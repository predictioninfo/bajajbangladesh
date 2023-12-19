<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Region;
use App\Models\Area;
use App\Models\Territory;
use App\Models\Town;
use App\Models\DbHouse;
use App\Models\OfficeShift;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
use Auth;


class UsersImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        // $row['employee_designation_id'] = Designation::where("name", "like", "%" . $row['designation'] . "%");
        // $row['line_manager_id']         = User::where("first_name", "like", "%" . $row['line_manager'] . "%");
        // $row['employee_job_title_id']   = HrJobTitle::where("name", "like", "%" . $row['job_title'] . "%");

        $row['department_id'] = Department::where('department_name', 'like', '%' . $row['department_id'] . '%');
        $row['designation_id'] = Designation::where('designation_name', 'like', '%' . $row['designation_id'] . '%');
        $row['office_shift_id'] = OfficeShift::where('shift_name', 'like', '%' . $row['office_shift_id'] . '%');
        $row['db_house_id'] = Region::where('region_name', 'like', '%' . $row['db_house_id'] . '%');
        $row['area_id'] = Area::where('area_name', 'like', '%' . $row['area_id'] . '%');
        $row['territory_id'] = Territory::where('territory_name', 'like', '%' . $row['territory_id'] . '%');
        $row['town_id'] = Town::where('town_name', 'like', '%' . $row['town_id'] . '%');
        $row['db_house_id'] = DbHouse::where('db_house_name', 'like', '%' . $row['db_house_id'] . '%');

        $joining = ($row['joining_date'] - 25569) * 86400;
        $formatted_joining_date = gmdate("Y-m-d", $joining);
        $birth = ($row['date_of_birth'] - 25569) * 86400;
        $formatted_birth_date = gmdate("Y-m-d", $birth);

        return new User([
            'company_assigned_id'     => $row['company_assigned_id'],
            'first_name'     => $row['first_name'],
            'last_name'    => $row['last_name'],
            'username'    => $row['username'],
            'email'    => $row['email'],
            'phone'    => $row['phone'],
            'address'    => $row['address'],
            'password'    => Hash::make($row['password']),
            'com_id'    => Auth::user()->com_id,
            'com_pack'    => Auth::user()->com_pack,
            'role_id'    => $row['role_id'],
            //'role_id'    => $bulk_employee_role_id->id,
            'report_to_parent_id'    => $row['report_to_parent_id'],
            'department_id'    => $row['department_id'],
            'designation_id'    => $row['designation_id'],
            'office_shift_id'    => $row['office_shift_id'],
            'attendance_type'    => $row['attendance_type'],
            'attendance_status'    => $row['attendance_status'],
            'joining_date'    => $formatted_joining_date,
            'gross_salary'    => $row['gross_salary'],
            'user_provident_fund_member'    => $row['user_provident_fund_member'],
            'user_provident_fund'    => $row['user_provident_fund'],
            'is_active'    => 1,
            'over_time_payable'    => $row['over_time_payable'],
            'user_over_time_type'    => $row['user_over_time_type'],
            'user_over_time_rate'    => $row['user_over_time_rate'],
            'region_id'    => $row['region_id'],
            'area_id'    => $row['area_id'],
            'territory_id'    => $row['territory_id'],
            'town_id'    => $row['town_id'],
            'db_house_id'    => $row['db_house_id'],
            'date_of_birth'    => $formatted_birth_date,
            'gender'    => $row['gender'],
        ]);
    }
}
