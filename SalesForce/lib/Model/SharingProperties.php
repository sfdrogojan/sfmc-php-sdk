<?php
/**
 * SharingProperties
 *
 * PHP version 5
 *
 * @category Class
 * @package  SalesForce\MarketingCloud
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Marketing Cloud REST API
 *
 * Marketing Cloud's REST API is our newest API. It supports multi-channel use cases, is much more lightweight and easy to use than our SOAP API, and is getting more comprehensive with every release.
 *
 * OpenAPI spec version: 1.0.0
 * Contact: mc_sdk@salesforce.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.7
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SalesForce\MarketingCloud\Model;

use \ArrayAccess;
use \SalesForce\MarketingCloud\ObjectSerializer;

/**
 * SharingProperties Class Doc Comment
 *
 * @category Class
 * @package  SalesForce\MarketingCloud
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SharingProperties implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SharingProperties';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'sharingType' => 'string',
        'sharedWith' => 'int[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'sharingType' => null,
        'sharedWith' => null
    ];

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
        'sharingType' => 'sharingType',
        'sharedWith' => 'sharedWith'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'sharingType' => 'setSharingType',
        'sharedWith' => 'setSharedWith'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'sharingType' => 'getSharingType',
        'sharedWith' => 'getSharedWith'
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
        return self::$swaggerModelName;
    }

    const SHARING_TYPE_VIEW = 'view';
    const SHARING_TYPE_EDIT = 'edit';
    const SHARING_TYPE_LOCAL = 'local';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSharingTypeAllowableValues()
    {
        return [
            self::SHARING_TYPE_VIEW,
            self::SHARING_TYPE_EDIT,
            self::SHARING_TYPE_LOCAL,
        ];
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
        $this->container['sharingType'] = isset($data['sharingType']) ? $data['sharingType'] : null;
        $this->container['sharedWith'] = isset($data['sharedWith']) ? $data['sharedWith'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getSharingTypeAllowableValues();
        if (!is_null($this->container['sharingType']) && !in_array($this->container['sharingType'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'sharingType', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets sharingType
     *
     * @return string
     */
    public function getSharingType()
    {
        return $this->container['sharingType'];
    }

    /**
     * Sets sharingType
     *
     * @param string $sharingType Indicates the permission that you are granting to the list of MIDs in sharedWith. Possible values are view, edit, or local.
     *
     * @return $this
     */
    public function setSharingType($sharingType)
    {
        $allowedValues = $this->getSharingTypeAllowableValues();
        if (!is_null($sharingType) && !in_array($sharingType, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'sharingType', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['sharingType'] = $sharingType;

        return $this;
    }

    /**
     * Gets sharedWith
     *
     * @return int[]
     */
    public function getSharedWith()
    {
        return $this->container['sharedWith'];
    }

    /**
     * Sets sharedWith
     *
     * @param int[] $sharedWith List of MID IDs the asset is shared with
     *
     * @return $this
     */
    public function setSharedWith($sharedWith)
    {
        $this->container['sharedWith'] = $sharedWith;

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


