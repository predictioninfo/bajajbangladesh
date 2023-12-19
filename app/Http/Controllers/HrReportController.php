<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use Excel;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Union;
use App\Models\Region;
use App\Models\Company;
use App\Models\Project;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\Attendance;
use App\Models\Separation;
use Illuminate\Http\Request;
use App\Models\Locatoincustomize;
use App\Models\ProvidentfundReport;
use App\Exports\EmployeeReportExport;
use App\Exports\ActivePsrReportExport;
use App\Exports\PsrSeparationReportExport;
use App\Exports\PsrMasterMultipuleReportExport;
use App\Exports\OrientationSelectedReportExport;
use App\Exports\PsrRecruitmentSummaryReportExport;

class HrReportController extends Controller
{
    public function attendanceReportIndex(Request $request)
    {

        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'profile_photo']);
        $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
            ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
            ->where('attendance_com_id', '=', Auth::user()->com_id)
            ->get();

        return view('back-end.premium.hr-reports.attendance-report.attendance-report-index', [
            'attendances' => $attendances,
            'employees' => $employees,
        ]);
    }

    public function projectReportIndex(Request $request)
    {

        $projects = Project::where('project_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.hr-reports.project-report.project-report-index', compact('projects'));
    }

    public function taskReportIndex()
    {
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'profile_photo']);
        $projects = Project::where('project_com_id', '=', Auth::user()->com_id)->get(['id', 'project_name']);
        $tasks = Task::where('task_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.hr-reports.task-report.task-report-index', compact('tasks', 'employees', 'projects'));
    }

    public function dateWiseEmployeeAttendanceReport(Request $request)
    {

        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'profile_photo']);
        $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
            ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
            //->where('employee_id', '=', $request->employee_id)
            ->where('attendance_com_id', '=', Auth::user()->com_id)
            ->whereBetween('attendance_date', [$request->start_date, $request->end_date])
            ->orderBy("users.id", "asc")
            ->get();

        return view('back-end.premium.hr-reports.attendance-report.attendance-report-index', [
            'attendances' => $attendances,
            'employees' => $employees,
        ]);
    }


    public function employeeReportIndex()
    {

        //$users = DB::table('users')->where('com_id','=', Auth::user()->com_id)->whereNull('company_profile')->get(['id','username','first_name','last_name','email','phone','username','profile_photo']);
        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get();
        $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
            ->whereNull('company_profile')
            ->where('com_id', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $divisions = Division::get();
        return view('back-end.premium.hr-reports.employee-report.employee-report-index', [
            'companies' => $companies,
            'regions' => $regions,
            'roles' => $roles,
            'users' => $users,
            'locations' => $locations,
            'divisions' => $divisions
        ]);
    }

    public function employeeReportFiltering(Request $request)
    {

        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get();

        if ($request->department_id && $request->designation_id && $request->office_shift_id && $request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->role_users_id && $request->over_time_payable && $request->user_over_time_rate && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('role_id', $request->role_users_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('user_over_time_rate', $request->user_over_time_rate)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->department_id && $request->designation_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->department_id && $request->designation_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->department_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('is_active', 1)

                ->get();
        } elseif ($request->department_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->office_shift_id  && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->office_shift_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->division_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id && $request->location_ten_id && $request->location_eleven_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('location_eleven_id', $request->location_eleven_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id && $request->location_ten_id && $request->location_eleven_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('location_eleven_id', $request->location_eleven_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id && $request->location_ten_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id && $request->location_ten_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->department_id && $request->designation_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->department_id && $request->designation_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->department_id && $request->designation_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->get();
        } elseif ($request->department_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->get();
        } elseif ($request->department_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('is_active', 1)

                ->get();
        } elseif ($request->department_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->office_shift_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->get();
        } elseif ($request->office_shift_id  && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->office_shift_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->division_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)

                ->get();
        } elseif ($request->division_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                //->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                //->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->region_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->get();
        } elseif ($request->region_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->role_users_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('role_id', $request->role_users_id)
                ->get();
        } elseif ($request->role_users_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('role_id', $request->role_users_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->role_users_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('role_id', $request->role_users_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->start_date && $request->end_date && $request->is_active == "all") {

            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                // ->where('joining_date', '<=', $request->start_date)
                // ->where('joining_date', '>=', $request->end_date)
                ->whereBetween('joining_date', [$request->start_date, $request->end_date])
                ->get();
        } elseif ($request->start_date && $request->end_date && $request->is_active == 1) {

            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                // ->where('joining_date', '<=', $request->start_date)
                // ->where('joining_date', '>=', $request->end_date)
                ->whereBetween('joining_date', [$request->start_date, $request->end_date])
                ->get();
        } elseif ($request->start_date && $request->end_date && $request->is_active == '') {

            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', '')
                // ->where('joining_date', '<=', $request->start_date)
                // ->where('joining_date', '>=', $request->end_date)
                ->whereBetween('joining_date', [$request->start_date, $request->end_date])
                ->get();
        } elseif ($request->start_date && $request->is_active == "all") {

            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->whereDate('joining_date', $request->start_date)
                ->get();
        } elseif ($request->start_date && $request->is_active == 1) {

            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->whereDate('joining_date', $request->start_date)
                ->get();
        } elseif ($request->start_date && $request->is_active == '') {

            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', '')
                ->whereDate('joining_date', $request->start_date)
                ->get();
        } elseif ($request->over_time_payable && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->get();
        } elseif ($request->over_time_payable && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->over_time_payable && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('is_active', '')
                ->get();
        } elseif ($request->company_id && $request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->get();
        } elseif ($request->company_id && $request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->company_id && $request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', '')
                ->get();
        } elseif ($request->is_active == "all") {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->get();
        } elseif ($request->is_active == 1) {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->is_active == '') {
            $users = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', '')
                ->get();
        } else {

            $users = [];
        }

        if ($request->category_name == 'Search') {
            //return view('back-end.premium.hr-reports.employee-report.employee-report-index',[
            $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
            $divisions = Division::get();
            return view('back-end.premium.hr-reports.employee-report.employee-report-index', [
                'companies' => $companies,
                'regions' => $regions,
                'roles' => $roles,
                'users' => $users,
                'locations' => $locations,
                'divisions' => $divisions,
            ]);
        }
        if ($request->category_name == 'EmployeeReport') {

            $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
            $divisions = Division::get();
            $company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
            $month = date('M');
            $year = date('Y');
            $fileName = "Employee-Report-" . $month . "-" . $year . ".pdf";

            $mpdf = new \Mpdf\Mpdf([
                'font-family' => 'nikosh',
                'margin_top' => 30,
                'margin_bottom' => 10,
                'margin_header' => 5,
                'margin_footer' => 5,
                'orientation' => 'L',
            ]);
            $html = \View::make('back-end.premium.hr-reports.employee-report.employee-bulk-report-pdf', compact('users', 'roles', 'regions', 'companies', 'locations', 'divisions'));
            $html = $html->render();

            $logo = url('/uploads/logos/logo.png');

            $htmlHeader = '<html><div>'
                . '<div><img src="' . $logo . '"  style="max-height: 20px; text-align: center; padding-left:0%;"/></div>'
                . '<div id="descriptionCourse" style="padding-left:33%;"><span style="font-size:20px;"> ' . $company_names->company_name . '</div>'
                . '<div id="descriptionCourse" style="padding-left:40%;"><span style="font-size:20px;"> Employee Report </div>'
                . '</div></html>';

            $mpdf->SetHTMLHeader($htmlHeader);
            $mpdf->WriteHTML($html);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->Output($fileName, 'D');
        }

        if ($request->category_name == 'EmployeeReportExcel') {

            $data['company_names'] = Company::where('id', Auth::user()->com_id)->first(['company_name']);
            $data['companies'] = $companies;
            $data['users'] = $users;
            $data['regions'] = $regions;
            $data['roles'] = $roles;
            $exl = Excel::download(new EmployeeReportExport($data), 'Employee-Report.xlsx');
            return $exl;
        }

    }

    public function employeeReportDownload(Request $request, $id)
    {

        $employees = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'emoloyeedetail', 'bankaccount', 'userrole')
            ->where('id', $request->id)
            ->where('com_id', Auth::user()->com_id)
            ->get();
        $pdf = PDF::loadView('back-end.premium.hr-reports.employee-report.employee-pdf-report', compact('employees'));
        $pdf->download('Report.pdf');
    }

    /* Active PSR Report Method Start */

    public function activePsr(Request $request)
    {
        $employees = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'emoloyeedetail', 'bankaccount', 'usertown')
            ->where('com_id', Auth::user()->com_id)
            ->where('is_active', 1)
            ->whereNull('company_profile')
            ->get();
        return view('back-end.premium.hr-reports.active-psr-report.index', get_defined_vars());
    }

    public function activePsrExcelReportDownload(Request $request)
    {
        $employees = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown')
            ->where('com_id', Auth::user()->com_id)
            ->where('is_active', 1)
            ->get();
        $data['employees'] = $employees;
        $exl = Excel::download(new ActivePsrReportExport($data), 'Active-Psr-Report.xlsx');
        return $exl;
    }

    /* Active PSR Report Method End */

    /* PSR Master Report Method Start */

    public function psrMasterReport(Request $request)
    {
        $employees = User::with('userdepartment', 'userDivision', 'userDistrict', 'userUpazila', 'userUnion', 'bankaccount', 'salaryconfig', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'emoloyeedetail',  'bankaccount')
            ->where('com_id', Auth::user()->com_id)
            ->whereNull('company_profile')
            ->get();
        $user_gross_salaries = User::pluck('gross_salary');
        return view('back-end.premium.hr-reports.psr-master-report.index', get_defined_vars());
    }

    public function psrMasterExcelReportDownload(Request $request)
    {
        $exl = Excel::download(new PsrMasterMultipuleReportExport, 'Psr-Master-Report.xlsx');
        return  $exl;
    }

    /* PSR Master Report Method End */


    /* PSR Recruitment Summary Report Method Start */

    function PsrRecruitmentSummary()
    {

        $employees = User::with('userterritory', 'userdbhouse','emoloyeedetail', 'educationdetail')
            ->where('com_id', Auth::user()->com_id)
            ->where('is_active', 1)
            ->whereNull('company_profile')
            ->get();

        return view('back-end.premium.hr-reports.psr-recruitment-summary.index', get_defined_vars());
    }


    public function PsrRecruitmentSummaryReportDownload(Request $request)
    {
        $month = date("m", strtotime($request->month_year));
        $year = date("Y", strtotime($request->month_year));
        if ($request->month_year) {
            $employees = User::with('userterritory', 'userdbhouse')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->whereMonth('joining_date', $month)
                ->whereYear('joining_date', $year)
                ->whereNull('company_profile')
                ->get();
        } else {
            $employees = User::with('userterritory', 'userdbhouse', 'emoloyeedetail', 'educationdetail')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->whereNull('company_profile')
                ->get();
        }
        $data['employees'] = $employees;
        $exl = Excel::download(new PsrRecruitmentSummaryReportExport($data), 'Psr-Recruitment-Summary-Report.xlsx');
        return $exl;
    }
    /* PSR Recruitment Summary Report Method End */

    /*  Orientation Selected Report Method Start */

    function orientationSelected()
    {
        $separations = Separation::where('separation_com_id', Auth::user()->com_id)
            ->with(['repalaceEmployee', 'separationEmployee' => function ($query) {
                $query->with(['emoloyeedetail', 'userregion', 'userarea', 'userterritory', 'usertown']);
            }])->get();
        return view('back-end.premium.hr-reports.orientation-selected-report.index', get_defined_vars());
    }

    public function orientationSelectedDownload(Request $request)
    {
        $month = date("m", strtotime($request->month_year));
        $year = date("Y", strtotime($request->month_year));
        if ($request->month_year) {
            $separations = Separation::where('separation_com_id', Auth::user()->com_id)
                ->with(['repalaceEmployee', 'separationEmployee' => function ($query) {
                    $query->with(['emoloyeedetail', 'userregion', 'userarea', 'userterritory', 'usertown']);
                }])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->get();
        } else {
            $separations = Separation::where('separation_com_id', Auth::user()->com_id)
                ->with(['repalaceEmployee', 'separationEmployee' => function ($query) {
                    $query->with(['emoloyeedetail', 'userregion', 'userarea', 'userterritory', 'usertown']);
                }])
                ->get();
        }


        $data['separations'] = $separations;
        $exl = Excel::download(new OrientationSelectedReportExport($data), 'all-orientation-selected.xlsx');
        return $exl;
    }
    /* Orientation Selected Report Method End */

    /* Separation Report  Method Start */
    function separationReport(Request $request)
    {
        $separations = Separation::where('separation_com_id', Auth::user()->com_id)
            ->with(['resignationEmployee', 'terminationEmployee', 'repalaceEmployee', 'separationEmployee' => function ($query) {
                $query->with(['bankaccount', 'emoloyeedetail', 'userregion', 'userarea', 'userterritory', 'usertown']);
            }])->get();
          //  dd($separations);
        return view('back-end.premium.hr-reports.separation.index', get_defined_vars());
    }


    function separationReportDownlaod(Request $request)
    {
        $month = date("m", strtotime($request->month_year));
        $year = date("Y", strtotime($request->month_year));
        if ($request->month_year) {
            $separations = Separation::where('separation_com_id', Auth::user()->com_id)
                ->with(['resignationEmployee', 'terminationEmployee', 'repalaceEmployee', 'separationEmployee' => function ($query) {
                    $query->with(['bankaccount', 'emoloyeedetail', 'userregion', 'userarea', 'userterritory', 'usertown']);
                }])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->get();
        } else {
            $separations = Separation::where('separation_com_id', Auth::user()->com_id)
                ->with(['resignationEmployee', 'terminationEmployee', 'repalaceEmployee', 'separationEmployee' => function ($query) {
                    $query->with(['bankaccount', 'emoloyeedetail', 'userregion', 'userarea', 'userterritory', 'usertown']);
                }])->get();
        }
        $data['separations'] = $separations;
        $exl = Excel::download(new PsrSeparationReportExport($data), 'Psr-Separation-Report.xlsx');
        return $exl;
    }

    /* Separation Report  Method End */


    public function pfReportIndex(Request $request)
    {

        $pf_histories = ProvidentfundReport::join('users', 'providentfund_reports.providentfund_report_employee_id', '=', 'users.id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('designations', 'users.designation_id', '=', 'designations.id')
            ->join('companies', 'users.com_id', '=', 'companies.id')
            ->join('providentfund_bankaccounts', 'users.id', '=', 'providentfund_bankaccounts.providentfund_bankaccount_employee_id')
            ->select('providentfund_reports.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'companies.company_name', 'providentfund_bankaccounts.providentfund_bankaccount_stuff_id', 'providentfund_bankaccounts.providentfund_bankaccount_bank_name', 'providentfund_bankaccounts.providentfund_bankaccount_bank_account_number', 'providentfund_bankaccounts.providentfund_bankaccount_branch_name', 'providentfund_bankaccounts.providentfund_bankaccount_branch_code')
            ->where('providentfund_report_com_id', Auth::user()->com_id)
            ->whereNull('company_profile')
            ->get();

        return view('back-end.premium.hr-reports.pf-report.pf-report-index', [
            'pf_histories' => $pf_histories,
        ]);
    }
}