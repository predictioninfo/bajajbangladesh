<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBankAccountCommunication extends Model
{
    use HasFactory;
    public function bankAccountCommunication(){
    return $this->belongsTo(user::class,'company_bank_account_communication_emp_id');
    }
    public function companyBankAccount(){
    return $this->belongsTo(CompanyBankAccount::class,'company_bank_account_communication_bank_id');
    }
}