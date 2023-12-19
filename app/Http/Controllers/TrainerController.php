<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
use DataTables;

class TrainerController extends Controller
{
    public function trainerAdd(Request $request)
    {

        $validated = $request->validate([
            'trainer_first_name' => 'required',
            'trainer_last_name' => 'required',
            'trainer_email' => 'required',
            'trainer_phone' => 'required',
            'trainer_address' => 'required',
            'trainer_expertise' => 'required',
        ]);
        try {
            $trainer = new Trainer();
            $trainer->trainer_com_id = Auth::user()->com_id;
            $trainer->trainer_first_name = $request->trainer_first_name;
            $trainer->trainer_last_name = $request->trainer_last_name;
            $trainer->trainer_email = $request->trainer_email;
            $trainer->trainer_phone = $request->trainer_phone;
            $trainer->trainer_address = $request->trainer_address;
            $trainer->trainer_expertise = $request->trainer_expertise;
            $trainer->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function trainerById(Request $request)
    {

        $where = array('id' => $request->id);
        $detailsByIds = Trainer::where($where)->first();
        return response()->json($detailsByIds);
    }

    public function trainerUpdate(Request $request)
    {

        $validated = $request->validate([
            'trainer_first_name' => 'required',
            'trainer_last_name' => 'required',
            'trainer_email' => 'required',
            'trainer_phone' => 'required',
            'trainer_address' => 'required',
            'trainer_expertise' => 'required',
        ]);
        try {
            $trainer = Trainer::find($request->id);
            $trainer->trainer_first_name = $request->trainer_first_name;
            $trainer->trainer_last_name = $request->trainer_last_name;
            $trainer->trainer_email = $request->trainer_email;
            $trainer->trainer_phone = $request->trainer_phone;
            $trainer->trainer_address = $request->trainer_address;
            $trainer->trainer_expertise = $request->trainer_expertise;
            $trainer->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function trainerDelete($id)
    {
        try {
            $trainer = Trainer::find($id);
            $trainer->delete();

            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}