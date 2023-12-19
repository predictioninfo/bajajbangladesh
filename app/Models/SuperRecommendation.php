<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperRecommendation extends Model
{
    use HasFactory;


    public function recommendationType(){
        return $this->belongsTo(Recommendation::class, 'recom_id','id');
    }
    public function employee(){
        return $this->belongsTo(User::class, 'recom_employee_id','id');
    }
}
