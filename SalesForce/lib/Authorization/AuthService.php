<?php

namespace SalesForce\MarketingCloud\Authorization;

use SalesForce\MarketingCloud\Cache\CacheAwareInterface;
use Psr\Cache\CacheItemPoolInterface;
use League\OAuth2\Client\Provider\GenericProvider;

/**
 * Class AuthService
 *
 * @package SalesForce\MarketingCloud\Authorization
 */
class AuthService implements CacheAwareInterface, AuthServiceInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var GenericProvider
     */
    private $client;

    /**
     * Sets the cache
     *
     * @param CacheItemPoolInterface $cache
     */
    public function setCache(CacheItemPoolInterface $cache): void
    {
        $this->cache = $cache;
    }

    /**
     * Sets the client used for the authorization
     *
     * @param GenericProvider $client
     */
    public function setClient(GenericProvider $client): void
    {
        $this->client = $client;
    }
}