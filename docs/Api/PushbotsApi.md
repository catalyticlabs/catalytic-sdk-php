# Catalytic\Client\PushbotsApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**findPushbots**](PushbotsApi.md#findpushbots) | **GET** /api/pushbots | Find Pushbots
[**getPushbot**](PushbotsApi.md#getpushbot) | **GET** /api/pushbots/{id} | Gets details of a specific Pushbot process template

# **findPushbots**
> \Catalytic\Client\Model\PushbotsPage findPushbots($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find Pushbots

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$query = "query_example"; // string | Free text query terms to search all attributes for
$status = "status_example"; // string | Run or task status to search for
$process_id = "process_id_example"; // string | Process ID (aka Pushbot ID) to search for
$run_id = "run_id_example"; // string | RunID (aka Instance ID) to search for
$owner = "owner_example"; // string | Run or task owner to search for
$category = "category_example"; // string | Category of process or run to search for
$page_token = "page_token_example"; // string | The token representing the result page to get
$page_size = 56; // int | The page size requested

try {
    $result = $apiInstance->findPushbots($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PushbotsApi->findPushbots: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **query** | **string**| Free text query terms to search all attributes for | [optional]
 **status** | **string**| Run or task status to search for | [optional]
 **process_id** | **string**| Process ID (aka Pushbot ID) to search for | [optional]
 **run_id** | **string**| RunID (aka Instance ID) to search for | [optional]
 **owner** | **string**| Run or task owner to search for | [optional]
 **category** | **string**| Category of process or run to search for | [optional]
 **page_token** | **string**| The token representing the result page to get | [optional]
 **page_size** | **int**| The page size requested | [optional]

### Return type

[**\Catalytic\Client\Model\PushbotsPage**](../Model/PushbotsPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPushbot**
> \Catalytic\Client\Model\Pushbot getPushbot($id)

Gets details of a specific Pushbot process template

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Pushbot to get

try {
    $result = $apiInstance->getPushbot($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PushbotsApi->getPushbot: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Pushbot to get |

### Return type

[**\Catalytic\Client\Model\Pushbot**](../Model/Pushbot.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

