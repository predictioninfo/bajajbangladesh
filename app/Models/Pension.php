<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;
    protected $fillable = [
        'pension_com_id',
        'pension_employee_id',
        'pension_start_date',
        'pension_type',
        'pension_amount',
    ];
}
