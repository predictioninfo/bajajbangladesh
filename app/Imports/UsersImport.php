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

        
        $role = Role::where('roles_com_id', Auth::user()->com_id)->where("roles_name", "like", "%" . $row['role'] . "%")->first('id');
        $department = Department::where('department_com_id', Auth::user()->com_id)->where("department_name", "like", "%" . $row['department'] . "%")->first('id');
        $designation = Designation::where('designation_com_id', Auth::user()->com_id)->where("designation_name", "like", "%" . $row['designation'] . "%")->first('id');
        $office_shift = OfficeShift::where('office_shift_com_id', Auth::user()->com_id)->where("shift_name", "like", "%" . $row['office_shift'] . "%")->first('id');
        $region = Region::where('region_com_id', Auth::user()->com_id)->where("region_name", "like", "%" . $row['region'] . "%")->first('id');
        $area = Area::where('area_com_id', Auth::user()->com_id)->where('area_name', "like", "%" . $row['area'] . "%")->first('id');
        $territory = Territory::where('territory_com_id', Auth::user()->com_id)->where("territory_name", "like", "%" . $row['territory'] . "%")->first('id');
        $town = Town::where('town_com_id', Auth::user()->com_id)->where('town_name', "like", "%" . $row['town'] . "%")->first('id');
        $db_house = DbHouse::where('db_house_com_id', Auth::user()->com_id)->where("db_house_name", "like", "%" . $row['db_house'] . "%")->first('id');

            $company_assigned_id  = $row['company_assigned_id'] ?? null;
            $first_name     = $row['first_name'] ?? null;
            $last_name    = $row['last_name'] ?? null;
            $username    = $row['username'] ?? null;
            $email   = $row['email'] ?? null;
            $phone    = $row['phone'] ?? null;
            $address    = $row['address'] ?? null;

            $password = $row['password'] ?? 12345678;

            $attendance_type = $row['attendance_type'] ?? null;
            $attendance_status  = $row['attendance_status'] ?? null;

            $gross_salary    = $row['gross_salary'] ?? null;;
            $user_provident_fund_member    = $row['user_provident_fund_member'] ?? null;
            $user_provident_fund    = $row['user_provident_fund'] ?? null;

            $over_time_payable   = $row['over_time_payable'] ?? null;
            $user_over_time_type   = $row['user_over_time_type'] ?? null;
            $user_over_time_rate   = $row['user_over_time_rate'] ?? null;

            $gender    = $row['gender'] ?? null;

            $joining = ($row['joining_date'] - 25569) * 86400;
            $formatted_joining_date = gmdate("Y-m-d", $joining);
            $birth = ($row['date_of_birth'] - 25569) * 86400;
            $formatted_birth_date = gmdate("Y-m-d", $birth);

        return new User([
            'company_assigned_id'     => $company_assigned_id,
            'first_name'     => $first_name,
            'last_name'    => $last_name,
            'username'    => $username,
            'email'    => $email,
            'phone'    => $phone,
            'address'    => $address,
            'password'    => Hash::make($password),
            'com_id'    => Auth::user()->com_id,
            'com_pack'    => Auth::user()->com_pack,
            'role_id'    => $role->id ?? null,
            // 'report_to_parent_id'    => $row['report_to_parent_id'],
            'department_id'    => $department->id ?? null,
            'designation_id'    => $designation->id ?? null,
            'office_shift_id'    => $office_shift->id ?? null,
            'attendance_type'    => $attendance_type,
            'attendance_status'    => $attendance_status,
            'joining_date'    => $formatted_joining_date,
            'gross_salary'    => $gross_salary,
            'user_provident_fund_member'    => $user_provident_fund_member,
            'user_provident_fund'    => $user_provident_fund,
            'is_active'    => 1,
            'over_time_payable'    => $over_time_payable,
            'user_over_time_type'    => $user_over_time_type,
            'user_over_time_rate'    => $user_over_time_rate,
            'region_id'    => $region->id ?? null,
            'area_id'    => $area->id ?? null,
            'territory_id' => $territory->id ?? null,
            'town_id'    => $town->id ?? null,
            'db_house_id'    => $db_house->id ?? null,
            'date_of_birth'    => $formatted_birth_date,
            'gender'    =>  $gender,
        ]);
    }
}
