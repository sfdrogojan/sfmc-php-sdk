<?php

namespace SalesForce\MarketingCloud\Authorization;

use Psr\Cache\CacheItemPoolInterface as CacheInterface;
use Psr\SimpleCache\CacheInterface as SimpleCacheInterface;
use Symfony\Component\Cache\Adapter\Psr16Adapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use League\OAuth2\Client\Provider\GenericProvider as AuthClient;

/**
 * Class AuthServiceFactory
 *
 * @package SalesForce\MarketingCloud\Authorization
 */
class AuthServiceFactory
{
    /**
     * @var array
     */
    private static $config = [
        'clientId' => '',
        'clientSecret' => '',
        'redirectUri' => '',
        'urlAuthorize' => '',
        'urlAccessToken' => '',
        'urlResourceOwnerDetails' => ''
    ];

    /**
     * Sets the configuration to be used by the authorization factory
     *
     * @param array $config
     */
    public static function setConfig(array $config): void
    {
        static::$config = array_merge(static::$config, $config);
    }

    /**
     * Creates a new instance of the authorization service
     *
     * @param CacheInterface|null $cache
     * @return AuthServiceInterface
     */
    public static function factory(CacheInterface $cache = null): AuthServiceInterface
    {
        // Default cache scenario
        if (null === $cache) {
            $cache = new Psr16Adapter(static::createDefaultCachePool());
        }

        $service = new AuthService();
        $service->setCache($cache);
        $service->setClient(new AuthClient(static::$config));

        return $service;
    }

    /**
     * Creates a default cache handler
     *
     * @return SimpleCacheInterface
     */
    protected static function createDefaultCachePool(): SimpleCacheInterface
    {
        return new FilesystemAdapter();
    }
}