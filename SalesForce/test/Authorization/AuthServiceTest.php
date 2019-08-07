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
use Symfony\Component\Stopwatch\Stopwatch;

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

    public function authCacheStatesDataProvider()
    {
        // Params are: $expires_in, $callCount, $sleep,
        return [
            [60, 1, 0], // 60s cache, getAccessToken() method should be called 1 time
            [0,  2, 3], // 00s cache, getAccessToken() method should be called 2 times
            [1, 2, 3]   // 02s cache, getAccessToken() method should be called 2 times
        ];
    }

    /**
     * @dataProvider authCacheStatesDataProvider
     * @param int $expires_in Time in seconds that the AccessToken is valid
     * @param int $callCount How many times the getAccessToken() method should be called
     * @param int $sleep Sleep time in seconds
     * @throws \Exception
     */
    public function testAuthorizeWithDummyAuthClient(int $expires_in, int $callCount, int $sleep = 3)
    {
        $accessToken = new AccessToken([
            "access_token" => "test",
            "expires_in" => $expires_in
        ]);

        /** @var GenericProvider|MockObject $clientMock */
        $clientMock = $this->getMockBuilder(GenericProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $clientMock->expects($this->exactly($callCount))
            ->method("getAccessToken")
            ->willReturn($accessToken);

        // SUT
        $service = new AuthService();
        $service->setCache(new ArrayAdapter());
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