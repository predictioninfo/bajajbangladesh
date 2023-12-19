<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locatoincustomize;
use App\Models\Locationeleven;
use App\Models\Locationten;
use App\Models\Locationnine;
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

class LocationelevenController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location11' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location11 = $request->location11;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location11 = $request->location11;
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
            'location_eleven_name' => 'required',
        ]);
        try {
            $location = new Locationeleven();
            $location->location_eleven_com_id = Auth::user()->com_id;
            $location->location_eleven_region_id = $request->region_id;
            $location->location_eleven_area_id = $request->area_id;
            $location->location_eleven_territory_id = $request->territory_id;
            $location->location_eleven_town_id = $request->town_id;
            $location->location_eleven_db_house_id = $request->db_house_id;
            $location->location_eleven_six_id = $request->location_six_id;
            $location->location_eleven_seven_id = $request->location_seven_id;
            $location->location_eleven_eight_id = $request->location_eight_id;
            $location->location_eleven_nine_id = $request->location_nine_id;
            $location->location_eleven_ten_id = $request->location_ten_id;
            $location->location_eleven_name = $request->location_eleven_name;
            $location->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }

        return back()->with('message', 'Location Added Successfully');
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'location_eleven_name' => 'required',
        ]);
        try {
            $location =  Locationeleven::find($request->id);
            $location->location_eleven_com_id = Auth::user()->com_id;
            $location->location_eleven_region_id = $request->region_id;
            $location->location_eleven_area_id = $request->area_id;
            $location->location_eleven_territory_id = $request->territory_id;
            $location->location_eleven_town_id = $request->town_id;
            $location->location_eleven_db_house_id = $request->db_house_id;
            $location->location_eleven_six_id = $request->location_six_id;
            $location->location_eleven_seven_id = $request->location_seven_id;
            $location->location_eleven_eight_id = $request->location_eight_id;
            $location->location_eleven_nine_id = $request->location_nine_id;
            $location->location_eleven_ten_id = $request->location_ten_id;
            $location->location_eleven_name = $request->location_eleven_name;
            $location->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return redirect('location-eleven')->with('message', 'Location Updated Successfully');
    }

    public function   editLocationEleven($id)
    {

        $locations_eleven = Locationeleven::where('id', '=', $id)->get();
        $locations_ten = Locationten::where('location_ten_com_id', '=', Auth::user()->com_id)->get();
        $locations_nine = Locationnine::where('location_nine_com_id', '=', Auth::user()->com_id)->get();
        $locations_eight = Locationeight::where('location_eights_com_id', '=', Auth::user()->com_id)->get();
        $locations_seven = Locatoionseven::where('location_seven_com_id', '=', Auth::user()->com_id)->get();
        $locations_six = Locationsix::where('location_six_com_id', '=', Auth::user()->com_id)->get();
        $db_houses = DbHouse::where('db_house_com_id', '=', Auth::user()->com_id)->get();
        $towns = Town::where('town_com_id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $territories = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationeleven.locationeleven-edit', get_defined_vars())
            ->with('message', 'Update Successfully');
    }


    public function deleteLocation($id)
    {

        DB::beginTransaction();
        try {
            $location = Locationeleven::where('id', $id)->delete();

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
            $location = Locationeleven::where('region_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Something Else! please go to your adminstration ');
        }
    }
}