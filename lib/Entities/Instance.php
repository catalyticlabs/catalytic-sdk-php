<?php

namespace Catalytic\SDK\Entities;

use Catalytic\SDK\Model\{InstanceStatus, FieldVisibility, InstanceVisibilty};
use Exception;

/**
 * An instance object
 */
class Instance
{
    private $id;
    private $workflowId;
    private $name;
    private $teamName;
    private $description;
    private $category;
    private $ownerEmail;
    private $createdByEmail;
    private $fields;
    private $status;
    private $startDate;
    private $endDate;
    private $fieldVisibility;
    private $visibility;
    private $visibleToUserEmails;

    public function __construct(
        $id = null,
        $workflowId = null,
        $name = null,
        $teamName = null,
        $description = null,
        $category = null,
        $ownerEmail = null,
        $createdByEmail = null,
        $fields = null,
        $status = null,
        $startDate = null,
        $endDate = null,
        $fieldVisibility = null,
        $visibility = null,
        $visibleToUserEmails = null
    ) {
        $this->id = $id;
        $this->workflowId = $workflowId;
        $this->name = $name;
        $this->teamName = $teamName;
        $this->description = $description;
        $this->category = $category;
        $this->ownerEmail = $ownerEmail;
        $this->createdByEmail = $createdByEmail;
        $this->fields = $fields;
        $this->status = $status;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->fieldVisibility = $fieldVisibility;
        $this->visibility = $visibility;
        $this->visibleToUserEmails = $visibleToUserEmails;
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
     * Get the value of ownerEmail
     */
    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    /**
     * Set the value of ownerEmail
     */
    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;
    }

    /**
     * Get the value of createdByEmail
     */
    public function getCreatedByEmail()
    {
        return $this->createdByEmail;
    }

    /**
     * Set the value of createdByEmail
     */
    public function setCreatedByEmail($createdByEmail)
    {
        $this->createdByEmail = $createdByEmail;
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
     * Get the value of visibleToUserEmails
     */
    public function getVisibleToUserEmails()
    {
        return $this->visibleToUserEmails;
    }

    /**
     * Set the value of visibleToUserEmails
     */
    public function setVisibleToUserEmails($visibleToUserEmails)
    {
        $this->visibleToUserEmails = $visibleToUserEmails;
    }
}