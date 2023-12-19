<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Region;
use App\Models\Role;
use App\Models\Locatoincustomize;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\SalaryIncrement;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use PDF;

class IdCardController extends Controller
{
    public function employeeIdCardDownload(Request $request)
    {
       
        //echo "ok"; exit;
        $employee_details_value = User::where('id', '=', Session::get('employee_setup_id'))->first();
        $company_details_value = Company::where('id', '=', $employee_details_value->com_id)->first();
        $department_value = Department::where('id', '=', $employee_details_value->department_id)->first();
        $designation_value = Designation::where('id', '=', $employee_details_value->designation_id)->first();
        //echo json_encode($employee_details); exit;
        $down = $employee_details_value->company_assigned_id;
        $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-id-card-pdf', [
            'employee_details_value' => $employee_details_value,
            'company_details_value' => $company_details_value,
            'department_value' => $department_value,
            'designation_value' => $designation_value,
        ]);
        // return $pdf->stream();
        $pdf->download('Id-Card-' . $down . '.pdf');
        //return back();
    }
    public function employeeIdCard(Request $request)
    {

        //echo "ok"; exit;
        $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
            ->where('com_id', Auth::user()->com_id)
            ->where('roles.roles_name', '=', 'Employee')
            ->where('is_active', 1)
            ->get();

        $fileName = "idcard.pdf";
        $mpdf = new \Mpdf\Mpdf([
            'R'  => 'SolaimanLipi.ttf',
            'margin_top' => 40,
            'margin_bottom' => 30,
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
        ]);
        $html = \View::make('idcardbangla', compact('employee_details_value'));
        $html = $html->render();

        // $logo = url('/uploads/logos/logo.png');

        // $htmlHeader = '<html><div>'
        // . '<div><img src="'.$logo.'"  style="max-height: 35px; padding-left:5%;"/></div>'
        // . '</div></html>';

        //   $htmlFooter= '<html><div>'
        //   .' <div style="font-size: 10px;text-align:center;"> Prediction Learning Associates Ltd., 365/9, Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
        //      Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: <span style="color:blue;">info@predictionla.com</span></div>'
        //  .'</div></html>';

        //   $mpdf->SetHTMLHeader($htmlHeader);
        //   $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');


        //echo json_encode($employee_details_value); exit;

        //return view('idcard',compact('employee_details_value'));
        //  $pdf = PDF::loadView('idcard',[
        //              'employee_details_value' => $employee_details_value
        //          ]);
        // return $pdf->stream();
        // $pdf->download('Idcard.pdf');
        //return back();
    }
    public function Ereport()
    {
        $employee_report =  User::where('is_Active', '=', 1)
            ->where('com_id', Auth::user()->com_id)
            ->get();
        //join('designations', 'designations.id', '=', 'users.designation_id')
        // ->join('departments', 'departments.id', '=', 'users.department_id')
        // ->join('regions', 'regions.id', '=', 'users.region_id')
        // ->join('areas', 'areas.id', '=', 'users.area_id')
        // ->join('territories', 'territories.id', '=', 'users.territory_id')
        // ->join('towns', 'towns.id', '=', 'users.town_id')
        // ->join('employee_details','employee_details.empdetails_employee_id', '=','users.id')
        //->select('users.*','users.first_name','users.last_name','departments.department_name','designations.designation_name','users.company_assigned_id','regions.region_name','areas.area_name','territories.territory_name','towns.town_name','employee_details.*')
        // ->get();
        $pdf = PDF::loadView('employeereport', [
            'employee_report' => $employee_report
        ]);
        return $pdf->stream();
    }

    public function bulkIdCardIndex(Request $request)
    {
        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $divisions = Division::get();
        return view('back-end.premium.user.bulk-id-card-index', compact('companies', 'regions', 'roles', 'locations', 'divisions'));
    }
    public function bulkIdCardDownload()
    {
        //     $all_employee_details = User::where('com_id',Auth::user()->com_id)->whereNull('company_profile')->get(['id']);

        //echo json_encode($all_employee_details); exit;

        //$pdfdata = [];

        // foreach($all_employee_details as $all_employee_details_value){

        //   // echo $all_employee_details_value->id;

        //   $employee_details_value = User::where('id','=',$all_employee_details_value->id)->first();
        //   $company_details_value = Company::where('id','=',$employee_details_value->com_id)->first();
        //   $department_value = Department::where('id','=',$employee_details_value->department_id)->first();
        //   $designation_value = Designation::where('id','=',$employee_details_value->designation_id)->first();


        //           $pdf = PDF::loadView('back-end.premium.user-settings.general.employee-id-card-pdf',[
        //               'employee_details_value' => $employee_details_value,
        //               'company_details_value' => $company_details_value,
        //               'department_value' => $department_value,
        //               'designation_value' => $designation_value,
        //           ]);

        //           $pdf->download('id-card.pdf');

        //           //array_push($pdfdata, $pdf);
        //           // $pdfdata = $pdf;
        // }

        // foreach($pdfdata as $pdfdataValue){

        //     //echo $pdfdataValue;
        //     $pdfdataValue->download('id-card.pdf');
        // }

        // exit;
        //  $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
        //                 ->join('departments', 'departments.id', '=', 'users.department_id')
        //             ->select('users.*','users.first_name','users.last_name','departments.department_name','designations.designation_name','users.company_assigned_id')
        //             ->where('com_id', '=', Auth::user()->com_id)
        //             ->where('role_id', '=', 2)
        //             ->where('is_active', '=', 1)
        //             ->get();

        $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
            ->where('com_id', Auth::user()->com_id)
            ->where('roles.roles_name', '=', 'Employee')
            ->where('is_active', 1)
            ->get();


        $fileName = "idcard.pdf";
        $mpdf = new \Mpdf\Mpdf([
            'R'  => 'SolaimanLipi.ttf',
            'margin_top' => 40,
            'margin_bottom' => 30,
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
        ]);
        $html = \View::make('idcard', compact('employee_details_value'));
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');


        //          $pdf = PDF::loadView('idcard',[
        //              'employee_details_value' => $employee_details_value
        //          ]);
        // return $pdf->stream();
    }



    public function searchWiseBulkIdCardDownload(Request $request)
    {

        //echo $request->category_name; exit;

        if ($request->department_id && $request->designation_id && $request->office_shift_id && $request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id  && $request->location_ten_id  && $request->location_eleven_id  && $request->role_users_id && $request->over_time_payable && $request->user_over_time_rate) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('location_eleven_id', $request->location_eleven_id)
                ->where('role_id', $request->role_users_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('user_over_time_rate', $request->user_over_time_rate)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id  && $request->location_ten_id  && $request->location_eleven_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('location_eleven_id', $request->location_eleven_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id  && $request->location_ten_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_ten_id', $request->location_ten_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id && $request->location_nine_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('location_nine_id', $request->location_nine_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id && $request->location_eight_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('location_eight_id', $request->location_eight_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id && $request->location_seven_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('location_seven_id', $request->location_seven_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id && $request->location_six_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('location_six_id', $request->location_six_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('department_id', $request->department_id)
                ->where('designation_id', $request->designation_id)
                ->where('office_shift_id', $request->office_shift_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id && $request->db_house_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('db_house_id', $request->db_house_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id && $request->town_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('town_id', $request->town_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id && $request->territory_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('territory_id', $request->territory_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id && $request->area_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('area_id', $request->area_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->region_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('region_id', $request->region_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->role_users_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('role_id', $request->role_users_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->over_time_payable && $request->user_over_time_rate) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('user_over_time_rate', $request->user_over_time_rate)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->over_time_payable) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->is_active) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', $request->is_active)
                ->get();
        } elseif ($request->company_id && $request->is_active) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', $request->is_active)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id && $request->over_time_payable) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->where('over_time_payable', $request->over_time_payable)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->district_id && $request->upazila_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id && $request->district_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->division_id) {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('division_id', $request->division_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->category_name == 'Appointment-Letter') {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->category_name == 'Id-Card') {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->get();
        } elseif ($request->category_name == 'increment-letter') {

            $employee_details_value = User::join('designations', 'designations.id', '=', 'users.designation_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('users.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'users.company_assigned_id')
                ->whereNull('company_profile')
                ->where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->get();
        } else {
            return back()->with('message', 'No Result Found! Please Select Category');
        }
        if ($request->category_name == 'Appointment-Letter') {
            $pdf = PDF::loadView('back-end.premium.user.download-bulk-appointment-letter-pdf', [
                'employee_details_value' => $employee_details_value,
            ]);
            return $pdf->stream();

            // return view('back-end.premium.user.download-bulk-appointment-letter-pdf', compact('employee_details_value'));
        } elseif ($request->category_name == 'Id-Card') {
            $pdf = PDF::loadView('back-end.premium.user.download-bulk-id-card-pdf', [
                'employee_details_value' => $employee_details_value
            ]);
            return $pdf->stream();
            // return view('back-end.premium.user.download-bulk-id-card-pdf', compact('employee_details_value'));
        } elseif ($request->category_name == 'increment-letter') {
            $salary_increments = SalaryIncrement::where('salary_incre_com_id', Auth::user()->com_id)->get();

            $pdf = PDF::loadView('back-end.premium.user.bulk-increment-letter-pdf', [
                'employee_details_value' => $employee_details_value,
                'salary_increments' => $salary_increments,
            ]);
            return $pdf->stream();
            // return view('back-end.premium.user.bulk-increment-letter-pdf', compact('employee_details_value', 'salary_increments'));
        }
    }




    public function Appointment()
    {
        $employee_details_value = User::with('emoloyeedetail')
            ->where('com_id', Auth::user()->com_id)
            ->limit(30)
            ->get();
        $pdf = PDF::loadView('appointmentletter', [
            'employee_details_value' => $employee_details_value,
        ]);
        return $pdf->stream();
    }
    public function filedForceAppointment()
    {
        $employee_details_value = User::with('emoloyeedetail')
            ->where('com_id', Auth::user()->com_id)
            ->where('is_active', '1')
            ->get();
        $pdf = PDF::loadView('appointmentletter', [
            'employee_details_value' => $employee_details_value,
        ]);
        return $pdf->stream();
    }
}
