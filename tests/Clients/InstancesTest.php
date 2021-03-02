<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Instances;
use Catalytic\SDK\Search\Where;
use Catalytic\SDK\Entities\{Instance, InstanceStep};
use Catalytic\SDK\Exceptions\{
    AccessTokenNotFoundException,
    InternalErrorException,
    InstanceNotFoundException,
    InstanceStepNotFoundException,
    UnauthorizedException,
    WorkflowNotFoundException
};
use Mockery\Adapter\Phpunit\MockeryTestCase;

class InstancesTest extends MockeryTestCase
{
    public function testGetInstance_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $instancesClient = new Instances(null);
        $instancesClient->get('1234');
    }

    public function testGetInstance_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('getInstance')
            ->andThrow(new ApiException(null, 401));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->get('1234');
    }

    public function testGetInstance_ItShouldThrowInstanceNotFoundExceptionIfInstanceDoesNotExist()
    {
        $this->expectException(InstanceNotFoundException::class);
        $this->expectExceptionMessage("Instance with id 1234 not found");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('getInstance')
            ->andThrow(new ApiException(null, 404));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->get('1234');
    }

    public function testGetInstance_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get Instance");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('getInstance')
            ->andThrow(new ApiException(null, 500));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->get('alice@catalytic.com');
    }

    public function testGetInstance_ItShouldGetAInstance()
    {
        $instance = new \Catalytic\SDK\Model\Instance(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'running',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
            )
        );
        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('getInstance')
            ->andReturn($instance);

        $instancesClient = new Instances('1234', $instancesApi);
        $instance = $instancesClient->get('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    // public function testFindInstances_ItShouldReturnAccessTokenNotFoundException()
    // {
    //     $this->expectException(AccessTokenNotFoundException::class);
    //     $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

    //     $instancesClient = new Instances(null);
    //     $instancesClient->find();
    // }

    // public function testFindInstances_ItShouldThrowUnauthorizedExceptionIfInstanceDoesNotExist()
    // {
    //     $this->expectException(UnauthorizedException::class);
    //     $this->expectExceptionMessage("Unauthorized");

    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //         ->andThrow(new ApiException(null, 401));

    //     $instancesClient = new Instances('1234', $instancesApi);
    //     $instancesClient->find();
    // }

    // public function testFindInstances_ItShouldThrowUInternalErrorExceptionIfInstanceDoesNotExist()
    // {
    //     $this->expectException(InternalErrorException::class);
    //     $this->expectExceptionMessage("Unable to find Instances");

    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //         ->andThrow(new ApiException(null, 500));

    //     $instancesClient = new Instances('1234', $instancesApi);
    //     $instancesClient->find();
    // }

    // public function testFindInstances_ItShouldFindAllInstances()
    // {
    //     $instance = new \Catalytic\SDK\Model\Instance(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //         )
    //     );
    //     $instancesPage = new \Catalytic\SDK\Model\InstancesPage(
    //         array(
    //             'instances' => array($instance),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //         ->andReturn($instancesPage);

    //     $instancesClient = new Instances('1234', $instancesApi);

    //     $results = $instancesClient->find();
    //     $instances = $results->getInstances();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->find(null, $results->getNextPageToken());
    //         $instances = array_merge($instances, $results->getInstances());
    //     }

    //     $this->assertEquals(count($instances), 1);
    // }

    // public function testFindInstances_ItShouldFindInstancesWithNameAlice()
    // {
    //     $instance = new \Catalytic\SDK\Model\Instance(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //         )
    //     );
    //     $instancesPage = new \Catalytic\SDK\Model\InstancesPage(
    //         array(
    //             'instances' => array($instance),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //         ->andReturn($instancesPage);

    //     $instancesClient = new Instances('1234', $instancesApi);

    //     $where = (new Where())->text()->matches('tom');
    //     $results = $instancesClient->find($where);
    //     $instances = $results->getInstances();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->find($where, $results->getNextPageToken());
    //         $instances = array_merge($instances, $results->getInstances());
    //     }

    //     $this->assertEquals(count($instances), 1);
    // }

    // public function testFindInstances_ItShouldFindInstancesWithOwnerAlice()
    // {
    //     $instance = new \Catalytic\SDK\Model\Instance(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //         )
    //     );
    //     $instancesPage = new \Catalytic\SDK\Model\InstancesPage(
    //         array(
    //             'instances' => array($instance),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //         ->andReturn($instancesPage);

    //     $instancesClient = new Instances('1234', $instancesApi);

    //     $where = (new Where())->owner()->is('alice');
    //     $results = $instancesClient->find($where);
    //     $instances = $results->getInstances();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->find($where, $results->getNextPageToken());
    //         $instances = array_merge($instances, $results->getInstances());
    //     }

    //     $this->assertEquals(count($instances), 1);
    // }

    // public function testFindInstances_ItShouldFindInstancesWithStatusRunning()
    // {
    //     $instance = new \Catalytic\SDK\Model\Instance(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //         )
    //     );
    //     $instancesPage = new \Catalytic\SDK\Model\InstancesPage(
    //         array(
    //             'instances' => array($instance),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //         ->andReturn($instancesPage);

    //     $instancesClient = new Instances('1234', $instancesApi);

    //     $where = (new Where())->status()->is('running');
    //     $results = $instancesClient->find($where);
    //     $instances = $results->getInstances();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->find($where, $results->getNextPageToken());
    //         $instances = array_merge($instances, $results->getInstances());
    //     }

    //     $this->assertEquals(count($instances), 1);
    // }

    // public function testFindInstances_ItShouldFindInstancesByWorkflowId()
    // {
    //     $instance = new \Catalytic\SDK\Model\Instance(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //         )
    //     );
    //     $instancesPage = new \Catalytic\SDK\Model\InstancesPage(
    //         array(
    //             'instances' => array($instance),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instancesApi->shouldReceive('findInstances')
    //     ->andReturn($instancesPage);

    //     $instancesClient = new Instances('1234', $instancesApi);

    //     $where = (new Where())->workflowId()->is('7d92e9ad-064c-42e4-b35e-6b26a594dd95');
    //     $results = $instancesClient->find($where);
    //     $instances = $results->getInstances();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->find($where, $results->getNextPageToken());
    //         $instances = array_merge($instances, $results->getInstances());
    //     }

    //     $this->assertEquals(count($instances), 1);
    // }

    public function testStartInstance_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $instancesClient = new Instances(null);
        $instancesClient->start('1234');
    }

    public function testStartInstance_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('startInstance')->andThrow(new ApiException(null, 401));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->start('1234');
    }

    public function testStartInstance_ItShouldThrowWorkflowNotFoundExceptionIfWorkflowDoesNotExist()
    {
        $this->expectException(WorkflowNotFoundException::class);
        $this->expectExceptionMessage("Workflow with id 1234 not found");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('startInstance')->andThrow(new ApiException(null, 404));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->start('1234');
    }

    public function testStartInstance_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to start Workflow Instance");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('startInstance')->andThrow(new ApiException(null, 500));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->start('1234');
    }

    public function testStartInstance_ItShouldStartInstance()
    {
        $instance = new \Catalytic\SDK\Model\Instance(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'running',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
            )
        );

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('startInstance')->andReturn($instance);

        $instancesClient = new Instances('1234', $instancesApi);
        $instance = $instancesClient->start('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    public function testStartInstance_ItShouldStartInstanceWithFields()
    {
        $instance = new \Catalytic\SDK\Model\Instance(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'running',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
            )
        );

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('startInstance')->andReturn($instance);

        $instancesClient = new Instances('1234', $instancesApi);
        $instance = $instancesClient->start('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd', 'My Instance', 'My first instance', array('foo' => 'bar'));
        $this->assertInstanceOf(Instance::class, $instance);
    }

    public function testStopInstance_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $instancesClient = new Instances(null);
        $instancesClient->stop('1234');
    }

    public function testStopInstance_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('stopInstance')->andThrow(new ApiException(null, 401));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->stop('1234');
    }

    public function testStopInstance_ItShouldThrowInstanceNotFoundExceptionIfInstanceDoesNotExist()
    {
        $this->expectException(InstanceNotFoundException::class);
        $this->expectExceptionMessage("Instance with id 1234 not found");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('stopInstance')->andThrow(new ApiException(null, 404));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->stop('1234');
    }

    public function testStopInstance_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to stop Workflow Instance");

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('stopInstance')->andThrow(new ApiException(null, 500));

        $instancesClient = new Instances('1234', $instancesApi);
        $instancesClient->stop('1234');
    }

    public function testStopInstance_ItShouldStopInstance()
    {
        $instance = new \Catalytic\SDK\Model\Instance(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'stopped',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
            )
        );

        $instancesApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
        $instancesApi->shouldReceive('stopInstance')->andReturn($instance);

        $instancesClient = new Instances('1234', $instancesApi);
        $instance = $instancesClient->stop('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    public function testGetStep_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $instancesClient = new Instances(null);
        $instancesClient->getStep('1234');
    }

    public function testGetStep_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andThrow(new ApiException(null, 401));

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instancesClient->getStep('1234');
    }

    public function testGetStep_ItShouldThrowInstanceStepNotFoundExceptionIfInstanceDoesNotExist()
    {
        $this->expectException(InstanceStepNotFoundException::class);
        $this->expectExceptionMessage("Instance Step with id 1234 not found");

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andThrow(new ApiException(null, 404));

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instancesClient->getStep('1234');
    }

    public function testGetStep_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get Instance Step");

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andThrow(new ApiException(null, 500));

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instancesClient->getStep('1234');
    }

    public function testGetStep_ItShouldGetStep()
    {
        $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'stopped',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
                'position' => '1'
            )
        );

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andReturn($instanceStep);

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instanceStep = $instancesClient->getStep('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(InstanceStep::class, $instanceStep);
    }

    // public function testFindInstanceSteps_ItShouldReturnAccessTokenNotFoundException()
    // {
    //     $this->expectException(AccessTokenNotFoundException::class);
    //     $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

    //     $instancesClient = new Instances(null);
    //     $instancesClient->findSteps();
    // }

    // public function testFindInstanceSteps_ItShouldThrowUnauthorizedException()
    // {
    //     $this->expectException(UnauthorizedException::class);
    //     $this->expectExceptionMessage("Unauthorized");

    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')
    //     ->andThrow(new ApiException(null, 401));

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);
    //     $instancesClient->findSteps();
    // }

    // public function testFindInstanceSteps_ItShouldThrowUInternalErrorException()
    // {
    //     $this->expectException(InternalErrorException::class);
    //     $this->expectExceptionMessage("Unable to find Instance Steps");

    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstancesApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')
    //     ->andThrow(new ApiException(null, 500));

    //     $instancesClient = new Instances('1234', $instanceStepsApi);
    //     $instancesClient->findSteps();
    // }

    // public function testFindInstanceSteps_ItShouldFindAllInstanceSteps()
    // {
    //     $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //             'position' => '1'
    //         )
    //     );
    //     $instanceStepsPage = new \Catalytic\SDK\Model\InstanceStepsPage(
    //         array(
    //             'steps' => array($instanceStep),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')->andReturn($instanceStepsPage);

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);

    //     $results = $instancesClient->findSteps();
    //     $instanceSteps = $results->getInstanceSteps();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->findSteps(null, $results->getNextPageToken());
    //         $instanceSteps = array_merge($instanceSteps, $results->getInstanceSteps());
    //     }

    //     $this->assertEquals(count($instanceSteps), 1);
    // }

    // public function testFindInstanceSteps_ItShouldFindInstanceStepsWithNameAlice()
    // {
    //     $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //             'position' => '1'
    //         )
    //     );
    //     $instanceStepsPage = new \Catalytic\SDK\Model\InstanceStepsPage(
    //         array(
    //             'steps' => array($instanceStep),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')->andReturn($instanceStepsPage);

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);

    //     $where = (new Where())->text()->matches('alice');
    //     $results = $instancesClient->findSteps($where);
    //     $instanceSteps = $results->getInstanceSteps();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->findSteps($where, $results->getNextPageToken());
    //         $instances = array_merge($instanceSteps, $results->getInstanceSteps());
    //     }

    //     $this->assertEquals(count($instanceSteps), 1);
    // }

    // public function testFindInstanceSteps_ItShouldFindInstanceStepsByWorkflowId()
    // {
    //     $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //             'position' => '1'
    //         )
    //     );
    //     $instanceStepsPage = new \Catalytic\SDK\Model\InstanceStepsPage(
    //         array(
    //             'steps' => array($instanceStep),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')->andReturn($instanceStepsPage);

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);

    //     $where = (new Where())->workflowId()->is('7d92e9ad-064c-42e4-b35e-6b26a594dd95');
    //     $results = $instancesClient->findSteps($where);
    //     $instanceSteps = $results->getInstanceSteps();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->findSteps($where, $results->getNextPageToken());
    //         $instanceSteps = array_merge($instanceSteps, $results->getInstanceSteps());
    //     }

    //     $this->assertEquals(count($instanceSteps), 1);
    // }

    // public function testFindInstanceSteps_ItShouldFindInstanceStepsByAssignee()
    // {
    //     $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Instance',
    //             'teamName' => 'example',
    //             'status' => 'running',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //             'position' => '1'
    //         )
    //     );
    //     $instanceStepsPage = new \Catalytic\SDK\Model\InstanceStepsPage(
    //         array(
    //             'steps' => array($instanceStep),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );
    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')->andReturn($instanceStepsPage);

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);

    //     $where = (new Where())->assignee()->is('alice');
    //     $results = $instancesClient->findSteps($where);
    //     $instanceSteps = $results->getInstanceSteps();

    //     // Loop through all the pages of results
    //     while (!empty($results->getNextPageToken())) {
    //         $results = $instancesClient()->findSteps($where, $results->getNextPageToken());
    //         $instanceSteps = array_merge($instanceSteps, $results->getInstanceSteps());
    //     }

    //     $this->assertEquals(count($instanceSteps), 1);
    // }

    // public function testGetInstances_ItShouldReturnAccessTokenNotFoundException()
    // {
    //     $this->expectException(AccessTokenNotFoundException::class);
    //     $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

    //     $instancesClient = new Instances(null);
    //     $instancesClient->getSteps('1234');
    // }

    // public function testGetSteps_ItShouldThrowInternalErrorException()
    // {
    //     $this->expectException(InternalErrorException::class);
    //     $this->expectExceptionMessage("Unable to get Instance Step");

    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')->andThrow(new ApiException(null, 500));

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);
    //     $instancesClient->getSteps('1234');
    // }

    // public function testGetSteps_ItShouldGetSteps()
    // {
    //     $instanceStep1 = new \Catalytic\SDK\Model\InstanceStep(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
    //             'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Step 1',
    //             'teamName' => 'example',
    //             'status' => 'stopped',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //             'position' => '1'
    //         )
    //     );

    //     $instanceStepsPage1 = new \Catalytic\SDK\Model\InstanceStepsPage(
    //         array(
    //             'steps' => array($instanceStep1),
    //             'nextPageToken' => "1",
    //             'count' => 1
    //         )
    //     );

    //     $instanceStep2 = new \Catalytic\SDK\Model\InstanceStep(
    //         array(
    //             'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91be',
    //             'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
    //             'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
    //             'name' => 'Example Step 2',
    //             'teamName' => 'example',
    //             'status' => 'stopped',
    //             'owner' => 'alice@example.com',
    //             'createdBy' => 'alice',
    //             'fields' => array(),
    //             'fieldVisibility' => 'foo',
    //             'visibility' => 'foo',
    //             'visibleToUsers' => array(),
    //             'position' => '2'
    //         )
    //     );

    //     $instanceStepsPage2 = new \Catalytic\SDK\Model\InstanceStepsPage(
    //         array(
    //             'steps' => array($instanceStep2),
    //             'nextPageToken' => null,
    //             'count' => 1
    //         )
    //     );

    //     $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
    //     $instanceStepsApi->shouldReceive('findInstanceSteps')->andReturn($instanceStepsPage1, $instanceStepsPage2)->twice();

    //     $instancesClient = new Instances('1234', null, $instanceStepsApi);
    //     $instanceSteps = $instancesClient->getSteps('5a21f23c-e5e2-4b5d-95ed-f7338b6b0645');

    //     $this->assertEquals(count($instanceSteps), 2);
    // }

    public function testCompleteStep_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $instancesClient = new Instances(null);
        $instancesClient->completeStep('1234');
    }

    public function testCompleteStep_ItShouldThrowUnathorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'stopped',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
                'position' => '1'
            )
        );

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andReturn($instanceStep);
        $instanceStepsApi->shouldReceive('completeStep')->andThrow(new ApiException(null, 401));

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instancesClient->completeStep('1234');
    }

    public function testCompleteStep_ItShouldThrowInstanceStepNotFoundExceptionIfInstanceDoesNotExist()
    {
        $this->expectException(InstanceStepNotFoundException::class);
        $this->expectExceptionMessage("Instance Step with id 1234 not found");

        $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'stopped',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
                'position' => '1'
            )
        );

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andReturn($instanceStep);
        $instanceStepsApi->shouldReceive('completeStep')->andThrow(new ApiException(null, 404));

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instancesClient->completeStep('1234');
    }

    public function testCompleteStep_ItShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to complete Instance Step");

        $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'stopped',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
                'position' => '1'
            )
        );

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andReturn($instanceStep);
        $instanceStepsApi->shouldReceive('completeStep')->andThrow(new ApiException(null, 500));

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instancesClient->completeStep('1234');
    }

    public function testCompleteStep_ItShouldCompleteStep()
    {
        $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'completed',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
                'position' => '1'
            )
        );

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andReturn($instanceStep);
        $instanceStepsApi->shouldReceive('completeStep')->andReturn($instanceStep);

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instanceStep = $instancesClient->completeStep('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(InstanceStep::class, $instanceStep);
    }

    public function testCompleteStep_ItShouldCompleteStepWithFields()
    {
        $instanceStep = new \Catalytic\SDK\Model\InstanceStep(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'instanceId' => '5a21f23c-e5e2-4b5d-95ed-f7338b6b0645',
                'workflowId' => '7d92e9ad-064c-42e4-b35e-6b26a594dd95',
                'name' => 'Example Instance',
                'teamName' => 'example',
                'status' => 'completed',
                'owner' => 'alice@example.com',
                'createdBy' => 'alice',
                'fields' => array(),
                'fieldVisibility' => 'foo',
                'visibility' => 'foo',
                'visibleToUsers' => array(),
                'position' => '1'
            )
        );

        $instanceStepsApi = Mockery::mock('Catalytic\SDK\Api\InstanceStepsApi');
        $instanceStepsApi->shouldReceive('getInstanceStep')->andReturn($instanceStep);
        $instanceStepsApi->shouldReceive('completeStep')->andReturn($instanceStep);

        $instancesClient = new Instances('1234', null, $instanceStepsApi);
        $instanceStep = $instancesClient->completeStep('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd', array('foo' => 'bar'));
        $this->assertInstanceOf(InstanceStep::class, $instanceStep);
    }
}
