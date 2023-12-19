<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function territoryregion(){
        return $this->belongsTo(Region::class,'territory_region_id');
    }
    public function territoryarea(){
        return $this->belongsTo(Area::class,'territory_area_id');
    }
}
