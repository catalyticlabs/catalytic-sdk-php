<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\DataTables;
use Catalytic\SDK\Entities\DataTable;
use Catalytic\SDK\Exceptions\{
    DataTableNotFoundException,
    InternalErrorException,
    UnauthorizedException
};
use Catalytic\SDK\Search\Where;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class DataTablesTest extends MockeryTestCase
{
    protected function tearDown(): void
    {
        // Delete the file that was created in any of the tests
        if (file_exists('foobar')) {
            unlink('foobar');
        }
    }

    public function testGetDataTable_ItShouldThrowDataTableNotFoundExceptionIfDataTableDoesNotExist()
    {
        $this->expectException(DataTableNotFoundException::class);
        $this->expectExceptionMessage("DataTable with id 1234 not found");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('getDataTable')
        ->andThrow(new ApiException(null, 404));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->get('1234');
    }

    public function testGetDataTable_ItShouldThrowUnauthorizedExceptionIfDataTableDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('getDataTable')
        ->andThrow(new ApiException(null, 401));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->get('alice@catalytic.com');
    }

    public function testGetDataTable_ItShouldThrowUInternalErrorExceptionIfDataTableDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get DataTable");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('getDataTable')
        ->andThrow(new ApiException(null, 500));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->get('alice@catalytic.com');
    }

    public function testGetDataTable_ItShouldGetADataTable()
    {
        $dataTable = new \Catalytic\SDK\Model\DataTable(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'dataTablename' => 'alice',
                'email' => 'alice@catalytic.com',
                'referenceName' => 'foobar',
                'name' => 'My Data Table',
                'teamName' => 'testing',
                'columns' => array(),
                'isArchived' => false,
                'type' => 'foo',
                'visibility' => 'bar',
                'visibleToUsers' => array(),
                'rowLimit' => 100,
                'columnLimit' => 100,
                'cellLimit' => 100
            )
        );
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('getDataTable')
        ->andReturn($dataTable);

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTable = $dataTablesClient->get('alice@catalytic.com');
        $this->assertInstanceOf(DataTable::class, $dataTable);
    }

    public function testFindDataTables_ItShouldThrowUnauthorizedExceptionIfDataTableDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('findDataTables')
        ->andThrow(new ApiException(null, 401));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->find();
    }

    public function testFindDataTables_ItShouldThrowUInternalErrorExceptionIfDataTableDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to find DataTables");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('findDataTables')
        ->andThrow(new ApiException(null, 500));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->find();
    }

    public function testFindDataTables_ItShouldFindAllDataTables()
    {
        $dataTable = new \Catalytic\SDK\Model\DataTable(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'dataTablename' => 'alice',
                'email' => 'alice@catalytic.com',
                'referenceName' => 'foobar',
                'name' => 'My Data Table',
                'teamName' => 'testing',
                'columns' => array(),
                'isArchived' => false,
                'type' => 'foo',
                'visibility' => 'bar',
                'visibleToUsers' => array(),
                'rowLimit' => 100,
                'columnLimit' => 100,
                'cellLimit' => 100
            )
        );
        $dataTablesPage = new \Catalytic\SDK\Model\DataTablesPage(
            array(
                'dataTables' => array($dataTable),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('findDataTables')
        ->andReturn($dataTablesPage);

        $dataTablesClient = new DataTables(null, $dataTablesApi);

        $results = $dataTablesClient->find();
        $dataTables = $results->getDataTables();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $dataTablesClient()->find(null, $results->getNextPageToken());
            $dataTables = array_merge($dataTables, $results->getDataTables());
        }

        $this->assertEquals(count($dataTables), 1);
    }

    public function testFindDataTables_ItShouldFindDataTablesWithNameAlice()
    {
        $dataTable = new \Catalytic\SDK\Model\DataTable(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'dataTablename' => 'alice',
                'email' => 'alice@catalytic.com',
                'referenceName' => 'foobar',
                'name' => 'My Data Table',
                'teamName' => 'testing',
                'columns' => array(),
                'isArchived' => false,
                'type' => 'foo',
                'visibility' => 'bar',
                'visibleToUsers' => array(),
                'rowLimit' => 100,
                'columnLimit' => 100,
                'cellLimit' => 100
            )
        );
        $dataTablesPage = new \Catalytic\SDK\Model\DataTablesPage(
            array(
                'dataTables' => array($dataTable),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('findDataTables')
        ->andReturn($dataTablesPage);

        $dataTablesClient = new DataTables(null, $dataTablesApi);

        $where = (new Where())->text()->matches('tom');
        $results = $dataTablesClient->find($where);
        $dataTables = $results->getDataTables();

        // Loop through all the pages of results
        while (!empty($results->getNextPageToken())) {
            $results = $dataTablesClient()->find($where, $results->getNextPageToken());
            $dataTables = array_merge($dataTables, $results->getDataTables());
        }

        $this->assertEquals(count($dataTables), 1);
    }

    public function testDownloadDataTable_itShouldThrowUnauthorizedException() {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('downloadDataTable')
        ->andThrow(new ApiException(null, 401));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->download('1234', 'csv');
    }

    public function testDownloadDataTable_itShouldThrowDataTableNotFoundException() {
        $this->expectException(DataTableNotFoundException::class);
        $this->expectExceptionMessage("DataTable with id 1234 not found");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('downloadDataTable')
        ->andThrow(new ApiException(null, 404));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->download('1234', 'csv');
    }

    public function testDownloadDataTable_itShouldThrowInternalErrorException() {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to download DataTable");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('downloadDataTable')
        ->andThrow(new ApiException(null, 500));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->download('1234', 'csv');
    }

    public function testDownloadDataTable_itShouldDownloadDataTable() {
        $dataTable = new SplFileObject('foobar', 'w');
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('downloadDataTable')
        ->andReturn($dataTable);

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTable = $dataTablesClient->download('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd', 'csv');
        $this->assertInstanceOf(SplFileObject::class, $dataTable);
    }

    public function testUploadDataTable_itShouldThrowUnauthorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('uploadDataTable')
        ->andThrow(new ApiException(null, 401));
        $dataTableFile = new SplFileObject('foobar', 'w');

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->upload($dataTableFile);
    }

    public function testUploadDataTable_itShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to upload DataTable");

        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('uploadDataTable')
        ->andThrow(new ApiException(null, 500));
        $dataTableFile = new SplFileObject('foobar', 'w');

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->upload($dataTableFile);
    }

    public function testUploadDataTable_itShouldUploadDataTable() {
        $internalDataTable = new \Catalytic\SDK\Model\DataTable(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'dataTablename' => 'alice',
                'email' => 'alice@catalytic.com',
                'referenceName' => 'foobar',
                'name' => 'My Data Table',
                'teamName' => 'testing',
                'columns' => array(),
                'isArchived' => false,
                'type' => 'foo',
                'visibility' => 'bar',
                'visibleToUsers' => array(),
                'rowLimit' => 100,
                'columnLimit' => 100,
                'cellLimit' => 100
            )
        );
        $dataTableFile = new SplFileObject('foobar', 'w');
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('uploadDataTable')
        ->andReturn($internalDataTable);

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTable = $dataTablesClient->upload($dataTableFile);
        $this->assertInstanceOf(DataTable::class, $dataTable);
    }

    public function testReplaceDataTable_itShouldThrowUnauthorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $dataTableFile = new SplFileObject('foobar', 'w');
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('replaceDataTable')
        ->andThrow(new ApiException(null, 401));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->replace('1234', $dataTableFile);
    }

    public function testReplaceDataTable_itShouldThrowDataTableNotFoundException()
    {
        $this->expectException(DataTableNotFoundException::class);
        $this->expectExceptionMessage("DataTable with id 1234 not found");

        $dataTableFile = new SplFileObject('foobar', 'w');
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('replaceDataTable')
        ->andThrow(new ApiException(null, 404));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->replace('1234', $dataTableFile);
    }

    public function testReplaceDataTable_itShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to replace DataTable");

        $dataTableFile = new SplFileObject('foobar', 'w');
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('replaceDataTable')
        ->andThrow(new ApiException(null, 500));

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTablesClient->replace('1234', $dataTableFile);
    }

    public function testReplaceDataTable_itShouldReplaceDataTable()
    {
        $internalDataTable = new \Catalytic\SDK\Model\DataTable(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'dataTablename' => 'alice',
                'email' => 'alice@catalytic.com',
                'referenceName' => 'foobar',
                'name' => 'My Data Table',
                'teamName' => 'testing',
                'columns' => array(),
                'isArchived' => false,
                'type' => 'foo',
                'visibility' => 'bar',
                'visibleToUsers' => array(),
                'rowLimit' => 100,
                'columnLimit' => 100,
                'cellLimit' => 100
            )
        );
        $dataTableFile = new SplFileObject('foobar', 'w');
        $dataTablesApi = Mockery::mock('Catalytic\SDK\Api\DataTablesApi');
        $dataTablesApi->shouldReceive('replaceDataTable')
        ->andReturn($internalDataTable);

        $dataTablesClient = new DataTables(null, $dataTablesApi);
        $dataTable = $dataTablesClient->replace('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd', $dataTableFile);
        $this->assertInstanceOf(DataTable::class, $dataTable);
    }
}
