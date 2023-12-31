<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    public function leaveTypes()
    {
        return $this->belongsTo(LeaveType::class, 'leaves_leave_type_id','id');
    }
}
