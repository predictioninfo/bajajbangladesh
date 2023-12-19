<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalPayment extends Model
{
    use HasFactory;

    public function festivalPaymentUser(){
        return $this->belongsTo(User::class,'festival_payment_emp_id');
       }
    public function festivalPaymentDepartment(){
        return $this->belongsTo(Department::class,'festival_payment_department_id');
       }

   public function festivalPaymentBankAccount(){
        return $this->belongsTo(BankAccount::class,'festival_payment_bank_account_id');
       }

    public function festivalPaymentBonus(){
        return $this->belongsTo(FestivalBonus::class,'festival_payment_bonus_id');
       }
    public function festivalPaymentBonusConfig(){
        return $this->belongsTo(FestivalConfig::class,'festival_payment_com_id','festival_config_com_id');
       }

}