# Catalytic\SDK\UserCredentialsApi

All URIs are relative to *https://catalyticsdkapi.azurewebsites.net*

Method | HTTP request | Description
------------- | ------------- | -------------
[**findCredentials**](UserCredentialsApi.md#findCredentials) | **GET** /api/credentials | Find User Tokens
[**getCredentials**](UserCredentialsApi.md#getCredentials) | **GET** /api/credentials/{id} | 
[**revokeCredentials**](UserCredentialsApi.md#revokeCredentials) | **PATCH** /api/credentials/{id}:revoke | Revoke User Token



## findCredentials

> \Catalytic\SDK\Model\CredentialsPage findCredentials($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)

Find User Tokens

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\UserCredentialsApi(
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
    $result = $apiInstance->findCredentials($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserCredentialsApi->findCredentials: ', $e->getMessage(), PHP_EOL;
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

[**\Catalytic\SDK\Model\CredentialsPage**](../Model/CredentialsPage.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getCredentials

> \Catalytic\SDK\Model\Credentials getCredentials($id)



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\UserCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 

try {
    $result = $apiInstance->getCredentials($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserCredentialsApi->getCredentials: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |

### Return type

[**\Catalytic\SDK\Model\Credentials**](../Model/Credentials.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## revokeCredentials

> \Catalytic\SDK\Model\Credentials revokeCredentials($id)

Revoke User Token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: Bearer
$config = Catalytic\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Catalytic\SDK\Api\UserCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The public Access Identifier of the Credentials

try {
    $result = $apiInstance->revokeCredentials($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserCredentialsApi->revokeCredentials: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The public Access Identifier of the Credentials |

### Return type

[**\Catalytic\SDK\Model\Credentials**](../Model/Credentials.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

