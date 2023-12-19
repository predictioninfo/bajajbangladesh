<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Area;
use App\Models\Role;
use App\Models\Town;
use App\Models\User;
use App\Models\Grade;
use App\Models\Union;
use App\Models\Region;
use App\Models\Company;
use App\Models\DbHouse;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\Document;
use App\Models\Immigrant;
use App\Models\Territory;
use App\Models\Department;
use App\Models\BankAccount;
use App\Models\Designation;
use App\Models\Locationsix;
use App\Models\Locationten;
use App\Models\Nationality;
use App\Models\OfficeShift;
use App\Models\Locationnine;
use App\Models\VariableType;
use Illuminate\Http\Request;
use App\Models\Locationeight;
use App\Models\Qualification;
use App\Models\SocialProfile;
use App\Models\EmployeeDetail;
use App\Models\Locationeleven;
use App\Models\Locatoionseven;
use App\Models\VariableMethod;
use App\Models\WorkExperience;
use App\Models\EmergencyContact;
use App\Models\Locatoincustomize;
use App\Models\SalaryCirtificate;
use App\Models\CompanyBankAccount;
use App\Models\ExperienceTemplate;
use App\Models\SalaryRemuneration;
use App\Models\AppointmentTemplate;
use App\Models\DeviceArea;
use App\Models\WarningLetterFormat;
use App\Models\SalaryIncrementLetter;
use App\Models\ProbitionLetterFormats;
use App\Models\NonObjectionCertificate;
use App\Models\ProvidentfundBankaccount;

