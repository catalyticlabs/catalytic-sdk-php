<?php
/**
 * UserSearchClause
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
 * UserSearchClause Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UserSearchClause implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'UserSearchClause';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'and' => '\Catalytic\SDK\Model\UserSearchClause[]',
        'or' => '\Catalytic\SDK\Model\UserSearchClause[]',
        'id' => '\Catalytic\SDK\Model\GuidSearchExpression',
        'email' => '\Catalytic\SDK\Model\StringSearchExpression',
        'fullName' => '\Catalytic\SDK\Model\StringSearchExpression',
        'isTeamAdmin' => '\Catalytic\SDK\Model\BoolSearchExpression',
        'isDeactivated' => '\Catalytic\SDK\Model\BoolSearchExpression',
        'isLockedOut' => '\Catalytic\SDK\Model\BoolSearchExpression',
        'createdDate' => '\Catalytic\SDK\Model\DateTimeSearchExpression'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'and' => null,
        'or' => null,
        'id' => null,
        'email' => null,
        'fullName' => null,
        'isTeamAdmin' => null,
        'isDeactivated' => null,
        'isLockedOut' => null,
        'createdDate' => null
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
        'and' => 'and',
        'or' => 'or',
        'id' => 'id',
        'email' => 'email',
        'fullName' => 'fullName',
        'isTeamAdmin' => 'isTeamAdmin',
        'isDeactivated' => 'isDeactivated',
        'isLockedOut' => 'isLockedOut',
        'createdDate' => 'createdDate'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'and' => 'setAnd',
        'or' => 'setOr',
        'id' => 'setId',
        'email' => 'setEmail',
        'fullName' => 'setFullName',
        'isTeamAdmin' => 'setIsTeamAdmin',
        'isDeactivated' => 'setIsDeactivated',
        'isLockedOut' => 'setIsLockedOut',
        'createdDate' => 'setCreatedDate'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'and' => 'getAnd',
        'or' => 'getOr',
        'id' => 'getId',
        'email' => 'getEmail',
        'fullName' => 'getFullName',
        'isTeamAdmin' => 'getIsTeamAdmin',
        'isDeactivated' => 'getIsDeactivated',
        'isLockedOut' => 'getIsLockedOut',
        'createdDate' => 'getCreatedDate'
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
        $this->container['and'] = isset($data['and']) ? $data['and'] : null;
        $this->container['or'] = isset($data['or']) ? $data['or'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['fullName'] = isset($data['fullName']) ? $data['fullName'] : null;
        $this->container['isTeamAdmin'] = isset($data['isTeamAdmin']) ? $data['isTeamAdmin'] : null;
        $this->container['isDeactivated'] = isset($data['isDeactivated']) ? $data['isDeactivated'] : null;
        $this->container['isLockedOut'] = isset($data['isLockedOut']) ? $data['isLockedOut'] : null;
        $this->container['createdDate'] = isset($data['createdDate']) ? $data['createdDate'] : null;
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
     * Gets and
     *
     * @return \Catalytic\SDK\Model\UserSearchClause[]|null
     */
    public function getAnd()
    {
        return $this->container['and'];
    }

    /**
     * Sets and
     *
     * @param \Catalytic\SDK\Model\UserSearchClause[]|null $and and
     *
     * @return $this
     */
    public function setAnd($and)
    {
        $this->container['and'] = $and;

        return $this;
    }

    /**
     * Gets or
     *
     * @return \Catalytic\SDK\Model\UserSearchClause[]|null
     */
    public function getOr()
    {
        return $this->container['or'];
    }

    /**
     * Sets or
     *
     * @param \Catalytic\SDK\Model\UserSearchClause[]|null $or or
     *
     * @return $this
     */
    public function setOr($or)
    {
        $this->container['or'] = $or;

        return $this;
    }

    /**
     * Gets id
     *
     * @return \Catalytic\SDK\Model\GuidSearchExpression|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param \Catalytic\SDK\Model\GuidSearchExpression|null $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets email
     *
     * @return \Catalytic\SDK\Model\StringSearchExpression|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param \Catalytic\SDK\Model\StringSearchExpression|null $email email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets fullName
     *
     * @return \Catalytic\SDK\Model\StringSearchExpression|null
     */
    public function getFullName()
    {
        return $this->container['fullName'];
    }

    /**
     * Sets fullName
     *
     * @param \Catalytic\SDK\Model\StringSearchExpression|null $fullName fullName
     *
     * @return $this
     */
    public function setFullName($fullName)
    {
        $this->container['fullName'] = $fullName;

        return $this;
    }

    /**
     * Gets isTeamAdmin
     *
     * @return \Catalytic\SDK\Model\BoolSearchExpression|null
     */
    public function getIsTeamAdmin()
    {
        return $this->container['isTeamAdmin'];
    }

    /**
     * Sets isTeamAdmin
     *
     * @param \Catalytic\SDK\Model\BoolSearchExpression|null $isTeamAdmin isTeamAdmin
     *
     * @return $this
     */
    public function setIsTeamAdmin($isTeamAdmin)
    {
        $this->container['isTeamAdmin'] = $isTeamAdmin;

        return $this;
    }

    /**
     * Gets isDeactivated
     *
     * @return \Catalytic\SDK\Model\BoolSearchExpression|null
     */
    public function getIsDeactivated()
    {
        return $this->container['isDeactivated'];
    }

    /**
     * Sets isDeactivated
     *
     * @param \Catalytic\SDK\Model\BoolSearchExpression|null $isDeactivated isDeactivated
     *
     * @return $this
     */
    public function setIsDeactivated($isDeactivated)
    {
        $this->container['isDeactivated'] = $isDeactivated;

        return $this;
    }

    /**
     * Gets isLockedOut
     *
     * @return \Catalytic\SDK\Model\BoolSearchExpression|null
     */
    public function getIsLockedOut()
    {
        return $this->container['isLockedOut'];
    }

    /**
     * Sets isLockedOut
     *
     * @param \Catalytic\SDK\Model\BoolSearchExpression|null $isLockedOut isLockedOut
     *
     * @return $this
     */
    public function setIsLockedOut($isLockedOut)
    {
        $this->container['isLockedOut'] = $isLockedOut;

        return $this;
    }

    /**
     * Gets createdDate
     *
     * @return \Catalytic\SDK\Model\DateTimeSearchExpression|null
     */
    public function getCreatedDate()
    {
        return $this->container['createdDate'];
    }

    /**
     * Sets createdDate
     *
     * @param \Catalytic\SDK\Model\DateTimeSearchExpression|null $createdDate createdDate
     *
     * @return $this
     */
    public function setCreatedDate($createdDate)
    {
        $this->container['createdDate'] = $createdDate;

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


