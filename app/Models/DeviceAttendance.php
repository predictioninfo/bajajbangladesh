<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceAttendance extends Model
{
    use HasFactory;
    protected $table = 'device_attendances';
    protected $fillable =['com_id','emp_code','first_name','last_name','attendance_date','clock_in','clock_out','punch_time','area_alias','terminal_sn','terminal_alias','verify_type_display'];
}
