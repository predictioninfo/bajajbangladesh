<?php

namespace App\Http\Controllers;

use App\Models\MedicalAllowanceNonTaxableRangeYearly;
use Illuminate\Http\Request;
use Auth;
class MedicalAllowanceNonTaxableRangeYearlyController extends Controller
{
    public function add(Request $request){
        $validated = $request->validate([
            'medical_allowance_minimum_tax_amount' => 'required',
        ]);

        try {
        if(MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
            $tax_config =  MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->first();
            $tax_config->medical_allowance_non_taxable_range_yearlies_com_id = Auth::user()->com_id;
            $tax_config->medical_allowance_non_taxable_range_yearlies_amount = $request->medical_allowance_minimum_tax_amount;
            $tax_config->save();
            return back()->with('message', 'Added Successfully');
        }else{
            $tax_config = new MedicalAllowanceNonTaxableRangeYearly();
            $tax_config->medical_allowance_non_taxable_range_yearlies_com_id = Auth::user()->com_id;
            $tax_config->medical_allowance_non_taxable_range_yearlies_amount = $request->medical_allowance_minimum_tax_amount;
            $tax_config->save();
            return back()->with('message', 'Added Successfully');
        }

        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something went wrong');
        }
}
}