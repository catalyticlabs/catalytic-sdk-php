<?php
/**
 * FieldVisibility
 *
 * PHP version 5
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Catalytic SDK API
 *
 * ## API for the Catalytic SDK
 *
 * The version of the OpenAPI document: 2.0.0
 * Contact: developers@catalytic.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Catalytic\SDK\Model;
use \Catalytic\SDK\ObjectSerializer;

/**
 * FieldVisibility Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FieldVisibility
{
    /**
     * Possible values of this enum
     */
    const _PUBLIC = 'public';
    const INTERNAL = 'internal';
    const CONFIDENTIAL = 'confidential';
    const HIGHLY_CONFIDENTIAL = 'highlyConfidential';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::_PUBLIC,
            self::INTERNAL,
            self::CONFIDENTIAL,
            self::HIGHLY_CONFIDENTIAL,
        ];
    }
}


