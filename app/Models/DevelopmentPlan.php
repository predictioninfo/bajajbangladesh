<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentPlan extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function userdesignation()
    {
        return $this->belongsTo(Designation::class, 'development_desig_id');
    }
    public function userdepartment()
    {
        return $this->belongsTo(Department::class, 'development_dept_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'development_emp_id');
    }
    public function developmentPlanDetails()
    {
        return $this->hasMany(DevelopmentPlanDetails::class, 'development_details__id');
    }
}
