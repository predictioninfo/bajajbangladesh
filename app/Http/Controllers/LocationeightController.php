<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locatoincustomize;
use App\Models\Locationeight;
use App\Models\DbHouse;
use App\Models\Area;
use App\Models\Region;
use App\Models\Locationsix;
use App\Models\Territory;
use App\Models\Town;
use App\Models\Locatoionseven;
use Auth;
use DB;
use Exception;

class LocationeightController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location8' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location8 = $request->location8;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location8 = $request->location8;
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
            'location_eight_name' => 'required',
        ]);
        try {
            $location = new Locationeight();
            $location->location_eights_com_id = Auth::user()->com_id;
            $location->location_eights_region_id = $request->region_id;
            $location->location_eights_area_id = $request->area_id;
            $location->location_eights_territory_id = $request->territory_id;
            $location->location_eights_town_id = $request->town_id;
            $location->location_eights_db_house_id = $request->db_house_id;
            $location->location_eights_ocation_six_id = $request->location_six_id;
            $location->location_eights_ocation_seven_id = $request->location_seven_id;
            $location->location_eights_name = $request->location_eight_name;
            $location->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }

        return back()->with('message', 'Location Added Successfully');
    }

    public function updateLocation(Request $request)
    {

        $validated = $request->validate([
            'location_eight_name' => 'required',
        ]);
        try {
            $location =  Locationeight::find($request->id);
            $location->location_eights_com_id = Auth::user()->com_id;
            $location->location_eights_region_id = $request->region_id;
            $location->location_eights_area_id = $request->area_id;
            $location->location_eights_territory_id = $request->territory_id;
            $location->location_eights_town_id = $request->town_id;
            $location->location_eights_db_house_id = $request->db_house_id;
            $location->location_eights_ocation_six_id = $request->location_six_id;
            $location->location_eights_ocation_seven_id = $request->location_seven_id;
            $location->location_eights_name = $request->location_eight_name;
            $location->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return redirect('location-eight')->with('message', 'Location Updated Successfully');
    }

    public function   editLocationEight($id)
    {

        $locations_eight = Locationeight::where('id', '=', $id)->get();
        $locations_seven = Locatoionseven::where('location_seven_com_id', '=', Auth::user()->com_id)->get();
        $locations_six = Locationsix::where('location_six_com_id', '=', Auth::user()->com_id)->get();
        $db_houses = DbHouse::where('db_house_com_id', '=', Auth::user()->com_id)->get();
        $towns = Town::where('town_com_id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $territories = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationeight.locationeight-edit', get_defined_vars())
            ->with('message', 'Update Successfully');
    }

    public function deleteLocation($id)
    {
        DB::beginTransaction();
        try {
            $location = Locationeight::where('id', $id)->delete();

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
            $location = Locationeight::where('region_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Something Else! please go to your adminstration ');
        }
    }
}