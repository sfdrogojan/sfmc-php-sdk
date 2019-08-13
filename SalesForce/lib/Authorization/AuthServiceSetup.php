<?php

namespace SalesForce\MarketingCloud\Authorization;

use GuzzleHttp\Client;
use League\OAuth2\Client\Provider\GenericProvider;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AuthServiceFactory
 *
 * @package SalesForce\MarketingCloud\Authorization
 */
class AuthServiceSetup
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * AuthServiceFactory constructor.
     *
     * @param ContainerBuilder $container
     * @param array|null $clientOptions
     */
    public function __construct(ContainerBuilder $container = null, array $clientOptions = array())
    {
        // Container create
        $this->container = $container ?? new ContainerBuilder();

        // Authentication client options
        if (!$this->container->hasParameter("auth.client.options")) {
            $this->container->setParameter("auth.client.options", array_merge([
                'accountId' => getenv('ACCOUNT_ID'),
                'clientId' => getenv('CLIENT_ID'),
                'clientSecret' => getenv('CLIENT_SECRET'),
                'urlAuthorize' => getenv('URL_AUTHORIZE'),
                'urlAccessToken' => getenv('URL_ACCESS_TOKEN'),
                'urlResourceOwnerDetails' => ''
            ], $clientOptions));
        }
    }

    /**
     * Setup the container to create the object
     *
     * @return AuthServiceSetup
     */
    public function run(): AuthServiceSetup
    {
        // HTTP client
        if (!$this->container->has("http.client.adapter")) {
            $this->container->set("http.client.adapter", new Client());
        }

        // Authentication cache
        if (!$this->container->has("auth.cache")) {
            $this->container->register("auth.cache", ArrayAdapter::class);
        }

        // Authentication client
        if (!$this->container->has("auth.client")) {
            $this->container
                ->register("auth.client", GenericProvider::class)
                ->setArgument("options", "%auth.client.options%")
                ->addMethodCall("setHttpClient", [new Reference("http.client.adapter")]);
        }

        // Authentication service
        $this->container
            ->register(AuthService::CONTAINER_ID, AuthService::class)
            ->addMethodCall("setCache", [new Reference("auth.cache")])
            ->addMethodCall("setCacheKey", [getenv('CLIENT_ID') . getenv('ACCOUNT_ID')])
            ->addMethodCall("setClient", [new Reference("auth.client")]);

        return $this;
    }

    /**
     * Retrieves the configured container
     *
     * @return ContainerBuilder
     */
    public function getContainer(): ContainerBuilder
    {
        return $this->container;
    }
}