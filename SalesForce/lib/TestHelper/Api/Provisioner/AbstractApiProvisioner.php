<?php

namespace SalesForce\MarketingCloud\TestHelper\Api\Provisioner;

use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class AbstractApiProvisioner
 *
 * @package SalesForce\MarketingCloud\TestHelper\Api\Provisioner
 */
abstract class AbstractApiProvisioner
{
    /**
     * @var AbstractApi
     */
    protected $client;

    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public abstract function provision(ModelInterface $model): ModelInterface;

    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public abstract function deplete(ModelInterface $model): ModelInterface;
}