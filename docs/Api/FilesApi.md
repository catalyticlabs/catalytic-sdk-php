# Catalytic\Client\FilesApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadFile**](FilesApi.md#downloadfile) | **GET** /api/files/{id}:download | Download a file
[**findFiles**](FilesApi.md#findfiles) | **GET** /api/files | Find Files
[**getFile**](FilesApi.md#getfile) | **GET** /api/files/{id} | Get metadata of a file
[**uploadFiles**](FilesApi.md#uploadfiles) | **POST** /api/files/:upload | Upload a file

# **downloadFile**
> string downloadFile($id)

Download a file

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the file to download

try {
    $result = $apiInstance->downloadFile($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->downloadFile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the file to download |

### Return type

**string**

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findFiles**
> \Catalytic\Client\Model\FilesPage findFiles($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find Files

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\FilesApi(
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
    $result = $apiInstance->findFiles($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->findFiles: ', $e->getMessage(), PHP_EOL;
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

[**\Catalytic\Client\Model\FilesPage**](../Model/FilesPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getFile**
> \Catalytic\Client\Model\File getFile($id)

Get metadata of a file

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the File to get metadata for

try {
    $result = $apiInstance->getFile($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->getFile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the File to get metadata for |

### Return type

[**\Catalytic\Client\Model\File**](../Model/File.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **uploadFiles**
> \Catalytic\Client\Model\File uploadFiles($files)

Upload a file

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$files = array("files_example"); // string[] | 

try {
    $result = $apiInstance->uploadFiles($files);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->uploadFiles: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **files** | [**string[]**](../Model/string.md)|  | [optional]

### Return type

[**\Catalytic\Client\Model\File**](../Model/File.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

