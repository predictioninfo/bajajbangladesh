<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    public function seeAll($id)
	{
        $see_alls = Notification::where('notification_to',$id)->get(['id']);

        foreach($see_alls as $see_alls_value){
            $notification = Notification::find($see_alls_value->id);
            $notification->notification_status = 'Seen';
            $notification->save();
        }

        return back();

    }

    public function clearAll($id)
	{
        $notification = Notification::where('notification_to',$id)->delete();
        return back();
    }


    public function seenByPage($id)
    {
        $notification = Notification::find($id);
        $notification->notification_status = 'Seen';
        $notification->save();
        return response()->json($notification);
    }

    ########## push notification functions start from here ############

        public function push()
        {
            return view('back-end.premium.push');
        }

        public function saveToken(Request $request)
        {

        //    $id_array = [6,7];
        //    $id_array = array("6","7");

        //    foreach($id_array as $id_array_value){

        //         $user = User::find($id_array_value);
        //         $user->device_token = $request->token;
        //         $user->save();
        //    }

            auth()->user()->update(['device_token'=>$request->token]);
            return response()->json(['token saved successfully.']);
        }

       public function sendNotification(Request $request)
        {
            //$firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
            $firebaseTokens = User::where('com_id',Auth::user()->com_id)->whereNotNull('device_token')->get(['device_token']); //ok
            //$firebaseTokens = User::where('id',7978)->whereNotNull('device_token')->get(['device_token']); //ok

            $SERVER_API_KEY = 'AAAAmyJq3eE:APA91bHOr3wzgheEkY2lsdwOqIMKtUmZ48VXV1_ZS1HKpp7KkyInrzA-QuvcPE_7spNaMc0xm4GE_iI6HK4qg_LLTnMcb54kkBisbK8IWEMYM4Rti2HoFvxxqpUZIowhlxahPOAC9SFr';

         $details_array = array();
            foreach($firebaseTokens as $firebaseTokens_value){

                $data = [
                "registration_ids" => [$firebaseTokens_value->device_token],
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->body,
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

            array_push($details_array,$response);
             }
           // dd($details_array);
                return back();





           //echo json_encode($response);
        }

    ########## push notification functions end here ############

}
