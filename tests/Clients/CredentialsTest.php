<?php

// use Catalytic\SDK\CatalyticClient;
// use Catalytic\SDK\Entities\Credentials;
// use Catalytic\SDK\Search\Where;
// use PHPUnit\Framework\TestCase;
// use Catalytic\SDK\Exceptions\CredentialsNotFoundException;

// class CredentialsTest extends TestCase
// {
//     public function testItShouldThrowAnExceptionIfCredentialsDoNotExist()
//     {
//         $this->expectException(CredentialsNotFoundException::class);
//         $this->expectExceptionMessage("Credentials with id 1234 not found");
//         $catalytic = new CatalyticClient();
//         // $catalytic->credentials()->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
//         $catalytic->credentials()->get('1234');
//     }

//     public function testItShouldGetCredentials()
//     {
//         $catalytic = new CatalyticClient();
//         $credentials = $catalytic->credentials()->get('114c0d7d-c291-4ad2-a10d-68c5dd532af3');
//         $this->assertInstanceOf(Credentials::class, $credentials);
//     }

//     // public function testItShouldFindAllUsers()
//     // {
//     //     $catalytic = new CatalyticClient();
//     //     $results = $catalytic->users()->find();
//     //     $users = $results->getUsers();

//     //     // Loop through all the pages of results
//     //     while (!empty($results->getNextPageToken())) {
//     //         $results = $catalytic->users()->find(null, $results->getNextPageToken());
//     //         $users = array_merge($users, $results->getUsers());
//     //     }

//     //     $this->assertGreaterThan(0, count($users));
//     // }

//     // public function testItShouldFindUsersWithNameTom()
//     // {
//     //     $catalytic = new CatalyticClient();
//     //     $where = (new Where())->text()->matches('tom');
//     //     $results = $catalytic->users()->find($where);
//     //     $users = $results->getUsers();

//     //     // Loop through all the pages of results
//     //     while (!empty($results->getNextPageToken())) {
//     //         $results = $catalytic->users()->find($where, $results->getNextPageToken());
//     //         $users = array_merge($users, $results->getUsers());
//     //     }

//     //     $this->assertGreaterThan(0, count($users));
//     // }
// }
