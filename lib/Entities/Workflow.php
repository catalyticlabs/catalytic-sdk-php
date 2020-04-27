<?php

namespace Catalytic\SDK\Entities;

use Catalytic\SDK\Model\{FieldVisibility, InstanceVisibilty};
use Exception;

/**
 * A Workflow object
 */
class Workflow
{
    private string $id;
    private string $name;
    private string $teamName;
    private ?string $description;
    private string $category;
    private string $owner;
    private string $createdBy;
    private array $inputFields;
    private bool $isPublished;
    private bool $isArchived;
    private string $fieldVisibility;
    private string $instanceVisibility;
    private array $adminUsers;
    private array $standardUsers;

    public function __construct(
        $id = null,
        $name = null,
        $teamName = null,
        $description = null,
        $category = null,
        $owner = null,
        $createdBy = null,
        $inputFields = null,
        $isPublished = null,
        $isArchived = null,
        $fieldVisibility = null,
        $instanceVisibility = null,
        $adminUsers = null,
        $standardUsers = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->teamName = $teamName;
        $this->description = $description;
        $this->category = $category;
        $this->owner = $owner;
        $this->createdBy = $createdBy;
        $this->inputFields = $inputFields;
        $this->isPublished = $isPublished;
        $this->isArchived = $isArchived;
        $this->fieldVisibility = $fieldVisibility;
        $this->instanceVisibility = $instanceVisibility;
        $this->adminUsers = $adminUsers;
        $this->standardUsers = $standardUsers;
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
    public function getWorkflowId()
    {
        return $this->id;
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
     * Get the value of inputFields
     */
    public function getInputFields()
    {
        return $this->inputFields;
    }

    /**
     * Set the value of inputFields
     */
    public function setInputFields($inputFields)
    {
        $this->inputFields = $inputFields;
    }

    /**
     * Get the value of isPublished
     */
    public function isPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set the value of isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * Get the value of isArchived
     */
    public function isArchived()
    {
        return $this->isArchived;
    }

    /**
     * Set the value of isArchived
     */
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;
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
    public function setFieldVisibility(string $fieldVisibility)
    {
        // Validate $fieldVisibility is a valid value
        if (in_array($fieldVisibility, FieldVisibility::getAllowableEnumValues())) {
            $possibleValues = implode(', ', FieldVisibility::getAllowableEnumValues());
            throw new Exception('Invalid value for $fieldVisibility param. Must be one of ' . $possibleValues);
        }
        $this->fieldVisibility = $fieldVisibility;
    }

    /**
     * Get the value of instanceVisibility
     */
    public function getInstanceVisibility()
    {
        return $this->instanceVisibility;
    }

    /**
     * Set the value of instanceVisibility
     */
    public function setInstanceVisibility(string $instanceVisibility)
    {
        // Validate $instanceVisibility is a valid value
        if (in_array($instanceVisibility, InstanceVisibilty::getAllowableEnumValues())) {
            $possibleValues = implode(', ', InstanceVisibilty::getAllowableEnumValues());
            throw new Exception('Invalid value for $instanceVisibility param. Must be one of ' . $possibleValues);
        }
        $this->instanceVisibility = $instanceVisibility;
    }

    /**
     * Get the value of adminUsers
     */
    public function getAdminUsers()
    {
        return $this->adminUsers;
    }

    /**
     * Set the value of adminUsers
     */
    public function setAdminUsers($adminUsers)
    {
        $this->adminUsers = $adminUsers;
    }

    /**
     * Get the value of standardUsers
     */
    public function getStandardUsers()
    {
        return $this->standardUsers;
    }

    /**
     * Set the value of standardUsers
     */
    public function setStandardUsers($standardUsers)
    {
        $this->standardUsers = $standardUsers;
    }
}