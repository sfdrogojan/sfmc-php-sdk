<?php

namespace SalesForce\MarketingCloud\TestHelper\Api\Provisioner;

use GuzzleHttp\Client;
use SalesForce\MarketingCloud\Api\AssetApi;
use SalesForce\MarketingCloud\Api\TransactionalMessagingApi;
use SalesForce\MarketingCloud\TestHelper\Authorization\AuthServiceTestFactory;
use SalesForce\MarketingCloud\Configuration;
use SalesForce\MarketingCloud\Model\Asset;
use SalesForce\MarketingCloud\Model\AssetType;
use SalesForce\MarketingCloud\Model\CreateEmailDefinitionContent;
use SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest;
use SalesForce\MarketingCloud\Model\ModelInterface;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\AssetProvider;

/**
 * Class EmailDefinitionRequest
 *
 * @package SalesForce\MarketingCloud\TestHelper\Api\Provisioner
 */
class EmailDefinitionRequest extends AbstractApiProvisioner
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * EmailDefinitionRequest constructor.
     *
     * @param TransactionalMessagingApi $client
     */
    public function __construct(TransactionalMessagingApi $client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new asset on the API
     *
     * @return Asset
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SalesForce\MarketingCloud\ApiException
     */
    private function createAsset(): Asset
    {
        // TODO: move to a factory of some sort
        $config = new Configuration();
        $config->setHost(getenv("API_URL"));

        $client = new AssetApi(
            [AuthServiceTestFactory::class, 'factory'],
            new Client(['verify' => false]),
            $config
        );

        /** @var Asset $asset */
        $asset = AssetProvider::createTestModel();
        $asset->setAssetType(new AssetType(["id" => 208, "name" => "htmlemail", "displayName" => "htmlemail"]));

        return $client->createAsset($asset->__toString());
    }

    /**
     * Executes all the necessary provisioning
     *
     * @param ModelInterface|EmailDefinitionRequest $model
     * @return ModelInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SalesForce\MarketingCloud\ApiException
     */
    public function provision(ModelInterface $model): ModelInterface
    {
        // Input check
        if (!$model instanceof CreateEmailDefinitionRequest) {
            throw new \InvalidArgumentException(
                "Parameter 0 is not of type " . CreateEmailDefinitionRequest::class
            );
        }

        $this->asset = $this->createAsset();
        $model->setContent(new CreateEmailDefinitionContent(["customerKey" => $this->asset->getCustomerKey()]));

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