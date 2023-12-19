<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceTemplate extends Model
{
    use HasFactory;
    public function experienceHeader()
    {
        return $this->belongsTo(Header::class, 'header_id');
    }
    public function experienceSignatory()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function experienceFooter()
    {
        return $this->belongsTo(Footer::class, 'footer_id');
    }
}
