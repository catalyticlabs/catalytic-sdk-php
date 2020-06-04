<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ApiException;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\UserCredentialsApi;
use Catalytic\SDK\Search\{Filter, SearchUtils};
use Catalytic\SDK\Exceptions\{CredentialsNotFoundException, UnauthorizedException, InternalErrorException};
use Catalytic\SDK\Model\Credentials as InternalCredentials;
use Catalytic\SDK\Entities\{Credentials as UserCredentials, CredentialsPage};

/**
 * Credentials client
 */
class Credentials
{
    private UserCredentialsApi $userCredentialsApi;

    /**
     * Constructor for UserCredentials
     *
     * @param string $secret                                    The token used to make the underlying api calls
     * @param UserCredentialsApi $userCredentialsApi (Optional) The injected UserCredentialsApi. Used for unit testing
     */
    public function __construct(?string $secret, UserCredentialsApi $userCredentialsApi = null)
    {
        if ($userCredentialsApi) {
            $this->userCredentialsApi = $userCredentialsApi;
        } else {
            $config = ConfigurationUtils::getConfiguration($secret);
            $this->userCredentialsApi = new UserCredentialsApi(null, $config);
        }
    }

    /**
     * Get Credentials by id
     *
     * @param string $id                    The id of the Credentials to get
     * @return UserCredentials              The Credentials object
     * @throws CredentialsNotFoundException If Credentials are not found
     * @throws InternalErrorException       If any errors fetching Credentials
     * @throws UnauthorizedException        If unauthorized
     */
    public function get(string $id): UserCredentials
    {
        try {
            $internalCredentials = $this->userCredentialsApi->getCredentials($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new CredentialsNotFoundException("Credentials with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get credentials", $e);
        }
        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Find credentials by a variety of filters
     *
     * @param Filter $filter            The filter criteria to search credentials by
     * @param string $pageToken         The token of the page to fetch
     * @param int    $pageSize          The number of credentials per page to fetch
     * @return CredentialsPage          A CredentialsPage which contains the reults
     * @throws InternalErrorException   If any errors finding Credentials
     * @throws UnauthorizedException    If unauthorized
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null): CredentialsPage
    {
        $text = null;
        $owner = null;
        $credentials = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
        }

        try {
            $internalCredentials = $this->userCredentialsApi->findCredentials($text, null, null, null, $owner, null, null, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find Credentials", $e);
        }
        foreach ($internalCredentials->getCredentials() as $internalCredential) {
            $credential = $this->createCredentials($internalCredential);
            array_push($credentials, $credential);
        }
        $credentialsPage = new CredentialsPage($credentials, $internalCredentials->getCount(), $internalCredentials->getNextPageToken());
        return $credentialsPage;
    }

    public function create(string $team, string $email, string $password)
    {
        throw new Exception('Not yet implemented');
    }

    /**
     * Revoke credentials for a specific id
     *
     * @param string $id                The id of the credentials to revoke
     * @return UserCredentials          The credentals that have been revoked
     * @throws InternalErrorException   If any errors revoking credentials
     * @throws UnauthorizedException    If unauthorized
     */
    public function revoke(string $id): UserCredentials
    {
        try {
            $internalCredentials = $this->userCredentialsApi->revokeCredentials($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new CredentialsNotFoundException("Credentials with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to revoke Credentials", $e);
        }
        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Create a Credentials object from an internal File object
     *
     * @param InternalCredentials  $internalCredentials   The internal credentials to create a Credentials object from
     * @return UserCredentials     $credentials           The created Credentials object
     */
    private function createCredentials(InternalCredentials $internalCredentials): UserCredentials
    {
        $credentials = new UserCredentials(
            $internalCredentials->getId(),
            $internalCredentials->getDomain(),
            $internalCredentials->getName(),
            $internalCredentials->getType(),
            $internalCredentials->getToken(),
            $internalCredentials->getSecret(),
            $internalCredentials->getEnvironment(),
            $internalCredentials->getOwner()
        );
        return $credentials;
    }
}