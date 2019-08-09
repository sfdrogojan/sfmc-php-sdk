<?php
/**
 * TransactionalMessagingApiTest
 * PHP version 5
 *
 * @category Class
 * @package  SalesForce\MarketingCloud
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Marketing Cloud REST API
 *
 * Marketing Cloud's REST API is our newest API. It supports multi-channel use cases, is much more lightweight and easy to use than our SOAP API, and is getting more comprehensive with every release.
 *
 * OpenAPI spec version: 1.0.0
 * Contact: mc_sdk@salesforce.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.7
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the endpoint.
 */

namespace SalesForce\MarketingCloud\Test\Api;

use GuzzleHttp\Client;
use SalesForce\MarketingCloud\Model\Recipient;
use SalesForce\MarketingCloud\Model\SendEmailToMultipleRecipientsRequest;
use SalesForce\MarketingCloud\Model\SendEmailToSingleRecipientRequest;
use SalesForce\MarketingCloud\Model\SendSmsToMultipleRecipientsRequest;
use SalesForce\MarketingCloud\Model\SendSmsToSingleRecipientRequest;
use SalesForce\MarketingCloud\TestHelper\Authorization\AuthServiceTestFactory;
use SalesForce\MarketingCloud\TestHelper\Api\BaseApiTest;
use SalesForce\MarketingCloud\Configuration;
use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\Api\TransactionalMessagingApi;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\EmailDefinitionProvider;
use SalesForce\MarketingCloud\TestHelper\Model\Provider\SmsDefinitionProvider;
use SalesForce\MarketingCloud\TestHelper\Model\Provisioner\EmailDefinition;
use SalesForce\MarketingCloud\TestHelper\Model\Provisioner\SmsDefinition;

