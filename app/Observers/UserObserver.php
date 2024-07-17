<?php

namespace App\Observers;

use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'THB')->first()->id,
        ]);
        Wallet::create([
            'user_id' => $user->id,
            'currency_id' => Currency::where('symbol', 'USD')->first()->id,
        ]);
    }

}
