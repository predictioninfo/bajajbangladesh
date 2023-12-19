<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Image;
use Session;
use App\Models\User;
use App\Models\Footer;
use App\Models\Header;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\SalaryIncrement;
use App\Models\SalaryIncrementLetter;


class SalaryIncrementLetterController extends Controller
{
    public function index()
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $incremenrt_letters = SalaryIncrementLetter::where('salary_inc_letter_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.salaryIncrementLetter.index', get_defined_vars());
    }


    public function addSalaryIncrementLetter(Request $req)
    {
        $incremenrt_letters = new SalaryIncrementLetter();
        $incremenrt_letters->salary_inc_letter_com_id = Auth::user()->com_id;
        $incremenrt_letters->subject = $req->subject;
        $incremenrt_letters->header_id = $req->header_id;
        $incremenrt_letters->footer_id = $req->footer_id;
        $description = nl2br($req->body);
        $incremenrt_letters->body =   $description;
        $incremenrt_letters_format_extra = nl2br($req->extra_feture);
        $incremenrt_letters->extra_feture = $incremenrt_letters_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $incremenrt_letters->signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $incremenrt_letters->emp_signature_id = $req->employee_id;
        $incremenrt_letters->save();
        return back()->with('message', 'Added Succesfully');
    }


    public function edit($id)
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $incremenrt_letters = SalaryIncrementLetter::where('salary_inc_letter_com_id', Auth::user()->com_id)->where('id', $id)->first();
        return view('back-end.premium.customize.salaryIncrementLetter.edit', get_defined_vars());
    }


    public function editSalaryIncrementLetter(Request $req, $id)
    {

        $incremenrt_letters =  SalaryIncrementLetter::where('id', $id)->first();
        $incremenrt_letters->salary_inc_letter_com_id = Auth::user()->com_id;
        $incremenrt_letters->subject = $req->subject;
        $incremenrt_letters->header_id = $req->header_id;
        $incremenrt_letters->footer_id = $req->footer_id;
        $description = nl2br($req->body);
        $incremenrt_letters->body =   $description;
        $incremenrt_letters_format_extra = nl2br($req->extra_feture);
        $incremenrt_letters->extra_feture = $incremenrt_letters_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $incremenrt_letters->signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $incremenrt_letters->emp_signature_id = $req->employee_id;
        $incremenrt_letters->save();
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

        $incremenrt_letters = SalaryIncrementLetter::with('signatory', 'company')->where('salary_inc_letter_com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->first();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $fileName = "probation-letter.pdf";
        return  $html = \View::make('back-end.premium.customize.salaryIncrementLetter.show', get_defined_vars());
    }

    public function delete($id)
    {
        $appointments = SalaryIncrementLetter::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }



    public function salaryIncrementLetterDownlaod($id)
    {

        $employees = SalaryIncrement::with('letterFormat', 'departmentdetails', 'designationdetails')->where('id', $id)->orderBy('id', 'desc')->first();
        $user = User::where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', 1)->where('id', '=',  $employees->salary_incre_emp_id)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->orderBy('id', 'DESC')
            ->first(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone', 'address', 'gross_salary', 'com_id', 'mobile_bill', 'salary_increment_letter_id']);

        $fileName = "SalaryIncrement-letter-" . $user->company_assigned_id . ".pdf";
        $footer = User::where('id', $employees->salary_incre_emp_id)
            ->select('salary_increment_letter_id')->with([
                'salaryIncrementLetter' => function ($q) {
                    $q->select('id', 'footer_id');
                }, 'salaryIncrementLetter.footer' => function ($q) {
                    $q->select('id', 'footer_description');
                }
            ])->first('footer_description');
        // $logo_header = asset($user->company->company_logo ?? null);
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);

        $html  = \View::make('back-end.premium.customize.salaryIncrementLetter.downloadPDF', get_defined_vars());
        $html = $html->render();
        $logo_header = asset($user->salaryIncrementLetter->Header->logo ?? null);
        $logo = url($logo_header);
        $footer=  $footer->salaryIncrementLetter->footer->footer_description ?? null;
        if($user->salaryIncrementLetter && $user->salaryIncrementLetter->header_id){
            $htmlHeader = '<html><div>'
            . '<div><img src="' . $logo . '"  style="max-height: 35px;"/></div>'
            . '</div></html>';
        }else{
            $htmlHeader = '<html><div>'
            . '<div></div>'
            . '</div></html>';
        }

        if($user->salaryIncrementLetter && $user->salaryIncrementLetter->footer_id){
            $htmlFooter = '<html><div>'
                    . ' <div style="font-size: 10px;text-align:center;"> ' . $footer . ' </div>'
                    . '</div></html>';
        }else{
            $htmlFooter = '<html><div>'
            .' <div style="font-size: 10px;text-align:center;"> Prediction Learning Associates Ltd., 365/9, Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
                Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: <span style="color:blue;">info@predictionla.com</span></div>'
            .'</div></html>';
    }
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
}
