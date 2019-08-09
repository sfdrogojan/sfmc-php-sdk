<?php

namespace SalesForce\MarketingCloud\Test\Api;

use PHPUnit\Framework\TestCase;
use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\ApiException;
use SalesForce\MarketingCloud\TestHelper\Authorization\AuthServiceTestFactory;
use SalesForce\MarketingCloud\Model\ModelInterface;
use SalesForce\MarketingCloud\TestHelper\Model\Provisioner\AbstractApiProvisioner;
use SalesForce\MarketingCloud\TestHelper\Model\Provisioner\ProvisionerResolver;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\AbstractModelProvider;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\ModelProviderResolver;

/**
 * Abstract class AbstractApiTest
 *
 * @package SalesForce\MarketingCloud\Test\Api
 */
abstract class AbstractApiTest extends TestCase
{
    /**
     * @var string
     */
    protected static $modelNamespace = "";

    /**
     * @var AbstractApi
     */
    protected $client;

    /**
     * @var AbstractApiProvisioner
     */
    private $provisioner;

    /**
     * @var ModelInterface
     */
    private $resource;

    /**
     * @var AbstractModelProvider|string
     */
    private $modelProvider;

    /**
     * @var ModelInterface|string
     */
    private $originalModelClass;

    /**
     * @var string
     */
    private $httpMethod;

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
     * @inheritDoc
     */
    public function tearDown(): void
    {
        // For manual written cases
        if (empty($this->modelProvider)) {
            return;
        }

        if ($this->httpMethod !== "DELETE") {
            call_user_func([$this->createClient(), $this->modelProvider::getApiDeleteMethod()], $this->getResourceId());
        }

        $this->provisioner->deplete($this->resource);
    }

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
        $this->httpMethod = $httpMethod;

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
     * Returns the resource identification info
     *
     * @return mixed
     */
    protected function getResourceId()
    {
        return call_user_func([$this->resource, $this->modelProvider::getModelIdMethod()]);
    }

    /**
     * Tries to guess the model class
     *
     * @param string $clientMethod
     * @return string
     */
    protected static function guessModelClass(string $clientMethod): string
    {
        // Strip the prefix
        $clientMethod = ltrim($clientMethod, "get");
        $clientMethod = ltrim($clientMethod, "create");
        $clientMethod = ltrim($clientMethod, "partiallyUpdate");
        $clientMethod = ltrim($clientMethod, "delete");

        // Strip the suffix
        $clientMethod = rtrim($clientMethod, "ById");

        return static::$modelNamespace . "\\" . ucfirst($clientMethod);
    }

    /**
     * Creates the resource on the API
     *
     * @param string|ModelInterface $modelClass
     * @return void
     */
    protected function createResourceOnEndpoint(string $modelClass): void
    {
        $client = $this->createClient();

        // Creating the provisioner
        $provisioner = ProvisionerResolver::resolve($modelClass);
        $this->provisioner = new $provisioner($client);

        // Store this for later use
        $this->originalModelClass = $modelClass;
        $this->modelProvider = ModelProviderResolver::resolve($modelClass);

        // Setup
        $clientMethod = $this->modelProvider::getApiCreateMethod();
        $model = $this->provisioner->provision($this->modelProvider::createTestModel());

        /** @var ModelInterface $resource */
        $this->resource = call_user_func([$client, $clientMethod], $model->__toString());
    }

    /**
     * Performs the create action for the test
     *
     * @param string $clientMethod
     */
    protected function doCreateAction(string $clientMethod): void
    {
        $this->assertNotEmpty($this->getResourceId());
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
        $resource = call_user_func([$client, $clientMethod], $this->getResourceId());

        $this->assertInstanceOf($this->originalModelClass, $resource);
    }

    /**
     * Performs the PATCH action for the test
     *
     * @param string $clientMethod
     */
    protected function doPatchAction(string $clientMethod): void
    {
        $client = $this->createClient();

        $updatedResource = call_user_func(
            [$client, $clientMethod],
            $this->getResourceId(),
            $this->modelProvider::updateTestModel($this->resource)->__toString()
        );

        $this->assertEquals($this->resource->__toString(), $updatedResource->__toString());
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
        $resourceId = $this->getResourceId();

        call_user_func([$client, $clientMethod], $this->getResourceId()); // DELETE
        call_user_func([$client, $this->modelProvider::getApiGetMethod()], $resourceId); // FETCH to check
    }
}