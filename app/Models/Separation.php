<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Separation extends Model
{
    use HasFactory;

    public function separationEmployee(){
        return $this->belongsTo(User::class,'employee_id');
       }
    public function repalaceEmployee(){
        return $this->belongsTo(User::class,'replace_employee_id');
       }

    public function resignationEmployee(){
        return $this->belongsTo(Resignation::class,'resignation_id');
       }
    public function terminationEmployee(){
        return $this->belongsTo(Termination::class,'termination_id');
       }
}
