<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DbHouse extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function dbhouseregion(){
        return $this->belongsTo(Region::class,'db_house_region_id');
    }
    public function dbhousearea(){
        return $this->belongsTo(Area::class,'db_house_area_id');
    }
    public function dbhouseterritory(){
        return $this->belongsTo(Territory::class,'db_house_territory_id');
    }
    public function dbhousetown(){
        return $this->belongsTo(Town::class,'db_house_town_id');
    }
}
