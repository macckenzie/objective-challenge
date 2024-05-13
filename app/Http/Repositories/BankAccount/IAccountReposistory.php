<?php

namespace App\Http\Repositories\BankAccount;

use App\Http\Requests\BankAccount\StoreRequest;
use App\Http\Requests\BankAccount\TransactionRequest;
use App\Models\BankAccount\Account;

interface IAccountReposistory
{
    public function find(string $accountId): Account;
    public function store(StoreRequest $request): Account;
    public function pay(TransactionRequest $request): Account;
}
