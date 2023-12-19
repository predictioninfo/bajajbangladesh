<?php
namespace App\Helpers;
use Image;
use App\Models\Employee;
use App\Models\Company;

use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Helper
{

    /**
     * This method is for get current user role name
     * @return string
     */



    public static function totalWorkedHours($employee)
	{


		if($employee->employeeAttendance->isEmpty()){
			return 0;
		}else{
			$total = 0;
			foreach ($employee->employeeAttendance as $a)
			{
				sscanf($a->total_work, '%d:%d', $hour, $min);
				$total += $hour * 60 + $min;
			}

			if ($h = floor($total / 60))
			{
				$total %= 60;
			}
			$sum_total = sprintf('%02d:%02d', $h, $total);

			return $sum_total;
		}
	}

    public static function generateInvoiceId()
       {
           $employeeIdPrefix = Company::where('id', '=', Auth::user()->com_id)->first('employee_id_prefix');
           $prefix =  $employeeIdPrefix->employee_id_prefix ;

           $invoiceLength = 6 ;
           $totalEmployee= DB::table('users')->where('com_id', '=', Auth::user()->com_id)->count();
           $voucherId =  $prefix . str_pad($totalEmployee +1, $invoiceLength, "0", STR_PAD_LEFT);

           return $voucherId;
       }



}
