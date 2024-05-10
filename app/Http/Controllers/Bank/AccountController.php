<?php

namespace App\Http\Controllers\Bank;

use App\Enums\HttpStatus;
use App\Http\Requests\BankAccount\StoreRequest;
use App\Models\BankAccount\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class AccountController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function store(StoreRequest $request): JsonResponse
    {
        $account = Account::create($request->validated());

        return response()->json($account, HttpStatus::CREATED);
    }
}
