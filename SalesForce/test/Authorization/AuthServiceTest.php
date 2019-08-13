<?php

namespace SalesForce\MarketingCloud;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;
use SalesForce\MarketingCloud\Authorization\AuthService;
use SalesForce\MarketingCloud\Authorization\AuthServiceSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

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
    public function testBuildAuthServiceUsingCallable()
    {
        $this->assertInstanceOf(
            AuthService::class,
            (new AuthServiceSetup())->run()->getContainer()->get(AuthService::CONTAINER_ID)
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
            [3, 2, 5]   // 03s cache, getAccessToken() method should be called 2 times
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
        /** @var GenericProvider|MockObject $clientMock */
        $clientMock = $this->getMockBuilder(GenericProvider::class)
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