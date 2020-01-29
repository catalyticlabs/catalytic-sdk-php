# Catalytic\Client\DataTablesApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadDataTable**](DataTablesApi.md#downloaddatatable) | **GET** /api/tables/{id}:download | Download a Data Table as a CSV or Excel file
[**findDataTables**](DataTablesApi.md#finddatatables) | **GET** /api/tables | Find Data Tables
[**getDataTable**](DataTablesApi.md#getdatatable) | **GET** /api/tables/{id} | Get metadata for a Data Table by ID
[**uploadDataTable**](DataTablesApi.md#uploaddatatable) | **POST** /api/tables/:upload | Upload a csv or excel file to create a data table

# **downloadDataTable**
> string downloadDataTable($id, $format)

Download a Data Table as a CSV or Excel file

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Data Table to download
$format = new \Catalytic\Client\Model\DataTableExportFormat(); // \Catalytic\Client\Model\DataTableExportFormat | The format to export the data table in. csv (default) or excel

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
 **format** | [**\Catalytic\Client\Model\DataTableExportFormat**](../Model/.md)| The format to export the data table in. csv (default) or excel | [optional]

### Return type

**string**

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findDataTables**
> \Catalytic\Client\Model\DataTablesPage findDataTables($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size)

Find Data Tables

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\DataTablesApi(
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
    $result = $apiInstance->findDataTables($query, $status, $process_id, $run_id, $owner, $category, $page_token, $page_size);
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
 **process_id** | **string**| Process ID (aka Pushbot ID) to search for | [optional]
 **run_id** | **string**| RunID (aka Instance ID) to search for | [optional]
 **owner** | **string**| Run or task owner to search for | [optional]
 **category** | **string**| Category of process or run to search for | [optional]
 **page_token** | **string**| The token representing the result page to get | [optional]
 **page_size** | **int**| The page size requested | [optional]

### Return type

[**\Catalytic\Client\Model\DataTablesPage**](../Model/DataTablesPage.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getDataTable**
> \Catalytic\Client\Model\DataTable getDataTable($id)

Get metadata for a Data Table by ID

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | The ID of the Data Table to get metadata for

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

[**\Catalytic\Client\Model\DataTable**](../Model/DataTable.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **uploadDataTable**
> \Catalytic\Client\Model\DataTable uploadDataTable($files, $table_name, $header_row, $sheet_number)

Upload a csv or excel file to create a data table

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: Basic
$config = Catalytic\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Catalytic\Client\Api\DataTablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$files = array("files_example"); // string[] | 
$table_name = "table_name_example"; // string | The name of the table to create. Defaults to the file name without the extension
$header_row = 56; // int | The row number that contains the column headers. Defaults to 1.
$sheet_number = 56; // int | The number of the sheet to import. Only applies to Excel files. The first sheet is imported by default.

try {
    $result = $apiInstance->uploadDataTable($files, $table_name, $header_row, $sheet_number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataTablesApi->uploadDataTable: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **files** | [**string[]**](../Model/string.md)|  | [optional]
 **table_name** | **string**| The name of the table to create. Defaults to the file name without the extension | [optional]
 **header_row** | **int**| The row number that contains the column headers. Defaults to 1. | [optional]
 **sheet_number** | **int**| The number of the sheet to import. Only applies to Excel files. The first sheet is imported by default. | [optional]

### Return type

[**\Catalytic\Client\Model\DataTable**](../Model/DataTable.md)

### Authorization

[Basic](../../README.md#Basic)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

