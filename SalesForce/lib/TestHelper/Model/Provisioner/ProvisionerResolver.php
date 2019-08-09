<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provisioner;

use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest;
use SalesForce\MarketingCloud\Model\DeleteQueuedMessagesForSendDefinitionResponse;
use SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse;
use SalesForce\MarketingCloud\Model\GetEmailDefinitionsResponse;
use SalesForce\MarketingCloud\Model\GetQueueMetricsForSendDefinitionResponse;
use SalesForce\MarketingCloud\Model\GetSmsDefinitionsResponse;

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
        "email" => [
            // Email definition
            CreateEmailDefinitionRequest::class => EmailDefinitionRequest::class,
            GetEmailDefinitionsResponse::class => EmailDefinitionRequest::class,
            GetQueueMetricsForSendDefinitionResponse::class => EmailDefinitionRequest::class,
            DeleteSendDefinitionResponse::class => EmailDefinitionRequest::class,
            DeleteQueuedMessagesForSendDefinitionResponse::class => QueuedMessagesForEmailDefinitionResponse::class,
        ],
        "sms" => [
            // SMS definition
            CreateSmsDefinitionRequest::class => SmsDefinitionRequest::class,
            GetSmsDefinitionsResponse::class => SmsDefinitionRequest::class,
            GetQueueMetricsForSendDefinitionResponse::class => SmsDefinitionRequest::class,
            DeleteSendDefinitionResponse::class => SmsDefinitionRequest::class,
            DeleteQueuedMessagesForSendDefinitionResponse::class => QueuedMessagesForSmsDefinitionResponse::class,
        ],
        "other" => []
    ];

    /**
     * List of class to provisioner
     *
     * @var array
     */
    private static $cache = [];

    /**
     * Returns the corresponding alias list based on the API method that is being tested
     *
     * @param string $apiMethod
     * @return string
     */
    private static function getAliasList(string $apiMethod)
    {
        $matches = [];
        if (preg_match("/(sms|email)/i", $apiMethod, $matches)) {
            return static::$aliases[strtolower($matches[0])];
        }

        return static::$aliases["other"];
    }

    /**
     * Resolve a model name to a provisioner
     *
     * @param string $modelClass
     * @param string $apiMethod
     * @return string
     */
    public static function resolve(string $modelClass, string $apiMethod): string
    {
        $modelClass = ltrim($modelClass, "\\"); // Fix naming

        // Check for aliases and return directly...no need to put in cache and do the extra processing
        $aliases = static::getAliasList($apiMethod);
        if (isset($aliases[$modelClass])) {
            return $aliases[$modelClass];
        }

        // Resolve the model class
        if (!isset(static::$cache[$modelClass])) {
            $matches = [];
            $className = "";

            if (preg_match('/(.*)\\\(Create|Send|Update|Delete)(.*)/', $modelClass, $matches)) {
                $className = $matches[3];
            } else {
                if (preg_match('/(.*)\\\(.*)/', $modelClass, $matches)) {
                    $className = $matches[2];
                }
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