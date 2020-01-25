# Catalytic\Client\ActionExecutionApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**acquireActionTasks**](ActionExecutionApi.md#acquireactiontasks) | **POST** /api/action-tasks/:acquire-tasks | Acquire new Action Tasks to Execute
[**completeActionTask**](ActionExecutionApi.md#completeactiontask) | **POST** /api/action-tasks/{id}:complete | Completes an acquired action task, optionally including output values.
[**createActionTaskComment**](ActionExecutionApi.md#createactiontaskcomment) | **POST** /api/action-tasks/{id}/comments | Post a comment to an action task
[**downloadActionTaskInputFile**](ActionExecutionApi.md#downloadactiontaskinputfile) | **POST** /api/action-tasks/{id}/files/{fileId}:download | Download Task Input File
[**updateActionTask**](ActionExecutionApi.md#updateactiontask) | **POST** /api/action-tasks/{id}:update | Updates an acquired action task. This can incude updates to outputs, progress percent or description, and  can extend the task lock duration.
[**uploadActionTaskOutputFile**](ActionExecutionApi.md#uploadactiontaskoutputfile) | **POST** /api/action-tasks/{id}/files/:upload | Upload a Task Output File

# **acquireActionTasks**
> \Catalytic\Client\Model\AcquiredTasks acquireActionTasks($body)

Acquire new Action Tasks to Execute

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: ActionWorker
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionExecutionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Catalytic\Client\Model\AcquireActionTasksRequest(); // \Catalytic\Client\Model\AcquireActionTasksRequest | Allows specifying the number of tasks to acquire and how long to hold the lock for

try {
    $result = $apiInstance->acquireActionTasks($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionExecutionApi->acquireActionTasks: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Catalytic\Client\Model\AcquireActionTasksRequest**](../Model/AcquireActionTasksRequest.md)| Allows specifying the number of tasks to acquire and how long to hold the lock for | [optional]

### Return type

[**\Catalytic\Client\Model\AcquiredTasks**](../Model/AcquiredTasks.md)

### Authorization

[ActionWorker](../../README.md#ActionWorker)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **completeActionTask**
> \Catalytic\Client\Model\ActionTask completeActionTask($id, $body)

Completes an acquired action task, optionally including output values.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: ActionWorker
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionExecutionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the acquired Action Task to complete
$body = new \Catalytic\Client\Model\ActionTaskCompleteRequest(); // \Catalytic\Client\Model\ActionTaskCompleteRequest | Output parameters, if any.

try {
    $result = $apiInstance->completeActionTask($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionExecutionApi->completeActionTask: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the acquired Action Task to complete |
 **body** | [**\Catalytic\Client\Model\ActionTaskCompleteRequest**](../Model/ActionTaskCompleteRequest.md)| Output parameters, if any. | [optional]

### Return type

[**\Catalytic\Client\Model\ActionTask**](../Model/ActionTask.md)

### Authorization

[ActionWorker](../../README.md#ActionWorker)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createActionTaskComment**
> \Catalytic\Client\Model\ActionTask createActionTaskComment($id, $body)

Post a comment to an action task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: ActionWorker
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionExecutionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the acquired Action Task to complete
$body = new \Catalytic\Client\Model\ActionTaskComment(); // \Catalytic\Client\Model\ActionTaskComment | The comment text to post

try {
    $result = $apiInstance->createActionTaskComment($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionExecutionApi->createActionTaskComment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the acquired Action Task to complete |
 **body** | [**\Catalytic\Client\Model\ActionTaskComment**](../Model/ActionTaskComment.md)| The comment text to post | [optional]

### Return type

[**\Catalytic\Client\Model\ActionTask**](../Model/ActionTask.md)

### Authorization

[ActionWorker](../../README.md#ActionWorker)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **downloadActionTaskInputFile**
> string downloadActionTaskInputFile($id, $file_id)

Download Task Input File

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: ActionWorker
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionExecutionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the acquired Action Task
$file_id = "file_id_example"; // string | The ID of the file input

try {
    $result = $apiInstance->downloadActionTaskInputFile($id, $file_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionExecutionApi->downloadActionTaskInputFile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the acquired Action Task |
 **file_id** | **string**| The ID of the file input |

### Return type

**string**

### Authorization

[ActionWorker](../../README.md#ActionWorker)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateActionTask**
> \Catalytic\Client\Model\ActionTask updateActionTask($id, $body)

Updates an acquired action task. This can incude updates to outputs, progress percent or description, and  can extend the task lock duration.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: ActionWorker
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionExecutionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the acquired Action Task to update
$body = new \Catalytic\Client\Model\ActionTaskUpdateRequest(); // \Catalytic\Client\Model\ActionTaskUpdateRequest | The update request, including updates to outputs, progress percent or description,
            and task lock duration.

try {
    $result = $apiInstance->updateActionTask($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionExecutionApi->updateActionTask: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the acquired Action Task to update |
 **body** | [**\Catalytic\Client\Model\ActionTaskUpdateRequest**](../Model/ActionTaskUpdateRequest.md)| The update request, including updates to outputs, progress percent or description,
            and task lock duration. | [optional]

### Return type

[**\Catalytic\Client\Model\ActionTask**](../Model/ActionTask.md)

### Authorization

[ActionWorker](../../README.md#ActionWorker)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **uploadActionTaskOutputFile**
> \Catalytic\Client\Model\ActionTask uploadActionTaskOutputFile($id, $file, $output_name, $lock_duration_seconds)

Upload a Task Output File

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: ActionWorker
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionExecutionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the acquired Action Task
$file = "file_example"; // string | 
$output_name = "output_name_example"; // string | The name of the output parameter to assocate the upload file with
$lock_duration_seconds = 56; // int | Optional number of seconds to extend the task lock duration

try {
    $result = $apiInstance->uploadActionTaskOutputFile($id, $file, $output_name, $lock_duration_seconds);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionExecutionApi->uploadActionTaskOutputFile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the acquired Action Task |
 **file** | **string****string**|  | [optional]
 **output_name** | **string**| The name of the output parameter to assocate the upload file with | [optional]
 **lock_duration_seconds** | **int**| Optional number of seconds to extend the task lock duration | [optional]

### Return type

[**\Catalytic\Client\Model\ActionTask**](../Model/ActionTask.md)

### Authorization

[ActionWorker](../../README.md#ActionWorker)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

