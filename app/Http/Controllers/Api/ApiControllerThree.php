<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\Notification;
use App\Models\Travel;
use App\Models\SupportTicket;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mail;
use Image;
use PDF;
use DateTime;

class ApiControllerThree extends Controller
{

    public function userLeaveRequestSending(Request $request)
	{

            $validator = \Validator::make($request->all(),
             [   
                'com_id' => 'required',
                'employee_id' => 'required',
                'leave_type' => 'required',
                'leave_reason' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            
            $details_array = array();
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(Leave::where('leaves_employee_id',$request->employee_id)->exists()){
    
                $logged_user_details = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id') 
                ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->select('leaves.*','users.first_name','users.last_name','departments.department_name', 'designations.designation_name','regions.region_name', 'areas.area_name','territories.territory_name','towns.town_name','db_houses.db_house_name','leave_types.leave_type')
                ->where('leaves_employee_id',$request->employee_id)
                ->get();
    
                foreach($logged_user_details as $logged_user_details_value){
        
                         array_push($details_array,$data=array(
                            'id' => $logged_user_details_value->id,
                            'leaves_leave_type_name' => $logged_user_details_value->leave_type,
                            'leaves_department_name' => $logged_user_details_value->department_name,
                            'leaves_designation_name' => $logged_user_details_value->designation_name,
                            'leaves_employee_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
                            'leaves_approver_generation_one_id' => $logged_user_details_value->leaves_approver_generation_one_id,
                            'leaves_approver_generation_two_id' => $logged_user_details_value->leaves_approver_generation_two_id,
                            'leaves_start_date' => $logged_user_details_value->leaves_start_date,
                            'leaves_end_date' => $logged_user_details_value->leaves_end_date,
                            'total_days' => $logged_user_details_value->total_days,
                            'leave_reason' => $logged_user_details_value->leave_reason,
                            'leaves_status' => $logged_user_details_value->leaves_status,
                            'leaves_region_name' => $logged_user_details_value->region_name,
                            'leaves_area_name' => $logged_user_details_value->area_name,
                            'leaves_territory_name' => $logged_user_details_value->territory_name,
                            'leaves_town_name' => $logged_user_details_value->town_name,
                            'leaves_db_house_name' => $logged_user_details_value->db_house_name,
                            'is_half' => $logged_user_details_value->is_half,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                }
    
            }else{
                
                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'leaves_leave_type_id' => 0,
                //     'leaves_leave_type_name' => "-",
                //     'leaves_department_name' => "-",
                //     'leaves_designation_name' =>"-",
                //     'leaves_employee_name' => "-",
                //     'leaves_start_date' => "-",
                //     'leaves_end_date' =>  "-",
                //     'total_days' =>  "-",
                //     'leave_reason' => "-",
                //     'leaves_status' =>  "-",
                //     'leaves_region_name' => "-",
                //     'leaves_area_name' => "-",
                //     'leaves_territory_name' =>"-",
                //     'leaves_town_name' => "-",
                //     'leaves_db_house_name' => "-",
                //     'is_half' =>  "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));
    
            }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                
 
            if(!$request->employee_id){

                return response()->json([
                'success' => false,
                'message'=>'Employee id field is missing!!!',
                'data' => $details_array,
                 ])->setStatusCode(200);
                
            }
            if(!$request->leave_type){

                return response()->json([
                'success' => false,
                'message'=>'leave type field is missing!!!',
                'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->leave_reason){

            return response()->json([
                'success' => false,
                 'message'=>'leave reason field is missing!!!',
                'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->start_date){

                return response()->json([
                'success' => false,
                'message'=>'start date field is missing!!!',
                'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->end_date){

                return response()->json([
                    'success' => false,
                    'message'=>'end date field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
    
            if ($validator->fails()) {
    
                return response()->json([
                    'success' => false,
                    'message'=>'Some form fields are missing!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
                 
    
                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]); 
            }
            
            $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
            $current_date = $date->format('Y-m-d');

            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
    
            ############### start date and end date should be this month code starts###########
            $requested_start_time=strtotime($start_date);
            $requested_start_time_month = date("m",$requested_start_time);
            $requested_start_time_year = date("Y",$requested_start_time);

            $requested_end_time=strtotime($end_date);
            $requested_end_time_month = date("m",$requested_end_time);
            $requested_end_time_year = date("Y",$requested_end_time);

            $current_month = date('m');
            $current_year = date('Y');
            
            if($request->is_half){
                //No need to check attendance
                if($start_date != $end_date){

                return response()->json([
                    'success' => false,
                     'message' => 'Half leave is allowed only for a single date!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
            
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'Half leave is allowed only for a single date!!!',
                    // ])->setStatusCode(200);
                }
            }else{
                if (($current_date >= $start_date) && ($current_date <= $end_date)){   
                    // echo "Current date is between two dates";
                     if(Attendance::where('attendance_com_id',$request->com_id)->where('employee_id',$request->employee_id)->where('check_in_out',1)->where('attendance_date',$current_date)->exists()){ //condition for attendance existence for this date

                        return response()->json([
                            'success' => false,
                            'message' => 'You are not permitted to send this leave request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!',
                            'data' => $details_array,
                         ])->setStatusCode(200);
                      
                      
                    //   return response()->json([
                    //         'success' => false,
                    //         'message' => 'You are not permitted to send this leave request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!',
                    //     ])->setStatusCode(200);
                     }
                }else{    
                    //echo "Current date is not between two dates";  
                }
            }
            
            // if($current_month == $requested_start_time_month && $current_year == $requested_start_time_year && $current_month == $requested_end_time_month && $current_year == $requested_end_time_year){
            //     //skip
            // } else {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Start Date and End Date Should Be In This Month',
            //     ])->setStatusCode(200);
            // }


            ############### start date and end date should be this month code ends ###########

            ############### remaining days checking code starts###########

            $alocated_leave_days = LeaveType::where('id',$request->leave_type)->get(['allocated_day']);

            $number_of_allocated_leave_days = 0;

            foreach($alocated_leave_days as $alocated_leave_days_value){

                $number_of_allocated_leave_days += $alocated_leave_days_value->allocated_day;

            }

            $current_year = date("Y");
            
            $approvel_leave_days_of_this_year = Leave::where('leaves_employee_id',$request->employee_id)->whereYear('leaves_start_date','=',$current_year)->where('leaves_leave_type_id','=',$request->leave_type)->where('leaves_status','=','Approved')->get();
        
            $number_of_approved_leave_days = 0;

            foreach($approvel_leave_days_of_this_year as $approvel_leave_days_of_this_year_value){

                $diff = strtotime($approvel_leave_days_of_this_year_value->leaves_end_date) - strtotime($approvel_leave_days_of_this_year_value->leaves_start_date);
                $days = abs(round($diff / 86400));
                $number_of_approved_leave_days += $days + 1;

            }

            function dateDiffInDays($date1, $date2) 
            {
                $diff = strtotime($date2) - strtotime($date1);
                return abs(round($diff / 86400));
            }
            
            // Start date
            $date1 = $start_date;
            // End date
            $date2 = $end_date;
            
            $dateDiff = dateDiffInDays($date1, $date2);

            $number_of_requested_leave_days = $dateDiff + 1;

            // echo $number_of_approved_leave_days; 
            // echo $number_of_allocated_leave_days; 
            
            //exit;

            if($number_of_approved_leave_days >= $number_of_allocated_leave_days){
                
                    return response()->json([
                        'success' => false,
                         'message' => 'You have already taken all the leaves!!!',
                        'data' => $details_array,
                         ])->setStatusCode(200);
                         
                // return response()->json([
                //     'success' => false,
                //     'message' => 'You have already taken all the leaves!!!',
                // ])->setStatusCode(200);
            }else{

                $leave_days_remaining = $number_of_allocated_leave_days - $number_of_approved_leave_days;
                if($number_of_requested_leave_days >= $leave_days_remaining){
                    //return back()->with('message','Sorry, Limit Exceed!!! You can not take a leave for more than '.$leave_days_remaining.' days in this year!!!');
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, Limit Exceed!!!',
                        'data' => $details_array,
                         ])->setStatusCode(200);
                         
                         
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'Sorry, Limit Exceed!!!',
                    // ])->setStatusCode(200);
                }

            }


        ############### remaining days checking code ends###########


        ############### random key generate code starts###########

        function generateRandomString($length = 25) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $random_key = generateRandomString().$request->employee_id;

        ############### random key generate code ends here###########

                $users = User::where('id','=',$request->employee_id)->get(['report_to_parent_id','email','first_name','last_name','department_id','designation_id','region_id','area_id','territory_id','town_id','db_house_id']);

                foreach($users as $users){

                    if($users->department_id == '' || $users->department_id == Null || 
                    $users->designation_id == '' || $users->designation_id == Null || 
                    $users->region_id == '' || $users->region_id == Null || 
                    $users->area_id == '' || $users->area_id == Null || 
                    $users->territory_id == '' || $users->territory_id == Null || 
                    $users->town_id == '' || $users->town_id == Null || 
                    $users->db_house_id == '' || $users->db_house_id == Null
                
                    ){
                        
                    return response()->json([
                        'success' => false,
                        'message' => 'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly',
                        'data' => $details_array,
                         ])->setStatusCode(200);
                         
                         
                        // return response()->json([
                        //     'success' => false,
                        //     'message' => 'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly',
                        // ])->setStatusCode(200);
                    }

                    if($users->report_to_parent_id == '' || $users->report_to_parent_id == NULL){
        
                        return response()->json([
                            'success' => false,
                             'message' => 'First Supervisor Not Set Yet!!!',
                            'data' => $details_array,
                         ])->setStatusCode(200);
                         
                         
                        // return response()->json([
                        //     'success' => false,
                        //     'message' => 'First Supervisor Not Set Yet!!!',
                        // ])->setStatusCode(200);
                    }else{
                        //echo $users->report_to_parent_id; exit;
                    
                        if(User::where('id','=',$users->report_to_parent_id)->exists()){
                            //skip
                        }else{
            
                            return response()->json([
                                'success' => false,
                                 'message' => 'First Supervisor Not Found!!!',
                                'data' => $details_array,
                             ])->setStatusCode(200);
                         
                         
                            // return response()->json([
                            //     'success' => false,
                            //     'message' => 'First Supervisor Not Found!!!',
                            // ])->setStatusCode(200);
                        }

                        $generation_one_details = User::where('id','=',$users->report_to_parent_id)->get(['report_to_parent_id','email']);
                        foreach($generation_one_details as $generation_one_details_value){

                                $leave = new Leave();
                                $leave->leaves_token = $random_key;
                                $leave->leaves_company_id = $request->com_id;
                                $leave->leaves_leave_type_id = $request->leave_type;
                                $leave->leaves_department_id = $users->department_id;
                                $leave->leaves_designation_id = $users->designation_id;
                                $leave->leaves_employee_id = $request->employee_id;
                                $leave->leaves_approver_generation_one_id = $users->report_to_parent_id;
                                $leave->leaves_approver_generation_two_id = $generation_one_details_value->report_to_parent_id;
                                $leave->leaves_start_date = $start_date;
                                $leave->leaves_end_date = $end_date;
                                $leave->total_days = $number_of_requested_leave_days;
                                $leave->leave_reason = $request->leave_reason;
                                $leave->leaves_status = "Pending";
                                $leave->leaves_region_id = $users->region_id;
                                $leave->leaves_area_id = $users->area_id;
                                $leave->leaves_territory_id = $users->territory_id;
                                $leave->leaves_town_id = $users->town_id;
                                $leave->leaves_db_house_id = $users->db_house_id;
                                $leave->is_half = $request->is_half;
                                $leave->save();

                                if($generation_one_details_value->report_to_parent_id == '' || $generation_one_details_value->report_to_parent_id == NULL){

                                        $notification = new Notification();
                                        $notification->notification_token = $random_key;
                                        $notification->notification_com_id = $request->com_id;
                                        $notification->notification_type = "Leave";
                                        $notification->notification_title = "You Have A New Leave Request To Approve";
                                        $notification->notification_from = $request->employee_id;
                                        $notification->notification_to = $users->report_to_parent_id;
                                        $notification->notification_status = "Unseen";
                                        $notification->save();
                                        //echo $generation_one_details_value->email; exit;
                                        $data["email"]= $generation_one_details_value->email;
                                        $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                        $data["subject"] = "Leave Request";
                    
                                        $sender_name = array(
                                            'pay_slip_net_salary' => $data["request_sender_name"],
                                            );
                    
                                        Mail::send('back-end.premium.emails.leave-request',[
                                            'sender_name' => $sender_name,
                                    ], function($message)use($data) {
                                        $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                        });

                                }else{

                                    if(User::where('id','=',$generation_one_details_value->report_to_parent_id)->exists()){
                                        //skip
                                    }else{

                                        $notification = new Notification();
                                        $notification->notification_token = $random_key;
                                        $notification->notification_com_id = $request->com_id;
                                        $notification->notification_type = "Leave";
                                        $notification->notification_title = "You Have A New Leave Request To Approve";
                                        $notification->notification_from = $request->employee_id;
                                        $notification->notification_to = $users->report_to_parent_id;
                                        $notification->notification_status = "Unseen";
                                        $notification->save();
                                        //echo $generation_one_details_value->email; exit;
                                        $data["email"]= $generation_one_details_value->email;
                                        $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                        $data["subject"] = "Leave Request";
                    
                                        $sender_name = array(
                                            'pay_slip_net_salary' => $data["request_sender_name"],
                                            );
                    
                                        Mail::send('back-end.premium.emails.leave-request',[
                                            'sender_name' => $sender_name,
                                    ], function($message)use($data) {
                                        $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                        });
                                        
                                        return response()->json([
                                            'success' => false,
                                            'message' => 'Request Sent To The First Supervisor!!! But The Seconnd Supervisor Not Set Yet!!!',
                                            'data' => $details_array,
                                             ])->setStatusCode(200);
                             
                             
                                        // return response()->json([
                                        //     'success' => false,
                                        //     'message' => 'Request Sent To The First Supervisor!!! But The Seconnd Supervisor Not Set Yet!!!',
                                        // ])->setStatusCode(200);
                                    }

                                    $notification = new Notification();
                                    $notification->notification_token = $random_key;
                                    $notification->notification_com_id =$request->com_id;
                                    $notification->notification_type = "Leave";
                                    $notification->notification_title = "You Have A New Leave Request To Approve";
                                    $notification->notification_from = $request->employee_id;
                                    $notification->notification_to = $users->report_to_parent_id;
                                    $notification->notification_status = "Unseen";
                                    $notification->save();
            
                                    $notification_second = new Notification();
                                    $notification_second->notification_token = $random_key;
                                    $notification_second->notification_com_id = $request->com_id;
                                    $notification_second->notification_type = "Leave";
                                    $notification_second->notification_title = "You Have A New Leave Request To Approve";
                                    $notification_second->notification_from = $request->employee_id;
                                    $notification_second->notification_to = $generation_one_details_value->report_to_parent_id;
                                    $notification_second->notification_status = "Unseen";
                                    $notification_second->save();

                                    $generation_two_details = User::where('id','=',$generation_one_details_value->report_to_parent_id)->get('email');

                                    foreach($generation_two_details as $generation_two_details_value){

                                                ######## first generation email##########
                                                $data["email"]= $generation_one_details_value->email;
                                                $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                                $data["subject"] = "Leave Request";
                            
                                                $sender_name = array(
                                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                                    );
                            
                                                Mail::send('back-end.premium.emails.leave-request',[
                                                    'sender_name' => $sender_name,
                                            ], function($message)use($data) {
                                                $message->to($data["email"], $data["request_sender_name"])
                                                ->subject($data["subject"]);
                                                });

                                                ######## first generation email ends##########

                                                ######## second generation email##########
                                                $data["email"]= $generation_two_details_value->email;
                                                $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                                $data["subject"] = "Leave Request";
                            
                                                $sender_name = array(
                                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                                    );
                            
                                                Mail::send('back-end.premium.emails.leave-request',[
                                                    'sender_name' => $sender_name,
                                            ], function($message)use($data) {
                                                $message->to($data["email"], $data["request_sender_name"])
                                                ->subject($data["subject"]);
                                                });
                    
                                                ######## second generation email ends##########

                                    }


                                }
                        
                        }
                        
                        
                        
                        ////////////////////////////////////////////////////////////////////////////////////////////////////
                                    $details_array2 = [];
                        
                                    if(Leave::where('leaves_employee_id',$request->employee_id)->exists()){
                            
                                        $logged_user_details = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                                        ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                                        ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id') 
                                        ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                                        ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                                        ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                                        ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                                        ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                                        ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                                        ->select('leaves.*','users.first_name','users.last_name','departments.department_name', 'designations.designation_name','regions.region_name', 'areas.area_name','territories.territory_name','towns.town_name','db_houses.db_house_name','leave_types.leave_type')
                                        ->where('leaves_employee_id',$request->employee_id)
                                        ->get();
                            
                                        foreach($logged_user_details as $logged_user_details_value){
                                
                                                 array_push($details_array2,$data=array(
                                                    'id' => $logged_user_details_value->id,
                                                    'leaves_leave_type_name' => $logged_user_details_value->leave_type,
                                                    'leaves_department_name' => $logged_user_details_value->department_name,
                                                    'leaves_designation_name' => $logged_user_details_value->designation_name,
                                                    'leaves_employee_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
                                                    'leaves_start_date' => $logged_user_details_value->leaves_start_date,
                                                    'leaves_end_date' => $logged_user_details_value->leaves_end_date,
                                                    'total_days' => $logged_user_details_value->total_days,
                                                    'leave_reason' => $logged_user_details_value->leave_reason,
                                                    'leaves_status' => $logged_user_details_value->leaves_status,
                                                    'leaves_region_name' => $logged_user_details_value->region_name,
                                                    'leaves_area_name' => $logged_user_details_value->area_name,
                                                    'leaves_territory_name' => $logged_user_details_value->territory_name,
                                                    'leaves_town_name' => $logged_user_details_value->town_name,
                                                    'leaves_db_house_name' => $logged_user_details_value->db_house_name,
                                                    'is_half' => $logged_user_details_value->is_half,
                                                    'created_at' => $logged_user_details_value->created_at,
                                                    'updated_at' => $logged_user_details_value->updated_at,
                                                ));
                                        }
                                        
                                        
                            
                                        return response()->json([
                                            'success' => true,
                                            'message' => 'Request Sent!!!',
                                            'data' => $details_array2,
                                             ])->setStatusCode(200);
                            
                                    }else{

                            
                                        return response()->json([
                                            'success' => true,
                                            'message' => 'Request Sent!!!',
                                            'data' => $details_array,
                                             ])->setStatusCode(200);
                            
                                    }
                        //////////////////////////////////////////////////////////////////////
                        
          
                                             
                        // return response()->json([
                        //     'success' => true,
                        //     'message' => 'Request Sent!!!',
                        // ])->setStatusCode(200);
                    }

                
                }


	}




    public function userTravelRequestSending(Request $request)
	{

        // $validated = $request->validate([
        //     'com_id' => 'required',
        //     'travel_department_id' => 'required',
        //     'travel_employee_id' => 'required',
        //     'travel_arrangement_type' => 'required',
        //     'travel_purpose' => 'required',
        //     'travel_place' => 'required',
        //     'travel_desc' => 'required',
        //     'travel_start_date' => 'required',
        //     'travel_end_date' => 'required',
        //     'travel_expected_budget' => 'required',
        //     //'travel_actual_budget' => 'required',
        //     'travel_mode' => 'required',
        //     //'travel_status' => 'required',
        // ]);
        
            $validator = \Validator::make($request->all(),
             [   
            'com_id' => 'required',
            'travel_department_id' => 'required',
            'travel_employee_id' => 'required',
            'travel_arrangement_type' => 'required',
            'travel_purpose' => 'required',
            'travel_place' => 'required',
            'travel_desc' => 'required',
            'travel_start_date' => 'required',
            'travel_end_date' => 'required',
            'travel_expected_budget' => 'required',
            'travel_mode' => 'required',
            ]);
            
            $details_array = array();
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(Travel::where('travel_employee_id',$request->travel_employee_id)->exists()){
    
                //$logged_user_details = Travel::where('travel_employee_id',$request->travel_employee_id)->get();
                $logged_user_details = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments','travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*','users.first_name','users.last_name','departments.department_name')
                ->where('travel_employee_id',$request->travel_employee_id)
                ->get();
    
                foreach($logged_user_details as $logged_user_details_value){
        
                         array_push($details_array,$data=array(
                            'id' => $logged_user_details_value->id,
                            'travel_token' => $logged_user_details_value->travel_token,
                            'travel_com_id' => $logged_user_details_value->travel_com_id,
                            'travel_department_id' => $logged_user_details_value->travel_department_id,
                            'travel_employee_full_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
                            'travel_employee_department_name' => $logged_user_details_value->department_name,
                            'travel_employee_id' => $logged_user_details_value->travel_employee_id,
                            'travel_approver_generation_one_id' => $logged_user_details_value->travel_approver_generation_one_id,
                            'travel_approver_generation_two_id' => $logged_user_details_value->travel_approver_generation_two_id,
                            'travel_arrangement_type' => $logged_user_details_value->travel_arrangement_type,
                            'travel_purpose' => $logged_user_details_value->travel_purpose,
                            'travel_place' => $logged_user_details_value->travel_place,
                            'travel_desc' => $logged_user_details_value->travel_desc,
                            'travel_start_date' => $logged_user_details_value->travel_start_date,
                            'travel_end_date' => $logged_user_details_value->travel_end_date,
                            'travel_expected_budget' => $logged_user_details_value->travel_expected_budget,
                            'travel_actual_budget' => $logged_user_details_value->travel_actual_budget,
                            'travel_mode' => $logged_user_details_value->travel_mode,
                            'travel_status' => $logged_user_details_value->travel_status,
                            'created_at' =>"-",
                            'updated_at' => "-",
                        ));
                }
     
    
            }else{
                
                // array_push($details_array, $data=array(
                //     'id' =>0,
                //     'travel_token' => 0,
                //     'travel_com_id' => 0,
                //     'travel_department_id' => 0,
                //     'travel_employee_id' => 0,
                //     'travel_employee_full_name' => "-",
                //     'travel_employee_department_name' => "-",
                //     'travel_approver_generation_one_id' => 0,
                //     'travel_approver_generation_two_id' => 0,
                //     'travel_arrangement_type' => "-",
                //     'travel_purpose' => "-",
                //     'travel_place' => "-",
                //     'travel_desc' => "-",
                //     'travel_start_date' => "-",
                //     'travel_end_date' => "-",
                //     'travel_expected_budget' => "-",
                //     'travel_actual_budget' => "-",
                //     'travel_mode' => "-",
                //     'travel_status' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));
    
            } 
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            if(!$request->travel_department_id){

                return response()->json([
                    'success' => false,
                    'message'=>'travel department id field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
                
            }
            if(!$request->travel_employee_id){


                return response()->json([
                    'success' => false,
                    'message'=>'travel employee id field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->travel_arrangement_type){

                return response()->json([
                    'success' => false,
                    'message'=>'travel arrangement type field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->travel_purpose){

                return response()->json([
                    'success' => false,
                     'message'=>'travel purpose field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->travel_place){

                return response()->json([
                    'success' => false,
                    'message'=>'travel place field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->travel_desc){

                return response()->json([
                    'success' => false,
                    'message'=>'travel desc field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->travel_start_date){

                return response()->json([
                    'success' => false,
                    'message'=>'travel start date field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->travel_end_date){
  
            return response()->json([
                'success' => false,
                'message'=>'travel end date field is missing!!!',
                'data' => $details_array,
                 ])->setStatusCode(200);
            }
            if(!$request->travel_expected_budget){

                return response()->json([
                    'success' => false,
                    'message'=>'travel expected budget field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            if(!$request->travel_mode){

                return response()->json([
                    'success' => false,
                    'message'=>'travel mode field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            
            
    
            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message'=>'Some form fields are missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
                 
                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]); 
            }
        
        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
        $current_date = $date->format('Y-m-d');

        $start_date = date('Y-m-d', strtotime($request->travel_start_date));
        $end_date = date('Y-m-d', strtotime($request->travel_end_date));

        ############### random key generate code starts###########
        function generateRandomString($length = 25) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $random_key = generateRandomString();
        ############### random key generate code staendsrts###########
        
            if(($current_date >= $start_date) && ($current_date <= $end_date)){   
            // echo "Current date is between two dates";
                if(Attendance::where('attendance_com_id',$request->com_id)->where('employee_id',$request->travel_employee_id)->where('check_in_out',1)->where('attendance_date',$current_date)->exists()){ //condition for travel aprovements
                   
                    return response()->json([
                        'success' => false,
                        'message'=>'You are not permitted to send this travel request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!',
                        'data' => $details_array,
                     ])->setStatusCode(200);
                 
                    //return back()->with('message','You are not permitted to send this travel request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!');
                }
            }else{    
            //echo "Current date is not between two dates";  
            }

            $users = User::where('id','=',$request->travel_employee_id)->get(['report_to_parent_id','email','first_name','last_name','department_id','designation_id','region_id','area_id','territory_id','town_id','db_house_id']);

            foreach($users as $users){

                 
    
                if($users->department_id == '' || $users->department_id == Null || 
                $users->designation_id == '' || $users->designation_id == Null || 
                $users->region_id == '' || $users->region_id == Null || 
                $users->area_id == '' || $users->area_id == Null || 
                $users->territory_id == '' || $users->territory_id == Null || 
                $users->town_id == '' || $users->town_id == Null || 
                $users->db_house_id == '' || $users->db_house_id == Null
               
                ){

                    return response()->json([
                    'success' => false,
                    'message'=>'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
                     
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly',
                    // ])->setStatusCode(200);
                }
    
                if($users->report_to_parent_id == '' || $users->report_to_parent_id == Null || $users->report_to_parent_id == NULL){
    
                    return response()->json([
                    'success' => false,
                    'message'=>'First Supervisor Not Set Yet!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
                     
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'First Supervisor Not Set Yet!!!',
                    // ])->setStatusCode(200);
                }else{

                    if(User::where('id','=',$users->report_to_parent_id)->exists()){
                        //skip
                    }else{
                        
                    return response()->json([
                    'success' => false,
                    'message'=>'First Supervisor Not Found!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
                     
                     
                        // return response()->json([
                        //     'success' => false,
                        //     'message' => 'First Supervisor Not Found!!!',
                        // ])->setStatusCode(200);
                    }

                    $generation_one_details = User::where('id','=',$users->report_to_parent_id)->get(['report_to_parent_id','email']);
                    foreach($generation_one_details as $generation_one_details_value){
    
                            $travel = new Travel();
                            $travel->travel_token = $random_key;
                            $travel->travel_com_id = $request->com_id;
                            $travel->travel_department_id = $request->travel_department_id;
                            $travel->travel_employee_id = $request->travel_employee_id;
                            $travel->travel_approver_generation_one_id = $users->report_to_parent_id;
                            $travel->travel_approver_generation_two_id = $generation_one_details_value->report_to_parent_id;
                            $travel->travel_arrangement_type = $request->travel_arrangement_type;
                            $travel->travel_purpose = $request->travel_purpose;
                            $travel->travel_place = $request->travel_place;
                            $travel->travel_desc = $request->travel_desc;
                            $travel->travel_start_date = $start_date;
                            $travel->travel_end_date = $end_date;
                            $travel->travel_expected_budget = $request->travel_expected_budget;
                            $travel->travel_actual_budget = 0;
                            $travel->travel_mode = $request->travel_mode;
                            $travel->travel_status = "Pending";
                            $travel->save();
    
                            if($generation_one_details_value->report_to_parent_id == '' || $generation_one_details_value->report_to_parent_id == Null){

                                    $notification = new Notification();
                                    $notification->notification_token = $random_key;
                                    $notification->notification_com_id = $request->com_id;
                                    $notification->notification_type = "Travel";
                                    $notification->notification_title = "You Have A New Travel Request To Approve";
                                    $notification->notification_from = $request->travel_employee_id;
                                    $notification->notification_to = $users->report_to_parent_id;
                                    $notification->notification_status = "Unseen";
                                    $notification->save();
                                    
                                    $data["email"]= $generation_one_details_value->email;
                                    $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                    $data["subject"] = "Travel Request";
                
                                    $sender_name = array(
                                        'pay_slip_net_salary' => $data["request_sender_name"],
                                        );
                
                                    Mail::send('back-end.premium.emails.travel-request',[
                                        'sender_name' => $sender_name,
                                ], function($message)use($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                                    });
    
                            }else{

                                if(User::where('id','=',$generation_one_details_value->report_to_parent_id)->exists()){
                                    //skip
                                }else{

                                    $notification = new Notification();
                                    $notification->notification_token = $random_key;
                                    $notification->notification_com_id = $request->com_id;
                                    $notification->notification_type = "Travel";
                                    $notification->notification_title = "You Have A New Travel Request To Approve";
                                    $notification->notification_from = $request->travel_employee_id;
                                    $notification->notification_to = $users->report_to_parent_id;
                                    $notification->notification_status = "Unseen";
                                    $notification->save();

                                    ######## first generation email##########
                                    $data["email"]= $generation_one_details_value->email;
                                    $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                    $data["subject"] = "Travel Request";
                
                                    $sender_name = array(
                                        'pay_slip_net_salary' => $data["request_sender_name"],
                                        );
                
                                    Mail::send('back-end.premium.emails.travel-request',[
                                        'sender_name' => $sender_name,
                                ], function($message)use($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                                    });

                                    ######## first generation email ends##########
                    
                                    return response()->json([
                                    'success' => false,
                                    'message' => 'Request Sent To The First Supervisor!!! But The Seconnd Supervisor Not Set Yet!!!',
                                    'data' => $details_array,
                                     ])->setStatusCode(200);
                     
                                    // return response()->json([
                                    //     'success' => false,
                                    //     'message' => 'Request Sent To The First Supervisor!!! But The Seconnd Supervisor Not Set Yet!!!',
                                    // ])->setStatusCode(200);
                                }

                                $notification = new Notification();
                                $notification->notification_token = $random_key;
                                $notification->notification_com_id = $request->com_id;
                                $notification->notification_type = "Travel";
                                $notification->notification_title = "You Have A New Travel Request To Approve";
                                $notification->notification_from = $request->travel_employee_id;
                                $notification->notification_to = $users->report_to_parent_id;
                                $notification->notification_status = "Unseen";
                                $notification->save();
    
                                $notification_second = new Notification();
                                $notification_second->notification_token = $random_key;
                                $notification_second->notification_com_id = $request->com_id;
                                $notification_second->notification_type = "Travel";
                                $notification_second->notification_title = "You Have A New Travel Request To Approve";
                                $notification_second->notification_from = $request->travel_employee_id;
                                $notification_second->notification_to = $generation_one_details_value->report_to_parent_id;
                                $notification_second->notification_status = "Unseen";
                                $notification_second->save();

    
                                $generation_two_details = User::where('id','=',$generation_one_details_value->report_to_parent_id)->get('email');
    
                                foreach($generation_two_details as $generation_two_details_value){
    
                                            ######## first generation email##########
                                            $data["email"]= $generation_one_details_value->email;
                                            $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                            $data["subject"] = "Travel Request";
                        
                                            $sender_name = array(
                                                'pay_slip_net_salary' => $data["request_sender_name"],
                                                );
                        
                                            Mail::send('back-end.premium.emails.travel-request',[
                                                'sender_name' => $sender_name,
                                        ], function($message)use($data) {
                                            $message->to($data["email"], $data["request_sender_name"])
                                            ->subject($data["subject"]);
                                            });
    
                                            ######## first generation email ends##########
    
                                            ######## second generation email##########
                                            $data["email"]= $generation_two_details_value->email;
                                            $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                            $data["subject"] = "Travel Request";
                        
                                            $sender_name = array(
                                                'pay_slip_net_salary' => $data["request_sender_name"],
                                                );
                        
                                            Mail::send('back-end.premium.emails.travel-request',[
                                                'sender_name' => $sender_name,
                                        ], function($message)use($data) {
                                            $message->to($data["email"], $data["request_sender_name"])
                                            ->subject($data["subject"]);
                                            });
                
                                            ######## second generation email ends##########
                                }
    
                            }
                
                    }
                    
                    
                    
                    
        $details_array2 = [];
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(Travel::where('travel_employee_id',$request->travel_employee_id)->exists()){
    
                //$logged_user_details = Travel::where('travel_employee_id',$request->travel_employee_id)->get();
                $logged_user_details = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments','travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*','users.first_name','users.last_name','departments.department_name')
                ->where('travel_employee_id',$request->travel_employee_id)
                ->get();
    
                foreach($logged_user_details as $logged_user_details_value){
        
                         array_push($details_array2,$data=array(
                            'id' => $logged_user_details_value->id,
                            'travel_token' => $logged_user_details_value->travel_token,
                            'travel_com_id' => $logged_user_details_value->travel_com_id,
                            'travel_department_id' => $logged_user_details_value->travel_department_id,
                            'travel_employee_full_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
                            'travel_employee_department_name' => $logged_user_details_value->department_name,
                            'travel_employee_id' => $logged_user_details_value->travel_employee_id,
                            'travel_approver_generation_one_id' => $logged_user_details_value->travel_approver_generation_one_id,
                            'travel_approver_generation_two_id' => $logged_user_details_value->travel_approver_generation_two_id,
                            'travel_arrangement_type' => $logged_user_details_value->travel_arrangement_type,
                            'travel_purpose' => $logged_user_details_value->travel_purpose,
                            'travel_place' => $logged_user_details_value->travel_place,
                            'travel_desc' => $logged_user_details_value->travel_desc,
                            'travel_start_date' => $logged_user_details_value->travel_start_date,
                            'travel_end_date' => $logged_user_details_value->travel_end_date,
                            'travel_expected_budget' => $logged_user_details_value->travel_expected_budget,
                            'travel_actual_budget' => $logged_user_details_value->travel_actual_budget,
                            'travel_mode' => $logged_user_details_value->travel_mode,
                            'travel_status' => $logged_user_details_value->travel_status,
                            'created_at' =>"-",
                            'updated_at' => "-",
                        ));
                }
                
                
                    return response()->json([
                    'success' => true,
                    'message' => 'Request Sent!!!',
                    'data' => $details_array2,
                     ])->setStatusCode(200);
     
    
            }else{

                    return response()->json([
                    'success' => true,
                    'message' => 'Request Sent!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
            } 
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                     
                    //  return response()->json([
                    //     'success' => true,
                    //     'message' => 'Request Sent!!!',
                    // ])->setStatusCode(200);
                }
    
               
            }

	}



    public function userSupportTicketRequestSending(Request $request)
	{

        //echo "ok"; exit;

            // $validated = $request->validate([
            //     'com_id' => 'required',
            //     'support_ticket_department_id' => 'required',
            //     'support_ticket_employee_id' => 'required',
            //     'support_ticket_priority' => 'required',
            //     'support_ticket_subject' => 'required',
            //     'support_ticket_note' => 'required',
            //     'support_ticket_date' => 'required',
            //     'support_ticket_desc' => 'required',
            // ]);
            
            $validator = \Validator::make($request->all(),
             [   
                'com_id' => 'required',
                'support_ticket_department_id' => 'required',
                'support_ticket_employee_id' => 'required',
                'support_ticket_priority' => 'required',
                'support_ticket_subject' => 'required',
                'support_ticket_note' => 'required',
                'support_ticket_date' => 'required',
                'support_ticket_desc' => 'required',
            ]);
            
            $details_array = [];
            
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(SupportTicket::where('support_ticket_employee_id',$request->support_ticket_employee_id)->exists()){
    
                //$logged_user_details = SupportTicket::where('support_ticket_employee_id',$request->support_ticket_employee_id)->get();
    
                $logged_user_details = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                ->join('departments','support_tickets.support_ticket_department_id', '=', 'departments.id')
                ->select('support_tickets.*','users.first_name','users.last_name','departments.department_name')
                ->where('support_ticket_employee_id',$request->support_ticket_employee_id)
                ->get();
    
                foreach($logged_user_details as $logged_user_details_value){
        
                         array_push($details_array,$data=array(
                            'id' => $logged_user_details_value->id,
                            
                            'support_ticket_generation_one_id' => $logged_user_details_value->support_ticket_generation_one_id,
                            'support_ticket_generation_two_id' => $logged_user_details_value->support_ticket_generation_two_id,

                            'support_ticket_department_name' => $logged_user_details_value->department_name,
                            'support_ticket_employee_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
    
                            'support_ticket_priority' => $logged_user_details_value->support_ticket_priority,
                            'support_ticket_subject' => $logged_user_details_value->support_ticket_subject,
                            'support_ticket_note' => $logged_user_details_value->support_ticket_note,
                            'support_ticket_attachment' => $logged_user_details_value->support_ticket_attachment,
                            'support_ticket_desc' => $logged_user_details_value->support_ticket_desc,
                            'support_ticket_status' => $logged_user_details_value->support_ticket_status,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                }
 
    
            }else{
                
                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'support_ticket_department_name' =>"-",
                //     'support_ticket_employee_name' =>"-",
                //     'support_ticket_priority' => "-",
                //     'support_ticket_subject' => "-",
                //     'support_ticket_note' => "-",
                //     'support_ticket_attachment' =>"-",
                //     'support_ticket_desc' => "-",
                //     'support_ticket_status' => "-",
                //     'created_at' => "-",
                //     'updated_at' =>"-",
                // ));
    
            }
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            
            if(!$request->com_id){

                return response()->json([
                    'success' => false,
                     'message'=>'com id field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
                
            }
            if(!$request->support_ticket_department_id){

                return response()->json([
                    'success' => false,
                    'message'=>'support ticket department id field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->support_ticket_employee_id){

                return response()->json([
                    'success' => false,
                    'message'=>'support ticket employee id field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->support_ticket_priority){

                return response()->json([
                    'success' => false,
                    'message'=>'support ticket priority field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->support_ticket_subject){

                return response()->json([
                    'success' => false,
                    'message'=>'support ticket subject field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->support_ticket_note){

                return response()->json([
                    'success' => false,
                    'message'=>'support ticket note field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->support_ticket_date){

                return response()->json([
                    'success' => false,
                     'message'=>'support ticket date field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            if(!$request->support_ticket_desc){

                return response()->json([
                    'success' => false,
                    'message'=>'support ticket desc field is missing!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
            }
            
            
            
            if ($validator->fails()) {
    
                    return response()->json([
                    'success' => false,
                    'message'=>'Some form fields are missing!!!',
                    'data' => $details_array,
                     ])->setStatusCode(200);
    
                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]); 
            }
            

            ############### random key generate code starts###########
            function generateRandomString($length = 25) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $random_key = generateRandomString();
            ############### random key generate code staendsrts###########

            $users = User::where('id','=',$request->support_ticket_employee_id)->get(['report_to_parent_id','email','first_name','last_name','department_id','designation_id','region_id','area_id','territory_id','town_id','db_house_id']);

            foreach($users as $users){
    
                if($users->department_id == '' || $users->department_id == Null || 
                $users->designation_id == '' || $users->designation_id == Null || 
                $users->region_id == '' || $users->region_id == Null || 
                $users->area_id == '' || $users->area_id == Null || 
                $users->territory_id == '' || $users->territory_id == Null || 
                $users->town_id == '' || $users->town_id == Null || 
                $users->db_house_id == '' || $users->db_house_id == Null
               
                ){
    
                    return response()->json([
                    'success' => false,
                    'message' => 'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly',
                    'data' => $details_array,
                     ])->setStatusCode(200);
                     
                     
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly',
                    // ])->setStatusCode(200);
                }
    
                if($users->report_to_parent_id == '' || $users->report_to_parent_id == Null || $users->report_to_parent_id == NULL){
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'First Supervisor Not Set Yet!!!',
                        'data' => $details_array,
                     ])->setStatusCode(200);
                     
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'First Supervisor Not Set Yet!!!',
                    // ])->setStatusCode(200);
                }else{

                    if(User::where('id','=',$users->report_to_parent_id)->exists()){
                        //skip
                    }else{
    
                    return response()->json([
                        'success' => false,
                        'message' => 'First Supervisor Not Found!!!',
                        'data' => $details_array,
                     ])->setStatusCode(200);
                     
                     
                        // return response()->json([
                        //     'success' => false,
                        //     'message' => 'First Supervisor Not Found!!!',
                        // ])->setStatusCode(200);
                    }
    
                    $generation_one_details = User::where('id','=',$users->report_to_parent_id)->get(['report_to_parent_id','email']);
                    foreach($generation_one_details as $generation_one_details_value){
    
                            $support_ticket = new SupportTicket();
                            $support_ticket->support_ticket_token = $random_key;
                            $support_ticket->support_ticket_com_id = $request->com_id;
                            $support_ticket->support_ticket_department_id = $request->support_ticket_department_id;
                            $support_ticket->support_ticket_employee_id = $request->support_ticket_employee_id;
                            $support_ticket->support_ticket_generation_one_id = $users->report_to_parent_id;
                            $support_ticket->support_ticket_generation_two_id = $generation_one_details_value->report_to_parent_id;
                            $support_ticket->support_ticket_priority = $request->support_ticket_priority;
                            $support_ticket->support_ticket_subject = $request->support_ticket_subject;
                            $support_ticket->support_ticket_note = $request->support_ticket_note;
                            $support_ticket->support_ticket_date = $request->support_ticket_date;
                            if($request->file('support_ticket_attachment')){
                                $image = $request->file('support_ticket_attachment');
                                $input['imagename'] = time().'.'.$image->extension();
                                $filePath = 'uploads/employee-ticket-files';
                                $imageUrl = $filePath.'/'.$input['imagename'];
                                $imageStoring = $image->move($filePath, $input['imagename']); 
    
                                $support_ticket->support_ticket_attachment = $imageUrl;
                            }
                            $support_ticket->support_ticket_desc = strip_tags($request->support_ticket_desc);
                            $support_ticket->support_ticket_status = "Pending";
                            $support_ticket->save();
    
                            if($generation_one_details_value->report_to_parent_id == '' || $generation_one_details_value->report_to_parent_id == NULL){

                                    $notification = new Notification();
                                    $notification->notification_token = $random_key;
                                    $notification->notification_com_id = $request->com_id;
                                    $notification->notification_type = "Support";
                                    $notification->notification_title = "You Have A New Support Request";
                                    $notification->notification_from = $request->support_ticket_employee_id;
                                    $notification->notification_to = $users->report_to_parent_id;
                                    $notification->notification_status = "Unseen";
                                    $notification->save();
                               
                                    $data["email"]= $generation_one_details_value->email;
                                    $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                    $data["subject"] = "Support Request";
                
                                    $sender_name = array(
                                        'pay_slip_net_salary' => $data["request_sender_name"],
                                        );
                
                                    Mail::send('back-end.premium.emails.support-request',[
                                        'sender_name' => $sender_name,
                                ], function($message)use($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                                    });
    
                            }else{

                                if(User::where('id','=',$generation_one_details_value->report_to_parent_id)->exists()){
                                    //skip
                                }else{

                                    $notification = new Notification();
                                    $notification->notification_token = $random_key;
                                    $notification->notification_com_id = $request->com_id;
                                    $notification->notification_type = "Support";
                                    $notification->notification_title = "You Have A New Support Request";
                                    $notification->notification_from = $request->support_ticket_employee_id;
                                    $notification->notification_to = $users->report_to_parent_id;
                                    $notification->notification_status = "Unseen";
                                    $notification->save();
                               
                                    $data["email"]= $generation_one_details_value->email;
                                    $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                    $data["subject"] = "Support Request";
                
                                    $sender_name = array(
                                        'pay_slip_net_salary' => $data["request_sender_name"],
                                        );
                
                                    Mail::send('back-end.premium.emails.support-request',[
                                        'sender_name' => $sender_name,
                                ], function($message)use($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                                    });
                    
                                    return response()->json([
                                        'success' => false,
                                        'message' => 'Request Sent To The First Supervisor!!! But The Seconnd Supervisor Not Set Yet!!!',
                                        'data' => $details_array,
                                     ])->setStatusCode(200);
                     
                     
                                    // return response()->json([
                                    //     'success' => false,
                                    //     'message' => 'Request Sent To The First Supervisor!!! But The Seconnd Supervisor Not Set Yet!!!',
                                    // ])->setStatusCode(200);
                                }

                                $notification = new Notification();
                                $notification->notification_token = $random_key;
                                $notification->notification_com_id = $request->com_id;
                                $notification->notification_type = "Support";
                                $notification->notification_title = "You Have A New Support Request";
                                $notification->notification_from = $request->support_ticket_employee_id;
                                $notification->notification_to = $users->report_to_parent_id;
                                $notification->notification_status = "Unseen";
                                $notification->save();

                                $notification_second = new Notification();
                                $notification_second->notification_token = $random_key;
                                $notification_second->notification_com_id = $request->com_id;
                                $notification_second->notification_type = "Support";
                                $notification_second->notification_title = "You Have A New Support Request";
                                $notification_second->notification_from = $request->support_ticket_employee_id;
                                $notification_second->notification_to = $generation_one_details_value->report_to_parent_id;
                                $notification_second->notification_status = "Unseen";
                                $notification_second->save();
    
                                $generation_two_details = User::where('id','=',$generation_one_details_value->report_to_parent_id)->get('email');
    
                                foreach($generation_two_details as $generation_two_details_value){
    
                                            ######## first generation email##########
                                            $data["email"]= $generation_one_details_value->email;
                                            $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                            $data["subject"] = "Support Request";
                        
                                            $sender_name = array(
                                                'pay_slip_net_salary' => $data["request_sender_name"],
                                                );
                        
                                            Mail::send('back-end.premium.emails.support-request',[
                                                'sender_name' => $sender_name,
                                        ], function($message)use($data) {
                                            $message->to($data["email"], $data["request_sender_name"])
                                            ->subject($data["subject"]);
                                            });
    
                                            ######## first generation email ends##########
    
                                            ######## second generation email##########
                                            $data["email"]= $generation_two_details_value->email;
                                            $data["request_sender_name"] = $users->first_name.' '.$users->last_name;
                                            $data["subject"] = "Support Request";
                        
                                            $sender_name = array(
                                                'pay_slip_net_salary' => $data["request_sender_name"],
                                                );
                        
                                            Mail::send('back-end.premium.emails.support-request',[
                                                'sender_name' => $sender_name,
                                        ], function($message)use($data) {
                                            $message->to($data["email"], $data["request_sender_name"])
                                            ->subject($data["subject"]);
                                            });
                
                                            ######## second generation email ends##########
    
                                }
    
    
                            }
                
                    
                    }
                    
    
                    // return response()->json([
                    //     'success' => true,
                    //      'message' => 'Request Sent!!!',
                    //     'data' => $details_array,
                    //  ])->setStatusCode(200);
    
                    //  return response()->json([
                    //     'success' => true,
                    //     'message' => 'Request Sent!!!',
                    // ])->setStatusCode(200);
                }
    
               
            }
            
            
            
            $details_array2 = [];
            
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if(SupportTicket::where('support_ticket_employee_id',$request->support_ticket_employee_id)->exists()){
    
                $logged_user_details = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                ->join('departments','support_tickets.support_ticket_department_id', '=', 'departments.id')
                ->select('support_tickets.*','users.first_name','users.last_name','departments.department_name')
                ->where('support_ticket_employee_id',$request->support_ticket_employee_id)
                ->get();
    
                foreach($logged_user_details as $logged_user_details_value){
        
                         array_push($details_array2,$data=array(
                            'id' => $logged_user_details_value->id,

                            'support_ticket_department_name' => $logged_user_details_value->department_name,
                            'support_ticket_employee_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
    
                            'support_ticket_priority' => $logged_user_details_value->support_ticket_priority,
                            'support_ticket_subject' => $logged_user_details_value->support_ticket_subject,
                            'support_ticket_note' => $logged_user_details_value->support_ticket_note,
                            'support_ticket_attachment' => $logged_user_details_value->support_ticket_attachment,
                            'support_ticket_desc' => $logged_user_details_value->support_ticket_desc,
                            'support_ticket_status' => $logged_user_details_value->support_ticket_status,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                }
                
                return response()->json([
                    'success' => true,
                    'message' => 'Request Sent!!!',
                    'data' => $details_array2,
                 ])->setStatusCode(200);
 
    
            }else{
                
                return response()->json([
                    'success' => true,
                    'message' => 'Request Sent!!!',
                    'data' => $details_array,
                 ])->setStatusCode(200);
    
            }
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Request Sent!!!',
            // ])->setStatusCode(200);
       
	}


}