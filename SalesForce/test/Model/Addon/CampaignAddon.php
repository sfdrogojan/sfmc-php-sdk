<?php

namespace SalesForce\MarketingCloud\Test\Model\Addon;

use SalesForce\MarketingCloud\Model\Campaign;
use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Trait CampaignAddon
 *
 * @package SalesForce\MarketingCloud\Test\Model\Addon
 */
trait CampaignAddon
{
    use BaseAddon;

    /**
     * Creates a test object
     *
     * @return ModelInterface|null
     */
    public static function createTestModel(): ?ModelInterface
    {
        $object = new Campaign([
            "name" => "Random name",
            "description" => "Random description",
            "campaignCode" => "100",
            "color" => "red",
            "favourite" => 0
        ]);

        return $object;
    }

    /**
     * Updates some field of the test object
     *
     * @param ModelInterface|Campaign $object
     * @return ModelInterface
     */
    public static function updateTestModel(ModelInterface $object): ModelInterface
    {
        $object->setName("Some random name");

        return $object;
    }

    /**
     * @inheritDoc
     */
    public static function getApiCreateMethod(): string
    {
        return "createCampaign";
    }

    /**
     * @inheritDoc
     */
    public static function getApiGetMethod(): string
    {
        return "getCampaignById";
    }

    /**
     * @inheritDoc
     */
    public static function getApiDeleteMethod(): string
    {
        return "deleteCampaignById";
    }

    /**
     * @inheritDoc
     */
    public static function getModelIdMethod(): string
    {
        return "getId";
    }
}