<?php

namespace Catalytic\SDK;

use Exception;
use \Catalytic\SDK\Clients\{Pushbots, Instances, Users, Files, DataTables, UserCredentials};

/**
 * Client for connecting to catalytic
 */
class Client
{
    private Pushbots $pushbots;
    private Instances $instances;
    private Users $users;
    private Files $files;
    private DataTables $dataTables;
    private UserCredentials $userCredentials;

    /**
     * Instantiate the individual clients
     *
     * @param string $token The token to use for making api requests
     */
    public function __construct(string $token)
    {
        if ($token === null) {
            throw new Exception('Cannot find credentials');
        }

        $this->pushbots = new Pushbots($token);
        $this->instances = new Instances($token);
        $this->users = new Users($token);
        $this->files = new Files($token);
        $this->dataTables = new DataTables($token);
        $this->userCredentials = new UserCredentials($token);
    }

    public function pushbots()
    {
        return $this->pushbots;
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

    public function userCredentials()
    {
        return $this->userCredentials;
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
