<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of credentials
 */
class CredentialsPage
{
    private array $credentials;
    private ?string $nextPageToken;
    private string $count;

    public function __construct($credentials, $count, $nextPageToken = null)
    {
        $this->credentials = $credentials;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set the value of credentials
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
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
