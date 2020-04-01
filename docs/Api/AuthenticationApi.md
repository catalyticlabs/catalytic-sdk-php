# Catalytic\SDK\AuthenticationApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAndApproveCredentials**](AuthenticationApi.md#createAndApproveCredentials) | **POST** /api/auth/create-and-approve | Create new Credentials using provided Catalytic team domain and Approve using provided email and password.
[**createCredentials**](AuthenticationApi.md#createCredentials) | **POST** /api/auth | Create new Credentials in the provided Catalytic team domain.  Credentials must be approved prior to use.
[**waitForCredentialsApproval**](AuthenticationApi.md#waitForCredentialsApproval) | **POST** /api/auth/wait-for-approval | Wait until Credentials are approved



## createAndApproveCredentials

> \Catalytic\SDK\Model\Credentials createAndApproveCredentials($credentialsCreationWithEmailAndPasswordRequest)

Create new Credentials using provided Catalytic team domain and Approve using provided email and password.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Catalytic\SDK\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credentialsCreationWithEmailAndPasswordRequest = new \Catalytic\SDK\Model\CredentialsCreationWithEmailAndPasswordRequest(); // \Catalytic\SDK\Model\CredentialsCreationWithEmailAndPasswordRequest | Params required to create and approve new Credentials

try {
    $result = $apiInstance->createAndApproveCredentials($credentialsCreationWithEmailAndPasswordRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->createAndApproveCredentials: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credentialsCreationWithEmailAndPasswordRequest** | [**\Catalytic\SDK\Model\CredentialsCreationWithEmailAndPasswordRequest**](../Model/CredentialsCreationWithEmailAndPasswordRequest.md)| Params required to create and approve new Credentials | [optional]

### Return type

[**\Catalytic\SDK\Model\Credentials**](../Model/Credentials.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## createCredentials

> \Catalytic\SDK\Model\Credentials createCredentials($credentialsCreationRequest)

Create new Credentials in the provided Catalytic team domain.  Credentials must be approved prior to use.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Catalytic\SDK\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$credentialsCreationRequest = new \Catalytic\SDK\Model\CredentialsCreationRequest(); // \Catalytic\SDK\Model\CredentialsCreationRequest | Params required to create new Credentials

try {
    $result = $apiInstance->createCredentials($credentialsCreationRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->createCredentials: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **credentialsCreationRequest** | [**\Catalytic\SDK\Model\CredentialsCreationRequest**](../Model/CredentialsCreationRequest.md)| Params required to create new Credentials | [optional]

### Return type

[**\Catalytic\SDK\Model\Credentials**](../Model/Credentials.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## waitForCredentialsApproval

> object waitForCredentialsApproval($waitForCredentialsApprovalRequest)

Wait until Credentials are approved

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new Catalytic\SDK\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$waitForCredentialsApprovalRequest = new \Catalytic\SDK\Model\WaitForCredentialsApprovalRequest(); // \Catalytic\SDK\Model\WaitForCredentialsApprovalRequest | Params required to poll approved Credentials

try {
    $result = $apiInstance->waitForCredentialsApproval($waitForCredentialsApprovalRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->waitForCredentialsApproval: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **waitForCredentialsApprovalRequest** | [**\Catalytic\SDK\Model\WaitForCredentialsApprovalRequest**](../Model/WaitForCredentialsApprovalRequest.md)| Params required to poll approved Credentials | [optional]

### Return type

**object**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

