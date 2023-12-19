<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assetuser(){
        return $this->belongsTo(User::class,'asset_employee_id');
       }
    public function assetdepartment(){
     return $this->belongsTo(Department::class,'asset_department_id');
    }
 
}
