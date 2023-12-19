<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
        public function taskassingedby(){
        return $this->belongsTo(User::class,'task_assigned_by','id');
       }
}