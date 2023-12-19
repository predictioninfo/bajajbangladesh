<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LateTimeSalaryConfig extends Model
{
    use HasFactory;

    public function lateTimeSalaryConfigCompany(){
        return $this->belongsTo(Company::class,'late_time_salary_config_com_id');
    }
}