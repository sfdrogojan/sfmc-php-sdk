<?php

namespace SalesForce\MarketingCloud\Test\Api;

use PHPUnit\Framework\TestCase;
use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\ApiException;
use SalesForce\MarketingCloud\Authorization\TestHelper\AuthServiceTestFactory;
use SalesForce\MarketingCloud\Model\Asset;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Abstract class AbstractApiTest
 *
 * @package SalesForce\MarketingCloud\Test\Api
 */
abstract class AbstractApiTest extends TestCase
{
    /**
     * Resource ID to use in the tests after creation
     *
     * @var string
     */
    protected static $resourceId;

    /**
     * The method to use for resource by ID retrieval
     *
     * @var string
     */
    protected $getByIdMethod = "";

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        AuthServiceTestFactory::setConfig([
            'accountId' => getenv('ACCOUNT_ID'),
            'clientId' => getenv('CLIENT_ID'),
            'clientSecret' => getenv('CLIENT_SECRET'),
            'urlAuthorize' => getenv('URL_AUTHORIZE'),
            'urlAccessToken' => getenv('URL_ACCESS_TOKEN'),
        ]);
    }

    /**
     * Creates the required resource
     *
     * @return ModelInterface
     */
    protected abstract function createResource(): ModelInterface;

    /**
     * Updates a given resource
     *
     * @param ModelInterface $resource
     * @return ModelInterface
     */
    protected abstract function updateResource(ModelInterface $resource): ModelInterface;

    /**
     * Creates the client required to do the API calls
     *
     * @return AbstractApi
     */
    protected abstract function createClient(): AbstractApi;

    /**
     * Selects the appropriate action method
     *
     * @param string $httpMethod
     * @return string
     */
    protected function selectActionMethod(string $httpMethod): string
    {
        switch ($httpMethod) {
            case "GET":
                return "doGetAction";

            case "POST":
                return "doCreateAction";

            case "PATCH":
                return "doPatchAction";

            case "DELETE":
                return "doDeleteAction";

            default:
                throw new \InvalidArgumentException("The {$httpMethod} action is not supported");
        }
    }

    /**
     * Performs the create action for the test
     *
     * @param string $clientMethod
     */
    protected function doCreateAction(string $clientMethod): void
    {
        $client = $this->createClient();

        /** @var ModelInterface $resource */
        $resource = call_user_func([$client, $clientMethod], $this->createResource()->__toString());

        static::$resourceId = $resource->getId();

        $this->assertNotEmpty(static::$resourceId);
    }

    /**
     * Performs the retrieve action for the test
     *
     * @param string $clientMethod
     */
    protected function doGetAction(string $clientMethod): void
    {
        $client = $this->createClient();

        /** @var ModelInterface $resource */
        $resource = call_user_func([$client, $clientMethod], static::$resourceId);

        $this->assertInstanceOf(Asset::class, $resource);
    }

    /**
     * Performs the PATCH action for the test
     *
     * @param string $clientMethod
     */
    protected function doPatchAction(string $clientMethod): void
    {
        $client = $this->createClient();

        /** @var ModelInterface $resource */
        $resource = $client->{$this->getByIdMethod}(static::$resourceId);

        $updatedResource = call_user_func(
            [$client, $clientMethod],
            static::$resourceId,
            $this->updateResource($resource)->__toString()
        );

        $this->assertEquals($resource->__toString(), $updatedResource->__toString());
    }

    /**
     * Performs the delete action for the test
     *
     * @param string $clientMethod
     */
    protected function doDeleteAction(string $clientMethod): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(404);

        $client = $this->createClient();
        call_user_func([$client, $clientMethod], static::$resourceId);

        $client->{$this->getByIdMethod}(static::$resourceId);
    }
}