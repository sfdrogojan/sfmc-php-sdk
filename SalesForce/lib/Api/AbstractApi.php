<?php

namespace SalesForce\MarketingCloud\Api;

use SalesForce\MarketingCloud\Api\Exception\ClientUnauthorizedException;
use SalesForce\MarketingCloud\Authorization\AuthServiceFactory;
use SalesForce\MarketingCloud\Authorization\AuthServiceInterface;

/**
 * Class AbstractApi
 *
 * @package SalesForce\MarketingCloud\Api
 */
abstract class AbstractApi
{
    /**
     * @var AuthServiceInterface
     */
    private $authService;
    /**
     * @var callable|\Closure
     */
    private $authServiceCallable;

    /**
     * AbstractApi constructor.
     *
     * @param callable|null $authServiceCallable
     */
    public function __construct(callable $authServiceCallable = null)
    {
        if (null === $authServiceCallable) {
            $authServiceCallable = function () {
                return AuthServiceFactory::factory();
            };
        }

        $this->authServiceCallable = $authServiceCallable;
    }

    /**
     * Lazy load the authorization
     *
     * @return AuthServiceInterface
     */
    protected function getAuthService(): AuthServiceInterface
    {
        if (null === $this->authService) {
            $this->authService = call_user_func($this->authServiceCallable);
        }

        return $this->authService;
    }

    /**
     * Authorize the client and retrieves a valid access token
     *
     * @return string The accessToken for the request
     * @throws ClientUnauthorizedException
     */
    protected function authorizeClient(): string
    {
        // TODO: implement this;

        $accessToken = "";

        if (empty($accessToken)) {
            throw new ClientUnauthorizedException();
        }

        return $accessToken;
    }
}