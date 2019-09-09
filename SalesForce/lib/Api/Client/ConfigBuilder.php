<?php

namespace SalesForce\MarketingCloud\Api\Client;

use SalesForce\MarketingCloud\Api\Client;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ConfigBuilder
 *
 * @package SalesForce\MarketingCloud\Api\Client
 *
 * @method self setAccountId(string $accountId)
 * @method self setClientId(string $clientId)
 * @method self setClientSecret(string $clientSecret)
 * @method self setUrlAuthorize(string $urlAuthorize)
 * @method self setUrlAccessToken(string $urlAccessToken)
 * @method self setUrlResourceOwnerDetails(string $urlResourceOwnerDetails)
 */
class ConfigBuilder
{
    /**
     * Stores the container builder required to create the APIs
     *
     * @var ContainerBuilder
     */
    private $container;

    /**
     * ConfigBuilder constructor.
     *
     * @param ContainerBuilder $container
     */
    public function __construct(ContainerBuilder $container = null)
    {
        $this->container = $container ?? new ContainerBuilder();

        // Set default config
        if (!$this->container->hasParameter("auth.client.options")) {
            $this->container->setParameter("auth.client.options", [
                'accountId' => getenv('ACCOUNT_ID'),
                'clientId' => getenv('CLIENT_ID'),
                'clientSecret' => getenv('CLIENT_SECRET'),
                'urlAuthorize' => getenv('URL_AUTHORIZE'),
                'urlAccessToken' => getenv('URL_ACCESS_TOKEN'),
                'urlResourceOwnerDetails' => ''
            ]);
        }
    }

    /**
     * Used to set the config
     *
     * @param string $name
     * @param array $arguments
     * @return self
     */
    public function __call(string $name, array $arguments): self
    {
        // Get the options
        $options = $this->container->getParameter("auth.client.options");

        // Update the option only if it was set by default
        $optionName = lcfirst(ltrim($name, "set"));
        if (isset($options[$optionName])) {
            $options[$optionName] = trim(strval($arguments[0]));
        }

        // Update the options
        $this->container->setParameter("auth.client.options", $options);

        return $this;
    }

    /**
     * Returns the container object
     *
     * @return ContainerBuilder
     */
    public function getContainer(): ContainerBuilder
    {
        return $this->container;
    }
}