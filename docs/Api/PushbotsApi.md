# Catalytic\SDK\PushbotsApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**exportPushbot**](PushbotsApi.md#exportPushbot) | **POST** /api/pushbots/{id}:export | Exports an existing Pushbot
[**findPushbots**](PushbotsApi.md#findPushbots) | **GET** /api/pushbots | Find Pushbots
[**getPushbot**](PushbotsApi.md#getPushbot) | **GET** /api/pushbots/{id} | Gets details of a specific Pushbot process template
[**getPushbotExport**](PushbotsApi.md#getPushbotExport) | **GET** /api/pushbots/export/{id} | Fetch an existing PushbotExport request
[**getPushbotImport**](PushbotsApi.md#getPushbotImport) | **GET** /api/pushbots/import/{id} | Fetch an existing PushbotImport request
[**importPushbot**](PushbotsApi.md#importPushbot) | **POST** /api/pushbots/import | Imports a new Pushbot



## exportPushbot

> \Catalytic\SDK\Model\PushbotExport exportPushbot($id, $pushbotExportRequest)

Exports an existing Pushbot

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$pushbotExportRequest = new \Catalytic\SDK\Model\PushbotExportRequest(); // \Catalytic\SDK\Model\PushbotExportRequest | The Pushbot Export request

try {
    $result = $apiInstance->exportPushbot($id, $pushbotExportRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PushbotsApi->exportPushbot: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **pushbotExportRequest** | [**\Catalytic\SDK\Model\PushbotExportRequest**](../Model/PushbotExportRequest.md)| The Pushbot Export request | [optional]

### Return type

[**\Catalytic\SDK\Model\PushbotExport**](../Model/PushbotExport.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## findPushbots

> \Catalytic\SDK\Model\PushbotsPage findPushbots($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)

Find Pushbots

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$query = 'query_example'; // string | Free text query terms to search all attributes for
$status = 'status_example'; // string | Run or task status to search for
$processId = 'processId_example'; // string | Process ID (aka Pushbot ID) to search for
$runId = 'runId_example'; // string | RunID (aka Instance ID) to search for
$owner = 'owner_example'; // string | Run or task owner to search for
$category = 'category_example'; // string | Category of process or run to search for
$participatingUsers = 'participatingUsers_example'; // string | Task assignee to search for
$pageToken = 'pageToken_example'; // string | The token representing the result page to get
$pageSize = 56; // int | The page size requested

try {
    $result = $apiInstance->findPushbots($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
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
 **processId** | **string**| Process ID (aka Pushbot ID) to search for | [optional]
 **runId** | **string**| RunID (aka Instance ID) to search for | [optional]
 **owner** | **string**| Run or task owner to search for | [optional]
 **category** | **string**| Category of process or run to search for | [optional]
 **participatingUsers** | **string**| Task assignee to search for | [optional]
 **pageToken** | **string**| The token representing the result page to get | [optional]
 **pageSize** | **int**| The page size requested | [optional]

### Return type

[**\Catalytic\SDK\Model\PushbotsPage**](../Model/PushbotsPage.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getPushbot

> \Catalytic\SDK\Model\Pushbot getPushbot($id)

Gets details of a specific Pushbot process template

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Pushbot to get

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

[**\Catalytic\SDK\Model\Pushbot**](../Model/Pushbot.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getPushbotExport

> \Catalytic\SDK\Model\PushbotExport getPushbotExport($id)

Fetch an existing PushbotExport request

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The Pushbot Export Id

try {
    $result = $apiInstance->getPushbotExport($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PushbotsApi->getPushbotExport: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The Pushbot Export Id |

### Return type

[**\Catalytic\SDK\Model\PushbotExport**](../Model/PushbotExport.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getPushbotImport

> \Catalytic\SDK\Model\PushbotImport getPushbotImport($id)

Fetch an existing PushbotImport request

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The Pushbot Import Id

try {
    $result = $apiInstance->getPushbotImport($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PushbotsApi->getPushbotImport: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The Pushbot Import Id |

### Return type

[**\Catalytic\SDK\Model\PushbotImport**](../Model/PushbotImport.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## importPushbot

> \Catalytic\SDK\Model\PushbotImport importPushbot($pushbotImportRequest)

Imports a new Pushbot

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\PushbotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pushbotImportRequest = new \Catalytic\SDK\Model\PushbotImportRequest(); // \Catalytic\SDK\Model\PushbotImportRequest | The Pushbot Import request

try {
    $result = $apiInstance->importPushbot($pushbotImportRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PushbotsApi->importPushbot: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **pushbotImportRequest** | [**\Catalytic\SDK\Model\PushbotImportRequest**](../Model/PushbotImportRequest.md)| The Pushbot Import request | [optional]

### Return type

[**\Catalytic\SDK\Model\PushbotImport**](../Model/PushbotImport.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

