<?php
require __DIR__ . '/../../vendor/autoload.php';

use Catalytic\SDK\Api\UsersApi;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Users;
use Catalytic\SDK\Search\Where;
use Catalytic\SDK\Entities\User;
use Catalytic\SDK\Exceptions\InternalErrorException;
use Catalytic\SDK\Exceptions\UnauthorizedException;
use Catalytic\SDK\Exceptions\UserNotFoundException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class UsersTest extends MockeryTestCase
{
    public function testGetUser_ItShouldThrowUserNotFoundExceptionIfUserDoesNotExist()
    {
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage("User with id, email, or username alice@catalytic.com not found");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
            ->andThrow(new ApiException(null, 404));

        $usersClient = new Users(null, $usersApi);
        $usersClient->get('alice@catalytic.com');
    }

    public function testGetUser_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
        ->andThrow(new ApiException(null, 401));

        $usersClient = new Users(null, $usersApi);
        $usersClient->get('alice@catalytic.com');
    }

    public function testGetUser_ItShouldThrowUInternalErrorExceptionIfUserDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get user");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
        ->andThrow(new ApiException(null, 500));

        $usersClient = new Users(null, $usersApi);
        $usersClient->get('alice@catalytic.com');
    }

    public function testGetUser_ItShouldGetAUser()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'username' => 'alice',
                'email' => 'alice@catalytic.com'
            )
        );
        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('getUser')
            ->andReturn($user);

        $usersClient = new Users(null, $usersApi);
        $user = $usersClient->get('alice@catalytic.com');
        $this->assertInstanceOf(User::class, $user);
    }

    public function testFindUsers_ItShouldThrowUnauthorizedExceptionIfUserDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('findUsers')
        ->andThrow(new ApiException(null, 401));

        $usersClient = new Users(null, $usersApi);
        $usersClient->find();
    }

    public function testFindUsers_ItShouldThrowUInternalErrorExceptionIfUserDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find Users");

        $usersApi = Mockery::mock('Catalytic\SDK\Api\UsersApi');
        $usersApi->shouldReceive('findUsers')
        ->andThrow(new ApiException(null, 500));

        $usersClient = new Users(null, $usersApi);
        $usersClient->find();
    }

    public function testFindUsers_ItShouldFindAllUsers()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'username' => 'alice',
                'email' => 'alice@catalytic.com'
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
        $usersApi->shouldReceive('findUsers')
            ->andReturn($usersPage);

        $usersClient = new Users(null, $usersApi);

        $results = $usersClient->find();
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->find(null, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }

    public function testFindUsers_ItShouldFindUsersWithNameAlice()
    {
        $user = new \Catalytic\SDK\Model\User(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'username' => 'alice',
                'email' => 'alice@catalytic.com'
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
        $usersApi->shouldReceive('findUsers')
            ->andReturn($usersPage);

        $usersClient = new Users(null, $usersApi);

        $where = (new Where())->text()->matches('tom');
        $results = $usersClient->find($where);
        $users = $results->getUsers();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $usersClient()->find($where, $results->getNextPageToken());
            $users = array_merge($users, $results->getUsers());
        }

        $this->assertEquals(count($users), 1);
    }
}