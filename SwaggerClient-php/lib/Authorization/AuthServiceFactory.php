<?php

namespace SalesForce\MarketingCloud\PHPSDK\Authorization;

use Psr\Cache\CacheItemPoolInterface as CacheInterface;
use Psr\SimpleCache\CacheInterface as SimpleCacheInterface;
use Symfony\Component\Cache\Adapter\Psr16Adapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use League\OAuth2\Client\Provider\GenericProvider as AuthClient;

/**
 * Class AuthServiceFactory
 *
 * @package SalesForce\MarketingCloud\PHPSDK\Authorization
 */
class AuthServiceFactory
{
    /**
     * Creates a new instance of the authorization service
     *
     * @param array $clientConfig
     * @param CacheInterface|null $cache
     */
    public static function factory(array $clientConfig, CacheInterface $cache = null)
    {
        // Default cache scenario
        if (null === $cache) {
            $cache = new Psr16Adapter(static::createDefaultCachePool());
        }

        $service = new AuthService();
        $service->setCache($cache);
        $service->setClient($client);
    }

    /**
     * Creates a default cache handler
     *
     * @return SimpleCacheInterface
     */
    private static function createDefaultCachePool(): SimpleCacheInterface
    {
        return new FilesystemAdapter();
    }

    /**
     * Creates the client used for authorization
     *
     * @param array $config
     * @return AuthClient
     */
    private static function createAuthClient(array $config): AuthClient
    {
        $config = array_merge([
            'clientId' => 'XXXXXX',    // The client ID assigned to you by the provider
            'clientSecret' => 'XXXXXX',    // The client password assigned to you by the provider
            'redirectUri' => 'http://my.example.com/your-redirect-url/',
            'urlAuthorize' => 'http://service.example.com/authorize',
            'urlAccessToken' => 'http://service.example.com/token',
            'urlResourceOwnerDetails' => 'http://service.example.com/resource'
        ], $config);

        return new AuthClient($config);
    }
}