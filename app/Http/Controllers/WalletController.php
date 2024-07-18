<?php

namespace App\Http\Controllers;

class WalletController extends Controller
{
    public function me()
    {
        return response()->json([
            'wallet' => auth()->user()->wallets,
        ]);
    }
}
