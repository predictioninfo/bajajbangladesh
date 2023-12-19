<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\ExperienceTemplate;
use App\Models\Header;
use Illuminate\Http\Request;
use Session;
use pdf;
use Auth;
use Image;

class experienceLetterController extends Controller
{

    public function index()
    {
        $headers = Header::where('header_com_id', Auth::user()->com_id)->get();
        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', 1)->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')->orderBy('id', 'DESC')
            ->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        $experienceTemplates = ExperienceTemplate::with('experienceHeader', 'experienceSignatory', 'experienceFooter')
            ->orderBy('id', 'DESC')
            ->where("experience_template_com_id", Auth::user()->com_id)
            ->get();
        return view('back-end.premium.customize.experience-letter.index', get_defined_vars());
    }

    public function experienceLetterCreate()
    {

        $footers = Footer::where('footer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name']);
        return view('back-end.premium.customize.experience-letter.create', get_defined_vars());
    }

    public function experienceLetterAdd(Request $request)
    {
        $experience = new ExperienceTemplate();
        $experience->experience_template_com_id = Auth::user()->com_id;
        $experience->header_id = $request->header_id;
        $experience->footer_id = $request->footer_id;
        $experience->subject = $request->subject;
        $description = nl2br($request->description);
        $experience->description = $description;
        $experience->employee_id = $request->employee_id;

        if ($request->file('signature_img')) {
            $image = $request->file('signature_img');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/signature';

            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $experience->signature = $imageUrl;
            $filePath = 'uploads/signature/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
        }
        $experience->save();
        return back()->with('message', 'Added Successfully');
    }
    public function experienceLetterShow(Request $request)
    {
        $experienceLetter = ExperienceTemplate::with([
            'experienceHeader',
            'experienceFooter',
            'experienceSignatory' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }
        ])
            ->where("experience_template_com_id", Auth::user()->com_id)
            ->where('id', $request->id)
            ->first();
        return response()->json(get_defined_vars());
    }
    public function experienceChange(Request $request)
    {
        // return  $request->title;
        $content1 = $request->input('content1');
        $content2 = $request->input('content2');
        $content3 = $request->input('content3');
        $title = $request->input('title');
        $subject = $request->input('subject');
        $body = $request->input('body');
        //Logo Position
        $logo_top = $request->input('logo_top');
        $logo_left = $request->input('logo_left');
        $experienceLetter = ExperienceTemplate::find($request->id); // replace 1 with the ID of the record you want to update
        $experienceLetter->content1 = $content1;
        $experienceLetter->content2 = $content2;
        $experienceLetter->content3 = $content3;
        //Logo Position
        $experienceLetter->logo_top = $logo_top;
        $experienceLetter->logo_left = $logo_left;
        $experienceLetter->title = $title;
        $experienceLetter->subject = $subject;
        $experienceLetter->description = $body;
        $experienceLetter->save();
        return response()->json(['success' => true]);
    }
    public function experienceLetterDelete($id)
    {
        ExperienceTemplate::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully!!!');
    }


    public function experienceLetterDownload()
    {

        $employee_value = User::where('id', '=', Session::get('employee_setup_id'))->first();
        $user = User::with(['userdesignation','company','userdepartment','experienceLetter' => function ($query) {
            $query->with(['experienceHeader', 'experienceSignatory' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }, 'experienceFooter']);
        }])
            ->where('id', Session::get('employee_setup_id'))
            ->select('id', 'first_name', 'last_name', 'experience_letter_id', 'company_assigned_id','joining_date','designation_id','department_id','com_id')
            ->firstOrFail();
        $fileName = "Experience-letter-" . $user->company_assigned_id . ".pdf";

        // $logo_header =  asset($user->experienceLetter->experienceHeader->logo ?? null) ;
        $logo_header = asset($user->company->company_logo ?? null);
        $logo = url($logo_header);

        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);


        // if($user->experienceLetter->header_id){
        // $htmlHeader = '<html><div>'
        //     . '<div><img src="' . $logo . '"  style="max-height: 35px;"/></div>'
        //     . '</div></html>';
        // }else{
        //     $htmlHeader = '<html><div>'
        //     . '<div></div>'
        //     . '</div></html>';
        // }

        $htmlHeader = '<html><div>'
        . '<div><img src="'.$logo.'"  style="max-height: 35px;"/></div>'
        . '</div></html>';
       $footer = $user->experienceLetter->experienceFooter->footer_description ?? null;

        $html = \View::make('back-end.premium.user-settings.general.employee-experience-letter-pdf', get_defined_vars());
        $html = $html->render();

        $htmlFooter = '<html><div>'
            . ' <div style="font-size: 10px;text-align:center;"> ' . $footer . ' </div>'
            . '</div></html>';


        if( $user->experienceLetter &&  $user->experienceLetter->experienceFooter->footer_description){
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
