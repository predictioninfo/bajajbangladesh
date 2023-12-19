<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\Asset;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth;
use Image;

class AssetController extends Controller
{
    public function assetCategoryIndex()
    {
        try {
            $assets_sub_module_one_add = "13.1.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $assets_sub_module_one_edit = "13.1.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $assets_sub_module_one_delete = "13.1.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }


            $asset_categories = AssetCategory::where('asset_category_com_id', Auth::user()->com_id)->get();
            return view('back-end.premium.assets.asset-category.asset-category-index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }


    public function assetIndex()
    {
        try {
            $assets_sub_module_two_add = "13.2.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $assets_sub_module_two_edit = "13.2.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $assets_sub_module_two_delete = "13.2.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }

            $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);
            $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
            $asset_categories = AssetCategory::where('asset_category_com_id', Auth::user()->com_id)->get();

            if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {

                $assets = Asset::join('users', 'assets.asset_employee_id', '=', 'users.id')
                    ->join('departments', 'assets.asset_department_id', '=', 'departments.id')
                    ->select('assets.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'users.company_assigned_id')
                    ->where('asset_com_id', Auth::user()->com_id)
                    ->get();
            } else {

                $assets = Asset::join('users', 'assets.asset_employee_id', '=', 'users.id')
                    ->join('departments', 'assets.asset_department_id', '=', 'departments.id')
                    ->select('assets.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'users.company_assigned_id')
                    ->where('asset_employee_id', Auth::user()->id)
                    ->get();
            }

            return view('back-end.premium.assets.asset.asset-index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function assetAdd(Request $request)
    {
        $validated = $request->validate([
            'asset_name' => 'required|min:4',
            'asset_department_id' => 'required',
            'asset_employee_id' => 'required',
            'asset_code' => 'required',
            'asset_category_name' => 'required',
            'asset_is_working' => 'required',
            'asset_purchase_date' => 'required',
            'asset_warranty_end_date' => 'required',
            'asset_manufacturer' => 'required',
            'asset_serial_number' => 'required',
            'asset_note' => 'required',
            'asset_image' => 'required|max:10240',
        ]);
        try {
            $asset = new Asset();
            $asset->asset_com_id = Auth::user()->com_id;
            $asset->asset_department_id = $request->asset_department_id;
            $asset->asset_employee_id = $request->asset_employee_id;
            $asset->asset_name = $request->asset_name;
            $asset->asset_code = $request->asset_code;
            $asset->asset_category_name = $request->asset_category_name;
            $asset->asset_is_working = $request->asset_is_working;
            $asset->asset_purchase_date = $request->asset_purchase_date;
            $asset->asset_warranty_end_date = $request->asset_warranty_end_date;
            $asset->asset_manufacturer = $request->asset_manufacturer;
            $asset->asset_serial_number = $request->asset_serial_number;
            $asset->asset_note = $request->asset_note;

            $image = $request->file('asset_image');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/asset-images';
            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $asset->asset_image = $imageUrl;

            $filePath = 'uploads/asset-images/before-resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);

            $asset->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function assetById(Request $request)
    {

        $where = array('id' => $request->id);
        $assetByIds = Asset::where($where)->first();

        return response()->json($assetByIds);
    }

    public function assetUpdate(Request $request)
    {
        $validated = $request->validate([
            'asset_name' => 'required|min:4',
            'edit_asset_department_id' => 'required',
            'asset_code' => 'required',
            'asset_category_name' => 'required',
            'asset_is_working' => 'required',
            'asset_purchase_date' => 'required',
            'asset_warranty_end_date' => 'required',
            'asset_manufacturer' => 'required',
            'asset_serial_number' => 'required',
            'asset_note' => 'required',
        ]);
        try {
            $asset = Asset::find($request->id);
            $asset->asset_department_id = $request->edit_asset_department_id;
            if ($request->edit_asset_employee_id) {
                $asset->asset_employee_id = $request->edit_asset_employee_id;
            }
            $asset->asset_name = $request->asset_name;
            $asset->asset_code = $request->asset_code;
            $asset->asset_category_name = $request->asset_category_name;
            $asset->asset_is_working = $request->asset_is_working;
            $asset->asset_purchase_date = $request->asset_purchase_date;
            $asset->asset_warranty_end_date = $request->asset_warranty_end_date;
            $asset->asset_manufacturer = $request->asset_manufacturer;
            $asset->asset_serial_number = $request->asset_serial_number;
            $asset->asset_note = $request->asset_note;
            if ($request->asset_image) {
                $image = $request->file('asset_image');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/asset-images';
                $img = Image::make($image->path());
                $img->resize(110, 110, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $input['imagename']);
                $imageUrl = $filePath . '/' . $input['imagename'];
                $asset->asset_image = $imageUrl;

                $filePath = 'uploads/asset-images/before-resized/';
                $before_resized_imageNames = $image->move($filePath, $input['imagename']);
            }
            $asset->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }
    public function deleteAsset($id)
    {
        try {
            $asset = Asset::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteAsset(Request $request)
    {
        try {
            $bulkasset = Asset::where('asset_com_id', $request->bulk_delete_asset_com_id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}