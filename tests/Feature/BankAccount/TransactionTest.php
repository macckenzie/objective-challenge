<?php

namespace BankAccount;

use App\Enums\HttpStatus;
use App\Enums\PaymentType;
use App\Factories\PaymentTypeFactory;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    private string $baseUrl = '/api/transacao';

    /**
     * @dataProvider chargesImmediatelyPaymentTypesProvider
     */
    public function testBankAccountBalanceIsChangedAfterTransaction(string $paymentType): void
    {
        $paymentTypeClass = PaymentTypeFactory::createPaymentTypeFromAcronym($paymentType);
        $balance = 500;
        $paymentValue = 100;

        $accountAsJson = $this->postJson('/api/conta', ['balance' => $balance])->getContent();
        $response = $this->postJson($this->baseUrl, [
            'account_id' => json_decode($accountAsJson)->account_id,
            'payment_type' => $paymentType,
            'value' => $paymentValue
        ]);

        $response->assertStatus(HttpStatus::OK->value);
        $response->assertJsonStructure(['account_id', 'balance']);

        $updatedAccountAsJson = json_decode($response->getContent());
        $chargeValue = $paymentTypeClass->getChargeValue($paymentValue);
        $this->assertEquals($balance - $chargeValue, $updatedAccountAsJson->balance);
    }

    /**
     * @dataProvider chargesLaterPaymentTypesProvider
     */
    public function testBankAccountBalanceIsNotChangedAfterTransaction(string $paymentType): void
    {
        $balance = 500;
        $paymentValue = 100;

        $accountAsJson = $this->postJson('/api/conta', ['balance' => $balance])->getContent();
        $response = $this->postJson($this->baseUrl, [
            'account_id' => json_decode($accountAsJson)->account_id,
            'payment_type' => $paymentType,
            'value' => $paymentValue
        ]);

        $response->assertStatus(HttpStatus::OK->value);
        $response->assertJsonStructure(['account_id', 'balance']);

        $updatedAccountAsJson = json_decode($response->getContent());
        $this->assertEquals($balance, $updatedAccountAsJson->balance);
    }

    public function testBankAccountChargeAmountExceedsBalanceValue()
    {
        $balance = 500;
        $paymentValue = 1000;

        $accountAsJson = $this->postJson('/api/conta', ['balance' => $balance])->getContent();
        $response = $this->postJson($this->baseUrl, [
            'account_id' => json_decode($accountAsJson)->account_id,
            'payment_type' => 'P',
            'value' => $paymentValue
        ]);

        $response->assertStatus(HttpStatus::OK->value);
        $response->assertJsonStructure(['account_id', 'balance']);

        $updatedAccountAsJson = json_decode($response->getContent());
        $this->assertEquals($balance, $updatedAccountAsJson->balance);
    }

    public static function chargesImmediatelyPaymentTypesProvider(): array
    {
        return [
            [PaymentType::PIX->value],
            [PaymentType::DEBIT->value]
        ];
    }

    public static function chargesLaterPaymentTypesProvider(): array
    {
        return [
            [PaymentType::CREDIT->value],
        ];
    }
}
