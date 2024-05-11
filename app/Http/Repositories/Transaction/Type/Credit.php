<?php

namespace App\Http\Repositories\Transaction\Type;

use App\Interfaces\IPaymentTransactionInterface;

class Credit implements IPaymentTransactionInterface
{
    private float $fee = 1.05;

    public function getChargeValue(float $value): float
    {
        return $value * $this->fee;
    }

    public function isPaymentChargedImmediately(): bool
    {
        return false;
    }
}
