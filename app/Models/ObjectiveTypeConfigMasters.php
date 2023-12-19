<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectiveTypeConfigMasters extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function departmentfromobjectiveconfig()
    {
        return $this->belongsTo(Department::class, 'obj_config_mas_dep_id');
    }
    public function designationfromobjectiveconfig()
    {
        return $this->belongsTo(Designation::class, 'obj_config_mas_dis_id');
    }
}
