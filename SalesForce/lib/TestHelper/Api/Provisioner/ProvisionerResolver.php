<?php

namespace SalesForce\MarketingCloud\TestHelper\Api\Provisioner;

use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest;
use SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse;

/**
 * Class ProvisionerResolver
 *
 * @package SalesForce\MarketingCloud\TestHelper\Api\Provisioner
 */
class ProvisionerResolver
{
    /**
     * Aliased classes to avoid creating a lot of providers
     *
     * @var array
     */
    private static $aliases = [
        DeleteSendDefinitionResponse::class => CreateEmailDefinitionRequest::class
    ];

    /**
     * List of class to provisioner
     *
     * @var array
     */
    private static $cache = [];

    /**
     * Resolve a model name to a provisioner
     *
     * @param string $modelClass
     * @return string
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

            if (class_exists(__NAMESPACE__ . '\\' . $className)) {
                static::$cache[$modelClass] = __NAMESPACE__ . '\\' . $className;
            } else {
                static::$cache[$modelClass] = NullProvisioner::class;
            }
        }

        return static::$cache[$modelClass];
    }
}