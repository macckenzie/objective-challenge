<?php

namespace App\Http\Repositories\BankAccount;

use App\Factories\PaymentTypeFactory;
use App\Http\Requests\BankAccount\StoreRequest;
use App\Http\Requests\BankAccount\TransactionRequest;
use App\Models\BankAccount\Account;
use Exception;

class AccountRepository implements IAccountReposistory
{
    public function find(string $accountId): Account
    {
        return Account::findOrFail($accountId);
    }

    public function store(StoreRequest $request): Account
    {
        return Account::create($request->validate($request->rules()));
    }

    public function pay(TransactionRequest $request): Account
    {
        $account = $this->find($request->account_id);
        try {
            $paymentType = PaymentTypeFactory::createPaymentTypeFromAcronym($request->payment_type);
            $chargeValue = $paymentType->getChargeValue($request->value);

            if ($paymentType->isPaymentChargedImmediately() && $account->balance >= $chargeValue) {
                $account->balance -= $chargeValue;
                $account->update();

                return $account;
            }

            return $account;
        } catch (Exception) {
            return $account;
        }
    }
}
