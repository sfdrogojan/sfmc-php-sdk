<?php

namespace SalesForce\MarketingCloud\Api\Configuration;

use SalesForce\MarketingCloud\Configuration;

/**
 * Class ConfigFactory
 *
 * @package SalesForce\MarketingCloud\Api\Configuration
 */
final class ConfigFactory
{
    /**
     * Creates the required configuration object
     *
     * @return Configuration
     */
    public static function factory(): Configuration
    {
        return (new Configuration())->setHost(getenv("API_URL"));
    }
}