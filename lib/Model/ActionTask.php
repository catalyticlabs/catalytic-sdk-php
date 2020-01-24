<?php
/**
 * ActionTask
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

use \ArrayAccess;
use \Swagger\Client\ObjectSerializer;

/**
 * ActionTask Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ActionTask implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ActionTask';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'inputs' => '\Swagger\Client\Model\ActionInput[]',
'outputs' => '\Swagger\Client\Model\ActionOutput[]',
'id' => 'string',
'team_name' => 'string',
'required_worker_tags' => 'string[]',
'action_id' => 'string',
'lock_request_id' => 'string',
'action_worker_id' => 'string',
'progress_percent' => 'int',
'progress_status' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'inputs' => null,
'outputs' => null,
'id' => 'uuid',
'team_name' => null,
'required_worker_tags' => null,
'action_id' => 'uuid',
'lock_request_id' => 'uuid',
'action_worker_id' => 'uuid',
'progress_percent' => 'int32',
'progress_status' => null    ];

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
        'inputs' => 'inputs',
'outputs' => 'outputs',
'id' => 'id',
'team_name' => 'teamName',
'required_worker_tags' => 'requiredWorkerTags',
'action_id' => 'actionId',
'lock_request_id' => 'lockRequestId',
'action_worker_id' => 'actionWorkerId',
'progress_percent' => 'progressPercent',
'progress_status' => 'progressStatus'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'inputs' => 'setInputs',
'outputs' => 'setOutputs',
'id' => 'setId',
'team_name' => 'setTeamName',
'required_worker_tags' => 'setRequiredWorkerTags',
'action_id' => 'setActionId',
'lock_request_id' => 'setLockRequestId',
'action_worker_id' => 'setActionWorkerId',
'progress_percent' => 'setProgressPercent',
'progress_status' => 'setProgressStatus'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'inputs' => 'getInputs',
'outputs' => 'getOutputs',
'id' => 'getId',
'team_name' => 'getTeamName',
'required_worker_tags' => 'getRequiredWorkerTags',
'action_id' => 'getActionId',
'lock_request_id' => 'getLockRequestId',
'action_worker_id' => 'getActionWorkerId',
'progress_percent' => 'getProgressPercent',
'progress_status' => 'getProgressStatus'    ];

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
        $this->container['inputs'] = isset($data['inputs']) ? $data['inputs'] : null;
        $this->container['outputs'] = isset($data['outputs']) ? $data['outputs'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['team_name'] = isset($data['team_name']) ? $data['team_name'] : null;
        $this->container['required_worker_tags'] = isset($data['required_worker_tags']) ? $data['required_worker_tags'] : null;
        $this->container['action_id'] = isset($data['action_id']) ? $data['action_id'] : null;
        $this->container['lock_request_id'] = isset($data['lock_request_id']) ? $data['lock_request_id'] : null;
        $this->container['action_worker_id'] = isset($data['action_worker_id']) ? $data['action_worker_id'] : null;
        $this->container['progress_percent'] = isset($data['progress_percent']) ? $data['progress_percent'] : null;
        $this->container['progress_status'] = isset($data['progress_status']) ? $data['progress_status'] : null;
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
     * Gets inputs
     *
     * @return \Swagger\Client\Model\ActionInput[]
     */
    public function getInputs()
    {
        return $this->container['inputs'];
    }

    /**
     * Sets inputs
     *
     * @param \Swagger\Client\Model\ActionInput[] $inputs inputs
     *
     * @return $this
     */
    public function setInputs($inputs)
    {
        $this->container['inputs'] = $inputs;

        return $this;
    }

    /**
     * Gets outputs
     *
     * @return \Swagger\Client\Model\ActionOutput[]
     */
    public function getOutputs()
    {
        return $this->container['outputs'];
    }

    /**
     * Sets outputs
     *
     * @param \Swagger\Client\Model\ActionOutput[] $outputs outputs
     *
     * @return $this
     */
    public function setOutputs($outputs)
    {
        $this->container['outputs'] = $outputs;

        return $this;
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
     * Gets team_name
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->container['team_name'];
    }

    /**
     * Sets team_name
     *
     * @param string $team_name team_name
     *
     * @return $this
     */
    public function setTeamName($team_name)
    {
        $this->container['team_name'] = $team_name;

        return $this;
    }

    /**
     * Gets required_worker_tags
     *
     * @return string[]
     */
    public function getRequiredWorkerTags()
    {
        return $this->container['required_worker_tags'];
    }

    /**
     * Sets required_worker_tags
     *
     * @param string[] $required_worker_tags required_worker_tags
     *
     * @return $this
     */
    public function setRequiredWorkerTags($required_worker_tags)
    {
        $this->container['required_worker_tags'] = $required_worker_tags;

        return $this;
    }

    /**
     * Gets action_id
     *
     * @return string
     */
    public function getActionId()
    {
        return $this->container['action_id'];
    }

    /**
     * Sets action_id
     *
     * @param string $action_id action_id
     *
     * @return $this
     */
    public function setActionId($action_id)
    {
        $this->container['action_id'] = $action_id;

        return $this;
    }

    /**
     * Gets lock_request_id
     *
     * @return string
     */
    public function getLockRequestId()
    {
        return $this->container['lock_request_id'];
    }

    /**
     * Sets lock_request_id
     *
     * @param string $lock_request_id lock_request_id
     *
     * @return $this
     */
    public function setLockRequestId($lock_request_id)
    {
        $this->container['lock_request_id'] = $lock_request_id;

        return $this;
    }

    /**
     * Gets action_worker_id
     *
     * @return string
     */
    public function getActionWorkerId()
    {
        return $this->container['action_worker_id'];
    }

    /**
     * Sets action_worker_id
     *
     * @param string $action_worker_id action_worker_id
     *
     * @return $this
     */
    public function setActionWorkerId($action_worker_id)
    {
        $this->container['action_worker_id'] = $action_worker_id;

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
