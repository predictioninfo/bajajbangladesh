<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    public function fromDepartmetUser()
    {
        return $this->belongsTo(Department::class, 'transfer_from_department_id');
    }
    public function toDepartmetUser()
    {
        return $this->belongsTo(Department::class, 'transfer_to_department_id');
    }

    public function toUserDesignation()
    {
        return $this->belongsTo(Designation::class, 'transfer_to_designation_id');
    }
    public function userTransfer()
    {
        return $this->belongsTo(User::class, 'transfer_employee_id');
    }
}
