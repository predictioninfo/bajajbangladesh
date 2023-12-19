<?php

namespace App\Http\Controllers;

use App\Models\SeatAllocation;
use Illuminate\Http\Request;
use Auth;

class SeatAllocationController extends Controller
{
    public function seatsAllocationAdd(Request $request)
    {
        $validated = $request->validate([
            'seat_allocation_dpt_id' => 'required',
            'seat_allocation_desig_id' => 'required',
            'seat_allocation_desig_level' => 'required',
            'seat_allocation_alctd_seat' => 'required|numeric',
        ]);
        try {
            if (SeatAllocation::where('seat_allocation_com_id', Auth::user()->com_id)->where('seat_allocation_dpt_id', $request->seat_allocation_dpt_id)->where('seat_allocation_desig_id', $request->seat_allocation_desig_id)->exists()) {

                $seat_allocations = SeatAllocation::where('seat_allocation_com_id', Auth::user()->com_id)->where('seat_allocation_dpt_id', $request->seat_allocation_dpt_id)->where('seat_allocation_desig_id', $request->seat_allocation_desig_id)->take(1)->get('id');

                foreach ($seat_allocations as $seat_allocations_value) {
                    $seat_allocation = SeatAllocation::find($seat_allocations_value->id);
                    $seat_allocation->seat_allocation_dpt_id = $request->seat_allocation_dpt_id;
                    $seat_allocation->seat_allocation_desig_id = $request->seat_allocation_desig_id;
                    $seat_allocation->seat_allocation_desig_level = $request->seat_allocation_desig_level;
                    $seat_allocation->seat_allocation_alctd_seat = $request->seat_allocation_alctd_seat;
                    $seat_allocation->save();
                }
                return back()->with('message', 'Updated Successfully');
            } else {

                $seat_allocation = new SeatAllocation();
                $seat_allocation->seat_allocation_com_id = Auth::user()->com_id;
                $seat_allocation->seat_allocation_dpt_id = $request->seat_allocation_dpt_id;
                $seat_allocation->seat_allocation_desig_id = $request->seat_allocation_desig_id;
                $seat_allocation->seat_allocation_desig_level = $request->seat_allocation_desig_level;
                $seat_allocation->seat_allocation_alctd_seat = $request->seat_allocation_alctd_seat;
                $seat_allocation->save();

                return back()->with('message', 'Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function seatsAllocationById(Request $request)
    {

        $where = array('id' => $request->id);
        $detailsByIds = SeatAllocation::where($where)->first();
        return response()->json($detailsByIds);
    }

    public function seatsAllocationUpdate(Request $request)
    {
        $validated = $request->validate([
            'seat_allocation_dpt_id' => 'required',
            'seat_allocation_desig_id' => 'required',
            'seat_allocation_desig_level' => 'required',
            'seat_allocation_alctd_seat' => 'required',
        ]);
        try {
            $seat_allocation =  SeatAllocation::find($request->id);
            $seat_allocation->seat_allocation_dpt_id = $request->seat_allocation_dpt_id;
            $seat_allocation->seat_allocation_desig_id = $request->seat_allocation_desig_id;
            $seat_allocation->seat_allocation_desig_level = $request->seat_allocation_desig_level;
            $seat_allocation->seat_allocation_alctd_seat = $request->seat_allocation_alctd_seat;
            $seat_allocation->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function seatsAllocationDelete($id)
    {
        try {
            $seat_allocation =  SeatAllocation::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}