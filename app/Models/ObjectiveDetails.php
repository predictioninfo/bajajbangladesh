<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectiveDetails extends Model
{
    use HasFactory;

    public function objectiveTypes(){
        return $this->belongsTo(ObjectiveType::class,'objective_obj_type_id');
    }

    public function objectiveTypeConfig(){
        return $this->belongsTo(ObjectiveTypeConfig::class,'objective_obj_type_id','obj_config_obj_typ_id');
    }
    public function objective(){
        return $this->belongsTo(Objective::class,'objective_id');
    }

    public function objectiveReport(){
        return $this->hasOne(Objective::class,'id','objective_id');
    }



}
