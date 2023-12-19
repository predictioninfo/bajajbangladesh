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
use App\Models\IncrementSalaryHistory;
use App\Models\ProbitionLetterFormats;

class ProbationLetterFormatController extends Controller
{
    public function index()
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $probation_letters = ProbitionLetterFormats::where('probation_letter_format_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.probition-letter-format.index', get_defined_vars());
    }


    public function addProbitionLetter(Request $req)
    {

        $probition = new ProbitionLetterFormats();
        $probition->probation_letter_format_com_id = Auth::user()->com_id;
        $probition->probation_letter_format_subject = $req->subject;
        $probition->header_id = $req->header_id;
        $probition->footer_id = $req->footer_id;
        $description = nl2br($req->probation_letter_format_body);
        $probition->probation_letter_format_body =   $description ;
        $probition_letter_format_extra = nl2br($req->probition_letter_format_extra);
        $probition->probation_letter_format_extra_feature = $probition_letter_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $probition->probation_letter_format_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $probition->probation_letter_format_signature_emp_id = $req->employee_id;
        $probition->save();
        return back()->with('message', 'Added Succesfully');
    }


    public function edit($id)
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $probitions = ProbitionLetterFormats::where('probation_letter_format_com_id', Auth::user()->com_id)->where('id', $id)->first();

        return view('back-end.premium.customize.probition-letter-format.edit', get_defined_vars());
    }


    public function editProbitionLetter(Request $req, $id)
    {

        $probition =  ProbitionLetterFormats::where('id', $id)->first();
        $probition->probation_letter_format_com_id = Auth::user()->com_id;
        $probition->probation_letter_format_subject = $req->subject;
        $probition->footer_id = $req->footer_id;
        $probition->header_id = $req->header_id;
        $description = nl2br($req->probation_letter_format_body);
        $probition->probation_letter_format_body = $description;
        $probition_letter_format_extra = nl2br($req->probition_letter_format_extra);
        $probition->probation_letter_format_extra_feature = $probition_letter_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $probition->probation_letter_format_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $probition->probation_letter_format_signature_emp_id = $req->employee_id;
        $probition->save();
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

        $probitions = ProbitionLetterFormats::with('probitionSignatory', 'probitionCompany')->where('probation_letter_format_com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->first();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $fileName = "probation-letter.pdf";
        return  $html = \View::make('back-end.premium.customize.probition-letter-format.download', get_defined_vars());
    }

    public function delete($id)
    {
        $appointments = ProbitionLetterFormats::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function probationLetterDownlaod()
    {
        $probation = User::where('com_id', Auth::user()->com_id)
            ->where('id', Session::get('employee_setup_id'))
            ->first();
        $incrementSalary = IncrementSalaryHistory::where('inc_sal_his_com_id', Auth::user()->com_id)
            ->where('emp_id', Session::get('employee_setup_id'))
            ->first(['increment_amount', 'increment_date']);
        $employees = User::where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', 1)->where('id', '=', Session::get('employee_setup_id'))
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->orderBy('id', 'DESC')
            ->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone', 'address', 'gross_salary', 'com_id', 'mobile_bill', 'probation_letter_format_id']);
        $fileName = "Probation-letter-" . $probation->company_assigned_id . ".pdf";
        $footer = $probation->probationLetter->probationFooter->footer_description ?? null;
        $logo_header = asset($probation->probationLetter->probationHeader->logo ?? null);
        $logo = url($logo_header);
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);
        $html = \View::make('back-end.premium.customize.probition-letter-format.probition-letter-format-download', get_defined_vars());
        $html = $html->render();
        if($probation->probationLetter->header_id){
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