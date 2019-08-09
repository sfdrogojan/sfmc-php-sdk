<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provider;

use SalesForce\MarketingCloud\Model\DeleteQueuedMessagesForSendDefinitionResponse;
use SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse;
use SalesForce\MarketingCloud\Model\GetEmailDefinitionsResponse;
use SalesForce\MarketingCloud\Model\GetSmsDefinitionsResponse;

/**
 * Class ModelProviderResolver
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provider
 */
class ModelProviderResolver
{
    /**
     * Aliased classes to avoid creating a lot of provider classes
     *
     * @var array
     */
    private static $aliases = [
        // Email definition
        GetEmailDefinitionsResponse::class => EmailDefinitionRequestProvider::class,
        DeleteQueuedMessagesForSendDefinitionResponse::class => EmailDefinitionRequestProvider::class,

        // SMS definition
        GetSmsDefinitionsResponse::class => SmsDefinitionRequestProvider::class,
        DeleteSendDefinitionResponse::class => SmsDefinitionRequestProvider::class,
    ];

    /**
     * Cache of model class to provider
     *
     * @var array
     */
    private static $cache = [];

    /**
     * Resolve a model name to a provider
     *
     * @param string $modelClass
     * @return string|AbstractModelProvider
     */
    public static function resolve(string $modelClass): string
    {
        $modelClass = ltrim($modelClass, "\\"); // Fix naming

        // Check for aliases and return directly...no need to put in cache and do the extra processing
        if (isset(static::$aliases[$modelClass])) {
            return static::$aliases[$modelClass];
        }

        // Resolve the model class
        if (!isset(static::$cache[$modelClass])) {
            $matches = [];
            $className = "";

            if (preg_match('/(.*)\\\(Create|Send|Update|Delete)(.*)/', $modelClass, $matches)) {
                $className = $matches[3] . "Provider";
            } else if(preg_match('/(.*)\\\(.*)/', $modelClass, $matches)) {
                $className = $matches[2] . "Provider";
            }

            if (class_exists(__NAMESPACE__ . '\\' . $className)) {
                static::$cache[$modelClass] = __NAMESPACE__ . '\\' . $className;
            } else {
                throw new \InvalidArgumentException("Could not find provider class for {$modelClass}");
            }
        }

        return static::$cache[$modelClass];
    }
}