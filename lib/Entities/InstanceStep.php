<?php

namespace Catalytic\SDK\Entities;

/**
 * A object which represents a step on a particular instance of a workflow
 */
class InstanceStep
{
    private $id;
    private $instanceId;
    private $workflowId;
    private $name;
    private $teamName;
    private $position;
    private $description;
    private $status;
    private $assignedTo;
    private $outputFields;

    public function __construct(
        $id = null,
        $instanceId = null,
        $workflowId = null,
        $name = null,
        $teamName = null,
        $position = null,
        $description = null,
        $status = null,
        $assignedTo = null,
        $outputFields = null
    ) {
        $this->id = $id;
        $this->instanceId = $instanceId;
        $this->workflowId = $workflowId;
        $this->name = $name;
        $this->teamName = $teamName;
        $this->position = $position;
        $this->description = $description;
        $this->status = $status;
        $this->assignedTo = $assignedTo;
        $this->outputFields = $outputFields;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of instanceId
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * Set the value of instanceId
     */
    public function setInstanceId($instanceId)
    {
        $this->instanceId = $instanceId;
    }

    /**
     * Get the value of workflowId
     */
    public function getWorkflowId()
    {
        return $this->workflowId;
    }

    /**
     * Set the value of workflowId
     */
    public function setWorkflowId($workflowId)
    {
        $this->workflowId = $workflowId;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of teamName
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set the value of teamName
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }

    /**
     * Get the value of position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of assignedTo
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * Set the value of assignedTo
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo = $assignedTo;
    }

    /**
     * Get the value of outputFields
     */
    public function getOutputFields()
    {
        return $this->outputFields;
    }

    /**
     * Set the value of outputFields
     */
    public function setOutputFields($outputFields)
    {
        $this->outputFields = $outputFields;
    }
}