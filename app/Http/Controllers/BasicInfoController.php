<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Region;
use App\Models\Role;
use App\Models\BankAccount;
use App\Models\EmployeeDetail;
use App\Models\GradeSetup;
use App\Models\NocEmployee;
use App\Models\Notification;
use App\Models\ProvidentfundBankaccount;
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use Mail;
use PDF;
use Carbon\Carbon;

class BasicInfoController extends Controller
{

    public function updateEmployeeBasicInfo(Request $request)
    {
        $validated = $request->validate([
            'company_assigned_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' =>  ['required', 'email', 'max:255'],
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
        ]);
        if (User::where('com_id', Auth::user()->com_id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {

            if (User::where('id', $request->id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {
                //skip
            } else {
                return back()->with('message', 'Company Assigned ID Already Exists');
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
        try {
            $employee_basic_info = User::find($request->id);

            $employee_basic_info->company_assigned_id = $request->company_assigned_id;
            $employee_basic_info->first_name = $request->first_name;
            $employee_basic_info->last_name = $request->last_name;
            $employee_basic_info->username = $request->username;
            $employee_basic_info->email = $request->email;
            $employee_basic_info->phone = $request->phone;
            $employee_basic_info->b_phone = $request->b_phone;
            $employee_basic_info->date_of_birth = $request->date_of_birth;
            $employee_basic_info->gender = $request->gender;
            $employee_basic_info->blood_group = $request->blood_group;
            $employee_basic_info->replace_employee_id = $request->replace_employee_id;
            $employee_basic_info->appointment_letter_format_id = $request->appointment_letter_format_id;


            if ($request->file('profile_photo')) {

                $image = $request->file('profile_photo');
                $input['imagename'] = time() . '.' . $image->extension();

                $filePath = 'uploads/profile_photos';

                $img = Image::make($image->path());
                $img->resize(110, 110, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $input['imagename']);

                $imageUrl = $filePath . '/' . $input['imagename'];

                $employee_basic_info->profile_photo = $imageUrl;

                $filePath = 'uploads/profile_photos/before_resized/';
            }
            $employee_basic_info->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        // return back()->with('message', 'Updated Successfully');

        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {

            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;

                $user->identification_type = $request->identification_type;
                $user->identification_number = $request->identification_number;
                $user->religion = $request->religion;
                $user->blood_group = $request->blood_group;
                $user->marital_status = $request->marital_status;
                $user->birth_place = $request->birth_place;
                $user->nationality_id = $request->nationality_id;

                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Basic Information Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                $user->identification_type = $request->identification_type;
                $user->identification_number = $request->identification_number;
                $user->religion = $request->religion;
                $user->blood_group = $request->blood_group;
                $user->marital_status = $request->marital_status;
                $user->birth_place = $request->birth_place;
                $user->nationality_id = $request->nationality_id;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Basic Information Update Successfully');
        }
    }

    public function updateEmployeePresentAddress(Request $request)
    {

        $validated = $request->validate([
            // 'present_division_id' => 'required',
            // 'present_district_id' => 'required',
            // 'present_upazila_id' => 'required',
            // 'present_upazila_id' => 'required',
            // 'present_union_id' => 'required',
            // 'present_ward_no' => 'required',
            // 'present_village' => 'required',
            // 'present_postal_area' => 'required',
            // 'present_postal_code' => 'required',
        ]);

        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {
            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;


                // Present Address
                if ($request->present_division_id) {
                    $user->present_division_id = $request->present_division_id;
                }
                if ($request->present_district_id) {
                    $user->present_district_id = $request->present_district_id;
                }
                $user->present_city_corporation = $request->present_city_corporation;
                if ($request->present_upazila_id) {
                    $user->present_upazila_id = $request->present_upazila_id;
                }
                if ($request->present_union_id) {
                    $user->present_union_id = $request->present_union_id;
                }
                $user->present_ward_no = $request->present_ward_no;
                $user->present_village = $request->present_village;
                $user->present_postal_area = $request->present_postal_area;

                $user->present_sadar = $request->present_sadar;
                $user->present_pourosova = $request->present_pourosova;
                $user->present_postal_code = $request->present_postal_code;

                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Present address Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;

                // Present Address
                if ($request->present_division_id) {
                    $user->present_division_id = $request->present_division_id;
                }
                if ($request->present_district_id) {
                    $user->present_district_id = $request->present_district_id;
                }
                $user->present_city_corporation = $request->present_city_corporation;
                if ($request->present_upazila_id) {
                    $user->present_upazila_id = $request->present_upazila_id;
                }
                if ($request->present_union_id) {
                    $user->present_union_id = $request->present_union_id;
                }
                $user->present_ward_no = $request->present_ward_no;
                $user->present_village = $request->present_village;
                $user->present_postal_area = $request->present_postal_area;

                $user->present_sadar = $request->present_sadar;
                $user->present_pourosova = $request->present_pourosova;
                $user->present_postal_code = $request->present_postal_code;

                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Present address Update Successfully');
        }
    }
    public function updateEmployeePermanentAddress(Request $request)
    {
        $validated = $request->validate([
            // 'division_id' => 'required',
            // 'district_id' => 'required',
            // 'upazila_id' => 'required',
            // 'union_id' => 'required',
            // 'ward_no' => 'required',
            // 'village' => 'required',
            // 'postal_area' => 'required',
            // 'postal_code' => 'required',
        ]);
        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {
            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;


                // Permanent Address
                if ($request->division_id) {
                    $user->division_id = $request->division_id;
                }
                if ($request->district_id) {
                    $user->district_id = $request->district_id;
                }
                $user->city_corporation = $request->city_corporation;
                if ($request->upazila_id) {
                    $user->upazila_id = $request->upazila_id;
                }
                if ($request->union_id) {
                    $user->union_id = $request->union_id;
                }
                $user->ward_number = $request->ward_no;
                $user->village_en = $request->village;
                $user->postal_area_en = $request->postal_area;

                $user->sadar = $request->sadar;
                $user->poursova = $request->poursova;
                $user->postal_code = $request->postal_code;

                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Permanent Address Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;

                // Permanent Address
                if ($request->division_id) {
                    $user->division_id = $request->division_id;
                }
                if ($request->district_id) {
                    $user->district_id = $request->district_id;
                }
                $user->city_corporation = $request->city_corporation;
                if ($request->upazila_id) {
                    $user->upazila_id = $request->upazila_id;
                }
                if ($request->union_id) {
                    $user->union_id = $request->union_id;
                }
                $user->ward_number = $request->ward_no;
                $user->village_en = $request->village;
                $user->postal_area_en = $request->postal_area;

                $user->sadar = $request->sadar;
                $user->poursova = $request->poursova;
                $user->postal_code = $request->postal_code;

                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Permanent Address Update Successfully');
        }
    }

    public function updateEmployeeJobLocation(Request $request)
    {
        try {
            $employee_basic_info = User::find($request->id);

            $employee_basic_info->region_id = $request->region_id;
            $employee_basic_info->area_id = $request->area_id;
            $employee_basic_info->territory_id = $request->territory_id;
            $employee_basic_info->town_id = $request->town_id;
            $employee_basic_info->db_house_id = $request->db_house_id;
            $employee_basic_info->location_six_id = $request->location_six_id;
            $employee_basic_info->location_seven_id = $request->location_seven_id;
            $employee_basic_info->location_eight_id = $request->location_eight_id;
            $employee_basic_info->location_nine_id = $request->location_nine_id;
            $employee_basic_info->location_ten_id = $request->location_ten_id;
            $employee_basic_info->location_eleven_id = $request->location_eleven_id;
            // return $employee_basic_info;
            $employee_basic_info->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Employee Job Location Updated Successfully');
    }
    public function updateEmployeeCompanyInfo(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'nullable',
            'office_shift_id' => 'required',
            'role_users_id' => 'required',
            'user_over_time_type' => 'required',
            'role_users_id' => 'required',
            'attendance_type' => 'required',
            'joining_date' => 'required',
        ]);
        try {
            $date = Carbon::parse($request->joining_date);
            $monthsToAdd = $request->in_probation_month;
            $newDate = $date->addMonths($monthsToAdd);
            $probationExpiryDate = $newDate->format('Y-m-d');

            $employee_basic_info = User::find($request->id);
            $employee_basic_info->com_id = $request->company_id;

            $employee_basic_info->username = $request->username;

            $employee_basic_info->department_id = $request->department_id;
            $employee_basic_info->designation_id = $request->designation_id;
            $employee_basic_info->office_shift_id = $request->office_shift_id;
            $employee_basic_info->expiry_date = $request->expiry_date;

            $employee_basic_info->in_trine_month = $request->in_trine_month_contractual;
            $employee_basic_info->in_trine_month = $request->in_trine_month_trainee;
            $employee_basic_info->in_trine_month = $request->in_trine_month_intern;
            $employee_basic_info->in_trine_month = $request->in_trine_month_change_1;
            $employee_basic_info->in_trine_month = $request->in_trine_month_change_2;
            $employee_basic_info->probation_expiry_date = $probationExpiryDate;
            if ($request->in_probation_month) {
                $employee_basic_info->in_probation_month = $request->in_probation_month;
            } else {
                $employee_basic_info->in_probation_month = $request->in_probation_month_1;
            }

            $employee_basic_info->appointment_letter = $request->appointment_letter;
            $employee_basic_info->employment_type = $request->employment_type;
            $employee_basic_info->salary_type = $request->salary_type;

            $employee_basic_info->role_id = $request->role_users_id;
         
            $employee_basic_info->attendance_type = $request->attendance_type;
           
            $employee_basic_info->joining_date = $request->joining_date;
            $employee_basic_info->grade_id = $request->grade;
            $employee_basic_info->user_over_time_type = $request->user_over_time_type;
            if ($request->over_time_payable) {
                $employee_basic_info->over_time_payable = $request->over_time_payable;
                $employee_basic_info->user_over_time_rate = $request->user_over_time_rate;
            }
            $employee_basic_info->is_active = $request->is_active ?? 0;
            $employee_basic_info->multi_attendance = $request->multi_attendance ?? 0;
            $employee_basic_info->user_admin_status = $request->admin_status ?? 0;
            $employee_basic_info->save();

            $grade = GradeSetup::where('emp_id', $request->id)->first();
            if ($grade) {
                $grade_setup = GradeSetup::find($grade->id);
                $grade_setup->grade_setup_com_id = $request->company_id;
                $grade_setup->grade_id = $request->grade;
                $grade_setup->dept_id = $request->department_id;
                $grade_setup->desg_id = $request->designation_id;
                $grade_setup->emp_id = $request->id;
                $grade_setup->save();
            } else {
                $grade_setup = new GradeSetup();
                $grade_setup->grade_setup_com_id = $request->company_id;
                $grade_setup->grade_id = $request->grade;
                $grade_setup->dept_id = $request->department_id;
                $grade_setup->desg_id = $request->designation_id;
                $grade_setup->emp_id = $request->id;
                $grade_setup->save();
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Company Information Updated Successfully');
    }
    public function updateEmployeePreviousCompanyInfo(Request $request)
    {
        $validated = $request->validate([
            'previous_organization_name' => 'required',
            'last_salary' => 'required',
            'experience_month' => 'required',
        ]);
        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {
            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                // Parental Information(English)
                $user->previous_organization = $request->previous_organization_name;
                $user->last_salary = $request->last_salary;
                $user->experience_month = $request->experience_month;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Parental Information Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                // Parental Information(English)
                $user->previous_organization = $request->previous_organization_name;
                $user->last_salary = $request->last_salary;
                $user->experience_month = $request->experience_month;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Parental Information Update Successfully');
        }
    }
    public function updateEmployeeParentalInfo(Request $request)
    {
        $validated = $request->validate([
            'father_name' => 'required',
            'mother_name' => 'required',
            // 'ward_no' => 'required',
            // 'present_ward_no' => 'required',
            // 'village' => 'required',
            // 'postal_area' => 'required',
            // 'postal_code' => 'required',
        ]);
        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {
            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                // Parental Information(English)
                $user->father_name = $request->father_name;
                $user->father_phone = $request->father_phone;
                $user->mother_name = $request->mother_name;
                $user->mother_phone = $request->mother_phone;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Parental Information Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                // Parental Information(English)
                $user->father_name = $request->father_name;
                $user->father_phone = $request->father_phone;
                $user->mother_name = $request->mother_name;
                $user->mother_phone = $request->mother_phone;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Parental Information Update Successfully');
        }
    }
    public function updateEmployeeBasicInfoBangla(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'bangla_name' => 'required',
            'father_name_bn' => 'required',
            'mother_name_bn' => 'required',

            // 'present_postal_area_bn' => 'required',
            // 'present_postal_code_bn' => 'required',
            // 'present_ward_no_bn' => 'required',
            // 'present_village_bn' => 'required',

            // 'permanent_postal_area_bn' => 'required',
            // 'permanent_postal_code_bn' => 'required',
            // 'permanent_ward_no_bn' => 'required',
            // 'permanent_village_bn' => 'required',
        ]);
        if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {
            try {
                $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

                $user = EmployeeDetail::find($employee_details->id);
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                // Employee Basic Information(Bangla)
                $user->bangla_name = $request->bangla_name;
                $user->father_name_bn = $request->father_name_bn;
                $user->mother_name_bn = $request->mother_name_bn;

                $user->present_city_corporation_bn = $request->present_city_corporation_bn;
                $user->present_sadar_bn = $request->present_sadar_bn;
                $user->present_poursova_bn = $request->present_poursova_bn;
                $user->present_postal_area_bn = $request->present_postal_area_bn;
                $user->present_postal_code_bn = $request->present_postal_code_bn;
                $user->present_ward_no_bn = $request->present_ward_no_bn;
                $user->present_village_bn = $request->present_village_bn;

                $user->permanent_city_corporation_bn = $request->permanent_city_corporation_bn;
                $user->permanent_sadar_bn = $request->permanent_sadar_bn;
                $user->permanent_poursova_bn = $request->permanent_poursova_bn;
                $user->permanent_postal_area_bn = $request->permanent_postal_area_bn;
                $user->permanent_postal_code_bn = $request->permanent_postal_code_bn;
                $user->permanent_ward_no_bn = $request->permanent_ward_no_bn;
                $user->permanent_village_bn = $request->permanent_village_bn;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Basis information (Bangla) Update Successfully');
        } else {
            try {
                $user = new EmployeeDetail();
                $user->empdetails_com_id =  Auth::user()->com_id;
                $user->empdetails_employee_id = $request->id;
                // Employee Basic Information(Bangla)
                $user->bangla_name = $request->bangla_name;
                $user->father_name_bn = $request->father_name_bn;
                $user->mother_name_bn = $request->mother_name_bn;

                $user->present_city_corporation_bn = $request->present_city_corporation_bn;
                $user->present_sadar_bn = $request->present_sadar_bn;
                $user->present_poursova_bn = $request->present_poursova_bn;
                $user->present_postal_area_bn = $request->present_postal_area_bn;
                $user->present_postal_code_bn = $request->present_postal_code_bn;
                $user->present_ward_no_bn = $request->present_ward_no_bn;
                $user->present_village_bn = $request->present_village_bn;

                $user->permanent_city_corporation_bn = $request->permanent_city_corporation_bn;
                $user->permanent_sadar_bn = $request->permanent_sadar_bn;
                $user->permanent_poursova_bn = $request->permanent_poursova_bn;
                $user->permanent_postal_area_bn = $request->permanent_postal_area_bn;
                $user->permanent_postal_code_bn = $request->permanent_postal_code_bn;
                $user->permanent_ward_no_bn = $request->permanent_ward_no_bn;
                $user->permanent_village_bn = $request->permanent_village_bn;
                $user->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
            return back()->with('message', 'Employee Basis information (Bangla) Update Successfully');
        }
    }
    public function updateCertificateLetter(Request $request)
    {
        try {
            $employee_basic_info = User::find($request->id);
            $employee_basic_info->appointment_letter_format_id = $request->appointment_letter_format_id;
            $employee_basic_info->warning_letter_format_id = $request->warning_letter_format_id;
            $employee_basic_info->probation_letter_format_id = $request->probation_letter_format_id;
            $employee_basic_info->noc_id = $request->noc_template_id;
            $employee_basic_info->experience_letter_id = $request->experience_letter_id;
            $employee_basic_info->salary_certificate_format_id = $request->salary_certificate_id;
            $employee_basic_info->salary_increment_letter_id = $request->salary_increment_letter_id;
            $employee_basic_info->noc_eligiblity_status = 0;
            $employee_basic_info->save();

        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Employee Selected for Certificates/Letters');
    }


    // public function updateEmployeeBasicInfo(Request $request)
    // {
    //     return $request->all();
    //     $validated = $request->validate([
    //         'bangla_name' => 'required',
    //         'company_assigned_id' => 'required',
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'username' => 'required',
    //         'email' =>  ['required', 'email', 'max:255'],
    //         'phone' => 'required',
    //         'date_of_birth' => 'required',
    //         'gender' => 'required',
    //         'company_id' => 'required',
    //         'department_id' => 'required',
    //         'designation_id' => 'nullable',
    //         'office_shift_id' => 'required',
    //         'role_users_id' => 'required',
    //         'user_over_time_type' => 'required',
    //         'role_users_id' => 'required',
    //         'attendance_type' => 'required',
    //         'joining_date' => 'required',
    //         'job_nature' => 'required',
    //         'blood_group' => 'required',
    //     ]);

    //     if (User::where('com_id', Auth::user()->com_id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {

    //         if (User::where('id', $request->id)->where('company_assigned_id', $request->company_assigned_id)->exists()) {
    //             //skip
    //         } else {
    //             return back()->with('message', 'Compnay Assigned ID Already Exists');
    //         }
    //     }


    //     if (User::where('com_id', Auth::user()->com_id)->where('email', $request->email)->exists()) {

    //         if (User::where('id', $request->id)->where('email', $request->email)->exists()) {
    //             //skip
    //         } else {
    //             return back()->with('message', 'Email Already Exists');
    //         }
    //     }

    //     if (User::where('com_id', Auth::user()->com_id)->where('username', $request->username)->exists()) {

    //         if (User::where('id', $request->id)->where('username', $request->username)->exists()) {
    //             //skip
    //         } else {
    //             return back()->with('message', 'User Name Already Exists');
    //         }
    //     }
    //     try {
    //     $employee_basic_info = User::find($request->id);
    //     $employee_basic_info->company_assigned_id = $request->company_assigned_id;
    //     $employee_basic_info->first_name = $request->first_name;
    //     $employee_basic_info->last_name = $request->last_name;
    //     $employee_basic_info->username = $request->username;
    //     $employee_basic_info->email = $request->email;
    //     $employee_basic_info->phone = $request->phone;
    //     $employee_basic_info->b_phone = $request->b_phone;
    //     $employee_basic_info->date_of_birth = $request->date_of_birth;
    //     $employee_basic_info->gender = $request->gender;
    //     $employee_basic_info->address = $request->address;
    //     $employee_basic_info->com_id = $request->company_id;
    //     $employee_basic_info->department_id = $request->department_id;
    //     $employee_basic_info->designation_id = $request->designation_id;
    //     $employee_basic_info->office_shift_id = $request->office_shift_id;
    //     $employee_basic_info->expiry_date = $request->expiry_date;
    //     $employee_basic_info->appointment_letter = $request->appointment_letter;
    //     $employee_basic_info->employment_type = $request->employment_type;
    //     $employee_basic_info->salary_type = $request->salary_type;

    //     $employee_basic_info->region_id = $request->region_id;
    //     $employee_basic_info->area_id = $request->area_id;
    //     $employee_basic_info->territory_id = $request->territory_id;
    //     $employee_basic_info->town_id = $request->town_id;
    //     $employee_basic_info->db_house_id = $request->db_house_id;
    //     $employee_basic_info->location_six_id = $request->location_six_id;
    //     $employee_basic_info->location_seven_id = $request->location_seven_id;
    //     $employee_basic_info->location_eight_id = $request->location_eight_id;
    //     $employee_basic_info->location_nine_id = $request->location_nine_id;
    //     $employee_basic_info->location_ten_id = $request->location_ten_id;
    //     $employee_basic_info->location_eleven_id = $request->location_eleven_id;
    //     $employee_basic_info->role_id = $request->role_users_id;
    //     $employee_basic_info->attendance_type = $request->attendance_type;
    //     $employee_basic_info->joining_date = $request->joining_date;
    //     $employee_basic_info->blood_group = $request->blood_group;
    //     $employee_basic_info->job_nature = $request->job_nature;
    //     $employee_basic_info->user_over_time_type = $request->user_over_time_type;
    //     if ($request->over_time_payable) {
    //         $employee_basic_info->over_time_payable = $request->over_time_payable;
    //         $employee_basic_info->user_over_time_rate = $request->user_over_time_rate;
    //     }

    //         $employee_basic_info->is_active = $request->is_active ?? 0;


    //         $employee_basic_info->multi_attendance = $request->multi_attendance ?? 0;

    //         $employee_basic_info->user_admin_status = $request->admin_status ?? 0;

    //     // return $employee_basic_info;
    //     $employee_basic_info->save();
    //     } catch (\Exception $e) {
    //     return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
    //     }
    //     // return back()->with('message', 'Updated Successfully');


    //     if (EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->exists()) {
    //         try {
    //         $employee_details = EmployeeDetail::where('empdetails_employee_id', '=', $request->id)->first('id');

    //         $user = EmployeeDetail::find($employee_details->id);
    //         $user->empdetails_com_id =  Auth::user()->com_id;
    //         $user->empdetails_employee_id = $request->id;
    //         $user->bangla_name = $request->bangla_name;

    //         $user->birth_place = $request->birth_place;
    //         $user->postal_area_bn = $request->postal_area_bn;
    //         $user->postal_area_en = $request->postal_area_en;
    //         $user->nationality_id = $request->nationality_id;
    //         $user->village_bn = $request->village_bn;
    //         $user->village_en = $request->village_en;
    //         $user->experience_month = $request->experience_month;
    //         $user->previous_organization = $request->previous_organization;
    //         // Permanent Address
    //         if ($request->division_id) {
    //             $user->division_id = $request->division_id;
    //         }
    //         if ($request->district_id) {
    //             $user->district_id = $request->district_id;
    //         }
    //         $user->city_corporation = $request->city_corporation;
    //         if ($request->upazila_id) {
    //             $user->upazila_id = $request->upazila_id;
    //         }
    //         if ($request->union_id) {
    //             $user->union_id = $request->union_id;
    //         }
    //         $user->ward_number = $request->ward_no;
    //         $user->village_en = $request->village;
    //         $user->postal_area_en = $request->postal_area;
    //         // Present Address
    //         if ($request->present_division_id) {
    //               $user->present_division_id = $request->present_division_id;
    //         }
    //         if ($request->present_district_id) {
    //             $user->present_district_id = $request->present_district_id;
    //         }
    //         $user->present_city_corporation = $request->present_city_corporation;
    //         if ($request->present_upazila_id) {
    //             $user->present_upazila_id = $request->present_upazila_id;
    //         }
    //         if ($request->present_union_id) {
    //             $user->present_union_id = $request->present_union_id;
    //         }
    //         $user->present_ward_no = $request->present_ward_no;
    //         $user->present_village = $request->present_village;
    //         $user->present_postal_area = $request->present_postal_area;

    //         $user->identification_type = $request->identification_type;
    //         $user->identification_number = $request->identification_number;
    //         $user->religion = $request->religion;
    //         $user->blood_group = $request->blood_group;
    //         $user->marital_status = $request->marital_status;
    //         // Parental Information(English)
    //         $user->father_name = $request->father_name;
    //         $user->father_phone = $request->father_phone;
    //         $user->mother_name = $request->mother_name;
    //         $user->mother_phone = $request->mother_phone;
    //         // Employee Basic Information(Bangla)
    //         $user->bangla_name = $request->bangla_name;
    //         $user->father_name_bn = $request->father_name_bn;
    //         $user->village_bn = $request->village_bn;
    //         $user->mother_name_bn = $request->mother_name_bn;
    //         $user->postal_area_bn = $request->postal_area_bn;

    //         // return $user;
    //         $user->save();
    //         // $user_update = User::find($request->empdetails_employee_id);
    //         // if ($request->division_id) {
    //         //     $user_update->division_id = $request->division_id;
    //         // }
    //         // if ($request->district_id) {
    //         //     $user_update->district_id = $request->district_id;
    //         // }
    //         // if ($request->upazila_id) {
    //         //     $user_update->upazila_id = $request->upazila_id;
    //         // }
    //         // if ($request->union_id) {
    //         //     $user_update->union_id = $request->union_id;
    //         // }
    //         // $user_update->save();
    //         } catch (\Exception $e) {
    //         return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
    //         }
    //         return back()->with('message', 'Update Successfully');
    //     } else {
    //         try {
    //         $user = new EmployeeDetail();
    //         $user->empdetails_com_id =  Auth::user()->com_id;
    //         $user->empdetails_employee_id = $request->id;
    //         $user->bangla_name = $request->bangla_name;

    //         $user->birth_place = $request->birth_place;
    //         $user->postal_area_bn = $request->postal_area_bn;
    //         $user->postal_area_en = $request->postal_area_en;
    //         $user->nationality_id = $request->nationality_id;
    //         $user->village_bn = $request->village_bn;
    //         $user->village_en = $request->village_en;
    //         $user->experience_month = $request->experience_month;
    //         $user->previous_organization = $request->previous_organization;
    //         // Permanent Address
    //         if ($request->division_id) {
    //             $user->division_id = $request->division_id;
    //         }
    //         if ($request->district_id) {
    //             $user->district_id = $request->district_id;
    //         }
    //         $user->city_corporation = $request->city_corporation;
    //         if ($request->upazila_id) {
    //             $user->upazila_id = $request->upazila_id;
    //         }
    //         if ($request->union_id) {
    //             $user->union_id = $request->union_id;
    //         }
    //         $user->ward_number = $request->ward_no;
    //         $user->village_en = $request->village;
    //         $user->postal_area_en = $request->postal_area;
    //         // Present Address
    //         if ($request->present_division_id) {
    //               $user->present_division_id = $request->present_division_id;
    //         }
    //         if ($request->present_district_id) {
    //             $user->present_district_id = $request->present_district_id;
    //         }
    //         $user->present_city_corporation = $request->present_city_corporation;
    //         if ($request->present_upazila_id) {
    //             $user->present_upazila_id = $request->present_upazila_id;
    //         }
    //         if ($request->present_union_id) {
    //             $user->present_union_id = $request->present_union_id;
    //         }
    //         $user->present_ward_no = $request->present_ward_no;
    //         $user->present_village = $request->present_village;
    //         $user->present_postal_area = $request->present_postal_area;

    //         $user->identification_type = $request->identification_type;
    //         $user->identification_number = $request->identification_number;
    //         $user->religion = $request->religion;
    //         $user->blood_group = $request->blood_group;
    //         $user->marital_status = $request->marital_status;
    //         // Parental Information(English)
    //         $user->father_name = $request->father_name;
    //         $user->father_phone = $request->father_phone;
    //         $user->mother_name = $request->mother_name;
    //         $user->mother_phone = $request->mother_phone;
    //         // Employee Basic Information(Bangla)
    //         $user->bangla_name = $request->bangla_name;
    //         $user->father_name_bn = $request->father_name_bn;
    //         $user->village_bn = $request->village_bn;
    //         $user->mother_name_bn = $request->mother_name_bn;
    //         $user->postal_area_bn = $request->postal_area_bn;
    //         $user->save();
    //         // $user_update = User::find($request->empdetails_employee_id);
    //         // if ($request->division_id) {
    //         //     $user_update->division_id = $request->division_id;
    //         // }
    //         // if ($request->district_id) {
    //         //     $user_update->district_id = $request->district_id;
    //         // }
    //         // if ($request->upazila_id) {
    //         //     $user_update->upazila_id = $request->upazila_id;
    //         // }
    //         // if ($request->union_id) {
    //         //     $user_update->union_id = $request->union_id;
    //         // }
    //         // $user_update->save();
    //         } catch (\Exception $e) {
    //         return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
    //         }
    //         return back()->with('message', 'Added Successfully');
    //     }
    // }

    public function updatedByEmployeeBasicInfo(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  ['required', 'email', 'max:255'],
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            // 'job_nature' => 'required',
            'blood_group' => 'required',
        ]);

        if (User::where('com_id', Auth::user()->com_id)->where('email', $request->email)->exists()) {

            if (User::where('id', $request->id)->where('email', $request->email)->exists()) {
                //skip
            } else {
                return back()->with('message', 'Email Already Exists');
            }
        }
        try {
            $employee_basic_info = User::find($request->id);
            $employee_basic_info->first_name = $request->first_name;
            $employee_basic_info->last_name = $request->last_name;
            $employee_basic_info->email = $request->email;
            $employee_basic_info->phone = $request->phone;
            $employee_basic_info->address = $request->address;
            $employee_basic_info->date_of_birth = $request->date_of_birth;
            $employee_basic_info->gender = $request->gender;
            $employee_basic_info->blood_group = $request->blood_group;
            $employee_basic_info->job_nature = $request->job_nature;
            $employee_basic_info->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }
    public function Signature()
    {
        $profile  = User::where('id', '=', Session::get('employee_setup_id'))->get();

        return view('back-end.premium.user-settings.general.employee-signature', [
            'profile' => $profile,
        ]);
    }
    public function signatureupload(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'profile_photo' => 'required',
        ]);
        try {
            $user = User::find($request->id);
            $image = $request->file('profile_photo');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/profile_photos';
            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $user->employee_signature = $imageUrl;
            $filePath = 'uploads/profile_photos/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'User Updated Successfully');
    }
}
