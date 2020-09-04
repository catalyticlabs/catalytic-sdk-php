<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Exceptions\AccessTokenNotFoundException;
use Catalytic\SDK\Model\FieldUpdateRequest;

class ClientHelpers
{
    // The REST api supports wildcard IntegrationId when fetching an Integration Connection by id
    // https://cloud.google.com/apis/design/design_patterns#list_sub-collections
    const WILDCARD_ID = '-';

    /**
     * Creates a FieldUpdateRequest object for each of the fields
     *
     * @param  array $fields    The fields to create a FieldUpdateRequest for each one
     * @return array            The formatted fields
     */
    public static function formatFields($fields)
    {
        $formattedFields = [];

        // Create a FieldUpdateRequest for each field
        foreach ($fields as $key => $value) {
            $fieldUpdateRequest = new FieldUpdateRequest(array('referenceName' => $key, 'value' => $value));
            array_push($formattedFields, $fieldUpdateRequest);
        }

        return $formattedFields;
    }

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