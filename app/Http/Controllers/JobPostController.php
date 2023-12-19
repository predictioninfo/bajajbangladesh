<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
use DataTables;
use Exception;

class JobPostController extends Controller
{
    public function jobPostAdd(Request $request)
    {

        $validated = $request->validate([
            'jb_post_title' => 'required',
            'jb_post_com_name' => 'required',
            'jb_post_vacancy' => 'required',
            'jb_post_type_id' => 'required',
            'jb_post_wrk_plc' => 'required',
            'jb_post_context' => 'required',
            'jb_post_res' => 'required',
            'jb_post_edu_req' => 'required',
            'jb_post_ex_req' => 'required',
            'jb_post_addi_req' => 'required',
            'jb_post_compen' => 'required',
            'jb_post_location' => 'required',
            'jb_post_salary' => 'required',
            'jb_post_closing_dt' => 'required',
            'jb_post_status' => 'required',
            'jb_post_min_exp' => 'required',
            'jb_post_category' => 'required',

        ]);
        try {
            function generateRandomString($length = 25)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $random_key = generateRandomString() . $request->pay_slip_employee_id;


            $job_post = new JobPost();
            $job_post->jb_post_com_id = Auth::user()->com_id;
            $job_post->jb_post_submited_by = Auth::user()->id;
            $job_post->jb_post_date = date('d-m-y');
            //$job_post->jb_post_desc = strip_tags($request->jb_post_desc);
            $job_post->jb_post_title = $request->jb_post_title;
            $job_post->jb_post_slug = $random_key;
            $job_post->jb_post_com_name = $request->jb_post_com_name;
            $job_post->jb_post_vacancy = $request->jb_post_vacancy;
            $job_post->jb_post_type_id = $request->jb_post_type_id;
            $job_post->jb_post_wrk_plc = $request->jb_post_wrk_plc;
            $job_post->jb_post_context = $request->jb_post_context;
            $job_post->jb_post_res = $request->jb_post_res;
            $job_post->jb_post_edu_req = $request->jb_post_edu_req;
            $job_post->jb_post_min_exp = $request->jb_post_min_exp;
            $job_post->jb_post_ex_req = $request->jb_post_ex_req;
            $job_post->jb_post_addi_req = $request->jb_post_addi_req;
            $job_post->jb_post_compen = $request->jb_post_compen;
            $job_post->jb_post_location = $request->jb_post_location;
            $job_post->jb_post_category = $request->jb_post_category;
            $job_post->jb_post_salary = $request->jb_post_salary;
            $job_post->jb_post_closing_dt = $request->jb_post_closing_dt;
            $job_post->jb_post_status = $request->jb_post_status;
            $job_post->save();

            return back()->with('message', 'Added Successfully');
        } catch (Exception $e) {
            return back()->with('message', 'Opps!There are some Error.Please Contact your IT Support.');
        }
    }

    public function jobPostById(Request $request)
    {
        try {
            $where = array('id' => $request->id);
            $detailsByIds = JobPost::where($where)->first();
            return response()->json($detailsByIds);
        } catch (Exception $e) {
            return back()->with('message', 'Opps!There are some Error.Please Contact your IT Support.');
        }
    }

    public function jobPostUpdate(Request $request)
    {
        try {
            $job_post = JobPost::find($request->id);
            $job_post->jb_post_title = $request->jb_post_title;
            $job_post->jb_post_com_name = $request->jb_post_com_name;
            $job_post->jb_post_vacancy = $request->jb_post_vacancy;
            $job_post->jb_post_type_id = $request->jb_post_type_id;
            $job_post->jb_post_wrk_plc = $request->jb_post_wrk_plc;
            $job_post->jb_post_context = $request->jb_post_context;
            $job_post->jb_post_res = $request->jb_post_res;
            $job_post->jb_post_edu_req = $request->jb_post_edu_req;
            $job_post->jb_post_min_exp = $request->jb_post_min_exp;
            $job_post->jb_post_ex_req = $request->jb_post_ex_req;
            $job_post->jb_post_addi_req = $request->jb_post_addi_req;
            $job_post->jb_post_compen = $request->jb_post_compen;
            $job_post->jb_post_location = $request->jb_post_location;
            $job_post->jb_post_category = $request->jb_post_category;
            $job_post->jb_post_salary = $request->jb_post_salary;
            $job_post->jb_post_closing_dt = $request->jb_post_closing_dt;
            $job_post->jb_post_status = $request->jb_post_status;
            $job_post->save();

            return back()->with('message', 'Updated Successfully');
        } catch (Exception $e) {
            return back()->with('message', 'Opps!There are some Error.Please Contact your IT Support.');
        }
    }

    public function jobPostDelete($id)
    {
        try {
            $job_post = JobPost::find($id);
            $job_post->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('message', 'Opps!There are some dependency.Please Contact your IT Support.');
        }
    }
}
