<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    use HasFactory;
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'pay_slip_bank_account_id', 'id');
    }
}