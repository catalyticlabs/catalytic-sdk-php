<?php
/**
 * Field
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
 * Field Class Doc Comment
 *
 * @category Class
 * @description Represents a named and typed variable within a Workflow or Instance
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Field implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Field';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'referenceName' => 'string',
        'description' => 'string',
        'example' => 'string',
        'position' => 'int',
        'display' => '\Catalytic\SDK\Model\FieldDisplayOptions',
        'fieldType' => '\Catalytic\SDK\Model\FieldType',
        'value' => 'string',
        'templateValue' => 'string',
        'defaultValue' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => 'uuid',
        'name' => null,
        'referenceName' => null,
        'description' => null,
        'example' => null,
        'position' => 'int32',
        'display' => null,
        'fieldType' => null,
        'value' => null,
        'templateValue' => null,
        'defaultValue' => null
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
        'name' => 'name',
        'referenceName' => 'referenceName',
        'description' => 'description',
        'example' => 'example',
        'position' => 'position',
        'display' => 'display',
        'fieldType' => 'fieldType',
        'value' => 'value',
        'templateValue' => 'templateValue',
        'defaultValue' => 'defaultValue'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'referenceName' => 'setReferenceName',
        'description' => 'setDescription',
        'example' => 'setExample',
        'position' => 'setPosition',
        'display' => 'setDisplay',
        'fieldType' => 'setFieldType',
        'value' => 'setValue',
        'templateValue' => 'setTemplateValue',
        'defaultValue' => 'setDefaultValue'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'referenceName' => 'getReferenceName',
        'description' => 'getDescription',
        'example' => 'getExample',
        'position' => 'getPosition',
        'display' => 'getDisplay',
        'fieldType' => 'getFieldType',
        'value' => 'getValue',
        'templateValue' => 'getTemplateValue',
        'defaultValue' => 'getDefaultValue'
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['referenceName'] = isset($data['referenceName']) ? $data['referenceName'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['example'] = isset($data['example']) ? $data['example'] : null;
        $this->container['position'] = isset($data['position']) ? $data['position'] : null;
        $this->container['display'] = isset($data['display']) ? $data['display'] : null;
        $this->container['fieldType'] = isset($data['fieldType']) ? $data['fieldType'] : null;
        $this->container['value'] = isset($data['value']) ? $data['value'] : null;
        $this->container['templateValue'] = isset($data['templateValue']) ? $data['templateValue'] : null;
        $this->container['defaultValue'] = isset($data['defaultValue']) ? $data['defaultValue'] : null;
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id The unique ID of the field
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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
     * @param string|null $name The descriptive name of the Field
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets referenceName
     *
     * @return string|null
     */
    public function getReferenceName()
    {
        return $this->container['referenceName'];
    }

    /**
     * Sets referenceName
     *
     * @param string|null $referenceName A unique name (within the scope of the Workflow or Instance) that  can be used to reference the value of this field in  a template or operation.
     *
     * @return $this
     */
    public function setReferenceName($referenceName)
    {
        $this->container['referenceName'] = $referenceName;

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
     * @param string|null $description A description of this field. This can be used as instructions   for users filling out this field in a form
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets example
     *
     * @return string|null
     */
    public function getExample()
    {
        return $this->container['example'];
    }

    /**
     * Sets example
     *
     * @param string|null $example An example of possible values for this field.
     *
     * @return $this
     */
    public function setExample($example)
    {
        $this->container['example'] = $example;

        return $this;
    }

    /**
     * Gets position
     *
     * @return int|null
     */
    public function getPosition()
    {
        return $this->container['position'];
    }

    /**
     * Sets position
     *
     * @param int|null $position The visual position of this field relative others in the same scope
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->container['position'] = $position;

        return $this;
    }

    /**
     * Gets display
     *
     * @return \Catalytic\SDK\Model\FieldDisplayOptions|null
     */
    public function getDisplay()
    {
        return $this->container['display'];
    }

    /**
     * Sets display
     *
     * @param \Catalytic\SDK\Model\FieldDisplayOptions|null $display display
     *
     * @return $this
     */
    public function setDisplay($display)
    {
        $this->container['display'] = $display;

        return $this;
    }

    /**
     * Gets fieldType
     *
     * @return \Catalytic\SDK\Model\FieldType|null
     */
    public function getFieldType()
    {
        return $this->container['fieldType'];
    }

    /**
     * Sets fieldType
     *
     * @param \Catalytic\SDK\Model\FieldType|null $fieldType fieldType
     *
     * @return $this
     */
    public function setFieldType($fieldType)
    {
        $this->container['fieldType'] = $fieldType;

        return $this;
    }

    /**
     * Gets value
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->container['value'];
    }

    /**
     * Sets value
     *
     * @param string|null $value The value of this field, serialized as a string
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->container['value'] = $value;

        return $this;
    }

    /**
     * Gets templateValue
     *
     * @return string|null
     */
    public function getTemplateValue()
    {
        return $this->container['templateValue'];
    }

    /**
     * Sets templateValue
     *
     * @param string|null $templateValue The template expression that will become the field value  once it is evaluated
     *
     * @return $this
     */
    public function setTemplateValue($templateValue)
    {
        $this->container['templateValue'] = $templateValue;

        return $this;
    }

    /**
     * Gets defaultValue
     *
     * @return string|null
     */
    public function getDefaultValue()
    {
        return $this->container['defaultValue'];
    }

    /**
     * Sets defaultValue
     *
     * @param string|null $defaultValue The optional default value of this field, serialized as a string. The   serialization format depends on the type of field.
     *
     * @return $this
     */
    public function setDefaultValue($defaultValue)
    {
        $this->container['defaultValue'] = $defaultValue;

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


