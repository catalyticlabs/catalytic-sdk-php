<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Api\AuthenticationApi;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\UserCredentialsApi;
use Catalytic\SDK\Search\{Filter, SearchUtils};
use Catalytic\SDK\Exceptions\{CredentialsNotFoundException, UnauthorizedException, InternalErrorException};
use Catalytic\SDK\Model\Credentials as InternalCredentials;
use Catalytic\SDK\Entities\{Credentials as UserCredentials, CredentialsPage};
use Catalytic\SDK\Model\{
    CredentialsCreationRequest,
    CredentialsCreationWithEmailAndPasswordRequest,
    WaitForCredentialsApprovalRequest,
};
use Monolog\Logger;

/**
 * Credentials client
 */
class Credentials
{
    private Logger $logger;
    private UserCredentialsApi $userCredentialsApi;
    private AuthenticationApi $authenticationApi;

    /**
     * Constructor for UserCredentials
     *
     * @param string $secret                                    The token used to make the underlying api calls
     * @param UserCredentialsApi $userCredentialsApi (Optional) The injected UserCredentialsApi. Used for unit testing
     * @param AuthenticationApi  $authenticationApi (Optional)  The injected AuthenticationApi. Used for unit testing
     */
    public function __construct(?string $secret, UserCredentialsApi $userCredentialsApi = null, AuthenticationApi $authenticationApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(Credentials::class);
        if ($secret) {
            $config = ConfigurationUtils::getConfiguration($secret);
        }

        if ($userCredentialsApi) {
            $this->userCredentialsApi = $userCredentialsApi;
        } else {
            $this->userCredentialsApi = new UserCredentialsApi(null, $config);
        }

        if ($authenticationApi) {
            $this->authenticationApi = $authenticationApi;
        } else {
            $this->authenticationApi = new AuthenticationApi(null, $config);
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
            $this->logger->debug("Getting Credentials with id $id");
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
     * @param Filter $filter (Optional)     The filter criteria to search credentials by
     * @param string $pageToken (Optional)  The token of the page to fetch
     * @param int    $pageSize (Optional)   The number of credentials per page to fetch
     * @return CredentialsPage (Optional)   A CredentialsPage which contains the reults
     * @throws InternalErrorException       If any errors finding Credentials
     * @throws UnauthorizedException        If unauthorized
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
            $this->logger->debug("Finding Credentials with text $text and owner $owner");
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

    /**
     * Create Credentials
     *
     * @param string $domain            The domain to create the Credentials for
     * @param string $email             The email to create the Credentials for
     * @param string $password          The password used to create the Credentials
     * @param string $name (Optional)   A name to identify the Credentials
     * @return UserCredentials          The newly created Credentials
     * @throws InternalErrorException   If any errors creating Credentials
     * @throws UnauthorizedException    If unauthorized
     */
    public function create(string $domain, string $email, string $password, string $name = null): UserCredentials
    {
        $credentialsRequest = new CredentialsCreationWithEmailAndPasswordRequest(
            array(
                'email' => $email,
                'password' => $password,
                'domain' => $domain,
                'name' => $name
            )
        );

        try {
            $this->logger->debug("Creating Credentials with email $email, domain $domain, name $name");
            $internalCredentials = $this->authenticationApi->createAndApproveCredentials($credentialsRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException('Unable to create Credentials', $e);
        }

        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Create Credentials
     *
     * @param string $domain            The domain to create the Credentials for
     * @param string $name (Optional)   A name to identify the Credentials
     * @return UserCredentials          The newly created Credentials
     * @throws InternalErrorException   If any errors creating Credentials
     * @throws UnauthorizedException    If unauthorized
     */
    public function createWithWebApprovalFlow(string $domain, string $name = null): UserCredentials
    {
        $credentialsRequest = new CredentialsCreationRequest(array('domain' => $domain,'name' => $name));

        try {
            $this->logger->debug("Creating Credentials with domain $domain, name $name");
            $internalCredentials = $this->authenticationApi->createCredentials($credentialsRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException('Unable to create Credentials', $e);
        }

        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Gets the url that the user must visit to approve Credentials created with the createWithWebApprovalFlow
     *
     * @param UserCredentials $credentials          The Credentials to get the approval url from
     * @param string $applicationName (Optional)    The name of the application to label the token with
     * @return string                               The url a user must visit to approval the Credentials created
     */
    public function getApprovalUrl(UserCredentials $credentials, string $applicationName = 'Catalytic SDK'): string
    {
        return "https://" . $credentials->getDomain() . "/access-tokens/approve?userTokenID=" . $credentials->getId() . "&application=" . urlencode($applicationName);
    }

    /**
     * Waits for Credentials to be approved
     *
     * @param UserCredentials   $credentials    The Credentials to wait for approval of
     * @param int               $waitTimeMillis The amount of time to wait in milliseconds before timing out
     * @return UserCredentials                  The Credentials
     */
    public function waitForApproval(UserCredentials $credentials, int $waitTimeMillis = null): UserCredentials
    {
        $credentialsApproval = new WaitForCredentialsApprovalRequest(
            array('token' => $credentials->getToken(), 'waitTimeMillis' => $waitTimeMillis)
        );
        try {
            $this->logger->debug("Waiting for approval of Credentials");
            $internalCredentials = $this->authenticationApi->waitForCredentialsApproval($credentialsApproval);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to wait for Credentials approval", $e);
        }
        $credentials = $this->createCredentials($internalCredentials);
        return $credentials;
    }

    /**
     * Revoke Credentials for a specific id
     *
     * @param string $id                The id of the Credentials to revoke
     * @return UserCredentials          The Credentals that have been revoked
     * @throws InternalErrorException   If any errors revoking Credentials
     * @throws UnauthorizedException    If unauthorized
     */
    public function revoke(string $id): UserCredentials
    {
        try {
            $this->logger->debug("Revoking Credentials with id $id");
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