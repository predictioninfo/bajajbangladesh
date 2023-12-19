<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRenewalLetterTemplate extends Model
{
    use HasFactory;

    public function ContactRenewalLetter(){
    return $this->belongsTo(User::class,'contact_renewal_letter_template_emp_id');
    }
    public function ContactRenewalLetterEmployeeInformation(){
    return $this->belongsTo(User::class,'contact_renewal_letter_employee_id');
    }
    //     public function employeeContactRenewal(){
    // return $this->belongsTo(User::class,'contact_renewal_letter_employee_id');
    // }
    //     public function employeeContactRenewal(){
    // return $this->belongsTo(User::class,'contact_renewal_letter_employee_id');
    // }
}