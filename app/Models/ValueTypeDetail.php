<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueTypeDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function valueDeatils()
    {
        return $this->belongsTo(ValueType::class, 'value_type_detail_value_type_id');
    }

    public function valueConfigDeatils()
    {
        return $this->belongsTo(valueTypeConfigDetail::class, 'id', 'value_type_config_type_detail_id');
    }
}