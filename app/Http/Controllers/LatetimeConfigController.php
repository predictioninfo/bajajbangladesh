<?php

namespace App\Http\Controllers;

use App\Models\LatetimeConfig;
use Illuminate\Http\Request;
use DB;
use Auth;

class LatetimeConfigController extends Controller
{
    public function configLatetime(Request $request)
    {
        $validated = $request->validate([
            'minimum_countable_time' => 'required',
            'minimum_countable_day' => 'required',
        ]);
        try {
            if (LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->exists()) {
                $late_time_company_wise_id = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->get(['id']);
                foreach ($late_time_company_wise_id as $late_time_company_wise_id_value) {
                    $latetime_config = LatetimeConfig::find($late_time_company_wise_id_value->id);
                    $latetime_config->minimum_countable_time = $request->minimum_countable_time;
                    $latetime_config->minimum_countable_day = $request->minimum_countable_day;
                    $latetime_config->save();
                }
            } else {
                $latetime_config = new LatetimeConfig();
                $latetime_config->latetime_config_com_id = Auth::user()->com_id;
                $latetime_config->minimum_countable_time = $request->minimum_countable_time;
                $latetime_config->minimum_countable_day = $request->minimum_countable_day;
                $latetime_config->save();
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Configured Successfully');
    }

    public function configLatetimeById(Request $request)
    {

        $where = array('id' => $request->id);
        $configLatetimeByIds = LatetimeConfig::where($where)->first();

        return response()->json($configLatetimeByIds);
    }

    public function updateConfigLatetime(Request $request)
    {

        $validated = $request->validate([
            'minimum_countable_time' => 'required',
            'minimum_countable_day' => 'required',
        ]);
        try {
            $latetime_config = LatetimeConfig::find($request->id);
            $latetime_config->minimum_countable_time = $request->minimum_countable_time;
            $latetime_config->minimum_countable_day = $request->minimum_countable_day;
            $latetime_config->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteConfigLatetime($id)
    {
        try {
            $latetime_config = LatetimeConfig::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}