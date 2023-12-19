<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBankAccount extends Model
{
    use HasFactory;
    public function employeeBank(){
    return $this->belongsTo(CompanyBankAccount::class,'bank_account_id');
    }
   public function employeeBankCommunication(){
    return $this->belongsTo(CompanyBankAccountCommunication::class,'company_bank_account_communication_emp_id');
    }
}