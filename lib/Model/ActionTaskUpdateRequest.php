<?php
/**
 * ActionTaskUpdateRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  Catalytic\Client
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

namespace Catalytic\Client\Model;

use \ArrayAccess;
use \Catalytic\Client\ObjectSerializer;

/**
 * ActionTaskUpdateRequest Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ActionTaskUpdateRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ActionTaskUpdateRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'outputs' => '\Catalytic\Client\Model\ActionOutput[]',
'progress_status' => 'string',
'progress_percent' => 'int',
'lock_duration_seconds' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'outputs' => null,
'progress_status' => null,
'progress_percent' => 'int32',
'lock_duration_seconds' => 'int32'    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'outputs' => 'outputs',
'progress_status' => 'progressStatus',
'progress_percent' => 'progressPercent',
'lock_duration_seconds' => 'lockDurationSeconds'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'outputs' => 'setOutputs',
'progress_status' => 'setProgressStatus',
'progress_percent' => 'setProgressPercent',
'lock_duration_seconds' => 'setLockDurationSeconds'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'outputs' => 'getOutputs',
'progress_status' => 'getProgressStatus',
'progress_percent' => 'getProgressPercent',
'lock_duration_seconds' => 'getLockDurationSeconds'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['outputs'] = isset($data['outputs']) ? $data['outputs'] : null;
        $this->container['progress_status'] = isset($data['progress_status']) ? $data['progress_status'] : null;
        $this->container['progress_percent'] = isset($data['progress_percent']) ? $data['progress_percent'] : null;
        $this->container['lock_duration_seconds'] = isset($data['lock_duration_seconds']) ? $data['lock_duration_seconds'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets outputs
     *
     * @return \Catalytic\Client\Model\ActionOutput[]
     */
    public function getOutputs()
    {
        return $this->container['outputs'];
    }

    /**
     * Sets outputs
     *
     * @param \Catalytic\Client\Model\ActionOutput[] $outputs outputs
     *
     * @return $this
     */
    public function setOutputs($outputs)
    {
        $this->container['outputs'] = $outputs;

        return $this;
    }

    /**
     * Gets progress_status
     *
     * @return string
     */
    public function getProgressStatus()
    {
        return $this->container['progress_status'];
    }

    /**
     * Sets progress_status
     *
     * @param string $progress_status progress_status
     *
     * @return $this
     */
    public function setProgressStatus($progress_status)
    {
        $this->container['progress_status'] = $progress_status;

        return $this;
    }

    /**
     * Gets progress_percent
     *
     * @return int
     */
    public function getProgressPercent()
    {
        return $this->container['progress_percent'];
    }

    /**
     * Sets progress_percent
     *
     * @param int $progress_percent progress_percent
     *
     * @return $this
     */
    public function setProgressPercent($progress_percent)
    {
        $this->container['progress_percent'] = $progress_percent;

        return $this;
    }

    /**
     * Gets lock_duration_seconds
     *
     * @return int
     */
    public function getLockDurationSeconds()
    {
        return $this->container['lock_duration_seconds'];
    }

    /**
     * Sets lock_duration_seconds
     *
     * @param int $lock_duration_seconds lock_duration_seconds
     *
     * @return $this
     */
    public function setLockDurationSeconds($lock_duration_seconds)
    {
        $this->container['lock_duration_seconds'] = $lock_duration_seconds;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
