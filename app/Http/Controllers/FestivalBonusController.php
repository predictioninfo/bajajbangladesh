<?php

namespace App\Http\Controllers;

use App\Models\FestivalBonus;
use Illuminate\Http\Request;
use Auth;
use Session;

class FestivalBonusController extends Controller
{
    public function addFestival(Request $request)
    {
        $validated = $request->validate([
            'festival_bonus_date_month_year' => 'required',
            'festival_bonus_title' => 'required',
        ]);
        try {
            $festival = new FestivalBonus();
            $festival->festival_bonus_com_id = Auth::user()->com_id;
            $festival->festival_bonus_date_month_year = $request->festival_bonus_date_month_year . "-01";
            $festival->festival_bonus_title = $request->festival_bonus_title;
            $festival->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function festivalById(Request $request)
    {

        $where = array('id' => $request->id);
        $festivalByIds = FestivalBonus::where($where)->first();

        return response()->json($festivalByIds);
    }

    public function festivalUpdate(Request $request)
    {
        $validated = $request->validate([
            'festival_bonus_date_month_year' => 'required',
            'festival_bonus_title' => 'required',
        ]);
        try {
            $festival = FestivalBonus::find($request->id);
            $festival->festival_bonus_date_month_year = $request->festival_bonus_date_month_year . "-01";
            $festival->festival_bonus_title = $request->festival_bonus_title;
            $festival->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteFestival($id)
    {
        $festival = FestivalBonus::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteFestival(Request $request)
    {
        $festival = FestivalBonus::where('festival_bonus_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
