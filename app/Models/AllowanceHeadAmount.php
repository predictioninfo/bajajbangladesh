<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceHeadAmount extends Model
{
    use HasFactory;

     protected $table = 'allowance_head_allocations';
    protected $guarded = [];
    
    public function allowancehead(){
        return $this->belongsTo(AllowanceHead::class,'allowance_head_id','id');
    }
    public function userallowancehead(){
        return $this->belongsTo(User::class,'id','allowance_head_allocation_emp_id');
    }
}