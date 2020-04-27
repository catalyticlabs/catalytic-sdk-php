<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\UserCredentialsApi;
use Catalytic\SDK\Search\{Filter, SearchUtils};
use Catalytic\SDK\Entities\{Credentials as UserCredentials, CredentialsPage};
use Catalytic\SDK\Model\Credentials as InternalCredentials;

/**
 * Credentials client
 */
class Credentials
{
    private UserCredentialsApi $userCredentialsApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->userCredentialsApi = new UserCredentialsApi(null, $config);
    }

    /**
     * Get credentials by id
     *
     * @param string $id        The id of the credentials to get
     * @return UserCredentials  The Credentials object
     */
    public function get(string $id) : UserCredentials
    {
        $internalCredentials = $this->userCredentialsApi->getCredentials($id);
        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Find credentials by a variety of filters
     *
     * @param Filter $filter    The filter criteria to search credentials by
     * @param string $pageToken The token of the page to fetch
     * @param int    $pageSize  The number of credentials per page to fetch
     * @return CredentialsPage  A CredentialsPage which contains the reults
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null) : CredentialsPage
    {
        $text = null;
        $owner = null;

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
        }

        $internalCredentials = $this->userCredentialsApi->findCredentials($text, null, null, null, $owner, null, null, $pageToken, $pageSize);
        $credentials = [];
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
     * @param string $id        The id of the credentials to revoke
     * @return UserCredentials  The credentals that have been revoked
     */
    public function revoke(string $id) : UserCredentials
    {
        $internalCredentials = $this->userCredentialsApi->revokeCredentials($id);
        print_r($internalCredentials);
        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Create a Credentials object from an internal File object
     *
     * @param InternalCredentials  $internalCredentials   The internal credentials to create a Credentials object from
     * @return UserCredentials     $credentials           The created Credentials object
     */
    private function createCredentials(InternalCredentials $internalCredentials) : UserCredentials
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