<?php


namespace App\Http\traits;

use App\Models\Company;
use App\Models\User;
use Auth;
use DB;


trait CommonMethod
{


    public  function generateInvoiceId()
    {
        //Previous Code
        // $employeeIdPrefix = Company::where('id', '=', Auth::user()->com_id)->first('employee_id_prefix');
        // $prefix =  $employeeIdPrefix->employee_id_prefix ;

        // $invoiceLength = 6 ;
        // $totalEmployee= DB::table('users')->where('com_id', '=', Auth::user()->com_id)->count();
        // $voucherId =  $prefix . str_pad($totalEmployee +1, $invoiceLength, "0", STR_PAD_LEFT);

        // return $voucherId;


        //New Code
        $employeeIdPrefix = Company::where('id', '=', Auth::user()->com_id)->first('employee_id_prefix');
        $prefix =  $employeeIdPrefix->employee_id_prefix;

        $invoiceLength = 6;

        $existingVoucherIds = DB::table('users')->where('com_id', '=', Auth::user()->com_id)->pluck('company_assigned_id')->toArray();

        $count = 1;
        do {
            $voucherId = $prefix . str_pad($count, $invoiceLength, "0", STR_PAD_LEFT);
            $count++;
        } while (in_array($voucherId, $existingVoucherIds));

        return $voucherId;
        
    }

    public function getAuthorizationToken()
    {
        $authorization =  'JWT eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxLCJ1c2VybmFtZSI6ImFkbWluIiwiZXhwIjoxNjk1NjIwMDgyLCJlbWFpbCI6ImluZm9AcHJlZGljdGlvbml0LmNvbSIsIm9yaWdfaWF0IjoxNjk1MDE1MjgyfQ.IkrT9rrKSph29-TS2TJHetkn8iJzkRHl3QC0wZuOC0w';
        return $authorization;
    }
}
