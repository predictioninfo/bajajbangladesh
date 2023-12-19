<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueType extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function valueconfigpoints()
    {
        return $this->belongsTo(ValuePoint::class, 'value_type_value_point_id');
    }
}