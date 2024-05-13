<?php

namespace App\Http\Requests\BankAccount;

use App\Enums\PaymentType;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $paymentTypes = implode(',', array_map(function ($type) {
            return $type->value;
        }, PaymentType::cases()));

        return [
            'account_id'   => ['required', 'exists:bank_accounts'],
            'payment_type' => ['required', 'string', "in:$paymentTypes"],
            'value'        => ['required', 'numeric']
        ];
    }
}
