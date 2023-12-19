<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use DB;


class ZKController extends Controller
{
    public function getDeviceInfo()
    {
        return   DB::connection('second_mysql')->table('ep_eptransaction')->first('emp_code');
    }

    public function addAttandance()
    {


        DB::connection('mysql')
            ->table('ep_eptransaction')
            ->join('pitechrms.users', 'ep_eptransaction.emp_code', '=', 'users.company_assign_id')
            ->whereNotNull('ep_eptransaction.emp_code')
            ->insert(['attendance_status' => 'ok']);
    }
}
