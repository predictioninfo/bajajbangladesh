<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectivePointConfig;
use Auth;

class ObjectivePointConfigController extends Controller
{
    public function objectivePointAdd(Request $request)
    {
        $validated = $request->validate([
            'objective_point' => 'required',
        ]);
        try {
            if (ObjectivePointConfig::where('objective_point_config_com_id', Auth::user()->com_id)->whereNotNull('id')->exists()) {
                return back()->with('message', 'You already configured Objective Point!');
            }

            $objective_point_config = new ObjectivePointConfig();
            $objective_point_config->objective_point_config_com_id = Auth::user()->com_id;
            $objective_point_config->objective_point_config_point_number = $request->objective_point;
            $objective_point_config->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }
    public function objectivePointConfigById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeObjectivePointConfigByIds = ObjectivePointConfig::where($where)->first();
        return response()->json($employeeObjectivePointConfigByIds);
    }

    public function objectivePointUpdate(Request $request)
    {
        $validated = $request->validate([
            'objective_point' => 'required',
            // 'pd_point_result_point' => 'required',
        ]);
        try {
            $objective_point_config =  ObjectivePointConfig::find($request->id);
            $objective_point_config->objective_point_config_com_id = Auth::user()->com_id;
            $objective_point_config->objective_point_config_point_number = $request->objective_point;
            $objective_point_config->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteObjectivePoint($id)
    {
        try {
            $promotion_demotion_point =  ObjectivePointConfig::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}