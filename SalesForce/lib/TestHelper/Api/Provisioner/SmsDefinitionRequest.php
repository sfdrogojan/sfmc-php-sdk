<?php

namespace SalesForce\MarketingCloud\TestHelper\Api\Provisioner;

use SalesForce\MarketingCloud\Api\TransactionalMessagingApi;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class SmsDefinitionRequest
 *
 * @package SalesForce\MarketingCloud\TestHelper\Api\Provisioner
 */
class SmsDefinitionRequest extends AbstractApiProvisioner
{
    /**
     * SmsDefinitionRequest constructor.
     * 
     * @param TransactionalMessagingApi $client
     */
    public function __construct(TransactionalMessagingApi $client)
    {
        $this->client = $client;
    }

    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public function provision(ModelInterface $model): ModelInterface
    {
        return $model;
    }

    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public function deplete(ModelInterface $model): ModelInterface
    {
        return $model;
    }
}