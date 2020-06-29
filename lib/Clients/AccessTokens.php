<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Api\AuthenticationApi;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\AccessTokensApi;
use Catalytic\SDK\Search\{Filter, SearchUtils};
use Catalytic\SDK\Exceptions\{AccessTokenNotFoundException, UnauthorizedException, InternalErrorException};
use Catalytic\SDK\Model\AccessToken as InternalAccessToken;
use Catalytic\SDK\Entities\{AccessToken, AccessTokensPage};
use Catalytic\SDK\Model\{
    AccessTokenCreationRequest,
    AccessTokenCreationWithEmailAndPasswordRequest,
    WaitForAccessTokenApprovalRequest
};
use InvalidArgumentException;
use Monolog\Logger;

/**
 * AccessTokens client
 */
class AccessTokens
{
    private $logger;
    private $accessTokensApi;
    private $authenticationApi;

    /**
     * Constructor for AccessTokens
     *
     * @param string $secret                                    The token used to make the underlying api calls
     * @param AccessTokensApi $accessTokensApi (Optional) The injected AccessTokensApi. Used for unit testing
     * @param AuthenticationApi  $authenticationApi (Optional)  The injected AuthenticationApi. Used for unit testing
     */
    public function __construct($secret, $accessTokensApi = null, $authenticationApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(AccessTokens::class);
        if ($secret) {
            $config = ConfigurationUtils::getConfiguration($secret);
        }

        if ($accessTokensApi) {
            $this->accessTokensApi = $accessTokensApi;
        } else {
            $this->accessTokensApi = new AccessTokensApi(null, $config);
        }

        if ($authenticationApi) {
            $this->authenticationApi = $authenticationApi;
        } else {
            $this->authenticationApi = new AuthenticationApi(null, $config);
        }
    }

    /**
     * Get AccessToken by id
     *
     * @param string $id                    The id of the AccessToken to get
     * @return AccessTokens              The AccessToken object
     * @throws AccessTokenNotFoundException If AccessToken are not found
     * @throws InternalErrorException       If any errors fetching AccessToken
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($id)
    {
        try {
            $this->logger->debug("Getting AccessToken with id $id");
            $internalAccessToken = $this->accessTokensApi->getAccessToken($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new AccessTokenNotFoundException("AccessToken with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get Access Token", $e);
        }
        $accessToken = $this->createAccessToken($internalAccessToken);
        return $accessToken;
    }

    /**
     * Find AccessTokens by a variety of filters
     *
     * @param Filter $filter (Optional)     The filter criteria to search AccessTokens by
     * @param string $pageToken (Optional)  The token of the page to fetch
     * @param int    $pageSize (Optional)   The number of AccessTokens per page to fetch
     * @return AccessTokensPage (Optional)  An AccessTokensPage which contains the results
     * @throws InternalErrorException       If any errors finding AccessTokens
     * @throws UnauthorizedException        If unauthorized
     */
    public function find($filter = null, $pageToken = null, $pageSize = null)
    {
        $text = null;
        $owner = null;
        $accessTokens = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
        }

        try {
            $this->logger->debug("Finding AccessTokens with text $text and owner $owner");
            $internalAccessTokens = $this->accessTokensApi->findAccessTokens($text, null, null, null, $owner, null, null, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find AccessTokens", $e);
        }
        foreach ($internalAccessTokens->getAccessTokens() as $internalAccessToken) {
            $accessToken = $this->createAccessToken($internalAccessToken);
            array_push($accessTokens, $accessToken);
        }
        $accessTokensPage = new AccessTokensPage($accessTokens, $internalAccessTokens->getCount(), $internalAccessTokens->getNextPageToken());
        return $accessTokensPage;
    }

