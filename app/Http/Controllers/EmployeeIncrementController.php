<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use Mail;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Promotion;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\IncrementSalaryHistory;

class EmployeeIncrementController extends Controller
{
    public function incrementAdd(Request $request)
    {
        try {

            if (IncrementSalaryHistory::where('inc_sal_his_com_id', Auth::user()->com_id)->where('emp_id', $request->emp_id)->exists()) {
                return back()->with('message', 'Increment already exits!!');
            } else {
                $employee_details = User::where('id', $request->emp_id)->get(['id', 'designation_id', 'email', 'first_name', 'last_name']);

                foreach ($employee_details as $employee_details_value) {
                    $firstDateOfMonth = Carbon::parse($request->increment_date)->firstOfMonth();
                    $increment = new IncrementSalaryHistory;
                    $increment->inc_sal_his_com_id = Auth::user()->com_id;
                    $increment->dep_id = $request->dep_id;
                    $increment->desig_id = $request->desig_id;
                    $increment->emp_id = $request->emp_id;
                    $increment->old_gross_salary = $request->old_gross_salary;
                    $increment->increment_amount = $request->increment_amount;
                    $increment->new_gross_salary = $request->old_gross_salary + $request->increment_amount;
                    $increment->increment_date = $request->increment_date;
                    $increment->start_date_of_month = $firstDateOfMonth->format('Y-m-d');
                    $increment->description = $request->description;
                    $increment->save();

                }
            }
            $promoted_employee = User::find($request->emp_id);
            if ($promoted_employee) {
                $promoted_employee->gross_salary =$request->old_gross_salary + $request->increment_amount;
            }
            $promoted_employee->save();


            // if ($request->emp_id) {
            //     try {

            //         foreach ($employee_details as $promotion_value) {

            //             $data["email"] = $promotion_value->email;
            //             $data["request_receiver_name"] =   $promotion_value->first_name . ' ' .  $promotion_value->last_name;
            //             $data["subject"] = "Promotion Letter";
            //             $receiver_name = array(
            //                 'receiver_name_value' => $data["request_receiver_name"],
            //             );

            //             Mail::send('back-end.premium.emails.promotion-letter', [
            //                 'receiver_name' => $receiver_name,
            //             ], function ($message) use ($data) {
            //                 $message->to($data["email"], $data["request_receiver_name"])
            //                     ->subject($data["subject"]);
            //             });
            //         }
            //     } catch (\Exception $e) {
            //         return back()->with('message', 'Please Setup a valid eamil to notify employee');
            //     }
            // }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }





    public function promotionLetterDownload(Request $request)
    {

        $promotion = Promotion::where('id', $request->id)->get();


        foreach ($promotion as $promotion_value) {

            $user_details = User::where('id', $promotion_value->promotion_employee_id)->get();


            foreach ($user_details as $user_details_value) {
                $company_details = Company::where('id', $user_details_value->com_id)->first(['company_name']);
                $department_details = Department::where('id', $user_details_value->department_id)->first(['department_name']);
                $designation_details = Designation::where('id', $user_details_value->designation_id)->first(['designation_name']);

                $user_full_name = $user_details_value->first_name . " " . $user_details_value->last_name;



                $company_name = array(
                    'promotion_com_id' => $company_details->company_name,
                );
                $employee_name = array(
                    'promotion_employee_id' => $user_full_name,
                );
                $promotion_old_department = array(
                    'promotion_old_department' => $department_details->department_name,
                );
                $promotion_new_department  = array(
                    'promotion_new_department'  => $department_details->department_name,
                );
                $promotion_old_designation  = array(
                    'promotion_old_designation' => $designation_details->designation_name,
                );
                $promotion_new_designation  = array(
                    'promotion_new_designation' => $designation_details->designation_name,
                );
                $promotion_old_gross_salary = array(
                    'promotion_old_gross_salary' =>  $promotion_value->promotion_old_gross_salary,
                );
                $promotion_new_gross_salary = array(
                    'promotion_new_gross_salary' => $promotion_value->promotion_new_gross_salary,
                );
                $promotion_date = array(
                    'promotion_date' => $promotion_value->promotion_date,
                );





                $pdf = PDF::loadView('back-end.premium.emails.promotion', [
                    'company_name' => $company_name,
                    'employee_name' => $employee_name,
                    'promotion_old_department' => $promotion_old_department,
                    'promotion_new_department' => $promotion_new_department,
                    'promotion_old_designation' => $promotion_old_designation,
                    'promotion_new_designation' => $promotion_new_designation,
                    'promotion_old_gross_salary' => $promotion_old_gross_salary,
                    'promotion_new_gross_salary' => $promotion_new_gross_salary,
                    'promotion_date' => $promotion_date,

                ]);

                $pdf->download('promotion.pdf');
            }
        }
    }
    //pdf generating and sending sending via email code ends here..


    public function incrementById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeIncrementByIds = IncrementSalaryHistory::where($where)->first();

        return response()->json($employeeIncrementByIds);
    }

    public function incrementUpdate(Request $request)
    {
        DB::beginTransaction();


        try {
            $firstDateOfMonth = Carbon::parse($request->increment_date)->firstOfMonth();
            $increment = IncrementSalaryHistory::find($request->id);
            $increment->dep_id = $request->dep_id;
            $increment->desig_id = $request->desig_id;
            $increment->emp_id = $request->emp_id;
            $increment->old_gross_salary = $request->old_gross_salary;
            $increment->increment_amount = $request->increment_amount;
            $increment->new_gross_salary = $request->old_gross_salary + $request->increment_amount;
            $increment->increment_date = $request->increment_date;
            $increment->start_date_of_month = $firstDateOfMonth->format('Y-m-d');
            $increment->description = $request->description;
            $increment->save();

            $promoted_employee = User::find($request->emp_id);
            if ($promoted_employee) {
                $promoted_employee->gross_salary =$request->old_gross_salary + $request->increment_amount;
            }
            $promoted_employee->save();

            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'Plese insert valid data');
        }
        // return back()->with('message', 'Updated Successfully');
    }

    public function deletePromotion($id)
    {
        $promotion = Promotion::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeletePromotion(Request $request)
    {
        $promotion = Promotion::where('promotion_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
