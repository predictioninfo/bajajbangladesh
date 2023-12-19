<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function designationdepartment()
    {
        return $this->belongsTo(Department::class, 'designation_department_id');
    }
    public function DesignationManPower()
    {
        return $this->hasOne(ManPower::class, 'designation_id');
    }
}
