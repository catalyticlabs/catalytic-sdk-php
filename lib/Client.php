<?php

namespace Catalytic\SDK;

use Catalytic\SDK\Credentials as InternalCredentials;
use Catalytic\SDK\Clients\{
    Workflows,
    Instances,
    Users,
    Files,
    DataTables,
    Credentials
};

/**
 * Client for connecting to catalytic
 */
class Client
{
    private Workflows $workflows;
    private Instances $instances;
    private Users $users;
    private Files $files;
    private DataTables $dataTables;
    private Credentials $credentials;

    /**
     * Instantiate the individual clients
     *
     * @param string $tokenOrFile (Optional) The token/name/path of a file to fetch a token to use for making api requests
     */
    public function __construct(string $tokenOrFile = null)
    {
        $credentials = new InternalCredentials();
        $token = $credentials->fetchToken($tokenOrFile);
        $this->workflows = new Workflows($token);
        $this->instances = new Instances($token);
        $this->users = new Users($token);
        $this->files = new Files($token);
        $this->dataTables = new DataTables($token);
        $this->credentials = new Credentials($token);
    }

    public function workflows()
    {
        return $this->workflows;
    }

    public function instances()
    {
        return $this->instances;
    }

    public function users()
    {
        return $this->users;
    }

    public function files()
    {
        return $this->files;
    }

    public function dataTables()
    {
        return $this->dataTables;
    }

    public function credentials()
    {
        return $this->credentials;
    }

    /**
     * Parse a token to get the connection values
     */
    // private static function _parseToken(string $secret)
    // {


        // $parsedToken = $this->_parseToken($secret);
        // $credentials['secret'] = $secret;
        // $config = array(
        //     'id' => $parsedToken['id'],
        //     'domain' => $parsedToken['domain'],
        //     'name' => ?,
        //     'type' => ?,
        //     'token' => $token,
        //     'secret' => $parsedToken['secret'],
        //     'environment' => $parsedToken['']
        // )


    //     $decodedToken = base64_decode($secret);
    //     echo "decodedToken = ";
    //     var_dump($decodedToken);
    //     $pieces = explode(':', $encodedToken);
    //     $credentials = array('id' => $pieces[0], 'secret' => $pieces[1], 'domain' => $pieces[2], 'stage' => $pieces[3]);
    //     return $credentials;
    // }
}
