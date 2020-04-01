# Catalytic\SDK\InstanceStepsApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**completeStep**](InstanceStepsApi.md#completeStep) | **POST** /api/instances/{instanceId}/steps/{id}:complete | Completes an Instance Step
[**findInstanceSteps**](InstanceStepsApi.md#findInstanceSteps) | **GET** /api/instances/{instanceId}/steps | Find Instance Steps
[**getInstanceStep**](InstanceStepsApi.md#getInstanceStep) | **GET** /api/instances/{instanceId}/steps/{id} | Gets details of a specific Instance Step
[**reassignStep**](InstanceStepsApi.md#reassignStep) | **POST** /api/instances/{instanceId}/steps/{id}:reassign | Reassigns a Instance Step
[**snoozeStep**](InstanceStepsApi.md#snoozeStep) | **POST** /api/instances/{instanceId}/steps/{id}:snooze | Snooze a pending Instance Step
[**startStep**](InstanceStepsApi.md#startStep) | **POST** /api/instances/{instanceId}/steps/{id}:start | Starts a pending Instance Step



## completeStep

> \Catalytic\SDK\Model\InstanceStep completeStep($id, $instanceId, $completeStepRequest)

Completes an Instance Step

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance Step to complete
$instanceId = 'instanceId_example'; // string | 
$completeStepRequest = new \Catalytic\SDK\Model\CompleteStepRequest(); // \Catalytic\SDK\Model\CompleteStepRequest | The values of the fields to complete the task with

try {
    $result = $apiInstance->completeStep($id, $instanceId, $completeStepRequest);
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
 **instanceId** | **string**|  |
 **completeStepRequest** | [**\Catalytic\SDK\Model\CompleteStepRequest**](../Model/CompleteStepRequest.md)| The values of the fields to complete the task with | [optional]

### Return type

[**\Catalytic\SDK\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## findInstanceSteps

> \Catalytic\SDK\Model\InstanceStepsPage findInstanceSteps($instanceId, $query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)

Find Instance Steps

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$instanceId = 'instanceId_example'; // string | The ID of the Instance
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
    $result = $apiInstance->findInstanceSteps($instanceId, $query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceStepsApi->findInstanceSteps: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **instanceId** | **string**| The ID of the Instance |
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

[**\Catalytic\SDK\Model\InstanceStepsPage**](../Model/InstanceStepsPage.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getInstanceStep

> \Catalytic\SDK\Model\InstanceStep getInstanceStep($id, $instanceId)

Gets details of a specific Instance Step

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance Steps to get
$instanceId = 'instanceId_example'; // string | 

try {
    $result = $apiInstance->getInstanceStep($id, $instanceId);
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
 **instanceId** | **string**|  |

### Return type

[**\Catalytic\SDK\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## reassignStep

> \Catalytic\SDK\Model\InstanceStep reassignStep($id, $instanceId, $reassignStepRequest)

Reassigns a Instance Step

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance Step to reassign
$instanceId = 'instanceId_example'; // string | 
$reassignStepRequest = new \Catalytic\SDK\Model\ReassignStepRequest(); // \Catalytic\SDK\Model\ReassignStepRequest | Contains the email address of the user to reassign the Instance Step to

try {
    $result = $apiInstance->reassignStep($id, $instanceId, $reassignStepRequest);
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
 **instanceId** | **string**|  |
 **reassignStepRequest** | [**\Catalytic\SDK\Model\ReassignStepRequest**](../Model/ReassignStepRequest.md)| Contains the email address of the user to reassign the Instance Step to | [optional]

### Return type

[**\Catalytic\SDK\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## snoozeStep

> \Catalytic\SDK\Model\InstanceStep snoozeStep($id, $instanceId)

Snooze a pending Instance Step

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance Step to snooze
$instanceId = 'instanceId_example'; // string | 

try {
    $result = $apiInstance->snoozeStep($id, $instanceId);
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
 **instanceId** | **string**|  |

### Return type

[**\Catalytic\SDK\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## startStep

> \Catalytic\SDK\Model\InstanceStep startStep($id, $instanceId)

Starts a pending Instance Step

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\InstanceStepsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Instance Step to start
$instanceId = 'instanceId_example'; // string | 

try {
    $result = $apiInstance->startStep($id, $instanceId);
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
 **instanceId** | **string**|  |

### Return type

[**\Catalytic\SDK\Model\InstanceStep**](../Model/InstanceStep.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

