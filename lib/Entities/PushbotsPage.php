<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of users
 */
class PushbotsPage
{
    private array $pushbots;
    private ?string $nextPageToken;
    private string $count;

    public function __construct($pushbots, $count, $nextPageToken = null)
    {
        $this->pushbots = $pushbots;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of pushbots
     */
    public function getPushbots()
    {
        return $this->pushbots;
    }

    /**
     * Set the value of pushbots
     */
    public function setPushbots($pushbots)
    {
        $this->pushbots = $pushbots;
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
