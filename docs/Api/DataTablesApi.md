# Catalytic\SDK\DataTablesApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadDataTable**](DataTablesApi.md#downloadDataTable) | **GET** /api/tables/{id}:download | Download a Data Table as a CSV or Excel file
[**findDataTables**](DataTablesApi.md#findDataTables) | **GET** /api/tables | Find Data Tables
[**getDataTable**](DataTablesApi.md#getDataTable) | **GET** /api/tables/{id} | Get metadata for a Data Table by ID
[**replaceDataTable**](DataTablesApi.md#replaceDataTable) | **POST** /api/tables/{id}:replace | Replace a Data Table with contents from a CSV or Excel file
[**uploadDataTable**](DataTablesApi.md#uploadDataTable) | **POST** /api/tables/:upload | Upload a csv or excel file to create a data table



## downloadDataTable

> \SplFileObject downloadDataTable($id, $format)

Download a Data Table as a CSV or Excel file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Data Table to download
$format = new \Catalytic\SDK\Model\\Catalytic\SDK\Model\DataTableExportFormat(); // \Catalytic\SDK\Model\DataTableExportFormat | The format to export the data table in. csv (default) or excel

try {
    $result = $apiInstance->downloadDataTable($id, $format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataTablesApi->downloadDataTable: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Data Table to download |
 **format** | [**\Catalytic\SDK\Model\DataTableExportFormat**](../Model/.md)| The format to export the data table in. csv (default) or excel | [optional]

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


## findDataTables

> \Catalytic\SDK\Model\DataTablesPage findDataTables($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)

Find Data Tables

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\DataTablesApi(
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
    $result = $apiInstance->findDataTables($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataTablesApi->findDataTables: ', $e->getMessage(), PHP_EOL;
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

[**\Catalytic\SDK\Model\DataTablesPage**](../Model/DataTablesPage.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getDataTable

> \Catalytic\SDK\Model\DataTable getDataTable($id)

Get metadata for a Data Table by ID

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Data Table to get metadata for

try {
    $result = $apiInstance->getDataTable($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataTablesApi->getDataTable: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Data Table to get metadata for |

### Return type

[**\Catalytic\SDK\Model\DataTable**](../Model/DataTable.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## replaceDataTable

> \SplFileObject replaceDataTable($id, $headerRow, $sheetNumber, $files)

Replace a Data Table with contents from a CSV or Excel file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the Data Table to download
$headerRow = 1; // int | The row number that contains the column headers. Defaults to 1.
$sheetNumber = 1; // int | The number of the sheet to import. Only applies to Excel files. The first sheet is imported by default.
$files = "/path/to/file.txt"; // \SplFileObject[] | 

try {
    $result = $apiInstance->replaceDataTable($id, $headerRow, $sheetNumber, $files);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataTablesApi->replaceDataTable: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The ID of the Data Table to download |
 **headerRow** | **int**| The row number that contains the column headers. Defaults to 1. | [optional] [default to 1]
 **sheetNumber** | **int**| The number of the sheet to import. Only applies to Excel files. The first sheet is imported by default. | [optional] [default to 1]
 **files** | **\SplFileObject[]**|  | [optional]

### Return type

[**\SplFileObject**](../Model/\SplFileObject.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/json, application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## uploadDataTable

> \Catalytic\SDK\Model\DataTable uploadDataTable($tableName, $headerRow, $sheetNumber, $files)

Upload a csv or excel file to create a data table

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tableName = 'tableName_example'; // string | The name of the table to create. Defaults to the file name without the extension
$headerRow = 1; // int | The row number that contains the column headers. Defaults to 1.
$sheetNumber = 1; // int | The number of the sheet to import. Only applies to Excel files. The first sheet is imported by default.
$files = "/path/to/file.txt"; // \SplFileObject[] | 

try {
    $result = $apiInstance->uploadDataTable($tableName, $headerRow, $sheetNumber, $files);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataTablesApi->uploadDataTable: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tableName** | **string**| The name of the table to create. Defaults to the file name without the extension | [optional]
 **headerRow** | **int**| The row number that contains the column headers. Defaults to 1. | [optional] [default to 1]
 **sheetNumber** | **int**| The number of the sheet to import. Only applies to Excel files. The first sheet is imported by default. | [optional] [default to 1]
 **files** | **\SplFileObject[]**|  | [optional]

### Return type

[**\Catalytic\SDK\Model\DataTable**](../Model/DataTable.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

