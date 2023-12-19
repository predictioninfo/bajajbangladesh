<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'other_payment_com_id',
        'other_payment_employee_id',
        'other_payment_month_year',
        'other_payment_title',
        'other_payment_amount',
    ];
}
