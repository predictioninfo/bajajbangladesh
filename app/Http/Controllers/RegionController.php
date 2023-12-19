<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Locatoincustomize;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;

class RegionController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location1' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location1 = $request->location1;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location1 = $request->location1;
                $location->save();
                return back()->with('message', 'Location Label Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }

    public function addRegion(Request $request)
    {
        $validated = $request->validate([
            'region_name' => 'required|unique:regions',
            // 'bangla_region_name' => 'required|unique:regions',
        ]);
        try {
            $region = new Region();
            $region->region_com_id = Auth::user()->com_id;
            $region->region_name = $request->region_name;
            $region->save();


            return back()->with('message', 'Region Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function updateRegion(Request $request)
    {
        $validated = $request->validate([
            'region_name' => 'required|unique:regions',
            // 'bangla_region_name' => 'required|unique:regions',
        ]);
        
        try {
            $region =  Region::find($request->id);
            $region->region_com_id = Auth::user()->com_id;
            $region->region_name = $request->region_name;
            $region->save();


            return back()->with('message', 'Region Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function deleteRegion($id)
    {

        DB::beginTransaction();
        try {
            $region = Region::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteRegion(Request $request)
    {
        try {
            $region = Region::where('region_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}