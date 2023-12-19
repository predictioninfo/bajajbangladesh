<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Objective;
use App\Models\ValuePoint;
use App\Models\ValueType;
use App\Models\valueTypeConfig;
use App\Models\valueTypeConfigDetail;
use App\Models\ValueTypeDetail;
use App\Models\YearlyReview;

use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use DB;
use Mail;

class valueConfigureController extends Controller
{
    public function valuePointConfig(Request $req)
    {
        $validated = $req->validate([
            'valuemarks' => 'required',
            'valuesignature' => 'required',

        ]);
        try {
            $value_point = new ValuePoint();
            $value_point->value_com_id = Auth::user()->com_id;
            $value_point->value_marks = $req->valuemarks;
            $value_point->value_signature = $req->valuesignature;
            $value_point->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function valuePointConfigUpdate(Request $req, $id)
    {
        $validated = $req->validate([
            'valuemarks' => 'required',
            'valuesignature' => 'required',

        ]);
        try {
            $value_point = ValuePoint::find($id);
            $value_point->value_com_id = Auth::user()->com_id;
            $value_point->value_marks = $req->valuemarks;
            $value_point->value_signature = $req->valuesignature;
            $value_point->save();
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function valuePointConfigDelete($id)
    {
        try {
            $value_point = ValuePoint::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function valueType(Request $req)
    {
        $validated = $req->validate([
            'value_type_name' => 'required',
            // 'value_type_value_point_id' => 'required',
        ]);
        try {
            $value_type = new ValueType();
            $value_type->value_type_com_id = Auth::user()->com_id;
            $value_type->value_type_name = $req->value_type_name;
            // $value_type->value_type_value_point_id = $req->value_type_value_point_id;
            $value_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function valueTypeUpdate(Request $req)
    {
        $validated = $req->validate([
            'value_type_name' => 'required',
            // 'value_type_value_point_id' => 'required',

        ]);
        try {
            $value_type = ValueType::find($req->id);
            $value_type->value_type_com_id = Auth::user()->com_id;
            $value_type->value_type_name = $req->value_type_name;
            // $value_type->value_type_value_point_id = $req->value_type_value_point_id;
            $value_type->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function valueTypeDelete($id)
    {

        try {
            $value_point = ValueType::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function valueTypeDetail(Request $req)
    {
        $validated = $req->validate([
            'value_type_id' => 'required',
            'valuedetails' => 'required',

        ]);
        try {
            $value_type = new ValueTypeDetail();
            $value_type->value_type_detail_com_id = Auth::user()->com_id;
            $value_type->value_type_detail_value_type_id = $req->value_type_id;
            $value_type->value_type_detail_value = $req->valuedetails;
            $value_type->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function UpdateValueTypeDetail(Request $req)
    {
        $validated = $req->validate([
            'value_type_id_edit' => 'required',
            'valuedetailsedit' => 'required',
        ]);
        try {
            $value_type = ValueTypeDetail::find($req->id);
            $value_type->value_type_detail_com_id = Auth::user()->com_id;
            $value_type->value_type_detail_value_type_id = $req->value_type_id_edit;
            $value_type->value_type_detail_value = $req->valuedetailsedit;
            $value_type->save();

            return back()->with('message', 'Update Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function UpdateValueTypeDelete(Request $req, $id)
    {
        try {
            $value_type = ValueTypeDetail::where('id', $id)->delete();

            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function valueTypeById(Request $request)
    {
        $where = array('id' => $request->id);
        $valueTypeByIds = ValueType::where($where)->first();
        return response()->json($valueTypeByIds);
    }

    public function valueTypDetailsById(Request $request)
    {
        $where = array('id' => $request->id);
        $valueTypeDetailsByIds = ValueTypeDetail::where($where)->first();
        return response()->json($valueTypeDetailsByIds);
    }

    public function valueTypeConfig(Request $req)
    {

        if (valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->where('value_type_emp_id', $req->value_type_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            $value_type_config = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->where('value_type_emp_id', $req->value_type_emp_id)->first('id');

            if ($value_type_config->id) {
                $this->addvalueTypeConfigDetails($value_type_config->id, $req);
            }
            return back();
        } else {

            $value_type_config = new valueTypeConfig();
            $value_type_config->value_type_config_com_id = Auth::user()->com_id;
            $value_type_config->value_type_config_dept_id = $req->value_type_config_dept_id;
            $value_type_config->value_type_desg_id = $req->value_type_desg_id;
            $value_type_config->value_type_emp_id = $req->value_type_emp_id;
            $value_type_config->status = $req->status;
            $value_type_config->save();

            if ($value_type_config->id) {
                $this->addvalueTypeConfigDetails($value_type_config->id, $req);
            }
            return back()->with('message', 'Added Successfully');
        }
        return back()->with('message', 'OOPs!Something Is Missing');
    }

    public function addvalueTypeConfigDetails($masterId, $req)
    {
        if (valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)->where('value_type_config_detail_emp_id', $req->value_type_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            return back()->with('message', 'Already Configured This Year');
        } else {
            valueTypeConfigDetail::where('value_type_config_id', $masterId)->delete();
            $value_type_detail_value_type_id = $req->value_type_id;
            $allDetails = array();
            foreach ($value_type_detail_value_type_id as $key => $value) :
                $valueDetail = array();
                $valueDetail['value_type_config_id'] = $masterId;
                $valueDetail['value_type_config_detail_com_id'] = Auth::user()->com_id;
                $valueDetail['value_type_config_dept_id'] = $req->value_type_config_dept_id;
                $valueDetail['value_type_config_detail_emp_id'] = $req->value_type_emp_id;
                $valueDetail['value_type_config_desg_id'] = $req->value_type_desg_id;
                $valueDetail['value_type_config_type_id'] = $req->value_type_config_type_id[$key];
                $valueDetail['value_type_config_type_detail_id'] = $req->config_value_type_id[$key];
                $valueDetail['value_type_config_Employee_behaviour'] = $req->employee_comments[$key];
                $valueDetail['value_type_config_supervisor_comment'] = $req->supervisor_comments[$key];
                $valueDetail['value_type_config_employee_rating'] = $req->employee_value_type_point[$key];
                // $valueDetail['value_type_config_supervisor_rating'] = $req->supervisor_employee_value_type_point[$key];
                array_push($allDetails, $valueDetail);
            endforeach;
            valueTypeConfigDetail::insert($allDetails);
            return back()->with('message', 'Added Successfully');
        }
    }

    public function employeevalueTypeConfig(Request $req)
    {

        if (valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->where('value_type_emp_id', $req->value_type_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            $value_type_config = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->where('value_type_emp_id', $req->value_type_emp_id)->first('id');

            if ($value_type_config->id) {
                $this->updateEmployeevalueTypeConfigDetails($value_type_config->id, $req);
            }
            return back();
        } else {

            $value_type_config = new valueTypeConfig();
            $value_type_config->value_type_config_com_id = Auth::user()->com_id;
            $value_type_config->value_type_config_dept_id = $req->value_type_config_dept_id;
            $value_type_config->value_type_desg_id = $req->value_type_desg_id;
            $value_type_config->value_type_emp_id = $req->value_type_emp_id;
            $value_type_config->value_date = date("Y-m-d");
            $value_type_config->save();

            if ($value_type_config->id) {
                $this->addvalueTypeConfigDetails($value_type_config->id, $req);
            }
            return back()->with('message', 'Added Successfully');
        }

        return back()->with('message', 'OOPs!Something Is Missing');
    }

    public function updateValueReview(Request $request, $id)
    {
       // return $request->all();
        DB::beginTransaction();
        // try {
            $value_type_config = valueTypeConfig::findOrFail($id);
            $value_type_config->value_type_config_com_id = Auth::user()->com_id;
            $value_type_config->value_type_config_dept_id = $request->value_type_config_dept_id;
            $value_type_config->value_type_desg_id = $request->value_type_desg_id;
            $value_type_config->value_type_emp_id = $request->value_type_emp_id;
            $value_type_config->value_satatus = $request->value_satatus;
             $value_type_config->save();

             $value_type_config_objective =  Objective::where('objective_emp_id',$request->value_type_emp_id)->first();
             $value_type_config_objective->objective_com_id = Auth::user()->com_id;
             $value_type_config_objective->objective_dept_id = $request->value_type_config_dept_id;
             $value_type_config_objective->objective_desig_id = $request->value_type_desg_id;
             $value_type_config_objective->objective_emp_id = $request->value_type_emp_id;
             $value_type_config_objective->value_point = $request->supervisor_value_point;
             $value_type_config_objective->save();
            if ($value_type_config->id) {
                $this->updateValueReviewDetails($value_type_config->id, $request);
            }
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     dd($e->getMessage());
        // }
    }

    public function updateValueReviewDetails($masterId, $req)
    {

        valueTypeConfigDetail::where('value_type_config_id', $masterId)->delete();
        $value_type_detail_value_type_id = $req->value_type_id;
        $allDetails = array();
        foreach ($value_type_detail_value_type_id as $key => $value) :
            $valueDetail = array();
            $valueDetail['value_type_config_id'] = $masterId;
            $valueDetail['value_type_config_detail_com_id'] = Auth::user()->com_id;
            $valueDetail['value_type_config_dept_id'] = $req->value_type_config_dept_id;
            $valueDetail['value_type_config_detail_emp_id'] = $req->value_type_emp_id;
            $valueDetail['value_type_config_desg_id'] = $req->value_type_desg_id;
            $valueDetail['value_type_config_type_id'] = $req->value_type_config_type_id[$key];
            $valueDetail['value_type_config_type_detail_id'] = $req->config_value_type_id[$key];
            $valueDetail['value_type_config_Employee_behaviour'] = $req->employee_comments[$key];
            $valueDetail['value_type_config_supervisor_comment'] = $req->supervisor_comments[$key];
            $valueDetail['value_type_config_employee_rating'] = $req->employee_value_type_point[$key];
            $valueDetail['value_type_config_supervisor_rating'] = $req->supervisor_employee_value_type_point[$key];

            array_push($allDetails, $valueDetail);

        endforeach;
        valueTypeConfigDetail::insert($allDetails);

        return back()->with('message', 'Updated Successfully');

    }
    public function updateEmployeevalueTypeConfigDetails($masterId, $req)
    {
        if (valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)->where('value_type_config_detail_emp_id', $req->value_type_emp_id)->whereYear('created_at', date("Y"))->exists()) {
            return back()->with('message', 'Already Configured This Year');
        } else {
        valueTypeConfigDetail::where('value_type_config_id', $masterId)->delete();
        $value_type_detail_value_type_id = $req->value_type_id;
        $allDetails = array();
        foreach ($value_type_detail_value_type_id as $key => $value) :
            $valueDetail = array();
            $valueDetail['value_type_config_id'] = $masterId;
            $valueDetail['value_type_config_detail_com_id'] = Auth::user()->com_id;
            $valueDetail['value_type_config_dept_id'] = $req->value_type_config_dept_id;
            $valueDetail['value_type_config_detail_emp_id'] = $req->value_type_emp_id;
            $valueDetail['value_type_config_desg_id'] = $req->value_type_desg_id;
            $valueDetail['value_type_config_type_id'] = $req->value_type_config_type_id[$key];
            $valueDetail['value_type_config_type_detail_id'] = $req->config_value_type_id[$key];
            $valueDetail['value_type_config_Employee_behaviour'] = $req->employee_comments[$key];
            $valueDetail['value_type_config_supervisor_comment'] = $req->supervisor_comments[$key];
            $valueDetail['value_type_config_employee_rating'] = $req->employee_value_type_point[$key];
            $valueDetail['value_type_config_supervisor_rating'] = 0;
            array_push($allDetails, $valueDetail);
        endforeach;
        valueTypeConfigDetail::insert($allDetails);
        return back()->with('message', 'Updated Successfully');
    }
    }

    public function employeePerformanceValue()
    {
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)->where('value_type_config_detail_emp_id', Session::get('employee_setup_id'))->get();
        $value_type_details = ValueTypeDetail::where('value_type_detail_com_id', Auth::user()->com_id)->get();
        $yearly_reviews = YearlyReview::where('yearly_review_com_id', Auth::user()->com_id)->get();

        $value_type_configs = valueTypeConfig::join('users', 'value_type_configs.value_type_emp_id', '=', 'users.id')
            ->select('value_type_configs.*', 'users.report_to_parent_id')
            ->where('users.id', Session::get('employee_setup_id'))
            ->where('value_type_config_com_id', '=', Auth::user()->com_id)
            ->get();
        return view('back-end.premium.user-settings.performance.employee-value', get_defined_vars());
    }

    public function employeePerformanceValueTypeConfigureDetail($id)
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with('valueUser')->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.user-settings.performance.employee-performance-value-details', get_defined_vars());
    }

    public function performanceValueTypeConfigureDetail($id)
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.performance.value.performane-value-type-config-details', get_defined_vars());
    }

    public function performanceValueTypeViewDetail($id)
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name','company_assigned_id','joining_date');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        $userDepartment = valueTypeConfig::with(['valueDepartment' => function ($q) {
            $q->select('id', 'department_name');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        $userDesignation = valueTypeConfig::with(['valueDesignation' => function ($q) {
            $q->select('id', 'designation_name');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.performance.value.performane-value-type-view-details', get_defined_vars());
    }


    public function employeeperformanceValueTypeViewDetail($id)
    {
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::with('valuetype')->where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->get();

        $value_employee_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_employee_rating');

        $value_supervisor_rating = valueTypeConfigDetail::
            where('value_type_config_detail_com_id', Auth::user()->com_id)
            ->where('value_type_config_id', $id)
            ->groupBy('value_type_config_id')
            ->avg('value_type_config_supervisor_rating');
        $userName = valueTypeConfig::with(['valueUser' => function ($q) {
            $q->select('id', 'first_name', 'last_name','company_assigned_id','joining_date');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        $userDepartment = valueTypeConfig::with(['valueDepartment' => function ($q) {
            $q->select('id', 'department_name');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        $userDesignation = valueTypeConfig::with(['valueDesignation' => function ($q) {
            $q->select('id', 'designation_name');
        }])->where('id', $id)
            ->where('value_type_config_com_id', Auth::user()->com_id)
            ->first();
        return view('back-end.premium.user-settings.performance.employee-performane-value-type-view-details', get_defined_vars());
    }

}
