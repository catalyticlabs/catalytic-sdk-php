<?php

namespace Catalytic\SDK;

use Exception;

/**
 * Class containing various ways of fetching the Catalytic token
 */
class Credentials
{
    /**
     * Fetch the Catalytic token.
     *
     * First tries to fetch the token from the env var $CATALYTIC_CREDENTIALS,
     * then tries to fetch it from ~/.catalytic/credentials/default.
     *
     * @return string   The Catalytic access token
     * @throws Exception
     */
    public static function default()
    {
        // Try to get the token from the env var
        $token = self::fetchTokenFromEnvVar();

        // If it didn't exist, try to get it from the default file
        if (!$token) {
            $token = self::fetchTokenFromFile();
        }

        // If it wasn't found, throw an exception
        if (!$token) {
            $home = self::getHomeDir();
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
    public static function fromFile(string $fileName)
    {
        $token = self::fetchTokenFromFile($fileName);

        // If it wasn't found, throw an exception
        if ($token === null) {
            $home = self::getHomeDir();
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
    private static function fetchTokenFromEnvVar()
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
    private static function fetchTokenFromFile(string $fileName = null)
    {
        // If it's a path to a file
        if (is_file($fileName)) {
            $token = file_get_contents($fileName);
            return $token;
        }

        $home = self::getHomeDir();

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
    private static function getHomeDir()
    {
        $user = posix_getpwuid(posix_getuid());
        $home = $user['dir'];
        return $home;
    }
}