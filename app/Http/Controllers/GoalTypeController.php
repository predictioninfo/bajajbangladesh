<?php

namespace App\Http\Controllers;

use App\Models\GoalType;
use Illuminate\Http\Request;
use Auth;

class GoalTypeController extends Controller
{
    public function goalTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'goal_type_name' => 'required',
        ]);
        try {
            $goal_type = new GoalType();
            $goal_type->goal_type_com_id = Auth::user()->com_id;
            $goal_type->goal_type_name = $request->goal_type_name;
            $goal_type->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function goalTypeById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeGoalTypeByIds = GoalType::where($where)->first();

        return response()->json($employeeGoalTypeByIds);
    }

    public function updateGoalType(Request $request)
    {
        $validated = $request->validate([
            'goal_type_name' => 'required',
        ]);
        try {
            $goal_type =  GoalType::find($request->id);
            $goal_type->goal_type_com_id = Auth::user()->com_id;
            $goal_type->goal_type_name = $request->goal_type_name;
            $goal_type->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteGoalType($id)
    {
        $goal_type =  GoalType::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}