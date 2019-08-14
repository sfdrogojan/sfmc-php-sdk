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
     * Setup the container to create the object
     *
     * @param ContainerBuilder|null $container
     * @return ContainerBuilder $container
     */
    public static function execute(ContainerBuilder $container = null): ContainerBuilder
    {
        $clientOptions = $container->getParameter("auth.client.options");

        // HTTP client
        if (!$container->has("http.client.adapter")) {
            $container->set("http.client.adapter", new Client());
        }

        // Authentication cache
        if (!$container->has("auth.cache")) {
            $container->register("auth.cache", ArrayAdapter::class);
        }

        // Authentication client
        if (!$container->has("auth.client")) {
            $container
                ->register("auth.client", GenericProvider::class)
                ->setArgument("options", $clientOptions)
                ->addMethodCall("setHttpClient", [new Reference("http.client.adapter")]);
        }

        // Authentication service
        $container
            ->register(AuthService::CONTAINER_ID, AuthService::class)
            ->addMethodCall("setCache", [new Reference("auth.cache")])
            ->addMethodCall("setCacheKey", [$clientOptions["clientId"] . $clientOptions["accountId"]])
            ->addMethodCall("setClient", [new Reference("auth.client")]);

        return $container;
    }
}