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
    private $assignedToEmail;
    private $actionTypeId;
    private $isAutomated;
    private $startDate;
    private $endDate;
    private $completedByEmail;
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
        $assignedToEmail = null,
        $actionTypeId = null,
        $isAutomated = null,
        $startDate = null,
        $endDate = null,
        $completedByEmail = null,
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
        $this->assignedToEmail = $assignedToEmail;
        $this->actionTypeId = $actionTypeId;
        $this->isAutomated = $isAutomated;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->completedByEmail = $completedByEmail;
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
     * Get the value of assignedToEmail
     */
    public function getAssignedToEmail()
    {
        return $this->assignedToEmail;
    }

    /**
     * Set the value of assignedToEmail
     */
    public function setAssignedToEmail($assignedToEmail)
    {
        $this->assignedToEmail = $assignedToEmail;
    }

    /**
     * Get the value of actionTypeId
     */
    public function getActionTypeId()
    {
        return $this->actionTypeId;
    }

    /**
     * Set the value of actionTypeId
     */
    public function setActionTypeId($actionTypeId)
    {
        $this->actionTypeId = $actionTypeId;
    }

    /**
     * Get the value of isAutomated
     */
    public function getIsAutomated()
    {
        return $this->isAutomated;
    }

    /**
     * Set the value of isAutomated
     */
    public function setIsAutomated($isAutomated)
    {
        $this->isAutomated = $isAutomated;
    }

    /**
     * Get the value of startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Get the value of endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Get the value of completedByEmail
     */
    public function getCompletedByEmail()
    {
        return $this->completedByEmail;
    }

    /**
     * Set the value of completedByEmail
     */
    public function setCompletedByEmail($completedByEmail)
    {
        $this->completedByEmail = $completedByEmail;
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