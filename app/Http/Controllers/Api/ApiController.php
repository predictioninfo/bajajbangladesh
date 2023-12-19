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
use App\Models\Area;
use App\Models\Territory;
use App\Models\Town;
use App\Models\DbHouse;
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
use App\Models\Notification;
use App\Models\CompanyCalendar;
use App\Models\Asset;
use App\Models\DevelopmentPlan;
use App\Models\GoalType;
use App\Models\Qualification;
use App\Models\LeaveType;
use App\Models\Objective;
use App\Models\ObjectiveType;
use App\Models\ObjectiveTypeConfig;
use App\Models\VariableMethod;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mail;
use Image;
use PDF;
use DateTime;

class ApiController extends Controller
{
    public function userLogin(Request $request)
    {

        $word = '@';
        $mystring = $request->emailPhone;
        // Test if string contains the letter
        if (strpos($mystring, $word) !== false) {
            ######################### Login With Email Code Starts From Here #######################

            if (User::where('email', $request->emailPhone)->where('is_active', 1)->where('users_bulk_deleted', 'No')->exists()) {

                $stored = User::where('email', $request->emailPhone)->get();

                foreach ($stored as $stored_data) {

                    if (password_verify($request->password, $stored_data->password)) {

                        $stored_id = $stored_data->id;
                        $stored_com_id = $stored_data->com_id;
                        $stored_first_name = $stored_data->first_name;
                        $stored_last_name = $stored_data->last_name;
                        $stored_email = $stored_data->email;
                        $stored_phone = $stored_data->phone;

                        $data = array(
                            'id' => $stored_id,
                            'com_id' => $stored_com_id,
                            'first_name' => $stored_first_name,
                            'last_name' => $stored_last_name,
                            'email' => $stored_email,
                            'phone' => $stored_phone,
                        );

                        return response()->json([
                            'success' => true,
                            'data' => $data
                        ]);
                    } else {

                        return response()->json([
                            'success' => false,
                            'message' => 'Incorrect Password',
                        ])->setStatusCode(200);
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'These credentials do not match our records. Or you are not an active user!!!',
                ])->setStatusCode(200);
            }

            ######################### Login With Email Code Ends Here #######################

        } else {

            ######################### Login With Phone Number Code Starts From Here #######################

            if (User::where('phone', $request->emailPhone)->where('is_active', 1)->where('users_bulk_deleted', 'No')->exists()) {

                $stored = User::where('phone', $request->emailPhone)->get();

                foreach ($stored as $stored_data) {

                    if (password_verify($request->password, $stored_data->password)) {

                        $stored_id = $stored_data->id;
                        $stored_com_id = $stored_data->com_id;
                        $stored_first_name = $stored_data->first_name;
                        $stored_last_name = $stored_data->last_name;
                        $stored_email = $stored_data->email;
                        $stored_phone = $stored_data->phone;

                        $data = array(
                            'id' => $stored_id,
                            'com_id' => $stored_com_id,
                            'first_name' => $stored_first_name,
                            'last_name' => $stored_last_name,
                            'email' => $stored_email,
                            'phone' => $stored_phone,
                        );

                        return response()->json([
                            'success' => true,
                            'data' => $data
                        ]);
                    } else {

                        return response()->json([
                            'success' => false,
                            'message' => 'Incorrect Password',
                        ])->setStatusCode(200);
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'These credentials do not match our records. Or you are not an active user!!!',
                ])->setStatusCode(200);
            }

            ######################### Login With Phone Number Code Ends Here #######################

        }
    }

