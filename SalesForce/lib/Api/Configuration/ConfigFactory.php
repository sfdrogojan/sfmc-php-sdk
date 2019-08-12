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
    public static function factory(): Configuration
    {
        return (new Configuration())->setHost(getenv("API_URL"));
    }
}