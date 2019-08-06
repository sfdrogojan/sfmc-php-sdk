<?php

namespace SalesForce\MarketingCloud\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use SalesForce\MarketingCloud\Api\Exception\ClientUnauthorizedException;
use SalesForce\MarketingCloud\Authorization\AuthServiceFactory;
use SalesForce\MarketingCloud\Authorization\AuthServiceInterface;
use SalesForce\MarketingCloud\Configuration;
use SalesForce\MarketingCloud\HeaderSelector;

/**
 * Class AbstractApi
 *
 * @package SalesForce\MarketingCloud\Api
 */
abstract class AbstractApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var AuthServiceInterface
     */
    private $authService;
    /**
     * @var callable|\Closure
     */
    private $authServiceCallable;

    /**
     * @param callable $authServiceCallable
     * @param ClientInterface $client
     * @param Configuration $config
     * @param HeaderSelector $selector
     */
    public function __construct(
        callable $authServiceCallable = null,
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        // Default callable
        if (null === $authServiceCallable) {
            $authServiceCallable = array(AuthServiceFactory::class, "factory");
        }

        // Setting the properties
        $this->authServiceCallable = $authServiceCallable;
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * Returns the client's configuration
     *
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Lazy load the authorization
     *
     * @return AuthServiceInterface
     */
    protected function getAuthService(): AuthServiceInterface
    {
        if (null === $this->authService) {
            $this->authService = call_user_func($this->authServiceCallable);
        }

        return $this->authService;
    }

    /**
     * Create http client option
     *
     * @return array of http client options
     * @throws \RuntimeException on file opening failure
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    /**
     * Authorize the client and retrieves a valid access token
     *
     * @throws ClientUnauthorizedException
     */
    protected function authorizeClient(): void
    {
        // TODO: implement this;

        $accessToken = "";

        if (empty($accessToken)) {
            throw new ClientUnauthorizedException();
        }

        $this->config->setAccessToken($accessToken);
    }
}