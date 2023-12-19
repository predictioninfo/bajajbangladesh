<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatAllocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userdepartmentfromseatallocation(){
        return $this->belongsTo(Department::class,'seat_allocation_dpt_id');
    }

    public function userdesignationfromseatallocation(){
        return $this->belongsTo(Designation::class,'seat_allocation_desig_id');
    }
}
