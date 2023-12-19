<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function townregion(){
        return $this->belongsTo(Region::class,'town_region_id');
    }
    public function townarea(){
        return $this->belongsTo(Area::class,'town_area_id');
    }
    public function townterritory(){
        return $this->belongsTo(Territory::class,'town_territory_id');
    }
}
