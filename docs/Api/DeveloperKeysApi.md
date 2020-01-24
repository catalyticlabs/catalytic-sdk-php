# Swagger\Client\DeveloperKeysApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**findDeveloperKeys**](DeveloperKeysApi.md#finddeveloperkeys) | **GET** /api/developer-keys | Find Developer Keys
[**revokeDeveloperKey**](DeveloperKeysApi.md#revokedeveloperkey) | **PATCH** /api/developer-keys/{accessIdentifier}:revoke | Revoke Developer Key

# **findDeveloperKeys**
> \Swagger\Client\Model\DeveloperKeysPage findDeveloperKeys($page_token, $page_size)

Find Developer Keys

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\DeveloperKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page_token = "page_token_example"; // string | The token representing the result page to get
$page_size = 56; // int | The page size requested

try {
    $result = $apiInstance->findDeveloperKeys($page_token, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeveloperKeysApi->findDeveloperKeys: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page_token** | **string**| The token representing the result page to get | [optional]
 **page_size** | **int**| The page size requested | [optional]

### Return type

[**\Swagger\Client\Model\DeveloperKeysPage**](../Model/DeveloperKeysPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **revokeDeveloperKey**
> \Swagger\Client\Model\DeveloperKey revokeDeveloperKey($access_identifier)

Revoke Developer Key

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\DeveloperKeysApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$access_identifier = "access_identifier_example"; // string | The public Access Identifier of the Developer Key

try {
    $result = $apiInstance->revokeDeveloperKey($access_identifier);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeveloperKeysApi->revokeDeveloperKey: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **access_identifier** | **string**| The public Access Identifier of the Developer Key |

### Return type

[**\Swagger\Client\Model\DeveloperKey**](../Model/DeveloperKey.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

