<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Immigrant;
use App\Models\EmergencyContact;
use App\Models\SocialProfile;
use App\Models\Document;
use App\Models\WorkExperience;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\SalaryConfig;
use App\Models\Commission;
use App\Models\Loan;
use App\Models\StatutoryDeduction;
use App\Models\OtherPayment;
use App\Models\SupportTicket;
use App\Models\OverTime;
use App\Models\Pension;
use App\Models\Attendance;
use App\Models\MonthlyAttendance;
use App\Models\Holiday;
use App\Models\Region;
use App\Models\Role;
use App\Models\AttendanceLocation;
use App\Models\LatetimeConfig;
use App\Models\LateTime;
use App\Models\OfficeShift;
use App\Models\Award;
use App\Models\Travel;
use App\Models\Transfer;
use App\Models\Termination;
use App\Models\Resignation;
use App\Models\Promotion;
use App\Models\Complaint;
use App\Models\Warning;
use App\Models\Leave;
use App\Models\Project;
use App\Models\Task;
use App\Models\PaySlip;
use App\Models\Announcement;
use App\Models\Policy;

//use App\Models\Permission;
//use App\Models\Attendance;
//use App\Models\Leave;
//use App\Models\Holiday;
//use App\Models\Travel;
//use App\Models\Role;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mail;
use Image;
use PDF;
use DateTime;

class ApiControllerTwo extends Controller
{
    public function userMonthWiseAttendance(Request $request){

        $date = new DateTime("now", new \DateTimeZone('Asia/Kolkata') );
        $current_date = $date->format('Y-m-d');
        $month = $date->format('m');
        $year = $date->format('Y');
        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);


        $day_one_string = "01";
        $day_one_year_month_date = $year.'-'.$month.'-'.$day_one_string;
        $day_one_date_wise_day_name = date('D', strtotime($day_one_year_month_date));

        $day_two_string = "02";
        $day_two_year_month_date = $year.'-'.$month.'-'.$day_two_string;
        $day_two_date_wise_day_name = date('D', strtotime($day_two_year_month_date));

        $day_three_string = "03";
        $day_three_year_month_date = $year.'-'.$month.'-'.$day_three_string;
        $day_three_date_wise_day_name = date('D', strtotime($day_three_year_month_date));

        $day_four_string = "04";
        $day_four_year_month_date = $year.'-'.$month.'-'.$day_four_string;
        $day_four_date_wise_day_name = date('D', strtotime($day_four_year_month_date));

        $day_five_string = "05";
        $day_five_year_month_date = $year.'-'.$month.'-'.$day_five_string;
        $day_five_date_wise_day_name = date('D', strtotime($day_five_year_month_date));

        $day_six_string = "06";
        $day_six_year_month_date = $year.'-'.$month.'-'.$day_six_string;
        $day_six_date_wise_day_name = date('D', strtotime($day_six_year_month_date));

        $day_seven_string = "07";
        $day_seven_year_month_date = $year.'-'.$month.'-'.$day_seven_string;
        $day_seven_date_wise_day_name = date('D', strtotime($day_seven_year_month_date));

        $day_eight_string = "08";
        $day_eight_year_month_date = $year.'-'.$month.'-'.$day_eight_string;
        $day_eight_date_wise_day_name = date('D', strtotime($day_eight_year_month_date));

        $day_nine_string = "09";
        $day_nine_year_month_date = $year.'-'.$month.'-'.$day_nine_string;
        $day_nine_date_wise_day_name = date('D', strtotime($day_nine_year_month_date));

        $day_ten_string = "10";
        $day_ten_year_month_date = $year.'-'.$month.'-'.$day_ten_string;
        $day_ten_date_wise_day_name = date('D', strtotime($day_ten_year_month_date));

        $day_eleven_string = "11";
        $day_eleven_year_month_date = $year.'-'.$month.'-'.$day_eleven_string;
        $day_eleven_date_wise_day_name = date('D', strtotime($day_eleven_year_month_date));

        $day_twelve_string = "12";
        $day_twelve_year_month_date = $year.'-'.$month.'-'.$day_twelve_string;
        $day_twelve_date_wise_day_name = date('D', strtotime($day_twelve_year_month_date));

        $day_thirteen_string = "13";
        $day_thirteen_year_month_date = $year.'-'.$month.'-'.$day_thirteen_string;
        $day_thirteen_date_wise_day_name = date('D', strtotime($day_thirteen_year_month_date));

        $day_fourteen_string = "14";
        $day_fourteen_year_month_date = $year.'-'.$month.'-'.$day_fourteen_string;
        $day_fourteen_date_wise_day_name = date('D', strtotime($day_fourteen_year_month_date));

