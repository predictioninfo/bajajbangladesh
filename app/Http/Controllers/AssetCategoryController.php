<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;
use Auth;


class AssetCategoryController extends Controller
{
    public function assetCategoryAdd(Request $request)
    {
        $validated = $request->validate([
            'asset_category_name' => 'required',
        ]);
        try {
            $asset_category = new AssetCategory();
            $asset_category->asset_category_com_id = Auth::user()->com_id;
            $asset_category->asset_category_name = $request->asset_category_name;
            $asset_category->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function assetCategoryById(Request $request)
    {

        $where = array('id' => $request->id);
        $assetCategoryByIds = AssetCategory::where($where)->first();

        return response()->json($assetCategoryByIds);
    }

    public function assetCategoryUpdate(Request $request)
    {
        $validated = $request->validate([
            'asset_category_name' => 'required',
        ]);
        try {
            $asset_category = AssetCategory::find($request->id);
            $asset_category->asset_category_name = $request->asset_category_name;
            $asset_category->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteAssetCategory($id)
    {
        try {
            $asset_category = AssetCategory::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
    }

    public function bulkDeleteAssetCategory(Request $request)
    {
        try {
            $bulk_asset_category = AssetCategory::where('asset_category_com_id', $request->bulk_delete_asset_category_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
    }
}