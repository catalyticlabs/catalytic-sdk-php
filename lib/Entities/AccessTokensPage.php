<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of AccessTokens
 */
class AccessTokensPage
{
    private array $accessTokens;
    private ?string $nextPageToken;
    private string $count;

    public function __construct($accessTokens, $count, $nextPageToken = null)
    {
        $this->accessTokens = $accessTokens;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of AccessTokens
     */
    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    /**
     * Set the value of AccessTokens
     */
    public function setAccessTokens($accessTokens)
    {
        $this->accessTokens = $accessTokens;
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
