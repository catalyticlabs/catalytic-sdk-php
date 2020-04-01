# Catalytic\SDK\FilesApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadFile**](FilesApi.md#downloadFile) | **GET** /api/files/{id}:download | Download a file
[**findFiles**](FilesApi.md#findFiles) | **GET** /api/files | Find Files
[**getFile**](FilesApi.md#getFile) | **GET** /api/files/{id} | Get metadata of a file
[**uploadFiles**](FilesApi.md#uploadFiles) | **POST** /api/files/:upload | Upload a file



## downloadFile

> \SplFileObject downloadFile($id)

Download a file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the file to download

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

[**\SplFileObject**](../Model/\SplFileObject.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json, application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## findFiles

> \Catalytic\SDK\Model\FilesPage findFiles($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)

Find Files

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\FilesApi(
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
    $result = $apiInstance->findFiles($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
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
 **processId** | **string**| Process ID (aka Pushbot ID) to search for | [optional]
 **runId** | **string**| RunID (aka Instance ID) to search for | [optional]
 **owner** | **string**| Run or task owner to search for | [optional]
 **category** | **string**| Category of process or run to search for | [optional]
 **participatingUsers** | **string**| Task assignee to search for | [optional]
 **pageToken** | **string**| The token representing the result page to get | [optional]
 **pageSize** | **int**| The page size requested | [optional]

### Return type

[**\Catalytic\SDK\Model\FilesPage**](../Model/FilesPage.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getFile

> \Catalytic\SDK\Model\File getFile($id)

Get metadata of a file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the File to get metadata for

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

[**\Catalytic\SDK\Model\File**](../Model/File.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## uploadFiles

> \Catalytic\SDK\Model\File uploadFiles($files)

Upload a file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$files = "/path/to/file.txt"; // \SplFileObject[] | 

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
 **files** | **\SplFileObject[]**|  | [optional]

### Return type

[**\Catalytic\SDK\Model\File**](../Model/File.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

