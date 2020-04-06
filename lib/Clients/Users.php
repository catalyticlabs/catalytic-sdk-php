<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\UsersApi;
use Catalytic\SDK\Entities\{User, UsersPage};
use Catalytic\SDK\Model\User as InternalUser;
use Catalytic\SDK\Search\Filter;

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
     * @return User                 The User object
     */
    public function get(string $identifier) : User
    {
        $internalUser = $this->usersApi->getUser($identifier);
        $user = $this->createUser($internalUser);
        return $user;
    }

    /**
     * Find users by a variety of filters
     *
     * @param string $filter    The filter to search users by
     * @param UsersPage         A UsersPage which contains the results
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null) : UsersPage
    {
        $internalUsers = $this->usersApi->findUsers($filter, null, null, null, null, null, null, $pageToken, $pageSize);
        $users = [];
        foreach ($internalUsers->getUsers() as $internalUser) {
            $user = $this->createUser($internalUser);
            array_push($users, $user);
        }
        $usersPage = new UsersPage($users, $internalUsers->getCount(), $internalUsers->getNextPageToken());
        return $usersPage;
    }

    /**
     * Create a User object from an internal User object
     *
     * @param InternalUser  $internalUser   The internal user to create a User object from
     * @return User         $user           The created User object
     */
    private function createUser(InternalUser $internalUser) : User
    {
        $user = new User(
            $internalUser->getId(),
            $internalUser->getUsername(),
            $internalUser->getEmail(),
            $internalUser->getFullName()
        );
        return $user;
    }
}