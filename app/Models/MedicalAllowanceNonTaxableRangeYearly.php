<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAllowanceNonTaxableRangeYearly extends Model
{
    use HasFactory;

    public function companyName(){
    return $this->belongsTo(Company::class,'medical_allowance_non_taxable_range_yearlies_com_id');
    }
}