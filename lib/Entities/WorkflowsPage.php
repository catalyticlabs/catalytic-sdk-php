<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of workflows
 */
class WorkflowsPage
{
    private array $workflows;
    private ?string $nextPageToken;
    private string $count;

    public function __construct($workflows, $count, $nextPageToken = null)
    {
        $this->workflows = $workflows;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of workflows
     */
    public function getWorkflows()
    {
        return $this->workflows;
    }

    /**
     * Set the value of workflows
     */
    public function setWorkflows($workflows)
    {
        $this->workflows = $workflows;
    }

    /**
     * Get the value of nextPageToken
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * Set the value of nextPageToken
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
    }

    /**
     * Get the value of count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set the value of count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }
}
