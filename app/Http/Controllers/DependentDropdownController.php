<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Area;
use App\Models\Role;
use App\Models\Town;
use App\Models\User;
use App\Models\Grade;
use App\Models\Union;
use App\Models\Company;
use App\Models\DbHouse;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\ManPower;
use App\Models\Territory;
use App\Models\ValueType;
use App\Models\Department;
use App\Models\GradeSetup;
use App\Models\Designation;
use App\Models\Locationsix;
use App\Models\Locationten;
use App\Models\OfficeShift;
use App\Models\Locationnine;
use Illuminate\Http\Request;
use App\Models\Locationeight;
use App\Models\ObjectiveType;
use App\Models\Locationeleven;
use App\Models\Locatoionseven;
use App\Models\ObjectiveTypeConfig;
use App\Models\Resignation;



class DependentDropdownController extends Controller
{
    public function getDepartment($id)
    {
        $departments = Department::where('department_com_id', $id)->get();

        return response()->json($departments);
    }

    public function getDesignation($id)
    {
        
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();
        foreach ($roles as $roles_value) {
            if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
                $designations = Designation::where('designation_department_id', $id)->where('designation_com_id', Auth::user()->com_id)->get();
            } else {
                $designations = Designation::join('users', 'designations.id', '=', 'users.designation_id')
                    ->select('designations.*', 'designations.designation_name')
                    ->where('designation_department_id', $id)
                    ->where('users.report_to_parent_id', '=', Auth::user()->id)
                    ->where('designation_com_id', Auth::user()->com_id)
                    ->get();
            }
        }
        return response()->json($designations);
    }

    public function getObjDesignation($id)
    {
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();
        foreach ($roles as $roles_value) {
            if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
                $designations = Designation::where('designation_department_id', $id)->where('designation_com_id', Auth::user()->com_id)->get();
            } else {
                $designations = Designation::join('users', 'designations.id', '=', 'users.designation_id')
                    ->select('designations.*', 'designations.designation_name')
                    ->where('designation_department_id', $id)
                    ->where('users.report_to_parent_id', '=', Auth::user()->id)
                    ->where('designation_com_id', Auth::user()->com_id)
                    ->distinct()
                    ->get();
            }
        }
        return response()->json($designations);
    }

    public function Designation($id)
    {
        $designations = Designation::where('designation_department_id', $id)->get();
        return response()->json($designations);
    }
    
    public function getForResignationEmployee($id)
    {
        $resignations = Resignation::where('status', 1)
            ->get('resignation_employee_id');
        $excluded_ids = $resignations->pluck('resignation_employee_id')->toArray();
        $employees = User::where('designation_id', $id)
            ->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->whereNotIn('id', $excluded_ids)
            ->get();
        return response()->json($employees);
    }

    public function getDesignationWithVacancy($id)
    {
        $designations = Designation::with('DesignationManPower')
            ->where('designation_department_id', $id)
            ->get();

        $responseData = [];

        foreach ($designations as $designation) {
            $requited = User::where('com_id', '=', Auth::user()->com_id)
                ->where('designation_id', '=', $designation->id ?? '')
                ->where('is_active', '=', 1)
                ->count();

            $vacancy = ($designation->DesignationManPower ? $designation->DesignationManPower->number_of_employee : 0) - $requited;

            if ($vacancy > 0) {
                $responseData[] = [
                    'designation' => $designation,
                    'vacancy' => $vacancy
                ];
            }
        }

        if (!empty($responseData)) {
            return response()->json($responseData);
        } else {
            $responseData = [
                'message' => 'No grade found for the given ID',
                'designations' => null,
                'vacancy' => null
            ];
            return response()->json($responseData);
        }
    }
    public function getGrade($id)
    {
        $grade = GradeSetup::with('gardeSetaupGarde', 'gardeSetaupManPower')->where('desg_id', $id)->get();
        return response()->json($grade);
    }
    public function getGradeForEmployeeInsert($id)
    {
        $grade = GradeSetup::with('gardeSetaupGarde', 'gardeSetaupManPower')->where('desg_id', $id)->first();

        if ($grade) {
            $requited = User::where('com_id', '=', Auth::user()->com_id)
                ->where('department_id', '=', $grade->gardeSetaupManPower->department_id ?? '')
                ->where('designation_id', '=', $grade->gardeSetaupManPower->designation_id ?? '')
                ->where('gradesetup_id', '=', $grade->gardeSetaupManPower->grade_id ?? '')
                ->where('is_active', '=', 1)
                ->count();
            $vacancy = $grade->gardeSetaupManPower->number_of_employee -  $requited;
            $responseData = [
                'grade' => $grade,
                'vacancy' => $vacancy
            ];
            return response()->json($responseData);
        } else {
            $responseData = [
                'message' => 'No grade found for the given ID',
                'grade' => null, // add this line to return null grade data
                'vacancy' => null //

            ];
            return response()->json($responseData);
        }
    }
    public function getGradeEmployee($id)
    {
        $grade = User::where('designation_id', $id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();
        //$grade = GradeSetup::with('gardeSetaupGarde')->where('emp_id', $id)->get();
        return response()->json($grade);
    }
    public function getNumberOfEmployee($id)
    {
        // $grade = ManPower::where('gradesetup_id', $id)->first();
        $grade = ManPower::where('designation_id', $id)->first();
        return response()->json($grade);
    }
    public function getOfficeShift($id)
    {
        $office_shifts = OfficeShift::where('office_shift_com_id', $id)->get();

        return response()->json($office_shifts);
    }

    public function getDistrict($id)
    {
        $districts = District::where('division_id', $id)->get();

        return response()->json($districts);
    }
    public function getUpazila($id)
    {
        $upazilas = Upazila::where('district_id', $id)->get();

        return response()->json($upazilas);
    }
    public function getUnion($id)
    {
        $unions = Union::where('upazila_id', $id)->get();

        return response()->json($unions);
    }

    public function getDesignationWiseEmployee($id)
    {
        $employees = User::where('designation_id', $id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();

        return response()->json($employees);
    }

    public function getArea($id)
    {
        $areas = Area::where('area_region_id', $id)->get();

        return response()->json($areas);
    }

    public function getTerritory($id)
    {
        $territories = Territory::where('territory_area_id', $id)->get();

        return response()->json($territories);
    }
    public function getTown($id)
    {
        $towns = Town::where('town_territory_id', $id)->get();

        return response()->json($towns);
    }

    public function getDbHouse($id)
    {
        $db_houses = DbHouse::where('db_house_town_id', $id)->get();

        return response()->json($db_houses);
    }
    public function getLocationsix($id)
    {
        $locationsixes = Locationsix::where('location_six_db_house_id', $id)->get();

        return response()->json($locationsixes);
    }
    public function getLocationseven($id)
    {
        $locationsevens = Locatoionseven::where('location_seven_location_six_id', $id)->get();

        return response()->json($locationsevens);
    }
    public function getLocationeight($id)
    {
        $locationeights = Locationeight::where('location_eights_ocation_seven_id', $id)->get();

        return response()->json($locationeights);
    }

    public function getLocationnine($id)
    {
        $locationnines = Locationnine::where('location_nine_eight_id', $id)->get();

        return response()->json($locationnines);
    }
    public function getLocationten($id)
    {
        $locationtens = Locationten::where('location_ten_nine_id', $id)->get();

        return response()->json($locationtens);
    }
    public function getLocationeleven($id)
    {
        $locationelevens = Locationeleven::where('location_eleven_ten_id', $id)->get();

        return response()->json($locationelevens);
    }

    public function getEmployee($id)
    {
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();
        foreach ($roles as $roles_value) {
            if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
                $employees = User::where('designation_id', $id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();
            } else {

                $employees = User::where('designation_id', $id)
                    ->where('report_to_parent_id', '=', Auth::user()->id)
                    ->where('is_active', 1)
                    ->where('users_bulk_deleted', 'No')
                    ->whereNull('company_profile')
                    ->where('com_id', Auth::user()->com_id)
                    ->get();
            }
        }

        // $employees = User::where('designation_id', $id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();
        return response()->json($employees);
    }


    public function getDepartmentWiseEmployee($id)
    {
        $employees = User::where('department_id', $id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get();

        return response()->json($employees);
    }

    public function getDepartmentWiseEmployeeIncrement($id)
    {
        $employees = User::where('designation_id', $id)->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')->whereNull('company_profile')
            ->where('employment_type', '!=', 'Permanent')->get();

        return response()->json($employees);
    }

    public function getEmployeeGrossSalary($id)
    {
        $employees_gross_salary = User::where('id', $id)->get();

        return response()->json($employees_gross_salary);
    }

    public function getObjectiveType($id)
    {
        $objectiveTypeConfig = ObjectiveTypeConfig::with('userobjectivetypefromobjectiveconfig')->where('obj_config_desig_id', $id)
            ->where('obj_config_com_id', Auth::user()->com_id)->get();
        return response()->json($objectiveTypeConfig);
    }

    public function objectiveType()
    {
        $objectiveType = ObjectiveType::get();
        return response()->json($objectiveType);
    }

    public function getValueType()
    {
        $valueTypeConfig = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
        return response()->json($valueTypeConfig);
    }
}
