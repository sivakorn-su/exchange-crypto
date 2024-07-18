<?php

namespace App\Models;

use App\Http\Enum\OrderStatus;
use App\Http\Enum\OrderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'price',
        'amount',
        'total',
        'status',
        'from_currency_id',
        'to_currency_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'from_currency_id');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }

    protected function casts(): array
    {
        return
            [
                'type' => OrderType::class,
                'price' => 'decimal:6',
                'amount' => 'decimal:6',
                'total' => 'decimal:6',
                'status' => OrderStatus::class,
            ];
    }

}
