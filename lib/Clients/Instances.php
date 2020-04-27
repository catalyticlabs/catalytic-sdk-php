<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\{InstancesApi, InstanceStepsApi};
use Catalytic\SDK\Entities\{Instance, InstanceStep, InstancesPage};
use Catalytic\SDK\Model\{
    CompleteStepRequest,
    FieldUpdateRequest,
    Instance as InternalInstance,
    InstanceStep as InternalInstanceStep,
    InstanceStepsPage,
    StartInstanceRequest
};
use Catalytic\SDK\Search\{Filter, SearchUtils};

/**
 * Instance client to be exposed to consumers
 */
class Instances
{
    private InstancesApi $instancesApi;
    private InstanceStepsApi $instanceStepsApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->instancesApi = new InstancesApi(null, $config);
        $this->instanceStepsApi = new InstanceStepsApi(null, $config);
    }

    /**
     * Get a workflow instance by id
     *
     * @param string $id    The id of the workflow instance to get
     * @return Instance     The Instance object
     */
    public function get(string $id) : Instance
    {
        $internalInstance = $this->instancesApi->getInstance($id);
        $instance = $this->createInstance($internalInstance);
        return $instance;
    }

    /**
     * Find instances by a variety of criteria
     *
     * @param Filter $filter The filter criteria to search instances by
     * @param string $pageToken The token of the page to fetch
     * @param int    $pageSize  The number of workflows per page to fetch
     * @return InstancesPage    An InstancesPage which contains the reults
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null) : InstancesPage
    {
        $text = null;
        $owner = null;
        $status = null;
        $workflowId = null;

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
            $status = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'status');
            $workflowId = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'workflowId');
        }

        $internalInstances = $this->instancesApi->findInstances($text, $status, $workflowId, null, $owner, null, null, $pageToken, $pageSize);
        $instances = [];
        foreach ($internalInstances->getInstances() as $internalInstance) {
            $instance = $this->createInstance($internalInstance);
            array_push($instances, $instance);
        }

        $instancesPage = new InstancesPage($instances, $internalInstances->getCount(), $internalInstances->getNextPageToken());
        return $instancesPage;
    }

    /**
     * Start an instance of a workflow for a given workflow id
     *
     * @param string $workflowId                 The id of the workflow to start an instance
     * @param string $name (Optional)           The name to give to the instance
     * @param string $description (Optional)    The description to give to the instance
     * @param array  $fields (Optional)         The input fields to use when starting this instance
     * @return Instance                         The newly created instance
     */
    public function start(string $workflowId, string $name = null, string $description = null, array $fields = null) : Instance
    {
        $request = $this->createStartInstanceRequest($workflowId, $name, $description, $fields);
        $internalInstance = $this->instancesApi->startInstance($request);
        $instance = $this->createInstance($internalInstance);
        return $instance;
    }

    /**
     * Stops an instance by instance id
     *
     * @param string $id    The id of the instance to stop
     * @param Instance      The Instance that was stopped
     */
    public function stop(string $id) : Instance
    {
        $internalStoppedInstance = $this->instancesApi->stopInstance($id);
        $stoppedInstance = $this->createInstance($internalStoppedInstance);
        return $stoppedInstance;
    }

    /**
     * Gets a step by step id
     *
     * @param string $id    The id of the step to get
     * @return InstanceStep The InstanceStep object
     */
    public function getStep(string $id) : InstanceStep
    {
        $internalStep = $this->getStepById($id);
        $step = $this->createInstanceStep($internalStep);
        return $step;
    }

    /**
     * Gets all the steps for a specific instance id
     *
     * @param string $instanceId    The id of the instances to get steps for
     * @return array                The InstanceStepsPage which contains the results
     */
    public function getSteps(string $instanceId) : array
    {
        $internalSteps = $this->instanceStepsApi->findInstanceSteps($instanceId);
        // TODO: Need to paginate here
        echo $internalSteps;
        $steps = [];

        // Wrap each step in a step wrapper object
        foreach ($internalSteps->getSteps() as $step) {
            $newStep = $this->createInstanceStep($step);
            array_push($steps, $newStep);
        }
        return $steps;
    }

    /**
     * Search for steps
     *
     * @param Filter $filter        The filter criteria to search instance steps by
     * @param string $pageToken     The token of the page to fetch
     * @param int    $pageSize      The number of instance steps per page to fetch
     * @return InstanceStepsPage    An InstanceStepsPage which contains the reults
     */
    public function findSteps(Filter $filter = null, string $pageToken = null, int $pageSize = null) : InstanceStepsPage
    {
        $text = null;
        $workflowId = null;
        $assignee = null;

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $workflowId = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'workflowId');
            $assignee = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'assignee');
        }

        $internalSteps = $this->instanceStepsApi->findInstanceSteps($instanceId, $text, null, $workflowId, null, null, null, $assignee, $pageToken, $pageSize);
        $steps = [];

        foreach ($internalSteps->getSteps() as $internalStep) {
            $step = $this->createInstanceStep($internalStep);
            array_push($steps, $step);
        }

        $stepsPage = new InstanceStepsPage($steps, $internalSteps->getCount(), $internalSteps->getNextPageToken());
        return $stepsPage;
    }

    /**
     * Completes a specific step
     *
     * @param string $id                The id of the step to complete
     * @param array  $fields (Optional) Fields and the values to use when completing a step
     * @return InstanceStep             The completed InstanceStep
     */
    public function completeStep(string $id, array $fields = null) : InstanceStep
    {
        $completeStepRequest = null;
        if (isset($fields)) {
            $completeStepRequest = $this->createCompleteStepRequest($id, $fields);
        }
        $step = $this->getStepById($id);
        $internalStep = $this->instanceStepsApi->completeStep($id, $step->getInstanceId(), $completeStepRequest);
        $completedStep = $this->createInstanceStep($internalStep);
        return $completedStep;
    }

    /**
     * Creates a StartInstanceRequest object with the passed in params
     *
     * @param string $workflowId                 The workflowId to create the StartInstanceRequest with
     * @param string $name (Optional)           The name to create the StartInstanceRequest with
     * @param string $description (Optional)    The description to create the StartInstanceRequest with
     * @param array  $fields (Optional)         The fields to create the StartInstanceRequest with
     * @return StartInstanceRequest             The created StartInstanceRequest object
     */
    private function createStartInstanceRequest(string $workflowId, string $name = null, string $description = null, array $fields = null) : StartInstanceRequest
    {
        $config = array('workflowId' => $workflowId);

        if (isset($name)) {
            $config['name'] = $name;
        }

        if (isset($description)) {
            $config['description'] = $description;
        }

        if (isset($fields)) {
            $inputFields = $this->formatFields($fields);
            $config['inputFields'] = $inputFields;
        }

        $startInstanceRequest = new StartInstanceRequest($config);
        return $startInstanceRequest;
    }

    /**
     * Creates a CompleteStepRequest object from an id and fields
     *
     * @param string $id            The id to create the CompleteStepRequest with
     * @param array  $fields        The fields to create the CompleteStepRequest with
     * @return CompleteStepRequest  The created CompleteStepRequest
     */
    private function createCompleteStepRequest(string $id, array $fields) : CompleteStepRequest
    {
        $stepOutputFields = $this->formatFields($fields);
        $stepRequest = new CompleteStepRequest(array('id' => $id, 'stepOutputFields' => $stepOutputFields));
        return $stepRequest;
    }

    /**
     * Creates a FieldUpdateRequest object for each of the fields
     *
     * @param  array $fields    The fields to create a FieldUpdateRequest for each one
     * @return array            The formatted fields
     */
    private function formatFields(array $fields) : array
    {
        $formattedFields = [];

        // Create a FieldUpdateRequest for each field
        foreach ($fields as $key => $value) {
            $fieldUpdateRequest = new FieldUpdateRequest(array('referenceName' => $key, 'value' => $value));
            array_push($formattedFields, $fieldUpdateRequest);
        }

        return $formattedFields;
    }

    /**
     * Get an instance step by its id
     *
     * @param string $id    The id of the step to get
     * @return InternalInstanceStep The InstanceStep object
     */
    private function getStepById(string $id) : InternalInstanceStep
    {
        // The REST api supports wildcard instance id when searching for instance steps
        // https://cloud.google.com/apis/design/design_patterns#list_sub-collections
        $wildcardInstanceId = '-';
        $step = $this->instanceStepsApi->getInstanceStep($id, $wildcardInstanceId);
        return $step;
    }

    /**
     * Create an Instance object from an internal Instance object
     *
     * @param InternalInstance  $internalInstance   The internal instance to create an Instance object from
     * @return Instance                             The created Instance object
     */
    private function createInstance(InternalInstance $internalInstance) : Instance
    {
        $instance = new Instance(
            $internalInstance->getId(),
            $internalInstance->getWorkflowId(),
            $internalInstance->getName(),
            $internalInstance->getTeamName(),
            $internalInstance->getDescription(),
            $internalInstance->getCategory(),
            $internalInstance->getOwner(),
            $internalInstance->getCreatedBy(),
            $internalInstance->getSteps(),
            $internalInstance->getFields(),
            $internalInstance->getStatus(),
            $internalInstance->getFieldVisibility(),
            $internalInstance->getVisibility(),
            $internalInstance->getVisibleToUsers()
        );
        return $instance;
    }

    /**
     * Create an InstanceStep object from an internal InstanceStep object
     *
     * @param InternalInstanceStep  $internalInstanceStep   The internal instance step to create an InstanceStep object from
     * @return InstanceStep                                 The created InstanceStep object
     */
    private function createInstanceStep(InternalInstanceStep $internalInstanceStep) : InstanceStep
    {
        $instanceStep = new InstanceStep(
            $internalInstanceStep->getId(),
            $internalInstanceStep->getInstanceId(),
            $internalInstanceStep->getWorkflowId(),
            $internalInstanceStep->getName(),
            $internalInstanceStep->getTeamName(),
            $internalInstanceStep->getPosition(),
            $internalInstanceStep->getDescription(),
            $internalInstanceStep->getStatus(),
            $internalInstanceStep->getAssignedTo(),
            $internalInstanceStep->getOutputFields()
        );
        return $instanceStep;
    }
}