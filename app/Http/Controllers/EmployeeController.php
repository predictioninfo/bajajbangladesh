<?php

namespace App\Http\Controllers;

use App\Models\ContactRenewalLetter;
use App\Models\ContactRenewalLetterTemplate;
use App\Models\ContactRenwalLetter;
use App\Models\SalaryRemuneration;
use DB;
use PDF;
use Auth;
use Excel;
use Image;
use helper;
use Session;
use DateTime;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\Role;
use App\Models\Town;
use App\Models\User;
use App\Models\Union;
use App\Models\Region;
use App\Models\Travel;
use App\Models\Company;
use App\Models\DbHouse;
use App\Models\Holiday;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\LateTime;
use App\Models\OverTime;
use App\Models\Territory;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Separation;
use App\Models\Designation;
use App\Models\Nationality;
use App\Models\OfficeShift;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\EmployeeDetail;
use App\Models\LatetimeConfig;
use App\Http\Traits\CommonMethod;
use App\Models\CompensatoryLeave;
use App\Models\Locatoincustomize;
use App\Models\MonthlyAttendance;
use App\Models\AttendanceLocation;
use App\Models\AppointmentTemplate;
use App\Models\DeviceConfigure;
use App\Models\DeviceToken;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    use CommonMethod;

    public function index()
    {

        $employee_sub_module_one_add = "2.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $employee_sub_module_one_edit = "2.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $employee_sub_module_one_delete = "2.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->where('roles_is_active', 1)->get();
        $office_shifts = OfficeShift::where('office_shift_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $users = User::with(['userDivision', 'userdepartment', 'userdesignation', 'userDistrict', 'userUpazila', 'userUnion', 'emoloyeedetail' => function ($q) {
                $q->with('emploeeUnion');
            }])
                ->where('com_id', '=', Auth::user()->com_id)
                ->where('is_active', 1)
                ->where('users_bulk_deleted', 'No')->whereNull('company_profile')
                ->orderBy('id', 'DESC')
                ->get();
            return view('back-end.premium.employees.employee-list-index', get_defined_vars());
        } else {

            $users = User::where('id', '=', Auth::user()->id)
                ->where('is_active', 1)->where('users_bulk_deleted', 'No')
                ->whereNull('company_profile')->orderBy('id', 'DESC')
                ->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'salary_type', 'is_active', 'address', 'id_card_status']);
            return view('back-end.premium.employees.employee-list-index', get_defined_vars());
        }
    }



    public function create()
    {
        $employee_sub_module_one_add = "2.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $employee_sub_module_one_edit = "2.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $employee_sub_module_one_delete = "2.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $employees = User::with('userrole')->where('employment_type', 'Probation')->where('com_id', '=', Auth::user()->com_id)->whereBetween('in_trine_month', [Carbon::now(), Carbon::now()->addDays(1)])->get();

        foreach ($employees as $employee) {
            $admin = $employee->userrole->roles_admin_status;
        }

        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->where('roles_is_active', 1)->get();
        $office_shifts = OfficeShift::where('office_shift_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $appointment_letter_formats = AppointmentTemplate::where('appointment_template_com_id', '=', Auth::user()->com_id)->get();
        $warning_letter_formats = \App\Models\WarningLetterFormat::where('warning_letter_format_com_id', Auth::user()->com_id)->get();
        $probation_letter_formats = \App\Models\ProbitionLetterFormats::where('probation_letter_format_com_id', Auth::user()->com_id)->get();


        return view('back-end.premium.employees.employee-create', get_defined_vars());
    }

    public function nonPermanentEmployeeIndex()
    {

        $employee_sub_module_one_add = "2.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $employee_sub_module_one_edit = "2.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $employee_sub_module_one_delete = "2.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get();
        $contact_renewals = ContactRenewalLetterTemplate::where('contact_renewal_letter_template_com_id', Auth::user()->com_id)->get();

        //$att_location = AttendanceLocation::all();

        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $users = DB::table('users')->where('com_id', '=', Auth::user()->com_id)->where('employment_type', '!=', 'Permanent')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'is_active', 'address', 'employment_type', 'joining_date', 'expiry_date']);

            return view('back-end.premium.employees.non-permanent-employee-list-index', get_defined_vars());
        } else {

            $users = DB::table('users')->where('id', '=', Auth::user()->id)->where('employment_type', '!=', 'Permanent')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'is_active', 'address', 'employment_type', 'joining_date', 'expiry_date']);

            return view('back-end.premium.employees.non-permanent-employee-list-index', get_defined_vars());
        }
    }


    public function fileImportExport()
    {
        return view('back-end.premium.employees.import-employee.import-employee-index');
    }

    public function fileImport()
    {
        $validated = request()->validate([
            'file' => 'required',
        ]);
        Excel::import(new UsersImport, request()->file('file'));
        return back()->with('message', 'Uplode Successfully');
    }

    public function fileExport()
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }

    public function employeeBulkDelete(Request $request)
    {

        $bulk_delete_users = DB::table('users')->where('com_id', '=', Auth::user()->com_id)->whereNull('company_profile')->get(['id']);

        foreach ($bulk_delete_users as $bulk_delete_users_value) {

            $user = User::find($bulk_delete_users_value->id);
            $user->users_bulk_deleted = "Yes";
            $user->save();
        }

        return back()->with('message', 'Deleted Successfully');
    }

    public function employeeBulkRestore(Request $request)
    {

        $bulk_delete_users = DB::table('users')->where('com_id', '=', Auth::user()->com_id)->whereNull('company_profile')->get(['id']);

        foreach ($bulk_delete_users as $bulk_delete_users_value) {

            $user = User::find($bulk_delete_users_value->id);
            $user->users_bulk_deleted = "No";
            $user->save();
        }

        return back()->with('message', 'Deleted Successfully');
    }


    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'company_assigned_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'company_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'email' =>  ['required', 'email', 'max:255', 'unique:users'],
            'phone' => 'required|unique:users',
            'address' => 'required',
            'password' => ['required', 'min:8', 'max:50'],
            'confirm_password' => 'required',
        ]);

        if ($password != $confirm_password) {
            return back()->with('message', 'Confirm Password Does not Match');
        }
        if (User::where('com_id', $request->company_id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {
            return back()->with('message', 'Assigned ID Already Exists');
        }

        if (Role::where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $role_users_id = Role::where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->first('id');

            $user = new User();
            $user->company_assigned_id = $request->company_assigned_id;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->date_of_birth = $request->date_of_birth;
            $user->gender = $request->gender;
            $user->com_id = $request->company_id;
            $user->department_id = $request->department_id;
            $user->designation_id = $request->designation_id;
            $user->email = $request->email;
            $user->role_id = $role_users_id->id;
            $user->phone = $request->contact_no;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->is_active = 1;
            $user->com_pack = Auth::user()->com_pack;

            if ($request->file('profile_photo')) {
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
            }

            $user->save();

            return back()->with('message', 'Added Successfully');
        } else {
            return back()->with('message', 'You did not set any role as admin with admin status!!!');
        }
    }
    public function checkData(Request $request)
    {
        $tableName = $request->table_name;
        $tableColum = $request->colum_name;
        $columValue = $request->colum_value;
        $result = User::where($tableColum, $columValue)->where('com_id', '=', Auth::user()->com_id)->get(['id', 'phone']);
        //   return  $result = DB::table($tableName)->where($tableColum, $columValue)->where('com_id','=',44)->get();
        if (count($result) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function checkId(Request $request)
    {
        $tableName = $request->table_name;
        $tableColum = $request->colum_name;
        $columValue = $request->colum_value;

        $result = DB::table($tableName)->where($tableColum, $columValue)->get();
        if (count($result) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function checkUserName(Request $request)
    {
        $userName = User::where('first_name', $request->firstName)->where('last_name', $request->lastName)->get('username');
        return response()->json($userName);
    }

    public function employeeStore(Request $request)
    {
        if ($request->employment_type != 'Permanent') {

            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'company_id' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
                'office_shift_id' => 'required',
                'email' =>  ['required', 'email', 'max:255', 'unique:users'],
                'role_users_id' => 'required',
                'phone' => ['required', 'max:13', 'unique:users'],
                // 'address' => 'required',
                'password' => ['required', 'min:8', 'max:50'],
                'confirm_password' => 'required',
                'attendance_type' => 'required',
                'employment_type' => 'required',
                // 'joining_date' => 'required',

                'blood_group' => 'required',
                'appointment_letter' => 'required',
                'salary_type' => 'required',
                // 'in_probation_month' => 'required',

            ]);
        } else {

            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'company_id' => 'required',
                'department_id' => 'required',
                'designation_id' => 'required',
                'office_shift_id' => 'required',
                'email' =>  ['required', 'email', 'max:255', 'unique:users'],
                'role_users_id' => 'required',
                'phone' => ['required', 'max:13', 'unique:users'],
                // 'address' => 'required',
                'password' => ['required', 'min:8', 'max:50'],
                'confirm_password' => 'required',
                'attendance_type' => 'required',
                'joining_date' => 'required',

                'blood_group' => 'required',
                'appointment_letter' => 'required',
                'salary_type' => 'required',
                // 'in_probation_month' => 'required',
            ]);
        }
        // try {
        $date = Carbon::parse($request->joining_date);
        $monthsToAdd = $request->in_probation_month;
        $newDate = $date->addMonths($monthsToAdd);

        $probationExpiryDate = $newDate->format('Y-m-d');

        $user = new User();
        $user->company_assigned_id = $this->generateInvoiceId();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->department_id = $request->department_id;
        $user->com_id = $request->company_id;
        $user->designation_id = $request->designation_id;
        $user->office_shift_id = $request->office_shift_id;
        $user->email = $request->email;
        $user->role_id = $request->role_users_id;
        $user->phone = $request->phone;
        $user->b_phone = $request->b_phone;
        $user->password = Hash::make($request->password);
        if ($request->attendance_type == 'finger_print') {
            $user->attendance_type = $request->attendance_type;
            $user->device_area = $request->device_area[0];
            try {
                $ipCheck = DeviceConfigure::where('com_id', Auth::user()->com_id)->first();
                $device_token = DeviceToken::where('com_id', Auth::user()->com_id)->first();
                if ($ipCheck == null) {
                    return redirect('set-ip')->with('message', 'Firstly set IP Address');
                } elseif ($device_token == null) {
                    return redirect('token-list')->with('message', 'Firstly set Device Token');
                } else {
                    // Make request to external API
                    $response = Http::withHeaders([
                        'Authorization' => 'JWT ' . $device_token->token,
                    ])->post($ipCheck->ip . 'personnel/api/employees/', [
                        'emp_code' => $this->generateInvoiceId(),
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'department' => 1,
                        'area'     => $request->device_area,
                        // Other fields as needed
                    ]);

                    // Process the response
                    $responseData = $response->json();

                    // Handle the response data and return a response to the client
                    $status = $response->getStatusCode();
                    // return $status;
                }
            } catch (\Exception $e) {
                // Handle exceptions (errors) that occur during the API request
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            $user->attendance_type = $request->attendance_type;
        }
        $user->joining_date = $request->joining_date;
        $user->blood_group = $request->blood_group;
        $user->appointment_letter_format_id = $request->appointment_letter_format_id;

        $user->appointment_letter = $request->appointment_letter;
        $user->salary_type = $request->salary_type;
        if ($request->multi_attendance) {
            $user->multi_attendance = $request->multi_attendance;
        } else {
            $user->multi_attendance = 0;
        }
        $user->employment_type = $request->employment_type;
        $user->expiry_date = $request->expiry_date;
        $user->in_trine_month = $request->in_trine_month;
        $user->in_probation_month = $request->in_probation_month;
        $user->probation_expiry_date = $probationExpiryDate;
        // if ($request->employment_type != 'Permanent') {
        //     $user->employment_type = $request->employment_type;
        //     $user->expiry_date = $request->expiry_date;
        // }
        $user->is_active = $request->is_active ?? 0;
        $user->user_admin_status = $request->admin_status ?? 'No';
        $user->check_in_latitude = "No";
        $user->check_in_longitude = "No";
        $user->check_out_latitude = "No";
        $user->check_out_longitude = "No";
        $user->com_pack = Auth::user()->com_pack;
        if ($request->over_time_payable) {
            $user->over_time_payable = $request->over_time_payable;
            $user->user_over_time_type = $request->user_over_time_type;
            $user->user_over_time_rate = $request->user_over_time_rate;
        } else {
            $user->over_time_payable = "No";
            $user->user_over_time_rate = 0;
        }

        $user->attendance_status = "No";
        $user->region_id = $request->region_id;
        if ($request->has('area_id')) {
            $user->area_id = $request->area_id;
        }
        if ($request->has('territory_id')) {
            $user->territory_id = $request->territory_id;
        }
        if ($request->has('town_id')) {
            $user->town_id = $request->town_id;
        }
        if ($request->has('db_house_id')) {
            $user->db_house_id = $request->db_house_id;
        }

        if ($request->has('location_six_id')) {
            $user->location_six_id = $request->location_six_id;
        }
        if ($request->has('location_seven_id')) {
            $user->location_seven_id = $request->location_seven_id;
        }
        if ($request->has('location_eight_id')) {
            $user->location_eight_id = $request->location_eight_id;
        }
        if ($request->has('location_nine_id')) {
            $user->location_nine_id = $request->location_nine_id;
        }
        if ($request->has('location_ten_id')) {
            $user->location_ten_id = $request->location_ten_id;
        }
        if ($request->has('location_eleven_id')) {
            $user->location_eleven_id = $request->location_eleven_id;
        }


        if ($request->file('profile_photo')) {

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

            // $image = $request->profile_photo;
            // $file_name = preg_replace('/\s+/', '', $request->username) . '_' . time() . '.' . $image->getClientOriginalName();
            // $imageName = $image->move('uploads/profile_photos/', $file_name);
            // $imageUrl = $imageName;

            // $user->profile_photo = $imageUrl;

        }





        $user->save();

        // if ($user->save()) {
        //     if ($request->company_id == 1) {
        //         $url = "http://66.45.237.70/api.php";
        //         //$number="88017,88018,88019";
        //         //$link = "https://hrmspla.predictionla.com";
        //         $link = route('home');
        //         $doc = "https://hr-doc.predictionit.com/employee.html";
        //         $app_link = "https://play.google.com/store/apps/details?id=com.predictionla";
        //         $pitechr = "PitecHR";
        //         $name = $request->first_name;
        //         $email = $request->email;
        //         $password = $request->password;
        //         $number = $request->phone;
        //         $text = "Dear $name, Welcome to Prediction learning Associates Ltd.Your login credential Phone:$number Email: $email Password: $password  Download Mobile App link:$app_link Or Search $pitechr on Playstore. Website link:$link .Details on PitecHR Documentation $doc";
        //         $data = array(
        //             'username' => "01324246900",
        //             'password' => "W5CGZF9A",
        //             'number' => "$number",
        //             'message' => "$text"
        //         );
        //         $ch = curl_init(); // Initialize cURL
        //         curl_setopt($ch, CURLOPT_URL, $url);
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         $smsresult = curl_exec($ch);
        //         $p = explode("|", $smsresult);
        //         $sendstatus = $p[0];
        //     }
        // }
        // }
        // catch (\Exception $e) {
        // return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        // }

        $user_id = User::latest()->first('id');
        $msg = 'It is done, Add <a href="' . url('employee-basic-info') . '"> More Basic Info  </a>,
                            <a href="' . url('employee-signatures') . '"> Signatures  </a>,
                            <a href="' . url('employee-immigration') . '"> Immigration  </a>,
                            <a href="' . url('employee-emergency-contact') . '"> Emergency Contact  </a>,
                            <a href="' . url('employee-social-profile') . '"> Social Profile  </a>,
                            <a href="' . url('employee-document') . '"> Document  </a>,
                            <a href="' . url('employee-qualification') . '"> Qualification  </a>,
                            <a href="' . url('employee-work-experience') . '"> Work Experience  </a>,
                            <a href="' . url('employee-bank-account') . '"> Bank Information  </a>';
        return redirect()->route('employee-details', $user_id)->with('message',  $msg);
    }

    public function employeeEdit($id)
    {
        $nationalities = Nationality::all();
        $divisions = Division::get();
        $districts = District::get();
        $unions = Union::get();
        $upzillas = Upazila::get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->where('roles_is_active', 1)->get();
        $office_shifts = OfficeShift::where('office_shift_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.employees.employee-edit', get_defined_vars());
    }

    public function userById(Request $request)
    {

        $where = array('id' => $request->id);
        $userByIds = User::where($where)->first();

        return response()->json($userByIds);
    }


    public function employeeUpdate(Request $request)
    {

        $validated = $request->validate([
            // 'company_assigned_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            //'username' => 'required',
            'email' =>  ['required', 'email', 'max:255'],
            'contact_no' => 'required',
            'address' => 'required',
            'appointment_letter' => 'required',
            'salary_type' => 'required',
        ]);


        if (User::where('com_id', Auth::user()->com_id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {

            if (User::where('id', $request->id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {
                //skip
            } else {
                return back()->with('message', 'Compnay Assigned ID Already Exists');
            }
        }

        if (User::where('com_id', Auth::user()->com_id)->where('email', $request->email)->exists()) {

            if (User::where('id', $request->id)->where('email', $request->email)->exists()) {
                //skip
            } else {
                return back()->with('message', 'Email Already Exists');
            }
        }

        if (User::where('com_id', Auth::user()->com_id)->where('username', $request->username)->exists()) {

            if (User::where('id', $request->id)->where('username', $request->username)->exists()) {
                //skip
            } else {
                return back()->with('message', 'User Name Already Exists');
            }
        }

        if (User::where('com_id', Auth::user()->com_id)->where('phone', $request->contact_no)->exists()) {

            if (User::where('id', $request->id)->where('phone', $request->contact_no)->exists()) {
                //skip
            } else {
                return back()->with('message', 'Contact Number Already Exists');
            }
        }
        try {
            $user = User::find($request->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->contact_no;
            $user->address = $request->address;
            $user->appointment_letter_format_id = $request->appointment_letter_format_id;
            $user->warning_letter_format_id = $request->warning_letter_format_id;

            if ($request->appointment_letter) {
                $user->appointment_letter = $request->appointment_letter;
            }
            $user->joining_date = $request->joining_date;
            $user->salary_type = $request->salary_type;
            if ($request->multi_attendance) {
                $user->multi_attendance = $request->multi_attendance;
            } else {
                $user->multi_attendance = 0;
            }
            $user->user_admin_status = $request->admin_status ?? 'No';
            //$user->blood_group = $request->blood_group;
            //$user->job_nature= $request->job_nature;
            if ($request->office_shift_id) {
                $user->office_shift_id = $request->office_shift_id;
            }

            // $image = $request->profile_photo;
            // $imageName = $image->move('uploads/profile_photos/', $image->getClientOriginalName());
            // $imageUrl = $imageName;

            // $user->profile_photo = $imageUrl;

            if ($request->profile_photo) {

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
            }

            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function employeeRenew(Request $request)
    {

        $validated = $request->validate([
            'expiry_date' => 'required',
        ]);
        // try {
        $user = User::find($request->id);
        $user->expiry_date = $request->expiry_date;
        $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
        $user->save();

        $renewal_letter = new ContactRenewalLetter();
        $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
        $renewal_letter->contact_renewal_letter_employee_id = $user->id;
        $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
        $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
        $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
        $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
        $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
        $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
        $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
        $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
        $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
        $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
        $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
        $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
        $renewal_letter->save();


        // } catch (\Exception $e) {
        //     return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        // }
        return back()->with('message', 'Renewed Successfully');
    }



    public function employeeBulkRenew(Request $request)
    {

        $validated = $request->validate([
            'expiry_date' => 'required',
        ]);

        $all_non_permanent_employees = User::where('com_id', $request->bulk_renew_com_id)->where('is_active', 1)->where('employment_type', '!=', 'Permanent')->get(['id', 'expiry_date']);

        foreach ($all_non_permanent_employees as $all_non_permanent_employees_value) {
            $user = User::find($all_non_permanent_employees_value->id);
            $user->expiry_date = $request->expiry_date;
            $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
            $user->save();

            $renewal_letter = new ContactRenewalLetter();
            $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
            $renewal_letter->contact_renewal_letter_employee_id = $user->id;
            $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
            $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
            $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
            $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
            $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
            $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
            $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
            $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
            $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
            $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
            $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
            $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
            $renewal_letter->save();
        }
        return back()->with('message', 'Renewed Successfully');
    }


    public function employeeFilteringBulkRenew(Request $request)
    {

        $validated = $request->validate([
            'expiry_date' => 'required',
        ]);
        if ($request->department_id && $request->designation_id && $request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->is_active) {
            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('is_active', $request->is_active)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();


                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->department_id && $request->designation_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->department_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('department_id', $request->department_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->region_id && $request->area_id && $request->territory_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->region_id && $request->area_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->region_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('region_id', $request->region_id)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->is_active) {
            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->where('is_active', $request->is_active)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->company_id && $request->is_active) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                // ->where('employment_type', '!=', 'Permanent')
                ->where('is_active', $request->is_active)
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } elseif ($request->company_id) {

            $non_permanent_employees = User::whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('employment_type', '!=', 'Permanent')
                ->get(['id', 'expiry_date']);

            foreach ($non_permanent_employees as $non_permanent_employees_value) {
                $user = User::find($non_permanent_employees_value->id);
                $user->expiry_date = $request->expiry_date;
                $user->contact_renewal_letter_employee_id = $request->contact_renewal_id;
                $user->save();

                $renewal_letter = new ContactRenewalLetter();
                $renewal_letter->contact_renewal_letter_com_id = Auth::user()->com_id;
                $renewal_letter->contact_renewal_letter_employee_id = $user->id;
                $renewal_letter->contact_renewal_letter_department_id = $user->department_id;
                $renewal_letter->contact_renewal_letter_designation_id = $user->designation_id;
                $renewal_letter->contact_renewal_letter_region_id = $user->region_id;
                $renewal_letter->contact_renewal_letter_area_id = $user->area_id;
                $renewal_letter->contact_renewal_letter_territory_id = $user->territory_id;
                $renewal_letter->contact_renewal_letter_town_id = $user->town_id;
                $renewal_letter->contact_renewal_letter_db_house_id = $user->db_house_id;
                $renewal_letter->contact_renewal_letter_renewal_date = $request->expiry_date;
                $renewal_letter->contact_renewal_letter_renewal_previous_date = $user->expiry_date;
                $renewal_letter->contact_renewal_letter_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_old_gross = $user->gross_salary;
                $renewal_letter->contact_renewal_letter_type_id = $request->contact_renewal_id;
                $renewal_letter->save();
            }
            return back()->with('message', 'Renewed Successfully');
        } else {

            return back()->with('message', 'There is no employee to be renewed with the submited filtering values!!!!');
        }
    }

    public function passwordChangeIndex(Request $request)
    {
        return view('back-end.premium.user.password-change-index');
    }


    public function activeUser(Request $request, $id)
    {

        try {
            $user_details =  User::where('id', $id)->get();
            foreach ($user_details as $user_details_value) {

                $user = User::find($id);
                if ($user_details_value->inactive_email) {
                    if (User::where('email', $user_details_value->inactive_email)->exists()) {
                        return back()->with('message', 'Email already exists');
                    }
                    $user->email = $user_details_value->inactive_email;
                } else {
                    $user->email = $user_details_value->email;
                }
                if ($user_details_value->inactive_phone) {
                    if (User::where('phone', $user_details_value->inactive_phone)->exists()) {
                        return back()->with('message', 'Phone number already exists');
                    }
                    $user->phone = $user_details_value->inactive_phone;
                } else {
                    $user->phone = $user_details_value->phone;
                }

                if ($user_details_value->inactive_username) {
                    if (User::where('username', $user_details_value->inactive_username)->exists()) {
                        return back()->with('message', 'Username already exists');
                    }
                    $user->username = $user_details_value->inactive_username;
                } else {
                    $user->username = $user_details_value->username;
                }



                $now = date('Y-m-d'); //Fomat Date and time

                $inactive_email = $user->email;
                $inactive_phone = $user->phone;
                $user->inactive_email = $inactive_email;
                $user->inactive_phone = $inactive_phone;
                $user->inactive_username = $user->username;

                $user->active_date = $now;
                $user->is_active = 1;

                $user->save();
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }

        return back()->with('message', 'User Activated Successfully');
    }

    public function inactiveUser(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $inactive_email = $user->email;
            $inactive_phone = $user->phone;
            $user->email = null;
            $user->phone = null;
            $user->username = null;
            $user->inactive_email = $inactive_email;
            $user->inactive_phone = $inactive_phone;
            $user->inactive_username = $user->username;
            $separation = new Separation();
            $separation->separation_com_id = Auth::user()->com_id;
            $separation->employee_id = $id;
            $separation->replace_employee_id = $request->replace_employee_id;
            $separation->date = $request->inactive_date;
            $separation->save();

            if ($request->has('inactive_date')) {
                $user->inactive_date = $request->inactive_date;
            } else {
                $user->inactive_date = date("Y-m-d");
            }
            $user->inactive_description = $request->inactive_description;
            $user->is_active = '';


            // if ($request->inactive_date == date("Y-m-d")) {
            //     $user->is_active = '';
            // } else {
            //     $user->is_active = 1;
            // }

            // if ($request->inactive_date == date("Y-m-d")) {
            //     $user->email = null;
            // } else {
            //     $user->email = $user->email;
            // }
            // if ($request->inactive_date == date("Y-m-d")) {
            //     $user->phone = null;
            // } else {
            //     $user->phone = $user->phone;
            // }
            // if ($request->inactive_date == date("Y-m-d")) {
            //     $user->username = null;
            // } else {
            //     $user->username =  $user->username;
            // }
            //dd($user);

            // dd($user);
            // $user->is_active = '';
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'User Inactivated Successfully');
    }

    public function approveIdCard(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->id_card_status = 'Approved';
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Approved Successfully');
    }

    public function banIdCard(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->id_card_status = 'Banned';
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Baned Successfully');
    }

    public function employeePasswordUpdate(Request $request)
    {
        if ($request->password == $request->confirm_password) {

            $user = User::find($request->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('message', 'Password Updated Successfully');
        } else {
            return back()->with('message', 'Confirm Password Does Not Match!!!!');
        }
    }



    public function employeeAttandance(Request $request)
    {
        $validated = $request->validate(
            [
                'employee_id' => 'required',
                'lat' => 'required',
                'longt' => 'required',
            ],
            [
                'lat.required' => 'Please Allow your Device location',
                'longt.required' => 'Otherwise attendance will be not count.'
            ]
        );
        // $browser = Agent::browser();
        // $version = Agent::version($browser);
        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');
        //$current_date = "2021-12-04";
        $current_month = $date->format('m');
        $current_year = $date->format('Y');
        $current_date_number = $date->format('d');
        $current_time = $date->format('H:i:s');
        $local_server_ip = $request->ip();
        $current_day_name = date('D', strtotime($current_date));
        //$current_day_name = date('D', strtotime("2022-01-01"));


        if ($current_day_name == "Sun") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->sunday_in;
                    $shift_out = $office_shifts->sunday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Mon") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->monday_in;
                    $shift_out = $office_shifts->monday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Tue") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->tuesday_in;
                    $shift_out = $office_shifts->tuesday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Wed") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->wednesday_in;
                    $shift_out = $office_shifts->wednesday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Thu") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->thursday_in;
                    $shift_out = $office_shifts->thursday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Fri") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->friday_in;
                    $shift_out = $office_shifts->friday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Sat") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->saturday_in;
                    $shift_out = $office_shifts->saturday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } else {
            // $shift_in = 0;
            // $shift_out = 0;
            return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
        }

        // echo json_encode($this->officeShift()); exit;

        ################ Seconds from shift start to end time of the day code starts from here ################################
        $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
        $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
        $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
        ################ Seconds from shift start to end time of the day code ends here #######################################
        $payable_time = strtotime($shift_out) + 60 * 60;
        $payable_over_time_hour = date('H:i', $payable_time);
        ################ Late Time Countable Seconds code starts from here ####################################################
        $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
        $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
        $current_time_in_seconds = strtotime($current_time) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################


        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where(function ($query) {
            $query->where('is_half', 0)
                ->orWhereNull('is_half');
        })
            ->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()
        ) { //condition for leave aprovements

            return back()->with('message', 'You Have Taken A Leave For This Day!!!');
        }

        if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements

            return back()->with('message', 'You are not permitted to give attendance when you are on traveling!!!');
        }


        if ($request->check_in_request) {

            if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $request->employee_id)->whereDate('attendance_date', $current_date)->exists()) { //condition for attendance existence of the current date
                return back()->with('message', 'You already gave your attendance!!!');
            }

            ////////// Attandance check-in code Starts...


            if ($request->lat && $request->longt) {


                $users = User::where('id', $request->employee_id)->get();

                $latitude = $request->lat;
                $longitude = $request->longt;
                $employee_id = $request->employee_id;

                foreach ($users as $usersValue) {

                    //echo $usersValue->attendance_status; exit;

                    if ($usersValue->attendance_status == "" || $usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No') {
                        // if($usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No'){
                        //echo 'ok'; exit;

                        $user = User::find($request->employee_id);
                        $user->attendance_status = "Yes";
                        $user->check_in_ip = $local_server_ip;
                        $user->check_in_latitude = $request->lat;
                        $user->check_in_longitude = $request->longt;
                        $user->save();


                        $attendance = new Attendance();
                        $attendance->attendance_com_id = Auth::user()->com_id;
                        $attendance->employee_id = $request->employee_id;
                        $attendance->attendance_date = $current_date;
                        $attendance->clock_in = $current_time;
                        $attendance->check_in_latitude = $request->lat;
                        $attendance->check_in_longitude = $request->longt;
                        $attendance->check_in_ip = $local_server_ip;
                        if (date_create($current_time) >= date_create($shift_in)) {
                            if ($shift_in != 0 && $shift_out != 0) {

                                $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                    if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {

                                        $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                        foreach ($late_times as $late_times_value) {

                                            $late_time = LateTime::find($late_times_value->id);
                                            $late_time->late_time_com_id = Auth::user()->com_id;
                                            $late_time->late_time_employee_id = $request->employee_id;
                                            $late_time->late_time_date = $current_date;
                                            $late_time->save();
                                        }
                                    } else {
                                        $late_time = new LateTime();
                                        $late_time->late_time_com_id = Auth::user()->com_id;
                                        $late_time->late_time_employee_id = $request->employee_id;
                                        $late_time->late_time_date = $current_date;
                                        $late_time->save();
                                    }
                                }
                            }
                        }

                        //$attendance->check_in_out = 0;
                        $attendance->check_in_out = 1;
                        $attendance->attendance_status = "Present";
                        // $attendance->browser = $browser;
                        $attendance->save();

                        if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->where('holiday_name', $current_day_name)->exists()) { //condition for weekly holiday
                            //echo "yes";
                            $compensatory_leave = new CompensatoryLeave();
                            $compensatory_leave->compen_leave_com_id = Auth::user()->com_id;
                            $compensatory_leave->compen_leave_employee_id = $request->employee_id;
                            $compensatory_leave->compen_leave_duty_date = $current_date;
                            $compensatory_leave->compen_leave_status = 0;
                            $compensatory_leave->save();
                        } else {

                            if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereRaw('"' . $current_date . '" between `start_date` and `end_date`')->exists()) { //condition for weekly holiday
                                //echo "yes";
                                $compensatory_leave = new CompensatoryLeave();
                                $compensatory_leave->compen_leave_com_id = Auth::user()->com_id;
                                $compensatory_leave->compen_leave_employee_id = $request->employee_id;
                                $compensatory_leave->compen_leave_duty_date = $current_date;
                                $compensatory_leave->compen_leave_status = 0;
                                $compensatory_leave->save();
                            }
                        }

                        if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {
                            $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();
                            foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {
                                $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                if ($current_date_number == 1) {
                                    $monthly_attendance->day_one = "P";
                                } elseif ($current_date_number == 2) {
                                    $monthly_attendance->day_two = "P";
                                } elseif ($current_date_number == 3) {
                                    $monthly_attendance->day_three = "P";
                                } elseif ($current_date_number == 4) {
                                    $monthly_attendance->day_four = "P";
                                } elseif ($current_date_number == 5) {
                                    $monthly_attendance->day_five = "P";
                                } elseif ($current_date_number == 6) {
                                    $monthly_attendance->day_six = "P";
                                } elseif ($current_date_number == 7) {
                                    $monthly_attendance->day_seven = "P";
                                } elseif ($current_date_number == 8) {
                                    $monthly_attendance->day_eight = "P";
                                } elseif ($current_date_number == 9) {
                                    $monthly_attendance->day_nine = "P";
                                } elseif ($current_date_number == 10) {
                                    $monthly_attendance->day_ten = "P";
                                } elseif ($current_date_number == 11) {
                                    $monthly_attendance->day_eleven = "P";
                                } elseif ($current_date_number == 12) {
                                    $monthly_attendance->day_twelve = "P";
                                } elseif ($current_date_number == 13) {
                                    $monthly_attendance->day_thirteen = "P";
                                } elseif ($current_date_number == 14) {
                                    $monthly_attendance->day_fourteen = "P";
                                } elseif ($current_date_number == 15) {
                                    $monthly_attendance->day_fifteen = "P";
                                } elseif ($current_date_number == 16) {
                                    $monthly_attendance->day_sixteen = "P";
                                } elseif ($current_date_number == 17) {
                                    $monthly_attendance->day_seventeen = "P";
                                } elseif ($current_date_number == 18) {
                                    $monthly_attendance->day_eighteen = "P";
                                } elseif ($current_date_number == 19) {
                                    $monthly_attendance->day_nineteen = "P";
                                } elseif ($current_date_number == 20) {
                                    $monthly_attendance->day_twenty = "P";
                                } elseif ($current_date_number == 21) {
                                    $monthly_attendance->day_twenty_one = "P";
                                } elseif ($current_date_number == 22) {
                                    $monthly_attendance->day_twenty_two = "P";
                                } elseif ($current_date_number == 23) {
                                    $monthly_attendance->day_twenty_three = "P";
                                } elseif ($current_date_number == 24) {
                                    $monthly_attendance->day_twenty_four = "P";
                                } elseif ($current_date_number == 25) {
                                    $monthly_attendance->day_twenty_five = "P";
                                } elseif ($current_date_number == 26) {
                                    $monthly_attendance->day_twenty_six = "P";
                                } elseif ($current_date_number == 27) {
                                    $monthly_attendance->day_twenty_seven = "P";
                                } elseif ($current_date_number == 28) {
                                    $monthly_attendance->day_twenty_eight = "P";
                                } elseif ($current_date_number == 29) {
                                    $monthly_attendance->day_twenty_nine = "P";
                                } elseif ($current_date_number == 30) {
                                    $monthly_attendance->day_thirty = "P";
                                } elseif ($current_date_number == 31) {
                                    $monthly_attendance->day_thirty_one = "P";
                                } else {
                                    return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                }

                                $monthly_attendance->save();
                            }
                        } else {

                            $monthly_attendance = new MonthlyAttendance();
                            $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                            $monthly_attendance->monthly_employee_id = $request->employee_id;
                            $monthly_attendance->attendance_month = $current_date;
                            $monthly_attendance->attendance_year = $current_date;
                            if ($current_date_number == 1) {
                                $monthly_attendance->day_one = "P";
                            } elseif ($current_date_number == 2) {
                                $monthly_attendance->day_two = "P";
                            } elseif ($current_date_number == 3) {
                                $monthly_attendance->day_three = "P";
                            } elseif ($current_date_number == 4) {
                                $monthly_attendance->day_four = "P";
                            } elseif ($current_date_number == 5) {
                                $monthly_attendance->day_five = "P";
                            } elseif ($current_date_number == 6) {
                                $monthly_attendance->day_six = "P";
                            } elseif ($current_date_number == 7) {
                                $monthly_attendance->day_seven = "P";
                            } elseif ($current_date_number == 8) {
                                $monthly_attendance->day_eight = "P";
                            } elseif ($current_date_number == 9) {
                                $monthly_attendance->day_nine = "P";
                            } elseif ($current_date_number == 10) {
                                $monthly_attendance->day_ten = "P";
                            } elseif ($current_date_number == 11) {
                                $monthly_attendance->day_eleven = "P";
                            } elseif ($current_date_number == 12) {
                                $monthly_attendance->day_twelve = "P";
                            } elseif ($current_date_number == 13) {
                                $monthly_attendance->day_thirteen = "P";
                            } elseif ($current_date_number == 14) {
                                $monthly_attendance->day_fourteen = "P";
                            } elseif ($current_date_number == 15) {
                                $monthly_attendance->day_fifteen = "P";
                            } elseif ($current_date_number == 16) {
                                $monthly_attendance->day_sixteen = "P";
                            } elseif ($current_date_number == 17) {
                                $monthly_attendance->day_seventeen = "P";
                            } elseif ($current_date_number == 18) {
                                $monthly_attendance->day_eighteen = "P";
                            } elseif ($current_date_number == 19) {
                                $monthly_attendance->day_nineteen = "P";
                            } elseif ($current_date_number == 20) {
                                $monthly_attendance->day_twenty = "P";
                            } elseif ($current_date_number == 21) {
                                $monthly_attendance->day_twenty_one = "P";
                            } elseif ($current_date_number == 22) {
                                $monthly_attendance->day_twenty_two = "P";
                            } elseif ($current_date_number == 23) {
                                $monthly_attendance->day_twenty_three = "P";
                            } elseif ($current_date_number == 24) {
                                $monthly_attendance->day_twenty_four = "P";
                            } elseif ($current_date_number == 25) {
                                $monthly_attendance->day_twenty_five = "P";
                            } elseif ($current_date_number == 26) {
                                $monthly_attendance->day_twenty_six = "P";
                            } elseif ($current_date_number == 27) {
                                $monthly_attendance->day_twenty_seven = "P";
                            } elseif ($current_date_number == 28) {
                                $monthly_attendance->day_twenty_eight = "P";
                            } elseif ($current_date_number == 29) {
                                $monthly_attendance->day_twenty_nine = "P";
                            } elseif ($current_date_number == 30) {
                                $monthly_attendance->day_thirty = "P";
                            } elseif ($current_date_number == 31) {
                                $monthly_attendance->day_thirty_one = "P";
                            } else {
                                return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                            }

                            $monthly_attendance->day_one = "P";

                            $monthly_attendance->save();
                        }

                        ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                        return back()->with('message', 'Attendance Submitted Successfully');
                    } else {

                        //echo 'not ok'; exit;

                        $added_chackin_lat = $usersValue->check_in_latitude + .1;
                        $deducted_checkin_lat = $usersValue->check_in_latitude - .1;
                        $added_checkin_longi = $usersValue->check_in_longitude + .1;
                        $deducted_checkin_longi = $usersValue->check_in_longitude - .1;

                        $added_chackin_lat = $usersValue->check_in_latitude + 0.0002;
                        $deducted_checkin_lat = $usersValue->check_in_latitude - 0.0002;
                        $added_checkin_longi = $usersValue->check_in_longitude + 0.0002;
                        $deducted_checkin_longi = $usersValue->check_in_longitude - 0.0002;

                        $added_chackin_lat = $usersValue->check_in_latitude + 0.0112609293;
                        $deducted_checkin_lat = $usersValue->check_in_latitude - 0.0112609293;
                        $added_checkin_longi = $usersValue->check_in_longitude + 0.0112459999;
                        $deducted_checkin_longi = $usersValue->check_in_longitude - 0.0112459999;

                        ######################################################## Code for checkin existance starts ##############################################################################
                        $requested_check_in_lat = number_format($request->lat, 2, '.', '');
                        $first_check_in_lat = number_format($usersValue->check_in_latitude, 2, '.', '');

                        if ($first_check_in_lat == $requested_check_in_lat) {
                            //skip
                        } else {

                            if ($usersValue->check_in_latitude != "" || $usersValue->check_in_latitude != NULL) {
                            } else {
                                $user = User::find($request->employee_id);
                                $user->check_in_latitude = $request->lat;
                                $user->check_in_longitude = $request->longt;
                                $user->save();
                            }
                        }
                        ########################################################### Code for checkin existance ends ###########################################################################

                        ############################################ Multiple checkin latitudes and longitudes code starts from here ###############################

                        /////////////////////// checkin latitude portion starts/////////////////////////
                        $requested_check_in_latitude = number_format($request->lat, 2, '.', '');

                        if ($usersValue->check_in_latitude == "" || $usersValue->check_in_latitude == NULL) {
                            $first_check_in_latitude = 0.00;
                        } else {
                            $first_check_in_latitude = number_format($usersValue->check_in_latitude, 2, '.', '');
                        }

                        if ($usersValue->check_in_latitude_two == "" || $usersValue->check_in_latitude_two == NULL) {
                            $second_check_in_latitude = 0.00;
                        } else {
                            $second_check_in_latitude = number_format($usersValue->check_in_latitude_two, 2, '.', '');
                        }

                        if ($usersValue->check_in_latitude_three == "" || $usersValue->check_in_latitude_three == NULL) {
                            $third_check_in_latitude = 0.00;
                        } else {
                            $third_check_in_latitude = number_format($usersValue->check_in_latitude_three, 2, '.', '');
                        }

                        if ($usersValue->check_in_latitude_four == "" || $usersValue->check_in_latitude_four == NULL) {
                            $fourth_check_in_latitude = 0.00;
                        } else {
                            $fourth_check_in_latitude = number_format($usersValue->check_in_latitude_four, 2, '.', '');
                        }
                        if ($usersValue->check_in_latitude_five == "" || $usersValue->check_in_latitude_five == NULL) {
                            $fifth_check_in_latitude = 0.00;
                        } else {
                            $fifth_check_in_latitude = number_format($usersValue->check_in_latitude_five, 2, '.', '');
                        }
                        if ($usersValue->check_in_latitude_six == "" || $usersValue->check_in_latitude_six == NULL) {
                            $sixth_check_in_latitude = 0.00;
                        } else {
                            $sixth_check_in_latitude = number_format($usersValue->check_in_latitude_six, 2, '.', '');
                        }
                        if ($usersValue->check_in_latitude_seven == "" || $usersValue->check_in_latitude_seven == NULL) {
                            $seventh_check_in_latitude = 0.00;
                        } else {
                            $seventh_check_in_latitude = number_format($usersValue->check_in_latitude_seven, 2, '.', '');
                        }

                        if ($first_check_in_latitude == $requested_check_in_latitude) {
                            //echo "first checkin latitude matched";
                            $added_chackin_lat = $usersValue->check_in_latitude + 0.0003;
                            $deducted_checkin_lat = $usersValue->check_in_latitude - 0.0003;
                        } elseif ($usersValue->multi_attendance == 1) {

                            $attendance =  new Attendance();
                            $attendance->attendance_com_id = Auth::user()->com_id;
                            $attendance->employee_id = $request->employee_id;
                            $attendance->attendance_date = $current_date;
                            $attendance->clock_in = $current_time;
                            $attendance->check_in_latitude = $request->lat;
                            $attendance->check_in_longitude = $request->longt;
                            $attendance->check_in_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($shift_in)) {
                                if ($shift_in != 0 && $shift_out != 0) {

                                    $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                    if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {
                                        $late_time = new LateTime();
                                        $late_time->late_time_com_id = Auth::user()->com_id;
                                        $late_time->late_time_employee_id = $request->employee_id;
                                        $late_time->late_time_date = $current_date;
                                        $late_time->save();
                                    }
                                }
                            }

                            $attendance->check_in_out = 1;
                            $attendance->attendance_status = "Present";
                            $attendance->save();
                            return back()->with('message', 'Attendance Submitted Successfully');
                        } else {
                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_in_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_in_attempt = $attempt_counts_value->attendance_location_check_in_attempt + 1;
                                    // $attendance_location->browser = $browser;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                $attendance_location->attendance_location_check_in_attempt = 1;
                                // $attendance_location->browser = $browser;
                                $attendance_location->save();
                            }
                            return back()->with('message', 'Checkin Latitude Not Matched!!! Try again after some time.');
                        }
                        /////////////////////// checkin latitude portion ends/////////////////////////
                        /////////////////////// checkin longitude portion starts/////////////////////////

                        $requested_check_in_longitude = number_format($request->longt, 2, '.', '');

                        if ($usersValue->check_in_longitude == "" || $usersValue->check_in_longitude == NULL) {
                            $first_check_in_longitude = 0.00;
                        } else {
                            $first_check_in_longitude = number_format($usersValue->check_in_longitude, 2, '.', '');
                        }

                        if ($usersValue->check_in_longitude_two == "" || $usersValue->check_in_longitude_two == NULL) {
                            $second_check_in_longitude = 0.00;
                        } else {
                            $second_check_in_longitude = number_format($usersValue->check_in_longitude_two, 2, '.', '');
                        }

                        if ($usersValue->check_in_longitude_three == "" || $usersValue->check_in_longitude_three == NULL) {
                            $third_check_in_longitude = 0.00;
                        } else {
                            $third_check_in_longitude = number_format($usersValue->check_in_longitude_three, 2, '.', '');
                        }

                        if ($usersValue->check_in_longitude_four == "" || $usersValue->check_in_longitude_four == NULL) {
                            $fourth_check_in_longitude = 0.00;
                        } else {
                            $fourth_check_in_longitude = number_format($usersValue->check_in_longitude_four, 2, '.', '');
                        }
                        if ($usersValue->check_in_longitude_five == "" || $usersValue->check_in_longitude_five == NULL) {
                            $fifth_check_in_longitude = 0.00;
                        } else {
                            $fifth_check_in_longitude = number_format($usersValue->check_in_longitude_five, 2, '.', '');
                        }
                        if ($usersValue->check_in_longitude_six == "" || $usersValue->check_in_longitude_six == NULL) {
                            $sixth_check_in_longitude = 0.00;
                        } else {
                            $sixth_check_in_longitude = number_format($usersValue->check_in_longitude_six, 2, '.', '');
                        }
                        if ($usersValue->check_in_longitude_seven == "" || $usersValue->check_in_longitude_seven == NULL) {
                            $seventh_check_in_longitude = 0.00;
                        } else {
                            $seventh_check_in_longitude = number_format($usersValue->check_in_longitude_seven, 2, '.', '');
                        }
                        //echo "ok"; exit;

                        if ($first_check_in_longitude == $requested_check_in_longitude) {
                            //echo "first checkin longitude matched";
                            $added_checkin_longi = $usersValue->check_in_longitude + 0.0003;
                            $deducted_checkin_longi = $usersValue->check_in_longitude - 0.0003;
                        } else {
                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_in_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_in_attempt = $attempt_counts_value->attendance_location_check_in_attempt + 1;
                                    // $attendance_location->browser = $browser;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                $attendance_location->attendance_location_check_in_attempt = 1;
                                // $attendance_location->browser = $browser;
                                $attendance_location->save();
                            }
                            return back()->with('message', 'Checkin Longitude Not Matched!!! Try again after some time.');
                        }
                        /////////////////////// checkin longitude portion ends/////////////////////////
                        ############################################ Multiple checkin latitudes and longitudes code ends here ###############################



                        if (($added_chackin_lat >= $request->lat && $deducted_checkin_lat <= $request->lat) || ($added_checkin_longi >= $request->longt && $deducted_checkin_longi <= $request->longt)) {

                            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->exists()) {

                                return back()->with('message', 'Already Checked In For Today!!! Please Contact With The System Administrator!!!');
                            } else {

                                $attendance = new Attendance();
                                $attendance->attendance_com_id = Auth::user()->com_id;
                                $attendance->employee_id = $request->employee_id;
                                $attendance->attendance_date = $current_date;
                                $attendance->clock_in = $current_time;
                                $attendance->check_in_latitude = $request->lat;
                                $attendance->check_in_longitude = $request->longt;
                                $attendance->check_in_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($shift_in)) {
                                    if ($shift_in != 0 && $shift_out != 0) {

                                        $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                        if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                            if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {

                                                $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                                foreach ($late_times as $late_times_value) {

                                                    $late_time = LateTime::find($late_times_value->id);
                                                    $late_time->late_time_com_id = Auth::user()->com_id;
                                                    $late_time->late_time_employee_id = $request->employee_id;
                                                    $late_time->late_time_date = $current_date;
                                                    $late_time->save();
                                                }
                                            } else {
                                                $late_time = new LateTime();
                                                $late_time->late_time_com_id = Auth::user()->com_id;
                                                $late_time->late_time_employee_id = $request->employee_id;
                                                $late_time->late_time_date = $current_date;
                                                $late_time->save();
                                            }
                                        }
                                    }
                                }
                                //$attendance->check_in_out = 0;
                                $attendance->check_in_out = 1;
                                $attendance->attendance_status = "Present";
                                // $attendance->browser = $browser;
                                $attendance->save();

                                if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->where('holiday_name', $current_day_name)->exists()) { //condition for weekly holiday
                                    //echo "yes";
                                    $compensatory_leave = new CompensatoryLeave();
                                    $compensatory_leave->compen_leave_com_id = Auth::user()->com_id;
                                    $compensatory_leave->compen_leave_employee_id = $request->employee_id;
                                    $compensatory_leave->compen_leave_duty_date = $current_date;
                                    $compensatory_leave->compen_leave_status = 0;
                                    $compensatory_leave->save();
                                } else {

                                    if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereRaw('"' . $current_date . '" between `start_date` and `end_date`')->exists()) { //condition for weekly holiday
                                        //echo "yes";
                                        $compensatory_leave = new CompensatoryLeave();
                                        $compensatory_leave->compen_leave_com_id = Auth::user()->com_id;
                                        $compensatory_leave->compen_leave_employee_id = $request->employee_id;
                                        $compensatory_leave->compen_leave_duty_date = $current_date;
                                        $compensatory_leave->compen_leave_status = 0;
                                        $compensatory_leave->save();
                                    }
                                }

                                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                    foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                        $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                        if ($current_date_number == 1) {
                                            $monthly_attendance->day_one = "P";
                                        } elseif ($current_date_number == 2) {
                                            $monthly_attendance->day_two = "P";
                                        } elseif ($current_date_number == 3) {
                                            $monthly_attendance->day_three = "P";
                                        } elseif ($current_date_number == 4) {
                                            $monthly_attendance->day_four = "P";
                                        } elseif ($current_date_number == 5) {
                                            $monthly_attendance->day_five = "P";
                                        } elseif ($current_date_number == 6) {
                                            $monthly_attendance->day_six = "P";
                                        } elseif ($current_date_number == 7) {
                                            $monthly_attendance->day_seven = "P";
                                        } elseif ($current_date_number == 8) {
                                            $monthly_attendance->day_eight = "P";
                                        } elseif ($current_date_number == 9) {
                                            $monthly_attendance->day_nine = "P";
                                        } elseif ($current_date_number == 10) {
                                            $monthly_attendance->day_ten = "P";
                                        } elseif ($current_date_number == 11) {
                                            $monthly_attendance->day_eleven = "P";
                                        } elseif ($current_date_number == 12) {
                                            $monthly_attendance->day_twelve = "P";
                                        } elseif ($current_date_number == 13) {
                                            $monthly_attendance->day_thirteen = "P";
                                        } elseif ($current_date_number == 14) {
                                            $monthly_attendance->day_fourteen = "P";
                                        } elseif ($current_date_number == 15) {
                                            $monthly_attendance->day_fifteen = "P";
                                        } elseif ($current_date_number == 16) {
                                            $monthly_attendance->day_sixteen = "P";
                                        } elseif ($current_date_number == 17) {
                                            $monthly_attendance->day_seventeen = "P";
                                        } elseif ($current_date_number == 18) {
                                            $monthly_attendance->day_eighteen = "P";
                                        } elseif ($current_date_number == 19) {
                                            $monthly_attendance->day_nineteen = "P";
                                        } elseif ($current_date_number == 20) {
                                            $monthly_attendance->day_twenty = "P";
                                        } elseif ($current_date_number == 21) {
                                            $monthly_attendance->day_twenty_one = "P";
                                        } elseif ($current_date_number == 22) {
                                            $monthly_attendance->day_twenty_two = "P";
                                        } elseif ($current_date_number == 23) {
                                            $monthly_attendance->day_twenty_three = "P";
                                        } elseif ($current_date_number == 24) {
                                            $monthly_attendance->day_twenty_four = "P";
                                        } elseif ($current_date_number == 25) {
                                            $monthly_attendance->day_twenty_five = "P";
                                        } elseif ($current_date_number == 26) {
                                            $monthly_attendance->day_twenty_six = "P";
                                        } elseif ($current_date_number == 27) {
                                            $monthly_attendance->day_twenty_seven = "P";
                                        } elseif ($current_date_number == 28) {
                                            $monthly_attendance->day_twenty_eight = "P";
                                        } elseif ($current_date_number == 29) {
                                            $monthly_attendance->day_twenty_nine = "P";
                                        } elseif ($current_date_number == 30) {
                                            $monthly_attendance->day_thirty = "P";
                                        } elseif ($current_date_number == 31) {
                                            $monthly_attendance->day_thirty_one = "P";
                                        } else {
                                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                        }

                                        $monthly_attendance->save();
                                    }
                                } else {

                                    $monthly_attendance = new MonthlyAttendance();
                                    $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                    $monthly_attendance->monthly_employee_id = $request->employee_id;
                                    $monthly_attendance->attendance_month = $current_date;
                                    $monthly_attendance->attendance_year = $current_date;
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }

                                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                                return back()->with('message', 'Attendance Submitted Successfully');
                            }
                        } else {

                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_in_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_in_attempt = $attempt_counts_value->attendance_location_check_in_attempt + 1;
                                    // $attempt_counts_value->browser = $browser;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                $attendance_location->attendance_location_check_in_attempt = 1;
                                // $attendance_location->browser = $browser;
                                $attendance_location->save();
                            }

                            return back()->with('message', 'Your Checkin Location not Matched!!!!');
                        }
                    }
                }
            } else {

                return back()->with('message', 'Your Browser Or Device not Supported Geolocaton');
            }
            ////////// Attandance check-in code Ends...

        } else {

            ////////// Attandance checkout code Starts...


            if ($request->lat && $request->longt) {


                $users = User::where('id', $request->employee_id)->get();

                $latitude = $request->lat;
                $longitude = $request->longt;
                $employee_id = $request->employee_id;

                foreach ($users as $usersValue) {

                    if ($usersValue->check_out_latitude == '' || $usersValue->check_out_longitude == '' || $usersValue->check_out_latitude == NULL || $usersValue->check_out_longitude == NULL || $usersValue->check_out_latitude === 'No' || $usersValue->check_out_longitude === 'No') {

                        $user = User::find($request->employee_id);
                        $user->check_out_ip = $local_server_ip;
                        $user->check_out_latitude = $request->lat;
                        $user->check_out_longitude = $request->longt;
                        $user->save();

                        $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();


                        foreach ($attendance_employee_id as $attendance_employee_id_value) {

                            $attendance = Attendance::find($attendance_employee_id_value->id);
                            $attendance->clock_out = $current_time;
                            $attendance->check_out_latitude = $request->lat;
                            $attendance->check_out_longitude = $request->longt;
                            $attendance->check_out_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                    $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                    if (Auth::user()->over_time_payable == 'Yes' && Auth::user()->user_over_time_type == 'Automatic') {

                                        if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->exists()) {

                                            $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->get('id');

                                            foreach ($over_times as $over_times_value) {

                                                $over_time = OverTime::find($over_times_value->id);
                                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                $over_time->save();
                                            }
                                        } else {

                                            $over_time = new OverTime();
                                            $over_time->over_time_com_id = Auth::user()->com_id;
                                            $over_time->over_time_employee_id = Auth::user()->id;
                                            $over_time->over_time_type = "Automatic";
                                            $over_time->over_time_date = $current_date;
                                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                            $over_time->save();
                                        }
                                    }
                                }
                            }
                            if (date_create($current_time) <= date_create($shift_out)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                }
                            }
                            $attendance->check_in_out = 1;
                            // $attendance->browser = $browser;
                            $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');

                            $attendance->save();

                            ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                            if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                    $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }
                            } else {

                                $monthly_attendance = new MonthlyAttendance();
                                $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                $monthly_attendance->monthly_employee_id = $request->employee_id;
                                $monthly_attendance->attendance_month = $current_date;
                                $monthly_attendance->attendance_year = $current_date;
                                if ($current_date_number == 1) {
                                    $monthly_attendance->day_one = "P";
                                } elseif ($current_date_number == 2) {
                                    $monthly_attendance->day_two = "P";
                                } elseif ($current_date_number == 3) {
                                    $monthly_attendance->day_three = "P";
                                } elseif ($current_date_number == 4) {
                                    $monthly_attendance->day_four = "P";
                                } elseif ($current_date_number == 5) {
                                    $monthly_attendance->day_five = "P";
                                } elseif ($current_date_number == 6) {
                                    $monthly_attendance->day_six = "P";
                                } elseif ($current_date_number == 7) {
                                    $monthly_attendance->day_seven = "P";
                                } elseif ($current_date_number == 8) {
                                    $monthly_attendance->day_eight = "P";
                                } elseif ($current_date_number == 9) {
                                    $monthly_attendance->day_nine = "P";
                                } elseif ($current_date_number == 10) {
                                    $monthly_attendance->day_ten = "P";
                                } elseif ($current_date_number == 11) {
                                    $monthly_attendance->day_eleven = "P";
                                } elseif ($current_date_number == 12) {
                                    $monthly_attendance->day_twelve = "P";
                                } elseif ($current_date_number == 13) {
                                    $monthly_attendance->day_thirteen = "P";
                                } elseif ($current_date_number == 14) {
                                    $monthly_attendance->day_fourteen = "P";
                                } elseif ($current_date_number == 15) {
                                    $monthly_attendance->day_fifteen = "P";
                                } elseif ($current_date_number == 16) {
                                    $monthly_attendance->day_sixteen = "P";
                                } elseif ($current_date_number == 17) {
                                    $monthly_attendance->day_seventeen = "P";
                                } elseif ($current_date_number == 18) {
                                    $monthly_attendance->day_eighteen = "P";
                                } elseif ($current_date_number == 19) {
                                    $monthly_attendance->day_nineteen = "P";
                                } elseif ($current_date_number == 20) {
                                    $monthly_attendance->day_twenty = "P";
                                } elseif ($current_date_number == 21) {
                                    $monthly_attendance->day_twenty_one = "P";
                                } elseif ($current_date_number == 22) {
                                    $monthly_attendance->day_twenty_two = "P";
                                } elseif ($current_date_number == 23) {
                                    $monthly_attendance->day_twenty_three = "P";
                                } elseif ($current_date_number == 24) {
                                    $monthly_attendance->day_twenty_four = "P";
                                } elseif ($current_date_number == 25) {
                                    $monthly_attendance->day_twenty_five = "P";
                                } elseif ($current_date_number == 26) {
                                    $monthly_attendance->day_twenty_six = "P";
                                } elseif ($current_date_number == 27) {
                                    $monthly_attendance->day_twenty_seven = "P";
                                } elseif ($current_date_number == 28) {
                                    $monthly_attendance->day_twenty_eight = "P";
                                } elseif ($current_date_number == 29) {
                                    $monthly_attendance->day_twenty_nine = "P";
                                } elseif ($current_date_number == 30) {
                                    $monthly_attendance->day_thirty = "P";
                                } elseif ($current_date_number == 31) {
                                    $monthly_attendance->day_thirty_one = "P";
                                } else {
                                    return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                }

                                $monthly_attendance->save();
                            }

                            ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                            return back()->with('message', 'Attendance Checkout Done Successfully');
                        }
                    } else {


                        $added_chackout_lat = $usersValue->check_out_latitude + .1;
                        $deducted_checkout_lat = $usersValue->check_out_latitude - .1;
                        $added_checkout_longi = $usersValue->check_out_longitude + .1;
                        $deducted_checkout_longi = $usersValue->check_out_longitude - .1;

                        $added_chackout_lat = $usersValue->check_out_latitude + 0.0002;
                        $deducted_checkout_lat = $usersValue->check_out_latitude - 0.0002;
                        $added_checkout_longi = $usersValue->check_out_longitude + 0.0002;
                        $deducted_checkout_longi = $usersValue->check_out_longitude - 0.0002;

                        $added_chackout_lat = $usersValue->check_out_latitude + 0.0112609293;
                        $deducted_checkout_lat = $usersValue->check_out_latitude - 0.0112609293;
                        $added_checkout_longi = $usersValue->check_out_longitude + 0.0112459999;
                        $deducted_checkout_longi = $usersValue->check_out_longitude - 0.0112459999;

                        ######################################################## Code for checkout existance starts ##############################################################################

                        $requested_check_out_lat = number_format($request->lat, 2, '.', '');

                        $first_check_out_lat = number_format($usersValue->check_out_latitude, 2, '.', '');

                        if ($first_check_out_lat == $requested_check_out_lat) {
                            //skip
                        } else {

                            if ($usersValue->check_out_latitude != "" || $usersValue->check_out_latitude != NULL) {
                                //skip
                            } else {
                                $user = User::find($request->employee_id);
                                $user->check_out_latitude = $request->lat;
                                $user->check_out_longitude = $request->longt;
                                $user->save();
                            }
                        }

                        ########################################################### Code for checkout existance ends ###########################################################################

                        ############################################ Multiple checkout latitudes and longitudes code starts from here ###############################

                        /////////////////////// checkin latitude portion starts/////////////////////////
                        $requested_check_out_latitude = number_format($request->lat, 2, '.', '');
                        if ($usersValue->check_out_latitude == "" || $usersValue->check_out_latitude == NULL) {
                            $first_check_out_latitude = 0.00;
                        } else {
                            $first_check_out_latitude = number_format($usersValue->check_out_latitude, 2, '.', '');
                        }
                        //echo "ok"; exit;
                        if ($first_check_out_latitude == $requested_check_out_latitude) {
                            //echo "first checkout latitude matched";
                            $added_chackout_lat = $usersValue->check_out_latitude + 0.0003;
                            $deducted_checkout_lat = $usersValue->check_out_latitude - 0.0003;
                        } elseif ($usersValue->multi_attendance == 1) {
                            $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();

                            foreach ($attendance_employee_id as $attendance_employee_id_value) {
                                $attendance = Attendance::find($attendance_employee_id_value->id);
                                $attendance->clock_out = $current_time;
                                $attendance->check_out_latitude = $request->lat;
                                $attendance->check_out_longitude = $request->longt;
                                $attendance->check_out_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                        $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                        if ($request->over_time_payable == 'Yes' && $request->user_over_time_type == 'Automatic') {
                                            $over_time = new OverTime();
                                            $over_time->over_time_com_id = $request->com_id;
                                            $over_time->over_time_employee_id = $request->employee_id;
                                            $over_time->over_time_type = "Automatic";
                                            $over_time->over_time_date = $current_date;
                                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                            //$over_time->over_time_rate = $request->user_over_time_rate;
                                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                            $over_time->save();
                                        }
                                    }
                                }
                                if (date_create($current_time) <= date_create($shift_out)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                    }
                                }
                                $attendance->check_in_out = 1;
                                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');

                                $attendance->save();
                                return back()->with('message', 'Attendance Checkout Done Successfully');
                            }
                        } else {
                            //echo "ok"; exit;

                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_out_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_out_attempt = $attempt_counts_value->attendance_location_check_out_attempt + 1;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                $attendance_location->attendance_location_check_out_attempt = 1;
                                $attendance_location->save();
                            }

                            return back()->with('message', 'Checkout Latitude Not Matched!!! Please try again after some time.');
                            //echo "checkout latitude not matched";
                        }
                        /////////////////////// checkout latitude portion ends/////////////////////////
                        /////////////////////// checkout longitude portion starts/////////////////////////

                        $requested_check_out_longitude = number_format($request->longt, 2, '.', '');

                        if ($usersValue->check_out_longitude == "" || $usersValue->check_out_longitude == NULL) {
                            $first_check_out_longitude = 0.00;
                        } else {
                            $first_check_out_longitude = number_format($usersValue->check_out_longitude, 2, '.', '');
                        }

                        if ($usersValue->check_out_longitude_two == "" || $usersValue->check_out_longitude_two == NULL) {
                            $second_check_out_longitude = 0.00;
                        } else {
                            $second_check_out_longitude = number_format($usersValue->check_out_longitude_two, 2, '.', '');
                        }

                        if ($usersValue->check_out_longitude_three == "" || $usersValue->check_out_longitude_three == NULL) {
                            $third_check_out_longitude = 0.00;
                        } else {
                            $third_check_out_longitude = number_format($usersValue->check_out_longitude_three, 2, '.', '');
                        }
                        if ($usersValue->check_out_longitude_four == "" || $usersValue->check_out_longitude_four == NULL) {
                            $fourth_check_out_longitude = 0.00;
                        } else {
                            $fourth_check_out_longitude = number_format($usersValue->check_out_longitude_four, 2, '.', '');
                        }
                        if ($usersValue->check_out_longitude_five == "" || $usersValue->check_out_longitude_five == NULL) {
                            $fifth_check_out_longitude = 0.00;
                        } else {
                            $fifth_check_out_longitude = number_format($usersValue->check_out_longitude_five, 2, '.', '');
                        }
                        if ($usersValue->check_out_longitude_six == "" || $usersValue->check_out_longitude_six == NULL) {
                            $sixth_check_out_longitude = 0.00;
                        } else {
                            $sixth_check_out_longitude = number_format($usersValue->check_out_longitude_six, 2, '.', '');
                        }
                        if ($usersValue->check_out_longitude_seven == "" || $usersValue->check_out_longitude_seven == NULL) {
                            $seventh_check_out_longitude = 0.00;
                        } else {
                            $seventh_check_out_longitude = number_format($usersValue->check_out_longitude_seven, 2, '.', '');
                        }

                        if ($first_check_out_longitude == $requested_check_out_longitude) {
                            //echo "ok"; exit;
                            $added_checkout_longi = $usersValue->check_out_longitude + 0.0003;
                            $deducted_checkout_longi = $usersValue->check_out_longitude - 0.0003;
                        } elseif ($usersValue->multi_attendance == 1) {
                            $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();

                            foreach ($attendance_employee_id as $attendance_employee_id_value) {
                                $attendance = Attendance::find($attendance_employee_id_value->id);
                                $attendance->clock_out = $current_time;
                                $attendance->check_out_latitude = $request->lat;
                                $attendance->check_out_longitude = $request->longt;
                                $attendance->check_out_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                        $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                        if ($request->over_time_payable == 'Yes' && $request->user_over_time_type == 'Automatic') {
                                            $over_time = new OverTime();
                                            $over_time->over_time_com_id = $request->com_id;
                                            $over_time->over_time_employee_id = $request->employee_id;
                                            $over_time->over_time_type = "Automatic";
                                            $over_time->over_time_date = $current_date;
                                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                            //$over_time->over_time_rate = $request->user_over_time_rate;
                                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                            $over_time->save();
                                        }
                                    }
                                }
                                if (date_create($current_time) <= date_create($shift_out)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                    }
                                }
                                $attendance->check_in_out = 1;
                                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');

                                $attendance->save();
                            }
                        } else {

                            //echo "ok"; exit;

                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_out_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_out_attempt = $attempt_counts_value->attendance_location_check_out_attempt + 1;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                $attendance_location->attendance_location_check_out_attempt = 1;
                                $attendance_location->save();
                            }

                            return back()->with('message', 'Checkout Longitude Not Matched!!! Please try again after some time.');
                            //echo "checkout longitude location not matched";
                        }
                        /////////////////////// checkout longitude portion ends/////////////////////////
                        ############################################ Multiple checkout latitudes and longitudes code starts from here ###############################

                        if (($added_chackout_lat >= $request->lat && $deducted_checkout_lat <= $request->lat) || ($added_checkout_longi >= $request->longt && $deducted_checkout_longi <= $request->longt)) {

                            $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();
                            foreach ($attendance_employee_id as $attendance_employee_id_value) {

                                // if($attendance_employee_id_value->check_in_out === 1){

                                //     return back()->with('message','Already Checked Out For Today!!! Please Contact With The System Administrator!!!');

                                // }else{

                                $attendance = Attendance::find($attendance_employee_id_value->id);
                                $attendance->clock_out = $current_time;
                                $attendance->check_out_latitude = $request->lat;
                                $attendance->check_out_longitude = $request->longt;
                                $attendance->check_out_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                        $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                        if (Auth::user()->over_time_payable == 'Yes' && Auth::user()->user_over_time_type == 'Automatic') {

                                            if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->exists()) {

                                                $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->get('id');

                                                foreach ($over_times as $over_times_value) {

                                                    $over_time = OverTime::find($over_times_value->id);
                                                    $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                    $over_time->save();
                                                }
                                            } else {

                                                $over_time = new OverTime();
                                                $over_time->over_time_com_id = Auth::user()->com_id;
                                                $over_time->over_time_employee_id = Auth::user()->id;
                                                $over_time->over_time_type = "Automatic";
                                                $over_time->over_time_date = $current_date;
                                                $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                                $over_time->save();
                                            }
                                        }
                                    }
                                }
                                if (date_create($current_time) <= date_create($shift_out)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                    }
                                }
                                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                                $attendance->check_in_out = 1;
                                $attendance->save();

                                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                    foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                        $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                        if ($current_date_number == 1) {
                                            $monthly_attendance->day_one = "P";
                                        } elseif ($current_date_number == 2) {
                                            $monthly_attendance->day_two = "P";
                                        } elseif ($current_date_number == 3) {
                                            $monthly_attendance->day_three = "P";
                                        } elseif ($current_date_number == 4) {
                                            $monthly_attendance->day_four = "P";
                                        } elseif ($current_date_number == 5) {
                                            $monthly_attendance->day_five = "P";
                                        } elseif ($current_date_number == 6) {
                                            $monthly_attendance->day_six = "P";
                                        } elseif ($current_date_number == 7) {
                                            $monthly_attendance->day_seven = "P";
                                        } elseif ($current_date_number == 8) {
                                            $monthly_attendance->day_eight = "P";
                                        } elseif ($current_date_number == 9) {
                                            $monthly_attendance->day_nine = "P";
                                        } elseif ($current_date_number == 10) {
                                            $monthly_attendance->day_ten = "P";
                                        } elseif ($current_date_number == 11) {
                                            $monthly_attendance->day_eleven = "P";
                                        } elseif ($current_date_number == 12) {
                                            $monthly_attendance->day_twelve = "P";
                                        } elseif ($current_date_number == 13) {
                                            $monthly_attendance->day_thirteen = "P";
                                        } elseif ($current_date_number == 14) {
                                            $monthly_attendance->day_fourteen = "P";
                                        } elseif ($current_date_number == 15) {
                                            $monthly_attendance->day_fifteen = "P";
                                        } elseif ($current_date_number == 16) {
                                            $monthly_attendance->day_sixteen = "P";
                                        } elseif ($current_date_number == 17) {
                                            $monthly_attendance->day_seventeen = "P";
                                        } elseif ($current_date_number == 18) {
                                            $monthly_attendance->day_eighteen = "P";
                                        } elseif ($current_date_number == 19) {
                                            $monthly_attendance->day_nineteen = "P";
                                        } elseif ($current_date_number == 20) {
                                            $monthly_attendance->day_twenty = "P";
                                        } elseif ($current_date_number == 21) {
                                            $monthly_attendance->day_twenty_one = "P";
                                        } elseif ($current_date_number == 22) {
                                            $monthly_attendance->day_twenty_two = "P";
                                        } elseif ($current_date_number == 23) {
                                            $monthly_attendance->day_twenty_three = "P";
                                        } elseif ($current_date_number == 24) {
                                            $monthly_attendance->day_twenty_four = "P";
                                        } elseif ($current_date_number == 25) {
                                            $monthly_attendance->day_twenty_five = "P";
                                        } elseif ($current_date_number == 26) {
                                            $monthly_attendance->day_twenty_six = "P";
                                        } elseif ($current_date_number == 27) {
                                            $monthly_attendance->day_twenty_seven = "P";
                                        } elseif ($current_date_number == 28) {
                                            $monthly_attendance->day_twenty_eight = "P";
                                        } elseif ($current_date_number == 29) {
                                            $monthly_attendance->day_twenty_nine = "P";
                                        } elseif ($current_date_number == 30) {
                                            $monthly_attendance->day_thirty = "P";
                                        } elseif ($current_date_number == 31) {
                                            $monthly_attendance->day_thirty_one = "P";
                                        } else {
                                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                        }

                                        $monthly_attendance->save();
                                    }
                                } else {

                                    $monthly_attendance = new MonthlyAttendance();
                                    $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                    $monthly_attendance->monthly_employee_id = $request->employee_id;
                                    $monthly_attendance->attendance_month = $current_date;
                                    $monthly_attendance->attendance_year = $current_date;
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }

                                return back()->with('message', 'Attendance Checkout Done Successfully');

                                //}



                            }
                        } else {

                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_out_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_out_attempt = $attempt_counts_value->attendance_location_check_out_attempt + 1;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = Auth::user()->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                $attendance_location->attendance_location_check_out_attempt = 1;
                                $attendance_location->save();
                            }

                            return back()->with('message', 'Your Checkout Location not Matched!!!!');
                        }
                    }
                }
            } else {

                return back()->with('message', 'Your Browser Or Device not Supported Geolocaton');
            }


            ////////// Attandance checkout code Ends...

        }
    }




    public function employeeDepartment()
    {

        $piedata = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->select('departments.department_name', DB::raw("count(users.id) as count"))
            ->groupBy('department_name')
            ->get();

        return view('pieemployeedata', compact('piedata'));
    }


    public function employeeDesignation()
    {
        $data = DB::select(DB::raw("select count(*) as designation_number,designation_name from designations group by designation_name"));

        $chartData = "";
        foreach ($data as  $dept) {
            $chartData .= "['" . $dept->designation_name . "', " . $dept->designation_number . "],";
        }
        $piedata['chartData'] = rtrim($chartData, ",");
        return view('employeedesignation', $piedata);
    }


    public function fileImportDetail(Request $request)
    {

        $importcompanydetails = Company::where('id', Auth::user()->com_id)->get();

        $importdepartmentdetails = Department::where('department_com_id', Auth::user()->com_id)->get();

        $importdesignationdetails = Designation::with('designationdepartment')->where('designation_com_id', '=', Auth::user()->com_id)->get();

        $importofficeshiftsdetails = OfficeShift::where('office_shift_com_id', Auth::user()->com_id)->get();
        $importregiondetails = Region::where('region_com_id', Auth::user()->com_id)->get();

        $importareadetails = Area::with('arearegion')->where('area_com_id', Auth::user()->com_id)->get();

        $importterritorydetails = Territory::with('territoryregion', 'territoryarea')->where('territory_com_id', Auth::user()->com_id)->get();

        $importtowndetails = Town::with('townregion', 'townarea', 'townterritory')->where('town_com_id', Auth::user()->com_id)->get();

        $importdbdetails = DbHouse::with('dbhouseregion', 'dbhousearea', 'dbhouseterritory', 'dbhousetown')->where('db_house_com_id', Auth::user()->com_id)->get();

        $importroledetails = Role::where('roles_com_id', Auth::user()->com_id)->get();

        $report_to_parent_ids = User::where('com_id', Auth::user()->com_id)->where('company_profile', '=', 'Yes')->get();

        $pdf = PDF::loadView('back-end.premium.emails.import-details', [
            'report_to_parent_ids' => $report_to_parent_ids,
            'importcompanydetails' => $importcompanydetails,
            'importdepartmentdetails' => $importdepartmentdetails,
            'importdesignationdetails' => $importdesignationdetails,
            'importofficeshiftsdetails' => $importofficeshiftsdetails,
            'importregiondetails' => $importregiondetails,
            'importareadetails' => $importareadetails,
            'importterritorydetails' => $importterritorydetails,
            'importtowndetails' => $importtowndetails,
            'importdbdetails' => $importdbdetails,
            'importroledetails' => $importroledetails,

        ]);
        $pdf->download('Importdetails.pdf');
        return back()->with('message', 'Pdf Generated Successfully');
    }




    public function employeeIpBasedAttandance(Request $request)
    {

        $validated = $request->validate([
            'employee_id' => 'required',
        ]);

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');
        $current_month = $date->format('m');
        $current_year = $date->format('Y');
        $current_date_number = $date->format('d');
        $current_time = $date->format('H:i:s');
        $local_server_ip = $request->ip();
        $current_day_name = date('D', strtotime($current_date));


        if ($current_day_name == "Sun") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->sunday_in;
                    $shift_out = $office_shifts->sunday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Mon") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->monday_in;
                    $shift_out = $office_shifts->monday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Tue") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->tuesday_in;
                    $shift_out = $office_shifts->tuesday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Wed") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->wednesday_in;
                    $shift_out = $office_shifts->wednesday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Thu") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->thursday_in;
                    $shift_out = $office_shifts->thursday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Fri") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->friday_in;
                    $shift_out = $office_shifts->friday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Sat") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->saturday_in;
                    $shift_out = $office_shifts->saturday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } else {
            // $shift_in = 0;
            // $shift_out = 0;
            return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
        }


        ################ Seconds from shift start to end time of the day code starts from here ################################
        $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
        $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
        $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
        ################ Seconds from shift start to end time of the day code ends here #######################################
        $payable_time = strtotime($shift_out) + 60 * 60;
        $payable_over_time_hour = date('H:i', $payable_time);
        ################ Late Time Countable Seconds code starts from here ####################################################
        $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
        $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
        $current_time_in_seconds = strtotime($current_time) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################


        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements

            return back()->with('message', 'You Have Taken A Leave For This Day!!!');
        }

        if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements

            return back()->with('message', 'You are not permitted to give attendance when you are on traveling!!!');
        }


        if ($request->check_in_request) {

            ////////// Attandance check-in code Starts...


            if ($local_server_ip) {


                $users = User::where('id', $request->employee_id)->get();

                $latitude = $request->lat;
                $longitude = $request->longt;
                $employee_id = $request->employee_id;

                foreach ($users as $usersValue) {

                    //echo $usersValue->attendance_status; exit;

                    if ($usersValue->attendance_status == "" || $usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No') {
                        // if($usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No'){
                        //echo 'ok'; exit;

                        $user = User::find($request->employee_id);
                        $user->attendance_status = "Yes";
                        $user->check_in_ip = $local_server_ip;
                        // $user->check_in_latitude = $request->lat;
                        // $user->check_in_longitude = $request->longt;
                        $user->save();



                        $attendance = new Attendance();
                        $attendance->attendance_com_id = Auth::user()->com_id;
                        $attendance->employee_id = $request->employee_id;
                        $attendance->attendance_date = $current_date;
                        $attendance->clock_in = $current_time;
                        // $attendance->check_in_latitude = $request->lat;
                        // $attendance->check_in_longitude = $request->longt;
                        $attendance->check_in_ip = $local_server_ip;
                        if (date_create($current_time) >= date_create($shift_in)) {
                            if ($shift_in != 0 && $shift_out != 0) {

                                $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                    if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {

                                        $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                        foreach ($late_times as $late_times_value) {

                                            $late_time = LateTime::find($late_times_value->id);
                                            $late_time->late_time_com_id = Auth::user()->com_id;
                                            $late_time->late_time_employee_id = $request->employee_id;
                                            $late_time->late_time_date = $current_date;
                                            $late_time->save();
                                        }
                                    } else {
                                        $late_time = new LateTime();
                                        $late_time->late_time_com_id = Auth::user()->com_id;
                                        $late_time->late_time_employee_id = $request->employee_id;
                                        $late_time->late_time_date = $current_date;
                                        $late_time->save();
                                    }
                                }
                            }
                        }

                        //$attendance->check_in_out = 0;
                        $attendance->check_in_out = 1;
                        $attendance->attendance_status = "Present";
                        $attendance->save();

                        ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                        $monthly_attendance = new MonthlyAttendance();
                        $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                        $monthly_attendance->monthly_employee_id = $request->employee_id;
                        $monthly_attendance->attendance_month = $current_date;
                        $monthly_attendance->attendance_year = $current_date;
                        if ($current_date_number == 1) {
                            $monthly_attendance->day_one = "P";
                        } elseif ($current_date_number == 2) {
                            $monthly_attendance->day_two = "P";
                        } elseif ($current_date_number == 3) {
                            $monthly_attendance->day_three = "P";
                        } elseif ($current_date_number == 4) {
                            $monthly_attendance->day_four = "P";
                        } elseif ($current_date_number == 5) {
                            $monthly_attendance->day_five = "P";
                        } elseif ($current_date_number == 6) {
                            $monthly_attendance->day_six = "P";
                        } elseif ($current_date_number == 7) {
                            $monthly_attendance->day_seven = "P";
                        } elseif ($current_date_number == 8) {
                            $monthly_attendance->day_eight = "P";
                        } elseif ($current_date_number == 9) {
                            $monthly_attendance->day_nine = "P";
                        } elseif ($current_date_number == 10) {
                            $monthly_attendance->day_ten = "P";
                        } elseif ($current_date_number == 11) {
                            $monthly_attendance->day_eleven = "P";
                        } elseif ($current_date_number == 12) {
                            $monthly_attendance->day_twelve = "P";
                        } elseif ($current_date_number == 13) {
                            $monthly_attendance->day_thirteen = "P";
                        } elseif ($current_date_number == 14) {
                            $monthly_attendance->day_fourteen = "P";
                        } elseif ($current_date_number == 15) {
                            $monthly_attendance->day_fifteen = "P";
                        } elseif ($current_date_number == 16) {
                            $monthly_attendance->day_sixteen = "P";
                        } elseif ($current_date_number == 17) {
                            $monthly_attendance->day_seventeen = "P";
                        } elseif ($current_date_number == 18) {
                            $monthly_attendance->day_eighteen = "P";
                        } elseif ($current_date_number == 19) {
                            $monthly_attendance->day_nineteen = "P";
                        } elseif ($current_date_number == 20) {
                            $monthly_attendance->day_twenty = "P";
                        } elseif ($current_date_number == 21) {
                            $monthly_attendance->day_twenty_one = "P";
                        } elseif ($current_date_number == 22) {
                            $monthly_attendance->day_twenty_two = "P";
                        } elseif ($current_date_number == 23) {
                            $monthly_attendance->day_twenty_three = "P";
                        } elseif ($current_date_number == 24) {
                            $monthly_attendance->day_twenty_four = "P";
                        } elseif ($current_date_number == 25) {
                            $monthly_attendance->day_twenty_five = "P";
                        } elseif ($current_date_number == 26) {
                            $monthly_attendance->day_twenty_six = "P";
                        } elseif ($current_date_number == 27) {
                            $monthly_attendance->day_twenty_seven = "P";
                        } elseif ($current_date_number == 28) {
                            $monthly_attendance->day_twenty_eight = "P";
                        } elseif ($current_date_number == 29) {
                            $monthly_attendance->day_twenty_nine = "P";
                        } elseif ($current_date_number == 30) {
                            $monthly_attendance->day_thirty = "P";
                        } elseif ($current_date_number == 31) {
                            $monthly_attendance->day_thirty_one = "P";
                        } else {
                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                        }

                        $monthly_attendance->day_one = "P";

                        $monthly_attendance->save();

                        ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                        return back()->with('message', 'Attendance Submitted Successfully');
                    } else {

                        //echo 'not ok'; exit;

                        // $added_chackin_lat = $usersValue->check_in_latitude + .1;
                        // $deducted_checkin_lat = $usersValue->check_in_latitude - .1;
                        // $added_checkin_longi = $usersValue->check_in_longitude + .1;
                        // $deducted_checkin_longi = $usersValue->check_in_longitude - .1;


                        //if(($added_chackin_lat >= $request->lat && $deducted_checkin_lat <= $request->lat) || ($added_checkin_longi >= $request->longt && $deducted_checkin_longi <= $request->longt)){
                        if (($usersValue->check_in_ip = $local_server_ip)) {

                            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->exists()) {

                                return back()->with('message', 'Already Checked In For Today!!! Please Contact With The System Administrator!!!');
                            } else {

                                $attendance = new Attendance();
                                $attendance->attendance_com_id = Auth::user()->com_id;
                                $attendance->employee_id = $request->employee_id;
                                $attendance->attendance_date = $current_date;
                                $attendance->clock_in = $current_time;
                                // $attendance->check_in_latitude = $request->lat;
                                // $attendance->check_in_longitude = $request->longt;
                                $attendance->check_in_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($shift_in)) {
                                    if ($shift_in != 0 && $shift_out != 0) {

                                        $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                        if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                            if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {

                                                $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                                foreach ($late_times as $late_times_value) {

                                                    $late_time = LateTime::find($late_times_value->id);
                                                    $late_time->late_time_com_id = Auth::user()->com_id;
                                                    $late_time->late_time_employee_id = $request->employee_id;
                                                    $late_time->late_time_date = $current_date;
                                                    $late_time->save();
                                                }
                                            } else {
                                                $late_time = new LateTime();
                                                $late_time->late_time_com_id = Auth::user()->com_id;
                                                $late_time->late_time_employee_id = $request->employee_id;
                                                $late_time->late_time_date = $current_date;
                                                $late_time->save();
                                            }
                                        }
                                    }
                                }
                                //$attendance->check_in_out = 0;
                                $attendance->check_in_out = 1;
                                $attendance->attendance_status = "Present";
                                $attendance->save();

                                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                    foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                        $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                        if ($current_date_number == 1) {
                                            $monthly_attendance->day_one = "P";
                                        } elseif ($current_date_number == 2) {
                                            $monthly_attendance->day_two = "P";
                                        } elseif ($current_date_number == 3) {
                                            $monthly_attendance->day_three = "P";
                                        } elseif ($current_date_number == 4) {
                                            $monthly_attendance->day_four = "P";
                                        } elseif ($current_date_number == 5) {
                                            $monthly_attendance->day_five = "P";
                                        } elseif ($current_date_number == 6) {
                                            $monthly_attendance->day_six = "P";
                                        } elseif ($current_date_number == 7) {
                                            $monthly_attendance->day_seven = "P";
                                        } elseif ($current_date_number == 8) {
                                            $monthly_attendance->day_eight = "P";
                                        } elseif ($current_date_number == 9) {
                                            $monthly_attendance->day_nine = "P";
                                        } elseif ($current_date_number == 10) {
                                            $monthly_attendance->day_ten = "P";
                                        } elseif ($current_date_number == 11) {
                                            $monthly_attendance->day_eleven = "P";
                                        } elseif ($current_date_number == 12) {
                                            $monthly_attendance->day_twelve = "P";
                                        } elseif ($current_date_number == 13) {
                                            $monthly_attendance->day_thirteen = "P";
                                        } elseif ($current_date_number == 14) {
                                            $monthly_attendance->day_fourteen = "P";
                                        } elseif ($current_date_number == 15) {
                                            $monthly_attendance->day_fifteen = "P";
                                        } elseif ($current_date_number == 16) {
                                            $monthly_attendance->day_sixteen = "P";
                                        } elseif ($current_date_number == 17) {
                                            $monthly_attendance->day_seventeen = "P";
                                        } elseif ($current_date_number == 18) {
                                            $monthly_attendance->day_eighteen = "P";
                                        } elseif ($current_date_number == 19) {
                                            $monthly_attendance->day_nineteen = "P";
                                        } elseif ($current_date_number == 20) {
                                            $monthly_attendance->day_twenty = "P";
                                        } elseif ($current_date_number == 21) {
                                            $monthly_attendance->day_twenty_one = "P";
                                        } elseif ($current_date_number == 22) {
                                            $monthly_attendance->day_twenty_two = "P";
                                        } elseif ($current_date_number == 23) {
                                            $monthly_attendance->day_twenty_three = "P";
                                        } elseif ($current_date_number == 24) {
                                            $monthly_attendance->day_twenty_four = "P";
                                        } elseif ($current_date_number == 25) {
                                            $monthly_attendance->day_twenty_five = "P";
                                        } elseif ($current_date_number == 26) {
                                            $monthly_attendance->day_twenty_six = "P";
                                        } elseif ($current_date_number == 27) {
                                            $monthly_attendance->day_twenty_seven = "P";
                                        } elseif ($current_date_number == 28) {
                                            $monthly_attendance->day_twenty_eight = "P";
                                        } elseif ($current_date_number == 29) {
                                            $monthly_attendance->day_twenty_nine = "P";
                                        } elseif ($current_date_number == 30) {
                                            $monthly_attendance->day_thirty = "P";
                                        } elseif ($current_date_number == 31) {
                                            $monthly_attendance->day_thirty_one = "P";
                                        } else {
                                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                        }

                                        $monthly_attendance->save();
                                    }
                                } else {

                                    $monthly_attendance = new MonthlyAttendance();
                                    $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                    $monthly_attendance->monthly_employee_id = $request->employee_id;
                                    $monthly_attendance->attendance_month = $current_date;
                                    $monthly_attendance->attendance_year = $current_date;
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }

                                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


                                return back()->with('message', 'Attendance Submitted Successfully');
                            }
                        } else {

                            return back()->with('message', 'Your Checkin Ip not Matched!!!!');
                        }
                    }
                }
            } else {

                return back()->with('message', 'Your Browser Or Device Does Not Provide The Ip Address!!!');
            }
            ////////// Attandance check-in code Ends...

        } else {

            ////////// Attandance checkout code Starts...


            if ($local_server_ip) {


                $users = User::where('id', $request->employee_id)->get();

                $latitude = $request->lat;
                $longitude = $request->longt;
                $employee_id = $request->employee_id;

                foreach ($users as $usersValue) {

                    if ($usersValue->check_out_ip == '' || $usersValue->check_out_ip == NULL || $usersValue->check_out_ip === 'No') {

                        $user = User::find($request->employee_id);
                        $user->check_out_ip = $local_server_ip;
                        // $user->check_out_latitude = $request->lat;
                        // $user->check_out_longitude = $request->longt;
                        $user->save();

                        $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();


                        foreach ($attendance_employee_id as $attendance_employee_id_value) {

                            $attendance = Attendance::find($attendance_employee_id_value->id);
                            $attendance->clock_out = $current_time;
                            // $attendance->check_out_latitude = $request->lat;
                            // $attendance->check_out_longitude = $request->longt;
                            $attendance->check_out_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                    $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                    if (Auth::user()->over_time_payable == 'Yes' && Auth::user()->user_over_time_type == 'Automatic') {

                                        if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->exists()) {

                                            $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->get('id');

                                            foreach ($over_times as $over_times_value) {

                                                $over_time = OverTime::find($over_times_value->id);
                                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                $over_time->save();
                                            }
                                        } else {

                                            $over_time = new OverTime();
                                            $over_time->over_time_com_id = Auth::user()->com_id;
                                            $over_time->over_time_employee_id = Auth::user()->id;
                                            $over_time->over_time_type = "Automatic";
                                            $over_time->over_time_date = $current_date;
                                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                            $over_time->save();
                                        }
                                    }
                                }
                            }
                            if (date_create($current_time) <= date_create($shift_out)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                }
                            }
                            $attendance->check_in_out = 1;
                            $attendance->save();


                            ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                            if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                    $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }
                            } else {

                                $monthly_attendance = new MonthlyAttendance();
                                $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                $monthly_attendance->monthly_employee_id = $request->employee_id;
                                $monthly_attendance->attendance_month = $current_date;
                                $monthly_attendance->attendance_year = $current_date;
                                if ($current_date_number == 1) {
                                    $monthly_attendance->day_one = "P";
                                } elseif ($current_date_number == 2) {
                                    $monthly_attendance->day_two = "P";
                                } elseif ($current_date_number == 3) {
                                    $monthly_attendance->day_three = "P";
                                } elseif ($current_date_number == 4) {
                                    $monthly_attendance->day_four = "P";
                                } elseif ($current_date_number == 5) {
                                    $monthly_attendance->day_five = "P";
                                } elseif ($current_date_number == 6) {
                                    $monthly_attendance->day_six = "P";
                                } elseif ($current_date_number == 7) {
                                    $monthly_attendance->day_seven = "P";
                                } elseif ($current_date_number == 8) {
                                    $monthly_attendance->day_eight = "P";
                                } elseif ($current_date_number == 9) {
                                    $monthly_attendance->day_nine = "P";
                                } elseif ($current_date_number == 10) {
                                    $monthly_attendance->day_ten = "P";
                                } elseif ($current_date_number == 11) {
                                    $monthly_attendance->day_eleven = "P";
                                } elseif ($current_date_number == 12) {
                                    $monthly_attendance->day_twelve = "P";
                                } elseif ($current_date_number == 13) {
                                    $monthly_attendance->day_thirteen = "P";
                                } elseif ($current_date_number == 14) {
                                    $monthly_attendance->day_fourteen = "P";
                                } elseif ($current_date_number == 15) {
                                    $monthly_attendance->day_fifteen = "P";
                                } elseif ($current_date_number == 16) {
                                    $monthly_attendance->day_sixteen = "P";
                                } elseif ($current_date_number == 17) {
                                    $monthly_attendance->day_seventeen = "P";
                                } elseif ($current_date_number == 18) {
                                    $monthly_attendance->day_eighteen = "P";
                                } elseif ($current_date_number == 19) {
                                    $monthly_attendance->day_nineteen = "P";
                                } elseif ($current_date_number == 20) {
                                    $monthly_attendance->day_twenty = "P";
                                } elseif ($current_date_number == 21) {
                                    $monthly_attendance->day_twenty_one = "P";
                                } elseif ($current_date_number == 22) {
                                    $monthly_attendance->day_twenty_two = "P";
                                } elseif ($current_date_number == 23) {
                                    $monthly_attendance->day_twenty_three = "P";
                                } elseif ($current_date_number == 24) {
                                    $monthly_attendance->day_twenty_four = "P";
                                } elseif ($current_date_number == 25) {
                                    $monthly_attendance->day_twenty_five = "P";
                                } elseif ($current_date_number == 26) {
                                    $monthly_attendance->day_twenty_six = "P";
                                } elseif ($current_date_number == 27) {
                                    $monthly_attendance->day_twenty_seven = "P";
                                } elseif ($current_date_number == 28) {
                                    $monthly_attendance->day_twenty_eight = "P";
                                } elseif ($current_date_number == 29) {
                                    $monthly_attendance->day_twenty_nine = "P";
                                } elseif ($current_date_number == 30) {
                                    $monthly_attendance->day_thirty = "P";
                                } elseif ($current_date_number == 31) {
                                    $monthly_attendance->day_thirty_one = "P";
                                } else {
                                    return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                }

                                $monthly_attendance->save();
                            }

                            ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


                            return back()->with('message', 'Attendance Checkout Done Successfully');
                        }
                    } else {


                        // $added_chackout_lat = $usersValue->check_out_latitude + .1;
                        // $deducted_checkout_lat = $usersValue->check_out_latitude - .1;
                        // $added_checkout_longi = $usersValue->check_out_longitude + .1;
                        // $deducted_checkout_longi = $usersValue->check_out_longitude - .1;

                        $added_chackout_lat = $usersValue->check_out_latitude + 0.0008;
                        $deducted_checkout_lat = $usersValue->check_out_latitude - 0.0008;
                        $added_checkout_longi = $usersValue->check_out_longitude + 0.0008;
                        $deducted_checkout_longi = $usersValue->check_out_longitude - 0.0008;

                        //if(($added_chackout_lat >= $request->lat && $deducted_checkout_lat <= $request->lat) || ($added_checkout_longi >= $request->longt && $deducted_checkout_longi <= $request->longt)){
                        if (($usersValue->check_out_ip = $local_server_ip)) {

                            $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();


                            foreach ($attendance_employee_id as $attendance_employee_id_value) {

                                // if($attendance_employee_id_value->check_in_out === 1){

                                //     return back()->with('message','Already Checked Out For Today!!! Please Contact With The System Administrator!!!');

                                // }else{

                                $attendance = Attendance::find($attendance_employee_id_value->id);
                                $attendance->clock_out = $current_time;
                                // $attendance->check_out_latitude = $request->lat;
                                // $attendance->check_out_longitude = $request->longt;
                                $attendance->check_out_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                        $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                        if (Auth::user()->over_time_payable == 'Yes' && Auth::user()->user_over_time_type == 'Automatic') {

                                            if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->exists()) {

                                                $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->get('id');

                                                foreach ($over_times as $over_times_value) {

                                                    $over_time = OverTime::find($over_times_value->id);
                                                    $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                    $over_time->save();
                                                }
                                            } else {

                                                $over_time = new OverTime();
                                                $over_time->over_time_com_id = Auth::user()->com_id;
                                                $over_time->over_time_employee_id = Auth::user()->id;
                                                $over_time->over_time_type = "Automatic";
                                                $over_time->over_time_date = $current_date;
                                                $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                                $over_time->save();
                                            }
                                        }
                                    }
                                }
                                if (date_create($current_time) <= date_create($shift_out)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                    }
                                }
                                $attendance->check_in_out = 1;
                                $attendance->save();

                                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                    foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                        $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                        if ($current_date_number == 1) {
                                            $monthly_attendance->day_one = "P";
                                        } elseif ($current_date_number == 2) {
                                            $monthly_attendance->day_two = "P";
                                        } elseif ($current_date_number == 3) {
                                            $monthly_attendance->day_three = "P";
                                        } elseif ($current_date_number == 4) {
                                            $monthly_attendance->day_four = "P";
                                        } elseif ($current_date_number == 5) {
                                            $monthly_attendance->day_five = "P";
                                        } elseif ($current_date_number == 6) {
                                            $monthly_attendance->day_six = "P";
                                        } elseif ($current_date_number == 7) {
                                            $monthly_attendance->day_seven = "P";
                                        } elseif ($current_date_number == 8) {
                                            $monthly_attendance->day_eight = "P";
                                        } elseif ($current_date_number == 9) {
                                            $monthly_attendance->day_nine = "P";
                                        } elseif ($current_date_number == 10) {
                                            $monthly_attendance->day_ten = "P";
                                        } elseif ($current_date_number == 11) {
                                            $monthly_attendance->day_eleven = "P";
                                        } elseif ($current_date_number == 12) {
                                            $monthly_attendance->day_twelve = "P";
                                        } elseif ($current_date_number == 13) {
                                            $monthly_attendance->day_thirteen = "P";
                                        } elseif ($current_date_number == 14) {
                                            $monthly_attendance->day_fourteen = "P";
                                        } elseif ($current_date_number == 15) {
                                            $monthly_attendance->day_fifteen = "P";
                                        } elseif ($current_date_number == 16) {
                                            $monthly_attendance->day_sixteen = "P";
                                        } elseif ($current_date_number == 17) {
                                            $monthly_attendance->day_seventeen = "P";
                                        } elseif ($current_date_number == 18) {
                                            $monthly_attendance->day_eighteen = "P";
                                        } elseif ($current_date_number == 19) {
                                            $monthly_attendance->day_nineteen = "P";
                                        } elseif ($current_date_number == 20) {
                                            $monthly_attendance->day_twenty = "P";
                                        } elseif ($current_date_number == 21) {
                                            $monthly_attendance->day_twenty_one = "P";
                                        } elseif ($current_date_number == 22) {
                                            $monthly_attendance->day_twenty_two = "P";
                                        } elseif ($current_date_number == 23) {
                                            $monthly_attendance->day_twenty_three = "P";
                                        } elseif ($current_date_number == 24) {
                                            $monthly_attendance->day_twenty_four = "P";
                                        } elseif ($current_date_number == 25) {
                                            $monthly_attendance->day_twenty_five = "P";
                                        } elseif ($current_date_number == 26) {
                                            $monthly_attendance->day_twenty_six = "P";
                                        } elseif ($current_date_number == 27) {
                                            $monthly_attendance->day_twenty_seven = "P";
                                        } elseif ($current_date_number == 28) {
                                            $monthly_attendance->day_twenty_eight = "P";
                                        } elseif ($current_date_number == 29) {
                                            $monthly_attendance->day_twenty_nine = "P";
                                        } elseif ($current_date_number == 30) {
                                            $monthly_attendance->day_thirty = "P";
                                        } elseif ($current_date_number == 31) {
                                            $monthly_attendance->day_thirty_one = "P";
                                        } else {
                                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                        }

                                        $monthly_attendance->save();
                                    }
                                } else {

                                    $monthly_attendance = new MonthlyAttendance();
                                    $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                    $monthly_attendance->monthly_employee_id = $request->employee_id;
                                    $monthly_attendance->attendance_month = $current_date;
                                    $monthly_attendance->attendance_year = $current_date;
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }

                                return back()->with('message', 'Attandance Checkout Done Successfully');

                                //}



                            }
                        } else {

                            return back()->with('message', 'Your Checkout Location not Matched!!!!');
                        }
                    }
                }
            } else {

                return back()->with('message', 'Your Browser Or Device Does Not Provide The Ip Address!!!');
            }


            ////////// Attandance checkout code Ends...

        }
    }








    public function userLocationWiseAttendance(Request $request)
    {

        $validated = $request->validate([
            'employee_id' => 'required',

        ]);

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');
        //$current_date = "2021-12-04";
        $current_month = $date->format('m');
        $current_year = $date->format('Y');
        $current_date_number = $date->format('d');
        $current_time = $date->format('H:i:s');
        $local_server_ip = $request->ip();
        $current_day_name = date('D', strtotime($current_date));
        //$current_day_name = date('D', strtotime("2022-01-01"));


        $ip = '103.195.204.115'; // your ip address here
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
        $visitor_latitude = $query['lat'];
        $visitor_longitude = $query['lon'];

        if ($current_day_name == "Sun") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->sunday_in;
                    $shift_out = $office_shifts->sunday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Mon") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->monday_in;
                    $shift_out = $office_shifts->monday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Tue") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->tuesday_in;
                    $shift_out = $office_shifts->tuesday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Wed") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->wednesday_in;
                    $shift_out = $office_shifts->wednesday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Thu") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->thursday_in;
                    $shift_out = $office_shifts->thursday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Fri") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->friday_in;
                    $shift_out = $office_shifts->friday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } elseif ($current_day_name == "Sat") {
            if (OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', Auth::user()->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->saturday_in;
                    $shift_out = $office_shifts->saturday_out;
                }
            } else {
                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }
        } else {
            // $shift_in = 0;
            // $shift_out = 0;
            return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
        }

        // echo json_encode($this->officeShift()); exit;

        ################ Seconds from shift start to end time of the day code starts from here ################################
        $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
        $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
        $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
        ################ Seconds from shift start to end time of the day code ends here #######################################
        $payable_time = strtotime($shift_out) + 60 * 60;
        $payable_over_time_hour = date('H:i', $payable_time);
        ################ Late Time Countable Seconds code starts from here ####################################################
        $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
        $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
        $current_time_in_seconds = strtotime($current_time) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################


        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements

            return back()->with('message', 'You Have Taken A Leave For This Day!!!');
        }

        if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements

            return back()->with('message', 'You are not permitted to give attendance when you are on traveling!!!');
        }


        if ($request->check_in_request) {

            ////////// Attandance check-in code Starts...


            if ($visitor_latitude && $visitor_longitude) {


                $users = User::where('id', $request->employee_id)->get();

                $latitude = $visitor_latitude;
                $longitude = $visitor_longitude;
                $employee_id = $request->employee_id;

                foreach ($users as $usersValue) {

                    //echo $usersValue->attendance_status; exit;

                    if ($usersValue->attendance_status == "" || $usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No') {
                        // if($usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No'){
                        //echo 'ok'; exit;

                        $user = User::find($request->employee_id);
                        $user->attendance_status = "Yes";
                        $user->check_in_ip = $local_server_ip;
                        $user->check_in_latitude = $visitor_latitude;
                        $user->check_in_longitude = $visitor_longitude;
                        $user->save();



                        $attendance = new Attendance();
                        $attendance->attendance_com_id = Auth::user()->com_id;
                        $attendance->employee_id = $request->employee_id;
                        $attendance->attendance_date = $current_date;
                        $attendance->clock_in = $current_time;
                        $attendance->check_in_latitude = $visitor_latitude;
                        $attendance->check_in_longitude = $visitor_longitude;
                        $attendance->check_in_ip = $local_server_ip;
                        if (date_create($current_time) >= date_create($shift_in)) {
                            if ($shift_in != 0 && $shift_out != 0) {

                                $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                    if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {

                                        $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                        foreach ($late_times as $late_times_value) {

                                            $late_time = LateTime::find($late_times_value->id);
                                            $late_time->late_time_com_id = Auth::user()->com_id;
                                            $late_time->late_time_employee_id = $request->employee_id;
                                            $late_time->late_time_date = $current_date;
                                            $late_time->save();
                                        }
                                    } else {
                                        $late_time = new LateTime();
                                        $late_time->late_time_com_id = Auth::user()->com_id;
                                        $late_time->late_time_employee_id = $request->employee_id;
                                        $late_time->late_time_date = $current_date;
                                        $late_time->save();
                                    }
                                }
                            }
                        }

                        //$attendance->check_in_out = 0;
                        $attendance->check_in_out = 1;
                        $attendance->attendance_status = "Present";
                        $attendance->save();

                        ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                        $monthly_attendance = new MonthlyAttendance();
                        $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                        $monthly_attendance->monthly_employee_id = $request->employee_id;
                        $monthly_attendance->attendance_month = $current_date;
                        $monthly_attendance->attendance_year = $current_date;
                        if ($current_date_number == 1) {
                            $monthly_attendance->day_one = "P";
                        } elseif ($current_date_number == 2) {
                            $monthly_attendance->day_two = "P";
                        } elseif ($current_date_number == 3) {
                            $monthly_attendance->day_three = "P";
                        } elseif ($current_date_number == 4) {
                            $monthly_attendance->day_four = "P";
                        } elseif ($current_date_number == 5) {
                            $monthly_attendance->day_five = "P";
                        } elseif ($current_date_number == 6) {
                            $monthly_attendance->day_six = "P";
                        } elseif ($current_date_number == 7) {
                            $monthly_attendance->day_seven = "P";
                        } elseif ($current_date_number == 8) {
                            $monthly_attendance->day_eight = "P";
                        } elseif ($current_date_number == 9) {
                            $monthly_attendance->day_nine = "P";
                        } elseif ($current_date_number == 10) {
                            $monthly_attendance->day_ten = "P";
                        } elseif ($current_date_number == 11) {
                            $monthly_attendance->day_eleven = "P";
                        } elseif ($current_date_number == 12) {
                            $monthly_attendance->day_twelve = "P";
                        } elseif ($current_date_number == 13) {
                            $monthly_attendance->day_thirteen = "P";
                        } elseif ($current_date_number == 14) {
                            $monthly_attendance->day_fourteen = "P";
                        } elseif ($current_date_number == 15) {
                            $monthly_attendance->day_fifteen = "P";
                        } elseif ($current_date_number == 16) {
                            $monthly_attendance->day_sixteen = "P";
                        } elseif ($current_date_number == 17) {
                            $monthly_attendance->day_seventeen = "P";
                        } elseif ($current_date_number == 18) {
                            $monthly_attendance->day_eighteen = "P";
                        } elseif ($current_date_number == 19) {
                            $monthly_attendance->day_nineteen = "P";
                        } elseif ($current_date_number == 20) {
                            $monthly_attendance->day_twenty = "P";
                        } elseif ($current_date_number == 21) {
                            $monthly_attendance->day_twenty_one = "P";
                        } elseif ($current_date_number == 22) {
                            $monthly_attendance->day_twenty_two = "P";
                        } elseif ($current_date_number == 23) {
                            $monthly_attendance->day_twenty_three = "P";
                        } elseif ($current_date_number == 24) {
                            $monthly_attendance->day_twenty_four = "P";
                        } elseif ($current_date_number == 25) {
                            $monthly_attendance->day_twenty_five = "P";
                        } elseif ($current_date_number == 26) {
                            $monthly_attendance->day_twenty_six = "P";
                        } elseif ($current_date_number == 27) {
                            $monthly_attendance->day_twenty_seven = "P";
                        } elseif ($current_date_number == 28) {
                            $monthly_attendance->day_twenty_eight = "P";
                        } elseif ($current_date_number == 29) {
                            $monthly_attendance->day_twenty_nine = "P";
                        } elseif ($current_date_number == 30) {
                            $monthly_attendance->day_thirty = "P";
                        } elseif ($current_date_number == 31) {
                            $monthly_attendance->day_thirty_one = "P";
                        } else {
                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                        }

                        $monthly_attendance->day_one = "P";

                        $monthly_attendance->save();

                        ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################





                        return back()->with('message', 'Attendance Submitted Successfully');
                    } else {

                        $added_chackin_lat = $usersValue->check_in_latitude + 0.0008;
                        $deducted_checkin_lat = $usersValue->check_in_latitude - 0.0008;
                        $added_checkin_longi = $usersValue->check_in_longitude + 0.0008;
                        $deducted_checkin_longi = $usersValue->check_in_longitude - 0.0008;

                        if (($added_chackin_lat >= $visitor_latitude && $deducted_checkin_lat <= $visitor_latitude) || ($added_checkin_longi >= $visitor_longitude && $deducted_checkin_longi <= $visitor_longitude)) {

                            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->exists()) {

                                return back()->with('message', 'Already Checked In For Today!!! Please Contact With The System Administrator!!!');
                            } else {

                                $attendance = new Attendance();
                                $attendance->attendance_com_id = Auth::user()->com_id;
                                $attendance->employee_id = $request->employee_id;
                                $attendance->attendance_date = $current_date;
                                $attendance->clock_in = $current_time;
                                $attendance->check_in_latitude = $visitor_latitude;
                                $attendance->check_in_longitude = $visitor_longitude;
                                $attendance->check_in_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($shift_in)) {
                                    if ($shift_in != 0 && $shift_out != 0) {

                                        $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                        if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                            if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {

                                                $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                                foreach ($late_times as $late_times_value) {

                                                    $late_time = LateTime::find($late_times_value->id);
                                                    $late_time->late_time_com_id = Auth::user()->com_id;
                                                    $late_time->late_time_employee_id = $request->employee_id;
                                                    $late_time->late_time_date = $current_date;
                                                    $late_time->save();
                                                }
                                            } else {
                                                $late_time = new LateTime();
                                                $late_time->late_time_com_id = Auth::user()->com_id;
                                                $late_time->late_time_employee_id = $request->employee_id;
                                                $late_time->late_time_date = $current_date;
                                                $late_time->save();
                                            }
                                        }
                                    }
                                }
                                //$attendance->check_in_out = 0;
                                $attendance->check_in_out = 1;
                                $attendance->attendance_status = "Present";
                                $attendance->save();

                                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                    foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                        $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                        if ($current_date_number == 1) {
                                            $monthly_attendance->day_one = "P";
                                        } elseif ($current_date_number == 2) {
                                            $monthly_attendance->day_two = "P";
                                        } elseif ($current_date_number == 3) {
                                            $monthly_attendance->day_three = "P";
                                        } elseif ($current_date_number == 4) {
                                            $monthly_attendance->day_four = "P";
                                        } elseif ($current_date_number == 5) {
                                            $monthly_attendance->day_five = "P";
                                        } elseif ($current_date_number == 6) {
                                            $monthly_attendance->day_six = "P";
                                        } elseif ($current_date_number == 7) {
                                            $monthly_attendance->day_seven = "P";
                                        } elseif ($current_date_number == 8) {
                                            $monthly_attendance->day_eight = "P";
                                        } elseif ($current_date_number == 9) {
                                            $monthly_attendance->day_nine = "P";
                                        } elseif ($current_date_number == 10) {
                                            $monthly_attendance->day_ten = "P";
                                        } elseif ($current_date_number == 11) {
                                            $monthly_attendance->day_eleven = "P";
                                        } elseif ($current_date_number == 12) {
                                            $monthly_attendance->day_twelve = "P";
                                        } elseif ($current_date_number == 13) {
                                            $monthly_attendance->day_thirteen = "P";
                                        } elseif ($current_date_number == 14) {
                                            $monthly_attendance->day_fourteen = "P";
                                        } elseif ($current_date_number == 15) {
                                            $monthly_attendance->day_fifteen = "P";
                                        } elseif ($current_date_number == 16) {
                                            $monthly_attendance->day_sixteen = "P";
                                        } elseif ($current_date_number == 17) {
                                            $monthly_attendance->day_seventeen = "P";
                                        } elseif ($current_date_number == 18) {
                                            $monthly_attendance->day_eighteen = "P";
                                        } elseif ($current_date_number == 19) {
                                            $monthly_attendance->day_nineteen = "P";
                                        } elseif ($current_date_number == 20) {
                                            $monthly_attendance->day_twenty = "P";
                                        } elseif ($current_date_number == 21) {
                                            $monthly_attendance->day_twenty_one = "P";
                                        } elseif ($current_date_number == 22) {
                                            $monthly_attendance->day_twenty_two = "P";
                                        } elseif ($current_date_number == 23) {
                                            $monthly_attendance->day_twenty_three = "P";
                                        } elseif ($current_date_number == 24) {
                                            $monthly_attendance->day_twenty_four = "P";
                                        } elseif ($current_date_number == 25) {
                                            $monthly_attendance->day_twenty_five = "P";
                                        } elseif ($current_date_number == 26) {
                                            $monthly_attendance->day_twenty_six = "P";
                                        } elseif ($current_date_number == 27) {
                                            $monthly_attendance->day_twenty_seven = "P";
                                        } elseif ($current_date_number == 28) {
                                            $monthly_attendance->day_twenty_eight = "P";
                                        } elseif ($current_date_number == 29) {
                                            $monthly_attendance->day_twenty_nine = "P";
                                        } elseif ($current_date_number == 30) {
                                            $monthly_attendance->day_thirty = "P";
                                        } elseif ($current_date_number == 31) {
                                            $monthly_attendance->day_thirty_one = "P";
                                        } else {
                                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                        }

                                        $monthly_attendance->save();
                                    }
                                } else {

                                    $monthly_attendance = new MonthlyAttendance();
                                    $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                    $monthly_attendance->monthly_employee_id = $request->employee_id;
                                    $monthly_attendance->attendance_month = $current_date;
                                    $monthly_attendance->attendance_year = $current_date;
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }

                                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                                return back()->with('message', 'Attendance Submitted Successfully');
                            }
                        } else {

                            return back()->with('message', 'Your Checkin Location not Matched!!!!');
                        }
                    }
                }
            } else {

                return back()->with('message', 'Your Browser Or Device not Supported Geolocaton');
            }
            ////////// Attandance check-in code Ends...

        } else {

            ////////// Attandance checkout code Starts...

            if ($visitor_latitude && $visitor_longitude) {

                $users = User::where('id', $request->employee_id)->get();

                $latitude = $visitor_latitude;
                $longitude = $visitor_longitude;
                $employee_id = $request->employee_id;

                foreach ($users as $usersValue) {

                    if ($usersValue->check_out_latitude == '' || $usersValue->check_out_longitude == '' || $usersValue->check_out_latitude == NULL || $usersValue->check_out_longitude == NULL || $usersValue->check_out_latitude === 'No' || $usersValue->check_out_longitude === 'No') {

                        $user = User::find($request->employee_id);
                        $user->check_out_ip = $local_server_ip;
                        $user->check_out_latitude = $visitor_latitude;
                        $user->check_out_longitude = $visitor_longitude;
                        $user->save();

                        $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();

                        foreach ($attendance_employee_id as $attendance_employee_id_value) {

                            $attendance = Attendance::find($attendance_employee_id_value->id);
                            $attendance->clock_out = $current_time;
                            $attendance->check_out_latitude = $visitor_latitude;
                            $attendance->check_out_longitude = $visitor_longitude;
                            $attendance->check_out_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                    $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                    if (Auth::user()->over_time_payable == 'Yes' && Auth::user()->user_over_time_type == 'Automatic') {

                                        if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->exists()) {

                                            $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->get('id');

                                            foreach ($over_times as $over_times_value) {

                                                $over_time = OverTime::find($over_times_value->id);
                                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                $over_time->save();
                                            }
                                        } else {

                                            $over_time = new OverTime();
                                            $over_time->over_time_com_id = Auth::user()->com_id;
                                            $over_time->over_time_employee_id = Auth::user()->id;
                                            $over_time->over_time_type = "Automatic";
                                            $over_time->over_time_date = $current_date;
                                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                            $over_time->save();
                                        }
                                    }
                                }
                            }
                            if (date_create($current_time) <= date_create($shift_out)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                }
                            }
                            $attendance->check_in_out = 1;
                            $attendance->save();

                            ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                            if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                    $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }
                            } else {

                                $monthly_attendance = new MonthlyAttendance();
                                $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                $monthly_attendance->monthly_employee_id = $request->employee_id;
                                $monthly_attendance->attendance_month = $current_date;
                                $monthly_attendance->attendance_year = $current_date;
                                if ($current_date_number == 1) {
                                    $monthly_attendance->day_one = "P";
                                } elseif ($current_date_number == 2) {
                                    $monthly_attendance->day_two = "P";
                                } elseif ($current_date_number == 3) {
                                    $monthly_attendance->day_three = "P";
                                } elseif ($current_date_number == 4) {
                                    $monthly_attendance->day_four = "P";
                                } elseif ($current_date_number == 5) {
                                    $monthly_attendance->day_five = "P";
                                } elseif ($current_date_number == 6) {
                                    $monthly_attendance->day_six = "P";
                                } elseif ($current_date_number == 7) {
                                    $monthly_attendance->day_seven = "P";
                                } elseif ($current_date_number == 8) {
                                    $monthly_attendance->day_eight = "P";
                                } elseif ($current_date_number == 9) {
                                    $monthly_attendance->day_nine = "P";
                                } elseif ($current_date_number == 10) {
                                    $monthly_attendance->day_ten = "P";
                                } elseif ($current_date_number == 11) {
                                    $monthly_attendance->day_eleven = "P";
                                } elseif ($current_date_number == 12) {
                                    $monthly_attendance->day_twelve = "P";
                                } elseif ($current_date_number == 13) {
                                    $monthly_attendance->day_thirteen = "P";
                                } elseif ($current_date_number == 14) {
                                    $monthly_attendance->day_fourteen = "P";
                                } elseif ($current_date_number == 15) {
                                    $monthly_attendance->day_fifteen = "P";
                                } elseif ($current_date_number == 16) {
                                    $monthly_attendance->day_sixteen = "P";
                                } elseif ($current_date_number == 17) {
                                    $monthly_attendance->day_seventeen = "P";
                                } elseif ($current_date_number == 18) {
                                    $monthly_attendance->day_eighteen = "P";
                                } elseif ($current_date_number == 19) {
                                    $monthly_attendance->day_nineteen = "P";
                                } elseif ($current_date_number == 20) {
                                    $monthly_attendance->day_twenty = "P";
                                } elseif ($current_date_number == 21) {
                                    $monthly_attendance->day_twenty_one = "P";
                                } elseif ($current_date_number == 22) {
                                    $monthly_attendance->day_twenty_two = "P";
                                } elseif ($current_date_number == 23) {
                                    $monthly_attendance->day_twenty_three = "P";
                                } elseif ($current_date_number == 24) {
                                    $monthly_attendance->day_twenty_four = "P";
                                } elseif ($current_date_number == 25) {
                                    $monthly_attendance->day_twenty_five = "P";
                                } elseif ($current_date_number == 26) {
                                    $monthly_attendance->day_twenty_six = "P";
                                } elseif ($current_date_number == 27) {
                                    $monthly_attendance->day_twenty_seven = "P";
                                } elseif ($current_date_number == 28) {
                                    $monthly_attendance->day_twenty_eight = "P";
                                } elseif ($current_date_number == 29) {
                                    $monthly_attendance->day_twenty_nine = "P";
                                } elseif ($current_date_number == 30) {
                                    $monthly_attendance->day_thirty = "P";
                                } elseif ($current_date_number == 31) {
                                    $monthly_attendance->day_thirty_one = "P";
                                } else {
                                    return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                }

                                $monthly_attendance->save();
                            }

                            ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                            return back()->with('message', 'Attendance Checkout Done Successfully');
                        }
                    } else {

                        $added_chackout_lat = $usersValue->check_out_latitude + 0.0008;
                        $deducted_checkout_lat = $usersValue->check_out_latitude - 0.0008;
                        $added_checkout_longi = $usersValue->check_out_longitude + 0.0008;
                        $deducted_checkout_longi = $usersValue->check_out_longitude - 0.0008;

                        if (($added_chackout_lat >= $visitor_latitude && $deducted_checkout_lat <= $visitor_latitude) || ($added_checkout_longi >= $visitor_longitude && $deducted_checkout_longi <= $visitor_longitude)) {
                            $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();
                            foreach ($attendance_employee_id as $attendance_employee_id_value) {
                                // if($attendance_employee_id_value->check_in_out === 1){
                                //     return back()->with('message','Already Checked Out For Today!!! Please Contact With The System Administrator!!!');
                                // }else{
                                $attendance = Attendance::find($attendance_employee_id_value->id);
                                $attendance->clock_out = $current_time;
                                $attendance->check_out_latitude = $visitor_latitude;
                                $attendance->check_out_longitude = $visitor_longitude;
                                $attendance->check_out_ip = $local_server_ip;
                                if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                        $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                        if (Auth::user()->over_time_payable == 'Yes' && Auth::user()->user_over_time_type == 'Automatic') {

                                            if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->exists()) {

                                                $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $current_date)->get('id');

                                                foreach ($over_times as $over_times_value) {

                                                    $over_time = OverTime::find($over_times_value->id);
                                                    $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                    $over_time->save();
                                                }
                                            } else {

                                                $over_time = new OverTime();
                                                $over_time->over_time_com_id = Auth::user()->com_id;
                                                $over_time->over_time_employee_id = Auth::user()->id;
                                                $over_time->over_time_type = "Automatic";
                                                $over_time->over_time_date = $current_date;
                                                $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                                $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                                                $over_time->save();
                                            }
                                        }
                                    }
                                }
                                if (date_create($current_time) <= date_create($shift_out)) {
                                    if ($shift_in != 0 && $shift_out != 0) {
                                        $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                    }
                                }
                                $attendance->check_in_out = 1;
                                $attendance->save();

                                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

                                    foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                                        $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);
                                        if ($current_date_number == 1) {
                                            $monthly_attendance->day_one = "P";
                                        } elseif ($current_date_number == 2) {
                                            $monthly_attendance->day_two = "P";
                                        } elseif ($current_date_number == 3) {
                                            $monthly_attendance->day_three = "P";
                                        } elseif ($current_date_number == 4) {
                                            $monthly_attendance->day_four = "P";
                                        } elseif ($current_date_number == 5) {
                                            $monthly_attendance->day_five = "P";
                                        } elseif ($current_date_number == 6) {
                                            $monthly_attendance->day_six = "P";
                                        } elseif ($current_date_number == 7) {
                                            $monthly_attendance->day_seven = "P";
                                        } elseif ($current_date_number == 8) {
                                            $monthly_attendance->day_eight = "P";
                                        } elseif ($current_date_number == 9) {
                                            $monthly_attendance->day_nine = "P";
                                        } elseif ($current_date_number == 10) {
                                            $monthly_attendance->day_ten = "P";
                                        } elseif ($current_date_number == 11) {
                                            $monthly_attendance->day_eleven = "P";
                                        } elseif ($current_date_number == 12) {
                                            $monthly_attendance->day_twelve = "P";
                                        } elseif ($current_date_number == 13) {
                                            $monthly_attendance->day_thirteen = "P";
                                        } elseif ($current_date_number == 14) {
                                            $monthly_attendance->day_fourteen = "P";
                                        } elseif ($current_date_number == 15) {
                                            $monthly_attendance->day_fifteen = "P";
                                        } elseif ($current_date_number == 16) {
                                            $monthly_attendance->day_sixteen = "P";
                                        } elseif ($current_date_number == 17) {
                                            $monthly_attendance->day_seventeen = "P";
                                        } elseif ($current_date_number == 18) {
                                            $monthly_attendance->day_eighteen = "P";
                                        } elseif ($current_date_number == 19) {
                                            $monthly_attendance->day_nineteen = "P";
                                        } elseif ($current_date_number == 20) {
                                            $monthly_attendance->day_twenty = "P";
                                        } elseif ($current_date_number == 21) {
                                            $monthly_attendance->day_twenty_one = "P";
                                        } elseif ($current_date_number == 22) {
                                            $monthly_attendance->day_twenty_two = "P";
                                        } elseif ($current_date_number == 23) {
                                            $monthly_attendance->day_twenty_three = "P";
                                        } elseif ($current_date_number == 24) {
                                            $monthly_attendance->day_twenty_four = "P";
                                        } elseif ($current_date_number == 25) {
                                            $monthly_attendance->day_twenty_five = "P";
                                        } elseif ($current_date_number == 26) {
                                            $monthly_attendance->day_twenty_six = "P";
                                        } elseif ($current_date_number == 27) {
                                            $monthly_attendance->day_twenty_seven = "P";
                                        } elseif ($current_date_number == 28) {
                                            $monthly_attendance->day_twenty_eight = "P";
                                        } elseif ($current_date_number == 29) {
                                            $monthly_attendance->day_twenty_nine = "P";
                                        } elseif ($current_date_number == 30) {
                                            $monthly_attendance->day_thirty = "P";
                                        } elseif ($current_date_number == 31) {
                                            $monthly_attendance->day_thirty_one = "P";
                                        } else {
                                            return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                        }
                                        $monthly_attendance->save();
                                    }
                                } else {

                                    $monthly_attendance = new MonthlyAttendance();
                                    $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                                    $monthly_attendance->monthly_employee_id = $request->employee_id;
                                    $monthly_attendance->attendance_month = $current_date;
                                    $monthly_attendance->attendance_year = $current_date;
                                    if ($current_date_number == 1) {
                                        $monthly_attendance->day_one = "P";
                                    } elseif ($current_date_number == 2) {
                                        $monthly_attendance->day_two = "P";
                                    } elseif ($current_date_number == 3) {
                                        $monthly_attendance->day_three = "P";
                                    } elseif ($current_date_number == 4) {
                                        $monthly_attendance->day_four = "P";
                                    } elseif ($current_date_number == 5) {
                                        $monthly_attendance->day_five = "P";
                                    } elseif ($current_date_number == 6) {
                                        $monthly_attendance->day_six = "P";
                                    } elseif ($current_date_number == 7) {
                                        $monthly_attendance->day_seven = "P";
                                    } elseif ($current_date_number == 8) {
                                        $monthly_attendance->day_eight = "P";
                                    } elseif ($current_date_number == 9) {
                                        $monthly_attendance->day_nine = "P";
                                    } elseif ($current_date_number == 10) {
                                        $monthly_attendance->day_ten = "P";
                                    } elseif ($current_date_number == 11) {
                                        $monthly_attendance->day_eleven = "P";
                                    } elseif ($current_date_number == 12) {
                                        $monthly_attendance->day_twelve = "P";
                                    } elseif ($current_date_number == 13) {
                                        $monthly_attendance->day_thirteen = "P";
                                    } elseif ($current_date_number == 14) {
                                        $monthly_attendance->day_fourteen = "P";
                                    } elseif ($current_date_number == 15) {
                                        $monthly_attendance->day_fifteen = "P";
                                    } elseif ($current_date_number == 16) {
                                        $monthly_attendance->day_sixteen = "P";
                                    } elseif ($current_date_number == 17) {
                                        $monthly_attendance->day_seventeen = "P";
                                    } elseif ($current_date_number == 18) {
                                        $monthly_attendance->day_eighteen = "P";
                                    } elseif ($current_date_number == 19) {
                                        $monthly_attendance->day_nineteen = "P";
                                    } elseif ($current_date_number == 20) {
                                        $monthly_attendance->day_twenty = "P";
                                    } elseif ($current_date_number == 21) {
                                        $monthly_attendance->day_twenty_one = "P";
                                    } elseif ($current_date_number == 22) {
                                        $monthly_attendance->day_twenty_two = "P";
                                    } elseif ($current_date_number == 23) {
                                        $monthly_attendance->day_twenty_three = "P";
                                    } elseif ($current_date_number == 24) {
                                        $monthly_attendance->day_twenty_four = "P";
                                    } elseif ($current_date_number == 25) {
                                        $monthly_attendance->day_twenty_five = "P";
                                    } elseif ($current_date_number == 26) {
                                        $monthly_attendance->day_twenty_six = "P";
                                    } elseif ($current_date_number == 27) {
                                        $monthly_attendance->day_twenty_seven = "P";
                                    } elseif ($current_date_number == 28) {
                                        $monthly_attendance->day_twenty_eight = "P";
                                    } elseif ($current_date_number == 29) {
                                        $monthly_attendance->day_twenty_nine = "P";
                                    } elseif ($current_date_number == 30) {
                                        $monthly_attendance->day_thirty = "P";
                                    } elseif ($current_date_number == 31) {
                                        $monthly_attendance->day_thirty_one = "P";
                                    } else {
                                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    }

                                    $monthly_attendance->save();
                                }

                                return back()->with('message', 'Attandance Checkout Done Successfully');
                            }
                        } else {

                            return back()->with('message', 'Your Checkout Location not Matched!!!!');
                        }
                    }
                }
            } else {

                return back()->with('message', 'Your Browser Or Device not Supported Geolocaton');
            }

            ////////// Attandance checkout code Ends...

        }
    }
}
