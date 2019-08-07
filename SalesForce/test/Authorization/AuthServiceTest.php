<?php

namespace SalesForce\MarketingCloud;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use SalesForce\MarketingCloud\Authorization\AuthService;
use SalesForce\MarketingCloud\Authorization\AuthServiceFactory;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * Class AuthServiceTest
 *
 * @package SalesForce\MarketingCloud
 */
class AuthServiceTest extends TestCase
{
    public function testBuildAuthServiceUsingCallable()
    {
        $this->assertInstanceOf(
            AuthService::class,
            call_user_func([AuthServiceFactory::class, "factory"])
        );
    }

    public function testAuthorizeWithDummyAuthClient()
    {
        $accessToken = new AccessToken([
            "access_token" => "test",
            "expires_in" => 0
        ]);

        /** @var GenericProvider|MockObject $clientMock */
        $clientMock = $this->getMockBuilder(GenericProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $clientMock->expects($this->once())
            ->method("getAccessToken")
            ->willReturn($accessToken);

        // SUT
        $service = new AuthService();
        $service->setCache(new ArrayAdapter());
        $service->setClient($clientMock);

        try {
            $service->authorize();
        } catch (IdentityProviderException $e) {
            $this->fail("Authorization failed");
        } catch (InvalidArgumentException $e) {
            $this->fail("Authorization failed");
        }

        $this->assertEquals("test", $service->getAccessToken());
    }

    public function testAuthorizeWithDummyAuthClientAndCache()
    {
        $accessToken = new AccessToken([
            "access_token" => "test",
            "expires_in" => 60
        ]);

        /** @var GenericProvider|MockObject $clientMock */
        $clientMock = $this->getMockBuilder(GenericProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $clientMock->expects($this->once())
            ->method("getAccessToken")
            ->willReturn($accessToken);

        // SUT
        $service = new AuthService();
        $service->setCache(new ArrayAdapter());
        $service->setClient($clientMock);

        try {
            $service->authorize();
            $service->authorize();
        } catch (IdentityProviderException $e) {
            $this->fail("Authorization failed");
        } catch (InvalidArgumentException $e) {
            $this->fail("Authorization failed");
        }
    }
}