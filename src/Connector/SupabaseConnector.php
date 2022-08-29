<?php
namespace Juanbenitez\SupabaseApi\Connector;

use Sammyjo20\Saloon\Http\SaloonConnector;

class SupabaseConnector extends SaloonConnector
{
    public function __construct(
        protected string $baseUrl,
        protected string $serviceKey,
    ){}

    public function defineBaseUrl(): string
    {
        return $this->baseUrl;
    }
    
    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'apikey' => $this->serviceKey,
            'Authorization' => 'Bearer ' . $this->serviceKey,
        ];
    }
    
    public function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }
}
