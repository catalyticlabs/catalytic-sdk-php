<?php

use Catalytic\SDK\CatalyticClient;
use PHPUnit\Framework\TestCase;

class CatalyticClientTest extends TestCase
{
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