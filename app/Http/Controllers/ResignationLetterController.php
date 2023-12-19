<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Header;
use App\Models\ProbitionLetterFormats;
use App\Models\ResignationLetter;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Image;
use PDF;

class ResignationLetterController extends Controller
{
    public function index(){
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);

        $resignations = ResignationLetter::where('resignation_letter_com_id', '=', Auth::user()->com_id)->orderBy('id', 'DESC')->get();
        return view('back-end.premium.customize.resignation.index', get_defined_vars());
    }
    public function create(){
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
    return view('back-end.premium.customize.resignation.create', get_defined_vars());
    }

    public function addResignationLetter(Request $req){
        $resignationLetter = new ResignationLetter();
        $resignationLetter->resignation_letter_com_id = Auth::user()->com_id;
        $resignationLetter->resignation_letter_subject = $req->subject;
        $resignationLetter->resignation_letter_header_id = $req->header_id;

        $resignationLetter->resignation_letter_footer = $req->letter_format_footer;
        $description = nl2br($req->letter_format_body);
        $resignationLetter->resignation_letter_description = $description;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $resignationLetter->resignation_letter_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $resignationLetter->resignation_letter_signature_emp_id = $req->employee_id;
        $resignationLetter->save();
        return back()->with('message', 'Added Succesfully');
    }

    public function Edit($id)
    {

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);

        $resignation = ResignationLetter::where('resignation_letter_com_id', '=', Auth::user()->com_id)->where('id', $id)->first();

        return view('back-end.premium.customize.resignation.edit', get_defined_vars());
    }
    public function editResignationLetter(Request $req){
        $resignationLetter = new ResignationLetter();
        $resignationLetter->resignation_letter_com_id = Auth::user()->com_id;
        $resignationLetter->resignation_letter_subject = $req->subject;
        $resignationLetter->resignation_letter_header_id = $req->header_id;
        $resignationLetter->resignation_letter_footer = $req->letter_format_footer;
        $description = nl2br($req->letter_format_body);
        $resignationLetter->resignation_letter_description = $description;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $resignationLetter->resignation_letter_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $resignationLetter->resignation_letter_signature_emp_id = $req->employee_id;
        $resignationLetter->save();
        return back()->with('message', 'Edited Succesfully');
    }

        public function show($id){
        $mpdf = new \Mpdf\Mpdf([
                            'default_font' => 'nikosh',
                            'mode' => 'utf-8',
                            'margin_header' =>5,
                            'margin_footer' =>5,
                            'orientation' => 'P',
                        ]);
            $fileName = "Resignation-letter.pdf";

            $resignation = ResignationLetter::where('resignation_letter_com_id',Auth::user()->com_id)
                                                ->where('id',$id)
                                                ->first();

            $footers = Footer::where('footer_com_id',Auth::user()->com_id)->get();

          //return view('back-end.premium.customize.resignation.show',get_defined_vars());

            $pdf = PDF::loadView('back-end.premium.customize.resignation.show',get_defined_vars());
            $pdf->stream();

            }


    public function delete($id)
    {
        $appointments = ResignationLetter::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}