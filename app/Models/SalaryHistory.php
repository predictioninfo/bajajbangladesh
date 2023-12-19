<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
    use HasFactory;
    public function usertSalaryHistory()
    {
        return $this->belongsTo(User::class, 'salary_history_emp_id');
    }
}