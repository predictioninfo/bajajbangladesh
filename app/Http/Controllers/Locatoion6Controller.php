<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locationsix;
use App\Models\Region;
use App\Models\Area;
use App\Models\Territory;
use App\Models\DbHouse;
use App\Models\Town;

use App\Models\Locatoincustomize;
use Auth;
use DB;
use Exception;

class Locatoion6Controller extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location6' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location6 = $request->location6;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location6 = $request->location6;
                $location->save();
                return back()->with('message', 'Location Label Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }
    public function addLocation(Request $request)
    {
        $validated = $request->validate([
            'location_six_name' => 'required',
        ]);
        try {
            $location = new Locationsix();
            $location->location_six_com_id = Auth::user()->com_id;
            $location->location_six_region_id = $request->region_id;
            $location->location_six_area_id = $request->area_id;
            $location->location_six_territory_id = $request->territory_id;
            $location->location_six_town_id = $request->town_id;
            $location->location_six_db_house_id = $request->db_house_id;
            $location->location_six_location_six_name = $request->location_six_name;
            $location->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Location Added Successfully');
    }

    public function editLocationSix($id)
    {
        $locations_six = Locationsix::where('id', '=', $id)->get();
        $db_houses = DbHouse::where('db_house_com_id', '=', Auth::user()->com_id)->get();
        $towns = Town::where('town_com_id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $territories = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationsix.locationsix-edit', get_defined_vars())
            ->with('message', 'Update Successfully');
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'location_six_name' => 'required',
        ]);
        try {
            $location =  Locationsix::find($request->id);
            $location->location_six_com_id = Auth::user()->com_id;
            $location->location_six_region_id = $request->region_id;
            $location->location_six_area_id = $request->area_id;
            $location->location_six_territory_id = $request->territory_id;
            $location->location_six_town_id = $request->town_id;
            $location->location_six_db_house_id = $request->db_house_id;
            $location->location_six_location_six_name = $request->location_six_name;
            $location->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return redirect('location-six')->with('message', 'Updated Successfully');
    }


    public function deleteLocation($id)
    {

        DB::beginTransaction();
        try {
            $location = Locationsix::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteLocation(Request $request)
    {
        try {
            $location = Locationsix::where('region_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Something Else! please go to your adminstration ');
        }
    }
}