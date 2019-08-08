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
use SalesForce\MarketingCloud\TestHelper\Authorization\AuthServiceTestFactory;
use SalesForce\MarketingCloud\Configuration;
use SalesForce\MarketingCloud\Api\AbstractApi;
use SalesForce\MarketingCloud\Api\TransactionalMessagingApi;

/**
 * TransactionalMessagingApiTest Class Doc Comment
 *
 * @category Class
 * @package  SalesForce\MarketingCloud
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransactionalMessagingApiTest extends AbstractApiTest
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
        $modelClass = "\SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("createEmailDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("POST");
        $this->$actionMethod("createEmailDefinition");
    }
    
    /**
     * Test case for createSmsDefinition
     *
     * createSmsDefinition.
     *
     */
    public function testCreateSmsDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("createSmsDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("POST");
        $this->$actionMethod("createSmsDefinition");
    }
    
    /**
     * Test case for deleteEmailDefinition
     *
     * deleteEmailDefinition.
     *
     */
    public function testDeleteEmailDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("deleteEmailDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("DELETE");
        $this->$actionMethod("deleteEmailDefinition");
    }
    
    /**
     * Test case for deleteQueuedMessagesForEmailDefinition
     *
     * deleteQueuedMessagesForEmailDefinition.
     *
     */
    public function testDeleteQueuedMessagesForEmailDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\DeleteQueuedMessagesForSendDefinitionResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("deleteQueuedMessagesForEmailDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("DELETE");
        $this->$actionMethod("deleteQueuedMessagesForEmailDefinition");
    }
    
    /**
     * Test case for deleteQueuedMessagesForSmsDefinition
     *
     * deleteQueuedMessagesForSmsDefinition.
     *
     */
    public function testDeleteQueuedMessagesForSmsDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\DeleteQueuedMessagesForSendDefinitionResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("deleteQueuedMessagesForSmsDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("DELETE");
        $this->$actionMethod("deleteQueuedMessagesForSmsDefinition");
    }
    
    /**
     * Test case for deleteSmsDefinition
     *
     * deleteSmsDefinition.
     *
     */
    public function testDeleteSmsDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\DeleteSendDefinitionResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("deleteSmsDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("DELETE");
        $this->$actionMethod("deleteSmsDefinition");
    }
    
    /**
     * Test case for getEmailDefinition
     *
     * getEmailDefinition.
     *
     */
    public function testGetEmailDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getEmailDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getEmailDefinition");
    }
    
    /**
     * Test case for getEmailDefinitions
     *
     * getEmailDefinitions.
     *
     */
    public function testGetEmailDefinitions()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetEmailDefinitionsResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getEmailDefinitions");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getEmailDefinitions");
    }
    
    /**
     * Test case for getEmailSendStatusForRecipient
     *
     * getEmailSendStatusForRecipient.
     *
     */
    public function testGetEmailSendStatusForRecipient()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetDefinitionSendStatusForRecipientResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getEmailSendStatusForRecipient");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getEmailSendStatusForRecipient");
    }
    
    /**
     * Test case for getEmailsNotSentToRecipients
     *
     * getEmailsNotSentToRecipients.
     *
     */
    public function testGetEmailsNotSentToRecipients()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetDefinitionsNotSentToRecipientsResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getEmailsNotSentToRecipients");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getEmailsNotSentToRecipients");
    }
    
    /**
     * Test case for getQueueMetricsForEmailDefinition
     *
     * getQueueMetricsForEmailDefinition.
     *
     */
    public function testGetQueueMetricsForEmailDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetQueueMetricsForSendDefinitionResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getQueueMetricsForEmailDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getQueueMetricsForEmailDefinition");
    }
    
    /**
     * Test case for getQueueMetricsForSmsDefinition
     *
     * getQueueMetricsForSmsDefinition.
     *
     */
    public function testGetQueueMetricsForSmsDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetQueueMetricsForSendDefinitionResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getQueueMetricsForSmsDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getQueueMetricsForSmsDefinition");
    }
    
    /**
     * Test case for getSMSsNotSentToRecipients
     *
     * getSMSsNotSentToRecipients.
     *
     */
    public function testGetSMSsNotSentToRecipients()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetDefinitionsNotSentToRecipientsResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getSMSsNotSentToRecipients");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getSMSsNotSentToRecipients");
    }
    
    /**
     * Test case for getSmsDefinition
     *
     * getSmsDefinition.
     *
     */
    public function testGetSmsDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getSmsDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getSmsDefinition");
    }
    
    /**
     * Test case for getSmsDefinitions
     *
     * getSmsDefinitions.
     *
     */
    public function testGetSmsDefinitions()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetSmsDefinitionsResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getSmsDefinitions");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getSmsDefinitions");
    }
    
    /**
     * Test case for getSmsSendStatusForRecipient
     *
     * getSmsSendStatusForRecipient.
     *
     */
    public function testGetSmsSendStatusForRecipient()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\GetDefinitionSendStatusForRecipientResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("getSmsSendStatusForRecipient");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("GET");
        $this->$actionMethod("getSmsSendStatusForRecipient");
    }
    
    /**
     * Test case for partiallyUpdateEmailDefinition
     *
     * partiallyUpdateEmailDefinition.
     *
     */
    public function testPartiallyUpdateEmailDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\CreateEmailDefinitionRequest";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("partiallyUpdateEmailDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("PATCH");
        $this->$actionMethod("partiallyUpdateEmailDefinition");
    }
    
    /**
     * Test case for partiallyUpdateSmsDefinition
     *
     * partiallyUpdateSmsDefinition.
     *
     */
    public function testPartiallyUpdateSmsDefinition()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\CreateSmsDefinitionRequest";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("partiallyUpdateSmsDefinition");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("PATCH");
        $this->$actionMethod("partiallyUpdateSmsDefinition");
    }
    
    /**
     * Test case for sendEmailToMultipleRecipients
     *
     * sendEmailToMultipleRecipients.
     *
     */
    public function testSendEmailToMultipleRecipients()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\SendDefinitionToMultipleRecipientsResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("sendEmailToMultipleRecipients");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("POST");
        $this->$actionMethod("sendEmailToMultipleRecipients");
    }
    
    /**
     * Test case for sendEmailToSingleRecipient
     *
     * sendEmailToSingleRecipient.
     *
     */
    public function testSendEmailToSingleRecipient()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\SendDefinitionToSingleRecipientResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("sendEmailToSingleRecipient");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("POST");
        $this->$actionMethod("sendEmailToSingleRecipient");
    }
    
    /**
     * Test case for sendSmsToMultipleRecipients
     *
     * sendSmsToMultipleRecipients.
     *
     */
    public function testSendSmsToMultipleRecipients()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\SendDefinitionToMultipleRecipientsResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("sendSmsToMultipleRecipients");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("POST");
        $this->$actionMethod("sendSmsToMultipleRecipients");
    }
    
    /**
     * Test case for sendSmsToSingleRecipient
     *
     * sendSmsToSingleRecipient.
     *
     */
    public function testSendSmsToSingleRecipient()
    {
        $modelClass = "\SalesForce\MarketingCloud\Model\SendDefinitionToSingleRecipientResponse";
        if (empty($modelClass)) {
            $modelClass = $this->guessModelClass("sendSmsToSingleRecipient");
        }

        $this->createResourceOnEndpoint($modelClass);

        $actionMethod = $this->selectActionMethod("POST");
        $this->$actionMethod("sendSmsToSingleRecipient");
    }
}
