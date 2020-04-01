<?php

namespace Catalytic\SDK\Clients;

use \Catalytic\SDK\ConfigurationUtils;
use \Catalytic\SDK\Api\UsersApi;
use \Catalytic\SDK\Entities\{User, UsersPage};
use \Catalytic\SDK\Search\Filter;

/**
 * User client to be exposed to consumers
 */
class Users
{
    private UsersApi $usersApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->usersApi = new UsersApi(null, $config);
    }

    /**
     * Get a user by either id, email, or username
     *
     * @param string $identifier    The id, email, or username of the user to get
     */
    public function get(string $identifier)
    {
        $internalUser = $this->usersApi->getUser($identifier);
        $user = new User(
            $internalUser->getId(),
            $internalUser->getUsername(),
            $internalUser->getEmail(),
            $internalUser->getFullName()
        );
        return $user;
    }

    /**
     * Find users by a variety of filters
     *
     * @param string $filter    The filter to search users by
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null)
    {
        $internalUsers = $this->usersApi->findUsers($filter, null, null, null, null, null, null, $pageToken, $pageSize);
        $users = [];
        foreach ($internalUsers->getUsers() as $internalUser) {
            $user = new User(
                $internalUser->getId(),
                $internalUser->getUsername(),
                $internalUser->getEmail(),
                $internalUser->getFullName()
            );
            array_push($users, $user);
        }
        $usersPage = new UsersPage($users, $internalUsers->getCount(), $internalUsers->getNextPageToken());
        return $usersPage;
    }
}