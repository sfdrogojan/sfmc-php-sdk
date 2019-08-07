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

    /**
     * Set the type of grant type for the authorization server
     *
     * @param string $grantType
     */
    public function setGrantType(string $grantType): void;

    /**
     * Performs the authorization process
     *
     * @return AuthServiceInterface
     */
    public function authorize(): AuthServiceInterface;

    /**
     * Returns a valid access token that was obtain via the call to authorize()
     *
     * @return string
     */
    public function getAccessToken(): string;
}