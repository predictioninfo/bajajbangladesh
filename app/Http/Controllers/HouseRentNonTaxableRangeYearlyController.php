<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseRentNonTaxableRangeYearly;
use Auth;
class HouseRentNonTaxableRangeYearlyController extends Controller
{
public function add(Request $request){
        $validated = $request->validate([
            'house_rent_minimum_tax_amount' => 'required',
        ]);
        try {
        if(HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
            $tax_config =  HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->first();
            $tax_config->house_rent_non_taxable_range_yearlies_com_id = Auth::user()->com_id;
            $tax_config->house_rent_non_taxable_range_yearlies_amount = $request->house_rent_minimum_tax_amount;
            $tax_config->save();
            return back()->with('message', 'Added Successfully');
        }else{
            $tax_config = new HouseRentNonTaxableRangeYearly();
            $tax_config->house_rent_non_taxable_range_yearlies_com_id = Auth::user()->com_id;
            $tax_config->house_rent_non_taxable_range_yearlies_amount = $request->house_rent_minimum_tax_amount;
            $tax_config->save();
            return back()->with('message', 'Added Successfully');
        }

        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something went wrong');
        }
}
}