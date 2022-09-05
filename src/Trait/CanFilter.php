<?php

namespace Juanbenitez\SupabaseApi\Trait;

use Exception;

trait CanFilter
{
    protected $filtersAllowed = [
        'eq', 'neq', 'like', 'ilike',
        'gt', 'gte', 'lt', 'lte', 'is', 'in',
    ];

    public function where(
        string $column,
        $value,
        string $operator = 'eq'
    ): static {
        if (! in_array($operator, $this->filtersAllowed)) {
            throw new \Exception('Invalid operator in where clause.');
        }

        if (is_null($value)) {
            $value = 'null';
        }

        $this->addQuery($column, implode('.', [$operator, $value]));

        return $this;
    }

    public function ilike(string $column, $value)
    {
        $value = '*'.$value.'*';

        return $this->where($column, $value, 'ilike');
    }

    public function neq(string $column, $value)
    {
        $query = $this->where($column, $value)->getQuery($column);

        $value = 'not.'.$query;

        $this->addQuery($column, $value);

        return $this;
    }

    /* public function orWhere(array $conditions)
    {
        if(count($conditions) <= 1){
            throw new Exception('Must be at least 2 conditions.');
        }        
        $value = '(' .implode(',', $conditions) . ')'; 

        $this->addQuery('or', $value);
    } */
}
