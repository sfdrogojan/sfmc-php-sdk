<?php

namespace SalesForce\MarketingCloud\Authorization;

use League\OAuth2\Client\Provider\GenericProvider;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class AuthService
 *
 * @package SalesForce\MarketingCloud\Authorization
 */
interface AuthServiceInterface
{
    /**
     * Sets the cache
     *
     * @param CacheItemPoolInterface $cache
     * @return mixed
     */
    public function setCache(CacheItemPoolInterface $cache): void;

    /**
     * Sets the client used for the authorization
     *
     * @param GenericProvider $client
     */
    public function setClient(GenericProvider $client): void;
}