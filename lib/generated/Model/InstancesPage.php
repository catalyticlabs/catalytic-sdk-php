<?php
/**
 * InstancesPage
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

use \ArrayAccess;
use \Catalytic\SDK\ObjectSerializer;

/**
 * InstancesPage Class Doc Comment
 *
 * @category Class
 * @description A page of Instances returned from a FindAync request
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class InstancesPage implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InstancesPage';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'instances' => '\Catalytic\SDK\Model\Instance[]',
        'nextPageOptions' => '\Catalytic\SDK\Model\PagingOptions',
        'nextPageToken' => 'string',
        'count' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'instances' => null,
        'nextPageOptions' => null,
        'nextPageToken' => null,
        'count' => 'int32'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'instances' => 'instances',
        'nextPageOptions' => 'nextPageOptions',
        'nextPageToken' => 'nextPageToken',
        'count' => 'count'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'instances' => 'setInstances',
        'nextPageOptions' => 'setNextPageOptions',
        'nextPageToken' => 'setNextPageToken',
        'count' => 'setCount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'instances' => 'getInstances',
        'nextPageOptions' => 'getNextPageOptions',
        'nextPageToken' => 'getNextPageToken',
        'count' => 'getCount'
    ];

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
        return self::$openAPIModelName;
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
        $this->container['instances'] = isset($data['instances']) ? $data['instances'] : null;
        $this->container['nextPageOptions'] = isset($data['nextPageOptions']) ? $data['nextPageOptions'] : null;
        $this->container['nextPageToken'] = isset($data['nextPageToken']) ? $data['nextPageToken'] : null;
        $this->container['count'] = isset($data['count']) ? $data['count'] : null;
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
     * Gets instances
     *
     * @return \Catalytic\SDK\Model\Instance[]|null
     */
    public function getInstances()
    {
        return $this->container['instances'];
    }

    /**
     * Sets instances
     *
     * @param \Catalytic\SDK\Model\Instance[]|null $instances The list of Instances
     *
     * @return $this
     */
    public function setInstances($instances)
    {
        $this->container['instances'] = $instances;

        return $this;
    }

    /**
     * Gets nextPageOptions
     *
     * @return \Catalytic\SDK\Model\PagingOptions|null
     */
    public function getNextPageOptions()
    {
        return $this->container['nextPageOptions'];
    }

    /**
     * Sets nextPageOptions
     *
     * @param \Catalytic\SDK\Model\PagingOptions|null $nextPageOptions nextPageOptions
     *
     * @return $this
     */
    public function setNextPageOptions($nextPageOptions)
    {
        $this->container['nextPageOptions'] = $nextPageOptions;

        return $this;
    }

    /**
     * Gets nextPageToken
     *
     * @return string|null
     */
    public function getNextPageToken()
    {
        return $this->container['nextPageToken'];
    }

    /**
     * Sets nextPageToken
     *
     * @param string|null $nextPageToken nextPageToken
     *
     * @return $this
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->container['nextPageToken'] = $nextPageToken;

        return $this;
    }

    /**
     * Gets count
     *
     * @return int|null
     */
    public function getCount()
    {
        return $this->container['count'];
    }

    /**
     * Sets count
     *
     * @param int|null $count count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->container['count'] = $count;

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
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


