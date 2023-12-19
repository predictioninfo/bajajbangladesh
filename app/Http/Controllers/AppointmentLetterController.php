<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;

class AppointmentLetterController extends Controller
{
    public function employeeAppointmentLetterGenerate(Request $request)
    {
        try {
            //     $employee_details_value = User::where('id','=',Session::get('employee_setup_id'))->first();
            //     $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
            //     $department_value = Department::where('id','=',$employee_details_value->department_id)->first();
            //     $designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();
            //         //echo json_encode($employee_details); exit;


            //         $headers = array(
            //             'Content-type ' => 'text/html',
            //             'Content-Disposition' =>'attatchment;Filename=mydoc.doc'

            //             );
            //             return \Response::make(view('back-end.premium.user-settings.general.employee-appointment-letter-pdf',compact('employee_details_value','company_details_value','department_value','designation_value')),200,$headers);

            // // $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-appointment-letter-pdf',[
            // //                 'employee_details_value' => $employee_details_value,
            // //                 'company_details_value' => $company_details_value,
            // //                 'department_value' => $department_value,
            // //                 'designation_value' => $designation_value,
            // //             ]);
            // //      $pdf->download('appointment-letter.pdf');
            // //    return back();

            $employee_details_value = User::where('id', '=', Session::get('employee_setup_id'))->first();
            $company_details_value = Company::where('id', '=', $employee_details_value->com_id)->first();
            $department_value = Department::where('id', '=', $employee_details_value->department_id)->first();
            $designation_value = Designation::where('id', '=', $employee_details_value->designation_id)->first();

            $employee_details_value_all = User::with('emoloyeedetail')->where('id', '=', Session::get('employee_setup_id'))->get();
            //echo json_encode($employee_details); exit;
            //  $logo = url('/uploads/logos/logo.png');
            // $htmlHeader = '<html><div>'
            // . '<div><img src="'.$logo.'"  style="max-height: 35px; padding-left:5%;"/></div>'
            // . '</div></html>';

            // $headers = array(
            // 'Content-type ' => 'text/html',
            // 'Content-Disposition' =>'attatchment;Filename=appointment-letter.doc',

            // );
            //   $head = header('Content-Type', 'text/plain');
            // $file_name ="mydoc.doc";
            // return \Response::make(view('back-end.premium.user-settings.general.employee-appointment-letter-pdf',compact('employee_details_value','company_details_value','department_value','designation_value')),800,$file_name);

            // 	return \Response::make(view('back-end.premium.user-settings.general.employee-appointment-letter-word',[
            //     'employee_details_value' => $employee_details_value_all,
            //     'company_details_value' => $company_details_value,
            //     'department_value' => $department_value,
            //     'designation_value' => $designation_value,
            // ]),200,$headers);


            // $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-appointment-letter-pdf', [
            //     'employee_details_value' => $employee_details_value_all,
            //     'company_details_value' => $company_details_value,
            //     'department_value' => $department_value,
            //     'designation_value' => $designation_value,
            // ]);
            // $pdf->download('appointment-letter.pdf');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back();
    }
    public function employeeAppointmentLetter(Request $request)
    {
        try {
            $mpdf = new \Mpdf\Mpdf([
                'default_font' => 'nikosh',
                'mode' => 'utf-8',

            ]);
            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->join('pay_slips', 'pay_slips.id', '=', 'users.id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->where('com_id', Auth::user()->com_id)
                ->get();

            //$employee_details_value = User::where('id','=',Session::get('employee_setup_id'))->first();
            // $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
            // $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
            //$department_value = Department::where('id','=',$employee_details_value->department_id)->first();
            //$designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();
            //echo json_encode($employee_details); exit;

            $pdf = PDF::loadView('appointmentletter', [
                'employee_details_value' => $employee_details_value,
                // 'company_details_value' => $company_details_value,
                // 'department_value' => $department_value,
                // 'designation_value' => $designation_value,
            ]);

            $pdf->stream();
            $mpdf->WriteHTML($pdf);

            return $mpdf->Output();
            //  $pdf->download('appointment-letter.pdf');
            // return back();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
