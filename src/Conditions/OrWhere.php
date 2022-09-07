<?php

namespace Juanbenitez\SupabaseApi\Conditions;

use Exception;

class OrWhere extends ConditionBase
{
    /**
     * Create orWhere condition
     *
     * @param array<Condition> $conditions
     */
    private function __construct(array $conditions)
    {
        if (count($conditions) <= 1) {
            throw new Exception('Must be at least 2 conditions.');
        }
        foreach ($conditions as $condition) {
            $newConditions[] = implode('.', [$condition->field, $condition->value]);
        }
        $value = '(' .implode(',', $newConditions) . ')';

        $this->data['field'] = 'or';
        $this->data['value'] = $value;
    }

    public static function make(array $conditions): static
    {
        return new static($conditions);
    }
}
