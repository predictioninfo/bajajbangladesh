<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManPower extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function manPowerDeparment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function manPowerDesignation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function manPowerGardeSetaup()
    {
        return $this->belongsTo(GradeSetup::class, 'gradesetup_id');
    }

    public function scopeWithFilters($query, $department_id_for_serach, $desig_id_for_serach, $gradesetup_id_for_serach, $start_date, $end_date)
    {
        // \Log::info($department_id_for_serach);
        // \Log::info($desig_id_for_serach);
        // \Log::info($gradesetup_id_for_serach);
        // \Log::info($start_date);
        // \Log::info($end_date);

        return $query->when($department_id_for_serach, function ($query) use ($department_id_for_serach) {

            $query->where('department_id', $department_id_for_serach);
        })
            ->when($desig_id_for_serach, function ($query) use ($desig_id_for_serach) {

                $query->where('designation_id',  $desig_id_for_serach);
            })
            ->when($gradesetup_id_for_serach, function ($query) use ($gradesetup_id_for_serach) {

                $query->where('gradesetup_id', $gradesetup_id_for_serach);
            })
            ->when($start_date, function ($query) use ($start_date) {

                $query->where('vacancy_date', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {

                $query->where('vacancy_date', '<=', $end_date);
            });
    }
}
