<?php

namespace SalesForce\MarketingCloud\Test\Authorization;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use SalesForce\MarketingCloud\Authorization\AuthService;
use SalesForce\MarketingCloud\Authorization\AuthServiceSetup;
use SalesForce\MarketingCloud\Authorization\Client\GenericClient;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AuthServiceTest
 *
 * @package SalesForce\MarketingCloud
 */
class AuthServiceTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCreateAuthService()
    {
        $container = new ContainerBuilder();
        $container->setParameter("auth.client.options", [
            'accountId' => getenv('ACCOUNT_ID'),
            'clientId' => getenv('CLIENT_ID'),
            'clientSecret' => getenv('CLIENT_SECRET'),
            'urlAuthorize' => getenv('URL_AUTHORIZE'),
            'urlAccessToken' => getenv('URL_ACCESS_TOKEN'),
            'urlResourceOwnerDetails' => ''
        ]);

        AuthServiceSetup::execute($container);

        $this->assertInstanceOf(
            AuthService::class,
            $container->get(AuthService::CONTAINER_ID)
        );
    }

    /**
     * Returns test data
     *
     * @return array
     */
    public function authCacheStatesDataProvider(): array
    {
        // Params are: $expires_in, $callCount, $sleep
        return [
            [60, 1, 0], // 60s cache, getAccessToken() method should be called 1 time
            [33, 2, 3]   // 30s cache, getAccessToken() method should be called 2 times
        ];
    }

    /**
     * @dataProvider authCacheStatesDataProvider
     * @param int $expires_in Time in seconds that the AccessToken is valid
     * @param int $callCount How many times the getAccessToken() method should be called
     * @param int $sleep Sleep time in seconds
     * @throws \Exception
     * @throws InvalidArgumentException
     */
    public function testAuthorizeWithDummyAuthClient(int $expires_in, int $callCount, int $sleep = 3)
    {
        /** @var GenericClient|MockObject $clientMock */
        $clientMock = $this->getMockBuilder(GenericClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $clientMock->expects($this->exactly($callCount))
            ->method("getAccessToken")
            ->willReturnCallback(function () use ($expires_in) {
                return new AccessToken([
                    "access_token" => "test",
                    "expires_in" => $expires_in
                ]);
            });

        // SUT
        $service = new AuthService();
        $service->setCache(new ArrayAdapter());
        $service->setCacheKey("access_token_test");
        $service->setClient($clientMock);

        try {
            $service->authorize();
            sleep($sleep);
            $service->authorize();
        } catch (IdentityProviderException $e) {
            $this->fail("Authorization failed");
        } catch (InvalidArgumentException $e) {
            $this->fail("Authorization failed");
        }

        $this->assertEquals("test", $service->getAccessToken());
    }
}