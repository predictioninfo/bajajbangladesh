<?php

namespace App\Http\Controllers;

use App\Models\VariableType;
use App\Models\VariableMethod;
use App\Models\JobPost;
use App\Models\JobCandidate;
use App\Models\JobPortalContact;
use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
use DataTables;

class RecruitmentController extends Controller
{
    public function jobPostIndex()
    {
        $job_status_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Job-Status')->get();
        $job_category_name_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Job')->get();
        $job_location_name_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Joblocation')->get();
        $job_posts = JobPost::where('jb_post_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.recruitment.job-post.job-post-index', compact('job_status_types', 'job_category_name_methods', 'job_posts', 'job_location_name_methods'));
    }
    public function jobCandidateIndex()
    {
        $job_candidates = JobCandidate::where('job_cnd_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.recruitment.job-candidates.job-candidates-index', compact('job_candidates'));
    }
    public function jobInterviewIndex()
    {
        $job_candidates = JobCandidate::where('job_cnd_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.recruitment.job-interview.job-interview-index', compact('job_candidates'));
    }

    public function jobPortalIndex()
    {
        $job_post__category_count = JobPost::select(DB::raw("jb_post_category as category"), DB::raw("count(*) as count"))
            ->groupBy(DB::raw("category"))
            ->where('jb_post_com_id', '=', Auth::user()->com_id)
            ->paginate(30);
        $job_post_city_count = JobPost::select(DB::raw("jb_post_location as city"), DB::raw("count(*) as count"))
            ->groupBy(DB::raw("city"))
            ->where('jb_post_com_id', '=', Auth::user()->com_id)
            ->paginate(30);

        $job_posts = JobPost::where('jb_post_com_id', '=', Auth::user()->com_id)->orderBy('id', 'DESC')->paginate(30);
        $job_categories = JobPost::where('jb_post_com_id', '=', Auth::user()->com_id)->orderBy('id', 'DESC')->count();
        return view('job.search', compact('job_posts', 'job_post__category_count', 'job_post_city_count'));
    }
    public function jobcategory($categories)
    {

        $job_post__category_count = JobPost::select(DB::raw("jb_post_category as category"), DB::raw("count(*) as count"))
            ->groupBy(DB::raw("category"))
            ->where('jb_post_com_id', '=', Auth::user()->com_id)
            ->paginate(30);
        $job_post_city_count = JobPost::select(DB::raw("jb_post_location as city"), DB::raw("count(*) as count"))
            ->groupBy(DB::raw("city"))
            ->where('jb_post_com_id', '=', Auth::user()->com_id)
            ->paginate(30);
        $job_posts = JobPost::where('jb_post_com_id', '=', Auth::user()->com_id)->where('jb_post_category', $categories)->orderBy('id', 'DESC')->paginate(30);
        return view('job.job-category', compact('job_posts', 'job_post__category_count', 'job_post_city_count'));
    }

    public function jobCity($cities)
    {
        $job_post__category_count = JobPost::select(DB::raw("jb_post_category as category"), DB::raw("count(*) as count"))
            ->groupBy(DB::raw("category"))
            ->where('jb_post_com_id', '=', Auth::user()->com_id)
            ->paginate(30);
        $job_post_city_count = JobPost::select(DB::raw("jb_post_location as city"), DB::raw("count(*) as count"))
            ->groupBy(DB::raw("city"))
            ->where('jb_post_com_id', '=', Auth::user()->com_id)
            ->paginate(30);
        $job_posts = JobPost::where('jb_post_com_id', '=', Auth::user()->com_id)->where('jb_post_location', $cities)->orderBy('id', 'DESC')->paginate(30);
        return view('job.job-location', compact('job_posts', 'job_post__category_count', 'job_post_city_count'));
    }


    public function singleJobDetails($slug)
    {
        $job_posts = JobPost::where('jb_post_slug', '=', $slug)->get();
        return view('job.job-details', compact('job_posts'));
    }

    public function jobDetails()
    {
        $job_posts = JobPost::where('jb_post_com_id', '=', Auth::user()->com_id)->get();
        return view('job.job-details', compact('job_posts'));
    }

    public function jobApplyForm(Request $request)
    {
        $id = $request->id;
        $message = 0;
        return view('job.job-apply', compact('id'));
    }

    public function jobApplyIndex(Request $request)
    {
        $id = $request->id;
        $message = 'Application Process Done!';
        return view('job.job-apply', compact('id', 'message'));
    }

    public function jobPortalAboutUsIndex()
    {
        return view('job.aboutus');
    }
    public function jobPortalContactUsIndex()
    {
        return view('job.contact');
    }

    public function jobPortalContactUsAdd(Request $request)
    {

        $validated = $request->validate([
            'job_cont_name' => 'required',
            'job_cont_email' => 'required',
            'job_cont_phone' => 'required',
            'job_cont_subj' => 'required',
            'job_cont_msg' => 'required',
        ]);
        try {
            $job_portal_contact = new JobPortalContact();
            $job_portal_contact->job_cont_com_id = Auth::user()->com_id;
            $job_portal_contact->job_cont_name = $request->job_cont_name;
            $job_portal_contact->job_cont_email = $request->job_cont_email;
            $job_portal_contact->job_cont_phone = $request->job_cont_phone;
            $job_portal_contact->job_cont_subj = $request->job_cont_subj;
            $job_portal_contact->job_cont_msg = $request->job_cont_msg;
            $job_portal_contact->save();

            return back()->with('message', 'Your message has been sent. Thank you!');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}