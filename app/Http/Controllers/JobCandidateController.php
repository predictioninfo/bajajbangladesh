<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobCandidate;
use App\Models\Company;
use Illuminate\Http\Request;
use Mail;
use DB;
use Auth;
use DateTime;
use DataTables;

class JobCandidateController extends Controller
{
    public function jobApply(Request $request)
    {

        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $validated = $request->validate([
            'job_cnd_full_name' => 'required',
            'job_cnd_email' => 'required|email',
            'job_cnd_phone' => 'required',
            'job_cnd_address' => 'required',
            'job_cnd_cover_ltr' => 'required',
            'job_cnd_cv_upload' => 'required',
            'job_cnd_lnkdin' => 'required|regex:' . $regex,
            'job_cnd_fb' => 'required|regex:' . $regex,
        ]);
        try {
            // function generateRandomString($length = 25)
            // {
            //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            //     $charactersLength = strlen($characters);
            //     $randomString = '';
            //     for ($i = 0; $i < $length; $i++) {
            //         $randomString .= $characters[rand(0, $charactersLength - 1)];
            //     }
            //     return $randomString;
            // }
            // $random_key = generateRandomString() . $request->pay_slip_employee_id;

            // if (JobPost::where('id', $request->id)->exists()) {
            $job_candidate = new JobCandidate();
            $job_candidate->job_cnd_com_id = Auth::user()->com_id;
            //$job_candidate->job_cnd_slug = $random_key;
            $job_candidate->job_cnd_job_post_id = $request->id;
            $job_candidate->job_cnd_full_name = $request->job_cnd_full_name;
            $job_candidate->job_cnd_email = $request->job_cnd_email;
            $job_candidate->job_cnd_phone = $request->job_cnd_phone;
            $job_candidate->job_cnd_address = $request->job_cnd_address;
            $job_candidate->job_cnd_apply_dt = date('d-m-y');
            $job_candidate->job_cnd_fb = $request->job_cnd_fb;
            $job_candidate->job_cnd_lnkdin = $request->job_cnd_lnkdin;
            $job_candidate->job_cnd_cover_ltr = $request->job_cnd_cover_ltr;

            $image = $request->file('job_cnd_cv_upload');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/recruitment-attachments';
            $imageUrl = $filePath . '/' . $input['imagename'];
            $imageStoring = $image->move($filePath, $input['imagename']);

            $job_candidate->job_cnd_cv_upload = $imageUrl;

            $job_candidate->job_cnd_agrmnt = $request->job_cnd_agrmnt;
            $job_candidate->save();
            // }

            return redirect()->route('job-portals')->with('message', 'Application Process Done!');
        } catch (\Exception $e) {
            return redirect()->route('job-portals')->with('message', 'Something Went Wrong! Please Try Again');
        }
    }

    public function jobApplyById(Request $request)
    {

        $where = array('id' => $request->id);
        $detailsByIds = JobCandidate::where($where)->first();
        return response()->json($detailsByIds);
    }


    public function jobCandidateById(Request $request)
    {

        $where = array('id' => $request->id);
        $detailsByIds = JobCandidate::where($where)->first();
        return response()->json($detailsByIds);
    }

    public function jobApplyUpdate(Request $request)
    {

        $job_candidate = JobCandidate::find($request->id);

        if ($request->jb_post_title) {
            $job_candidate->jb_post_title = $request->jb_post_title;
        }
        if ($request->jb_post_type_id) {
            $job_candidate->jb_post_type_id = $request->jb_post_type_id;
        }
        if ($request->jb_post_category_id) {
            $job_candidate->jb_post_category_id = $request->jb_post_category_id;
        }
        if ($request->jb_post_gender) {
            $job_candidate->jb_post_gender = $request->jb_post_gender;
        }
        if ($request->jb_post_status) {
            $job_candidate->jb_post_status = $request->jb_post_status;
        }
        if ($request->jb_post_min_exp) {
            $job_candidate->jb_post_min_exp = $request->jb_post_min_exp;
        }
        if ($request->jb_post_vacancy) {
            $job_candidate->jb_post_vacancy = $request->jb_post_vacancy;
        }
        if ($request->jb_post_desc) {
            $job_candidate->jb_post_desc = strip_tags($request->jb_post_desc);
        }

        $job_candidate->jb_post_date = date('d-m-y');
        $job_candidate->save();

        return back()->with('message', 'Updated Successfully');
    }

    public function jobApplyDelete($id)
    {
        $job_candidate = JobCandidate::find($id);
        $job_candidate->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function selectCandidate(Request $request)
    {

        $validated = $request->validate([
            'job_cnd_intw_plc' => 'required',
            'job_cnd_intw_dt' => 'required',
            'job_cnd_intw_tym' => 'required',
            'job_cnd_intw_phn' => 'required',
        ]);
        try {
            $job_candidate_details = JobCandidate::where('id', $request->id)->get();

            foreach ($job_candidate_details as $job_candidate_detail) {

                $job_candidate_detail->job_cnd_full_name;
                //echo $job_candidate_detail->job_cnd_email;
                $job_candidate_detail->job_cnd_phone;

                $company_details = Company::where('id', Auth::user()->com_id)->get();

                $job_candidate = JobCandidate::find($request->id);
                $job_candidate->job_cnd_selection = "Yes";
                $job_candidate->job_cnd_intw_std_by = Auth::user()->id;
                $job_candidate->job_cnd_intw_plc = $request->job_cnd_intw_plc;
                $job_candidate->job_cnd_intw_dt = $request->job_cnd_intw_dt;
                $job_candidate->job_cnd_intw_tym = $request->job_cnd_intw_tym;
                $job_candidate->job_cnd_intw_phn = $request->job_cnd_intw_phn;
                $job_candidate->save();

                foreach ($company_details as $company_detail) {


                    $data["email"] = $job_candidate_detail->job_cnd_email;
                    $data["request_sender_name"] = $job_candidate_detail->job_cnd_full_name;
                    $data["subject"] = "Interview Invitation";

                    $data["request_company_name"] = $company_detail->company_name;
                    $data["request_company_phone"] = $company_detail->company_phone;

                    $sender_name = array(
                        'sender_name_value' => $data["request_sender_name"],
                    );

                    $company_name = array(
                        'company_name_value' => $data["request_company_name"],
                    );

                    $company_phone = array(
                        'company_phone_value' => $data["request_company_phone"],
                    );


                    $intrvw_place = array(
                        'intrvw_place_value' => $request->job_cnd_intw_plc,
                    );

                    $intrvw_date = array(
                        'intrvw_date_value' => $request->job_cnd_intw_dt,
                    );

                    $intrvw_time = array(
                        'intrvw_time_value' => $request->job_cnd_intw_tym,
                    );
                    $intrvw_phone = array(
                        'intrvw_phone_value' => $request->job_cnd_intw_phn,
                    );

                    Mail::send('back-end.premium.emails.interview-invitation', [
                        'sender_name' => $sender_name,
                        'company_name' => $company_name,
                        'company_phone' => $company_phone,
                        'intrvw_place' => $intrvw_place,
                        'intrvw_date' => $intrvw_date,
                        'intrvw_time' => $intrvw_time,
                        'intrvw_phone' => $intrvw_phone,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_sender_name"])
                            ->subject($data["subject"]);
                    });
                }
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }



        return back()->with('message', 'Selected Successfully');
    }
}