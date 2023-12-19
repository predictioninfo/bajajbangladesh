<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Notification;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Session;
use PDF;
use DB;

class PromotionController extends Controller
{
    public function promotionAdd(Request $request)
    {

        $validated = $request->validate([
            'promotion_employee_id' => 'required',
            'department_id' => 'required',
            'new_department_id' => 'required',
            'new_designation_id' => 'required',
            'old_gross_salary' => 'required',
            'new_gross_salary' => 'required',
            'promotion_title' => 'required',
            'promotion_date' => 'required',
            'promotion_description' => 'required',
        ]);
        try {
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
            $employee_details = User::where('id', $request->promotion_employee_id)->get(['id', 'designation_id', 'email', 'first_name', 'last_name']);

            foreach ($employee_details as $employee_details_value) {

                $promotion = new Promotion();
                $promotion->promotion_com_id = Auth::user()->com_id;
                $promotion->promotion_employee_id = $request->promotion_employee_id;
                $promotion->promotion_old_department = $request->department_id;
                $promotion->promotion_new_department = $request->new_department_id;
                $promotion->promotion_old_designation = $employee_details_value->designation_id;
                $promotion->promotion_new_designation = $request->new_designation_id;
                $promotion->promotion_old_gross_salary = $request->old_gross_salary;
                $promotion->promotion_new_gross_salary = $request->new_gross_salary;
                $promotion->promotion_title = $request->promotion_title;
                $promotion->promotion_date = $request->promotion_date;
                $promotion->promotion_description = $request->promotion_description;
                // dd($employee_details_value);
                $promotion->save();
            }
            $promoted_employee = User::find($request->promotion_employee_id);
            if ($request->new_gross_salary) {
                $promoted_employee->gross_salary = $request->new_gross_salary;
            }
            if ($request->new_department_id) {
                $promoted_employee->department_id = $request->new_department_id;
            }
            if ($request->new_designation_id) {
                $promoted_employee->designation_id = $request->new_designation_id;
            }
            $promoted_employee->save();


            if ($request->promotion_employee_id) {
                try {

                    foreach ($employee_details as $promotion_value) {

                        $data["email"] = $promotion_value->email;
                        $data["request_receiver_name"] =   $promotion_value->first_name . ' ' .  $promotion_value->last_name;
                        $data["subject"] = "Promotion Letter";
                        $receiver_name = array(
                            'receiver_name_value' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.promotion-letter', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                } catch (\Exception $e) {
                    return back()->with('message', 'Please Setup a valid eamil to notify employee');
                }
            }

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


    public function promotionById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeePromotionByIds = Promotion::where($where)->first();

        return response()->json($employeePromotionByIds);
    }

    public function promotionUpdate(Request $request)
    {
        DB::beginTransaction();


        $validated = $request->validate([
            'new_department_id' => 'required',
            'new_designation_id' => 'required',
            'promotion_title' => 'required',
            'promotion_date' => 'required',
            'promotion_description' => 'required',
        ]);
        try {
            $promotion = Promotion::find($request->id);
            $promotion->promotion_new_department = $request->new_department_id;
            $promotion->promotion_new_designation = $request->new_designation_id;
            $promotion->promotion_new_gross_salary = $request->new_gross_salary;
            $promotion->promotion_title = $request->promotion_title;
            $promotion->promotion_date = $request->promotion_date;
            $promotion->promotion_description = $request->promotion_description;
            $promotion->save();

            $promoted_employee = User::find($request->promoted_employee_id);
            if ($request->new_gross_salary) {
                $promoted_employee->gross_salary = $request->new_gross_salary;
            }
            if ($request->new_department_id) {
                $promoted_employee->department_id = $request->new_department_id;
            }
            if ($request->new_designation_id) {
                $promoted_employee->designation_id = $request->new_designation_id;
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