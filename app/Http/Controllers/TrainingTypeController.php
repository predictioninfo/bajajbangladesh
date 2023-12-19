<?php

namespace App\Http\Controllers;

use App\Models\TrainingType;
use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
use DataTables;

class TrainingTypeController extends Controller
{
    public function trainingTypeAdd(Request $request)
    {

        $validated = $request->validate([
            'training_type' => 'required',
        ]);
        try {
            $training_type = new TrainingType();
            $training_type->training_type_com_id = Auth::user()->com_id;
            $training_type->training_type = $request->training_type;
            $training_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!Please Contact your IT Support.');
        }
    }


    public function trainingTypeById(Request $request)
    {
        try {
            $where = array('id' => $request->id);
            $detailsByIds = TrainingType::where($where)->first();
            return response()->json($detailsByIds);
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!Please Contact your IT Support.');
        }
    }

    public function trainingTypeUpdate(Request $request)
    {

        $validated = $request->validate([
            'training_type' => 'required',
        ]);
        try {
            $training_type = TrainingType::find($request->id);
            $training_type->training_type = $request->training_type;
            $training_type->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!Please Contact your IT Support.');
        }
    }

    public function trainingTypeDelete($id)
    {
        try {
            $training_type = TrainingType::find($id);
            $training_type->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!There are some dependency.Please Contact your IT Support.');
        }
    }
}