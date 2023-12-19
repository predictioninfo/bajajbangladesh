<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalTracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function usergoaltype(){
        return $this->belongsTo(GoalType::class,'goal_tracking_goal_type_id');
    }
}
