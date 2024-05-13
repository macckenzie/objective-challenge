<?php

namespace Database\Seeders;

use App\Models\BankAccount\Account;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::insert([
            [
                'balance' => 0
            ],
            [
                'balance' => 500
            ],
            [
                'balance' => 1000
            ]
        ]);
    }
}
