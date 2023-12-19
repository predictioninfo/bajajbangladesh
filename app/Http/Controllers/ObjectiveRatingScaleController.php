<?php

namespace App\Http\Controllers;

use App\Models\RatingScale;
use Illuminate\Http\Request;
use Auth;

class ObjectiveRatingScaleController extends Controller
{
    public function objectiveScaleAdd(Request $request)
    {
        
        try {
            $objective_scale = new RatingScale();
            $objective_scale->point_scale_com_id = Auth::user()->com_id;
            $objective_scale->point = $request->point;
            $objective_scale->defination = $request->defination;
            $objective_scale->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function objectivePointScaleById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeObjectivePointScaleIds = RatingScale::where($where)->first();

        return response()->json($employeeObjectivePointScaleIds);
    }

    public function objectivePointScaleUpdate(Request $request)
    {
       
        try {
            $objective_scale =  RatingScale::find($request->id);
            $objective_scale->point_scale_com_id = Auth::user()->com_id;
            $objective_scale->point = $request->point;
            $objective_scale->defination = $request->defination;
            $objective_scale->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteObjectivePointScale($id)
    {
        try {
            $objective_scale =  RatingScale::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}