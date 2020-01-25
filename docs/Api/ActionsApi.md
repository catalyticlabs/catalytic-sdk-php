# Catalytic\Client\ActionsApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAction**](ActionsApi.md#createaction) | **POST** /api/actions | Define a new Action
[**deleteAction**](ActionsApi.md#deleteaction) | **DELETE** /api/actions/{id} | Deletes a specific Action definition
[**findActions**](ActionsApi.md#findactions) | **GET** /api/actions | Find Actions
[**getAction**](ActionsApi.md#getaction) | **GET** /api/actions/{id} | Gets details of a specific Action definition
[**updateAction**](ActionsApi.md#updateaction) | **PATCH** /api/actions/{id} | Update an Action

# **createAction**
> \Catalytic\Client\Model\Action createAction($body)

Define a new Action

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Catalytic\Client\Model\RegisterActionRequest(); // \Catalytic\Client\Model\RegisterActionRequest | The definition of the action to create

try {
    $result = $apiInstance->createAction($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionsApi->createAction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Catalytic\Client\Model\RegisterActionRequest**](../Model/RegisterActionRequest.md)| The definition of the action to create | [optional]

### Return type

[**\Catalytic\Client\Model\Action**](../Model/Action.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteAction**
> \Catalytic\Client\Model\IActionResult deleteAction($id)

Deletes a specific Action definition

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Action to delete

try {
    $result = $apiInstance->deleteAction($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionsApi->deleteAction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Action to delete |

### Return type

[**\Catalytic\Client\Model\IActionResult**](../Model/IActionResult.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findActions**
> \Catalytic\Client\Model\ActionsPage findActions($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find Actions

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionsApi(
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
    $result = $apiInstance->findActions($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionsApi->findActions: ', $e->getMessage(), PHP_EOL;
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

[**\Catalytic\Client\Model\ActionsPage**](../Model/ActionsPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAction**
> \Catalytic\Client\Model\Action getAction($id)

Gets details of a specific Action definition

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Action to get

try {
    $result = $apiInstance->getAction($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionsApi->getAction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Action to get |

### Return type

[**\Catalytic\Client\Model\Action**](../Model/Action.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateAction**
> \Catalytic\Client\Model\Action updateAction($id, $body)

Update an Action

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\ActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The id of the action to update
$body = new \Catalytic\Client\Model\UpdateActionRequest(); // \Catalytic\Client\Model\UpdateActionRequest | The updates to apply to the action

try {
    $result = $apiInstance->updateAction($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ActionsApi->updateAction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The id of the action to update |
 **body** | [**\Catalytic\Client\Model\UpdateActionRequest**](../Model/UpdateActionRequest.md)| The updates to apply to the action | [optional]

### Return type

[**\Catalytic\Client\Model\Action**](../Model/Action.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: application/json-patch+json, application/json, text/json, application/_*+json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

