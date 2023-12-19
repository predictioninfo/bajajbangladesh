<?php

namespace App\Http\Controllers;

use App\Models\VariableMethod;
use Illuminate\Http\Request;
use Auth;
use Session;

class VariableMethodController extends Controller
{
    public function arrangementMethodAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_method_name' => 'required',
        ]);
        try {
            $variable_method = new VariableMethod();
            $variable_method->variable_method_com_id = Auth::user()->com_id;
            $variable_method->variable_method_category = "Arrangement";
            $variable_method->variable_method_name = $request->variable_method_name;
            $variable_method->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function paymentMethodAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_method_name' => 'required',
        ]);
        try {
            $variable_method = new VariableMethod();
            $variable_method->variable_method_com_id = Auth::user()->com_id;
            $variable_method->variable_method_category = "Payment";
            $variable_method->variable_method_name = $request->variable_method_name;
            $variable_method->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function qualificationMethodAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_method_name' => 'required',
        ]);
        try {
            $variable_method = new VariableMethod();
            $variable_method->variable_method_com_id = Auth::user()->com_id;
            $variable_method->variable_method_category = "Qualification";
            $variable_method->variable_method_name = $request->variable_method_name;
            $variable_method->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function jobCategoryAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_method_name' => 'required',
        ]);
        try {
            $variable_method = new VariableMethod();
            $variable_method->variable_method_com_id = Auth::user()->com_id;
            $variable_method->variable_method_category = "Job";
            $variable_method->variable_method_name = $request->variable_method_name;
            $variable_method->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function jobLocationAdd(Request $request)
    {
        $validated = $request->validate([
            'variable_method_name' => 'required',
        ]);
        try {
            $variable_method = new VariableMethod();
            $variable_method->variable_method_com_id = Auth::user()->com_id;
            $variable_method->variable_method_category = "Joblocation";
            $variable_method->variable_method_name = $request->variable_method_name;
            $variable_method->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function variableMethodById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeVariableMethodByIds = VariableMethod::where($where)->first();

        return response()->json($employeeVariableMethodByIds);
    }

    public function variableMethodUpdate(Request $request)
    {
        $validated = $request->validate([
            'variable_method_name' => 'required',
        ]);
        try {
            $variable_method = VariableMethod::find($request->id);
            $variable_method->variable_method_name = $request->variable_method_name;
            $variable_method->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteVariableMethod($id)
    {
        try {
            $variable_method = VariableMethod::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}