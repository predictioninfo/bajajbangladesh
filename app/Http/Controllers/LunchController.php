<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Lunch;
use App\Models\User;
use Auth;
class LunchController extends Controller
{
public function index(){

$organization_sub_module_twentyfour_add  = "5.24.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_twentyfour_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $organization_sub_module_twentyfour_edit = "5.24.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_twentyfour_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $organization_sub_module_twentyfour_delete = "5.24.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_twentyfour_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

    $lunches = Lunch::where('lunch_com_id', Auth::user()->com_id)->get();

    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);

    return view('back-end.premium.organization.lunch.index',get_defined_vars());
}

public function addLunchBill(Request $req){

$lunch_bill = new Lunch();
$lunch_bill->lunch_com_id = Auth::user()->com_id;
$lunch_bill->lunch_emp_id = $req->employee_id;
$lunch_bill->lunch_month_year = $req->lunch_bill_month. "-01";
$lunch_bill->lunch_bill = $req->lunch_bill;
$lunch_bill->save();

return back()->with('message','Added Succsesfully');
}
public function updateLunchBill(Request $req,$id){

$lunch_bill =  Lunch::where('lunch_com_id', Auth::user()->com_id)->where('id',$id)->first();
$lunch_bill->lunch_com_id = Auth::user()->com_id;
$lunch_bill->lunch_emp_id = $req->employee_id;
$lunch_bill->lunch_month_year = $req->lunch_bill_month. "-01";
$lunch_bill->lunch_bill = $req->lunch_bill;
$lunch_bill->save();

return back()->with('message','Added Succsesfully');
}
public function  deleteLunchBill($id){
Lunch::where('lunch_com_id', Auth::user()->com_id)->where('id',$id)->delete();
return back()->with('message','Deleted Succsesfully');

}
}