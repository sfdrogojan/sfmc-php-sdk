<?php

namespace SalesForce\MarketingCloud\PHPSDK\Authorization;

use SalesForce\MarketingCloud\PHPSDK\Cache\CacheAwareInterface;
use Psr\Cache\CacheItemPoolInterface;
use League\OAuth2\Client\Provider\GenericProvider;

/**
 * Class AuthService
 *
 * @package SalesForce\MarketingCloud\PHPSDK\Authorization
 */
class AuthService implements CacheAwareInterface
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
     * @return mixed
     */
    public function setCache(CacheItemPoolInterface $cache)
    {
        // TODO: Implement setCacheItemPool() method.
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