<?php

namespace App\Models\BankAccount;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'bank_accounts';
    protected $primaryKey = 'account_id';
    protected $fillable = [
        'balance',
        'created_at',
        'updated_at',
    ];

    protected function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    protected function getUpdatedAtAttribute()
    {
        if (!$this->attributes['updated_at'])
            return null;

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }
}
