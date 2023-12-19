<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Resignation;
use Illuminate\Http\Request;
use Auth;
use Mail;
use DB;
use PDF;
class ResignationController extends Controller
{
    public function resignationAdd(Request $request)
    {
        $validated = $request->validate([
            'resignation_department_id' => 'required',
            'resignation_employee_id' => 'required',
            'resignation_notice_date' => 'required',
            'resignation_date' => 'required',
        ]);
         try {
            $resignation = new Resignation();
            $resignation->resignation_com_id = Auth::user()->com_id;
            $resignation->resignation_department_id = $request->resignation_department_id;
            $resignation->designation_id = $request->designation_id;
            $resignation->resignation_employee_id = $request->resignation_employee_id;
            $resignation->work_pressure_or_office_time = $request->work_pressure_or_office_time;
            $resignation->rude_behaviours_by_supervisor = $request->rude_behaviours_by_supervisor;
            $resignation->better_oppurtunity = $request->better_oppurtunity;
            $resignation->doing_bussiness_or_others_mention = $request->doing_bussiness_or_others_mention;
            $resignation->absent = $request->absent;
            $resignation->other = $request->other;
            $resignation->showthis = $request->showthis;
            $resignation->resignation_notice_date = $request->resignation_notice_date;
            $resignation->resignation_date = $request->resignation_date;
            $resignation->resignation_desc = $request->resignation_desc;
            $resignation->status = 0;
            $resignation->save();

            $resignations  = Resignation::where('resignation_employee_id',$request->resignation_employee_id)->orderBy('id', 'desc')->first();

            $resignation_date = $resignations->resignation_date;
            $resignation_desc = $resignations->resignation_desc;

            $users = User::where('id', '=', $request->resignation_employee_id)->get(['email', 'first_name', 'last_name','company_assigned_id','report_to_parent_id']);

            foreach ($users as $user) {

            $supervisor = User::where('id', '=', $user->report_to_parent_id)->first(['email','report_to_parent_id']);

            $second_supervisor = User::where('id', '=', $supervisor->report_to_parent_id)->first(['email','report_to_parent_id']);

            ########email for Employee ##########

            $data["email"] = $supervisor->email;
            $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
            $data["subject"] = "Resignation Letter";
            $data["employee_id"] = $user->company_assigned_id;
            $data["resignation_desc"] = $resignation_desc;
            $data["resignation_date"] = $resignation_date;

            $sender_name = array(
                'request_sender_name' => $data["request_sender_name"],
            );
           $employee_id = array(
                'employee_id' => $data["employee_id"],
            );
           $resignation_desc = array(
                'resignation_desc' => $data["resignation_desc"],
            );
           $resignation_date = array(
                'resignation_date' => $data["resignation_date"],
            );
           $pdf = PDF::loadView('back-end.premium.emails.resignation-letter', [
                'employee_id' => $employee_id,
                'sender_name' => $sender_name,
                'resignation_desc' => $resignation_desc,
                'resignation_date' => $resignation_date,
                ]);


            Mail::send('back-end.premium.emails.resignation-letter', [
                'employee_id' => $employee_id,
                'sender_name' => $sender_name,
                'resignation_desc' => $resignation_desc,
                'resignation_date' => $resignation_date,

            ], function ($message) use ($data,$pdf) {
                $message->to($data["email"], $data["request_sender_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "Resignation-letter.pdf");
            });

            if($second_supervisor){
            $data["email"] = $second_supervisor->email;
            Mail::send('back-end.premium.emails.resignation-letter', [
                'employee_id' => $employee_id,
                'sender_name' => $sender_name,
                'resignation_desc' => $resignation_desc,
                'resignation_date' => $resignation_date,

            ], function ($message) use ($data,$pdf) {
                $message->to($data["email"], $data["request_sender_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "Resignation-letter.pdf");
            });

            }
            }
            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function resignationById(Request $request)
    {

        $where = array('id' => $request->id);
        $resignationByIds = Resignation::where($where)->first();

        return response()->json($resignationByIds);
    }

    public function resignationUpdate(Request $request)
    {
        $validated = $request->validate([
            'edit_resignation_department_id' => 'required',
            'resignation_notice_date' => 'required',
            'resignation_date' => 'required',

        ]);
        try {
        $resignation = Resignation::find($request->id);
        $resignation->resignation_department_id = $request->edit_resignation_department_id;
        $resignation->designation_id = $request->edit_designation_id;
        $resignation->resignation_employee_id = $request->edit_employee_id;
        $resignation->work_pressure_or_office_time = $request->work_pressure_or_office_time;
        $resignation->rude_behaviours_by_supervisor = $request->rude_behaviours_by_supervisor;
        $resignation->better_oppurtunity = $request->better_oppurtunity;
        $resignation->doing_bussiness_or_others_mention = $request->doing_bussiness_or_others_mention;
        $resignation->absent = $request->absent;
        $resignation->other = $request->other;
        if ($request->showthis) {
            $resignation->showthis = $request->showthis;
        } elseif ($request->edit_specific_reason) {
            $resignation->showthis = $request->edit_specific_reason;
        }
        $resignation->resignation_notice_date = $request->resignation_notice_date;
        $resignation->resignation_date = $request->resignation_date;
        $resignation->resignation_desc = $request->resignation_desc;
        $resignation->save();

        return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }


  public function approveResignation(Request $request, $id)
    {
        $resignation = Resignation::where('id',$id)->first();
        $users_data = User::where('id',$resignation->resignation_employee_id)->first();
        if(date('Y-m-d') >= $resignation->resignation_date){
        $user_in_active = User::where('id',$resignation->resignation_employee_id)
                                    ->update(['inactive_date' => $resignation->resignation_date,
                                              'is_active' => '',
                                              'email' => null,
                                              'phone' => null,
                                              'username' => null,
                                              'inactive_email' => $users_data->email,
                                              'inactive_phone' => $users_data->phone,
                                              'inactive_username' => $users_data->username,
                                              'replace_employee_id'=>$request->replace_employee_id,
                                              'resignation_letter_acceptance_id'=>$request->resignation_letter_acceptance_id]);
        }
        else{
        $user_in_active = User::where('id',$resignation->resignation_employee_id)
                                    ->update(['inactive_date' => $resignation->resignation_date,
                                                'replace_employee_id'=>$request->replace_employee_id,
                                                'resignation_letter_acceptance_id'=>$request->resignation_letter_acceptance_id]);
        }

        $resignations = Resignation::where('id',$id)->update(['status' => 1,'resignation_letter_acceptance_id'=>$request->resignation_letter_acceptance_id]);


          $users = User::where('id', '=', $resignation->resignation_employee_id)->get(['email', 'first_name', 'last_name','company_assigned_id','report_to_parent_id']);

            foreach ($users as $user) {
            ########email for Employee ##########
            $data["email"] = $user->email;
            $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
            $data["subject"] = "Approved Resignation Letter";
            $data["status"] = "Your Resignation Letter is Approve";

           $status = array(
                'status' => $data["status"],
            );
           $sender_name = array(
                'request_sender_name' => $data["request_sender_name"],
            );
            Mail::send('back-end.premium.emails.approved-resignation-letter', [
                'status' => $status,
                'sender_name' => $sender_name,
            ], function ($message) use ($data) {
                $message->to($data["email"], $data["request_sender_name"])
                    ->subject($data["subject"]);
            });
            }

        return back()->with('message','Approve Successfully');
    }

    public function deleteResignation($id)
    {
        $resignation = Resignation::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteResignation(Request $request)
    {
        try {
            $resignation = Resignation::where('resignation_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function ResignationLetterDownload(Request $request,$id){

         $employees = Resignation::where('id',$request->id)->first();

        $fileName = "Resignation-letter.pdf";

        $mpdf = new \Mpdf\Mpdf([
              'R'  => 'SolaimanLipi.ttf',
              'margin_top' =>40,
              'margin_bottom' =>30,
              'margin_header' =>5,
              'margin_footer' =>5,
              'orientation' => 'P',
              ]);

        $html = \View::make('back-end.premium.core-hr.resignation.resignation-letter',compact('employees'));
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName,'D');
    }

    public function ResignationLetterAcceptanceDownload(Request $request,$id){

       $employee = Resignation::where('resignation_letter_acceptance_id',$id)->first();

        $fileName = "Resignation-Acceptance-letter.pdf";

        $mpdf = new \Mpdf\Mpdf([
              'R'  => 'SolaimanLipi.ttf',
              'margin_top' =>40,
              'margin_bottom' =>30,
              'margin_header' =>5,
              'margin_footer' =>5,
              'orientation' => 'P',
              ]);

        $html = \View::make('back-end.premium.core-hr.resignation.resignation-letter-download',compact('employee'));
        $html = $html->render();

        $logo_header = asset($employee->resignationAcceptance->Header->logo ?? null);
        $logo = url($logo_header);
        $footer=  $employee->resignationAcceptance->resignation_letter_footer ?? null;

        if($employee->resignationAcceptance && $employee->resignationAcceptance->resignation_letter_header_id){
            $htmlHeader = '<html><div>'
            . '<div><img src="' . $logo . '"  style="max-height: 35px;"/></div>'
            . '</div></html>';
        }else{
            $htmlHeader = '<html><div>'
            . '<div></div>'
            . '</div></html>';
        }

        $htmlFooter = '<html><div>'
                . ' <div style="font-size: 10px;text-align:center;"> ' . $footer . ' </div>'
                . '</div></html>';

        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
}