<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;

class employeeProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (User::where('com_id', Auth::user()->com_id)->where('id', Session::get('employee_setup_id'))->exists()) {
            return $next($request);
        } else {
            // Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect('/home')->with('message', 'You Can Not Perform This Action.Please Contact Your It Officer');
        }
    }
}