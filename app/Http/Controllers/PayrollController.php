<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use Mail;
use Excel;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Leave;
use App\Models\Lunch;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\PaySlip;
use Carbon\CarbonPeriod;
use App\Models\TaxConfig;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\BankAccount;
use App\Models\Designation;
use App\Models\Notification;
use App\Models\SalaryConfig;
use Illuminate\Http\Request;
use App\Models\FestivalBonus;
use App\Models\ProvidentFund;
use App\Models\FestivalConfig;
use App\Models\FestivalPayment;
use App\Models\MonthlyAttendance;
use App\Exports\salarySheetExport;
use App\Models\MinimumTaxConfigure;
use App\Models\ProvidentfundConfig;
use App\Models\ProvidentfundReport;
use App\Models\LateTimeSalaryConfig;
use App\Models\IncrementSalaryHistory;
use App\Models\HouseRentNonTaxableRangeYearly;
use App\Models\CompanyBankAccountCommunication;
use App\Exports\withOutPaymentSalarySheetExport;
use App\Models\MedicalAllowanceNonTaxableRangeYearly;
use App\Models\ConveyanceAllowanceNonTaxableRangeYearly;
use App\Models\YearlyFestivalBonusConfig;


class PayrollController extends Controller
{
    public function newPaymentIndex(Request $request)
    {
      $users = CompanyBankAccountCommunication::with('bankAccountCommunication')->
      where('company_bank_account_communication_com_id',Auth::user()->com_id)
      ->get();

      $house_rent_non_taxable =  HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
      $medical_allowance_non_taxable =  MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
      $conveyance_allowance_non_taxable =  ConveyanceAllowanceNonTaxableRangeYearly::where('conveyance_allowance_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
        $late_time_salary_config = LateTimeSalaryConfig::where('late_time_salary_config_com_id', Auth::user()->com_id)->first();
        if($request->department_id && $request->month_year){
            $minimum_tax_config = MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();
            $last_month_date_year = date('Y', strtotime($request->month_year));
            $last_month = date('m', strtotime($request->month_year));
            $date_wise_day_name = date('D', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));
            $departments = Department::where('department_com_id',Auth::user()->com_id)->get(['id','department_name']);

            $tax_configs = TaxConfig::where('tax_com_id','=',Auth::user()->com_id)->get();
            $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);
            $festivalBonus = FestivalBonus::where('festival_bonus_com_id', Auth::user()->com_id)->get();
            $new_payments = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('salary_configs', 'monthly_attendances.monthly_com_id', '=', 'salary_configs.salary_config_com_id')
            ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id', 'users.joining_date', 'users.department_id', 'users.profile_photo', 'users.gross_salary', 'users.salary_type', 'users.user_provident_fund', 'user_provident_fund_member', 'users.email', 'users.per_hour_rate', 'salary_configs.salary_config_basic_salary', 'salary_configs.salary_config_house_rent_allowance', 'salary_configs.salary_config_conveyance_allowance', 'salary_configs.salary_config_medical_allowance', 'salary_configs.salary_config_festival_bonus', 'mobile_bill', 'transport_allowance')
            ->where('monthly_com_id', '=', Auth::user()->com_id)
            ->where('department_id', '=', $request->department_id)
            ->whereMonth('attendance_month','=',$last_month)
            ->whereYear('attendance_year','=',$previous_month_year)
            ->get();

            return view('back-end.premium.payroll.new-payment.new-payment-index2',get_defined_vars());
        }else{
            $minimum_tax_config = MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();
            $tax_configs = TaxConfig::where('tax_com_id','=',Auth::user()->com_id)->get();
            $last_month = date('m', strtotime($request->month_year));
            $date_wise_day_name = date('D', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));
            $departments = Department::where('department_com_id',Auth::user()->com_id)->get(['id','department_name']);
            $last_month_date_year = date('Y', strtotime($request->month_year));
            $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);
            $festivalBonus = FestivalBonus::where('festival_bonus_com_id', Auth::user()->com_id)->get();
            $new_payments = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('salary_configs', 'monthly_attendances.monthly_com_id', '=', 'salary_configs.salary_config_com_id')
            ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id', 'users.joining_date', 'users.department_id', 'users.per_hour_rate', 'users.profile_photo', 'users.gross_salary', 'users.salary_type', 'users.user_provident_fund', 'user_provident_fund_member', 'users.email', 'salary_configs.salary_config_basic_salary', 'salary_configs.salary_config_house_rent_allowance', 'salary_configs.salary_config_conveyance_allowance', 'salary_configs.salary_config_medical_allowance', 'salary_configs.salary_config_festival_bonus', 'mobile_bill', 'transport_allowance')
            ->where('monthly_com_id', '=', Auth::user()->com_id)
            ->whereMonth('attendance_month','=',$last_month)
            ->whereYear('attendance_year','=',$previous_month_year)
            ->get();
            return view('back-end.premium.payroll.new-payment.new-payment-index2',get_defined_vars());
        }

    }



    public function salaryDetailsById(Request $request)
    {
        function total_holiday($month, $year)
        {

            $holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->get();

            $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $holidays = 0;
            for ($i = 1; $i <= $total_days; $i++)
                foreach ($holidays_names as $holidays_names_value) {
                    if (date('N', strtotime($year . '-' . $month . '-' . $i)) == $holidays_names_value->holiday_number) //if monday means 1, tue means 2.... sunday means 7
                        $holidays++;
                }
            return $holidays;
        }
        $total_holidays = total_holiday(1, 2016);

        $user_details = User::where('id', $request->id)->first();

        return response()->json($user_details);
    }
    public function makePayment(Request $request)
    {
        $validated = $request->validate([
            'pay_slip_com_id' => 'required',
            'pay_slip_employee_id' => 'required',
            'pay_slip_department_id' => 'required',
            'pay_slip_payment_type' => 'required',
            'pay_slip_payment_date' => 'required',
            'pay_slip_month_year' => 'required',
            'pay_slip_gross_salary' => 'required',
            'pay_slip_basic_salary' => 'required',
            'pay_slip_house_rent' => 'required',
            'pay_slip_medical_allowance' => 'required',
            'pay_slip_conveyance_allowance' => 'required',
            'pay_slip_festival_bonus' => 'required',
            'pay_slip_commissions' => 'required',
            'pay_slip_other_payments' => 'required',
            'pay_slip_overtimes' => 'required',
            'pay_slip_provident_fund' => 'required',
            'pay_slip_tax_deduction' => 'required',
            'pay_slip_loans' => 'required',
            'pay_slip_statutory_deduction' => 'required',
            'pay_slip_net_salary' => 'required',
            // 'pay_slip_commissions' => 'required',
            'pay_slip_working_days' => 'required',
            'pay_slip_transport_allowance' => 'required',
            'pay_slip_mobile_bill' => 'required',

        ]);


        function generateRandomString($length = 25)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $random_key = generateRandomString() . $request->pay_slip_employee_id;
        $random_number = rand(100000, 100000000000000) . $request->pay_slip_employee_id;

        // this code for non parmanent employees payroll
        if (IncrementSalaryHistory::where('emp_id', $request->pay_slip_employee_id)->first()) {

            $totalWorkingDay = $request->pay_slip_working_days;
            $incrementData = IncrementSalaryHistory::where('inc_sal_his_com_id', Auth::user()->com_id)
                ->where('emp_id', $request->pay_slip_employee_id)
                ->first();

            // previous month history
            $startOfMonth = now()->subMonth()->startOfMonth()->format('Y-m-d');
            $incrementDate = Carbon::parse($incrementData->increment_date);
            $previousDayOfMonth = now()->subMonth()->daysInMonth;


            // specify the start and end dates
            $startDate = Carbon::parse($startOfMonth);
            $endDate = Carbon::parse($incrementDate);


            //attandance weekend holiday  count start
            $holidaysDays = [];
            for ($holidayDate = $startDate->copy(); $holidayDate->lte($endDate); $holidayDate->addDay()) {
                $holidaysDays[] = $holidayDate->format('D');
            }

            $holidayData = [];

            foreach ($holidaysDays as $holiday) {
                $data = Holiday::where('holiday_com_id', Auth::user()->com_id)
                    ->where('holiday_type', 'Weekly-Holiday')
                    ->where('holiday_name', [$holiday])
                    ->get();
                if (!$data->isEmpty()) {
                    $holidayData = array_merge($holidayData, $data->toArray());
                }
            }
            $holidayDataCount = count($holidayData);

            //attandance weekend holiday count end

            //attandance other-holiday  count start

            $otherHolidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                ->where('holiday_type', 'Other-Holiday')
                ->get();
            $probationStartDate = Carbon::parse($incrementData->start_date_of_month);
            $probationEndDate = Carbon::parse($incrementData->increment_date);

            $overlappingDays = 0;
            foreach ($otherHolidays as $holiday) {
                $holidaysStartDate = Carbon::parse($holiday->start_date);
                $holidaysEndDate = Carbon::parse($holiday->end_date);

                // Check if the probation period overlaps with the holiday period
                if ($probationStartDate <= $holidaysEndDate && $probationEndDate >= $holidaysStartDate) {
                    // Find the start and end dates of the overlapping period
                    $overlapStartDate = max($probationStartDate, $holidaysStartDate);
                    $overlapEndDate = min($probationEndDate, $holidaysEndDate);

                    // Calculate the number of overlapping days
                    $duration = $overlapStartDate->diff($overlapEndDate);
                    $overlappingDays += $duration->days + 1;
                }
            }

            //attandance other-holiday  count end

            // Leave Attendence Count Start

            $leaves = Leave::where('leaves_employee_id', $request->pay_slip_employee_id)->where('leaves_status', 'Approved')->get();
            $overlappingLeaveDays = 0;
            foreach ($leaves as $leave) {
                $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                // Check if the probation period overlaps with the holiday period
                if ($probationStartDate <= $leaveEndDate && $probationEndDate >= $leaveStartDate) {
                    // Find the start and end dates of the overlapping period
                    $overlapLeaveStartDate = max($probationStartDate, $leaveStartDate);
                    $overlapLeaveEndDate = min($probationEndDate, $leaveEndDate);

                    // Calculate the number of overlapping days
                    $durationLeave = $overlapLeaveStartDate->diff($overlapLeaveEndDate);
                    $overlappingLeaveDays += $durationLeave->days + 1;
                }
            }

            // Leave Attendence Count End

            //attandance day count start
            $days = [];
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $days[] = $date->format('Y-m-d');
            }

            $attendanceData = [];
            foreach ($days as $day) {
                $data = Attendance::where('employee_id', $request->pay_slip_employee_id)
                    ->whereIn('attendance_date', [$day])
                    ->get();
                if (!$data->isEmpty()) {
                    $attendanceData[$day] = $data;
                }
            }

            //attandance day count start end

            //total probition working day start
            $totalAttendanceCount = 0;
            foreach ($attendanceData as $data) {
                $totalAttendanceCount += $data->count();
            }
            //total probition working day end

            // probition working days count start
            // $probitionTotalWorkingDays = $totalAttendanceCount + $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
            $probitionTotalWorkingDays = $incrementData->days_before_probation;
            // probition working days count end

            // probition previous salary  count start
            // $previousMonthSalary = ($incrementData->old_gross_salary / $previousDayOfMonth) * $probitionTotalWorkingDays;
            $previousMonthSalary = $incrementData->salary_before_probation;
            // probition previous salary  count end

            // other  working day start
            // $daysPreviousBetween = $totalWorkingDay - $probitionTotalWorkingDays;
            $daysPreviousBetween = $incrementData->days_after_probation;
            // other  working day end

            // $totalWorkDays = $probitionTotalWorkingDays + $daysPreviousBetween;
            $totalWorkDays = $incrementData->days_before_probation + $incrementData->days_after_probation;

            // probition  after  count start
            // $currentMonthSalary = ($incrementData->new_gross_salary / $previousDayOfMonth) * $daysPreviousBetween;
            $currentMonthSalary = $incrementData->salary_after_probation;
            // probition  after  count end

            //total salary start
            // $totalSalary = round($previousMonthSalary + $currentMonthSalary);
            $totalSalary = $incrementData->probation_net_salary;
            //total salary end

            //inactive Employee Salary
            if (User::where('id', $request->pay_slip_employee_id)->whereNotNull('inactive_date')->first()) {


                $userInactiveDate = User::where('com_id', Auth::user()->com_id)
                    ->where('id', $request->pay_slip_employee_id)
                    ->first();

                // active month date history
                $inactiveDate = Carbon::parse($userInactiveDate->inactive_date);
                $activeEndMonthFirstDate = now()->subMonth()->startOfMonth()->format('Y-m-d');

                $previousDayOfMonth = now()->subMonth()->daysInMonth;

                // specify the start and end dates
                $startDate = Carbon::parse($activeEndMonthFirstDate);
                $endDate = Carbon::parse($inactiveDate);

                //attandance weekend holiday count start
                $holidaysDays = [];
                for ($holidayDate = $startDate->copy(); $holidayDate->lte($endDate); $holidayDate->addDay()) {
                    $holidaysDays[] = $holidayDate->format('D');
                }

                $holidayData = [];

                foreach ($holidaysDays as $holiday) {
                    $data = Holiday::where('holiday_com_id', Auth::user()->com_id)
                        ->where('holiday_type', 'Weekly-Holiday')
                        ->where('holiday_name', [$holiday])
                        ->get();
                    if (!$data->isEmpty()) {
                        $holidayData = array_merge($holidayData, $data->toArray());
                    }
                }

                $holidayDataCount = count($holidayData);

                //attandance weekend holiday count end

                //attandance other-holiday  count start

                $otherHolidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                    ->where('holiday_type', 'Other-Holiday')
                    ->get();

                $activeMonthstartDate = Carbon::parse($startDate);
                $activMonthLastDate = Carbon::parse($endDate);


                $overlappingDays = 0;

                foreach ($otherHolidays as $holiday) {
                    $holidaysStartDate = Carbon::parse($holiday->start_date);
                    $holidaysEndDate = Carbon::parse($holiday->end_date);

                    // Check if the probation period overlaps with the holiday period
                    if ($activeMonthstartDate <= $holidaysEndDate && $activMonthLastDate >= $holidaysEndDate) {
                        // Find the start and end dates of the overlapping period
                        $overlapStartDate = max($activeMonthstartDate, $holidaysStartDate);
                        $overlapEndDate = min($activMonthLastDate, $holidaysEndDate);

                        // Calculate the number of overlapping days
                        $duration = $overlapStartDate->diff($overlapEndDate);
                        $overlappingDays += $duration->days + 1;
                    }
                }

                //attandance other-holiday  count end

                // Leave Attendence Count Start

                $leaves = Leave::where('leaves_employee_id', $request->pay_slip_employee_id)->where('leaves_status', 'Approved')->get();
                $overlappingLeaveDays = 0;
                foreach ($leaves as $leave) {
                    $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                    $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                    // Check if the probation period overlaps with the holiday period
                    if ($activeMonthstartDate <= $leaveEndDate && $activMonthLastDate >= $leaveStartDate) {
                        // Find the start and end dates of the overlapping period
                        $overlapLeaveStartDate = max($activeMonthstartDate, $leaveStartDate);
                        $overlapLeaveEndDate = min($activMonthLastDate, $leaveEndDate);

                        // Calculate the number of overlapping days

                        $durationLeave = $overlapLeaveStartDate->diff($overlapLeaveEndDate);
                        $overlappingLeaveDays += $durationLeave->days + 1;
                    }
                }

                // Leave Attendence Count End

                //attandance day count start startDate
                $days = [];
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    $days[] = $date->format('Y-m-d');
                }
                $days;
                $attendanceData = [];
                foreach ($days as $day) {
                    $data = Attendance::where('employee_id', $request->pay_slip_employee_id)
                        ->whereIn('attendance_date', [$day])
                        ->get();
                    if (!$data->isEmpty()) {
                        $attendanceData[$day] = $data;
                    }
                }

                //attandance day count start end

                //total probition working day start
                $totalAttendanceCount = 0;
                foreach ($attendanceData as $data) {
                    $totalAttendanceCount += $data->count();
                }


                //total probition working day end

                // probition working days count start
                $totalWorkingDays = $totalAttendanceCount + $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
                // probition working days count end

                // probition previous salary  count start
                $totalSalary = ($userInactiveDate->gross_salary / $previousDayOfMonth) * $totalWorkingDays;

            }

            $gross_deductions = $request->pay_slip_provident_fund + $request->pay_slip_tax_deduction + $request->pay_slip_loans + $request->pay_slip_statutory_deduction + $request->pay_slip_late_day_salary_deduct;
            $net_pay = ($totalSalary + $request->pay_slip_mobile_bill + $request->pay_slip_overtimes + $request->pay_slip_transport_allowance) - $gross_deductions;

            $pay_slip = new PaySlip();
            $pay_slip->monthly_attendance_id = $request->monthly_attendance_row_id;
            $pay_slip->pay_slip_bank_account_id = $request->pay_slip_bank_account_id;
            $pay_slip->pay_slip_com_id = $request->pay_slip_com_id;
            $pay_slip->pay_slip_employee_id = $request->pay_slip_employee_id;
            $pay_slip->pay_slip_department_id = $request->pay_slip_department_id;
            $pay_slip->pay_slip_payment_type = $request->pay_slip_payment_type;
            $pay_slip->pay_slip_payment_date = $request->pay_slip_payment_date;
            $pay_slip->pay_slip_month_year = $request->pay_slip_month_year;
            $pay_slip->pay_slip_gross_salary = $request->pay_slip_gross_salary;
            $pay_slip->pay_slip_basic_salary = $request->pay_slip_basic_salary;
            $pay_slip->pay_slip_house_rent = $request->pay_slip_house_rent;
            $pay_slip->pay_slip_medical_allowance = $request->pay_slip_medical_allowance;
            $pay_slip->pay_slip_conveyance_allowance = $request->pay_slip_conveyance_allowance;
            $pay_slip->pay_slip_festival_bonus = $request->pay_slip_festival_bonus;
            $pay_slip->pay_slip_commissions = $request->pay_slip_commissions;
            $pay_slip->pay_slip_other_payments = $request->pay_slip_other_payments;
            $pay_slip->pay_slip_overtimes = $request->pay_slip_overtimes;
            $pay_slip->pay_slip_provident_fund = $request->pay_slip_provident_fund;
            $pay_slip->pay_slip_tax_deduction = $request->pay_slip_tax_deduction;
            $pay_slip->pay_slip_loans = $request->pay_slip_loans;
            $pay_slip->pay_slip_total_working_hour = $request->pay_slip_total_working_hour;
            $pay_slip->pay_slip_per_hour_rate = $request->pay_slip_per_hour_rate;
            $pay_slip->pay_slip_statutory_deduction = $request->pay_slip_statutory_deduction;
            $pay_slip->pay_slip_transport_allowance = $request->pay_slip_transport_allowance;
            $pay_slip->pay_slip_mobile_bill = $request->pay_slip_mobile_bill;
            $pay_slip->pay_slip_lunch_allowance = $request->pay_slip_lunch_allowance;

            $pay_slip->pay_slip_net_salary = $net_pay;
            $pay_slip->pay_slip_key = $random_key;
            $pay_slip->pay_slip_number = $random_number;
            $pay_slip->pay_slip_working_days = $totalWorkDays;
            $pay_slip->pay_slip_status = 1;
            $pay_slip->pay_slip_late_days = $request->late_days;
            $pay_slip->pay_slip_late_day_salary_deduct = $request->pay_slip_late_day_salary_deduct;
            $pay_slip->save();

            $gross_earnings = $request->pay_slip_basic_salary + $request->pay_slip_house_rent + $request->pay_slip_medical_allowance + $request->pay_slip_conveyance_allowance + $request->pay_slip_festival_bonus + $request->pay_slip_commissions + $request->pay_slip_other_payments + $request->pay_slip_overtimes;
            $gross_deductions = $request->pay_slip_provident_fund + $request->pay_slip_tax_deduction + $request->pay_slip_loans + $request->pay_slip_statutory_deduction + $request->pay_slip_late_day_salary_deduct;

            $monthly_attendance = MonthlyAttendance::find($request->monthly_attendance_row_id);
            $monthly_attendance->monthly_payment_status = $request->monthly_attendanc_payment_status;
            $monthly_attendance->save();


            if (Loan::where('loans_employee_id', $request->pay_slip_employee_id)->where('loans_remaining_installments', '>', 0)->exists()) {
                $employee_loan = Loan::where('loans_employee_id', $request->pay_slip_employee_id)->where('loans_remaining_installments', '>', 0)->get(['id', 'loans_remaining_amount', 'loans_remaining_installments']);
                foreach ($employee_loan as $employee_loan_value) {

                    $loan = Loan::find($employee_loan_value->id);
                    $loan->loans_remaining_amount = $employee_loan_value->loans_remaining_amount - $request->pay_slip_loans;
                    $loan->loans_remaining_installments = $employee_loan_value->loans_remaining_installments - 1;
                    $loan->save();
                }
            }

            $employee_details = User::where('id', $request->pay_slip_employee_id)->first(['com_id', 'date_of_birth', 'department_id', 'designation_id', 'user_provident_fund_member']);
            if ($employee_details->user_provident_fund_member == "Yes") {

                $company_pf_configs = ProvidentfundConfig::where('providentfund_config_com_id', '=', $request->pay_slip_com_id)->get(['providentfund_config_amount_precentage']);
                foreach ($company_pf_configs as $company_pf_configs_value) {
                    $employee_pf_contribution = new ProvidentFund();
                    $employee_pf_contribution->provident_fund_com_id = $request->pay_slip_com_id;
                    $employee_pf_contribution->provident_fund_employee_id = $request->pay_slip_employee_id;
                    $employee_pf_contribution->provident_fund_payment_date = $request->pay_slip_payment_date;
                    $employee_pf_contribution->provident_fund_month_year = $request->pay_slip_month_year;
                    $employee_pf_contribution->provident_fund_employee_amount = $request->pay_slip_provident_fund;
                    $employee_pf_contribution->provident_fund_company_amount = ($totalSalary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                    $employee_pf_contribution->save();

                    if (ProvidentfundReport::where('providentfund_report_com_id', '=', $request->pay_slip_com_id)->where('providentfund_report_employee_id', '=', $request->pay_slip_employee_id)->exists()) {

                        $pf_report_details = ProvidentfundReport::where('providentfund_report_com_id', '=', $request->pay_slip_com_id)->where('providentfund_report_employee_id', '=', $request->pay_slip_employee_id)->get(['id', 'providentfund_report_total_amount']);

                        foreach ($pf_report_details as $pf_report_details_value) {

                            $pf_report = ProvidentfundReport::find($pf_report_details_value->id);
                            $pf_report->providentfund_report_total_amount = $pf_report_details_value->providentfund_report_total_amount + $request->pay_slip_provident_fund + ($totalSalary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                            $pf_report->save();
                        }
                    } else {

                        $pf_report = new ProvidentfundReport();
                        $pf_report->providentfund_report_com_id = $request->pay_slip_com_id;
                        $pf_report->providentfund_report_employee_id = $request->pay_slip_employee_id;
                        $pf_report->providentfund_report_total_amount = $request->pay_slip_provident_fund + ($totalSalary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                        $pf_report->save();
                    }
                }
            }


            $bank_null = "---";
            $company_details = Company::where('id', $employee_details->com_id)->first(['company_name']);
            $department_details = Department::where('id', $employee_details->department_id)->first(['department_name']);
            $designation_details = Designation::where('id', $employee_details->designation_id)->first(['designation_name']);

            if (BankAccount::where('bank_account_employee_id', $request->pay_slip_employee_id)->exists()) {

                $employee_bank_details = BankAccount::where('bank_account_employee_id', $request->pay_slip_employee_id)->get();
                //echo "ok"; exit;
                foreach ($employee_bank_details as $employee_bank_details_value) {
                    //pdf generating and sending sending via email code starts from here..


                    $data["email"] = $request->pay_slip_email;
                    $data["client_name"] = $request->pay_slip_employee_name;
                    $data["subject"] = "Purpose of Salary Payment";
                    $data["stuff_id"] = $employee_bank_details_value->stuff_id;
                    $data["bank_name"] = $employee_bank_details_value->bank_name;
                    $data["bank_account_number"] = $employee_bank_details_value->bank_account_number;
                    $data["bank_account_number"] = $request->pay_slip_payment_date;

                    $company_name = array(
                        'pay_slip_company_name' => $company_details->company_name,
                    );
                    $employee_name = array(
                        'pay_slip_employee_name' => $request->pay_slip_employee_name,
                    );

                    $stuff_id = array(
                        'pay_slip_stuff_id' => $employee_bank_details_value->stuff_id,
                    );
                    // $payslip_latedays = array(
                    //     'payslip_latedays' => $employee_bank_details_value->payslip_latedays,
                    // );
                    // $bank_name = array(
                    //     'pay_slip_bank_name' => $employee_bank_details_value->bank_name,
                    // );

                    // $bank_account_number = array(
                    //     'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                    // );

                    // $bank_branch = array(
                    //     'pay_slip_bank_branch' => $employee_bank_details_value->bank_branch,
                    // );

                    $bank_name = array(
                        'pay_slip_bank_name' => $employee_bank_details_value->employeeBank->company_bank_account_name,
                    );
                    $bank_account_number = array(
                        'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                    );
                    $bank_branch = array(
                        'pay_slip_bank_branch' => $employee_bank_details_value->employeeBank->company_bank_account_branch,
                    );

                    $probation_previous_working_days = array(
                        'pay_slip_probation_previous_working_days' => $probitionTotalWorkingDays,
                    );

                    $probation_after_working_days = array(
                        'pay_slip_probation_after_working_days' => $daysPreviousBetween,
                    );

                    $working_days = array(
                        'pay_slip_working_days' => $totalWorkingDay,
                    );

                    $date_of_birth = array(
                        'pay_slip_date_of_birth' => $employee_details->date_of_birth,
                    );
                    $department_name = array(
                        'pay_slip_department_name' => $department_details->department_name,
                    );
                    $designation_name = array(
                        'pay_slip_designation_name' => $designation_details->designation_name,
                    );

                    $salary_type = array(
                        'pay_slip_payment_type' => $request->pay_slip_payment_type,
                    );
                    $basic = array(
                        'pay_slip_basic_salary' => $request->pay_slip_basic_salary,
                    );
                    $total_working_hour = array(
                        'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                    );
                    $per_hour_rate = array(
                        'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                    );
                    $house_rent = array(
                        'pay_slip_house_rent' => $request->pay_slip_house_rent,
                    );
                    $medical_allowance = array(
                        'pay_slip_medical_allowance' => $request->pay_slip_medical_allowance,
                    );
                    $conveyance_allowance = array(
                        'pay_slip_conveyance_allowance' => $request->pay_slip_conveyance_allowance,
                    );
                    $festival_bonus = array(
                        'pay_slip_festival_bonus' => $request->pay_slip_festival_bonus,
                    );
                    $commissions = array(
                        'pay_slip_commissions' => $request->pay_slip_commissions,
                    );
                    $other_payments = array(
                        'pay_slip_other_payments' => $request->pay_slip_other_payments,
                    );
                    $overtimes = array(
                        'pay_slip_overtimes' => $request->pay_slip_overtimes,
                    );

                    $pf_contribution = array(
                        'pay_slip_pf_contribution' => $request->pay_slip_provident_fund,
                    );
                    $tax_deduction = array(
                        'pay_slip_tax_deduction' => $request->pay_slip_tax_deduction,
                    );
                    $loans = array(
                        'pay_slip_loans' => $request->pay_slip_loans,
                    );
                    $statutory_deduction = array(
                        'pay_slip_statutory_deduction' => $request->pay_slip_statutory_deduction,
                    );

                    $transport_allowance = array(
                        'pay_slip_transport_allowance' => $request->pay_slip_transport_allowance,
                    );
                    $pay_slip_lunch_allowance = array(
                        'pay_slip_lunch_allowance' => $request->pay_slip_lunch_allowance,
                    );
                    $mobile_bill = array(
                        'pay_slip_mobile_bill' => $request->pay_slip_mobile_bill,
                    );

                    $gross_earning = array(
                        'pay_slip_gross_earnings' => $totalSalary,
                    );
                    $gross_deduction = array(
                        'pay_slip_gross_deductions' => $gross_deductions,
                    );


                    $probition_previous_net_salary = array(
                        'pay_slip_probition_previous_net_salary' => $previousMonthSalary,
                    );
                    $probition_after_net_salary = array(
                        'pay_slip_probition_after_net_salary' => $currentMonthSalary,
                    );


                    $net_salary = array(
                        'pay_slip_net_salary' => $net_pay,
                    );

                    $pdf = PDF::loadView('back-end.premium.emails.probition_payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,

                        'probation_previous_working_days' => $probation_previous_working_days,
                        'probation_after_working_days' => $probation_after_working_days,

                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'probition_previous_net_salary' => $probition_previous_net_salary,
                        'probition_after_net_salary' => $probition_after_net_salary,
                        'net_salary' => $net_salary,
                    ]);

                    Mail::send('back-end.premium.emails.probition_payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,


                        'probation_previous_working_days' => $probation_previous_working_days,
                        'probation_after_working_days' => $probation_after_working_days,

                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'probition_previous_net_salary' => $probition_previous_net_salary,
                        'probition_after_net_salary' => $probition_after_net_salary,
                        'net_salary' => $net_salary,
                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["client_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "payslip.pdf");
                    });
                    //pdf generating and sending sending via email code ends here..
                }
            } else {


                //pdf generating and sending sending via email code starts from here..

                $data["email"] = $request->pay_slip_email;
                $data["client_name"] = $request->pay_slip_employee_name;
                $data["subject"] = "Purpose of Salary Payment";
                $data["stuff_id"] = "---";
                $data["bank_name"] = "---";
                $data["bank_account_number"] = "---";
                $data["bank_account_number"] = $request->pay_slip_payment_date;


                $company_name = array(
                    'pay_slip_company_name' => $company_details->company_name,
                );
                $employee_name = array(
                    'pay_slip_employee_name' => $request->pay_slip_employee_name,
                );


                $stuff_id = array(
                    'pay_slip_stuff_id' => "---",
                );



                $bank_name = array(
                    'pay_slip_bank_name' => "---",
                );


                $bank_account_number = array(
                    'pay_slip_bank_account_number' => "---",
                );


                $bank_branch = array(
                    'pay_slip_bank_branch' => "---",
                );



                $probation_previous_working_days = array(
                    'pay_slip_probation_previous_working_days' => $probitionTotalWorkingDays,
                );

                $probation_after_working_days = array(
                    'pay_slip_probation_after_working_days' => $daysPreviousBetween,
                );

                $working_days = array(
                    'pay_slip_working_days' => $totalWorkingDay,
                );


                $date_of_birth = array(
                    'pay_slip_date_of_birth' => $employee_details->date_of_birth,
                );
                $department_name = array(
                    'pay_slip_department_name' => $department_details->department_name,
                );
                $designation_name = array(
                    'pay_slip_designation_name' => $designation_details->designation_name,
                );
                $salary_type = array(
                    'pay_slip_payment_type' => $request->pay_slip_payment_type,
                );

                $basic = array(
                    'pay_slip_basic_salary' => $request->pay_slip_basic_salary,
                );
                $total_working_hour = array(
                    'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                );
                $per_hour_rate = array(
                    'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                );
                $house_rent = array(
                    'pay_slip_house_rent' => $request->pay_slip_house_rent,
                );
                $medical_allowance = array(
                    'pay_slip_medical_allowance' => $request->pay_slip_medical_allowance,
                );
                $conveyance_allowance = array(
                    'pay_slip_conveyance_allowance' => $request->pay_slip_conveyance_allowance,
                );
                $festival_bonus = array(
                    'pay_slip_festival_bonus' => $request->pay_slip_festival_bonus,
                );
                $commissions = array(
                    'pay_slip_commissions' => $request->pay_slip_commissions,
                );
                $other_payments = array(
                    'pay_slip_other_payments' => $request->pay_slip_other_payments,
                );
                $overtimes = array(
                    'pay_slip_overtimes' => $request->pay_slip_overtimes,
                );


                $pf_contribution = array(
                    'pay_slip_pf_contribution' => $request->pay_slip_provident_fund,
                );
                $tax_deduction = array(
                    'pay_slip_tax_deduction' => $request->pay_slip_tax_deduction,
                );
                $loans = array(
                    'pay_slip_loans' => $request->pay_slip_loans,
                );
                $statutory_deduction = array(
                    'pay_slip_statutory_deduction' => $request->pay_slip_statutory_deduction,
                );

                $transport_allowance = array(
                    'pay_slip_transport_allowance' => $request->pay_slip_transport_allowance,
                );
                $pay_slip_lunch_allowance = array(
                    'pay_slip_lunch_allowance' => $request->pay_slip_lunch_allowance,
                );
                $mobile_bill = array(
                    'pay_slip_mobile_bill' => $request->pay_slip_mobile_bill,
                );


                $gross_earning = array(
                    'pay_slip_gross_earnings' => $totalSalary,
                );
                $gross_deduction = array(
                    'pay_slip_gross_deductions' => $gross_deductions,
                );

                $probition_previous_net_salary = array(
                    'pay_slip_probition_previous_net_salary' => $previousMonthSalary,
                );
                $probition_after_net_salary = array(
                    'pay_slip_probition_after_net_salary' => $currentMonthSalary,
                );


                $net_salary = array(
                    'pay_slip_net_salary' => $net_pay,
                );

                $pdf = PDF::loadView('back-end.premium.emails.probition_payslip', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'stuff_id' => $stuff_id,
                    'bank_name' => $bank_name,
                    'bank_account_number' => $bank_account_number,
                    'bank_branch' => $bank_branch,
                    'working_days' => $working_days,

                    'probation_previous_working_days' => $probation_previous_working_days,
                    'probation_after_working_days' => $probation_after_working_days,


                    'date_of_birth' => $date_of_birth,
                    'department_name' => $department_name,
                    'designation_name' => $designation_name,
                    'salary_type' => $salary_type,
                    'basic' => $basic,
                    'total_working_hour' => $total_working_hour,
                    'per_hour_rate' => $per_hour_rate,
                    'house_rent' => $house_rent,
                    'medical_allowance' => $medical_allowance,
                    'conveyance_allowance' => $conveyance_allowance,
                    'festival_bonus' => $festival_bonus,
                    'commissions' => $commissions,
                    'other_payments' => $other_payments,
                    'overtimes' => $overtimes,
                    'pf_contribution' => $pf_contribution,
                    'tax_deduction' => $tax_deduction,
                    'loans' => $loans,
                    'statutory_deduction' => $statutory_deduction,
                    'transport_allowance' => $transport_allowance,
                    'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                    'mobile_bill' => $mobile_bill,
                    'gross_earning' => $gross_earning,
                    'gross_deduction' => $gross_deduction,
                    'probition_previous_net_salary' => $probition_previous_net_salary,
                    'probition_after_net_salary' => $probition_after_net_salary,
                    'net_salary' => $net_salary,
                ]);

                Mail::send('back-end.premium.emails.probition_payslip', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'stuff_id' => $stuff_id,
                    'bank_name' => $bank_name,
                    'bank_account_number' => $bank_account_number,
                    'bank_branch' => $bank_branch,
                    'working_days' => $working_days,

                    'probation_previous_working_days' => $probation_previous_working_days,
                    'probation_after_working_days' => $probation_after_working_days,


                    'date_of_birth' => $date_of_birth,
                    'department_name' => $department_name,
                    'designation_name' => $designation_name,
                    'salary_type' => $salary_type,
                    'basic' => $basic,
                    'total_working_hour' => $total_working_hour,
                    'per_hour_rate' => $per_hour_rate,
                    'house_rent' => $house_rent,
                    'medical_allowance' => $medical_allowance,
                    'conveyance_allowance' => $conveyance_allowance,
                    'festival_bonus' => $festival_bonus,
                    'commissions' => $commissions,
                    'other_payments' => $other_payments,
                    'overtimes' => $overtimes,
                    'pf_contribution' => $pf_contribution,
                    'tax_deduction' => $tax_deduction,
                    'loans' => $loans,
                    'statutory_deduction' => $statutory_deduction,
                    'transport_allowance' => $transport_allowance,
                    'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                    'mobile_bill' => $mobile_bill,
                    'gross_earning' => $gross_earning,
                    'gross_deduction' => $gross_deduction,
                    'probition_previous_net_salary' => $probition_previous_net_salary,
                    'probition_after_net_salary' => $probition_after_net_salary,
                    'net_salary' => $net_salary,
                ], function ($message) use ($data, $pdf) {
                    $message->to($data["email"], $data["client_name"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), "payslip.pdf");
                });
                //pdf generating and sending sending via email code ends here.}

            }
        } elseif (User::where('id', $request->pay_slip_employee_id)->where('is_active', 1)->whereNotNull('active_date')->first()) {

            $totalWorkingDay = $request->pay_slip_working_days;
            $userActiveDate = User::where('com_id', Auth::user()->com_id)
                ->where('id', $request->pay_slip_employee_id)
                ->first();

            // active month date history
            $activeDate = Carbon::parse($userActiveDate->active_date);
            $activeEndMonthLastDate = now()->subMonth()->endOfMonth()->format('Y-m-d');
            $previousDayOfMonth = now()->subMonth()->daysInMonth;

            // specify the start and end dates
            $startDate = Carbon::parse($activeDate);
            $endDate = Carbon::parse($activeEndMonthLastDate);

            //attandance weekend holiday  count start
            $holidaysDays = [];
            for ($holidayDate = $startDate->copy(); $holidayDate->lte($endDate); $holidayDate->addDay()) {
                $holidaysDays[] = $holidayDate->format('D');
            }

            $holidayData = [];

            foreach ($holidaysDays as $holiday) {
                $data = Holiday::where('holiday_com_id', Auth::user()->com_id)
                    ->where('holiday_type', 'Weekly-Holiday')
                    ->where('holiday_name', [$holiday])
                    ->get();
                if (!$data->isEmpty()) {
                    $holidayData = array_merge($holidayData, $data->toArray());
                }
            }

            $holidayDataCount = count($holidayData);

            //attandance weekend holiday count end

            //attandance other-holiday  count start

            $otherHolidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                ->where('holiday_type', 'Other-Holiday')
                ->get();

            $activeMonthstartDate = Carbon::parse($userActiveDate->active_date);
            $activMonthLastDate = Carbon::parse($endDate);


            $overlappingDays = 0;

            foreach ($otherHolidays as $holiday) {
                $holidaysStartDate = Carbon::parse($holiday->start_date);
                $holidaysEndDate = Carbon::parse($holiday->end_date);


                // Check if the probation period overlaps with the holiday period
                if ($activeMonthstartDate <= $holidaysEndDate && $activMonthLastDate >= $holidaysEndDate) {
                    // Find the start and end dates of the overlapping period
                    $overlapStartDate = max($activeMonthstartDate, $holidaysStartDate);
                    $overlapEndDate = min($activMonthLastDate, $holidaysEndDate);

                    // Calculate the number of overlapping days
                    $duration = $overlapStartDate->diff($overlapEndDate);
                    $overlappingDays += $duration->days + 1;
                }
            }

            //attandance other-holiday  count end

            // Leave Attendence Count Start

            $leaves = Leave::where('leaves_employee_id', $request->pay_slip_employee_id)->where('leaves_status', 'Approved')->get();
            $overlappingLeaveDays = 0;
            foreach ($leaves as $leave) {
                $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                // Check if the probation period overlaps with the holiday period
                if ($activeMonthstartDate <= $leaveEndDate && $activMonthLastDate >= $leaveStartDate) {
                    // Find the start and end dates of the overlapping period
                    $overlapLeaveStartDate = max($activeMonthstartDate, $leaveStartDate);
                    $overlapLeaveEndDate = min($activMonthLastDate, $leaveEndDate);

                    // Calculate the number of overlapping days
                    $durationLeave = $overlapLeaveStartDate->diff($overlapLeaveEndDate);
                    $overlappingLeaveDays += $durationLeave->days + 1;
                }
            }

            // Leave Attendence Count End

            //attandance day count start start Date
            $days = [];
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $days[] = $date->format('Y-m-d');
            }
            $days;
            $attendanceData = [];
            foreach ($days as $day) {
                $data = Attendance::where('employee_id', $request->pay_slip_employee_id)
                    ->whereIn('attendance_date', [$day])
                    ->get();
                if (!$data->isEmpty()) {
                    $attendanceData[$day] = $data;
                }
            }

            //attandance day count start end

            //total  working day start
            $totalAttendanceCount = 0;
            foreach ($attendanceData as $data) {
                $totalAttendanceCount += $data->count();
            }

            //total  working day end

            // working days count start
            $totalWorkingDays = $totalAttendanceCount + $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
            //  working days count end

            //  salary  count start
            $totalSalary = ($userActiveDate->gross_salary / $previousDayOfMonth) * $totalWorkingDays;
            //  salary  count end

            $gross_deductions = $request->pay_slip_provident_fund + $request->pay_slip_tax_deduction + $request->pay_slip_loans + $request->pay_slip_statutory_deduction + $request->pay_slip_late_day_salary_deduct;
            $net_pay = ($totalSalary + $request->pay_slip_mobile_bill + $request->pay_slip_overtimes + $request->pay_slip_transport_allowance) - $gross_deductions;

            $pay_slip = new PaySlip();
            $pay_slip->monthly_attendance_id = $request->monthly_attendance_row_id;
            $pay_slip->pay_slip_bank_account_id = $request->pay_slip_bank_account_id;
            $pay_slip->pay_slip_com_id = $request->pay_slip_com_id;
            $pay_slip->pay_slip_employee_id = $request->pay_slip_employee_id;
            $pay_slip->pay_slip_department_id = $request->pay_slip_department_id;
            $pay_slip->pay_slip_payment_type = $request->pay_slip_payment_type;
            $pay_slip->pay_slip_payment_date = $request->pay_slip_payment_date;
            $pay_slip->pay_slip_month_year = $request->pay_slip_month_year;
            $pay_slip->pay_slip_gross_salary = $request->pay_slip_gross_salary;
            $pay_slip->pay_slip_basic_salary = $request->pay_slip_basic_salary;
            $pay_slip->pay_slip_house_rent = $request->pay_slip_house_rent;
            $pay_slip->pay_slip_medical_allowance = $request->pay_slip_medical_allowance;
            $pay_slip->pay_slip_conveyance_allowance = $request->pay_slip_conveyance_allowance;
            $pay_slip->pay_slip_festival_bonus = $request->pay_slip_festival_bonus;
            $pay_slip->pay_slip_commissions = $request->pay_slip_commissions;
            $pay_slip->pay_slip_other_payments = $request->pay_slip_other_payments;
            $pay_slip->pay_slip_overtimes = $request->pay_slip_overtimes;
            $pay_slip->pay_slip_provident_fund = $request->pay_slip_provident_fund;
            $pay_slip->pay_slip_tax_deduction = $request->pay_slip_tax_deduction;
            $pay_slip->pay_slip_loans = $request->pay_slip_loans;
            $pay_slip->pay_slip_total_working_hour = $request->pay_slip_total_working_hour;
            $pay_slip->pay_slip_per_hour_rate = $request->pay_slip_per_hour_rate;
            $pay_slip->pay_slip_statutory_deduction = $request->pay_slip_statutory_deduction;
            $pay_slip->pay_slip_transport_allowance = $request->pay_slip_transport_allowance;
            $pay_slip->pay_slip_mobile_bill = $request->pay_slip_mobile_bill;
            $pay_slip->pay_slip_lunch_allowance = $request->pay_slip_lunch_allowance;
            $pay_slip->pay_slip_net_salary = $net_pay;
            $pay_slip->pay_slip_key = $random_key;
            $pay_slip->pay_slip_number = $random_number;
            $pay_slip->pay_slip_working_days = $totalWorkingDays;
            $pay_slip->pay_slip_status = 1;
            $pay_slip->pay_slip_late_days = $request->late_days;
            $pay_slip->pay_slip_late_day_salary_deduct = $request->pay_slip_late_day_salary_deduct;
            $pay_slip->save();

            $gross_earnings = $request->pay_slip_basic_salary + $request->pay_slip_house_rent + $request->pay_slip_medical_allowance + $request->pay_slip_conveyance_allowance + $request->pay_slip_festival_bonus + $request->pay_slip_commissions + $request->pay_slip_other_payments + $request->pay_slip_overtimes;
            $gross_deductions = $request->pay_slip_provident_fund + $request->pay_slip_tax_deduction + $request->pay_slip_loans + $request->pay_slip_statutory_deduction + $request->pay_slip_late_day_salary_deduct;

            $monthly_attendance = MonthlyAttendance::find($request->monthly_attendance_row_id);
            $monthly_attendance->monthly_payment_status = $request->monthly_attendanc_payment_status;
            $monthly_attendance->save();


            if (Loan::where('loans_employee_id', $request->pay_slip_employee_id)->where('loans_remaining_installments', '>', 0)->exists()) {
                $employee_loan = Loan::where('loans_employee_id', $request->pay_slip_employee_id)->where('loans_remaining_installments', '>', 0)->get(['id', 'loans_remaining_amount', 'loans_remaining_installments']);
                foreach ($employee_loan as $employee_loan_value) {

                    $loan = Loan::find($employee_loan_value->id);
                    $loan->loans_remaining_amount = $employee_loan_value->loans_remaining_amount - $request->pay_slip_loans;
                    $loan->loans_remaining_installments = $employee_loan_value->loans_remaining_installments - 1;
                    $loan->save();
                }
            }

            $employee_details = User::where('id', $request->pay_slip_employee_id)->first(['com_id', 'date_of_birth', 'department_id', 'designation_id', 'user_provident_fund_member']);
            if ($employee_details->user_provident_fund_member == "Yes") {

                $company_pf_configs = ProvidentfundConfig::where('providentfund_config_com_id', '=', $request->pay_slip_com_id)->get(['providentfund_config_amount_precentage']);
                foreach ($company_pf_configs as $company_pf_configs_value) {
                    $employee_pf_contribution = new ProvidentFund();
                    $employee_pf_contribution->provident_fund_com_id = $request->pay_slip_com_id;
                    $employee_pf_contribution->provident_fund_employee_id = $request->pay_slip_employee_id;
                    $employee_pf_contribution->provident_fund_payment_date = $request->pay_slip_payment_date;
                    $employee_pf_contribution->provident_fund_month_year = $request->pay_slip_month_year;
                    $employee_pf_contribution->provident_fund_employee_amount = $request->pay_slip_provident_fund;
                    $employee_pf_contribution->provident_fund_company_amount = ($request->pay_slip_gross_salary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                    $employee_pf_contribution->save();

                    if (ProvidentfundReport::where('providentfund_report_com_id', '=', $request->pay_slip_com_id)->where('providentfund_report_employee_id', '=', $request->pay_slip_employee_id)->exists()) {

                        $pf_report_details = ProvidentfundReport::where('providentfund_report_com_id', '=', $request->pay_slip_com_id)->where('providentfund_report_employee_id', '=', $request->pay_slip_employee_id)->get(['id', 'providentfund_report_total_amount']);

                        foreach ($pf_report_details as $pf_report_details_value) {

                            $pf_report = ProvidentfundReport::find($pf_report_details_value->id);
                            $pf_report->providentfund_report_total_amount = $pf_report_details_value->providentfund_report_total_amount + $request->pay_slip_provident_fund + ($request->pay_slip_gross_salary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                            $pf_report->save();
                        }
                    } else {

                        $pf_report = new ProvidentfundReport();
                        $pf_report->providentfund_report_com_id = $request->pay_slip_com_id;
                        $pf_report->providentfund_report_employee_id = $request->pay_slip_employee_id;
                        $pf_report->providentfund_report_total_amount = $request->pay_slip_provident_fund + ($request->pay_slip_gross_salary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                        $pf_report->save();
                    }
                }
            }


            $bank_null = "---";
            $company_details = Company::where('id', $employee_details->com_id)->first(['company_name']);
            $department_details = Department::where('id', $employee_details->department_id)->first(['department_name']);
            $designation_details = Designation::where('id', $employee_details->designation_id)->first(['designation_name']);

            if (BankAccount::where('bank_account_employee_id', $request->pay_slip_employee_id)->exists()) {

                $employee_bank_details = BankAccount::where('bank_account_employee_id', $request->pay_slip_employee_id)->get();
                //echo "ok"; exit;
                foreach ($employee_bank_details as $employee_bank_details_value) {
                    //pdf generating and sending sending via email code starts from here..

                    //$data["email"] = "mahbubwebsoft@gmail.com";
                    $data["email"] = $request->pay_slip_email;
                    $data["client_name"] = $request->pay_slip_employee_name;
                    $data["subject"] = "Purpose of Salary Payment";
                    $data["stuff_id"] = $employee_bank_details_value->stuff_id;
                    $data["bank_name"] = $employee_bank_details_value->bank_name;
                    $data["bank_account_number"] = $employee_bank_details_value->bank_account_number;
                    $data["bank_account_number"] = $request->pay_slip_payment_date;

                    $salary_month = date('M', strtotime($request->pay_slip_month_year));

                    $salary_month = array(
                        'salary_month' => $salary_month,
                    );
                    $company_name = array(
                        'pay_slip_company_name' => $company_details->company_name,
                    );
                    $employee_name = array(
                        'pay_slip_employee_name' => $request->pay_slip_employee_name,
                    );

                    $stuff_id = array(
                        'pay_slip_stuff_id' => $employee_bank_details_value->stuff_id,
                    );

                    // $bank_name = array(
                    //     'pay_slip_bank_name' => $employee_bank_details_value->bank_name,
                    // );

                    // $bank_account_number = array(
                    //     'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                    // );

                    // $bank_branch = array(
                    //     'pay_slip_bank_branch' => $employee_bank_details_value->bank_branch,
                    // );

                    $bank_name = array(
                        'pay_slip_bank_name' => $employee_bank_details_value->employeeBank->company_bank_account_name,
                    );
                    $bank_account_number = array(
                        'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                    );
                    $bank_branch = array(
                        'pay_slip_bank_branch' => $employee_bank_details_value->employeeBank->company_bank_account_branch,
                    );

                    $working_days = array(
                        'pay_slip_working_days' => $request->pay_slip_working_days,
                    );
                    $date_of_birth = array(
                        'pay_slip_date_of_birth' => $employee_details->date_of_birth,
                    );
                    $department_name = array(
                        'pay_slip_department_name' => $department_details->department_name,
                    );
                    $designation_name = array(
                        'pay_slip_designation_name' => $designation_details->designation_name,
                    );

                    $salary_type = array(
                        'pay_slip_payment_type' => $request->pay_slip_payment_type,
                    );
                    $basic = array(
                        'pay_slip_basic_salary' => $request->pay_slip_basic_salary,
                    );
                    $total_working_hour = array(
                        'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                    );
                    $per_hour_rate = array(
                        'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                    );
                    $house_rent = array(
                        'pay_slip_house_rent' => $request->pay_slip_house_rent,
                    );
                    $medical_allowance = array(
                        'pay_slip_medical_allowance' => $request->pay_slip_medical_allowance,
                    );
                    $conveyance_allowance = array(
                        'pay_slip_conveyance_allowance' => $request->pay_slip_conveyance_allowance,
                    );
                    $festival_bonus = array(
                        'pay_slip_festival_bonus' => $request->pay_slip_festival_bonus,
                    );
                    $commissions = array(
                        'pay_slip_commissions' => $request->pay_slip_commissions,
                    );
                    $other_payments = array(
                        'pay_slip_other_payments' => $request->pay_slip_other_payments,
                    );
                    $overtimes = array(
                        'pay_slip_overtimes' => $request->pay_slip_overtimes,
                    );

                    $pf_contribution = array(
                        'pay_slip_pf_contribution' => $request->pay_slip_provident_fund,
                    );
                    $tax_deduction = array(
                        'pay_slip_tax_deduction' => $request->pay_slip_tax_deduction,
                    );
                    $loans = array(
                        'pay_slip_loans' => $request->pay_slip_loans,
                    );
                    $statutory_deduction = array(
                        'pay_slip_statutory_deduction' => $request->pay_slip_statutory_deduction,
                    );

                    $transport_allowance = array(
                        'pay_slip_transport_allowance' => $request->pay_slip_transport_allowance,
                    );
                    $pay_slip_lunch_allowance = array(
                        'pay_slip_lunch_allowance' => $request->pay_slip_lunch_allowance,
                    );
                    $mobile_bill = array(
                        'pay_slip_mobile_bill' => $request->pay_slip_mobile_bill,
                    );

                    $gross_earning = array(
                        'pay_slip_gross_earnings' => $gross_earnings,
                    );
                    $gross_deduction = array(
                        'pay_slip_gross_deductions' => $gross_deductions,
                    );

                    $net_salary = array(
                        'pay_slip_net_salary' => $request->pay_slip_net_salary,
                    );
                    $payment_date = array(
                        'payment_date' => $request->pay_slip_payment_date,
                    );

                    $pay_slip_late_day_salary_deduct = array(
                        'pay_slip_late_day_salary_deduct' => $request->pay_slip_late_day_salary_deduct,
                    );

                    $pdf = PDF::loadView('back-end.premium.emails.payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,
                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'net_salary' => $net_salary,
                        'payment_date' => $payment_date,
                        'salary_month' => $salary_month,
                        'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                    ]);

                    Mail::send('back-end.premium.emails.payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,
                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'payment_date' => $payment_date,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'net_salary' => $net_salary,
                        'salary_month' => $salary_month,
                        'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["client_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "payslip.pdf");
                    });
                    //pdf generating and sending sending via email code ends here..
                }
            } else {


                //pdf generating and sending sending via email code starts from here..

                $data["email"] = $request->pay_slip_email;
                $data["client_name"] = $request->pay_slip_employee_name;
                $data["subject"] = "Purpose of Salary Payment";
                $data["stuff_id"] = "---";
                $data["bank_name"] = "---";
                $data["bank_account_number"] = "---";
                $data["bank_account_number"] = $request->pay_slip_payment_date;

                $salary_month = date('M', strtotime($request->pay_slip_month_year));

                $salary_month = array(
                    'salary_month' => $salary_month,
                );
                $company_name = array(
                    'pay_slip_company_name' => $company_details->company_name,
                );
                $employee_name = array(
                    'pay_slip_employee_name' => $request->pay_slip_employee_name,
                );


                $stuff_id = array(
                    'pay_slip_stuff_id' => "---",
                );



                $bank_name = array(
                    'pay_slip_bank_name' => "---",
                );


                $bank_account_number = array(
                    'pay_slip_bank_account_number' => "---",
                );


                $bank_branch = array(
                    'pay_slip_bank_branch' => "---",
                );


                $working_days = array(
                    'pay_slip_working_days' => $request->pay_slip_working_days,
                );
                $date_of_birth = array(
                    'pay_slip_date_of_birth' => $employee_details->date_of_birth,
                );
                $department_name = array(
                    'pay_slip_department_name' => $department_details->department_name,
                );
                $designation_name = array(
                    'pay_slip_designation_name' => $designation_details->designation_name,
                );
                $salary_type = array(
                    'pay_slip_payment_type' => $request->pay_slip_payment_type,
                );

                $basic = array(
                    'pay_slip_basic_salary' => $request->pay_slip_basic_salary,
                );
                $total_working_hour = array(
                    'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                );
                $per_hour_rate = array(
                    'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                );
                $house_rent = array(
                    'pay_slip_house_rent' => $request->pay_slip_house_rent,
                );
                $medical_allowance = array(
                    'pay_slip_medical_allowance' => $request->pay_slip_medical_allowance,
                );
                $conveyance_allowance = array(
                    'pay_slip_conveyance_allowance' => $request->pay_slip_conveyance_allowance,
                );
                $festival_bonus = array(
                    'pay_slip_festival_bonus' => $request->pay_slip_festival_bonus,
                );
                $commissions = array(
                    'pay_slip_commissions' => $request->pay_slip_commissions,
                );
                $other_payments = array(
                    'pay_slip_other_payments' => $request->pay_slip_other_payments,
                );
                $overtimes = array(
                    'pay_slip_overtimes' => $request->pay_slip_overtimes,
                );


                $pf_contribution = array(
                    'pay_slip_pf_contribution' => $request->pay_slip_provident_fund,
                );
                $tax_deduction = array(
                    'pay_slip_tax_deduction' => $request->pay_slip_tax_deduction,
                );
                $loans = array(
                    'pay_slip_loans' => $request->pay_slip_loans,
                );
                $statutory_deduction = array(
                    'pay_slip_statutory_deduction' => $request->pay_slip_statutory_deduction,
                );

                $transport_allowance = array(
                    'pay_slip_transport_allowance' => $request->pay_slip_transport_allowance,
                );
                $pay_slip_lunch_allowance = array(
                    'pay_slip_lunch_allowance' => $request->pay_slip_lunch_allowance,
                );
                $mobile_bill = array(
                    'pay_slip_mobile_bill' => $request->pay_slip_mobile_bill,
                );

                $payment_date = array(
                    'payment_date' => $request->pay_slip_payment_date,
                );
                $gross_earning = array(
                    'pay_slip_gross_earnings' => $gross_earnings,
                );
                $gross_deduction = array(
                    'pay_slip_gross_deductions' => $gross_deductions,
                );

                $net_salary = array(
                    'pay_slip_net_salary' => $request->pay_slip_net_salary,
                );
                $pay_slip_late_day_salary_deduct = array(
                        'pay_slip_late_day_salary_deduct' => $request->pay_slip_late_day_salary_deduct,
                    );
                $pdf = PDF::loadView('back-end.premium.emails.payslip', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'stuff_id' => $stuff_id,
                    'bank_name' => $bank_name,
                    'bank_account_number' => $bank_account_number,
                    'bank_branch' => $bank_branch,
                    'working_days' => $working_days,
                    'date_of_birth' => $date_of_birth,
                    'department_name' => $department_name,
                    'designation_name' => $designation_name,
                    'salary_type' => $salary_type,
                    'basic' => $basic,
                    'total_working_hour' => $total_working_hour,
                    'per_hour_rate' => $per_hour_rate,
                    'house_rent' => $house_rent,
                    'medical_allowance' => $medical_allowance,
                    'conveyance_allowance' => $conveyance_allowance,
                    'festival_bonus' => $festival_bonus,
                    'commissions' => $commissions,
                    'other_payments' => $other_payments,
                    'overtimes' => $overtimes,
                    'pf_contribution' => $pf_contribution,
                    'tax_deduction' => $tax_deduction,
                    'loans' => $loans,
                    'statutory_deduction' => $statutory_deduction,
                    'transport_allowance' => $transport_allowance,
                    'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                    'mobile_bill' => $mobile_bill,
                    'gross_earning' => $gross_earning,
                    'gross_deduction' => $gross_deduction,
                    'net_salary' => $net_salary,
                    'payment_date' => $payment_date,
                    'salary_month' => $salary_month,
                    'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                ]);

                Mail::send('back-end.premium.emails.payslip', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'stuff_id' => $stuff_id,
                    'bank_name' => $bank_name,
                    'bank_account_number' => $bank_account_number,
                    'bank_branch' => $bank_branch,
                    'working_days' => $working_days,
                    'date_of_birth' => $date_of_birth,
                    'department_name' => $department_name,
                    'designation_name' => $designation_name,
                    'salary_type' => $salary_type,
                    'basic' => $basic,
                    'total_working_hour' => $total_working_hour,
                    'per_hour_rate' => $per_hour_rate,
                    'house_rent' => $house_rent,
                    'medical_allowance' => $medical_allowance,
                    'conveyance_allowance' => $conveyance_allowance,
                    'festival_bonus' => $festival_bonus,
                    'commissions' => $commissions,
                    'other_payments' => $other_payments,
                    'overtimes' => $overtimes,
                    'pf_contribution' => $pf_contribution,
                    'tax_deduction' => $tax_deduction,
                    'loans' => $loans,
                    'statutory_deduction' => $statutory_deduction,
                    'transport_allowance' => $transport_allowance,
                    'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                    'mobile_bill' => $mobile_bill,
                    'gross_earning' => $gross_earning,
                    'gross_deduction' => $gross_deduction,
                    'net_salary' => $net_salary,
                    'payment_date' => $payment_date,
                    'salary_month' => $salary_month,
                    'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                ], function ($message) use ($data, $pdf) {
                    $message->to($data["email"], $data["client_name"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), "payslip.pdf");
                });
                //pdf generating and sending sending via email code ends here..
            }

        } else {
            $pay_slip = new PaySlip();
            $pay_slip->monthly_attendance_id = $request->monthly_attendance_row_id;
            $pay_slip->pay_slip_bank_account_id = $request->pay_slip_bank_account_id;
            $pay_slip->pay_slip_com_id = $request->pay_slip_com_id;
            $pay_slip->pay_slip_employee_id = $request->pay_slip_employee_id;
            $pay_slip->pay_slip_department_id = $request->pay_slip_department_id;
            $pay_slip->pay_slip_payment_type = $request->pay_slip_payment_type;
            $pay_slip->pay_slip_payment_date = $request->pay_slip_payment_date;
            $pay_slip->pay_slip_month_year = $request->pay_slip_month_year;
            $pay_slip->pay_slip_gross_salary = $request->pay_slip_gross_salary;
            $pay_slip->pay_slip_basic_salary = $request->pay_slip_basic_salary;
            $pay_slip->pay_slip_house_rent = $request->pay_slip_house_rent;
            $pay_slip->pay_slip_medical_allowance = $request->pay_slip_medical_allowance;
            $pay_slip->pay_slip_conveyance_allowance = $request->pay_slip_conveyance_allowance;
            $pay_slip->pay_slip_festival_bonus = $request->pay_slip_festival_bonus;
            $pay_slip->pay_slip_commissions = $request->pay_slip_commissions;
            $pay_slip->pay_slip_other_payments = $request->pay_slip_other_payments;
            $pay_slip->pay_slip_overtimes = $request->pay_slip_overtimes;
            $pay_slip->pay_slip_provident_fund = $request->pay_slip_provident_fund;
            $pay_slip->pay_slip_tax_deduction = $request->pay_slip_tax_deduction;
            $pay_slip->pay_slip_loans = $request->pay_slip_loans;
            $pay_slip->pay_slip_total_working_hour = $request->pay_slip_total_working_hour;
            $pay_slip->pay_slip_per_hour_rate = $request->pay_slip_per_hour_rate;
            $pay_slip->pay_slip_statutory_deduction = $request->pay_slip_statutory_deduction;
            $pay_slip->pay_slip_transport_allowance = $request->pay_slip_transport_allowance;
            $pay_slip->pay_slip_mobile_bill = $request->pay_slip_mobile_bill;
            $pay_slip->pay_slip_lunch_allowance = $request->pay_slip_lunch_allowance;
            $pay_slip->pay_slip_net_salary = $request->pay_slip_net_salary;
            $pay_slip->pay_slip_key = $random_key;
            $pay_slip->pay_slip_number = $random_number;
            $pay_slip->pay_slip_working_days = $request->pay_slip_working_days;
            $pay_slip->pay_slip_status = 1;
            $pay_slip->pay_slip_late_days = $request->late_days;
            $pay_slip->pay_slip_late_day_salary_deduct = $request->pay_slip_late_day_salary_deduct;

            $pay_slip->save();

            $gross_earnings = $request->pay_slip_basic_salary + $request->pay_slip_house_rent + $request->pay_slip_medical_allowance + $request->pay_slip_conveyance_allowance + $request->pay_slip_festival_bonus + $request->pay_slip_commissions + $request->pay_slip_other_payments + $request->pay_slip_overtimes;
            $gross_deductions = $request->pay_slip_provident_fund + $request->pay_slip_tax_deduction + $request->pay_slip_loans + $request->pay_slip_statutory_deduction + $request->pay_slip_late_day_salary_deduct;

            $monthly_attendance = MonthlyAttendance::find($request->monthly_attendance_row_id);
            $monthly_attendance->monthly_payment_status = $request->monthly_attendanc_payment_status;
            $monthly_attendance->save();


            if (Loan::where('loans_employee_id', $request->pay_slip_employee_id)->where('loans_remaining_installments', '>', 0)->exists()) {
                $employee_loan = Loan::where('loans_employee_id', $request->pay_slip_employee_id)->where('loans_remaining_installments', '>', 0)->get(['id', 'loans_remaining_amount', 'loans_remaining_installments']);
                foreach ($employee_loan as $employee_loan_value) {

                    $loan = Loan::find($employee_loan_value->id);
                    $loan->loans_remaining_amount = $employee_loan_value->loans_remaining_amount - $request->pay_slip_loans;
                    $loan->loans_remaining_installments = $employee_loan_value->loans_remaining_installments - 1;
                    $loan->save();
                }
            }

            $employee_details = User::where('id', $request->pay_slip_employee_id)->first(['com_id', 'date_of_birth', 'department_id', 'designation_id', 'user_provident_fund_member']);
            if ($employee_details->user_provident_fund_member == "Yes") {

                $company_pf_configs = ProvidentfundConfig::where('providentfund_config_com_id', '=', $request->pay_slip_com_id)->get(['providentfund_config_amount_precentage']);
                foreach ($company_pf_configs as $company_pf_configs_value) {
                    $employee_pf_contribution = new ProvidentFund();
                    $employee_pf_contribution->provident_fund_com_id = $request->pay_slip_com_id;
                    $employee_pf_contribution->provident_fund_employee_id = $request->pay_slip_employee_id;
                    $employee_pf_contribution->provident_fund_payment_date = $request->pay_slip_payment_date;
                    $employee_pf_contribution->provident_fund_month_year = $request->pay_slip_month_year;
                    $employee_pf_contribution->provident_fund_employee_amount = $request->pay_slip_provident_fund;
                    $employee_pf_contribution->provident_fund_company_amount = ($request->pay_slip_gross_salary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                    $employee_pf_contribution->save();

                    if (ProvidentfundReport::where('providentfund_report_com_id', '=', $request->pay_slip_com_id)->where('providentfund_report_employee_id', '=', $request->pay_slip_employee_id)->exists()) {

                        $pf_report_details = ProvidentfundReport::where('providentfund_report_com_id', '=', $request->pay_slip_com_id)->where('providentfund_report_employee_id', '=', $request->pay_slip_employee_id)->get(['id', 'providentfund_report_total_amount']);

                        foreach ($pf_report_details as $pf_report_details_value) {

                            $pf_report = ProvidentfundReport::find($pf_report_details_value->id);
                            $pf_report->providentfund_report_total_amount = $pf_report_details_value->providentfund_report_total_amount + $request->pay_slip_provident_fund + ($request->pay_slip_gross_salary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                            $pf_report->save();
                        }
                    } else {

                        $pf_report = new ProvidentfundReport();
                        $pf_report->providentfund_report_com_id = $request->pay_slip_com_id;
                        $pf_report->providentfund_report_employee_id = $request->pay_slip_employee_id;
                        $pf_report->providentfund_report_total_amount = $request->pay_slip_provident_fund + ($request->pay_slip_gross_salary * $company_pf_configs_value->providentfund_config_amount_precentage) / 100;
                        $pf_report->save();
                    }
                }
            }


            $bank_null = "---";
            $company_details = Company::where('id', $employee_details->com_id)->first(['company_name']);
            $department_details = Department::where('id', $employee_details->department_id)->first(['department_name']);
            $designation_details = Designation::where('id', $employee_details->designation_id)->first(['designation_name']);

            if (BankAccount::where('bank_account_employee_id', $request->pay_slip_employee_id)->exists()) {

                $employee_bank_details = BankAccount::where('bank_account_employee_id', $request->pay_slip_employee_id)->get();
                //echo "ok"; exit;
                foreach ($employee_bank_details as $employee_bank_details_value) {
                    //pdf generating and sending sending via email code starts from here..

                    //$data["email"] = "mahbubwebsoft@gmail.com";
                    $data["email"] = $request->pay_slip_email;
                    $data["client_name"] = $request->pay_slip_employee_name;
                    $data["subject"] = "Purpose of Salary Payment";
                    $data["stuff_id"] = $employee_bank_details_value->stuff_id;
                    $data["bank_name"] = $employee_bank_details_value->bank_name;
                    $data["bank_account_number"] = $employee_bank_details_value->bank_account_number;
                    $data["bank_account_number"] = $request->pay_slip_payment_date;

                    $salary_month = date('M', strtotime($request->pay_slip_month_year));

                    $salary_month = array(
                        'salary_month' => $salary_month,
                    );

                    $company_name = array(
                        'pay_slip_company_name' => $company_details->company_name,
                    );
                    $employee_name = array(
                        'pay_slip_employee_name' => $request->pay_slip_employee_name,
                    );

                    $stuff_id = array(
                        'pay_slip_stuff_id' => $employee_bank_details_value->stuff_id,
                    );

                    // $bank_name = array(
                    //     'pay_slip_bank_name' => $employee_bank_details_value->bank_name,
                    // );

                    // $bank_account_number = array(
                    //     'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                    // );

                    // $bank_branch = array(
                    //     'pay_slip_bank_branch' => $employee_bank_details_value->bank_branch,
                    // );

                    $bank_name = array(
                        'pay_slip_bank_name' => $employee_bank_details_value->employeeBank->company_bank_account_name,
                    );
                    $bank_account_number = array(
                        'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                    );
                    $bank_branch = array(
                        'pay_slip_bank_branch' => $employee_bank_details_value->employeeBank->company_bank_account_branch,
                    );

                    $working_days = array(
                        'pay_slip_working_days' => $request->pay_slip_working_days,
                    );
                    $date_of_birth = array(
                        'pay_slip_date_of_birth' => $employee_details->date_of_birth,
                    );
                    $department_name = array(
                        'pay_slip_department_name' => $department_details->department_name,
                    );
                    $designation_name = array(
                        'pay_slip_designation_name' => $designation_details->designation_name,
                    );

                    $salary_type = array(
                        'pay_slip_payment_type' => $request->pay_slip_payment_type,
                    );
                    $basic = array(
                        'pay_slip_basic_salary' => $request->pay_slip_basic_salary,
                    );
                    $total_working_hour = array(
                        'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                    );
                    $per_hour_rate = array(
                        'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                    );
                    $house_rent = array(
                        'pay_slip_house_rent' => $request->pay_slip_house_rent,
                    );
                    $medical_allowance = array(
                        'pay_slip_medical_allowance' => $request->pay_slip_medical_allowance,
                    );
                    $conveyance_allowance = array(
                        'pay_slip_conveyance_allowance' => $request->pay_slip_conveyance_allowance,
                    );
                    $festival_bonus = array(
                        'pay_slip_festival_bonus' => $request->pay_slip_festival_bonus,
                    );
                    $commissions = array(
                        'pay_slip_commissions' => $request->pay_slip_commissions,
                    );
                    $other_payments = array(
                        'pay_slip_other_payments' => $request->pay_slip_other_payments,
                    );
                    $overtimes = array(
                        'pay_slip_overtimes' => $request->pay_slip_overtimes,
                    );

                    $pf_contribution = array(
                        'pay_slip_pf_contribution' => $request->pay_slip_provident_fund,
                    );
                    $tax_deduction = array(
                        'pay_slip_tax_deduction' => $request->pay_slip_tax_deduction,
                    );
                    $loans = array(
                        'pay_slip_loans' => $request->pay_slip_loans,
                    );
                    $statutory_deduction = array(
                        'pay_slip_statutory_deduction' => $request->pay_slip_statutory_deduction,
                    );

                    $transport_allowance = array(
                        'pay_slip_transport_allowance' => $request->pay_slip_transport_allowance,
                    );
                    $pay_slip_lunch_allowance = array(
                        'pay_slip_lunch_allowance' => $request->pay_slip_lunch_allowance,
                    );
                    $mobile_bill = array(
                        'pay_slip_mobile_bill' => $request->pay_slip_mobile_bill,
                    );

                    $gross_earning = array(
                        'pay_slip_gross_earnings' => $gross_earnings,
                    );
                    $gross_deduction = array(
                        'pay_slip_gross_deductions' => $gross_deductions,
                    );

                    $net_salary = array(
                        'pay_slip_net_salary' => $request->pay_slip_net_salary,
                    );
                    $payment_date = array(
                        'payment_date' => $request->pay_slip_payment_date,
                    );
                    $pay_slip_late_day_salary_deduct = array(
                        'pay_slip_late_day_salary_deduct' => $request->pay_slip_late_day_salary_deduct,
                    );
                    $pdf = PDF::loadView('back-end.premium.emails.payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,
                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'payment_date' => $payment_date,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'net_salary' => $net_salary,
                        'salary_month' => $salary_month,
                        'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                    ]);

                    Mail::send('back-end.premium.emails.payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,
                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'payment_date' => $payment_date,
                        'net_salary' => $net_salary,
                        'salary_month' => $salary_month,
                        'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,

                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["client_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "payslip.pdf");
                    });
                    //pdf generating and sending sending via email code ends here..
                }
            } else {


                //pdf generating and sending sending via email code starts from here..

                $data["email"] = $request->pay_slip_email;
                $data["client_name"] = $request->pay_slip_employee_name;
                $data["subject"] = "Purpose of Salary Payment";
                $data["stuff_id"] = "---";
                $data["bank_name"] = "---";
                $data["bank_account_number"] = "---";
                $data["bank_account_number"] = $request->pay_slip_payment_date;

                $salary_month = date('M', strtotime($request->pay_slip_month_year));

                $salary_month = array(
                    'salary_month' => $salary_month,
                );
                $company_name = array(
                    'pay_slip_company_name' => $company_details->company_name,
                );
                $employee_name = array(
                    'pay_slip_employee_name' => $request->pay_slip_employee_name,
                );

                $payment_date = array(
                    'payment_date' => $request->pay_slip_payment_date,
                );
                $stuff_id = array(
                    'pay_slip_stuff_id' => "---",
                );



                $bank_name = array(
                    'pay_slip_bank_name' => "---",
                );


                $bank_account_number = array(
                    'pay_slip_bank_account_number' => "---",
                );


                $bank_branch = array(
                    'pay_slip_bank_branch' => "---",
                );


                $working_days = array(
                    'pay_slip_working_days' => $request->pay_slip_working_days,
                );
                $date_of_birth = array(
                    'pay_slip_date_of_birth' => $employee_details->date_of_birth,
                );
                $department_name = array(
                    'pay_slip_department_name' => $department_details->department_name,
                );
                $designation_name = array(
                    'pay_slip_designation_name' => $designation_details->designation_name,
                );
                $salary_type = array(
                    'pay_slip_payment_type' => $request->pay_slip_payment_type,
                );

                $basic = array(
                    'pay_slip_basic_salary' => $request->pay_slip_basic_salary,
                );
                $total_working_hour = array(
                    'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                );
                $per_hour_rate = array(
                    'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                );
                $house_rent = array(
                    'pay_slip_house_rent' => $request->pay_slip_house_rent,
                );
                $medical_allowance = array(
                    'pay_slip_medical_allowance' => $request->pay_slip_medical_allowance,
                );
                $conveyance_allowance = array(
                    'pay_slip_conveyance_allowance' => $request->pay_slip_conveyance_allowance,
                );
                $festival_bonus = array(
                    'pay_slip_festival_bonus' => $request->pay_slip_festival_bonus,
                );
                $commissions = array(
                    'pay_slip_commissions' => $request->pay_slip_commissions,
                );
                $other_payments = array(
                    'pay_slip_other_payments' => $request->pay_slip_other_payments,
                );
                $overtimes = array(
                    'pay_slip_overtimes' => $request->pay_slip_overtimes,
                );


                $pf_contribution = array(
                    'pay_slip_pf_contribution' => $request->pay_slip_provident_fund,
                );
                $tax_deduction = array(
                    'pay_slip_tax_deduction' => $request->pay_slip_tax_deduction,
                );
                $loans = array(
                    'pay_slip_loans' => $request->pay_slip_loans,
                );
                $statutory_deduction = array(
                    'pay_slip_statutory_deduction' => $request->pay_slip_statutory_deduction,
                );

                $transport_allowance = array(
                    'pay_slip_transport_allowance' => $request->pay_slip_transport_allowance,
                );

                $pay_slip_lunch_allowance = array(
                    'pay_slip_lunch_allowance' => $request->pay_slip_lunch_allowance,
                );

                $mobile_bill = array(
                    'pay_slip_mobile_bill' => $request->pay_slip_mobile_bill,
                );


                $gross_earning = array(
                    'pay_slip_gross_earnings' => $gross_earnings,
                );
                $gross_deduction = array(
                    'pay_slip_gross_deductions' => $gross_deductions,
                );

                $net_salary = array(
                    'pay_slip_net_salary' => $request->pay_slip_net_salary,
                );
                $pay_slip_late_day_salary_deduct = array(
                    'pay_slip_late_day_salary_deduct' => $request->pay_slip_late_day_salary_deduct,
                );
                $pdf = PDF::loadView('back-end.premium.emails.payslip', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'stuff_id' => $stuff_id,
                    'bank_name' => $bank_name,
                    'bank_account_number' => $bank_account_number,
                    'bank_branch' => $bank_branch,
                    'working_days' => $working_days,
                    'date_of_birth' => $date_of_birth,
                    'department_name' => $department_name,
                    'designation_name' => $designation_name,
                    'salary_type' => $salary_type,
                    'basic' => $basic,
                    'total_working_hour' => $total_working_hour,
                    'per_hour_rate' => $per_hour_rate,
                    'house_rent' => $house_rent,
                    'medical_allowance' => $medical_allowance,
                    'conveyance_allowance' => $conveyance_allowance,
                    'festival_bonus' => $festival_bonus,
                    'commissions' => $commissions,
                    'other_payments' => $other_payments,
                    'overtimes' => $overtimes,
                    'pf_contribution' => $pf_contribution,
                    'tax_deduction' => $tax_deduction,
                    'loans' => $loans,
                    'statutory_deduction' => $statutory_deduction,
                    'transport_allowance' => $transport_allowance,
                    'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                    'mobile_bill' => $mobile_bill,
                    'gross_earning' => $gross_earning,
                    'gross_deduction' => $gross_deduction,
                    'net_salary' => $net_salary,
                    'payment_date' => $payment_date,
                    'salary_month' => $salary_month,
                    'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                ]);

                Mail::send('back-end.premium.emails.payslip', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'stuff_id' => $stuff_id,
                    'bank_name' => $bank_name,
                    'bank_account_number' => $bank_account_number,
                    'bank_branch' => $bank_branch,
                    'working_days' => $working_days,
                    'date_of_birth' => $date_of_birth,
                    'department_name' => $department_name,
                    'designation_name' => $designation_name,
                    'salary_type' => $salary_type,
                    'basic' => $basic,
                    'total_working_hour' => $total_working_hour,
                    'per_hour_rate' => $per_hour_rate,
                    'house_rent' => $house_rent,
                    'medical_allowance' => $medical_allowance,
                    'conveyance_allowance' => $conveyance_allowance,
                    'festival_bonus' => $festival_bonus,
                    'commissions' => $commissions,
                    'other_payments' => $other_payments,
                    'overtimes' => $overtimes,
                    'pf_contribution' => $pf_contribution,
                    'tax_deduction' => $tax_deduction,
                    'loans' => $loans,
                    'statutory_deduction' => $statutory_deduction,
                    'transport_allowance' => $transport_allowance,
                    'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                    'mobile_bill' => $mobile_bill,
                    'gross_earning' => $gross_earning,
                    'gross_deduction' => $gross_deduction,
                    'net_salary' => $net_salary,
                    'payment_date' => $payment_date,
                    'salary_month' => $salary_month,
                    'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                ], function ($message) use ($data, $pdf) {
                    $message->to($data["email"], $data["client_name"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), "payslip.pdf");
                });
                //pdf generating and sending sending via email code ends here..
            }
        }

        //return $pdf->download('payslip.pdf');
        return back()->with('message', 'Payment Made');
    }

    public function paymentHistoryIndex(Request $request)
    {
        if ($request->payment_history_department_id && $request->payment_history_month_year) {
            $last_month = date('m', strtotime($request->payment_history_month_year));
            $previous_month_year = date('Y', strtotime($request->payment_history_month_year));

            $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->where('pay_slip_department_id', $request->payment_history_department_id)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            return view('back-end.premium.payroll.payment-history.payment-history-index', compact('payment_histories', 'departments'));
        } else {
            $last_month = date('m', strtotime($request->payment_history_month_year));
            $previous_month_year = date('Y', strtotime($request->payment_history_month_year));

            $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                // ->whereMonth('pay_slip_month_year', '=', $last_month)
                // ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            return view('back-end.premium.payroll.payment-history.payment-history-index', compact('payment_histories', 'departments'));
        }
    }
    public function paymentHistorySearchIndex(Request $request)
    {
        if ($request->payment_history_department_id && $request->payment_history_month_year) {
            $last_month = date('m', strtotime($request->payment_history_month_year));
            $previous_month_year = date('Y', strtotime($request->payment_history_month_year));

            $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->where('pay_slip_department_id', $request->payment_history_department_id)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            return view('back-end.premium.payroll.payment-history.payment-history-index', compact('payment_histories', 'departments'));
        } else {
            $last_month = date('m', strtotime($request->payment_history_month_year));
            $previous_month_year = date('Y', strtotime($request->payment_history_month_year));

            $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            return view('back-end.premium.payroll.payment-history.payment-history-index', compact('payment_histories', 'departments'));
        }
    }
    public function monthWiseSalarySheetGenerate(Request $request)
    {
        if ($request->download_pdf) {
            $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
            $last_month = date('m', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));
            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();
            $fileName = "Salary-Sheet.pdf";
            $month_year = $request->month_year;
            $mpdf = new \Mpdf\Mpdf([
                                'margin_top' => 40,
                                'margin_bottom' => 30,
                                'margin_header' => 5,
                                'margin_footer' => 5,
                                'orientation' => 'L',
            ]);
            $html = \View::make('back-end.premium.emails.salary-sheet', compact('payment_histories', 'month_year'));
            $html = $html->render();
            $logo = url('/uploads/logos/logo.png');
            $htmlHeader = '<html><div>'
                . '<div><img src="' . $logo . '"  style="max-height: 20px; text-align: center; padding-left:0%;"/></div>'
                . '<div id="descriptionCourse" style="padding-left:33%;"><span style="font-size:20px;"> ' . $company_names->company_name . '</div>'
                . '<div id="descriptionClassement" style="padding-left:40%;"><span style="font-size:20px;">Period:  ' . date("F", strtotime($month_year)) . ' ' . date("Y", strtotime($month_year)) . '</span></div>'
                . '<div id="descriptionClassement" style="padding-left:42%;"><span style="font-size:20px;">Salary Sheet</span></div>'
                . '</div></html>';

            $htmlFooter = '<html><div>'
            .' <div style="">  <br/> <br/> <br/><br/> ________________ <br/> Prepared By<br/></div>
            <div style="margin-top:-4%; margin-left: 45%;">  _______________<br/>checked By<br/> </div>
            <div style="margin-top:-4%; margin-left: 90%;">  _______________<br/>Approved By<br/></div>'
            . '</div></html>';

            $mpdf->SetHTMLHeader($htmlHeader);
            $mpdf->SetHTMLFooter($htmlFooter);
            $mpdf->WriteHTML($html);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->Output($fileName, 'D');
            return back();
        }
        if ($request->download_excel) {
            $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
            $last_month = date('m', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));
            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            $fileName = "Salary-Sheet.pdf";
            $month_year = $request->month_year;
            $data['payment_histories'] = $payment_histories;
            $data['month_year'] = $month_year;
            $data['previous_month_year'] = $previous_month_year;

            $exl = Excel::download(new salarySheetExport($data), 'Salary Sheet ' . $data['month_year'] . '.xlsx');
            return $exl;
        }
    }

    public function withOutPaymentSheetApprove(Request $request)
    {
                ############### random key generate code starts###########
                function generateRandomString1($length = 25)
                {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }
                $random_key = generateRandomString1();
                ############### random key generate code staendsrts###########

                $employees = User::where('id', $request->emp_id)->get(['id','email','first_name','last_name']);


                foreach ($employees as $employees_value) {

                    $data["email"] = $employees_value->email;
                    $data["request_receiver_name"] =   $employees_value->first_name . ' ' .  $employees_value->last_name;
                    $data["subject"] = "Approve Salary Sheet";
                    $receiver_name = array(
                        'receiver_name_value' => $data["request_receiver_name"],
                    );

                                    // Save notification
                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Approve Salary Sheet";
                        $notification->notification_title = "You Have A New Notification for Approve Salary Sheet";
                        $notification->notification_to = $request->emp_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                    $late_time_salary_config = LateTimeSalaryConfig::where('late_time_salary_config_com_id', Auth::user()->com_id)->first();
                    $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);
                    $festival_bounus_percentage = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_percentage']);
                    $salary_config = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first();
                    $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
                    $minimum_tax_config = MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();
                    $last_month = date('m', strtotime($request->month_year));
                    $previous_month_year = date('Y', strtotime($request->month_year));

                    $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                        ->join('departments', 'users.department_id', '=', 'departments.id')
                        ->join('designations', 'users.designation_id', '=', 'designations.id')
                        ->join('companies', 'users.com_id', '=', 'companies.id')
                        ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name',
                        'designations.designation_name', 'companies.company_name')
                        ->where('pay_slip_com_id', Auth::user()->com_id)
                        ->where('pay_slip_status', 1)
                        ->whereMonth('pay_slip_month_year', '=', $last_month)
                        ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                        ->get();
                    $last_month_date_year = date('Y-m-d', strtotime('last month'));
                    $last_month = date('m', strtotime($request->month_year));
                    $date_wise_day_name = date('D', strtotime($request->month_year));
                    $previous_month_year = date('Y', strtotime($request->month_year));
                    $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
                    $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
                    $month_year = $request->month_year;
                    $new_payments = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                        ->join('departments', 'users.department_id', '=', 'departments.id')
                        ->join('designations', 'users.designation_id', '=', 'designations.id')
                        ->join('salary_configs', 'monthly_attendances.monthly_com_id', '=', 'salary_configs.salary_config_com_id')
                        ->select(
                            'monthly_attendances.*',
                            'users.first_name',
                            'users.last_name',
                            'users.joining_date',
                            'users.department_id',
                            'users.per_hour_rate',
                            'users.profile_photo',
                            'users.per_hour_rate',
                            'users.gross_salary',
                            'users.salary_type',
                            'users.user_provident_fund',
                            'user_provident_fund_member',
                            'users.email',
                            'salary_configs.salary_config_basic_salary',
                            'salary_configs.salary_config_house_rent_allowance',
                            'salary_configs.salary_config_conveyance_allowance',
                            'salary_configs.salary_config_medical_allowance',
                            'salary_configs.salary_config_festival_bonus',
                            'users.mobile_bill',
                            'transport_allowance',
                            'departments.department_name',
                            'designations.designation_name',
                            'users.company_assigned_id'
                        )
                        ->where('monthly_com_id', '=', Auth::user()->com_id)
                        ->whereMonth('attendance_month', '=', $last_month)
                        ->whereYear('attendance_year', '=', $previous_month_year)
                        ->get();

                    $pdf = PDF::loadView('back-end.premium.payroll.new-payment.approve-salary-sheet', get_defined_vars());
                    // return view('back-end.premium.payroll.new-payment.approve-salary-sheet', get_defined_vars());

                    Mail::send('back-end.premium.payroll.new-payment.approve-salary-sheet-mail', [
                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "salary-sheet.pdf");
                    });
                }

                return back()->with('message', 'Sent Successfully');
    }

    public function downloadwithOutPaymentSheet(Request $request)
    {
        $last_month = date('m', strtotime($request->month_year));
        if ($last_month ) {

                    $late_time_salary_config = LateTimeSalaryConfig::where('late_time_salary_config_com_id', Auth::user()->com_id)->first();
                    $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);
                    $festival_bounus_percentage = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_percentage']);
                    $salary_config = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first();
                    $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
                    $minimum_tax_config = MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();
                    // $last_month = date('m', strtotime($request->month_year));
                    $previous_month_year = date('Y', strtotime($request->month_year));
                    $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                        ->join('departments', 'users.department_id', '=', 'departments.id')
                        ->join('designations', 'users.designation_id', '=', 'designations.id')
                        ->join('companies', 'users.com_id', '=', 'companies.id')
                        ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name',
                        'designations.designation_name', 'companies.company_name')
                        ->where('pay_slip_com_id', Auth::user()->com_id)
                        ->where('pay_slip_status', 1)
                        ->whereMonth('pay_slip_month_year', '=', $last_month)
                        ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                        ->get();
                    $last_month_date_year = date('Y-m-d', strtotime('last month'));
                    $last_month = date('m', strtotime($request->month_year));
                    $date_wise_day_name = date('D', strtotime($request->month_year));
                    $previous_month_year = date('Y', strtotime($request->month_year));
                    $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
                    $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
                    $month_year = $request->month_year;
                    $new_payments = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                        ->join('departments', 'users.department_id', '=', 'departments.id')
                        ->join('designations', 'users.designation_id', '=', 'designations.id')
                        ->join('salary_configs', 'monthly_attendances.monthly_com_id', '=', 'salary_configs.salary_config_com_id')
                        ->select(
                            'monthly_attendances.*',
                            'users.first_name',
                            'users.last_name',
                            'users.joining_date',
                            'users.department_id',
                            'users.per_hour_rate',
                            'users.profile_photo',
                            'users.per_hour_rate',
                            'users.gross_salary',
                            'users.salary_type',
                            'users.user_provident_fund',
                            'user_provident_fund_member',
                            'users.email',
                            'salary_configs.salary_config_basic_salary',
                            'salary_configs.salary_config_house_rent_allowance',
                            'salary_configs.salary_config_conveyance_allowance',
                            'salary_configs.salary_config_medical_allowance',
                            'salary_configs.salary_config_festival_bonus',
                            'users.mobile_bill',
                            'transport_allowance',
                            'departments.department_name',
                            'designations.designation_name',
                            'users.company_assigned_id'
                        )
                        ->where('monthly_com_id', '=', Auth::user()->com_id)
                        ->whereMonth('attendance_month', '=', $last_month)
                        ->whereYear('attendance_year', '=', $previous_month_year)
                        ->get();
                     }
                        $fileName = "Approve-Salary-Sheet.pdf";
                        $mpdf = new \Mpdf\Mpdf([
                            'margin_top' => 40,
                            'margin_bottom' => 30,
                            'margin_header' => 5,
                            'margin_footer' => 5,
                            'orientation' => 'L',
                        ]);
                        $html = \View::make('back-end.premium.payroll.new-payment.download-salary-sheet', get_defined_vars());
                        $html = $html->render();

                        $logo = url('/uploads/logos/logo.png');

                        $htmlHeader = '<html><div>'
                            . '<div><img src="' . $logo . '"  style="max-height: 20px; text-align: center; padding-left:0%;"/></div>'
                            . '<div id="descriptionCourse" style="padding-left:33%;"><span style="font-size:20px;"> ' . $company_names->company_name . '</div>'
                            . '<div id="descriptionClassement" style="padding-left:40%;"><span style="font-size:20px;">Period:  ' . date("F", strtotime($month_year)) . ' ' . date("Y", strtotime($month_year)) . '</span></div>'
                            . '<div id="descriptionClassement" style="padding-left:42%;"><span style="font-size:20px;">Salary Sheet</span></div>'
                            . '</div></html>';


                        $htmlFooter = '<html><div>'
                            . ' <div style="">  <br/> <br/> <br/><br/> ________________ <br/> Prepared By<br/></div>
                    <div style="margin-top:-4%; margin-left: 45%;">  _______________<br/>checked By<br/> </div>
                    <div style="margin-top:-4%; margin-left: 90%;">  _______________<br/>Approved By<br/></div>'
                            . '</div></html>';

                        $mpdf->SetHTMLHeader($htmlHeader);
                        $mpdf->SetHTMLFooter($htmlFooter);
                        $mpdf->WriteHTML($html);
                        $mpdf->SetDisplayMode('fullpage');
                        $mpdf->Output($fileName, 'D');
                        return back();
                    // return view('back-end.premium.payroll.new-payment.download-salary-sheet', get_defined_vars());

    }



    public function monthWiseSalarySheetGenerateWithOutPayment(Request $request)
    {
        if ($request->download_pdf) {

            $late_time_salary_config = LateTimeSalaryConfig::where('late_time_salary_config_com_id', Auth::user()->com_id)->first();
            $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);

            $festival_bounus_percentage = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_percentage']);

            $salary_config = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first();

            $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);

            $minimum_tax_config = MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();

            $last_month = date('m', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));

            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            $last_month_date_year = date('Y-m-d', strtotime('last month'));
            $last_month = date('m', strtotime($request->month_year));
            $date_wise_day_name = date('D', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));
            $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
            $departments = Department::where('department_com_id', Auth::user()->com_id)->get();

            $new_payments = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('salary_configs', 'monthly_attendances.monthly_com_id', '=', 'salary_configs.salary_config_com_id')
                ->select(
                    'monthly_attendances.*',
                    'users.first_name',
                    'users.last_name',
                    'users.joining_date',
                    'users.department_id',
                    'users.per_hour_rate',
                    'users.profile_photo',
                    'users.per_hour_rate',
                    'users.gross_salary',
                    'users.salary_type',
                    'users.user_provident_fund',
                    'user_provident_fund_member',
                    'users.email',
                    'salary_configs.salary_config_basic_salary',
                    'salary_configs.salary_config_house_rent_allowance',
                    'salary_configs.salary_config_conveyance_allowance',
                    'salary_configs.salary_config_medical_allowance',
                    'salary_configs.salary_config_festival_bonus',
                    'users.mobile_bill',
                    'transport_allowance',
                    'departments.department_name',
                    'designations.designation_name',
                    'users.company_assigned_id'
                )
                ->where('monthly_com_id', '=', Auth::user()->com_id)
                ->whereMonth('attendance_month', '=', $last_month)
                ->whereYear('attendance_year', '=', $previous_month_year)
                ->get();

            $fileName = "Without-Payment-Salary-Sheet.pdf";
            $month_year = $request->month_year;

            $mpdf = new \Mpdf\Mpdf([

                'margin_top' => 40,
                'margin_bottom' => 30,
                'margin_header' => 5,
                'margin_footer' => 5,
                'orientation' => 'L',
            ]);
            $html = \View::make('back-end.premium.payroll.new-payment.without-payment', get_defined_vars());
            $html = $html->render();

            $logo = url('/uploads/logos/logo.png');

            $htmlHeader = '<html><div>'
                . '<div><img src="' . $logo . '"  style="max-height: 20px; text-align: center; padding-left:0%;"/></div>'
                . '<div id="descriptionCourse" style="padding-left:33%;"><span style="font-size:20px;"> ' . $company_names->company_name . '</div>'
                . '<div id="descriptionClassement" style="padding-left:40%;"><span style="font-size:20px;">Period:  ' . date("F", strtotime($month_year)) . ' ' . date("Y", strtotime($month_year)) . '</span></div>'
                . '<div id="descriptionClassement" style="padding-left:35%;"><span style="font-size:20px;">Salary Sheet Without Payment</span></div>'
                . '</div></html>';

            $htmlFooter = '<html><div>'
                . ' <div style="">  <br/> <br/> <br/><br/> ________________ <br/> Prepared By<br/></div>
          <div style="margin-top:-4%; margin-left: 45%;">  _______________<br/>checked By<br/> </div>
          <div style="margin-top:-4%; margin-left: 90%;">  _______________<br/>Approved By<br/></div>'
                . '</div></html>';

            $mpdf->SetHTMLHeader($htmlHeader);
            $mpdf->SetHTMLFooter($htmlFooter);
            $mpdf->WriteHTML($html);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->Output($fileName, 'D');
            return back();
        }
        if ($request->download_excel) {

            $late_time_salary_config = LateTimeSalaryConfig::where('late_time_salary_config_com_id', Auth::user()->com_id)->first();
            $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);

            $festival_bounus_percentage = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_percentage']);

            $salary_config = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first();

            $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);

            $minimum_tax_config = MinimumTaxConfigure::where('minimum_tax_config_com_id', Auth::user()->com_id)->first();

            $last_month = date('m', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));

            $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('companies', 'users.com_id', '=', 'companies.id')
                ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->whereMonth('pay_slip_month_year', '=', $last_month)
                ->whereYear('pay_slip_month_year', '=', $previous_month_year)
                ->get();

            $last_month_date_year = date('Y-m-d', strtotime('last month'));
            $last_month = date('m', strtotime($request->month_year));
            $date_wise_day_name = date('D', strtotime($request->month_year));
            $previous_month_year = date('Y', strtotime($request->month_year));
            $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
            $departments = Department::where('department_com_id', Auth::user()->com_id)->get();

            $new_payments = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id')
                ->join('salary_configs', 'monthly_attendances.monthly_com_id', '=', 'salary_configs.salary_config_com_id')
                ->select(
                    'monthly_attendances.*',
                    'users.first_name',
                    'users.last_name',
                    'users.joining_date',
                    'users.department_id',
                    'users.per_hour_rate',
                    'users.profile_photo',
                    'users.per_hour_rate',
                    'users.gross_salary',
                    'users.salary_type',
                    'users.user_provident_fund',
                    'user_provident_fund_member',
                    'users.email',
                    'salary_configs.salary_config_basic_salary',
                    'salary_configs.salary_config_house_rent_allowance',
                    'salary_configs.salary_config_conveyance_allowance',
                    'salary_configs.salary_config_medical_allowance',
                    'salary_configs.salary_config_festival_bonus',
                    'users.mobile_bill',
                    'transport_allowance',
                    'departments.department_name',
                    'designations.designation_name',
                    'users.company_assigned_id'
                )
                ->where('monthly_com_id', '=', Auth::user()->com_id)
                ->whereMonth('attendance_month', '=', $last_month)
                ->whereYear('attendance_year', '=', $previous_month_year)
                ->get();

            $fileName = "Without-Payment-Salary-Sheet.pdf";

            $month_year = $request->month_year;
            $data['payment_histories'] = $payment_histories;
            $data['company_names'] = $company_names;
            $data['new_payments'] = $new_payments;
            $data['minimum_tax_config'] = $minimum_tax_config;
            $data['previous_month_year'] = $previous_month_year;
            $data['date_wise_day_name'] = $date_wise_day_name;
            $data['tax_configs'] = $tax_configs;
            $data['departments'] = $departments;
            $data['last_month'] = $last_month;
            $data['month_year'] = $month_year;
            $data['last_month_date_year'] = $last_month_date_year;

            $data['previous_month_year'] = $previous_month_year;

            $exl = Excel::download(new withOutPaymentSalarySheetExport($data), 'Withot Payment Salary Sheet ' . $data['month_year'] . '.xlsx');
            return $exl;

        }
    }
    public function pfHistoryIndex(Request $request)
    {

        $last_month = date('m', strtotime('last month'));
        $previous_month_year = date('Y', strtotime('last month'));

        $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
        $pf_histories = ProvidentFund::join('users', 'provident_funds.provident_fund_employee_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('designations', 'users.designation_id', '=', 'designations.id')
            ->join('companies', 'users.com_id', '=', 'companies.id')
            ->join('providentfund_bankaccounts', 'users.id', '=', 'providentfund_bankaccounts.providentfund_bankaccount_employee_id')
            ->select('provident_funds.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'companies.company_name', 'providentfund_bankaccounts.providentfund_bankaccount_stuff_id', 'providentfund_bankaccounts.providentfund_bankaccount_bank_name', 'providentfund_bankaccounts.providentfund_bankaccount_bank_account_number', 'providentfund_bankaccounts.providentfund_bankaccount_branch_name', 'providentfund_bankaccounts.providentfund_bankaccount_branch_code')
            ->where('provident_fund_com_id', Auth::user()->com_id)
            ->whereMonth('provident_fund_month_year', '=', $last_month)
            ->whereYear('provident_fund_month_year', '=', $previous_month_year)
            ->get();

        //echo json_encode($pf_histories); exit;

        return view('back-end.premium.payroll.pf-history.pf-history-index', compact('pf_histories', 'departments'));
    }

    public function monthWisePfHistoryIndex(Request $request)
    {

        $last_month = date('m', strtotime($request->provident_fund_month_year));
        $previous_month_year = date('Y', strtotime($request->provident_fund_month_year));

        $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
        $pf_histories = ProvidentFund::join('users', 'provident_funds.provident_fund_employee_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('designations', 'users.designation_id', '=', 'designations.id')
            ->join('companies', 'users.com_id', '=', 'companies.id')
            ->join('providentfund_bankaccounts', 'users.id', '=', 'providentfund_bankaccounts.providentfund_bankaccount_employee_id')
            ->select('provident_funds.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'companies.company_name', 'providentfund_bankaccounts.providentfund_bankaccount_stuff_id', 'providentfund_bankaccounts.providentfund_bankaccount_bank_name', 'providentfund_bankaccounts.providentfund_bankaccount_bank_account_number', 'providentfund_bankaccounts.providentfund_bankaccount_branch_name', 'providentfund_bankaccounts.providentfund_bankaccount_branch_code')
            ->where('provident_fund_com_id', Auth::user()->com_id)
            ->whereMonth('provident_fund_month_year', '=', $last_month)
            ->whereYear('provident_fund_month_year', '=', $previous_month_year)
            ->get();

        //echo json_encode($pf_histories); exit;

        return view('back-end.premium.payroll.pf-history.pf-history-index', compact('pf_histories', 'departments'));
    }

    public function employeePaySlipDownload(Request $request)
    {

        $pay_slips = PaySlip::where('id', $request->id)->get();

        foreach ($pay_slips as $pay_slips_value) {

            $user_details = User::where('id', $pay_slips_value->pay_slip_employee_id)->get();

            if (BankAccount::where('bank_account_employee_id', $pay_slips_value->pay_slip_employee_id)->exists()) {

                $employee_bank_details = BankAccount::where('bank_account_employee_id', $pay_slips_value->pay_slip_employee_id)->get();

                foreach ($employee_bank_details as $employee_bank_details_value) {


                    foreach ($user_details as $user_details_value) {
                        $company_details = Company::where('id', $user_details_value->com_id)->first(['company_name']);
                        $department_details = Department::where('id', $user_details_value->department_id)->first(['department_name']);
                        $designation_details = Designation::where('id', $user_details_value->designation_id)->first(['designation_name']);

                        $user_full_name = $user_details_value->first_name . " " . $user_details_value->last_name;

                        $salary_month = date('M', strtotime($pay_slips_value->pay_slip_month_year));

                        $salary_month = array(
                            'salary_month' => $salary_month,
                        );

                        $company_name = array(
                            'pay_slip_company_name' => $company_details->company_name,
                        );
                        $employee_name = array(
                            'pay_slip_employee_name' => $user_full_name,
                        );
                        $stuff_id = array(
                            'pay_slip_stuff_id' => $user_details_value->company_assigned_id,
                        );

                        $bank_name = array(
                            'pay_slip_bank_name' => $employee_bank_details_value->employeeBank->company_bank_account_name,
                        );
                        $bank_account_number = array(
                            'pay_slip_bank_account_number' => $employee_bank_details_value->bank_account_number,
                        );
                        $bank_branch = array(
                            'pay_slip_bank_branch' => $employee_bank_details_value->employeeBank->company_bank_account_branch,
                        );

                        $working_days = array(
                            'pay_slip_working_days' => $pay_slips_value->pay_slip_working_days,
                        );
                        $date_of_birth = array(
                            'pay_slip_date_of_birth' => $user_details_value->date_of_birth,
                        );
                        $department_name = array(
                            'pay_slip_department_name' => $department_details->department_name,
                        );
                        $designation_name = array(
                            'pay_slip_designation_name' => $designation_details->designation_name,
                        );
                        $salary_type = array(
                            'pay_slip_payment_type' => $pay_slips_value->pay_slip_payment_type,
                        );

                        $pay_slip_month_year = array(
                            'pay_slip_basic_salary' => $pay_slips_value->pay_slip_month_year,
                        );

                        $basic = array(
                            'pay_slip_basic_salary' => $pay_slips_value->pay_slip_basic_salary,
                        );
                        $total_working_hour = array(
                            'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                        );
                        $per_hour_rate = array(
                            'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                        );
                        $house_rent = array(
                            'pay_slip_house_rent' => $pay_slips_value->pay_slip_house_rent,
                        );
                        $medical_allowance = array(
                            'pay_slip_medical_allowance' => $pay_slips_value->pay_slip_medical_allowance,
                        );
                        $conveyance_allowance = array(
                            'pay_slip_conveyance_allowance' => $pay_slips_value->pay_slip_conveyance_allowance,
                        );
                        $festival_bonus = array(
                            'pay_slip_festival_bonus' => $pay_slips_value->pay_slip_festival_bonus,
                        );
                        $commissions = array(
                            'pay_slip_commissions' => $pay_slips_value->pay_slip_commissions,
                        );
                        $other_payments = array(
                            'pay_slip_other_payments' => $pay_slips_value->pay_slip_other_payments,
                        );
                        $overtimes = array(
                            'pay_slip_overtimes' => $pay_slips_value->pay_slip_overtimes,
                        );
                        $pf_contribution = array(
                            'pay_slip_pf_contribution' => $pay_slips_value->pay_slip_provident_fund,
                        );
                        $tax_deduction = array(
                            'pay_slip_tax_deduction' => $pay_slips_value->pay_slip_tax_deduction,
                        );
                        $loans = array(
                            'pay_slip_loans' => $pay_slips_value->pay_slip_loans,
                        );
                        $statutory_deduction = array(
                            'pay_slip_statutory_deduction' => $pay_slips_value->pay_slip_statutory_deduction,
                        );

                        $transport_allowance = array(
                            'pay_slip_transport_allowance' => $pay_slips_value->pay_slip_transport_allowance,
                        );
                        $pay_slip_lunch_allowance = array(
                            'pay_slip_lunch_allowance' => $pay_slips_value->pay_slip_lunch_allowance,
                        );
                        $mobile_bill = array(
                            'pay_slip_mobile_bill' => $pay_slips_value->pay_slip_mobile_bill,
                        );
                        $payment_date = array(
                            'payment_date' => $pay_slips_value->pay_slip_payment_date,
                        );
                        $pay_slip_late_day_salary_deduct = array(
                         'pay_slip_late_day_salary_deduct' => $pay_slips_value->pay_slip_late_day_salary_deduct,
                         );
                        $gross_earning_total = $pay_slips_value->pay_slip_basic_salary
                            + $pay_slips_value->pay_slip_house_rent
                            + $pay_slips_value->pay_slip_medical_allowance
                            + $pay_slips_value->pay_slip_conveyance_allowance
                            + $pay_slips_value->pay_slip_festival_bonus
                            + $pay_slips_value->pay_slip_commissions
                            + $pay_slips_value->pay_slip_other_payments
                            + $pay_slips_value->pay_slip_overtimes
                            + $pay_slips_value->pay_slip_mobile_bill
                            + $pay_slips_value->pay_slip_transport_allowance;

                        $gross_deduction_total = $pay_slips_value->pay_slip_provident_fund
                            + $pay_slips_value->pay_slip_tax_deduction
                            + $pay_slips_value->pay_slip_loans
                            + $pay_slips_value->pay_slip_statutory_deduction
                            + $pay_slips_value->pay_slip_late_day_salary_deduct
                            + $pay_slips_value->pay_slip_lunch_allowance;

                        $gross_earning = array(
                            'pay_slip_gross_earnings' => $gross_earning_total,
                        );
                        $gross_deduction = array(
                            'pay_slip_gross_deductions' => $gross_deduction_total,
                        );

                        $net_salary = array(
                            'pay_slip_net_salary' => $pay_slips_value->pay_slip_net_salary,
                        );


                        $pdf = PDF::loadView('back-end.premium.emails.payslip', [
                            'company_name' => $company_name,
                            'employee_name' => $employee_name,
                            'pay_slip_month_year' => $pay_slip_month_year,
                            'stuff_id' => $stuff_id,
                            'bank_name' => $bank_name,
                            'bank_account_number' => $bank_account_number,
                            'bank_branch' => $bank_branch,
                            'working_days' => $working_days,
                            'date_of_birth' => $date_of_birth,
                            'department_name' => $department_name,
                            'designation_name' => $designation_name,
                            'salary_type' => $salary_type,
                            'basic' => $basic,
                            'total_working_hour' => $total_working_hour,
                            'per_hour_rate' => $per_hour_rate,
                            'house_rent' => $house_rent,
                            'medical_allowance' => $medical_allowance,
                            'conveyance_allowance' => $conveyance_allowance,
                            'festival_bonus' => $festival_bonus,
                            'commissions' => $commissions,
                            'other_payments' => $other_payments,
                            'overtimes' => $overtimes,
                            'pf_contribution' => $pf_contribution,
                            'tax_deduction' => $tax_deduction,
                            'loans' => $loans,
                            'statutory_deduction' => $statutory_deduction,
                            'transport_allowance' => $transport_allowance,
                            'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                            'mobile_bill' => $mobile_bill,
                            'gross_earning' => $gross_earning,
                            'gross_deduction' => $gross_deduction,
                            'net_salary' => $net_salary,
                            'payment_date' => $payment_date,
                            'salary_month' => $salary_month,
                            'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                        ]);

                        $pdf->download('paySlip.pdf');
                    }
                }
            } else {

                foreach ($user_details as $user_details_value) {
                    $company_details = Company::where('id', $user_details_value->com_id)->first(['company_name']);
                    $department_details = Department::where('id', $user_details_value->department_id)->first(['department_name']);
                    $designation_details = Designation::where('id', $user_details_value->designation_id)->first(['designation_name']);

                    $user_full_name = $user_details_value->first_name . " " . $user_details_value->last_name;

                    $salary_month = date('M', strtotime($pay_slips_value->pay_slip_month_year));


                    $salary_month = array(
                        'salary_month' => $salary_month,
                    );


                    $company_name = array(
                        'pay_slip_company_name' => $company_details->company_name,
                    );
                    $employee_name = array(
                        'pay_slip_employee_name' => $user_full_name,
                    );
                    $stuff_id = array(
                        'pay_slip_stuff_id' => $user_details_value->company_assigned_id,
                    );
                    $bank_name = array(
                        'pay_slip_bank_name' => "--",
                    );
                    $bank_account_number = array(
                        'pay_slip_bank_account_number' => "--",
                    );
                    $bank_branch = array(
                        'pay_slip_bank_branch' => "--",
                    );
                    $working_days = array(
                        'pay_slip_working_days' => $pay_slips_value->pay_slip_working_days,
                    );
                    $date_of_birth = array(
                        'pay_slip_date_of_birth' => $user_details_value->date_of_birth,
                    );
                    $department_name = array(
                        'pay_slip_department_name' => $department_details->department_name,
                    );
                    $designation_name = array(
                        'pay_slip_designation_name' => $designation_details->designation_name,
                    );
                    $salary_type = array(
                        'pay_slip_payment_type' => $pay_slips_value->pay_slip_payment_type,
                    );

                    $pay_slip_month_year = array(
                        'pay_slip_basic_salary' => $pay_slips_value->pay_slip_month_year,
                    );

                    $basic = array(
                        'pay_slip_basic_salary' => $pay_slips_value->pay_slip_basic_salary,
                    );
                    $total_working_hour = array(
                        'pay_slip_total_working_hour' => $request->pay_slip_total_working_hour,
                    );
                    $per_hour_rate = array(
                        'pay_slip_per_hour_rate' => $request->pay_slip_per_hour_rate,
                    );
                    $house_rent = array(
                        'pay_slip_house_rent' => $pay_slips_value->pay_slip_house_rent,
                    );
                    $medical_allowance = array(
                        'pay_slip_medical_allowance' => $pay_slips_value->pay_slip_medical_allowance,
                    );
                    $conveyance_allowance = array(
                        'pay_slip_conveyance_allowance' => $pay_slips_value->pay_slip_conveyance_allowance,
                    );
                    $festival_bonus = array(
                        'pay_slip_festival_bonus' => $pay_slips_value->pay_slip_festival_bonus,
                    );
                    $commissions = array(
                        'pay_slip_commissions' => $pay_slips_value->pay_slip_commissions,
                    );
                    $other_payments = array(
                        'pay_slip_other_payments' => $pay_slips_value->pay_slip_other_payments,
                    );
                    $overtimes = array(
                        'pay_slip_overtimes' => $pay_slips_value->pay_slip_overtimes,
                    );


                    $pf_contribution = array(
                        'pay_slip_pf_contribution' => $pay_slips_value->pay_slip_provident_fund,
                    );
                    $tax_deduction = array(
                        'pay_slip_tax_deduction' => $pay_slips_value->pay_slip_tax_deduction,
                    );
                    $loans = array(
                        'pay_slip_loans' => $pay_slips_value->pay_slip_loans,
                    );
                    $statutory_deduction = array(
                        'pay_slip_statutory_deduction' => $pay_slips_value->pay_slip_statutory_deduction,
                    );

                    $transport_allowance = array(
                        'pay_slip_transport_allowance' => $pay_slips_value->pay_slip_transport_allowance,
                    );
                    $pay_slip_lunch_allowance = array(
                        'pay_slip_lunch_allowance' => $pay_slips_value->pay_slip_lunch_allowance,
                    );
                    $mobile_bill = array(
                        'pay_slip_mobile_bill' => $pay_slips_value->pay_slip_mobile_bill,
                    );
                    $payment_date = array(
                        'payment_date' => $pay_slips_value->pay_slip_payment_date,
                    );
                    $pay_slip_late_day_salary_deduct = array(
                         'pay_slip_late_day_salary_deduct' => $pay_slips_value->pay_slip_late_day_salary_deduct,
                         );
                    $gross_earning_total = $pay_slips_value->pay_slip_basic_salary
                        + $pay_slips_value->pay_slip_house_rent
                        + $pay_slips_value->pay_slip_medical_allowance
                        + $pay_slips_value->pay_slip_conveyance_allowance
                        + $pay_slips_value->pay_slip_festival_bonus
                        + $pay_slips_value->pay_slip_commissions
                        + $pay_slips_value->pay_slip_other_payments
                        + $pay_slips_value->pay_slip_overtimes
                        + $pay_slips_value->pay_slip_mobile_bill
                        + $pay_slips_value->pay_slip_transport_allowance;

                    $gross_deduction_total = $pay_slips_value->pay_slip_provident_fund
                        + $pay_slips_value->pay_slip_tax_deduction
                        + $pay_slips_value->pay_slip_loans
                        + $pay_slips_value->pay_slip_statutory_deduction
                        + $pay_slips_value->pay_slip_late_day_salary_deduct
                        + $pay_slips_value->pay_slip_lunch_allowance;

                    $gross_earning = array(
                        'pay_slip_gross_earnings' => $gross_earning_total,
                    );
                    $gross_deduction = array(
                        'pay_slip_gross_deductions' => $gross_deduction_total,
                    );

                    $net_salary = array(
                        'pay_slip_net_salary' => $pay_slips_value->pay_slip_net_salary,
                    );


                    $pdf = PDF::loadView('back-end.premium.emails.payslip', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pay_slip_month_year' => $pay_slip_month_year,
                        'stuff_id' => $stuff_id,
                        'bank_name' => $bank_name,
                        'bank_account_number' => $bank_account_number,
                        'bank_branch' => $bank_branch,
                        'working_days' => $working_days,
                        'date_of_birth' => $date_of_birth,
                        'department_name' => $department_name,
                        'designation_name' => $designation_name,
                        'salary_type' => $salary_type,
                        'basic' => $basic,
                        'total_working_hour' => $total_working_hour,
                        'per_hour_rate' => $per_hour_rate,
                        'house_rent' => $house_rent,
                        'medical_allowance' => $medical_allowance,
                        'conveyance_allowance' => $conveyance_allowance,
                        'festival_bonus' => $festival_bonus,
                        'commissions' => $commissions,
                        'other_payments' => $other_payments,
                        'overtimes' => $overtimes,
                        'pf_contribution' => $pf_contribution,
                        'tax_deduction' => $tax_deduction,
                        'loans' => $loans,
                        'statutory_deduction' => $statutory_deduction,
                        'transport_allowance' => $transport_allowance,
                        'pay_slip_lunch_allowance' => $pay_slip_lunch_allowance,
                        'mobile_bill' => $mobile_bill,
                        'gross_earning' => $gross_earning,
                        'gross_deduction' => $gross_deduction,
                        'net_salary' => $net_salary,
                        'payment_date' => $payment_date,
                        'salary_month' => $salary_month,
                        'pay_slip_late_day_salary_deduct' => $pay_slip_late_day_salary_deduct,
                    ]);

                    $pdf->download('paySlip.pdf');
                }
            }


            //pdf generating and sending sending via email code ends here..
        }
    }

    public function paymentHistoryDelete(Request $request)
    {
        try {

            $payslip = PaySlip::where('id', $request->id)->delete();

            $monthly_attendance = MonthlyAttendance::find($request->monthly_attendance_row_id);
            $monthly_attendance->monthly_payment_status = $request->monthly_attendanc_payment_status;
            $monthly_attendance->save();

            return redirect()->route('department-wise-employee-payments')->with('message', 'Successfully Remove');
        } catch (\Exception $e) {
            return redirect()->route('department-wise-employee-payments')->with('message', 'Something Went Wrong');
        }
    }
    public function paymentFestivalBounus(Request $request)
    {
        try {

            $festival_payments = new FestivalPayment();

            $festival_payments->festival_payment_com_id = Auth::user()->com_id;
            $festival_payments->festival_payment_emp_id = $request->festival_payment_emp_id;
            $festival_payments->festival_payment_department_id = $request->festival_payment_department_id;
            $festival_payments->festival_payment_date = $request->festival_payment_date;
            $festival_payments->festival_payment_amount = $request->festival_payment_amount;
            $festival_payments->festival_payment_percentage = $request->festival_payment_percentage;
            $festival_payments->status = $request->festival_payment_status;
            $festival_payments->festival_payment_bank_account_id = $request->festival_payment_bank_account_id;
            $festival_payments->festival_payment_tax_deduction = $request->festival_payment_tax_deduction;
            $festival_payments->festival_payment_bonus_id = $request->festival_payment_bonus_id;
            $festival_payments->festival_payment_net_bonus = $request->festival_payment_net_bonus;

            $festival_payments->save();


            $employee_detail = User::where('id', $request->festival_payment_emp_id)->first();


            $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);
            $festival_bounus_percentage = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_percentage']);

            $salary_config = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first();

            $data["email"] = $employee_detail->email;
            $data["client_name"] = $employee_detail->first_name . ' ' . $employee_detail->last_name;
            $data["subject"] = "Purpose of Bounus Payment";
            $data["stuff_id"] = $employee_detail->company_assigned_id;
            $data["bank_name"] = $employee_detail->bankaccount->bank_name;
            $data["bank_account_number"] = $employee_detail->bankaccount->bank_account_number;
            $data["payment_date"] = $request->festival_payment_date;
            $data["festival_payment_amount"] = $request->festival_payment_amount;
            $employee_name = $employee_detail->first_name . " " . $employee_detail->last_name;
            $stuff_id = $employee_detail->company_assigned_id;
            $bank_name = $employee_detail->bankaccount->bank_name;
            $payment_date = $request->festival_payment_date;
            $festival_payment_amount = $request->festival_payment_amount;
            $bank_account_number = $employee_detail->bankaccount->bank_account_number;
            $departments = $employee_detail->userdepartment->department_name;
            $designation_name = $employee_detail->userdesignation->designation_name;
            $employment_type = $employee_detail->employment_type;
            $gross_salary = $employee_detail->gross_salary ?? null;

            $basic_salary = ($employee_detail->gross_salary * $salary_config->salary_config_basic_salary) / 100;

            $festival_config = $festival_config->festival_config_salary_type;

            $festival_bounus_percentage = $festival_bounus_percentage->festival_config_festival_bonus_percentage;

            $company_name = array(
                'company_name' => Auth::user()->company->company_name,
            );
            $festival_config = array(
                'festival_config' => $festival_config,
            );

            $festival_bounus_percentage = array(
                'festival_bounus_percentage' => $festival_bounus_percentage,
            );

            $basic_salary = array(
                'basic_salary' => $basic_salary,
            );

            $gross_salary = array(
                'gross_salary ' => $gross_salary,
            );

            $employment_type = array(
                'employment_type' => $employment_type,
            );

            $employee_name = array(
                'employee_name' => $employee_name,
            );
            $stuff_id = array(
                'stuff_id' => $stuff_id,
            );
            $bank_name = array(
                'bank_name' => $bank_name,
            );
            $bank_account_number = array(
                'bank_account_number' => $bank_account_number,
            );
            $payment_date = array(
                'payment_date' => $payment_date,
            );
            $festival_payment_amount = array(
                'festival_payment_amount' => $festival_payment_amount,
            );

            $departments = array(
                'departments' => $departments,
            );
            $designation_name = array(
                'designation_name' => $designation_name,
            );
            $pdf = PDF::loadView('back-end.premium.emails.festival', [
                'company_name' => $company_name,
                'employee_name' => $employee_name,
                'stuff_id' => $stuff_id,
                'bank_name' => $bank_name,
                'bank_account_number' => $bank_account_number,
                'payment_date' => $payment_date,
                'festival_payment_amount' => $festival_payment_amount,
                'departments' => $departments,
                'designation_name' => $designation_name,
                'employment_type' => $employment_type,
                'gross_salary' => $gross_salary,
                'basic_salary' => $basic_salary,
                'festival_config' => $festival_config,
                'festival_bounus_percentage' => $festival_bounus_percentage,

            ]);

            Mail::send('back-end.premium.emails.festival', [
                'company_name' => $company_name,
                'employee_name' => $employee_name,
                'stuff_id' => $stuff_id,
                'bank_name' => $bank_name,
                'bank_account_number' => $bank_account_number,
                'payment_date' => $payment_date,
                'festival_payment_amount' => $festival_payment_amount,
                'departments' => $departments,
                'designation_name' => $designation_name,
                'employment_type' => $employment_type,
                'gross_salary' => $gross_salary,
                'basic_salary' => $basic_salary,
                'festival_config' => $festival_config,
                'festival_bounus_percentage' => $festival_bounus_percentage,

            ], function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "bounus.pdf");
            });

            return back()->with('message', 'Festival Payment Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Something Went Wrong');
        }
    }

    public function paymentFestivalBounusRemove(Request $request)
    {
        try {

            $monthly_attendance = FestivalPayment::find($request->monthly_attendance_row_id);
            $monthly_attendance->monthly_payment_status = $request->monthly_attendanc_payment_status;
            $monthly_attendance->save();

            return redirect()->route('department-wise-employee-payments')->with('message', 'Successfully Remove');
        } catch (\Exception $e) {
            return redirect()->route('department-wise-employee-payments')->with('message', 'Something Went Wrong');
        }
    }


    public function FestivalBounusPaymentHistory()
    {
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
        $festival_payments = FestivalPayment::with('festivalPaymentUser', 'festivalPaymentDepartment')->where('festival_payment_com_id', Auth::user()->com_id)->where('status', 1)->get();

        return view('back-end.premium.payroll.new-festival-payment.festival-bounus-history', get_defined_vars());

    }

    public function paymentFestivalHistoryDelete(Request $request)
    {
        try {
            $festival_histories = FestivalPayment::find($request->id);
            $festival_histories->status = $request->status;
            $festival_histories->save();

            return redirect()->route('payment-festival-histories')->with('message', 'Successfully Remove');
        } catch (\Exception $e) {
            return redirect()->route('payment-festival-histories')->with('message', 'Something Went Wrong');
        }
    }

    public function paymentFestivalHistorySearchIndex(Request $request)
    {
        if ($request->payment_history_department_id && $request->payment_history_month_year) {
            $last_month = date('m', strtotime($request->payment_history_month_year));
            $previous_month_year = date('Y', strtotime($request->payment_history_month_year));

            $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);

            $festival_payments = FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->where('festival_payment_department_id', $request->payment_history_department_id)
                ->whereMonth('festival_payment_date', '=', $last_month)
                ->whereYear('festival_payment_date', '=', $previous_month_year)
                ->get();

            return view('back-end.premium.payroll.new-festival-payment.festival-bounus-history', get_defined_vars());
        } else {
            $last_month = date('m', strtotime($request->payment_history_month_year));
            $previous_month_year = date('Y', strtotime($request->payment_history_month_year));

            $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);

            $festival_payments = FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)
                ->where('status', 1)
                ->whereMonth('festival_payment_date', '=', $last_month)
                ->whereYear('festival_payment_date', '=', $previous_month_year)
                ->get();

            return view('back-end.premium.payroll.new-festival-payment.festival-bounus-history', get_defined_vars());
        }
    }



    public function MonthWiseFestivalSalarySheetGenerate(Request $request)
    {

        $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);

        $last_month = date('m', strtotime($request->festival_month_year));
        $month_name = date('F', strtotime($request->festival_month_year));
        $previous_month_year = date('Y', strtotime($request->festival_month_year));

        $departments = Department::where('department_com_id', Auth::user()->com_id)->get(['id', 'department_name']);
        $salary_configs = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->first(['salary_config_basic_salary', 'salary_config_conveyance_allowance', 'salary_config_house_rent_allowance', 'salary_config_medical_allowance']);

        $festival_config = FestivalConfig::where('festival_config_com_id', Auth::user()->com_id)->first(['festival_config_festival_bonus_time_duration', 'festival_config_salary_type', 'festival_config_festival_bonus_percentage']);

        $festivalBonus = FestivalBonus::where('festival_bonus_com_id', Auth::user()->com_id)->get();

        $payment_histories = FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)
            ->where('status', 1)
            ->whereMonth('festival_payment_date', '=', $last_month)
            ->whereYear('festival_payment_date', '=', $previous_month_year)
            ->get();

        $payment_title = FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)
            ->where('status', 1)
            ->whereMonth('festival_payment_date', '=', $last_month)
            ->whereYear('festival_payment_date', '=', $previous_month_year)
            ->first();
        $payment_title->festivalPaymentBonus->festival_bonus_title;
        $fileName = "Festival-Bonus-Sheet.pdf";

        $month_year = $request->festival_month_year;

        $mpdf = new \Mpdf\Mpdf([
            'margin_top' => 40,
            'margin_bottom' => 30,
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'L',
        ]);
        $html = \View::make('back-end.premium.emails.festival-salary-sheet', compact('payment_histories', 'month_year', 'salary_configs', 'festival_config', 'month_name', 'previous_month_year'));
        $html = $html->render();

        $logo = url('/uploads/logos/logo.png');

        $htmlHeader = '<html><div>'
            . '<div><img src="' . $logo . '"  style="max-height: 20px; text-align: center; padding-left:0%;"/></div>'
            . '<div id="descriptionCourse" style="padding-left:33%;"><span style="font-size:20px;"> ' . $company_names->company_name . '</div>'
            . '<div id="descriptionClassement" style="padding-left:40%;"><span style="font-size:20px;">Period:  ' . date("F", strtotime($month_year)) . ' ' . date("Y", strtotime($month_year)) . '</span></div>'
            . '<div id="descriptionClassement" style="padding-left:42%;"><span style="font-size:20px;">Bonus sheet for' . $payment_title . '</span></div>'
            . '</div></html>';


        $htmlFooter = '<html><div>'
            . ' <div style="">  <br/> <br/> <br/><br/> ________________ <br/> Prepared By<br/></div>
          <div style="margin-top:-4%; margin-left: 45%;">  _______________<br/>checked By<br/> </div>
          <div style="margin-top:-4%; margin-left: 90%;">  _______________<br/>Approved By<br/></div>'
            . '</div></html>';

        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');

        return back();
    }

    public function MonthWiseExcelSalarySheet(Request $request)
    {
        $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);

        $last_month = date('m', strtotime($request->month_year));
        $previous_month_year = date('Y', strtotime($request->month_year));

        $payment_histories = PaySlip::join('users', 'pay_slips.pay_slip_employee_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('designations', 'users.designation_id', '=', 'designations.id')
            ->join('companies', 'users.com_id', '=', 'companies.id')
            ->select('pay_slips.*', 'users.first_name', 'users.last_name', 'users.joining_date', 'departments.department_name', 'designations.designation_name', 'companies.company_name')
            ->where('pay_slip_com_id', Auth::user()->com_id)
            ->where('pay_slip_status', 1)
            ->whereMonth('pay_slip_month_year', '=', $last_month)
            ->whereYear('pay_slip_month_year', '=', $previous_month_year)
            ->get();


        $fileName = "Salary-Sheet.pdf";
        $month_year = $request->month_year;

        $data['payment_histories'] = $payment_histories;
        $data['month_year'] = $month_year;
        $data['previous_month_year'] = $previous_month_year;

        $exl = Excel::download(new salarySheetExport($data), 'Salary Sheet ' . $data['month_year'] . '.xlsx');
        return $exl;
    }

}
