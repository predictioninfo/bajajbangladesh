<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSetup extends Model
{
    use HasFactory;
    public function gardeSetaupGarde()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function gardeSetaupDepartment()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    public function gardeSetaupDesignation()
    {
        return $this->belongsTo(Designation::class, 'desg_id');
    }
    public function gardeSetaupEmployee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
    public function gardeSetaupManPower()
    {
        return $this->hasOne(ManPower::class, 'gradesetup_id');
    }
    public function parentName()
    {
        return $this->belongsTo(GradeSetup::class, 'parent_id');
    }
    public function gardeSetaupUnderDepartment()
    {
        return $this->belongsTo(Department::class, 'under_dept_id');
    }
    public function gardeSetaupUnderDesignation()
    {
        return $this->belongsTo(Designation::class, 'under_desg_id');
    }
}
