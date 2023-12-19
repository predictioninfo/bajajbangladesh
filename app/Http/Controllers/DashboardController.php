<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Award;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Announcement;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Holiday;
use App\Models\SupportTicket;
use App\Models\Project;
use App\Models\PaySlip;
use App\Models\Company;
use App\Models\Package;
use App\Models\VariableMethod;
use App\Models\Grade;
use App\Models\GradeLabel;
use App\Models\GradeSetup;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use DateTime;
use Exception;
use Illuminate\Http\Response;
use Session;

class DashboardController extends Controller
{
    public function organogram()
    {
        return view('back-end.premium.organization.organogram.index', get_defined_vars());
        // return view('back-end.premium.organization.organogram.index2', get_defined_vars());
    }

    // public function orgChart()
    // {
    //     $data = GradeSetup::join('users as emp', 'emp.id', '=', 'grade_setups.emp_id')
    //         ->leftJoin('users as sup', 'sup.id', '=', 'grade_setups.report_to_parent_id')
    //         ->join('departments', 'grade_setups.dept_id', '=', 'departments.id')
    //         ->join('designations', 'grade_setups.desg_id', '=', 'designations.id')
    //         ->select(
    //             DB::raw('grade_setups.id as id'),
    //             DB::raw('parent_id as pid'),
    //             DB::raw('grade_setups.emp_id as employee'),
    //             DB::raw('grade_setups.report_to_parent_id as supervisor'),
    //             DB::raw('emp.profile_photo as img'),
    //             DB::raw('departments.department_name as departmentName'),
    //             DB::raw('designations.designation_name as designationName'),
    //             DB::raw("CONCAT(emp.first_name, ' ', emp.last_name) as fullName"),
    //             DB::raw("CONCAT(sup.first_name, ' ', sup.last_name) as supervisorName")
    //         )
    //         ->where(function ($query) {
    //             $query->whereNull('grade_setups.report_to_parent_id')
    //                 ->orWhere(DB::raw('sup.id'), '=', DB::raw('grade_setups.report_to_parent_id'));
    //         })
    //         ->get();
    //     try {
    //         return response()->json($data);
    //     } catch (Exception $e) {
    //         return '{"error":{"text":' . $e->getMessage() . '}}';
    //     }
    // }
    public function orgChart()
    {
       return $data = GradeSetup::join('users', 'users.id', '=', 'grade_setups.emp_id')
            ->join('departments', 'grade_setups.dept_id', '=', 'departments.id')
            ->join('designations', 'grade_setups.desg_id', '=', 'designations.id')
            ->select(DB::raw("grade_setups.id as memberId"), DB::raw("parent_id as parentId"), DB::raw("users.first_name as firstName"), DB::raw("users.last_name as lastName"), DB::raw("departments.department_name as departmentName"), DB::raw("designations.designation_name as otherInfo"), DB::raw("users.profile_photo as Image"))
            ->get();
        try {
            return response()->json($data);
        } catch (Exception $e) {
            return '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }

    public function Tree()
    {
        $grades = Grade::where('grade_com_id', Auth::user()->com_id)->get();
        // foreach($grades as $grade){
        //     $data[] = $grade;
        // }DB::raw("count(*) as count"),
        // $grade=json_encode($data);
        // $grade_labels = GradeLabel::where('grade_label_com_id', Auth::user()->com_id)->get();
        // $depatments = Department::where('department_com_id', Auth::user()->com_id)->get();
        // $grade_setups = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->get();
        $users = User::where('com_id', Auth::user()->com_id)->where('is_active', '1')->get(['report_to_parent_id', 'first_name', 'last_name']);
        return view('tree', ['grades' => $grades, 'users' => $users]);
    }
    public function getData()
    {
        // $employeeData = Grade::where('grade_com_id', Auth::user()->com_id)
        //                        ->get();
        $employeeData = GradeSetup::join('grades', 'grade_setups.grade_id', '=', 'grades.id')
            ->join('departments', 'grade_setups.dept_id', '=', 'departments.id')
            ->join('designations', 'grade_setups.desg_id', '=', 'designations.id')
            ->join('users', 'grade_setups.emp_id', '=', 'users.id')
            ->select('grades.grade_name', 'grades.id', 'grades.grade_defination', 'departments.department_name', 'designations.designation_name', 'grade_setups.under_grade_id')
            ->where('grade_setup_com_id', Auth::user()->com_id)
            ->get();
        $nodes = [];

        foreach ($employeeData as $employee) {
            $node = [
                'id' => $employee->id,
                'name' => $employee->grade_name,
                'positionName' => $employee->designation_name,
                'parent' => $employee->under_grade_id,
                'imageUrl' => $employee->created_at,
            ];
            $nodes[] = $node;
        }
        return response()->json($nodes);
    }
    public function index()
    {

        if (Auth::user()->super_system_admin === 'Yes') {
            $company_counts = Company::count();
            $employee_active_counts = User::where('is_active', '1')->count();
            $employee_inactive_counts = User::where('is_active', '')->count();
            $package_counts = Package::count();
            return view('back-end.premium.dashboard.super-system-admin-dashboard', compact('company_counts', 'employee_active_counts', 'employee_inactive_counts', 'package_counts'));
        } elseif (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $department_piedata = User::join('departments', 'users.department_id', '=', 'departments.id')
                ->select('departments.department_name', DB::raw("count(users.id) as count"))
                ->groupBy('department_name')
                ->where('com_id', Auth::user()->com_id)
                ->get();

                $designation_chartData = User::join('designations', 'users.designation_id', '=', 'designations.id')
                ->select('designations.designation_name', DB::raw("count(users.id) as count"))
                ->groupBy('designation_name')
                ->where('com_id', Auth::user()->com_id)
                ->get();

            $projects = Project::select(DB::raw("count(*) as count"), DB::raw("progress_progress as progress"), DB::raw("project_name as project"), DB::raw("assign_to as assign"))
                ->groupBy(DB::raw("project"), DB::raw("progress"), DB::raw("assign"))
                ->where('project_com_id', Auth::user()->com_id)
                ->get();
            $payments = PaySlip::select(
                DB::raw("(sum(pay_slip_net_salary)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
            )->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->get();
            $users = User::with('userdesignation', 'userdepartment', 'userofficeshift')->where('id', Auth::user()->id)->get(['designation_id', 'department_id', 'office_shift_id']);

          $employee_counts = User::where('is_active', '1')->where('com_id', Auth::user()->com_id)->where('attendance_status','No')->count();
            $attendance_p = Attendance::where('attendance_com_id', Auth::user()->com_id)->where('attendance_date', now()->format('Y-m-d'))->where('check_in_out', 1)->count();
            $announcement = Announcement::where('announcement_com_id', Auth::user()->com_id)->count();
            $leave = Leave::where('leaves_company_id', Auth::user()->com_id)->where('leaves_status', 'Pending')->count();
            $supportticket = SupportTicket::where('support_ticket_com_id', Auth::user()->com_id)->where('support_ticket_status', 'Pending')->count();
            //$project=Project::where('project_com_id',Auth::user()->com_id)->count();
            $project = Project::where('project_com_id', Auth::user()->com_id)->where('progress_progress', '=', 100)->count();
            $salary = PaySlip::where('pay_slip_com_id', Auth::user()->com_id)->sum('pay_slip_net_salary');

            //return view('back-end.premium.dashboard.premium-admin-dashboard',compact('payments','designation_chartData','department_piedata','project_chartData','employee_counts','attendance_p','announcement','leave','supportticket','project','salary'));
            return view('back-end.premium.dashboard.premium-admin-dashboard', compact('users', 'payments', 'designation_chartData', 'department_piedata', 'projects', 'employee_counts', 'attendance_p', 'announcement', 'leave', 'supportticket', 'project', 'salary'));
        } elseif (Auth::user()->company_profile == 'Yes') {

            $department_piedata = User::join('departments', 'users.department_id', '=', 'departments.id')
                ->select('departments.department_name', DB::raw("count(users.id) as count"))
                ->groupBy('department_name')
                ->where('com_id', Auth::user()->com_id)
                ->get();

            $designation_chartData = User::join('designations', 'users.designation_id', '=', 'designations.id')
                ->select('designations.designation_name', DB::raw("count(users.id) as count"))
                ->groupBy('designation_name')
                ->where('com_id', Auth::user()->com_id)
                ->get();

            $projects = Project::select(DB::raw("count(*) as count"), DB::raw("progress_progress as progress"), DB::raw("project_name as project"), DB::raw("assign_to as assign"))
                ->groupBy(DB::raw("project"), DB::raw("progress"), DB::raw("assign"))
                ->where('project_com_id', Auth::user()->com_id)
                ->get();


            $payments = PaySlip::select(
                DB::raw("(sum(pay_slip_net_salary)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
            )->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->where('pay_slip_com_id', Auth::user()->com_id)
                ->where('pay_slip_status', 1)
                ->get();
            $users = User::with('userdesignation', 'userdepartment', 'userofficeshift')->where('id', Auth::user()->id)->get(['designation_id', 'department_id', 'office_shift_id']);

             $employee_counts = User::where('is_active', '1')->where('com_id', Auth::user()->com_id)->count();
            $attendance_p = Attendance::where('attendance_com_id', Auth::user()->com_id)->where('attendance_date', now()->format('Y-m-d'))->where('check_in_out', 1)->count();
            $announcement = Announcement::where('announcement_com_id', Auth::user()->com_id)->count();
            $leave = Leave::where('leaves_company_id', Auth::user()->com_id)->where('leaves_status', 'Pending')->count();
            $supportticket = SupportTicket::where('support_ticket_com_id', Auth::user()->com_id)->where('support_ticket_status', 'Pending')->count();
            //$project=Project::where('project_com_id',Auth::user()->com_id)->count();
            $project = Project::where('project_com_id', Auth::user()->com_id)->where('progress_progress', '=', 100)->count();
            $salary = PaySlip::where('pay_slip_com_id', Auth::user()->com_id)->sum('pay_slip_net_salary');

            //return view('back-end.premium.dashboard.premium-admin-dashboard',compact('payments','designation_chartData','department_piedata','project_chartData','employee_counts','attendance_p','announcement','leave','supportticket','project','salary'));
            return view('back-end.premium.dashboard.premium-admin-dashboard', compact('users', 'payments', 'designation_chartData', 'department_piedata', 'projects', 'employee_counts', 'attendance_p', 'announcement', 'leave', 'supportticket', 'project', 'salary'));
        } elseif (Role::where('id', Auth::user()->role_id)->exists()) {

            if (Auth::user()->is_active == 1 && Auth::user()->users_bulk_deleted == 'No') {

                if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

                    $department_piedata = User::join('departments', 'users.department_id', '=', 'departments.id')
                        ->select('departments.department_name', DB::raw("count(users.id) as count"))
                        ->groupBy('department_name')
                        ->where('com_id', Auth::user()->com_id)
                        ->get();

                    $designation_chartData = User::join('designations', 'users.designation_id', '=', 'designations.id')
                        ->select('designations.designation_name', DB::raw("count(users.id) as count"))
                        ->groupBy('designation_name')
                        ->where('com_id', Auth::user()->com_id)
                        ->get();
                    $projects = Project::select(DB::raw("count(*) as count"), DB::raw("progress_progress as progress"), DB::raw("project_name as project"), DB::raw("assign_to as assign"))
                        ->groupBy(DB::raw("project"), DB::raw("progress"), DB::raw("assign"))
                        ->where('project_com_id', Auth::user()->com_id)
                        ->get();


                    $payments = PaySlip::select(
                        DB::raw("(sum(pay_slip_net_salary)) as total"),
                        DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
                    )->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])
                        ->orderBy('created_at')
                        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                        ->where('pay_slip_com_id', Auth::user()->com_id)
                        ->where('pay_slip_status', 1)
                        ->get();
                    $users = User::with('userdesignation', 'userdepartment', 'userofficeshift')->where('id', Auth::user()->id)->get(['designation_id', 'department_id', 'office_shift_id']);
                   $employee_counts = User::where('is_active', '1')->where('com_id', Auth::user()->com_id)->count();
                    $attendance_p = Attendance::where('attendance_com_id', Auth::user()->com_id)->where('attendance_date', now()->format('Y-m-d'))->where('check_in_out', 1)->count();
                    $announcement = Announcement::where('announcement_com_id', Auth::user()->com_id)->count();
                    $leave = Leave::where('leaves_company_id', Auth::user()->com_id)->where('leaves_status', 'Pending')->count();
                    $supportticket = SupportTicket::where('support_ticket_com_id', Auth::user()->com_id)->where('support_ticket_status', 'Pending')->count();
                    //$project=Project::where('project_com_id',Auth::user()->com_id)->count();
                    $project = Project::where('project_com_id', Auth::user()->com_id)->where('progress_progress', '=', 100)->count();
                    $salary = PaySlip::where('pay_slip_com_id', Auth::user()->com_id)->sum('pay_slip_net_salary');

                    //return view('back-end.premium.dashboard.premium-admin-dashboard',compact('payments','designation_chartData','department_piedata','project_chartData','employee_counts','attendance_p','announcement','leave','supportticket','project','salary'));
                    return view('back-end.premium.dashboard.premium-admin-dashboard', compact('users', 'payments', 'designation_chartData', 'department_piedata', 'projects', 'employee_counts', 'attendance_p', 'announcement', 'leave', 'supportticket', 'project', 'salary'));
                } else {
                    Session::put('employee_setup_id', Auth::user()->id);

                    $current_year =  date('Y');
                    $startDate = date("Y-m-d");
                    //$endDate = date('Y-m-d',strtotime('+365 days'));
                    $endDate = date('Y') . '-' . '12' . '-' . '31';

                    $previous_start_date = date('Y-m-d', strtotime('-7 days'));
                    $upto_end_date = date('Y-m-d', strtotime('+1 days'));

                    // $sick_leave_count = Leave::
                    //     // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
                    //     // ->select('leave_types.leave_type')
                    //     where('leaves_leave_type_id', '=', '4')
                    //     ->where('leaves_company_id', Auth::user()->com_id)
                    //     ->where('leaves_employee_id', Auth::user()->id)
                    //     ->whereYear('created_at', '=', $current_year)
                    //     ->where('leaves_status', 'Approved')->sum('total_days');
                    // $casual_leave_count = Leave::
                    //     // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
                    //     // ->select('leave_types.leave_type')
                    //     where('leaves_leave_type_id', '=', '5')
                    //     ->where('leaves_company_id', Auth::user()->com_id)
                    //     ->where('leaves_employee_id', Auth::user()->id)
                    //     ->whereYear('created_at', '=', $current_year)
                    //     ->where('leaves_status', 'Approved')->sum('total_days');
                    // $annual_leave_count = Leave::
                    //     // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
                    //     // ->select('leave_types.leave_type')
                    //     where('leaves_leave_type_id', '=', '7')
                    //     ->where('leaves_company_id', Auth::user()->com_id)
                    //     ->where('leaves_employee_id', Auth::user()->id)
                    //     ->whereYear('created_at', '=', $current_year)
                    //     ->where('leaves_status', 'Approved')->sum('total_days');
                    // $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
                    //     ->where('leave_type', "Sick leave")
                    //     ->get();
                    // $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
                    //     ->where('leave_type', "Casual Leave")
                    //     ->get();
                    // $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
                    //     ->where('leave_type', "Annual Leave")
                    //     ->get();


                    $holiday_counts = Holiday::where('holiday_com_id', Auth::user()->com_id)->whereBetween('start_date', [$startDate, $endDate])->count();
                    $award_counts = Award::where('award_employee_id', Auth::user()->id)->count();
                    $pay_slip = PaySlip::where('pay_slip_employee_id', Auth::user()->id)->whereBetween('created_at', [$startDate, $endDate])->count();
                    $users = User::with('userdesignation', 'userdepartment', 'userofficeshift')->where('id', Auth::user()->id)->get(['designation_id', 'profile_photo', 'department_id', 'office_shift_id', 'joining_date']);
                    // return round((strtotime(date('Y-m-d')) - strtotime($users[0]->joining_date)) / (60 * 60 * 24));
                    if (round((strtotime(date('Y-m-d')) - strtotime($users[0]->joining_date)) / (60 * 60 * 24)) >= 365) {
                        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get(['id', 'leave_type']);
                    } else {
                        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->take(2)->get(['id', 'leave_type']);
                    }

                    $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();

                    $arrangement_types = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Arrangement')->get(['variable_method_name']);
                    $announcement = Announcement::where('announcement_com_id', Auth::user()->com_id)->where(function ($query) {
                        $query->where('announcement_department_id', Auth::user()->department_id)
                            ->orWhere('announcement_department_id', 0);
                    })
                        ->whereBetween('created_at', [$previous_start_date, $upto_end_date])->count();

                    $employees = User::where('com_id', '=', Auth::user()->com_id)

                    ->where('is_active', 1)
                    ->where('users_bulk_deleted', 'No')
                    ->whereNotIn('id', [Auth::user()->id])
                    ->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);

                    // return view('back-end.premium.dashboard.employee-dashboard', compact('users', 'employees', 'award_counts', 'announcement', 'holiday_counts', 'leave_types', 'arrangement_types', 'pay_slip', 'sick_leave_count', 'casual_leave_count', 'annual_leave_count', 'Sick_leaves', 'Casual_Leaves', 'Annual_Leaves'));
                    return view('back-end.premium.dashboard.employee-dashboard', get_defined_vars());
                }
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        } else {
            return redirect('/login')->with(Auth::logout());
        }

        return view('back-end.premium.dashboard.premium-admin-dashboard');
    }
}
