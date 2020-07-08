<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\Api\UsersApi;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Clients\ClientHelpers;
use Catalytic\SDK\Entities\{User, UsersPage};
use Catalytic\SDK\Exceptions\{UserNotFoundException, InternalErrorException, UnauthorizedException};
use Catalytic\SDK\Model\User as InternalUser;
use Catalytic\SDK\Search\{SearchUtils};

/**
 * User client to be exposed to consumers
 */
class Users
{
    private $token;
    private $logger;
    private $usersApi;

    /**
     * Constructor for Users client
     *
     * @param string $token                 The token used to make the underlying api calls
     * @param UsersApi $usersApi (Optional) The injected UsersApi. Used for unit testing
     */
    public function __construct($token, $usersApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(Users::class);
        $this->token = ClientHelpers::trimIfString($token);

        if ($usersApi) {
            $this->usersApi = $usersApi;
        } else {
            $config = ConfigurationUtils::getConfiguration($this->token);
            $this->usersApi = new UsersApi(null, $config);
        }
    }

    /**
     * Get a User by either id, email, or username
     *
     * @param string $identifier            The id, email, or username of the User to get
     * @return User                         The User object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws UserNotFoundException        If User is not found
     * @throws InternalErrorException       If any errors fetching User
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($identifier)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting user with identifier $identifier");
            $internalUser = $this->usersApi->getUser($identifier);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new UserNotFoundException("User with id, email, or username $identifier not found", $e);
            }
            throw new InternalErrorException("Unable to get user", $e);
        }

        $user = $this->createUser($internalUser);
        return $user;
    }

    /**
     * Find Users by a variety of filters
     *
     * @param string $filter                The filter to search users by
     * @param string $pageToken             The token of the page to fetch
     * @param int    $pageSize              The number of users per page to fetch
     * @param UsersPage                     A UsersPage which contains the results
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors finding Users
     * @throws UnauthorizedException        If unauthorized
     */
    public function find($filter = null, $pageToken = null, $pageSize = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $text = null;
        $users = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
        }

        try {
            $this->logger->debug("Finding users with text $text");
            $internalUsers = $this->usersApi->findUsers($text, null, null, null, null, null, null, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find Users", $e);
        }

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
    private function createUser($internalUser)
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