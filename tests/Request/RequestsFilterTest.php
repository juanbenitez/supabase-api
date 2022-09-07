<?php

declare(strict_types=1);

namespace Juanbenitez\SupabaseApi\Tests\Request;

use Juanbenitez\SupabaseApi\Tests\TestCase;

class RequestsFilterTest extends TestCase
{
    /** @test */
    public function canCreateReadRowsRequestWithEqualFilter()
    {
        $this->readRows->equals(column: 'field_1', value: 'VALUE');

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
     public function canCreateReadRowsRequestWithOrCondition()
     {
         $this->readRows->orWhere([
            ['field_1', 'my-value_1', 'eq'],
            ['field_2', 'my-value_2', 'eq'],
         ]);

         $queryParams = $this->readRows->getQuery();

         $this->assertArrayHasKey('or', $queryParams);
         $this->assertEquals('(field_1.eq.my-value_1,field_2.eq.my-value_2)', $queryParams['or']);
     }

      /** @test */
      public function canCreateReadRowsRequestMultipleConditions()
      {
          $this->readRows->orWhere([
             ['field_1', 'my_value_1', 'eq'],
             ['field_2', 'my_value_2', 'eq'],
          ])
          ->like('field_3', 'my_value_3');

          $queryParams = $this->readRows->getQuery();

          $this->assertArrayHasKey('or', $queryParams);
          $this->assertArrayHasKey('field_3', $queryParams);
          $this->assertEquals('(field_1.eq.my_value_1,field_2.eq.my_value_2)', $queryParams['or']);
          $this->assertEquals('like.*my_value_3*', $queryParams['field_3']);
      }
}
