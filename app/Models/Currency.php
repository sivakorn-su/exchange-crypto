<?php

namespace App\Models;

use App\Enum\CurrencyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'type',
    ];
    protected $casts = [
        'type' => CurrencyType::class,
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }
}
