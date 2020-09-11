<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ApiException;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\{InstancesApi, InstanceStepsApi};
use Catalytic\SDK\Clients\ClientHelpers;
use Catalytic\SDK\Entities\{Instance, InstanceStep, InstancesPage, InstanceStepsPage};
use Catalytic\SDK\Exceptions\{
    InstanceNotFoundException,
    InstanceStepNotFoundException,
    InternalErrorException,
    WorkflowNotFoundException,
    UnauthorizedException
};
use Catalytic\SDK\Model\{
    CompleteStepRequest,
    Instance as InternalInstance,
    InstanceStep as InternalInstanceStep,
    StartInstanceRequest
};
use Catalytic\SDK\Search\{Filter, SearchUtils};

/**
 * Instance client
 */
class Instances
{
    private $token;
    private $logger;
    private $instancesApi;
    private $instanceStepsApi;

    /**
     * Constructor for Workflows client
     *
     * @param string $token                                     The token used to make the underlying api calls
     * @param InstancesApi      $instancesApi (Optional)        The injected WorkflowsApi. Used for unit testing
     * @param InstanceStepsApi  $instanceStepsApi (Optional)    The injected FilesClient. Used for unit testing
     */
    public function __construct($token, $instancesApi = null, $instanceStepsApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(Instances::class);
        $this->token = ClientHelpers::trimIfString($token);

        if ($token) {
            $config = ConfigurationUtils::getConfiguration($this->token);
        }

        if ($instancesApi) {
            $this->instancesApi = $instancesApi;
        } else {
            $this->instancesApi = new InstancesApi(null, $config);
        }

        if ($instanceStepsApi) {
            $this->instanceStepsApi = $instanceStepsApi;
        } else {
            $this->instanceStepsApi = new InstanceStepsApi(null, $config);
        }
    }

