<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provisioner;

use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class DefinitionSendStatusForRecipientResponse
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provisioner
 */
class DefinitionSendStatusForRecipientResponse extends AbstractModelProvisioner
{
    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface|CreateEmailDefinitionRequest $model
     * @return ModelInterface
     */
    public function provision(ModelInterface $model): ModelInterface
    {
        // Create an EmailDefinition on the API
        // Call SendEmailToSingleRecipientRequest::setDefinitionKey(CreateEmailDefinitionRequest::getDefinitionKey())
    }

    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public function deplete(ModelInterface $model): ModelInterface
    {
        // TODO: Implement deplete() method.
    }
}