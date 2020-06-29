<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of users
 */
class UsersPage
{
    private $users;
    private $nextPageToken;
    private $count;

    public function __construct($users, $count, $nextPageToken = null)
    {
        $this->users = $users;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set the value of users
     */
    public function setUsers($users)
    {
        $this->users = $users;
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