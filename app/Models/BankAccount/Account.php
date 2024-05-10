<?php

namespace App\Models\BankAccount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'bank_accounts';
    protected $primaryKey = 'account_id';
    protected $fillable = [
        'balance'
    ];
}
