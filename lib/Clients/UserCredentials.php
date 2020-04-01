<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\UserCredentialsApi;

/**
 * Credentials client to be exposed to consumers
 */
class UserCredentials
{
    private UserCredentialsApi $userCredentialsApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->userCredentialsApi = new UserCredentialsApi(null, $config);
    }

    public function get(string $id)
    {
        // $userCredentials = $this->userCredentialsApi->getCredentials($id);
        // return $userCredentials;
        throw new Exception('Not yet implemented');
    }

    public function find(Where $filter)
    {
        // $userCredentials = $this->userCredentialsApi->findCredentials($filter);
        // return $userCredentials;
        throw new Exception('Not yet implemented');
    }

    public function create(string $team, string $email, string $password)
    {
        throw new Exception('Not yet implemented');
    }

    public function revoke(string $id)
    {
        throw new Exception('Not yet implemented');
    }
}