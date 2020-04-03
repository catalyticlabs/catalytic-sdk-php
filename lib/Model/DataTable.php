<?php
/**
 * DataTable
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
 * DataTable Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DataTable implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'DataTable';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'dataTableId' => 'string',
        'referenceName' => 'string',
        'name' => 'string',
        'teamName' => 'string',
        'description' => 'string',
        'columns' => '\Catalytic\SDK\Model\DataTableColumn[]',
        'isArchived' => 'bool',
        'type' => '\Catalytic\SDK\Model\DataTableType',
        'visibility' => '\Catalytic\SDK\Model\TableVisibility',
        'visibleToUsers' => 'string[]',
        'rowLimit' => 'int',
        'columnLimit' => 'int',
        'cellLimit' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => 'uuid',
        'dataTableId' => 'uuid',
        'referenceName' => null,
        'name' => null,
        'teamName' => null,
        'description' => null,
        'columns' => null,
        'isArchived' => null,
        'type' => null,
        'visibility' => null,
        'visibleToUsers' => null,
        'rowLimit' => 'int32',
        'columnLimit' => 'int32',
        'cellLimit' => 'int32'
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
        'dataTableId' => 'dataTableId',
        'referenceName' => 'referenceName',
        'name' => 'name',
        'teamName' => 'teamName',
        'description' => 'description',
        'columns' => 'columns',
        'isArchived' => 'isArchived',
        'type' => 'type',
        'visibility' => 'visibility',
        'visibleToUsers' => 'visibleToUsers',
        'rowLimit' => 'rowLimit',
        'columnLimit' => 'columnLimit',
        'cellLimit' => 'cellLimit'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'dataTableId' => 'setDataTableId',
        'referenceName' => 'setReferenceName',
        'name' => 'setName',
        'teamName' => 'setTeamName',
        'description' => 'setDescription',
        'columns' => 'setColumns',
        'isArchived' => 'setIsArchived',
        'type' => 'setType',
        'visibility' => 'setVisibility',
        'visibleToUsers' => 'setVisibleToUsers',
        'rowLimit' => 'setRowLimit',
        'columnLimit' => 'setColumnLimit',
        'cellLimit' => 'setCellLimit'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'dataTableId' => 'getDataTableId',
        'referenceName' => 'getReferenceName',
        'name' => 'getName',
        'teamName' => 'getTeamName',
        'description' => 'getDescription',
        'columns' => 'getColumns',
        'isArchived' => 'getIsArchived',
        'type' => 'getType',
        'visibility' => 'getVisibility',
        'visibleToUsers' => 'getVisibleToUsers',
        'rowLimit' => 'getRowLimit',
        'columnLimit' => 'getColumnLimit',
        'cellLimit' => 'getCellLimit'
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
        $this->container['dataTableId'] = isset($data['dataTableId']) ? $data['dataTableId'] : null;
        $this->container['referenceName'] = isset($data['referenceName']) ? $data['referenceName'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['teamName'] = isset($data['teamName']) ? $data['teamName'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['columns'] = isset($data['columns']) ? $data['columns'] : null;
        $this->container['isArchived'] = isset($data['isArchived']) ? $data['isArchived'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['visibility'] = isset($data['visibility']) ? $data['visibility'] : null;
        $this->container['visibleToUsers'] = isset($data['visibleToUsers']) ? $data['visibleToUsers'] : null;
        $this->container['rowLimit'] = isset($data['rowLimit']) ? $data['rowLimit'] : null;
        $this->container['columnLimit'] = isset($data['columnLimit']) ? $data['columnLimit'] : null;
        $this->container['cellLimit'] = isset($data['cellLimit']) ? $data['cellLimit'] : null;
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
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
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
     * Gets dataTableId
     *
     * @return string|null
     */
    public function getDataTableId()
    {
        return $this->container['dataTableId'];
    }

    /**
     * Sets dataTableId
     *
     * @param string|null $dataTableId dataTableId
     *
     * @return $this
     */
    public function setDataTableId($dataTableId)
    {
        $this->container['dataTableId'] = $dataTableId;

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
     * @param string|null $referenceName referenceName
     *
     * @return $this
     */
    public function setReferenceName($referenceName)
    {
        $this->container['referenceName'] = $referenceName;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
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
     * Gets columns
     *
     * @return \Catalytic\SDK\Model\DataTableColumn[]|null
     */
    public function getColumns()
    {
        return $this->container['columns'];
    }

    /**
     * Sets columns
     *
     * @param \Catalytic\SDK\Model\DataTableColumn[]|null $columns columns
     *
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->container['columns'] = $columns;

        return $this;
    }

    /**
     * Gets isArchived
     *
     * @return bool|null
     */
    public function getIsArchived()
    {
        return $this->container['isArchived'];
    }

    /**
     * Sets isArchived
     *
     * @param bool|null $isArchived isArchived
     *
     * @return $this
     */
    public function setIsArchived($isArchived)
    {
        $this->container['isArchived'] = $isArchived;

        return $this;
    }

    /**
     * Gets type
     *
     * @return \Catalytic\SDK\Model\DataTableType|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \Catalytic\SDK\Model\DataTableType|null $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return \Catalytic\SDK\Model\TableVisibility|null
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param \Catalytic\SDK\Model\TableVisibility|null $visibility visibility
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
     * Gets rowLimit
     *
     * @return int|null
     */
    public function getRowLimit()
    {
        return $this->container['rowLimit'];
    }

    /**
     * Sets rowLimit
     *
     * @param int|null $rowLimit rowLimit
     *
     * @return $this
     */
    public function setRowLimit($rowLimit)
    {
        $this->container['rowLimit'] = $rowLimit;

        return $this;
    }

    /**
     * Gets columnLimit
     *
     * @return int|null
     */
    public function getColumnLimit()
    {
        return $this->container['columnLimit'];
    }

    /**
     * Sets columnLimit
     *
     * @param int|null $columnLimit columnLimit
     *
     * @return $this
     */
    public function setColumnLimit($columnLimit)
    {
        $this->container['columnLimit'] = $columnLimit;

        return $this;
    }

    /**
     * Gets cellLimit
     *
     * @return int|null
     */
    public function getCellLimit()
    {
        return $this->container['cellLimit'];
    }

    /**
     * Sets cellLimit
     *
     * @param int|null $cellLimit cellLimit
     *
     * @return $this
     */
    public function setCellLimit($cellLimit)
    {
        $this->container['cellLimit'] = $cellLimit;

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


