<?php

namespace SalesForce\MarketingCloud\Authorization;

use Psr\Cache\CacheItemPoolInterface as CacheInterface;
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
        $service = new AuthService();
        $service->setCache($cache ?? static::createDefaultCachePool());
        $service->setClient(new AuthClient(static::$config));

        return $service;
    }

    /**
     * Creates a default cache handler
     *
     * @return CacheInterface
     */
    protected static function createDefaultCachePool(): CacheInterface
    {
        return new FilesystemAdapter();
    }
}