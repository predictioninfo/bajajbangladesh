<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompensatoryLeave extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function usercompensatoryleave(){
    return $this->belongsTo(User::class,'compen_leave_employee_id');
    }
}
