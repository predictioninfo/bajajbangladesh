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
use App\Models\DevelopmentPlanDetails;
use App\Models\YearlyReview;
use App\Models\PromotionDemotionPoint;
use App\Models\SeatAllocation;
use App\Models\Permission;
use App\Models\DevelopmentPlan;
use App\Models\ObjectiveDetails;
use App\Models\Role;
use App\Models\ValuePoint;
use App\Models\ValueType;
use App\Models\valueTypeConfig;
use App\Models\valueTypeConfigDetail;
use App\Models\ValueTypeDetail;
use App\Models\ObjectivePointConfig;
use App\Models\IncrementConfig;
use App\Models\SalaryHistory;
use App\Models\Notification;
use App\Models\Company;

use Illuminate\Http\Request;
use Mail;
use Auth;
use DB;
use Session;
use PDF;

class PerformanceController extends Controller
{




    public function performanceValueConfigure()
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
        $value_type_details = ValueTypeDetail::where('value_type_detail_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.value.performance-value-configure', get_defined_vars());
    }



    public function performanceValueTypeConfigure()
    {
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {
            $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
            $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
            $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
            foreach ($variable_types as $variable_type) {
                $valuetypeid = $variable_type->id;
            }
            $value_type_configs = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->get();
        } else {
            $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
            $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
            $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
            foreach ($variable_types as $variable_type) {
                $valuetypeid = $variable_type->id;
            }
            $value_type_configs = valueTypeConfig::join('users', 'value_type_configs.value_type_emp_id', '=', 'users.id')
                ->select('value_type_configs.*', 'users.report_to_parent_id')
                ->where('users.report_to_parent_id', Auth::user()->id)
                ->where('value_type_config_com_id', '=', Auth::user()->com_id)
                ->get();

        }
        $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.value.performance-value-type-configure', get_defined_vars());
    }


    public function performanceValueTypeDetail()
    {
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
        $value_type_configs = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->get();
        $value_type_configs = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)->get();
        $value_type_details = ValueTypeDetail::where('value_type_detail_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.performance.value.performance_value_type_details', get_defined_vars());
    }




    public function indicatorIndex()
    {
        $performance_sub_module_five_add = "15.3.1";
        $performance_sub_module_five_edit = "15.3.2";
        $performance_sub_module_five_delete = "15.3.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_five_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_five_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_five_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->first();
        $objectiveTypeConfigs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();

      
            if ($roles->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
                $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
                $objectivePlans = Objective::where('objective_com_id', Auth::user()->com_id)->get();
                $developmentPlans = DevelopmentPlan::with('user', 'userdesignation', 'userdepartment')->where('development_com_id', Auth::user()->com_id)->get();
            } else {
                $objectivePlans = Objective::join('users', 'objectives.objective_emp_id', '=', 'users.id')
                    ->select('objectives.*', 'users.first_name', 'users.last_name')
                    ->where('users.report_to_parent_id', '=', Auth::user()->id)
                    ->where('objective_com_id', Auth::user()->com_id)
                    ->get();
                $developmentPlans = DevelopmentPlan::join('users', 'development_plans.development_emp_id', '=', 'users.id')
                    ->select('development_plans.*', 'users.first_name', 'users.last_name')
                    ->where('users.report_to_parent_id', '=', Auth::user()->id)
                    ->where('development_com_id', Auth::user()->com_id)
                    ->get();
                $departments = Department::join('users', 'departments.id', '=', 'users.department_id')
                    ->select('departments.*', 'departments.department_name')
                     ->where('users.report_to_parent_id', '=', Auth::user()->id)
                    ->where('department_com_id', Auth::user()->com_id)
                    ->distinct()
                    ->get();
               
            }
            $employee_list = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)
                ->where('users_bulk_deleted', 'No')
                ->whereNull('company_profile')
                ->get();
            return view('back-end.premium.performance.indicator.indicator-index', get_defined_vars());
       
    }


    public function employeePerformanceResult()
    {

        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->groupBy('objective_id')
            ->avg('rating');

        $employee_list = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->get();
        $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.result.employee-result', get_defined_vars());
    }

    public function annualIncrementIndex()
    {
        $employee_list = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)
        ->where('users_bulk_deleted', 'No')
        ->whereNull('company_profile')
        ->get();
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();

        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
        $objectives = Objective::where('objective_com_id', Auth::user()->com_id)->whereYear('updated_at', date('Y'))->get();
        $users = DB::table('users')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'department_id', 'designation_id']);
        $increment_configs = IncrementConfig::where('increment_config_com_id', Auth::user()->com_id)->get();
        $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->get();
        $salary_histories = SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_increment_status', 1)->get();
        return view('back-end.premium.performance.annual-increment.annual-increment', get_defined_vars());
    }

    public function employeePerformanceResultsearch(Request $request)
    {
        $year = date("Y", strtotime($request->year));
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->where('id', $request->employee_id)
            ->get();
        $employee_list = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->get();
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->groupBy('objective_id')
            ->avg('rating');
        $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.performance.result.employee-result', get_defined_vars());
    }

    public function seatsAllocationIndex()
    {
        $performance_sub_module_eight_add = "15.8.1";
        $performance_sub_module_eight_edit = "15.8.2";
        $performance_sub_module_eight_delete = "15.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_eight_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_eight_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_eight_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $seat_allocations = SeatAllocation::where('seat_allocation_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.seat-allocation.seat-allocation-index', get_defined_vars());
    }

    public function performanceFormIndex()
    {
        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', Auth::user()->designation_id)->get();
        $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $objectives = Objective::with('userdepartmentfromobjective', 'userdesignationfromobjective', 'userfromobjective')->where('objective_com_id', Auth::user()->com_id)->get();
        } else {
            $objectives = Objective::join('users', 'objectives.objective_emp_id', '=', 'users.id')
                ->select('objectives.id', 'objectives.created_at', 'objectives.objective_dept_id', 'objectives.objective_desig_id', 'objectives.objective_emp_id')
                ->where('objective_com_id', Auth::user()->com_id)
                ->where('users.report_to_parent_id', Auth::user()->id)
                ->get();
        }
        return view('back-end.premium.performance.performance-form.performance-form-index', get_defined_vars());
    }


    public function supervisorMarkingIndex()
    {
        $employees = User::where('com_id', Auth::user()->com_id)->where('report_to_parent_id', Auth::user()->id)->get();
        return view('back-end.premium.performance.supervisor-marking.supervisor-marking-index', compact('employees'));
    }


    public function supervisorMarkGivingIndex(Request $request)
    {

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

            $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
            foreach ($employees as $employees_value) {
                $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
            }
        }

        $em_id = $request->em_id;
        $em_designation_id = $employees_value->designation_id;
        $message = '';

        return view(
            'back-end.premium.performance.supervisor-mark-giving.supervisor-mark-giving-index',
            compact(
                'message',
                'em_id',
                'em_designation_id',
                'employees',
                'objective_type_configs'
            )
        );
    }

    public function employeePerformanceIndex()
    {
        $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();


        foreach ($roles as $roles_value) {
            if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
                $objectives = Objective::where('objective_com_id', Session::get('employee_setup_id'))->get();
                return view('back-end.premium.user-settings.performance.objective', get_defined_vars());
            } else {
                $objectives = Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_dept_id', Auth::user()->department_id)->where('objective_desig_id', Auth::user()->designation_id)->where('objective_emp_id', Session::get('employee_setup_id'))->get();
                return view('back-end.premium.user-settings.performance.objective', get_defined_vars());
            }
        }
    }
    public function eligiblePdEmployeeIndex()
    {
        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
        $users = DB::table('users')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'department_id', 'designation_id']);
        return view('back-end.premium.performance.eligible-pd-employee.eligible-pd-employee-index', get_defined_vars());
    }




    public function annualApproveIncrementIndex()
    {
        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
        $objectives = Objective::join('salary_histories', 'salary_histories.salary_history_emp_id', '=', 'objectives.objective_emp_id')
            ->join('users', 'users.id', '=', 'objectives.objective_emp_id')
            ->join('departments', 'departments.id', '=', 'objectives.objective_dept_id')
            ->join('designations', 'designations.id', '=', 'objectives.objective_desig_id')
            ->select('salary_histories.salary_history_previous_gross', 'salary_histories.salary_history_gross', 'salary_histories.salary_history_previous_per_hour_rate', 'salary_histories.salary_history_per_hour_rate', 'salary_histories.salary_history_increment_status', 'salary_histories.salary_history_approval_status', 'salary_histories.salary_history_increment_date', 'salary_histories.updated_at', 'users.gross_salary', 'users.per_hour_rate', 'users.salary_type', 'users.company_assigned_id', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'objectives.objective_emp_id', 'salary_histories.id', 'users.salary_type', 'salary_histories.salary_historiy_increment_salary')
            ->where('objective_com_id', Auth::user()->com_id)->get();
        $users = DB::table('users')->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'department_id', 'designation_id']);
        $increment_configs = IncrementConfig::where('increment_config_com_id', Auth::user()->com_id)->orderBy('id', 'DESC')->get();
        $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->get();
        $salary_histories = SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_increment_status', 1)->get();
        return view('back-end.premium.performance.annual-increment.approval-increment', get_defined_vars());
    }


    public function keyWiseGoalTrackingIndex($slug)
    {
        $performance_sub_module_two_add = "15.2.1";
        $performance_sub_module_two_edit = "15.2.2";
        $performance_sub_module_two_delete = "15.2.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_two_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
        if (Objective::where('objective_slug', $slug)->exists()) {
            $objectives = Objective::where('objective_slug', $slug)->get();
            foreach ($objectives as $objectives_value) {
                $goal_trackings = GoalTracking::where('goal_tracking_key', $objectives_value->objective_gl_trkng_key)->get();
            }
        } else {
            $goal_trackings = [];
        }

        return view('back-end.premium.performance.goal-tracking.goal-tracking-index', get_defined_vars());
    }


    public function addDevelopmentForm(Request $request)
    {
        if (DevelopmentPlan::where('development_com_id', Auth::user()->com_id)->where('development_emp_id', $request->development_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            $developmentPlan = DevelopmentPlan::where('development_com_id', Auth::user()->com_id)->where('development_emp_id', $request->development_emp_id)->whereYear('created_at', date("Y"))->first('id');

            if ($developmentPlan->id) {
                $this->addDevelopmentFormFormDetails($developmentPlan->id, $request);
            }
            return back();
        } else {
            $developmentPlan = new DevelopmentPlan;
            $developmentPlan->development_com_id = Auth::user()->com_id;
            $developmentPlan->development_dept_id  = $request->development_dept_id;
            $developmentPlan->development_desig_id  = $request->development_desig_id;
            $developmentPlan->development_emp_id   = $request->development_emp_id;
            $developmentPlan->save();

            if ($developmentPlan->id) {
                $this->addDevelopmentFormFormDetails($developmentPlan->id, $request);
            }
            return back()->with('message', 'Added Successfully');
        }
    }

    public function addDevelopmentFormFormDetails($masterId, $request)
    {
        if (DevelopmentPlanDetails::where('development_details_com_id', Auth::user()->com_id)->where('development_details__id', $masterId)->whereYear('created_at', date("Y"))->exists()) {
            return back()->with('message', 'Already Added Development Plan!! Please Updated Development Plan!');
        } else {
            DevelopmentPlanDetails::where('development_details__id', $masterId)->delete();
            $developmentlPlanInfo = $request->development_name;
            $allDetails = array();

            foreach ($developmentlPlanInfo as $key => $value) :
                $developmentlPlanDetails = array();
                $developmentlPlanDetails['development_details__id'] = $masterId;
                $developmentlPlanDetails['development_details_com_id'] = Auth::user()->com_id;
                $developmentlPlanDetails['development_name'] = $request->development_name[$key];
                $developmentlPlanDetails['development_meassure_of_success'] = $request->meassure_of_success[$key];
                $developmentlPlanDetails['development_action_taken'] = $request->action_taken[$key];
                array_push($allDetails, $developmentlPlanDetails);
            endforeach;
            DevelopmentPlanDetails::insert($allDetails);
            return back()->with('message', 'Added Successfully');
        }
    }


    public function updateDevelopmentForm(Request $request, $id)

    {
        DB::beginTransaction();
        try {
            $developmentPlan = DevelopmentPlan::findOrFail($id);

            $developmentPlan->development_com_id = Auth::user()->com_id;
            $developmentPlan->development_dept_id  = $request->development_dept_id;
            $developmentPlan->development_desig_id  = $request->development_desig_id;
            $developmentPlan->development_emp_id   = $request->development_emp_id;
            $developmentPlan->status   = $request->status;
            $developmentPlan->save();
            if ($developmentPlan->id) {
                $this->updateDevelopmentFormFormDetails($developmentPlan->id, $request);
            }
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function updateDevelopmentFormFormDetails($masterId, $request)
    {
        DevelopmentPlanDetails::where('development_details__id', $masterId)->delete();
        $developmentlPlanInfo = $request->development_name;
        $allDetails = array();

        foreach ($developmentlPlanInfo as $key => $value) :
            $developmentlPlanDetails = array();
            $developmentlPlanDetails['development_details__id'] = $masterId;
            $developmentlPlanDetails['development_details_com_id'] = Auth::user()->com_id;
            $developmentlPlanDetails['development_name'] = $request->development_name[$key];
            $developmentlPlanDetails['development_meassure_of_success'] = $request->meassure_of_success[$key];
            $developmentlPlanDetails['development_action_taken'] = $request->action_taken[$key];
            array_push($allDetails, $developmentlPlanDetails);
        endforeach;
        DevelopmentPlanDetails::insert($allDetails);
        return back()->with('message', 'Updated Successfully');
    }
    public function supervisorReviewDevelopment(Request $request, $id)
    {
        DB::beginTransaction();
        try {


            $developmentPlan = DevelopmentPlan::findOrFail($id);
            $developmentPlan->development_supervisor_review = $request->development_supervisor_review;
            $developmentPlan->status = "Pending";
            $developmentPlan->save();


            $notification = new Notification();
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Development-Plan";
            $notification->notification_title = "Supervisor Review For Development Plan";
            $notification->notification_from  = Auth::user()->id;
            $notification->notification_to = $request->development_emp_id;
            $notification->notification_status = "Unseen";
            $notification->save();

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

            $users = User::where('id', '=', $request->development_emp_id)->get(['email', 'first_name', 'last_name']);

            foreach ($users as $users) {

                $data["email"] = $users->email;
                $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                $data["subject"] = "Development Plan";
                $receiver_name = array(
                    'pay_slip_net_salary' => $data["request_receiver_name"],
                );
                Mail::send('back-end.premium.emails.development-review', [
                    'receiver_name' => $receiver_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_receiver_name"])
                        ->subject($data["subject"]);
                });
            }
            DB::commit();
            // all good
            return back()->with('message', 'Supervisor Review Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }


    public function detailsDevelopment($id)
    {
        $detailsDevelopment = DevelopmentPlanDetails::where('development_details__id', $id)
            ->where('development_details_com_id', Auth::user()->com_id)
            ->get();
        $userName = DevelopmentPlan::with(['user' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('development_com_id', Auth::user()->com_id)
            ->first();
        $development_review = DevelopmentPlan::where('id', $id)
            ->where('development_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.performance.indicator.details-development-plan', get_defined_vars());
    }

    public function detailsDevelopmentPlansView($id)
    {

        $employee_info = DevelopmentPlanDetails::where('development_details__id', $id)
        ->with(['developmentPlans' => function ($query) {
            $query->with(['userdesignation', 'userdepartment', 'user' => function ($query) {
                $query->with('emoloyeedetail');
            }]);
        }])
        ->first();

        $development_employee = DevelopmentPlan::where('id', $id)
        ->first('development_emp_id');

        $detailsDevelopment = DevelopmentPlan::where('development_emp_id', $development_employee->development_emp_id)
        ->with('developmentPlanDetails')
        ->first();

        return view('back-end.premium.performance.indicator.details-development-plan-views', get_defined_vars());
    }

    public function employeeDetailsDevelopmentPlansView($id)
    {

        $employee_info = DevelopmentPlanDetails::where('development_details__id', $id)
        ->with(['developmentPlans' => function ($query) {
            $query->with(['userdesignation', 'userdepartment', 'user' => function ($query) {
                $query->with('emoloyeedetail');
            }]);
        }])
        ->first();

        $development_employee = DevelopmentPlan::where('id', $id)
        ->first('development_emp_id');

        $detailsDevelopment = DevelopmentPlan::where('development_emp_id', $development_employee->development_emp_id)
        ->with('developmentPlanDetails')
        ->first();

        return view('back-end.premium.user-settings.performance.employee-details-development-plan-views', get_defined_vars());
    }

    public function DetailsDevelopmentPdf($id)
    {
        $detailsDevelopment = DevelopmentPlanDetails::where('development_details__id', $id)
            ->where('development_details_com_id', Auth::user()->com_id)
            ->get();
        $userName = DevelopmentPlan::with(['user' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('development_com_id', Auth::user()->com_id)
            ->first();
        $fileName = $userName->user->first_name . "'s " . "Development Plans" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'P',
        ]);
        $html = \View::make('back-end.premium.performance.indicator.development-plan-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }

    public function employeeDetailsDevelopment($id)
    {
        $detailsDevelopment = DevelopmentPlanDetails::where('development_details__id', $id)
            ->where('development_details_com_id', Auth::user()->com_id)
            ->get();
        $userName = DevelopmentPlan::with(['user' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('development_com_id', Auth::user()->com_id)
            ->first();
        $development_review = DevelopmentPlan::where('id', $id)
            ->where('development_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.user-settings.performance.details-development-plan', get_defined_vars());
    }

    public function addObjectiveForm(Request $request)
    {

        if (Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_emp_id', $request->objective_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            $objectivePlan = Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_emp_id', $request->objective_emp_id)->whereYear('created_at', date("Y"))->first('id');

            if ($objectivePlan->id) {
                $this->addObjectiveFormDetails($objectivePlan->id, $request, $request->objective_dept_id, $request->objective_desig_id, $request->objective_emp_id);
            }
            return back();
        } else {
            $objectivePlan = new Objective;
            $objectivePlan->objective_com_id = Auth::user()->com_id;
            $objectivePlan->objective_dept_id  = $request->objective_dept_id;
            $objectivePlan->objective_desig_id  = $request->objective_desig_id;
            $objectivePlan->objective_emp_id   = $request->objective_emp_id;
            $objectivePlan->objective_date = date("Y-m-d");
            $objectivePlan->save();
            if ($objectivePlan->id) {
                $this->addObjectiveFormDetails($objectivePlan->id, $request, $request->objective_dept_id, $request->objective_desig_id, $request->objective_emp_id);
            }
            return back()->with('message', 'Added Successfully');
        }
    }

    public function addObjectiveFormDetails($masterId, $request, $departID, $desigID, $employeeID)
    {
        if (ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)->where('objective_id', $masterId)->whereYear('created_at', date("Y"))->exists()) {
            return back()->with('message', 'Already Added objectives in this Year');
        } else {
            ObjectiveDetails::where('objective_id', $masterId)->delete();

            $objective_name = $request->objective_name;
            $allDetails = array();
            foreach ($objective_name as $key => $value) :
                $objectivePlan = array();
                $objectivePlan['objective_id'] = $masterId;
                $objectivePlan['obj_detail_com_id'] = Auth::user()->com_id;
                $objectivePlan['objective_obj_type_id'] = $request->obj_config_obj_typ_id[$key];
                $objectivePlan['objective_name'] = $request->objective_name[$key];
                $objectivePlan['objective_success'] = $request->objective_success[$key];
                $objectivePlan['objective_dept_id'] = $departID;
                $objectivePlan['objective_desig_id'] = $desigID;
                $objectivePlan['objective_emp_id'] = $employeeID;
                $objectivePlan['objective_date'] =  date("Y-m-d");
                array_push($allDetails, $objectivePlan);
            endforeach;
            ObjectiveDetails::insert($allDetails);

            return back()->with('message', 'Added Successfully');
        }
    }

    public function detailsObjective($id)
    {
        $detailsObjective = ObjectiveDetails::select("*")->with([
            'objectiveTypeConfig' => function ($q) {
                $q->select('*');
            }, 'objectiveTypeConfig.userobjectivetypefromobjectiveconfig' => function ($q) {
                $q->select('*');
            }
        ])->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)
            ->get();
        $userName = Objective::with(['userfromobjective' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('objective_com_id', Auth::user()->com_id)
            ->first();
        $review = Objective::where('id', $id)
            ->where('objective_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.performance.indicator.details-indicator', get_defined_vars());
    }

    public function employeeDetailsObjectiveViews($id)
    {
        $employee_info = ObjectiveDetails::where('objective_id', $id)
        ->with(['objectiveReport' => function ($query) {
            $query->with(['userdesignationfromobjective', 'userfromobjective' => function ($query) {
                $query->with('qualification',  'emoloyeedetail');
            }]);
        }])
        ->first();

        $objectiveDetails = ObjectiveDetails::where('objective_id', $id)
        ->with(['objectiveReport' => function ($query) {
            $query->with('userfromobjective');
        }])->get();

        return view('back-end.premium.performance.indicator.show-objective-details', get_defined_vars());
    }


    public function detailsEmployeeObjectiveViews($id)
    {
        $employee_info = ObjectiveDetails::where('objective_id', $id)
        ->with(['objectiveReport' => function ($query) {
            $query->with(['userdesignationfromobjective', 'userfromobjective' => function ($query) {
                $query->with('qualification',  'emoloyeedetail');
            }]);
        }])
        ->first();

        $objectiveDetails = ObjectiveDetails::where('objective_id', $id)
        ->with(['objectiveReport' => function ($query) {
            $query->with('userfromobjective');
        }])->get();

        return view('back-end.premium.user-settings.performance.show-employee-objective-details', get_defined_vars());
    }


    public function DetailsObjectivePdf($id)
    {
        $detailsObjective = ObjectiveDetails::select("*")->with([
            'objectiveTypeConfig' => function ($q) {
                $q->select('*');
            }, 'objectiveTypeConfig.userobjectivetypefromobjectiveconfig' => function ($q) {
                $q->select('*');
            }
        ])->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)
            ->get();
        $userName = Objective::with(['userfromobjective' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('objective_com_id', Auth::user()->com_id)
            ->first();
        $fileName = $userName->userfromobjective->first_name . "'s " . "Objective Plans" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $html = \View::make('back-end.premium.performance.indicator.objective-plans-pdf', get_defined_vars());
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }

    public function employeeDetailsObjective($id)
    {
        $detailsObjective = ObjectiveDetails::select("*")->with([
            'objectiveTypeConfig' => function ($q) {
                $q->select('*');
            }, 'objectiveTypeConfig.userobjectivetypefromobjectiveconfig' => function ($q) {
                $q->select('*');
            }
        ])->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)
            ->get();
        $userName = Objective::with(['userfromobjective' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('objective_com_id', Auth::user()->com_id)
            ->first();
        $review = Objective::where('id', $id)
            ->where('objective_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.user-settings.performance.details-objective-plan', get_defined_vars());
    }



    public function updateObjective(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $objectivePlan = Objective::findOrFail($id);

            $objectivePlan->objective_com_id = Auth::user()->com_id;
            $objectivePlan->objective_dept_id  = $request->objective_dept_id;
            $objectivePlan->objective_desig_id  = $request->objective_desig_id;
            $objectivePlan->objective_emp_id   = $request->objective_emp_id;
            $objectivePlan->objective_date = date("Y-m-d");
            $objectivePlan->status   = $request->status;
            $objectivePlan->save();

            if ($request->status) {
                $notification = new Notification();
                // $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Objective-Review-Comments";
                $notification->notification_title = "Objective-Review-Comments";
                $notification->notification_to = $request->objective_emp_id;
                $notification->notification_status = "Unseen";
                $notification->save();
                $users = User::where('id', '=', $request->objective_emp_id)->get(['email', 'first_name', 'last_name']);
                foreach ($users as $users) {

                    $data["email"] = $users->email;
                    $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                    $data["subject"] = "Objective Review Comments";
                    $receiver_name = array(
                        'pay_slip_net_salary' => $data["request_receiver_name"],
                    );
                    Mail::send('back-end.premium.emails.objective-approve', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"]);
                    });
                }
            }
            if ($objectivePlan->id) {
                $this->updateObjectiveFormDetails($objectivePlan->id, $request);
            }
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function updateObjectiveFormDetails($masterId, $request)
    {
        ObjectiveDetails::where('objective_id', $masterId)->delete();

        $objective_name = $request->objective_name;
        $allDetails = array();
        foreach ($objective_name as $key => $value) :
            $objectivePlan = array();
            $objectivePlan['objective_id'] = $masterId;
            $objectivePlan['obj_detail_com_id'] = Auth::user()->com_id;
            $objectivePlan['objective_obj_type_id'] = $request->obj_config_obj_typ_id[$key];
            $objectivePlan['objective_name'] = $request->objective_name[$key];
            $objectivePlan['objective_success'] = $request->objective_success[$key];
            array_push($allDetails, $objectivePlan);
        endforeach;
        ObjectiveDetails::insert($allDetails);

        return back()->with('message', 'Added Successfully');
    }

    public function supervisorReviewObjective(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $objectivePlan = Objective::findOrFail($id);
            $objectivePlan->objective_supervisor_review = $request->objective_supervisor_review;
            $objectivePlan->review_status = "Pending";
            $objectivePlan->save();

            $notification = new Notification();
            //$notification->notification_token = $random_key;
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Objective-Review";
            $notification->notification_title = "Supervisor Objective Review";
            $notification->notification_from  = Auth::user()->id;
            $notification->notification_to = $request->objective_emp_id;
            $notification->notification_status = "Unseen";
            $notification->save();

            $users = User::where('id', '=', $request->objective_emp_id)->get(['email', 'first_name', 'last_name']);
            foreach ($users as $users) {
                $data["email"] = $users->email;
                $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                $data["subject"] = "Objective Review";
                $receiver_name = array(
                    'pay_slip_net_salary' => $data["request_receiver_name"],
                );
                Mail::send('back-end.premium.emails.objective-review', [
                    'receiver_name' => $receiver_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_receiver_name"])
                        ->subject($data["subject"]);
                });
            }
            DB::commit();
            // all good
            return back()->with('message', 'Supervisor Review Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }


}
