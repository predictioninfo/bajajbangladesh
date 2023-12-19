<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use Mail;
use Session;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\SalaryIncrement;

class SalaryIncrementController extends Controller
{


    public function giveEmployeeIncrement(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'increment_date' => 'required',
        ]);

        try {
            // $increment_details = User::where('id', $request->employee_id)->get(['id', 'designation_id', 'email', 'first_name', 'last_name']);

            $salary_increment = new SalaryIncrement();
            $salary_increment->salary_incre_com_id = Auth::user()->com_id;
            $salary_increment->salary_incre_emp_id = $request->employee_id;
            $salary_increment->salary_incre_dept_id = $request->department_id;
            $salary_increment->salary_incre_desig_id = $request->designation_id;
            $salary_increment->increment_amount = $request->increment_amount;
            $salary_increment->cirtificate_format_id = $request->cirtificate_format_id;
            if (User::where('id', $request->employee_id)->exists()) {

                $employee_details = User::where('id', $request->employee_id)->first('gross_salary');

                $old_gross = $salary_increment->salary_incre_old_salary = $employee_details->gross_salary;
                $total_gross = $request->increment_amount + $old_gross;
                $employee = User::find($request->employee_id);
                $employee->gross_salary = $total_gross;
                $employee->salary_increment_letter_id = $request->cirtificate_format_id;
                $employee->save();
            } else {
                return back()->with('message', 'Employee Not Found');
            }

            $salary_increment->salary_incre_new_salary =   $total_gross;
            $salary_increment->salary_incre_date = $request->increment_date;
            $salary_increment->save();

            if ($request->employee_id) {
                try {
                    $salaryIncrement = SalaryIncrement::get();

                    foreach ($salaryIncrement as $incrementValue) {
                        $employee_details = User::where('id', $incrementValue->salary_incre_emp_id)->get();

                        foreach ($employee_details as $salary_increment) {

                            $data["email"] = $salary_increment->email;
                            $data["request_receiver_name"] =   $salary_increment->first_name . ' ' .  $salary_increment->last_name;
                            $data["subject"] = "Increment Letter";
                            $receiver_name = array(
                                'receiver_name_value' => $data["request_receiver_name"],
                            );
                            $department_details = Department::where('id', $salary_increment->department_id)->first(['department_name']);
                            $designation_details = Designation::where('id', $salary_increment->designation_id)->first(['designation_name']);
                            $user_full_name = $salary_increment->first_name . " " . $salary_increment->last_name;

                    $employee_name = array(
                        'incre_emp_id' => $user_full_name,
                    );
                    $incre_dep_id = array(
                        'incre_dep_id' => $department_details->department_name,
                    );

                    $incre_desi_id  = array(
                        'incre_desi_id' => $designation_details->designation_name,
                    );
                    $incre_incre_salary = array(
                        'incre_incre_salary' =>  $incrementValue->salary_incre_new_salary,
                    );
                    $incre_incre_date = array(
                        'incre_incre_date' =>  $incrementValue->salary_incre_date,
                    );


                            Mail::send('back-end.premium.emails.salary-incre-letter', [
                                'receiver_name' => $receiver_name,
                                'employee_name' => $employee_name,
                                'incre_dep_id' => $incre_dep_id,
                                'incre_desi_id' => $incre_desi_id,
                                'incre_incre_salary' => $incre_incre_salary,
                                'incre_incre_date' => $incre_incre_date,

                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_receiver_name"])
                                    ->subject($data["subject"]);
                            });
                        }
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



    public function roleById(Request $request)
    {

        $where = array('id' => $request->id);
        $roleByIds = SalaryIncrement::where($where)->first();

        return response()->json($roleByIds);
    }

    public function updateEmployeeIncrement(Request $request)
    {

        $salary_increment = SalaryIncrement::find($request->id);
        $salary_increment->salary_incre_com_id = Auth::user()->com_id;

        $salary_increment->increment_amount = $request->increment_amount;

        if (User::where('id', $request->employee_id)->exists()) {

            $employee_details = User::where('id', $request->employee_id)->first('gross_salary');
            $old_gross = $salary_increment->salary_incre_old_salary = $employee_details->gross_salary;
            $total_gross = $request->increment_amount + $old_gross;
            $employee = User::find($request->employee_id);
            $employee->gross_salary = $total_gross;
            $employee->salary_increment_letter_id = $request->cirtificate_format_id;
            $employee->save();
        } else {
            return back()->with('message', 'Employee Not Found');
        }
        $salary_increment->salary_incre_new_salary =   $total_gross;
        $salary_increment->salary_incre_date = $request->increment_date;
        $salary_increment->cirtificate_format_id = $request->cirtificate_format_id;

        $salary_increment->save();
        return back()->with('message', 'Updated Successfully');
    }



    public function deleteEmployeeIncrement($id)
    {
        $salary_increment = SalaryIncrement::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
