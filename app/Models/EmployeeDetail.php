<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;
    protected $gurded = [];
    // public function emoloyee(){
    // return $this->hasOne(User::class,'empdetails_employee_id');
    // }
    //Permanent Address
    public function emploeeDivision()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
    public function emploeeDistrict()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function emploeeUpazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }
    public function emploeeUnion()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }
    //Present Address
    public function presentEmploeeDivision()
    {
        return $this->belongsTo(Division::class, 'present_division_id', 'id');
    }
    public function presentEmploeeDistrict()
    {
        return $this->belongsTo(District::class, 'present_district_id', 'id');
    }
    public function presentEmploeeUpazila()
    {
        return $this->belongsTo(Upazila::class, 'present_upazila_id', 'id');
    }
    public function presentEmploeeUnion()
    {
        return $this->belongsTo(Union::class, 'present_union_id', 'id');
    }
    //Nationality
    public function userNationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'id');
    }
}
