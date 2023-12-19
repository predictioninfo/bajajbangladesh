<?php

namespace App\Http\Controllers;

use App\Models\Termination;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;
use PDF;

class TerminationController extends Controller
{
    public function terminationAdd(Request $request)
    {

        $validated = $request->validate([
            'termination_department_id' => 'required',
            'termination_employee_id' => 'required',
            'termination_type' => 'required',
            'termination_desc' => 'required',
            'termination_date' => 'required',
            'termination_notice_date' => 'required',
        ]);

    // try{
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


            $termination = new Termination();
            $termination->termination_com_id = Auth::user()->com_id;
            $termination->termination_department_id = $request->termination_department_id;
            $termination->termination_employee_id = $request->termination_employee_id;
            $termination->termination_type = $request->termination_type;
            $termination->termination_desc = $request->termination_desc;
            $termination->termination_date = $request->termination_date;
            $termination->termination_notice_date = $request->termination_notice_date;
            $termination->termination_replace_employee_id = $request->termination_replace_employee_id;
            $termination->poor_performance = $request->poor_performance;
            $termination->integrity_problem = $request->integrity_problem;
            $termination->habitual_absent_attendance = $request->habitual_absent_attendance;
            $termination->indecent_behavior = $request->indecent_behavior;

            $termination->save();

            $user = User::findOrFail($request->termination_employee_id);
            $user->replace_employee_id = $request->termination_replace_employee_id;
            $user->inactive_date = $request->termination_date;
            if ($request->has('inactive_date') <= date("Y-m-d")) {
            $user->is_active = '';
            }
            $user->save();

            $terminations = Termination::where('termination_employee_id',$request->termination_employee_id)->orderBy('id', 'desc')->first();

            $termination_date = $terminations->termination_date;
            $termination_desc = $terminations->termination_desc;

            $users = User::where('id', '=', $request->termination_employee_id)->get(['email', 'first_name', 'last_name','company_assigned_id']);

            foreach ($users as $user) {

            $notification = new Notification();
            $notification->notification_token = $random_key;
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Termination";
            $notification->notification_title = "You Have A Termination Notification";
            $notification->notification_to = $request->termination_employee_id;
            $notification->notification_status = "Unseen";
            $notification->save();

            ########email for Employee ##########

            $data["email"] = $user->email;
            $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
            $data["subject"] = "Termination";
            $data["company_name"] = Auth::user()->company->company_assigned_id;
            $data["employee_id"] = $user->company_assigned_id;
            $data["termination_date"] = $termination_date;
            $data["termination_desc"] = $termination_desc;

            $sender_name = array(
                'request_sender_name' => $data["request_sender_name"],
            );
            $company_name = array(
                'company_name' => $data["company_name"],
            );

           $employee_id = array(
                'employee_id' => $data["employee_id"],
            );
           $termination_date = array(
                'termination_date' => $data["termination_date"],
            );
           $termination_desc = array(
                'termination_desc' => $data["termination_desc"],
            );

          $pdf = PDF::loadView('back-end.premium.emails.termination', [
                'employee_id' => $employee_id,
                'sender_name' => $sender_name,
                'company_name' => $company_name,
                'employee_id' => $employee_id,
                'termination_date' => $termination_date,
                'termination_desc' => $termination_desc,
                     ]);

            Mail::send('back-end.premium.emails.termination', [
                'employee_id' => $employee_id,
                'sender_name' => $sender_name,
                'company_name' => $company_name,
                'employee_id' => $employee_id,
                'termination_date' => $termination_date,
                'termination_desc' => $termination_desc,
            ], function ($message) use ($data,$pdf) {
                $message->to($data["email"], $data["request_sender_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "Transfer-letter.pdf");
            });

        return back()->with('message', 'Added Successfully');
            ######## email for Employee ends ##########
        }

        return back()->with('message', 'Added Successfully');
    // } catch (\Exception $e) {
    //     return back()->with('message', 'Plese fill up all requird field.');
    // }
    }

    public function terminationById(Request $request)
    {

        $where = array('id' => $request->id);
        $terminationByIds = Termination::where($where)->first();

        return response()->json($terminationByIds);
    }

    public function terminationUpdate(Request $request)
    {
        $validated = $request->validate([
            'edit_termination_department_id' => 'required',
            'termination_type' => 'required',
            'termination_date' => 'required',
            'termination_notice_date' => 'required',
        ]);
    try{
        $termination = Termination::find($request->id);
        $termination->termination_department_id = $request->edit_termination_department_id;
        if($request->edit_termination_employee_id){
            $termination->termination_employee_id = $request->edit_termination_employee_id;
        }
        $termination->termination_type = $request->termination_type;
        $termination->termination_desc = $request->termination_desc;
        $termination->termination_date = $request->termination_date;
        $termination->termination_notice_date = $request->termination_notice_date;

        $termination->termination_replace_employee_id = $request->termination_replace_employee_id;
        $termination->poor_performance = $request->poor_performance;
        $termination->integrity_problem = $request->integrity_problem;
        $termination->habitual_absent_attendance = $request->habitual_absent_attendance;
        $termination->indecent_behavior = $request->indecent_behavior;

        $termination->save();

        $user = User::findOrFail($request->edit_termination_employee_id);
        if ($request->has('inactive_date') <= date("Y-m-d")) {
        $user->is_active = '';
        }
        $user->replace_employee_id = $request->termination_replace_employee_id;
        $user->inactive_date = $request->termination_date;
        $user->save();

        return back()->with('message','Updated Successfully');
    } catch (\Exception $e) {
        return back()->with('message', 'Plese fill up all requird field.');
    }
    }

    public function deleteTermination($id)
    {
        $termination_user_update = Termination::where('id',$id)->first('termination_employee_id');

        $user = User::findOrFail($termination_user_update->termination_employee_id);
        $user->replace_employee_id = null;
        $user->inactive_date = null;
        $user->save();

        $termination = Termination::where('id',$id)->delete();

        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteTermination(Request $request)
    {
        $termination = Termination::where('termination_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
    public function terminationLetter(Request $request,$id){
        $employees = Termination::where('id',$id)->get();
          $fileName = "Termination-letter.pdf";
          $mpdf = new \Mpdf\Mpdf([
              'R'  => 'SolaimanLipi.ttf',
              'margin_top' =>40,
              'margin_bottom' =>30,
              'margin_header' =>5,
              'margin_footer' =>5,
              'orientation' => 'P',
              ]);
          $html = \View::make('back-end.premium.core-hr.termination.termination-letter',compact('employees'));
          $html = $html->render();

            $logo = url('/uploads/logos/logo.png');

            $htmlHeader = '<html><div>'
            . '<div><img src="'.$logo.'"  style="max-height: 35px; padding-left:5%;"/></div>'
            . '</div></html>';

          $htmlFooter = '<html><div>'
          .' <div style="font-size: 10px;text-align:center;"> Prediction Learning Associates Ltd., 365/9, Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
             Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: <span style="color:blue;">info@predictionla.com</span></div>'
         .'</div></html>';

          $mpdf->SetHTMLHeader($htmlHeader);
          $mpdf->SetHTMLFooter($htmlFooter);
          $mpdf->WriteHTML($html);
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->Output($fileName,'D');
    }
}