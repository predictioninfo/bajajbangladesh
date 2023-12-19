<?php

namespace App\Http\Controllers;

use App\Models\SalaryConfig;
use Illuminate\Http\Request;
use Auth;



class SalaryConfigController extends Controller
{
    public function addSalaryConfig(Request $request)
    {
        $validated = $request->validate([
            'salary_config_basic_salary' => 'required',
            'salary_config_house_rent_allowance' => 'required',
            'salary_config_conveyance_allowance' => 'required',
            'salary_config_medical_allowance' => 'required',
            'salary_config_festival_bonus' => 'required',
            'salary_config_provident_fund' => 'required',
            'salary_config_festival_bonus_active_period' => 'required',
        ]);

        try {
            if (SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->exists()) {
                return back()->with('message', 'You Already Set Your Salary Config');
            } else {

                $salary_config = new SalaryConfig();
                $salary_config->salary_config_com_id = Auth::user()->com_id;
                $salary_config->salary_config_basic_salary = $request->salary_config_basic_salary;
                $salary_config->salary_config_house_rent_allowance = $request->salary_config_house_rent_allowance;
                $salary_config->salary_config_conveyance_allowance = $request->salary_config_conveyance_allowance;
                $salary_config->salary_config_medical_allowance = $request->salary_config_medical_allowance;
                $salary_config->salary_config_festival_bonus = $request->salary_config_festival_bonus;
                $salary_config->salary_config_provident_fund = $request->salary_config_provident_fund;
                $salary_config->salary_config_festival_bonus_active_period = $request->salary_config_festival_bonus_active_period;
                $salary_config->save();

                return back()->with('message', 'Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function salaryConfigById(Request $request)
    {

        $where = array('id' => $request->id);
        $salaryConfigByIds = SalaryConfig::where($where)->first();

        return response()->json($salaryConfigByIds);
    }

    public function updateSalaryConfig(Request $request)
    {
        $validated = $request->validate([
            'salary_config_basic_salary' => 'required',
            'salary_config_house_rent_allowance' => 'required',
            'salary_config_conveyance_allowance' => 'required',
            'salary_config_medical_allowance' => 'required',
            'salary_config_festival_bonus' => 'required',
            'salary_config_provident_fund' => 'required',
            'salary_config_festival_bonus_active_period' => 'required',
        ]);
        try {
            $salary_config = SalaryConfig::find($request->id);
            $salary_config->salary_config_basic_salary = $request->salary_config_basic_salary;
            $salary_config->salary_config_house_rent_allowance = $request->salary_config_house_rent_allowance;
            $salary_config->salary_config_conveyance_allowance = $request->salary_config_conveyance_allowance;
            $salary_config->salary_config_medical_allowance = $request->salary_config_medical_allowance;
            $salary_config->salary_config_festival_bonus = $request->salary_config_festival_bonus;
            $salary_config->salary_config_provident_fund = $request->salary_config_provident_fund;
            $salary_config->salary_config_festival_bonus_active_period = $request->salary_config_festival_bonus_active_period;
            $salary_config->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function checkPackageByExistsCompany($packageId)
    {
        $packageList = User::where('company_package', $packageId)->count();
        if ($packageList > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSalaryConfig($id)
    {
        try {
            $salary_config = SalaryConfig::where('id', $id)->delete();

            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function bulkDeleteSalaryConfig(Request $request)
    {
        try {
            $salary_config = SalaryConfig::where('salary_config_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}