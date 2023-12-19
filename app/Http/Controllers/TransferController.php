<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transfer;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use Mail;
use PDF;
class TransferController extends Controller
{
    public function transferAdd(Request $request)
    {
        $validated = $request->validate([
            'transfer_from_department_id' => 'required',
            'transfer_employee_id' => 'required',
            'transfer_to_department_id' => 'required',
            'transfer_to_designation_id' => 'required',
            'transfer_date' => 'required',
            'transfer_desc' => 'required',
        ]);

        // try {

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


            $transfer = new Transfer();
            $transfer->transfer_com_id = Auth::user()->com_id;
            $transfer->transfer_from_department_id = $request->transfer_from_department_id;
            $transfer->transfer_employee_id = $request->transfer_employee_id;
            $transfer->transfer_to_department_id = $request->transfer_to_department_id;
            $transfer->transfer_to_designation_id = $request->transfer_to_designation_id;
            $transfer->transfer_date = $request->transfer_date;
            $transfer->transfer_desc = $request->transfer_desc;
            $transfer->save();

            $employee = User::find($request->transfer_employee_id);
            $employee->department_id = $request->transfer_to_department_id;
            $employee->designation_id = $request->transfer_to_designation_id;
            $employee->save();

            $transfers = Transfer::where('transfer_employee_id',$request->transfer_employee_id)->orderBy('id', 'desc')->first();

            $transfer_date = $transfers->transfer_date;
            $transfer_desc = $transfers->transfer_desc;
            $transfer_from_department = Department::where('id',$transfers->transfer_from_department_id)->first();
            $transfer_to_department =  Department::where('id',$transfers->transfer_to_department_id)->first();
            $transfer_to_designation = Designation::where('id',$transfers->transfer_to_department_id)->first();

            $users = User::where('id', '=', $request->transfer_employee_id)->get(['email', 'first_name', 'last_name','company_assigned_id','department_id','designation_id','id']);

            //$employees = Transfer::where('id',$request->id)->get();

            foreach ($users as $users) {

                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Transfer";
                $notification->notification_title = "You Have A New Transfer Order";
                $notification->notification_to = $request->transfer_employee_id;
                $notification->notification_status = "Unseen";
                $notification->save();

                $data["email"] = $users->email;
                $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                $data["company_assigned_id"] = $users->company_assigned_id;
                $data["company_name"] = Auth::user()->company->company_name;
                $data["from_department_name"] = $transfer_from_department->department_name;
                $data["to_department_name"] = $transfer_to_department->department_name;
                $data["to_designation_name"] = $transfer_to_designation->designation_name;
                $data["transfer_date"] = $transfer_date;
                $data["transfer_desc"] = $transfer_desc;
                $data["subject"] = "Transfer Order";

                $receiver_name = array(
                    'request_receiver_name' => $data["request_receiver_name"],
                );
                $employee_id = array(
                    'request_employee_id' => $data["company_assigned_id"],
                );
                $company_name = array(
                    'company_name' => $data["company_name"],
                );
                $from_department_name = array(
                    'request_to_department_name' => $data["from_department_name"],
                );
                $to_department_name = array(
                    'request_to_department_name' => $data["to_department_name"],
                );
                $to_designation_name = array(
                    'request_to_designation_name' => $data["to_designation_name"],
                );
               $transfer_date = array(
                    'request_transfer_date' => $data["transfer_date"],
                );
                $transfer_dsc = array(
                    'request_transfer_dsc' => $data["transfer_desc"],
                );

                  $pdf = PDF::loadView('back-end.premium.emails.transfer-email', [
                    'employee_id' => $employee_id,
                    'receiver_name' => $receiver_name,
                    'company_name' => $company_name,
                    'from_department_name' => $from_department_name,
                    'to_department_name' => $to_department_name,
                    'to_designation_name' => $to_designation_name,
                    'transfer_date' => $transfer_date,
                    'transfer_dsc' => $transfer_dsc,
                     ]);

                Mail::send('back-end.premium.emails.transfer-email', [
                    'employee_id' => $employee_id,
                    'receiver_name' => $receiver_name,
                    'company_name' => $company_name,
                    'from_department_name' => $from_department_name,
                    'to_department_name' => $to_department_name,
                    'to_designation_name' => $to_designation_name,
                    'transfer_date' => $transfer_date,
                    'transfer_dsc' => $transfer_dsc,
                ], function ($message) use ($data,$pdf) {
                    $message->to($data["email"], $data["request_receiver_name"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), "Transfer-letter.pdf");
                });
            }

            return back()->with('message', 'Added Successfully');
        // } catch (\Exception $e) {
        //     return back()->with('message', 'Plese fill up all requird field.');
        // }
    }

    public function transferById(Request $request)
    {

        $where = array('id' => $request->id);
        $transferByIds = Transfer::where($where)->first();

        return response()->json($transferByIds);
    }

    public function transferUpdate(Request $request)
    {
        try {
            $transfer = Transfer::find($request->id);

            if ($request->edit_transfer_from_department_id) {
                $transfer->transfer_from_department_id = $request->edit_transfer_from_department_id;
            }

            if ($request->edit_transfer_employee_id) {
                $transfer->transfer_employee_id = $request->edit_transfer_employee_id;
            }

            if ($request->edit_transfer_to_department_id) {
                $transfer->transfer_to_department_id = $request->edit_transfer_to_department_id;
            }

            if ($request->edit_transfer_to_designation_id) {
                $transfer->transfer_to_designation_id = $request->edit_transfer_to_designation_id;
            }


            $transfer->transfer_date = $request->transfer_date;
            $transfer->transfer_desc = $request->transfer_desc;
            $transfer->save();

            if ($request->edit_transfer_to_department_id || $request->edit_transfer_to_designation_id) {

                $employee = User::find($request->edit_transfer_employee_id);
                if ($request->edit_transfer_to_department_id) {
                    $employee->department_id = $request->edit_transfer_to_department_id;
                }
                if ($request->edit_transfer_to_designation_id) {
                    $employee->designation_id = $request->edit_transfer_to_designation_id;
                }
                $employee->save();
            }
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function deleteTransfer($id)
    {
        $transfer = Transfer::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteTransfer(Request $request)
    {
        $transfer = Transfer::where('transfer_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

     public function transferletter(Request $request,$id)
    {
        $employees = Transfer::where('id',$request->id)->orderBy('id', 'desc')->get();
          $fileName = "Transfer-letter.pdf";
          $mpdf = new \Mpdf\Mpdf([
              'R'  => 'SolaimanLipi.ttf',
              'margin_top' =>40,
              'margin_bottom' =>30,
              'margin_header' =>5,
              'margin_footer' =>5,
              'orientation' => 'P',
              ]);
          $html = \View::make('back-end.premium.core-hr.transfer.transfer-letter',compact('employees'));
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
