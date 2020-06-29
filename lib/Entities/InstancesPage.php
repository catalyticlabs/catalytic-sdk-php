<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of Instances
 */
class InstancesPage
{
    private $instances;
    private $nextPageToken;
    private $count;

    public function __construct($instances, $count, $nextPageToken = null)
    {
        $this->instances = $instances;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of instances
     */
    public function getInstances()
    {
        return $this->instances;
    }

    /**
     * Set the value of instances
     */
    public function setInstances($instances)
    {
        $this->instances = $instances;
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
