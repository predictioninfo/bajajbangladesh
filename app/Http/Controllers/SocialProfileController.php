<?php

namespace App\Http\Controllers;

use App\Models\SocialProfile;
use Illuminate\Http\Request;
use Auth;
use Session;

class SocialProfileController extends Controller
{
    public function socialProfileEmployeeAdd(Request $request)
    {
        try {
            if (SocialProfile::where('social_profile_com_id', Auth::user()->com_id)->where('social_profile_employee_id', Session::get('employee_setup_id'))->exists()) {
                return back()->with('message', 'Already Added!!!');
            } else {

                $social_profile = new SocialProfile();
                $social_profile->social_profile_com_id = Auth::user()->com_id;
                $social_profile->social_profile_employee_id = Session::get('employee_setup_id');
                $social_profile->social_profile_fb_profile = $request->social_profile_fb_profile;
                $social_profile->social_profile_linkedin_profile = $request->social_profile_linkedin_profile;
                $social_profile->social_profile_skype_profile = $request->social_profile_skype_profile;
                $social_profile->social_profile_twitter_profile = $request->social_profile_twitter_profile;
                $social_profile->social_profile_whatsapp_profile = $request->social_profile_whatsapp_profile;
                $social_profile->save();

                return back()->with('message', 'Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeSocialProfileById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeSocialProfileByIds = SocialProfile::where($where)->first();

        return response()->json($employeeSocialProfileByIds);
    }

    public function employeeSocialProfileUpdate(Request $request)
    {
        try {
            $social_profile = SocialProfile::find($request->id);
            $social_profile->social_profile_fb_profile = $request->social_profile_fb_profile;
            $social_profile->social_profile_linkedin_profile = $request->social_profile_linkedin_profile;
            $social_profile->social_profile_skype_profile = $request->social_profile_skype_profile;
            $social_profile->social_profile_twitter_profile = $request->social_profile_twitter_profile;
            $social_profile->social_profile_whatsapp_profile = $request->social_profile_whatsapp_profile;
            $social_profile->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeSocialProfile($id)
    {
        try {
            $social_profile = SocialProfile::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}