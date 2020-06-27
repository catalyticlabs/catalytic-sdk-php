<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\AccessTokens;
use Catalytic\SDK\Search\Where;
use Catalytic\SDK\Exceptions\{
    AccessTokenNotFoundException,
    InternalErrorException,
    UnauthorizedException
};
use Catalytic\SDK\Entities\{AccessToken, AccessTokensPage};
use PHPUnit\Framework\TestCase;

class AccessTokensTest extends TestCase
{
    public function testGetAccessToken_ItShouldThrowAnExceptionIfAccessTokenDoesNotExist()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage("AccessToken with id 1234 not found");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('getAccessToken')
            ->andThrow(new ApiException(null, 404));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->get('1234');
    }

    public function testGetAccessToken_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('getAccessToken')
            ->andThrow(new ApiException(null, 401));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testGetAccessToken_ItShouldThrowInternalErrorExceptionIfFailureToFetchAccessToken()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get Access Token");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('getAccessToken')
            ->andThrow(new ApiException(null, 500));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testGetAccessToken_ItShouldGetAccessToken()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('getAccessToken')
            ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }

    public function testFindAccessTokens_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('findAccessTokens')
        ->andThrow(new ApiException(null, 401));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->find();
    }

    public function testFindAccessTokens_ItShouldThrowUInternalErrorExceptionIfAccessTokensDoNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find AccessTokens");

        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('findAccessTokens')
        ->andThrow(new ApiException(null, 500));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->find();
    }

    public function testFindAccessTokens_ItShouldFindAllAccessTokens()
    {
        $user = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenPage = new \Catalytic\SDK\Model\AccessTokensPage(
            array(
                'accessTokens' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('findAccessTokens')
        ->andReturn($accessTokenPage);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);

        $results = $accessTokensClient->find();
        $accessToken = $results->getAccessTokens();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $accessTokensClient()->find(null, $results->getNextPageToken());
            $accessToken = array_merge($accessToken, $results->getAccessTokens());
        }

        $this->assertEquals(count($accessToken), 1);
    }

    public function testFindAccessTokens_ItShouldFindAccessTokensWithTextAlice()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenPage = new \Catalytic\SDK\Model\AccessTokensPage(
            array(
                'accessTokens' => array($accessToken),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('findAccessTokens')
        ->andReturn($accessTokenPage);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);

        $where = (new Where())->text()->matches('tom');
        $results = $accessTokensClient->find($where);
        $accessToken = $results->getAccessTokens();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $accessTokensClient()->find($where, $results->getNextPageToken());
            $accessToken = array_merge($accessToken, $results->getAccessTokens());
        }

        $this->assertEquals(count($accessToken), 1);
    }

    public function testFindAccessTokens_ItShouldFindAccessTokensWithOwnerLarry()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'larry@catalytic.com'
            )
        );
        $accessTokenPage = new \Catalytic\SDK\Model\AccessTokensPage(
            array(
                'accessTokens' => array($accessToken),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('findAccessTokens')
        ->andReturn($accessTokenPage);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);

        $where = (new Where())->text()->matches('tom');
        $results = $accessTokensClient->find($where);
        $accessToken = $results->getAccessTokens();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $accessTokensClient()->find($where, $results->getNextPageToken());
            $accessToken = array_merge($accessToken, $results->getAccessTokens());
        }

        $this->assertEquals(count($accessToken), 1);
    }

    public function testCreateAccessTokens_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveAccessToken')
        ->andThrow(new ApiException(null, 401));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->create('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateAccessToken_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to create AccessToken");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveAccessToken')
        ->andThrow(new ApiException(null, 500));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->create('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateAccessToken_ItShouldCreateAccessTokenWithTeamName()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveAccessToken')
        ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->create('example', 'alice@example.com', 'mypassword');
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }

    public function testCreateAccessToken_ItShouldCreateAccessTokenWithDomain()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveAccessToken')
        ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->create('example.pushbot.com', 'alice@example.com', 'mypassword');
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }

    public function testCreateAccessToken_ItShouldThrowInvalidArgumentException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid teamName");
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAndApproveAccessToken')
        ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->create('http://example.pushbot.com', 'alice@example.com', 'mypassword');
    }

    public function testCreateAccessTokenWithWebApprovalFlow_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAccessToken')
        ->andThrow(new ApiException(null, 401));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->createWithWebApprovalFlow('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateAccessTokenWithWebApprovalFlow_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to create AccessToken");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAccessToken')
        ->andThrow(new ApiException(null, 500));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->createWithWebApprovalFlow('example', 'alice@example.com', 'mypassword');
    }

    public function testCreateAccessTokenWithWebApprovalFlow_ItShouldCreateAccessToken()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAccessToken')
        ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->createWithWebApprovalFlow('example', 'alice@example.com', 'mypassword');
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }

    public function testGetApprovalUrl_ItShouldReturnApprovalUrl()
    {

        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'example.pushbot.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('createAccessToken')
        ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->createWithWebApprovalFlow('example.pushbot.com');
        $url = $accessTokensClient->getApprovalUrl($accessToken);
        $this->assertEquals('https://example.pushbot.com/access-tokens/approve?userTokenID=114c0d7d-c291-4ad2-a10d-68c5dd532af3&application=Catalytic+SDK', $url);
    }

    public function testWaitForApproval_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('waitForAccessTokenApproval')
        ->andThrow(new ApiException(null, 401));

        $accessToken = new \Catalytic\SDK\Entities\AccessToken(
            '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
            'example.pushbot.com',
            'catalytic',
            'foobar',
            'asdf1234',
            'mysecret',
            'prod',
            'alice'
        );
        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->waitForApproval($accessToken);
    }

    public function testWaitForApproval_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to wait for AccessToken approval");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('waitForAccessTokenApproval')
        ->andThrow(new ApiException(null, 500));

        $accessToken = new \Catalytic\SDK\Entities\AccessToken(
            '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
            'example.pushbot.com',
            'catalytic',
            'foobar',
            'asdf1234',
            'mysecret',
            'prod',
            'alice'
        );
        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->waitForApproval($accessToken);
    }

    public function testWaitForApproval_ItShouldWaitForAccessTokenApproval()
    {
        $internalAccessTokens = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'alice@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $authenticationApi->shouldReceive('waitForAccessTokenApproval')
        ->andReturn($internalAccessTokens);

        $accessToken = new \Catalytic\SDK\Entities\AccessToken(
            '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
            'example.pushbot.com',
            'catalytic',
            'foobar',
            'asdf1234',
            'mysecret',
            'prod',
            'alice'
        );
        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->waitForApproval($accessToken);
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }

    public function testRevokeAccessToken_ItShouldThrowAnExceptionIfAccessTokenDoNotExist()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage("AccessToken with id 1234 not found");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('revokeAccessToken')
            ->andThrow(new ApiException(null, 404));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->revoke('1234');
    }

    public function testRevokeAccessToken_ItShouldThrowUnauthorizedExceptionIfUnauthorized()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('revokeAccessToken')
            ->andThrow(new ApiException(null, 401));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testRevokeAccessToken_ItShouldThrowInternalErrorExceptionIfFailureToFetchAccessToken()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to revoke AccessToken");
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('revokeAccessToken')
            ->andThrow(new ApiException(null, 500));

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessTokensClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
    }

    public function testRevokeAccessToken_ItShouldRevokeAccessToken()
    {
        $accessToken = new \Catalytic\SDK\Model\AccessToken(
            array(
                'id' => '114c0d7d-c291-4ad2-a10d-68c5dd532af3',
                'domain' => 'https://catalytic.com',
                'name' => 'catalytic',
                'type' => 'foobar',
                'environment' => 'prod',
                'owner' => 'larry@catalytic.com'
            )
        );
        $accessTokenApi = Mockery::mock('Catalytic\SDK\Api\AccessTokensApi');
        $authenticationApi = Mockery::mock('Catalytic\SDK\Api\AuthenticationApi');
        $accessTokenApi->shouldReceive('revokeAccessToken')
            ->andReturn($accessToken);

        $accessTokensClient = new AccessTokens(null, $accessTokenApi, $authenticationApi);
        $accessToken = $accessTokensClient->revoke('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }
}
