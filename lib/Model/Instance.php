<?php
/**
 * Instance
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
 * OpenAPI Generator version: 4.2.3
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
 * Instance Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Instance implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Instance';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'pushbotId' => 'string',
        'name' => 'string',
        'teamName' => 'string',
        'description' => 'string',
        'category' => 'string',
        'owner' => 'string',
        'createdBy' => 'string',
        'steps' => '\Catalytic\SDK\Model\InstanceStep[]',
        'fields' => '\Catalytic\SDK\Model\Field[]',
        'status' => '\Catalytic\SDK\Model\InstanceStatus',
        'fieldVisibility' => '\Catalytic\SDK\Model\FieldVisibility',
        'visibility' => '\Catalytic\SDK\Model\InstanceVisibilty',
        'visibleToUsers' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => 'uuid',
        'pushbotId' => 'uuid',
        'name' => null,
        'teamName' => null,
        'description' => null,
        'category' => null,
        'owner' => null,
        'createdBy' => null,
        'steps' => null,
        'fields' => null,
        'status' => null,
        'fieldVisibility' => null,
        'visibility' => null,
        'visibleToUsers' => null
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
        'id' => 'id',
        'pushbotId' => 'pushbotId',
        'name' => 'name',
        'teamName' => 'teamName',
        'description' => 'description',
        'category' => 'category',
        'owner' => 'owner',
        'createdBy' => 'createdBy',
        'steps' => 'steps',
        'fields' => 'fields',
        'status' => 'status',
        'fieldVisibility' => 'fieldVisibility',
        'visibility' => 'visibility',
        'visibleToUsers' => 'visibleToUsers'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'pushbotId' => 'setPushbotId',
        'name' => 'setName',
        'teamName' => 'setTeamName',
        'description' => 'setDescription',
        'category' => 'setCategory',
        'owner' => 'setOwner',
        'createdBy' => 'setCreatedBy',
        'steps' => 'setSteps',
        'fields' => 'setFields',
        'status' => 'setStatus',
        'fieldVisibility' => 'setFieldVisibility',
        'visibility' => 'setVisibility',
        'visibleToUsers' => 'setVisibleToUsers'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'pushbotId' => 'getPushbotId',
        'name' => 'getName',
        'teamName' => 'getTeamName',
        'description' => 'getDescription',
        'category' => 'getCategory',
        'owner' => 'getOwner',
        'createdBy' => 'getCreatedBy',
        'steps' => 'getSteps',
        'fields' => 'getFields',
        'status' => 'getStatus',
        'fieldVisibility' => 'getFieldVisibility',
        'visibility' => 'getVisibility',
        'visibleToUsers' => 'getVisibleToUsers'
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['pushbotId'] = isset($data['pushbotId']) ? $data['pushbotId'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['teamName'] = isset($data['teamName']) ? $data['teamName'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['owner'] = isset($data['owner']) ? $data['owner'] : null;
        $this->container['createdBy'] = isset($data['createdBy']) ? $data['createdBy'] : null;
        $this->container['steps'] = isset($data['steps']) ? $data['steps'] : null;
        $this->container['fields'] = isset($data['fields']) ? $data['fields'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['fieldVisibility'] = isset($data['fieldVisibility']) ? $data['fieldVisibility'] : null;
        $this->container['visibility'] = isset($data['visibility']) ? $data['visibility'] : null;
        $this->container['visibleToUsers'] = isset($data['visibleToUsers']) ? $data['visibleToUsers'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['pushbotId'] === null) {
            $invalidProperties[] = "'pushbotId' can't be null";
        }
        if ($this->container['teamName'] === null) {
            $invalidProperties[] = "'teamName' can't be null";
        }
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
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets pushbotId
     *
     * @return string
     */
    public function getPushbotId()
    {
        return $this->container['pushbotId'];
    }

    /**
     * Sets pushbotId
     *
     * @param string $pushbotId pushbotId
     *
     * @return $this
     */
    public function setPushbotId($pushbotId)
    {
        $this->container['pushbotId'] = $pushbotId;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets teamName
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->container['teamName'];
    }

    /**
     * Sets teamName
     *
     * @param string $teamName teamName
     *
     * @return $this
     */
    public function setTeamName($teamName)
    {
        $this->container['teamName'] = $teamName;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets category
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string|null $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets owner
     *
     * @return string|null
     */
    public function getOwner()
    {
        return $this->container['owner'];
    }

    /**
     * Sets owner
     *
     * @param string|null $owner owner
     *
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->container['owner'] = $owner;

        return $this;
    }

    /**
     * Gets createdBy
     *
     * @return string|null
     */
    public function getCreatedBy()
    {
        return $this->container['createdBy'];
    }

    /**
     * Sets createdBy
     *
     * @param string|null $createdBy createdBy
     *
     * @return $this
     */
    public function setCreatedBy($createdBy)
    {
        $this->container['createdBy'] = $createdBy;

        return $this;
    }

    /**
     * Gets steps
     *
     * @return \Catalytic\SDK\Model\InstanceStep[]|null
     */
    public function getSteps()
    {
        return $this->container['steps'];
    }

    /**
     * Sets steps
     *
     * @param \Catalytic\SDK\Model\InstanceStep[]|null $steps steps
     *
     * @return $this
     */
    public function setSteps($steps)
    {
        $this->container['steps'] = $steps;

        return $this;
    }

    /**
     * Gets fields
     *
     * @return \Catalytic\SDK\Model\Field[]|null
     */
    public function getFields()
    {
        return $this->container['fields'];
    }

    /**
     * Sets fields
     *
     * @param \Catalytic\SDK\Model\Field[]|null $fields fields
     *
     * @return $this
     */
    public function setFields($fields)
    {
        $this->container['fields'] = $fields;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \Catalytic\SDK\Model\InstanceStatus|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \Catalytic\SDK\Model\InstanceStatus|null $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets fieldVisibility
     *
     * @return \Catalytic\SDK\Model\FieldVisibility|null
     */
    public function getFieldVisibility()
    {
        return $this->container['fieldVisibility'];
    }

    /**
     * Sets fieldVisibility
     *
     * @param \Catalytic\SDK\Model\FieldVisibility|null $fieldVisibility fieldVisibility
     *
     * @return $this
     */
    public function setFieldVisibility($fieldVisibility)
    {
        $this->container['fieldVisibility'] = $fieldVisibility;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return \Catalytic\SDK\Model\InstanceVisibilty|null
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param \Catalytic\SDK\Model\InstanceVisibilty|null $visibility visibility
     *
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets visibleToUsers
     *
     * @return string[]|null
     */
    public function getVisibleToUsers()
    {
        return $this->container['visibleToUsers'];
    }

    /**
     * Sets visibleToUsers
     *
     * @param string[]|null $visibleToUsers visibleToUsers
     *
     * @return $this
     */
    public function setVisibleToUsers($visibleToUsers)
    {
        $this->container['visibleToUsers'] = $visibleToUsers;

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


