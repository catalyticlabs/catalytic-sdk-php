<?php
/**
 * DataTableType
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
 * DataTableType Class Doc Comment
 *
 * @category Class
 * @description The type of data table
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DataTableType
{
    /**
     * Possible values of this enum
     */
    const IMPORTED = 'imported';
    const MASTER = 'master';
    const APPLICATION = 'application';
    const INSTANCE = 'instance';
    const BATCH = 'batch';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::IMPORTED,
            self::MASTER,
            self::APPLICATION,
            self::INSTANCE,
            self::BATCH,
        ];
    }
}


