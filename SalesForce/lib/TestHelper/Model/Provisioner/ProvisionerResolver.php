<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provisioner;

use SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse;
use SalesForce\MarketingCloud\Model\GetEmailDefinitionsResponse;

/**
 * Class ProvisionerResolver
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provisioner
 */
class ProvisionerResolver
{
    /**
     * Aliased classes to avoid creating a lot of providers
     *
     * @var array
     */
    private static $aliases = [
        // Email definition
        GetEmailDefinitionsResponse::class => EmailDefinitionRequest::class,

        // SMS definition
        DeleteSendDefinitionResponse::class => SmsDefinitionRequest::class,
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

        // Check for aliases and return directly...no need to put in cache and do the extra processing
        if (isset(static::$aliases[$modelClass])) {
            return static::$aliases[$modelClass];
        }

        // Resolve the model class
        if (!isset(static::$cache[$modelClass])) {
            $matches = [];
            $className = "";

            if (preg_match('/(.*)\\\(Create|Send|Update|Delete)(.*)/', $modelClass, $matches)) {
                $className = $matches[3];
            }

            if (class_exists(__NAMESPACE__ . '\\' . $className)) {
                static::$cache[$modelClass] = __NAMESPACE__ . '\\' . $className;
            } else {
                static::$cache[$modelClass] = NullProvisioner::class;
            }
        }

        return static::$cache[$modelClass];
    }
}