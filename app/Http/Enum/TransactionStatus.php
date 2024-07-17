<?php


namespace App\Http\Enum;

enum TransactionStatus: int
{
    case PENDING = 1;
    case COMPLETED = 2;
    case FAILED = 3;

}
