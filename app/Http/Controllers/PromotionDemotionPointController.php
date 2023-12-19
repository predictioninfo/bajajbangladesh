<?php

namespace App\Http\Controllers;

use App\Models\PromotionDemotionPoint;
use Illuminate\Http\Request;
use Auth;

class PromotionDemotionPointController extends Controller
{
    public function promotionDemotionPointAdd(Request $request)
    {
        $validated = $request->validate([
            'pd_point_cat' => 'required',
            // 'pd_point_result_point' => 'required',
        ]);
       
            if (PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->where('pd_point_cat', $request->pd_point_cat)->exists()) {

                $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->where('pd_point_cat', $request->pd_point_cat)->take(1)->get('id');

                foreach ($promotion_demotion_points as $promotion_demotion_points_value) {
                    $promotion_demotion_point =  PromotionDemotionPoint::find($promotion_demotion_points_value->id);
                    $promotion_demotion_point->pd_point_cat = $request->pd_point_cat;
                    $promotion_demotion_point->pd_point_result_point = $request->pd_point_result_point;
                    $promotion_demotion_point->pd_point_min_value_point = $request->pd_point_min_value_point;
                    $promotion_demotion_point->pd_point_min_objective_point = $request->pd_point_min_objective_point;
                    $promotion_demotion_point->save();
                }
                return back()->with('message', 'Updated Successfully');
            } else {

                $promotion_demotion_point = new PromotionDemotionPoint();
                $promotion_demotion_point->pd_point_com_id = Auth::user()->com_id;
                $promotion_demotion_point->pd_point_cat = $request->pd_point_cat;
                $promotion_demotion_point->pd_point_result_point = $request->pd_point_result_point;
                $promotion_demotion_point->pd_point_min_value_point = $request->pd_point_min_value_point;
                $promotion_demotion_point->pd_point_min_objective_point = $request->pd_point_min_objective_point;
                $promotion_demotion_point->save();
            }


            return back()->with('message', 'Added Successfully');

    }

    public function promotionDemotionPointById(Request $request)
    {

        $where = array('id' => $request->id);
        $detailsByIds = PromotionDemotionPoint::where($where)->first();
        return response()->json($detailsByIds);
    }

    public function promotionDemotionPointUpdate(Request $request)
    {
        $validated = $request->validate([
            'pd_point_cat' => 'required',
            // 'pd_point_result_point' => 'required',
        ]);
        try {
            $promotion_demotion_point =  PromotionDemotionPoint::find($request->id);
            $promotion_demotion_point->pd_point_cat = $request->pd_point_cat;
            $promotion_demotion_point->pd_point_result_point = $request->pd_point_result_point;
            $promotion_demotion_point->pd_point_min_value_point = $request->pd_point_min_value_point;
            $promotion_demotion_point->pd_point_min_objective_point = $request->pd_point_min_objective_point;
            $promotion_demotion_point->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function promotionDemotionPointDelete($id)
    {
        try {
            $promotion_demotion_point =  PromotionDemotionPoint::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