    /**
     * Get a workflow Instance by id
     *
     * @param string $id                    The id of the workflow Instance to get
     * @return Instance                     The Instance object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InstanceNotFoundException    If Instance is not found
     * @throws InternalErrorException       If any errors fetching Instance
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($id)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting Instance with id $id");
            $internalInstance = $this->instancesApi->getInstance($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new InstanceNotFoundException("Instance with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get Instance", $e);
        }
        $instance = $this->createInstance($internalInstance);
        return $instance;
    }

    /**
     * Find Instances by a variety of criteria
     *
     * @param Filter $filter                The filter criteria to search instances by
     * @param string $pageToken             The token of the page to fetch
     * @param int    $pageSize              The number of workflows per page to fetch
     * @return InstancesPage                An InstancesPage which contains the results
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors finding Instances
     * @throws UnauthorizedException        If unauthorized
     */
    public function find($filter = null, $pageToken = null, $pageSize = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $text = null;
        $owner = null;
        $status = null;
        $workflowId = null;
        $instances = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
            $status = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'status');
            $workflowId = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'workflowId');
        }

        try {
            $this->logger->debug("Finding Instances with text $text, owner $owner, status $status, workflowId $workflowId");
            $internalInstances = $this->instancesApi->findInstances($text, $status, $workflowId, null, $owner, null, null, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find Instances", $e);
        }

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
     * @param string $workflowId                The id of the workflow to start an instance
     * @param string $name (Optional)           The name to give to the instance
     * @param string $description (Optional)    The description to give to the instance
     * @param array  $fields (Optional)         The input fields to use when starting this instance
     * @return Instance                         The newly created instance
     * @throws AccessTokenNotFoundException     If the client was instantiated without an Access Token
     * @throws WorkflowNotFoundException        If Workflow not found
     * @throws InternalErrorException           If any errors starting Instance
     * @throws UnauthorizedException            If unauthorized
     */
    public function start($workflowId, $name = null, $description = null, $fields = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $request = $this->createStartInstanceRequest($workflowId, $name, $description, $fields);

        try {
            $this->logger->debug("Starting Instance with workflowId $workflowId");
            $internalInstance = $this->instancesApi->startInstance($request);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new WorkflowNotFoundException("Workflow with id $workflowId not found", $e);
            }
            throw new InternalErrorException("Unable to start Workflow Instance", $e);
        }
        $instance = $this->createInstance($internalInstance);
        return $instance;
    }

    /**
     * Stops an Instance by Instance id
     *
     * @param string $id                    The id of the Instance to stop
     * @param Instance                      The Instance that was stopped
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InstanceNotFoundException    If Instance not found
     * @throws InternalErrorException       If any errors stopping Instance
     * @throws UnauthorizedException        If unauthorized
     */
    public function stop($id)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Stopping Instance with id $id");
            $internalStoppedInstance = $this->instancesApi->stopInstance($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new InstanceNotFoundException("Instance with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to stop Workflow Instance", $e);
        }
        $stoppedInstance = $this->createInstance($internalStoppedInstance);
        return $stoppedInstance;
    }

    /**
     * Gets a step by step id
     *
     * @param string $id                        The id of the step to get
     * @return InstanceStep                     The InstanceStep object
     * @throws AccessTokenNotFoundException     If the client was instantiated without an Access Token
     * @throws InstanceStepNotFoundException    If Instance Step not found
     * @throws InternalErrorException           If any errors fetching Instance Step
     * @throws UnauthorizedException            If unauthorized
     */
    public function getStep($id)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting step with id $id");
            $internalStep = $this->getStepById($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new InstanceStepNotFoundException("Instance Step with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get Instance Step", $e);
        }
        $step = $this->createInstanceStep($internalStep);
        return $step;
    }

    /**
     * Gets all the steps for a specific Instance id
     *
     * @param string $instanceId            The id of the Instance to get steps for
     * @return InstanceStepsPage            The InstanceStepsPage which contains the results
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors fetching Instance Steps
     * @throws UnauthorizedException        If unauthorized
     */
    public function getSteps($instanceId)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $steps = [];

        try {
            $this->logger->debug("Getting all the steps for Instance $instanceId");
            $results = $this->instanceStepsApi->findInstanceSteps($instanceId);
        } catch (ApiException $e) {
            throw new InternalErrorException("Unable to get Instance Steps", $e);
        }

        $allSteps = $results->getSteps();

        // Loop through and get all the steps
        while ($results->getNextPageToken() != null) {
            try {
                $results = $this->instanceStepsApi->findInstanceSteps($instanceId, $results->getNextPageToken());
            } catch (ApiException $e) {
                if ($e->getCode() === 401) {
                    throw new UnauthorizedException(null, $e);
                }
                throw new InternalErrorException("Unable to get Instance Steps", $e);
            }
            array_push($allSteps, $results->getSteps());
        }

        // Create external InstanceStep from each internal InstanceStep
        foreach ($allSteps as $step) {
            $newStep = $this->createInstanceStep($step);
            array_push($steps, $newStep);
        }
        return $steps;
    }

    /**
     * Search for steps
     *
     * @param Filter $filter                The filter criteria to search instance steps by
     * @param string $pageToken             The token of the page to fetch
     * @param int    $pageSize              The number of instance steps per page to fetch
     * @return InstanceStepsPage            An InstanceStepsPage which contains the reults
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors finding Instance Steps
     * @throws UnauthorizedException        If unauthorized
     */
    public function findSteps($filter = null, $pageToken = null, $pageSize = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $text = null;
        $workflowId = null;
        $assignee = null;
        $steps = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $workflowId = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'workflowId');
            $assignee = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'assignee');
        }

        try {
            $this->logger->debug("Finding steps with text $text, workflowId $workflowId, assignee $assignee");
            $internalSteps = $this->instanceStepsApi->findInstanceSteps(ClientHelpers::WILDCARD_ID, $text, null, $workflowId, null, null, null, $assignee, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find Instance Steps", $e);
        }

        // Loop through and get all the steps
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
     * @param string $id                        The id of the step to complete
     * @param array  $fields (Optional)         Fields and the values to use when completing a step
     * @return InstanceStep                     The completed InstanceStep
     * @throws AccessTokenNotFoundException     If the client was instantiated without an Access Token
     * @throws InstanceStepNotFoundException    If Instance Step not found
     * @throws InternalErrorException           If any errors completing Instance Step
     * @throws UnauthorizedException            If unauthorized
     */
    public function completeStep($id, $fields = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $completeStepRequest = null;
        if (isset($fields)) {
            $completeStepRequest = $this->createCompleteStepRequest($id, $fields);
        }
        $step = $this->getStepById($id);
        try {
            $this->logger->debug("Completing step with id $id");
            $internalStep = $this->instanceStepsApi->completeStep($id, $step->getInstanceId(), $completeStepRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new InstanceStepNotFoundException("Instance Step with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to complete Instance Step", $e);
        }
        $completedStep = $this->createInstanceStep($internalStep);
        return $completedStep;
    }

    /**
     * Creates a StartInstanceRequest object with the passed in params
     *
     * @param string $workflowId                The workflowId to create the StartInstanceRequest with
     * @param string $name (Optional)           The name to create the StartInstanceRequest with
     * @param string $description (Optional)    The description to create the StartInstanceRequest with
     * @param array  $fields (Optional)         The fields to create the StartInstanceRequest with
     * @return StartInstanceRequest             The created StartInstanceRequest object
     */
    private function createStartInstanceRequest($workflowId, $name = null, $description = null, $fields = null)
    {
        $config = array('workflowId' => $workflowId);

        if (isset($name)) {
            $config['name'] = $name;
        }

        if (isset($description)) {
            $config['description'] = $description;
        }

        if (isset($fields)) {
            $inputFields = ClientHelpers::formatFields($fields);
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
    private function createCompleteStepRequest($id, $fields)
    {
        $stepOutputFields = ClientHelpers::formatFields($fields);
        $stepRequest = new CompleteStepRequest(array('id' => $id, 'stepOutputFields' => $stepOutputFields));
        return $stepRequest;
    }

    /**
     * Get an instance step by its id
     *
     * @param string $id    The id of the step to get
     * @return InternalInstanceStep The InstanceStep object
     */
    private function getStepById($id)
    {
        $step = $this->instanceStepsApi->getInstanceStep($id, ClientHelpers::WILDCARD_ID);
        return $step;
    }

    /**
     * Create an Instance object from an internal Instance object
     *
     * @param InternalInstance  $internalInstance   The internal instance to create an Instance object from
     * @return Instance                             The created Instance object
     */
    private function createInstance($internalInstance)
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
            $internalInstance->getStartDate(),
            $internalInstance->getEndDate(),
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
    private function createInstanceStep($internalInstanceStep)
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
            $internalInstanceStep->getStartDate(),
            $internalInstanceStep->getEndDate(),
            $internalInstanceStep->getOutputFields()
        );
        return $instanceStep;
    }
}