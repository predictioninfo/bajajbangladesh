<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Module;
use App\Models\Company;
use App\Models\SubModule;
use Illuminate\Http\Request;
use DB;
use Auth;

class PackageController extends Controller
{
    public function packageIndex()
    {

        $packages = Package::get();
        $modules = Module::get(['module_name', 'module_serial_code']);
        $sub_modules = SubModule::get(['sub_module_name', 'sub_module_serial_code']);

        return view('back-end.premium.company.package.package-index', [

            'packages' => $packages,
            'modules' => $modules,
            'sub_modules' => $sub_modules,
        ]);
    }

    public function packageAdd(Request $request)
    {
        try {
            $package_assigned_modules = [$request->package_module];

            foreach ($package_assigned_modules as $package_assigned_modules_value) {
                $package = new Package();
                $package->package_name = $request->package_name;
                $package->package_module = json_encode($package_assigned_modules_value);
                $package->save();
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function packageById(Request $request)
    {

        $where = array('id' => $request->id);
        $festivalByIds = Package::where($where)->first();

        return response()->json($festivalByIds);
    }

    public function packagelUpdate(Request $request)
    {
        try {
            $package = Package::find($request->id);
            $package->package_name = $request->package_name;
            $package->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function checkPackageByExistsCompany($packageId)
    {
        $packageList = Company::where('company_package', $packageId)->count();
        if ($packageList > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePackage($id)
    {
        DB::beginTransaction();
        try {
            $package = Package::find($id);

            if ($this->checkPackageByExistsCompany($package->id) === false) :
                $package->delete();
            endif;
            DB::commit();

            // all good
            return back()->with('message', 'Delet Successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('message', 'OOPs! There have some dependency11');
        }
    }
}