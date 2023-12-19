<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseRentNonTaxableRangeYearly extends Model
{
    use HasFactory;

    public function companyName(){
    return $this->belongsTo(Company::class,'house_rent_non_taxable_range_yearlies_com_id');
    }
}