<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Permission;
use Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }








    public function handle($request, Closure $next)
    {


        if (Auth::user()->id) {
            return $next($request);
        } else {
            return redirect('/login');
        }


        if (request()->is('employee-attendances')) {
            return $next($request);
        }

        $dashboard_module = "0";
        if (request()->is('home')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $dashboard_module . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes') || (Auth::user()->super_system_admin == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        if (request()->is('company-list')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        if (request()->is('package-list')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        if (request()->is('add-package')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        if (request()->is('package-permissions/*')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        if (request()->is('edit-package')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        if (request()->is('delete-package/*')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        if (request()->is('package-permission-giving')) {
            if (Auth::user()->super_system_admin == 'Yes') {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }


        $user_settings_panel = "15";
        if (
            request()->is('employee-detail/*') ||

            request()->is('employee-profile') ||
            request()->is('employee-profile-photo-update') ||

            request()->is('employee-basic-info') ||
            request()->is('update-employee-basic-info') ||
            request()->is('updated-by-employee-basic-info') ||

            request()->is('employee-immigration') ||
            request()->is('add-immigrant-employee') ||
            request()->is('update-employee-immigrant') ||
            request()->is('delete-employee-immigrant/delete/*') ||
            request()->is('employee-emergency-contact') ||
            request()->is('add-emergency-contact-employee') ||
            request()->is('update-employee-emergency-contact') ||
            request()->is('delete-employee-emergency-contact/delete/*') ||
            request()->is('employee-social-profile') ||
            request()->is('add-emergency-social-profile') ||
            request()->is('update-employee-social-profile') ||
            request()->is('delete-employee-social-profile/delete/*') ||
            request()->is('employee-document') ||
            request()->is('add-emergency-document') ||
            request()->is('update-employee-document') ||
            request()->is('delete-employee-document/delete/*') ||
            request()->is('employee-qualification') ||
            request()->is('add-employee-qualification') ||
            request()->is('update-employee-qualification') ||
            request()->is('delete-employee-qualification/delete/*') ||
            request()->is('employee-work-experience') ||
            request()->is('add-emergency-work-experience') ||
            request()->is('update-employee-work-experience') ||
            request()->is('delete-employee-work-experience/delete/*') ||
            request()->is('employee-bank-account') ||
            request()->is('add-employee-bank-account') ||
            request()->is('update-employee-bank-account') ||
            request()->is('delete-employee-bank-account/delete/*') ||
            request()->is('employee-pf-bank-accounts') ||
            request()->is('add-pf-employee-bank-account') ||
            request()->is('update-employee-pf-bank-account') ||
            request()->is('delete-employee-pf-bank-account/*') ||
            request()->is('employee-appointment-letter') ||
            request()->is('employee-id-card-download') ||

            request()->is('employee-total-salary') ||
            request()->is('add-employee-gross-salary') ||
            request()->is('update-employee-gross-salary') ||
            request()->is('delete-employee-gross-salary/delete/*') ||

            request()->is('employee-allowance') ||

            request()->is('employee-commission') ||
            request()->is('add-employee-commission') ||
            request()->is('update-employee-commission') ||
            request()->is('delete-employee-commission/delete/*') ||
            request()->is('employee-loan') ||
            request()->is('add-employee-loan') ||
            request()->is('update-employee-loan') ||
            request()->is('delete-employee-loan/delete/*') ||
            request()->is('employee-statutory-deduction') ||
            request()->is('add-employee-statutory-deduction') ||
            request()->is('update-employee-statutory-deduction') ||
            request()->is('delete-employee-statutory-deduction/delete/*') ||
            request()->is('employee-other-payment') ||
            request()->is('add-employee-other-payment') ||
            request()->is('update-employee-other-payment') ||
            request()->is('delete-employee-other-payment/delete/*') ||
            request()->is('employee-over-time') ||
            request()->is('add-employee-over-time') ||
            request()->is('update-employee-over-time') ||
            request()->is('delete-employee-over-time/delete/*') ||
            request()->is('employee-pension') ||
            request()->is('add-employee-pension') ||
            request()->is('update-employee-pension') ||
            request()->is('delete-employee-pension/delete/*') ||

            request()->is('employee-awards') ||
            request()->is('employee-travels') ||
            request()->is('employee-transfers') ||
            request()->is('employee-terminations') ||
            request()->is('employee-promotions') ||
            request()->is('employee-complaints') ||
            request()->is('employee-warnings') ||

            request()->is('employee-leave') ||

            request()->is('employee-support-tickets') ||

            request()->is('employee-report-to-config') ||
            request()->is('set-employee-report-to-id/*') ||

            request()->is('employee-pf-config') ||

            request()->is('employee-project') ||
            request()->is('add-employee-projects') ||
            request()->is('update-employee-project') ||
            request()->is('employee-project/delete/*') ||

            request()->is('employee-task') ||
            request()->is('add-employee-task') ||
            request()->is('update-task-project') ||
            request()->is('employee-task/delete/*') ||
            request()->is('employee-pay-slip')
        ) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_settings_panel . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect()->back();
            }
        }


        $user_module = "1";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $user_sub_module_one = "1.1";
        if (request()->is('user-list')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $user_sub_module_two = "1.2";
        if (request()->is('assigning-role')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $user_sub_module_three = "1.3";
        if (request()->is('admin/user-activity')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $employee_module = "2";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $employee_sub_module_one = "2.1";
        if (request()->is('employee-list')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $employee_sub_module_two = "2.2";
        if (request()->is('import-employees')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $customize_module = "3";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $customize_sub_module_one = "3.1";
        if (request()->is('role')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_two = "3.2";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_two . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $customize_sub_module_three = "3.3";
        if (request()->is('variable-types')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_four = "3.4";
        if (request()->is('variable-methods')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }





        $customize_sub_module_five = "3.5";
        if (request()->is('tax-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_six = "3.6";
        if (request()->is('salary-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_eight = "3.8";
        if (request()->is('festival')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_nine = "3.9";
        if (request()->is('over-time-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_ten = "3.10";
        if (request()->is('late-time-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $customize_sub_module_eleven = "3.11";
        if (request()->is('company-pf-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $core_hr_module =  "4";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $core_hr_sub_module_one = "4.1";
        if (request()->is('promotions')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_two = "4.2";
        if (request()->is('awards')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_three = "4.3";
        if (request()->is('travels')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_four = "4.4";
        if (request()->is('transfers')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_five = "4.5";
        if (request()->is('resignations')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_six = "4.6";
        if (request()->is('complaints')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_seven = "4.7";
        if (request()->is('warnings')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_eight = "4.8";
        if (request()->is('terminations')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_nine = "4.9";
        if (request()->is('provident-fund-members')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_nine . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $core_hr_sub_module_ten = "4.10";
        if (request()->is('take-pf-membership')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_ten . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $organization_module = "5";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }

        $organization_sub_module_one = "5.1";
        if (request()->is('company') || request()->is('company-update')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $organization_sub_module_two = "5.2";
        if (request()->is('department')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_three = "5.3";
        if (request()->is('allowance-head')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_four = "5.4";
        if (request()->is('region')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_five = "5.5";
        if (request()->is('area')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_six = "5.6";
        if (request()->is('territory')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_seven = "5.7";
        if (request()->is('town')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_eight = "5.8";
        if (request()->is('db-house')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_nine = "5.9";
        if (request()->is('designation')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_ten = "5.10";
        if (request()->is('announcements')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $organization_sub_module_eleven = "5.11";
        if (request()->is('company-policies')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $time_sheet_module = "6";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $time_sheet_sub_module_one = "6.1";
        if (request()->is('attendance')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_two = "6.2";
        if (request()->is('date-wise-attendances')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_three = "6.3";
        if (request()->is('monthly-attendances')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_four = "6.4";
        if (request()->is('update-attendances')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_four . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_five = "6.5";
        if (request()->is('import-attendances')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_five . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_six = "6.6";
        if (request()->is('office-shift')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_seven = "6.7";
        if (request()->is('manage-weekly-holiday')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_eight = "6.8";
        if (request()->is('manage-other-holiday')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_nine = "6.9";
        if (request()->is('manage-leave-type')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_ten = "6.10";
        if (request()->is('manage-leaves')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $time_sheet_sub_module_eleven = "6.11";
        if (request()->is('approve-leave') || request()->is('approve-leave-request/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eleven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $payroll_module = "7";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $payroll_sub_module_one = "7.1";
        if (request()->is('new-payments') || request()->is('make-payment')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $payroll_sub_module_two = "7.2";
        if (request()->is('payment-history')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $payroll_sub_module_three = "7.3";
        if (request()->is('pf-history')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }





        $hr_calander_module =  "8";
        if (request()->is('fullcalender')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_calander_module . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }






        $hr_report_module = "9";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $hr_report_sub_module_one = "9.1";
        if (request()->is('attendance-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_two = "9.2";
        if (request()->is('training-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_three = "9.3";
        if (request()->is('project-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_four = "9.4";
        if (request()->is('task-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_four . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_five = "9.5";
        if (request()->is('employee-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_five . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_six = "9.6";
        if (request()->is('account-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_six . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_seven = "9.7";
        if (request()->is('expense-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_seven . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_eight = "9.8";
        if (request()->is('deposite-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_eight . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_nine = "9.9";
        if (request()->is('transaction-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_nine . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $hr_report_sub_module_ten = "9.10";
        if (request()->is('pf-report')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_ten . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $event_and_meeting_module = "10";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $event_and_meeting_sub_module_one = "10.1";
        if (request()->is('events')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $event_and_meeting_sub_module_two = "10.2";
        if (request()->is('meetings')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }


        $project_management_module = "11";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $project_management_sub_module_one = "11.1";
        if (request()->is('projects') || request()->is('add-projects') || request()->is('update-project') || request()->is('project/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $project_management_sub_module_two = "11.2";
        if (request()->is('tasks') || request()->is('add-task') || request()->is('update-task') || request()->is('task/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }




        $support_ticket_module = "12";
        if (request()->is('support-tickets')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $assets_module = "13";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $assets_sub_module_one = "13.1";
        if (request()->is('asset-categories')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $assets_sub_module_two = "13.2";
        if (request()->is('assets')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }

        $file_manager_module = "14";
        // if(request()->is('add-employee')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_module . '"]\')')->exists()){
        //         return $next($request);
        //     }else{
        //         return redirect('/login')->with(Auth::logout());
        //     }
        // }
        $file_manager_sub_module_one = "14.1";
        if (request()->is('file-manager')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $file_manager_sub_module_two = "14.2";
        if (request()->is('official-documents')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }
        $file_manager_sub_module_three = "14.3";
        if (request()->is('file-configuration')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_three . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return redirect('/login')->with(Auth::logout());
            }
        }




        ########################### employee setting panel code starts from here####################################


        ########################### employee setting panel code ends here####################################
        ###########################all add, edit and delete urls code starts from here####################################




        $user_sub_module_one_add = "1.1.1";
        if (request()->is('add-employee')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $user_sub_module_one_edit = "1.1.2";
        if (request()->is('update-employee')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $user_sub_module_one_delete = "1.1.3";
        if (request()->is('user/delete/*')  || request()->is('user/active/*') || request()->is('user/inactive/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $user_sub_module_one_delete = "1.1.3";
        if (request()->is('bulk-delete-employee')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $user_sub_module_one_delete = "1.1.3";
        if (request()->is('bulk-restore-employee')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }


        $employee_sub_module_one_add = "2.1.1";
        if (request()->is('add-employee')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $employee_sub_module_one_edit = "2.1.2";
        if (request()->is('update-employee')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $employee_sub_module_one_delete = "2.1.3";
        if (request()->is('user/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_one_add = "3.1.1";
        if (request()->is('add-role')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_one_edit = "3.1.2";
        if (request()->is('update-role')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_one_delete = "3.1.3";
        if (request()->is('role/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_one_permission = "3.1.4";
        if (request()->is('role-access-permission/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_permission . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_one_permission_giving = "3.1.5";
        if (request()->is('permission-giving')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_permission_giving . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_three_add = "3.3.1";
        if (request()->is('add-award-type') || request()->is('add-warning-type') || request()->is('add-termination-type') || request()->is('add-job-status-type') || request()->is('add-office-shift-type')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_three_edit = "3.3.2";
        if (request()->is('update-variable-type')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_three_delete = "3.3.3";
        if (request()->is('variable-type/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_four_add = "3.4.1";
        if (request()->is('add-arrangement-method') || request()->is('add-payment-type-method') || request()->is('add-qualification-method') || request()->is('add-job-category-method')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_four_edit = "3.4.2";
        if (request()->is('update-variable-method')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_four_delete = "3.4.3";
        if (request()->is('variable-method/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_five_add = "3.5.1";
        if (request()->is('add-tax-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_five_edit = "3.5.2";
        if (request()->is('update-tax-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_five_delete = "3.5.3";
        if (request()->is('tax-config/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_six_add = "3.6.1";
        if (request()->is('add-salary-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_six_edit = "3.6.2";
        if (request()->is('update-salary-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_six_delete = "3.6.3";
        if (request()->is('salary-config/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_eight_add = "3.8.1";
        if (request()->is('add-festival')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eight_edit = "3.8.2";
        if (request()->is('update-festival')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eight_delete = "3.8.3";
        if (request()->is('festival/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_nine_add = "3.9.1";
        if (request()->is('add-over-time-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_nine_edit = "3.9.2";
        if (request()->is('edit-over-time-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_nine_delete = "3.9.3";
        if (request()->is('delete-over-time-config/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_ten_add = "3.10.1";
        if (request()->is('add-late-time-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_ten_edit = "3.10.2";
        if (request()->is('update-late-time-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_ten_delete = "3.10.3";
        if (request()->is('delete-late-time-config/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $customize_sub_module_eleven_add = "3.11.1";
        if (request()->is('add-company-pf-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eleven_edit = "3.11.2";
        if (request()->is('update-company-pf-config')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $customize_sub_module_eleven_delete = "3.11.3";
        if (request()->is('delete-company-pf-config/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }








        $core_hr_sub_module_one_add = "4.1.1";
        if (request()->is('add-promotion')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_one_edit = "4.1.2";
        if (request()->is('update-promotion')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_one_delete = "4.1.3";
        if (request()->is('delete-promotion/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_two_add = "4.2.1";
        if (request()->is('add-award')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_two_edit = "4.2.2";
        if (request()->is('update-award')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_two_delete = "4.2.3";
        if (request()->is('delete-award/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_three_add = "4.3.1";
        if (request()->is('add-travel')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_three_edit = "4.3.2";
        if (request()->is('update-travel')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_three_delete = "4.3.3";
        if (request()->is('delete-travel/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_four_add = "4.4.1";
        if (request()->is('add-transfer')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_four_edit = "4.4.2";
        if (request()->is('update-transfer')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_four_delete = "4.4.3";
        if (request()->is('delete-transfer/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_five_add = "4.5.1";
        if (request()->is('add-resignation')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_five_edit = "4.5.2";
        if (request()->is('update-resignation')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_five_delete = "4.5.3";
        if (request()->is('delete-resignation/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_six_add = "4.6.1";
        if (request()->is('add-complaint')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_six_edit = "4.6.2";
        if (request()->is('update-complaint')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_six_delete = "4.6.3";
        if (request()->is('delete-complaint/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_seven_add = "4.7.1";
        if (request()->is('add-warning')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_seven_edit = "4.7.2";
        if (request()->is('update-warning')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_seven_delete = "4.7.3";
        if (request()->is('delete-warning/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $core_hr_sub_module_eight_add = "4.8.1";
        if (request()->is('add-termination')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_eight_edit = "4.8.2";
        if (request()->is('update-termination')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $core_hr_sub_module_eight_delete = "4.8.3";
        if (request()->is('delete-termination/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }









        $organization_sub_module_two_add = "5.2.1";
        if (request()->is('add-department')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_two_edit = "5.2.2";
        if (request()->is('update-department')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_two_delete = "5.2.3";
        if (request()->is('department/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_three_add = "5.3.1";
        if (request()->is('add-allowance-head')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_three_edit = "5.3.2";
        if (request()->is('update-allowance-head')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_three_delete = "5.3.3";
        if (request()->is('allowance-head/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_four_add = "5.4.1";
        if (request()->is('add-region')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_four_edit = "5.4.2";
        if (request()->is('update-region')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_four_delete = "5.4.3";
        if (request()->is('region/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_five_add = "5.5.1";
        if (request()->is('add-area')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_five_edit = "5.5.2";
        if (request()->is('update-area')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_five_delete = "5.5.3";
        if (request()->is('area/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_six_add = "5.6.1";
        if (request()->is('add-territory')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_six_edit = "5.6.2";
        if (request()->is('update-territory')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_six_delete = "5.6.3";
        if (request()->is('territory/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_seven_add = "5.7.1";
        if (request()->is('add-town')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_seven_edit = "5.7.2";
        if (request()->is('update-town')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_seven_delete = "5.7.3";
        if (request()->is('town/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_eight_add = "5.8.1";
        if (request()->is('add-db-house')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eight_edit = "5.8.2";
        if (request()->is('update-db-house')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eight_delete = "5.8.3";
        if (request()->is('db-house/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_nine_add = "5.9.1";
        if (request()->is('add-designation')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_nine_edit = "5.9.2";
        if (request()->is('update-designation')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_nine_delete = "5.9.3";
        if (request()->is('designation/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_ten_add = "5.10.1";
        if (request()->is('add-announcement')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_ten_edit = "5.10.2";
        if (request()->is('update-announcement')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_ten_delete = "5.10.3";
        if (request()->is('announcement/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $organization_sub_module_eleven_add = "5.11.1";
        if (request()->is('add-company-policies')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eleven_edit = "5.11.2";
        if (request()->is('update-company-policies')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $organization_sub_module_eleven_delete = "5.11.3";
        if (request()->is('company-policies/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }






        $time_sheet_sub_module_six_add = "6.6.1";
        if (request()->is('add-shift')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_six_edit = "6.6.2";
        if (request()->is('update-shift')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_six_delete = "6.6.3";
        if (request()->is('shift/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_seven_add = "6.7.1";
        if (request()->is('add-weekly-holiday')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        // $time_sheet_sub_module_seven_edit = "6.7.2";
        // if(request()->is('edit-weekly-holiday')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')){
        //         return $next($request);
        //     }else{
        //         return back()->with('message','You are not permitted to this action!!!');
        //     }
        // }

        $time_sheet_sub_module_seven_edit = "6.7.2";
        if (request()->is('update-weekly-holiday')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_seven_delete = "6.7.3";
        if (request()->is('delete-weekly-holiday*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_eight_add = "6.8.1";
        if (request()->is('add-other-holiday')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_eight_edit = "6.8.2";
        if (request()->is('edit-company-other-holiday')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_eight_delete = "6.8.3";
        if (request()->is('delete-other-holiday/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_nine_add = "6.9.1";
        if (request()->is('add-leave-type')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_nine_edit = "6.9.2";
        if (request()->is('update-leave-type')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $time_sheet_sub_module_nine_delete = "6.9.3";
        if (request()->is('delete-leave-type/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $time_sheet_sub_module_ten_add = "6.10.1";
        if (request()->is('add-leave')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        // $time_sheet_sub_module_ten_edit = "6.10.2";
        // if(request()->is('user/delete/*')){
        //     if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')){
        //         return $next($request);
        //     }else{
        //         return back()->with('message','You are not permitted to this action!!!');
        //     }
        // }
        $time_sheet_sub_module_ten_delete = "6.10.3";
        if (request()->is('delete-leave/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }







        $event_and_meeting_sub_module_one_add = "10.1.1";
        if (request()->is('add-event')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_one_edit = "10.1.2";
        if (request()->is('update-event')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_one_delete = "10.1.3";
        if (request()->is('delete-event/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $event_and_meeting_sub_module_two_add = "10.2.1";
        if (request()->is('add-meeting')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_two_edit = "10.2.2";
        if (request()->is('update-meeting')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $event_and_meeting_sub_module_two_delete = "10.2.3";
        if (request()->is('delete-meeting/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }







        $support_ticket_module_add = "12.0.1";
        if (request()->is('add-support-ticket')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $support_ticket_module_edit = "12.0.2";
        if (request()->is('update-support-ticket')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $support_ticket_module_delete = "12.0.3";
        if (request()->is('delete-support-ticket/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }







        $assets_sub_module_one_add = "13.1.1";
        if (request()->is('add-asset-category')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_one_edit = "13.1.2";
        if (request()->is('update-asset-category')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_one_delete = "13.1.3";
        if (request()->is('delete-asset-category/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $assets_sub_module_two_add = "13.2.1";
        if (request()->is('add-asset')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_two_edit = "13.2.2";
        if (request()->is('update-asset')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $assets_sub_module_two_delete = "13.2.3";
        if (request()->is('delete-asset/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }






        $file_manager_sub_module_one_add = "14.1.1";
        if (request()->is('add-file-manager')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_one_edit = "14.1.2";
        if (request()->is('update-file-manager')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_one_delete = "14.1.3";
        if (request()->is('delete-file-manager/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }

        $file_manager_sub_module_two_add = "14.2.1";
        if (request()->is('add-emergency-document')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_two_edit = "14.2.2";
        if (request()->is('update-employee-document')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }
        $file_manager_sub_module_two_delete = "14.2.3";
        if (request()->is('delete-employee-document/delete/*')) {
            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                return $next($request);
            } else {
                return back()->with('message', 'You are not permitted to this action!!!');
            }
        }








        ##########################all add, edit and delete urls code ends here####################################












        // if (auth()->user()->status == 'active') {
        //     return $next($request);
        // }
        // return response()->json('Your account is inactive');

        // if(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $employee_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_nine . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_ten . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_four . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_five . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_six . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_seven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eight . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_nine . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_ten . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $organization_sub_module_eleven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_four . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_five . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eleven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $payroll_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_calander_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_four . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_five . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_six . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_seven . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_eight . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_nine . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $hr_report_sub_module_ten . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $assets_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_module . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_one . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_two . '"]\')')->exists()){
        //     return $next($request);
        // }elseif(Permission::where('permission_com_id','=', Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $file_manager_sub_module_three . '"]\')')->exists()){
        //     return $next($request);
        // }elseif (Auth::user()->super_system_admin == 'Yes') {
        //     return $next($request);
        // }elseif (Auth::user()->company_profile == 'Yes') {
        //     return $next($request);
        // }else{
        //     return redirect('/login')->with(Auth::logout());
        // }

    }
}