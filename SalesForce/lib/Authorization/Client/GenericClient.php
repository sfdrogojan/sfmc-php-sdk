<?php

namespace SalesForce\MarketingCloud\Authorization\Client;

use League\OAuth2\Client\Provider\GenericProvider;
use SalesForce\MarketingCloud\Authorization\Client\Tool\RequestFactory;

/**
 * Class GenericClient
 *
 * @package SalesForce\MarketingCloud\Authorization\Client
 */
class GenericClient extends GenericProvider
{
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
}