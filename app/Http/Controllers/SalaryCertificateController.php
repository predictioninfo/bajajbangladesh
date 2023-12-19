<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Header;
use App\Models\User;
use App\Models\SalaryCirtificate;
use App\Models\Company;
use Illuminate\Http\Request;
use Image;
use Auth;
use Session;
use PDF;

class SalaryCertificateController extends Controller
{
    public function index()
    {

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $salary_cirtificates = SalaryCirtificate::where('salary_cirti_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.salary-certificate-format.index', get_defined_vars());
    }


    public function create()
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        return view('back-end.premium.customize.salary-certificate-format.create', get_defined_vars());
    }

    public function addSalaryCertificateLetter(Request $req)
    {

        $salary_certificate = new SalaryCirtificate();
        $salary_certificate->salary_cirti_com_id = Auth::user()->com_id;
        $salary_certificate->salary_cirti_sub = $req->subject;
        $salary_certificate->salary_cirti_footer = $req->salary_certificate_format_footer;

        $description = nl2br($req->salary_certificate_letter_format_body);
        $salary_certificate->salary_cirti_body = $description;
        $salary_certificate_letter_format_extra = nl2br($req->salary_certificate);
        $salary_certificate->salary_cirti_extra_feature = $salary_certificate_letter_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $salary_certificate->salary_cirti_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $salary_certificate->salary_cirti_emp_id = $req->employee_id;
        $salary_certificate->salary_cirtificate_header_id = $req->salary_certificate_format_header_id;
        $salary_certificate->save();
        return back()->with('message', 'Added Succesfully');
    }


    public function edit($id)
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $salary_certificate = SalaryCirtificate::where('salary_cirti_com_id', Auth::user()->com_id)->where('id', $id)->first();

        return view('back-end.premium.customize.salary-certificate-format.edit', get_defined_vars());
    }
    public function editSalaryCertificate(Request $req, $id)
    {
        $salary_certificate =  SalaryCirtificate::where('id', $id)->first();
        $salary_certificate->salary_cirti_com_id = Auth::user()->com_id;
        $salary_certificate->salary_cirti_sub = $req->subject;
        $salary_certificate->salary_cirti_footer = $req->salary_certificate_format_footer;

        $description = nl2br($req->salary_certificate_letter_format_body);
        $salary_certificate->salary_cirti_body = $description;
        $salary_certificate_letter_format_extra = nl2br($req->salary_certificate);
        $salary_certificate->salary_cirti_extra_feature = $salary_certificate_letter_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $salary_certificate->salary_cirti_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $salary_certificate->salary_cirti_emp_id = $req->employee_id;
        $salary_certificate->salary_cirtificate_header_id = $req->salary_certificate_format_header_id;
        $salary_certificate->save();
        return back()->with('message', 'Edited Succesfully');
    }
    public function show($id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'mode' => 'utf-8',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
        ]);
        $SalaryCertificate = SalaryCirtificate::where('salary_cirti_com_id', Auth::user()->com_id)->where('id', $id)->first();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $fileName = "Salary-certificate.pdf";
        return  $html = \View::make('back-end.premium.customize.salary-certificate-format.download', get_defined_vars());

    }

    public function delete($id)
    {
         SalaryCirtificate::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function salaryCertificateDownload()
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
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('id', '=', Session::get('employee_setup_id'))->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone', 'salary_certificate_format_id', 'address', 'gross_salary', 'com_id', 'mobile_bill']);
        $fileName = "Appointment-letter-" . $employee->company_assigned_id . ".pdf";
        $html = \View::make('back-end.premium.customize.salary-certificate-format.salary-certificate-download', get_defined_vars());

        $html = $html->render();
        $logo_header = asset($employee->salaryCertificate->salaryCertificateHeader->logo ?? null);
        $logo = url($logo_header);
        $footer = $employee->salaryCertificate->salary_cirti_footer ?? null;

        if($employee->salaryCertificate->salary_cirtificate_header_id){
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