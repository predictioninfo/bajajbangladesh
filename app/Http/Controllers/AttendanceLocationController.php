<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\AttendanceLocation;
use Illuminate\Http\Request;
use Auth;
use DB;
use DateTime;
use Excel;
use Carbon\Carbon;

class AttendanceLocationController extends Controller
{
    public function unsetAttendanceLocation(Request $request)
    {
        try {
            $user = User::find($request->attendance_location_employee_id);
            $user->check_in_latitude_three = NULL;
            $user->check_in_longitude_three = NULL;
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Unset Successfully');
    }
    public function setAttendanceLocation(Request $request)
    {
        try {
            $user = User::find($request->attendance_location_employee_id);
            $user->check_in_latitude_three = $request->attendance_check_in_location_latitude;
            $user->check_in_longitude_three = $request->attendance_check_in_location_longitude;
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Set Successfully');
    }
    public function unsetCheckOutAttendanceLocation(Request $request)
    {
        //echo "okdfhdf"; exit;
        try {
            $user = User::find($request->attendance_check_out_location_employee_id);
            $user->check_out_latitude_three = NULL;
            $user->check_out_longitude_three = NULL;
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Unset Successfully');
    }
    public function setCheckOutAttendanceLocation(Request $request)
    {
        try {
            // echo $request->attendance_check_out_location_longitude;
            // echo "ok"; exit;
            $user = User::find($request->attendance_check_out_location_employee_id);
            $user->check_out_latitude_three = $request->attendance_check_out_location_latitude;
            $user->check_out_longitude_three = $request->attendance_check_out_location_longitude;
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Set Successfully');
    }













    // 	public function unsetAttendanceLocation(Request $request)
    // 	{

    //           $user = User::find($request->attendance_location_employee_id);
    //           $user->check_in_latitude_three = NULL;
    //           $user->check_in_longitude_three = NULL;
    //           $user->save();
    //           return back()->with('message','Unset Successfully');
    // 	}
    //     public function setAttendanceLocation(Request $request)
    // 	{


    // 	    $user_details = User::where('id',$request->attendance_location_employee_id)->get();

    // 	    foreach($user_details as $user_details_values){


    //             $requested_check_in_latitude = number_format($request->attendance_check_in_location_latitude, 2, '.', '');
    //             //$requested_check_in_longitude = number_format($request->attendance_check_in_location_longitude, 2, '.', '');

    //             $user_details_check_in_latitude = number_format($user_details_values->check_in_latitude, 2, '.', '');
    //             $user_details_check_in_latitude_two = number_format($user_details_values->check_in_latitude_two, 2, '.', '');
    //             $user_details_check_in_latitude_three = number_format($user_details_values->check_in_latitude_three, 2, '.', '');



    //             if($user_details_check_in_latitude == $requested_check_in_latitude){
    //                 //echo "first checkin latitude matched";
    //                 $user = User::find($request->attendance_location_employee_id);
    //                 $user->check_in_latitude = $request->attendance_check_in_location_latitude;
    //                 $user->check_in_longitude = $request->attendance_check_in_location_longitude;
    //                 $user->save();
    //             }elseif ($user_details_check_in_latitude_two == $requested_check_in_latitude) {
    //                 //echo "second checkin latitude matched";
    //                 $user = User::find($request->attendance_location_employee_id);
    //                 $user->check_in_latitude_two = $request->attendance_check_in_location_latitude;
    //                 $user->check_in_longitude_two = $request->attendance_check_in_location_longitude;
    //                 $user->save();
    //             }elseif($user_details_check_in_latitude_three == $requested_check_in_latitude){
    //                 $user = User::find($request->attendance_location_employee_id);
    //                 $user->check_in_latitude_three = $request->attendance_check_in_location_latitude;
    //                 $user->check_in_longitude_three = $request->attendance_check_in_location_longitude;
    //                 $user->save();
    //             }else{
    //                 $user = User::find($request->attendance_location_employee_id);
    //                 $user->check_in_latitude_three = $request->attendance_check_in_location_latitude;
    //                 $user->check_in_longitude_three = $request->attendance_check_in_location_longitude;
    //                 $user->save();
    //             }



    // 	    }

    //         // $user = User::find($request->attendance_location_employee_id);
    //         // $user->check_in_latitude_three = $request->attendance_check_in_location_latitude;
    //         // $user->check_in_longitude_three = $request->attendance_check_in_location_longitude;
    //         // $user->save();

    //             return back()->with('message','Set Successfully');
    // 	}
    //     public function unsetCheckOutAttendanceLocation(Request $request)
    // 	{
    // 	     //echo "okdfhdf"; exit;

    //           $user = User::find($request->attendance_check_out_location_employee_id);
    //           $user->check_out_latitude_three = NULL;
    //           $user->check_out_longitude_three = NULL;
    //           $user->save();
    //           return back()->with('message','Unset Successfully');
    // 	}
    //     public function setCheckOutAttendanceLocation(Request $request)
    // 	{


    //   $user_details = User::where('id',$request->attendance_check_out_location_employee_id)->get();

    // 	    foreach($user_details as $user_details_values){

    //             $requested_check_out_latitude = number_format($request->attendance_check_out_location_latitude, 2, '.', '');

    //             $user_details_check_out_latitude = number_format($user_details_values->check_out_latitude, 2, '.', '');
    //             $user_details_check_out_latitude_two = number_format($user_details_values->check_out_latitude_two, 2, '.', '');
    //             $user_details_check_out_latitude_three = number_format($user_details_values->check_out_latitude_three, 2, '.', '');


    //             if($user_details_check_out_latitude == $requested_check_out_latitude){
    //                 //echo "first checkin latitude matched";
    //                 $user = User::find($request->attendance_check_out_location_employee_id);
    //                 $user->check_out_latitude = $request->attendance_check_out_location_latitude;
    //                 $user->check_out_longitude = $request->attendance_check_out_location_longitude;
    //                 $user->save();
    //             }elseif ($user_details_check_out_latitude_two == $requested_check_out_latitude) {
    //                 //echo "second checkin latitude matched";
    //                 $user = User::find($request->attendance_check_out_location_employee_id);
    //                 $user->check_out_latitude_two = $request->attendance_check_out_location_latitude;
    //                 $user->check_out_longitude_two = $request->attendance_check_out_location_longitude;
    //                 $user->save();
    //             }elseif($user_details_check_out_latitude_three == $requested_check_out_latitude){
    //                 $user = User::find($request->attendance_check_out_location_employee_id);
    //                 $user->check_out_latitude_three = $request->attendance_check_out_location_latitude;
    //                 $user->check_out_longitude_three = $request->attendance_check_out_location_longitude;
    //                 $user->save();
    //             }else{
    //                 $user = User::find($request->attendance_check_out_location_employee_id);
    //                 $user->check_out_latitude_three = $request->attendance_check_out_location_latitude;
    //                 $user->check_out_longitude_three = $request->attendance_check_out_location_longitude;
    //                 $user->save();
    //             }


    // 	    }
    //             // $user = User::find($request->attendance_check_out_location_employee_id);
    //             // $user->check_out_latitude_three = $request->attendance_check_out_location_latitude;
    //             // $user->check_out_longitude_three = $request->attendance_check_out_location_longitude;
    //             // $user->save();
    //             return back()->with('message','Set Successfully');
    // 	}



}