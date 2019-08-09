<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provider;

use SalesForce\MarketingCloud\Model\ModelInterface;
use SalesForce\MarketingCloud\Model\Recipient;
use SalesForce\MarketingCloud\Model\SendEmailToSingleRecipientRequest;

/**
 * Class DefinitionSendStatusForRecipientResponseProvider
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provider
 */
class DefinitionSendStatusForRecipientResponseProvider extends AbstractModelProvider
{
    /**
     * Creates a test object
     *
     * @return ModelInterface|null
     */
    public static function getTestModel(): ?ModelInterface
    {
        $recipient = new Recipient(["to" => "johnDoe@gmail.com"]);
        $messageKey = md5(rand(0, 9999));

        $messageRequestBody = new SendEmailToSingleRecipientRequest(["recipient" => $recipient]);
    }

    /**
     * Updates some field of the test object
     *
     * @param ModelInterface $object
     * @return ModelInterface|null
     */
    public static function getPatchedModel(ModelInterface $object): ?ModelInterface
    {
        // TODO: Implement getPatchedModel() method.
    }
}