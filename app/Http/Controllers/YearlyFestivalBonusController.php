<?php

namespace App\Http\Controllers;
use App\Models\YearlyFestivalBonusConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;


class YearlyFestivalBonusController extends Controller
{
    public function yearlyFestivalBonusIndex()
    {
        $users = User::where('com_id' , Auth::user()->com_id)
        ->where('is_active', 1)->where('users_bulk_deleted', 'No')
        ->whereNull('company_profile')->orderBy('id', 'DESC')
        ->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $yearlyFestivalBonus = YearlyFestivalBonusConfig::where('fes_bonus_com_id' ,Auth::user()->com_id)->with('user')->get();
        //dd($yearlyFestivalBonus);
        return view('back-end.premium.customize.yearly-festivel-bonus.yearly-festival-bonus-index', get_defined_vars());
    }

   
    public function addYearlyFestivalBonus(Request $request) {
        $yearlyFestivalBonus = YearlyFestivalBonusConfig::where('fes_bonus_com_id', Auth::user()->com_id)
            ->where('employee_id', $request->emp_id)
            ->first(); // Fetch the existing record if it exists
    
        if ($yearlyFestivalBonus) {
            $yearlyFestivalBonus->total_bonus = $request->total_bonus;
            $yearlyFestivalBonus->save();
            return back()->with('message', 'Added Successfully');
        } else {
            // If the record doesn't exist, create a new instance of YearlyFestivalBonusConfig
            $yearlyFestivalBonus = new YearlyFestivalBonusConfig();
            $yearlyFestivalBonus->fes_bonus_com_id = Auth::user()->com_id;
            $yearlyFestivalBonus->employee_id = $request->emp_id;
            $yearlyFestivalBonus->total_bonus = $request->total_bonus;
            $yearlyFestivalBonus->save();
            return back()->with('message', 'Added Successfully');
        }
    }

    public function updateYearlyFestivalBonus(Request $request)
    {
        try {
            $yearlyFestivalBonus = YearlyFestivalBonusConfig::find($request->id);
            $yearlyFestivalBonus->fes_bonus_com_id = Auth::user()->com_id;
            $yearlyFestivalBonus->employee_id = $request->emp_id;
            $yearlyFestivalBonus->total_bonus = $request->total_bonus;
            $yearlyFestivalBonus->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deletYearlyFestivalBonus($id)
    {
        try {
            $yearlyFestivalBonus = YearlyFestivalBonusConfig::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
