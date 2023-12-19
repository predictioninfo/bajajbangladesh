<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Image;
use Mpdf\Mpdf;
use App\Models\User;
use App\Models\Footer;
use App\Models\Header;
use Illuminate\Http\Request;
use App\Models\NonObjectionCertificate;


class NonObjectionCertificateController extends Controller
{
    public function index()
    {
        $nocs = NonObjectionCertificate::where('non_objection_certificate_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.non-objection-certificate.index', get_defined_vars());
    }

    public function create()
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        return view('back-end.premium.customize.non-objection-certificate.create', get_defined_vars());
    }
    public function addNoc(Request $req)
    {
        $noc = new NonObjectionCertificate();
        $noc->non_objection_certificate_com_id = Auth::user()->com_id;
        $noc->non_objection_certificate_subject = $req->non_objection_certificate_subject;
        $noc->non_objection_certificate_footer = $req->non_objection_certificate_footer;
        $noc->header_id = $req->header_id;

        $description = nl2br($req->non_objection_certificate_body);
        $noc->non_objection_certificate_body = $description;
        $noc_extra_feature = nl2br($req->non_objection_certificate_extra_feature);
        $noc->non_objection_certificate_extra_feature = $noc_extra_feature;
        $noc->non_objection_certificate_signature_emp_id = $req->non_objection_certificate_signature_emp_id;

        if ($req->file('non_objection_certificate_signature')) {
            $image = $req->file('non_objection_certificate_signature');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $noc->non_objection_certificate_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $noc->save();
        return redirect('non-objection-certificate')->with('message', 'Added Succesfully');
    }
    public function editNoc($id)
    {
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $noc = NonObjectionCertificate::where('non_objection_certificate_com_id', Auth::user()->com_id)->where('id', $id)->first();

        return view('back-end.premium.customize.non-objection-certificate.edit', get_defined_vars());
    }

    public function updateNoc(Request $req, $id)
    {
        $noc =  NonObjectionCertificate::where('id', $id)->first();
        $noc->non_objection_certificate_com_id = Auth::user()->com_id;
        $noc->non_objection_certificate_subject = $req->non_objection_certificate_subject;
        $noc->non_objection_certificate_footer = $req->non_objection_certificate_footer;
        $noc->header_id = $req->header_id;
        $description = nl2br($req->non_objection_certificate_body);
        $noc->non_objection_certificate_body = $description;
        $noc_extra_feature = nl2br($req->non_objection_certificate_extra_feature);
        $noc->non_objection_certificate_extra_feature = $noc_extra_feature;
        $noc->non_objection_certificate_signature_emp_id = $req->non_objection_certificate_signature_emp_id;

        if ($req->file('non_objection_certificate_signature')) {
            $image = $req->file('non_objection_certificate_signature');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $noc->non_objection_certificate_signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $noc->save();
        return redirect('non-objection-certificate')->with('message', 'Update Succesfully');
    }

    public function deleteNoc($id)
    {
        $noc = NonObjectionCertificate::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function showNoc($id)
    {
        $nocs = NonObjectionCertificate::where('non_objection_certificate_com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->first();

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->first();
        $pdf = PDF::loadView('back-end.premium.customize.non-objection-certificate.show', [
            'nocs' => $nocs,
        ]);
        $pdf->stream();
    }
}
