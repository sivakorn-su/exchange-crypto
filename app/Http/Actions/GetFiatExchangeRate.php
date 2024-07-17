<?php

namespace App\Http\Actions;

use Exception;
use Illuminate\Support\Facades\Http;

class GetFiatExchangeRate
{
    public function execute()
    {
        try {
            $response = Http::get(config('exchange.exchangerate-api.url') . config('exchange.exchangerate-api.api_key') . '/latest/USD');
            return $response->json()['conversion_rates'];
        } catch (Exception $e) {
            throw $e;
        }

    }
}
