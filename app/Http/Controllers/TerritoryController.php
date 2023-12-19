<?php

namespace App\Http\Controllers;

use App\Models\Territory;
use App\Models\Region;
use App\Models\Area;
use App\Models\Locatoincustomize;
use App\Models\Town;
use Illuminate\Http\Request;
use Auth;
use DB;

class TerritoryController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location3' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location3 = $request->location3;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location3 = $request->location3;
                $location->save();
                return back()->with('message', 'Location Label Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }
    public function addTerritory(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'area_id' => 'required',
            'territory_name' => 'required',
            // 'bangla_territory_name' => 'required',
        ]);
        try {
            if (Territory::where('territory_com_id', Auth::user()->com_id)->where('territory_region_id', $request->region_id)->where('territory_area_id', $request->area_id)->where('territory_name', $request->territory_name)->exists()) {
                return back()->with('message', 'Duplicated Territory Name');
            } else {
                $territory = new Territory();
                $territory->territory_com_id = Auth::user()->com_id;
                $territory->territory_region_id = $request->region_id;
                $territory->territory_area_id = $request->area_id;
                $territory->territory_name = $request->territory_name;
                // $territory->bangla_territory_name = $request->bangla_territory_name;
                $territory->save();

                return back()->with('message', 'Territory Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }

    public function updateTerritory(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'territory_name' => 'required',
        ]);
      
             $town = Town::where('town_territory_id', $request->id)
            ->select('town_region_id','town_area_id')
            ->first();

            if ($town &&  $town->town_area_id != $request->area_id ) {
                return back()->with('message', 'Territory cannot be updated because there have dependency');
            }


            if (Territory::where('territory_com_id', Auth::user()->com_id)
                ->where('territory_region_id', $request->region_id)
                ->where('territory_area_id', $request->area_id)
                ->where('territory_name', $request->territory_name)
                ->exists()) {
                return back()->with('message', 'Duplicated Territory Name');
            } else {
                $territory = Territory::find($request->id);
                $territory->territory_com_id = Auth::user()->com_id;
                $territory->territory_region_id = $request->region_id;
                $territory->territory_area_id = $request->area_id;
                $territory->territory_name = $request->territory_name;
                // $territory->bangla_territory_name = $request->bangla_territory_name;
                $territory->save();
                return back()->with('message', 'Territory Updated Successfully');
            }
        
    }

    public function deleteTerritory($id)
    {
        DB::beginTransaction();
        try {
            $territory = Territory::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function editTerritory($id)
    {
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();

        $territories = Territory::where('id', '=', $id)->get();
        return view('back-end.premium.organization.territory.territory-edit', get_defined_vars())
            ->with('message', 'Update Successfully');
    }

    public function bulkDeleteTerritory(Request $request)
    {
        $territory = Territory::where('territory_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
