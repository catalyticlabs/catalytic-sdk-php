<?php
/**
 * FieldType
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
 * The version of the OpenAPI document: v1.0.0
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
 * FieldType Class Doc Comment
 *
 * @category Class
 * @description Represents the types of data that may be stored in Fields.
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class FieldType
{
    /**
     * Possible values of this enum
     */
    const UNDEFINED = 'undefined';
    const TEXT = 'text';
    const INTEGER = 'integer';
    const DECIMAL = 'decimal';
    const DATE = 'date';
    const DATE_TIME = 'dateTime';
    const JSON = 'json';
    const BOOL = 'bool';
    const SINGLE_CHOICE = 'singleChoice';
    const MULTIPLE_CHOICE = 'multipleChoice';
    const INSTRUCTIONS = 'instructions';
    const FILE = 'file';
    const TABLE = 'table';
    const WORKFLOW = 'workflow';
    const INSTANCE = 'instance';
    const USER = 'user';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::UNDEFINED,
            self::TEXT,
            self::INTEGER,
            self::DECIMAL,
            self::DATE,
            self::DATE_TIME,
            self::JSON,
            self::BOOL,
            self::SINGLE_CHOICE,
            self::MULTIPLE_CHOICE,
            self::INSTRUCTIONS,
            self::FILE,
            self::TABLE,
            self::WORKFLOW,
            self::INSTANCE,
            self::USER,
        ];
    }
}


