<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Exceptions\AccessTokenNotFoundException;

class ClientHelpers
{
    /**
     * Verifies that the passed in $token is not null
     *
     * @param string $token             The token to verify is not null
     * @throws AccessNotFoundException  If the token is null
     */
    public static function verifyAccessTokenExists($token) {
        if ($token === null) {
            throw new AccessTokenNotFoundException("Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()");
        }
    }

    /**
     * Trims the token if it's a string. If it's null don't trim it or it gets cast to an empty string
     *
     * @param string $token The token to trim if not null
     * @return string|null  The trimmed string or null
     */
    public static function trimIfString($value)
    {
        return is_string($value) ? trim($value) : $value;
    }
}