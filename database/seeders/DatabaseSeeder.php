<?php

namespace Database\Seeders;

use App\Http\Actions\GetCryptocurrencyExchangeRate;
use App\Http\Actions\GetFiatExchangeRate;
use App\Http\Enum\CurrencyType;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->currencySeeder();
        $this->exchangeRateSeeder();
        $userA = User::factory()->create([
            'name' => 'Test UserA',
            'email' => 'testuserA@example.com',
            'password' => bcrypt('password'),
        ]);
        $userB = User::factory()->create([
            'name' => 'Test UserB',
            'email' => 'testuserB@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->walletSeeder($userA);
        $this->walletSeeder($userB);
    }

    public function currencySeeder()
    {
        Currency::create([
            'name' => 'Bitcoin',
            'symbol' => 'BTC',
            'type' => CurrencyType::CRYPTO,
        ]);
        Currency::create([
            'name' => 'Ethereum',
            'symbol' => 'ETH',
            'type' => CurrencyType::CRYPTO,
        ]);
        Currency::create([
            'name' => 'XRP',
            'symbol' => 'XRP',
            'type' => CurrencyType::CRYPTO,
        ]);
        Currency::create([
            'name' => 'Dogecoin',
            'symbol' => 'Doge',
            'type' => CurrencyType::CRYPTO,
        ]);
        Currency::create([
            'name' => 'Thai baht',
            'symbol' => 'THB',
            'type' => CurrencyType::FIAT,
        ]);
        Currency::create([
            'name' => 'United States dollar',
            'symbol' => 'USD',
            'type' => CurrencyType::FIAT,
        ]);
    }

    public function exchangeRateSeeder()
    {
        $exchangeFiatRates = (new GetFiatExchangeRate)->execute();

        ExchangeRate::create([
            'from_currency_id' => Currency::where('symbol', 'THB')->first()->id,
            'to_currency_id' => Currency::where('symbol', 'USD')->first()->id,
            'rate' => $exchangeFiatRates['THB'],
        ]);
        ExchangeRate::create([
            'from_currency_id' => Currency::where('symbol', 'USD')->first()->id,
            'to_currency_id' => Currency::where('symbol', 'THB')->first()->id,
            'rate' => 1 / $exchangeFiatRates['THB'],
        ]);

        $exchangeBitcoinRate = (new GetCryptocurrencyExchangeRate())->execute('Bitcoin', 'USD');
        ExchangeRate::create([
            'from_currency_id' => Currency::where('symbol', 'BTC')->first()->id,
            'to_currency_id' => Currency::where('symbol', 'USD')->first()->id,
            'rate' => $exchangeBitcoinRate['bitcoin']['usd'],
        ]);
        $exchangeEthereumRate = (new GetCryptocurrencyExchangeRate())->execute('Ethereum', 'USD');
        ExchangeRate::create([
            'from_currency_id' => Currency::where('symbol', 'ETH')->first()->id,
            'to_currency_id' => Currency::where('symbol', 'USD')->first()->id,
            'rate' => $exchangeEthereumRate['ethereum']['usd'],
        ]);
        $exchangeRippleRate = (new GetCryptocurrencyExchangeRate())->execute('ripple', 'USD');

        ExchangeRate::create([
            'from_currency_id' => Currency::where('symbol', 'XRP')->first()->id,
            'to_currency_id' => Currency::where('symbol', 'USD')->first()->id,
            'rate' => $exchangeRippleRate['ripple']['usd'],
        ]);
        $exchangeDogecoinRate = (new GetCryptocurrencyExchangeRate())->execute('dogecoin', 'USD');
        ExchangeRate::create([
            'from_currency_id' => Currency::where('symbol', 'Doge')->first()->id,
            'to_currency_id' => Currency::where('symbol', 'USD')->first()->id,
            'rate' => $exchangeDogecoinRate['dogecoin']['usd'],
        ]);
    }

    private function walletSeeder($user)
    {
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'THB')->first()->id,
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'USD')->first()->id,
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'BTC')->first()->id,
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'ETH')->first()->id,
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'XRP')->first()->id,
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'Doge')->first()->id,
        ]);
    }
}
