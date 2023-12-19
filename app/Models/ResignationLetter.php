<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignationLetter extends Model
{
    use HasFactory;

   public function ResignationSignatory()
    {
        return $this->belongsTo(User::class, 'resignation_letter_signature_emp_id');
    }
    public function ResignationCompany()
    {
        return $this->belongsTo(Company::class, 'resignation_letter_com_id');
    }

    public function Header()
    {
        return $this->belongsTo(Header::class, 'resignation_letter_header_id');
    }

    public function Footer()
    {
        return $this->belongsTo(Footer::class, 'resignation_letter_com_id');
    }
}