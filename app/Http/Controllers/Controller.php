<?php

namespace App\Http\Controllers;

use App\Enums\PaymentType;
use App\Http\Repositories\BankAccount\IAccountReposistory;
use App\Http\Requests\BankAccount\StoreRequest;
use App\Http\Requests\BankAccount\TransactionRequest;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct(private readonly IAccountReposistory $accountReposistory)
    {
    }

    public function index()
    {
        echo "1. Validar se uma conta existe <br>";
        echo $this->accountReposistory->find(1);

        echo "<br><br> 2. Criar uma conta com saldo inicial de R$ 500 <br>";
        $storeRequest = new StoreRequest(['balance' => 500]);
        echo $account = $this->accountReposistory->store($storeRequest);

        echo "<br><br> 3. Consultar o saldo dela <br>";
        echo $account->balance;

        echo "<br><br> 4. Efetue uma compra no valor de R$50 utilizando a opção de débito <br>";
        $debitChargeRequest = new TransactionRequest([
            'account_id' => $account->account_id,
            'payment_type' => PaymentType::DEBIT->value,
            'value' => 50
        ]);
        echo $this->accountReposistory->pay($debitChargeRequest);

        echo "<br><br> 5. Execute uma compra de R$100 usando a opção de crédito <br>";
        echo "(Atenção): A opção crédito supostamente não debita imediatamente da conta <br>";
        $creditChargeRequest = new TransactionRequest([
            'account_id' => $account->account_id,
            'payment_type' => PaymentType::CREDIT->value,
            'value' => 50
        ]);
        echo $this->accountReposistory->pay($creditChargeRequest);

        echo "<br><br> 6. Realize uma transferência via Pix no valor de R$75. <br>";
        $pixTransferRequest = new TransactionRequest([
            'account_id' => $account->account_id,
            'payment_type' => PaymentType::PIX->value,
            'value' => 50
        ]);
        echo $this->accountReposistory->pay($pixTransferRequest);
    }
}
