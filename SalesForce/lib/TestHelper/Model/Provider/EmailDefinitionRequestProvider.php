<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provider;

use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\CreateEmailDefinitionSubscriptions;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class EmailDefinitionRequestProvider
 *
 * @package TestHelper\Model\Provider
 */
class EmailDefinitionRequestProvider extends AbstractModelProvider
{
    /**
     * Creates a test object
     *
     * @return ModelInterface|null
     */
    public static function createTestModel(): ?ModelInterface
    {
        $uniqueKey = (string)rand(0, 1000);
        $name = "Name {$uniqueKey}"; // Asset names within a category and asset type must be unique

        $object = new CreateEmailDefinitionRequest([
            "name" => $name,
            "definitionKey" => $uniqueKey,
            "subscriptions" => new CreateEmailDefinitionSubscriptions(["list" => "All Subscribers"]),
        ]);

        return $object;
    }

    /**
     * Updates some field of the test object
     *
     * @param ModelInterface|CreateEmailDefinitionRequest $object
     * @return ModelInterface
     */
    public static function updateTestModel(ModelInterface $object): ModelInterface
    {
        $object->setName("Some random content");
        $object->setRequestId("");

        return $object;
    }

    /**
     * @inheritDoc
     */
    public static function getApiCreateMethod(): string
    {
        return "createEmailDefinition";
    }

    /**
     * @inheritDoc
     */
    public static function getApiGetMethod(): string
    {
        return "getEmailDefinition";
    }

    /**
     * @inheritDoc
     */
    public static function getApiDeleteMethod(): string
    {
        return "deleteEmailDefinition";
    }

    /**
     * @inheritDoc
     */
    public static function getModelIdMethod(): string
    {
        return "getDefinitionKey";
    }
}