<?php

namespace App\Http\Controllers;

class WalletController extends Controller
{

    public function me()
    {
        $user = auth()->user();
        $wallets = $user->wallets()->with('currency')->get();
        return response()->json($wallets);
    }

}
