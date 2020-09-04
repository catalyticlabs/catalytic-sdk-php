<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ApiException;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\IntegrationsApi;
use Catalytic\SDK\Clients\ClientHelpers;
use Catalytic\SDK\Entities\{
    Integration,
    IntegrationConnection,
    IntegrationsPage
};
use Catalytic\SDK\Exceptions\{
    AccessTokenNotFoundException,
    IntegrationNotFoundException,
    IntegrationConnectionNotFoundException,
    InternalErrorException,
    UnauthorizedException
};
use Catalytic\SDK\Model\{
    IntegrationCreationRequest,
    Integration as InternalIntegration,
    IntegrationConnection as InternalIntegrationConnection,
    IntegrationConnectionCreationRequest,
    IntegrationType,
    IntegrationUpdateRequest
};
use Catalytic\SDK\Search\{Filter, SearchUtils};

/**
 * Integrations client
 */
class Integrations
{
    private $token;
    private $integrationsApi;

    /**
     * Constructor for Integrations client
     *
     * @param string            $token                      The token used to make the underlying api calls
     * @param IntegrationsApi   $integrationsApi (Optional) The injected IntegrationsApi. Used for unit testing
     */
    public function __construct(?string $token, $integrationsApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(Integrations::class);
        $this->token = ClientHelpers::trimIfString($token);

        if ($token) {
            $config = ConfigurationUtils::getConfiguration($this->token);
        }

        if ($integrationsApi) {
            $this->integrationsApi = $integrationsApi;
        } else {
            $this->integrationsApi = new IntegrationsApi(null, $config);
        }
    }

