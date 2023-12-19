<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function announcementuser(){
        return $this->belongsTo(User::class,'announcement_by');
    }
    public function announcementdepartment(){
        return $this->belongsTo(Department::class,'announcement_department_id');
    }

}