<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCirtificate extends Model
{
    use HasFactory;

    public function salaryCertificateSignatory()
    {
        return $this->belongsTo(User::class, 'salary_cirti_emp_id');
    }
    public function salaryCertificateCompany()
    {
        return $this->belongsTo(Company::class, 'salary_cirti_com_id');
    }

    public function salaryCertificateHeader()
    {
        return $this->belongsTo(Header::class, 'salary_cirtificate_header_id');
    }

}
