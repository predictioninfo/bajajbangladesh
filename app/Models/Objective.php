<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Objective extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function usergoaltypefromobjective()
    {
        return $this->belongsTo(GoalType::class, 'objective_goal_type_id');
    }

    public function userobjectivetypefromobjective()
    {
        return $this->belongsTo(ObjectiveType::class, 'objective_obj_type_id');
    }

    public function userdepartmentfromobjective()
    {
        return $this->belongsTo(Department::class, 'objective_dept_id');
    }

    public function userdesignationfromobjective()
    {
        return $this->belongsTo(Designation::class, 'objective_desig_id');
    }

    public function userfromobjective()
    {
        return $this->belongsTo(User::class, 'objective_emp_id');
    }

    public function objectiveDetails()
    {
        return $this->hasMany(ObjectiveDetails::class, 'id');
    }
    public function objectiveFilter()
    {
        return $this->hasMany(ObjectiveDetails::class,'objective_id');
    }
    // public function objectiveSalaryHistory()
    // {
    //     return $this->hasMany(SalaryHistory::class,   'objective_emp_id ', 'salary_history_emp_id',);
    // }
    public function objectiveSalaryHistory()
    {
        return $this->hasOne(SalaryHistory::class, 'salary_history_emp_id', 'objective_emp_id',);
    }

    public function scopeWithFilters($query, $objective_dept_id, $objective_desig_id, $objective_emp_id, $start_year, $end_year, $point, $value_point)
    {
        // \Log::info($objective_dept_id);
        // \Log::info($objective_desig_id);
        // \Log::info($objective_emp_id);
        // \Log::info($start_year);
        // \Log::info($end_year);
        // \Log::info($point);
        // \Log::info($value_point);

        return $query->when($objective_dept_id, function ($query) use ($objective_dept_id) {

            $query->where('objective_dept_id', $objective_dept_id);
        })
            ->when($objective_desig_id, function ($query) use ($objective_desig_id) {

                $query->where('objective_desig_id',  $objective_desig_id);
            })
            ->when($objective_emp_id, function ($query) use ($objective_emp_id) {

                $query->where('objective_emp_id', $objective_emp_id);
            })
            ->when($start_year, function ($query) use ($start_year) {

                $query->where('objective_date', '>=', $start_year);
            })
            ->when($end_year, function ($query) use ($end_year) {

                $query->where('objective_date', '<=', $end_year);
            })
            ->when($point, function ($query) use ($point) {

                $query->where('point', '<=', $point);
            })
            ->when($value_point, function ($query) use ($value_point) {

                $query->where('value_point', '<=', $value_point);
            })
            ;
    }
}