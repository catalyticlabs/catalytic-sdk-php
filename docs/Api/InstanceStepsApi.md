# Swagger\Client\InstanceStepsApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**completeStep**](InstanceStepsApi.md#completestep) | **POST** /api/instances/{instanceId}/steps/{id}:complete | Completes an Instance Step
[**findInstanceSteps**](InstanceStepsApi.md#findinstancesteps) | **GET** /api/instances/{instanceId}/steps | Find Instance Steps
[**getInstanceStep**](InstanceStepsApi.md#getinstancestep) | **GET** /api/instances/{instanceId}/steps/{id} | Gets details of a specific Instance Step
[**reassignStep**](InstanceStepsApi.md#reassignstep) | **POST** /api/instances/{instanceId}/steps/{id}:reassign | Reassigns a Instance Step
[**snoozeStep**](InstanceStepsApi.md#snoozestep) | **POST** /api/instances/{instanceId}/steps/{id}:snooze | Snooze a pending Instance Step
[**startStep**](InstanceStepsApi.md#startstep) | **POST** /api/instances/{instanceId}/steps/{id}:start | Starts a pending Instance Step

# **completeStep**
> \Swagger\Client\Model\InstanceStep completeStep($id, $instance_id, $body)

Completes an Instance Step

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance Step to complete
$instance_id = "instance_id_example"; // string | 
$body = new \Swagger\Client\Model\CompleteStepRequest(); // \Swagger\Client\Model\CompleteStepRequest | The values of the fields to complete the task with

try {
    $result = $apiInstance->completeStep($id, $instance_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->completeStep: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance Step to complete |
 **instance_id** | **string**|  |
 **body** | [**\Swagger\Client\Model\CompleteStepRequest**](../Model/CompleteStepRequest.md)| The values of the fields to complete the task with | [optional]

### Return type

[**\Swagger\Client\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findInstanceSteps**
> \Swagger\Client\Model\InstanceStepsPage findInstanceSteps($instance_id, $query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find Instance Steps

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$instance_id = "instance_id_example"; // string | The ID of the Instance
$query = "query_example"; // string | Free text query terms to search all attributes for
$status = "status_example"; // string | Run or task status to search for
$process_id = "process_id_example"; // string | Process ID (aka Pushbot ID) to search for
$run_id = "run_id_example"; // string | RunID (aka Instance ID) to search for
$owner = "owner_example"; // string | Run or task owner to search for
$category = "category_example"; // string | Category of process or run to search for
$page_token = "page_token_example"; // string | The token representing the result page to get
$page_size = 56; // int | The page size requested

try {
    $result = $apiInstance->findInstanceSteps($instance_id, $query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->findInstanceSteps: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **instance_id** | **string**| The ID of the Instance |
 **query** | **string**| Free text query terms to search all attributes for | [optional]
 **status** | **string**| Run or task status to search for | [optional]
 **process_id** | **string**| Process ID (aka Pushbot ID) to search for | [optional]
 **run_id** | **string**| RunID (aka Instance ID) to search for | [optional]
 **owner** | **string**| Run or task owner to search for | [optional]
 **category** | **string**| Category of process or run to search for | [optional]
 **page_token** | **string**| The token representing the result page to get | [optional]
 **page_size** | **int**| The page size requested | [optional]

### Return type

[**\Swagger\Client\Model\InstanceStepsPage**](../Model/InstanceStepsPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getInstanceStep**
> \Swagger\Client\Model\InstanceStep getInstanceStep($id, $instance_id)

Gets details of a specific Instance Step

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance Steps to get
$instance_id = "instance_id_example"; // string | 

try {
    $result = $apiInstance->getInstanceStep($id, $instance_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->getInstanceStep: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance Steps to get |
 **instance_id** | **string**|  |

### Return type

[**\Swagger\Client\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reassignStep**
> \Swagger\Client\Model\InstanceStep reassignStep($id, $instance_id, $body)

Reassigns a Instance Step

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance Step to reassign
$instance_id = "instance_id_example"; // string | 
$body = new \Swagger\Client\Model\ReassignTaskRequest(); // \Swagger\Client\Model\ReassignTaskRequest | Contains the email address of the user to reassign the Instance Step to

try {
    $result = $apiInstance->reassignStep($id, $instance_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->reassignStep: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance Step to reassign |
 **instance_id** | **string**|  |
 **body** | [**\Swagger\Client\Model\ReassignTaskRequest**](../Model/ReassignTaskRequest.md)| Contains the email address of the user to reassign the Instance Step to | [optional]

### Return type

[**\Swagger\Client\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **snoozeStep**
> \Swagger\Client\Model\InstanceStep snoozeStep($id, $instance_id)

Snooze a pending Instance Step

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance Step to snooze
$instance_id = "instance_id_example"; // string | 

try {
    $result = $apiInstance->snoozeStep($id, $instance_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->snoozeStep: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance Step to snooze |
 **instance_id** | **string**|  |

### Return type

[**\Swagger\Client\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **startStep**
> \Swagger\Client\Model\InstanceStep startStep($id, $instance_id)

Starts a pending Instance Step

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Instance Step to start
$instance_id = "instance_id_example"; // string | 

try {
    $result = $apiInstance->startStep($id, $instance_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->startStep: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Instance Step to start |
 **instance_id** | **string**|  |

### Return type

[**\Swagger\Client\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

