<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryIncrement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employeedetails(){
        return $this->belongsTo(User::class,'salary_incre_emp_id');
    }

    public function departmentdetails(){
        return $this->belongsTo(Department::class,'salary_incre_dept_id');
    }

    public function designationdetails(){
        return $this->belongsTo(Designation::class,'salary_incre_desig_id');
    }

    public function letterFormat(){
        return $this->belongsTo(SalaryIncrementLetter::class,'cirtificate_format_id');
    }

    public function letterHeader(){
        return $this->belongsTo(Header::class,'cirtificate_format_id');
    }
}