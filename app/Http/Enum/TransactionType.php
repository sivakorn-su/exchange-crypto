<?php


namespace App\Http\Enum;

enum TransactionType: int
{
    case TRANSFER = 1;
    case DEPOSIT = 2;
    case WITHDRAWAL = 3;

}
