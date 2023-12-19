<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Objective;
use App\Models\ObjectiveTypeConfig;
use App\Models\PromotionApproval;
use App\Models\Promotion;
use App\Models\SeatAllocation;
use App\Models\Notification;
use App\Models\SalaryIncrement;
use App\Models\SalaryIncrementApproval;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use Mail;
use Session;

class ObjectiveController extends Controller
{
    public function objectiveAdd(Request $request)
    {

        $validated = $request->validate([
            'objective_goal_type_id' => 'required',
            'objective_obj_type_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'employee_id' => 'required',
            'objective_name' => 'required',
            'objective_success' => 'required',
            'goal_tracking_key' => 'required',
            'objective_review_yr' => 'required',
        ]);
        try {
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

            $random_number = rand(100000, 1000000) . generateRandomString();
            $random_key = generateRandomString() . $request->objective_goal_type_id . "-%&0&j" . $random_number;

            if (Objective::where('objective_slug', $random_key)->exists()) {
                return back()->with('message', 'Please try again later');
            }

            if (User::where('com_id', Auth::user()->com_id)->where('id', $request->employee_id)->exists()) {

                $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->employee_id)->get();

                foreach ($employee_details as $employee_details_value) {

                    if (User::where('id', '=', $employee_details_value->report_to_parent_id)->exists()) {
                        $generation_one_details = User::where('id', '=', $employee_details_value->report_to_parent_id)->get('report_to_parent_id');
                        foreach ($generation_one_details as $generation_one_details_value) {
                            $gen_one_id = $employee_details_value->report_to_parent_id;
                            $gen_two_id = $generation_one_details_value->report_to_parent_id;
                        }
                    } else {
                        $gen_one_id = '';
                        $gen_two_id = '';
                    }
                }
            } else {
                $gen_one_id = '';
                $gen_two_id = '';
            }

            $objective = new Objective();
            $objective->objective_com_id = Auth::user()->com_id;
            $objective->objective_goal_type_id = $request->objective_goal_type_id;
            $objective->objective_gl_trkng_key = $request->goal_tracking_key;
            $objective->objective_obj_type_id = $request->objective_obj_type_id;
            $objective->objective_dept_id = $request->department_id;
            $objective->objective_desig_id = $request->designation_id;
            $objective->objective_emp_id = $request->employee_id;
            $objective->objective_fst_sv_id = $gen_one_id;
            $objective->objective_scnd_sv_id = $gen_two_id;
            $objective->objective_name = $request->objective_name;
            $objective->objective_success = $request->objective_success;
            $objective->objective_slug = $random_key;
            $objective->objective_review_yr = $request->objective_review_yr;
            $objective->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function objectiveById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeObjectiveTypeConfigByIds = Objective::where($where)->first();
        return response()->json($employeeObjectiveTypeConfigByIds);
    }

