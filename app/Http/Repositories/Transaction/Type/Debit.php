<?php

namespace App\Http\Repositories\Transaction\Type;

use App\Interfaces\IPaymentTransactionInterface;

class Debit implements IPaymentTransactionInterface
{
    private float $fee = 1.03;

    public function getChargeValue(float $value): float
    {
        return $value * $this->fee;
    }

    public function isPaymentChargedImmediately(): bool
    {
        return true;
    }
}
