<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    use HasFactory;
    public function userresignationdepartment()
    {
        return $this->belongsTo(Department::class, 'resignation_department_id', 'id');
    }
    public function userInforamtion()
    {
        return $this->belongsTo(User::class, 'resignation_employee_id');
    }
    public function userInforamtionDetails()
    {
        return $this->belongsTo(EmployeeDetail::class, 'resignation_employee_id');
    }
    public function resignationAcceptance()
    {
        return $this->belongsTo(ResignationLetter::class, 'resignation_letter_acceptance_id');
    }


}