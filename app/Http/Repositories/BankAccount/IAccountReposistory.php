<?php

namespace App\Http\Repositories\BankAccount;

use App\Http\Requests\BankAccount\StoreRequest;
use App\Models\BankAccount\Account;

interface IAccountReposistory
{
    public function find(string $accountId): Account;
    public function store(StoreRequest $request): Account;
}
