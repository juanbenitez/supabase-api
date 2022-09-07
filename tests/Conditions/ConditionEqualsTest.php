<?php

declare(strict_types=1);

namespace Juanbenitez\SupabaseApi\Tests\Conditions;

use Juanbenitez\SupabaseApi\Conditions\Equals;
use Juanbenitez\SupabaseApi\Conditions\OrWhere;
use Juanbenitez\SupabaseApi\Tests\TestCase;

class ConditionEqualsTest extends TestCase
{
    /** @test */
    public function canBuildEqualCondition()
    {
        $equalCondition = Equals::make('field_1', 'VALUE')->toArray();

        $this->assertArrayHasKey('field_1', $equalCondition);
        $this->assertEquals('eq.VALUE', $equalCondition['field_1']);
    }

    /** @test */
    public function canBuildOrwhereWithTwoConditions()
    {
        $orWhereCondition = OrWhere::make([
            Equals::make('field_1', 'VALUE1'),
            Equals::make('field_2', 'VALUE2'),
        ])->toArray();

        //print_r($orWhereCondition);
        $this->assertArrayHasKey('or', $orWhereCondition);
        $this->assertEquals('(field_1.eq.VALUE1,field_2.eq.VALUE2)', $orWhereCondition['or']);
    }

    /** @test */
    public function throwExceptionOrwhereWithLessThanTwoConditions()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Must be at least 2 conditions.');

        OrWhere::make([
            Equals::make('field_1', 'VALUE1'),
        ]);
    }
}
