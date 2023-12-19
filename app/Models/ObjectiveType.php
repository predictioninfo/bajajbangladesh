<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectiveType extends Model
{
    use HasFactory;
    public function abcd(){
        return $this->hasMany(ObjectiveDetails::class,'id');
       }
}
