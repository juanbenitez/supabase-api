<?php

declare(strict_types=1);

namespace Juanbenitez\SupabaseApi\Tests\Request;

use Juanbenitez\SupabaseApi\Tests\TestCase;

class RequestsTest extends TestCase
{
    /** @test */
    public function canCreateReadRowsRequestToSupabaseTable()
    {
        $this->assertStringContainsString('supabase.co/rest/v1/test_table', $this->readRows->getFullRequestUrl());
    }

    /** @test */
    public function canCreateReadRowsRequestWithSelectAllFields()
    {
        $this->readRows->selectAll();

        $this->assertArrayHasKey('select', $this->readRows->getQuery());
        $this->assertEquals($this->readRows->getQuery()['select'], '*');
    }

    /** @test */
    public function canCreateReadRowsRequestWithSelectSpecificFields()
    {
        $this->readRows->select([
            'field_1',
            'field_2',
        ]);

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('select', $queryParams);
        $this->assertEquals($queryParams['select'], 'field_1,field_2');
    }
}
