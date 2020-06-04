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
        $credentialsApi->shouldReceive('getCredentials')
            ->andThrow(new ApiException(null, 404));

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentialsClient->get('1234');
    }

    public function testGetCredentials_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('getCredentials')
            ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentialsClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testGetCredentials_ItShouldThrowInternalErrorExceptionIfFailureToFetchCredentials()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get credentials");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('getCredentials')
            ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $credentialsApi);
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
        $credentialsApi->shouldReceive('getCredentials')
            ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentials = $credentialsClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
        $this->assertInstanceOf(UserCredentials::class, $credentials);
    }

    public function testFindCredentials_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentialsClient->find();
    }

    public function testFindCredentials_ItShouldThrowUInternalErrorExceptionIfCredentialsDoNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find Credentials");

        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('findCredentials')
        ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $credentialsApi);
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
        $credentialsApi->shouldReceive('findCredentials')
        ->andReturn($credentialsPage);

        $credentialsClient = new Credentials(null, $credentialsApi);

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
        $credentialsApi->shouldReceive('findCredentials')
        ->andReturn($credentialsPage);

        $credentialsClient = new Credentials(null, $credentialsApi);

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
        $credentialsApi->shouldReceive('findCredentials')
        ->andReturn($credentialsPage);

        $credentialsClient = new Credentials(null, $credentialsApi);

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

    public function testRevokeCredentials_ItShouldThrowAnExceptionIfCredentialsDoNotExist()
    {
        $this->expectException(CredentialsNotFoundException::class);
        $this->expectExceptionMessage("Credentials with id 1234 not found");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andThrow(new ApiException(null, 404));

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentialsClient->revoke('1234');
    }

    public function testRevokeCredentials_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andThrow(new ApiException(null, 401));

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentialsClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testRevokeCredentials_ItShouldThrowInternalErrorExceptionIfFailureToFetchCredentials()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to revoke Credentials");
        $credentialsApi = Mockery::mock('Catalytic\SDK\Api\UserCredentialsApi');
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andThrow(new ApiException(null, 500));

        $credentialsClient = new Credentials(null, $credentialsApi);
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
        $credentialsApi->shouldReceive('revokeCredentials')
            ->andReturn($credentials);

        $credentialsClient = new Credentials(null, $credentialsApi);
        $credentials = $credentialsClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
        $this->assertInstanceOf(\Catalytic\SDK\Entities\Credentials::class, $credentials);
    }
}