class GeneralController extends Controller
{
    public function employeeBasicInfoIndex(Request $request)
    {
        $companies = Company::where('id', '=', Auth::user()->com_id)->get(['id', 'company_name']);
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get(['id', 'region_name']);
        $employee_profile  = User::where('id', '=', Session::get('employee_setup_id'))->with('userdesignation')->first();

        if (EmployeeDetail::where('empdetails_employee_id', '=', Session::get('employee_setup_id'))->exists()) {
            $add = 0;
            $employee_basic_infos = User::with('emoloyeedetail')->where('id', '=', Session::get('employee_setup_id'))->get([
                'id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone','b_phone' ,'username', 'date_of_birth', 'gender', 'profile_photo',
                'joining_date','expiry_date','employment_type', 'salary_type', 'user_admin_status', 'appointment_letter','user_over_time_type', 'over_time_payable', 'user_over_time_rate', 'is_active','multi_attendance', 'user_admin_status', 'address', 'blood_group', 'job_nature', 'attendance_type', 'department_id', 'designation_id',
                'office_shift_id', 'appointment_letter_format_id','warning_letter_format_id','probation_letter_format_id','region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id', 'role_id', 'location_six_id', 'location_seven_id', 'location_eight_id', 'location_nine_id', 'location_ten_id', 'location_eleven_id','replace_employee_id','grade_id','noc_id','experience_letter_id','in_probation_month','in_trine_month','device_area'
            ]);
        }else{
            $add = 1;
              $employee_basic_infos = User::where('id', '=', Session::get('employee_setup_id'))->get([
                'id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone','b_phone' ,'username', 'date_of_birth', 'gender', 'profile_photo',
                'joining_date','expiry_date','employment_type', 'salary_type', 'user_admin_status', 'appointment_letter','user_over_time_type', 'over_time_payable', 'user_over_time_rate', 'is_active','multi_attendance', 'user_admin_status', 'address', 'blood_group', 'job_nature', 'attendance_type', 'department_id', 'designation_id',
                'office_shift_id', 'region_id','appointment_letter_format_id','warning_letter_format_id','probation_letter_format_id','area_id', 'territory_id', 'town_id', 'db_house_id', 'role_id', 'location_six_id', 'location_seven_id', 'location_eight_id', 'location_nine_id', 'location_ten_id', 'location_eleven_id','replace_employee_id','grade_id','noc_id','experience_letter_id','in_probation_month','in_trine_month','device_area'
            ]);
        }

        $officeShifts = OfficeShift::where('office_shift_com_id', '=',  Auth::user()->com_id)->get();

        foreach ($employee_basic_infos as  $employee_designation_info) {
            $designation_id = $employee_designation_info->department_id;
            $area_id = $employee_designation_info->region_id;
            $territory_id = $employee_designation_info->area_id;
            $town_id = $employee_designation_info->territory_id;
            $db_id = $employee_designation_info->town_id;
            $location_six_id = $employee_designation_info->db_house_id;
            $location_seven_id = $employee_designation_info->location_six_id;
            $location_eight_id = $employee_designation_info->location_seven_id;
            $location_nine_id = $employee_designation_info->location_eight_id;
            $location_ten_id = $employee_designation_info->location_nine_id;
            $location_eleven_id = $employee_designation_info->location_ten_id;
        }
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->where('roles_is_active', 1)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->where('area_region_id', '=', $area_id)->get();
        $territores = Territory::where('territory_com_id', '=', Auth::user()->com_id)->where('territory_area_id', '=', $territory_id)->get();
        $towns = Town::where('town_com_id', '=', Auth::user()->com_id)->where('town_territory_id', '=', $town_id)->get();
        $dbs = DbHouse::where('db_house_com_id', '=', Auth::user()->com_id)->where('db_house_town_id', '=', $db_id)->get();
        $location_six = Locationsix::where('location_six_com_id', '=', Auth::user()->com_id)->where('location_six_db_house_id', '=', $location_six_id)->get();
        $location_seven = Locatoionseven::where('location_seven_com_id', '=', Auth::user()->com_id)->where('location_seven_location_six_id', '=', $location_seven_id)->get();
        $location_eight = Locationeight::where('location_eights_com_id', '=', Auth::user()->com_id)->where('location_eights_ocation_seven_id', '=', $location_eight_id)->get();
        $location_nine = Locationnine::where('location_nine_com_id', '=', Auth::user()->com_id)->where('location_nine_eight_id', '=', $location_nine_id)->get();
        $location_ten = Locationten::where('location_ten_com_id', '=', Auth::user()->com_id)->where('location_ten_nine_id', '=', $location_ten_id)->get();
        $location_eleven = Locationeleven::where('location_eleven_com_id', '=', Auth::user()->com_id)->where('location_eleven_ten_id', '=', $location_eleven_id)->get();
        $designations = Designation::where('designation_department_id', '=', $designation_id)->get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $inactive_users = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', '=', '')->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'first_name', 'last_name']);

        $nationalities = Nationality::all();
        $divisions = Division::get();
        $districts = District::get();
        $upzillas = Upazila::get();
        $unions = Union::get();
        $grades = Grade::get();
        $device_area =  DeviceArea::get();

        $appointment_letter_formats = AppointmentTemplate::where('appointment_template_com_id', '=', Auth::user()->com_id)->get();
        $warning_letter_formats = WarningLetterFormat::where('warning_letter_format_com_id',Auth::user()->com_id)->get();
        $probition_letter_formats = ProbitionLetterFormats::where('probation_letter_format_com_id',Auth::user()->com_id)->get();
        $noc_templates = NonObjectionCertificate::where('non_objection_certificate_com_id',Auth::user()->com_id)->get();
        $experience_letters = ExperienceTemplate::where('experience_template_com_id',Auth::user()->com_id)->get();
        $salary_certificates = SalaryCirtificate::where('salary_cirti_com_id',Auth::user()->com_id)->get();
        $salaryIncrements = SalaryIncrementLetter::where('salary_inc_letter_com_id',Auth::user()->com_id)->get();


        return view('back-end.premium.user-settings.general.employee-basic-info-index', get_defined_vars());
    }



    public function employeeImmigrationIndex(Request $request)
    {
        $immigrant_details = Immigrant::where('immigrant_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.general.employee-immigrant-index', [
            'immigrant_details' => $immigrant_details,
        ]);
    }

