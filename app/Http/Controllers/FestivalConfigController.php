<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FestivalBonus;
use App\Models\FestivalConfig;
use App\Models\FestivalPayment;
use App\Models\MinimumTaxConfigure;
use App\Models\MonthlyAttendance;
use App\Models\SalaryConfig;
use App\Models\TaxConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use PhpParser\Node\Stmt\Catch_;

class FestivalConfigController extends Controller
{
    public function addFestivalConfig(Request $request)
    {
        $validated = $request->validate([
            'festival_bonus_percentage' => 'required',
            'festival_bonus_time_duration' => 'required',
            'salary_type' => 'required',
        ]);
        try {
            if (FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->exists()) {
                return back()->with('message_err', 'Configured already added');
            } else {
                $festival_config = new FestivalConfig();
                $festival_config->festival_config_com_id = Auth::user()->com_id;
                $festival_config->festival_config_salary_type = $request->salary_type;
                $festival_config->festival_config_festival_bonus_percentage = $request->festival_bonus_percentage;
                $festival_config->festival_config_festival_bonus_time_duration = $request->festival_bonus_time_duration;
                $festival_config->save();
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function festivalConfigUpdate(Request $request)
    {
        $validated = $request->validate([
            'festival_bonus_percentage' => 'required',
            'festival_bonus_time_duration' => 'required',
            'salary_type' => 'required',
        ]);
        try {
            $festival_config = FestivalConfig::where('id', $request->id)->first();
            $festival_config->festival_config_com_id = Auth::user()->com_id;
            $festival_config->festival_config_salary_type = $request->salary_type;
            $festival_config->festival_config_festival_bonus_percentage = $request->festival_bonus_percentage;
            $festival_config->festival_config_festival_bonus_time_duration = $request->festival_bonus_time_duration;
            $festival_config->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public  function  newFestivalPaymentIndex(Request $request)
    {
        try {
            if ($request->department_id) {
                $last_month_date_year = date('Y-m-d', strtotime($request->month_year));
                $last_month = date('m', strtotime($request->month_year));
                $date_wise_day_name = date('D', strtotime($request->month_year));
                $previous_month_year = date('Y', strtotime($request->month_year));
                $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
                $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
                $users = User::where('com_id', Auth::user()->com_id)->whereNull('company_profile')->where('is_active', 1)->where('department_id', $request->department_id)->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'phone', 'gross_salary', 'joining_date', 'department_id', 'employment_type']);
                $salary_configs = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first('salary_config_basic_salary', 'salary_config_conveyance_allowance', 'salary_config_house_rent_allowance', 'salary_config_medical_allowance');

                $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);
                $festivalBonus = FestivalBonus::where('festival_bonus_com_id', Auth::user()->com_id)->get();
            } else {
                $last_month_date_year = date('Y-m-d', strtotime('last month'));
                $last_month = date('m', strtotime('last month'));
                $date_wise_day_name = date('D', strtotime('last month'));
                $previous_month_year = date('Y', strtotime('last month'));
                $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();

                $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);

                $users = User::where('com_id', Auth::user()->com_id)->whereNull('company_profile')->where('is_active', 1)->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'phone', 'gross_salary', 'joining_date', 'department_id', 'employment_type']);

                $salary_configs = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first('salary_config_basic_salary', 'salary_config_conveyance_allowance', 'salary_config_house_rent_allowance', 'salary_config_medical_allowance');

                $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);

                $festivalBonus = FestivalBonus::where('festival_bonus_com_id', Auth::user()->com_id)->get();

                $festival_payments = FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)->get();
            }
            $minimum_tax_config =  MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();
            return view('back-end.premium.payroll.new-festival-payment.index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'Enable to all configure option.');
        }
    }

    public function deleteFestivalConfig($id)
    {
        $festival = FestivalConfig::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
