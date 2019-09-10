<?php

namespace SalesForce\MarketingCloud\Authorization;

use Psr\Cache\CacheItemPoolInterface;
use SalesForce\MarketingCloud\Authorization\Client\GenericClient;

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
     * @param GenericClient $client
     */
    public function setClient(GenericClient $client): void;

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