    public function employeeEmergencyContactIndex(Request $request)
    {
        $emergency_contact_details = EmergencyContact::where('emergency_contact_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.general.employee-emergency-contact-index', [
            'emergency_contact_details' => $emergency_contact_details,
        ]);
    }

    public function employeeSocialProfileIndex(Request $request)
    {
        $social_profile_details = SocialProfile::where('social_profile_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.general.employee-social-profile-index', [
            'social_profile_details' => $social_profile_details,
        ]);
    }

    public function employeeDocumentIndex(Request $request)
    {
        $document_details = Document::with('documentUploadedByEmployee', 'documentEmployee')
            ->where('document_com_id', Auth::user()->com_id)
            ->where('document_employee_id', '=', Session::get('employee_setup_id'))
            ->get();
        $documnets_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Document-Type')->get();
        return view('back-end.premium.user-settings.general.employee-document-index', [
            'document_details' => $document_details,
            'documnets_types' => $documnets_types,
        ]);
    }

    public function employeeQualificationIndex(Request $request)
    {
        $qualification_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Qualification')->get();
        $qualification_details = Qualification::where('qualification_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.general.employee-qualification-index', [
            'qualification_details' => $qualification_details,
            'qualification_methods' => $qualification_methods,
        ]);
    }

    public function employeeWorkExperirenceIndex(Request $request)
    {
        $work_experience_details = WorkExperience::where('work_experience_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.general.employee-work-experience-index', [
            'work_experience_details' => $work_experience_details,
        ]);
    }
    
    public function employeeBankAccountIndex(Request $request)
    {
        $bank_accounts = BankAccount::where('bank_account_employee_id', '=', Session::get('employee_setup_id'))->get();
        $company_bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();
        $user_id = User::where('id', '=', Session::get('employee_setup_id'))->get(['company_assigned_id']);
        foreach ($user_id as $user) {
            $stuff_id = $user->company_assigned_id;
        }

        return view('back-end.premium.user-settings.general.employee-bank-account-index', [
            'bank_accounts' => $bank_accounts,
            'user_id' => $user_id,
            'stuff_id' => $stuff_id,
            'company_bank_accounts' => $company_bank_accounts,
        ]);
    }

    public function employeePfBankAccountIndex(Request $request)
    {
        $pf_bank_accounts = ProvidentfundBankaccount::where('providentfund_bankaccount_employee_id', '=', Session::get('employee_setup_id'))->get();

        return view('back-end.premium.user-settings.general.employee-pf-bank-account-index', [
            'pf_bank_accounts' => $pf_bank_accounts,
        ]);
    }

    public function employeePasswordChangeIndex(Request $request)
    {
        //$employee_password_details = User::where('id','=',Session::get('employee_setup_id'))->get('password');

        return view('back-end.premium.user-settings.general.employee-password-change-index');
    }

