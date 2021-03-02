<?php

use Catalytic\SDK\CatalyticClient;
use PHPUnit\Framework\TestCase;

class CatalyticClientTest extends TestCase
{
    // NOTE: THIS TEST WILL FAIL LOCALLY IF YOU HAVE AN ACCESS TOKEN IN ~/.catalytic/tokens/default
    public function testCatalyticClient_ItShouldHaveNullAccessToken()
    {
        $catalytic = new CatalyticClient();
        $this->assertNull($catalytic->getAccessToken());
    }

    public function testCatalyticClient_ItShouldHaveAnAccessToken()
    {
        $catalytic = new CatalyticClient('1234');
        $this->assertEquals('1234', $catalytic->getAccessToken());
    }
}