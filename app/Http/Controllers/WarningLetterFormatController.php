<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use View;
use Image;
use Session;
use App\Models\User;
use App\Models\Footer;
use App\Models\Header;
use App\Models\Warning;
use Illuminate\Http\Request;
use App\Models\WarningLetterFormat;

class WarningLetterFormatController extends Controller
{
    public function index()
    {
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $warning_letters = WarningLetterFormat::where('warning_letter_format_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.warning-letter-format.index', get_defined_vars());
    }
    public function create()
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        return view('back-end.premium.customize.warning-letter-format.create', get_defined_vars());
    }

    public function addWarningLetter(Request $req)
    {
        $warning = new WarningLetterFormat();
        $warning->header_id = $req->header_id;
        $warning->footer_id = $req->footer_id;
        $description = nl2br($req->warning_letter_format_body);
        $warning_letter_format_extra = nl2br($req->warning_letter_format_extra);
        $warning->warning_letter_format_body = $description;
        $warning->warning_letter_format_extra_feature = $warning_letter_format_extra;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $warning->warning_letter_format_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $warning->warning_letter_format_signature_emp_id = $req->employee_id;
        $warning->save();
        return redirect()->route('warning-letter-formats')->with('message', 'Added Succesfully');
    }


    public function edit($id)
    {

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $warnings = WarningLetterFormat::where('warning_letter_format_com_id', Auth::user()->com_id)->where('id', $id)->first();

        return view('back-end.premium.customize.warning-letter-format.edit', get_defined_vars());
    }


    public function editWarningLetter(Request $req, $id)
    {
        $warning =  WarningLetterFormat::where('id', $id)->first();
        $warning->warning_letter_format_com_id = Auth::user()->com_id;
        $warning->warning_letter_format_subject = $req->subject;
        $warning->footer_id = $req->footer_id;
        $warning->header_id = $req->header_id;
        $description = nl2br($req->warning_letter_format_body);
        $warning_letter_format_extra = nl2br($req->warning_letter_format_extra);
        $warning->warning_letter_format_body = $description;
        $warning->warning_letter_format_extra_feature = $warning_letter_format_extra;
        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $warning->warning_letter_format_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $warning->warning_letter_format_signature_emp_id = $req->employee_id;
        $warning->save();
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
        $fileName = "warning-letter.pdf";

        $warning = WarningLetterFormat::where('warning_letter_format_com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->first();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        //return view('back-end.premium.customize.warning-letter-format.download',get_defined_vars());
        $pdf = PDF::loadView('back-end.premium.customize.warning-letter-format.download', [
            'warning' => $warning,
        ]);
        $pdf->stream();
    }

    public function delete($id)
    {
        $appointments = WarningLetterFormat::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function warningLetterDownlaod($id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'mode' => 'utf-8',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);
        $empId = Warning::where('id', $id)->first('warning_employee_id');

        $warning = User::where('com_id', Auth::user()->com_id)->where('id', $empId->warning_employee_id)->first();

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('id', '=', $empId)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone', 'address', 'gross_salary', 'com_id', 'mobile_bill', 'warning_letter_format_id']);
        $fileName = "Warning-letter-" . $warning->company_assigned_id . ".pdf";

        $html = View::make('back-end.premium.customize.warning-letter-format.warning-letter-format-download', get_defined_vars());

        $html = $html->render();

        $logo_header = asset($warning->warningLetter->warningHeader->logo  ?? null);
        $logo = url($logo_header);



        if($warning->warningLetter && $warning->warningLetter->header_id){
        $htmlHeader = '<html><div>'
            . '<div><img src="' . $logo . '"  style="max-height: 35px;"/></div>'
            . '</div></html>';
        }else{
         $htmlHeader = '<html><div>'
            . '<div></div>'
            . '</div></html>';
        }

        $footer = User::where('id', $empId->warning_employee_id)
            ->select('warning_letter_format_id')->with([
                'warningLetter' => function ($q) {
                    $q->select('id', 'footer_id');
                }, 'warningLetter.worningFooter' => function ($q) {
                    $q->select('id', 'footer_description');
                }
            ])->first('footer_description');
         $footer_desc_= $footer->warningLetter->worningFooter->footer_description ?? null;

        if ($warning->warning_letter_format_id){
            $htmlFooter = '<html><div>'
                . ' <div style="font-size: 10px;text-align:center;"> ' .$footer_desc_. ' </div>'
                . '</div></html>';
        }
        else {
            $htmlFooter = '<html><div>'
                . ' <div style="font-size: 10px;text-align:center;"> Prediction Learning Associates Ltd., 365/9, Lane 06, Baridhara DOHS, Dhaka -1206, Bangladesh;<br>
               Tel: +88028413439; +8801713 -334 874; www.predictionla.com, email: <span style="color:blue;">info@predictionla.com</span></div>'
                . '</div></html>';
        }

        $mpdf->SetHTMLHeader($htmlHeader);

        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
}
