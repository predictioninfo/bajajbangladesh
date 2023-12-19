<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentPlanDetails extends Model
{
    use HasFactory;

    public function developmentPlans()
    {
        return $this->belongsTo(DevelopmentPlan::class, 'development_details__id');
    }
}
