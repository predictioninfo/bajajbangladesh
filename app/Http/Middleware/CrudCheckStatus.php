<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use Auth;
class CrudCheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //echo Auth::user()->role_id; exit;
                
        $user_sub_module_one_add = "1.1.1";
        if(request()->is('add-employee')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $user_sub_module_one_edit = "1.1.2";
        if(request()->is('update-employee')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $user_sub_module_one_delete = "1.1.3";
        if(request()->is('user/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
    

        $employee_sub_module_one_add = "2.1.1";
        if(request()->is('add-employee')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $employee_sub_module_one_edit = "2.1.2";
        if(request()->is('update-employee')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $employee_sub_module_one_delete = "2.1.3";
        if(request()->is('user/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_one_add = "3.1.1";
        if(request()->is('add-role')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_one_edit = "3.1.2";
        if(request()->is('update-role')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_one_delete = "3.1.3";
        if(request()->is('role/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_three_add = "3.3.1";
        if(request()->is('add-award-type') || request()->is('add-warning-type') || request()->is('add-termination-type') || request()->is('add-job-status-type') || request()->is('add-office-shift-type')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_three_edit = "3.3.2";
        if(request()->is('update-variable-type')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_three_delete = "3.3.3";
        if(request()->is('variable-type/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_four_add = "3.4.1";
        if(request()->is('add-arrangement-method') || request()->is('add-payment-type-method') || request()->is('add-qualification-method') || request()->is('add-job-category-method')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_four_edit = "3.4.2";
        if(request()->is('update-variable-method')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_four_delete = "3.4.3";
        if(request()->is('variable-method/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_five_add = "3.5.1";
        if(request()->is('add-tax-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_five_edit = "3.5.2";
        if(request()->is('update-tax-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_five_delete = "3.5.3";
        if(request()->is('tax-config/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_six_add = "3.6.1";
        if(request()->is('add-salary-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_six_edit = "3.6.2";
        if(request()->is('update-salary-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_six_delete = "3.6.3";
        if(request()->is('salary-config/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_eight_add = "3.8.1";
        if(request()->is('add-festival')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eight_edit = "3.8.2";
        if(request()->is('update-festival')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eight_delete = "3.8.3";
        if(request()->is('festival/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_nine_add = "3.9.1";
        if(request()->is('add-over-time-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_nine_edit = "3.9.2";
        if(request()->is('edit-over-time-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_nine_delete = "3.9.3";
        if(request()->is('delete-over-time-config/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_ten_add = "3.10.1";
        if(request()->is('add-late-time-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_ten_edit = "3.10.2";
        if(request()->is('update-late-time-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_ten_delete = "3.10.3";
        if(request()->is('delete-late-time-config/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_eleven_add = "3.11.1";
        if(request()->is('add-company-pf-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eleven_edit = "3.11.2";
        if(request()->is('update-company-pf-config')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eleven_delete = "3.11.3";
        if(request()->is('delete-company-pf-config/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }








        $core_hr_sub_module_one_add = "4.1.1";
        if(request()->is('add-promotion')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_one_edit = "4.1.2";
        if(request()->is('update-promotion')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_one_delete = "4.1.3";
        if(request()->is('delete-promotion/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_two_add = "4.2.1";
        if(request()->is('add-award')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_two_edit = "4.2.2";
        if(request()->is('update-award')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_two_delete = "4.2.3";
        if(request()->is('delete-award/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_three_add = "4.3.1";
        if(request()->is('add-travel')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_three_edit = "4.3.2";
        if(request()->is('update-travel')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_three_delete = "4.3.3";
        if(request()->is('delete-travel/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_four_add = "4.4.1";
        if(request()->is('add-transfer')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_four_edit = "4.4.2";
        if(request()->is('update-transfer')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_four_delete = "4.4.3";
        if(request()->is('delete-transfer/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_five_add = "4.5.1";
        if(request()->is('add-resignation')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_five_edit = "4.5.2";
        if(request()->is('update-resignation')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_five_delete = "4.5.3";
        if(request()->is('delete-resignation/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_six_add = "4.6.1";
        if(request()->is('add-complaint')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_six_edit = "4.6.2";
        if(request()->is('update-complaint')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_six_delete = "4.6.3";
        if(request()->is('delete-complaint/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_seven_add = "4.7.1";
        if(request()->is('add-warning')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_seven_edit = "4.7.2";
        if(request()->is('update-warning')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_seven_delete = "4.7.3";
        if(request()->is('delete-warning/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_eight_add = "4.8.1";
        if(request()->is('add-termination')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_eight_edit = "4.8.2";
        if(request()->is('update-termination')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_eight_delete = "4.8.3";
        if(request()->is('delete-termination/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }









        $organization_sub_module_two_add = "5.2.1";
        if(request()->is('add-department')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_two_edit = "5.2.2";
        if(request()->is('update-department')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_two_delete = "5.2.3";
        if(request()->is('department/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_three_add = "5.3.1";
        if(request()->is('add-allowance-head')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_three_edit = "5.3.2";
        if(request()->is('update-allowance-head')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_three_delete = "5.3.3";
        if(request()->is('allowance-head/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_four_add = "5.4.1";
        if(request()->is('add-region')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_four_edit = "5.4.2";
        if(request()->is('update-region')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_four_delete = "5.4.3";
        if(request()->is('region/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_five_add = "5.5.1";
        if(request()->is('add-area')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_five_edit = "5.5.2";
        if(request()->is('update-area')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_five_delete = "5.5.3";
        if(request()->is('area/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_six_add = "5.6.1";
        if(request()->is('add-territory')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_six_edit = "5.6.2";
        if(request()->is('update-territory')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_six_delete = "5.6.3";
        if(request()->is('territory/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_seven_add = "5.7.1";
        if(request()->is('add-town')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_seven_edit = "5.7.2";
        if(request()->is('update-town')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_seven_delete = "5.7.3";
        if(request()->is('town/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_eight_add = "5.8.1";
        if(request()->is('add-db-house')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eight_edit = "5.8.2";
        if(request()->is('update-db-house')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eight_delete = "5.8.3";
        if(request()->is('db-house/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_nine_add = "5.9.1";
        if(request()->is('add-designation')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_nine_edit = "5.9.2";
        if(request()->is('update-designation')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_nine_delete = "5.9.3";
        if(request()->is('designation/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_ten_add = "5.10.1";
        if(request()->is('add-announcement')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_ten_edit = "5.10.2";
        if(request()->is('update-announcement')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_ten_delete = "5.10.3";
        if(request()->is('announcement/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_eleven_add = "5.11.1";
        if(request()->is('add-company-policies')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eleven_edit = "5.11.2";
        if(request()->is('update-company-policies')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eleven_delete = "5.11.3";
        if(request()->is('company-policies/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }






        $time_sheet_sub_module_six_add = "6.6.1";
        if(request()->is('add-shift')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_six_edit = "6.6.2";
        if(request()->is('update-shift')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_six_delete = "6.6.3";
        if(request()->is('shift/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_seven_add = "6.7.1";
        if(request()->is('add-weekly-holiday')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        // $time_sheet_sub_module_seven_edit = "6.7.2";
        // if(request()->is('edit-weekly-holiday')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_edit . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return back()->with('message','You are not permitted to this action!!!');
        //     }
        // }

        $time_sheet_sub_module_seven_edit = "6.7.2";
        if(request()->is('update-weekly-holiday')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_seven_delete = "6.7.3";
        if(request()->is('delete-weekly-holiday*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_eight_add = "6.8.1";
        if(request()->is('add-other-holiday')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_eight_edit = "6.8.2";
        if(request()->is('edit-company-other-holiday')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_eight_delete = "6.8.3";
        if(request()->is('delete-other-holiday/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_nine_add = "6.9.1";
        if(request()->is('add-leave-type')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_nine_edit = "6.9.2";
        if(request()->is('update-leave-type')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_nine_delete = "6.9.3";
        if(request()->is('delete-leave-type/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_ten_add = "6.10.1";
        if(request()->is('add-leave')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        // $time_sheet_sub_module_ten_edit = "6.10.2";
        // if(request()->is('user/delete/*')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_edit . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return back()->with('message','You are not permitted to this action!!!');
        //     }
        // }
        $time_sheet_sub_module_ten_delete = "6.10.3";
        if(request()->is('delete-leave/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }







        $event_and_meeting_sub_module_one_add = "10.1.1";
        if(request()->is('add-event')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_one_edit = "10.1.2";
        if(request()->is('update-event')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_one_delete = "10.1.3";
        if(request()->is('delete-event/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $event_and_meeting_sub_module_two_add = "10.2.1";
        if(request()->is('add-meeting')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_two_edit = "10.2.2";
        if(request()->is('update-meeting')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_two_delete = "10.2.3";
        if(request()->is('delete-meeting/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }







        $support_ticket_module_add = "12.0.1";
        if(request()->is('add-support-ticket')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $support_ticket_module_edit = "12.0.2";
        if(request()->is('update-support-ticket')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $support_ticket_module_delete = "12.0.3";
        if(request()->is('delete-support-ticket/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }







        $assets_sub_module_one_add = "13.1.1";
        if(request()->is('add-asset-category')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_one_edit = "13.1.2";
        if(request()->is('update-asset-category')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_one_delete = "13.1.3";
        if(request()->is('delete-asset-category/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $assets_sub_module_two_add = "13.2.1";
        if(request()->is('add-asset')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_two_edit = "13.2.2";
        if(request()->is('update-asset')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_two_delete = "13.2.3";
        if(request()->is('delete-asset/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }






        $file_manager_sub_module_one_add = "14.1.1";
        if(request()->is('add-file-manager')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_one_edit = "14.1.2";
        if(request()->is('update-file-manager')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_one_delete = "14.1.3";
        if(request()->is('delete-file-manager/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }

        $file_manager_sub_module_two_add = "14.1.1";
        if(request()->is('add-emergency-document')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_add . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_two_edit = "14.1.2";
        if(request()->is('update-employee-document')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_edit . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_two_delete = "14.1.3";
        if(request()->is('delete-employee-document/delete/*')){
            if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_delete . '"]\')')->exists()){
                return $next($request);
            }else{
                return back()->with('message','You are not permitted to this action!!!');
            }
        }




      
    }
}
