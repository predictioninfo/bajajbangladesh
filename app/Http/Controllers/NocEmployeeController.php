<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\NonObjectionCertificate;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\NocEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Image;
use Mail;
use PDF;

class NocEmployeeController extends Controller
{
    public function nocEmployeeIndex(Request $request)
    {
        try {
            $core_hr_sub_module_twelve_add = "4.12.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_twelve_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $core_hr_sub_module_twelve_edit = "4.12.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_twelve_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $core_hr_sub_module_twelve_delete = "4.12.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_twelve_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }

            $noc_employees = NocEmployee::where('noc_com_id', Auth::user()->com_id)
                ->WithNocFilters(
                    $request->noc_employee_id,
                    $request->start_date_of_issue,
                    $request->end_date_of_issue,
                )
                ->orderBy('id', 'DESC')
                ->get();
            $employees = User::where('com_id', Auth::user()->com_id)
                ->orderBy('id', 'DESC')
                ->whereNull('company_profile')
                ->where('is_active', 1)
                ->get(['id', 'first_name', 'last_name']);
            $noc_employee_list = User::where('com_id', Auth::user()->com_id)
                ->orderBy('id', 'DESC')
                ->whereNull('company_profile')->where('is_active', 1)
                ->whereNotNull('noc_id')
                ->where('noc_eligiblity_status', 0)
                ->get(['id', 'first_name', 'last_name']);
            $noc_templates = NonObjectionCertificate::where('non_objection_certificate_com_id', Auth::user()->com_id)
                ->get(['id', 'non_objection_certificate_subject']);
            $request->session()->put('noc_employees',  $noc_employees);
            return view('back-end.premium.core-hr.noc.index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
    public function nocEmployeeAdd(Request $request)
    {
        $validated = $request->validate([
            'noc_document' => 'required|file|mimes:jpeg,png,gif,pdf'
        ]);

        $noc_employee = new NocEmployee();
        $noc_employee->noc_com_id = Auth::user()->com_id;
        $noc_employee->noc_employee_id = $request->noc_employee_id;
        $noc_employee->noc_template_id = $request->noc_template_id;
        $noc_employee->place_of_issue = $request->place_of_issue;
        $noc_employee->date_of_issue = $request->date_of_issue;
        $noc_employee->date_of_expiry = $request->date_of_expiry;
        $noc_employee->purpose_of_noc = $request->purpose_of_noc;
        $noc_employee->description = $request->description;
        $noc_employee->status = 0;
        $noc_employee->noc_eligiblity_status = 0;
        $image = $request->file('noc_document');
        $input['imagename'] = time() . '.' . $image->extension();
        $filePath = 'uploads/employee-document-files';
        $imageUrl = $filePath . '/' . $input['imagename'];
        $imageStoring = $image->move($filePath, $input['imagename']);

        $noc_employee->noc_document = $imageUrl;
        $noc_employee->save();

        $user = User::where('id', $request->noc_employee_id)->firstOrFail();
        $user->noc_id = $noc_employee->noc_template_id;
        $user->noc_eligiblity_status = 0;
        $user->save();

        return redirect('noc-employee')->with('message', 'Added Successfully');
    }


    public function nocEmployeeEdit(Request $request)
    {
        $where = array('id' => $request->id);
        $edit_noc_employee = NocEmployee::where($where)->first();

        return response()->json($edit_noc_employee);
    }

    public function nocEmployeeUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            $noc_employee =  NocEmployee::find($request->id);
            $noc_employee->noc_com_id = Auth::user()->com_id;
            $noc_employee->noc_employee_id = $request->noc_employee_id;
            $noc_employee->noc_template_id = $request->noc_template_id;
            $noc_employee->place_of_issue = $request->place_of_issue;
            $noc_employee->date_of_issue = $request->date_of_issue;
            $noc_employee->date_of_expiry = $request->date_of_expiry;
            $noc_employee->purpose_of_noc = $request->purpose_of_noc;
            $noc_employee->description = $request->description;
            $noc_employee->status = 0;
            if ($request->noc_document) {
                $validatedData = $request->validate([
                    'noc_document' => 'mimes:jpeg,png,gif,pdf'
                ]);

                $image = $request->file('noc_document');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/employee-document-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $noc_employee->noc_document = $imageUrl;
            } else {
                $noc_employee->noc_document = $request->edit_previewContainer_hidden;
            }
            $noc_employee->save();
            $user = User::where('id', $request->noc_employee_id)->firstOrFail();
            $user->noc_id = $noc_employee->noc_template_id;
            $user->save();
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'Plese insert valid data');
        }
    }
    public function nocEmployeeDeletet($id)
    {
        $noc_employee = NocEmployee::where('id', $id)->first();
        NocEmployee::where('id', $noc_employee->id)->delete();
        User::where('id', $noc_employee->noc_employee_id)->update(['noc_id' => null]);
        return back()->with('message', 'Deleted Successfully');
    }
    public function nocRequestApprove(Request $request)
    {
        NocEmployee::where('id', $request->id)
            ->update([
                'noc_com_id' => Auth::user()->com_id,
                'noc_template_id' => $request->approve_noc_template_id,
                'status' => 1
            ]);
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

        $employee =  NocEmployee::where('id', $request->id)->first('noc_employee_id');
        $user = User::where('id', '=', $employee->noc_employee_id)
            ->first(['email', 'first_name', 'last_name', 'company_assigned_id']);

        $notification = new Notification();
        $notification->notification_token = $random_key;
        $notification->notification_com_id = Auth::user()->com_id;
        $notification->notification_type = "NOC Approve";
        $notification->notification_title = "You Have A NOC Approve Notification";
        $notification->notification_to = $employee->noc_employee_id;
        $notification->notification_from =  Auth::user()->id;
        $notification->notification_status = "Unseen";
        $notification->save();

        $data["email"] = $user->email;
        $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
        $data["subject"] = "NOC Approve";
        $data["company_name"] = Auth::user()->company->company_assigned_id;
        $data["employee_id"] = $user->company_assigned_id;

        $sender_name = array(
            'request_sender_name' => $data["request_sender_name"],
        );
        $company_name = array(
            'company_name' => $data["company_name"],
        );

        $employee_id = array(
            'employee_id' => $data["employee_id"],
        );

        $pdf = PDF::loadView('back-end.premium.emails.noc-approve', [
            'employee_id' => $employee_id,
            'sender_name' => $sender_name,
            'company_name' => $company_name,
            'employee_id' => $employee_id,
        ]);

        Mail::send('back-end.premium.emails.noc-approve', [
            'employee_id' => $employee_id,
            'sender_name' => $sender_name,
            'company_name' => $company_name,
            'employee_id' => $employee_id,
        ], function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["request_sender_name"])
                ->subject($data["subject"])
                ->attachData($pdf->output(), "Transfer-letter.pdf");
        });
        return back()->with('message', 'Approve Successfully');
    }
    public function nocRequestDisapprove($id)
    {
        NocEmployee::where('id', $id)
            ->update([
                'noc_com_id' => Auth::user()->com_id,
                'status' => 0
            ]);
        function generateRandomStringForDisapprove($length = 25)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $random_key = generateRandomStringForDisapprove();

        $employee =  NocEmployee::where('id', $id)->first('noc_employee_id');
        $user = User::where('id', '=', $employee->noc_employee_id)
            ->first(['email', 'first_name', 'last_name', 'company_assigned_id']);

        $notification = new Notification();
        $notification->notification_token = $random_key;
        $notification->notification_com_id = Auth::user()->com_id;
        $notification->notification_type = "NOC Disapprove";
        $notification->notification_title = "You Have A NOC Disapprove Notification";
        $notification->notification_to = $employee->noc_employee_id;
        $notification->notification_from =  Auth::user()->id;
        $notification->notification_status = "Unseen";
        $notification->save();

        $data["email"] = $user->email;
        $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
        $data["subject"] = "NOC Disapprove";
        $data["company_name"] = Auth::user()->company->company_assigned_id;
        $data["employee_id"] = $user->company_assigned_id;

        $sender_name = array(
            'request_sender_name' => $data["request_sender_name"],
        );
        $company_name = array(
            'company_name' => $data["company_name"],
        );

        $employee_id = array(
            'employee_id' => $data["employee_id"],
        );

        $pdf = PDF::loadView('back-end.premium.emails.noc-disapprove', [
            'employee_id' => $employee_id,
            'sender_name' => $sender_name,
            'company_name' => $company_name,
            'employee_id' => $employee_id,
        ]);

        Mail::send('back-end.premium.emails.noc-disapprove', [
            'employee_id' => $employee_id,
            'sender_name' => $sender_name,
            'company_name' => $company_name,
            'employee_id' => $employee_id,
        ], function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["request_sender_name"])
                ->subject($data["subject"])
                ->attachData($pdf->output(), "Transfer-letter.pdf");
        });
        return back()->with('message', 'Disapprove Successfully');
    }
    public function nocEmployeePdf($id)
    {
        $company_logo = Company::where('id', Auth::user()->com_id)->first();
        $noc_employee =  NocEmployee::with(['nocemployee' => function ($q) {
            $q->with(['emoloyeedetail' => function ($q) {
                $q->with('userNationality');
            }, 'userdesignation', 'userdepartment']);
        }, 'noctemplate' => function ($q) {
            $q->with(['signatory' => function ($q) {
                $q->with('userdesignation', 'userdepartment');
            }]);
        }])->where('id', $id)->first();
        $fileName = $noc_employee->nocemployee->first_name . "'s " . "NOC" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'P',
        ]);

        $html = \View::make('back-end.premium.core-hr.noc.pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
    public function nocEmployeeShow(Request $request)
    {
        $company_logo = Company::where('id', Auth::user()->com_id)->first();
        $noc_employee =  NocEmployee::with(['nocemployee' => function ($q) {
            $q->with(['emoloyeedetail' => function ($q) {
                $q->with('userNationality');
            }, 'userdesignation', 'userdepartment']);
        }, 'noctemplate' => function ($q) {
            $q->with(['signatory' => function ($q) {
                $q->with('userdesignation', 'userdepartment');
            }]);
        }])->where('id', $request->id)->first();
        return response()->json(get_defined_vars());
    }
    public function allNocEmployeePdf(Request $request)
    {
        $company_logo = Company::where('id', Auth::user()->com_id)->first();
        $data = $request->session()->get('noc_employees');
        $fileName = "All NOC Employee" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'p',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.core-hr.noc.all-noc-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
    public function NocApprovalIndex()
    {
        $noc_lists = NocEmployee::where('noc_com_id', Auth::user()->com_id)
            ->orderBy('id', 'DESC')
            ->where('noc_employee_id', Session::get('employee_setup_id'))
            ->get();
        return view('back-end.premium.core-hr.noc.appoval', get_defined_vars());
    }
    public function NocApprovalRequest(Request $request)
    {
        $validated = $request->validate([
            'noc_document' => 'required|file|mimes:jpeg,png,gif,pdf'
        ]);
        $noc_employee = new NocEmployee();
        $noc_employee->noc_com_id = Auth::user()->com_id;
        $noc_employee->noc_employee_id = Session::get('employee_setup_id');
        $noc_employee->place_of_issue = $request->place_of_issue;
        $noc_employee->date_of_issue = $request->date_of_issue;
        $noc_employee->date_of_expiry = $request->date_of_expiry;
        $noc_employee->purpose_of_noc = $request->purpose_of_noc;
        $noc_employee->description = $request->description;
        $noc_employee->status = 0;
        $image = $request->file('noc_document');
        $input['imagename'] = time() . '.' . $image->extension();
        $filePath = 'uploads/employee-document-files';
        $imageUrl = $filePath . '/' . $input['imagename'];
        $imageStoring = $image->move($filePath, $input['imagename']);

        $noc_employee->noc_document = $imageUrl;
        $noc_id = User::where('id', Session::get('employee_setup_id'))->first('noc_id');
        if ($noc_id) {
            $noc_employee->noc_template_id = $noc_id->noc_id;
        } else {
            $noc_employee->noc_template_id = null;
        }

        $noc_employee->save();
        return redirect('noc-approval-index')->with('message', 'Added Succesfully');
    }
    public function NocApprovalRequestEdit(Request $request)
    {
        $where = array('id' => $request->id);
        $edit_noc_employee = NocEmployee::where($where)->first();

        return response()->json($edit_noc_employee);
    }
    public function approvalRequestUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            $noc_employee =  NocEmployee::find($request->id);
            $noc_employee->noc_com_id = Auth::user()->com_id;
            $noc_employee->noc_employee_id = Session::get('employee_setup_id');
            $noc_employee->place_of_issue = $request->place_of_issue;
            $noc_employee->date_of_issue = $request->date_of_issue;
            $noc_employee->date_of_expiry = $request->date_of_expiry;
            $noc_employee->purpose_of_noc = $request->purpose_of_noc;
            $noc_employee->description = $request->description;
            $noc_employee->status = 0;
            if ($request->noc_document) {
                $validatedData = $request->validate([
                    'noc_document' => 'mimes:jpeg,png,gif,pdf'
                ]);

                $image = $request->file('noc_document');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/employee-document-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $noc_employee->noc_document = $imageUrl;
            } else {
                $noc_employee->noc_document = $request->edit_previewContainer_hidden;
            }
            $noc_id = User::where('id', Session::get('employee_setup_id'))->first('noc_id');
            if ($noc_id) {
                $noc_employee->noc_template_id = $noc_id->noc_id;
            } else {
                $noc_employee->noc_template_id = null;
            }
            $noc_employee->save();
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'Plese insert valid data');
        }
    }
    public function nocRequestShow(Request $request)
    {
        $company_logo = Company::where('id', Auth::user()->com_id)->first();
        $noc_employee =  NocEmployee::with(['nocemployee' => function ($q) {
            $q->with(['emoloyeedetail' => function ($q) {
                $q->with('userNationality');
            }, 'userdesignation', 'userdepartment']);
        }, 'noctemplate' => function ($q) {
            $q->with(['signatory' => function ($q) {
                $q->with('userdesignation', 'userdepartment');
            }]);
        }])->where('id', $request->id)->first();
        return response()->json(get_defined_vars());
    }
    public function nocRequestPdf($id)
    {
        $company_logo = Company::where('id', Auth::user()->com_id)->first();
        $noc_employee =  NocEmployee::with(['nocemployee' => function ($q) {
            $q->with(['emoloyeedetail' => function ($q) {
                $q->with('userNationality');
            }, 'userdesignation', 'userdepartment']);
        }, 'noctemplate' => function ($q) {
            $q->with(['signatory' => function ($q) {
                $q->with('userdesignation', 'userdepartment');
            }]);
        }])->where('id', $id)->first();
        $fileName = $noc_employee->nocemployee->first_name . "'s " . "NOC" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'P',
        ]);

        $html = \View::make('back-end.premium.core-hr.noc.request-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
    public function nocRequestDeletet($id)
    {
        $noc = NocEmployee::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
    public function nocUnacceptable($id)
    {
        User::where('com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->update(['noc_eligiblity_status' => 1]);
        NocEmployee::where('noc_com_id', Auth::user()->com_id)
            ->where('noc_employee_id', $id)
            ->update(['noc_eligiblity_status' => 1]);
        return back()->with('message', 'Noc Unacceptable Successfully!');
    }
}
