<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of instance steps
 */
class InstanceStepsPage
{
    private $instanceSteps;
    private $nextPageToken;
    private $count;

    public function __construct($instanceSteps, $count, $nextPageToken = null)
    {
        $this->instanceSteps = $instanceSteps;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of instanceSteps
     */
    public function getInstanceSteps()
    {
        return $this->instanceSteps;
    }

    /**
     * Set the value of instanceSteps
     */
    public function setInstanceSteps($instanceSteps)
    {
        $this->instanceSteps = $instanceSteps;
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
