<?php

namespace App\Http\Controllers;

use App\Models\ObjectiveType;
use Illuminate\Http\Request;
use Auth;

class ObjectiveTypeController extends Controller
{
    public function objectiveTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'objective_type_name' => 'required',
        ]);
        try {
            $objective_type = new ObjectiveType();
            $objective_type->objective_type_com_id = Auth::user()->com_id;
            $objective_type->objective_type_name = $request->objective_type_name;
            $objective_type->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function objectiveTypeById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeObjectiveTypeByIds = ObjectiveType::where($where)->first();

        return response()->json($employeeObjectiveTypeByIds);
    }
   

    public function updateObjectiveType(Request $request)
    {
        $validated = $request->validate([
            'objective_type_name' => 'required',
        ]);
        try {
            $objective_type =  ObjectiveType::find($request->id);
            $objective_type->objective_type_name = $request->objective_type_name;
            $objective_type->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteObjectiveType($id)
    {
        try {
            $objective_type =  ObjectiveType::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}