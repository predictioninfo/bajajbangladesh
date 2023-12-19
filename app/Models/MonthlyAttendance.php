<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyAttendance extends Model
{
    use HasFactory;
    public function monthlyattendacecalculate()
    {
        return $this->belongsTo(Attendance::class, 'monthly_employee_id', 'employee_id');
    }
}