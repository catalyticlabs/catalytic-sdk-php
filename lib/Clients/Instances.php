<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Entities\Instance;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Entities\InstanceStep;
use Catalytic\SDK\Model\{CompleteStepRequest, StartInstanceRequest};
use Catalytic\SDK\Api\{InstancesApi, InstanceStepsApi};

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
     * @param string $id  The id of the pushbot instance to get
     */
    public function get(string $id)
    {
        $internalInstance = $this->instancesApi->getInstance($id);
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
     * @param string $pushbotId The id of the pushbot to start an instance
     */
    public function start(string $pushbotId)
    {
        $request = new StartInstanceRequest(array('pushbotId' => $pushbotId));
        // print_r($request);
        // $internalInstance = $this->instancesApi->startInstance($request);
        $internalInstance = $this->instancesApi->startInstance($request);
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
     * Stops an instance by instance id
     *
     * @param string $id  The id of the instance to stop
     */
    public function stop(string $id)
    {
        $stoppedInstance = $this->instancesApi->stopInstance($id);
        return $stoppedInstance;
    }

    /**
     * Gets a step by step id
     *
     * @param string $id  The id of the step to get
     */
    public function getStep(string $id)
    {
        $internalStep = $this->getStepById($id);
        $step = new InstanceStep(
            $internalStep->getId(),
            $internalStep->getInstanceId(),
            $internalStep->getPushbotId(),
            $internalStep->getName(),
            $internalStep->getTeamName(),
            $internalStep->getPosition(),
            $internalStep->getDescription(),
            $internalStep->getStatus(),
            $internalStep->getAssignedTo(),
            $internalStep->getOutputFields()
        );
        return $step;
    }

    /**
     * Gets all the steps for a specific instance id
     *
     * @param string $instanceId  The id of the instances to get steps for
     */
    public function getSteps(string $instanceId)
    {
        $internalSteps = $this->instanceStepsApi->findInstanceSteps($instanceId);
        // TODO: Need to paginate here
        echo $internalSteps;
        $steps = [];

        // Wrap each step in a step wrapper object
        foreach ($internalSteps->getSteps() as $step) {
            $newStep = new InstanceStep(
                $step->getId(),
                $step->getInstanceId(),
                $step->getPushbotId(),
                $step->getName(),
                $step->getTeamName(),
                $step->getPosition(),
                $step->getDescription(),
                $step->getStatus(),
                $step->getAssignedTo(),
                $step->getOutputFields()
            );
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
     * @param string $id  The id of the step to complete
     * @param array $fields (Optional)  Fields and the values to use when completing a step
     */
    public function completeStep(string $id, array $fields = null)
    {
        $step = $this->getStepById($id);
        $completeStepRequest = $this->createCompleteStepRequest($id, $fields);
        $internalStep = $this->instanceStepsApi->completeStep($id, $step->getInstanceId());
        $completedStep = new InstanceStep(
            $internalStep->getId(),
            $internalStep->getInstanceId(),
            $internalStep->getPushbotId(),
            $internalStep->getName(),
            $internalStep->getTeamName(),
            $internalStep->getPosition(),
            $internalStep->getDescription(),
            $internalStep->getStatus(),
            $internalStep->getAssignedTo(),
            $internalStep->getOutputFields()
        );
        return $completedStep;
    }

    /**
     * Get an instance step by its id
     *
     * @param string $id    The id of the step to get
     */
    private function getStepById(string $id)
    {
        // The REST api supports wildcard instance id when searching for instance steps
        // https://cloud.google.com/apis/design/design_patterns#list_sub-collections
        $wildcardInstanceId = '-';
        $step = $this->instanceStepsApi->getInstanceStep($id, $wildcardInstanceId);
        return $step;
    }

    private function createCompleteStepRequest(string $id, array $fields)
    {
        $stepRequest = new CompleteStepRequest(array('id' => $id, 'stepOutputFields' => $fields));
        // $allFields = [];
        // foreach($fields as $field) {
        //     $newField = new CompleteStepRequest()
        // }
        return $stepRequest;
    }
}