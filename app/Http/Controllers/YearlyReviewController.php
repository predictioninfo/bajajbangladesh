<?php

namespace App\Http\Controllers;
use App\Models\YearlyReview;
use Illuminate\Http\Request;
use Auth;

class YearlyReviewController extends Controller
{
    public function yearlyReviewAdd(Request $request)
	{
            $validated = $request->validate([
                'yearly_review_after_months' => 'required',
                'yearly_review_upto' => 'required|numeric|max:30',
            ]);

            // if(YearlyReview::where('yearly_review_com_id',Auth::user()->com_id)->exists()){

            //     $yearly_reviews = YearlyReview::where('yearly_review_com_id',Auth::user()->com_id)->take(1)->get('id');

            //     foreach($yearly_reviews as $yearly_reviews_value){
            //         $yearly_review =  YearlyReview::find($yearly_reviews_value->id);
            //         $yearly_review->yearly_review_after_months = $request->yearly_review_after_months;
            //         $yearly_review->yearly_review_upto = $request->yearly_review_upto;
            //         $yearly_review->save();
            //     }
            //     return back()->with('message','Updated Successfully');
            // }

            $yearly_review = new YearlyReview();
            $yearly_review->yearly_review_com_id = Auth::user()->com_id;
            $yearly_review->yearly_review_after_months = $request->yearly_review_after_months;
            $yearly_review->yearly_review_upto = $request->yearly_review_upto;
            $yearly_review->save();

            return back()->with('message','Added Successfully');
	}

    public function yearlyReviewById(Request $request) {

        $where = array('id' =>$request->id);
        $detailsByIds = YearlyReview::where($where)->first();
        return response()->json($detailsByIds);
    }

    public function yearlyReviewUpdate(Request $request)
    {
         $validated = $request->validate([
            'yearly_review_after_months' => 'required',
            'yearly_review_upto' => 'required|numeric|max:30',
        ]);

        $yearly_review =  YearlyReview::find($request->id);
        $yearly_review->yearly_review_after_months = $request->yearly_review_after_months;
        $yearly_review->yearly_review_upto = $request->yearly_review_upto;
        $yearly_review->save();

        return back()->with('message','Updated Successfully');
    }

    public function yearlyReviewDelete($id)
    {
        $yearly_review =  YearlyReview::where('id',$id)->delete();
        return back()->with('message','Deleted Successfully');
    }
}
