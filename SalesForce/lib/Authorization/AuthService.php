<?php

namespace SalesForce\MarketingCloud\Authorization;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use SalesForce\MarketingCloud\Authorization\Client\GenericClient;
use SalesForce\MarketingCloud\Cache\CacheAwareInterface;
use Psr\Cache\CacheItemPoolInterface;
use SalesForce\MarketingCloud\Event\AuthSuccessEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class AuthService
 *
 * @package SalesForce\MarketingCloud\Authorization
 */
class AuthService implements CacheAwareInterface, AuthServiceInterface
{
    const CONTAINER_ID = "auth.service";

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var string
     */
    private $cacheKey = 'access_token';

    /**
     * @var GenericClient
     */
    private $client;

    /**
     * @var string
     */
    private $grantType = 'client_credentials';

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

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
     * Sets the cache key to be used when caching the accessToken
     *
     * @param string $cacheKey
     */
    public function setCacheKey(string $cacheKey): void
    {
        $this->cacheKey = $cacheKey;
    }

    /**
     * Sets the client used for the authorization
     *
     * @param GenericClient $client
     */
    public function setClient(GenericClient $client): void
    {
        $this->client = $client;
    }

    /**
     * @param string $grantType
     */
    public function setGrantType(string $grantType): void
    {
        $this->grantType = $grantType;
    }

    /**
     * @return EventDispatcher
     */
    public function getEventDispatcher(): EventDispatcher
    {
        if (null === $this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher();
        }

        return $this->eventDispatcher;
    }

    /**
     * @param EventDispatcher $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Authorizes the client
     *
     * @return AuthServiceInterface
     * @throws IdentityProviderException
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws IdentityProviderException
     * @throws \Exception
     */
    public function authorize(): AuthServiceInterface
    {
        // First we look into the cache
        $cacheItem = $this->cache->getItem($this->cacheKey);
        if (!$cacheItem->isHit()) {
            $accessToken = $this->client->getAccessToken($this->grantType);
            $response = $this->client->getLastParsedResponse();

            $dateTime = new \DateTime();
            $dateTime->setTimestamp($accessToken->getExpires());
            $dateTime->modify("-30 seconds");

            // Configuring the cache item
            $cacheItem->set($accessToken);
            $cacheItem->expiresAt($dateTime);

            // Saves the cache item
            $this->cache->save($cacheItem);

            $event = new AuthSuccessEvent();
            $event->setAccessToken($accessToken);
            $event->setRestInstanceUrl($response["rest_instance_url"]);

            // Dispatch the event
            $this->getEventDispatcher()->dispatch($event, AuthSuccessEvent::NAME);
        }

        return $this;
    }

    /**
     * Returns the access token
     *
     * @return string
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws Exception\TokenExpiredException
     */
    public function getAccessToken(): string
    {
        $cacheItem = $this->cache->getItem($this->cacheKey);
        if ($cacheItem->isHit()) {
            /** @var AccessTokenInterface $accessToken */
            $accessToken = $cacheItem->get();

            return $accessToken->getToken();
        }

        throw new Exception\TokenExpiredException('The access token has expired');
    }
}