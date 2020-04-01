<?php
/**
 * UsersApi
 * PHP version 5
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Catalytic SDK API
 *
 * ## API for the Catalytic SDK
 *
 * The version of the OpenAPI document: v1.0.0
 * Contact: developers@catalytic.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.2.3
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Catalytic\SDK\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\Configuration;
use Catalytic\SDK\HeaderSelector;
use Catalytic\SDK\ObjectSerializer;

/**
 * UsersApi Class Doc Comment
 *
 * @category Class
 * @package  Catalytic\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UsersApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $host_index (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $host_index = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $host_index;
    }

    /**
     * Set the host index
     *
     * @param  int Host index (required)
     */
    public function setHostIndex($host_index)
    {
        $this->hostIndex = $host_index;
    }

    /**
     * Get the host index
     *
     * @return Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation findUsers
     *
     * List all users on team
     *
     * @param  string $query Free text query terms to search all attributes for (optional)
     * @param  string $status Run or task status to search for (optional)
     * @param  string $processId Process ID (aka Pushbot ID) to search for (optional)
     * @param  string $runId RunID (aka Instance ID) to search for (optional)
     * @param  string $owner Run or task owner to search for (optional)
     * @param  string $category Category of process or run to search for (optional)
     * @param  string $participatingUsers Task assignee to search for (optional)
     * @param  string $pageToken The token representing the result page to get (optional)
     * @param  int $pageSize The page size requested (optional)
     *
     * @throws \Catalytic\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Catalytic\SDK\Model\ProblemDetails|\Catalytic\SDK\Model\UsersPage
     */
    public function findUsers($query = null, $status = null, $processId = null, $runId = null, $owner = null, $category = null, $participatingUsers = null, $pageToken = null, $pageSize = null)
    {
        list($response) = $this->findUsersWithHttpInfo($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);
        return $response;
    }

    /**
     * Operation findUsersWithHttpInfo
     *
     * List all users on team
     *
     * @param  string $query Free text query terms to search all attributes for (optional)
     * @param  string $status Run or task status to search for (optional)
     * @param  string $processId Process ID (aka Pushbot ID) to search for (optional)
     * @param  string $runId RunID (aka Instance ID) to search for (optional)
     * @param  string $owner Run or task owner to search for (optional)
     * @param  string $category Category of process or run to search for (optional)
     * @param  string $participatingUsers Task assignee to search for (optional)
     * @param  string $pageToken The token representing the result page to get (optional)
     * @param  int $pageSize The page size requested (optional)
     *
     * @throws \Catalytic\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Catalytic\SDK\Model\ProblemDetails|\Catalytic\SDK\Model\UsersPage, HTTP status code, HTTP response headers (array of strings)
     */
    public function findUsersWithHttpInfo($query = null, $status = null, $processId = null, $runId = null, $owner = null, $category = null, $participatingUsers = null, $pageToken = null, $pageSize = null)
    {
        $request = $this->findUsersRequest($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 401:
                    if ('\Catalytic\SDK\Model\ProblemDetails' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Catalytic\SDK\Model\ProblemDetails', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 200:
                    if ('\Catalytic\SDK\Model\UsersPage' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Catalytic\SDK\Model\UsersPage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Catalytic\SDK\Model\UsersPage';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Catalytic\SDK\Model\ProblemDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Catalytic\SDK\Model\UsersPage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation findUsersAsync
     *
     * List all users on team
     *
     * @param  string $query Free text query terms to search all attributes for (optional)
     * @param  string $status Run or task status to search for (optional)
     * @param  string $processId Process ID (aka Pushbot ID) to search for (optional)
     * @param  string $runId RunID (aka Instance ID) to search for (optional)
     * @param  string $owner Run or task owner to search for (optional)
     * @param  string $category Category of process or run to search for (optional)
     * @param  string $participatingUsers Task assignee to search for (optional)
     * @param  string $pageToken The token representing the result page to get (optional)
     * @param  int $pageSize The page size requested (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function findUsersAsync($query = null, $status = null, $processId = null, $runId = null, $owner = null, $category = null, $participatingUsers = null, $pageToken = null, $pageSize = null)
    {
        return $this->findUsersAsyncWithHttpInfo($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation findUsersAsyncWithHttpInfo
     *
     * List all users on team
     *
     * @param  string $query Free text query terms to search all attributes for (optional)
     * @param  string $status Run or task status to search for (optional)
     * @param  string $processId Process ID (aka Pushbot ID) to search for (optional)
     * @param  string $runId RunID (aka Instance ID) to search for (optional)
     * @param  string $owner Run or task owner to search for (optional)
     * @param  string $category Category of process or run to search for (optional)
     * @param  string $participatingUsers Task assignee to search for (optional)
     * @param  string $pageToken The token representing the result page to get (optional)
     * @param  int $pageSize The page size requested (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function findUsersAsyncWithHttpInfo($query = null, $status = null, $processId = null, $runId = null, $owner = null, $category = null, $participatingUsers = null, $pageToken = null, $pageSize = null)
    {
        $returnType = '\Catalytic\SDK\Model\UsersPage';
        $request = $this->findUsersRequest($query, $status, $processId, $runId, $owner, $category, $participatingUsers, $pageToken, $pageSize);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'findUsers'
     *
     * @param  string $query Free text query terms to search all attributes for (optional)
     * @param  string $status Run or task status to search for (optional)
     * @param  string $processId Process ID (aka Pushbot ID) to search for (optional)
     * @param  string $runId RunID (aka Instance ID) to search for (optional)
     * @param  string $owner Run or task owner to search for (optional)
     * @param  string $category Category of process or run to search for (optional)
     * @param  string $participatingUsers Task assignee to search for (optional)
     * @param  string $pageToken The token representing the result page to get (optional)
     * @param  int $pageSize The page size requested (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function findUsersRequest($query = null, $status = null, $processId = null, $runId = null, $owner = null, $category = null, $participatingUsers = null, $pageToken = null, $pageSize = null)
    {

        $resourcePath = '/api/users';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($query !== null) {
            $queryParams['query'] = ObjectSerializer::toQueryValue($query);
        }
        // query params
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status);
        }
        // query params
        if ($processId !== null) {
            $queryParams['process_id'] = ObjectSerializer::toQueryValue($processId);
        }
        // query params
        if ($runId !== null) {
            $queryParams['run_id'] = ObjectSerializer::toQueryValue($runId);
        }
        // query params
        if ($owner !== null) {
            $queryParams['owner'] = ObjectSerializer::toQueryValue($owner);
        }
        // query params
        if ($category !== null) {
            $queryParams['category'] = ObjectSerializer::toQueryValue($category);
        }
        // query params
        if ($participatingUsers !== null) {
            $queryParams['participating_users'] = ObjectSerializer::toQueryValue($participatingUsers);
        }
        // query params
        if ($pageToken !== null) {
            $queryParams['page_token'] = ObjectSerializer::toQueryValue($pageToken);
        }
        // query params
        if ($pageSize !== null) {
            $queryParams['page_size'] = ObjectSerializer::toQueryValue($pageSize);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUser
     *
     * Gets details of a specific User
     *
     * @param  string $id The ID or username of the User to get (required)
     *
     * @throws \Catalytic\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Catalytic\SDK\Model\ProblemDetails|\Catalytic\SDK\Model\ProblemDetails|\Catalytic\SDK\Model\User
     */
    public function getUser($id)
    {
        list($response) = $this->getUserWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getUserWithHttpInfo
     *
     * Gets details of a specific User
     *
     * @param  string $id The ID or username of the User to get (required)
     *
     * @throws \Catalytic\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Catalytic\SDK\Model\ProblemDetails|\Catalytic\SDK\Model\ProblemDetails|\Catalytic\SDK\Model\User, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUserWithHttpInfo($id)
    {
        $request = $this->getUserRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 401:
                    if ('\Catalytic\SDK\Model\ProblemDetails' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Catalytic\SDK\Model\ProblemDetails', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\Catalytic\SDK\Model\ProblemDetails' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Catalytic\SDK\Model\ProblemDetails', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 200:
                    if ('\Catalytic\SDK\Model\User' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Catalytic\SDK\Model\User', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Catalytic\SDK\Model\User';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Catalytic\SDK\Model\ProblemDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Catalytic\SDK\Model\ProblemDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Catalytic\SDK\Model\User',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getUserAsync
     *
     * Gets details of a specific User
     *
     * @param  string $id The ID or username of the User to get (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUserAsync($id)
    {
        return $this->getUserAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserAsyncWithHttpInfo
     *
     * Gets details of a specific User
     *
     * @param  string $id The ID or username of the User to get (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUserAsyncWithHttpInfo($id)
    {
        $returnType = '\Catalytic\SDK\Model\User';
        $request = $this->getUserRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUser'
     *
     * @param  string $id The ID or username of the User to get (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getUserRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getUser'
            );
        }

        $resourcePath = '/api/users/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
