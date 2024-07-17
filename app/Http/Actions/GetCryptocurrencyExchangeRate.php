<?php

namespace App\Http\Actions;


use Exception;
use Illuminate\Support\Facades\Http;

class GetCryptocurrencyExchangeRate
{

    public function execute(string $currency, ?string $fiat)
    {
        try {
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'x-cg-demo-api-key' => config('exchange.coingecko.api_key'),
            ])->get(config('exchange.coingecko.url') . '/simple/price?ids=' . $currency . '&vs_currencies=' . $fiat);
            return $response->json();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
