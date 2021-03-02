<?php
require __DIR__ . '/../../vendor/autoload.php';

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Users;
use Catalytic\SDK\Entities\User;
use Catalytic\SDK\Exceptions\{
    AccessTokenNotFoundException,
    InternalErrorException,
    UnauthorizedException,
    UserNotFoundException
};
use Catalytic\SDK\Search\UsersWhere;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class UsersTest extends MockeryTestCase
{
    public function testGetUser_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $usersClient = new Users(null);
        $usersClient->get('alice@example.com');
    }

    public function testGetUser_ItShouldThrowUserNotFoundExceptionIfUserDoesNotExist()
    {
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage("User with id or email alice@catalytic.com not found");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
            ->andThrow(new ApiException(null, 404));

        $usersClient = new Users('1234', $usersApi);
        $usersClient->get('alice@catalytic.com');
    }

    public function testGetUser_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
        ->andThrow(new ApiException(null, 401));

        $usersClient = new Users('1234', $usersApi);
        $usersClient->get('alice@catalytic.com');
    }

    public function testGetUser_ItShouldThrowUInternalErrorExceptionIfUserDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get user");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
        ->andThrow(new ApiException(null, 500));

        $usersClient = new Users('1234', $usersApi);
        $usersClient->get('alice@catalytic.com');
    }

    public function testGetUser_ItShouldGetAUser()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com'
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
            ->andReturn($user);

        $usersClient = new Users('1234', $usersApi);
        $user = $usersClient->get('alice@catalytic.com');
        $this->assertInstanceOf(User::class, $user);
    }

    public function testListUsers_ItShouldListAllUsers()
    {
        $alice = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example'
            )
        );
        $bob = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'bob@aol.com',
                'fullName' => 'bob ross'
            )
        );

        $firstPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($alice),
                'nextPageToken' => '123',
                'count' => 1
            )
        );
        $secondPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($bob),
                'nextPageToken' => '',
                'count' => 1
            )
        );

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
            ->andReturn($firstPage, $secondPage);


        $usersClient = new Users('1234', $usersApi);

        $results = $usersClient->list();
        $users = $results->getUsers();

        $this->assertEquals(count($users), 2);
        $this->assertEquals($users[0]->getEmail(), 'alice@catalytic.com');
        $this->assertEquals($users[1]->getEmail(), 'bob@aol.com');
    }

    public function testSearchUsers_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $usersClient = new Users(null);
        $usersClient->search();
    }

    public function testSearchUsers_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andThrow(new ApiException(null, 401));

        $usersClient = new Users('1234', $usersApi);
        $usersClient->search();
    }

    public function testSearchUsers_ItShouldThrowUInternalErrorExceptionIfUserDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find Users");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andThrow(new ApiException(null, 500));

        $usersClient = new Users('1234', $usersApi);
        $usersClient->search();
    }

    public function testSearchUsers_ItShouldFindUsersById()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example'
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::id("7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd");
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByEmail()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example'
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::email('alice@catalytic.com');
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByEmailContains()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example'
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::emailContains('alice@');
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByEmailBetween()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'createdDate' => ''
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::emailBetween('alic', 'aliz');
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByFullName()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example'
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::fullName('alice example');
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByFullNameContains()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example'
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::emailContains('alice');
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByFullNameBetween()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'createdDate' => ''
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::fullNameBetween('alic', 'aliz');
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByIsTeamAdmin()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'isTeamAdmin' => true
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::isTeamAdmin(true);
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByIsDeactivated()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'isDeactivated' => true
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::isDeactivated(true);
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByIsLockedOut()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'isLockedOut' => true
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::isLockedOut(true);
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByCreatedDate()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'createdDate' => ''
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::createdDate(new DateTime);
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByCreatedDateBetween()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'createdDate' => ''
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::createdDateBetween(new DateTime, new DateTime);
        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByEmailOrEmail()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'isLockedOut' => true
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::or(
            UsersWhere::email('alice@example.com'),
            UsersWhere::email('marvin@aol.com')
        );

        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testSearchUsers_ItShouldFindUsersByEmailAndFullName()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'email' => 'alice@catalytic.com',
                'fullName' => 'alice example',
                'isLockedOut' => true
            )
        );
        $usersPage = new \Catalytic\SDK\Model\UsersPage(
            array(
                'users' => array($user),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('searchUsers')
        ->andReturn($usersPage);

        $usersClient = new Users('1234', $usersApi);

        $searchCriteria = UsersWhere::and(
            UsersWhere::email('alice@example.com'),
            UsersWhere::fullName('alice example')
        );

        $results = $usersClient->search($searchCriteria);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->search($searchCriteria, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }
}