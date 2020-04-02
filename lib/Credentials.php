<?php

namespace Catalytic\SDK;

use Exception;

/**
 * Class containing various ways of fetching the Catalytic token
 */
class Credentials
{
    /**
     * Tries to find a token.
     *
     * $tokenOrFile can either be null, the name of a file, or the path to a file.
     *
     * If $tokenOrFile is null, try to find a token in this order:
     *
     * 1. Read $CATALYTIC_CREDENTIALS env var
     * 2. Read ~/.catalytic/credentials/default
     *
     * If $tokenOrFile is not null, try to find a token in this order:
     *
     * 1. Read ~/.catalytic/credentials/$tokenOrFile
     * 2. Read $tokenOrFile as the path to a file
     * 3. Assume it's an actual token that was passed in
     *
     * @param string $tokenOrFile (Optional)    The token, filename, or path to a file for fetching a token
     * @return string                           The token
     * @throws Exception                        If a token can't be found
     */
    public function fetchToken(string $tokenOrFile = null)
    {
        if ($tokenOrFile === null) {
            return $this->fromDefault();
        } else {
            return $this->fromFile($tokenOrFile);
        }
    }

    /**
     * Fetch the Catalytic token.
     *
     * First tries to fetch the token from the env var $CATALYTIC_CREDENTIALS,
     * then tries to fetch it from ~/.catalytic/credentials/default.
     *
     * @return string   The Catalytic access token
     * @throws Exception
     */
    private function fromDefault()
    {
        // Try to get the token from the env var
        $token = $this->fetchTokenFromEnvVar();

        // If it didn't exist, try to get it from the default file
        if (!$token) {
            $token = $this->fetchTokenFromFile();
        }

        // If it wasn't found, throw an exception
        if (!$token) {
            $home = $this->getHomeDir();
            throw new Exception('Cannot find credentials in $CATALYTIC_CREDENTIALS
                environment variable or ' . "$home/.catalytic/credentials/default");
        }

        return $token;
    }

    /**
     * Fetch the Catalytic token from a named file in ~/.catalytic/credentials/<$fileName>
     *
     * @param string $fileName          The name of the file to fetch the token from
     * @return string                   The Catalytic access token
     * @throws Exception
     */
    private function fromFile(string $fileName)
    {
        $token = $this->fetchTokenFromFile($fileName);

        // If it wasn't found, throw an exception
        if ($token === null) {
            $home = $this->getHomeDir();
            throw new Exception('Cannot find credentials in $CATALYTIC_CREDENTIALS
                environment variable or ' . "$home/.catalytic/credentials/$fileName");
        }

        return $token;
    }

    /**
     * Fetch the token from the env var CATALYTIC_CREDENTIALS
     *
     * @return string   The Catalytic access token
     */
    private function fetchTokenFromEnvVar()
    {
        $token = getenv('CATALYTIC_CREDENTIALS');
        return $token;
    }

    /**
     * Fetch a Catalytic token from a file
     *
     * @param string $fileName (optional)   The name or path to the file to fetch the token from
     * @return string                       The Catalytic access token
     */
    private function fetchTokenFromFile(string $fileName = null)
    {
        // If it's a path to a file
        if (is_file($fileName)) {
            $token = file_get_contents($fileName);
            return $token;
        }

        $home = $this->getHomeDir();

        // If it's only the name of a file
        if ($fileName) {
            $path = "$home/.catalytic/credentials/$fileName";
        } else {
            $path = "$home/.catalytic/credentials/default";
        }
        $token = file_get_contents($path);

        return $token;
    }

    /**
     * Cross platform way of fetching the home dir
     *
     * @return string   The home dir of the user executing the code
     */
    private function getHomeDir()
    {
        $user = posix_getpwuid(posix_getuid());
        $home = $user['dir'];
        return $home;
    }
}