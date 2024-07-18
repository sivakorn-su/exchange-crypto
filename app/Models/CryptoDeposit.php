<?php

namespace App\Models;

use App\Http\Enum\CryptoDepositStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'amount',
        'currency_id',
        'status',
    ];

    protected function casts(): array
    {
        return
            [
                'amount' => 'decimal:8',
                'status' => CryptoDepositStatus::class,
            ];
    }
}
