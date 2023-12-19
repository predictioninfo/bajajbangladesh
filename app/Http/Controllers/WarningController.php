<?php

namespace App\Http\Controllers;

use App\Models\Warning;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;

class WarningController extends Controller
{
    public function warningAdd(Request $request)
    {
        $validated = $request->validate([
            'warning_department_id' => 'required',
            'warning_employee_id' => 'required',
            'warning_type' => 'required',
            'warning_subject' => 'required',
            'warning_date' => 'required',
            'warning_status' => 'required',
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
            $warning_date = date('Y-m-d', strtotime($request->warning_date));

            $warning = new Warning();
            $warning->warning_com_id = Auth::user()->com_id;
            $warning->warning_department_id = $request->warning_department_id;
            $warning->warning_employee_id = $request->warning_employee_id;
            $warning->warning_type = $request->warning_type;
            $warning->warning_subject = $request->warning_subject;
            $warning->warning_desc = $request->warning_desc;
            $warning->warning_date = $warning_date;
            $warning->warning_status = $request->warning_status;
            $warning->cirtificate_format_id = $request->cirtificate_format_id;
            $warning->save();


            if (User::where('id', $request->warning_employee_id)->exists()) {
                $employee = User::find($request->warning_employee_id);
                $employee->warning_letter_format_id = $request->cirtificate_format_id;
                $employee->save();
            } else {
                return back()->with('message', 'Employee Not Found');
            }


            $users = User::where('id', '=', $request->warning_employee_id)->get(['email', 'first_name', 'last_name']);

            foreach ($users as $user) {
                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Warning";
                $notification->notification_title = "You Have A New Warning";
                $notification->notification_to = $request->warning_employee_id;
                $notification->notification_status = "Unseen";
                $notification->save();


                ########email for Employee ##########
                $data["email"] = $user->email;
                $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
                $data["subject"] = "Warning";
                $sender_name = array(
                    'request_sender_name' => $data["request_sender_name"],
                );
                Mail::send('back-end.premium.emails.warning', [
                    'sender_name' => $sender_name,
                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_sender_name"])
                        ->subject($data["subject"]);
                });
                ########email for Employee ends ##########
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function warningById(Request $request)
    {

        $where = array('id' => $request->id);
        $warningByIds = Warning::where($where)->first();

        return response()->json($warningByIds);
    }

    public function warningUpdate(Request $request)
    {
        $validated = $request->validate([
            'warning_type' => 'required',
            'warning_subject' => 'required',
            'warning_date' => 'required',
            'warning_status' => 'required',
        ]);
        try {
            $warning_date = date('Y-m-d', strtotime($request->warning_date));

            $warning = Warning::find($request->id);
            if ($request->edit_warning_department_id) {
                $warning->warning_department_id = $request->edit_warning_department_id;
            }
            if ($request->edit_warning_employee_id) {
                $warning->warning_employee_id = $request->edit_warning_employee_id;
            }
            $warning->warning_type = $request->warning_type;
            $warning->warning_subject = $request->warning_subject;
            $warning->warning_desc = $request->warning_desc;
            $warning->warning_date = $warning_date;
            $warning->warning_status = $request->warning_status;
            $warning->cirtificate_format_id = $request->cirtificate_format_id;
            $warning->save();

            if (User::where('id', $request->edit_warning_employee_id)->exists()) {
                $employee = User::find($request->edit_warning_employee_id);
                $employee->warning_letter_format_id = $request->cirtificate_format_id;
                $employee->save();
            } else {
                return back()->with('message', 'Employee Not Found');
            }


            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function deleteWarning($id)
    {
        $warning = Warning::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteWarning(Request $request)
    {
        $warning = Warning::where('warning_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
