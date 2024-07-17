<?php


namespace App\Http\Enum;

enum OrderStatus: int
{
    case OPEN = 1;
    case CLOSED = 2;
    case CANCELLED = 3;
}
