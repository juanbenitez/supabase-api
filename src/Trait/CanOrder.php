<?php

namespace Juanbenitez\SupabaseApi\Trait;

use Exception;

trait CanOrder
{
    protected array $orders = [];

    protected function order(string $column, string $direction = 'asc', string $nullsOrder = '')
    {
        if(!in_array($direction, ['asc', 'desc'])){
            throw new Exception('Invalid order direction in where clause.');
        }
        
        $resultOrderQuery = [$column, $direction];

        if(!empty($nullsOrder && in_array($nullsOrder, ['nullsfirst', 'nullslast']))){
            $resultOrderQuery[] = $nullsOrder;
        }

        $this->orders[] = implode('.', $resultOrderQuery);
    }
    
    public function orderBy(string $column, string $direction = 'asc', string $nullsOrder = ''): static
    {
        $this->order($column, $direction, $nullsOrder);

        $this->addQuery('order', count($this->orders) > 1 ? implode(',', $this->orders) : $this->orders[0]);

        return $this;
    }

    public function getOrders(): array
    {
        return $this->orders;
    }
}
