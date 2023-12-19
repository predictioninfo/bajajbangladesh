<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    use HasFactory;

    public function userLunch(){
        return $this->belongsTo(User::class,'lunch_emp_id');
    }
}