<?php

namespace App\Http\Controllers\Bank;

use App\Enums\HttpStatus;
use App\Http\Repositories\BankAccount\IAccountReposistory;
use App\Http\Requests\BankAccount\GetRequest;
use App\Http\Requests\BankAccount\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class AccountController extends BaseController
{
    public function __construct(private readonly IAccountReposistory $accountReposistory)
    {}

    public function find(GetRequest $request): JsonResponse
    {
        $account = $this->accountReposistory->find($request->get('id'));

        return response()->json($account, HttpStatus::OK->value);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $account = $this->accountReposistory->store($request);

        return response()->json($account, HttpStatus::CREATED->value);
    }
}
