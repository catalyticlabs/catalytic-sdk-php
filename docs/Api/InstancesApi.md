# Catalytic\SDK\InstancesApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**findInstances**](InstancesApi.md#findInstances) | **GET** /api/instances | Find Instances
[**getInstance**](InstancesApi.md#getInstance) | **GET** /api/instances/{id} | Gets details of a specific Instance
[**startInstance**](InstancesApi.md#startInstance) | **POST** /api/instances | Starts a new Instance
[**stopInstance**](InstancesApi.md#stopInstance) | **GET** /api/instances/{id}:stop | Stops a specific Instance



## findInstances

> \Catalytic\SDK\Model\InstancesPage findInstances($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)

Find Instances

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstancesApi(
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
    $result = $apiInstance->findInstances($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->findInstances: ', $e->getMessage(), PHP_EOL;
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

[**\Catalytic\SDK\Model\InstancesPage**](../Model/InstancesPage.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getInstance

> \Catalytic\SDK\Model\Instance getInstance($id)

Gets details of a specific Instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance to get

try {
    $result = $apiInstance->getInstance($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->getInstance: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance to get |

### Return type

[**\Catalytic\SDK\Model\Instance**](../Model/Instance.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## startInstance

> \Catalytic\SDK\Model\Instance startInstance($startInstanceRequest)

Starts a new Instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$startInstanceRequest = new \Catalytic\SDK\Model\StartInstanceRequest(); // \Catalytic\SDK\Model\StartInstanceRequest | The details of the Instance to start

try {
    $result = $apiInstance->startInstance($startInstanceRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->startInstance: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **startInstanceRequest** | [**\Catalytic\SDK\Model\StartInstanceRequest**](../Model/StartInstanceRequest.md)| The details of the Instance to start | [optional]

### Return type

[**\Catalytic\SDK\Model\Instance**](../Model/Instance.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stopInstance

> \Catalytic\SDK\Model\Instance stopInstance($id)

Stops a specific Instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance to stop

try {
    $result = $apiInstance->stopInstance($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->stopInstance: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance to stop |

### Return type

[**\Catalytic\SDK\Model\Instance**](../Model/Instance.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

