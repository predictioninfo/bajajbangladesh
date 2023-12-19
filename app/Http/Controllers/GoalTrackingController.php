<?php

namespace App\Http\Controllers;

use App\Models\GoalTracking;
use Illuminate\Http\Request;
use Auth;

class GoalTrackingController extends Controller
{
    public function goalTrackingAdd(Request $request)
    {
        $validated = $request->validate([
            'goal_tracking_goal_type_id' => 'required',
            'goal_tracking_sub' => 'required',
            'goal_tracking_ta' => 'required',
            'goal_tracking_desc' => 'required',
            'goal_tracking_start_date' => 'required',
            'goal_tracking_end_date' => 'required',
            'goal_tracking_progress' => 'required|numeric',
        ]);
        try {
            $random_number = "HRGT-" . rand(100000, 100000000000) . $request->goal_tracking_goal_type_id;

            if (GoalTracking::where('goal_tracking_key', $random_number)->exists()) {
                return back()->with('message', 'Please try again later...');
            }

            $goal_tracking = new GoalTracking();
            $goal_tracking->goal_tracking_key = $random_number;
            $goal_tracking->goal_tracking_com_id = Auth::user()->com_id;
            $goal_tracking->goal_tracking_goal_type_id = $request->goal_tracking_goal_type_id;
            $goal_tracking->goal_tracking_sub = $request->goal_tracking_sub;
            $goal_tracking->goal_tracking_ta = $request->goal_tracking_ta;
            $goal_tracking->goal_tracking_desc = $request->goal_tracking_desc;
            $goal_tracking->goal_tracking_start_date = $request->goal_tracking_start_date;
            $goal_tracking->goal_tracking_end_date = $request->goal_tracking_end_date;
            $goal_tracking->goal_tracking_progress = $request->goal_tracking_progress;
            $goal_tracking->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function goalTrackingById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeGoalTrackingByIds = GoalTracking::where($where)->first();

        return response()->json($employeeGoalTrackingByIds);
    }

    public function updateGoalTracking(Request $request)
    {
        $validated = $request->validate([
            'goal_tracking_goal_type_id' => 'required',
            'goal_tracking_sub' => 'required',
            'goal_tracking_ta' => 'required',
            'goal_tracking_desc' => 'required',
            'goal_tracking_start_date' => 'required',
            'goal_tracking_end_date' => 'required',
            'goal_tracking_progress' => 'required',
        ]);
        try {
            $goal_tracking =  GoalTracking::find($request->id);
            $goal_tracking->goal_tracking_goal_type_id = $request->goal_tracking_goal_type_id;
            $goal_tracking->goal_tracking_sub = $request->goal_tracking_sub;
            $goal_tracking->goal_tracking_ta = $request->goal_tracking_ta;
            $goal_tracking->goal_tracking_desc = $request->goal_tracking_desc;
            $goal_tracking->goal_tracking_start_date = $request->goal_tracking_start_date;
            $goal_tracking->goal_tracking_end_date = $request->goal_tracking_end_date;
            $goal_tracking->goal_tracking_progress = $request->goal_tracking_progress;
            $goal_tracking->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteGoalTracking($id)
    {
        $goal_tracking =  GoalTracking::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}