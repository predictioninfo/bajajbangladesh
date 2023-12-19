<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    public function userPromotion()
    {
        return $this->belongsTo(User::class, 'promotion_employee_id');
    }
}
