<?php

namespace Catalytic\SDK\Entities;

/**
 * A DataTable object
 */
class DataTable
{
    private string $id;
    private string $referenceName;
    private string $name;
    private string $teamName;
    private ?string $description;
    private array $columns;
    private bool $isArchived;
    private string $type;
    private string $visibility;
    private array $visibleToUsers;
    private int $rowLimit;
    private int $columnLimit;
    private int $cellLimit;

    public function __construct(
        string $id = null,
        string $referenceName = null,
        string $name = null,
        string $teamName = null,
        string $description = null,
        array $columns = null,
        bool $isArchived = null,
        string $type = null,
        string $visibility = null,
        array $visibleToUsers = null,
        int $rowLimit = null,
        int $columnLimit = null,
        int $cellLimit = null
    ) {
        $this->id = $id;
        $this->referenceName = $referenceName;
        $this->name = $name;
        $this->teamName = $teamName;
        $this->description = $description;
        $this->columns = $columns;
        $this->isArchived = $isArchived;
        $this->type = $type;
        $this->visibility = $visibility;
        $this->visibleToUsers = $visibleToUsers;
        $this->rowLimit = $rowLimit;
        $this->columnLimit = $columnLimit;
        $this->cellLimit = $cellLimit;
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
     * Alias for id
     */
    public function getDataTableId()
    {
        return $this->id;
    }

    /**
     * Get the value of referenceName
     */
    public function getReferenceName()
    {
        return $this->referenceName;
    }

    /**
     * Set the value of referenceName
     */
    public function setReferenceName($referenceName)
    {
        $this->referenceName = $referenceName;
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
     * Get the value of columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the value of columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * Get the value of isArchived
     */
    public function getIsArchived()
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
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType($type)
    {
        $this->type = $type;
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

    /**
     * Get the value of rowLimit
     */
    public function getRowLimit()
    {
        return $this->rowLimit;
    }

    /**
     * Set the value of rowLimit
     */
    public function setRowLimit($rowLimit)
    {
        $this->rowLimit = $rowLimit;
    }

    /**
     * Get the value of columnLimit
     */
    public function getColumnLimit()
    {
        return $this->columnLimit;
    }

    /**
     * Set the value of columnLimit
     */
    public function setColumnLimit($columnLimit)
    {
        $this->columnLimit = $columnLimit;
    }

    /**
     * Get the value of cellLimit
     */
    public function getCellLimit()
    {
        return $this->cellLimit;
    }

    /**
     * Set the value of cellLimit
     */
    public function setCellLimit($cellLimit)
    {
        $this->cellLimit = $cellLimit;
    }
}