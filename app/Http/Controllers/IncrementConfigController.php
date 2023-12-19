<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\IncrementConfig;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\ObjectivePointConfig;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

class IncrementConfigController extends Controller
{
    public function addAnnualIncrementConfig(Request $req)
    {
        // $validated = $req->validate(
        //     [
        //         'objective_point' => 'required',
        //         'value_point' => 'required',
        //         'salary_percentage' => 'required',

        //     ],
        //     [
        //         'objective_point.required' => 'Objective point is required',
        //         'value_point.required' => 'Value point is required',
        //         'salary_percentage.required' => 'Salary percentage must be required.'
        //     ]
        // );
        try {
            $increment_config = new IncrementConfig();
            $increment_config->increment_config_com_id = Auth::user()->com_id;
            $increment_config->increment_config_objective_point = $req->objective_point;
            $increment_config->increment_config_value_point = $req->value_point;
            // $increment_config->to_increment_config_objective_point = $req->to_objective_point;
            // $increment_config->to_increment_config_value_point = $req->to_value_point;
            $increment_config->increment_config_salary_percentage = $req->salary_percentage;
            $increment_config->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function updateAnnualIncrementConfig(Request $req)
    {
        $validated = $req->validate(
            [
                'objective_point' => 'required',
                'value_point' => 'required',
                'salary_percentage' => 'required',

            ],
            [
                'objective_point.required' => 'Objective point is required',
                'value_point.required' => 'Value point is required',
                'salary_percentage.required' => 'Salary percentage must be required.'
            ]
        );
        try {
            $increment_config = IncrementConfig::find($req->id);
            $increment_config->increment_config_com_id = Auth::user()->com_id;
            $increment_config->increment_config_objective_point = $req->objective_point;
            $increment_config->increment_config_value_point = $req->value_point;
            $increment_config->to_increment_config_objective_point = $req->to_objective_point;
            $increment_config->to_increment_config_value_point = $req->to_value_point;
            $increment_config->increment_config_salary_percentage = $req->salary_percentage;
            $increment_config->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function incrementPointById(Request $request)
    {
        $where = array('id' => $request->id);
        $detailsByIds = IncrementConfig::where($where)->first();
        return response()->json($detailsByIds);
    }


    public function deleteAnnualIncrementConfig($id)
    {
        DB::beginTransaction();
        try {
            $area = IncrementConfig::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }
}
