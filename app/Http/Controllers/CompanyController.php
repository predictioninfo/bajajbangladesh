<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class CompanyController extends Controller
{
    public function companyProfileIndex()
    {
        try {
            $companies = Company::all();
            $companies = Company::with('companypackage')->get();
            $packages = Package::all();
            return view('back-end.premium.company.company-index', compact('companies', 'packages'));
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function groupOfCompanyProfileIndex()
    {
        try {
            $companies = Company::where('company_mother_id', Auth::user()->com_id)->get();
            $employee_active_counts = User::where('is_active', '1')->count();
            $employee_inactive_counts = User::where('is_active', '')->count();
            return view('back-end.premium.company.group-of-company-index', compact('companies', 'employee_active_counts', 'employee_inactive_counts'));
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function companyById(Request $request)
    {

        $where = array('id' => $request->id);
        $companyByIds = Company::where($where)->first();

        return response()->json($companyByIds);
    }
    public function companyAdd(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required',
            'company_name_bangla' => 'required',
            'company_email' =>  ['required', 'email', 'max:255', 'unique:companies', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'company_password' => ['required', 'min:8', 'max:50'],
            'company_phone' => 'required|numeric|digits_between:7,14',
            'company_address' => 'required',
            'company_city' => 'required',
            'company_country' => 'required',
            'company_package' => 'required',
            'company_logo' => 'required',
        ]);
        try {
            $company = new Company();
            $company->company_name = $request->company_name;
            $company->company_name_bangla = $request->company_name_bangla;
            $company->company_email = $request->company_email;
            $company->company_password = $request->company_password;
            $company->company_phone = $request->company_phone;
            $company->company_address = $request->company_address;
            $company->company_web_address = $request->company_web_address;
            $company->company_city = $request->company_city;
            $company->company_country = $request->company_country;
            $company->company_package = $request->company_package;
            $company->company_create_limit = $request->company_create_limit;
            $company->employee_id_prefix = $request->employee_id_prefix;

            $image = $request->company_logo;
            $imageName = $image->move('uploads/logos/', $image->getClientOriginalName());
            $imageUrl = $imageName;
            $company->company_logo = $imageUrl;
            $company->save();

            $company_details_id = Company::where('company_email', $request->company_email)->where('company_phone', '=', $request->company_phone)->pluck('id');

            foreach ($company_details_id as $company_details_id_value) {

                $user = new User();
                $user->company_profile = "Yes";
                $user->first_name = $request->company_name;
                $user->last_name = " ";
                $user->username = " ";
                $user->department_id = 0;
                $user->designation_id = 0;
                $user->office_shift_id = 0;
                $user->role_id = 0;
                $user->email = $request->company_email;
                $user->password = Hash::make($request->company_password);
                $user->phone = $request->company_phone;
                $user->profile_photo = $imageUrl;
                $user->com_id = $company_details_id_value;
                $user->com_pack = $request->company_package;
                if ($request->company_create_limit) {
                    $user->group_com_status = 'Yes';
                }

                $user->save();
                $users = User::where('com_id', $company_details_id_value)->where('company_profile', '=', 'Yes')->get();
                foreach ($users as $usersValue) {

                    $user = User::find($usersValue->id);
                    $user->report_to_parent_id = $usersValue->id;
                    $user->save();
                }
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Company Added Successfully');
    }

    public function companyUpdate(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required',
            'company_email' =>  ['required', 'email', 'max:255'],
            'company_phone' => 'required',
            'company_address' => 'required',
            'company_city' => 'required',
            'company_country' => 'required',
        ]);

        if (Company::where('company_email', $request->company_email)->exists()) {

            if (Company::where('id', $request->id)->where('company_email', $request->company_email)->exists()) {
            } else {
                return back()->with('message', 'Email Already Exists');
            }
        }
        try {
            $company = Company::find($request->id);
            $company->company_name = $request->company_name;
            $company->company_name_bangla = $request->company_name_bangla;
            $company->company_email = $request->company_email;
            $company->company_phone = $request->company_phone;
            $company->company_address = $request->company_address;
            $company->company_web_address = $request->company_web_address;
            $company->company_city = $request->company_city;
            $company->company_country = $request->company_country;
            $company->company_password = $request->company_password;
            $company->company_create_limit = $request->company_create_limit;
            $company->employee_id_prefix = $request->employee_id_prefix;

            if ($request->company_package) {
                $company->company_package = $request->company_package;
            }
            if ($request->company_logo) {
                $image = $request->company_logo;
                $imageName = $image->move('uploads/logos/', $image->getClientOriginalName());
                $imageUrl = $imageName;
                $company->company_logo = $imageUrl;
            }
            $company->save();

            $users = User::where('com_id', $request->id)->where('company_profile', '=', 'Yes')->get();

            foreach ($users as $usersValue) {

                $user = User::find($usersValue->id);
                $user->first_name = $request->company_name;
                $user->email = $request->company_email;
                $user->password = Hash::make($request->company_password);
                $user->phone = $request->company_phone;
                $user->address = $request->company_address;
                if ($request->company_logo) {
                    $user->profile_photo = $imageUrl;
                }
                if ($request->company_create_limit) {
                    $user->group_com_status = 'Yes';
                }
                if ($request->company_package) {
                    $user->com_pack = $request->company_package;
                }
                $user->save();
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Company Updated Successfully');
    }

    public function deleteCompany($id)
    {

        DB::beginTransaction();
        try {
            $company = Company::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }


    public function sisterConcernAdd(Request $request)
    {
        $validated = $request->validate([

            'company_email' =>  ['required', 'email', 'max:255', 'unique:companies', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'company_password' => ['required', 'min:8', 'max:50'],
            'company_phone' => 'required|digits_between:6,14',
        ]);

        if (Company::where('id', Auth::user()->com_id)->whereNull('company_create_limit')->exists()) {
            return back()->with('message', 'Not Permitted To Create Any Company!');
        } else {

            $company_limits = Company::where('id', Auth::user()->com_id)->first('company_create_limit');

            $created_companies_counts = Company::where('company_mother_id', Auth::user()->com_id)->count();

            if ($company_limits->company_create_limit > $created_companies_counts) {
                try {
                    $company = new Company();
                    $company->company_name = $request->company_name;
                    $company->company_name_bangla = $request->company_name_bangla;
                    $company->company_email = $request->company_email;
                    $company->company_password = Hash::make($request->company_password);
                    $company->company_phone = $request->company_phone;
                    $company->company_address = $request->company_address;
                    $company->company_web_address = $request->company_web_address;
                    $company->company_city = $request->company_city;
                    $company->company_country = $request->company_country;
                    $company->employee_id_prefix = $request->employee_id_prefix;
                    $company->company_package = Auth::user()->com_pack;
                    $company->company_mother_id = Auth::user()->com_id;

                    $image = $request->company_logo;
                    $imageName = $image->move('uploads/logos/', $image->getClientOriginalName());
                    $imageUrl = $imageName;
                    $company->company_logo = $imageUrl;
                    $company->save();

                    $company_details_id = Company::where('company_email', $request->company_email)->where('company_phone', '=', $request->company_phone)->pluck('id');

                    foreach ($company_details_id as $company_details_id_value) {

                        $user = new User();
                        $user->company_profile = "Yes";
                        $user->first_name = $request->company_name;
                        $user->last_name = " ";
                        $user->username = " ";
                        $user->department_id = 0;
                        $user->designation_id = 0;
                        $user->office_shift_id = 0;
                        $user->role_id = 0;
                        $user->email = $request->company_email;
                        $user->password = Hash::make($request->company_password);
                        $user->phone = $request->company_phone;
                        $user->profile_photo = $imageUrl;
                        $user->com_id = $company_details_id_value;
                        $user->com_pack = Auth::user()->com_pack;
                        $user->save();
                        $users = User::where('com_id', $company_details_id_value)->where('company_profile', '=', 'Yes')->get();

                        foreach ($users as $usersValue) {
                            $user = User::find($usersValue->id);
                            $user->report_to_parent_id = $usersValue->id;
                            $user->save();
                        }
                    }

                    return back()->with('message', 'Company Added Successfully');
                } catch (\Exception $e) {
                    return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
                }
            } else {
                return back()->with('message', 'Company Creating Limit Exceed!!!');
            }
        }
    }
}
