<?php

namespace App\Http\Repositories\Transaction\Type;

use App\Interfaces\IPaymentTransactionInterface;

class PIX implements IPaymentTransactionInterface
{
    public function getChargeValue(float $value): float
    {
        return $value;
    }

    public function isPaymentChargedImmediately(): bool
    {
        return true;
    }
}
