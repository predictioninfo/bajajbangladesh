<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Territory;
use App\Models\Region;
use App\Models\Area;
use App\Models\AllowanceHead;
use App\Models\Announcement;
use App\Models\Policy;
use App\Models\Permission;
use App\Models\Locatoincustomize;
use Illuminate\Http\Request;
use DB;
use Auth;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('back-end.user.index');
    }

    public function allowanceIndex()
    {

        $organization_sub_module_three_add = "5.3.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_three_edit = "5.3.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_three_delete = "5.3.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $allowance_heads = AllowanceHead::where('allowance_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.allowance-head.allowance-head-index', get_defined_vars());
    }

    public function companyOrganogramIndex()
    {


        // $parent_user = User::where('report_to_parent_id', 5)->get();

        // function maincount($parent,  $level)   //Function to calculate leftcount
        //     {
        //     $count = 0;

        //          $result = User::where('report_to_parent_id','=', $parent)->get();




        //               foreach( $result as $row)

        //             {
        //                 if(!empty($row['id']))
        //                 {
        //                 $count++;
        //                 $count += maincount($row['id'], $level);


        //                 }

        //             }


        //         $totalcount = $count;
        //         return $totalcount;


        //     }

        //     $main_user_rank = maincount(5, 0); // main user value passing into the function
        //      echo $main_user_rank; exit;





        //      function display_children($parent, $level) {
        //         $count = 0;
        //         $result = User::where('report_to_parent_id','=', $parent)->get();

        //      foreach( $result as $row)
        //         {

        //             if($level === 0){

        //                 $var = $row['id']."<br>";

        //                 echo $var;
        //             }elseif($level === 1){

        //                 $var = $row['id']."<br>";

        //                 echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;

        //             } elseif($level === 2){

        //                 $var = $row['id']."<br>";

        //                 echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;

        //             }elseif($level === 3){

        //                 $var = $row['id']."<br>";

        //                 echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'. $var;

        //             }



        //                $count += display_children($row['id'], $level+1);

        //         }

        //         echo "<br>";
        //         return $count; // it will return all user_id count under parent_id
        //     }

        //    display_children(5, 0);

        //exit();

        $result_level_one = User::where('report_to_parent_id', '=', 5)->get();
        return view('back-end.premium.organization.company-organogram.organogram-index', [

            'result_level_one' =>  $result_level_one,
        ]);
    }




    public function companyIndex()
    {


        $companies = DB::table('companies')
            ->join('users', 'companies.id', '=', 'users.com_id')
            ->select('companies.*', 'users.*')
            ->where('users.id', '=', Auth::user()->id)
            ->where('users.company_profile', '=', 'Yes')
            ->get();


        // $companies = Company::where('id', '=', Auth::user()->com_id)->get();

        //return view('back-end.premium.organization.company.company-index',compact('companies'));
        return view('back-end.premium.organization.company.company-index', get_defined_vars());
    }


    public function departmentIndex()
    {

        $organization_sub_module_two_add = "5.2.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_two_edit = "5.2.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_two_delete = "5.2.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();

        return view('back-end.premium.organization.department.department-index', get_defined_vars());
    }


    public function regionIndex()
    {

        $organization_sub_module_four_add = "5.4.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_four_edit = "5.4.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_four_delete = "5.4.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();

        return view('back-end.premium.organization.region.region-index', get_defined_vars());
    }


    public function areaIndex()
    {

        $organization_sub_module_five_add = "5.5.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_five_edit = "5.5.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_five_delete = "5.5.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }



        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $areas = DB::table('areas')
            //->join('companies', 'areas.area_com_id', '=', 'companies.id')
            ->join('regions', 'areas.area_region_id', '=', 'regions.id')
            //->select('areas.*','companies.company_name', 'regions.region_name')
            ->select('areas.*', 'regions.region_name')
            ->where('area_com_id', '=', Auth::user()->com_id)
            ->get();

        return view('back-end.premium.organization.area.area-index', get_defined_vars());
    }


    public function territoryIndex()
    {


        $organization_sub_module_six_add = "5.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_six_edit = "5.6.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_six_delete = "5.6.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }



        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();

        $territories = DB::table('territories')
            //->join('companies', 'territories.territory_com_id', '=', 'companies.id')
            ->join('regions', 'territories.territory_region_id', '=', 'regions.id')
            ->join('areas', 'territories.territory_area_id', '=', 'areas.id')
            //->select('territories.*','companies.company_name', 'regions.region_name','areas.area_name')
            ->select('territories.*', 'regions.region_name', 'areas.area_name')
            ->where('territory_com_id', '=', Auth::user()->com_id)
            ->get();

        return view('back-end.premium.organization.territory.territory-index', get_defined_vars());
    }

    public function townIndex()
    {

        $organization_sub_module_seven_add = "5.7.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_seven_edit = "5.7.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_seven_delete = "5.7.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }



        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $territorys = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        $towns = DB::table('towns')
            //->join('companies', 'towns.town_com_id', '=', 'companies.id')
            ->join('regions', 'towns.town_region_id', '=', 'regions.id')
            ->join('areas', 'towns.town_area_id', '=', 'areas.id')
            ->join('territories', 'towns.town_territory_id', '=', 'territories.id')
            //->select('towns.*', 'companies.company_name', 'regions.region_name','areas.area_name','territories.territory_name')
            ->select('towns.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name')
            ->where('town_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();

        return view('back-end.premium.organization.town.town-index', get_defined_vars());
    }

    public function dbHouseIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }




        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $areas = Area::where('area_com_id', '=', Auth::user()->com_id)->get();
        $territorys = Territory::where('territory_com_id', '=', Auth::user()->com_id)->get();
        $db_houses = DB::table('db_houses')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'db_houses.db_house_region_id', '=', 'regions.id')
            ->join('areas', 'db_houses.db_house_area_id', '=', 'areas.id')
            ->join('territories', 'db_houses.db_house_territory_id', '=', 'territories.id')
            ->join('towns', 'db_houses.db_house_town_id', '=', 'towns.id')
            //->select('db_houses.*', 'companies.company_name', 'regions.region_name','areas.area_name','territories.territory_name','towns.town_name')
            ->select('db_houses.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name')
            ->where('db_house_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.db-house.db-house-index', get_defined_vars());
    }
    public function locationSixIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }




        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $location_sixes = DB::table('locationsixes')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'locationsixes.location_six_region_id', '=', 'regions.id')
            ->join('areas', 'locationsixes.location_six_area_id', '=', 'areas.id')
            ->join('territories', 'locationsixes.location_six_territory_id', '=', 'territories.id')
            ->join('towns', 'locationsixes.location_six_town_id', '=', 'towns.id')
            ->join('db_houses', 'locationsixes.location_six_db_house_id', '=', 'db_houses.id')
            //->select('db_houses.*', 'companies.company_name', 'regions.region_name','areas.area_name','territories.territory_name','towns.town_name')
            ->select('locationsixes.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name')
            ->where('location_six_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationsix.location-six', get_defined_vars());
    }
    public function locationSevenIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $location_sevens = DB::table('locatoionsevens')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'locatoionsevens.location_seven_region_id', '=', 'regions.id')
            ->join('areas', 'locatoionsevens.location_seven_area_id', '=', 'areas.id')
            ->join('territories', 'locatoionsevens.location_seven_territory_id', '=', 'territories.id')
            ->join('towns', 'locatoionsevens.location_seven_town_id', '=', 'towns.id')
            ->join('db_houses', 'locatoionsevens.location_seven_db_house_id', '=', 'db_houses.id')
            ->join('locationsixes', 'locatoionsevens.location_seven_location_six_id', '=', 'locationsixes.id')
            //->select('db_houses.*', 'companies.company_name', 'regions.region_name','areas.area_name','territories.territory_name','towns.town_name')
            ->select('locatoionsevens.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'locationsixes.location_six_location_six_name')
            ->where('location_seven_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationseven.location-seven', [

            'location_sevens' => $location_sevens,
            'regions' => $regions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
            'locations' => $locations,
        ]);
    }
    public function locationEightIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $location_eights = DB::table('locationeights')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'locationeights.location_eights_region_id', '=', 'regions.id')
            ->join('areas', 'locationeights.location_eights_area_id', '=', 'areas.id')
            ->join('territories', 'locationeights.location_eights_territory_id', '=', 'territories.id')
            ->join('towns', 'locationeights.location_eights_town_id', '=', 'towns.id')
            ->join('db_houses', 'locationeights.location_eights_db_house_id', '=', 'db_houses.id')
            ->join('locationsixes', 'locationeights.location_eights_ocation_six_id', '=', 'locationsixes.id')
            ->join('locatoionsevens', 'locationeights.location_eights_ocation_seven_id', '=', 'locatoionsevens.id')
            ->select('locationeights.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'locationsixes.location_six_location_six_name', 'locatoionsevens.location_seven_name')
            ->where('location_eights_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationeight.location-eight', [

            'location_eights' => $location_eights,
            'regions' => $regions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
            'locations' => $locations,
        ]);
    }
    public function locationNineIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $location_nines = DB::table('locationnines')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'locationnines.location_nine_region_id', '=', 'regions.id')
            ->join('areas', 'locationnines.location_nine_area_id', '=', 'areas.id')
            ->join('territories', 'locationnines.location_nine_territory_id', '=', 'territories.id')
            ->join('towns', 'locationnines.location_nine_town_id', '=', 'towns.id')
            ->join('db_houses', 'locationnines.location_nine_db_house_id', '=', 'db_houses.id')
            ->join('locationsixes', 'locationnines.location_nine_six_id', '=', 'locationsixes.id')
            ->join('locatoionsevens', 'locationnines.location_nine_seven_id', '=', 'locatoionsevens.id')
            ->join('locationeights', 'locationnines.location_nine_eight_id', '=', 'locationeights.id')
            ->select('locationnines.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'locationsixes.location_six_location_six_name', 'locatoionsevens.location_seven_name', 'locationeights.location_eights_name')
            ->where('location_nine_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationnine.location-nine', [

            'location_nines' => $location_nines,
            'regions' => $regions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
            'locations' => $locations,
        ]);
    }

    public function locationTenIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $location_tens = DB::table('locationtens')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'locationtens.location_ten_region_id', '=', 'regions.id')
            ->join('areas', 'locationtens.location_ten_area_id', '=', 'areas.id')
            ->join('territories', 'locationtens.location_ten_territory_id', '=', 'territories.id')
            ->join('towns', 'locationtens.location_ten_town_id', '=', 'towns.id')
            ->join('db_houses', 'locationtens.location_ten_db_house_id', '=', 'db_houses.id')
            ->join('locationsixes', 'locationtens.location_ten_six_id', '=', 'locationsixes.id')
            ->join('locatoionsevens', 'locationtens.location_ten_seven_id', '=', 'locatoionsevens.id')
            ->join('locationeights', 'locationtens.location_ten_eight_id', '=', 'locationeights.id')
            ->join('locationnines', 'locationtens.location_ten_nine_id', '=', 'locationnines.id')
            ->select('locationtens.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'locationsixes.location_six_location_six_name', 'locatoionsevens.location_seven_name', 'locationeights.location_eights_name', 'locationnines.location_nine_name')
            ->where('location_nine_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationten.location-ten', [

            'location_tens' => $location_tens,
            'regions' => $regions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
            'locations' => $locations,
        ]);
    }

    public function locationElevenIndex()
    {

        $organization_sub_module_eight_add = "5.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eight_edit = "5.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $organization_sub_module_eight_delete = "5.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();

        $location_elevens = DB::table('locationelevens')
            //->join('companies', 'db_houses.db_house_com_id', '=', 'companies.id')
            ->join('regions', 'locationelevens.location_eleven_region_id', '=', 'regions.id')
            ->join('areas', 'locationelevens.location_eleven_area_id', '=', 'areas.id')
            ->join('territories', 'locationelevens.location_eleven_territory_id', '=', 'territories.id')
            ->join('towns', 'locationelevens.location_eleven_town_id', '=', 'towns.id')
            ->join('db_houses', 'locationelevens.location_eleven_db_house_id', '=', 'db_houses.id')
            ->join('locationsixes', 'locationelevens.location_eleven_six_id', '=', 'locationsixes.id')
            ->join('locatoionsevens', 'locationelevens.location_eleven_seven_id', '=', 'locatoionsevens.id')
            ->join('locationeights', 'locationelevens.location_eleven_eight_id', '=', 'locationeights.id')
            ->join('locationnines', 'locationelevens.location_eleven_nine_id', '=', 'locationnines.id')
            ->join('locationtens', 'locationelevens.location_eleven_ten_id', '=', 'locationtens.id')
            ->select('locationelevens.*', 'regions.region_name', 'areas.area_name', 'territories.territory_name', 'towns.town_name', 'db_houses.db_house_name', 'locationsixes.location_six_location_six_name', 'locatoionsevens.location_seven_name', 'locationeights.location_eights_name', 'locationnines.location_nine_name', 'locationtens.location_ten_name')
            ->where('location_nine_com_id', '=', Auth::user()->com_id)
            ->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.organization.locationeleven.location-eleven', [

            'location_elevens' => $location_elevens,
            'regions' => $regions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
            'locations' => $locations,
        ]);
    }

    public function designationIndex()
    {

        $organization_sub_module_nine_add = "5.9.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_nine_edit = "5.9.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_nine_delete = "5.9.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();

        $designations = Designation::join('companies', 'designations.designation_com_id', '=', 'companies.id')
            ->join('departments', 'designations.designation_department_id', '=', 'departments.id')
            ->select('designations.*', 'companies.company_name', 'departments.department_name')
            ->where('designation_com_id', '=', Auth::user()->com_id)
            ->get();

        return view('back-end.premium.organization.designation.designation-index', get_defined_vars());
    }


    public function announcementIndex()
    {

        $organization_sub_module_ten_add = "5.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_ten_edit = "5.10.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_ten_delete = "5.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }



        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        //$announcements = Announcement::where('announcement_com_id', '=', Auth::user()->com_id)->get();

        // $announcements = Announcement::join('users', 'announcements.announcement_by', '=', 'users.id')
        //                             ->where('announcement_com_id', '=', Auth::user()->com_id)
        //                             ->join('departments', 'announcements.announcement_department_id', '=', 'departments.id')
        //                             ->select('announcements.*','users.first_name','users.last_name', 'departments.department_name')
        //                             ->get();

        if (Auth::user()->company_profile == 'Yes') {
            $announcements = Announcement::where('announcement_com_id', Auth::user()->com_id)->get();
        } else {
            $announcements = Announcement::where('announcement_com_id', Auth::user()->com_id)->where(function ($query) {
                $query->where('announcement_department_id', Auth::user()->department_id)
                    ->orWhere('announcement_department_id', 0);
            })
                ->get();
        }



        return view('back-end.premium.organization.announcement.announcement-index', get_defined_vars());
    }

    public function policyIndex()
    {

        $organization_sub_module_eleven_add = "5.11.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_eleven_edit = "5.11.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_eleven_delete = "5.11.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }



        $company_policies = Policy::join('users', 'policies.policy_added_by', '=', 'users.id')
            ->select('policies.*', 'users.first_name', 'users.last_name')
            ->where('policy_com_id', '=', Auth::user()->com_id)
            ->get();

        return view('back-end.premium.organization.company-policy.company-policy-index', get_defined_vars());
    }
}
