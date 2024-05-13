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
        $now = now();
        Account::insert([
            [
                'balance' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'balance' => 500,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'balance' => 1000,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
