<?php

namespace SalesForce\MarketingCloud\Test\Model\Addon;

use SalesForce\MarketingCloud\Model\ModelInterface;

/**
 * Trait BaseAddon
 *
 * @package SalesForce\MarketingCloud\Test\Model\Addon
 */
trait BaseAddon
{
    /**
     * Creates a test object
     *
     * @return ModelInterface|null
     */
    public static abstract function createTestModel(): ?ModelInterface;

    /**
     * Updates some field of the test object
     *
     * @param ModelInterface $object
     * @return ModelInterface|null
     */
    public static abstract function updateTestModel(ModelInterface $object): ?ModelInterface;

    /**
     * Returns the method that can be used call the API and create a resource based on the test object
     *
     * @return string
     */
    public static function getApiCreateMethod(): string
    {
        throw new \RuntimeException(__METHOD__ . " is not implemented");
    }

    /**
     * Returns the method that can be used call the API and create a resource based on the test object
     *
     * @return string
     */
    public static function getApiGetMethod(): string
    {
        throw new \RuntimeException(__METHOD__ . " is not implemented");
    }

    /**
     * Returns the method that can be used call the API and create a resource based on the test object
     *
     * @return string
     */
    public static function getApiDeleteMethod(): string
    {
        throw new \RuntimeException(__METHOD__ . " is not implemented");
    }

    /**
     * Returns the method that can be used call identify a resource
     *
     * @return string
     */
    public static function getModelIdMethod(): string
    {
        throw new \RuntimeException(__METHOD__ . " is not implemented");
    }
}