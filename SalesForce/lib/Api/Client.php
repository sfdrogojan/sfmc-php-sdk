<?php

namespace SalesForce\MarketingCloud\Api;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use SalesForce\MarketingCloud\Configuration;
use SalesForce\MarketingCloud\Authorization\AuthServiceSetup;
use SalesForce\MarketingCloud\Authorization\AuthService;

/**
 * Class Client
 *
 * NOTE: This class is auto generated
 *
 * @package SalesForce\MarketingCloud\Api
 * @method self setAccountId(string $accountId)
 * @method self setClientId(string $clientId)
 * @method self setClientSecret(string $clientSecret)
 * @method self setUrlAuthorize(string $urlAuthorize)
 * @method self setUrlAccessToken(string $urlAccessToken)
 * @method self setUrlResourceOwnerDetails(string $urlResourceOwnerDetails)
 */
class Client
{
    const API_VERSION = "1.0.0";

    # List of available clients
    const CLIENT_ASSET_API = \SalesForce\MarketingCloud\Api\AssetApi::class;
    const CLIENT_CAMPAIGN_API = \SalesForce\MarketingCloud\Api\CampaignApi::class;
    const CLIENT_TRANSACTIONAL_MESSAGING_API = \SalesForce\MarketingCloud\Api\TransactionalMessagingApi::class;

    /**
     * Stores the container builder required to create the APIs
     *
     * @var ContainerBuilder
     */
    private $container;

    /**
     * Client constructor.
     *
     * @param ContainerBuilder|null $container
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

        if (!$this->container->hasParameter("api.baseUrl")) {
            $this->setApiUrl(getenv("API_URL"));
        }
    }

    /**
     * Just a helper object but all the config will be set in the container
     *
     * @return self
     */
    public function getConfig(): self
    {
        return $this;
    }

    /**
     * Sets the API Url configuration
     *
     * @param string $url
     * @return self
     */
    public function setApiUrl(string $url): self
    {
        $this->container->setParameter("api.baseUrl", $url);

        return $this;
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
     * Creates/retrieves the requested client object
     *
     * @param string $class
     * @return AbstractApi|AssetApi|CampaignApi|TransactionalMessagingApi
     * @throws \Exception
     */
    public function getClient(string $class): \SalesForce\MarketingCloud\Api\AbstractApi
    {
        if (!$this->container->has($class)) {
            /** @var \GuzzleHttp\Client $httpClient */
            $httpClient = $this->container->get("auth.http.client");

            // Auth container will not be preset in the container at first load
            if (!$this->container->has(AuthService::CONTAINER_ID)) {
                AuthServiceSetup::execute($this->container); // Sets the service AuthService::CONTAINER_ID
            }

            /** @var AuthService $authService */
            $authService = $this->container->get(AuthService::CONTAINER_ID);

            $this->container->set($class, new $class(
                $authService,
                $httpClient,
                (new Configuration())->setHost($this->container->getParameter("api.baseUrl"))
            ));
        }

        /** @var \SalesForce\MarketingCloud\Api\AbstractApi $client */
        $client = $this->container->get($class);

        return $client;
    }

    /**
     * Creates a new AssetApi object
     *
     * @return AssetApi
     * @throws \Exception
     */
    public function getAssetApi(): \SalesForce\MarketingCloud\Api\AssetApi
    {
        return $this->getClient(self::CLIENT_ASSET_API);
    }

    /**
     * Creates a new CampaignApi object
     *
     * @return CampaignApi
     * @throws \Exception
     */
    public function getCampaignApi(): \SalesForce\MarketingCloud\Api\CampaignApi
    {
        return $this->getClient(self::CLIENT_CAMPAIGN_API);
    }

    /**
     * Creates a new TransactionalMessagingApi object
     *
     * @return TransactionalMessagingApi
     * @throws \Exception
     */
    public function getTransactionalMessagingApi(): \SalesForce\MarketingCloud\Api\TransactionalMessagingApi
    {
        return $this->getClient(self::CLIENT_TRANSACTIONAL_MESSAGING_API);
    }

}
