<?php

namespace SalesForce\MarketingCloud\Authorization\TestHelper;

use GuzzleHttp\Client;
use League\OAuth2\Client\Provider\GenericProvider as AuthClient;
use SalesForce\MarketingCloud\Authorization\AuthServiceFactory;

/**
 * Class AuthServiceTestFactory
 *
 * @package SalesForce\MarketingCloud\Authorization\TestHelper
 */
class AuthServiceTestFactory extends AuthServiceFactory
{
    /**
     * @inheritDoc
     */
    protected static function createAuthClient(): AuthClient
    {
        return new AuthClient(static::$config, [
            'httpClient' => new Client([
                'verify' => false
            ])
        ]);
    }

}