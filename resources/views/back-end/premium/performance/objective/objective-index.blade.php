<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GoalType;
use App\Models\GoalTracking;
use App\Models\ObjectiveType;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Region;
use App\Models\Appraisal;
use App\Models\YearlyReview;
use App\Models\PromotionDemotionPoint;
use App\Models\SeatAllocation;
use App\Models\Permission;
use App\Models\OperationalPlan;
use App\Models\ObjectiveDetails;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class PerformanceController extends Controller
{
    // public function goalTypeIndex()
    // {

    //     $performance_sub_module_one_add = "15.1.1";
    //     $performance_sub_module_one_edit = "15.1.2";
    //     $performance_sub_module_one_delete = "15.1.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_one_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_one_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_one_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }

    //     $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.goal-type.goal-type-index', compact('goal_types', 'add_permission', 'edit_permission', 'delete_permission'));
    // }
    // public function goalTrackingIndex()
    // {
    //     $performance_sub_module_two_add = "15.2.1";
    //     $performance_sub_module_two_edit = "15.2.2";
    //     $performance_sub_module_two_delete = "15.2.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }


    //     $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
    //     $goal_trackings = GoalTracking::where('goal_tracking_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.goal-tracking.goal-tracking-index', compact('goal_types', 'goal_trackings', 'add_permission', 'edit_permission', 'delete_permission'));
    // }
    // public function objectiveTypeIndex()
    // {
    //     $performance_sub_module_three_add = "15.3.1";
    //     $performance_sub_module_three_edit = "15.3.2";
    //     $performance_sub_module_three_delete = "15.3.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_three_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_three_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_three_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }

    //     $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.objective-type.objective-type-index', get_defined_vars());
    // }
    // public function objectiveTypeConfigIndex()
    // {
    //     $performance_sub_module_four_add = "15.4.1";
    //     $performance_sub_module_four_edit = "15.4.2";
    //     $performance_sub_module_four_delete = "15.4.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_four_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_four_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_four_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }


    //     $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
    //     $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
    //     $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
    //     $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->orderBy('id', 'DESC')->get();

    //     $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.objective-type-config.objective-type-config-index', get_defined_vars());
    // }
    // public function appraisalIndex()
    // {
    //     $appraisals = Appraisal::where('appraisal_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.appraisal.appraisal-index', compact('appraisals'));
    // }

    // public function indicatorIndex()
    // {
    //     $performance_sub_module_five_add = "15.5.1";
    //     $performance_sub_module_five_edit = "15.5.2";
    //     $performance_sub_module_five_delete = "15.5.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_five_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_five_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_five_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }

    //     $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
    //     $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
    //     // $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
    //     $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
    //     $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();
    //     // $objectivePlans = Objective::where('objective_com_id', Auth::user()->com_id)->get();
    //     // $operationalPlans = OperationalPlan::with('user', 'userdesignation', 'userdepartment')->where('operation_com_id', Auth::user()->com_id)->get();
    //     // dd($operationalPlans);


    //     foreach ($roles as $roles_value) {
    //         if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
    //             $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
    //             $objectivePlans = Objective::where('objective_com_id', Auth::user()->com_id)->get();
    //             $operationalPlans = OperationalPlan::with('user', 'userdesignation', 'userdepartment')->where('operation_com_id', Auth::user()->com_id)->get();
    //             // return view('back-end.premium.performance.indicator.indicator-index', get_defined_vars());
    //         } else {
    //             // $operationalPlans = OperationalPlan::with('user', 'userdesignation', 'userdepartment')->where('operation_com_id', Auth::user()->com_id)->get();
    //             $objectivePlans = Objective::join('users', 'objectives.objective_emp_id', '=', 'users.id')
    //                 ->select('objectives.*', 'users.first_name', 'users.last_name')
    //                 ->where('users.report_to_parent_id', '=', Auth::user()->id)
    //                 ->where('objective_com_id', Auth::user()->com_id)
    //                 // ->where('objective_dept_id', Auth::user()->department_id)
    //                 // ->where('objective_desig_id', Auth::user()->designation_id)
    //                 // ->where('objective_emp_id', Auth::user()->id)
    //                 ->get();
    //             $operationalPlans = OperationalPlan::join('users', 'operational_plans.operation_emp_id', '=', 'users.id')
    //                 ->select('operational_plans.*', 'users.first_name', 'users.last_name')
    //                 ->where('users.report_to_parent_id', '=', Auth::user()->id)
    //                 ->where('operation_com_id', Auth::user()->com_id)
    //                 // ->where('objective_dept_id', Auth::user()->department_id)
    //                 // ->where('objective_desig_id', Auth::user()->designation_id)
    //                 // ->where('objective_emp_id', Auth::user()->id)
    //                 ->get();
    //             $departments = Department::join('users', 'departments.id', '=', 'users.department_id')
    //                 ->select('departments.*', 'departments.department_name')
    //                 ->where('users.report_to_parent_id', '=', Auth::user()->id)
    //                 ->where('department_com_id', Auth::user()->com_id)
    //                 // ->where('objective_dept_id', Auth::user()->department_id)
    //                 // ->where('objective_desig_id', Auth::user()->designation_id)
    //                 // ->where('objective_emp_id', Auth::user()->id)
    //                 ->get();
    //         }
    //         return view('back-end.premium.performance.indicator.indicator-index', get_defined_vars());
    //     }
    // }
    // public function yearlyReviewIndex()
    // {
    //     $performance_sub_module_six_add = "15.6.1";
    //     $performance_sub_module_six_edit = "15.6.2";
    //     $performance_sub_module_six_delete = "15.6.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_six_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_six_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_six_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }
    //     $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.yearly-review.yearly-review-index', compact('yearly_reviews', 'add_permission', 'edit_permission', 'delete_permission'));
    // }

    // public function promotionDemotionPointIndex()
    // {
    //     $performance_sub_module_seven_add = "15.7.1";
    //     $performance_sub_module_seven_edit = "15.7.2";
    //     $performance_sub_module_seven_delete = "15.7.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_seven_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_seven_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_seven_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }

    //     $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.promotion-demotion.promotion-demotion-index', compact('promotion_demotion_points', 'add_permission', 'edit_permission', 'delete_permission'));
    // }
    // public function seatsAllocationIndex()
    // {
    //     $performance_sub_module_eight_add = "15.8.1";
    //     $performance_sub_module_eight_edit = "15.8.2";
    //     $performance_sub_module_eight_delete = "15.8.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_eight_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_eight_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_eight_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }

    //     $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
    //     $seat_allocations = SeatAllocation::where('seat_allocation_com_id', Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.seat-allocation.seat-allocation-index', get_defined_vars());
    // }

    // public function performanceFormIndex()
    // {
    //     $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', Auth::user()->designation_id)->get();
    //     $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();

    //     $users = User::where('com_id', '=', Auth::user()->com_id)->where('id', '=', Auth::user()->id)->get('id');
    //     foreach ($users as $user) {
    //         $us = $user->id;
    //     }

    //     if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
    //         $objectives = Objective::with('userdepartmentfromobjective', 'userdesignationfromobjective', 'userfromobjective')->where('objective_com_id', Auth::user()->com_id)->get();
    //     } else {
    //         $objectives = Objective::with('userdepartmentfromobjective', 'userdesignationfromobjective', 'userfromobjective')->where('objective_com_id', Auth::user()->com_id)->where('objective_emp_id', $us)->get();
    //     }
    //     //   @if(User::where('com_id','=',Auth::user()->com_id)->where('report_to_parent_id',$value->objective_emp_id)->exists())
    //     return view('back-end.premium.performance.performance-form.performance-form-index', get_defined_vars());
    // }

    // public function performanceFormIndex1($id)
    // {
    //     $objectiveTypeConfig = ObjectiveTypeConfig::with('userobjectivetypefromobjectiveconfig')->where('obj_config_emp_id', $id)->get();

    //     // $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id',Auth::user()->com_id)->where('obj_config_desig_id',Auth::user()->designation_id)->get();
    //     // $yearly_reviews = YearlyReview::where('yearly_review_com_id',Auth::user()->com_id)->get();
    //     return view('back-end.premium.performance.performance-form.performance-form-type', get_defined_vars());
    // }

    // public function supervisorMarkingIndex()
    // {
    //     $employees = User::where('com_id', Auth::user()->com_id)->where('report_to_parent_id', Auth::user()->id)->get();
    //     return view('back-end.premium.performance.supervisor-marking.supervisor-marking-index', compact('employees'));
    // }

    // public function supervisorMarkGivingIndex(Request $request)
    // {

    //     // echo $request->em_id;
    //     // exit;

    //     if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

    //         $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
    //         foreach ($employees as $employees_value) {
    //             $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
    //         }
    //     }

    //     $em_id = $request->em_id;
    //     $em_designation_id = $employees_value->designation_id;
    //     $message = '';

    //     return view(
    //         'back-end.premium.performance.supervisor-mark-giving.supervisor-mark-giving-index',
    //         compact(
    //             'message',
    //             'em_id',
    //             'em_designation_id',
    //             'employees',
    //             'objective_type_configs'
    //         )
    //     );
    // }
    // public function employeePerformanceIndex()
    // {
    //     $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
    //     $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
    //     $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
    //     $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
    //     $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();


    //     foreach ($roles as $roles_value) {
    //         if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
    //             $objectives = Objective::where('objective_com_id', Session::get('employee_setup_id'))->get();
    //             return view('back-end.premium.user-settings.performance.objective', get_defined_vars());
    //         } else {
    //             $objectives = Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_dept_id', Auth::user()->department_id)->where('objective_desig_id', Auth::user()->designation_id)->where('objective_emp_id', Session::get('employee_setup_id'))->get();
    //             return view('back-end.premium.user-settings.performance.objective', get_defined_vars());
    //         }
    //     }
    // }
    // public function eligiblePdEmployeeIndex()
    // {
    //     $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
    //     //$objectives = Objective::where('objective_com_id',Auth::user()->com_id)->get();
    //     $users = DB::table('users')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'department_id', 'designation_id']);
    //     return view('back-end.premium.performance.eligible-pd-employee.eligible-pd-employee-index', compact('objective_type_configs', 'users'));
    // }

    // public function annualIncrementIndex()
    // {
    //     $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
    //     //$objectives = Objective::where('objective_com_id',Auth::user()->com_id)->get();
    //     $users = DB::table('users')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'department_id', 'designation_id']);
    //     return view('back-end.premium.performance.annual-increment.annual-increment-index', compact('objective_type_configs', 'users'));
    // }

    // public function keyWiseGoalTrackingIndex($slug)
    // {

    //     $performance_sub_module_two_add = "15.2.1";
    //     $performance_sub_module_two_edit = "15.2.2";
    //     $performance_sub_module_two_delete = "15.2.3";

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_add . '"]\')')->exists()) {
    //         $add_permission = "Yes";
    //     } else {
    //         $add_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_edit . '"]\')')->exists()) {
    //         $edit_permission = "Yes";
    //     } else {
    //         $edit_permission = "No";
    //     }

    //     if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_delete . '"]\')')->exists()) {
    //         $delete_permission = "Yes";
    //     } else {
    //         $delete_permission = "No";
    //     }


    //     $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
    //     if (Objective::where('objective_slug', $slug)->exists()) {
    //         $objectives = Objective::where('objective_slug', $slug)->get();
    //         foreach ($objectives as $objectives_value) {
    //             $goal_trackings = GoalTracking::where('goal_tracking_key', $objectives_value->objective_gl_trkng_key)->get();
    //         }
    //     } else {
    //         $goal_trackings = [];
    //     }

    //     return view('back-end.premium.performance.goal-tracking.goal-tracking-index', compact('goal_types', 'goal_trackings', 'add_permission', 'edit_permission', 'delete_permission'));
    // }





    // public function addOperationalForm(Request $request)
    // {
    //     $operationalPlanInfo = $request->development_name;

    //     $allDetails = array();
    //     foreach ($operationalPlanInfo as $key => $value) :
    //         $operationalPlan = array();
    //         $operationalPlan['operation_com_id'] = Auth::user()->com_id;
    //         $operationalPlan['operation_dept_id'] = $request->operation_dept_id;
    //         $operationalPlan['operation_desi_id'] = $request->operation_desi_id;
    //         $operationalPlan['operation_emp_id'] = $request->operation_emp_id;
    //         $operationalPlan['development_name'] = $request->development_name[$key];
    //         $operationalPlan['meassure_of_success'] = $request->meassure_of_success[$key];
    //         $operationalPlan['action_taken'] = $request->action_taken[$key];
    //         array_push($allDetails, $operationalPlan);
    //     endforeach;
    //     OperationalPlan::insert($allDetails);
    //     return back()->with('message', 'Updated Successfully');
    // }


    // public function addObjectiveForm(Request $request)
    // {

    //     $operationalPlan = new Objective;
    //     $operationalPlan->objective_com_id = Auth::user()->com_id;
    //     $operationalPlan->objective_dept_id  = $request->objective_dept_id;
    //     $operationalPlan->objective_desig_id  = $request->objective_desig_id;
    //     $operationalPlan->objective_emp_id   = $request->objective_emp_id;
    //     $operationalPlan->save();
    //     if ($operationalPlan->id) {

    //         $this->addObjectiveFormDetails($operationalPlan->id, $request);
    //     }
    //     return back()->with('message', 'Added Successfully');
    // }

    // public function addObjectiveFormDetails($masterId, $request)
    // {
    //     $objective_name = $request->objective_name;
    //     $allDetails = array();
    //     foreach ($objective_name as $key => $value) :
    //         $objectivePlan = array();
    //         $objectivePlan['objective_id'] = $masterId;
    //         $objectivePlan['obj_detail_com_id'] = Auth::user()->com_id;
    //         $objectivePlan['objective_obj_type_id'] = $request->obj_config_obj_typ_id;
    //         $objectivePlan['obj_config_percent'] = $request->obj_config_percent;
    //         $objectivePlan['obj_config_target_point'] = $request->obj_config_target_point;
    //         $objectivePlan['objective_name'] = $request->objective_name[$key];
    //         $objectivePlan['objective_success'] = $request->objective_success[$key];
    //         array_push($allDetails, $objectivePlan);
    //     endforeach;
    //     // return $allDetails;
    //     ObjectiveDetails::insert($allDetails);
    //     return back()->with('message', 'Added Successfully');
    // }

    // public function detailsObjective($id)
    // {
    //     $detailsObjective = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
    //         ->where('objective_id', $id)
    //         ->where('obj_detail_com_id', Auth::user()->com_id)
    //         ->get();

    //     $userName = Objective::with(['userfromobjective' => function ($q) {
    //         $q->select('id', 'first_name', 'last_name');
    //     }])->where('id', $id)
    //         ->where('objective_com_id', Auth::user()->com_id)
    //         ->first();
    //     return view('back-end.premium.performance.indicator.details-indicator', get_defined_vars());
    // }

    // public function updateObjective(Request $request, $id)
    // {
    //     return $request->all();
    // }
    // public function detailsOperation($id)
    // {
    //     return 'opsss';
    // }


    // public function employeePerformanceMarking($id)
    // {

    //     $objectives = ObjectiveDetails::with('objectiveDetails','objectiveTypeConfig')->where('objective_id', $id)->where('obj_detail_com_id', Auth::user()->com_id)->get();
    //      $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();


    //     return view('back-end.premium.performance.performance-form.performance-review-form', get_defined_vars());
    // }
}
