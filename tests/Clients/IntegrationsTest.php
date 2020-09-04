<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Integrations;
use Catalytic\SDK\Search\Where;
use Catalytic\SDK\Entities\{
    Integration,
    IntegrationConnection
};
use Catalytic\SDK\Exceptions\{
    AccessTokenNotFoundException,
    IntegrationConnectionNotFoundException,
    IntegrationNotFoundException,
    InternalErrorException,
    UnauthorizedException
};
use Mockery\Adapter\Phpunit\MockeryTestCase;

class IntegrationsTest extends MockeryTestCase
{
    public function testGetIntegration_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->get('1234');
    }

    public function testGetIntegration_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegration')
            ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->get('1234');
    }

    public function testGetIntegration_ItShouldThrowIntegrationNotFoundExceptionIfIntegrationDoesNotExist()
    {
        $this->expectException(IntegrationNotFoundException::class);
        $this->expectExceptionMessage("Integration with id 1234 not found");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegration')
            ->andThrow(new ApiException(null, 404));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->get('1234');
    }

    public function testGetIntegration_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get Integration");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegration')
            ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->get('alice@catalytic.com');
    }

    public function testGetIntegration_ItShouldGetAnIntegration()
    {
        $integration = new \Catalytic\SDK\Model\Integration(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'isCustomIntegration' => false,
                'connections' => 'Something here',
                'connectionParams' => 'Some params'
            )
        );
        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegration')
            ->andReturn($integration);

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integration = $integrationsClient->get('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(Integration::class, $integration);
    }

    public function testFindIntegration_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->find();
    }

    public function testFindIntegrations_ItShouldThrowUnauthorizedExceptionIfNotAuthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('findIntegrations')
            ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->find();
    }

    public function testFindIntegrations_ItShouldThrowUInternalErrorExceptionIfAnErrorOccurs()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find Integrations");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('findIntegrations')
            ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->find();
    }

    public function testFindIntegrations_ItShouldFindAllIntegrations()
    {
        $integration = new \Catalytic\SDK\Model\Integration(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'isCustomIntegration' => false,
                'connections' => 'Something here',
                'connectionParams' => 'Some params'
            )
        );
        $integrationsPage = new \Catalytic\SDK\Model\IntegrationsPage(
            array(
                'integrations' => array($integration),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('findIntegrations')
            ->andReturn($integrationsPage);

        $integrationsClient = new Integrations('1234', $integrationsApi);

        $results = $integrationsClient->find();
        $integrations = $results->getIntegrations();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $integrationsClient()->find(null, $results->getNextPageToken());
            $integrations = array_merge($integrations, $results->getIntegrations());
        }

        $this->assertEquals(count($integrations), 1);
    }

    public function testFindIntegrations_ItShouldFindIntegrationsWithNameDropbox()
    {
        $integration = new \Catalytic\SDK\Model\Integration(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'isCustomIntegration' => false,
                'connections' => 'Something here',
                'connectionParams' => 'Some params'
            )
        );
        $integrationsPage = new \Catalytic\SDK\Model\IntegrationsPage(
            array(
                'integrations' => array($integration),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('findIntegrations')
            ->andReturn($integrationsPage);

        $integrationsClient = new Integrations('1234', $integrationsApi);

        $where = (new Where())->text()->matches('dropbox');
        $results = $integrationsClient->find($where);
        $integrations = $results->getIntegrations();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $integrationsClient()->find($where, $results->getNextPageToken());
            $integrations = array_merge($integrations, $results->getIntegrations());
        }

        $this->assertEquals(count($integrations), 1);
    }

    public function testCreateIntegration_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->create('foo', array());
    }

    public function testCreateIntegration_ItShouldThrowUnauthorizedExceptionIfNotAuthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('createIntegration')
        ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->create('foo', array());
    }

    public function testCreateIntegration_ItShouldThrowUInternalErrorExceptionIfAnErrorOccurs()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to create Integration");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('createIntegration')
        ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->create('foo', array());
    }

    public function testCreateIntegration_ItShouldCreateAnIntegration()
    {
        $integration = new \Catalytic\SDK\Model\Integration(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'isCustomIntegration' => false,
                'connections' => 'Something here',
                'connectionParams' => 'Some params'
            )
        );

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('createIntegration')
        ->andReturn($integration);

        $integrationsClient = new Integrations('1234', $integrationsApi);

        $integration = $integrationsClient->create('My new integration', array());
        $this->assertInstanceOf(Integration::class, $integration);
    }

    public function testUpdateIntegration_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->update('1234', 'foo', array());
    }

    public function testUpdateIntegration_ItShouldThrowUnauthorizedExceptionIfNotAuthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('updateIntegration')
        ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->update('1234', 'foo', array());
    }

    public function testUpdateIntegration_ItShouldThrowUInternalErrorExceptionIfAnErrorOccurs()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to update Integration");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('updateIntegration')
        ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->update('1234', 'foo', array());
    }

    public function testUpdateIntegration_ItShouldUpdateAnIntegration()
    {
        $integration = new \Catalytic\SDK\Model\Integration(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'isCustomIntegration' => false,
                'connections' => 'Something here',
                'connectionParams' => 'Some params'
            )
        );

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('updateIntegration')
        ->andReturn($integration);

        $integrationsClient = new Integrations('1234', $integrationsApi);

        $integration = $integrationsClient->update('1234', 'My new integration', array());
        $this->assertInstanceOf(Integration::class, $integration);
    }

    public function testDeleteIntegration_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->delete('1234');
    }

    public function testDeleteIntegration_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegration')
        ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->delete('1234');
    }

    public function testDeleteIntegration_ItShouldThrowIntegrationNotFoundExceptionIfIntegrationDoesNotExist()
    {
        $this->expectException(IntegrationNotFoundException::class);
        $this->expectExceptionMessage("Integration with id 1234 not found");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegration')
        ->andThrow(new ApiException(null, 404));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->delete('1234');
    }

    public function testDeleteIntegration_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to delete Integration");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegration')
        ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->delete('1234');
    }

    public function testDeleteIntegration_ItShouldDeleteAnIntegration()
    {
        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegration');

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integration = $integrationsClient->delete('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        // No exception was thrown, so just make a dummy assertion to pass the test
        $this->assertTrue(true);
    }

    public function testGetIntegrationConnection_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->getIntegrationConnection('1234');
    }

    public function testGetIntegrationConnection_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegrationConnection')
        ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->getIntegrationConnection('1234');
    }

    public function testGetIntegrationConnection_ItShouldThrowIntegrationConnectionNotFoundExceptionIfIntegrationDoesNotExist()
    {
        $this->expectException(IntegrationConnectionNotFoundException::class);
        $this->expectExceptionMessage("Integration Connection with id 1234 not found");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegrationConnection')
        ->andThrow(new ApiException(null, 404));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->getIntegrationConnection('1234');
    }

    public function testGetIntegrationConnection_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get Integration Connection");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegrationConnection')
        ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->getIntegrationConnection('alice@catalytic.com');
    }

    public function testGetIntegrationConnection_ItShouldGetAnIntegrationConnection()
    {
        $integration = new \Catalytic\SDK\Model\IntegrationConnection(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'referenceName' => 'example-integration',
                'integrationId' => '92d35fa4-ba51-419a-bfc9-7d35b7a8613d'
            )
        );
        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('getIntegrationConnection')
        ->andReturn($integration);

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integration = $integrationsClient->getIntegrationConnection('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(IntegrationConnection::class, $integration);
    }

    public function testCreateIntegrationConnection_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->createIntegrationConnection('foo', 'bar', array());
    }

    public function testCreateIntegrationConnection_ItShouldThrowUnauthorizedExceptionIfNotAuthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('createIntegrationConnection')
        ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->createIntegrationConnection('foo', 'bar', array());
    }

    public function testCreateIntegrationConnection_ItShouldThrowUInternalErrorExceptionIfAnErrorOccurs()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to create Integration Connection");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('createIntegrationConnection')
        ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->createIntegrationConnection('foo', 'bar', array());
    }

    public function testCreateIntegrationConnection_ItShouldCreateAnIntegration()
    {
        $integration = new \Catalytic\SDK\Model\IntegrationConnection(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Integration',
                'referenceName' => 'example-integration',
                'integrationId' => '92d35fa4-ba51-419a-bfc9-7d35b7a8613d'
            )
        );

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('createIntegrationConnection')
        ->andReturn($integration);

        $integrationsClient = new Integrations('1234', $integrationsApi);

        $integration = $integrationsClient->createIntegrationConnection('1234', 'My new integration', array());
        $this->assertInstanceOf(IntegrationConnection::class, $integration);
    }

    public function testDeleteIntegrationConnection_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $integrationsClient = new Integrations(null);
        $integrationsClient->deleteIntegrationConnection('1234');
    }

    public function testDeleteIntegrationConnection_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegrationConnection')
        ->andThrow(new ApiException(null, 401));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->deleteIntegrationConnection('1234');
    }

    public function testDeleteIntegrationConnection_ItShouldThrowIntegrationConnectionNotFoundExceptionIfIntegrationConnectionDoesNotExist()
    {
        $this->expectException(IntegrationConnectionNotFoundException::class);
        $this->expectExceptionMessage("Integration Connection with id 1234 not found");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegrationConnection')
        ->andThrow(new ApiException(null, 404));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->deleteIntegrationConnection('1234');
    }

    public function testDeleteIntegrationConnection_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to delete Integration Connection");

        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegrationConnection')
        ->andThrow(new ApiException(null, 500));

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integrationsClient->deleteIntegrationConnection('1234');
    }

    public function testDeleteIntegrationConnection_ItShouldDeleteAnIntegration()
    {
        $integrationsApi = Mockery::mock('Catalytic\SDK\Api\IntegrationsApi');
        $integrationsApi->shouldReceive('deleteIntegrationConnection');

        $integrationsClient = new Integrations('1234', $integrationsApi);
        $integration = $integrationsClient->deleteIntegrationConnection('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        // No exception was thrown, so just make a dummy assertion to pass the test
        $this->assertTrue(true);
    }
}
