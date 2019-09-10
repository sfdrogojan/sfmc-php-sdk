<?php

namespace SalesForce\MarketingCloud\Authorization;

use GuzzleHttp\Client as HttpClient;
use SalesForce\MarketingCloud\Authorization\Client\GenericClient as AuthClient;
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
        if (!$container->has("auth.http.client")) {
            $container->set("auth.http.client", new HttpClient());
        }

        // Authentication cache
        if (!$container->has("auth.cache")) {
            $container->register("auth.cache", ArrayAdapter::class);
        }

        // Authentication client
        if (!$container->has("auth.client")) {
            $container
                ->register("auth.client", AuthClient::class)
                ->setArgument("options", $clientOptions)
                ->addMethodCall("setHttpClient", [new Reference("auth.http.client")]);
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