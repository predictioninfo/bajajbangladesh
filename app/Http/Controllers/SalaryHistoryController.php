<?php

namespace App\Http\Controllers;

use App\Models\SalaryHistory;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use Mail;

class SalaryHistoryController extends Controller
{
    public function salaryIncremnt(Request $request)
    {
        // try {
        if (SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_emp_id', $request->emp_id)->where('salary_history_increment_status', 1)->exists()) {
            return back()->with('message', 'Already Incremnt');
        } else {
            $saray_increment =  new SalaryHistory();
            $saray_increment->salary_history_com_id = Auth::user()->com_id;
            $saray_increment->salary_history_increment_status = 1;
            $saray_increment->salary_history_emp_id = $request->emp_id;
            $saray_increment->salary_history_previous_gross = $request->previous_gross;
            $saray_increment->salary_history_gross = $request->salary_history_gross;
            $saray_increment->salary_history_previous_per_hour_rate = $request->previous_per_hour_rate;
            $saray_increment->salary_history_per_hour_rate = $request->salary_history_per_hour_rate;
            $saray_increment->salary_history_increment_date = $request->salary_history_incremnt_date;
            $saray_increment->salary_historiy_increment_salary = $request->salary_historiy_increment_salary;
            $saray_increment->save();
        }
        // } catch (\Exception $e) {
        //     return back()->with('message', 'OOPs!Something Is Missing.);
        // }
        return back()->with('message', 'Increment Succsesfully');
    }

    public function customizeSalaryIncremnt(Request $request)
    {
        try {
            if (SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_emp_id', $request->emp_id)->where('salary_history_increment_status', 1)->exists()) {

                return back()->with('message', 'Already Incremnt');
            } else {
                $saray_increment =  new SalaryHistory();
                $saray_increment->salary_history_com_id = Auth::user()->com_id;
                $saray_increment->salary_history_increment_status = 1;
                $saray_increment->salary_history_emp_id = $request->emp_id;
                $saray_increment->salary_history_previous_gross = $request->previous_gross;
                $saray_increment->salary_history_gross = ($request->salary_history_gross + $request->previous_gross);
                $saray_increment->salary_history_previous_per_hour_rate = $request->previous_per_hour_rate;
                $saray_increment->salary_history_per_hour_rate = ($request->salary_history_per_hour_rate + $request->previous_per_hour_rate);
                $saray_increment->salary_history_increment_date = $request->salary_history_incremnt_date;
                $saray_increment->salary_historiy_increment_salary = $request->salary_history_gross;
                $saray_increment->save();
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Increment Succsesfully');
    }
    public function salaryIncremntApprove(Request $request)
    {
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
            $saray_increment = SalaryHistory::findOrFail($request->id);
            $saray_increment->salary_history_com_id = Auth::user()->com_id;
            $saray_increment->salary_history_increment_status = 0;
            $saray_increment->salary_history_approval_status = 1;
            $saray_increment->salary_history_emp_id = $request->emp_id;
            $saray_increment->salary_history_previous_gross = $request->previous_gross;
            $saray_increment->salary_history_gross = $request->salary_history_gross;
            $saray_increment->salary_history_previous_per_hour_rate = $request->previous_per_hour_rate;
            $saray_increment->salary_history_per_hour_rate = $request->salary_history_per_hour_rate;
            $saray_increment->salary_history_increment_date = $request->salary_history_incremnt_date;
            $saray_increment->save();
            $gross_increment = User::findOrFail($request->emp_id);
            $gross_increment->gross_salary = $request->salary_history_gross;
            $gross_increment->per_hour_rate = $request->salary_history_per_hour_rate;
            $gross_increment->save();

            $users = User::where('id', '=', $request->emp_id)->get(['email', 'first_name', 'last_name']);

            foreach ($users as $users) {
                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Salary-Increment";
                $notification->notification_title = "Salary Increment";
                $notification->notification_to = $request->emp_id;
                $notification->notification_status = "Unseen";
                $notification->save();
                $data["email"] = $users->email;
                $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                $data["subject"] = "Salary Increment";
                $receiver_name = array(
                    'pay_slip_net_salary' => $data["request_receiver_name"],
                );

                Mail::send('back-end.premium.emails.increment-letter', [
                    'receiver_name' => $receiver_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_receiver_name"])
                        ->subject($data["subject"]);
                });
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.');
        }
        return back()->with('message', 'Approve Succsesfully');
    }

    public function salaryIncremntcustomizeApprove(Request $request)
    {
        try {
            $saray_increment = SalaryHistory::findOrFail($request->id);
            $saray_increment->salary_history_com_id = Auth::user()->com_id;
            $saray_increment->salary_history_increment_status = 0;
            $saray_increment->salary_history_approval_status = 1;
            $saray_increment->salary_history_emp_id = $request->emp_id;
            $saray_increment->salary_history_previous_gross = $request->previous_gross;
            $saray_increment->salary_history_gross = ($request->salary_history_gross + $request->previous_gross);
            $saray_increment->salary_history_increment_date = $request->salary_history_incremnt_date;
            $saray_increment->save();
            // }
            $gross_increment = User::findOrFail($request->emp_id);
            $gross_increment->gross_salary = ($request->salary_history_gross + $request->previous_gross);
            $gross_increment->per_hour_rate = ($request->salary_history_per_hour_rate + $request->previous_per_hour_rate);
            $gross_increment->save();

            $notification = new Notification();
            // $notification->notification_token = $random_key;
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Salary-Increment";
            $notification->notification_title = "Salary Increment";
            $notification->notification_to = $request->emp_id;
            $notification->notification_status = "Unseen";
            $notification->save();

            $users = User::where('id', '=', $request->emp_id)->get(['email', 'first_name', 'last_name']);
            foreach ($users as $users) {
                $data["email"] = $users->email;
                $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                $data["subject"] = "Salary Increment";
                $receiver_name = array(
                    'pay_slip_net_salary' => $data["request_receiver_name"],
                );
                Mail::send('back-end.premium.emails.increment-letter', [
                    'receiver_name' => $receiver_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_receiver_name"])
                        ->subject($data["subject"]);
                });
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Approve Succsesfully');
    }
    public function salaryHistory()
    {
        $histories = SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_approval_status', '1')->orderBy('id', 'desc')->get();
        return view('back-end.premium.performance.transaction-history.transaction-history', get_defined_vars());
    }
    public function bulkIncrementApprove(Request $request)
    {
        $bulk_increments = SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_increment_status', '1')->orderBy('id', 'desc')->get(['id']);
        foreach ($bulk_increments as $bulk_increment) {
            $bulk_increment = SalaryHistory::find($bulk_increment->id);
            $bulk_increment->salary_history_approval_status = 1;
            $bulk_increment->salary_history_increment_status = 0;
            $bulk_increment->save();
        }

        return back()->with('message', 'Bulk Increment Approval Successfully');
    }
}