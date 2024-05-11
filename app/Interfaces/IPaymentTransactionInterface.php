<?php

namespace App\Interfaces;

interface IPaymentTransactionInterface
{
    public function getChargeValue(float $value): float;
    public function isPaymentChargedImmediately(): bool;
}
