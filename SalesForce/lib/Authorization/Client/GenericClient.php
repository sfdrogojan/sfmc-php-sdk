<?php

namespace SalesForce\MarketingCloud\Authorization\Client;

use GuzzleHttp\Exception\BadResponseException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use SalesForce\MarketingCloud\Authorization\Client\Tool\RequestFactory;

/**
 * Class GenericClient
 *
 * @package SalesForce\MarketingCloud\Authorization\Client
 */
class GenericClient extends GenericProvider
{
    /**
     * @var mixed
     */
    private $lastParsedResponse;

    /**
     * GenericClient constructor.
     *
     * @param array $options
     * @param array $collaborators
     */
    public function __construct(array $options = [], array $collaborators = [])
    {
        // Default request factory
        if (empty($collaborators['requestFactory'])) {
            $collaborators['requestFactory'] = new RequestFactory();
        }

        // Request factory type check
        if (false === $collaborators['requestFactory'] instanceof RequestFactory) {
            throw new \InvalidArgumentException(
                "The request factory must be of type Authorization\Client\Tool\RequestFactory"
            );
        }

        parent::__construct($options, $collaborators);
    }

    /**
     * Sends a request instance and returns a response instance.
     *
     * WARNING: This method does not attempt to catch exceptions caused by HTTP
     * errors! It is recommended to wrap this method in a try/catch block.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function getResponse(RequestInterface $request)
    {
        $this->lastParsedResponse = null; // Reset the last parsed response

        return parent::getResponse($request);
    }

    /**
     * Sends a request and returns the parsed response.
     *
     * @param RequestInterface $request
     * @return mixed
     * @throws IdentityProviderException
     */
    public function getParsedResponse(RequestInterface $request)
    {
        if (null === $this->lastParsedResponse) {
            try {
                $response = $this->getResponse($request);
            } catch (BadResponseException $e) {
                $response = $e->getResponse();
            }

            $this->lastParsedResponse = $this->parseResponse($response);

            $this->checkResponse($response, $this->lastParsedResponse);
        }

        return $this->lastParsedResponse;
    }

    /**
     * Returns the last response that was parsed
     *
     * @return mixed
     */
    public function getLastParsedResponse()
    {
        return $this->lastParsedResponse;
    }
}