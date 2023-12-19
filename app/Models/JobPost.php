<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jobpostcompanydetails(){
        return $this->belongsTo(Company::class,'jb_post_com_id');
       }

    public function jobpostuserdetails(){
    return $this->belongsTo(User::class,'jb_post_submited_by');
    }
    public function jobpostvariable(){
    return $this->belongsTo(VariableType::class,'jb_post_type_id','id');
    }

}
