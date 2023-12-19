<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    public function employeeBank(){
    return $this->belongsTo(CompanyBankAccount::class,'bank_account_id');
    }
}