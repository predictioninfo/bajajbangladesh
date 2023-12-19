<?php

namespace App\Http\Middleware\company;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use App\Models\Package;
use Session;
use Auth;

class comapnylist
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
        if (User::where('super_system_admin', '=', "Yes")->where('com_id', Auth::user()->com_id)->exists()) {
            return $next($request);
        } else {
            return redirect('/home')->with('message', 'You Can Not Perform This Action.Please Contact Your It Officer');
        }
    }
}