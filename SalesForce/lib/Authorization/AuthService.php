<?php

namespace SalesForce\MarketingCloud\Authorization;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
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
     * The access token retrieved by the client after the authorization
     *
     * @var string
     */
    private $accessToken;

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

    /**
     * Returns the last valid access token
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * Authorizes the client
     *
     * @return void
     * @throws IdentityProviderException
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws IdentityProviderException
     */
    public function authorize(): void
    {
        // First we look into the cache
        $cacheItem = $this->cache->getItem("accessToken");
        if (!$cacheItem->isHit()) {
            $accessToken = $this->client->getAccessToken('client_credentials');

            // Configuring the cache item
            $cacheItem->set($accessToken);
            $cacheItem->expiresAfter($accessToken->getExpires() ?? 0);

            // Saves the cache item
            $this->cache->save($cacheItem);
        } else {
            /** @var AccessTokenInterface $accessToken */
            $accessToken = $cacheItem->get();
        }

        $this->accessToken = $accessToken->getToken();
    }
}