<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCandidate extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function jobpostdetailsforcandidate(){
        return $this->belongsTo(JobPost::class,'job_cnd_job_post_id');
    }
    public function userdetailsforcandidate(){
        return $this->belongsTo(User::class,'job_cnd_intw_std_by');
    }

}
