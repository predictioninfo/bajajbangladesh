<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Department;
use App\Models\Designation;
use App\Models\ManPower;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ManPowerController extends Controller
{
    public function manPower(Request $request)
    {
        $organization_sub_module_twentythree_add = "5.23.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_twentythree_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_twentythree_edit = "5.23.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_twentythree_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_twentythree_delete = "5.23.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_twentythree_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
        $manPowers = ManPower::where('man_power_com_id',Auth::user()->com_id)
        ->with(['manPowerGardeSetaup' => function ($query) {
            $query->with('gardeSetaupGarde');
        }])
            ->WithFilters(
                $request->department_id_for_serach,
                $request->desig_id_for_serach,
                $request->gradesetup_id_for_serach,
                $request->start_date,
                $request->end_date
            )
            ->orderBy('id', 'DESC')->get();
        $request->session()->put('manPowers',  $manPowers);
        return view('back-end.premium.organization.man-power.man-power-index', get_defined_vars());
    }

    public function DownloadManPowerReport(Request $request)
    {
        $data = $request->session()->get('manPowers');
        $fileName = "Man Power Report" . ".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'font-family' => 'nikosh',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'L',
        ]);
        $mpdf->setFooter('{PAGENO}');
        $html = \View::make('back-end.premium.organization.man-power.man-power-report', get_defined_vars());
        $html = $html->render();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }

    public function createMananPower(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'department_id' => 'required',
            'designation_id' => 'required',
            'number_of_employee' => 'required',
            'vacancy_date' => 'required',
        ]);
        ManPower::where('designation_id', $request->designation_id)->delete();
        try {
            $manPower = new ManPower();
            $manPower->man_power_com_id = Auth::user()->com_id;
            $manPower->department_id = $request->department_id;
            $manPower->designation_id = $request->designation_id;
            // $manPower->gradesetup_id = $request->gradesetup_id;
            $manPower->number_of_employee = $request->number_of_employee;
            $manPower->vacancy_date = $request->vacancy_date;
            $manPower->update_vacancy_date = null;
            if ($request->increment_or_decrement == 'increment') {
                $manPower->update_employee = $request->number_of_employee + $request->previous_number_of_employee;
                $manPower->previous_employee = $request->previous_number_of_employee;
                $manPower->number_of_employee = $request->number_of_employee + $request->previous_number_of_employee;
                $manPower->update_vacancy_date = $request->vacancy_date;
                $manPower->increment_or_decrement = $request->increment_or_decrement;
            } elseif ($request->increment_or_decrement == 'decrement') {
                $manPower->update_employee = $request->previous_number_of_employee - $request->number_of_employee;
                $manPower->previous_employee = $request->previous_number_of_employee;
                $manPower->number_of_employee = $request->previous_number_of_employee - $request->number_of_employee;
                $manPower->update_vacancy_date = $request->vacancy_date;
                $manPower->increment_or_decrement = $request->increment_or_decrement;
            }
            $manPower->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Man Power Added Successfully');
    }

    public function manPowerById(Request $request)
    {
        $where = array('id' => $request->id);
        $complaintByIds = ManPower::where($where)->first();
        return response()->json($complaintByIds);
    }
    public function UpdateManPower(Request $request)
    {
        $validated = $request->validate([
            'edit_number_of_employee' => 'required',
            'edit_vacancy_date' => 'required',
        ]);

        try {

            $manPower = ManPower::find($request->id);
            $manPower->man_power_com_id = Auth::user()->com_id;
            $manPower->department_id = $request->edit_man_power_department_id;
            $manPower->designation_id = $request->edit_man_power_designation_id;
            $manPower->number_of_employee = $request->edit_number_of_employee;
            $manPower->vacancy_date = $request->edit_vacancy_date;
            $manPower->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function DeleteManPower($id)
    {
          $man_power = ManPower::where('id', $id)->first();
          $employee = User::where('department_id', $man_power->department_id)
            ->where('designation_id', $man_power->designation_id)
            ->count();
        if ($employee) {
            return back()->with('message','This Setup Not Delete, Because Employee Recruited For This Designation');
        } else {
            ManPower::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully!!!');
        }
    }
}
