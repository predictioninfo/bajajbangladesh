<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userqualification()
    {
        return $this->belongsTo(User::class, 'qualification_employee_id');
    }
}
