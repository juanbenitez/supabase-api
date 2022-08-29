<?php

namespace Juanbenitez\SupabaseApi\Trait;

use Exception;

trait CanFilter
{
    protected $filtersAllowed = [
        'eq', 'neq', 'like', 'ilike', 
        'gt', 'gte', 'lt', 'lte', 'is', 'in'
    ];

    public function where(
        string $column, 
        $value,
        string $operator = 'eq'
    ): static
    {
                
        if(!in_array($operator, $this->filtersAllowed)){
            throw new \Exception('Invalid operator in where clause.');
        }

        if(is_null($value)){
            $value = 'null';
        }
        
        $this->addQuery($column, implode('.', [$operator, $value]));

        return $this;
    }
}
