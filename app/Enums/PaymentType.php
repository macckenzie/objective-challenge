<?php

namespace App\Enums;

enum PaymentType: string
{
    case CREDIT = 'C';
    case DEBIT = 'D';
    case PIX = 'P';
}
