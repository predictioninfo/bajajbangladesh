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
use App\Models\Review;
use App\Models\ReviewDetails;
use App\Models\Permission;
use App\Models\OperationalPlan;
use App\Models\ObjectiveDetails;
use App\Models\RatingScale;
use App\Models\Notification;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;

use Session;

class PerformanceReviewController extends Controller
{

    public function addObjectiveReviewForm(Request $request)
    {
        if (Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_emp_id', $request->review_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            $objectivePlan = Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_emp_id', $request->review_emp_id)->whereYear('created_at', date("Y"))->first('id');

            if ($objectivePlan->id) {
                $this->addObjectiveReviewFormDetails($objectivePlan->id, $request);
            }
            return back();
        } else {
            $objectivePlan = new Objective;
            $objectivePlan->objective_com_id = Auth::user()->com_id;
            $objectivePlan->objective_dept_id  = $request->review_dept_id;
            $objectivePlan->objective_desig_id  = $request->review_desi_id;
            $objectivePlan->objective_emp_id   = $request->review_emp_id;
            $objectivePlan->objective_id   = $request->objective_id;
            $objectivePlan->save();
            if ($objectivePlan->id) {
                $this->addObjectiveReviewFormDetails($objectivePlan->id, $request);
            }
            return back()->with('message', 'Updated Successfully');
        }
    }

    public function addObjectiveReviewFormDetails($masterId, $request)
    {
        if (ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)->where('objective_id', $masterId)->whereYear('created_at', date("Y"))->exists()) {
            return back()->with('message', 'Already Added objectives in this Year');
        } else {
            ObjectiveDetails::where('objective_id', $masterId)->delete();
            $objective_name = $request->obj_name;
            $allDetails = array();
            foreach ($objective_name as $key => $value) :
                $objectivePlan['objective_id'] = $masterId;
                $objectivePlan['obj_detail_com_id'] = Auth::user()->com_id;
                $objectivePlan['objective_obj_type_id'] = $request->objective_obj_type_id[$key];
                $objectivePlan['objective_name'] = $request->obj_name[$key];
                $objectivePlan['objective_success'] = $request->messure_of_succ[$key];
                $objectivePlan['action_taken'] = $request->action_taken[$key];
                $objectivePlan['super_comments'] = $request->super_comments[$key];
                $objectivePlan['rating'] = $request->rating[$key];
                array_push($allDetails, $objectivePlan);
            endforeach;

            ObjectiveDetails::insert($allDetails);
            return back()->with('message', 'Added Successfully');
        }
    }

    public function detailsObjective($id)
    {

        $detailsObjective = ObjectiveDetails::with('objectiveDetails')->where('objective_id', $id)->get();
        return view('back-end.premium.performance.indicator.details-indicator', get_defined_vars());
    }


    public function employeePerformanceMarking($id)
    {
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');
        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');
        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();
        $ratingDefination = RatingScale::where('point_scale_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.performance-form.performance-review-form', get_defined_vars());
    }

    public function employeePerformanceReviewView($id)
    {
        $employee_info = ObjectiveDetails::where('objective_id', $id)
        ->with(['objectiveReport' => function ($query) {
            $query->with(['userdesignationfromobjective', 'userfromobjective' => function ($query) {
                $query->with('qualification',  'emoloyeedetail');
            }]);
        }])
        ->first();

        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');
        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');
        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();
        $ratingDefination = RatingScale::where('point_scale_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.performance-form.performance-review-form-view', get_defined_vars());
    }


    public function performanceReviewView($id)
    {
        $employee_info = ObjectiveDetails::where('objective_id', $id)
        ->with(['objectiveReport' => function ($query) {
            $query->with(['userdesignationfromobjective', 'userfromobjective' => function ($query) {
                $query->with('qualification',  'emoloyeedetail');
            }]);
        }])
        ->first();

        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');
        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');
        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();
        $ratingDefination = RatingScale::where('point_scale_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.performance.employee-performance-review-form-view', get_defined_vars());
    }

    public function employeePerformanceDetailsReview($id)
    {
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');
        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');

        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();

        return view('back-end.premium.performance.performance-form.employee-performance-details-review-form', get_defined_vars());
    }

    public function employeePerformanceReviewMarking()
    {
        $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')
            ->where('objective_emp_id', Session::get('employee_setup_id'))
            ->where('objective_com_id', Auth::user()->com_id)
            ->first();

        $objectives = Objective::join('users', 'objectives.objective_emp_id', '=', 'users.id')
            ->select('objectives.*', 'users.first_name', 'users.last_name')
            ->where('objective_com_id', Auth::user()->com_id)
            ->where('objective_emp_id', Session::get('employee_setup_id'))
            ->get();
        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id',   $objectiveUsers->id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.user-settings.performance.employee-performance-review-from', get_defined_vars());
    }

    public function updatePerformanceReview(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $objectivePlan = Objective::findOrFail($id);
            $objectivePlan->objective_com_id = Auth::user()->com_id;
            $objectivePlan->objective_dept_id  = $request->review_dept_id;
            $objectivePlan->objective_desig_id  = $request->review_desi_id;
            $objectivePlan->objective_emp_id   = $request->review_emp_id;
            $objectivePlan->review_status  = $request->review_status;
            $objectivePlan->objective_date  = date('Y-m-d');
            $objectivePlan->point  = $request->point;
            $objectivePlan->save();
            if ($objectivePlan->id) {
                $this->updatePerformanceReviewDetails($objectivePlan->id, $request);
            }
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function updatePerformanceReviewDetails($masterId, $request)
    {

        ObjectiveDetails::where('objective_id', $masterId)->delete();
        $objective_name = $request->obj_name;
        $allDetails = array();
        foreach ($objective_name as $key => $value) :
            $objectivePlan['objective_id'] = $masterId;
            $objectivePlan['obj_detail_com_id'] = Auth::user()->com_id;
            $objectivePlan['objective_emp_id'] = $request->review_dept_id1[$key];
            $objectivePlan['objective_desig_id'] = $request->review_desi_id1[$key];
            $objectivePlan['objective_dept_id'] = $request->review_emp_id1[$key];
            $objectivePlan['objective_obj_type_id'] = $request->objective_obj_type_id[$key];
            $objectivePlan['objective_name'] = $request->obj_name[$key];
            $objectivePlan['objective_success'] = $request->messure_of_succ[$key];
            $objectivePlan['action_taken'] = $request->action_taken[$key];
            $objectivePlan['super_comments'] = $request->super_comments[$key];
            $objectivePlan['rating'] = $request->rating[$key];
            $objectivePlan['objective_date']  = date('Y-m-d');
            array_push($allDetails, $objectivePlan);
        endforeach;

        ObjectiveDetails::insert($allDetails);
        return back()->with('message', 'Added Successfully');
    }

    // public function employeeObjectiveReviewComments(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     try {

    //           ############### random key generate code starts###########
    //           function generateRandomString($length = 25)
    //           {
    //               $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //               $charactersLength = strlen($characters);
    //               $randomString = '';
    //               for ($i = 0; $i < $length; $i++) {
    //                   $randomString .= $characters[rand(0, $charactersLength - 1)];
    //               }
    //               return $randomString;
    //           }
    //           $random_key = generateRandomString();
    //           ############### random key generate code staendsrts###########

    //         $developmentPlan = Objective::findOrFail($id);
    //         $developmentPlan->employee_comments = $request->employee_comments;
    //         $developmentPlan->save();

    //         $notification = new Notification();
    //         $notification->notification_token = $random_key;
    //         $notification->notification_com_id = Auth::user()->com_id;
    //         $notification->notification_type = "Employee Objective Review Comments";
    //         $notification->notification_title = "Employee Objective Review Comments";
    //         // $notification->notification_from  = Auth::user()->id;
    //         $notification->notification_to = $request->objective_comments_emp_id  ;
    //         $notification->notification_status = "Unseen";
    //         $notification->save();

    //        $users = User::where('id', '=', $request->objective_comments_emp_id)->get(['email', 'first_name', 'last_name']);

    //         foreach ($users as $users) {

    //             $data["email"] = $users->email;
    //             $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
    //             $data["subject"] = "Employee Objective Review Comments";

    //             $receiver_name = array(
    //                 'objective_comments' => $data["request_receiver_name"],
    //             );

    //             Mail::send('back-end.premium.emails.objective_comments', [
    //                 'receiver_name' => $receiver_name,
    //             ], function ($message) use ($data) {
    //                 $message->to($data["email"], $data["request_receiver_name"])
    //                     ->subject($data["subject"]);
    //             });
    //         }
    //         DB::commit();
    //         // all good
    //         return back()->with('message', 'Supervisor Review Successfully');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         dd($e->getMessage());
    //     }
    // }


    public function employeeObjectiveReviewComments(Request $request, $id)
    {
        DB::beginTransaction();
        try {


            $developmentPlan = Objective::findOrFail($id);
            $developmentPlan->employee_comments = $request->employee_comments;
            $developmentPlan->save();


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
            $notification = new Notification();
            $notification->notification_token = $random_key;
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Employee-Objective-Comments";
            $notification->notification_title = "Employees Have a Objective Reviews Questions";
            // $notification->notification_from = $request->objective_comments_emp_id;
            $notification->notification_to = $request->objective_comments_emp_id;
            $notification->notification_status = "Unseen";
            $notification->save();

            $userss = User::where('id', '=', $request->employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name']);
            
            DB::commit();
            // all good
            return back()->with('message', 'Supervisor Review Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }
}
