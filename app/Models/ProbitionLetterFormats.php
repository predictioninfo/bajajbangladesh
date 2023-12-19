<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbitionLetterFormats extends Model
{
    use HasFactory;

    public function probitionSignatory()
    {
        return $this->belongsTo(User::class, 'probation_letter_format_signature_emp_id');
    }
    public function probitionCompany()
    {
        return $this->belongsTo(Company::class, 'probation_letter_format_com_id');
    }
    public function probationHeader()
    {
        return $this->belongsTo(Header::class, 'header_id');
    }

    public function probationFooter()
    {
        return $this->belongsTo(Footer::class, 'footer_id');
    }
}
