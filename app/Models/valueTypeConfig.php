<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valueTypeConfig extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function valueTypeConfig()
    {
        return $this->belongsTo(ValueType::class, 'value_type_config_value_type_id');
    }

    public function valueTypePointConfig()
    {
        return $this->belongsTo(ValuePoint::class, 'value_type_value_point_id');
    }
    public function valueDepartment()
    {
        return $this->belongsTo(Department::class, 'value_type_config_dept_id');
    }
    public function valueDesignation()
    {
        return $this->belongsTo(Designation::class, 'value_type_desg_id');
    }
    public function valueUser()
    {
        return $this->belongsTo(User::class, 'value_type_emp_id');
    }

    public function scopeWithValueFilters($query, $value_type_config_dept_id, $value_type_desg_id, $value_type_emp_id, $start_year, $end_year)
    {
        // \Log::info($value_type_config_dept_id);
        // \Log::info($value_type_desg_id);
        // \Log::info($value_type_emp_id);
        // \Log::info($start_year);
        // \Log::info($end_year);

        return $query->when($value_type_config_dept_id, function ($query) use ($value_type_config_dept_id) {

            $query->where('value_type_config_dept_id', $value_type_config_dept_id);
        })
            ->when($value_type_desg_id, function ($query) use ($value_type_desg_id) {

                $query->where('value_type_desg_id',  $value_type_desg_id);
            })
            ->when($value_type_emp_id, function ($query) use ($value_type_emp_id) {

                $query->where('value_type_emp_id', $value_type_emp_id);
            })
            ->when($start_year, function ($query) use ($start_year) {

                $query->where('value_date', '>=', $start_year);
            })
            ->when($end_year, function ($query) use ($end_year) {

                $query->where('value_date', '<=', $end_year);
            })
            ;
    }

}
