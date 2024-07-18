<?php

namespace App\Models;

use App\Http\Enum\BankType;
use App\Http\Enum\TransactionStatus;
use App\Http\Enum\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'type',
        'status',
        'bankType',
        'to_address',
    ];

    public function detail()
    {
        return $this->hasOne(Transaction::class);
    }

    protected function casts(): array
    {
        return
            [
                'type' => TransactionType::class,
                'bankType' => BankType::class,
                'status' => TransactionStatus::class,
            ];
    }


}
