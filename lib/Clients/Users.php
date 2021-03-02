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
use Catalytic\SDK\Model\UserSearchClause as InternalUserSearchClause;
use Catalytic\SDK\Search\{SearchUtils, UserSearchClause};

/**
 * User client
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
     * Get a User by either id or email
     *
     * @param string $identifier            The id or email of the User to get
     * @return User                         The User object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws UserNotFoundException        If User is not found
     * @throws InternalErrorException       If any errors fetching User
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($identifier): User
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting user with identifier $identifier");
            $internalUser = $this->usersApi->getUser($identifier);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new UserNotFoundException("User with id or email $identifier not found", $e);
            }
            throw new InternalErrorException("Unable to get user", $e);
        }

        $user = $this->createUser($internalUser);
        return $user;
    }

    /**
     * Get all Users
     *
     * @return UsersPage                    A UsersPage which contains the results
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors finding Users
     * @throws UnauthorizedException        If unauthorized
     */
    public function list(): UsersPage
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        // Get the first page of Users
        $usersPage = $this->search();
        $results = $usersPage;

        // Loop through the rest of the pages and add the User's to results
        while($usersPage->getNextPageToken() !== '') {
            $usersPage = $this->search(null, $usersPage->getNextPageToken());
            $results->addUsers($usersPage->getUsers(), $usersPage->getNextPageToken());
        }

        return $results;
    }

    /**
     * Search Users by a variety of filters
     *
     * @param UserSearchClause $userSearchClause    The search criteria to search users by
     * @param string $pageToken                     The token of the page to fetch
     * @param int    $pageSize                      The number of users per page to fetch
     * @param UsersPage                             A UsersPage which contains the results
     * @throws AccessTokenNotFoundException         If the client was instantiated without an Access Token
     * @throws InternalErrorException               If any errors finding Users
     * @throws UnauthorizedException                If unauthorized
     */
    public function search(UserSearchClause $userSearchClause = null, string $pageToken = null, int $pageSize = null): UsersPage
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $users = [];

        if ($userSearchClause === null) {
            $userSearchClause = new UserSearchClause();
        }

        $internalId = ClientHelpers::createInternalGuidSearchExpression($userSearchClause->getId());
        $internalEmail = ClientHelpers::createInternalStringSearchExpression($userSearchClause->getEmail());
        $internalFullName = ClientHelpers::createInternalStringSearchExpression($userSearchClause->getFullName());
        $internalIsTeamAdmin = ClientHelpers::createInternalBooleanSearchExpression($userSearchClause->getIsTeamAdmin());
        $internalIsDeactivated = ClientHelpers::createInternalBooleanSearchExpression($userSearchClause->getIsDeactivated());
        $internalIsLockedOut = ClientHelpers::createInternalBooleanSearchExpression($userSearchClause->getIsLockedOut());
        $internalCreatedDate = ClientHelpers::createInternalDateTimeSearchExpression($userSearchClause->getCreatedDate());
        $internalAnd = $this->createInternalUserSearchClause($userSearchClause->getAnd());
        $internalOr = $this->createInternalUserSearchClause($userSearchClause->getOr());

        $internalUserSearchClause = new InternalUserSearchClause();
        $internalUserSearchClause->setId($internalId);
        $internalUserSearchClause->setEmail($internalEmail);
        $internalUserSearchClause->setFullName($internalFullName);
        $internalUserSearchClause->setIsTeamAdmin($internalIsTeamAdmin);
        $internalUserSearchClause->setIsDeactivated($internalIsDeactivated);
        $internalUserSearchClause->setIsLockedOut($internalIsLockedOut);
        $internalUserSearchClause->setCreatedDate($internalCreatedDate);
        $internalUserSearchClause->setAnd($internalAnd);
        $internalUserSearchClause->setOr($internalOr);

        try {
            $this->logger->debug("Searching Users with $internalUserSearchClause");
            $internalUsers = $this->usersApi->searchUsers($pageToken, $pageSize, $internalUserSearchClause);
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
     * @param InternalUser  $internalUser   The internal User to create a User object from
     * @return User         $user           The created User object
     */
    private function createUser($internalUser): User
    {
        $user = new User(
            $internalUser->getId(),
            $internalUser->getTeamName(),
            $internalUser->getEmail(),
            $internalUser->getFullName(),
            $internalUser->getIsTeamAdmin(),
            $internalUser->getIsDeactivated(),
            $internalUser->getIsLockedOut(),
            $internalUser->getCreatedDate()
        );
        return $user;
    }

    /**
     * Create an internal UserSearchClause from an external UserSearchClause
     *
     * @param UserSearchClause $userSearchClause    The external UserSearchClause to create an internal one from
     * @return array                                An internal UserSearchClause
     */
    private function createInternalUserSearchClause($userSearchClause): ?array
    {
        $internalUserSearchClauses = null;

        if ($userSearchClause !== null) {
            $internalUserSearchClauses = array();

            foreach($userSearchClause as $searchClause) {
                $internalId = ClientHelpers::createInternalGuidSearchExpression($searchClause->getId());
                $internalEmail = ClientHelpers::createInternalStringSearchExpression($searchClause->getEmail());
                $internalFullName = ClientHelpers::createInternalStringSearchExpression($searchClause->getFullName());
                $internalIsTeamAdmin = ClientHelpers::createInternalBooleanSearchExpression($searchClause->getIsTeamAdmin());
                $internalIsDeactivated = ClientHelpers::createInternalBooleanSearchExpression($searchClause->getIsDeactivated());
                $internalIsLockedOut = ClientHelpers::createInternalBooleanSearchExpression($searchClause->getIsLockedOut());
                $internalCreatedDate = ClientHelpers::createInternalDateTimeSearchExpression($searchClause->getCreatedDate());
                $internalAnd = $this->createInternalUserSearchClause($searchClause->getAnd());
                $internalOr = $this->createInternalUserSearchClause($searchClause->getOr());

                $internalUserSearchClause = new InternalUserSearchClause(
                    array(
                        'id' => $internalId,
                        'email' => $internalEmail,
                        'fullName' => $internalFullName,
                        'isTeamAdmin' => $internalIsTeamAdmin,
                        'isDeactivated' => $internalIsDeactivated,
                        'isLockedOut' => $internalIsLockedOut,
                        'createdDate' => $internalCreatedDate,
                        'and' => $internalAnd,
                        'or' => $internalOr
                    )
                );
                array_push($internalUserSearchClauses, $internalUserSearchClause);
            }
        }

        return $internalUserSearchClauses;
    }
}