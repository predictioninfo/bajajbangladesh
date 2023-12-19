<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use pdf;



class PersonalDetailsDownloadController extends Controller
{

    public function personalDetailsShow()
    {
        $employee_value = User::where('id', '=', Session::get('employee_setup_id'))->first();
        $user = User::with('userdesignation','userdepartment','emoloyeedetail','educationdetail','experienceLetter')
            ->where('id', Session::get('employee_setup_id'))
            ->select('id', 'first_name', 'last_name', 'experience_letter_id', 'company_assigned_id','joining_date','designation_id','department_id')
            ->firstOrFail();
        return view('back-end.premium.user-settings.general.personal-details-show',get_defined_vars());

    }

    public function personalDetailsDownload(){
        $employee_value = User::where('id', '=', Session::get('employee_setup_id'))->first();
        $user = User::with('userdesignation','userdepartment','emoloyeedetail','educationdetail','experienceLetter')
            ->where('id', Session::get('employee_setup_id'))
            ->select('id', 'first_name', 'last_name', 'company_assigned_id','joining_date','designation_id','department_id')
            ->first();
        // return view('back-end.premium.user-settings.general.personal-details-download', get_defined_vars());
        $fileName = $user->first_name . "'s " . "Employee Details" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);  
        
        $html = \View::make('back-end.premium.user-settings.general.personal-details-download', get_defined_vars());
        
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
}
