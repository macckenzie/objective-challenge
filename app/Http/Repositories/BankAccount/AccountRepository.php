<?php

namespace App\Http\Repositories\BankAccount;

use App\Http\Requests\BankAccount\StoreRequest;
use App\Models\BankAccount\Account;

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
}
