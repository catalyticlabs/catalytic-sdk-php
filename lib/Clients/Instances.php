<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\{InstancesApi, InstanceStepsApi};
use Catalytic\SDK\Entities\{Instance, InstanceStep};
use Catalytic\SDK\Model\{
    CompleteStepRequest,
    FieldUpdateRequest,
    Instance as InternalInstance,
    InstanceStep as InternalInstanceStep,
    InstanceStepsPage,
    StartInstanceRequest
};

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
     * Get a pushbot instance by id
     *
     * @param string $id    The id of the pushbot instance to get
     * @param Instance      The Instance object
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
     * @param Where $filter The filter criteria to look up instances
     */
    public function find(Where $filter)
    {
        $instances = $this->instancesApi->findInstances($filter);
        return $instances;
    }

    /**
     * Start an instance of a pushbot for a given pushbot id
     *
     * @param string $pushbotId                 The id of the pushbot to start an instance
     * @param string $name (Optional)           The name to give to the instance
     * @param string $description (Optional)    The description to give to the instance
     * @param array  $fields (Optional)         The input fields to use when starting this instance
     * @return Instance                         The newly created instance
     */
    public function start(string $pushbotId, string $name = null, string $description = null, array $fields = null) : Instance
    {
        $request = $this->createStartInstanceRequest($pushbotId, $name, $description, $fields);
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
        $stoppedInstance = $this->instancesApi->stopInstance($id);
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
     */
    public function findSteps(Where $filter)
    {
        $steps = $this->instanceStepsApi->findInstanceSteps(null, $filter);
        return $steps;
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
     * @param string $id                        The id to create the CompleteStepRequest with
     * @param string $name (Optional)           The name to create the CompleteStepRequest with
     * @param string $description (Optional)    The description to create the CompleteStepRequest with
     * @param array  $fields (Optional)         The fields to create the CompleteStepRequest with
     * @return StartInstanceRequest             The created StartInstanceRequest object
     */
    private function createStartInstanceRequest(string $pushbotId, string $name = null, string $description = null, array $fields = null) : StartInstanceRequest
    {
        $config = array('pushbotId' => $pushbotId);

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

        $stepRequest = new StartInstanceRequest($config);
        return $stepRequest;
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
     * @return Instance         $instance           The created Instance object
     */
    private function createInstance(InternalInstance $internalInstance): Instance
    {
        $instance = new Instance(
            $internalInstance->getId(),
            $internalInstance->getPushbotId(),
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
     * @return InstanceStep         $instanceStep           The created InstanceStep object
     */
    private function createInstanceStep(InternalInstanceStep $internalInstanceStep) : InstanceStep
    {
        $instanceStep = new InstanceStep(
            $internalInstanceStep->getId(),
            $internalInstanceStep->getInstanceId(),
            $internalInstanceStep->getPushbotId(),
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