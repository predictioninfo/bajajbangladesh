<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConveyanceAllowanceNonTaxableRangeYearly extends Model
{
    use HasFactory;

    public function companyName(){
    return $this->belongsTo(Company::class,'conveyance_allowance_non_taxable_range_yearlies_com_id');
    }
}