        $day_fifteen_string = "15";
        $day_fifteen_year_month_date = $year.'-'.$month.'-'.$day_fifteen_string;
        $day_fifteen_date_wise_day_name = date('D', strtotime($day_fifteen_year_month_date));

        $day_sixteen_string = "16";
        $day_sixteen_year_month_date = $year.'-'.$month.'-'.$day_sixteen_string;
        $day_sixteen_date_wise_day_name = date('D', strtotime($day_sixteen_year_month_date));

        $day_seventeen_string = "17";
        $day_seventeen_year_month_date = $year.'-'.$month.'-'.$day_seventeen_string;
        $day_seventeen_date_wise_day_name = date('D', strtotime($day_seventeen_year_month_date));

        $day_eighteen_string = "18";
        $day_eighteen_year_month_date = $year.'-'.$month.'-'.$day_eighteen_string;
        $day_eighteen_date_wise_day_name = date('D', strtotime($day_eighteen_year_month_date));

        $day_nineteen_string = "19";
        $day_nineteen_year_month_date = $year.'-'.$month.'-'.$day_nineteen_string;
        $day_nineteen_date_wise_day_name = date('D', strtotime($day_nineteen_year_month_date));

        $day_twenty_string = "20";
        $day_twenty_year_month_date = $year.'-'.$month.'-'.$day_twenty_string;
        $day_twenty_date_wise_day_name = date('D', strtotime($day_twenty_year_month_date));

        $day_twenty_one_string = "21";
        $day_twenty_one_year_month_date = $year.'-'.$month.'-'.$day_twenty_one_string;
        $day_twenty_one_date_wise_day_name = date('D', strtotime($day_twenty_one_year_month_date));

        $day_twenty_two_string = "22";
        $day_twenty_two_year_month_date = $year.'-'.$month.'-'.$day_twenty_two_string;
        $day_twenty_two_date_wise_day_name = date('D', strtotime($day_twenty_two_year_month_date));

        $day_twenty_three_string = "23";
        $day_twenty_three_year_month_date = $year.'-'.$month.'-'.$day_twenty_three_string;
        $day_twenty_three_date_wise_day_name = date('D', strtotime($day_twenty_three_year_month_date));

        $day_twenty_four_string = "24";
        $day_twenty_four_year_month_date = $year.'-'.$month.'-'.$day_twenty_four_string;
        $day_twenty_four_date_wise_day_name = date('D', strtotime($day_twenty_four_year_month_date));

        $day_twenty_five_string = "25";
        $day_twenty_five_year_month_date = $year.'-'.$month.'-'.$day_twenty_five_string;
        $day_twenty_five_date_wise_day_name = date('D', strtotime($day_twenty_five_year_month_date));

        $day_twenty_six_string = "26";
        $day_twenty_six_year_month_date = $year.'-'.$month.'-'.$day_twenty_six_string;
        $day_twenty_six_date_wise_day_name = date('D', strtotime($day_twenty_six_year_month_date));

        $day_twenty_seven_string = "27";
        $day_twenty_seven_year_month_date = $year.'-'.$month.'-'.$day_twenty_seven_string;
        $day_twenty_seven_date_wise_day_name = date('D', strtotime($day_twenty_seven_year_month_date));

        $day_twenty_eight_string = "28";
        $day_twenty_eight_year_month_date = $year.'-'.$month.'-'.$day_twenty_eight_string;
        $day_twenty_eight_date_wise_day_name = date('D', strtotime($day_twenty_eight_year_month_date));

        $day_twenty_nine_string = "29";
        $day_twenty_nine_year_month_date = $year.'-'.$month.'-'.$day_twenty_nine_string;
        $day_twenty_nine_date_wise_day_name = date('D', strtotime($day_twenty_nine_year_month_date));

        $day_thirty_string = "30";
        $day_thirty_year_month_date = $year.'-'.$month.'-'.$day_thirty_string;
        $day_thirty_date_wise_day_name = date('D', strtotime($day_thirty_year_month_date));

        $day_thirty_one_string = "31";
        $day_thirty_one_year_month_date = $year.'-'.$month.'-'.$day_thirty_one_string;
        $day_thirty_one_date_wise_day_name = date('D', strtotime($day_thirty_one_year_month_date));

        //echo $request->monthly_com_id; exit;