    public function updateObjective(Request $request)
    {

        $validated = $request->validate([
            'objective_goal_type_id' => 'required',
            'objective_obj_type_id' => 'required',
            'edit_department_id' => 'required',
            'edit_designation_id' => 'required',
            'edit_employee_id' => 'required',
            'objective_name' => 'required',
            'objective_success' => 'required',
            'objective_review_yr' => 'required',
        ]);

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->edit_employee_id)->exists()) {

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->edit_employee_id)->get();

            if (User::where('id', '=', $employee_details_value->report_to_parent_id)->exists()) {
                $generation_one_details = User::where('id', '=', $employee_details_value->report_to_parent_id)->get('report_to_parent_id');
                foreach ($generation_one_details as $generation_one_details_value) {
                    $gen_one_id = $employee_details_value->report_to_parent_id;
                    $gen_two_id = $generation_one_details_value->report_to_parent_id;
                }
            } else {
                $gen_one_id = '';
                $gen_two_id = '';
            }
        } else {
            $gen_one_id = '';
            $gen_two_id = '';
        }

        try {
            $objective =  Objective::find($request->id);
            $objective->objective_goal_type_id = $request->objective_goal_type_id;
            $objective->objective_obj_type_id = $request->objective_obj_type_id;
            $objective->objective_dept_id = $request->edit_department_id;
            $objective->objective_desig_id = $request->edit_designation_id;
            $objective->objective_emp_id = $request->edit_employee_id;
            $objective->objective_fst_sv_id = $gen_one_id;
            $objective->objective_scnd_sv_id = $gen_two_id;
            $objective->objective_name = $request->objective_name;
            $objective->objective_success = $request->objective_success;
            $objective->objective_review_yr = $request->objective_review_yr;
            $objective->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function updateEmployeeActionObjective(Request $request)
    {

        // exit;

        $validated = $request->validate([
            'objective_emp_actn' => 'required',
        ]);
        try {
            $objective =  Objective::find($request->id);
            $objective->objective_emp_actn = $request->objective_emp_actn;
            $objective->save();

            ######################## view page code starts #################################
            if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

                $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
                foreach ($employees as $employees_value) {
                    if ($employees_value->designation_id) {
                        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
                        $em_designation_id = $employees_value->designation_id;
                    } else {
                        $objective_type_configs = [];
                        $em_designation_id = '';
                    }
                }
            } else {
                $employees = [];
                $em_designation_id = '';
            }

            $em_id = $request->em_id;
            $message = 'Updated Successfully';

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
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        ######################## view page code ends #################################

        // return back()->with('message','Updated Successfully');
    }

    public function updateSupervisorCommentObjective(Request $request)
    {

        $validated = $request->validate([
            'objective_sprvisr_cmnt' => 'required',
            'objective_dept_id' => 'required',
            'objective_desig_id' => 'required',
            'objective_obj_type_id' => 'required',
        ]);
        try {
            // echo $request->objective_obj_type_id;

            $objective =  Objective::find($request->id);
            $objective->objective_sprvisr_cmnt = $request->objective_sprvisr_cmnt;
            $objective->save();

            ######################## view page code starts #################################
            if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

                $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
                foreach ($employees as $employees_value) {
                    if ($employees_value->designation_id) {
                        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
                        $em_designation_id = $employees_value->designation_id;
                    } else {
                        $objective_type_configs = [];
                        $em_designation_id = '';
                    }
                }
            } else {
                $employees = [];
                $em_designation_id = '';
            }

            $em_id = $request->em_id;
            $message = 'Updated Successfully';

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
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        ######################## view page code ends #################################

        //return back()->with('message','Updated Successfully');
    }

    public function updateSupervisorMarkingObjective(Request $request)
    {

        $validated = $request->validate([
            'objective_sprvisr_mark' => 'required',
            'objective_dept_id' => 'required',
            'objective_desig_id' => 'required',
            'objective_obj_type_id' => 'required',
        ]);

        // echo $request->objective_obj_type_id;

        if (ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->where('obj_config_dept_id', $request->objective_dept_id)
            ->where('obj_config_desig_id', $request->objective_desig_id)
            ->where('obj_config_obj_typ_id', $request->objective_obj_type_id)
            ->exists()
        ) {

            $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
                ->where('obj_config_dept_id', $request->objective_dept_id)
                ->where('obj_config_desig_id', $request->objective_desig_id)
                ->where('obj_config_obj_typ_id', $request->objective_obj_type_id)
                ->get();

            foreach ($objective_type_configs as $objective_type_configs_value) {
                if ($objective_type_configs_value->obj_config_percent <= $request->objective_sprvisr_mark) {

                    ######################## view page code starts #################################
                    if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

                        $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
                        foreach ($employees as $employees_value) {
                            if ($employees_value->designation_id) {
                                $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
                                $em_designation_id = $employees_value->designation_id;
                            } else {
                                $objective_type_configs = [];
                                $em_designation_id = '';
                            }
                        }
                    } else {
                        $employees = [];
                        $em_designation_id = '';
                    }

                    $em_id = $request->em_id;
                    $message = 'Marking should not be over limit';

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
                    ######################## view page code ends #################################

                    // return back()->with('message','Marking should not be over limit');
                }
            }
        } else {

            ######################## view page code starts #################################
            if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

                $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
                foreach ($employees as $employees_value) {
                    if ($employees_value->designation_id) {
                        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
                        $em_designation_id = $employees_value->designation_id;
                    } else {
                        $objective_type_configs = [];
                        $em_designation_id = '';
                    }
                }
            } else {
                $employees = [];
                $em_designation_id = '';
            }

            $em_id = $request->em_id;
            $message = 'Not Configured Properly!!!';

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
            ######################## view page code ends #################################

            //return back()->with('message','Not Configured Properly!!!');
        }

        $objective =  Objective::find($request->id);
        $objective->objective_sprvisr_mark = $request->objective_sprvisr_mark;
        $objective->save();


        ######################## view page code starts #################################
        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->exists()) {

            $employees = User::where('com_id', Auth::user()->com_id)->where('id', $request->em_id)->get();
            foreach ($employees as $employees_value) {
                if ($employees_value->designation_id) {
                    $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->where('obj_config_desig_id', $employees_value->designation_id)->get();
                    $em_designation_id = $employees_value->designation_id;
                } else {
                    $objective_type_configs = [];
                    $em_designation_id = '';
                }
            }
        } else {
            $employees = [];
            $em_designation_id = '';
        }

        $em_id = $request->em_id;
        $message = 'Updated Successfully';

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
        ######################## view page code ends #################################

        //return back()->with('message','Updated Successfully');
    }

    public function firstSupervisorPromotionApproval(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'objective_emp_id' => 'required',
        ]);

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

        $random_key = generateRandomString() . $request->objective_emp_id;
        ############### random key generate code staendsrts###########

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->exists()) {

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->get();

            foreach ($employee_details as $employee_details_value) {

                if ($employee_details_value->report_to_parent_id) {

                    $promotion_approval =  new PromotionApproval();
                    $promotion_approval->prom_aprv_com_id = Auth::user()->com_id;
                    $promotion_approval->prom_aprv_emp_id = $request->objective_emp_id;
                    $promotion_approval->prom_aprv_fst_sv_sts = 'Yes';
                    $promotion_approval->save();

                    $generation_one_details = User::where('id', '=', $employee_details_value->report_to_parent_id)->get(['id', 'report_to_parent_id', 'email']);

                    foreach ($generation_one_details as $generation_one_details_value) {

                        $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->get('email');

                        foreach ($generation_two_details as $generation_two_details_value) {

                            $notification = new Notification();
                            $notification->notification_token = $random_key;
                            $notification->notification_com_id = Auth::user()->com_id;
                            $notification->notification_type = "Promotion Approval";
                            $notification->notification_title = "Employee Promotion Approving Request";
                            $notification->notification_from = $generation_one_details_value->id;
                            $notification->notification_to = $generation_one_details_value->report_to_parent_id;
                            $notification->notification_status = "Unseen";
                            $notification->save();

                            ######## second generation email##########
                            $data["email"] = $generation_two_details_value->email;
                            $data["request_sender_name"] = $employee_details_value->first_name . ' ' . $employee_details_value->last_name;
                            $data["subject"] = "Promotion Approving Request";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.promotion-request', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });

                            ######## second generation email ends##########

                        }
                    }
                } else {
                    return back()->with('message', 'First supervisor not set for this employee!!!');
                }
            }
        } else {
            return back()->with('message', 'This employee not found in the system!!!');
        }

        return back()->with('message', 'Approved Successfully');
    }

    public function secondSupervisorPromotionApproval(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'objective_emp_id' => 'required',
        ]);

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

        $random_key = generateRandomString() . $request->objective_emp_id;
        ############### random key generate code ends here###########

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->exists()) {

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->get();

            foreach ($employee_details as $employee_details_value) {

                $promotion_approval =  new PromotionApproval();
                $promotion_approval->prom_aprv_com_id = Auth::user()->com_id;
                $promotion_approval->prom_aprv_emp_id = $request->objective_emp_id;
                $promotion_approval->prom_aprv_fst_sv_sts = 'Yes';
                $promotion_approval->prom_aprv_scnd_sv_sts = 'Yes';
                $promotion_approval->save();



                $generation_one_details = User::where('id', '=', $employee_details_value->report_to_parent_id)->get(['report_to_parent_id', 'email']);
                foreach ($generation_one_details as $generation_one_details_value) {

                    $notification = new Notification();
                    $notification->notification_token = $random_key;
                    $notification->notification_com_id = Auth::user()->com_id;
                    $notification->notification_type = "Supervisor Approval for Promotion";
                    $notification->notification_title = "Your supervisor also approved the employee to give him/her a promotion";
                    $notification->notification_from = $request->objective_emp_id;
                    $notification->notification_to = $employee_details_value->report_to_parent_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    $data["email"] = $generation_one_details_value->email;
                    $data["request_sender_name"] = $employee_details_value->first_name . ' ' . $employee_details_value->last_name;
                    $data["subject"] = "Promotion Approval";

                    $sender_name = array(
                        'pay_slip_net_salary' => $data["request_sender_name"],
                    );

                    Mail::send('back-end.premium.emails.promotion-approved-by-second-supervisor', [
                        'sender_name' => $sender_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_sender_name"])
                            ->subject($data["subject"]);
                    });
                }
            }
        } else {
            return back()->with('message', 'This employee not found in the system!!!');
        }

        return back()->with('message', 'Approved Successfully');
    }


























    public function firstSupervisorAnnualSalaryIncrementApproval(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'objective_emp_id' => 'required',
        ]);

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

        $random_key = generateRandomString() . $request->objective_emp_id;
        ############### random key generate code staendsrts###########

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->exists()) {

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->get();

            foreach ($employee_details as $employee_details_value) {

                if ($employee_details_value->report_to_parent_id) {

                    $salary_increment_approval =  new SalaryIncrementApproval();
                    $salary_increment_approval->slry_incre_aprv_com_id = Auth::user()->com_id;
                    $salary_increment_approval->slry_incre_aprv_emp_id = $request->objective_emp_id;
                    $salary_increment_approval->slry_incre_aprv_fst_sv_sts = 'Yes';
                    $salary_increment_approval->save();

                    $generation_one_details = User::where('id', '=', $employee_details_value->report_to_parent_id)->get(['id', 'report_to_parent_id', 'email']);

                    foreach ($generation_one_details as $generation_one_details_value) {

                        $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->get('email');

                        foreach ($generation_two_details as $generation_two_details_value) {

                            $notification = new Notification();
                            $notification->notification_token = $random_key;
                            $notification->notification_com_id = Auth::user()->com_id;
                            $notification->notification_type = "Salary Increment Approval";
                            $notification->notification_title = "Employee Salary Increment Approving Request";
                            $notification->notification_from = $generation_one_details_value->id;
                            $notification->notification_to = $generation_one_details_value->report_to_parent_id;
                            $notification->notification_status = "Unseen";
                            $notification->save();

                            ######## second generation email##########
                            $data["email"] = $generation_two_details_value->email;
                            $data["request_sender_name"] = $employee_details_value->first_name . ' ' . $employee_details_value->last_name;
                            $data["subject"] = "Salary Increment Approving Request";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.annual-salary-approving-request-to-second-supervisor', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });

                            ######## second generation email ends##########

                        }
                    }
                } else {
                    return back()->with('message', 'First supervisor not set for this employee!!!');
                }
            }
        } else {
            return back()->with('message', 'This employee not found in the system!!!');
        }

        return back()->with('message', 'Approved Successfully');
    }

    public function secondSupervisorAnnualSalaryIncrementApproval(Request $request)
    {

        $validated = $request->validate([
            'id' => 'required',
            'objective_emp_id' => 'required',
        ]);

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

        $random_key = generateRandomString() . $request->objective_emp_id;
        ############### random key generate code ends here###########

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->exists()) {

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->objective_emp_id)->get();

            foreach ($employee_details as $employee_details_value) {

                $salary_increment_approval =  new SalaryIncrementApproval();
                $salary_increment_approval->slry_incre_aprv_com_id = Auth::user()->com_id;
                $salary_increment_approval->slry_incre_aprv_emp_id = $request->objective_emp_id;
                $salary_increment_approval->slry_incre_aprv_fst_sv_sts = 'Yes';
                $salary_increment_approval->slry_incre_aprv_scnd_sv_sts = 'Yes';
                $salary_increment_approval->save();

                $generation_one_details = User::where('id', '=', $employee_details_value->report_to_parent_id)->get(['report_to_parent_id', 'email']);
                foreach ($generation_one_details as $generation_one_details_value) {

                    $notification = new Notification();
                    $notification->notification_token = $random_key;
                    $notification->notification_com_id = Auth::user()->com_id;
                    $notification->notification_type = "Salary Increment Approval";
                    $notification->notification_title = "Employee Salary Increment Approving Request";
                    $notification->notification_from = $request->objective_emp_id;
                    $notification->notification_to = $employee_details_value->report_to_parent_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    $data["email"] = $generation_one_details_value->email;
                    $data["request_sender_name"] = $employee_details_value->first_name . ' ' . $employee_details_value->last_name;
                    $data["subject"] = "Salary Increment Approving Request";

                    $sender_name = array(
                        'pay_slip_net_salary' => $data["request_sender_name"],
                    );

                    Mail::send('back-end.premium.emails.salary-increment-approved-by-second-supervisor', [
                        'sender_name' => $sender_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_sender_name"])
                            ->subject($data["subject"]);
                    });
                }
            }
        } else {
            return back()->with('message', 'This employee not found in the system!!!');
        }

        return back()->with('message', 'Approved Successfully');
    }






























    public function promotionApproval(Request $request)
    {

        $validated = $request->validate([
            'promotion_giving_emp_id' => 'required',
            'promotion_giving_old_department_id' => 'required',
            'promotion_giving_new_department_id' => 'required',
            'promotion_giving_old_designation_id' => 'required',
            'promotion_giving_new_designation_id' => 'required',
            'promotion_giving_new_salary' => 'required|numeric',
        ]);

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');

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

        $random_key = generateRandomString() . $request->promotion_giving_emp_id;
        ############### random key generate code ends here###########

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->promotion_giving_emp_id)->exists()) {


            if (SeatAllocation::where('seat_allocation_com_id', Auth::user()->com_id)
                ->where('seat_allocation_dpt_id', $request->promotion_giving_new_department_id)
                ->where('seat_allocation_desig_id', $request->promotion_giving_new_designation_id)
                ->exists()
            ) {

                $level_wise_vacancies = SeatAllocation::where('seat_allocation_com_id', Auth::user()->com_id)
                    ->where('seat_allocation_dpt_id', $request->promotion_giving_new_department_id)
                    ->where('seat_allocation_desig_id', $request->promotion_giving_new_designation_id)
                    ->take(1)
                    ->get();

                foreach ($level_wise_vacancies as $level_wise_vacancies_value) {

                    if ($level_wise_vacancies_value->seat_allocation_alctd_seat >= 1) {

                        $available_seats = $level_wise_vacancies_value->seat_allocation_alctd_seat - 1;

                        $seat_allocation =  SeatAllocation::find($level_wise_vacancies_value->id);
                        $seat_allocation->seat_allocation_alctd_seat = $available_seats;
                        $seat_allocation->save();
                    } else {
                        return back()->with('message', 'No vacancy!!!');
                    }
                }
            } else {
                return back()->with('message', 'No vacancy!!!');
            }

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->promotion_giving_emp_id)->get();

            foreach ($employee_details as $employee_details_value) {

                $promotion = new Promotion();
                $promotion->promotion_com_id = Auth::user()->com_id;
                $promotion->promotion_employee_id = $request->promotion_giving_emp_id;
                $promotion->promotion_old_department = $request->promotion_giving_old_department_id;
                $promotion->promotion_new_department = $request->promotion_giving_new_department_id;
                $promotion->promotion_old_designation = $request->promotion_giving_old_designation_id;
                $promotion->promotion_new_designation = $request->promotion_giving_new_designation_id;
                $promotion->promotion_old_gross_salary = $employee_details_value->gross_salary;
                $promotion->promotion_new_gross_salary = $request->promotion_giving_new_salary;
                $promotion->promotion_title = "Employee Promotion";
                $promotion->promotion_date = $current_date;
                $promotion->promotion_description = "Employee Promotion Approved";
                $promotion->save();

                $employee =  User::find($employee_details_value->id);
                $employee->department_id = $request->promotion_giving_new_department_id;
                $employee->designation_id = $request->promotion_giving_new_designation_id;
                $employee->gross_salary = $request->promotion_giving_new_salary;
                $employee->save();


                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Congratulations!!!!!";
                $notification->notification_title = "You have been promoted.";
                $notification->notification_from = $employee_details_value->report_to_parent_id;
                $notification->notification_to = $request->promotion_giving_emp_id;
                $notification->notification_status = "Unseen";
                $notification->save();

                $data["email"] = $employee_details_value->email;
                $data["request_sender_name"] = $employee_details_value->first_name . ' ' . $employee_details_value->last_name;
                $data["subject"] = "Promotion Approval";

                $sender_name = array(
                    'pay_slip_net_salary' => $data["request_sender_name"],
                );

                Mail::send('back-end.premium.emails.promotion-approval-congratulation', [
                    'sender_name' => $sender_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_sender_name"])
                        ->subject($data["subject"]);
                });
            }
        } else {
            return back()->with('message', 'This employee not found in the system!!!');
        }

        return back()->with('message', 'Promotion Approved Successfully');
    }




    public function givingAnnualSalaryIncrement(Request $request)
    {

        $validated = $request->validate([
            'promotion_giving_emp_id' => 'required',
            'promotion_giving_old_department_id' => 'required',
            'promotion_giving_old_designation_id' => 'required',
            'old_gross_salary' => 'required',
            'salary_increment_percentage' => 'required|numeric',
        ]);

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');

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

        $random_key = generateRandomString() . $request->promotion_giving_emp_id;
        ############### random key generate code ends here###########

        if (User::where('com_id', Auth::user()->com_id)->where('id', $request->promotion_giving_emp_id)->exists()) {

            $employee_details = User::where('com_id', Auth::user()->com_id)->where('id', $request->promotion_giving_emp_id)->get();

            foreach ($employee_details as $employee_details_value) {

                $ammount_to_add_with_the_gross_salary = ($request->old_gross_salary * $request->salary_increment_percentage) / 100;
                $incremented_salary = $request->old_gross_salary + $ammount_to_add_with_the_gross_salary;

                $salary_increment = new SalaryIncrement();
                $salary_increment->salary_incre_com_id = Auth::user()->com_id;
                $salary_increment->salary_incre_emp_id = $request->promotion_giving_emp_id;
                $salary_increment->salary_incre_dept_id = $request->promotion_giving_old_department_id;
                $salary_increment->salary_incre_desig_id = $request->promotion_giving_old_designation_id;
                $salary_increment->salary_incre_old_salary = $request->old_gross_salary;
                $salary_increment->salary_incre_new_salary = $incremented_salary;
                $salary_increment->salary_incre_date = $current_date;
                $salary_increment->save();


                $employee =  User::find($employee_details_value->id);
                // $employee->department_id = $request->promotion_giving_new_department_id;
                // $employee->designation_id = $request->promotion_giving_new_designation_id;
                $employee->gross_salary = $incremented_salary;
                $employee->save();


                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Congratulations!!!!!";
                $notification->notification_title = "You got a salary increment";
                $notification->notification_from = $employee_details_value->report_to_parent_id;
                $notification->notification_to = $request->promotion_giving_emp_id;
                $notification->notification_status = "Unseen";
                $notification->save();

                $data["email"] = $employee_details_value->email;
                $data["request_sender_name"] = $employee_details_value->first_name . ' ' . $employee_details_value->last_name;
                $data["subject"] = "Salary Increment";

                $sender_name = array(
                    'pay_slip_net_salary' => $data["request_sender_name"],
                );

                Mail::send('back-end.premium.emails.annual-increment-congratulation', [
                    'sender_name' => $sender_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_sender_name"])
                        ->subject($data["subject"]);
                });
            }
        } else {
            return back()->with('message', 'This employee not found in the system!!!');
        }

        return back()->with('message', 'Success!');
    }




    public function deleteObjective($id)
    {
        $objective =  Objective::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}