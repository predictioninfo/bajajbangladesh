<?php

namespace App\Http\Controllers;

use App\Models\ObjectiveType;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\YearlyReview;
use App\Models\PromotionDemotionPoint;
use App\Models\Permission;
use App\Models\ValuePoint;
use App\Models\ValueType;
use App\Models\ValueTypeDetail;
use App\Models\ObjectivePointConfig;
use App\Models\IncrementConfig;
use App\Models\RatingScale;
use App\Models\Recommendation;
use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use PDF;

class PerformanceConfigarationController extends Controller
{


    public function performanceConfigaration()
    {
        $performance_sub_module_three_add = "15.1.1";
        $performance_sub_module_three_edit = "15.1.2";
        $performance_sub_module_three_delete = "15.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_three_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_three_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_three_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();

        $objective_points = ObjectivePointConfig::where('objective_point_config_com_id', Auth::user()->com_id)->get();

        $promotion_demotion_points = PromotionDemotionPoint::where('pd_point_com_id', Auth::user()->com_id)->get();
        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
        $objectives = Objective::where('objective_com_id', Auth::user()->com_id)->get();
        $increment_configs = IncrementConfig::where('increment_config_com_id', Auth::user()->com_id)->orderBy('id', 'DESC')->get();
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
        $value_type_details = ValueTypeDetail::where('value_type_detail_com_id', Auth::user()->com_id)->get();
        $rating_scales = RatingScale::where('point_scale_com_id', Auth::user()->com_id)->get();
        $recommendations = Recommendation::where('recom_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.performance-configaration.performance_cofigaration', get_defined_vars());
    }

}
