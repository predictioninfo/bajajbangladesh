<?php

namespace App\Http\Controllers;

use App\Models\OvertimeConfig;
use Illuminate\Http\Request;
use Auth;

class OvertimeConfigController extends Controller
{
    public function configOverTime(Request $request)
    {
        try {
            if (OvertimeConfig::where('overtime_config_com_id', '=', Auth::user()->com_id)->exists()) {
                return back()->with('message', 'Already Configured!!!');
            } else {

                $validated = $request->validate([
                    'minimum_countable_over_time' => 'required',
                ]);

                $overtime_config = new OvertimeConfig();
                $overtime_config->overtime_config_com_id = Auth::user()->com_id;
                $overtime_config->minimum_countable_over_time = $request->minimum_countable_over_time;
                $overtime_config->save();
            }
            return back()->with('message', 'Configured Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function configOverTimeById(Request $request)
    {

        $where = array('id' => $request->id);
        $configLatetimeByIds = OvertimeConfig::where($where)->first();

        return response()->json($configLatetimeByIds);
    }

    public function updateConfigOverTime(Request $request)
    {

        $validated = $request->validate([
            'minimum_countable_over_time' => 'required',
        ]);
        try {
            $overtime_config = OvertimeConfig::find($request->id);
            $overtime_config->minimum_countable_over_time = $request->minimum_countable_over_time;
            $overtime_config->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteConfigOverTime($id)
    {
        try {
            $overtime_config = OvertimeConfig::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}