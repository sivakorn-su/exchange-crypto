<?php

namespace App\Models;

use App\Enum\CryptoDepositStatus;
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
    protected $casts = [
        'amount' => 'decimal:8',
        'status' => CryptoDepositStatus::class,
    ];
}
