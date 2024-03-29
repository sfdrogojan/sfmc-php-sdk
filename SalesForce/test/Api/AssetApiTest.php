<?php
/**
 * AssetApiTest
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
 * Please update the test case below to test the endpoint.
 */

namespace SalesForce\MarketingCloud\Test\Api;

use SalesForce\MarketingCloud\TestHelper\Api\BaseApiTest;

/**
 * AssetApiTest Class Doc Comment
 *
 * @category Class
 * @package  SalesForce\MarketingCloud
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AssetApiTest extends BaseApiTest
{
    /**
     * The client class to use in order to build the client object
     *
     * @var string
     */
    protected $clientClass = \SalesForce\MarketingCloud\Api\AssetApi::class;

    /**
     * @var string
     */
    protected static $modelNamespace = "\SalesForce\MarketingCloud\Model";

    
    /**
     * Test case for createAsset
     *
     * createAsset.
     * @throws \Exception
     */
    public function testCreateAsset()
    {
        $this->setHttpMethod("POST");

        // Looking for a decorator first
        /** @var \SalesForce\MarketingCloud\TestHelper\Decorator\AssetApiDecorator $decorator */
        $decorator = $this->getDecorator();
        if (method_exists($decorator, "testCreateAsset")) {
            return $decorator->testCreateAsset();
        }
        
        // Setting up the resource creator
        $resourceCreator = $this->getResourceCreator();
        $resourceCreator->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\Asset"
        );

        // SUT
        $this->createResourceOnEndpoint();
        $this->executeOperation("createAsset");
    }
    
    /**
     * Test case for deleteAssetById
     *
     * deleteAssetById.
     * @throws \Exception
     */
    public function testDeleteAssetById()
    {
        $this->setHttpMethod("DELETE");

        // Looking for a decorator first
        /** @var \SalesForce\MarketingCloud\TestHelper\Decorator\AssetApiDecorator $decorator */
        $decorator = $this->getDecorator();
        if (method_exists($decorator, "testDeleteAssetById")) {
            return $decorator->testDeleteAssetById();
        }
        
        // Setting up the resource creator
        $resourceCreator = $this->getResourceCreator();
        $resourceCreator->setModelClass(
            __FUNCTION__,
            ""
        );

        // SUT
        $this->createResourceOnEndpoint();
        $this->executeOperation("deleteAssetById");
    }
    
    /**
     * Test case for getAssetById
     *
     * getAssetById.
     * @throws \Exception
     */
    public function testGetAssetById()
    {
        $this->setHttpMethod("GET");

        // Looking for a decorator first
        /** @var \SalesForce\MarketingCloud\TestHelper\Decorator\AssetApiDecorator $decorator */
        $decorator = $this->getDecorator();
        if (method_exists($decorator, "testGetAssetById")) {
            return $decorator->testGetAssetById();
        }
        
        // Setting up the resource creator
        $resourceCreator = $this->getResourceCreator();
        $resourceCreator->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\Asset"
        );

        // SUT
        $this->createResourceOnEndpoint();
        $this->executeOperation("getAssetById");
    }
    
    /**
     * Test case for partiallyUpdateAssetById
     *
     * partiallyUpdateAssetById.
     * @throws \Exception
     */
    public function testPartiallyUpdateAssetById()
    {
        $this->setHttpMethod("PATCH");

        // Looking for a decorator first
        /** @var \SalesForce\MarketingCloud\TestHelper\Decorator\AssetApiDecorator $decorator */
        $decorator = $this->getDecorator();
        if (method_exists($decorator, "testPartiallyUpdateAssetById")) {
            return $decorator->testPartiallyUpdateAssetById();
        }
        
        // Setting up the resource creator
        $resourceCreator = $this->getResourceCreator();
        $resourceCreator->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\Asset"
        );

        // SUT
        $this->createResourceOnEndpoint();
        $this->executeOperation("partiallyUpdateAssetById");
    }
}
