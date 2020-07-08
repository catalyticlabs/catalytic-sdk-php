<?php

namespace Catalytic\SDK;

use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\Exceptions\AccessTokenNotFoundException;

use Exception;

/**
 * Class containing various ways of fetching the Catalytic token
 */
class Credentials
{
    private $logger;

    /**
     * Constructor which initializes the logger
     */
    public function __construct()
    {
        $this->logger = CatalyticLogger::getLogger(Credentials::class);
    }

    /**
     * Tries to find a token.
     *
     * $tokenOrFile can either be null, the name of a file, or the path to a file.
     *
     * If $tokenOrFile is null, try to find a token in this order:
     *
     * 1. Read $CATALYTIC_TOKEN env var
     * 2. Read ~/.catalytic/tokens/default
     *
     * If $tokenOrFile is not null, try to find a token in this order:
     *
     * 1. Read ~/.catalytic/tokens/$tokenOrFile
     * 2. Read $tokenOrFile as the path to a file
     * 3. Assume it's an actual token that was passed in
     *
     * @param string $tokenOrFile (Optional)    The token, filename, or path to a file for fetching a token
     * @return string|null                      The token if found or null if not found
     */
    public function fetchToken($tokenOrFile = null)
    {
        if ($tokenOrFile === null) {
            return $this->fromDefault();
        } else {
            $token = $this->fromFile($tokenOrFile);

            // If a token was not found in a file, then a token was passed in so use it
            if ($token === null) {
                return $tokenOrFile;
            }
        }
    }

    /**
     * Fetch the Catalytic token.
     *
     * First tries to fetch the token from the env var $CATALYTIC_TOKEN,
     * then tries to fetch it from ~/.catalytic/tokens/default.
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
            $this->logger->debug('Cannot find Access Token in $CATALYTIC_TOKEN
                environment variable or ' . "$home/.catalytic/tokens/default");
            return null;
        }

        return $token;
    }

    /**
     * Fetch the Catalytic token from a named file in ~/.catalytic/tokens/<$fileName>
     *
     * @param string $fileName          The name of the file to fetch the token from
     * @return string                   The Catalytic access token
     * @throws Exception
     */
    private function fromFile($fileName)
    {
        $token = $this->fetchTokenFromFile($fileName);

        // If it wasn't found, return null;
        if ($token === null) {
            $home = $this->getHomeDir();
            $this->logger->debug('Cannot find Access Token in ' . "$home/.catalytic/tokens/$fileName" . "or $fileName");
            return null;
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
        $token = getenv('CATALYTIC_TOKEN');
        return $token;
    }

    /**
     * Fetch a Catalytic token from a file
     *
     * @param string $fileName (optional)   The name or path to the file to fetch the token from
     * @return string                       The Catalytic access token
     */
    private function fetchTokenFromFile($fileName = null)
    {
        // If it's a path to a file
        if (is_file($fileName)) {
            $token = file_get_contents($fileName);
            return $token;
        }

        $home = $this->getHomeDir();

        // If it's only the name of a file
        if ($fileName) {
            $path = "$home/.catalytic/tokens/$fileName";
        } else {
            $path = "$home/.catalytic/tokens/default";
        }

        try {
            $token = file_get_contents($path);
        } catch (Exception $e) {
            // If the file doesn't exist or can't be read, set the token to null
            $this->logger->debug("Cannot find Access Token in $path");
            $token = null;
        }

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