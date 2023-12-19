<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;

class AnnouncementController extends Controller
{
    public function addAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required',
            'announcement_title' => 'required',
            'announcement_desc' => 'required',
        ]);
        try {
            $announcement = new Announcement();
            $announcement->announcement_com_id = Auth::user()->com_id;
            $announcement->announcement_by = Auth::user()->id;
            $announcement->announcement_department_id = $request->department_id;
            $announcement->announcement_title = $request->announcement_title;
            $announcement->announcement_desc = $request->announcement_desc;
            $announcement->save();

            $notification = new Notification();
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Announcement";
            $notification->notification_title = "There is A New Announcement";
            $notification->notification_status = "Unseen";
            $notification->save();

            //$firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
            $firebaseTokens = User::where('com_id', Auth::user()->com_id)->whereNotNull('device_token')->get(['device_token']); //ok
            //$firebaseTokens = User::where('id',7978)->whereNotNull('device_token')->get(['device_token']); //ok

            $SERVER_API_KEY = 'AAAAmyJq3eE:APA91bHOr3wzgheEkY2lsdwOqIMKtUmZ48VXV1_ZS1HKpp7KkyInrzA-QuvcPE_7spNaMc0xm4GE_iI6HK4qg_LLTnMcb54kkBisbK8IWEMYM4Rti2HoFvxxqpUZIowhlxahPOAC9SFr';

            $details_array = array();
            foreach ($firebaseTokens as $firebaseTokens_value) {

                $data = [
                    "registration_ids" => [$firebaseTokens_value->device_token],
                    "notification" => [
                        "title" =>  "There is A New Announcement",
                        "body" => $request->announcement_title,
                    ]
                ];

                $dataString = json_encode($data);

                $headers = [
                    'Authorization: key=' . $SERVER_API_KEY,
                    'Content-Type: application/json',
                ];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                $response = curl_exec($ch);

                array_push($details_array, $response);
            }

            //Sending SMS

            if ($announcement->save()) {
                if ($request->department_id == 0) {
                    $message = User::where('is_active', '=', 1)->get();
                    $x = '';
                    foreach ($message as $val) {
                        $number = $val->phone;
                        $x = $x . $number . ","; //number separated by comma
                        $text = $request->announcement_desc;
                    }

                    $url = "http://66.45.237.70/api.php";
                    $data = array(
                        'username' => "01324246900",
                        'password' => "W5CGZF9A",
                        'number' => "$x",
                        'message' => "$text"
                    );
                    $ch = curl_init(); // Initialize cURL
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $smsresult = curl_exec($ch);
                    $p = explode("|", $smsresult);
                    $sendstatus = $p[0];
                } else {
                    $message = User::where('is_active', '=', 1)->where('department_id', '=', $request->department_id)->get();
                    $x = '';
                    foreach ($message as $val) {
                        $number = $val->phone;
                        $x = $x . $number . ","; //number separated by comma
                        $text = $request->announcement_desc;
                    }
                    $url = "http://66.45.237.70/api.php";
                    $data = array(
                        'username' => "01324246900",
                        'password' => "W5CGZF9A",
                        'number' => "$x",
                        'message' => "$text"
                    );
                    $ch = curl_init(); // Initialize cURL
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $smsresult = curl_exec($ch);
                    $p = explode("|", $smsresult);
                    $sendstatus = $p[0];
                }
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

        //End Sending SMS

        return back()->with('message', 'Announcement Added Successfully');
    }

    public function updateAnnouncement(Request $request)
    {

        //echo $request->department_id; exit;
        $validated = $request->validate([
            'announcement_title' => 'required',
            'announcement_desc' => 'required',
        ]);
        try {
            $announcement =  Announcement::find($request->id);
            if ($request->department_id) {

                if ($request->department_id == 'ALL') {
                    $announcement->announcement_department_id = "0";
                } else {
                    $announcement->announcement_department_id = $request->department_id;
                }
            }
            $announcement->announcement_title = $request->announcement_title;
            $announcement->announcement_desc = $request->announcement_desc;
            $announcement->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

        return back()->with('message', 'Announcement Updated Successfully');
    }

    public function deleteAnnouncement($id)
    {
        try {
            $announcement =  Announcement::find($id);
            $announcement->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Announcement Deleted Successfully');
    }

    public function bulkDeleteAnnouncement(Request $request)
    {
        try {
            $announcement = Announcement::where('announcement_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}