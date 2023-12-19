<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Award;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use Mail;
use DateTime;

class AwardController extends Controller
{
    public function awardAdd(Request $request)
    {

        $validated = $request->validate([
            'department_id' => 'required',
            'employee_id' => 'required',
            'award_type_name' => 'required',
            'award_gift' => 'required',
            'award_cash' => 'required',
            'award_date' => 'required',
        ]);
        try {
            $award = new Award();
            $award->award_com_id = Auth::user()->com_id;
            $award->award_department_id = $request->department_id;
            $award->award_employee_id = $request->employee_id;
            $award->award_type_name = $request->award_type_name;
            $award->award_gift = $request->award_gift;
            $award->award_cash = $request->award_cash;
            $award->award_date = $request->award_date;

            if ($request->award_photo) {
                $image = $request->file('award_photo');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/award-photos';
                $img = Image::make($image->path());
                $img->resize(110, 110, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $input['imagename']);
                $imageUrl = $filePath . '/' . $input['imagename'];
                $award->award_photo = $imageUrl;


                $filePath = 'uploads/award-photos/before_resized/';
                $before_resized_imageNames = $image->move($filePath, $input['imagename']);
            }

            $award->award_info = $request->award_info;
            $award->save();
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
            $notification->notification_type = "Award";
            $notification->notification_title = "You have won a Award";
            $notification->notification_from = $request->complaint_from_employee_id;
            $notification->notification_to = $request->employee_id;
            $notification->notification_status = "Unseen";
            $notification->save();
            if ($request->employee_id) {
                try {
                    $employees =  User::where('id', $request->employee_id)->get(['email', 'first_name', 'last_name']);
                    foreach ($employees as $employee) {

                        $data["email"] = $employee->email;
                        $data["request_sender_name"] = $employee->first_name . ' ' . $employee->last_name;
                        $data["subject"] =  $employee->first_name . ' ' . $employee->last_name . " You have won a Award";
                        $sender_name = $employee->first_name . ' ' . $employee->last_name;
                        Mail::send('back-end.premium.emails.award', [
                            'sender_name' => $sender_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_sender_name"])
                                ->subject($data["subject"]);
                        });
                    }
                } catch (\Exception $e) {
                    return back()->with('message', 'Please Setup a valid email to notify employee');
                }
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function awardById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeAwardByIds = Award::where($where)->first();

        return response()->json($employeeAwardByIds);
    }

    public function awardUpdate(Request $request)
    {
        $validated = $request->validate([

            'award_type_name' => 'required',
            'award_gift' => 'required',
            'award_cash' => 'required',
            'award_date' => 'required',

        ]);
        try {
            $award = Award::find($request->id);
            if ($request->edit_department_id && $request->edit_employee_id) {
                $award->award_department_id = $request->edit_department_id;
                $award->award_employee_id = $request->edit_employee_id;
            } else {
                $award->award_department_id = $request->department_id;
                $award->award_employee_id = $request->employee_id;
            }
            if ($request->award_photo) {
                $image = $request->file('award_photo');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/award-photos';
                $img = Image::make($image->path());
                $img->resize(110, 110, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $input['imagename']);
                $imageUrl = $filePath . '/' . $input['imagename'];
                $award->award_photo = $imageUrl;


                $filePath = 'uploads/award-photos/before_resized/';
                $before_resized_imageNames = $image->move($filePath, $input['imagename']);
            }
            $award->award_type_name = $request->award_type_name;
            $award->award_gift = $request->award_gift;
            $award->award_cash = $request->award_cash;
            $award->award_date = $request->award_date;
            $award->award_info = $request->award_info;
            $award->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteAward($id)
    {
        try {
            $award = Award::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteAward(Request $request)
    {
        try {
            $award = Award::where('award_com_id', $request->bulk_delete_com_id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}