/**
 * TransactionalMessagingApiTest Class Doc Comment
 *
 * @category Class
 * @package  SalesForce\MarketingCloud
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransactionalMessagingApiTest extends BaseApiTest
{
    /**
     * @var string
     */
    protected static $modelNamespace = "\SalesForce\MarketingCloud\Model";

    /**
     * Creates the client required to do the API calls
     *
     * @return TransactionalMessagingApi|AbstractApi
     */
    protected function createClient(): AbstractApi
    {
        if (null === $this->client) {
            $config = new Configuration();
            $config->setHost(getenv("API_URL"));

            $this->client = new TransactionalMessagingApi(
                [AuthServiceTestFactory::class, 'factory'],
                new Client(['verify' => false]),
                $config
            );
        }

        return $this->client;
    }


    /**
     * Test case for createEmailDefinition
     *
     * createEmailDefinition.
     *
     */
    public function testCreateEmailDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("POST", "createEmailDefinition");
    }

    /**
     * Test case for createSmsDefinition
     *
     * createSmsDefinition.
     *
     */
    public function testCreateSmsDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("POST", "createSmsDefinition");
    }

    /**
     * Test case for deleteEmailDefinition
     *
     * deleteEmailDefinition.
     *
     */
    public function testDeleteEmailDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("DELETE", "deleteEmailDefinition");
    }

    /**
     * Test case for deleteQueuedMessagesForEmailDefinition
     *
     * deleteQueuedMessagesForEmailDefinition.
     *
     */
    public function testDeleteQueuedMessagesForEmailDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\DeleteQueuedMessagesForSendDefinitionResponse"
        );

        $this->createResourceOnEndpoint();

        // The actual test
        $client = $this->createClient();
        $response = $client->deleteQueuedMessagesForEmailDefinition($this->getResourceId());

        $this->assertNotNull($response->getRequestId());
    }

    /**
     * Test case for deleteQueuedMessagesForSmsDefinition
     *
     * deleteQueuedMessagesForSmsDefinition.
     *
     */
    public function testDeleteQueuedMessagesForSmsDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\DeleteQueuedMessagesForSendDefinitionResponse"
        );

        $this->createResourceOnEndpoint();

        // The actual test
        $client = $this->createClient();
        $response = $client->deleteQueuedMessagesForSmsDefinition($this->getResourceId());

        $this->assertNotNull($response->getRequestId());
    }

    /**
     * Test case for deleteSmsDefinition
     *
     * deleteSmsDefinition.
     *
     */
    public function testDeleteSmsDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("DELETE", "deleteSmsDefinition");
    }

    /**
     * Test case for getEmailDefinition
     *
     * getEmailDefinition.
     *
     */
    public function testGetEmailDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("GET", "getEmailDefinition");
    }

    /**
     * Test case for getEmailDefinitions
     *
     * getEmailDefinitions.
     *
     */
    public function testGetEmailDefinitions()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\GetEmailDefinitionsResponse"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("GET", "getEmailDefinitions");
    }

    /**
     * Test case for getEmailSendStatusForRecipient
     *
     * getEmailSendStatusForRecipient.
     *
     */
    public function testGetEmailSendStatusForRecipient()
    {
        $eventCategories = [
            "TransactionalSendEvents.EmailSent",
            "TransactionalSendEvents.EmailQueued",
            "TransactionalSendEvents.EmailNotSent"
        ];

        $client = $this->createClient();

        // Create the email definition
        $emailDefinitionProvisioner = new EmailDefinition($client);
        $emailDefinition = $emailDefinitionProvisioner->provision(EmailDefinitionProvider::getTestModel());
        $emailDefinition = $client->createEmailDefinition($emailDefinition->__toString());

        // Construct the email request
        $messageKey = md5(rand(0, 9999));
        $recipient = new Recipient([
            "contactKey" => "johnDoe@gmail.com"
        ]);

        $messageRequestBody = new SendEmailToSingleRecipientRequest([
            "definitionKey" => $emailDefinition->getDefinitionKey(),
            "recipient" => $recipient
        ]);

        // SUT
        $client->sendEmailToSingleRecipient($messageKey, $messageRequestBody);

        // Effect check
        $result = $client->getEmailSendStatusForRecipient($messageKey);

        $this->assertNotNull($result->getRequestId());
        $this->assertContains($result->getEventCategoryType(), $eventCategories);
    }

    /**
     * Test case for getEmailsNotSentToRecipients
     *
     * getEmailsNotSentToRecipients.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SalesForce\MarketingCloud\ApiException
     */
    public function testGetEmailsNotSentToRecipients()
    {
        $response = $this->createClient()->getEmailsNotSentToRecipients("notSent");

        $this->assertNotNull($response->getRequestId());
        $this->assertNotNull($response->getCount());
    }

    /**
     * Test case for getQueueMetricsForEmailDefinition
     *
     * getQueueMetricsForEmailDefinition.
     *
     */
    public function testGetQueueMetricsForEmailDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\GetQueueMetricsForSendDefinitionResponse"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("GET", "getQueueMetricsForEmailDefinition");
    }

    /**
     * Test case for getQueueMetricsForSmsDefinition
     *
     * getQueueMetricsForSmsDefinition.
     *
     */
    public function testGetQueueMetricsForSmsDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\GetQueueMetricsForSendDefinitionResponse"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("GET", "getQueueMetricsForSmsDefinition");
    }

    /**
     * Test case for getSMSsNotSentToRecipients
     *
     * getSMSsNotSentToRecipients.
     *
     */
    public function testGetSMSsNotSentToRecipients()
    {
        $response = $this->createClient()->getSMSsNotSentToRecipients("notSent");

        $this->assertNotNull($response->getRequestId());
        $this->assertNotNull($response->getCount());
    }

    /**
     * Test case for getSmsDefinition
     *
     * getSmsDefinition.
     *
     */
    public function testGetSmsDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("GET", "getSmsDefinition");
    }

    /**
     * Test case for getSmsDefinitions
     *
     * getSmsDefinitions.
     *
     */
    public function testGetSmsDefinitions()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\GetSmsDefinitionsResponse"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("GET", "getSmsDefinitions");
    }

    /**
     * Test case for getSmsSendStatusForRecipient
     *
     * getSmsSendStatusForRecipient.
     *
     */
    public function testGetSmsSendStatusForRecipient()
    {
        $eventCategories = [
            "TransactionalSendEvents.SMSSent",
            "TransactionalSendEvents.SMSQueued",
            "TransactionalSendEvents.SMSNotSent"
        ];

        $client = $this->createClient();

        // Create the email definition
        $provider = new SmsDefinition($client);
        $definition = $provider->provision(SmsDefinitionProvider::getTestModel());
        $definition = $client->createSmsDefinition($definition->__toString());

        // Construct the email request
        $messageKey = md5(rand(0, 9999));
        $recipient = new Recipient([
            "contactKey" => "johnDoe@gmail.com"
        ]);

        $body = new SendSmsToSingleRecipientRequest([
            "definitionKey" => $definition->getDefinitionKey(),
            "recipient" => $recipient
        ]);

        // SUT
        $client->sendSmsToSingleRecipient($messageKey, $body);

        // Effect check
        $result = $client->getSmsSendStatusForRecipient($messageKey);

        $this->assertNotNull($result->getRequestId());
        $this->assertContains($result->getEventCategoryType(), $eventCategories);
    }

    /**
     * Test case for partiallyUpdateEmailDefinition
     *
     * partiallyUpdateEmailDefinition.
     *
     */
    public function testPartiallyUpdateEmailDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("PATCH", "partiallyUpdateEmailDefinition");
    }

    /**
     * Test case for partiallyUpdateSmsDefinition
     *
     * partiallyUpdateSmsDefinition.
     *
     */
    public function testPartiallyUpdateSmsDefinition()
    {
        $this->setModelClass(
            __FUNCTION__,
            "\SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest"
        );

        $this->createResourceOnEndpoint();
        $this->executeOperation("PATCH", "partiallyUpdateSmsDefinition");
    }

    /**
     * Test case for sendEmailToMultipleRecipients
     *
     * sendEmailToMultipleRecipients.
     *
     */
    public function testSendEmailToMultipleRecipients()
    {
        $client = $this->createClient();

        // Create the email definition
        $emailDefinitionProvisioner = new EmailDefinition($client);
        $emailDefinition = $emailDefinitionProvisioner->provision(EmailDefinitionProvider::getTestModel());
        $emailDefinition = $client->createEmailDefinition($emailDefinition->__toString());

        // Construct the email request
        $messageKey = md5(rand(0, 9999));
        $recipient = new Recipient([
            "contactKey" => "johnDoe@gmail.com"
        ]);

        $messageRequestBody = new SendEmailToMultipleRecipientsRequest([
            "definitionKey" => $emailDefinition->getDefinitionKey(),
            "recipients" => [
                new Recipient(["contactKey" => "johnDoe@gmail.com"]),
                new Recipient(["contactKey" => "johnDoe2@gmail.com"]),
            ]
        ]);

        // SUT
        $result = $client->sendEmailToMultipleRecipients($messageRequestBody);

        $this->assertNotNull($result->getRequestId());
    }

    /**
     * Test case for sendEmailToSingleRecipient
     *
     * sendEmailToSingleRecipient.
     *
     */
    public function testSendEmailToSingleRecipient()
    {
        $client = $this->createClient();

        // Create the email definition
        $emailDefinitionProvisioner = new EmailDefinition($client);
        $emailDefinition = $emailDefinitionProvisioner->provision(EmailDefinitionProvider::getTestModel());
        $emailDefinition = $client->createEmailDefinition($emailDefinition->__toString());

        // Construct the email request
        $messageKey = md5(rand(0, 9999));
        $recipient = new Recipient([
            "contactKey" => "johnDoe@gmail.com"
        ]);

        $messageRequestBody = new SendEmailToSingleRecipientRequest([
            "definitionKey" => $emailDefinition->getDefinitionKey(),
            "recipient" => $recipient
        ]);

        // SUT
        $result = $client->sendEmailToSingleRecipient($messageKey, $messageRequestBody);

        $this->assertNotNull($result->getRequestId());
    }

    /**
     * Test case for sendSmsToMultipleRecipients
     *
     * sendSmsToMultipleRecipients.
     *
     */
    public function testSendSmsToMultipleRecipients()
    {
        $client = $this->createClient();

        // Create the email definition
        $provider = new SmsDefinition($client);
        $definition = $provider->provision(SmsDefinitionProvider::getTestModel());
        $definition = $client->createSmsDefinition($definition->__toString());

        $body = new SendSmsToMultipleRecipientsRequest([
            "definitionKey" => $definition->getDefinitionKey(),
            "recipients" => [
                new Recipient(["contactKey" => "johnDoe@gmail.com"]),
                new Recipient(["contactKey" => "johnDoe2@gmail.com"]),
            ]
        ]);

        // SUT
        $result = $client->sendSmsToMultipleRecipients($body);

        $this->assertNotNull($result->getRequestId());
    }

    /**
     * Test case for sendSmsToSingleRecipient
     *
     * sendSmsToSingleRecipient.
     *
     */
    public function testSendSmsToSingleRecipient()
    {
        $client = $this->createClient();

        // Create the email definition
        $provider = new SmsDefinition($client);
        $definition = $provider->provision(SmsDefinitionProvider::getTestModel());
        $definition = $client->createSmsDefinition($definition->__toString());

        // Construct the email request
        $messageKey = md5(rand(0, 9999));
        $recipient = new Recipient([
            "contactKey" => "johnDoe@gmail.com"
        ]);

        $body = new SendSmsToSingleRecipientRequest([
            "definitionKey" => $definition->getDefinitionKey(),
            "recipient" => $recipient
        ]);

        // SUT
        $result = $client->sendSmsToSingleRecipient($messageKey, $body);

        $this->assertNotNull($result->getRequestId());
    }
}
