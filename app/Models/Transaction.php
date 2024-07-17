<?php

namespace App\Models;

use App\Http\Enum\TransactionStatus;
use App\Http\Enum\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'depositor_id',
        'recipient_id',
        'amount',
        'currency_id',
        'type',
        'status'
    ];
    protected $casts = [
        'type' => TransactionType::class,
        'status' => TransactionStatus::class,
        'amount' => 'decimal:6',
    ];

    public function depositor()
    {
        return $this->belongsTo(Wallet::class, 'depositor_id');
    }
}
