<?php

namespace Catalytic\SDK\Entities;

/**
 * A WorkflowExport object
 */
class WorkflowExport
{
    private string $id;
    private string $name;
    private string $fileId;
    private string $errorMessage;

    public function __construct(
        string $id = null,
        string $name = null,
        string $fileId = null,
        string $errorMessage = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->fileId = $fileId;
        $this->errorMessage = $errorMessage;
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
     * Get the value of fileId
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * Set the value of fileId
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * Get the value of errorMessage
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set the value of errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
}