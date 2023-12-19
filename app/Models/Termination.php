<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    use HasFactory;
    public function userTermination()
    {
        return $this->belongsTo(User::class, 'transfer_employee_id');
    }
}