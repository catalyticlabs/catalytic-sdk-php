<?php

namespace Catalytic\SDK\Clients;

use SplFileObject;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\WorkflowsApi;
use Catalytic\SDK\Clients\ClientHelpers;
use Catalytic\SDK\Search\{Filter, SearchUtils};
use Catalytic\SDK\Exceptions\{InternalErrorException, WorkflowNotFoundException, UnauthorizedException};
use Catalytic\SDK\Entities\{File, Workflow, WorkflowsPage};
use Catalytic\SDK\Model\{Workflow as InternalWorkflow, WorkflowExportRequest, WorkflowImportRequest};

/**
 * Workflow client to be exposed to consumers
 */
class Workflows
{
    private $token;
    private $workflowsApi;
    private $filesClient;

    /**
     * Constructor for Workflows client
     *
     * @param string $token                             The token used to make the underlying api calls
     * @param WorkflowsApi  $workflowsApi (Optional)    The injected WorkflowsApi. Used for unit testing
     * @param Files         $filesClient (Optional)     The injected FilesClient. Used for unit testing
     */
    public function __construct($token, $workflowsApi = null, $filesClient = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(Workflows::class);
        $this->token = ClientHelpers::trimIfString($token);

        if ($token) {
            $config = ConfigurationUtils::getConfiguration($this->token);
        }

        if ($workflowsApi) {
            $this->workflowsApi = $workflowsApi;
        } else {
            $this->workflowsApi = new WorkflowsApi(null, $config);
        }

        if ($filesClient) {
            $this->filesClient = $filesClient;
        } else {
            $this->filesClient = new Files($this->token);
        }
    }

    /**
     * Get a Workflow by id
     *
     * @param string $id                    The id of the workflow to get
     * @return Workflow                     The Workflow object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws WorkflowNotFoundException    If Workflow not found
     * @throws InternalErrorException       If any errors fetching Workflow
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($id)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting Workflow with id $id");
            $internalWorkflow = $this->workflowsApi->getWorkflow($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new WorkflowNotFoundException("Workflow with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get Workflow", $e);
        }
        $workflow = $this->createWorkflow($internalWorkflow);
        return $workflow;
    }

    /**
     * Find Workflows by a variety of filters
     *
     * @param Filter $filter (Optional)     The filter criteria to search Workflows by
     * @param string $pageToken (Optional)  The token of the page to fetch
     * @param int    $pageSize (Optional)   The number of Workflows per page to fetch
     * @return WorkflowsPage                A WorkflowsPage which contains the reults
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors finding Workflows
     * @throws UnauthorizedException        If unauthorized
     */
    public function find($filter = null, $pageToken = null, $pageSize = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $text = null;
        $owner = null;
        $category = null;
        $workflows = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
            $category = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'category');
        }

        try {
            $this->logger->debug("Finding Workflows with text $text, owner $owner, category $category");
            $internalWorkflows = $this->workflowsApi->findWorkflows($text, null, null, null, $owner, $category, null, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find Workflows", $e);
        }

        foreach ($internalWorkflows->getWorkflows() as $internalWorkflow) {
            $workflow = $this->createWorkflow($internalWorkflow);
            array_push($workflows, $workflow);
        }
        $workflowsPage = new WorkflowsPage($workflows, $internalWorkflows->getCount(), $internalWorkflows->getNextPageToken());
        return $workflowsPage;
    }

    /**
     * Export a Workflow by id
     *
     * @param string $id                    The id of the Workflow to export
     * @param string $password (Optional)   The password for the Workflow
     * @return File                         The exported Workflow file object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws WorkflowNotFoundException    If Workflow is not found
     * @throws InternalErrorException       If any errors exporting Workflow
     * @throws UnauthorizedException        If unauthorized
     */
    public function export($id, $password = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $workflowExportRequest = null;

        if (isset($password)) {
            $workflowExportRequest = new WorkflowExportRequest(array('workflowID' => $id, 'password' => $password));
        }

        // Submit a request to export a workflow
        try {
            $this->logger->debug("Exporting Workflow with id $id");
            $internalWorkflowExport = $this->workflowsApi->exportWorkflow($id, $workflowExportRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new WorkflowNotFoundException("Workflow with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to export Workflow with id $id", $e);
        }

        // Poll another request every second until the export is ready
        while ($internalWorkflowExport->getFileId() === null) {
            $exportId = $internalWorkflowExport->getId();
            try {
                $this->logger->debug("Getting Workflow Export with id $exportId");
                $internalWorkflowExport = $this->workflowsApi->getWorkflowExport($exportId, $workflowExportRequest);
            } catch (ApiException $e) {
                throw new InternalErrorException("Unable to export Workflow with id $id", $e);
            }
            sleep(1);
        }

        $file = $this->filesClient->get($internalWorkflowExport->getFileId());
        return $file;
    }

    /**
     * Import a Workflow
     *
     * @param SplFileObject $importFile             The workflow to be imported
     * @param string        $password (Optional)    The password for the workflow
     * @return Workflow                             The imported workflow
     * @throws AccessTokenNotFoundException         If the client was instantiated without an Access Token
     * @throws InternalErrorException               If any errors importing Workflow
     * @throws UnauthorizedException                If unauthorized
     */
    public function import($importFile, $password = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        // Upload the file
        $file = $this->filesClient->upload($importFile);
        $workflowImportBody = array('fileId' => $file->getId());

        if (isset($password)) {
            $workflowImportBody['password'] = $password;
        }

        $workflowImportRequest = new WorkflowImportRequest($workflowImportBody);

        // Submit a request to import the workflow
        try {
            $this->logger->debug("Importing workflow");
            $internalWorkflowImport = $this->workflowsApi->importWorkflow($workflowImportRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to import Workflow", $e);
        }

        // Poll another request every second until the import is ready
        while ($internalWorkflowImport->getWorkflowId() === null) {
            $importId = $internalWorkflowImport->getId();
            try {
                $this->logger->debug("Getting Workflow Import with id $importId");
                $internalWorkflowImport = $this->workflowsApi->getWorkflowImport($importId, $workflowImportRequest);
            } catch (ApiException $e) {
                throw new InternalErrorException("Unable to import Workflow", $e);
            }
            sleep(1);
        }

        $workflow = $this->get($internalWorkflowImport->getWorkflowId());
        return $workflow;
    }

    /**
     * Create a Workflow object from an internal Workflow object
     *
     * @param InternalWorkflow  $internalWorkflow     The internal workflow to create a Workflow object from
     * @return Workflow         $workflow             The created Workflow object
     */
    private function createWorkflow($internalWorkflow)
    {
        $workflow = new Workflow(
            $internalWorkflow->getId(),
            $internalWorkflow->getName(),
            $internalWorkflow->getTeamName(),
            $internalWorkflow->getDescription(),
            $internalWorkflow->getCategory(),
            $internalWorkflow->getOwner(),
            $internalWorkflow->getCreatedBy(),
            $internalWorkflow->getInputFields(),
            $internalWorkflow->getIsPublished(),
            $internalWorkflow->getIsArchived(),
            $internalWorkflow->getFieldVisibility(),
            $internalWorkflow->getInstanceVisibility(),
            $internalWorkflow->getAdminUsers(),
            $internalWorkflow->getStandardUsers()
        );
        return $workflow;
    }
}
