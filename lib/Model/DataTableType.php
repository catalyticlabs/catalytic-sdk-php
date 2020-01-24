<?php
/**
 * DataTableType
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Catalytic SDK API
 *
 * ## API for the Catalytic SDK
 *
 * OpenAPI spec version: v1.0.0
 * Contact: developers@catalytic.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.16
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;
use \Swagger\Client\ObjectSerializer;

/**
 * DataTableType Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
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
self::BATCH,        ];
    }
}
