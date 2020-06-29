<?php

namespace Catalytic\SDK;

use Catalytic\SDK\Credentials;
use Catalytic\SDK\Clients\{
    Workflows,
    Instances,
    Users,
    Files,
    DataTables,
    AccessTokens
};

/**
 * Client for connecting to catalytic
 */
class CatalyticClient
{
    private $token;
    private $workflows;
    private $instances;
    private $users;
    private $files;
    private $dataTables;
    private $accessTokens;

    /**
     * Instantiate the individual clients
     *
     * @param string $tokenOrFile (Optional) The token/name/path of a file to fetch a token to use for making api requests
     */
    public function __construct($tokenOrFile = null)
    {
        $credentials = new Credentials();
        $this->token = $credentials->fetchToken($tokenOrFile);
        $this->workflows = new Workflows($this->token);
        $this->instances = new Instances($this->token);
        $this->users = new Users($this->token);
        $this->files = new Files($this->token);
        $this->dataTables = new DataTables($this->token);
        $this->accessTokens = new AccessTokens($this->token);
    }

    public function workflows(): Workflows
    {
        return $this->workflows;
    }

    public function instances(): Instances
    {
        return $this->instances;
    }

    public function users(): Users
    {
        return $this->users;
    }

    public function files(): Files
    {
        return $this->files;
    }

    public function dataTables(): DataTables
    {
        return $this->dataTables;
    }

    public function accessTokens(): AccessTokens
    {
        return $this->accessTokens;
    }

    /**
     * Get the AccessToken used to instantiate this instance of CatalyticClient
     */
    public function getAccessToken(): string
    {
        return $this->token;
    }
}
