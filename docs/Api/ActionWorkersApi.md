# Swagger\Client\ActionWorkersApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createActionWorker**](ActionWorkersApi.md#createactionworker) | **POST** /api/action-workers | Define a new Action Worker
[**deleteActionWorker**](ActionWorkersApi.md#deleteactionworker) | **DELETE** /api/action-workers/{id} | Deletes a specific Action Worker
[**findActionWorkers**](ActionWorkersApi.md#findactionworkers) | **GET** /api/action-workers | Find ActionWorkers
[**getActionWorker**](ActionWorkersApi.md#getactionworker) | **GET** /api/action-workers/{id} | Gets details of a specific Action Worker
[**updateActionWorker**](ActionWorkersApi.md#updateactionworker) | **PATCH** /api/action-workers/{id} | Update an Action Worker

# **createActionWorker**
> \Swagger\Client\Model\ActionWorkerWithCredentials createActionWorker($body)

Define a new Action Worker

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\ActionWorkersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Model\CreateActionWorkerRequest(); // \Swagger\Client\Model\CreateActionWorkerRequest | The definition of the action worker to create

try {
    $result = $apiInstance->createActionWorker($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionWorkersApi->createActionWorker: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\CreateActionWorkerRequest**](../Model/CreateActionWorkerRequest.md)| The definition of the action worker to create | [optional]

### Return type

[**\Swagger\Client\Model\ActionWorkerWithCredentials**](../Model/ActionWorkerWithCredentials.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteActionWorker**
> \Swagger\Client\Model\IActionResult deleteActionWorker($id)

Deletes a specific Action Worker

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\ActionWorkersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Action Worker to delete

try {
    $result = $apiInstance->deleteActionWorker($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionWorkersApi->deleteActionWorker: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Action Worker to delete |

### Return type

[**\Swagger\Client\Model\IActionResult**](../Model/IActionResult.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findActionWorkers**
> \Swagger\Client\Model\ActionWorkersPage findActionWorkers($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find ActionWorkers

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\ActionWorkersApi(
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
    $result = $apiInstance->findActionWorkers($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionWorkersApi->findActionWorkers: ', $e->getMessage(), PHP_EOL;
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

[**\Swagger\Client\Model\ActionWorkersPage**](../Model/ActionWorkersPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getActionWorker**
> \Swagger\Client\Model\ActionWorker getActionWorker($id)

Gets details of a specific Action Worker

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\ActionWorkersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Action Worker to get

try {
    $result = $apiInstance->getActionWorker($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionWorkersApi->getActionWorker: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Action Worker to get |

### Return type

[**\Swagger\Client\Model\ActionWorker**](../Model/ActionWorker.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateActionWorker**
> \Swagger\Client\Model\ActionWorker updateActionWorker($id, $body)

Update an Action Worker

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Swagger\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Swagger\Client\Api\ActionWorkersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The id of the action worker to update
$body = new \Swagger\Client\Model\UpdateActionWorkerRequest(); // \Swagger\Client\Model\UpdateActionWorkerRequest | The updates to apply to the action worker

try {
    $result = $apiInstance->updateActionWorker($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionWorkersApi->updateActionWorker: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The id of the action worker to update |
 **body** | [**\Swagger\Client\Model\UpdateActionWorkerRequest**](../Model/UpdateActionWorkerRequest.md)| The updates to apply to the action worker | [optional]

### Return type

[**\Swagger\Client\Model\ActionWorker**](../Model/ActionWorker.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

