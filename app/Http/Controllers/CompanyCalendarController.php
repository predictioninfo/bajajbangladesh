<?php

namespace App\Http\Controllers;

use App\Models\CompanyCalendar;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Calendar;
use Session;


class CompanyCalendarController extends Controller
{
    // public function index(Request $request)
    // { 
    //     if($request->ajax()) {
    //         $event = CompanyCalendar::where('company_calendar_com_id',Auth::user()->com_id)
    //         ->whereDate('start','>=',$request->start)
    //         ->whereDate('end','<=',$request->end)
    //         ->get();
    //         return response()->json($event);
    //     }
    //     return view('back-end.premium.hr-calendar.hr-calendar-index');
    // }
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $events = CompanyCalendar::where('company_calendar_com_id', Auth::user()->com_id)
                ->whereDate('start', '>=', $request->start)
                ->whereDate('end','<=',$request->end)
                ->get();
    
            $events = $events->map(function ($event) {
                $event->end = date('Y-m-d', strtotime($event->end . ' +1 day'));
                return $event;
            });
            return response()->json($events);
        }
        return view('back-end.premium.hr-calendar.hr-calendar-index');
    }

    public function employeeCalendarIndex(Request $request)
    {
        return view('back-end.premium.hr-calendar.hr-calendar-index');
    }

    public function companyCalenderById(Request $request)
    {
        $where = array('id' => $request->id);
        $companyCalenderByIds = CompanyCalendar::where($where)->first();
        // if($companyCalenderByIds->company_calendar_employee_id == null){
        //   return response()->json($companyCalenderByIds);
        // }else{
        //   $employee_details = User::where('id',$companyCalenderByIds->company_calendar_employee_id)->get('first_name','last_name');
        //   $employee_names_array = [];
        //   foreach($employee_details as $employee_details_value){
        //     array_push($employee_names_array,$employee_details_value->first_name);
        //   }
        //   $array_mearging = array_merge($companyCalenderByIds,$employee_names_array);
        //   return response()->json($array_mearging);
        // }

        return response()->json($companyCalenderByIds);
    }
    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $event = new CompanyCalendar();
                $event->company_calendar_com_id = Auth::user()->com_id;
                $event->company_calendar_employee_id =  Auth::user()->id;
                $event->title = $request->title;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->save();
                return response()->json($event);
                break;
            case 'update':
                $event = CompanyCalendar::find($request->id);
                $event->title = $request->title;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->save();
                return response()->json($event);
                break;
            case 'delete':
                $event = CompanyCalendar::find($request->id)->delete();
                return response()->json($event);
                break;
            default:
                # code...
                break;
        }
    }
}
