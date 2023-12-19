<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryIncrementLetter extends Model
{
    use HasFactory;

    public function signatory()
    {
        return $this->belongsTo(User::class, 'emp_signature_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'salary_inc_letter_com_id');
    }

    public function footer()
    {
        return $this->belongsTo(Footer::class, 'footer_id');
    }

    public function Header()
    {
        return $this->belongsTo(Header::class, 'header_id');
    }

}