<?php

namespace App\Http\Controllers;

use App\Models\MinimumTaxConfigure;
use App\Models\TaxConfig;
use Illuminate\Http\Request;
use Auth;

class TaxConfigController extends Controller
{
    public function addTaxCofig(Request $request)
    {
        $validated = $request->validate([
            'minimum_salary' => 'required',
            'maximum_salary' => 'required',
            'tax_percentage' => 'required',
        ]);
        try {
            $tax_config = new TaxConfig();
            $tax_config->tax_com_id = Auth::user()->com_id;
            $tax_config->minimum_salary = $request->minimum_salary;
            $tax_config->maximum_salary = $request->maximum_salary;
            $tax_config->tax_percentage = $request->tax_percentage;
            $tax_config->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function taxConfigById(Request $request)
    {

        $where = array('id' => $request->id);
        $taxConfigByIds = TaxConfig::where($where)->first();

        return response()->json($taxConfigByIds);
    }

    public function updateTaxConfig(Request $request)
    {
        $validated = $request->validate([
            'minimum_salary' => 'required',
            'maximum_salary' => 'required',
            'tax_percentage' => 'required',
        ]);
        try {
            $tax_config = TaxConfig::find($request->id);
            $tax_config->minimum_salary = $request->minimum_salary;
            $tax_config->maximum_salary = $request->maximum_salary;
            $tax_config->tax_percentage = $request->tax_percentage;
            $tax_config->save();



            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteTaxConfig($id)
    {
        try {
            $tax_config = TaxConfig::where('id', $id)->delete();

            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function bulkDeleteTaxConfig(Request $request)
    {
        try {
            $tax_config = TaxConfig::where('tax_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function addMinuimumTaxCofig(Request $request)
    {
        $validated = $request->validate([
            'minimum_tax' => 'required',
        ]);
        try {
        if(MinimumTaxConfigure::where('minimum_tax_config_com_id',Auth::user()->com_id)->exists()){
            $tax_config =  MinimumTaxConfigure::where('minimum_tax_config_com_id',Auth::user()->com_id)->first();
            $tax_config->minimum_tax_config_com_id = Auth::user()->com_id;
            $tax_config->minimum_tax_config_amount = $request->minimum_tax;
            $tax_config->save();
            return back()->with('message', 'Added Successfully');
        }else{
            $tax_config = new MinimumTaxConfigure();
            $tax_config->minimum_tax_config_com_id = Auth::user()->com_id;
            $tax_config->minimum_tax_config_amount = $request->minimum_tax;
            $tax_config->save();
            return back()->with('message', 'Added Successfully');
        }

        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something went wrong');
        }

    }

}