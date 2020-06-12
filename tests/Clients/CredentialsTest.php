<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Credentials;
use Catalytic\SDK\Search\Where;
use Catalytic\SDK\Exceptions\{
    CredentialsNotFoundException,
    InternalErrorException,
    UnauthorizedException
};
use Catalytic\SDK\Entities\{Credentials as UserCredentials, CredentialsPage};
use PHPUnit\Framework\TestCase;

class CredentialsTest extends TestCase
{
    public function testGetCredentials_ItShouldThrowAnExceptionIfCredentialsDoNotExist()
    {
        $this->expectException(CredentialsNotFoundException::class);
        $this->expectExceptionMessage("Credentials with id 1234 not found");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('getCredentials')
            ->andThrow(new ApiException(null, 404));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->get('1234');
    }

    public function testGetCredentials_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('getCredentials')
            ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testGetCredentials_ItShouldThrowInternalErrorExceptionIfFailureToFetchCredentials()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get credentials");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('getCredentials')
            ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testGetCredentials_ItShouldGetCredentials()
    {
        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('getCredentials')
            ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentials = $credentialsClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
        $this->assertInstanceOf(UserCredentials::class, $credentials);
    }

    public function testFindCredentials_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->find();
    }

    public function testFindCredentials_ItShouldThrowUInternalErrorExceptionIfCredentialsDoNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find Credentials");

        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->find();
    }

    public function testFindCredentials_ItShouldFindAllCredentials()
    {
        $user = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $credentialsPage = new \Catalytic\SDK\Model\CredentialsPage(
            array(
                'credentials' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andReturn($credentialsPage);

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);

        $results = $credentialsClient->find();
        $credentials = $results->getCredentials();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $credentialsClient()->find(null, $results->getNextPageToken());
            $credentials = array_merge($credentials, $results->getCredentials());
        }

        $this->assertEquals(count($credentials), 1);
    }

    public function testFindCredentials_ItShouldFindCredentialsWithTextAlice()
    {
        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $credentialsPage = new \Catalytic\SDK\Model\CredentialsPage(
            array(
                'credentials' => array($credentials),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andReturn($credentialsPage);

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);

        $where = (new Where())->text()->matches('tom');
        $results = $credentialsClient->find($where);
        $credentials = $results->getCredentials();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $credentialsClient()->find($where, $results->getNextPageToken());
            $credentials = array_merge($credentials, $results->getCredentials());
        }

        $this->assertEquals(count($credentials), 1);
    }

    public function testFindCredentials_ItShouldFindCredentialsWithOwnerLarry()
    {
        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'larry@catalytic.com'
            )
        );
        $credentialsPage = new \Catalytic\SDK\Model\CredentialsPage(
            array(
                'credentials' => array($credentials),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andReturn($credentialsPage);

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);

        $where = (new Where())->text()->matches('tom');
        $results = $credentialsClient->find($where);
        $credentials = $results->getCredentials();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $credentialsClient()->find($where, $results->getNextPageToken());
            $credentials = array_merge($credentials, $results->getCredentials());
        }

        $this->assertEquals(count($credentials), 1);
    }

    public function testCreateCredentials_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveCredentials')
        ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentialsClient->create('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateCredentials_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to create Credentials");
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveCredentials')
        ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentialsClient->create('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateCredentials_ItShouldCreateCredentials()
    {
        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveCredentials')
        ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentials = $credentialsClient->create('example', 'alice@example.com', 'mypassword');
        $this->assertInstanceOf(UserCredentials::class, $credentials);
    }

    public function testCreateCredentialsWithWebApprovalFlow_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createCredentials')
        ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentialsClient->createWithWebApprovalFlow('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateCredentialsWithWebApprovalFlow_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to create Credentials");
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createCredentials')
        ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentialsClient->createWithWebApprovalFlow('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateCredentialsWithWebApprovalFlow_ItShouldCreateCredentials()
    {
        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createCredentials')
        ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentials = $credentialsClient->createWithWebApprovalFlow('example', 'alice@example.com', 'mypassword');
        $this->assertInstanceOf(UserCredentials::class, $credentials);
    }

    public function testGetApprovalUrl_ItShouldReturnApprovalUrl()
    {

        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'example.pushbot.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createCredentials')
        ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentials = $credentialsClient->createWithWebApprovalFlow('example.pushbot.com');
        $url = $credentialsClient->getApprovalUrl($credentials);
        $this->assertEquals('https://example.pushbot.com/access-tokens/approve?userTokenID=114c0d7d-c291-4ad2-a10d-68c5dd532af3&application=Catalytic+SDK', $url);
    }

    public function testWaitForApproval_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('waitForCredentialsApproval')
        ->andThrow(new ApiException(null, 401));

        $credentials = new \Catalytic\SDK\Entities\Credentials(
            '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
            'example.pushbot.com',
            'catalytic',
            'foobar',
            'asdf1234',
            'mysecret',
            'prod',
            'alice'
        );
        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentialsClient->waitForApproval($credentials);
    }

    public function testWaitForApproval_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to wait for Credentials approval");
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('waitForCredentialsApproval')
        ->andThrow(new ApiException(null, 500));

        $credentials = new \Catalytic\SDK\Entities\Credentials(
            '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
            'example.pushbot.com',
            'catalytic',
            'foobar',
            'asdf1234',
            'mysecret',
            'prod',
            'alice'
        );
        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentialsClient->waitForApproval($credentials);
    }

    public function testWaitForApproval_ItShouldWaitForCredentialsApproval()
    {
        $internalCredentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $userCredentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('waitForCredentialsApproval')
        ->andReturn($internalCredentials);

        $credentials = new \Catalytic\SDK\Entities\Credentials(
            '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
            'example.pushbot.com',
            'catalytic',
            'foobar',
            'asdf1234',
            'mysecret',
            'prod',
            'alice'
        );
        $credentialsClient = new Credentials(null, $userCredentialsApi, $authenticationApi);
        $credentials = $credentialsClient->waitForApproval($credentials);
        $this->assertInstanceOf(UserCredentials::class, $credentials);
    }

    public function testRevokeCredentials_ItShouldThrowAnExceptionIfCredentialsDoNotExist()
    {
        $this->expectException(CredentialsNotFoundException::class);
        $this->expectExceptionMessage("Credentials with id 1234 not found");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andThrow(new ApiException(null, 404));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->revoke('1234');
    }

    public function testRevokeCredentials_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testRevokeCredentials_ItShouldThrowInternalErrorExceptionIfFailureToFetchCredentials()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to revoke Credentials");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentialsClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testRevokeCredentials_ItShouldGetCredentials()
    {
        $credentials = new \Catalytic\SDK\Model\Credentials(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'larry@catalytic.com'
            )
        );
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $credentialsApi, $authenticationApi);
        $credentials = $credentialsClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
        $this->assertInstanceOf(\Catalytic\SDK\Entities\Credentials::class, $credentials);
    }
}
