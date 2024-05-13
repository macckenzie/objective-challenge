<?php

namespace App\Factories;

use App\Enums\PaymentType;
use App\Http\Repositories\Transaction\Type\Credit;
use App\Http\Repositories\Transaction\Type\Debit;
use App\Http\Repositories\Transaction\Type\PIX;
use App\Interfaces\IPaymentTransactionInterface;
use Exception;

final class PaymentTypeFactory
{
    private const types = [
        PaymentType::PIX->value => PIX::class,
        PaymentType::CREDIT->value => Credit::class,
        PaymentType::DEBIT->value => Debit::class,
    ];

    public static function createPaymentTypeFromAcronym(string $acronym): IPaymentTransactionInterface
    {
        $paymentType = self::types[$acronym];
        throw_if(!$paymentType, new Exception("Payment type $acronym not found!"));

        return app()->make($paymentType);
    }
}
