<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\WorkflowsApi;
use Catalytic\SDK\Entities\{File, Workflow, WorkflowsPage};
use Catalytic\SDK\Model\{Workflow as InternalWorkflow, WorkflowExportRequest, WorkflowImportRequest};
use Catalytic\SDK\Search\{Filter, SearchUtils};
use SplFileObject;

/**
 * Workflow client to be exposed to consumers
 */
class Workflows
{
    private WorkflowsApi $workflowsApi;
    private Files $filesClient;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->workflowsApi = new WorkflowsApi(null, $config);
        $this->filesClient = new Files(trim($secret));
    }

    /**
     * Get a workflow by id
     *
     * @param string $id    The id of the workflow to get
     * @return Workflow      The Workflow object
     */
    public function get(string $id) : Workflow
    {
        $internalWorkflow = $this->workflowsApi->getWorkflow($id);
        $workflow = $this->createWorkflow($internalWorkflow);
        return $workflow;
    }

    /**
     * Find workflows by a variety of filters
     *
     * @param Filter $filter    The filter criteria to search workflows by
     * @param string $pageToken The token of the page to fetch
     * @param int    $pageSize  The number of workflows per page to fetch
     * @return WorkflowsPage     A WorkflowsPage which contains the reults
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null) : WorkflowsPage
    {
        $text = null;
        $owner = null;
        $category = null;

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
            $category = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'category');
        }

        $internalWorkflows = $this->workflowsApi->findWorkflows($text, null, null, null, $owner, $category, null, $pageToken, $pageSize);
        $workflows = [];
        foreach ($internalWorkflows->getWorkflows() as $internalWorkflow) {
            $workflow = $this->createWorkflow($internalWorkflow);
            array_push($workflows, $workflow);
        }
        $workflowsPage = new WorkflowsPage($workflows, $internalWorkflows->getCount(), $internalWorkflows->getNextPageToken());
        return $workflowsPage;
    }

    /**
     * Export a workflow by id
     *
     * @param string $id                    The id of the workflow to export
     * @param string $password (Optional)   The password for the workflow
     * @return File                         The exported workflow file object
     */
    public function export(string $id, string $password = null) : File
    {
        $workflowExportRequest = null;

        if (isset($password)) {
            $workflowExportRequest = new WorkflowExportRequest(array('workflowID' => $id, 'password' => $password));
        }

        // Submit a request to export a workflow
        $internalWorkflowExport = $this->workflowsApi->exportWorkflow($id, $workflowExportRequest);

        // Poll another request every second until the export is ready
        while ($internalWorkflowExport->getFileId() === null) {
            $exportId = $internalWorkflowExport->getId();
            $internalWorkflowExport = $this->workflowsApi->getWorkflowExport($exportId, $workflowExportRequest);
            sleep(1);
        }

        $file = $this->filesClient->get($internalWorkflowExport->getFileId());
        return $file;
    }

    /**
     * Import a workflow
     *
     * @param SplFileObject $importFile             The workflow to be imported
     * @param string        $password (Optional)    The password for the workflow
     * @return Workflow                             The imported workflow
     */
    public function import(SplFileObject $importFile, string $password = null) : Workflow
    {
        // Upload the file
        $file = $this->filesClient->upload($importFile);
        $workflowImportBody = array('fileId' => $file->getId());

        if (isset($password)) {
            $workflowImportBody['password'] = $password;
        }

        $workflowImportRequest = new WorkflowImportRequest($workflowImportBody);

        // Submit a request to import the workflow
        $internalWorkflowImport = $this->workflowsApi->importWorkflow($workflowImportRequest);

        // Poll another request every second until the import is ready
        while ($internalWorkflowImport->getWorkflowId() === null) {
            $importId = $internalWorkflowImport->getId();
            $internalWorkflowImport = $this->workflowsApi->getWorkflowImport($importId, $workflowImportRequest);
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
    private function createWorkflow(InternalWorkflow $internalWorkflow) : Workflow
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
