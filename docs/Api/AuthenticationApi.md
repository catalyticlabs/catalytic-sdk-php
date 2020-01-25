# Catalytic\Client\AuthenticationApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAndActivateDeveloperKey**](AuthenticationApi.md#createandactivatedeveloperkey) | **POST** /api/auth/create-and-activate | Create a new Developer Key using provided Catalytic team domain and Activate using provided email and password.
[**createDeveloperKey**](AuthenticationApi.md#createdeveloperkey) | **POST** /api/auth | Create a new Developer Key in the provided Catalytic team domain
[**waitForDeveloperKeyActivation**](AuthenticationApi.md#waitfordeveloperkeyactivation) | **POST** /api/auth/:activate | Wait until Developer Key is in approved state, the activate Developer Key

# **createAndActivateDeveloperKey**
> \Catalytic\Client\Model\DeveloperKey createAndActivateDeveloperKey($body)

Create a new Developer Key using provided Catalytic team domain and Activate using provided email and password.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Catalytic\Client\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Catalytic\Client\Model\DeveloperKeyCreationWithEmailAndPasswordRequest(); // \Catalytic\Client\Model\DeveloperKeyCreationWithEmailAndPasswordRequest | Params required to create and activate a new Developer Key

try {
    $result = $apiInstance->createAndActivateDeveloperKey($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->createAndActivateDeveloperKey: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Catalytic\Client\Model\DeveloperKeyCreationWithEmailAndPasswordRequest**](../Model/DeveloperKeyCreationWithEmailAndPasswordRequest.md)| Params required to create and activate a new Developer Key | [optional]

### Return type

[**\Catalytic\Client\Model\DeveloperKey**](../Model/DeveloperKey.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createDeveloperKey**
> \Catalytic\Client\Model\DeveloperKey createDeveloperKey($body)

Create a new Developer Key in the provided Catalytic team domain

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Catalytic\Client\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Catalytic\Client\Model\DeveloperKeyCreationRequest(); // \Catalytic\Client\Model\DeveloperKeyCreationRequest | Params required to create a new Developer Key

try {
    $result = $apiInstance->createDeveloperKey($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->createDeveloperKey: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Catalytic\Client\Model\DeveloperKeyCreationRequest**](../Model/DeveloperKeyCreationRequest.md)| Params required to create a new Developer Key | [optional]

### Return type

[**\Catalytic\Client\Model\DeveloperKey**](../Model/DeveloperKey.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **waitForDeveloperKeyActivation**
> \Catalytic\Client\Model\DeveloperKey waitForDeveloperKeyActivation($body)

Wait until Developer Key is in approved state, the activate Developer Key

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Catalytic\Client\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Catalytic\Client\Model\DeveloperKeyActivationRequest(); // \Catalytic\Client\Model\DeveloperKeyActivationRequest | Params required to poll for and activate Developer Key

try {
    $result = $apiInstance->waitForDeveloperKeyActivation($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->waitForDeveloperKeyActivation: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Catalytic\Client\Model\DeveloperKeyActivationRequest**](../Model/DeveloperKeyActivationRequest.md)| Params required to poll for and activate Developer Key | [optional]

### Return type

[**\Catalytic\Client\Model\DeveloperKey**](../Model/DeveloperKey.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

