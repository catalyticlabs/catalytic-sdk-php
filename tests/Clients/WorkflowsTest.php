<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Workflows;
use Catalytic\SDK\Entities\File;
use Catalytic\SDK\Search\Where;
use Catalytic\SDK\Entities\Workflow;
use Catalytic\SDK\Exceptions\AccessTokenNotFoundException;
use Catalytic\SDK\Exceptions\InternalErrorException;
use Catalytic\SDK\Exceptions\UnauthorizedException;
use Catalytic\SDK\Exceptions\WorkflowNotFoundException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WorkflowsTest extends MockeryTestCase
{
    protected function tearDown(): void
    {
        // Delete the file that was created in any of the tests
        if (file_exists('foobar')) {
            unlink('foobar');
        }
    }

    public function testGetWorkflow_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $workflowsClient = new Workflows(null);
        $workflowsClient->get('1234');
    }

    public function testGetWorkflow_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('getWorkflow')
        ->andThrow(new ApiException(null, 401));

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflowsClient->get('1234');
    }

    public function testGetWorkflow_ItShouldThrowWorkflowNotFoundExceptionIfWorkflowDoesNotExist()
    {
        $this->expectException(WorkflowNotFoundException::class);
        $this->expectExceptionMessage("Workflow with id 1234 not found");

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('getWorkflow')
        ->andThrow(new ApiException(null, 404));

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflowsClient->get('1234');
    }

    public function testGetWorkflow_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get Workflow");

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('getWorkflow')
        ->andThrow(new ApiException(null, 500));

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflowsClient->get('alice@catalytic.com');
    }

    public function testGetWorkflow_ItShouldGetAWorkflow()
    {
        $workflow = new \Catalytic\SDK\Model\Workflow(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Workflow',
                'teamName' => 'example',
                'category' => 'General',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'inputFields' => array(),
                'isPublished' => true,
                'isArchived' => false,
                'fieldVisibility' => 'foo',
                'instanceVisibility' => 'bar',
                'adminWorkflows' => array(),
                'standardWorkflows' => array(),
                'adminUsers' => array(),
                'standardUsers' => array()
            )
        );
        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('getWorkflow')
        ->andReturn($workflow);

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflow = $workflowsClient->get('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(Workflow::class, $workflow);
    }

    // public function testFindWorkflow_ItShouldReturnAccessTokenNotFoundException()
    // {
    //     $this->expectException(AccessTokenNotFoundException::class);
    //     $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

    //     $workflowsClient = new Workflows(null);
    //     $workflowsClient->find();
    // }

    // public function testFindWorkflows_ItShouldThrowUnauthorizedExceptionIfWorkflowDoesNotExist()
    // {
    //     $this->expectException(UnauthorizedException::class);
    //     $this->expectExceptionMessage("Unauthorized");

    //     $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
    //     $workflowsApi->shouldReceive('findWorkflows')
    //     ->andThrow(new ApiException(null, 401));

    //     $workflowsClient = new Workflows('1234', $workflowsApi);
    //     $workflowsClient->find();
    // }

    // public function testFindWorkflows_ItShouldThrowUInternalErrorExceptionIfWorkflowDoesNotExist()
    // {
    //     $this->expectException(InternalErrorException::class);
    //     $this->expectExceptionMessage("Unable to find Workflows");

    //     $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
    //     $workflowsApi->shouldReceive('findWorkflows')
    //     ->andThrow(new ApiException(null, 500));

    //     $workflowsClient = new Workflows('1234', $workflowsApi);
    //     $workflowsClient->find();
    // }

    // public function testFindWorkflows_ItShouldFindAllWorkflows()
    // {
    //     $workflow = new \Catalytic\SDK\Model\Workflow(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'name' => 'Example Workflow',
    //             'teamName' => 'example',
    //             'category' => 'General',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'inputFields' => array(),
    //             'isPublished' => true,
    //             'isArchived' => false,
    //             'fieldVisibility' => 'foo',
    //             'instanceVisibility' => 'bar',
    //             'adminWorkflows' => array(),
    //             'standardWorkflows' => array(),
    //             'adminUsers' => array(),
    //             'standardUsers' => array()
    //         )
    //     );
    //     $workflowsPage = new \Catalytic\SDK\Model\WorkflowsPage(
    //         array(
    //             'workflows' => array($workflow),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
    //     $workflowsApi->shouldReceive('findWorkflows')
    //         ->andReturn($workflowsPage);

    //     $workflowsClient = new Workflows('1234', $workflowsApi);

    //     $results = $workflowsClient->find();
    //     $workflows = $results->getWorkflows();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $workflowsClient()->find(null, $results->getNextPageToken());
    //         $workflows = array_merge($workflows, $results->getWorkflows());
    //     }

    //     $this->assertEquals(count($workflows), 1);
    // }

    // public function testFindWorkflows_ItShouldFindWorkflowsWithNameAlice()
    // {
    //     $workflow = new \Catalytic\SDK\Model\Workflow(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'name' => 'Example Workflow',
    //             'teamName' => 'example',
    //             'category' => 'General',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'inputFields' => array(),
    //             'isPublished' => true,
    //             'isArchived' => false,
    //             'fieldVisibility' => 'foo',
    //             'instanceVisibility' => 'bar',
    //             'adminWorkflows' => array(),
    //             'standardWorkflows' => array(),
    //             'adminUsers' => array(),
    //             'standardUsers' => array()
    //         )
    //     );
    //     $workflowsPage = new \Catalytic\SDK\Model\WorkflowsPage(
    //         array(
    //             'workflows' => array($workflow),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
    //     $workflowsApi->shouldReceive('findWorkflows')
    //         ->andReturn($workflowsPage);

    //     $workflowsClient = new Workflows('1234', $workflowsApi);

    //     $where = (new Where())->text()->matches('tom');
    //     $results = $workflowsClient->find($where);
    //     $workflows = $results->getWorkflows();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $workflowsClient()->find($where, $results->getNextPageToken());
    //         $workflows = array_merge($workflows, $results->getWorkflows());
    //     }

    //     $this->assertEquals(count($workflows), 1);
    // }

    // public function testFindWorkflows_ItShouldFindWorkflowsWithOwnerAlice()
    // {
    //     $workflow = new \Catalytic\SDK\Model\Workflow(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'name' => 'Example Workflow',
    //             'teamName' => 'example',
    //             'category' => 'General',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'inputFields' => array(),
    //             'isPublished' => true,
    //             'isArchived' => false,
    //             'fieldVisibility' => 'foo',
    //             'instanceVisibility' => 'bar',
    //             'adminWorkflows' => array(),
    //             'standardWorkflows' => array(),
    //             'adminUsers' => array(),
    //             'standardUsers' => array()
    //         )
    //     );
    //     $workflowsPage = new \Catalytic\SDK\Model\WorkflowsPage(
    //         array(
    //             'workflows' => array($workflow),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
    //     $workflowsApi->shouldReceive('findWorkflows')
    //     ->andReturn($workflowsPage);

    //     $workflowsClient = new Workflows('1234', $workflowsApi);

    //     $where = (new Where())->owner()->is('alice');
    //     $results = $workflowsClient->find($where);
    //     $workflows = $results->getWorkflows();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $workflowsClient()->find($where, $results->getNextPageToken());
    //         $workflows = array_merge($workflows, $results->getWorkflows());
    //     }

    //     $this->assertEquals(count($workflows), 1);
    // }

    // public function testFindWorkflows_ItShouldFindWorkflowsWithCategoryGeneral()
    // {
    //     $workflow = new \Catalytic\SDK\Model\Workflow(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'name' => 'Example Workflow',
    //             'teamName' => 'example',
    //             'category' => 'General',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'inputFields' => array(),
    //             'isPublished' => true,
    //             'isArchived' => false,
    //             'fieldVisibility' => 'foo',
    //             'instanceVisibility' => 'bar',
    //             'adminWorkflows' => array(),
    //             'standardWorkflows' => array(),
    //             'adminUsers' => array(),
    //             'standardUsers' => array()
    //         )
    //     );
    //     $workflowsPage = new \Catalytic\SDK\Model\WorkflowsPage(
    //         array(
    //             'workflows' => array($workflow),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
    //     $workflowsApi->shouldReceive('findWorkflows')
    //     ->andReturn($workflowsPage);

    //     $workflowsClient = new Workflows('1234', $workflowsApi);

    //     $where = (new Where())->category()->is('general');
    //     $results = $workflowsClient->find($where);
    //     $workflows = $results->getWorkflows();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $workflowsClient()->find($where, $results->getNextPageToken());
    //         $workflows = array_merge($workflows, $results->getWorkflows());
    //     }

    //     $this->assertEquals(count($workflows), 1);
    // }

    public function testExportWorkflow_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $workflowsClient = new Workflows(null);
        $workflowsClient->export('1234');
    }

    public function testExportWorkflow_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('exportWorkflow')
        ->andThrow(new ApiException(null, 401));

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflowsClient->export('1234');
    }

    public function testExportWorkflow_ItShouldThrowWorkflowNotFoundExceptionIfWorkflowDoesNotExist()
    {
        $this->expectException(WorkflowNotFoundException::class);
        $this->expectExceptionMessage("Workflow with id 1234 not found");

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('exportWorkflow')
        ->andThrow(new ApiException(null, 404));

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflowsClient->export('1234');
    }

    public function testExportWorkflow_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to export Workflow with id 1234");

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('exportWorkflow')
        ->andThrow(new ApiException(null, 500));

        $workflowsClient = new Workflows('1234', $workflowsApi);
        $workflowsClient->export('1234');
    }

    public function testExportWorkflow_ItShouldThrowInternalErrorExceptionIfErrorFetchingWorkflowExport()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to export Workflow with id 7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd");

        $initialWorkflowExport = new \Catalytic\SDK\Model\WorkflowExport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053'
            )
        );

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('exportWorkflow')->andReturn($initialWorkflowExport);
        $workflowsApi->shouldReceive('getWorkflowExport')->andThrow(new ApiException(null, 500));
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('get')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflow = $workflowsClient->export('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(File::class, $workflow);
    }

    public function testExportWorkflow_ItShouldExportAWorkflow()
    {
        $initialWorkflowExport = new \Catalytic\SDK\Model\WorkflowExport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053'
            )
        );

        $workflowExport = new \Catalytic\SDK\Model\WorkflowExport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053',
                'fileId' => '47fedd20-9a68-42bf-b7ac-3033a5d89aca'
            )
        );

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('exportWorkflow')->andReturn($initialWorkflowExport);
        $workflowsApi->shouldReceive('getWorkflowExport')->andReturn($workflowExport);
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('get')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflow = $workflowsClient->export('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(File::class, $workflow);
    }

    public function testExportWorkflow_ItShouldExportAWorkflowWithAPassword()
    {
        $initialWorkflowExport = new \Catalytic\SDK\Model\WorkflowExport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053'
            )
        );

        $workflowExport = new \Catalytic\SDK\Model\WorkflowExport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053',
                'fileId' => '47fedd20-9a68-42bf-b7ac-3033a5d89aca'
            )
        );

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );

        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('exportWorkflow')->andReturn($initialWorkflowExport);
        $workflowsApi->shouldReceive('getWorkflowExport')->andReturn($workflowExport);
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('get')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflow = $workflowsClient->export('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd', 'my-password');
        $this->assertInstanceOf(File::class, $workflow);
    }

    public function testImportWorkflow_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $workflowsClient = new Workflows(null);
        $workflowsClient->import('1234');
    }

    public function testImportWorkflow_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );
        $importFile = new SplFileObject('foobar', 'w');
        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('importWorkflow')->andThrow(new ApiException(null, 401));
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('upload')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflowsClient->import($importFile);
    }

    public function testImportWorkflow_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage('Unable to import Workflow');

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );
        $importFile = new SplFileObject('foobar', 'w');
        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('importWorkflow')->andThrow(new ApiException(null, 500));
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('upload')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflowsClient->import($importFile);
    }

    public function testImportWorkflow_ItShouldThrowInternalErrorExceptionIfErrorFetchingWorkflowImport()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to import Workflow");

        $initialWorkflowImport = new \Catalytic\SDK\Model\WorkflowImport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053'
            )
        );

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );
        $importFile = new SplFileObject('foobar', 'w');
        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('importWorkflow')->andReturn($initialWorkflowImport);
        $workflowsApi->shouldReceive('getWorkflowImport')->andThrow(new ApiException(null, 500));
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('upload')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflow = $workflowsClient->import($importFile);
        $this->assertInstanceOf(File::class, $workflow);
    }

    public function testImportWorkflow_ItShouldImportAWorkflow()
    {
        $initialWorkflowImport = new \Catalytic\SDK\Model\WorkflowImport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053',
                'workflowId' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd'
            )
        );

        $workflowImport = new \Catalytic\SDK\Model\WorkflowImport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053',
                'fileId' => '47fedd20-9a68-42bf-b7ac-3033a5d89aca'
            )
        );

        $workflow = new \Catalytic\SDK\Model\Workflow(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Workflow',
                'teamName' => 'example',
                'category' => 'General',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'inputFields' => array(),
                'isPublished' => true,
                'isArchived' => false,
                'fieldVisibility' => 'foo',
                'instanceVisibility' => 'bar',
                'adminWorkflows' => array(),
                'standardWorkflows' => array(),
                'adminUsers' => array(),
                'standardUsers' => array()
            )
        );

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );

        $importFile = new SplFileObject('foobar', 'w');
        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('importWorkflow')->andReturn($initialWorkflowImport);
        $workflowsApi->shouldReceive('getWorkflowImport')->andReturn($workflowImport);
        $workflowsApi->shouldReceive('getWorkflow')->andReturn($workflow);
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('upload')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflow = $workflowsClient->import($importFile);
        $this->assertInstanceOf(Workflow::class, $workflow);
    }

    public function testImportWorkflow_ItShouldImportAWorkflowWithAPassword()
    {
        $initialWorkflowImport = new \Catalytic\SDK\Model\WorkflowImport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053',
                'workflowId' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd'
            )
        );

        $workflowImport = new \Catalytic\SDK\Model\WorkflowImport(
            array(
                'id' => '9146235a-3834-4f63-a47c-8ecb3a7f2053',
                'fileId' => '47fedd20-9a68-42bf-b7ac-3033a5d89aca'
            )
        );

        $workflow = new \Catalytic\SDK\Model\Workflow(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example Workflow',
                'teamName' => 'example',
                'category' => 'General',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'inputFields' => array(),
                'isPublished' => true,
                'isArchived' => false,
                'fieldVisibility' => 'foo',
                'instanceVisibility' => 'bar',
                'adminWorkflows' => array(),
                'standardWorkflows' => array(),
                'adminUsers' => array(),
                'standardUsers' => array()
            )
        );

        $file = new File(
            '47fedd20-9a68-42bf-b7ac-3033a5d89aca',
            'Example workflow',
            'example',
            'text/csv',
            '6023',
            '1000',
            true,
            'foobar',
            'example-workflow'
        );
        $importFile = new SplFileObject('foobar', 'w');
        $workflowsApi = Mockery::mock('Catalytic\SDK\Api\WorkflowsApi');
        $workflowsApi->shouldReceive('importWorkflow')->andReturn($initialWorkflowImport);
        $workflowsApi->shouldReceive('getWorkflowImport')->andReturn($workflowImport);
        $workflowsApi->shouldReceive('getWorkflow')->andReturn($workflow);
        $filesClient = Mockery::mock('Catalytic\SDK\Clients\Files');
        $filesClient->shouldReceive('upload')->andReturn($file);

        $workflowsClient = new Workflows('1234', $workflowsApi, $filesClient);
        $workflow = $workflowsClient->import($importFile, 'my-password');
        $this->assertInstanceOf(Workflow::class, $workflow);
    }
}
