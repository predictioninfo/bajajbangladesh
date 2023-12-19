<?php

namespace App\Http\Controllers;

use App\Models\ProvidentfundConfig;
use Illuminate\Http\Request;
use Auth;

class ProvidentfundConfigController extends Controller
{
    public function addCompanyProvidentfundConfig(Request $request)
    {
        try {
            if (ProvidentfundConfig::where('providentfund_config_com_id', '=', Auth::user()->com_id)->exists()) {
                return back()->with('message', 'Already Set, You can not set twice!!!');
            } else {

                $validated = $request->validate([
                    'providentfund_config_amount_precentage' => 'required',

                ]);

                $company_pf_config = new ProvidentfundConfig();
                $company_pf_config->providentfund_config_com_id = Auth::user()->com_id;
                $company_pf_config->providentfund_config_amount_precentage = $request->providentfund_config_amount_precentage;
                $company_pf_config->save();

                return back()->with('message', 'PF Configured Successfully!!!');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function companyProvidentfundConfigById(Request $request)
    {

        $where = array('id' => $request->id);
        $companuyPfConfigByIds = ProvidentfundConfig::where($where)->first();

        return response()->json($companuyPfConfigByIds);
    }

    public function companyProvidentfundConfigUpdate(Request $request)
    {
        try {
            $validated = $request->validate([
                'providentfund_config_amount_precentage' => 'required',

            ]);

            $company_pf_config = ProvidentfundConfig::find($request->id);
            $company_pf_config->providentfund_config_amount_precentage = $request->providentfund_config_amount_precentage;
            $company_pf_config->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteCompanyProvidentfundConfig($id)
    {
        try {
            $company_pf_config = ProvidentfundConfig::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}