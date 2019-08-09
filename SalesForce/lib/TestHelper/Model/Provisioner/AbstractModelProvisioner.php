<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provisioner;

use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class AbstractModelProvisioner
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provisioner
 */
abstract class AbstractModelProvisioner
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