    /**
     * Create AccessToken
     *
     * @param string $teamName          The team name or hostname of your Catalytic team
     * @param string $email             The email you use to login to Catalytic
     * @param string $password          The password you use to login to Catalytic
     * @param string $name (Optional)   A name to identify the AccessToken
     * @return AccessToken              The newly created AccessToken
     * @throws InternalErrorException   If any errors creating AccessToken
     * @throws UnauthorizedException    If unauthorized
     */
    public function create($teamName, $email, $password, $name = null)
    {
        $domain = $this->getDomainFromTeamName($teamName);
        $accessTokensRequest = new AccessTokenCreationWithEmailAndPasswordRequest(
            array(
                'email' => $email,
                'password' => $password,
                'domain' => $domain,
                'name' => $name
            )
        );

        try {
            $this->logger->debug("Creating AccessToken with email $email, teamName $teamName, name $name");
            $internalAccessToken = $this->authenticationApi->createAndApproveAccessToken($accessTokensRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException('Unable to create AccessToken', $e);
        }

        $accessTokens = $this->createAccessToken($internalAccessToken);
        return $accessTokens;
    }

    /**
     * Create AccessToken
     *
     * The AccessToken will need to be approved before it can be used
     *
     * @param string $teamname          The name or hostname of your Catalytic team
     * @param string $name (Optional)   A name to identify the AccessToken
     * @return AccessToken               The newly created AccessToken
     * @throws InternalErrorException   If any errors creating AccessToken
     * @throws UnauthorizedException    If unauthorized
     */
    public function createWithWebApprovalFlow($teamName, $name = null)
    {
        $domain = $this->getDomainFromTeamName($teamName);
        $accessTokenRequest = new AccessTokenCreationRequest(array('domain' => $domain,'name' => $name));

        try {
            $this->logger->debug("Creating AccessToken with domain $teamName, name $name");
            $internalAccessToken = $this->authenticationApi->createAccessToken($accessTokenRequest);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException('Unable to create AccessToken', $e);
        }

        $accessToken = $this->createAccessToken($internalAccessToken);
        return $accessToken;
    }

    /**
     * Gets the url that the user must visit to approve AccessToken created with the createWithWebApprovalFlow
     *
     * @param AccessToken $accessToken              The AccessToken to get the approval url from
     * @param string $applicationName (Optional)    The name of the application to label the token with
     * @return string                               The url a user must visit to approve the AccessToken created
     */
    public function getApprovalUrl($accessToken, $applicationName = 'Catalytic SDK')
    {
        return "https://" . $accessToken->getDomain() . "/access-tokens/approve?userTokenID=" . $accessToken->getId() . "&application=" . urlencode($applicationName);
    }

    /**
     * Waits for AccessToken to be approved
     *
     * @param AccessTokens   $accessToken    The AccessToken to wait for approval of
     * @param int            $waitTimeMillis The amount of time to wait in milliseconds before timing out
     * @return AccessTokens                  The AccessToken
     */
    public function waitForApproval($accessToken, $waitTimeMillis = null)
    {
        $accessTokenApproval = new WaitForAccessTokenApprovalRequest(
            array('token' => $accessToken->getToken(), 'waitTimeMillis' => $waitTimeMillis)
        );
        try {
            $this->logger->debug("Waiting for approval of AccessToken");
            $internalAccessToken = $this->authenticationApi->waitForAccessTokenApproval($accessTokenApproval);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to wait for AccessToken approval", $e);
        }
        $accessToken = $this->createAccessToken($internalAccessToken);
        return $accessToken;
    }

    /**
     * Revoke AccessToken for a specific id
     *
     * @param string $id                The id of the AccessToken to revoke
     * @return AccessTokens          The Credentals that have been revoked
     * @throws InternalErrorException   If any errors revoking AccessToken
     * @throws UnauthorizedException    If unauthorized
     */
    public function revoke($id)
    {
        try {
            $this->logger->debug("Revoking AccessToken with id $id");
            $internalAccessToken = $this->accessTokensApi->revokeAccessToken($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new AccessTokenNotFoundException("AccessToken with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to revoke AccessToken", $e);
        }
        $accessToken = $this->createAccessToken($internalAccessToken);
        return $accessToken;
    }

    /**
     * Create a AccessToken object from an internal File object
     *
     * @param InternalAccessToken   $internalAccessToken   The internal accessToken to create a AccessToken object from
     * @return AccessToken          $accessToken           The created AccessToken object
     */
    private function createAccessToken($internalAccessToken)
    {
        $accessToken = new AccessToken(
            $internalAccessToken->getId(),
            $internalAccessToken->getDomain(),
            $internalAccessToken->getName(),
            $internalAccessToken->getType(),
            $internalAccessToken->getToken(),
            $internalAccessToken->getSecret(),
            $internalAccessToken->getEnvironment(),
            $internalAccessToken->getOwner()
        );
        return $accessToken;
    }

    /**
     * Gets the domain from the passed in teamName
     *
     * @param string $teamNameOrDomain  The teamName to get the domain from
     * @return string                   The domain
     */
    private function getDomainFromTeamName($teamNameOrDomain)
    {
        // If the domain was passed in, validate the teamName and return the domain
        if (strpos($teamNameOrDomain, '.') !== false) {
            $pieces = explode('.', $teamNameOrDomain);
            $teamName = $pieces[0];
            $this->validateTeamName($teamName);
            return $teamNameOrDomain;
        }

        // Otherwise teamName was passed in so validate it, build the domain, and return it
        $this->validateTeamName($teamNameOrDomain);
        return "$teamNameOrDomain.pushbot.com";
    }

    /**
     * Validates the passed in team name
     *
     * @param string $teamName          The team name to validate
     * @throws InvalidArgumentException If the passed in team name is not valid
     */
    private function validateTeamName($teamName)
    {
        $validTeamNameRegex = '/^[a-z0-9][a-z0-9-_]+$/';
        if (!preg_match($validTeamNameRegex, $teamName)) {
            throw new InvalidArgumentException('Invalid teamName');
        }
    }
}