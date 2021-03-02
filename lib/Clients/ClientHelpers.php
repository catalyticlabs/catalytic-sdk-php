<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Exceptions\AccessTokenNotFoundException;
use Catalytic\SDK\Model\FieldUpdateRequest;
use Catalytic\SDK\Model\{
    BoolSearchExpression as InternalBooleanSearchExpression,
    GuidSearchExpression as InternalGuidSearchExpression,
    StringSearchExpression as InternalStringSearchExpression,
    DateTimeSearchExpression as InternalDateTimeSearchExpression,
    StringRange as InternalStringRange,
    DateTimeOffsetNullableRange as InternalDateTimeRange
};
use Catalytic\SDK\Search\{
    BooleanSearchExpression,
    GuidSearchExpression,
    StringSearchExpression,
    DateTimeSearchExpression,
    StringRange,
    DateTimeRange
};

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

    /**
     * Create an internal GuidSearchExpression from an external GuidSearchExpression
     *
     * @param   GuidSearchExpression $searchExpression  The external GuidSearchExpression to create an internal one from
     * @return  InternalGuidSearchExpression            An internal GuidSearchExpression
     */
    public static function createInternalGuidSearchExpression (?GuidSearchExpression $searchExpression): ?InternalGuidSearchExpression
    {
        $internalGuidSearchExpression = null;

        if ($searchExpression !== null) {
            $internalGuidSearchExpression = new InternalGuidSearchExpression(
                array('isEqualTo' => $searchExpression->getIsEqualTo())
            );
        }

        return $internalGuidSearchExpression;
    }

    /**
     * Create an internal StringSearchExpression from an external StringSearchExpression
     *
     * @param   StringSearchExpression $searchExpression  The external StringSearchExpression to create an internal one from
     * @return  InternalStringSearchExpression            An internal StringSearchExpression
     */
    public static function createInternalStringSearchExpression(?StringSearchExpression $searchExpression): ?InternalStringSearchExpression
    {
        $internalStringSearchExpression = null;

        if ($searchExpression !== null) {
            $internalBetween = self::createInternalStringRange($searchExpression->getBetween());
            $internalStringSearchExpression = new InternalStringSearchExpression(
                array(
                    'isEqualTo' => $searchExpression->getIsEqualTo(),
                    'contains' => $searchExpression->getContains(),
                    'between' => $internalBetween
                )
            );
        }

        return $internalStringSearchExpression;
    }

    /**
     * Create an internal BooleanSearchExpression from an external BooleanSearchExpression
     *
     * @param   BooleanSearchExpression $searchExpression  The external BooleanSearchExpression to create an internal one from
     * @return  InternalBooleanSearchExpression            An internal BooleanSearchExpression
     */
    public static function createInternalBooleanSearchExpression(?BooleanSearchExpression $searchExpression): ?InternalBooleanSearchExpression
    {
        $internalBooleanSearchExpression = null;

        if ($searchExpression !== null) {
            $internalBooleanSearchExpression = new InternalBooleanSearchExpression(
                array('isEqualTo' => $searchExpression->getIsEqualTo())
            );
        }

        return $internalBooleanSearchExpression;
    }

    /**
     * Create an internal DateTimeSearchExpression from an external DateTimeSearchExpression
     *
     * @param   DateTimeSearchExpression $searchExpression  The external DateTimeSearchExpression to create an internal one from
     * @return  InternalDateTimeSearchExpression            An internal DateTimeSearchExpression
     */
    public static function createInternalDateTimeSearchExpression(?DateTimeSearchExpression $searchExpression): ?InternalDateTimeSearchExpression
    {
        $internalDateTimeSearchExpression = null;

        if ($searchExpression !== null) {
            $internalBetween = self::createInternalDateTimeRange($searchExpression->getBetween());
            $internalDateTimeSearchExpression = new InternalDateTimeSearchExpression(
                array(
                    'isEqualTo' => $searchExpression->getIsEqualTo(),
                    'between' => $internalBetween
                )
            );
        }

        return $internalDateTimeSearchExpression;
    }

    /**
     * Create an internal StringRange form an external one
     *
     * @param   StringRange $stringRange    The external StringRange to create an internal one from
     * @return  InternalStringRange         An internal StringRange
     */
    private static function createInternalStringRange(?StringRange $stringRange): ?InternalStringRange
    {
        $internalStringRange = null;

        if ($stringRange !== null) {
            $internalStringRange = new InternalStringRange(
                array(
                    'lowerBoundInclusive' => $stringRange->getLowerBoundInclusive(),
                    'upperBoundInclusive' => $stringRange->getUpperBoundInclusive()
                )
            );
        }

        return $internalStringRange;
    }

    /**
     * Create an internal DateTimeRange form an external one
     *
     * @param   DateTimeRange $dateTimeRange    The external DateTimeRange to create an internal one from
     * @return  InternalDateTimeRange           An internal DateTimeRange
     */
    private static function createInternalDateTimeRange(?DateTimeRange $dateTimeRange): ?InternalDateTimeRange
    {
        $internalDateTimeRange = null;

        if ($dateTimeRange !== null
        ) {
            $internalDateTimeRange = new InternalDateTimeRange(
                array(
                    'lowerBoundInclusive' => $dateTimeRange->getLowerBoundInclusive(),
                    'upperBoundInclusive' => $dateTimeRange->getUpperBoundInclusive()
                )
            );
        }

        return $internalDateTimeRange;
    }

    // TODO: DateTimeSearchExpression
}