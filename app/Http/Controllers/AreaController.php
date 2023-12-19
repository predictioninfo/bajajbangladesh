<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Area;
use App\Models\Territory;
use Illuminate\Http\Request;
use App\Models\Locatoincustomize;

class AreaController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location2' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location2 = $request->location2;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location2 = $request->location2;
                $location->save();
                return back()->with('message', 'Location Label Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }
    public function addArea(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'area_name' => 'required',
            // 'bangla_area_name' => 'required',
        ]);
        try {
            if (Area::where('area_com_id', Auth::user()->com_id)->where('area_region_id', $request->region_id)->where('area_name', $request->area_name)->exists()) {
                return back()->with('message', 'Duplicated Area Name');
            } else {
                $area = new Area();
                $area->area_com_id = Auth::user()->com_id;
                $area->area_region_id = $request->region_id;
                $area->area_name = $request->area_name;
                // $area->bangla_area_name = $request->bangla_area_name;
                $area->save();
                return back()->with('message', 'Area Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }


    public function updateArea(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'area_name' => 'required',
        ]);
    
        try {
            $territory = Territory::where('territory_area_id', $request->id)
                                    ->select('territory_region_id')
                                    ->first();
    
            if ($territory && $territory->territory_region_id != $request->region_id) {
                return back()->with('message', 'Area cannot be updated because there have dependency');
            }
    
            if (Area::where('area_com_id', Auth::user()->com_id)
                    ->where('area_region_id', $request->region_id)
                    ->where('area_name', $request->area_name)
                    ->where('id', '!=', $request->id)
                    ->exists()) {
                return back()->with('message', 'Duplicated Area Name');
            } else {
                $area = Area::find($request->id);
                $area->area_com_id = Auth::user()->com_id;
                $area->area_region_id = $request->region_id;
                $area->area_name = $request->area_name;
                $area->save();
    
                return back()->with('message', 'Area Updated Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }

    public function deleteArea($id)
    {
        DB::beginTransaction();
        try {
            $area = Area::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteArea(Request $request)
    {
        try {
            $area = Area::where('area_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.please check Clearfully');
        }
    }
}
