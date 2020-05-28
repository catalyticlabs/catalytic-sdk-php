<?php

// use Catalytic\SDK\CatalyticClient;
// use Catalytic\SDK\Entities\File;
// use Catalytic\SDK\Search\Where;
// use Catalytic\SDK\Entities\Workflow;
// use Catalytic\SDK\Exceptions\WorkflowNotFoundException;
// use PHPUnit\Framework\TestCase;

// class WorkflowsTest extends TestCase
// {
//     public function testItShouldThrowAnExceptionIfWorkflowDoesNotExist()
//     {
//         $this->expectException(WorkflowNotFoundException::class);
//         $this->expectExceptionMessage("Workflow with id 1234 not found");
//         $catalytic = new CatalyticClient();
//         $catalytic->workflows()->get('1234');
//     }

//     public function testItShouldGetWorkflow()
//     {
//         $catalytic = new CatalyticClient();
//         $workflow = $catalytic->workflows()->get('7e77254c-d2d6-4271-965a-98390aefa50a');
//         $this->assertInstanceOf(Workflow::class, $workflow);
//     }

//     public function testItShouldFindAllWorkflows()
//     {
//         $catalytic = new CatalyticClient();
//         $results = $catalytic->workflows()->find();
//         $workflows = $results->getWorkflows();

//         // Loop through all the pages of results
//         while (!empty($results->getNextPageToken())) {
//             $results = $catalytic->workflows()->find(null, $results->getNextPageToken());
//             $workflows = array_merge($workflows, $results->getWorkflows());
//         }

//         $this->assertGreaterThan(0, count($workflows));
//     }

//     public function testItShouldFindWorkflowsByName()
//     {
//         $catalytic = new CatalyticClient();
//         $where = (new Where())->text()->matches('php');
//         $results = $catalytic->workflows()->find($where);
//         $workflows = $results->getWorkflows();

//         // Loop through all the pages of results
//         while (!empty($results->getNextPageToken())) {
//             $results = $catalytic->workflows()->find($where, $results->getNextPageToken());
//             $users = array_merge($workflows, $results->getWorkflows());
//         }

//         $this->assertGreaterThan(0, count($workflows));
//     }

//     public function testItShouldFindWorkflowsByOwner()
//     {
//         $catalytic = new CatalyticClient();
//         $where = (new Where())->owner()->is('tcaflisch@catalytic.com');
//         $results = $catalytic->workflows()->find($where);
//         $workflows = $results->getWorkflows();

//         // Loop through all the pages of results
//         while (!empty($results->getNextPageToken())) {
//             $results = $catalytic->workflows()->find($where, $results->getNextPageToken());
//             $users = array_merge($workflows, $results->getWorkflows());
//         }

//         $this->assertGreaterThan(0, count($workflows));
//     }

//     public function testItShouldFindWorkflowsByCategory()
//     {
//         $catalytic = new CatalyticClient();
//         $where = (new Where())->category()->is('general');
//         $results = $catalytic->workflows()->find($where);
//         $workflows = $results->getWorkflows();

//         // Loop through all the pages of results
//         while (!empty($results->getNextPageToken())) {
//             $results = $catalytic->workflows()->find($where, $results->getNextPageToken());
//             $users = array_merge($workflows, $results->getWorkflows());
//         }

//         $this->assertGreaterThan(0, count($workflows));
//     }

//     public function testItShouldThrowAnExceptionIfWorkflowDoesNotExistWhenTryingToExport()
//     {
//         $this->expectException(WorkflowNotFoundException::class);
//         $this->expectExceptionMessage("Workflow with id 00000000-0000-0000-0000-000000000000 not found");
//         $catalytic = new CatalyticClient();
//         $file = $catalytic->workflows()->export('00000000-0000-0000-0000-000000000000');
//         $this->assertInstanceOf(File::class, $file);
//     }

//     // TODO: Commented out until this is fixed https://github.com/catalyticlabs/CatalyticSDKAPI/issues/140
//     // public function testItShouldThrowAnExceptionIfWorkflowDoesNotExistWhenTryingToExport()
//     // {
//     //     $this->expectException(WorkflowNotFoundException::class);
//     //     $this->expectExceptionMessage("Workflow with id 1234 not found");
//     //     $catalytic = new CatalyticClient();
//     //     $file = $catalytic->workflows()->export('1234');
//     //     $this->assertInstanceOf(File::class, $file);
//     // }

//     public function testItShouldExportWorkflow()
//     {
//         $catalytic = new CatalyticClient();
//         $file = $catalytic->workflows()->export('7e77254c-d2d6-4271-965a-98390aefa50a');
//         $this->assertInstanceOf(File::class, $file);
//     }

//     public function testItShouldImportWorkflow()
//     {
//         $catalytic = new CatalyticClient();
//         $file = new SplFileObject('/Users/tomcaflisch/Downloads/testing-php-sdk-export.catalytic');
//         $workflow = $catalytic->workflows()->import($file);
//         $this->assertInstanceOf(Workflow::class, $workflow);
//     }
// }
