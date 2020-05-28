<?php

// use Catalytic\SDK\CatalyticClient;
// use Catalytic\SDK\Entities\DataTable;
// use Catalytic\SDK\Exceptions\DataTableNotFoundException;
// use Catalytic\SDK\Search\Where;
// use PHPUnit\Framework\TestCase;

// class DataTablesTest extends TestCase
// {
//     public function testItShouldThrowAnExceptionIfDataTableDoesNotExist()
//     {
//         $this->expectException(DataTableNotFoundException::class);
//         $this->expectExceptionMessage("DataTable with id 1234 not found");
//         $catalytic = new CatalyticClient();
//         $catalytic->dataTables()->get('1234');
//     }

//     public function testItShouldGetDataTable()
//     {
//         $catalytic = new CatalyticClient();
//         $dataTable = $catalytic->dataTables()->get('7e77254c-d2d6-4271-965a-98390aefa50a');
//         $this->assertInstanceOf(DataTable::class, $dataTable);
//     }

//     public function testItShouldFindAllDataTables()
//     {
//         $catalytic = new CatalyticClient();
//         $results = $catalytic->dataTables()->find();
//         $dataTables = $results->getDataTables();

//         // print_r($results);
//         // Loop through all the pages of results
//         while (!empty($results->getNextPageToken())) {
//             $results = $catalytic->dataTables()->find(null, $results->getNextPageToken());
//             $dataTables = array_merge($dataTables, $results->getDataTables());
//         }

//         $this->assertGreaterThan(0, count($dataTables));
//     }

//     public function testItShouldFindDataTablesByName()
//     {
//         $catalytic = new CatalyticClient();
//         $where = (new Where())->text()->matches('sdk');
//         $results = $catalytic->dataTables()->find($where);
//         $dataTables = $results->getDataTables();

//         // Loop through all the pages of results
//         while (!empty($results->getNextPageToken())) {
//             $results = $catalytic->dataTables()->find($where, $results->getNextPageToken());
//             $dataTables = array_merge($dataTables, $results->getDataTables());
//         }

//         $this->assertGreaterThan(0, count($dataTables));
//     }

//     // TODO: Need to figure out why this test is failing with memory issues
//     // public function testItShouldThrowAnExceptionIfDataTableDoesNotExistWhenTryingToDownload()
//     // {
//     //     $this->expectException(DataTableNotFoundException::class);
//     //     $this->expectExceptionMessage("DataTable with id 00000000-0000-0000-0000-000000000000 not found");
//     //     $catalytic = new CatalyticClient();
//     //     $dataTable = $catalytic->dataTables()->download('00000000-0000-0000-0000-000000000000');
//     //     $this->assertInstanceOf(DataTable::class, $dataTable);
//     // }

//     public function testItShouldDownloadDataTable()
//     {
//         $catalytic = new CatalyticClient();
//         $dataTable = $catalytic->dataTables()->download('7e77254c-d2d6-4271-965a-98390aefa50a', 'csv');
//         $this->assertInstanceOf(SplFileObject::class, $dataTable);
//     }

//     public function testItShouldUploadDataTable()
//     {
//         $catalytic = new CatalyticClient();
//         $dataTableToUpload = new SplFileObject('/Users/tomcaflisch/Downloads/mycsv.csv');
//         $dataTable = $catalytic->dataTables()->upload($dataTableToUpload);
//         $this->assertInstanceOf(DataTable::class, $dataTable);
//     }

//     public function testItShouldReplaceDataTable()
//     {
//         $catalytic = new CatalyticClient();
//         $dataTableToUpload = new SplFileObject('/Users/tomcaflisch/Downloads/mycsv2.csv');
//         $dataTable = $catalytic->dataTables()->replace('7f0594eb-9e02-46f1-b897-a1fc0a9786ca', $dataTableToUpload);
//         $this->assertInstanceOf(DataTable::class, $dataTable);
//     }
// }
