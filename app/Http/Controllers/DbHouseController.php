<?php

namespace App\Http\Controllers;

use App\Models\DbHouse;
use App\Models\Area;
use App\Models\Town;
use App\Models\Territory;
use App\Models\Region;
use App\Models\Locatoincustomize;
use Illuminate\Http\Request;
use Auth;
use DB;

class DbHouseController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location5' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location5 = $request->location5;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location5 = $request->location5;
                $location->save();
                return back()->with('message', 'Location Label Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }
    public function addDbHouse(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'area_id' => 'required',
            'territory_id' => 'required',
            'town_id' => 'required',
            //'db_house_name' => 'required|min:3',
        ]);

        try {
            if (DbHouse::where('db_house_com_id', Auth::user()->com_id)->where('db_house_region_id', $request->region_id)->where('db_house_area_id', $request->area_id)->where('db_house_territory_id', $request->territory_id)->where('db_house_name', $request->db_house_name)->exists()) {
                return back()->with('message', 'Duplicated DB House Name');
            } else {

                $db_house = new DbHouse();
                $db_house->db_house_com_id = Auth::user()->com_id;
                $db_house->db_house_region_id = $request->region_id;
                $db_house->db_house_area_id = $request->area_id;
                $db_house->db_house_territory_id = $request->territory_id;
                $db_house->db_house_town_id = $request->town_id;
                $db_house->db_house_name = $request->db_house_name;
                //  $db_house->bangla_db_house_name = $request->bangla_db_house_name;
                $db_house->save();

                return back()->with('message', 'DB House Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function updateDbHouse(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'area_id' => 'required',
            'territory_id' => 'required',
            'town_id' => 'required',
            'db_house_name' => 'required',
           // 'bangla_db_house_name' => 'required',
        ]);
        try {
            if (DbHouse::where('db_house_com_id', Auth::user()->com_id)->where('db_house_region_id', $request->region_id)->where('db_house_area_id', $request->area_id)->where('db_house_territory_id', $request->territory_id)->where('db_house_name', $request->db_house_name)->exists()) {
                return back()->with('message', 'Duplicated DB House Name');
            } else {
                $db_house = DbHouse::find($request->id);
                $db_house->db_house_com_id = Auth::user()->com_id;
                $db_house->db_house_region_id = $request->region_id;
                $db_house->db_house_area_id = $request->area_id;
                $db_house->db_house_territory_id = $request->territory_id;
                $db_house->db_house_town_id = $request->town_id;
                $db_house->db_house_name = $request->db_house_name;
                // $db_house->bangla_db_house_name = $request->bangla_db_house_name;
                $db_house->save();
                return back()->with('message', 'DB House Updated Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function editDbHouse($id)
    {
        $db_houses = DbHouse::where('id', '=', $id)->get();
        $towns = Town::where('town_com_id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $territories = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.db-house.db-house-edit', get_defined_vars())
            ->with('message', 'Update Successfully');
    }


    public function deleteDbHouse($id)
    {

        DB::beginTransaction();
        try {
            $db_house = DbHouse::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteDbHouse(Request $request)
    {
        $db_house = DbHouse::where('db_house_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function db()
    {
        // $db_house = DbHouse::get();
        $db_house = DB::select('select * from db_points');


        return view('dbpint', compact('db_house'));
    }
}