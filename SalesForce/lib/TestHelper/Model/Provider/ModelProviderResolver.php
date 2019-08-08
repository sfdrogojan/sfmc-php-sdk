<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provider;

use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse;

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
        DeleteSendDefinitionResponse::class => CreateEmailDefinitionRequest::class
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

        // Check for aliases
        if (isset(static::$aliases[$modelClass])) {
            $modelClass = static::$aliases[$modelClass];
        }

        // Resolve the model class
        if (!isset(static::$cache[$modelClass])) {
            $className = explode('\\', $modelClass);
            $className = $className[count($className) - 1];
            $className = str_replace(["Create", "Send", "Update", "Delete"], "", $className);
            $className .= "Provider";

            if (class_exists(__NAMESPACE__ . '\\' . $className)) {
                static::$cache[$modelClass] = __NAMESPACE__ . '\\' . $className;
            } else {
                throw new \InvalidArgumentException("Could not find provider class for {$modelClass}");
            }
        }

        return static::$cache[$modelClass];
    }
}