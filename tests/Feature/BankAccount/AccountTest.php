<?php

namespace Tests\Feature\BankAccount;

use App\Enums\HttpStatus;
use Tests\TestCase;

class AccountTest extends TestCase
{
    private string $baseUrl = '/api/conta';

    public function testBankAccountExists(): void
    {
        $response = $this->get("$this->baseUrl?id=1");

        $response->assertStatus(HttpStatus::OK->value);
        $response->assertJsonStructure(['account_id', 'balance']);
    }

    public function testGetBankAccountMissingIdParameter(): void
    {
        $response = $this->get($this->baseUrl, ['Accept' => 'application/json']);

        $response->assertStatus(HttpStatus::UNPROCESSABLE_CONTENT->value);
        $response->assertJsonValidationErrors(['id']);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'id'
            ]
        ]);
    }

    public function testBankAccountNotFound(): void
    {
        $response = $this->get("$this->baseUrl?id=9999");
        $response->assertStatus(HttpStatus::NOT_FOUND->value);
    }

    public function testStoreBankAccount(): void
    {
        $response = $this->postJson($this->baseUrl, ['balance' => 500]);

        $response->assertStatus(HttpStatus::CREATED->value);
        $response->assertJsonStructure(['account_id', 'balance']);
    }

    public function testStoreBankAccountMissingBalanceParameter(): void
    {
        $response = $this->postJson($this->baseUrl, [], ['Accept' => 'application/json']);

        $response->assertStatus(HttpStatus::UNPROCESSABLE_CONTENT->value);
        $response->assertJsonValidationErrors(['balance']);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'balance'
            ]
        ]);
    }
}
