<?php

declare(strict_types=1);

namespace Juanbenitez\SupabaseApi\Tests\Request;

use Juanbenitez\SupabaseApi\Tests\TestCase;

class RequestsLimitTest extends TestCase
{
    /** @test */
    public function canCreateReadRowsRequestWithLimit()
    {
        $this->readRows->limit(10);

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('limit', $queryParams);
        $this->assertEquals(10, $queryParams['limit']);
    }

    /** @test */
    public function canCreateReadRowsRequestWithLimitAndOffset()
    {
        $this->readRows->limit(100, 20);

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('limit', $queryParams);
        $this->assertArrayHasKey('offset', $queryParams);
        $this->assertEquals(100, $queryParams['limit']);
        $this->assertEquals(20, $queryParams['offset']);
    }
}
