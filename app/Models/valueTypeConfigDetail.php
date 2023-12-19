<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valueTypeConfigDetail extends Model
{
    use HasFactory;

    public function valueDeatilDepartment()
    {
        return $this->belongsTo(Department::class, 'value_type_config_dept_id');
    }
    public function valueDeatilDesignation()
    {
        return $this->belongsTo(Designation::class, 'value_type_config_desg_id');
    }
    public function valueDeatilUser()
    {
        return $this->belongsTo(User::class, 'value_type_config_detail_emp_id');
    }
    public function valueTypeDeatilConfig()
    {
        return $this->belongsTo(valueTypeConfig::class, 'value_type_config_type_detail_id');
    }
    public function valueTypDeatils()
    {
        return $this->belongsTo(ValueTypeDetail::class, 'value_type_config_type_detail_id');
    }
    public function valuetype()
    {
        return $this->belongsTo(ValueType::class, 'value_type_config_type_id');
    }
    public function employeeValueTypeConfigPoint()
    {
        return $this->belongsTo(ValuePoint::class, 'value_type_config_employee_rating');
    }
    public function supervisorValueTypeConfigPoint()
    {
        return $this->belongsTo(ValuePoint::class, 'value_type_config_supervisor_rating');
    }
}