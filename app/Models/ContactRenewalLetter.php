<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRenewalLetter extends Model
{
    use HasFactory;

    public function employeeContactRenewal(){
    return $this->belongsTo(User::class,'contact_renewal_letter_employee_id');
    }

    public function employeeContactRenewalLetter(){
    return $this->belongsTo(ContactRenewalLetterTemplate::class,'contact_renewal_letter_type_id');
    }
}