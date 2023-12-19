<?php

namespace App\Http\Controllers;

use App\Models\AppointmentTemplate;
use App\Models\ContactRenewalLetter;
use App\Models\Footer;
use App\Models\Header;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ContactRenewalLetterTemplate;

use Auth;
use Image;
use PDF;
class ContactRenewalLetterTemplateController extends Controller
{
public function index(){

        $templates = ContactRenewalLetterTemplate::where('contact_renewal_letter_template_com_id', Auth::user()->com_id)->get();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.customize.contact-renewal-letter.index', get_defined_vars());

}

public function create(){
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        return view('back-end.premium.customize.contact-renewal-letter.create', get_defined_vars());
}


 public function addContactRenewalLetter(Request $req){
        $contactRenewalLetter = new ContactRenewalLetterTemplate();
        $contactRenewalLetter->contact_renewal_letter_template_com_id = Auth::user()->com_id;
        $contactRenewalLetter->contact_renewal_letter_template_subject = $req->subject;
        $contactRenewalLetter->contact_renewal_letter_template_header = $req->header_id;
        $contactRenewalLetter->contact_renewal_letter_template_footer = $req->letter_format_footer;
        $description = nl2br($req->letter_format_body);
        $contactRenewalLetter->contact_renewal_letter_template_description = $description;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $contactRenewalLetter->contact_renewal_letter_template_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $contactRenewalLetter->contact_renewal_letter_template_emp_id = $req->employee_id;
        // $contactRenewalLetter->contact_renewal_letter_template_header = $req->header;
        $contactRenewalLetter->contact_renewal_letter_template_name = $req->template_name;

        $contactRenewalLetter->save();

        return back()->with('message', 'Added Succesfully');
    }

    public function edit($id){
    $renewal_letters = ContactRenewalLetterTemplate::where('contact_renewal_letter_template_com_id',Auth::user()->com_id)->first();
    $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
    $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
    return view('back-end.premium.customize.contact-renewal-letter.edit', get_defined_vars());
    }

    public function editContactRenewalLetter(Request $req,$id){

        $contactRenewalLetter =  ContactRenewalLetterTemplate::findOrFail($id);
        $contactRenewalLetter->contact_renewal_letter_template_com_id = Auth::user()->com_id;
        $contactRenewalLetter->contact_renewal_letter_template_subject = $req->subject;
        $contactRenewalLetter->contact_renewal_letter_template_footer = $req->letter_format_footer;
        $description = nl2br($req->letter_format_body);
        $contactRenewalLetter->contact_renewal_letter_template_description = $description;

        if ($req->file('signature_img')) {
            $image = $req->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $contactRenewalLetter->contact_renewal_letter_template_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $contactRenewalLetter->contact_renewal_letter_template_emp_id = $req->employee_id;
        $contactRenewalLetter->contact_renewal_letter_template_header = $req->header_id;
        $contactRenewalLetter->contact_renewal_letter_template_name = $req->template_name;

        $contactRenewalLetter->save();

        return back()->with('message', 'Updated Succesfully');
    }

    public function show($id){

        $mpdf = new \Mpdf\Mpdf([
                            'default_font' => 'nikosh',
                            'mode' => 'utf-8',
                            'margin_header' =>5,
                            'margin_footer' =>5,
                            'orientation' => 'P',
                        ]);
            $fileName = "warning-letter.pdf";

            $contact_renewal = ContactRenewalLetterTemplate::where('contact_renewal_letter_template_com_id',Auth::user()->com_id)
                                                ->where('id',$id)
                                                ->first();

            $footers = Footer::where('footer_com_id',Auth::user()->com_id)->get();

          //return view('back-end.premium.customize.contact-renewal-letter.show', get_defined_vars());

           $pdf = PDF::loadView('back-end.premium.customize.contact-renewal-letter.show', get_defined_vars());

           $pdf->stream();
    }
    public function delete($id){

       ContactRenewalLetterTemplate::findOrFail($id)->delete();

       return back()->with('message','Deleted Succesfully');

    }
    public function contactRenewalLetterDownlaod($id){


       $contact_renewal =  ContactRenewalLetter::where('contact_renewal_letter_com_id',Auth::user()->com_id)->where('id',$id)->first();
      // return view('back-end.premium.customize.contact-renewal-letter.employee-download', get_defined_vars());
        $fileName = "Contact-Renewal-letter.pdf";
        $pdf = PDF::loadView('back-end.premium.customize.contact-renewal-letter.employee-download', get_defined_vars());

        $pdf->download($fileName);

        return back();

    }


}