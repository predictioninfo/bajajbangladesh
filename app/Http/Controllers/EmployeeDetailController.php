<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\OfficeShift;
use App\Models\OverTime;
use App\Models\Attendance;
use App\Models\MonthlyAttendance;
use App\Models\Holiday;
use App\Models\Region;
use App\Models\Role;
use App\Models\AttendanceLocation;
use App\Models\LatetimeConfig;
use App\Models\LateTime;
use App\Models\Permission;
use App\Models\Area;
use App\Models\DbHouse;
use App\Models\Territory;
use App\Models\Town;
use App\Models\EmployeeDetail;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use App\Http\Traits\DayWiseOfficeShift;
use Auth;
use DB;
use Image;
use DateTime;
use Excel;
use PDF;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

class EmployeeDetailController extends Controller
{
    public function addBanglaDeatil($id)
    {
        // echo $id; exit;
        $employee_name = User::where('id', '=', $id)->first(['first_name']);
        $user = User::where('id', '=', $id)->get();
        if (EmployeeDetail::where('empdetails_employee_id', '=', $id)->exists()) {
            $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $id)->get();
            $employee_id = $id;
            $divisions = Division::get();
            $districts = District::get();
            $unions = Union::get();
            $upzillas = Upazila::get();
            $add = 0;
            return view('back-end.premium.employees.employee-bangla-details-index',get_defined_vars());
        } else {
            $employee_details = [];
            $divisions = Division::get();
            $districts = District::get();
            $unions = Union::get();
            $upzillas = Upazila::get();
            $add = 1;
            $employee_id = $id;
            return view('back-end.premium.employees.employee-bangla-details-index',get_defined_vars());
        }
    }
    public function banglaDeatils(Request $request)
    {

        $validated = $request->validate([
            //'empdetails_employee_id' => 'required',
            'bangla_name' => 'required',
            //'postal_area_bn' => 'required',
            //'village_bn' => 'required',
            // 'father_name' => 'required',
            // 'mother_name' => 'required',
            // 'permenet_address_english' => 'required',
            // 'permenet_address_bangla' => 'required',
            // 'experience_month' => 'required',
            // 'previous_organization' => 'required',
            // 'district' => 'required',
            // 'identification_type' => 'required',
            // 'identification_number' => 'required',
            // //'salary_after_probation' => 'required',
            // 'religion' => 'required',
            // 'blood_group' => 'required',
            // 'marital_status' => 'required',

        ]);

        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->empdetails_employee_id)->exists()) {
            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->empdetails_employee_id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->empdetails_employee_id;
                $user->bangla_name = $request->bangla_name;
                $user->father_name = $request->father_name;
                $user->mother_name = $request->mother_name;
                $user->postal_area_bn = $request->postal_area_bn;
                $user->postal_area_en = $request->postal_area_en;
                $user->village_bn = $request->village_bn;
                $user->village_en = $request->village_en;
                $user->experience_month = $request->experience_month;
                $user->previous_organization = $request->previous_organization;
                if ($request->division_id) {
                    $user->division_id = $request->division_id;
                }
                if ($request->district_id) {
                    $user->district_id = $request->district_id;
                }
                if ($request->upazila_id) {
                    $user->upazila_id = $request->upazila_id;
                }
                if ($request->union_id) {
                    $user->union_id = $request->union_id;
                }


                $user->identification_type = $request->identification_type;
                $user->identification_number = $request->identification_number;
                $user->religion = $request->religion;
                $user->blood_group = $request->blood_group;
                $user->marital_status = $request->marital_status;
                $user->save();
                $user_update = User::find($request->empdetails_employee_id);
                if ($request->division_id) {
                    $user_update->division_id = $request->division_id;
                }
                if ($request->district_id) {
                    $user_update->district_id = $request->district_id;
                }
                if ($request->upazila_id) {
                    $user_update->upazila_id = $request->upazila_id;
                }
                if ($request->union_id) {
                    $user_update->union_id = $request->union_id;
                }
                $user_update->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->empdetails_employee_id;
                $user->bangla_name = $request->bangla_name;
                $user->father_name = $request->father_name;
                $user->mother_name = $request->mother_name;
                $user->postal_area_bn = $request->postal_area_bn;
                $user->postal_area_en = $request->postal_area_en;
                $user->village_bn = $request->village_bn;
                $user->village_en = $request->village_en;
                $user->experience_month = $request->experience_month;
                $user->previous_organization = $request->previous_organization;
                $user->identification_type = $request->identification_type;
                $user->identification_number = $request->identification_number;
                if ($request->division_id) {
                    $user->division_id = $request->division_id;
                }
                if ($request->district_id) {
                    $user->district_id = $request->district_id;
                }
                if ($request->upazila_id) {
                    $user->upazila_id = $request->upazila_id;
                }
                if ($request->union_id) {
                    $user->union_id = $request->union_id;
                }
                $user->religion = $request->religion;
                $user->blood_group = $request->blood_group;
                $user->marital_status = $request->marital_status;
                $user->save();
                $user_update = User::find($request->empdetails_employee_id);
                if ($request->division_id) {
                    $user_update->division_id = $request->division_id;
                }
                if ($request->district_id) {
                    $user_update->district_id = $request->district_id;
                }
                if ($request->upazila_id) {
                    $user_update->upazila_id = $request->upazila_id;
                }
                if ($request->union_id) {
                    $user_update->union_id = $request->union_id;
                }
                $user_update->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Added Successfully');
        }
    }
}

