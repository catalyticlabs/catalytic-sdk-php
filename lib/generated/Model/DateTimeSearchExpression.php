<?php
/**
 * DateTimeSearchExpression
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

use \ArrayAccess;
use \Catalytic\SDK\ObjectSerializer;

/**
 * DateTimeSearchExpression Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DateTimeSearchExpression implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'DateTimeSearchExpression';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'between' => '\Catalytic\SDK\Model\DateTimeOffsetNullableRange',
        'contains' => '\DateTime',
        'isEqualTo' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'between' => null,
        'contains' => 'date-time',
        'isEqualTo' => 'date-time'
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
        'between' => 'between',
        'contains' => 'contains',
        'isEqualTo' => 'isEqualTo'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'between' => 'setBetween',
        'contains' => 'setContains',
        'isEqualTo' => 'setIsEqualTo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'between' => 'getBetween',
        'contains' => 'getContains',
        'isEqualTo' => 'getIsEqualTo'
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
        $this->container['between'] = isset($data['between']) ? $data['between'] : null;
        $this->container['contains'] = isset($data['contains']) ? $data['contains'] : null;
        $this->container['isEqualTo'] = isset($data['isEqualTo']) ? $data['isEqualTo'] : null;
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
     * Gets between
     *
     * @return \Catalytic\SDK\Model\DateTimeOffsetNullableRange|null
     */
    public function getBetween()
    {
        return $this->container['between'];
    }

    /**
     * Sets between
     *
     * @param \Catalytic\SDK\Model\DateTimeOffsetNullableRange|null $between between
     *
     * @return $this
     */
    public function setBetween($between)
    {
        $this->container['between'] = $between;

        return $this;
    }

    /**
     * Gets contains
     *
     * @return \DateTime|null
     */
    public function getContains()
    {
        return $this->container['contains'];
    }

    /**
     * Sets contains
     *
     * @param \DateTime|null $contains contains
     *
     * @return $this
     */
    public function setContains($contains)
    {
        $this->container['contains'] = $contains;

        return $this;
    }

    /**
     * Gets isEqualTo
     *
     * @return \DateTime|null
     */
    public function getIsEqualTo()
    {
        return $this->container['isEqualTo'];
    }

    /**
     * Sets isEqualTo
     *
     * @param \DateTime|null $isEqualTo isEqualTo
     *
     * @return $this
     */
    public function setIsEqualTo($isEqualTo)
    {
        $this->container['isEqualTo'] = $isEqualTo;

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


