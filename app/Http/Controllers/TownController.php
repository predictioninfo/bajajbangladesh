<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Models\Locatoincustomize;
use App\Models\Region;
use App\Models\Area;
use App\Models\DbHouse;
use App\Models\Territory;
use Illuminate\Http\Request;
use Auth;
use DB;

class TownController extends Controller
{
    public function LocationCustomize(Request $request)
    {
        $validated = $request->validate([
            'location4' => 'required',
        ]);
        try {
            if (Locatoincustomize::where('location_com_id', Auth::user()->com_id)->exists()) {

                $location = Locatoincustomize::where('location_com_id', Auth::user()->com_id)->first();
                $location->location4 = $request->location4;
                $location->save();

                return back()->with('message', 'Location Label Added Successfully');
            } else {
                $location = new Locatoincustomize();
                $location->location_com_id = Auth::user()->com_id;
                $location->location4 = $request->location4;
                $location->save();
                return back()->with('message', 'Location Label Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Please Added Properly');
        }
    }

    public function addTown(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'area_id' => 'required',
            'territory_id' => 'required',
            'town_name' => 'required',
            // 'bangla_town_name' => 'required',
        ]);
        try {
            if (Town::where('town_com_id', Auth::user()->com_id)->where('town_region_id', $request->region_id)->where('town_area_id', $request->area_id)->where('town_territory_id', $request->territory_id)->where('town_name', $request->town_name)->exists()) {
                return back()->with('message', 'Duplicated Town Name');
            } else {

                $town = new Town();
                $town->town_com_id = Auth::user()->com_id;
                $town->town_region_id = $request->region_id;
                $town->town_area_id = $request->area_id;
                $town->town_territory_id = $request->territory_id;
                $town->town_name = $request->town_name;
                // $town->bangla_town_name = $request->bangla_town_name;
                $town->save();
                return back()->with('message', 'Town Added Successfully');
            }
            return back()->with('message', 'Town Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function updateTown(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required',
            'town_name' => 'required',
        ]);
        try {

            $dbHouse = DbHouse::where('db_house_town_id', $request->id)
            ->select('db_house_region_id','db_house_area_id','db_house_territory_id')
            ->first();

            if ($dbHouse && $dbHouse->db_house_area_id != $request->area_id && $dbHouse && $dbHouse->db_house_territory_id != $request->territory_id) {
                return back()->with('message', 'Town cannot be updated because there have dependency');
            }

            if (Town::where('town_com_id', Auth::user()->com_id)->where('town_region_id', $request->region_id)->where('town_area_id', $request->area_id)->where('town_territory_id', $request->territory_id)->where('town_name', $request->town_name)->exists()) {
                return back()->with('message', 'Duplicated Town Name');
            } else {
                $town = Town::find($request->id);
                $town->town_com_id = Auth::user()->com_id;
                $town->town_region_id = $request->region_id;
                $town->town_area_id = $request->area_id;
                $town->town_territory_id = $request->territory_id;
                $town->town_name = $request->town_name;
                // $town->bangla_town_name = $request->bangla_town_name;
                $town->save();
                return back()->with('message', 'Town Updated Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function editTown($id)
    {
        $towns = Town::where('id', '=', $id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $territories = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.town.town-edit', get_defined_vars())
            ->with('message', 'Update Successfully');
    }


    public function deleteTown($id)
    {

        DB::beginTransaction();
        try {
            $town = Town::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteTown(Request $request)
    {
        $town = Town::where('town_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
