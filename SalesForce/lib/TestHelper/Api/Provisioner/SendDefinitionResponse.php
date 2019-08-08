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
 * Class SendDefinitionResponse
 *
 * @package SalesForce\MarketingCloud\TestHelper\Api\Provisioner
 */
class SendDefinitionResponse extends EmailDefinitionRequest
{
}