    /**
     * Get an Integration by id
     *
     * @param string $id                    The id of the Integration to get
     * @return Integration                  The Integration object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws IntegrationNotFoundException If Integratio nnot found
     * @throws InternalErrorException       If any errors fetching the Integration
     * @throws UnauthorizedException        If unauthorized
     */
    public function get(string $id): Integration
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting Integration with id $id");
            $internalIntegration = $this->integrationsApi->getIntegration($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new IntegrationNotFoundException("Integration with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get Integration", $e);
        }
        $integration = $this->createIntegration($internalIntegration);
        return $integration;
    }

    /**
     * Find Integrations by a variety of filters
     *
     * @param Filter $filter (Optional)     The filter criteria to search Integrations by
     * @param string $pageToken (Optional)  The token of the page to fetch
     * @param int    $pageSize (Optional)   The number of Integrations per page to fetch
     * @return IntegrationsPage             An IntegrationsPage which contains the results
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors finding Integrations
     * @throws UnauthorizedException        If unauthorized
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null): IntegrationsPage
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $text = null;
        $integrations = [];

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
        }

        try {
            $this->logger->debug("Finding Integrations with text $text");
            $internalIntegrations = $this->integrationsApi->findIntegrations($text, null, null, null, null, null, null, $pageToken, $pageSize);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to find Integrations", $e);
        }

        foreach ($internalIntegrations->getIntegrations() as $internalIntegration) {
            $integration = $this->createIntegration($internalIntegration);
            array_push($integrations, $integration);
        }

        $integrationsPage = new IntegrationsPage($integrations, $internalIntegrations->getCount(), $internalIntegrations->getNextPageToken());
        return $integrationsPage;
    }

    /**
     * Create a custom Integration with which Connections can be created
     *
     * @param string $name                  The name of the Integration
     * @param array  $oauthConfig           The oauth2 configuration settings for the Integration
     * @return Integration                  The newly created Integration
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors starting Instance
     * @throws UnauthorizedException        If unauthorized
     */
    public function create(string $name, array $oauthConfig): Integration
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $request = new IntegrationCreationRequest(array('name' => $name, 'type' => IntegrationType::O_AUTH2, 'config' => $oauthConfig));

        try {
            $this->logger->debug("Creating new Integration with name $name");
            $internalIntegration = $this->integrationsApi->createIntegration($request);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to create Integration", $e);
        }
        $integration = $this->createIntegration($internalIntegration);
        return $integration;
    }

    /**
     * Update an Integration by id
     *
     * @param string $id                    The id of the Integration to update
     * @param string $name                  The name of the Integration
     * @param array $oauthConfig            The oauth2 configuration settings for the Integration
     * @return Integration                  The updated Integration object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws IntegrationNotFoundException If Integration not found
     * @throws InternalErrorException       If any errors fetching the Integration
     * @throws UnauthorizedException        If unauthorized
     */
    public function update(string $id, string $name, array $oauthConfig): Integration
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $request = new IntegrationUpdateRequest(array('name' => $name, 'type' => IntegrationType::O_AUTH2, 'config' => $oauthConfig));

        try {
            $this->logger->debug("Updating Integration with id $id");
            $internalIntegration = $this->integrationsApi->updateIntegration($id, $request);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new IntegrationNotFoundException("Integration with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to update Integration", $e);
        }
        $integration = $this->createIntegration($internalIntegration);
        return $integration;
    }

    /**
     * Delete an Integration by id
     *
     * @param string $id                    The id of the integration to delete
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws IntegrationNotFoundException If Integratio nnot found
     * @throws InternalErrorException       If any errors fetching the Integration
     * @throws UnauthorizedException        If unauthorized
     */
    public function delete(string $id): void
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Deleting Integration with id $id");
            $this->integrationsApi->deleteIntegration($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new IntegrationNotFoundException("Integration with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to delete Integration", $e);
        }
    }

    /**
     * Get an Integration Connection by id
     *
     * @param string $id                                The id of the Integration Connection to get
     * @return Integration                              The Integration object
     * @throws AccessTokenNotFoundException             If the client was instantiated without an Access Token
     * @throws IntegrationConnectionNotFoundException   If Integration not found
     * @throws InternalErrorException                   If any errors fetching the Integration
     * @throws UnauthorizedException                    If unauthorized
     */
    public function getIntegrationConnection(string $id): IntegrationConnection
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting Integration Connection with id $id");
            $internalIntegrationConnection = $this->integrationsApi->getIntegrationConnection(ClientHelpers::WILDCARD_ID, $id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new IntegrationConnectionNotFoundException("Integration Connection with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get Integration Connection", $e);
        }
        $integrationConnection = $this->createIntegrationConnectionObject($internalIntegrationConnection);
        return $integrationConnection;
    }

    /**
     * Create a custom IntegrationConnection
     *
     * @param string $integrationId         The id of the Integration to create a connection for
     * @param string $name                  A name to give to the IntegrationConnection
     * @param array  $connectionParams      The parameters used to make a Connection to an Integration
     * @return Integration                  The newly created IntegrationConnection
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors creating an IntegrationConnection
     * @throws UnauthorizedException        If unauthorized
     */
    public function createIntegrationConnection(string $integrationId, string $name, array $connectionParams): IntegrationConnection
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        $formattedFields = ClientHelpers::formatFields($connectionParams);
        $request = new IntegrationConnectionCreationRequest(array('name' => $name, 'integrationId' => $integrationId, 'connectionParams' => $formattedFields));

        try {
            $this->logger->debug("Creating new Integration Connection for integrationId $integrationId with name $name");
            $internalIntegrationConnection = $this->integrationsApi->createIntegrationConnection($integrationId, $request);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to create Integration Connection", $e);
        }
        $integrationConnection = $this->createIntegrationConnectionObject($internalIntegrationConnection);
        return $integrationConnection;
    }

    /**
     * Delete an IntegrationConnection by id
     *
     * @param string $id                                The id of the IntegrationConnection to delete
     * @throws AccessTokenNotFoundException             If the client was instantiated without an Access Token
     * @throws IntegrationConnectionNotFoundException   If IntegrationConnection not found
     * @throws InternalErrorException                   If any errors deleting the IntegrationConnection
     * @throws UnauthorizedException                    If unauthorized
     */
    public function deleteIntegrationConnection(string $id): void
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Deleting IntegrationConnection with id $id");
            $this->integrationsApi->deleteIntegrationConnection(ClientHelpers::WILDCARD_ID, $id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new IntegrationConnectionNotFoundException("Integration Connection with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to delete Integration Connection", $e);
        }
    }

    /**
     * Create an Integration object from an internal Integration object
     *
     * @param InternalIntegration   $internalIntegration    The internal integration to create an Integration object from
     * @return Integration          $integration            The created Integration object
     */
    private function createIntegration(InternalIntegration $internalIntegration): Integration
    {
        $integration = new Integration(
            $internalIntegration->getId(),
            $internalIntegration->getName(),
            $internalIntegration->getIsCustomIntegration(),
            $internalIntegration->getConnections(),
            $internalIntegration->getConnectionParams()
        );
        return $integration;
    }

    /**
     * Create an IntegrationConnection object from an internal IntegrationConnection object
     *
     * @param InternalIntegrationConnection $internalIntegrationConnection  The internal IntegrationConnection to create an IntegrationConnection object from
     * @return IntegrationConnection        $integration                    The created IntegrationConnection object
     */
    private function createIntegrationConnectionObject(InternalIntegrationConnection $internalIntegrationConnection): IntegrationConnection
    {
        $integrationConnection = new IntegrationConnection(
            $internalIntegrationConnection->getId(),
            $internalIntegrationConnection->getName(),
            $internalIntegrationConnection->getReferenceName(),
            $internalIntegrationConnection->getIntegrationId()
        );
        return $integrationConnection;
    }
}