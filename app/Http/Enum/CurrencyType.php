<?php

namespace App\Http\Enum;

enum CurrencyType: int
{
    case FIAT = 1;
    case CRYPTO = 2;
}
