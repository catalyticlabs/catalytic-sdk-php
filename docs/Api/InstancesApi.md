# Catalytic\Client\InstancesApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**findInstances**](InstancesApi.md#findinstances) | **GET** /api/instances | Find Instances
[**getInstance**](InstancesApi.md#getinstance) | **GET** /api/instances/{id} | Gets details of a specific Instance
[**startInstance**](InstancesApi.md#startinstance) | **POST** /api/instances | Starts a new Instance
[**stopInstance**](InstancesApi.md#stopinstance) | **GET** /api/instances/{id}:stop | Stops a specific Instance

# **findInstances**
> \Catalytic\Client\Model\InstancesPage findInstances($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find Instances

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\InstancesApi(
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
    $result = $apiInstance->findInstances($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
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
 **process_id** | **string**| Process ID (aka Pushbot ID) to search for | [optional]
 **run_id** | **string**| RunID (aka Instance ID) to search for | [optional]
 **owner** | **string**| Run or task owner to search for | [optional]
 **category** | **string**| Category of process or run to search for | [optional]
 **page_token** | **string**| The token representing the result page to get | [optional]
 **page_size** | **int**| The page size requested | [optional]

### Return type

[**\Catalytic\Client\Model\InstancesPage**](../Model/InstancesPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getInstance**
> \Catalytic\Client\Model\Instance getInstance($id)

Gets details of a specific Instance

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance to get

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

[**\Catalytic\Client\Model\Instance**](../Model/Instance.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **startInstance**
> \Catalytic\Client\Model\Instance startInstance($body)

Starts a new Instance

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Catalytic\Client\Model\StartInstanceRequest(); // \Catalytic\Client\Model\StartInstanceRequest | The details of the Instance to start

try {
    $result = $apiInstance->startInstance($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->startInstance: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Catalytic\Client\Model\StartInstanceRequest**](../Model/StartInstanceRequest.md)| The details of the Instance to start | [optional]

### Return type

[**\Catalytic\Client\Model\Instance**](../Model/Instance.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **stopInstance**
> \Catalytic\Client\Model\Instance stopInstance($id)

Stops a specific Instance

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance to stop

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

[**\Catalytic\Client\Model\Instance**](../Model/Instance.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

