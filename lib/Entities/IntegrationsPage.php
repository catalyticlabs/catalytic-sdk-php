<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of Integrations
 */
class IntegrationsPage
{
    private $integrations;
    private $nextPageToken;
    private $count;

    public function __construct($integrations, $count, $nextPageToken = null)
    {
        $this->integrations = $integrations;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of integrations
     */
    public function getIntegrations()
    {
        return $this->integrations;
    }

    /**
     * Set the value of integrations
     */
    public function setIntegrations($integrations)
    {
        $this->integrations = $integrations;
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