    public function userProfilePicFetch(Request $request)
    {


        $details_array = [];

        if (User::where('id', $request->id)->exists()) {

            $loged_user_details = User::where('id', $request->id)->get(['id', 'profile_photo']);

            foreach ($loged_user_details as $loged_user_details_value) {

                $logged_user_id = $loged_user_details_value->id;
                $logged_user_profile_photo = $loged_user_details_value->profile_photo;

                array_push($details_array, $data = array(
                    'id' => $logged_user_id,
                    'profile_photo' => $logged_user_profile_photo,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ]);
        } else {

            // array_push($details_array, $data=array(
            //     'id'=>0,
            //     'profile_photo'=>'',
            //     'created_at' => '',
            //     'updated_at' => '',
            // ));

            return response()->json([
                'success' => false,
                'message' => 'Value not found!',
                'data' => $details_array
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            //     ])->setStatusCode(200);

        }
    }

    public function userProfilePicChange(Request $request)
    {

        //echo "ok";

        // $validated = $request->validate([
        //     'id' => 'required',
        //     'profile_photo' => 'required',
        // ]);


        $validator = \Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'profile_photo' => 'required',
            ]
        );

        $details_array = [];
        //////////////////////////////////////////////////
        if (User::where('id', $request->id)->exists()) {


            $loged_user_details = User::where('id', $request->id)->get(['id', 'profile_photo', 'created_at', 'updated_at']);

            foreach ($loged_user_details as $loged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $loged_user_details_value->id,
                    'profile_photo' => $loged_user_details_value->profile_photo,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                ));
            }
        } else {

            //  array_push($details_array,$data=array(
            //         'id'=>0,
            //         'profile_photo'=> "",
            //         'created_at' => "",
            //         'updated_at' => "",
            //     ));
        }
        //////////////////////////////////


        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is required',
                'data' => $details_array
            ]);
        }
        if (!$request->profile_photo) {

            return response()->json([
                'success' => false,
                'message' => 'profile photo field is required',
                'data' => $details_array
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'some form fields are required',
                'data' => $details_array
            ]);
        }


        // if(!$request->id){

        //     $data=array(
        //         'message'=>'id field is required',
        //         'created_at' => '',
        //         'updated_at' => '',
        //     );

        //     return response()->json([
        //         'success' =>false,
        //         'data'=>$data
        //         ]);

        // }



        //exit;


        $user = User::find($request->id);
        $image = $request->file('profile_photo');
        $input['imagename'] = time() . '.' . $image->extension();
        $filePath = 'uploads/profile_photos';
        $img = Image::make($image->path());
        $img->resize(110, 110, function ($const) {
            $const->aspectRatio();
        })->save($filePath . '/' . $input['imagename']);
        $imageUrl = $filePath . '/' . $input['imagename'];
        $user->profile_photo = $imageUrl;
        $filePath = 'uploads/profile_photos/before_resized/';
        $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        $user->save();

        $details_array2 = [];
        //////////////////////////////////////////////////
        if (User::where('id', $request->id)->exists()) {

            $loged_user_details = User::where('id', $request->id)->get(['id', 'profile_photo', 'created_at', 'updated_at']);

            foreach ($loged_user_details as $loged_user_details_value) {

                array_push($details_array2, $data2 = array(
                    'id' => $loged_user_details_value->id,
                    'profile_photo' => $loged_user_details_value->profile_photo,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'message' => "Updated Successfully",
                'data' => $details_array2,
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => "Not Updated",
                'data' => $details_array
            ]);
        }
        //////////////////////////////////

    }

    public function userBasicInformation(Request $request)
    {

        //echo $request->id; exit;
        $details_array = [];
        if (User::where('id', $request->id)->exists()) {

            $loged_user_details = User::where('id', $request->id)->get(['id', 'first_name', 'last_name', 'email', 'phone', 'date_of_birth', 'gender']);

            foreach ($loged_user_details as $loged_user_details_value) {

                $logged_user_id = $loged_user_details_value->id;
                $logged_user_first_name = $loged_user_details_value->first_name;
                $logged_user_last_name = $loged_user_details_value->last_name;
                $logged_user_email = $loged_user_details_value->email;
                $logged_user_phone = $loged_user_details_value->phone;
                $logged_user_date_of_birth = $loged_user_details_value->date_of_birth;
                $logged_user_gender = $loged_user_details_value->gender;

                array_push($details_array, $data = array(
                    'id' => $logged_user_id,
                    'first_name' => $logged_user_first_name,
                    'last_name' => $logged_user_last_name,
                    'email' => $logged_user_email,
                    'phone' => $logged_user_phone,
                    'date_of_birth' => $logged_user_date_of_birth,
                    'gender' => $logged_user_gender,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array
            ]);
        } else {

            // array_push($details_array,$data=array(
            //     'id'=>0,
            //     'first_name'=>'',
            //     'last_name'=>'',
            //     'email'=>'',
            //     'phone'=>'',
            //     'date_of_birth'=>'',
            //     'gender'=>'',
            //     'created_at' => '',
            //     'updated_at' => '',
            // ));

            return response()->json([
                'success' => false,
                'message' => "Value Not Found!!!!",
                'data' => $details_array
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            //     ])->setStatusCode(200);

        }
    }

    public function userBasicInformationUpdate(Request $request)
    {


        $validator = \Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
            ]
        );

        $details_array = [];

        if (User::where('id', $request->id)->exists()) {

            $loged_user_details = User::where('id', $request->id)->get(['id', 'first_name', 'last_name', 'email', 'phone', 'date_of_birth', 'gender', 'created_at', 'updated_at']);

            foreach ($loged_user_details as $loged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $loged_user_details_value->id,
                    'first_name' => $loged_user_details_value->first_name,
                    'last_name' => $loged_user_details_value->last_name,
                    'email' => $loged_user_details_value->email,
                    'phone' => $loged_user_details_value->phone,
                    'date_of_birth' => $loged_user_details_value->date_of_birth,
                    'gender' => $loged_user_details_value->gender,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array,$data=array(
            //     'id'=>0,
            //     'first_name'=> "",
            //     'last_name'=> "",
            //     'email'=> "",
            //     'phone'=> "",
            //     'date_of_birth'=> "",
            //     'gender'=> "",
            //     'created_at' => "",
            //     'updated_at' => "",
            // ));

        }

        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is missing',
                'data' => $details_array
            ]);
        } elseif (!$request->first_name) {

            return response()->json([
                'success' => false,
                'message' => 'first name field is missing',
                'data' => $details_array
            ]);
        } elseif (!$request->last_name) {

            return response()->json([
                'success' => false,
                'message' => 'last name field is missing',
                'data' => $details_array
            ]);
        } elseif (!$request->email) {

            return response()->json([
                'success' => false,
                'message' => 'email field is missing',
                'data' => $details_array
            ]);
        } elseif (!$request->phone) {

            return response()->json([
                'success' => false,
                'message' => 'phone field is missing',
                'data' => $details_array
            ]);
        } elseif (!$request->date_of_birth) {

            return response()->json([
                'success' => false,
                'message' => 'date of birth field is missing',
                'data' => $details_array
            ]);
        } elseif (!$request->gender) {

            return response()->json([
                'success' => false,
                'message' => 'gender field is missing',
                'data' => $details_array
            ]);
        } else {
            //skip
        }


        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ]);
        }

        if (User::where('id', $request->id)->exists()) {

            $user = User::find($request->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->date_of_birth = $request->date_of_birth;
            $user->gender = $request->gender;
            $user->save();
        } else {

            return response()->json([
                'success' => false,
                'message' => "Id Not Found in the database!",
                'data' => $details_array
            ]);
        }

        $details_array2 = [];

        if (User::where('id', $request->id)->exists()) {

            $loged_user_details = User::where('id', $request->id)->get(['id', 'first_name', 'last_name', 'email', 'phone', 'date_of_birth', 'gender', 'created_at', 'updated_at']);

            foreach ($loged_user_details as $loged_user_details_value) {

                array_push($details_array2, $data2 = array(
                    'id' => $loged_user_details_value->id,
                    'first_name' => $loged_user_details_value->first_name,
                    'last_name' => $loged_user_details_value->last_name,
                    'email' => $loged_user_details_value->email,
                    'phone' => $loged_user_details_value->phone,
                    'date_of_birth' => $loged_user_details_value->date_of_birth,
                    'gender' => $loged_user_details_value->gender,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'message' => "Updated Successfully",
                'data' => $details_array2
            ]);
        } else {

            return response()->json([
                'success' => true,
                'message' => "Updated Successfully",
                'data' => $details_array
            ]);

            // return response()->json([
            //     'success' => true,
            //     //'message' => "Updated Successfully",
            //     ])->setStatusCode(200);

        }

        // return response()->json([
        // 'success' => true,
        // 'message' => "Updated Successfully",
        // ])->setStatusCode(200);

    }

    public function userImmigration(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->exists()) {

            $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->get();

            foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_immigrant_details_value->id,
                    'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                    'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                    'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                    'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                    'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                    'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                    'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                    'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                    'created_at' => $logged_user_immigrant_details_value->created_at,
                    'updated_at' => $logged_user_immigrant_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //         'id' => 0,
            //         'immigrant_com_id' => 0,
            //         'immigrant_employee_id' => 0,
            //         'immigrant_document_type' =>"-",
            //         'immigrant_issue_date' => "-",
            //         'immigrant_expired_date' => "-",
            //         'immigrant_eligible_review_date' => "-",
            //         'immigrant_document_file' => "-",
            //         'immigrant_country' => "-",
            //         'created_at' => "-",
            //         'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
                //'data' =>[],
            ])->setStatusCode(200);
        }
    }

    public function userImmigrationAdd(Request $request)
    {

        // $validated = $request->validate([
        //     'immigrant_com_id' => 'required',
        //     'immigrant_employee_id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'immigrant_com_id' => 'required',
                'immigrant_employee_id' => 'required',
            ]
        );

        $details_array = [];


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if (Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->exists()) {

            $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->get();

            foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_immigrant_details_value->id,
                    'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                    'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                    'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                    'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                    'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                    'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                    'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                    'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                    'created_at' => $logged_user_immigrant_details_value->created_at,
                    'updated_at' => $logged_user_immigrant_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //         'id' => 0,
            //         'immigrant_com_id' => 0,
            //         'immigrant_employee_id' => 0,
            //         'immigrant_document_type' =>"-",
            //         'immigrant_issue_date' => "-",
            //         'immigrant_expired_date' => "-",
            //         'immigrant_eligible_review_date' => "-",
            //         'immigrant_document_file' => "-",
            //         'immigrant_country' => "-",
            //         'created_at' => "-",
            //         'updated_at' => "-",
            // ));


        }

        ///////////////////////////////////////////////////////



        if (!$request->immigrant_com_id && !$request->immigrant_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'company id and employee id form fields are missing',
                'data' => $details_array,
            ]);
        }

        if (!$request->immigrant_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'company id form field is required',
                'data' => $details_array,
            ]);
        }

        if (!$request->immigrant_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'employee id form field is missing',
                'data' => $details_array,
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are required',
                'data' => $details_array,
            ]);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }




        if (Immigrant::where('immigrant_com_id', $request->immigrant_com_id)->where('immigrant_employee_id', $request->immigrant_employee_id)->exists()) {

            /////////////////////////////////////////////////////
            // $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id',$request->immigrant_employee_id)->get();

            // foreach($logged_user_immigrant_details as $logged_user_immigrant_details_value){

            //     array_push($details_array, $data=array(
            //         'id' => $logged_user_immigrant_details_value->id,
            //         'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
            //         'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
            //         'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
            //         'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
            //         'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
            //         'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
            //         'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
            //         'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
            //         'created_at' => $logged_user_immigrant_details_value->created_at,
            //         'updated_at' => $logged_user_immigrant_details_value->updated_at,
            //     ));

            // }

            // return response()->json([
            //     'success' => false,
            //     'data' => $details_array,
            //      ])->setStatusCode(200);

            ///////////////////////////////////////////////////////////////////

            return response()->json([
                'success' => false,
                'message' => "Already Added!!!",
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {



            $validator = \Validator::make(
                $request->all(),
                [
                    'immigrant_employee_id' => 'required',
                    'immigrant_com_id' => 'required',
                    'immigrant_document_type' => 'required',
                    'immigrant_document_number' => 'required',
                    'immigrant_issue_date' => 'required',
                    'immigrant_expired_date' => 'required',
                    'immigrant_eligible_review_date' => 'required',
                    'immigrant_document_file' => 'required',
                    'immigrant_country' => 'required',
                ]
            );


            //echo $request->immigrant_document_file;

            // exit;

            if (!$request->immigrant_employee_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'Employee id form field is missing!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->immigrant_com_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant com id form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_document_type) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant document type form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_document_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant document number form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_issue_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant issue date form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_expired_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant expired date form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_eligible_review_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant eligible review date form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_document_file) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant document file form field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->immigrant_country) {

                return response()->json([
                    'success' => false,
                    'message' => 'immigrant country form field is missing!!!',
                    'data' => $details_array,
                ]);
            }


            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Some form fields are missing!!!',
                    'data' => $details_array,
                ]);

                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]);
            }




            $immigrant = new Immigrant();
            $immigrant->immigrant_com_id = $request->immigrant_com_id;
            $immigrant->immigrant_employee_id = $request->immigrant_employee_id;
            $immigrant->immigrant_document_type = $request->immigrant_document_type;
            $immigrant->immigrant_document_number = $request->immigrant_document_number;
            $immigrant->immigrant_issue_date = $request->immigrant_issue_date;
            $immigrant->immigrant_expired_date = $request->immigrant_expired_date;
            $immigrant->immigrant_eligible_review_date = $request->immigrant_eligible_review_date;
            //$immigrant->immigrant_document_file = $request->immigrant_document_file;

            $image = $request->file('immigrant_document_file');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/immigrant-files';
            $imageUrl = $filePath . '/' . $input['imagename'];
            $imageStoring = $image->move($filePath, $input['imagename']);

            $immigrant->immigrant_document_file = $imageUrl;
            $immigrant->immigrant_country = $request->immigrant_country;
            $immigrant->save();

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $details_array2 = [];
            if (Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->exists()) {

                $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->get();

                foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                    array_push($details_array2, $data = array(
                        'id' => $logged_user_immigrant_details_value->id,
                        'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                        'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                        'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                        'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                        'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                        'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                        'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                        'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                        'created_at' => $logged_user_immigrant_details_value->created_at,
                        'updated_at' => $logged_user_immigrant_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Added Successfully',
                    'data' => $details_array2,
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => true,
                    'message' => 'Added Successfully',
                    'data' => $details_array,
                ])->setStatusCode(200);
            }

            ///////////////////////////////////////////////////////


        }
    }

    public function userImmigrationById(Request $request)
    {



        if (Immigrant::where('id', $request->id)->exists()) {

            $loged_user_details = Immigrant::where('id', $request->id)->get();

            foreach ($loged_user_details as $loged_user_details_value) {

                $id = $loged_user_details_value->id;
                $immigrant_com_id = $loged_user_details_value->immigrant_com_id;
                $immigrant_employee_id = $loged_user_details_value->immigrant_employee_id;
                $immigrant_document_type = $loged_user_details_value->immigrant_document_type;
                $immigrant_document_number = $loged_user_details_value->immigrant_document_number;
                $immigrant_issue_date = $loged_user_details_value->immigrant_issue_date;
                $immigrant_expired_date = $loged_user_details_value->immigrant_expired_date;
                $immigrant_eligible_review_date = $loged_user_details_value->immigrant_eligible_review_date;
                $immigrant_document_file = $loged_user_details_value->immigrant_document_file;
                $immigrant_country = $loged_user_details_value->immigrant_country;



                $data = array(
                    'id' => $id,
                    'immigrant_com_id' => $immigrant_com_id,
                    'immigrant_employee_id' => $immigrant_employee_id,
                    'immigrant_document_type' => $immigrant_document_type,
                    'immigrant_document_number' => $immigrant_document_number,
                    'immigrant_issue_date' => $immigrant_issue_date,
                    'immigrant_expired_date' => $immigrant_expired_date,
                    'immigrant_eligible_review_date' => $immigrant_eligible_review_date,
                    'immigrant_document_file' => $immigrant_document_file,
                    'immigrant_country' => $immigrant_country,
                    'created_at' => $loged_user_details_value->created_at,
                    'updated_at' => $loged_user_details_value->updated_at,
                );

                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {

            $data = array(
                'message' => "Value Not Found!!!!",
            );

            return response()->json([
                'success' => false,
                'data' => $data
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            //     ])->setStatusCode(200);

        }
    }

    public function userImmigrationUpdate(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'immigrant_document_type' => 'required',
                'immigrant_document_number' => 'required',
                'immigrant_issue_date' => 'required',
                'immigrant_expired_date' => 'required',
                'immigrant_eligible_review_date' => 'required',
                'immigrant_country' => 'required',
            ]
        );

        $details_array = array();


        ///////////////////////////////////////////////////////////////////////////////////////////
        if (Immigrant::where('id', $request->id)->exists()) {


            $employee_details = Immigrant::where('id', $request->id)->get('immigrant_employee_id');

            foreach ($employee_details as $employee_details_value) {

                if (Immigrant::where('immigrant_employee_id', $employee_details_value->immigrant_employee_id)->exists()) {

                    $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $employee_details_value->immigrant_employee_id)->get();

                    foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_immigrant_details_value->id,
                            'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                            'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                            'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                            'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                            'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                            'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                            'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                            'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                            'created_at' => $logged_user_immigrant_details_value->created_at,
                            'updated_at' => $logged_user_immigrant_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //         'id' => 0,
                    //         'immigrant_com_id' => 0,
                    //         'immigrant_employee_id' => 0,
                    //         'immigrant_document_type' =>"-",
                    //         'immigrant_issue_date' => "-",
                    //         'immigrant_expired_date' => "-",
                    //         'immigrant_eligible_review_date' => "-",
                    //         'immigrant_document_file' => "-",
                    //         'immigrant_country' => "-",
                    //         'created_at' => "-",
                    //         'updated_at' => "-",
                    // ));
                }
            }
        } else {

            // array_push($details_array, $data=array(
            //             'id' => 0,
            //             'immigrant_com_id' => 0,
            //             'immigrant_employee_id' => 0,
            //             'immigrant_document_type' =>"-",
            //             'immigrant_issue_date' => "-",
            //             'immigrant_expired_date' => "-",
            //             'immigrant_eligible_review_date' => "-",
            //             'immigrant_document_file' => "-",
            //             'immigrant_country' => "-",
            //             'created_at' => "-",
            //             'updated_at' => "-",
            //     ));

        }


        ////////////////////////////////////////////////////////////////////////////////

        if (!$request->immigrant_document_type) {

            return response()->json([
                'success' => false,
                'message' => 'immigrant document type form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->immigrant_document_number) {

            return response()->json([
                'success' => false,
                'message' => 'immigrant document number form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->immigrant_issue_date) {

            return response()->json([
                'success' => false,
                'message' => 'immigrant issue date form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->immigrant_expired_date) {

            return response()->json([
                'success' => false,
                'message' => 'immigrant expired date form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->immigrant_eligible_review_date) {

            array_push($details_array, $data = array(
                //'message'=>$validator->errors(),
                'message' => 'immigrant eligible review date form field is missing!!!',
            ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ]);
        }
        if (!$request->immigrant_country) {

            return response()->json([
                'success' => false,
                'message' => 'immigrant eligible review date form field is missing!!!',
                'data' => $details_array,
            ]);
        }


        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ]);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }


        if (Immigrant::where('id', $request->id)->exists()) {

            $immigrant = Immigrant::find($request->id);
            $immigrant->immigrant_document_type = $request->immigrant_document_type;
            $immigrant->immigrant_document_number = $request->immigrant_document_number;
            $immigrant->immigrant_issue_date = $request->immigrant_issue_date;
            $immigrant->immigrant_expired_date = $request->immigrant_expired_date;
            $immigrant->immigrant_eligible_review_date = $request->immigrant_eligible_review_date;

            if ($request->file('immigrant_document_file')) {
                $image = $request->file('immigrant_document_file');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/immigrant-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $immigrant->immigrant_document_file = $imageUrl;
            }
            $immigrant->immigrant_country = $request->immigrant_country;
            $immigrant->save();

            // return response()->json([
            // 'success' => true,
            // 'message' => "Updated Successfully",
            // ])->setStatusCode(200);
            //////////////////////////////////////////////////////////////////////////////
            $employee_details = Immigrant::where('id', $request->id)->get('immigrant_employee_id');

            foreach ($employee_details as $employee_details_value) {

                $details_array2 = array();
                if (Immigrant::where('immigrant_employee_id', $employee_details_value->immigrant_employee_id)->exists()) {

                    $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $employee_details_value->immigrant_employee_id)->get();

                    foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_immigrant_details_value->id,
                            'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                            'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                            'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                            'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                            'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                            'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                            'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                            'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                            'created_at' => $logged_user_immigrant_details_value->created_at,
                            'updated_at' => $logged_user_immigrant_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Updated Successfully!!!',
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {


                    return response()->json([
                        'success' => false,
                        'message' => 'Update Error!!!',
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        }


        return response()->json([
            'success' => false,
            'message' => "Nothing To Update",
            'data' => $details_array,
        ])->setStatusCode(200);
        //////////////////////////////////////////////////

        // return response()->json([
        //     'success' => false,
        //     'message' => "Nothing To Update",
        //     ])->setStatusCode(200);


    }

    public function deleteImmigrantion(Request $request)
    {
        if (Immigrant::where('id', $request->id)->exists()) {
            $immigrant = Immigrant::where('id', $request->id)->delete();
            // return response()->json([
            //     'success' => true,
            //     'message' => "Deleted Successfully",
            // ])->setStatusCode(200);


            $details_array = array();
            if (Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->exists()) {

                $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->get();

                foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_immigrant_details_value->id,
                        'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                        'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                        'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                        'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                        'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                        'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                        'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                        'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                        'created_at' => $logged_user_immigrant_details_value->created_at,
                        'updated_at' => $logged_user_immigrant_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //         'id' => 0,
                //         'immigrant_com_id' => 0,
                //         'immigrant_employee_id' => 0,
                //         'immigrant_document_type' =>"-",
                //         'immigrant_issue_date' => "-",
                //         'immigrant_expired_date' => "-",
                //         'immigrant_eligible_review_date' => "-",
                //         'immigrant_document_file' => "-",
                //         'immigrant_country' => "-",
                //         'created_at' => "-",
                //         'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        } else {
            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing To Delete",
            // ])->setStatusCode(200);

            $details_array = array();
            if (Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->exists()) {

                $logged_user_immigrant_details = Immigrant::where('immigrant_employee_id', $request->immigrant_employee_id)->get();

                foreach ($logged_user_immigrant_details as $logged_user_immigrant_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_immigrant_details_value->id,
                        'immigrant_com_id' => $logged_user_immigrant_details_value->immigrant_com_id,
                        'immigrant_employee_id' => $logged_user_immigrant_details_value->immigrant_employee_id,
                        'immigrant_document_type' => $logged_user_immigrant_details_value->immigrant_document_type,
                        'immigrant_issue_date' => $logged_user_immigrant_details_value->immigrant_issue_date,
                        'immigrant_expired_date' => $logged_user_immigrant_details_value->immigrant_expired_date,
                        'immigrant_eligible_review_date' => $logged_user_immigrant_details_value->immigrant_eligible_review_date,
                        'immigrant_document_file' => $logged_user_immigrant_details_value->immigrant_document_file,
                        'immigrant_country' => $logged_user_immigrant_details_value->immigrant_country,
                        'created_at' => $logged_user_immigrant_details_value->created_at,
                        'updated_at' => $logged_user_immigrant_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => false,
                    'message' => "Nothing To Delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //         'id' => 0,
                //         'immigrant_com_id' => 0,
                //         'immigrant_employee_id' => 0,
                //         'immigrant_document_type' =>"-",
                //         'immigrant_issue_date' => "-",
                //         'immigrant_expired_date' => "-",
                //         'immigrant_eligible_review_date' => "-",
                //         'immigrant_document_file' => "-",
                //         'immigrant_country' => "-",
                //         'created_at' => "-",
                //         'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => false,
                    'message' => "Nothing To Delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        }
    }

    public function userEmergencyContact(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->exists()) {

            $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->get();

            foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_emergency_contact_details_value->id,
                    'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                    'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                    'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                    'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                    'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                    'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                    'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                    'created_at' => $logged_user_emergency_contact_details_value->created_at,
                    'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'emergency_contact_com_id' => 0,
            //     'emergency_contact_employee_id' => 0,
            //     'emergency_contact_name' => "-",
            //     'emergency_contact_relation' =>"-",
            //     'emergency_contact_email' => "-",
            //     'emergency_contact_phone' => "-",
            //     'emergency_contact_address' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userEmergencyContactAdd(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'emergency_contact_com_id' => 'required',
                'emergency_contact_employee_id' => 'required',
                'emergency_contact_name' => 'required',
                'emergency_contact_relation' => 'required',
                'emergency_contact_email' => 'required|email',
                'emergency_contact_phone' => 'required',
                'emergency_contact_address' => 'required',
            ]
        );

        $details_array = [];


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //$details_array = array();
        if (EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->exists()) {

            $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->get();

            foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_emergency_contact_details_value->id,
                    'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                    'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                    'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                    'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                    'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                    'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                    'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                    'created_at' => $logged_user_emergency_contact_details_value->created_at,
                    'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'emergency_contact_com_id' => 0,
            //     'emergency_contact_employee_id' => 0,
            //     'emergency_contact_name' => "-",
            //     'emergency_contact_relation' =>"-",
            //     'emergency_contact_email' => "-",
            //     'emergency_contact_phone' => "-",
            //     'emergency_contact_address' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));


        }
        //////////////////////////////////////////////////////////////////////////////////

        if (!$request->emergency_contact_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'Company Id form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'employee id form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_name) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact name form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_relation) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact relation form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_email) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact email form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_phone) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact phone form field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->emergency_contact_address) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact address form field is missing!!!',
                'data' => $details_array,
            ]);
        }


        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);
        }

        $emergency_contact = new EmergencyContact();
        $emergency_contact->emergency_contact_com_id = $request->emergency_contact_com_id;
        $emergency_contact->emergency_contact_employee_id = $request->emergency_contact_employee_id;
        $emergency_contact->emergency_contact_name = $request->emergency_contact_name;
        $emergency_contact->emergency_contact_relation = $request->emergency_contact_relation;
        $emergency_contact->emergency_contact_email = $request->emergency_contact_email;
        $emergency_contact->emergency_contact_phone = $request->emergency_contact_phone;
        $emergency_contact->emergency_contact_address = $request->emergency_contact_address;
        $emergency_contact->save();

        // return response()->json([
        // 'success' => true,
        // 'message' => "Added Successfully",
        // ])->setStatusCode(200);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $details_array2 = array();
        if (EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->exists()) {

            $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->get();

            foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                array_push($details_array2, $data = array(
                    'id' => $logged_user_emergency_contact_details_value->id,
                    'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                    'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                    'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                    'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                    'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                    'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                    'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                    'created_at' => $logged_user_emergency_contact_details_value->created_at,
                    'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'message' => 'Added Successfully!!!',
                'data' => $details_array2,
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'There is an error while adding!!!',
                'data' => $details_array,
            ])->setStatusCode(200);
        }
        //////////////////////////////////////////////////////////////////////////////////


    }

    public function userEmergencyContactById(Request $request)
    {

        if (EmergencyContact::where('id', $request->id)->exists()) {

            $logged_user_details = EmergencyContact::where('id', $request->id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'emergency_contact_com_id' => $logged_user_details_value->emergency_contact_com_id,
                    'emergency_contact_employee_id' => $logged_user_details_value->emergency_contact_employee_id,
                    'emergency_contact_name' => $logged_user_details_value->emergency_contact_name,
                    'emergency_contact_relation' => $logged_user_details_value->emergency_contact_relation,
                    'emergency_contact_email' => $logged_user_details_value->emergency_contact_email,
                    'emergency_contact_phone' =>  $logged_user_details_value->emergency_contact_phone,
                    'emergency_contact_address' => $logged_user_details_value->emergency_contact_address,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {

            $data = array(
                'message' => "Value Not Found!!!!",
            );
            return response()->json([
                'success' => false,
                'data' => $data
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            // ])->setStatusCode(200);

        }
    }

    public function userEmergencyContactUpdate(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'emergency_contact_name' => 'required',
                'emergency_contact_relation' => 'required',
                'emergency_contact_email' => 'required|email',
                'emergency_contact_phone' => 'required',
                'emergency_contact_address' => 'required',
            ]
        );

        $details_array = array();


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (EmergencyContact::where('id', $request->id)->exists()) {

            $emergency_contact_ids = EmergencyContact::where('id', $request->id)->get('emergency_contact_employee_id');

            foreach ($emergency_contact_ids as $emergency_contact_ids_value) {

                if (EmergencyContact::where('emergency_contact_employee_id', $emergency_contact_ids_value->emergency_contact_employee_id)->exists()) {

                    $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $emergency_contact_ids_value->emergency_contact_employee_id)->get();

                    foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_emergency_contact_details_value->id,
                            'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                            'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                            'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                            'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                            'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                            'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                            'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                            'created_at' => $logged_user_emergency_contact_details_value->created_at,
                            'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //     'id' => 0,
                    //     'emergency_contact_com_id' => 0,
                    //     'emergency_contact_employee_id' => 0,
                    //     'emergency_contact_name' => "-",
                    //     'emergency_contact_relation' =>"-",
                    //     'emergency_contact_email' => "-",
                    //     'emergency_contact_phone' => "-",
                    //     'emergency_contact_address' => "-",
                    //     'created_at' => "-",
                    //     'updated_at' => "-",
                    // ));


                }
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'emergency_contact_com_id' => 0,
            //     'emergency_contact_employee_id' => 0,
            //     'emergency_contact_name' => "-",
            //     'emergency_contact_relation' =>"-",
            //     'emergency_contact_email' => "-",
            //     'emergency_contact_phone' => "-",
            //     'emergency_contact_address' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));
        }


        //////////////////////////////////////////////////////////////////////////////////////////


        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_name) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact name form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_relation) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact relation form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_email) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact email form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->emergency_contact_phone) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact phone form field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->emergency_contact_address) {

            return response()->json([
                'success' => false,
                'message' => 'emergency contact address form field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ]);
        }

        $details_array2 = array();
        if (EmergencyContact::where('id', $request->id)->exists()) {

            $emergency_contact = EmergencyContact::find($request->id);
            $emergency_contact->emergency_contact_name = $request->emergency_contact_name;
            $emergency_contact->emergency_contact_relation = $request->emergency_contact_relation;
            $emergency_contact->emergency_contact_email = $request->emergency_contact_email;
            $emergency_contact->emergency_contact_phone = $request->emergency_contact_phone;
            $emergency_contact->emergency_contact_address = $request->emergency_contact_address;
            $emergency_contact->save();

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $emergency_contact_ids = EmergencyContact::where('id', $request->id)->get('emergency_contact_employee_id');

            foreach ($emergency_contact_ids as $emergency_contact_ids_value) {

                if (EmergencyContact::where('emergency_contact_employee_id', $emergency_contact_ids_value->emergency_contact_employee_id)->exists()) {

                    $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $emergency_contact_ids_value->emergency_contact_employee_id)->get();

                    foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_emergency_contact_details_value->id,
                            'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                            'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                            'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                            'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                            'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                            'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                            'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                            'created_at' => $logged_user_emergency_contact_details_value->created_at,
                            'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Updated Successfully!!!',
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {

                    return response()->json([
                        'success' => false,
                        'message' => 'Update Error!!!',
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        }


        return response()->json([
            'success' => false,
            'message' => 'Nothing to update!!!',
            'data' => $details_array,
        ])->setStatusCode(200);
        //////////////////////////////////////////////////////////////////////////////////////////


    }

    public function deleteEmergencyContact(Request $request)
    {
        if (EmergencyContact::where('id', $request->id)->exists()) {
            $emergency_contact = EmergencyContact::where('id', $request->id)->delete();
            // return response()->json([
            //     'success' => true,
            //     'message' => "Deleted Successfully",
            // ])->setStatusCode(200);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $details_array = array();
            if (EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->exists()) {

                $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->get();

                foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_emergency_contact_details_value->id,
                        'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                        'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                        'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                        'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                        'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                        'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                        'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                        'created_at' => $logged_user_emergency_contact_details_value->created_at,
                        'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'emergency_contact_com_id' => 0,
                //     'emergency_contact_employee_id' => 0,
                //     'emergency_contact_name' => "-",
                //     'emergency_contact_relation' =>"-",
                //     'emergency_contact_email' => "-",
                //     'emergency_contact_phone' => "-",
                //     'emergency_contact_address' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
            //////////////////////////////////////////////////////////////////////////////////
        } else {

            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing to delete",
            // ])->setStatusCode(200);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $details_array = array();
            if (EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->exists()) {

                $logged_user_emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', $request->emergency_contact_employee_id)->get();

                foreach ($logged_user_emergency_contact_details as $logged_user_emergency_contact_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_emergency_contact_details_value->id,
                        'emergency_contact_com_id' => $logged_user_emergency_contact_details_value->emergency_contact_com_id,
                        'emergency_contact_employee_id' => $logged_user_emergency_contact_details_value->emergency_contact_employee_id,
                        'emergency_contact_name' => $logged_user_emergency_contact_details_value->emergency_contact_name,
                        'emergency_contact_relation' => $logged_user_emergency_contact_details_value->emergency_contact_relation,
                        'emergency_contact_email' => $logged_user_emergency_contact_details_value->emergency_contact_email,
                        'emergency_contact_phone' => $logged_user_emergency_contact_details_value->emergency_contact_phone,
                        'emergency_contact_address' => $logged_user_emergency_contact_details_value->emergency_contact_address,
                        'created_at' => $logged_user_emergency_contact_details_value->created_at,
                        'updated_at' => $logged_user_emergency_contact_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to deleted",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'emergency_contact_com_id' => 0,
                //     'emergency_contact_employee_id' => 0,
                //     'emergency_contact_name' => "-",
                //     'emergency_contact_relation' =>"-",
                //     'emergency_contact_email' => "-",
                //     'emergency_contact_phone' => "-",
                //     'emergency_contact_address' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to deleted",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
            //////////////////////////////////////////////////////////////////////////////////

        }
    }

    public function userSocialProfile(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->exists()) {

            $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->get();

            foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_social_profile_details_value->id,
                    'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                    'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                    'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                    'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                    'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                    'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                    'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                    'created_at' => $logged_user_social_profile_details_value->created_at,
                    'updated_at' => $logged_user_social_profile_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'social_profile_com_id' => 0,
            //     'social_profile_employee_id' => 0,
            //     'social_profile_fb_profile' => "-",
            //     'social_profile_linkedin_profile' => "-",
            //     'social_profile_skype_profile' => "-",
            //     'social_profile_twitter_profile' => "-",
            //     'social_profile_whatsapp_profile' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }


    public function userSocialProfileAdd(Request $request)
    {

        // $validated = $request->validate([
        //     'social_profile_com_id' => 'required',
        //     'social_profile_employee_id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'social_profile_com_id' => 'required',
                'social_profile_employee_id' => 'required',
            ]
        );

        $details_array = array();


        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //$details_array = array();
        if (SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->exists()) {

            $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->get();

            foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_social_profile_details_value->id,
                    'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                    'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                    'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                    'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                    'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                    'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                    'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                    'created_at' => $logged_user_social_profile_details_value->created_at,
                    'updated_at' => $logged_user_social_profile_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'social_profile_com_id' => 0,
            //     'social_profile_employee_id' => 0,
            //     'social_profile_fb_profile' => "-",
            //     'social_profile_linkedin_profile' => "-",
            //     'social_profile_skype_profile' => "-",
            //     'social_profile_twitter_profile' => "-",
            //     'social_profile_whatsapp_profile' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }
        /////////////////////////////////////////////////////////


        if (!$request->social_profile_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'company id field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->social_profile_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'employee id field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }


        if (SocialProfile::where('social_profile_com_id', $request->social_profile_com_id)->where('social_profile_employee_id', $request->social_profile_employee_id)->exists()) {
            // return response()->json([
            //     'success' => true,
            //     'message' => "Already Added!!!",
            //     ])->setStatusCode(200);
            /////////////////////////////////////////////////////////////////
            // $social_profile_details = SocialProfile::where('social_profile_com_id',$request->social_profile_com_id)->where('social_profile_employee_id',$request->social_profile_employee_id)->get();

            // foreach($social_profile_details as $logged_user_social_profile_details_value){

            //     array_push($details_array, $data=array(
            //     'id' => $logged_user_social_profile_details_value->id,
            //     'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
            //     'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
            //     'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
            //     'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
            //     'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
            //     'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
            //     'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
            //     'created_at' => $logged_user_social_profile_details_value->created_at,
            //     'updated_at' => $logged_user_social_profile_details_value->updated_at,
            //     ));

            // }

            return response()->json([
                'success' => false,
                'message' => "Already Added!!!",
                'data' => $details_array,
            ])->setStatusCode(200);

            ///////////////////////////////////////////////////////

        } else {

            $social_profile = new SocialProfile();
            $social_profile->social_profile_com_id = $request->social_profile_com_id;
            $social_profile->social_profile_employee_id = $request->social_profile_employee_id;
            $social_profile->social_profile_fb_profile = $request->social_profile_fb_profile;
            $social_profile->social_profile_linkedin_profile = $request->social_profile_linkedin_profile;
            $social_profile->social_profile_skype_profile = $request->social_profile_skype_profile;
            $social_profile->social_profile_twitter_profile = $request->social_profile_twitter_profile;
            $social_profile->social_profile_whatsapp_profile = $request->social_profile_whatsapp_profile;
            $social_profile->save();

            // return response()->json([
            //     'success' => true,
            //     'message' => "Added Successfully",
            // ])->setStatusCode(200);
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $details_array2 = array();
            if (SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->exists()) {

                $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->get();

                foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                    array_push($details_array2, $data = array(
                        'id' => $logged_user_social_profile_details_value->id,
                        'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                        'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                        'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                        'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                        'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                        'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                        'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                        'created_at' => $logged_user_social_profile_details_value->created_at,
                        'updated_at' => $logged_user_social_profile_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Added Successfully",
                    'data' => $details_array2,
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to add",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
            /////////////////////////////////////////////////////////
        }
    }

    public function userSocialProfileById(Request $request)
    {

        if (SocialProfile::where('id', $request->id)->exists()) {

            $logged_user_details = SocialProfile::where('id', $request->id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'social_profile_com_id' => $logged_user_details_value->social_profile_com_id,
                    'social_profile_employee_id' => $logged_user_details_value->social_profile_employee_id,
                    'social_profile_fb_profile' => $logged_user_details_value->social_profile_fb_profile,
                    'social_profile_linkedin_profile' => $logged_user_details_value->social_profile_linkedin_profile,
                    'social_profile_skype_profile' => $logged_user_details_value->social_profile_skype_profile,
                    'social_profile_twitter_profile' =>  $logged_user_details_value->social_profile_twitter_profile,
                    'social_profile_whatsapp_profile' => $logged_user_details_value->social_profile_whatsapp_profile,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {

            $data = array(
                'message' => "Value Not Found!!!!",
            );
            return response()->json([
                'success' => false,
                'data' => $data
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            // ])->setStatusCode(200);

        }
    }

    public function userSocialProfileUpdate(Request $request)
    {

        // $validated = $request->validate([
        //     'id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        );

        $details_array = array();

        ////////////////////////////////////////////////////////////////////////////////////////////////////

        if (SocialProfile::where('id', $request->id)->exists()) {

            $social_profiles = SocialProfile::where('id', $request->id)->get('social_profile_employee_id');

            foreach ($social_profiles as $social_profiles_value) {

                if (SocialProfile::where('social_profile_employee_id', $social_profiles_value->social_profile_employee_id)->exists()) {

                    $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $social_profiles_value->social_profile_employee_id)->get();

                    foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_social_profile_details_value->id,
                            'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                            'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                            'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                            'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                            'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                            'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                            'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                            'created_at' => $logged_user_social_profile_details_value->created_at,
                            'updated_at' => $logged_user_social_profile_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //     'id' => 0,
                    //     'social_profile_com_id' => 0,
                    //     'social_profile_employee_id' => 0,
                    //     'social_profile_fb_profile' => "-",
                    //     'social_profile_linkedin_profile' => "-",
                    //     'social_profile_skype_profile' => "-",
                    //     'social_profile_twitter_profile' => "-",
                    //     'social_profile_whatsapp_profile' => "-",
                    //     'created_at' => "-",
                    //     'updated_at' => "-",
                    // ));


                }
            }
        } else {
            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'social_profile_com_id' => 0,
            //     'social_profile_employee_id' => 0,
            //     'social_profile_fb_profile' => "-",
            //     'social_profile_linkedin_profile' => "-",
            //     'social_profile_skype_profile' => "-",
            //     'social_profile_twitter_profile' => "-",
            //     'social_profile_whatsapp_profile' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }

        //////////////////////////////////////////////////////////////////////////////////////////



        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }

        $details_array2 = array();
        if (SocialProfile::where('id', $request->id)->exists()) {

            $social_profile = SocialProfile::find($request->id);
            $social_profile->social_profile_fb_profile = $request->social_profile_fb_profile;
            $social_profile->social_profile_linkedin_profile = $request->social_profile_linkedin_profile;
            $social_profile->social_profile_skype_profile = $request->social_profile_skype_profile;
            $social_profile->social_profile_twitter_profile = $request->social_profile_twitter_profile;
            $social_profile->social_profile_whatsapp_profile = $request->social_profile_whatsapp_profile;
            $social_profile->save();

            // return response()->json([
            // 'success' => true,
            // 'message' => "Updated Successfully",
            // ])->setStatusCode(200);

            ////////////////////////////////////////////////////////////////////////////////////////////////////
            $social_profiles = SocialProfile::where('id', $request->id)->get('social_profile_employee_id');

            foreach ($social_profiles as $social_profiles_value) {

                if (SocialProfile::where('social_profile_employee_id', $social_profiles_value->social_profile_employee_id)->exists()) {

                    $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $social_profiles_value->social_profile_employee_id)->get();

                    foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_social_profile_details_value->id,
                            'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                            'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                            'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                            'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                            'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                            'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                            'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                            'created_at' => $logged_user_social_profile_details_value->created_at,
                            'updated_at' => $logged_user_social_profile_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => "Updated Successfully",
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {

                    return response()->json([
                        'success' => false,
                        'message' => "Update Error",
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing to update",
                'data' => $details_array,
            ])->setStatusCode(200);
            //////////////////////////////////////////////////////////////
            // return response()->json([
            // 'success' => false,
            // 'message' => "Nothing to update",
            // ])->setStatusCode(200);
        }
    }

    public function deleteSocialProfile(Request $request)
    {
        if (SocialProfile::where('id', $request->id)->exists()) {
            $social_profile = SocialProfile::where('id', $request->id)->delete();
            // return response()->json([
            //     'success' => true,
            //     'message' => "Deleted Successfully",
            // ])->setStatusCode(200);

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $details_array = array();
            if (SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->exists()) {

                $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->get();

                foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_social_profile_details_value->id,
                        'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                        'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                        'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                        'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                        'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                        'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                        'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                        'created_at' => $logged_user_social_profile_details_value->created_at,
                        'updated_at' => $logged_user_social_profile_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'social_profile_com_id' => 0,
                //     'social_profile_employee_id' => 0,
                //     'social_profile_fb_profile' => "-",
                //     'social_profile_linkedin_profile' => "-",
                //     'social_profile_skype_profile' => "-",
                //     'social_profile_twitter_profile' => "-",
                //     'social_profile_whatsapp_profile' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
            /////////////////////////////////////////////////////////
        } else {
            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing to delete",
            // ])->setStatusCode(200);

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $details_array = array();
            if (SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->exists()) {

                $logged_user_social_profile_details = SocialProfile::where('social_profile_employee_id', $request->social_profile_employee_id)->get();

                foreach ($logged_user_social_profile_details as $logged_user_social_profile_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_social_profile_details_value->id,
                        'social_profile_com_id' => $logged_user_social_profile_details_value->social_profile_com_id,
                        'social_profile_employee_id' => $logged_user_social_profile_details_value->social_profile_employee_id,
                        'social_profile_fb_profile' => $logged_user_social_profile_details_value->social_profile_fb_profile,
                        'social_profile_linkedin_profile' => $logged_user_social_profile_details_value->social_profile_linkedin_profile,
                        'social_profile_skype_profile' => $logged_user_social_profile_details_value->social_profile_skype_profile,
                        'social_profile_twitter_profile' => $logged_user_social_profile_details_value->social_profile_twitter_profile,
                        'social_profile_whatsapp_profile' => $logged_user_social_profile_details_value->social_profile_whatsapp_profile,
                        'created_at' => $logged_user_social_profile_details_value->created_at,
                        'updated_at' => $logged_user_social_profile_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'social_profile_com_id' => 0,
                //     'social_profile_employee_id' => 0,
                //     'social_profile_fb_profile' => "-",
                //     'social_profile_linkedin_profile' => "-",
                //     'social_profile_skype_profile' => "-",
                //     'social_profile_twitter_profile' => "-",
                //     'social_profile_whatsapp_profile' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
            /////////////////////////////////////////////////////////
        }
    }

    public function userDocument(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (Document::where('document_employee_id', $request->document_employee_id)->exists()) {

            //$logged_user_details = Document::where('document_employee_id',$request->document_employee_id)->get();

            $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                ->select('documents.*', 'users.first_name', 'users.last_name')
                //->where('document_com_id',Auth::user()->com_id)
                ->where('document_employee_id', $request->document_employee_id)
                // ->where('document_type','=','Certificate')
                // ->orWhere('document_type','=','Other')
                ->where(function ($query) {
                    $query->where('document_type', '=', 'Certificate')
                        ->orWhere('document_type', '=', 'Other');
                })
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'document_com_id' => $logged_user_details_value->document_com_id,
                    'document_employee_id' => $logged_user_details_value->document_employee_id,
                    'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'document_type' => $logged_user_details_value->document_type,
                    'document_title' => $logged_user_details_value->document_title,
                    'document_date' => $logged_user_details_value->document_date,
                    'document_description' => $logged_user_details_value->document_description,
                    'document_file' => $logged_user_details_value->document_file,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'document_com_id' => 0,
            //     'document_employee_id' => 0,
            //     'document_uploaded_by' => "-",
            //     'document_type' => "-",
            //     'document_title' => "-",
            //     'document_date' => "-",
            //     'document_description' => "-",
            //     'document_file' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userDocumentAdd(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'document_com_id' => 'required',
                'document_employee_id' => 'required',
                'document_title' => 'required',
                'document_type' => 'required',
                'document_description' => 'required',
                'document_file' => 'required',
                'document_date' => 'required',
            ]
        );

        $details_array = array();

        ////////////////////////////////////////////////////////////////////////////////////////

        if (Document::where('document_employee_id', $request->document_employee_id)->exists()) {

            //$logged_user_details = Document::where('document_employee_id',$request->document_employee_id)->get();

            $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                ->select('documents.*', 'users.first_name', 'users.last_name')
                //->where('document_com_id',Auth::user()->com_id)
                ->where('document_employee_id', $request->document_employee_id)
                // ->where('document_type','=','Certificate')
                // ->orWhere('document_type','=','Other')
                ->where(function ($query) {
                    $query->where('document_type', '=', 'Certificate')
                        ->orWhere('document_type', '=', 'Other');
                })
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'document_com_id' => $logged_user_details_value->document_com_id,
                    'document_employee_id' => $logged_user_details_value->document_employee_id,
                    'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'document_type' => $logged_user_details_value->document_type,
                    'document_title' => $logged_user_details_value->document_title,
                    'document_date' => $logged_user_details_value->document_date,
                    'document_description' => $logged_user_details_value->document_description,
                    'document_file' => $logged_user_details_value->document_file,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'document_com_id' => 0,
            //     'document_employee_id' => 0,
            //     'document_uploaded_by' => "-",
            //     'document_type' => "-",
            //     'document_title' => "-",
            //     'document_date' => "-",
            //     'document_description' => "-",
            //     'document_file' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }

        /////////////////////////////////////////////////////////////////////////////////

        if (!$request->document_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'company id field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->document_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'employee id field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->document_title) {

            return response()->json([
                'success' => false,
                'message' => 'document title field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->document_type) {

            return response()->json([
                'success' => false,
                'message' => 'document type field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->document_description) {

            return response()->json([
                'success' => false,
                'message' => 'document description field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->document_file) {

            return response()->json([
                'success' => false,
                'message' => 'document file field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->document_date) {

            return response()->json([
                'success' => false,
                'message' => 'document date field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }


        // return response()->json([
        //     'success' => true,
        //     'data' => $request->all(),
        // ])->setStatusCode(200);

        $employee_document = new Document();
        $employee_document->document_com_id = $request->document_com_id;
        $employee_document->document_employee_id = $request->document_employee_id;
        $employee_document->document_type = $request->document_type;
        $employee_document->document_title = $request->document_title;
        $employee_document->document_date = $request->document_date;
        $employee_document->document_description = $request->document_description;

        $image = $request->file('document_file');
        $input['imagename'] = time() . '.' . $image->extension();
        $filePath = 'uploads/employee-document-files';
        $imageUrl = $filePath . '/' . $input['imagename'];
        $imageStoring = $image->move($filePath, $input['imagename']);

        $employee_document->document_file = $imageUrl;
        $employee_document->save();

        // return response()->json([
        //     'success' => true,
        //     'message' => "Added Successfully",
        // ])->setStatusCode(200);

        $details_array2 = array();
        if (Document::where('document_employee_id', $request->document_employee_id)->exists()) {

            //$logged_user_details = Document::where('document_employee_id',$request->document_employee_id)->get();

            $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                ->select('documents.*', 'users.first_name', 'users.last_name')
                //->where('document_com_id',Auth::user()->com_id)
                ->where('document_employee_id', $request->document_employee_id)
                // ->where('document_type','=','Certificate')
                // ->orWhere('document_type','=','Other')
                ->where(function ($query) {
                    $query->where('document_type', '=', 'Certificate')
                        ->orWhere('document_type', '=', 'Other');
                })
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array2, $data = array(
                    'id' => $logged_user_details_value->id,
                    'document_com_id' => $logged_user_details_value->document_com_id,
                    'document_employee_id' => $logged_user_details_value->document_employee_id,
                    'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'document_type' => $logged_user_details_value->document_type,
                    'document_title' => $logged_user_details_value->document_title,
                    'document_date' => $logged_user_details_value->document_date,
                    'document_description' => $logged_user_details_value->document_description,
                    'document_file' => $logged_user_details_value->document_file,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'message' => "Added Successfully",
                'data' => $details_array2,
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'message' => "Error Occured!!!",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userDocumentById(Request $request)
    {

        if (Document::where('id', $request->id)->exists()) {

            $logged_user_details = Document::where('id', $request->id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'document_com_id' => $logged_user_details_value->document_com_id,
                    'document_employee_id' => $logged_user_details_value->document_employee_id,
                    'document_type' => $logged_user_details_value->document_type,
                    'document_title' => $logged_user_details_value->document_title,
                    'document_date' => $logged_user_details_value->document_date,
                    'document_description' =>  $logged_user_details_value->document_description,
                    'document_file' => $logged_user_details_value->document_file,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {

            $data = array(
                'message' => "Value Not Found!!!!",
            );
            return response()->json([
                'success' => false,
                'data' => $data
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            // ])->setStatusCode(200);

        }
    }

    public function userDocumentUpdate(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $details_array = array();

        if (Document::where('id', $request->id)->exists()) {

            $document_details = Document::where('id', $request->id)->get('document_employee_id');

            foreach ($document_details as $document_details_value) {

                if (Document::where('document_employee_id', $document_details_value->document_employee_id)->exists()) {

                    $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                        ->select('documents.*', 'users.first_name', 'users.last_name')
                        ->where('document_employee_id', $document_details_value->document_employee_id)
                        // ->where('document_type','=','Certificate')
                        // ->orWhere('document_type','=','Other')
                        ->where(function ($query) {
                            $query->where('document_type', '=', 'Certificate')
                                ->orWhere('document_type', '=', 'Other');
                        })
                        ->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_details_value->id,
                            'document_com_id' => $logged_user_details_value->document_com_id,
                            'document_employee_id' => $logged_user_details_value->document_employee_id,
                            'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                            'document_type' => $logged_user_details_value->document_type,
                            'document_title' => $logged_user_details_value->document_title,
                            'document_date' => $logged_user_details_value->document_date,
                            'document_description' => $logged_user_details_value->document_description,
                            'document_file' => $logged_user_details_value->document_file,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //     'id' => 0,
                    //     'document_com_id' => 0,
                    //     'document_employee_id' => 0,
                    //     'document_uploaded_by' => "-",
                    //     'document_type' => "-",
                    //     'document_title' => "-",
                    //     'document_date' => "-",
                    //     'document_description' => "-",
                    //     'document_file' => "-",
                    //     'created_at' => "-",
                    //     'updated_at' => "-",
                    // ));


                }
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'document_com_id' => 0,
            //     'document_employee_id' => 0,
            //     'document_uploaded_by' => "-",
            //     'document_type' => "-",
            //     'document_title' => "-",
            //     'document_date' => "-",
            //     'document_description' => "-",
            //     'document_file' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }




        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);
        }

        $details_array2 = array();

        if (Document::where('id', $request->id)->exists()) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'document_title' => 'required',
                    'document_type' => 'required',
                    'document_description' => 'required',
                    'document_date' => 'required',
                ]
            );

            if (!$request->document_title) {

                return response()->json([
                    'success' => false,
                    'message' => 'document title field is missing!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->document_type) {

                return response()->json([
                    'success' => false,
                    'message' => 'document type field is missing!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->document_description) {

                return response()->json([
                    'success' => false,
                    'message' => 'document description field is missing!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->document_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'document date field is missing!!!',
                    'data' => $details_array,
                ]);
            }


            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Some form fields are missing!!!',
                    'data' => $details_array,
                ])->setStatusCode(200);

                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]);
            }


            $employee_document = Document::find($request->id);
            $employee_document->document_type = $request->document_type;
            $employee_document->document_title = $request->document_title;
            $employee_document->document_description = $request->document_description;
            $employee_document->document_date = $request->document_date;
            if ($request->file('document_file')) {
                $image = $request->file('document_file');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/employee-document-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $employee_document->document_file = $imageUrl;
            }
            $employee_document->save();

            // return response()->json([
            // 'success' => true,
            // 'message' => "Updated Successfully",
            // ])->setStatusCode(200);

            $document_details = Document::where('id', $request->id)->get('document_employee_id');

            foreach ($document_details as $document_details_value) {

                if (Document::where('document_employee_id', $document_details_value->document_employee_id)->exists()) {

                    $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                        ->select('documents.*', 'users.first_name', 'users.last_name')
                        ->where('document_employee_id', $document_details_value->document_employee_id)
                        // ->where('document_type','=','Certificate')
                        // ->orWhere('document_type','=','Other')
                        ->where(function ($query) {
                            $query->where('document_type', '=', 'Certificate')
                                ->orWhere('document_type', '=', 'Other');
                        })
                        ->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_details_value->id,
                            'document_com_id' => $logged_user_details_value->document_com_id,
                            'document_employee_id' => $logged_user_details_value->document_employee_id,
                            'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                            'document_type' => $logged_user_details_value->document_type,
                            'document_title' => $logged_user_details_value->document_title,
                            'document_date' => $logged_user_details_value->document_date,
                            'document_description' => $logged_user_details_value->document_description,
                            'document_file' => $logged_user_details_value->document_file,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => "Updated Successfully",
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {

                    return response()->json([
                        'success' => false,
                        'message' => "Update Error",
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing to update",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
        // return response()->json([
        // 'success' => false,
        // 'message' => "Nothing to update",
        // ])->setStatusCode(200);


    }

    public function deleteDocument(Request $request)
    {
        if (Document::where('id', $request->id)->exists()) {
            $employee_document = Document::where('id', $request->id)->delete();
            // return response()->json([
            //     'success' => true,
            //     'message' => "Deleted Successfully",
            // ])->setStatusCode(200);

            $details_array = array();
            if (Document::where('document_employee_id', $request->document_employee_id)->exists()) {

                //$logged_user_details = Document::where('document_employee_id',$request->document_employee_id)->get();

                $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                    ->select('documents.*', 'users.first_name', 'users.last_name')
                    //->where('document_com_id',Auth::user()->com_id)
                    ->where('document_employee_id', $request->document_employee_id)
                    // ->where('document_type','=','Certificate')
                    // ->orWhere('document_type','=','Other')
                    ->where(function ($query) {
                        $query->where('document_type', '=', 'Certificate')
                            ->orWhere('document_type', '=', 'Other');
                    })
                    ->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'document_com_id' => $logged_user_details_value->document_com_id,
                        'document_employee_id' => $logged_user_details_value->document_employee_id,
                        'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                        'document_type' => $logged_user_details_value->document_type,
                        'document_title' => $logged_user_details_value->document_title,
                        'document_date' => $logged_user_details_value->document_date,
                        'document_description' => $logged_user_details_value->document_description,
                        'document_file' => $logged_user_details_value->document_file,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'document_com_id' => 0,
                //     'document_employee_id' => 0,
                //     'document_uploaded_by' => "-",
                //     'document_type' => "-",
                //     'document_title' => "-",
                //     'document_date' => "-",
                //     'document_description' => "-",
                //     'document_file' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        } else {

            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing to delete",
            // ])->setStatusCode(200);

            $details_array = array();
            if (Document::where('document_employee_id', $request->document_employee_id)->exists()) {

                //$logged_user_details = Document::where('document_employee_id',$request->document_employee_id)->get();

                $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                    ->select('documents.*', 'users.first_name', 'users.last_name')
                    //->where('document_com_id',Auth::user()->com_id)
                    ->where('document_employee_id', $request->document_employee_id)
                    // ->where('document_type','=','Certificate')
                    // ->orWhere('document_type','=','Other')
                    ->where(function ($query) {
                        $query->where('document_type', '=', 'Certificate')
                            ->orWhere('document_type', '=', 'Other');
                    })
                    ->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'document_com_id' => $logged_user_details_value->document_com_id,
                        'document_employee_id' => $logged_user_details_value->document_employee_id,
                        'document_uploaded_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                        'document_type' => $logged_user_details_value->document_type,
                        'document_title' => $logged_user_details_value->document_title,
                        'document_date' => $logged_user_details_value->document_date,
                        'document_description' => $logged_user_details_value->document_description,
                        'document_file' => $logged_user_details_value->document_file,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'document_com_id' => 0,
                //     'document_employee_id' => 0,
                //     'document_uploaded_by' => "-",
                //     'document_type' => "-",
                //     'document_title' => "-",
                //     'document_date' => "-",
                //     'document_description' => "-",
                //     'document_file' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        }
    }

    public function userQualification(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (Qualification::where('qualification_employee_id', $request->qualification_employee_id)->exists()) {

            $logged_user_details = Qualification::where('qualification_employee_id', $request->qualification_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                    'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                    'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                    'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                    // 'qualification_from_date' => $logged_user_details_value->qualification_from_date,
                    // 'qualification_to_date' => $logged_user_details_value->qualification_to_date,
                    // 'qualification_language_version' => $logged_user_details_value->qualification_language_version,
                    // 'qualification_skill' => $logged_user_details_value->qualification_skill,
                    // 'qualification_description' => $logged_user_details_value->qualification_description,
                    'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                    'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                    'qualification_result' => $logged_user_details_value->qualification_result,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'qualification_com_id' =>0,
            //     'qualification_employee_id' => 0,
            //     'qualification_institute_name' =>"-",
            //     'qualification_education_level' => "-",
            //     // 'qualification_from_date' => "-",
            //     // 'qualification_to_date' => "-",
            //     // 'qualification_language_version' =>"-",
            //     // 'qualification_skill' => "-",
            //     // 'qualification_description' =>"-",
            //     'qualification_education_board' => "-",
            //     'qualification_passing_year' => "-",
            //     'qualification_result' => "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userQualificationAdd(Request $request)
    {

        // $validated = $request->validate([
        //     'qualification_com_id' => 'required',
        //     'qualification_employee_id' => 'required',
        //     // 'qualification_institute_name' => 'required',
        //     // 'qualification_education_level' => 'required',
        //     // 'qualification_from_date' => 'required',
        //     // 'qualification_to_date' => 'required',
        //     // 'qualification_language_version' => 'required',
        //     // 'qualification_skill' => 'required',
        //     // 'qualification_description' => 'required',
        //     // 'qualification_education_board' => 'required',
        //     // 'qualification_passing_year' => 'required',
        //     // 'qualification_result' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'qualification_com_id' => 'required',
                'qualification_employee_id' => 'required',
            ]
        );

        $details_array = array();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (Qualification::where('qualification_employee_id', $request->qualification_employee_id)->exists()) {

            $logged_user_details = Qualification::where('qualification_employee_id', $request->qualification_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                    'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                    'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                    'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                    'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                    'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                    'qualification_result' => $logged_user_details_value->qualification_result,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'qualification_com_id' =>0,
            //     'qualification_employee_id' => 0,
            //     'qualification_institute_name' =>"-",
            //     'qualification_education_level' => "-",
            //     'qualification_education_board' => "-",
            //     'qualification_passing_year' => "-",
            //     'qualification_result' => "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////




        if (!$request->qualification_com_id && !$request->qualification_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'Company ID and Employee ID fields Required!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->qualification_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'Company ID field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->qualification_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'Employee ID field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }

        $qualification = new Qualification();
        $qualification->qualification_com_id = $request->qualification_com_id;
        $qualification->qualification_employee_id = $request->qualification_employee_id;
        $qualification->qualification_institute_name = $request->qualification_institute_name;
        $qualification->qualification_education_level = $request->qualification_education_level;
        // $qualification->qualification_from_date = $request->qualification_from_date;
        // $qualification->qualification_to_date = $request->qualification_to_date;
        // $qualification->qualification_language_version = $request->qualification_language_version;
        // $qualification->qualification_skill = $request->qualification_skill;
        // $qualification->qualification_description = $request->qualification_description;
        $qualification->qualification_education_board = $request->qualification_education_board;
        $qualification->qualification_passing_year = $request->qualification_passing_year;
        $qualification->qualification_result = $request->qualification_result;
        $qualification->save();

        // return response()->json([
        //     'success' => true,
        //     'message' => "Added Successfully",
        // ])->setStatusCode(200);

        $details_array2 = array();
        if (Qualification::where('qualification_employee_id', $request->qualification_employee_id)->exists()) {

            $logged_user_details = Qualification::where('qualification_employee_id', $request->qualification_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array2, $data = array(
                    'id' => $logged_user_details_value->id,
                    'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                    'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                    'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                    'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                    // 'qualification_from_date' => $logged_user_details_value->qualification_from_date,
                    // 'qualification_to_date' => $logged_user_details_value->qualification_to_date,
                    // 'qualification_language_version' => $logged_user_details_value->qualification_language_version,
                    // 'qualification_skill' => $logged_user_details_value->qualification_skill,
                    // 'qualification_description' => $logged_user_details_value->qualification_description,
                    'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                    'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                    'qualification_result' => $logged_user_details_value->qualification_result,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'message' => "Added Successfully",
                'data' => $details_array2,
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'message' => "Added Successfully",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }


    public function userQualificationById(Request $request)
    {

        if (Qualification::where('id', $request->id)->exists()) {

            $logged_user_details = Qualification::where('id', $request->id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                    'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                    'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                    'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                    // 'qualification_from_date' => $logged_user_details_value->qualification_from_date,
                    // 'qualification_to_date' => $logged_user_details_value->qualification_to_date,
                    // 'qualification_language_version' => $logged_user_details_value->qualification_language_version,
                    // 'qualification_skill' => $logged_user_details_value->qualification_skill,
                    // 'qualification_description' => $logged_user_details_value->qualification_description,
                    'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                    'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                    'qualification_result' => $logged_user_details_value->qualification_result,

                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {

            $data = array(
                'message' => "Value Not Found!!!!",
            );
            return response()->json([
                'success' => true,
                'data' => $data
            ]);


            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            // ])->setStatusCode(200);

        }
    }

    public function userQualificationUpdate(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $details_array = array();

        if (Qualification::where('id', $request->id)->exists()) {

            $qualification_details = Qualification::where('id', $request->id)->get('qualification_employee_id');

            foreach ($qualification_details as $qualification_details_value) {

                if (Qualification::where('qualification_employee_id', $qualification_details_value->qualification_employee_id)->exists()) {

                    $logged_user_details = Qualification::where('qualification_employee_id', $qualification_details_value->qualification_employee_id)->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_details_value->id,
                            'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                            'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                            'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                            'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                            'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                            'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                            'qualification_result' => $logged_user_details_value->qualification_result,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //     'id' => 0,
                    //     'qualification_com_id' =>0,
                    //     'qualification_employee_id' => 0,
                    //     'qualification_institute_name' =>"-",
                    //     'qualification_education_level' => "-",
                    //     'qualification_education_board' => "-",
                    //     'qualification_passing_year' => "-",
                    //     'qualification_result' => "-",
                    //     'created_at' => "-",
                    //     'updated_at' =>"-",
                    // ));

                }
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'qualification_com_id' =>0,
            //     'qualification_employee_id' => 0,
            //     'qualification_institute_name' =>"-",
            //     'qualification_education_level' => "-",
            //     'qualification_education_board' => "-",
            //     'qualification_passing_year' => "-",
            //     'qualification_result' => "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

        }


        if (Qualification::where('id', $request->id)->exists()) {


            $validator = \Validator::make(
                $request->all(),
                [
                    'qualification_institute_name' => 'required',
                    'qualification_education_level' => 'required',
                    'qualification_education_board' => 'required',
                    'qualification_passing_year' => 'required',
                    'qualification_result' => 'required',
                ]
            );

            if (!$request->qualification_institute_name) {

                return response()->json([
                    'success' => false,
                    'message' => 'qualification institute name field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->qualification_education_level) {

                return response()->json([
                    'success' => false,
                    'message' => 'qualification education level field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->qualification_education_board) {

                return response()->json([
                    'success' => false,
                    'message' => 'qualification education board field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->qualification_passing_year) {

                return response()->json([
                    'success' => false,
                    'message' => 'qualification passing year field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->qualification_result) {

                return response()->json([
                    'success' => false,
                    'message' => 'qualification result field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Some form fields are required!!!',
                    'data' => $details_array,
                ])->setStatusCode(200);

                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]);
            }


            $qualification = Qualification::find($request->id);
            $qualification->qualification_institute_name = $request->qualification_institute_name;
            $qualification->qualification_education_level = $request->qualification_education_level;
            // $qualification->qualification_from_date = $request->qualification_from_date;
            // $qualification->qualification_to_date = $request->qualification_to_date;
            // $qualification->qualification_language_version = $request->qualification_language_version;
            // $qualification->qualification_skill = $request->qualification_skill;
            // $qualification->qualification_description = $request->qualification_description;
            // $qualification->qualification_description = $request->qualification_description;
            $qualification->qualification_education_board = $request->qualification_education_board;
            $qualification->qualification_passing_year = $request->qualification_passing_year;
            $qualification->qualification_result = $request->qualification_result;
            $qualification->save();

            // return response()->json([
            // 'success' => true,
            // 'message' => "Updated Successfully",
            // ])->setStatusCode(200);

            $details_array2 = array();

            $qualification_details = Qualification::where('id', $request->id)->get('qualification_employee_id');

            foreach ($qualification_details as $qualification_details_value) {

                if (Qualification::where('qualification_employee_id', $qualification_details_value->qualification_employee_id)->exists()) {

                    $logged_user_details = Qualification::where('qualification_employee_id', $qualification_details_value->qualification_employee_id)->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_details_value->id,
                            'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                            'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                            'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                            'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                            // 'qualification_from_date' => $logged_user_details_value->qualification_from_date,
                            // 'qualification_to_date' => $logged_user_details_value->qualification_to_date,
                            // 'qualification_language_version' => $logged_user_details_value->qualification_language_version,
                            // 'qualification_skill' => $logged_user_details_value->qualification_skill,
                            // 'qualification_description' => $logged_user_details_value->qualification_description,
                            'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                            'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                            'qualification_result' => $logged_user_details_value->qualification_result,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => "Updated Successfully",
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {

                    return response()->json([
                        'success' => true,
                        'message' => "Updated Successfully",
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing to update",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
        // return response()->json([
        // 'success' => false,
        // 'message' => "Nothing to update",
        // ])->setStatusCode(200);

    }

    public function deleteQualification(Request $request)
    {
        if (Qualification::where('id', $request->id)->exists()) {
            $qualification = Qualification::where('id', $request->id)->delete();
            // return response()->json([
            //     'success' => true,
            //     'message' => "Deleted Successfully",
            // ])->setStatusCode(200);

            $details_array = array();

            if (Qualification::where('qualification_employee_id', $request->qualification_employee_id)->exists()) {

                $logged_user_details = Qualification::where('qualification_employee_id', $request->qualification_employee_id)->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                        'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                        'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                        'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                        // 'qualification_from_date' => $logged_user_details_value->qualification_from_date,
                        // 'qualification_to_date' => $logged_user_details_value->qualification_to_date,
                        // 'qualification_language_version' => $logged_user_details_value->qualification_language_version,
                        // 'qualification_skill' => $logged_user_details_value->qualification_skill,
                        // 'qualification_description' => $logged_user_details_value->qualification_description,
                        'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                        'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                        'qualification_result' => $logged_user_details_value->qualification_result,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'qualification_com_id' =>0,
                //     'qualification_employee_id' => 0,
                //     'qualification_institute_name' =>"-",
                //     'qualification_education_level' => "-",
                //     'qualification_education_board' => "-",
                //     'qualification_passing_year' => "-",
                //     'qualification_result' => "-",
                //     'created_at' => "-",
                //     'updated_at' =>"-",
                // ));

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        } else {
            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing to delete",
            // ])->setStatusCode(200);

            $details_array = array();
            if (Qualification::where('qualification_employee_id', $request->qualification_employee_id)->exists()) {

                $logged_user_details = Qualification::where('qualification_employee_id', $request->qualification_employee_id)->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'qualification_com_id' => $logged_user_details_value->qualification_com_id,
                        'qualification_employee_id' => $logged_user_details_value->qualification_employee_id,
                        'qualification_institute_name' => $logged_user_details_value->qualification_institute_name,
                        'qualification_education_level' => $logged_user_details_value->qualification_education_level,
                        'qualification_education_board' => $logged_user_details_value->qualification_education_board,
                        'qualification_passing_year' => $logged_user_details_value->qualification_passing_year,
                        'qualification_result' => $logged_user_details_value->qualification_result,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'qualification_com_id' =>0,
                //     'qualification_employee_id' => 0,
                //     'qualification_institute_name' =>"-",
                //     'qualification_education_level' => "-",
                //     'qualification_education_board' => "-",
                //     'qualification_passing_year' => "-",
                //     'qualification_result' => "-",
                //     'created_at' => "-",
                //     'updated_at' =>"-",
                // ));

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        }
    }

    public function userWorkExperience(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->exists()) {

            $logged_user_details = WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                    'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                    'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                    'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                    'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                    'work_experience_post' => $logged_user_details_value->work_experience_post,
                    'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'work_experience_com_id' => 0,
            //     'work_experience_employee_id' => 0,
            //     'work_experience_company_name' => "-",
            //     'work_experience_from_date' => "-",
            //     'work_experience_to_date' => "-",
            //     'work_experience_post' => "-",
            //     'work_experience_desc' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userWorkExperienceAdd(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'work_experience_com_id' => 'required',
                'work_experience_employee_id' => 'required',
                'work_experience_company_name' => 'required',
                'work_experience_from_date' => 'required',
                'work_experience_to_date' => 'required',
                'work_experience_post' => 'required',
                'work_experience_desc' => 'required',
            ]
        );

        $details_array = [];

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->exists()) {

            $logged_user_details = WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                    'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                    'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                    'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                    'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                    'work_experience_post' => $logged_user_details_value->work_experience_post,
                    'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'work_experience_com_id' => 0,
            //     'work_experience_employee_id' => 0,
            //     'work_experience_company_name' => "-",
            //     'work_experience_from_date' => "-",
            //     'work_experience_to_date' => "-",
            //     'work_experience_post' => "-",
            //     'work_experience_desc' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////

        if (!$request->work_experience_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'company id field is required!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->work_experience_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'employee id field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->work_experience_company_name) {

            return response()->json([
                'success' => false,
                'message' => 'company name field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->work_experience_from_date) {

            return response()->json([
                'success' => false,
                'message' => 'from date field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->work_experience_to_date) {

            return response()->json([
                'success' => false,
                'message' => 'to date field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->work_experience_post) {

            return response()->json([
                'success' => false,
                'message' => 'position field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->work_experience_desc) {

            return response()->json([
                'success' => false,
                'message' => 'desc id field is missing!!!',
                'data' => $details_array,
            ]);
        }


        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);

            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }


        $work_experience = new WorkExperience();
        $work_experience->work_experience_com_id = $request->work_experience_com_id;
        $work_experience->work_experience_employee_id = $request->work_experience_employee_id;
        $work_experience->work_experience_company_name = $request->work_experience_company_name;
        $work_experience->work_experience_from_date = $request->work_experience_from_date;
        $work_experience->work_experience_to_date = $request->work_experience_to_date;
        $work_experience->work_experience_post = $request->work_experience_post;
        $work_experience->work_experience_desc = $request->work_experience_desc;
        $work_experience->save();

        // return response()->json([
        //     'success' => true,
        //     'message' => "Added Successfully",
        // ])->setStatusCode(200);

        $details_array2 = array();
        if (WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->exists()) {

            $logged_user_details = WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array2, $data = array(
                    'id' => $logged_user_details_value->id,
                    'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                    'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                    'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                    'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                    'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                    'work_experience_post' => $logged_user_details_value->work_experience_post,
                    'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'message' => "Added Successfully",
                'data' => $details_array2,
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => true,
                'message' => "Added Successfully",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userWorkExperienceById(Request $request)
    {

        if (WorkExperience::where('id', $request->id)->exists()) {

            $logged_user_details = WorkExperience::where('id', $request->id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                    'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                    'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                    'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                    'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                    'work_experience_post' =>  $logged_user_details_value->work_experience_post,
                    'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {


            $data = array(
                'message' => "Value Not Found!!!!",
            );
            return response()->json([
                'success' => true,
                'data' => $data
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            // ])->setStatusCode(200);

        }
    }

    public function userWorkExperienceUpdate(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $details_array = array();

        if (WorkExperience::where('id', $request->id)->exists()) {

            $work_experience_details = WorkExperience::where('id', $request->id)->get('work_experience_employee_id');

            foreach ($work_experience_details as $work_experience_details_value) {
                if (WorkExperience::where('work_experience_employee_id', $work_experience_details_value->work_experience_employee_id)->exists()) {

                    $logged_user_details = WorkExperience::where('work_experience_employee_id', $work_experience_details_value->work_experience_employee_id)->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_details_value->id,
                            'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                            'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                            'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                            'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                            'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                            'work_experience_post' => $logged_user_details_value->work_experience_post,
                            'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //     'id' => 0,
                    //     'work_experience_com_id' => 0,
                    //     'work_experience_employee_id' => 0,
                    //     'work_experience_company_name' => "-",
                    //     'work_experience_from_date' => "-",
                    //     'work_experience_to_date' => "-",
                    //     'work_experience_post' => "-",
                    //     'work_experience_desc' => "-",
                    //     'created_at' => "-",
                    //     'updated_at' => "-",
                    // ));

                }
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'work_experience_com_id' => 0,
            //     'work_experience_employee_id' => 0,
            //     'work_experience_company_name' => "-",
            //     'work_experience_from_date' => "-",
            //     'work_experience_to_date' => "-",
            //     'work_experience_post' => "-",
            //     'work_experience_desc' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }


        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is required',
                'data' => $details_array,
            ])->setStatusCode(200);
        }
        $details_array2 = array();
        if (WorkExperience::where('id', $request->id)->exists()) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'work_experience_company_name' => 'required',
                    'work_experience_from_date' => 'required',
                    'work_experience_to_date' => 'required',
                    'work_experience_post' => 'required',
                    'work_experience_desc' => 'required',
                ]
            );

            if (!$request->work_experience_company_name) {

                return response()->json([
                    'success' => false,
                    'message' => 'company name field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->work_experience_from_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'from date field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->work_experience_to_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'to date field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->work_experience_post) {

                return response()->json([
                    'success' => false,
                    'message' => 'position field is missing!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->work_experience_desc) {

                return response()->json([
                    'success' => false,
                    'message' => 'desc id field is missing!!!',
                    'data' => $details_array,
                ]);
            }

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Some form fields are missing!!!',
                    'data' => $details_array,
                ])->setStatusCode(200);


                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]);
            }

            $work_experience = WorkExperience::find($request->id);
            $work_experience->work_experience_company_name = $request->work_experience_company_name;
            $work_experience->work_experience_from_date = $request->work_experience_from_date;
            $work_experience->work_experience_to_date = $request->work_experience_to_date;
            $work_experience->work_experience_post = $request->work_experience_post;
            $work_experience->work_experience_desc = $request->work_experience_desc;
            $work_experience->save();

            // return response()->json([
            // 'success' => true,
            // 'message' => "Updated Successfully",
            // ])->setStatusCode(200);
            $work_experience_details = WorkExperience::where('id', $request->id)->get('work_experience_employee_id');
            foreach ($work_experience_details as $work_experience_details_value) {
                if (WorkExperience::where('work_experience_employee_id', $work_experience_details_value->work_experience_employee_id)->exists()) {

                    $logged_user_details = WorkExperience::where('work_experience_employee_id', $work_experience_details_value->work_experience_employee_id)->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_details_value->id,
                            'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                            'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                            'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                            'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                            'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                            'work_experience_post' => $logged_user_details_value->work_experience_post,
                            'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => "Updated Successfully",
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {

                    return response()->json([
                        'success' => false,
                        'message' => "Updated Error!",
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing to update",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
        // return response()->json([
        // 'success' => false,
        // 'message' => "Nothing to update",
        // ])->setStatusCode(200);

    }

    public function deleteWorkExperience(Request $request)
    {
        if (WorkExperience::where('id', $request->id)->exists()) {
            $work_experience = WorkExperience::where('id', $request->id)->delete();
            // return response()->json([
            //     'success' => true,
            //     'message' => "Deleted Successfully",
            // ])->setStatusCode(200);

            $details_array = array();
            if (WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->exists()) {

                $logged_user_details = WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                        'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                        'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                        'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                        'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                        'work_experience_post' => $logged_user_details_value->work_experience_post,
                        'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'work_experience_com_id' => 0,
                //     'work_experience_employee_id' => 0,
                //     'work_experience_company_name' => "-",
                //     'work_experience_from_date' => "-",
                //     'work_experience_to_date' => "-",
                //     'work_experience_post' => "-",
                //     'work_experience_desc' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => true,
                    'message' => "Deleted Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        } else {
            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing to delete",
            // ])->setStatusCode(200);

            $details_array = array();
            if (WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->exists()) {

                $logged_user_details = WorkExperience::where('work_experience_employee_id', $request->work_experience_employee_id)->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'work_experience_com_id' => $logged_user_details_value->work_experience_com_id,
                        'work_experience_employee_id' => $logged_user_details_value->work_experience_employee_id,
                        'work_experience_company_name' => $logged_user_details_value->work_experience_company_name,
                        'work_experience_from_date' => $logged_user_details_value->work_experience_from_date,
                        'work_experience_to_date' => $logged_user_details_value->work_experience_to_date,
                        'work_experience_post' => $logged_user_details_value->work_experience_post,
                        'work_experience_desc' => $logged_user_details_value->work_experience_desc,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            } else {

                // array_push($details_array, $data=array(
                //     'id' => 0,
                //     'work_experience_com_id' => 0,
                //     'work_experience_employee_id' => 0,
                //     'work_experience_company_name' => "-",
                //     'work_experience_from_date' => "-",
                //     'work_experience_to_date' => "-",
                //     'work_experience_post' => "-",
                //     'work_experience_desc' => "-",
                //     'created_at' => "-",
                //     'updated_at' => "-",
                // ));

                return response()->json([
                    'success' => false,
                    'message' => "Nothing to delete",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        }
    }

    public function userSalaryBankAccount(Request $request)
    {

        //echo $request->id; exit;
        $details_array = array();
        if (BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->exists()) {

            $logged_user_details = BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'bank_account_com_id' => $logged_user_details_value->bank_account_com_id,
                    'bank_account_employee_id' => $logged_user_details_value->bank_account_employee_id,
                    'stuff_id' => $logged_user_details_value->stuff_id,
                    'bank_account_type' => $logged_user_details_value->bank_account_type,
                    'bank_account_title' => $logged_user_details_value->bank_account_title,
                    'bank_name' => $logged_user_details_value->bank_name,
                    'bank_account_number' => $logged_user_details_value->bank_account_number,
                    'bank_code' => $logged_user_details_value->bank_code,
                    'bank_account_routing_number' => $logged_user_details_value->bank_account_routing_number,
                    'bank_account_card_number' => $logged_user_details_value->bank_account_card_number,
                    'bank_branch' => $logged_user_details_value->bank_branch,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'bank_account_com_id' => 0,
            //     'bank_account_employee_id' => 0,
            //     'stuff_id' => 0,
            //     'bank_account_type' => "-",
            //     'bank_account_title' => "-",
            //     'bank_name' => "-",
            //     'bank_account_number' => "-",
            //     'bank_code' => "-",
            //     'bank_account_routing_number' => "-",
            //     'bank_account_card_number' => "-",
            //     'bank_branch' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userSalaryBankAccountAdd(Request $request)
    {

        // $validated = $request->validate([
        //     'bank_account_com_id' => 'required',
        //     'bank_account_employee_id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'bank_account_com_id' => 'required',
                'bank_account_employee_id' => 'required',
            ]
        );

        $details_array = array();
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->exists()) {

            $logged_user_details = BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'bank_account_com_id' => $logged_user_details_value->bank_account_com_id,
                    'bank_account_employee_id' => $logged_user_details_value->bank_account_employee_id,
                    'stuff_id' => $logged_user_details_value->stuff_id,
                    'bank_account_type' => $logged_user_details_value->bank_account_type,
                    'bank_account_title' => $logged_user_details_value->bank_account_title,
                    'bank_name' => $logged_user_details_value->bank_name,
                    'bank_account_number' => $logged_user_details_value->bank_account_number,
                    'bank_code' => $logged_user_details_value->bank_code,
                    'bank_account_routing_number' => $logged_user_details_value->bank_account_routing_number,
                    'bank_account_card_number' => $logged_user_details_value->bank_account_card_number,
                    'bank_branch' => $logged_user_details_value->bank_branch,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'bank_account_com_id' => 0,
            //     'bank_account_employee_id' => 0,
            //     'stuff_id' => 0,
            //     'bank_account_type' => "-",
            //     'bank_account_title' => "-",
            //     'bank_name' => "-",
            //     'bank_account_number' => "-",
            //     'bank_code' => "-",
            //     'bank_account_routing_number' => "-",
            //     'bank_account_card_number' => "-",
            //     'bank_branch' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }

        ///////////////////////////////////////////////////////////////////////////////

        if (!$request->bank_account_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'company id field is required!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->bank_account_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'employee id field is required!!!',
                'data' => $details_array,
            ]);
        }


        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Some form fields are missing!!!',
                'data' => $details_array,
            ])->setStatusCode(200);


            // return response()->json([
            //     'success' =>false,
            //     'message'=>$validator->errors()
            //     ]);
        }

        $details_array2 = array();
        if (BankAccount::where('bank_account_com_id', $request->bank_account_com_id)->where('bank_account_employee_id', $request->bank_account_employee_id)->exists()) {
            // return response()->json([
            //     'success' => true,
            //     'message' => "This employee already has a bank account",
            // ])->setStatusCode(200);

            $bank_details = BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->get();

            foreach ($bank_details as $bank_details_value) {

                array_push($details_array2, $data = array(
                    'id' => $bank_details_value->id,
                    'bank_account_com_id' => $bank_details_value->bank_account_com_id,
                    'bank_account_employee_id' => $bank_details_value->bank_account_employee_id,
                    'stuff_id' => $bank_details_value->stuff_id,
                    'bank_account_type' => $bank_details_value->bank_account_type,
                    'bank_account_title' => $bank_details_value->bank_account_title,
                    'bank_name' => $bank_details_value->bank_name,
                    'bank_account_number' => $bank_details_value->bank_account_number,
                    'bank_code' => $bank_details_value->bank_code,
                    'bank_account_routing_number' => $bank_details_value->bank_account_routing_number,
                    'bank_account_card_number' => $bank_details_value->bank_account_card_number,
                    'bank_branch' => $bank_details_value->bank_branch,
                    'created_at' => $bank_details_value->created_at,
                    'updated_at' => $bank_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => false,
                'message' => "This employee already has a bank account",
                'data' => $details_array2,
            ])->setStatusCode(200);
        } else {
            // $validated = $request->validate([
            //     'bank_account_type' => 'required',
            //     'bank_account_title' => 'required',
            //     'stuff_id' => 'required',
            //     'bank_name' => 'required',
            //     'bank_account_number' => 'required',
            //     'bank_code' => 'required',
            //     'bank_account_routing_number' => 'required',
            //     'bank_account_card_number' => 'required',
            //     'bank_branch' => 'required',
            // ]);

            $validator = \Validator::make(
                $request->all(),
                [
                    'bank_account_type' => 'required',
                    'bank_account_title' => 'required',
                    'stuff_id' => 'required',
                    'bank_name' => 'required',
                    'bank_account_number' => 'required',
                    'bank_code' => 'required',
                    'bank_account_routing_number' => 'required',
                    'bank_account_card_number' => 'required',
                    'bank_branch' => 'required',
                ]
            );


            if (!$request->bank_account_type) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account type field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_account_title) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account title field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->stuff_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'stuff id field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_name) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank name field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->bank_account_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account number field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_code) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank code field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->bank_account_routing_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account routing number field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_account_card_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account card number field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->bank_branch) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank branch field is required!!!',
                    'data' => $details_array,
                ]);
            }


            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Some form fields are missing!!!',
                    'data' => $details_array,
                ])->setStatusCode(200);

                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]);
            }

            $bank_account = new BankAccount();
            $bank_account->bank_account_com_id = $request->bank_account_com_id;
            $bank_account->bank_account_employee_id = $request->bank_account_employee_id;
            $bank_account->bank_account_type = $request->bank_account_type;
            $bank_account->bank_account_title = $request->bank_account_title;
            $bank_account->stuff_id = $request->stuff_id;
            $bank_account->bank_name = $request->bank_name;
            $bank_account->bank_account_number = $request->bank_account_number;
            $bank_account->bank_code = $request->bank_code;
            $bank_account->bank_account_routing_number = $request->bank_account_routing_number;
            $bank_account->bank_account_card_number = $request->bank_account_card_number;
            $bank_account->bank_branch = $request->bank_branch;
            $bank_account->save();

            // return response()->json([
            //     'success' => true,
            //     'message' => "Added Successfully",
            // ])->setStatusCode(200);

            $details_array3 = array();
            if (BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->exists()) {

                $logged_user_details = BankAccount::where('bank_account_employee_id', $request->bank_account_employee_id)->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array3, $data = array(
                        'id' => $logged_user_details_value->id,
                        'bank_account_com_id' => $logged_user_details_value->bank_account_com_id,
                        'bank_account_employee_id' => $logged_user_details_value->bank_account_employee_id,
                        'stuff_id' => $logged_user_details_value->stuff_id,
                        'bank_account_type' => $logged_user_details_value->bank_account_type,
                        'bank_account_title' => $logged_user_details_value->bank_account_title,
                        'bank_name' => $logged_user_details_value->bank_name,
                        'bank_account_number' => $logged_user_details_value->bank_account_number,
                        'bank_code' => $logged_user_details_value->bank_code,
                        'bank_account_routing_number' => $logged_user_details_value->bank_account_routing_number,
                        'bank_account_card_number' => $logged_user_details_value->bank_account_card_number,
                        'bank_branch' => $logged_user_details_value->bank_branch,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => "Added Successfully",
                    'data' => $details_array3,
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => "An error found!",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        }
    }

    public function userSalaryBankAccountById(Request $request)
    {

        if (BankAccount::where('id', $request->id)->exists()) {

            $logged_user_details = BankAccount::where('id', $request->id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'bank_account_com_id' => $logged_user_details_value->bank_account_com_id,
                    'bank_account_employee_id' => $logged_user_details_value->bank_account_employee_id,
                    'bank_account_type' => $logged_user_details_value->bank_account_type,
                    'bank_account_title' => $logged_user_details_value->bank_account_title,
                    'stuff_id' => $logged_user_details_value->stuff_id,
                    'bank_name' =>  $logged_user_details_value->bank_name,
                    'bank_account_number' => $logged_user_details_value->bank_account_number,
                    'bank_code' => $logged_user_details_value->bank_code,
                    'bank_account_routing_number' => $logged_user_details_value->bank_account_routing_number,
                    'bank_account_card_number' => $logged_user_details_value->bank_account_card_number,
                    'bank_branch' => $logged_user_details_value->bank_branch,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
        } else {

            $data = array(
                'message' => "Value Not Found!!!!",
            );
            return response()->json([
                'success' => false,
                'data' => $data
            ]);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Value Not Found!!!!",
            // ])->setStatusCode(200);

        }
    }

    public function userSalaryBankAccountUpdate(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);
        $details_array = array();

        if (BankAccount::where('id', $request->id)->exists()) {

            $bank_details =  BankAccount::where('id', $request->id)->get('bank_account_employee_id');

            foreach ($bank_details as $bank_details_value) {
                if (BankAccount::where('bank_account_employee_id', $bank_details_value->bank_account_employee_id)->exists()) {

                    $logged_user_details = BankAccount::where('bank_account_employee_id', $bank_details_value->bank_account_employee_id)->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array, $data = array(
                            'id' => $logged_user_details_value->id,
                            'bank_account_com_id' => $logged_user_details_value->bank_account_com_id,
                            'bank_account_employee_id' => $logged_user_details_value->bank_account_employee_id,
                            'stuff_id' => $logged_user_details_value->stuff_id,
                            'bank_account_type' => $logged_user_details_value->bank_account_type,
                            'bank_account_title' => $logged_user_details_value->bank_account_title,
                            'bank_name' => $logged_user_details_value->bank_name,
                            'bank_account_number' => $logged_user_details_value->bank_account_number,
                            'bank_code' => $logged_user_details_value->bank_code,
                            'bank_account_routing_number' => $logged_user_details_value->bank_account_routing_number,
                            'bank_account_card_number' => $logged_user_details_value->bank_account_card_number,
                            'bank_branch' => $logged_user_details_value->bank_branch,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }
                } else {

                    // array_push($details_array, $data=array(
                    //     'id' => 0,
                    //     'bank_account_com_id' => 0,
                    //     'bank_account_employee_id' => 0,
                    //     'stuff_id' => 0,
                    //     'bank_account_type' => "-",
                    //     'bank_account_title' => "-",
                    //     'bank_name' => "-",
                    //     'bank_account_number' => "-",
                    //     'bank_code' => "-",
                    //     'bank_account_routing_number' => "-",
                    //     'bank_account_card_number' => "-",
                    //     'bank_branch' => "-",
                    //     'created_at' => "-",
                    //     'updated_at' => "-",
                    // ));

                }
            }
        } else {

            // array_push($details_array, $data=array(
            //         'id' => 0,
            //         'bank_account_com_id' => 0,
            //         'bank_account_employee_id' => 0,
            //         'stuff_id' => 0,
            //         'bank_account_type' => "-",
            //         'bank_account_title' => "-",
            //         'bank_name' => "-",
            //         'bank_account_number' => "-",
            //         'bank_code' => "-",
            //         'bank_account_routing_number' => "-",
            //         'bank_account_card_number' => "-",
            //         'bank_branch' => "-",
            //         'created_at' => "-",
            //         'updated_at' => "-",
            //     ));

        }


        if (BankAccount::where('id', $request->id)->exists()) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'bank_account_type' => 'required',
                    'bank_account_title' => 'required',
                    'stuff_id' => 'required',
                    'bank_name' => 'required',
                    'bank_account_number' => 'required',
                    'bank_code' => 'required',
                    'bank_account_routing_number' => 'required',
                    'bank_account_card_number' => 'required',
                    'bank_branch' => 'required',
                ]
            );

            if (!$request->bank_account_type) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account type field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_account_title) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account title field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->stuff_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'stuff id field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_name) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank name field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->bank_account_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account number field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_code) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank code field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->bank_account_routing_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account routing number field is required!!!',
                    'data' => $details_array,
                ]);
            }
            if (!$request->bank_account_card_number) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank account card number field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if (!$request->bank_branch) {

                return response()->json([
                    'success' => false,
                    'message' => 'bank branch field is required!!!',
                    'data' => $details_array,
                ]);
            }

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Some form fields are missing!!!',
                    'data' => $details_array,
                ])->setStatusCode(200);

                // return response()->json([
                //     'success' =>false,
                //     'message'=>$validator->errors()
                //     ]);
            }

            $bank_account = BankAccount::find($request->id);
            if ($request->bank_account_type) {
                $bank_account->bank_account_type = $request->bank_account_type;
            }
            $bank_account->bank_account_title = $request->bank_account_title;
            $bank_account->stuff_id = $request->stuff_id;
            $bank_account->bank_name = $request->bank_name;
            $bank_account->bank_account_number = $request->bank_account_number;
            $bank_account->bank_code = $request->bank_code;
            $bank_account->bank_account_routing_number = $request->bank_account_routing_number;
            $bank_account->bank_account_card_number = $request->bank_account_card_number;
            $bank_account->bank_branch = $request->bank_branch;
            $bank_account->save();

            // return response()->json([
            // 'success' => true,
            // 'message' => "Updated Successfully",
            // ])->setStatusCode(200);

            $details_array2 = [];
            $bank_details =  BankAccount::where('id', $request->id)->get('bank_account_employee_id');
            foreach ($bank_details as $bank_details_value) {
                if (BankAccount::where('bank_account_employee_id', $bank_details_value->bank_account_employee_id)->exists()) {

                    $logged_user_details = BankAccount::where('bank_account_employee_id', $bank_details_value->bank_account_employee_id)->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_details_value->id,
                            'bank_account_com_id' => $logged_user_details_value->bank_account_com_id,
                            'bank_account_employee_id' => $logged_user_details_value->bank_account_employee_id,
                            'stuff_id' => $logged_user_details_value->stuff_id,
                            'bank_account_type' => $logged_user_details_value->bank_account_type,
                            'bank_account_title' => $logged_user_details_value->bank_account_title,
                            'bank_name' => $logged_user_details_value->bank_name,
                            'bank_account_number' => $logged_user_details_value->bank_account_number,
                            'bank_code' => $logged_user_details_value->bank_code,
                            'bank_account_routing_number' => $logged_user_details_value->bank_account_routing_number,
                            'bank_account_card_number' => $logged_user_details_value->bank_account_card_number,
                            'bank_branch' => $logged_user_details_value->bank_branch,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => "Updated Successfully",
                        'data' => $details_array2,
                    ])->setStatusCode(200);
                } else {

                    return response()->json([
                        'success' => false,
                        'message' => "Update Error!",
                        'data' => $details_array,
                    ])->setStatusCode(200);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing to update",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
        // return response()->json([
        // 'success' => false,
        // 'message' => "Nothing to update",
        // ])->setStatusCode(200);

    }

    public function userPasswordChange(Request $request)
    {

        // $validated = $request->validate([
        //     'id' => 'required',
        //     'password' => 'required',
        //     'confirm_password' => 'required'
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'password' => 'required',
                'confirm_password' => 'required'
            ]
        );

        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'Id field is required!!!'
            ])->setStatusCode(200);
        }
        if (!$request->password) {

            return response()->json([
                'success' => false,
                'message' => 'password field is required!!!'
            ])->setStatusCode(200);
        }
        if (!$request->confirm_password) {

            return response()->json([
                'success' => false,
                'message' => 'confirm password field is required!!!'
            ])->setStatusCode(200);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'some fields missing!!!'
            ]);
        }

        if (User::where('id', $request->id)->exists()) {
            if ($request->password == $request->confirm_password) {
                $user = User::find($request->id);
                $user->password = Hash::make($request->password);
                $user->save();
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Cofirm Password Does Not Match!!!'
                ])->setStatusCode(200);
            }
            return response()->json([
                'success' => true,
                'message' =>  "User Password Updated Successfully",
            ])->setStatusCode(200);
        }
        return response()->json([
            'success' => false,
            'message' => "Nothing to Change",
        ])->setStatusCode(200);
    }


    // public function userAppointmentLetter(Request $request)
    // {
    //     $employee_details_value = User::where('id',$request->id)->first();
    //     $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
    //     $department_value = Department::where('id','=',$employee_details_value->department_id)->first();
    //     $designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();

    //     $employee_details_value_all = User::with('emoloyeedetail')->where('id',$request->id)->get();
    //         //echo json_encode($employee_details); exit;

    // $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-appointment-letter-pdf',[
    //                     'employee_details_value' => $employee_details_value_all,
    //                     'company_details_value' => $company_details_value,
    //                     'department_value' => $department_value,
    //                     'designation_value' => $designation_value,
    //                 ]);
    //          $pdf->download('appointment-letter.pdf');
    //         return response()->json([
    //         'success' => true,
    //         'message' => "Downloaded Successfully",
    //     ])->setStatusCode(200);
    // }

    public function userAppointmentLetter($id)
    {

        //echo $id; exit;
        $employee_details_value = User::where('id', $id)->first();
        $company_details_value = Company::where('id', '=', $employee_details_value->com_id)->first();
        $department_value = Department::where('id', '=', $employee_details_value->department_id)->first();
        $designation_value = Designation::where('id', '=', $employee_details_value->designation_id)->first();

        $employee_details_value_all = User::with('emoloyeedetail')->where('id', $id)->get();
        //echo json_encode($employee_details); exit;

        $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-appointment-letter-pdf', [
            'employee_details_value' => $employee_details_value_all,
            'company_details_value' => $company_details_value,
            'department_value' => $department_value,
            'designation_value' => $designation_value,
        ]);
        $pdf->download('appointment-letter.pdf');
        return response()->json([
            'success' => true,
            'message' => "Downloaded Successfully",
        ])->setStatusCode(200);
    }


    //       public function userIdCard(Request $request){
    //         //echo $request->id; exit;
    //     //     $validated = $request->validate([
    //     //         'id' => 'required',
    //     //     ]);

    //     //     $employee_details_value = User::where('id',$request->id)->first();
    //     //     $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
    //     //     $department_value = Department::where('id','=',$employee_details_value->department_id)->first();
    //     //     $designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();
    //     //         //echo json_encode($employee_details); exit;

    // 				// $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-id-card-pdf2',[
    //     //                 'employee_details_value' => $employee_details_value,
    //     //                 'company_details_value' => $company_details_value,
    //     //                 'department_value' => $department_value,
    //     //                 'designation_value' => $designation_value,
    //     //             ]);
    //     //             //return $pdf->stream();
    //     //       $pdf->download('id-card.pdf');
    //         //return back();

    //             $employee_details_value = User::where('id',$request->id)->first();
    //         $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
    //         $department_value = Department::where('id','=',$employee_details_value->department_id)->first();
    //         $designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();

    //         $employee_details_value_all = User::with('emoloyeedetail')->where('id',$request->id)->get();

    //             //echo json_encode($employee_details); exit;

    // $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-id-card-pdf2',[
    //                     'employee_details_value' => $employee_details_value_all,
    //                     'company_details_value' => $company_details_value,
    //                     'department_value' => $department_value,
    //                     'designation_value' => $designation_value,
    //                 ]);
    //                 //return $pdf->stream();
    //           $pdf->download('id-card.pdf');


    //       }

    public function userIdCard($id)
    {
        //echo $request->id; exit;
        //     $validated = $request->validate([
        //         'id' => 'required',
        //     ]);

        //     $employee_details_value = User::where('id',$request->id)->first();
        //     $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
        //     $department_value = Department::where('id','=',$employee_details_value->department_id)->first();
        //     $designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();
        //         //echo json_encode($employee_details); exit;

        // $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-id-card-pdf2',[
        //                 'employee_details_value' => $employee_details_value,
        //                 'company_details_value' => $company_details_value,
        //                 'department_value' => $department_value,
        //                 'designation_value' => $designation_value,
        //             ]);
        //             //return $pdf->stream();
        //       $pdf->download('id-card.pdf');
        //return back();

        $employee_details_value = User::where('id', $id)->first();
        $company_details_value = Company::where('id', '=', $employee_details_value->com_id)->first();
        $department_value = Department::where('id', '=', $employee_details_value->department_id)->first();
        $designation_value = Designation::where('id', '=', $employee_details_value->designation_id)->first();

        $employee_details_value_all = User::with('emoloyeedetail')->where('id', $id)->get();

        //echo json_encode($employee_details); exit;

        $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-id-card-pdf2', [
            'employee_details_value' => $employee_details_value_all,
            'company_details_value' => $company_details_value,
            'department_value' => $department_value,
            'designation_value' => $designation_value,
        ]);
        //return $pdf->stream();
        $pdf->download('id-card.pdf');
    }

    public function userTotalSalary(Request $request)
    {

        if (User::where('id', $request->id)->exists()) {

            $logged_user_details = User::where('id', $request->id)->get(['gross_salary', 'created_at', 'updated_at']);
            $user_salary_configs = SalaryConfig::where('salary_config_com_id', $request->com_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {
                foreach ($user_salary_configs as $user_salary_configs_value) {

                    $basic_salary = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_basic_salary) / 100;
                    $house_rent = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_house_rent_allowance) / 100;
                    $conveyance = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_conveyance_allowance) / 100;
                    $medical = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_medical_allowance) / 100;
                    $gross_salary = $logged_user_details_value->gross_salary;

                    $data = array(
                        // 'id' => $request->id,
                        // 'com_id' => $request->com_id,
                        'basic_salary' => $basic_salary,
                        'house_rent' => $house_rent,
                        'conveyance' => $conveyance,
                        'medical' => $medical,
                        'gross_salary' => $gross_salary,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    );
                    return response()->json([
                        'success' => true,
                        'data' => $data
                    ]);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Value Not Found!!!!",
            ])->setStatusCode(200);
        }
    }

    public function userComponent(Request $request)
    {

        if (User::where('id', $request->id)->exists()) {

            $logged_user_details = User::where('id', $request->id)->get(['gross_salary', 'created_at', 'updated_at']);
            $user_salary_configs = SalaryConfig::where('salary_config_com_id', $request->com_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {
                foreach ($user_salary_configs as $user_salary_configs_value) {

                    $house_rent = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_house_rent_allowance) / 100;
                    $conveyance = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_conveyance_allowance) / 100;
                    $medical = ($logged_user_details_value->gross_salary * $user_salary_configs_value->salary_config_medical_allowance) / 100;
                    $total_allowance = $house_rent + $conveyance + $medical;

                    $data = array(
                        'house_rent' => $house_rent,
                        'conveyance' => $conveyance,
                        'medical' => $medical,
                        'total' => $total_allowance,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    );
                    return response()->json([
                        'success' => true,
                        'data' => $data
                    ]);
                }
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Value Not Found!!!!",
            ])->setStatusCode(200);
        }
    }

    public function userCommission(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Commission::where('commission_employee_id', $request->commission_employee_id)->exists()) {

            $logged_user_details = Commission::where('commission_employee_id', $request->commission_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'commission_com_id' => $logged_user_details_value->commission_com_id,
                    'commission_employee_id' => $logged_user_details_value->commission_employee_id,
                    'commission_type' => $logged_user_details_value->commission_type,
                    'commission_title' => $logged_user_details_value->commission_title,
                    'commission_desc' => $logged_user_details_value->commission_desc,
                    'commission_month_year' => $logged_user_details_value->commission_month_year,
                    'commission_amount' => $logged_user_details_value->commission_amount,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'commission_com_id' => 0,
            //     'commission_employee_id' => 0,
            //     'commission_type' => "-",
            //     'commission_title' => "-",
            //     'commission_desc' => "-",
            //     'commission_month_year' => "-",
            //     'commission_amount' => "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userLoan(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Loan::where('loans_employee_id', $request->loans_employee_id)->exists()) {

            $logged_user_details = Loan::where('loans_employee_id', $request->loans_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'loans_com_id' => $logged_user_details_value->loans_com_id,
                    'loans_employee_id' => $logged_user_details_value->loans_employee_id,
                    'loans_month_year' => $logged_user_details_value->loans_month_year,
                    'loans_start_date' => $logged_user_details_value->loans_start_date,
                    'loans_title' => $logged_user_details_value->loans_title,
                    'loans_amount' => $logged_user_details_value->loans_amount,
                    'loans_type' => $logged_user_details_value->loans_type,
                    'loans_no_of_installments' => $logged_user_details_value->loans_no_of_installments,
                    'loans_remaining_amount' => $logged_user_details_value->loans_remaining_amount,
                    'loans_remaining_installments' => $logged_user_details_value->loans_remaining_installments,
                    'loans_monthly_payable' => $logged_user_details_value->loans_monthly_payable,
                    'loans_reason' => $logged_user_details_value->loans_reason,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'loans_com_id' => 0,
            //     'loans_employee_id' => 0,
            //     'loans_month_year' => "-",
            //     'loans_start_date' => "-",
            //     'loans_title' => "-",
            //     'loans_amount' => "-",
            //     'loans_type' => "-",
            //     'loans_no_of_installments' => "-",
            //     'loans_remaining_amount' => "-",
            //     'loans_remaining_installments' => "-",
            //     'loans_monthly_payable' => "-",
            //     'loans_reason' => "-",
            //     'created_at' =>"-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userStatutoryDeduction(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (StatutoryDeduction::where('statutory_deduc_employee_id', $request->statutory_deduc_employee_id)->exists()) {

            $logged_user_details = StatutoryDeduction::where('statutory_deduc_employee_id', $request->statutory_deduc_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'statutory_deduc_com_id' => $logged_user_details_value->statutory_deduc_com_id,
                    'statutory_deduc_employee_id' => $logged_user_details_value->statutory_deduc_employee_id,
                    'statutory_deduc_month_year' => $logged_user_details_value->statutory_deduc_month_year,
                    'statutory_deduc_type' => $logged_user_details_value->statutory_deduc_type,
                    'statutory_deduc_title' => $logged_user_details_value->statutory_deduc_title,
                    'statutory_deduc_amount' => $logged_user_details_value->statutory_deduc_amount,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'statutory_deduc_com_id' => 0,
            //     'statutory_deduc_employee_id' => 0,
            //     'statutory_deduc_month_year' => "-",
            //     'statutory_deduc_type' => "-",
            //     'statutory_deduc_title' => "-",
            //     'statutory_deduc_amount' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userAllowance(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (OtherPayment::where('other_payment_employee_id', $request->other_payment_employee_id)->exists()) {

            $logged_user_details = OtherPayment::where('other_payment_employee_id', $request->other_payment_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'other_allowance_com_id' => $logged_user_details_value->other_payment_com_id,
                    'other_allowance_employee_id' => $logged_user_details_value->other_payment_employee_id,
                    'other_allowance_month_year' => $logged_user_details_value->other_payment_month_year,
                    'other_allowance_title' => $logged_user_details_value->other_payment_title,
                    'other_allowance_amount' => $logged_user_details_value->other_payment_amount,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'other_payment_com_id' => 0,
            //     'other_payment_employee_id' => 0,
            //     'other_payment_month_year' => "-",
            //     'other_payment_title' => "-",
            //     'other_payment_amount' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userOverTime(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (OverTime::where('over_time_employee_id', $request->over_time_employee_id)->exists()) {

            $logged_user_details = OverTime::where('over_time_employee_id', $request->over_time_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'over_time_com_id' => $logged_user_details_value->over_time_com_id,
                    'over_time_employee_id' => $logged_user_details_value->over_time_employee_id,
                    //'over_time_type' => $logged_user_details_value->over_time_type,
                    'over_time_date' => $logged_user_details_value->over_time_date,
                    'over_time_company_duty_in_seconds' => $logged_user_details_value->over_time_company_duty_in_seconds,
                    'over_time_employee_in_seconds' => $logged_user_details_value->over_time_employee_in_seconds,
                    'over_time_rate' => $logged_user_details_value->over_time_rate,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'over_time_com_id' => 0,
            //     'over_time_employee_id' => 0,
            //     //'over_time_type' => "-",
            //     'over_time_date' => "-",
            //     'over_time_company_duty_in_seconds' => "-",
            //     'over_time_employee_in_seconds' => "-",
            //     'over_time_rate' => "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userSalaryPension(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Pension::where('pension_employee_id', $request->pension_employee_id)->exists()) {

            $logged_user_details = Pension::where('pension_employee_id', $request->pension_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'pension_com_id' => $logged_user_details_value->pension_com_id,
                    'pension_employee_id' => $logged_user_details_value->pension_employee_id,
                    'pension_start_date' => $logged_user_details_value->pension_start_date,
                    'pension_type' => $logged_user_details_value->pension_type,
                    'pension_amount' => $logged_user_details_value->pension_amount,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'pension_com_id' => 0,
            //     'pension_employee_id' => 0,
            //     'pension_start_date' => "-",
            //     'pension_type' => "-",
            //     'pension_amount' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userAward(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Award::where('award_employee_id', $request->award_employee_id)->exists()) {

            //$logged_user_details = Award::where('award_employee_id',$request->award_employee_id)->get();
            $logged_user_details = Award::join('users', 'awards.award_employee_id', '=', 'users.id')
                ->join('departments', 'awards.award_department_id', '=', 'departments.id')
                ->select('awards.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('award_employee_id', $request->award_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    //'award_com_id' => $logged_user_details_value->award_com_id,
                    // 'award_department_id' => $logged_user_details_value->award_department_id,
                    // 'award_employee_id' => $logged_user_details_value->award_employee_id,
                    'award_employee_full_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'award_employee_department_name' => $logged_user_details_value->department_name,
                    'award_type_name' => $logged_user_details_value->award_type_name,
                    'award_gift' => $logged_user_details_value->award_gift,
                    'award_cash' => $logged_user_details_value->award_cash,
                    'award_date' => $logged_user_details_value->award_date,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     //'award_com_id' => 0,
            //     // 'award_department_id' => 0,
            //     // 'award_employee_id' => 0,
            //     'award_employee_full_name' => "-",
            //     'award_employee_department_name' =>"-",
            //     'award_type_name' => "-",
            //     'award_gift' => "-",
            //     'award_cash' => "-",
            //     'award_date' => "-",
            //     'created_at' =>"-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userTravel(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Travel::where('travel_employee_id', $request->travel_employee_id)->exists()) {

            //$logged_user_details = Travel::where('travel_employee_id',$request->travel_employee_id)->get();
            $logged_user_details = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_employee_id', $request->travel_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'travel_token' => $logged_user_details_value->travel_token,
                    'travel_com_id' => $logged_user_details_value->travel_com_id,
                    'travel_department_id' => $logged_user_details_value->travel_department_id,
                    'travel_employee_full_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
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
                    'created_at' => "-",
                    'updated_at' => "-",
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

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

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userTransfer(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Transfer::where('transfer_employee_id', $request->transfer_employee_id)->exists()) {

            $logged_user_details =  Transfer::where('transfer_employee_id', $request->transfer_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                // echo $logged_user_details_value->transfer_from_region_id;
                // exit;

                $employee_names = User::where('id', '=', $logged_user_details_value->transfer_employee_id)->get(['first_name', 'last_name']);

                $from_region_names = Region::where('id', $logged_user_details_value->transfer_from_region_id)->get(['region_name']);
                $to_region_names = Region::where('id', '=', $logged_user_details_value->transfer_to_region_id)->get(['region_name']);

                $from_area_names = Area::where('id', '=', $logged_user_details_value->transfer_from_area_id)->get(['area_name']);
                $to_area_names = Area::where('id', '=', $logged_user_details_value->transfer_to_area_id)->get(['area_name']);

                $from_territory_names = Territory::where('id', '=', $logged_user_details_value->transfer_from_territory_id)->get(['territory_name']);
                $to_territory_names = Territory::where('id', '=', $logged_user_details_value->transfer_to_territory_id)->get(['territory_name']);

                $from_town_names = Town::where('id', '=', $logged_user_details_value->transfer_from_town_id)->get(['town_name']);
                $to_town_names = Town::where('id', '=', $logged_user_details_value->transfer_to_town_id)->get(['town_name']);

                $from_db_house_names = DbHouse::where('id', '=', $logged_user_details_value->transfer_from_db_house_id)->get(['db_house_name']);
                $to_db_house_names = DbHouse::where('id', '=', $logged_user_details_value->transfer_to_db_house_id)->get(['db_house_name']);

                $from_department_names = Department::where('id', '=', $logged_user_details_value->transfer_from_department_id)->get(['department_name']);
                $to_department_names = Department::where('id', '=', $logged_user_details_value->transfer_to_department_id)->get(['department_name']);

                $from_designation_names = Designation::where('id', '=', $logged_user_details_value->transfer_from_designation_id)->get(['designation_name']);
                $to_designation_names = Designation::where('id', '=', $logged_user_details_value->transfer_to_designation_id)->get(['designation_name']);





                $transfer_employee_name = '';

                $from_region_name = '';
                $from_area_name = '';
                $from_territory_name = '';
                $from_town_name = '';
                $from_db_house_name = '';
                $from_department_name = '';
                $from_designation_name = '';

                $to_region_name = '';
                $to_area_name = '';
                $to_territory_name = '';
                $to_town_name = '';
                $to_db_house_name = '';
                $to_department_name = '';
                $to_designation_name = '';


                foreach ($employee_names as $employee_names_value) {
                    $transfer_employee_name = $employee_names_value->first_name . ' ' . $employee_names_value->last_name;
                }
                foreach ($from_department_names as $from_department_names_value) {
                    $from_department_name = $from_department_names_value->department_name;
                }
                foreach ($to_department_names as $to_department_names_value) {
                    $to_department_name = $to_department_names_value->department_name;
                }
                foreach ($to_designation_names as $to_designation_names_value) {
                    $to_designation_name = $to_designation_names_value->designation_name;
                }



                foreach ($from_region_names as $from_region_names_value) {
                    $from_region_name = $from_region_names_value->region_name;
                }
                foreach ($from_area_names as $from_department_names_value) {
                    $from_area_name = $from_department_names_value->area_name;
                }
                foreach ($from_territory_names as $from_department_names_value) {
                    $from_territory_name = $from_department_names_value->territory_name;
                }
                foreach ($from_town_names as $from_department_names_value) {
                    $from_town_name = $from_department_names_value->town_name;
                }
                foreach ($from_db_house_names as $from_department_names_value) {
                    $from_db_house_name = $from_department_names_value->db_house_name;
                }

                foreach ($from_designation_names as $from_department_names_value) {
                    $from_designation_name = $from_department_names_value->designation_name;
                }

                foreach ($to_region_names as $to_department_names_value) {
                    $to_region_name = $to_department_names_value->region_name;
                }
                foreach ($to_area_names as $to_department_names_value) {
                    $to_area_name = $to_department_names_value->area_name;
                }
                foreach ($to_territory_names as $to_department_names_value) {
                    $to_territory_name = $to_department_names_value->territory_name;
                }
                foreach ($to_town_names as $to_department_names_value) {
                    $to_town_name = $to_department_names_value->town_name;
                }
                foreach ($to_db_house_names as $to_department_names_value) {
                    $to_db_house_name = $to_department_names_value->db_house_name;
                }



                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'transfer_com_id' => $logged_user_details_value->transfer_com_id,
                    'transfer_employee_id' => $logged_user_details_value->transfer_employee_id,
                    //'travel_department_id' => $logged_user_details_value->travel_department_id,
                    // 'transfer_from_department_id' => $logged_user_details_value->transfer_from_department_id,
                    // 'transfer_to_department_id' => $logged_user_details_value->transfer_to_department_id,
                    // 'transfer_to_designation_id' => $logged_user_details_value->transfer_to_designation_id,

                    'transfer_employee_full_name' => $transfer_employee_name,
                    'transfer_from_region_name' => $from_region_name,
                    'transfer_from_area_name' => $from_area_name,
                    'transfer_from_territory_name' => $from_territory_name,
                    'transfer_from_town_name' => $from_town_name,
                    'transfer_from_db_house_name' => $from_db_house_name,
                    'transfer_from_department_name' => $from_department_name,
                    'transfer_from_designation_name' => $from_designation_name,

                    'transfer_to_department_name' => $to_department_name,
                    'transfer_to_designation_name' =>  $to_designation_name,

                    'transfer_to_region_name' => $to_region_name,
                    'transfer_to_area_name' => $to_area_name,
                    'transfer_to_territory_name' => $to_territory_name,
                    'transfer_to_town_name' => $to_town_name,
                    'transfer_to_db_house_name' => $to_db_house_name,


                    'transfer_date' => $logged_user_details_value->transfer_date,
                    'transfer_desc' => $logged_user_details_value->transfer_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            array_push($details_array, $data = array(
                'id' => 0,
                'transfer_com_id' => 0,
                'transfer_employee_id' => 0,
                //'travel_department_id' => 0,
                // 'transfer_from_department_id' =>0,
                // 'transfer_to_department_id' => 0,
                // 'transfer_to_designation_id' => 0,

                'transfer_employee_full_name' => "-",
                'transfer_from_region_name' => "-",
                'transfer_from_area_name' => "-",
                'transfer_from_territory_name' => "-",
                'transfer_from_town_name' => "-",
                'transfer_from_db_house_name' => "-",
                'transfer_from_department_name' => "-",
                'transfer_from_designation_name' => "-",

                'transfer_to_department_name' => "-",
                'transfer_to_designation_name' => "-",

                'transfer_to_region_name' => "-",
                'transfer_to_area_name' => "-",
                'transfer_to_territory_name' => "-",
                'transfer_to_town_name' => "-",
                'transfer_to_db_house_name' => "-",

                'transfer_date' => "-",
                'transfer_desc' => "-",
                'created_at' => "-",
                'updated_at' => "-",
            ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userTermination(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();

        if (Termination::where('termination_employee_id', $request->termination_employee_id)->exists()) {

            //$logged_user_details = Termination::where('termination_employee_id',$request->termination_employee_id)->get();

            $logged_user_details = Termination::join('users', 'terminations.termination_employee_id', '=', 'users.id')
                ->join('departments', 'terminations.termination_department_id', '=', 'departments.id')
                ->select('terminations.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('termination_employee_id', $request->termination_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'termination_com_id' => $logged_user_details_value->termination_com_id,
                    // 'termination_department_id' => $logged_user_details_value->termination_department_id,
                    // 'termination_employee_id' => $logged_user_details_value->termination_employee_id,

                    'termination_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'termination_department_name' => $logged_user_details_value->department_name,

                    'termination_type' => $logged_user_details_value->termination_type,
                    'termination_desc' => $logged_user_details_value->termination_desc,
                    'termination_date' => $logged_user_details_value->termination_date,
                    'termination_notice_date' => $logged_user_details_value->termination_notice_date,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     'termination_com_id' =>0,
            //     // 'termination_department_id' => 0,
            //     // 'termination_employee_id' =>0,
            //     'termination_employee_name' =>"-",
            //     'termination_department_name' => "-",
            //     'termination_type' => "-",
            //     'termination_desc' =>"-",
            //     'termination_date' => "-",
            //     'termination_notice_date' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userResignation(Request $request)
    {

        $details_array = array();

        if (Resignation::where('resignation_employee_id', $request->resignation_employee_id)->exists()) {


            $logged_user_details = Resignation::join('users', 'resignations.resignation_employee_id', '=', 'users.id')
                ->join('departments', 'resignations.resignation_department_id', '=', 'departments.id')
                ->select('resignations.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('resignation_employee_id', $request->resignation_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'resignation_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'resignation_department_name' => $logged_user_details_value->department_name,
                    'resignation_notice_date' => $logged_user_details_value->resignation_notice_date,
                    'resignation_desc' => $logged_user_details_value->resignation_date,
                    'resignation_desc' => $logged_user_details_value->resignation_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }


    public function userResignationAdd(Request $request)
    {

        $details_array = [];



        if (Resignation::where('resignation_employee_id', $request->resignation_employee_id)->exists()) {
            $logged_user_resignation = Resignation::where('resignation_employee_id', $request->resignation_employee_id)->get();

            foreach ($logged_user_resignation as $logged_user_resignation_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_resignation_value->id,
                    'resignation_com_id' => $logged_user_resignation_value->resignation_com_id,
                    'resignation_employee_id' => $logged_user_resignation_value->resignation_employee_id,
                    'resignation_department_id' => $logged_user_resignation_value->resignation_department_id,
                    'resignation_desc' => $logged_user_resignation_value->resignation_desc,
                    'resignation_notice_date' => $logged_user_resignation_value->resignation_notice_date,
                    'resignation_date' => $logged_user_resignation_value->resignation_date,
                    'created_at' => $logged_user_resignation_value->created_at,
                    'updated_at' => $logged_user_resignation_value->updated_at,
                ));
            }
        }
        if (!$request->resignation_employee_id) {

            return response()->json([
                'success' => false,
                'message' => 'Employee id form field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->resignation_com_id) {

            return response()->json([
                'success' => false,
                'message' => 'Resignation com id form field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->resignation_department_id) {

            return response()->json([
                'success' => false,
                'message' => 'Resignation department id field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->resignation_notice_date) {

            return response()->json([
                'success' => false,
                'message' => 'Resignation resignation_notice_date field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->resignation_date) {

            return response()->json([
                'success' => false,
                'message' => 'Resignation resignation_date field is missing!!!',
                'data' => $details_array,
            ]);
        }
        if (!$request->resignation_desc) {

            return response()->json([
                'success' => false,
                'message' => 'Resignation resignation_desc field is missing!!!',
                'data' => $details_array,
            ]);
        }

        if (Resignation::where('resignation_com_id', $request->resignation_com_id)->where('resignation_employee_id', $request->resignation_employee_id)->exists()) {

            return response()->json([
                'success' => false,
                'message' => "Already Added!!!",
                'data' => $details_array,
            ])->setStatusCode(200);
        } else {


            if (!$request->resignation_employee_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'Employee id form field is missing!!!',
                ]);
            }

            if (!$request->resignation_com_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'Resignation com id form field is missing!!!',

                ]);
            }
            if (!$request->resignation_department_id) {

                return response()->json([
                    'success' => false,
                    'message' => 'Resignation department id field is missing!!!',
                ]);
            }
            if (!$request->resignation_notice_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'Resignation resignation_notice_date field is missing!!!',
                ]);
            }
            if (!$request->resignation_date) {

                return response()->json([
                    'success' => false,
                    'message' => 'Resignation resignation_date field is missing!!!',
                ]);
            }
            if (!$request->resignation_desc) {

                return response()->json([
                    'success' => false,
                    'message' => 'Resignation resignation_desc field is missing!!!',
                ]);
            }

            $resignation = new Resignation();
            $resignation->resignation_com_id = $request->resignation_com_id;
            $resignation->resignation_employee_id = $request->resignation_employee_id;
            $resignation->resignation_department_id = $request->resignation_department_id;
            $resignation->resignation_notice_date = $request->resignation_notice_date;
            $resignation->resignation_date = $request->resignation_date;
            $resignation->resignation_desc = $request->resignation_desc;
            $resignation->save();

            $details_array2 = [];
            if (Resignation::where('resignation_employee_id', $request->resignation_employee_id)->exists()) {

                $logged_user_resignation_details = Resignation::where('resignation_employee_id', $request->resignation_employee_id)->get();

                foreach ($logged_user_resignation_details as $logged_user_resignation_details_value) {

                    array_push($details_array2, $data = array(
                        'id' => $logged_user_resignation_details_value->id,

                        'resignation_com_id' => $logged_user_resignation_details_value->resignation_com_id,
                        'resignation_com_id' => $logged_user_resignation_details_value->resignation_com_id,
                        'resignation_department_id' => $logged_user_resignation_details_value->resignation_department_id,
                        'resignation_notice_date' => $logged_user_resignation_details_value->resignation_notice_date,
                        'resignation_date' => $logged_user_resignation_details_value->resignation_date,
                        'resignation_desc' => $logged_user_resignation_details_value->resignation_desc,

                        'created_at' => $logged_user_resignation_details_value->created_at,
                        'updated_at' => $logged_user_resignation_details_value->updated_at,
                    ));
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Added Successfully',
                    'data' => $details_array2,
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => true,
                    'message' => 'Added Successfully',
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        }
    }



    public function userPromotion(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Promotion::where('promotion_employee_id', $request->promotion_employee_id)->exists()) {

            $logged_user_details = Promotion::where('promotion_employee_id', $request->promotion_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {


                $employee_name = User::where('id', $logged_user_details_value->promotion_employee_id)->get(['first_name', 'last_name']);
                $old_department_name = Department::where('id', $logged_user_details_value->promotion_old_department)->get(['department_name']);
                $new_department_name = Department::where('id', $logged_user_details_value->promotion_new_department)->get(['department_name']);
                $old_designation_name = Designation::where('id', $logged_user_details_value->promotion_old_designation)->get(['designation_name']);
                $new_designation_name = Designation::where('id', $logged_user_details_value->promotion_new_designation)->get(['designation_name']);

                foreach ($employee_name as $employee_name_value) {
                    $promotion_employee_name = $employee_name_value->first_name . ' ' . $employee_name_value->last_name;
                }
                foreach ($old_department_name as $old_department_name_value) {
                    $promotion_old_department_name = $old_department_name_value->department_name;
                }
                foreach ($new_department_name as $new_department_name_value) {
                    $promotion_new_department_name = $new_department_name_value->department_name;
                }
                foreach ($old_designation_name as $old_designation_name_value) {
                    $promotion_old_designation_name = $old_designation_name_value->designation_name;
                }
                foreach ($new_designation_name as $new_designation_name_value) {
                    $promotion_new_designation_name = $new_designation_name_value->designation_name;
                }


                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'promotion_com_id' => $logged_user_details_value->promotion_com_id,
                    // 'promotion_employee_id' => $logged_user_details_value->promotion_employee_id,
                    'promotion_employee_name' => $promotion_employee_name,
                    'promotion_old_department' => $promotion_old_department_name,
                    'promotion_new_department' => $promotion_new_department_name,
                    'promotion_old_designation' => $promotion_old_designation_name,
                    'promotion_new_designation' =>  $promotion_new_designation_name,
                    'promotion_old_gross_salary' => $logged_user_details_value->promotion_old_gross_salary,
                    'promotion_new_gross_salary' => $logged_user_details_value->promotion_new_gross_salary,
                    'promotion_title' => $logged_user_details_value->promotion_title,
                    'promotion_date' => $logged_user_details_value->promotion_date,
                    'promotion_description' => $logged_user_details_value->promotion_description,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     // 'promotion_com_id' => 0,
            //     // 'promotion_employee_id' => 0,
            //     'promotion_employee_name' => "-",
            //     'promotion_old_department' =>  "-",
            //     'promotion_new_department' => "-",
            //     'promotion_old_designation' =>  "-",
            //     'promotion_new_designation' =>  "-",
            //     'promotion_old_gross_salary' => 0,
            //     'promotion_new_gross_salary' =>0,
            //     'promotion_title' =>"-",
            //     'promotion_date' => "-",
            //     'promotion_description' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userComplaint(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Complaint::where('complaint_from_employee_id', $request->complaint_from_employee_id)->exists()) {

            $logged_user_details = Complaint::where('complaint_from_employee_id', $request->complaint_from_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $complaint_from_department = Department::where('id', $logged_user_details_value->complaint_from_department_id)->get(['department_name']);
                $complaint_to_department = Department::where('id', $logged_user_details_value->complaint_to_department_id)->get(['department_name']);
                $complaint_from = User::where('id', $logged_user_details_value->complaint_from_employee_id)->get(['first_name', 'last_name']);
                $complaint_to = User::where('id', $logged_user_details_value->complaint_to_employee_id)->get(['first_name', 'last_name']);

                foreach ($complaint_from_department as $complaint_from_department_value) {
                    $from_department = $complaint_from_department_value->department_name;
                }
                foreach ($complaint_from as $complaint_from_value) {
                    $complaint_from_employee = $complaint_from_value->first_name . ' ' . $complaint_from_value->last_name;
                }
                foreach ($complaint_to_department as $complaint_to_department_value) {
                    $complaint_to_department = $complaint_to_department_value->department_name;
                }
                foreach ($complaint_to as $complaint_to_value) {
                    $complaint_to_employee = $complaint_to_value->first_name . ' ' . $complaint_to_value->last_name;
                }

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'complaint_com_id' => $logged_user_details_value->complaint_com_id,
                    // 'complaint_from_department_id' => $logged_user_details_value->complaint_from_department_id,
                    // 'complaint_from_employee_id' => $logged_user_details_value->complaint_from_employee_id,
                    // 'complaint_to_department_id' => $logged_user_details_value->complaint_to_department_id,
                    // 'complaint_to_employee_id' => $logged_user_details_value->complaint_to_employee_id,

                    'complaint_from_department_name' => $from_department,
                    'complaint_from_employee_name' => $complaint_from_employee,
                    'complaint_to_department_name' => $complaint_to_department,
                    'complaint_to_employee_name' => $complaint_to_employee,

                    'complaint_date' => $logged_user_details_value->complaint_date,
                    'complaint_title' => $logged_user_details_value->complaint_title,
                    'complaint_desc' => $logged_user_details_value->complaint_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     // 'complaint_com_id' =>0,
            //     // 'complaint_from_department_id' => 0,
            //     // 'complaint_from_employee_id' => 0,
            //     // 'complaint_to_department_id' => 0,
            //     // 'complaint_to_employee_id' =>0,

            //     'complaint_from_department_name' =>"-",
            //     'complaint_from_employee_name' =>"-",
            //     'complaint_to_department_name' =>"-",
            //     'complaint_to_employee_name' =>"-",

            //     'complaint_date' => "-",
            //     'complaint_title' =>  "-",
            //     'complaint_desc' =>  "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userWarning(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Warning::where('warning_employee_id', $request->warning_employee_id)->exists()) {

            $logged_user_details = Warning::where('warning_employee_id', $request->warning_employee_id)->get();

            $logged_user_details = Warning::join('users', 'warnings.warning_employee_id', '=', 'users.id')
                ->join('departments', 'warnings.warning_department_id', '=', 'departments.id')
                ->select('warnings.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('warning_employee_id', $request->warning_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'warning_com_id' => $logged_user_details_value->warning_com_id,
                    // 'warning_department_id' => $logged_user_details_value->warning_department_id,
                    // 'warning_employee_id' => $logged_user_details_value->warning_employee_id,
                    'warning_department_name' => $logged_user_details_value->department_name,
                    'warning_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'warning_type' => $logged_user_details_value->warning_type,
                    'warning_subject' => $logged_user_details_value->warning_subject,
                    'warning_desc' => $logged_user_details_value->warning_desc,
                    'warning_date' => $logged_user_details_value->warning_date,
                    'warning_status' => $logged_user_details_value->warning_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' =>0,
            //     // 'warning_com_id' => 0,
            //     // 'warning_department_id' =>0,
            //     // 'warning_employee_id' => 0,
            //     'warning_department_name' =>"-",
            //     'warning_employee_name' => "-",
            //     'warning_type' => "-",
            //     'warning_subject' =>  "-",
            //     'warning_desc' =>  "-",
            //     'warning_date' => "-",
            //     'warning_status' =>  "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userLeave(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Leave::where('leaves_employee_id', $request->leaves_employee_id)->exists()) {

            //$logged_user_details = Leave::where('leaves_employee_id',$request->leaves_employee_id)->get();

            $logged_user_details = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'leave_types.leave_type')
                ->where('leaves_employee_id', $request->leaves_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    //'leaves_company_id' => $logged_user_details_value->leaves_company_id,
                    //'leaves_leave_type_id' => $logged_user_details_value->leaves_leave_type_id,
                    //'leaves_department_id' => $logged_user_details_value->leaves_department_id,
                    //'leaves_designation_id' => $logged_user_details_value->leaves_designation_id,
                    //'leaves_employee_id' => $logged_user_details_value->leaves_employee_id,
                    'leaves_leave_type_name' => $logged_user_details_value->leave_type,
                    'leaves_department_name' => $logged_user_details_value->department_name,
                    'leaves_designation_name' => $logged_user_details_value->designation_name,
                    'leaves_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

                    'leaves_approver_generation_one_id' => $logged_user_details_value->leaves_approver_generation_one_id,
                    'leaves_approver_generation_two_id' => $logged_user_details_value->leaves_approver_generation_two_id,
                    'leaves_start_date' => $logged_user_details_value->leaves_start_date,
                    'leaves_end_date' => $logged_user_details_value->leaves_end_date,
                    'total_days' => $logged_user_details_value->total_days,
                    'leave_reason' => $logged_user_details_value->leave_reason,
                    'leaves_status' => $logged_user_details_value->leaves_status,
                    // 'leaves_region_id' => $logged_user_details_value->leaves_region_id,
                    // 'leaves_area_id' => $logged_user_details_value->leaves_area_id,
                    // 'leaves_territory_id' => $logged_user_details_value->leaves_territory_id,
                    // 'leaves_town_id' => $logged_user_details_value->leaves_town_id,
                    // 'leaves_db_house_id' => $logged_user_details_value->leaves_db_house_id,

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
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     //'leaves_company_id' => 0,
            //     'leaves_leave_type_id' => 0,
            //     // 'leaves_department_id' => 0,
            //     // 'leaves_designation_id' => 0,
            //     // 'leaves_employee_id' => 0,
            //     // 'leaves_approver_generation_one_id' => 0,
            //     // 'leaves_approver_generation_two_id' => 0,
            //     'leaves_leave_type_name' => "-",
            //     'leaves_department_name' => "-",
            //     'leaves_designation_name' =>"-",
            //     'leaves_employee_name' => "-",

            //     'leaves_start_date' => "-",
            //     'leaves_end_date' =>  "-",
            //     'total_days' =>  "-",
            //     'leave_reason' => "-",
            //     'leaves_status' =>  "-",
            //     // 'leaves_region_id' => 0,
            //     // 'leaves_area_id' =>0,
            //     // 'leaves_territory_id' => 0,
            //     // 'leaves_town_id' => 0,
            //     // 'leaves_db_house_id' =>0,

            //     'leaves_region_name' => "-",
            //     'leaves_area_name' => "-",
            //     'leaves_territory_name' =>"-",
            //     'leaves_town_name' => "-",
            //     'leaves_db_house_name' => "-",

            //     'is_half' =>  "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userSupportTicketOwnDetails(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (SupportTicket::where('support_ticket_employee_id', $request->support_ticket_employee_id)->exists()) {

            //$logged_user_details = SupportTicket::where('support_ticket_employee_id',$request->support_ticket_employee_id)->get();

            $logged_user_details = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
                ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('support_ticket_employee_id', $request->support_ticket_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'support_ticket_com_id' => $logged_user_details_value->support_ticket_com_id,
                    // 'support_ticket_department_id' => $logged_user_details_value->support_ticket_department_id,
                    // 'support_ticket_employee_id' => $logged_user_details_value->support_ticket_employee_id,

                    'support_ticket_generation_one_id' => $logged_user_details_value->support_ticket_generation_one_id,
                    'support_ticket_generation_two_id' => $logged_user_details_value->support_ticket_generation_two_id,

                    'support_ticket_department_name' => $logged_user_details_value->department_name,
                    'support_ticket_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

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
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     // 'support_ticket_com_id' =>0,
            //     // 'support_ticket_department_id' => 0,
            //     // 'support_ticket_employee_id' => 0,
            //     // 'support_ticket_generation_one_id' => 0,
            //     // 'support_ticket_generation_two_id' =>0,
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

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userProject(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Project::where('project_com_id', $request->project_com_id)->exists()) {

            $logged_user_details = Project::where('project_com_id', $request->project_com_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                foreach (json_decode($logged_user_details_value->assign_to) as $test) {
                    if ($test == $request->project_employee_id) {

                        $users = User::where('id', $test)->get(['first_name', 'last_name']);
                        $project_workers_name_array = [];
                        foreach ($users as $users_data) {

                            //echo $users_data->first_name.' '.$users_data->last_name;
                            array_push($project_workers_name_array, $users_data->first_name . ' ' . $users_data->last_name);
                            //$project_workers_name['workers_name'] = $users_data->first_name.' '.$users_data->last_name;
                        }
                        //exit;
                        foreach ($project_workers_name_array as $project_workers_name_array_value) {
                            array_push($details_array, $data = array(
                                'id' => $logged_user_details_value->id,
                                //'project_com_id' => $logged_user_details_value->project_com_id,
                                'assign_to' => $project_workers_name_array_value,
                                'project_name' => $logged_user_details_value->project_name,
                                'project_priority' => $logged_user_details_value->project_priority,
                                'project_client_name' => $logged_user_details_value->project_client_name,
                                'project_start_date' => $logged_user_details_value->project_start_date,
                                'project_end_date' => $logged_user_details_value->project_end_date,
                                'progress_progress' => $logged_user_details_value->progress_progress,
                                'created_at' => $logged_user_details_value->created_at,
                                'updated_at' => $logged_user_details_value->updated_at,
                            ));
                        }
                    }
                }
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     //'project_com_id' =>0,
            //     'assign_to' =>0,
            //     'project_name' =>"-",
            //     'project_priority' =>"-",
            //     'project_client_name' =>"-",
            //     'project_start_date' => "-",
            //     'project_end_date' =>"-",
            //     'progress_progress' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userTask(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Task::where('task_com_id', $request->task_com_id)->exists()) {

            $logged_user_details = Task::where('task_com_id', $request->task_com_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                foreach (json_decode($logged_user_details_value->task_assigned_to) as $test) {
                    if ($test == $request->task_employee_id) {

                        $users = User::where('id', $test)->get(['first_name', 'last_name']);
                        $project_workers_name_array = [];
                        foreach ($users as $users_data) {

                            //echo $users_data->first_name.' '.$users_data->last_name;
                            array_push($project_workers_name_array, $users_data->first_name . ' ' . $users_data->last_name);
                            //$project_workers_name['workers_name'] = $users_data->first_name.' '.$users_data->last_name;
                        }
                        //exit;
                        foreach ($project_workers_name_array as $project_workers_name_array_value) {

                            $task_assigned_by_details = User::where('id', $logged_user_details_value->task_assigned_by)->get(['first_name', 'last_name']);
                            if (User::where('id', $logged_user_details_value->task_assigned_by)->exists()) {
                                foreach ($task_assigned_by_details as $task_assigned_by_details_value) {
                                    $task_assigned_by_full_name = $task_assigned_by_details_value->first_name . " " . $task_assigned_by_details_value->last_name;
                                }
                            } else {
                                $task_assigned_by_full_name = '';
                            }

                            array_push($details_array, $data = array(
                                'id' => $logged_user_details_value->id,
                                //'task_com_id' => $logged_user_details_value->task_com_id,
                                'task_assigned_to' => $project_workers_name_array_value,
                                'task_title' => $logged_user_details_value->task_title,
                                'task_start_date' => $logged_user_details_value->task_start_date,
                                'task_end_date' => $logged_user_details_value->task_end_date,
                                //'task_assigned_by' => $logged_user_details_value->task_assigned_by,
                                'task_assigned_by' => $task_assigned_by_full_name,
                                'task_progress' => $logged_user_details_value->task_progress,
                                'created_at' => $logged_user_details_value->created_at,
                                'updated_at' => $logged_user_details_value->updated_at,
                            ));
                        }
                    }
                }
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' =>0,
            //     'task_com_id' => 0,
            //     //'task_assigned_to' => 0,
            //     'task_title' =>"-",
            //     'task_start_date' =>"-",
            //     'task_end_date' =>"-",
            //     'task_assigned_by' =>0,
            //     'task_progress' =>"-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userPaySlip(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (PaySlip::where('pay_slip_employee_id', $request->pay_slip_employee_id)->exists()) {

            $logged_user_details = PaySlip::where('pay_slip_employee_id', $request->pay_slip_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {
                if ($logged_user_details_value->pay_slip_status == 1) {
                    $payslip_status = "Paid";
                } else {
                    $payslip_status = "Unpaid";
                }
                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'pay_slip_com_id' => $logged_user_details_value->pay_slip_com_id,
                    // 'pay_slip_employee_id' => $logged_user_details_value->pay_slip_employee_id,
                    // 'pay_slip_department_id' => $logged_user_details_value->pay_slip_department_id,
                    // 'pay_slip_payment_type' => $logged_user_details_value->pay_slip_payment_type,
                    // 'pay_slip_payment_date' => $logged_user_details_value->pay_slip_payment_date,
                    'pay_slip_month_year' => $logged_user_details_value->pay_slip_month_year,
                    // 'pay_slip_gross_salary' => $logged_user_details_value->pay_slip_gross_salary,
                    // 'pay_slip_basic_salary' => $logged_user_details_value->pay_slip_basic_salary,
                    // 'pay_slip_house_rent' => $logged_user_details_value->pay_slip_house_rent,
                    // 'pay_slip_medical_allowance' => $logged_user_details_value->pay_slip_medical_allowance,
                    // 'pay_slip_festival_bonus' => $logged_user_details_value->pay_slip_festival_bonus,
                    // 'pay_slip_commissions' => $logged_user_details_value->pay_slip_commissions,
                    // 'pay_slip_other_payments' => $logged_user_details_value->pay_slip_other_payments,
                    // 'pay_slip_overtimes' => $logged_user_details_value->pay_slip_overtimes,
                    // 'pay_slip_provident_fund' => $logged_user_details_value->pay_slip_provident_fund,
                    // 'pay_slip_tax_deduction' => $logged_user_details_value->pay_slip_tax_deduction,
                    // 'pay_slip_loans' => $logged_user_details_value->pay_slip_loans,
                    // 'pay_slip_statutory_deduction' => $logged_user_details_value->pay_slip_statutory_deduction,
                    'pay_slip_net_salary' => $logged_user_details_value->pay_slip_net_salary,
                    // 'pay_slip_key' => $logged_user_details_value->pay_slip_key,
                    // 'pay_slip_number' => $logged_user_details_value->pay_slip_number,
                    // 'pay_slip_working_days' => $logged_user_details_value->pay_slip_working_days,
                    'pay_slip_payment_date' => $logged_user_details_value->pay_slip_payment_date,
                    'pay_slip_status' => $payslip_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     // 'pay_slip_com_id' => 0,
            //     // 'pay_slip_employee_id' => 0,
            //     // 'pay_slip_department_id' => 0,
            //     // 'pay_slip_payment_type' => 0,
            //     // 'pay_slip_payment_date' => 0,
            //      'pay_slip_month_year' =>  "-",
            //     // 'pay_slip_gross_salary' =>0,
            //     // 'pay_slip_basic_salary' =>0,
            //     // 'pay_slip_house_rent' => 0,
            //     // 'pay_slip_medical_allowance' => 0,
            //     // 'pay_slip_festival_bonus' => 0,
            //     // 'pay_slip_commissions' => 0,
            //     // 'pay_slip_other_payments' => 0,
            //     // 'pay_slip_overtimes' => 0,
            //     // 'pay_slip_provident_fund' => 0,
            //     // 'pay_slip_tax_deduction' => 0,
            //     // 'pay_slip_loans' => 0,
            //     // 'pay_slip_statutory_deduction' => 0,
            //     'pay_slip_net_salary' => 0,
            //     // 'pay_slip_key' =>  "-",
            //     // 'pay_slip_number' =>  "-",
            //     // 'pay_slip_working_days' => 0,
            //     'pay_slip_status' => "-",
            //     'pay_slip_payment_date' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userIdsAndAppointmentLetters(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Document::where('document_employee_id', $request->document_employee_id)->where('document_type', '=', 'Appointment-Letter')->exists()) {

            $logged_user_details = Document::where('document_employee_id', $request->document_employee_id)->where('document_type', '=', 'Appointment-Letter')->get();

            $logged_user_details = Document::join('users', 'documents.document_employee_id', '=', 'users.id')
                ->select('documents.*', 'users.first_name', 'users.last_name')
                //->where('document_com_id',Auth::user()->com_id)
                ->where('document_employee_id', $request->document_employee_id)
                ->where('document_type', '=', 'Appointment-Letter')
                ->orWhere('document_type', '=', 'Id-Card')
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    //'document_com_id' => $logged_user_details_value->document_com_id,
                    //'document_employee_id' => $logged_user_details_value->document_employee_id,
                    'document_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'document_type' => $logged_user_details_value->document_type,
                    'document_title' => $logged_user_details_value->document_title,
                    'document_date' => $logged_user_details_value->document_date,
                    'document_description' => $logged_user_details_value->document_description,
                    'document_file' => $logged_user_details_value->document_file,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     //'document_com_id' => 0,
            //     //'document_employee_id' => 0,
            //     'document_employee_name' => "-",
            //     'document_type' => "-",
            //     'document_title' => "-",
            //     'document_date' => "-",
            //     'document_description' => "-",
            //     'document_file' => "-",
            //     'created_at' =>"-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userAnnouncement(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Announcement::where('announcement_com_id', $request->announcement_com_id)->exists()) {

            //$logged_user_details = Announcement::where('announcement_com_id',$request->announcement_com_id)->get();
            $logged_user_details = Announcement::join('users', 'announcements.announcement_by', '=', 'users.id')
                ->join('departments', 'announcements.announcement_department_id', '=', 'departments.id')
                ->select('announcements.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('announcement_com_id', $request->announcement_com_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'announcement_com_id' => $logged_user_details_value->announcement_com_id,
                    // 'announcement_by' => $logged_user_details_value->announcement_by,
                    // 'announcement_department_id' => $logged_user_details_value->announcement_department_id,

                    'announcement_by' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'announcement_department_name' => $logged_user_details_value->department_name,

                    'announcement_title' => $logged_user_details_value->announcement_title,
                    'announcement_desc' => $logged_user_details_value->announcement_desc,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array, $data=array(
            //     'id' => 0,
            //     // 'announcement_com_id' => 0,
            //     // 'announcement_by' => 0,
            //     // 'announcement_department_id' => 0,

            //     'announcement_by' => "-",
            //     'announcement_department_name' =>"-",

            //     'announcement_title' =>"-",
            //     'announcement_desc' => "-",
            //     'created_at' =>"-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userCompanyPolicy(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Policy::where('policy_com_id', $request->policy_com_id)->exists()) {

            $logged_user_details = Policy::where('policy_com_id', $request->policy_com_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                $policy_added_by_details = User::where('id', $logged_user_details_value->policy_added_by)->get(['first_name', 'last_name']);

                if (User::where('id', $logged_user_details_value->policy_added_by)->exists()) {
                    foreach ($policy_added_by_details as $policy_added_by_details_value) {
                        $policy_added_by_full_name = $policy_added_by_details_value->first_name . " " . $policy_added_by_details_value->last_name;
                    }
                } else {
                    $policy_added_by_full_name = '';
                }

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    //'policy_com_id' => $logged_user_details_value->policy_com_id,
                    'policy_title' => $logged_user_details_value->policy_title,
                    'policy_desc' => $logged_user_details_value->policy_desc,
                    //'policy_added_by' => $logged_user_details_value->policy_added_by,
                    'policy_added_by' => $policy_added_by_full_name,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     //'policy_com_id' => 0,
            //     'policy_title' => "-",
            //     'policy_desc' => "-",
            //     'policy_added_by' => "-",
            //     'created_at' =>"-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userAttendance(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $current_date = date('Y-m-d');
        $details_array = array();
        if (Attendance::where('employee_id', $request->employee_id)->whereDate('attendance_date', $current_date)->exists()) {

            //$logged_user_details = Attendance::where('employee_id',$request->employee_id)->whereDate('attendance_date',$current_date)->get();

            $logged_user_details = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name')
                ->where('employee_id', $request->employee_id)
                //->where('attendance_com_id',Auth::user()->com_id)
                ->whereDate('attendance_date', $current_date)
                ->get();


            foreach ($logged_user_details as $logged_user_details_value) {


                if ($logged_user_details_value->check_in_out == 1) {
                    $attendance_status = 'Present';
                } else {
                    $attendance_status = 'Absent';
                }

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'attendance_com_id' => $logged_user_details_value->attendance_com_id,
                    // 'employee_id ' => $logged_user_details_value->employee_id ,

                    'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

                    'attendance_date' => $logged_user_details_value->attendance_date,
                    'clock_in' => $logged_user_details_value->clock_in,
                    //'check_in_ip' => $logged_user_details_value->check_in_ip,
                    'clock_out' => $logged_user_details_value->clock_out,
                    //'check_out_ip' => $logged_user_details_value->check_out_ip,
                    'check_in_out' => $logged_user_details_value->check_in_out,
                    'time_late' => $logged_user_details_value->time_late,
                    'early_leaving' => $logged_user_details_value->early_leaving,
                    'overtime' => $logged_user_details_value->overtime,
                    'total_work' => $logged_user_details_value->total_work,
                    'total_rest' => $logged_user_details_value->total_rest,
                    'attendance_status' => $attendance_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     // 'attendance_com_id' =>0,
            //     // 'employee_id ' => 0,
            //     'employee_name' =>"-",
            //     'attendance_date' => "-",
            //     'clock_in' => "-",
            //     //'check_in_ip' => "-",
            //     'clock_out' =>  "-",
            //     //'check_out_ip' => "-",
            //     'check_in_out' =>0,
            //     'time_late' => "-",
            //     'early_leaving' => "-",
            //     'overtime' => "-",
            //     'total_work' => "-",
            //     'total_rest' => "-",
            //     'attendance_status' => "-",
            //     'created_at' =>"-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
                //'data' => [],
            ])->setStatusCode(200);
        }
    }

    public function userDateWiseAttendance(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Attendance::where('employee_id', $request->employee_id)->exists()) {

            //$logged_user_details = Attendance::where('employee_id',$request->employee_id)->get();

            $logged_user_details = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name')
                ->where('employee_id', $request->employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                if ($logged_user_details_value->check_in_out == 1) {
                    $attendance_status = 'Present';
                } else {
                    $attendance_status = 'Absent';
                }

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'attendance_com_id' => $logged_user_details_value->attendance_com_id,
                    // 'employee_id ' => $logged_user_details_value->employee_id ,

                    'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

                    'attendance_date' => $logged_user_details_value->attendance_date,
                    'clock_in' => $logged_user_details_value->clock_in,
                    //'check_in_ip' => $logged_user_details_value->check_in_ip,
                    'clock_out' => $logged_user_details_value->clock_out,
                    //'check_out_ip' => $logged_user_details_value->check_out_ip,
                    'check_in_out' => $logged_user_details_value->check_in_out,
                    'time_late' => $logged_user_details_value->time_late,
                    'early_leaving' => $logged_user_details_value->early_leaving,
                    'overtime' => $logged_user_details_value->overtime,
                    'total_work' => $logged_user_details_value->total_work,
                    'total_rest' => $logged_user_details_value->total_rest,
                    'attendance_status' => $attendance_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     // 'attendance_com_id' =>0,
            //     // 'employee_id ' => 0,

            //     'employee_name' => "-",

            //     'attendance_date' => "-",
            //     'clock_in' => "-",
            //     //'check_in_ip' => "-",
            //     'clock_out' =>  "-",
            //     //'check_out_ip' => "-",
            //     'check_in_out' =>0,
            //     'time_late' => "-",
            //     'early_leaving' => "-",
            //     'overtime' => "-",
            //     'total_work' => "-",
            //     'total_rest' => "-",
            //     'attendance_status' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    // public function userMonthWiseAttendance(Request $request){

    //     //echo $request->commission_employee_id; exit;
    //     $details_array = array();
    //     if(Attendance::where('employee_id',$request->employee_id)->exists()){

    //         $logged_user_details = Attendance::where('employee_id',$request->employee_id)->get();

    //         foreach($logged_user_details as $logged_user_details_value){

    //                  array_push($details_array,$data=array(
    //                     'id' => $logged_user_details_value->id,
    //                     'attendance_com_id' => $logged_user_details_value->attendance_com_id,
    //                     'employee_id ' => $logged_user_details_value->employee_id ,
    //                     'attendance_date' => $logged_user_details_value->attendance_date,
    //                     'clock_in' => $logged_user_details_value->clock_in,
    //                     //'check_in_ip' => $logged_user_details_value->check_in_ip,
    //                     'clock_out' => $logged_user_details_value->clock_out,
    //                     //'check_out_ip' => $logged_user_details_value->check_out_ip,
    //                     'check_in_out' => $logged_user_details_value->check_in_out,
    //                     'time_late' => $logged_user_details_value->time_late,
    //                     'early_leaving' => $logged_user_details_value->early_leaving,
    //                     'overtime' => $logged_user_details_value->overtime,
    //                     'total_work' => $logged_user_details_value->total_work,
    //                     'total_rest' => $logged_user_details_value->total_rest,
    //                     'attendance_status' => $logged_user_details_value->attendance_status,
    //                     'created_at' => $logged_user_details_value->created_at,
    //                     'updated_at' => $logged_user_details_value->updated_at,
    //                 ));
    //         }
    //         return response()->json([
    //             'success' => true,
    //             'data'=>$details_array
    //         ])->setStatusCode(200);

    //     }else{

    //         array_push($details_array,$data=array(
    //             'id' => 0,
    //             'attendance_com_id' =>0,
    //             'employee_id ' => 0,
    //             'attendance_date' => "-",
    //             'clock_in' => "-",
    //             //'check_in_ip' => "-",
    //             'clock_out' =>  "-",
    //             //'check_out_ip' => "-",
    //             'check_in_out' =>0,
    //             'time_late' => "-",
    //             'early_leaving' => "-",
    //             'overtime' => "-",
    //             'total_work' => "-",
    //             'total_rest' => "-",
    //             'attendance_status' => "-",
    //             'created_at' => "-",
    //             'updated_at' =>"-",
    //         ));

    //         return response()->json([
    //         'success' => false,
    //         'data' => $details_array,
    //         ])->setStatusCode(200);

    //     }


    // }

    public function userLeaveApprove(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (Leave::where('leaves_company_id', '=', $request->leaves_company_id)->where('leaves_approver_generation_one_id', '=', $request->leaves_employee_id)->orWhere('leaves_approver_generation_two_id', '=', $request->leaves_employee_id)->exists()) {

            //$logged_user_details = Leave::where('leaves_company_id','=',$request->leaves_company_id)->where('leaves_approver_generation_one_id','=',$request->leaves_employee_id)->orWhere('leaves_approver_generation_two_id','=',$request->leaves_employee_id)->get();

            $logged_user_details = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'leave_types.leave_type')
                ->where('leaves_company_id', $request->leaves_company_id)
                ->where('leaves_status', 'Pending')
                ->where('leaves_approver_generation_one_id', $request->leaves_employee_id)
                ->orWhere('leaves_approver_generation_two_id', $request->leaves_employee_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'leaves_token' => $logged_user_details_value->leaves_token,
                    //'leaves_leave_type_id  ' => $logged_user_details_value->leaves_leave_type_id ,
                    'leaves__type' => $logged_user_details_value->leave_type,
                    'leaves_company_id' => $logged_user_details_value->leaves_company_id,
                    // 'leaves_department_id ' => $logged_user_details_value->leaves_department_id,
                    // 'leaves_designation_id' => $logged_user_details_value->leaves_designation_id,
                    'leaves_employee_id' => $logged_user_details_value->leaves_employee_id,

                    'leaves_department_name' => $logged_user_details_value->department_name,
                    'leaves_designation_name' => $logged_user_details_value->designation_name,
                    'leaves_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

                    'leaves_approver_generation_one_id' => $logged_user_details_value->leaves_approver_generation_one_id,
                    'leaves_approver_generation_two_id' => $logged_user_details_value->leaves_approver_generation_two_id,
                    'leaves_start_date' => $logged_user_details_value->leaves_start_date,
                    'leaves_end_date' => $logged_user_details_value->leaves_end_date,
                    'total_days' => $logged_user_details_value->total_days,
                    'leave_reason' => $logged_user_details_value->leave_reason,
                    'leaves_status' => $logged_user_details_value->leaves_status,
                    // 'leaves_region_id' => $logged_user_details_value->leaves_region_id,
                    // 'leaves_area_id' => $logged_user_details_value->leaves_area_id,
                    // 'leaves_territory_id' => $logged_user_details_value->leaves_territory_id,
                    // 'leaves_town_id' => $logged_user_details_value->leaves_town_id,
                    // 'leaves_db_house_id' => $logged_user_details_value->leaves_db_house_id,

                    'leaves_region_name' => $logged_user_details_value->region_name,
                    'leaves_area_name' => $logged_user_details_value->area_name,
                    'leaves_territory_name' => $logged_user_details_value->territory_name,
                    'leaves_town_name' => $logged_user_details_value->town_name,
                    'leaves_db_house_name' => $logged_user_details_value->db_house_name,

                    'is_half' => $logged_user_details_value->is_half,
                    'is_notify' => $logged_user_details_value->is_notify,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     'leaves_token' => "-",
            //     //'leaves_leave_type_id  ' => 0,
            //     'leaves__type' => "-",
            //     'leaves_company_id' => 0,
            //     // 'leaves_department_id ' => 0,
            //     // 'leaves_designation_id' => 0,
            //      'leaves_employee_id' => 0,

            //     'leaves_department_name' => "-",
            //     'leaves_designation_name' => "-",
            //     'leaves_employee_name' => "-",

            //     'leaves_approver_generation_one_id' => 0,
            //     'leaves_approver_generation_two_id' => 0,
            //     'leaves_start_date' => "-",
            //     'leaves_end_date' =>  "-",
            //     'total_days' =>  "-",
            //     'leave_reason' =>  "-",
            //     'leaves_status' =>  "-",
            //     // 'leaves_region_id' => 0,
            //     // 'leaves_area_id' => 0,
            //     // 'leaves_territory_id' =>0,
            //     // 'leaves_town_id' => 0,
            //     // 'leaves_db_house_id' => 0,

            //     'leaves_region_name' => "-",
            //     'leaves_area_name' =>  "-",
            //     'leaves_territory_name' =>  "-",
            //     'leaves_town_name' =>  "-",
            //     'leaves_db_house_name' =>  "-",

            //     'is_half' =>  "-",
            //     'is_notify' =>  "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userApprovingLeave(Request $request)
    {

        $id = $request->id;
        $leave_approver_id = $request->leave_approver_id;

        $details_array = array();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if (Leave::where('leaves_company_id', '=', $request->leave_approver_com_id)->where('leaves_approver_generation_one_id', '=', $request->leave_approver_id)->orWhere('leaves_approver_generation_two_id', '=', $request->leave_approver_id)->exists()) {

            $logged_user_details = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'leave_types.leave_type')
                ->where('leaves_company_id', $request->leave_approver_com_id)
                ->where('leaves_approver_generation_one_id', $request->leave_approver_id)
                ->where('leaves_status', 'Approved')
                ->orWhere('leaves_approver_generation_two_id', $request->leave_approver_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'leaves_token' => $logged_user_details_value->leaves_token,
                    'leaves__type' => $logged_user_details_value->leave_type,
                    'leaves_company_id' => $logged_user_details_value->leaves_company_id,
                    'leaves_employee_id' => $logged_user_details_value->leaves_employee_id,

                    'leaves_department_name' => $logged_user_details_value->department_name,
                    'leaves_designation_name' => $logged_user_details_value->designation_name,
                    'leaves_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

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
                    'is_notify' => $logged_user_details_value->is_notify,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     'leaves_token' => "-",
            //     'leaves__type' => "-",
            //     'leaves_company_id' => 0,
            //     'leaves_employee_id' => 0,

            //     'leaves_department_name' => "-",
            //     'leaves_designation_name' => "-",
            //     'leaves_employee_name' => "-",

            //     'leaves_approver_generation_one_id' => 0,
            //     'leaves_approver_generation_two_id' => 0,
            //     'leaves_start_date' => "-",
            //     'leaves_end_date' =>  "-",
            //     'total_days' =>  "-",
            //     'leave_reason' =>  "-",
            //     'leaves_status' =>  "-",

            //     'leaves_region_name' => "-",
            //     'leaves_area_name' =>  "-",
            //     'leaves_territory_name' =>  "-",
            //     'leaves_town_name' =>  "-",
            //     'leaves_db_house_name' =>  "-",

            //     'is_half' =>  "-",
            //     'is_notify' =>  "-",
            //     'created_at' => "-",
            //     'updated_at' =>"-",
            // ));


        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////


        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is required!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->leave_approver_id) {

            return response()->json([
                'success' => false,
                'message' => 'leave approver id field is required!!!',
                'data' => $details_array,
            ]);
        }

        // if($request->id){

        //     return response()->json([
        //     'success' => true,
        //      'message'=>'id field is exists!!!',
        //     'data' => $details_array,
        //     ]);
        // }


        if (Leave::where('id', '=', $request->id)->where('leaves_company_id', '=', $request->leave_approver_com_id)->where('leaves_approver_generation_one_id', '=', $request->leave_approver_id)->orWhere('leaves_approver_generation_two_id', '=', $request->leave_approver_id)->exists()) {

            $leave = Leave::find($id);
            $leave->leaves_status = "Approved";
            $leave->save();

            $approver_id = Leave::where('id', '=', $id)->first(['leaves_start_date', 'leaves_end_date', 'leave_reason', 'leaves_employee_id', 'leaves_token']);
            $sender_details = User::where('id', '=', $approver_id->leaves_employee_id)->get(['email', 'first_name', 'last_name']);
            $approvers_details = User::where('id', $leave_approver_id)->get(['first_name', 'last_name']);

            ############### random key generate code starts###########
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
            $random_key = generateRandomString();
            ############### random key generate code staendsrts###########


            foreach ($sender_details as $sender_details_value) {
                foreach ($approvers_details as $approvers_details_value) {

                    $notification = new Notification();
                    $notification->notification_token = $random_key;
                    $notification->notification_com_id = $request->leave_approver_com_id;
                    $notification->notification_type = "Leave-Approved";
                    $notification->notification_title = "Your Leave Request was Approved";
                    $notification->notification_from = $leave_approver_id;
                    $notification->notification_to = $approver_id->leaves_employee_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    if ($approver_id->leaves_token != NULL) {
                        $notification_delete = Notification::where('notification_token', $approver_id->leaves_token)->delete();
                    }

                    $event = new CompanyCalendar();
                    $event->company_calendar_com_id = $request->leave_approver_com_id;
                    $event->company_calendar_employee_id = $approver_id->leaves_employee_id;
                    $event->company_calendar_employee_name = $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->title = "Leave for " . $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->calander_detail_type = "Leave";
                    $event->calander_details = $approver_id->leave_reason;
                    $event->start = $approver_id->leaves_start_date;
                    $event->end = $approver_id->leaves_end_date;
                    $event->save();

                    $data["email"] = $sender_details_value->email;
                    $data["request_receiver_name"] = $approvers_details_value->first_name . ' ' . $approvers_details_value->last_name;
                    $data["subject"] = "Request Acceptance";

                    $receiver_name = array(
                        'request_receiver_name' => $data["request_receiver_name"],
                    );

                    Mail::send('back-end.premium.emails.approve-request', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                    });
                }
            }

            // return response()->json([
            //     'success' => true,
            //     'message' => "Approved Successfully",
            // ])->setStatusCode(200);

            $details_array2 = [];


            if (Leave::where('leaves_company_id', $request->leave_approver_com_id)->where('leaves_approver_generation_one_id', $request->leave_approver_id)->orWhere('leaves_approver_generation_two_id', $request->leave_approver_id)->exists()) {

                $logged_user_details = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                    ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                    ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                    ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                    ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                    ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                    ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                    ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                    ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                    ->select('leaves.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'leave_types.leave_type')
                    ->where('leaves_company_id', $request->leave_approver_com_id)
                    ->where('leaves_approver_generation_one_id', $request->leave_approver_id)
                    ->where('leaves_status', 'Approved')
                    ->orWhere('leaves_approver_generation_two_id', $request->leave_approver_id)
                    ->get();




                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array2, $data = array(
                        'id' => $logged_user_details_value->id,
                        'leaves_token' => $logged_user_details_value->leaves_token,
                        'leaves__type' => $logged_user_details_value->leave_type,
                        'leaves_company_id' => $logged_user_details_value->leaves_company_id,
                        'leaves_employee_id' => $logged_user_details_value->leaves_employee_id,

                        'leaves_department_name' => $logged_user_details_value->department_name,
                        'leaves_designation_name' => $logged_user_details_value->designation_name,
                        'leaves_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,

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
                        'is_notify' => $logged_user_details_value->is_notify,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }
                return response()->json([
                    'success' => true,
                    'message' => "Approved Successfully",
                    'data' => $details_array2
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => "Approving Error!",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        } else {
            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing to Approve!!!",
            // ])->setStatusCode(200);

            return response()->json([
                'success' => false,
                'message' => "Nothing to Approve!!!",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userTravelApprove(Request $request)
    {

        //echo $request->travel_company_id; exit;

        $details_array = array();
        if (Travel::where('travel_com_id', '=', $request->travel_company_id)->where('travel_approver_generation_one_id', '=', $request->travel_approver_id)->orWhere('travel_approver_generation_two_id', '=', $request->travel_approver_id)->exists()) {

            //$logged_user_details = Leave::where('leaves_company_id','=',$request->leaves_company_id)->where('leaves_approver_generation_one_id','=',$request->leaves_employee_id)->orWhere('leaves_approver_generation_two_id','=',$request->leaves_employee_id)->get();

            $logged_user_details = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_status', 'Pending')
                ->where('travel_approver_generation_one_id', $request->travel_approver_id)
                ->orWhere('travel_approver_generation_two_id', $request->travel_approver_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'travel_token' => $logged_user_details_value->travel_token,
                    'travel_com_id' => $logged_user_details_value->travel_com_id,
                    'travel_department_id' => $logged_user_details_value->travel_department_id,
                    'travel_department_id' => $logged_user_details_value->travel_department_id,
                    'travel_department_name' => $logged_user_details_value->department_name,
                    'travel_employee_id' => $logged_user_details_value->travel_employee_id,
                    'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
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
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }


    public function userApprovingTravel(Request $request)
    {
        $id = $request->id;

        $details_array = array();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if (Travel::where('travel_com_id', '=', $request->travel_company_id)->where('travel_approver_generation_one_id', '=', $request->travel_approver_id)->orWhere('travel_approver_generation_two_id', '=', $request->travel_approver_id)->exists()) {

            $logged_user_details = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_approver_generation_one_id', $request->travel_approver_id)
                ->orWhere('travel_approver_generation_two_id', $request->travel_approver_id)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'travel_token' => $logged_user_details_value->travel_token,
                    'travel_com_id' => $logged_user_details_value->travel_com_id,
                    'travel_department_id' => $logged_user_details_value->travel_department_id,
                    'travel_department_id' => $logged_user_details_value->travel_department_id,
                    'travel_department_name' => $logged_user_details_value->department_name,
                    'travel_employee_id' => $logged_user_details_value->travel_employee_id,
                    'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
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
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            // return response()->json([
            //     'success' => true,
            //      'message'=>'se',
            //     'data'=>$details_array
            // ])->setStatusCode(200);

        } else {

            // return response()->json([
            // 'success' => false,
            // 'data' => $details_array,
            // ])->setStatusCode(200);

        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////


        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is required!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->travel_approver_id) {

            return response()->json([
                'success' => false,
                'message' => 'travel approver id field is required!!!',
                'data' => $details_array,
            ]);
        }


        if (Travel::where('travel_com_id', '=', $request->travel_company_id)->where('travel_approver_generation_one_id', '=', $request->travel_approver_id)->orWhere('travel_approver_generation_two_id', '=', $request->travel_approver_id)->exists()) {

            $travel = Travel::find($id);
            $travel->travel_status = "Approved";
            $travel->save();

            $travel_datails = Travel::where('id', '=', $id)->first(['travel_start_date', 'travel_end_date', 'travel_purpose', 'travel_employee_id', 'travel_token']);
            $sender_details = User::where('id', '=', $travel_datails->travel_employee_id)->get(['email', 'first_name', 'last_name']);
            $approvers_details = User::where('id', $request->travel_company_id)->get(['first_name', 'last_name']);

            ############### random key generate code starts###########
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
            $random_key = generateRandomString();
            ############### random key generate code staendsrts###########


            foreach ($sender_details as $sender_details_value) {
                foreach ($approvers_details as $approvers_details_value) {

                    $notification = new Notification();
                    $notification->notification_token = $random_key;
                    $notification->notification_com_id = $request->travel_company_id;
                    $notification->notification_type = "Travel-Approved";
                    $notification->notification_title = "Your Travel Request was Approved";
                    $notification->notification_from = $request->travel_approver_id;
                    $notification->notification_to = $travel_datails->travel_employee_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    if ($travel_datails->travel_token != NULL) {
                        $notification_delete = Notification::where('notification_token', $travel_datails->travel_token)->delete();
                    }

                    $event = new CompanyCalendar();
                    $event->company_calendar_com_id = $request->travel_company_id;
                    $event->company_calendar_employee_id = $travel_datails->travel_employee_id;
                    $event->company_calendar_employee_name = $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->title = "Travel for " . $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->calander_detail_type = "Travel";
                    $event->calander_details = $travel_datails->travel_purpose;
                    $event->start = $travel_datails->travel_start_date;
                    $event->end = $travel_datails->travel_end_date;
                    $event->save();

                    $data["email"] = $sender_details_value->email;
                    $data["request_receiver_name"] = $approvers_details_value->first_name . ' ' . $approvers_details_value->last_name;
                    $data["subject"] = "Request Acceptance";

                    $receiver_name = array(
                        'request_receiver_name' => $data["request_receiver_name"],
                    );

                    Mail::send('back-end.premium.emails.travel-approved', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                    });
                }
            }

            // return response()->json([
            //     'success' => true,
            //     'message' => "Approved Successfully",
            // ])->setStatusCode(200);

            $details_array2 = [];

            if (Travel::where('travel_com_id', '=', $request->travel_company_id)->where('travel_approver_generation_one_id', '=', $request->travel_approver_id)->orWhere('travel_approver_generation_two_id', '=', $request->travel_approver_id)->exists()) {

                //$logged_user_details = Leave::where('leaves_company_id','=',$request->leaves_company_id)->where('leaves_approver_generation_one_id','=',$request->leaves_employee_id)->orWhere('leaves_approver_generation_two_id','=',$request->leaves_employee_id)->get();

                $logged_user_details = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                    ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                    ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                    ->where('travel_approver_generation_one_id', $request->travel_approver_id)
                    ->orWhere('travel_approver_generation_two_id', $request->travel_approver_id)
                    ->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array2, $data = array(
                        'id' => $logged_user_details_value->id,
                        'travel_token' => $logged_user_details_value->travel_token,
                        'travel_com_id' => $logged_user_details_value->travel_com_id,
                        'travel_department_id' => $logged_user_details_value->travel_department_id,
                        'travel_department_id' => $logged_user_details_value->travel_department_id,
                        'travel_department_name' => $logged_user_details_value->department_name,
                        'travel_employee_id' => $logged_user_details_value->travel_employee_id,
                        'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
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
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }
                return response()->json([
                    'success' => true,
                    'message' => "Approved Successfully!!!",
                    'data' => $details_array2
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => "Approved!!!",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing to Approve!!!",
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userWorkingOnSupportTicket(Request $request)
    {

        //echo $request->commission_employee_id; exit;
        $details_array = array();
        if (SupportTicket::where('support_ticket_com_id', '=', $request->support_ticket_com_id)->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)->exists()) {

            //$logged_user_details = SupportTicket::where('support_ticket_com_id','=',$request->support_ticket_com_id)->where('support_ticket_generation_one_id',$request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id',$request->support_ticket_opener_id)->get();

            $logged_user_details = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
                ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('support_ticket_com_id', $request->support_ticket_com_id)
                ->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)
                ->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)
                ->get();
            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    //'support_ticket_token' => $logged_user_details_value->support_ticket_token,
                    // 'support_ticket_com_id' => $logged_user_details_value->support_ticket_com_id,
                    // 'support_ticket_department_id' => $logged_user_details_value->support_ticket_department_id,
                    'support_ticket_employee_id' => $logged_user_details_value->support_ticket_employee_id,
                    'support_ticket_generation_one_id' => $logged_user_details_value->support_ticket_generation_one_id,
                    'support_ticket_generation_two_id' => $logged_user_details_value->support_ticket_generation_two_id,
                    'support_ticket_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'support_ticket_department_name' => $logged_user_details_value->department_name,
                    'support_ticket_priority' => $logged_user_details_value->support_ticket_priority,
                    'support_ticket_subject' => $logged_user_details_value->support_ticket_subject,
                    'support_ticket_note' => $logged_user_details_value->support_ticket_note,
                    'support_ticket_date' => $logged_user_details_value->support_ticket_date,
                    'support_ticket_attachment' => $logged_user_details_value->support_ticket_attachment,
                    'support_ticket_desc' => $logged_user_details_value->support_ticket_desc,
                    'support_ticket_status' => $logged_user_details_value->support_ticket_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     // 'support_ticket_token' => "-",
            //     // 'support_ticket_com_id' =>0,
            //     // 'support_ticket_department_id' => 0,
            //     // 'support_ticket_employee_id' => 0,
            //     // 'support_ticket_generation_one_id' => 0,
            //     // 'support_ticket_generation_two_id' => 0,
            //     'support_ticket_employee_name' => "-",
            //     'support_ticket_department_name' =>"-",
            //     'support_ticket_priority' => "-",
            //     'support_ticket_subject' => "-",
            //     'support_ticket_note' => "-",
            //     'support_ticket_date' => "-",
            //     'support_ticket_attachment' => "-",
            //     'support_ticket_desc' =>"-",
            //     'support_ticket_status' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userSupportTicketUpdate(Request $request)
    {
        // echo 'ok'; exit;
        $details_array = array();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (SupportTicket::where('id', '=', $request->id)->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)->exists()) {

            $support_ticket_com_ids = SupportTicket::where('id', '=', $request->id)->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)->get();

            foreach ($support_ticket_com_ids as $support_ticket_com_ids_value) {

                $logged_user_details = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                    ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
                    ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                    ->where('support_ticket_com_id', $support_ticket_com_ids_value->support_ticket_com_id)
                    ->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)
                    ->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)
                    ->get();

                foreach ($logged_user_details as $logged_user_details_value) {

                    array_push($details_array, $data = array(
                        'id' => $logged_user_details_value->id,
                        'support_ticket_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                        'support_ticket_department_name' => $logged_user_details_value->department_name,
                        'support_ticket_priority' => $logged_user_details_value->support_ticket_priority,
                        'support_ticket_subject' => $logged_user_details_value->support_ticket_subject,
                        'support_ticket_note' => $logged_user_details_value->support_ticket_note,
                        'support_ticket_date' => $logged_user_details_value->support_ticket_date,
                        'support_ticket_attachment' => $logged_user_details_value->support_ticket_attachment,
                        'support_ticket_desc' => $logged_user_details_value->support_ticket_desc,
                        'support_ticket_status' => $logged_user_details_value->support_ticket_status,
                        'created_at' => $logged_user_details_value->created_at,
                        'updated_at' => $logged_user_details_value->updated_at,
                    ));
                }
            }
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     'support_ticket_employee_name' => "-",
            //     'support_ticket_department_name' =>"-",
            //     'support_ticket_priority' => "-",
            //     'support_ticket_subject' => "-",
            //     'support_ticket_note' => "-",
            //     'support_ticket_date' => "-",
            //     'support_ticket_attachment' => "-",
            //     'support_ticket_desc' =>"-",
            //     'support_ticket_status' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        if (!$request->id) {

            return response()->json([
                'success' => false,
                'message' => 'id field is required!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->support_ticket_opener_id) {

            return response()->json([
                'success' => false,
                'message' => 'support ticket opener id field is required!!!',
                'data' => $details_array,
            ]);
        }

        if (!$request->support_ticket_status) {

            return response()->json([
                'success' => false,
                'message' => 'support ticket status field is required!!!',
                'data' => $details_array,
            ]);
        }



        if (SupportTicket::where('id', '=', $request->id)->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)->exists()) {
            $support_ticket = SupportTicket::find($request->id);
            $support_ticket->support_ticket_status = $request->support_ticket_status;
            $support_ticket->save();

            ############### random key generate code starts###########
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
            $random_key = generateRandomString();
            ############### random key generate code staendsrts###########


            if ($request->support_ticket_status == 'Opened') {

                $support_ticket_employee_details = SupportTicket::where('id', '=', $request->id)->get(['support_ticket_com_id', 'support_ticket_employee_id']);

                foreach ($support_ticket_employee_details as $support_ticket_employee_details_id) {

                    $users = User::where('id', '=', $support_ticket_employee_details_id->support_ticket_employee_id)->get(['email', 'first_name', 'last_name', 'report_to_parent_id']);

                    foreach ($users as $users) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = $support_ticket_employee_details_id->support_ticket_com_id;
                        $notification->notification_type = "Support-Updated";
                        $notification->notification_title = "Support Ticket Opened";
                        $notification->notification_from = $users->report_to_parent_id;
                        $notification->notification_to = $support_ticket_employee_details_id->support_ticket_employee_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $data["email"] = $users->email;
                        $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Support Status";

                        $receiver_name = array(
                            'pay_slip_net_salary' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.support-open-status', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                }
            } elseif ($request->support_ticket_status == 'Closed') {

                $support_ticket_employee_details = SupportTicket::where('id', '=', $request->id)->get(['support_ticket_com_id', 'support_ticket_employee_id']);

                foreach ($support_ticket_employee_details as $support_ticket_employee_details_id) {

                    $users = User::where('id', '=', $support_ticket_employee_details_id->support_ticket_employee_id)->get(['email', 'first_name', 'last_name', 'report_to_parent_id']);

                    foreach ($users as $users) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = $support_ticket_employee_details_id->support_ticket_com_id;
                        $notification->notification_type = "Support-Updated";
                        $notification->notification_title = "Support Ticket Closed";
                        $notification->notification_from = $users->report_to_parent_id;
                        $notification->notification_to = $support_ticket_employee_details_id->support_ticket_employee_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $data["email"] = $users->email;
                        $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Support Status";

                        $receiver_name = array(
                            'pay_slip_net_salary' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.support-close-status', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                }
            }



            $details_array2 = [];

            if (SupportTicket::where('id', '=', $request->id)->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)->exists()) {

                $support_ticket_com_ids = SupportTicket::where('id', '=', $request->id)->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)->get();

                foreach ($support_ticket_com_ids as $support_ticket_com_ids_value) {

                    $logged_user_details = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                        ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
                        ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                        ->where('support_ticket_com_id', $support_ticket_com_ids_value->support_ticket_com_id)
                        ->where('support_ticket_generation_one_id', $request->support_ticket_opener_id)
                        ->orWhere('support_ticket_generation_two_id', $request->support_ticket_opener_id)
                        ->get();

                    foreach ($logged_user_details as $logged_user_details_value) {

                        array_push($details_array2, $data = array(
                            'id' => $logged_user_details_value->id,
                            'support_ticket_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                            'support_ticket_department_name' => $logged_user_details_value->department_name,
                            'support_ticket_priority' => $logged_user_details_value->support_ticket_priority,
                            'support_ticket_subject' => $logged_user_details_value->support_ticket_subject,
                            'support_ticket_note' => $logged_user_details_value->support_ticket_note,
                            'support_ticket_date' => $logged_user_details_value->support_ticket_date,
                            'support_ticket_attachment' => $logged_user_details_value->support_ticket_attachment,
                            'support_ticket_desc' => $logged_user_details_value->support_ticket_desc,
                            'support_ticket_status' => $logged_user_details_value->support_ticket_status,
                            'created_at' => $logged_user_details_value->created_at,
                            'updated_at' => $logged_user_details_value->updated_at,
                        ));
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => "Updated Successfully",
                    'data' => $details_array2,
                ])->setStatusCode(200);
            } else {

                return response()->json([
                    'success' => true,
                    'message' => "Updated Successfully",
                    'data' => $details_array,
                ])->setStatusCode(200);
            }

            // return response()->json([
            //     'success' => false,
            //     'message' => "Updated Successfully",
            // ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'message' => "Nothing To Update",
                'data' => $details_array,
            ])->setStatusCode(200);

            // return response()->json([
            //     'success' => false,
            //     'message' => "Nothing To Update",
            // ])->setStatusCode(200);

        }
    }

    public function userAsset(Request $request)
    {

        //echo $request->asset_employee_id; exit;
        $details_array = array();
        if (Asset::where('asset_com_id', $request->asset_com_id)->where('asset_employee_id', $request->asset_employee_id)->exists()) {

            //echo "ok"; exit;

            //$logged_user_details = Asset::with('assetuser','assetdepartment')->where('asset_com_id',$request->asset_com_id)->where('asset_employee_id',$request->asset_employee_id)->get();

            $logged_user_details = Asset::join('users', 'assets.asset_employee_id', '=', 'users.id')
                ->join('departments', 'assets.asset_department_id', '=', 'departments.id')
                ->select('assets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('asset_com_id', $request->asset_com_id)
                ->where('asset_employee_id', $request->asset_employee_id)
                ->get();

            //echo json_encode($logged_user_details); exit;

            foreach ($logged_user_details as $logged_user_details_value) {

                //echo $logged_user_details_value->department_name; exit;

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    //'asset_com_id' => $logged_user_details_value->asset_com_id,
                    //'asset_department_id' => $logged_user_details_value->asset_department_id,
                    //'asset_employee_id' => $logged_user_details_value->asset_employee_id,
                    'asset_department_name' => $logged_user_details_value->department_name,
                    'asset_employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'asset_name' => $logged_user_details_value->asset_name,
                    'asset_code' => $logged_user_details_value->asset_code,
                    'asset_category_name' => $logged_user_details_value->asset_category_name,
                    'asset_is_working' => $logged_user_details_value->asset_is_working,
                    'asset_purchase_date' => $logged_user_details_value->asset_purchase_date,
                    'asset_warranty_end_date' => $logged_user_details_value->asset_warranty_end_date,
                    'asset_manufacturer' => $logged_user_details_value->asset_manufacturer,
                    'asset_serial_number' => $logged_user_details_value->asset_serial_number,
                    'asset_note' => $logged_user_details_value->asset_note,
                    'asset_image' => $logged_user_details_value->asset_image,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' =>0,
            //     // 'asset_com_id' =>0,
            //     // 'asset_department_id' =>0,
            //     // 'asset_employee_id' => 0,
            //     'asset_department_name' =>"-",
            //     'asset_employee_name' =>"-",
            //     'asset_name' => "-",
            //     'asset_code' => "-",
            //     'asset_category_name' =>"-",
            //     'asset_is_working' => "-",
            //     'asset_purchase_date' => "-",
            //     'asset_warranty_end_date' => "-",
            //     'asset_manufacturer' => "-",
            //     'asset_serial_number' => "-",
            //     'asset_note' => "-",
            //     'asset_image' =>"-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userCalendar(Request $request)
    {

        //echo $request->asset_com_id; exit;
        $where = array('id' => $request->id);
        $details_array = array();
        if (CompanyCalendar::where('company_calendar_com_id', $request->company_calendar_com_id)->where('company_calendar_employee_id', $request->company_calendar_employee_id)->exists()) {

            $logged_user_details = CompanyCalendar::where('company_calendar_com_id', $request->company_calendar_com_id)->where('company_calendar_employee_id', $request->company_calendar_employee_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    // 'company_calendar_com_id' => $logged_user_details_value->company_calendar_com_id,
                    // 'company_calendar_unique_key' => $logged_user_details_value->company_calendar_unique_key,
                    'company_calendar_employee_id' => $logged_user_details_value->company_calendar_employee_id,
                    'company_calendar_employee_name' => $logged_user_details_value->company_calendar_employee_name,
                    'title' => $logged_user_details_value->title,
                    'calander_detail_type' => $logged_user_details_value->calander_detail_type,
                    'start' => $logged_user_details_value->start,
                    'end' => $logged_user_details_value->end,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     // 'company_calendar_com_id' => 0,
            //     // 'company_calendar_unique_key' => "-",
            //     'company_calendar_employee_id' => 0,
            //     'company_calendar_employee_name' => "-",
            //     'title' => "-",
            //     'calander_detail_type' => "-",
            //     'start' =>"-",
            //     'end' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userLeaveType(Request $request)
    {

        //echo $request->asset_com_id; exit;
        $details_array = array();
        if (LeaveType::where('leave_type_company_id', $request->leave_type_company_id)->exists()) {

            $logged_user_details = LeaveType::where('leave_type_company_id', $request->leave_type_company_id)->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'leave_type' => $logged_user_details_value->leave_type,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            array_push($details_array, $data = array(
                'id' => 0,
                'leave_type' => "-",
                'created_at' => "-",
                'updated_at' => "-",
            ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userArrangementType(Request $request)
    {

        //echo $request->asset_com_id; exit;
        $details_array = array();
        if (VariableMethod::where('variable_method_com_id', $request->variable_method_com_id)->where('variable_method_category', '=', 'Arrangement')->exists()) {

            $logged_user_details = VariableMethod::where('variable_method_com_id', $request->variable_method_com_id)->where('variable_method_category', '=', 'Arrangement')->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'variable_method_name' => $logged_user_details_value->variable_method_name,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            array_push($details_array, $data = array(
                'id' => 0,
                'variable_method_name' => "-",
                'created_at' => "-",
                'updated_at' => "-",
            ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userTicketPriority(Request $request)
    {
        $details_array = array();
        $logged_user_details = array("Critical", "High", "Medium", "Low");

        foreach ($logged_user_details as $logged_user_details_value) {
            array_push($details_array, $data = array(
                'support_ticket_priority' => $logged_user_details_value,
            ));
        }
        return response()->json([
            'success' => true,
            'data' => $details_array
        ])->setStatusCode(200);
    }

    public function userSupportTicketStatus(Request $request)
    {
        $details_array = array();
        $logged_user_details = array("Pending", "Opened", "Closed");

        foreach ($logged_user_details as $logged_user_details_value) {
            array_push($details_array, $data = array(
                'support_ticket_status' => $logged_user_details_value,
            ));
        }
        return response()->json([
            'success' => true,
            'data' => $details_array
        ])->setStatusCode(200);
    }

    public function userImmigrationDoccumentType(Request $request)
    {
        $details_array = array();
        $logged_user_details = array("VIP", "VVIP");

        foreach ($logged_user_details as $logged_user_details_value) {
            array_push($details_array, $data = array(
                'immigrant_document_type' => $logged_user_details_value,
            ));
        }
        return response()->json([
            'success' => true,
            'data' => $details_array
        ])->setStatusCode(200);
    }

    public function userDoccumentType(Request $request)
    {
        $details_array = array();
        $logged_user_details = array("Certificate", "Appointment-Letter", "Id-Card", "Other");

        foreach ($logged_user_details as $logged_user_details_value) {
            array_push($details_array, $data = array(
                'document_type' => $logged_user_details_value,
            ));
        }
        return response()->json([
            'success' => true,
            'data' => $details_array
        ])->setStatusCode(200);
    }

    public function userEducationLevel(Request $request)
    {

        //echo $request->asset_com_id; exit;
        $details_array = array();
        if (VariableMethod::where('variable_method_com_id', $request->variable_method_com_id)->where('variable_method_category', '=', 'Qualification')->exists()) {

            $logged_user_details = VariableMethod::where('variable_method_com_id', $request->variable_method_com_id)->where('variable_method_category', '=', 'Qualification')->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'qualification_education_level' => $logged_user_details_value->variable_method_name,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' => 0,
            //     'qualification_education_level' => "-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userBankAccountType(Request $request)
    {
        $details_array = array();
        $logged_user_details = array("Mobile Banking", "Core Banking");

        foreach ($logged_user_details as $logged_user_details_value) {
            array_push($details_array, $data = array(
                'bank_account_type' => $logged_user_details_value,
            ));
        }
        return response()->json([
            'success' => true,
            'data' => $details_array
        ])->setStatusCode(200);
    }

    public function userMobileBill(Request $request)
    {

        // echo $request->employee_id; exit;

        if (User::where('id', $request->employee_id)->where('com_id', $request->com_id)->whereNotNull('mobile_bill')->exists()) {

            $logged_user_details = User::where('id', $request->employee_id)->where('com_id', $request->com_id)->whereNotNull('mobile_bill')->get(['id', 'mobile_bill', 'created_at', 'updated_at']);

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'mobile_bill' => $logged_user_details_value->mobile_bill,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );

                return response()->json([
                    'success' => true,
                    'data' => $data
                ])->setStatusCode(200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Value Not Set Yet!!!",
            ])->setStatusCode(200);
        }
    }

    public function userTransportAllowance(Request $request)
    {

        //echo $request->asset_com_id; exit;

        if (User::where('id', $request->employee_id)->where('com_id', $request->com_id)->whereNotNull('transport_allowance')->exists()) {

            $logged_user_details = User::where('id', $request->employee_id)->where('com_id', $request->com_id)->whereNotNull('transport_allowance')->get(['id', 'transport_allowance', 'created_at', 'updated_at']);

            foreach ($logged_user_details as $logged_user_details_value) {

                $data = array(
                    'id' => $logged_user_details_value->id,
                    'transport_allowance' => $logged_user_details_value->transport_allowance,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                );

                return response()->json([
                    'success' => true,
                    'data' => $data
                ])->setStatusCode(200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Value Not Set Yet!!!",
            ])->setStatusCode(200);
        }
    }

    public function userUnseenNotificationCount(Request $request)
    {

        //echo $request->com_id; exit;

        ##### previous
        $previous_startDate = date('Y-m-d', strtotime('-7 days'));
        $previous_endDate = date("Y-m-d", strtotime('+1 days'));
        ##### previous ends

        if (Notification::where('notification_to', $request->employee_id)->where('notification_com_id', $request->com_id)->exists()) {

            $announcement_counts = Notification::where('notification_com_id', $request->com_id)
                ->where('notification_type', '=', 'Announcement')
                ->where('notification_status', '=', 'Unseen')
                ->where(function ($query) use ($previous_startDate, $previous_endDate) {
                    $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])
                        ->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
                })
                ->count();

            $notifications_counts = Notification::where('notification_com_id', $request->com_id)
                ->where('notification_to', $request->employee_id)
                ->where('notification_status', '=', 'Unseen')
                ->where(function ($query) use ($previous_startDate, $previous_endDate) {
                    $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])
                        ->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
                })
                ->count();

            $all_notifications = $notifications_counts + $announcement_counts;

            $data = array(
                'id' => $request->employee_id,
                'number_of_notification' => $all_notifications,
            );

            return response()->json([
                'success' => true,
                'data' => $data
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Notification Not Found!!!",
            ])->setStatusCode(200);
        }
    }


    public function userNotification(Request $request)
    {

        //echo $request->asset_com_id; exit;

        ##### previous
        $previous_startDate = date('Y-m-d', strtotime('-7 days'));
        $previous_endDate = date("Y-m-d", strtotime('+1 days'));
        ##### previous ends

        $details_array = array();

        if (Notification::where('notification_to', $request->employee_id)->where('notification_com_id', $request->com_id)->exists()) {

            $announcement_details = Notification::where('notification_com_id', $request->com_id)
                ->where('notification_type', '=', 'Announcement')
                ->where(function ($query) use ($previous_startDate, $previous_endDate) {
                    $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])
                        ->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
                })
                ->get();

            $logged_user_details = Notification::where('notification_com_id', $request->com_id)
                ->where('notification_to', $request->employee_id)
                ->where(function ($query) use ($previous_startDate, $previous_endDate) {
                    $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])
                        ->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
                })
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'notification_type' => $logged_user_details_value->notification_type,
                    'notification_title' => $logged_user_details_value->notification_title,
                    //'notification_to' => $logged_user_details_value->notification_to,
                    'notification_status' => $logged_user_details_value->notification_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }

            foreach ($announcement_details as $announcement_details_value) {

                array_push($details_array, $data = array(
                    'id' => $announcement_details_value->id,
                    'notification_type' => $announcement_details_value->notification_type,
                    'notification_title' => $announcement_details_value->notification_title,
                    //'notification_to' => $announcement_details_value->notification_to,
                    'notification_status' => $announcement_details_value->notification_status,
                    'created_at' => $announcement_details_value->created_at,
                    'updated_at' => $announcement_details_value->updated_at,
                ));
            }

            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            // array_push($details_array,$data=array(
            //     'id' =>0,
            //     'notification_type' => "-",
            //     'notification_title' => "-",
            //     //'notification_to' => 0,
            //     'notification_status' =>"-",
            //     'created_at' => "-",
            //     'updated_at' => "-",
            // ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }

    public function userDeviceTokenSave(Request $request)
    {

        $validated = $request->validate([
            'company_id' => 'required',
            'employee_id' => 'required',
            'device_token' => 'required',
        ]);

        if (User::where('id', $request->employee_id)->where('com_id', $request->company_id)->exists()) {
            $user = User::find($request->employee_id);
            $user->device_token = $request->device_token;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Saved'
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Nothing to Change",
            ])->setStatusCode(200);
        }
    }

    public function sendNotification(Request $request)
    {

        $validated = $request->validate([
            'com_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);
        //$firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $firebaseTokens = User::where('com_id', $request->com_id)->whereNotNull('device_token')->get(['device_token']);
        //$firebaseTokens = User::where('com_id',Auth::user()->com_id)->whereNotNull('device_token')->get(['device_token']);
        //$firebaseToken = User::where('id',7975)->pluck('device_token')->all();

        // echo json_encode($firebaseToken);

        $SERVER_API_KEY = 'AAAAmyJq3eE:APA91bHOr3wzgheEkY2lsdwOqIMKtUmZ48VXV1_ZS1HKpp7KkyInrzA-QuvcPE_7spNaMc0xm4GE_iI6HK4qg_LLTnMcb54kkBisbK8IWEMYM4Rti2HoFvxxqpUZIowhlxahPOAC9SFr';
        $details_array = array();
        foreach ($firebaseTokens as $firebaseTokens_value) {

            $data = [
                "registration_ids" => [$firebaseTokens_value->device_token],
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->body,
                ]
            ];

            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);

            array_push($details_array, $response);
        }
        //dd($details_array);
        //echo json_encode($response);

        return response()->json([
            'success' => true,
            'message' => 'Sent'
        ])->setStatusCode(200);
    }

    public function attendanceStatusForToday(Request $request)
    {

        // $validated = $request->validate([
        //     'attendance_com_id' => 'required',
        //     'employee_id' => 'required',
        //     //'attendance_date' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'attendance_com_id' => 'required',
                'employee_id' => 'required',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');

        if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', $request->attendance_com_id)->where('attendance_date', $current_date)->exists()) {
            return response()->json([
                'success' => true,
                'attendance_status' => 'Present',
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'attendance_status' => 'Absent',
            ])->setStatusCode(200);
        }
    }

    public function userDesignation(Request $request)
    {

        // $validated = $request->validate([
        //     'company_id' => 'required',
        //     'designation_id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'company_id' => 'required',
                'designation_id' => 'required',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        if (Designation::where('id', $request->designation_id)->where('designation_com_id', $request->company_id)->exists()) {

            $desginations = Designation::where('id', $request->designation_id)->where('designation_com_id', $request->company_id)->get('designation_name');
            foreach ($desginations as $desginations_value) {
                return response()->json([
                    'success' => true,
                    'designation_name' => $desginations_value->designation_name,
                ])->setStatusCode(200);
            }
        } else {
            return response()->json([
                'success' => false,
                'designation_name' => 'Not Found!!!',
            ])->setStatusCode(200);
        }
    }

    public function userOfficeShift(Request $request)
    {

        // $validated = $request->validate([
        //     'company_id' => 'required',
        //     'office_shift_id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'company_id' => 'required',
                'office_shift_id' => 'required',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        if (OfficeShift::where('id', $request->office_shift_id)->where('office_shift_com_id', $request->company_id)->exists()) {

            $office_shifts = OfficeShift::where('id', $request->office_shift_id)->where('office_shift_com_id', $request->company_id)->get('shift_name');
            foreach ($office_shifts as $office_shifts_value) {
                return response()->json([
                    'success' => true,
                    'shift_name' => $office_shifts_value->shift_name,
                ])->setStatusCode(200);
            }
        } else {
            return response()->json([
                'success' => false,
                'shift_name' => 'Not Found!!!',
            ])->setStatusCode(200);
        }
    }

    public function userOfficeShiftTime(Request $request)
    {

        // $validated = $request->validate([
        //     'company_id' => 'required',
        //     'office_shift_id' => 'required',
        // ]);

        $validator = \Validator::make(
            $request->all(),
            [
                'company_id' => 'required',
                'office_shift_id' => 'required',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        if (OfficeShift::where('id', $request->office_shift_id)->where('office_shift_com_id', $request->company_id)->exists()) {

            $office_shifts = OfficeShift::where('id', $request->office_shift_id)->where('office_shift_com_id', $request->company_id)->get();
            foreach ($office_shifts as $office_shifts_value) {


                $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
                $current_date = $date->format('Y-m-d');
                $current_day_name = date('D', strtotime($current_date));
                //$current_day_name = date('D', strtotime("2022-01-01"));


                if ($current_day_name == "Sun") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->sunday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->sunday_out)),
                    ])->setStatusCode(200);
                } elseif ($current_day_name == "Mon") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->monday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->monday_out)),
                    ])->setStatusCode(200);
                } elseif ($current_day_name == "Tue") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->tuesday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->tuesday_out)),
                    ])->setStatusCode(200);
                } elseif ($current_day_name == "Wed") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->wednesday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->wednesday_out)),
                    ])->setStatusCode(200);
                } elseif ($current_day_name == "Thu") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->thursday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->thursday_out)),
                    ])->setStatusCode(200);
                } elseif ($current_day_name == "Fri") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->friday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->friday_out)),
                    ])->setStatusCode(200);
                } elseif ($current_day_name == "Sat") {

                    return response()->json([
                        'success' => true,
                        'shift_time' => date('g:i A', strtotime($office_shifts_value->saturday_in)) . " To " . date('g:i A', strtotime($office_shifts_value->saturday_out)),
                    ])->setStatusCode(200);
                }

                // return response()->json([
                //     'success' => true,
                //     'shift_name'=>$office_shifts_value->shift_name,
                // ])->setStatusCode(200);
            }
        } else {
            return response()->json([
                'success' => false,
                'shift_name' => 'Not Found!!!',
            ])->setStatusCode(200);
        }
    }


    public function userPaySlipCount(Request $request)
    {

        ##### previous
        $previous_startDate = date('Y-m-d', strtotime('-31 days'));
        $previous_endDate = date("Y-m-d", strtotime('+1 days'));
        ##### previous ends

        if (PaySlip::where('pay_slip_employee_id', $request->employee_id)->whereBetween('created_at', [$previous_startDate, $previous_endDate])->exists()) {

            $payslip_counts = PaySlip::where('pay_slip_employee_id', $request->employee_id)->whereBetween('created_at', [$previous_startDate, $previous_endDate])->count();

            $data = array(
                'id' => $request->employee_id,
                'payslip_counts' => $payslip_counts,
            );

            return response()->json([
                'success' => true,
                'data' => $data
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Nothing to count!!!",
            ])->setStatusCode(200);
        }
    }

    public function userUpcomingHolidayCount(Request $request)
    {

        $startDate = date("Y-m-d");
        $endDate = date('Y') . '-' . '12' . '-' . '31';

        if (Holiday::where('holiday_com_id', $request->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereBetween('start_date', [$startDate, $endDate])->exists()) {

            $upcoming_holiday_counts = Holiday::where('holiday_com_id', $request->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereBetween('start_date', [$startDate, $endDate])->count();

            $data = array(
                'upcoming_holiday_counts' => $upcoming_holiday_counts,
            );

            return response()->json([
                'success' => true,
                'data' => $data
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Nothing to count!!!",
            ])->setStatusCode(200);
        }
    }

    public function userAwardCount(Request $request)
    {

        if (Award::where('award_employee_id', $request->employee_id)->exists()) {

            $award_counts = Award::where('award_employee_id', $request->employee_id)->count();

            $data = array(
                'award_counts' => $award_counts,
            );

            return response()->json([
                'success' => true,
                'data' => $data
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Nothing to count!!!",
            ])->setStatusCode(200);
        }
    }

    public function userAnnouncementCount(Request $request)
    {

        $previous_start_date = date('Y-m-d', strtotime('-25 days'));
        $upto_end_date = date('Y-m-d', strtotime('+1 days'));

        if (Announcement::where('announcement_com_id', $request->com_id)->where('announcement_department_id', $request->department_id)->whereBetween('created_at', [$previous_start_date, $upto_end_date])->exists()) {

            $announcement_counts = Announcement::where('announcement_com_id', $request->com_id)->where('announcement_department_id', $request->department_id)->whereBetween('created_at', [$previous_start_date, $upto_end_date])->count();

            $data = array(
                'announcement_counts' => $announcement_counts,
            );

            return response()->json([
                'success' => true,
                'data' => $data
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Nothing to count!!!",
            ])->setStatusCode(200);
        }
    }


    public function userUpcomingHoliday(Request $request)
    {

        $startDate = date("Y-m-d");
        $endDate = date('Y') . '-' . '12' . '-' . '31';
        $details_array = array();
        if (Holiday::where('holiday_com_id', $request->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereBetween('start_date', [$startDate, $endDate])->exists()) {

            $logged_user_details = Holiday::where('holiday_com_id', $request->com_id)->whereBetween('start_date', [$startDate, $endDate])->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    'id' => $logged_user_details_value->id,
                    'holiday_type' => $logged_user_details_value->holiday_type,
                    'holiday_name' => $logged_user_details_value->holiday_name,
                    'start_date' => $logged_user_details_value->start_date,
                    'end_date' => $logged_user_details_value->end_date,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {
            array_push($details_array, $data = array(
                'id' => 0,
                'holiday_type' => "-",
                'holiday_name' => "-",
                'start_date' => "-",
                'end_date' => "-",
                'created_at' => "-",
                'updated_at' => "-",
            ));

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }




    public function supervisorEmployeeDateWiseAttendance(Request $request)
    {
        $details_array = array();

        $validator = \Validator::make(
            $request->all(),
            [
                'supervisor_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]
        );

        if (!$request->supervisor_id) {

            return response()->json([
                'success' => false,
                'message' => 'supervisor_id field is required',
            ]);
        }
        if (!$request->start_date) {

            return response()->json([
                'success' => false,
                'message' => 'start_date field is required',
            ]);
        }
        if (!$request->end_date) {

            return response()->json([
                'success' => false,
                'message' => 'end_date field is required',
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'some form fields are required',
            ]);
        }


        if (User::where('report_to_parent_id', $request->supervisor_id)->exists()) {

            //$logged_user_details = Attendance::where('employee_id',$request->employee_id)->get();

            $logged_user_details = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name')
                ->where('report_to_parent_id', $request->supervisor_id)
                ->whereBetween('attendance_date', [$request->start_date, $request->end_date])
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                if ($logged_user_details_value->check_in_out == 1) {
                    $attendance_status = 'Present';
                } else {
                    $attendance_status = 'Absent';
                }

                array_push($details_array, $data = array(
                    // 'id' => $logged_user_details_value->id,
                    'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'attendance_date' => $logged_user_details_value->attendance_date,
                    'clock_in' => $logged_user_details_value->clock_in,
                    //'check_in_ip' => $logged_user_details_value->check_in_ip,
                    'clock_out' => $logged_user_details_value->clock_out,
                    //'check_out_ip' => $logged_user_details_value->check_out_ip,
                    'check_in_out' => $logged_user_details_value->check_in_out,
                    'time_late' => $logged_user_details_value->time_late,
                    'early_leaving' => $logged_user_details_value->early_leaving,
                    'overtime' => $logged_user_details_value->overtime,
                    'total_work' => $logged_user_details_value->total_work,
                    'total_rest' => $logged_user_details_value->total_rest,
                    'attendance_status' => $attendance_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }




    public function supervisorEmployeeAttendanceList(Request $request)
    {
        $details_array = array();
        if (User::where('report_to_parent_id', $request->supervisor_id)->exists()) {

            $logged_user_details = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name')
                ->where('report_to_parent_id', $request->supervisor_id)
                ->where('is_active', 1)
                ->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                if ($logged_user_details_value->check_in_out == 1) {
                    $attendance_status = 'Present';
                } else {
                    $attendance_status = 'Absent';
                }

                array_push($details_array, $data = array(
                    // 'id' => $logged_user_details_value->id,
                    'employee_name' => $logged_user_details_value->first_name . " " . $logged_user_details_value->last_name,
                    'attendance_date' => $logged_user_details_value->attendance_date,
                    'clock_in' => $logged_user_details_value->clock_in,
                    //'check_in_ip' => $logged_user_details_value->check_in_ip,
                    'clock_out' => $logged_user_details_value->clock_out,
                    //'check_out_ip' => $logged_user_details_value->check_out_ip,
                    'check_in_out' => $logged_user_details_value->check_in_out,
                    'time_late' => $logged_user_details_value->time_late,
                    'early_leaving' => $logged_user_details_value->early_leaving,
                    'overtime' => $logged_user_details_value->overtime,
                    'total_work' => $logged_user_details_value->total_work,
                    'total_rest' => $logged_user_details_value->total_rest,
                    'attendance_status' => $attendance_status,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {

            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }


    public function supervisorEmployee(Request $request)
    {
        $details_array = array();
        // if(User::where('id',$request->employee_id)->exists()){
        if (User::where('report_to_parent_id', $request->supervisor_id)->exists()) {

            $logged_user_details = User::where('is_active', 1)
                ->where('report_to_parent_id', $request->supervisor_id)->whereNull('company_profile')->get();

            foreach ($logged_user_details as $logged_user_details_value) {

                array_push($details_array, $data = array(
                    // 'id' => $logged_user_details_value->id,
                    'company_assigned_id' => $logged_user_details_value->company_assigned_id,
                    'first_name' => $logged_user_details_value->first_name,
                    'last_name' => $logged_user_details_value->last_name,
                    'email' => $logged_user_details_value->email,
                    'phone' => $logged_user_details_value->phone,
                    'address' => $logged_user_details_value->address,
                    // 'employee_name' => $logged_user_details_value->first_name." ".$logged_user_details_value->last_name,
                    'created_at' => $logged_user_details_value->created_at,
                    'updated_at' => $logged_user_details_value->updated_at,
                ));
            }
            return response()->json([
                'success' => true,
                'data' => $details_array
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'data' => $details_array,
            ])->setStatusCode(200);
        }
    }
    //   }
    public function employeeObjective(Request $request)
    {
        $goal_types = GoalType::where('goal_type_com_id', $request->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', 1)->get();
        $departments = Department::where('department_com_id', $request->com_id)->get();
        $designations = Designation::where('designation_com_id', $request->com_id)->get();
        $roles = Role::where('id', $request->role_id)->where('roles_com_id', $request->com_id)->get();

        $objectives = ObjectiveTypeConfig::where('obj_config_com_id', $request->com_id)->get();
        foreach ($objectives as $objective) {
            $objective_dept_id =  $objective->obj_config_dept_id;
            $objective_desig_id = $objective->obj_config_desig_id;
        }
           $objectivePlans = Objective::join('users', 'objectives.objective_emp_id', '=', 'users.id')
            ->join('departments', 'objectives.objective_dept_id', '=', 'departments.id')
            ->join('designations', 'objectives.objective_desig_id', '=', 'designations.id')
            ->select('objectives.*', 'users.first_name', 'users.last_name', 'departments.department_name','designations.designation_name')
            ->where('objective_com_id', $request->com_id)
            ->where('objective_emp_id', $request->emp_id)
            ->get();

            $developmentPlans = DevelopmentPlan::with('user', 'userdepartment', 'userdesignation')
            ->where('development_com_id', $request->com_id)
            ->where('development_emp_id', $request->emp_id)
            ->get();
            return response()->json([
                'objectivePlans' => $objectivePlans,
                'developmentPlans' => $developmentPlans,
            ]);
    }
}
