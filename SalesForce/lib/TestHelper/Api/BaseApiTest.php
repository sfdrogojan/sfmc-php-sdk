<?php

namespace SalesForce\MarketingCloud\TestHelper\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\Api\AssetApi;
use SalesForce\MarketingCloud\Api\CampaignApi;
use SalesForce\MarketingCloud\Api\Configuration\ConfigFactory;
use SalesForce\MarketingCloud\Api\TransactionalMessagingApi;
use SalesForce\MarketingCloud\ApiException;
use SalesForce\MarketingCloud\Configuration;
use SalesForce\MarketingCloud\TestHelper\Authorization\AuthServiceTestFactory;
use SalesForce\MarketingCloud\Model\ModelInterface;
use SalesForce\MarketingCloud\TestHelper\Model\Provisioner\AbstractModelProvisioner;
use SalesForce\MarketingCloud\TestHelper\Model\Provisioner\ProvisionerResolver;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\AbstractModelProvider;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\ModelProviderResolver;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Base class for the unit tests
 *
 * @package SalesForce\MarketingCloud\TestHelper\Api
 */
abstract class BaseApiTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected static $container;

    /**
     * @var string
     */
    protected static $modelNamespace;

    /**
     * The client class to use in order to build the client object
     *
     * @var string
     */
    protected $clientClass;

    /**
     * @var AbstractApi
     */
    private $client;

    /**
     * @var AbstractModelProvisioner
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
     * @var ModelInterface|string
     */
    private $modelClass;

    /**
     * @var string
     */
    private $httpMethod;

    /**
     * @var string
     */
    private $apiMethod;

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        // Configure the authentication service
        AuthServiceTestFactory::setConfig([
            'accountId' => getenv('ACCOUNT_ID'),
            'clientId' => getenv('CLIENT_ID'),
            'clientSecret' => getenv('CLIENT_SECRET'),
            'urlAuthorize' => getenv('URL_AUTHORIZE'),
            'urlAccessToken' => getenv('URL_ACCESS_TOKEN'),
        ]);

        static::setupContainer();
    }

    /**
     * Sets up the container
     *
     * @return void
     */
    private static function setupContainer(): void
    {
        $configRef = new Reference("config");
        $clientRef = new Reference("client");

        // Setup the dependency container
        static::$container = new ContainerBuilder();

        // Register the authentication service
        static::$container->setParameter("auth.service", [AuthServiceTestFactory::class, 'factory']);

        // Sets the client service
        static::$container->set("client", new Client(['verify' => false]));

        // Register the config object
        static::$container->register("config", Configuration::class)
            ->setFactory([ConfigFactory::class, "factory"]);

        // Register the AssetApi service
        foreach ([AssetApi::class, CampaignApi::class, TransactionalMessagingApi::class] as $apiClientClass) {
            static::$container
                ->register($apiClientClass, $apiClientClass)
                ->addArgument("%auth.service%")
                ->addArgument($clientRef)
                ->addArgument($configRef);
        }
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function tearDown(): void
    {
        // For manual written cases
        if (empty($this->modelProvider)) {
            return;
        }

        if ($this->httpMethod !== "DELETE") {
            call_user_func([$this->getClient(), $this->modelProvider::getApiDeleteMethod()], $this->getResourceId());
        }

        $this->provisioner->deplete($this->resource);
    }

    /**
     * Creates the client required to do the API calls
     *
     * @return AbstractApi
     * @throws \Exception
     */
    protected function getClient(): AbstractApi
    {
        if (null === $this->client) {
            $this->client = static::$container->get($this->clientClass);
        }

        return $this->client;
    }

    /**
     * Sets the class of the model in the SUT
     *
     * @param string $invokerMethod
     * @param string|null $modelClass
     */
    protected function setModelClass(string $invokerMethod, ?string $modelClass): void
    {
        $this->apiMethod = lcfirst(ltrim($invokerMethod, "test"));
        $this->originalModelClass = $modelClass;

        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass($this->apiMethod);
        }

        $this->modelClass = $modelClass;
    }

    /**
     * Sets the HTTP method of the test
     *
     * @param string $httpMethod
     */
    public function setHttpMethod(string $httpMethod): void
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * Selects the appropriate action method
     *
     * @param string $httpMethod
     * @param string $operation
     * @return void
     */
    protected function executeOperation(string $httpMethod, string $operation): void
    {
        $methodMap = [
            "GET" => "doGetAction",
            "POST" => "doCreateAction",
            "PATCH" => "doPatchAction",
            "DELETE" => "doDeleteAction",
        ];

        if (!isset($methodMap[$httpMethod])) {
            throw new \InvalidArgumentException("The {$httpMethod} action is not supported");
        }

        $this->httpMethod = $httpMethod;

        call_user_func([$this, $methodMap[$httpMethod]], $operation);
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

        return strval(static::$modelNamespace) . "\\" . ucfirst($clientMethod);
    }

    /**
     * Creates the resource on the API
     *
     * @return void
     * @throws \Exception
     */
    protected function createResourceOnEndpoint(): void
    {
        $client = $this->getClient();

        // Creating the provisioner
        $provisionerClass = ProvisionerResolver::resolve($this->modelClass, $this->apiMethod);
        $this->provisioner = new $provisionerClass();
        if ($this->provisioner instanceof ContainerAwareInterface) {
            $this->provisioner->setContainer(static::$container);
        }

        // Store this for later use
        $this->modelProvider = ModelProviderResolver::resolve($this->modelClass, $this->apiMethod);

        // Setup
        $clientMethod = $this->modelProvider::getApiCreateMethod();
        $model = $this->provisioner->provision($this->modelProvider::getTestModel());

        /** @var ModelInterface $resource */
        $this->resource = call_user_func([$client, $clientMethod], $model);
    }

    /**
     * Performs the create action for the test
     *
     * @param string $clientMethod
     */
    protected function doCreateAction(string $clientMethod): void
    {
        unset($clientMethod); // Avoids IDE errors

        $this->assertNotEmpty($this->getResourceId());
    }

    /**
     * Performs the retrieve action for the test
     *
     * @param string $clientMethod
     * @throws \Exception
     */
    protected function doGetAction(string $clientMethod): void
    {
        $client = $this->getClient();

        /** @var ModelInterface $resource */
        $resource = call_user_func([$client, $clientMethod], $this->getResourceId());

        $this->assertInstanceOf($this->originalModelClass, $resource);
    }

    /**
     * Performs the PATCH action for the test
     *
     * @param string $clientMethod
     * @throws \Exception
     */
    protected function doPatchAction(string $clientMethod): void
    {
        $client = $this->getClient();

        $updatedResource = call_user_func(
            [$client, $clientMethod],
            $this->getResourceId(),
            $this->modelProvider::getPatchedModel($this->resource)
        );

        $this->assertNotEquals($this->resource, $updatedResource);
    }

    /**
     * Performs the delete action for the test
     *
     * @param string $clientMethod
     * @throws \Exception
     */
    protected function doDeleteAction(string $clientMethod): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(404);

        $client = $this->getClient();
        $resourceId = $this->getResourceId();

        call_user_func([$client, $clientMethod], $this->getResourceId()); // DELETE
        call_user_func([$client, $this->modelProvider::getApiGetMethod()], $resourceId); // FETCH to check
    }
}