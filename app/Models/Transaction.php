<?php

namespace App\Models;

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
    ];

    public function depositor()
    {
        return $this->belongsTo(Wallet::class, 'depositor_id');
    }

    public function recipient()
    {
        return $this->belongsTo(Wallet::class, 'recipient_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
