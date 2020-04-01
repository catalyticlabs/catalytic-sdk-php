<?php

namespace Catalytic\SDK\Entities;

use Catalytic\SDK\Model\{InstanceStatus, FieldVisibility, InstanceVisibilty};
use Exception;

/**
 * An instance object
 */
class Instance
{
    private string $id;
    private string $pushbotId;
    private string $name;
    private string $teamName;
    private ?string $description;
    private ?string $category;
    private string $owner;
    private string $createdBy;
    private ?array $steps;
    private array $fields;
    private string $status;
    private string $fieldVisibility;
    private string $visibility;
    private array $visibleToUsers;

    public function __construct(
        $id = null,
        $pushbotId = null,
        $name = null,
        $teamName = null,
        $description = null,
        $category = null,
        $owner = null,
        $createdBy = null,
        $steps = null,
        $fields = null,
        $status = null,
        $fieldVisibility = null,
        $visibility = null,
        $visibleToUsers = null
    ) {
        $this->id = $id;
        $this->pushbotId = $pushbotId;
        $this->name = $name;
        $this->teamName = $teamName;
        $this->description = $description;
        $this->category = $category;
        $this->owner = $owner;
        $this->createdBy = $createdBy;
        $this->steps = $steps;
        $this->fields = $fields;
        $this->status = $status;
        $this->fieldVisibility = $fieldVisibility;
        $this->visibility = $visibility;
        $this->visibleToUsers = $visibleToUsers;
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
     * Alias for $this->id
     */
    public function getInstanceId()
    {
        return $this->id;
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
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Get the value of owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get the value of createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set the value of createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Get the value of steps
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Set the value of steps
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    /**
     * Get the value of fields
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set the value of fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
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
        // Validate $status is a valid value
        if (in_array($status, InstanceStatus::getAllowableEnumValues())) {
            $possibleValues = implode(', ', InstanceStatus::getAllowableEnumValues());
            throw new Exception('Invalid value for $status param. Must be one of ' . $possibleValues);
        }
        $this->status = $status;
    }

    /**
     * Get the value of fieldVisibility
     */
    public function getFieldVisibility()
    {
        return $this->fieldVisibility;
    }

    /**
     * Set the value of fieldVisibility
     */
    public function setFieldVisibility($fieldVisibility)
    {
        // Validate $fieldVisibility is a valid value
        if (in_array($fieldVisibility, FieldVisibility::getAllowableEnumValues())) {
            $possibleValues = implode(', ', FieldVisibility::getAllowableEnumValues());
            throw new Exception('Invalid value for $fieldVisibility param. Must be one of ' . $possibleValues);
        }
        $this->fieldVisibility = $fieldVisibility;
    }

    /**
     * Get the value of visibility
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set the value of visibility
     */
    public function setVisibility($visibility)
    {
        // Validate $visibility is a valid value
        if (in_array($visibility, InstanceVisibilty::getAllowableEnumValues())) {
            $possibleValues = implode(', ', InstanceVisibilty::getAllowableEnumValues());
            throw new Exception('Invalid value for $visibility param. Must be one of ' . $possibleValues);
        }
        $this->visibility = $visibility;
    }

    /**
     * Get the value of visibleToUsers
     */
    public function getVisibleToUsers()
    {
        return $this->visibleToUsers;
    }

    /**
     * Set the value of visibleToUsers
     */
    public function setVisibleToUsers($visibleToUsers)
    {
        $this->visibleToUsers = $visibleToUsers;
    }
}