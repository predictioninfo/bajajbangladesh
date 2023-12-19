<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningLetterFormat extends Model
{
    use HasFactory;
    public function WarningSignatory()
    {
        return $this->belongsTo(User::class, 'warning_letter_format_signature_emp_id');
    }
    public function WarningCompany()
    {
        return $this->belongsTo(Company::class, 'warning_letter_format_com_id');
    }
    public function worningFooter()
    {
        return $this->belongsTo(Footer::class, 'footer_id');
    }

    public function warningHeader()
    {
        return $this->belongsTo(Header::class, 'header_id');
    }
}
