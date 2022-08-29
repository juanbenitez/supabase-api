<?php

declare(strict_types=1);

namespace Juanbenitez\SupabaseApi\Tests\Request;

use Juanbenitez\SupabaseApi\Tests\TestCase;

class RequestsOrderTest extends TestCase
{
    /** @test */
    public function canCreateReadRowsRequestWithDefaultOrder()
    {
        $this->readRows->orderBy(
            column: 'field_1',
        );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('order', $queryParams);
        $this->assertEquals($queryParams['order'], 'field_1.asc');
    }

    /** @test */
    public function canCreateReadRowsRequestWithDescOrder()
    {
        $this->readRows->orderBy(
            column: 'field_1',
            direction: 'desc'
        );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('order', $queryParams);
        $this->assertEquals($queryParams['order'], 'field_1.desc');
    }

    /** @test */
    public function canCreateReadRowsRequestWithNullsPositionOrder()
    {
        $this->readRows->orderBy(
            column: 'field_1',
            direction: 'desc',
            nullsOrder: 'nullsfirst'
        );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('order', $queryParams);
        $this->assertEquals($queryParams['order'], 'field_1.desc.nullsfirst');
    }

    /** @test */
    public function canNotCreateReadRowsRequestWithInvalidOrderDirection()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid order direction in where clause.');

        $this->readRows->orderBy(
            column: 'field_1',
            direction: 'invalid_direction',
        );
    }

    /** @test */
    public function canCreateReadRowsRequestWithMultipleOrdersBy()
    {
        $this->readRows
            ->orderBy(
                column: 'field_1',
                direction: 'asc',
            )
            ->orderBy(
                column: 'field_2',
                direction: 'desc',
            )
            ->orderBy(
                column: 'field_3',
                nullsOrder: 'nullslast',
            );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('order', $queryParams);
        $this->assertEquals($queryParams['order'], 'field_1.asc,field_2.desc,field_3.asc.nullslast');
    }
}
