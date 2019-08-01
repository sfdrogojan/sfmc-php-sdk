# SalesForce\MarketingCloud\PHPSDK\AssetApi

All URIs are relative to *https://www.exacttargetapis.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAsset**](AssetApi.md#createAsset) | **POST** /asset/v1/content/assets | createAsset
[**deleteAssetById**](AssetApi.md#deleteAssetById) | **DELETE** /asset/v1/content/assets/{id} | deleteAssetById
[**getAssetById**](AssetApi.md#getAssetById) | **GET** /asset/v1/content/assets/{id} | getAssetById
[**partiallyUpdateAssetById**](AssetApi.md#partiallyUpdateAssetById) | **PATCH** /asset/v1/content/assets/{id} | partiallyUpdateAssetById


# **createAsset**
> \SalesForce\MarketingCloud\PHPSDK\Model\Asset createAsset($body)

createAsset

Creates a new asset.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = SalesForce\MarketingCloud\PHPSDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new SalesForce\MarketingCloud\PHPSDK\Api\AssetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \SalesForce\MarketingCloud\PHPSDK\Model\Asset(); // \SalesForce\MarketingCloud\PHPSDK\Model\Asset | JSON Parameters

try {
    $result = $apiInstance->createAsset($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AssetApi->createAsset: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\SalesForce\MarketingCloud\PHPSDK\Model\Asset**](../Model/Asset.md)| JSON Parameters | [optional]

### Return type

[**\SalesForce\MarketingCloud\PHPSDK\Model\Asset**](../Model/Asset.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteAssetById**
> deleteAssetById($id)

deleteAssetById

Deletes an asset.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = SalesForce\MarketingCloud\PHPSDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new SalesForce\MarketingCloud\PHPSDK\Api\AssetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 8.14; // float | The ID of the asset to delete

try {
    $apiInstance->deleteAssetById($id);
} catch (Exception $e) {
    echo 'Exception when calling AssetApi->deleteAssetById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **float**| The ID of the asset to delete |

### Return type

void (empty response body)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAssetById**
> \SalesForce\MarketingCloud\PHPSDK\Model\Asset getAssetById($id)

getAssetById

Gets an asset by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = SalesForce\MarketingCloud\PHPSDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new SalesForce\MarketingCloud\PHPSDK\Api\AssetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 8.14; // float | The ID of the asset

try {
    $result = $apiInstance->getAssetById($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AssetApi->getAssetById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **float**| The ID of the asset |

### Return type

[**\SalesForce\MarketingCloud\PHPSDK\Model\Asset**](../Model/Asset.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **partiallyUpdateAssetById**
> \SalesForce\MarketingCloud\PHPSDK\Model\Asset partiallyUpdateAssetById($id, $body)

partiallyUpdateAssetById

Updates part of an asset.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = SalesForce\MarketingCloud\PHPSDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new SalesForce\MarketingCloud\PHPSDK\Api\AssetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 8.14; // float | The ID of the asset to update
$body = new \SalesForce\MarketingCloud\PHPSDK\Model\Asset(); // \SalesForce\MarketingCloud\PHPSDK\Model\Asset | JSON Parameters

try {
    $result = $apiInstance->partiallyUpdateAssetById($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AssetApi->partiallyUpdateAssetById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **float**| The ID of the asset to update |
 **body** | [**\SalesForce\MarketingCloud\PHPSDK\Model\Asset**](../Model/Asset.md)| JSON Parameters | [optional]

### Return type

[**\SalesForce\MarketingCloud\PHPSDK\Model\Asset**](../Model/Asset.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

