<?php
return [
    'coingecko' => [
        'url' => env('COINGECKO_URL', 'https://api.coingecko.com/api/v3/'),
        'api_key' => env('COINGECKO_API_KEY', '7Zq2K1oNHmrjhca9E1FX6DP3'),
    ],
    'exchangerate-api' => [
        'url' => env('EXCHANGERATE_API_URL', 'https://v6.exchangerate-api.com/v6/'),
        'api_key' => env('EXCHANGERATE_API_KEY', '2d3e69b01a5e133ed31c68c5'),
    ],
];