    ###################################Employee Gross Salary Crud Portion starts from here#####################################################################
    public function addEmployeeGrossSalary(Request $request)
    {
        try {
            $gross_salary = User::find($request->id);
            $gross_salary->gross_salary = $request->gross_salary;
            $gross_salary->per_hour_rate = 0;
            $gross_salary->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeGrossSalaryById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeGrossSalaryByIds = User::where($where)->first();

        return response()->json($employeeGrossSalaryByIds);
    }

    public function employeeGrossSalaryUpdate(Request $request)
    {
        try {
            $gross_salary = User::find($request->id);
            $gross_salary->gross_salary = $request->gross_salary;
            $gross_salary->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function addSalaryRemunaration(Request $request)
	{
            if(SalaryRemuneration::where('saray_remuneration_com_id',Auth::user()->com_id)->where('saray_remuneration_employeee_id',$request->employee_id)->exists()){

            $salary_remunaration =  SalaryRemuneration::where('saray_remuneration_com_id',Auth::user()->com_id)->where('saray_remuneration_employeee_id',$request->employee_id)->first();
            $salary_remunaration->saray_remuneration_com_id = Auth::user()->com_id;
            $salary_remunaration->saray_remuneration_employeee_id = $request->employee_id;

            $salary_remunaration->saray_remuneration_basic = $request->saray_remuneration_basic;
            $salary_remunaration->saray_remuneration_medical = $request->saray_remuneration_medical;
            $salary_remunaration->saray_remuneration_house_rent = $request->saray_remuneration_house_rent;
            $salary_remunaration->saray_remuneration_other_allowance = $request->saray_remuneration_other_allowance;
            $salary_remunaration->saray_remuneration_convence = $request->saray_remuneration_convence;
            $salary_remunaration->saray_remuneration_gross_salary_with_fixed = $request->saray_remuneration_gross_salary_with_fixed;
            $salary_remunaration->save();

            }else{

            $salary_remunaration = new SalaryRemuneration();
            $salary_remunaration->saray_remuneration_com_id = Auth::user()->com_id;
            $salary_remunaration->saray_remuneration_employeee_id = $request->employee_id;
            $salary_remunaration->saray_remuneration_basic = $request->saray_remuneration_basic;
            $salary_remunaration->saray_remuneration_medical = $request->saray_remuneration_medical;
            $salary_remunaration->saray_remuneration_house_rent = $request->saray_remuneration_house_rent;
            $salary_remunaration->saray_remuneration_other_allowance = $request->saray_remuneration_other_allowance;
            $salary_remunaration->saray_remuneration_convence = $request->saray_remuneration_convence;
            $salary_remunaration->saray_remuneration_gross_salary_with_fixed = $request->saray_remuneration_gross_salary_with_fixed;
            $salary_remunaration->save();

            }
            return back()->with('message','Added Successfully');
	}



    public function deleteEmployeeGrossSalary($id)
    {
        try {
            //$project = Project::where('id',$id)->delete();
            $gross_salary = User::find($id);
            $gross_salary->gross_salary = 0;
            $gross_salary->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    ###################################Employee Gross Salary Crud Portion Ends here#####################################################################

    ###################################Employee Mobile Allowance Crud Portion starts from here#####################################################################
    public function addEmployeeMobileBill(Request $request)
    {
        try {
            $mobile_bill = User::find($request->id);
            $mobile_bill->mobile_bill = $request->mobile_bill;
            $mobile_bill->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeMobileBillById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeMobileBillByIds = User::where($where)->first();
        return response()->json($employeeMobileBillByIds);
    }

    public function employeeMobileBillUpdate(Request $request)
    {
        try {
            $mobile_bill = User::find($request->id);
            $mobile_bill->mobile_bill = $request->mobile_bill;
            $mobile_bill->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeMobileBill($id)
    {
        try {
            $mobile_bill = User::find($id);
            $mobile_bill->mobile_bill = 0;
            $mobile_bill->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    ###################################Employee Mobile Allowance Crud Portion Ends here#####################################################################

    ###################################Employee TA/DA Crud Portion starts from here#####################################################################
    public function addEmployeeTaDa(Request $request)
    {
        try {
            $transport_allowance = User::find($request->id);
            $transport_allowance->transport_allowance = $request->transport_allowance;
            $transport_allowance->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeTaDaById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeTransportAllowanceByIds = User::where($where)->first();
        return response()->json($employeeTransportAllowanceByIds);
    }

    public function employeeTaDaUpdate(Request $request)
    {
        try {
            $transport_allowance = User::find($request->id);
            $transport_allowance->transport_allowance = $request->transport_allowance;
            $transport_allowance->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeTaDa($id)
    {
        try {
            $transport_allowance = User::find($id);
            $transport_allowance->transport_allowance = 0;
            $transport_allowance->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    ###################################Employee TA/DA Crud Portion Ends here#####################################################################





}