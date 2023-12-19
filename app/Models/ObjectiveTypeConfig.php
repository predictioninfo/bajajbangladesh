<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectiveTypeConfig extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userdepartmentfromobjectiveconfig()
    {
        return $this->belongsTo(Department::class, 'obj_config_dept_id');
    }
    public function userdesignationfromobjectiveconfig()
    {
        return $this->belongsTo(Designation::class, 'obj_config_desig_id');
    }
    public function usernamefromobjectiveconfig()
    {
        return $this->belongsTo(User::class, 'obj_config_emp_id');
    }
    public function userobjectivetypefromobjectiveconfig()
    {
        return $this->belongsTo(ObjectiveType::class, 'obj_config_obj_typ_id');
    }
}

