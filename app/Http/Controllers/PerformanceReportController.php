<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DevelopmentPlan;
use App\Models\ObjectiveDetails;
use App\Models\Objective;
use App\Models\ValuePoint;
use App\Models\valueTypeConfig;
use App\Models\valueTypeConfigDetail;
use App\Models\Department;
use App\Models\ObjectiveTypeConfig;
use App\Models\RatingScale;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class PerformanceReportController extends Controller
{
    public function index(Request $request)
    {
        $valueTypeConfig = valueTypeConfig::with('valueDepartment', 'valueDesignation', 'valueUser:id,first_name,last_name')
            ->where('value_type_config_com_id', '=', Auth::user()->com_id)
            ->get();
        $objective_employee = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective', 'objectiveFilter')
            ->WithFilters(
                $request->department_id,
                $request->objective_desig_id,
                $request->objective_emp_id,
                $request->start_year,
                $request->end_year,
                $request->point,
                $request->value_point
            )
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)
            ->get();
        $request->session()->put('objective_employee',  $objective_employee);
        return view('back-end.premium.performance.performance-report.objective.index', get_defined_vars());
    }

    
    public function DownloadPerformanceReport(Request $request)
    {
        $company_logo = Company::where('id', Auth::user()->com_id)->first('company_logo');
        $rating_scale = RatingScale::all();
        $data = $request->session()->get('objective_employee');
        $fileName = "Development Plans" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.performance.performance-report.objective.performance-report-pdf', get_defined_vars());
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }

    public function singleEmployeePerformanceReportPreview($id)
    {
        $rating_scale = RatingScale::all();
        $company_logo = Company::where('id', Auth::user()->com_id)->first('company_logo');
        $objective_employee = Objective::where('id', $id)
            ->first('objective_emp_id');
        $detailsDevelopment = DevelopmentPlan::where('development_emp_id', $objective_employee->objective_emp_id)
            ->with('developmentPlanDetails')
            ->first();
        $objectiveDetails = ObjectiveDetails::where('objective_id', $id)
            ->with(['objectiveReport' => function ($query) {
                $query->with('userfromobjective');
            }])->get();

        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');

        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');


        $employee_info = ObjectiveDetails::where('objective_id', $id)
            ->with(['objectiveReport' => function ($query) {
                $query->with(['userdesignationfromobjective', 'userfromobjective' => function ($query) {
                    $query->with('qualification', 'salaryIncrement', 'promotion', 'emoloyeedetail');
                }]);
            }])
            ->first();
        $supervisor_id = User::where('id', $employee_info->objectiveReport->objective_emp_id)
            ->first(['report_to_parent_id']);

        $supervisor = User::where('id', $supervisor_id->report_to_parent_id)
            ->with('userdesignation')
            ->first();

        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)
            ->get();

        $employee_id = User::where(
            'id',
            $employee_info->objectiveReport->objective_emp_id
        )->first(['id']);

        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $employee_id->id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $employee_id->id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $employee_id->id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('value_type_emp_id', $employee_id->id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.performance.performance-report.objective.single-employee-performance-report-preview', get_defined_vars());
    }
    public function singleEmployeePerformanceReportDwonload($id)
    {
        $rating_scale = RatingScale::all();
        $company_logo = Company::where('id', Auth::user()->com_id)->first('company_logo');
        $objective_employee = Objective::where('id', $id)
            ->first('objective_emp_id');
        $detailsDevelopment = DevelopmentPlan::where('development_emp_id', $objective_employee->objective_emp_id)
            ->with('developmentPlanDetails')
            ->first();
        $objectiveDetails = ObjectiveDetails::where('objective_id', $id)
            ->with(['objectiveReport' => function ($query) {
                $query->with('userfromobjective');
            }])->get();

        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');

        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');


        $employee_info = ObjectiveDetails::where('objective_id', $id)
            ->with(['objectiveReport' => function ($query) {
                $query->with(['userdesignationfromobjective', 'userfromobjective' => function ($query) {
                    $query->with('qualification', 'salaryIncrement', 'promotion', 'emoloyeedetail');
                }]);
            }])
            ->first();
        $supervisor_id = User::where('id', $employee_info->objectiveReport->objective_emp_id)
            ->first(['report_to_parent_id']);

        $supervisor = User::where('id', $supervisor_id->report_to_parent_id)
            ->with('userdesignation')
            ->first();

        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)
            ->get();

        $employee_id = User::where(
            'id',
            $employee_info->objectiveReport->objective_emp_id
        )->first(['id']);

        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $employee_id->id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $employee_id->id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_detail_emp_id', $employee_id->id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('value_type_emp_id', $employee_id->id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();

        $fileName = $employee_info->objectiveReport->userfromobjective->first_name . "'s " . "Development Plans" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $html = \View::make('back-end.premium.performance.performance-report.objective.single-employee-performance-report-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }

    public function performanceValue(Request $request)
    {
        $valueTypeConfig = valueTypeConfig::with('valueDepartment', 'valueDesignation', 'valueUser:id,first_name,last_name,joining_date')
            ->WithValueFilters(
                $request->department_id,
                $request->objective_desig_id,
                $request->objective_emp_id,
                $request->start_year,
                $request->end_year
            )
            ->where('value_type_config_com_id', '=', Auth::user()->com_id)
            ->get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)
            ->get();
        $request->session()->put('valueTypeConfig',  $valueTypeConfig);
        return view('back-end.premium.performance.performance-report.value.performance-value-index', get_defined_vars());
    }
    public function DownloadPerformanceValue(Request $request)
    {
        $data = $request->session()->get('valueTypeConfig');
        $fileName = "Development Plans" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.performance.performance-report.value.performance-value-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
    public function SinglePerformanceValueReport($id)
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::
            // join('value_points', 'value_points.id', '=', 'value_type_config_details.value_type_config_employee_rating')
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            // ->select('value_type_config_details.*',  'value_points.value_marks')
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::
            // join('value_points', 'value_points.id', '=', 'value_type_config_details.value_type_config_supervisor_rating')
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            //->select('value_type_config_details.*',  'value_points.value_marks')
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueDepartment', 'valueDesignation', 'valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name', 'joining_date');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();

        $fileName = $userName->valueUser->first_name . "'s " . "Performance value" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $html = \View::make('back-end.premium.performance.performance-report.value.single-performance-value-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
    public function SinglePerformanceValuePreview($id)
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::
            // join('value_points', 'value_points.id', '=', 'value_type_config_details.value_type_config_employee_rating')
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            // ->select('value_type_config_details.*',  'value_points.value_marks')
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::
            // join('value_points', 'value_points.id', '=', 'value_type_config_details.value_type_config_supervisor_rating')
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            //->select('value_type_config_details.*',  'value_points.value_marks')
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueDepartment', 'valueDesignation', 'valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name', 'joining_date');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.performance.performance-report.value.single-performance-value-preview', get_defined_vars());
    }

    public function performancePoint(Request $request)
    {
        $data = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective', 'objectiveFilter')
            ->WithFilters(
                $request->department_id,
                $request->objective_desig_id,
                $request->objective_emp_id,
                $request->start_year,
                $request->end_year,
                $request->point,
                $request->value_point
            )
            //   ->whereNotNull('point')
            //   ->orWhereNotNull('value_point')
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)
            ->get();
        $request->session()->put('performancePoint', $data);

        return view('back-end.premium.performance.performance-report.point.index', get_defined_vars());
    }
    public function downloadPerformancePoint(Request $request)
    {
        $data = $request->session()->get('performancePoint');
        $fileName = "Performance Point" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.performance.performance-report.point.performance-point-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
    public function SinglePerformancePointPreview($id)
    {
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');

        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');

        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();

        $employee_id = valueTypeConfig::where('value_type_emp_id', $objectiveUsers->objective_emp_id)->first('id');
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        if ($employee_id) {
            $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
                ->where('value_type_config_id', $employee_id->id)
                ->get();

            $value_employee_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
                ->where('value_type_config_id', $employee_id->id)
                ->groupBy('value_type_config_id')
                ->avg('value_type_config_employee_rating');

            $value_supervisor_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
                ->where('value_type_config_id', $employee_id->id)
                ->groupBy('value_type_config_id')
                ->avg('value_type_config_supervisor_rating');
        }
        return view('back-end.premium.performance.performance-report.point.single-performance-point-preview', get_defined_vars());
    }
    public function SinglePerformancePointReport($id)
    {
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            ->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');

        $total_rating = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)
            ->groupBy('obj_config_desig_id')
            ->avg('obj_config_target_point');

        $objectivesMarking = ObjectiveDetails::with('objectiveTypes', 'objectiveTypeConfig')
            ->where('objective_id', $id)
            ->where('obj_detail_com_id', Auth::user()->com_id)->get();
        $objectiveUsers = Objective::with('userfromobjective')->where('id', $id)->where('objective_com_id', Auth::user()->com_id)->first();

        $employee_id = valueTypeConfig::where('value_type_emp_id', $objectiveUsers->objective_emp_id)->first('id');
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        if ($employee_id) {
            $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
                ->where('value_type_config_id', $employee_id->id)
                ->get();

            $value_employee_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
                ->where('value_type_config_id', $employee_id->id)
                ->groupBy('value_type_config_id')
                ->avg('value_type_config_employee_rating');

            $value_supervisor_rating = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)
                ->where('value_type_config_id', $employee_id->id)
                ->groupBy('value_type_config_id')
                ->avg('value_type_config_supervisor_rating');
        }
        $fileName = $objectiveUsers->userfromobjective->first_name . "'s " . "Performance value" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.performance.performance-report.point.single-performance-point-pdf', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }

    public function incompletePerformanceForm(Request $request)
    {
        $valueTypeConfig = valueTypeConfig::with('valueDepartment', 'valueDesignation', 'valueUser:id,first_name,last_name')
            ->where('value_type_config_com_id', '=', Auth::user()->com_id)
            ->get();
        $incomplete_performance = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective', 'objectiveFilter')
            ->WithFilters(
                $request->department_id,
                $request->objective_desig_id,
                $request->objective_emp_id,
                $request->start_year,
                $request->end_year,
                $request->point,
                $request->value_point
            )
            ->where('point', NULL)
            ->where('value_point', NULL)
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)
            ->get();
        $request->session()->put('incomplete_performance',  $incomplete_performance);
        return view('back-end.premium.performance.performance-report.incomplete.incomplete-performance', get_defined_vars());
    }
    public function incompletePerformanceList(Request $request)
    {
        $data = $request->session()->get('incomplete_performance');
        $fileName = "Incomplete Performance List" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.performance.performance-report.incomplete.incomplete-performance-list', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }


    public function getDepartmentInfo(Request $request)
    {
        // Session::put('department', $request->id);
        $objective_employee = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective')
            ->where('objective_dept_id', $request->id)
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        return response()->json($objective_employee);
    }
    public function getDesignationInfo(Request $request)
    {
        Session::put('designation', $request->id);
        $objective_employee = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective')
            ->where('objective_desig_id', $request->id)
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        return response()->json($objective_employee);
    }
    public function getEmployeeInfo(Request $request)
    {
        Session::put('employee', $request->id);
        $objective_employee = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective')
            ->where('objective_emp_id', $request->id)
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        return response()->json($objective_employee);
    }
    public function getStartDateInfo(Request $request)
    {
        Session::put('start_date', $request->id);
        $objective_employee = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective')
            ->where('objective_date', '>=', $request->id)
            ->where('objective_dept_id', $request->dep)
            ->where('objective_desig_id', Session::get('designation'))
            ->where('objective_emp_id', Session::get('employee'))
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        return response()->json($objective_employee);
    }
    public function getEndDateInfo(Request $request)
    {
        // return $data=Session::get('department');
        // $date_with_one_day = strtotime($request->id . ' +1 day');
        // $date = date('Y-m-d', $date_with_one_day);
        $objective_employee = Objective::with('userdesignationfromobjective', 'userdepartmentfromobjective', 'userfromobjective')
            ->where('objective_date', '<=', $request->id)
            ->where('objective_date', '>=', Session::get('start_date'))
            ->where('objective_dept_id', Session::get('department'))
            ->where('objective_desig_id', Session::get('designation'))
            ->where('objective_emp_id', Session::get('employee'))
            ->where('objective_com_id', '=', Auth::user()->com_id)
            ->get();
        return response()->json($objective_employee);
    }


}
