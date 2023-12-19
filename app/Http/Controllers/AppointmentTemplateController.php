<?php

namespace App\Http\Controllers;

use App\Models\AppointmentTemplate;
use App\Models\Footer;
use App\Models\Header;
use App\Models\User;
use Image;
use Illuminate\Http\Request;
use Auth;
use File;
use PDF;
use Session;

class AppointmentTemplateController extends Controller
{
    public function index()
    {
        $appointments = AppointmentTemplate::where('appointment_template_com_id', Auth::user()->com_id)->get();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.template.appointment.index', get_defined_vars());
    }

    public function create(Request $req)
    {
        $appointments = AppointmentTemplate::where('appointment_template_com_id', Auth::user()->com_id)->get();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        return view('back-end.premium.template.appointment.create', get_defined_vars());
    }

    public function add(Request $req)
    {
        $appointment = new AppointmentTemplate();
        $appointment->appointment_template_com_id = Auth::user()->com_id;
        $appointment->appointment_template_subject = $req->subject;
        $appointment->appointment_template_header = $req->appoinment_header;
        $appointment->appointment_template_footer = $req->appoinment_footer;
        $description = nl2br($req->description);
        $appointment->appointment_template_description = $description;
        $general_terms = nl2br($req->general_terms);
        $appointment->appointment_template_general_terms = $general_terms;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $appointment->appointment_template_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $appointment->appointment_template_signature_employee_id = $req->employee_id;
        $appointment->save();
        return back()->with('message', 'Added Successfully');
    }

    public function Edit($id)
    {

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);

        $appointments = AppointmentTemplate::where('appointment_template_com_id', Auth::user()->com_id)->where('id', $id)->first();

        return view('back-end.premium.template.appointment.edit', get_defined_vars());
    }

    public function appointmentEdit(Request $req, $id)
    {
        $appointment =  AppointmentTemplate::where('id', $id)->first();
        $appointment->appointment_template_com_id = Auth::user()->com_id;
        $appointment->appointment_template_subject = $req->subject;
        $appointment->appointment_template_header = $req->appoinment_header;
        $appointment->appointment_template_footer = $req->appoinment_footer;
        $description = nl2br($req->description);
        $description = str_replace('<br />', '', $description);
        $appointment->appointment_template_description = $description;
        $general_terms = nl2br($req->general_terms);
        $general_terms = str_replace('<br />', '', $general_terms);
        $appointment->appointment_template_general_terms = $general_terms;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $appointment->appointment_template_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $appointment->appointment_template_signature_employee_id = $req->employee_id;
        $appointment->save();
        return back()->with('message', 'Added Succesfully');
    }

    public function show($id)
    {
        $appointments = AppointmentTemplate::where('appointment_template_com_id', Auth::user()->com_id)
            ->where('appointment_templates.id', $id)
            ->get();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        view('back-end.premium.template.appointment.show', compact('appointments'));

        $pdf = PDF::loadView('back-end.premium.template.appointment.show', [
            'appointments' => $appointments,
        ]);
        $pdf->stream();
    }

    public function delete($id)
    {
        $appointments = AppointmentTemplate::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function Customize($id)
    {

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone']);


        // $employee_info= User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->first(['id', 'company_assigned_id','first_name','last_name','joining_date','designation_id','phone']);

        $appointments = AppointmentTemplate::where('appointment_template_com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->first();
        return view('back-end.premium.template.appointment.customize', get_defined_vars());
    }
    public function CustomizeAdd(Request $req)
    {
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->orderBy('id', 'DESC')
            ->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone']);

        $html = view('back-end.premium.template.appointment.customize', compact('headers', 'footers', 'employees'))->render();

        preg_match('/<div class="my-div">(.*?)<\/div>/s', $html, $matches);
        $matches = str_replace("\n", " ", $matches);
        $appointment = AppointmentTemplate::where('id', $req->id)->first();
        $appointment->html_content = $matches;
        $appointment->save();
        return redirect()->route('home');
    }
    public function downloadTemplate(Request $request, $id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'mode' => 'utf-8',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone', 'appointment_letter_format_id']);

        $appointments = AppointmentTemplate::where('appointment_template_com_id', Auth::user()->com_id)
            ->where('id', $id)->first();
        // $fileName = "Appointment-letter.pdf";
        return $html = \View::make('back-end.premium.template.appointment.download-template', get_defined_vars());
        // $html = $html->render();
        // $mpdf->WriteHTML($html);
        // $mpdf->SetDisplayMode('fullpage');
        // $mpdf->Output($fileName,'D');
    }

    public function appointmentLetterDownlaod()
    {
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'mode' => 'utf-8',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);

        $employee = User::where('com_id', Auth::user()->com_id)->where('id', Session::get('employee_setup_id'))->first();
        $employees = User::with(['userdesignation', 'userdepartment','userarea', 'emoloyeedetail' => function ($query) {
            $query->with('presentEmploeeUpazila', 'presentEmploeeDistrict', 'emploeeUpazila', 'emploeeDistrict');
        }])->where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)
            ->where('id', '=', Session::get('employee_setup_id'))
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->orderBy('id', 'DESC')
            ->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'gender', 'email', 'area_id', 'joining_date', 'designation_id','department_id', 'phone', 'appointment_letter_format_id', 'address', 'gross_salary', 'com_id', 'mobile_bill']);
        $fileName = "Appointment-letter-" . $employee->company_assigned_id . ".pdf";
        $html = \View::make('back-end.premium.template.appointment.download', get_defined_vars());

        $html = $html->render();
        $logo_header = asset($employee->appointmentLetter->appointmentHeader->logo  ?? null);
        $logo = url($logo_header);
        if ($employee && $employee->appointmentLetter && $employee->appointmentLetter->appointment_template_header) {
            $htmlHeader = '<html><div>'
                . '<div><img src="' . $logo . '"  style="max-height: 35px;"/></div>'
                . '</div></html>';
        } else {
            $htmlHeader = '<html><div>'
                . '<div></div>'
                . '</div></html>';
        }

        $footer = $employee->appointmentLetter->appointment_template_footer ?? null;
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