        if(MonthlyAttendance::where('monthly_employee_id',$request->monthly_employee_id)->whereMonth('attendance_month', '=',$month)->whereYear('attendance_year', '=',$year)->exists()){
            $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
            ->select('monthly_attendances.*','users.first_name','users.last_name')
            ->where('monthly_employee_id',$request->monthly_employee_id)
            ->where('monthly_com_id',$request->monthly_com_id)
            ->whereMonth('attendance_month', '=',$month)
            ->whereYear('attendance_year', '=',$year)
            ->get();
            $details_array = array();
            foreach($attendances as $attendancesValue){
                
                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_one_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_one_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '02',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id','=',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_two_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '02',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id','=',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_two_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '02',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_two_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '02',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_two_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '02',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '02',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '03',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_three_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '03',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_three_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '03',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_three_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '03',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_three_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '03',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '03',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '04',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id','=',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_four_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '04',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id','=',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_four_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '04',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_four_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '04',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_four_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '04',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '04',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '05',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_five_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '05',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_five_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '05',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_five_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '05',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_five_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '05',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '05',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '06',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_six_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '06',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_six_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '06',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_six_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '06',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_six_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '06',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '06',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '07',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_seven_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '07',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_seven_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '07',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_seven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '07',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_seven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '07',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '07',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '08',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eight_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '08',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eight_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '08',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eight_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '08',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eight_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '08',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '08',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '09',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_nine_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '01',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_nine_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '09',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_nine_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '09',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_nine_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '09',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '09',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '10',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_ten_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '10',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_ten_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '10',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_ten_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '10',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_ten_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '10',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '10',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '11',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eleven_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '11',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eleven_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '11',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eleven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '11',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eleven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '11',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '11',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '12',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twelve_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '12',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twelve_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '12',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twelve_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '12',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twelve_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '12',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '12',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '13',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirteen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '13',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirteen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '13',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'13',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '13',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' =>'13',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '14',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_fourteen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '14',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_fourteen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' =>'14',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_fourteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'14',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_fourteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '14',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '14',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '15',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_fifteen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '15',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_fifteen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '15',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_fifteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '15',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_fifteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '15',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' =>'15',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '16',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_sixteen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>  '16',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_sixteen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '16',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_sixteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>  '16',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_sixteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '16',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' =>  '16',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '17',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_seventeen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'17',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_seventeen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '17',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_seventeen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'17',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_seventeen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'17',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' =>'17',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '18',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eighteen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '18',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eighteen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' =>'18',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eighteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'18',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eighteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>'18',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' =>'18',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '19',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_nineteen_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '19',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_nineteen_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '19',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_nineteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '19',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_nineteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '19',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '19',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '20',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '20',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '20',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '20',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' =>  '20',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' =>  '20',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '21',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_one_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '21',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '21',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '21',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '21',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '21',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '22',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_two_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '22',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '22',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '22',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '22',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '22',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '23',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_three_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '23',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '23',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '23',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '23',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '23',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '24',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_four_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '24',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '24',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '24',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '24',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '24',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '25',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_five_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '25',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '25',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '25',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '25',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '25',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '26',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_six_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '26',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '26',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '26',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '26',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '26',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '27',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_seven_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '27',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '27',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '27',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '27',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_one' => '27',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '28',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_eight_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '28',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '28',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '28',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '28',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '28',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '29',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_nine_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '29',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '29',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '29',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '29',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '29',
                            'status' => 'A',
                        ));
                    } 

                    if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                        array_push($details_array,$data=array(
                            'day_number' => '30',
                            'status' => 'P',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirty_date_wise_day_name)->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '30',
                            'status' => 'W',
                        ));
                    }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirty_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                        array_push($details_array,$data=array(
                            'day_number' => '30',
                            'status' => 'W',
                        ));
                    }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirty_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '30',
                            'status' => 'L',
                        ));
                     }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirty_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                        array_push($details_array,$data=array(
                            'day_number' => '30',
                            'status' => 'T',
                        ));
                    }else{ 
                        array_push($details_array,$data=array(
                            'day_number' => '30',
                            'status' => 'A',
                        ));
                    } 
                    
                    if($days > 30){
                        
                        if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out', '=',1)->exists()){ 
                            array_push($details_array,$data=array(
                                'day_number' => '31',
                                'status' => 'P',
                            ));
                        }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirty_one_date_wise_day_name)->exists()) { 
                            array_push($details_array,$data=array(
                                'day_number' => '31',
                                'status' => 'W',
                            ));
                        }elseif(Holiday::where('holiday_com_id',$request->monthly_com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `start_date` and `end_date`')->exists()) {
                            array_push($details_array,$data=array(
                                'day_number' => '31',
                                'status' => 'W',
                            ));
                        }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { 
                            array_push($details_array,$data=array(
                                'day_number' => '31',
                                'status' => 'L',
                            ));
                         }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { 
                            array_push($details_array,$data=array(
                                'day_number' => '31',
                                'status' => 'T',
                            ));
                        }else{ 
                            array_push($details_array,$data=array(
                                'day_number' => '31',
                                'status' => 'A',
                            ));
                        } 
                        
                    }


            }
            return response()->json([
                'success' => true,
                'data'=>$details_array
            ])->setStatusCode(200);  
        }else{
            return response()->json([
                'success' => false,
            ])->setStatusCode(200);  
        }



    }
    
   
}
