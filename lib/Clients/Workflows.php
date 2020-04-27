<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\WorkflowsApi;
use Catalytic\SDK\Entities\{Workflow, WorkflowsPage, WorkflowExport};
use Catalytic\SDK\Model\{Workflow as InternalWorkflow, WorkflowExportRequest};
use Catalytic\SDK\Search\{Filter, SearchUtils};

/**
 * Workflow client to be exposed to consumers
 */
class Workflows
{
    private WorkflowsApi $workflowsApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->workflowsApi = new WorkflowsApi(null, $config);
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
     * @return WorkflowExport                The exported workflow object
     */
    public function export(string $id, string $password = null) : WorkflowExport
    {
        $workflowExportRequest = null;

        if (isset($password)) {
            $workflowExportRequest = new WorkflowExportRequest(array('workflowID' => $id, 'password' => $password));
        }

        // Submit a request to export a workflow
        $internalWorkflowExport = $this->workflowsApi->exportWorkflow($id, $workflowExportRequest);

        // Poll another request every second until the export is ready
        while ($internalWorkflowExport['fileId'] === null) {
            $exportId = $internalWorkflowExport['id'];
            $internalWorkflowExport = $this->workflowsApi->getWorkflowExport($exportId, $workflowExportRequest);
            sleep(1);
        }

        $workflowExport = new WorkflowExport(
            $internalWorkflowExport->getId(),
            $internalWorkflowExport->getName(),
            $internalWorkflowExport->getFileId(),
            $internalWorkflowExport->getErrorMessage()
        );
        return $workflowExport;
    }

    // TODO: Finish/test
    public function import(SplFileObject $importFile, string $password)
    {
        $workflowImportRequest = $this->workflowsApi->importWorkflow($)
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
