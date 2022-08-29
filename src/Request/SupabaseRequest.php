<?php

namespace Juanbenitez\SupabaseApi\Request;

use Juanbenitez\SupabaseApi\Connector\SupabaseConnector;
use Sammyjo20\Saloon\Http\SaloonRequest;

class SupabaseRequest extends SaloonRequest
{
    protected ?string $connector = SupabaseConnector::class;

    protected ?string $table = null;

    public function defineEndpoint(): string
    {
        return $this->getEndpointFromTable();
    }

    public function getEndpointFromTable(): string
    {
        if (! $this->table) {
            throw new \Exception('Table not defined.');
        }

        return "/{$this->table}";
    }

    public function setTable(string $tableName)
    {
        $this->table = $tableName;
    }

    public function getTable(): string
    {
        return $this->table;
    }
}
