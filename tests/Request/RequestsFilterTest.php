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
        $this->assertEquals('eq.VALUE', $queryParams['field_1']);
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
        $this->assertEquals('like.VALUE', $queryParams['field_1']);
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
        $this->assertEquals('eq.null', $queryParams['field_1']);
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
        $this->assertEquals('ilike.*my-value*', $queryParams['field_1']);
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
         $this->assertEquals('not.eq.my-value', $queryParams['field_1']);
     }

     /** @test */
     /* public function canCreateReadRowsRequestWithOrCondition()
     {
         $this->readRows->orWhere([
            $this->readRows->where(column: 'field_1', value: 'my-value1')->getQuery('field_1'),
            $this->readRows->where(column: 'field_2', value: 'my-value2')->getQuery('field_2'),
         ]);

         $queryParams = $this->readRows->getQuery();

         $this->assertArrayHasKey('or', $queryParams);
         $this->assertEquals('(field_1.eq.my-value1,field_2.eq.my-value2)', $queryParams['or']);
     } */
}
