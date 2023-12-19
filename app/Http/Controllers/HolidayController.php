<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\CompanyCalendar;
use Illuminate\Http\Request;
use DB;
use Auth;

class HolidayController extends Controller
{
    public function manageWeeklyHolidayStore(Request $request)
    {
        $validated = $request->validate([
            'holiday_type' => 'required',
            'holiday_name' => 'required',
        ]);
        try {
            if ($request->holiday_name == 'Mon') {
                $holiday_numbers = 1;
            } elseif ($request->holiday_name == 'Tue') {
                $holiday_numbers = 2;
            } elseif ($request->holiday_name == 'Wed') {
                $holiday_numbers = 3;
            } elseif ($request->holiday_name == 'Thu') {
                $holiday_numbers = 4;
            } elseif ($request->holiday_name == 'Fri') {
                $holiday_numbers = 5;
            } elseif ($request->holiday_name == 'Sat') {
                $holiday_numbers = 6;
            } elseif ($request->holiday_name == 'Sun') {
                $holiday_numbers = 7;
            }

            $holiday = new Holiday();
            $holiday->holiday_com_id = Auth::user()->com_id;
            $holiday->holiday_type = $request->holiday_type;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->holiday_number = $holiday_numbers;
            $holiday->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Weekly Holiday Added Successfully');
    }

    public function editWeeklyHoliday(Request $request)
    {

        $where = array('id' => $request->id);
        $holidays  = Holiday::where($where)->first();

        return response()->json($holidays);
    }

    public function updateWeeklyHoliday(Request $request)
    {
        $validated = $request->validate([
            'holiday_type' => 'required',
            'holiday_name' => 'required',
        ]);
        try {
            if ($request->holiday_name == 'Mon') {
                $holiday_numbers = 1;
            } elseif ($request->holiday_name == 'Tue') {
                $holiday_numbers = 2;
            } elseif ($request->holiday_name == 'Wed') {
                $holiday_numbers = 3;
            } elseif ($request->holiday_name == 'Thu') {
                $holiday_numbers = 4;
            } elseif ($request->holiday_name == 'Fri') {
                $holiday_numbers = 5;
            } elseif ($request->holiday_name == 'Sat') {
                $holiday_numbers = 6;
            } elseif ($request->holiday_name == 'Sun') {
                $holiday_numbers = 7;
            }

            $holiday = Holiday::find($request->id);
            $holiday->holiday_type = $request->holiday_type;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->holiday_number = $holiday_numbers;
            $holiday->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Weekly Holiday Updated Successfully');
    }

    public function deleteWeeklyHoliday(Request $request)
    {
        $holidays = Holiday::where('id', $request->id)->delete();

        $success_msg = 'Deleted';

        return response()->json($success_msg);

        // return response()->json(['success' => true]);
    }

    public function manageOtherHolidayStore(Request $request)
    {
        try {
            function generateRandomString($length = 25)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $random_key = generateRandomString();

            $holiday = new Holiday();
            $holiday->holiday_com_id = Auth::user()->com_id;
            $holiday->holiday_unique_key = $random_key;
            $holiday->holiday_type = $request->holiday_type;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->start_date = $request->start_date;
            $holiday->end_date = $request->end_date;
            $holiday->save();

            $event = new CompanyCalendar();
            $event->company_calendar_com_id = Auth::user()->com_id;
            $event->company_calendar_unique_key = $random_key;
            $event->company_calendar_employee_all = "Yes";
            $event->calander_detail_type = "Holiday";
            $event->title = $request->holiday_name;
            $event->start = $request->start_date;
            $event->end = $request->end_date;
            $event->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Other Holiday Added Successfully');
    }

    public function editOtherHolidayGetting(Request $request)
    {
        $where = array('id' => $request->id);
        $holidays  = Holiday::where($where)->first();
        return response()->json($holidays);
    }

    public function editCompanyOtherHoliday(Request $request)
    {
        try {
            $holiday = Holiday::find($request->id);
            $holiday->holiday_name = $request->holiday_name;
            $holiday->start_date = $request->start_date;
            $holiday->end_date = $request->end_date;
            $holiday->save();


            $holiday_unique_key_array = Holiday::where('id', '=', $request->id)->get(['holiday_unique_key']);
            foreach ($holiday_unique_key_array as  $holiday_unique_key_array_value) {
                if (CompanyCalendar::where('company_calendar_unique_key', $holiday_unique_key_array_value->holiday_unique_key)->exists()) {
                    $unique_key_wise_id = CompanyCalendar::where('company_calendar_unique_key', $holiday_unique_key_array_value->holiday_unique_key)->first('id');

                    $event = CompanyCalendar::find($unique_key_wise_id->id);
                    $event->title = $request->holiday_name;
                    $event->start = $request->start_date;
                    $event->end = $request->end_date;
                    $event->save();
                }
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Other Holiday Updated Successfully');
    }

    public function deleteOtherHoliday($id)
    {
        $unique_key_wise_id = Holiday::where('id', $id)->first('holiday_unique_key');
        $delete_company_calender = CompanyCalendar::where('company_calendar_unique_key', $unique_key_wise_id->holiday_unique_key)->delete();
        $holiday = Holiday::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}