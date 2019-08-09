<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provisioner;

use SalesForce\MarketingCloud\Api\TransactionalMessagingApi;
use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class QueuedMessagesForSendDefinitionResponse
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provisioner
 */
class QueuedMessagesForSendDefinitionResponse extends EmailDefinitionRequest
{
    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface|CreateEmailDefinitionRequest $model
     * @return ModelInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SalesForce\MarketingCloud\ApiException
     */
    public function provision(ModelInterface $model): ModelInterface
    {
        parent::provision($model);

        $model->setStatus("Inactive");

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
        parent::deplete($model);

        return $model;
    }
}