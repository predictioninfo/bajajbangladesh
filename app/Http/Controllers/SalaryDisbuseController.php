<?php

namespace App\Http\Controllers;

use App\Exports\FestivalSalaryDisburseReportExport;
use App\Models\CompanyBankAccount;
use App\Models\CompanyBankAccountCommunication;
use App\Models\FestivalPayment;
use Excel;
use App\Models\User;
use App\Models\PaySlip;
use App\Models\Role;
use App\Models\Department;
use App\Models\Designation;
use App\Models\BankAccount;
use App\Exports\SalaryDisburseReportExport;
use DB;
use Auth;
use Illuminate\Http\Request;

class SalaryDisbuseController extends Controller
{
    public function salaryDisburse()
    {
        $bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();
        $departments = Department::where('department_com_id',Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id',Auth::user()->com_id)->get();
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {


            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name', 'designations.designation_name','pay_slips.pay_slip_net_salary','bank_accounts.bank_account_number','bank_accounts.bank_type')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                 ->orderBy("pay_slip_payment_date", "desc")
                ->get();

            return view('back-end.premium.payroll.salary-disburse.index', [
                'payment_histories' => $payment_histories,
                'departments' => $departments,
                'bank_accounts' => $bank_accounts,
            ]);
        } else {

            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name','pay_slips.pay_slip_net_salary','bank_accounts.bank_account_number','bank_accounts.bank_type')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->orderBy("pay_slip_payment_date", "desc")
                ->get();

            return view('back-end.premium.payroll.salary-disburse.index', [
                    'payment_histories' => $payment_histories,
                    'departments' => $departments,
                    'bank_accounts' => $bank_accounts,
            ]);
        }
    }

 public function searchSalaryDisburse(Request $request)
    {
        $start_day_month_year = date('Y-m-d', strtotime($request->start_date));
        if($request->start_date){
        $month = date('M', strtotime($request->start_date));
        $year = date('Y', strtotime($request->start_date));
        $month_m = date('m', strtotime($request->start_date));

        }else{
        $month_m = date('m', strtotime($request->month));
        $month = date('M', strtotime($request->month));
        $year = date('Y', strtotime($request->month));
        }

        $end_day_month_year = date('Y-m-d', strtotime($request->end_date));
        $end_month_year = date('Y-m', strtotime($request->end_date));

        $bank_type = $request->bank_type;
        $departments = Department::where('department_com_id',Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id',Auth::user()->com_id)->get();
        $bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();

        $communication_employee = CompanyBankAccountCommunication::where('company_bank_account_communication_com_id', Auth::user()->com_id)
                                    ->where('company_bank_account_communication_bank_id', $request->bank_id)
                                    ->get();

        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {
            try{

        if($request->bank_type == 'Core Bank' && $request->department_id && $request->month){

                $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                    ->join('departments', 'users.department_id', '=', 'departments.id')
                    ->join('designations', 'users.designation_id', '=', 'designations.id')
                    ->join('companies', 'users.com_id', '=', 'companies.id')
                    ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                    ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                    ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','departments.id', 'designations.designation_name','pay_slips.pay_slip_net_salary','bank_accounts.bank_account_number','bank_accounts.bank_type','company_bank_accounts.company_bank_account_number','companies.company_name','company_bank_accounts.company_bank_account_name','company_bank_accounts.company_bank_account_branch','company_bank_accounts.company_bank_account_address','pay_slips.pay_slip_payment_date')
                    ->where('pay_slip_com_id', Auth::user()->com_id)
                    // ->where('bank_accounts.bank_type', 'Core Bank')
                    ->where('company_bank_accounts.company_bank_account_type', 'Core Bank')
                    ->where('departments.id', $request->department_id)
                    ->whereMonth('pay_slip_payment_date',$month_m)
                    ->whereYear('pay_slip_payment_date',$year)
                    ->where('pay_slip_status', 1)
                    ->orderBy("pay_slip_payment_date", "desc")
                    ->get();

                $paymen_total = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                    ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                    ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                    ->join('departments', 'users.department_id', '=', 'departments.id')
                    ->where('pay_slip_com_id', Auth::user()->com_id)
                    // ->where('bank_accounts.bank_type', 'Core Bank')
                    ->where('company_bank_accounts.company_bank_account_type', 'Core Bank')
                    ->where('departments.id', $request->department_id)
                    ->whereMonth('pay_slip_payment_date',$month_m)
                    ->whereYear('pay_slip_payment_date',$year)
                    ->where('pay_slip_status', 1)
                    ->sum('pay_slip_net_salary');
            }

            if($request->bank_type == 'Core Bank' && $request->month){

                $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                    ->join('departments', 'users.department_id', '=', 'departments.id')
                    ->join('designations', 'users.designation_id', '=', 'designations.id')
                    ->join('companies', 'users.com_id', '=', 'companies.id')
                    ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                    ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                    ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','departments.id', 'designations.designation_name','pay_slips.pay_slip_net_salary','bank_accounts.bank_account_number','bank_accounts.bank_type','company_bank_accounts.company_bank_account_number','companies.company_name','company_bank_accounts.company_bank_account_name','company_bank_accounts.company_bank_account_branch','company_bank_accounts.company_bank_account_address','pay_slips.pay_slip_payment_date')
                    ->where('pay_slip_com_id', Auth::user()->com_id)
                    // ->where('bank_accounts.bank_type', 'Core Bank')
                    ->where('company_bank_accounts.company_bank_account_type', 'Core Bank')
                    ->whereMonth('pay_slip_payment_date',$month_m)
                    ->whereYear('pay_slip_payment_date',$year)
                    ->where('pay_slip_status', 1)
                    ->orderBy("pay_slip_payment_date", "desc")
                    ->get();

                $paymen_total = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                    ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                    ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                    ->join('departments', 'users.department_id', '=', 'departments.id')
                    ->where('pay_slip_com_id', Auth::user()->com_id)
                    // ->where('bank_accounts.bank_type', 'Core Bank')
                    ->where('company_bank_accounts.company_bank_account_type', 'Core Bank')
                    ->whereMonth('pay_slip_payment_date',$month_m)
                    ->whereYear('pay_slip_payment_date',$year)
                    ->where('pay_slip_status', 1)
                    ->sum('pay_slip_net_salary');
            }



        if($request->bank_type == 'Mobile Bank' && $request->department_id && $request->month ){

            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','departments.id', 'designations.designation_name','pay_slips.pay_slip_net_salary','bank_accounts.bank_account_number','bank_accounts.bank_type','company_bank_accounts.company_bank_account_number','companies.company_name','company_bank_accounts.company_bank_account_name','company_bank_accounts.company_bank_account_branch','company_bank_accounts.company_bank_account_address','pay_slips.pay_slip_payment_date')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                // ->where('bank_accounts.bank_type', 'Mobile Bank')
                ->where('company_bank_accounts.company_bank_account_type', 'Mobile Bank')
                ->where('departments.id', $request->department_id)
                ->whereMonth('pay_slip_payment_date', '=', $month_m)
                ->whereYear('pay_slip_payment_date', '=', $year)
                ->where('pay_slip_status', 1)
                ->orderBy("pay_slip_payment_date", "desc")
                ->get();

                 $paymen_total = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                 ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                 ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                 ->join('departments', 'users.department_id', '=', 'departments.id')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                // ->where('bank_accounts.bank_type', 'Mobile Bank')
                ->where('company_bank_accounts.company_bank_account_type', 'Mobile Bank')
                ->where('departments.id', $request->department_id)
                ->whereMonth('pay_slip_payment_date', '=', $month_m)
                ->whereYear('pay_slip_payment_date', '=', $year)
                ->where('pay_slip_status', 1)
                ->sum('pay_slip_net_salary');

        }

        if($request->bank_type == 'Mobile Bank' &&  $request->month ){

            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','departments.id', 'designations.designation_name','pay_slips.pay_slip_net_salary','bank_accounts.bank_account_number','bank_accounts.bank_type','company_bank_accounts.company_bank_account_number','companies.company_name','company_bank_accounts.company_bank_account_name','company_bank_accounts.company_bank_account_branch','company_bank_accounts.company_bank_account_address','pay_slips.pay_slip_payment_date')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                // ->where('bank_accounts.bank_type', 'Mobile Bank')
                ->where('company_bank_accounts.company_bank_account_type', 'Mobile Bank')
                ->whereMonth('pay_slip_payment_date',$month_m)
                ->whereYear('pay_slip_payment_date',$year)
                ->where('pay_slip_status', 1)
                ->orderBy("pay_slip_payment_date", "desc")
                ->get();

                 $paymen_total = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                 ->join('bank_accounts', 'pay_slips.pay_slip_employee_id', '=', 'bank_accounts.bank_account_employee_id')
                 ->join('company_bank_accounts', 'bank_accounts.bank_account_id', '=', 'company_bank_accounts.id')
                 ->join('departments', 'users.department_id', '=', 'departments.id')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                // ->where('bank_accounts.bank_type', 'Mobile Bank')
                ->where('company_bank_accounts.company_bank_account_type', 'Mobile Bank')
                ->whereMonth('pay_slip_payment_date',$month_m)
                ->whereYear('pay_slip_payment_date',$year)
                ->where('pay_slip_status', 1)
                ->sum('pay_slip_net_salary');

           }
            }catch(\Exception $e){
            return back()->with('message','please Selcet strat date ,end date or month');
            }

        }
        if($request->search){
        return view('back-end.premium.payroll.salary-disburse.search-index',get_defined_vars());
        }
        if($request->exeldownload){
            $data['payment_histories'] = $payment_histories;
            $data['bank_type'] = $bank_type;
            $data['paymen_total'] = $paymen_total;
            $data['month'] = $month;
            $data['year'] = $year;
            $exl = Excel::download(new SalaryDisburseReportExport($data), 'Bank Advise Salary for '.$data['month'].'-'.$data['year'].'['.$data['bank_type'].']'.'.xlsx');
            return $exl;
        }
        if($request->disburse_reqest){
        if($request->bank_type == 'Mobile Bank'){
            $number = number_format((float)$paymen_total , 0, '.', '');
            $numberToWord = $this->numberToWord($number);
            $headers = array(
                'Content-Type' => 'text/html',
                'Content-Disposition' => 'attachment; filename=salary '.$bank_type.' '.$month.' '.$year.'.doc'
            );
            return \Response::make(view('back-end.premium.payroll.salary-disburse.salaray-disburse-mobile-bank',compact('month','year','numberToWord','number','payment_histories','communication_employee')), 200, $headers);
            }
            if($request->bank_type == 'Core Bank'){
            $number = number_format((float)$paymen_total , 0, '.', '');
            $numberToWord = $this->numberToWord($number);
            $headers = array(
                'Content-Type' => 'text/html',
                'Content-Disposition' => 'attachment; filename=salary '.$bank_type.' '.$month.' '.$year.'.doc'
            );
            return \Response::make(view('back-end.premium.payroll.salary-disburse.salary-disburse-report',compact('month','year','numberToWord','number','payment_histories','communication_employee')), 200, $headers);
            }
        }
    }


    public function festivalSalaryDisburse(){
        $bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();
        $departments = Department::where('department_com_id',Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id',Auth::user()->com_id)->get();
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {


            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','designations.designation_name')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->get();

            return view('back-end.premium.payroll.salary-disburse.festival-index', [
                'payment_histories' => $payment_histories,
                'departments' => $departments,
                'bank_accounts' => $bank_accounts,
            ]);
        } else {

            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','designations.designation_name')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->get();

            return view('back-end.premium.payroll.salary-disburse.festival-index', [
                    'payment_histories' => $payment_histories,
                    'departments' => $departments,
                    'bank_accounts' => $bank_accounts,
            ]);
        }
    }

        public function searchFestivalSalaryDisburse(Request $request){

        $start_day_month_year = date('Y-m-d', strtotime($request->start_date));
        if($request->start_date){
        $month = date('M', strtotime($request->start_date));
        $year = date('Y', strtotime($request->start_date));
        $month_m = date('m', strtotime($request->start_date));

        }else{
        $month_m = date('m', strtotime($request->month));
        $month = date('M', strtotime($request->month));
        $year = date('Y', strtotime($request->month));
        }

        $end_day_month_year = date('Y-m-d', strtotime($request->end_date));
        $end_month_year = date('Y-m', strtotime($request->end_date));

        $bank_type = $request->bank_type;
        $departments = Department::where('department_com_id',Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id',Auth::user()->com_id)->get();
        $bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();

        $communication_employee = CompanyBankAccountCommunication::where('company_bank_account_communication_com_id', Auth::user()->com_id)
                                    ->where('company_bank_account_communication_bank_id', $request->bank_id)
                                    ->get();

        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {
            try{
        if($request->bank_type && $request->department_id && $request->start_date){

            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('departments.id', $request->department_id)
                ->whereMonth('festival_payment_date', $month_m)
                ->whereYear('festival_payment_date', $year)
                ->where('status', 1)
                ->get();

            $paymen_total = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->whereMonth('festival_payment_date', $month_m)
                ->whereYear('festival_payment_date', $year)
                ->where('status', 1)
                ->sum('festival_payment_net_bonus');

        }

        if($request->bank_type && $request->department_id && $request->month){

            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('departments.id', $request->department_id)
                ->whereMonth('festival_payment_date', $month_m)
                ->whereYear('festival_payment_date', $year)
                ->where('status', 1)
                ->get();

            $paymen_total = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('departments.id', $request->department_id)
                ->whereMonth('festival_payment_date', $month_m)
                ->whereYear('festival_payment_date', $year)
                ->where('status', 1)
                ->sum('festival_payment_net_bonus');

            }

            if($request->bank_type  && $request->month){

            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->whereMonth('festival_payment_date', $month_m)
                ->whereYear('festival_payment_date', $year)
                ->where('status', 1)
                ->get();

            $paymen_total = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->whereMonth('festival_payment_date', $month_m)
                ->whereYear('festival_payment_date', $year)
                ->where('status', 1)
                ->sum('festival_payment_net_bonus');
            }
        else {
            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->get();

            $paymen_total = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->sum('festival_payment_net_bonus');
        }
            }catch(\Exception $e){
            return back()->with('message','please Selcet strat date ,end date or month');
            }

        } else {
            $payment_histories = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->get();

            $paymen_total = FestivalPayment::join('users', 'festival_payments.festival_payment_emp_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->join('bank_accounts', 'festival_payments.festival_payment_emp_id', '=', 'bank_accounts.bank_account_employee_id')
                ->select('festival_payments.*', 'users.first_name', 'users.last_name', 'users.joining_date','users.company_assigned_id', 'departments.department_name','bank_accounts.bank_account_number','departments.id')
                ->where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->sum('festival_payment_net_bonus');
        }
        if($request->search){

        return view('back-end.premium.payroll.salary-disburse.festival-search-index',get_defined_vars());

        }
        if($request->exeldownload){
            $data['payment_histories'] = $payment_histories;
            $data['bank_type'] = $bank_type;
            $data['paymen_total'] = $paymen_total;
            $data['month'] = $month;
            $data['year'] = $year;
            $exl = Excel::download(new FestivalSalaryDisburseReportExport($data), 'Festival Bonus for '.$data['month'].'-'.$data['year'].'['.$data['bank_type'].']'.'.xlsx');
            return $exl;
        }
        if($request->disburse_reqest){
        if($request->bank_type == 'Mobile Bank'){
            $number = number_format((float)$paymen_total , 0, '.', '');
            $numberToWord = $this->numberToWord($number);
            $headers = array(
                'Content-Type' => 'text/html',
                'Content-Disposition' => 'attachment; filename=Festival Bonus '.$bank_type.' '.$month.' '.$year.'.doc'
            );
            return \Response::make(view('back-end.premium.payroll.salary-disburse.festival-salaray-disburse-mobile-bank',compact('month','year','numberToWord','number','payment_histories','communication_employee')), 200, $headers);
            }
            if($request->bank_type == 'Core Bank'){
            $number = number_format((float)$paymen_total , 0, '.', '');
            $numberToWord = $this->numberToWord($number);
            $headers = array(
                'Content-Type' => 'text/html',
                'Content-Disposition' => 'attachment; filename=Festival Bonus '.$bank_type.' '.$month.' '.$year.'.doc'
            );
            return \Response::make(view('back-end.premium.payroll.salary-disburse.festival-salary-disburse-report',compact('month','year','numberToWord','number','payment_histories','communication_employee')), 200, $headers);
            }
        }

        }





     public function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );

        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );

            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');

            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');

            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');

            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );

            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';

                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }

            $words  = implode( ', ' , $words );

            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }

            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }


}