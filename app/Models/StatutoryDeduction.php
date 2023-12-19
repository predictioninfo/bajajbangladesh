<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutoryDeduction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'statutory_deduc_com_id',
        'statutory_deduc_employee_id',
        'statutory_deduc_month_year',
        'statutory_deduc_type',
        'statutory_deduc_title',
        'statutory_deduc_amount',
    ];
}
