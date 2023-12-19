<?php

namespace App\Http\Controllers;

use App\Models\VariableType;
use Illuminate\Http\Request;
use Auth;
use Session;

class VariableTypeController extends Controller
{
    public function awardTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = new VariableType();
            $variable_type->variable_type_com_id = Auth::user()->com_id;
            $variable_type->variable_type_category = "Award";
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function warningTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = new VariableType();
            $variable_type->variable_type_com_id = Auth::user()->com_id;
            $variable_type->variable_type_category = "Warning";
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function terminationTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = new VariableType();
            $variable_type->variable_type_com_id = Auth::user()->com_id;
            $variable_type->variable_type_category = "Termination";
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function jobStatusTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = new VariableType();
            $variable_type->variable_type_com_id = Auth::user()->com_id;
            $variable_type->variable_type_category = "Job-Status";
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function officeShiftTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = new VariableType();
            $variable_type->variable_type_com_id = Auth::user()->com_id;
            $variable_type->variable_type_category = "Office-Shift";
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function documentTypeAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = new VariableType();
            $variable_type->variable_type_com_id = Auth::user()->com_id;
            $variable_type->variable_type_category = "Document-Type";
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function variableTypeById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeVariableTypeByIds = VariableType::where($where)->first();

        return response()->json($employeeVariableTypeByIds);
    }

    public function variableTypeUpdate(Request $request)
    {
        $validated = $request->validate([
            'variable_type_name' => 'required',
        ]);
        try {
            $variable_type = VariableType::find($request->id);
            $variable_type->variable_type_name = $request->variable_type_name;
            $variable_type->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteVariableType($id)
    {
        try {
            $variable_type = VariableType::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}