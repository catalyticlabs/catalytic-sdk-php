<?php

namespace Catalytic\SDK\Entities;

class InstanceStep
{
    private string $id;
    private string $instanceId;
    private string $pushbotId;
    private string $name;
    private string $teamName;
    private string $position;
    private ?string $description;
    private string $status;
    private ?string $assignedTo;
    private ?array $outputFields;

    public function __construct(
        $id = null,
        $instanceId = null,
        $pushbotId = null,
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
        $this->pushbotId = $pushbotId;
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
     * Get the value of pushbotId
     */
    public function getPushbotId()
    {
        return $this->pushbotId;
    }

    /**
     * Set the value of pushbotId
     */
    public function setPushbotId($pushbotId)
    {
        $this->pushbotId = $pushbotId;
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