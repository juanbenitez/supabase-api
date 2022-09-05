<?php

declare(strict_types=1);

namespace Juanbenitez\SupabaseApi\Tests\Request;

use Juanbenitez\SupabaseApi\Tests\TestCase;

class RequestsFilterTest extends TestCase
{
    /** @test */
    public function canCreateReadRowsRequestWithDefaultEqualFilter()
    {
        $this->readRows->where(column: 'field_1', value: 'VALUE');

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('field_1', $queryParams);
        $this->assertEquals($queryParams['field_1'], 'eq.VALUE');
    }

    /** @test */
    public function canCreateReadRowsRequestWithNotDefaultFilter()
    {
        $this->readRows->where(
            column: 'field_1',
            operator: 'like',
            value: 'VALUE'
        );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('field_1', $queryParams);
        $this->assertEquals($queryParams['field_1'], 'like.VALUE');
    }

    /** @test */
    public function canNotCreateReadRowsRequestWithInvalidFilter()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid operator in where clause.');

        $this->readRows->where(
            column: 'field_1',
            operator: 'notvalidfilter',
            value: 'VALUE'
        );
    }

    /** @test */
    public function canCreateReadRowsRequestWithNullValueFilter()
    {
        $this->readRows->where(
            column: 'field_1',
            value: null
        );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('field_1', $queryParams);
        $this->assertEquals($queryParams['field_1'], 'eq.null');
    }

    /** @test */
    public function canCreateReadRowsRequestIlikeFilter()
    {
        $this->readRows->ilike(
            column: 'field_1',
            value: 'my-value'
        );

        $queryParams = $this->readRows->getQuery();

        $this->assertArrayHasKey('field_1', $queryParams);
        $this->assertEquals($queryParams['field_1'], 'ilike.*my-value*');
    }

     /** @test */
     public function canCreateReadRowsRequestNotEqualFilter()
     {
         $this->readRows->neq(
             column: 'field_1',
             value: 'my-value'
         );
 
         $queryParams = $this->readRows->getQuery();
 
         $this->assertArrayHasKey('field_1', $queryParams);
         $this->assertEquals($queryParams['field_1'], 'not.eq.my-value');
     }
}
