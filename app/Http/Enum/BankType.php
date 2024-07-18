<?php

namespace App\Http\Enum;

enum BankType: int
{
    case SCB = 1;
    case KBANK = 2;
    case PromptPay = 3;

    case Crypto = 4;
}
