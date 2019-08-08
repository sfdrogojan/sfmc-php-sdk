<?php

namespace SalesForce\MarketingCloud\TestHelper\Model\Provider;

use SalesForce\MarketingCloud\Model\Asset;
use SalesForce\MarketingCloud\Model\AssetType;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Class AssetProvider
 *
 * @package SalesForce\MarketingCloud\TestHelper\Model\Provider
 */
class AssetProvider extends AbstractModelProvider
{
    /**
     * Creates a test object
     *
     * @return ModelInterface|null
     */
    public static function createTestModel(): ?ModelInterface
    {
        $customerKey = (string)rand(0, 1000);
        $name = "AssetName {$customerKey}"; // Asset names within a category and asset type must be unique

        $object = new Asset([
            "name" => $name,
            "description" => "AssetDescription",
            "customerKey" => $customerKey,
            "assetType" => new AssetType([
                "id" => 196,
                "name" => "text_block",
                "displayName" => "Text Block"
            ]),
            "views" => [
                "subjectline" => [
                    "content" => "New TS Subject Line"
                ]
            ]
        ]);

        return $object;
    }

    /**
     * Updates some field of the test object
     *
     * @param ModelInterface|Asset $object
     * @return ModelInterface
     */
    public static function updateTestModel(ModelInterface $object): ModelInterface
    {
        $object->setContent("Some random content");

        return $object;
    }

    /**
     * @inheritDoc
     */
    public static function getApiCreateMethod(): string
    {
        return "createAsset";
    }

    /**
     * @inheritDoc
     */
    public static function getApiGetMethod(): string
    {
        return "getAssetById";
    }

    /**
     * @inheritDoc
     */
    public static function getApiDeleteMethod(): string
    {
        return "deleteAssetById";
    }

    /**
     * @inheritDoc
     */
    public static function getModelIdMethod(): string
    {
        return "getId";
    }
}