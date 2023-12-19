<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbationRecomendetion extends Model
{
    use HasFactory;

    public function receEployee()
    {
        return $this->belongsTo(User::class, 'pro_emp_id');
    }
    public function recDepartment()
    {
        return $this->belongsTo(Department::class, 'pro_dep_id');
    }
    public function recDesignation()
    {
        return $this->belongsTo(Designation::class, 'pro_desi_id');
    }
    public function recDepartmentNew()
    {
        return $this->belongsTo(Department::class, 'new_department_id_sup');
    }
    public function recDesignationNew()
    {
        return $this->belongsTo(Designation::class, 'new_designation_sup');
    }
    public function  recDesignationAdmin()
    {
        return $this->belongsTo(Designation::class, 'pro_desi_id_admin');
    }
    public function recDepartmentAdmin()
    {
        return $this->belongsTo(Department::class, 'pro_dep_id_admin');
    }
    public function probationLetterFormat()
    {
        return $this->belongsTo(ProbitionLetterFormats::class, 'template_id','id');
    }

    public function salaryconfig()
    {
        return $this->belongsTo(SalaryConfig::class, 'pro_com_id', 'salary_config_com_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'pro_com_id', 'id');
    }
}
