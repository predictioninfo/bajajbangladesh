<?php
                    use App\Models\Permission;
                    use App\Models\Attendance;
                    use App\Models\Leave;
                    use App\Models\User;
                    use App\Models\Holiday;
                    use App\Models\Travel;
                    use App\Models\Role;
                    use App\Models\MonthlyAttendance;
                    use App\Models\LateTime;
                    use App\Models\CompensatoryLeave;
                    use App\Models\LatetimeConfig;
                    use App\Helpers\Helper;
                    //use DateTime;
                    $date = new DateTime("now", new \DateTimeZone('Asia/Kolkata') );
                    $current_date = $date->format('Y-m-d');
                    //$current_time = $date->format('H:i:s');


?>

<table id="user-table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th colspan="6" rowspan="2"
                style="width: 85px; height: 50px; background-color: #dadfe6; text-align:center; vertical-align: center;">
                {{ __('Attendance Report') }}</th>
            <?php
                $days = cal_days_in_month(CAL_GREGORIAN,$data['month'],$data['year']);

                //$dates = '2021-10-02';
                //$datetime = DateTime::createFromFormat('Y-m-d', $dates);
                //echo $datetime->format('D');
                for($i = 1; $i <= $days; $i++){ ?>

            <?php  if($i%2 == 0){?>
            <th colspan="4"
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php
                    if($i < 10){
                        $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                        echo date('D', strtotime($date_month_year));
                    }else{
                        $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                        echo date('D', strtotime($date_month_year));
                    }
                    ?>
            </th>
            <?php }else{ ?>
            <th colspan="4" style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">
                <?php
                                if($i < 10){
                                    $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                                    echo date('D', strtotime($date_month_year));
                                }else{
                                    $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                                    echo date('D', strtotime($date_month_year));
                                }
                                ?>
            </th>
            <?php } ?>
            <?php  } ?>
            <th rowspan="3"
                style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);background-color: #c3e01d;">
                Total
                Worked Hours</th>
            <th rowspan="3"
                style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);background-color: #c3e01d;">
                Total
                Present</th>
            {{-- <th rowspan="3" style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">Total
                Absent</th>
            <th rowspan="3" style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">Total
                Leave</th> --}}
        </tr>
        <tr>
            <?php
                $days = cal_days_in_month(CAL_GREGORIAN,$data['month'],$data['year']);

                //$dates = '2021-10-02';
                //$datetime = DateTime::createFromFormat('Y-m-d', $dates);
                //echo $datetime->format('D');
                for($i = 1; $i <= $days; $i++){ ?>

            <?php  if($i%2 == 0){?>
            <th colspan="4"
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php
                if($i < 10){
                    $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                    echo date('Y-m-d', strtotime($date_month_year));
                        $day_find = date('D', strtotime($date_month_year));
                }else{
                    $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                    echo date('Y-m-d', strtotime($date_month_year));
                        $day_find = date('D', strtotime($date_month_year));
                }
                ?>
            </th>
            <?php }else{ ?>
            <th colspan="4" style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">
                <?php
                            if($i < 10){
                                $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                                echo date('Y-m-d', strtotime($date_month_year));
                                    $day_find = date('D', strtotime($date_month_year));
                            }else{
                                $date_month_year = $data['year'].'-'.$data['month'].'-'.$i;
                                echo date('Y-m-d', strtotime($date_month_year));
                                    $day_find = date('D', strtotime($date_month_year));
                            }
                            ?>
            </th>
            <?php } ?>
            <?php  } ?>
        </tr>
        <tr>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                SL</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Employee ID</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Employee </th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Department Name</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Designation</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Date Of Joining</th>
            <?php
            $days = cal_days_in_month(CAL_GREGORIAN,$data['month'],$data['year']);

            //$dates = '2021-10-02';
            //$datetime = DateTime::createFromFormat('Y-m-d', $dates);
            //echo $datetime->format('D');
            for($i = 1; $i <= $days; $i++){ ?>
            <?php  if($i%2 == 0){?>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                Status</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                InTime</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                OutTime</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                Work Hour</th>
            <?php }else{ ?>
            <th style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">Status</th>
            <th style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">InTime</th>
            <th style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">OutTime</th>
            <th style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);">Work Hour</th>
            <?php } ?>

            <?php  } ?>


    </thead>
    <tbody>
        @php($j=1)
        @foreach ($data['attendances'] as $attendancesValue)
        <?php

                                     //exit;
                                    $day_one_string = "01";
                                    $day_one_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_one_string;
                                    $day_one_date_wise_day_name = date('D', strtotime($day_one_year_month_date));

                                    $day_two_string = "02";
                                    $day_two_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_two_string;
                                    $day_two_date_wise_day_name = date('D', strtotime($day_two_year_month_date));

                                    $day_three_string = "03";
                                    $day_three_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_three_string;
                                    $day_three_date_wise_day_name = date('D', strtotime($day_three_year_month_date));

                                    $day_four_string = "04";
                                    $day_four_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_four_string;
                                    $day_four_date_wise_day_name = date('D', strtotime($day_four_year_month_date));

                                    $day_five_string = "05";
                                    $day_five_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_five_string;
                                    $day_five_date_wise_day_name = date('D', strtotime($day_five_year_month_date));

                                    $day_six_string = "06";
                                    $day_six_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_six_string;
                                    $day_six_date_wise_day_name = date('D', strtotime($day_six_year_month_date));

                                    $day_seven_string = "07";
                                    $day_seven_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_seven_string;
                                    $day_seven_date_wise_day_name = date('D', strtotime($day_seven_year_month_date));

                                    $day_eight_string = "08";
                                    $day_eight_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_eight_string;
                                    $day_eight_date_wise_day_name = date('D', strtotime($day_eight_year_month_date));

                                    $day_nine_string = "09";
                                    $day_nine_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_nine_string;
                                    $day_nine_date_wise_day_name = date('D', strtotime($day_nine_year_month_date));

                                    $day_ten_string = "10";
                                    $day_ten_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_ten_string;
                                    $day_ten_date_wise_day_name = date('D', strtotime($day_ten_year_month_date));

                                    $day_eleven_string = "11";
                                    $day_eleven_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_eleven_string;
                                    $day_eleven_date_wise_day_name = date('D', strtotime($day_eleven_year_month_date));

                                    $day_twelve_string = "12";
                                    $day_twelve_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twelve_string;
                                    $day_twelve_date_wise_day_name = date('D', strtotime($day_twelve_year_month_date));

                                    $day_thirteen_string = "13";
                                    $day_thirteen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_thirteen_string;
                                    $day_thirteen_date_wise_day_name = date('D', strtotime($day_thirteen_year_month_date));

                                    $day_fourteen_string = "14";
                                    $day_fourteen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_fourteen_string;
                                    $day_fourteen_date_wise_day_name = date('D', strtotime($day_fourteen_year_month_date));

                                    $day_fifteen_string = "15";
                                    $day_fifteen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_fifteen_string;
                                    $day_fifteen_date_wise_day_name = date('D', strtotime($day_fifteen_year_month_date));

                                    $day_sixteen_string = "16";
                                    $day_sixteen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_sixteen_string;
                                    $day_sixteen_date_wise_day_name = date('D', strtotime($day_sixteen_year_month_date));

                                    $day_seventeen_string = "17";
                                    $day_seventeen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_seventeen_string;
                                    $day_seventeen_date_wise_day_name = date('D', strtotime($day_seventeen_year_month_date));

                                    $day_eighteen_string = "18";
                                    $day_eighteen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_eighteen_string;
                                    $day_eighteen_date_wise_day_name = date('D', strtotime($day_eighteen_year_month_date));

                                    $day_nineteen_string = "19";
                                    $day_nineteen_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_nineteen_string;
                                    $day_nineteen_date_wise_day_name = date('D', strtotime($day_nineteen_year_month_date));

                                    $day_twenty_string = "20";
                                    $day_twenty_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_string;
                                    $day_twenty_date_wise_day_name = date('D', strtotime($day_twenty_year_month_date));

                                    $day_twenty_one_string = "21";
                                    $day_twenty_one_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_one_string;
                                    $day_twenty_one_date_wise_day_name = date('D', strtotime($day_twenty_one_year_month_date));

                                    $day_twenty_two_string = "22";
                                    $day_twenty_two_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_two_string;
                                    $day_twenty_two_date_wise_day_name = date('D', strtotime($day_twenty_two_year_month_date));

                                    $day_twenty_three_string = "23";
                                    $day_twenty_three_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_three_string;
                                    $day_twenty_three_date_wise_day_name = date('D', strtotime($day_twenty_three_year_month_date));

                                    $day_twenty_four_string = "24";
                                    $day_twenty_four_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_four_string;
                                    $day_twenty_four_date_wise_day_name = date('D', strtotime($day_twenty_four_year_month_date));

                                    $day_twenty_five_string = "25";
                                    $day_twenty_five_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_five_string;
                                    $day_twenty_five_date_wise_day_name = date('D', strtotime($day_twenty_five_year_month_date));

                                    $day_twenty_six_string = "26";
                                    $day_twenty_six_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_six_string;
                                    $day_twenty_six_date_wise_day_name = date('D', strtotime($day_twenty_six_year_month_date));

                                    $day_twenty_seven_string = "27";
                                    $day_twenty_seven_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_seven_string;
                                    $day_twenty_seven_date_wise_day_name = date('D', strtotime($day_twenty_seven_year_month_date));

                                    $day_twenty_eight_string = "28";
                                    $day_twenty_eight_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_eight_string;
                                    $day_twenty_eight_date_wise_day_name = date('D', strtotime($day_twenty_eight_year_month_date));

                                    $day_twenty_nine_string = "29";
                                    $day_twenty_nine_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_twenty_nine_string;
                                    $day_twenty_nine_date_wise_day_name = date('D', strtotime($day_twenty_nine_year_month_date));

                                    $day_thirty_string = "30";
                                    $day_thirty_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_thirty_string;
                                    $day_thirty_date_wise_day_name = date('D', strtotime($day_thirty_year_month_date));

                                    $day_thirty_one_string = "31";
                                    $day_thirty_one_year_month_date = $data['year'].'-'.$data['month'].'-'.$day_thirty_one_string;
                                    $day_thirty_one_date_wise_day_name = date('D', strtotime($day_thirty_one_year_month_date));

                                ?>
        <tr>
            <?php  $userData = User::where('com_id',Auth::user()->com_id)->where('company_assigned_id',$attendancesValue->company_assigned_id)->first(); ?>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{$j++}}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $attendancesValue->company_assigned_id }}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $attendancesValue->first_name.' '.$attendancesValue->last_name}}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $userData->userdepartment->department_name ?? null }}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $userData->userdesignation->designation_name ?? null }}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{ $userData->joining_date
                ?? null}}</td>
            <!-- Day One Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_one_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_one_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day One Collumn code Ends -->

            <!-- Day 2 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_two_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_two_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_two_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_two_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 2 Collumn code Ends -->

            <!-- Day 3 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_three_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_three_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_three_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_three_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 3 Collumn code Ends -->

            <!-- Day 4 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_four_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_four_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_four_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_four_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 4 Collumn code Ends -->

            <!-- Day 5 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_five_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_five_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_five_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_five_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 5 Collumn code Ends -->

            <!-- Day 6 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_six_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_six_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_six_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_six_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 6 Collumn code Ends -->

            <!-- Day 7 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_seven_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_seven_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_seven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_seven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 7 Collumn code Ends -->

            <!-- Day 8 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eight_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eight_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eight_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eight_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center;  background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 8 Collumn code Ends -->

            <!-- Day 9 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_nine_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_nine_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_nine_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_nine_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 9 Collumn code Ends -->

            <!-- Day 10 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_ten_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_ten_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_ten_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_ten_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 10 Collumn code Ends -->

            <!-- Day 11 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eleven_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eleven_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eleven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eleven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 11 Collumn code Ends -->

            <!-- Day 12 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twelve_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twelve_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twelve_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twelve_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 12 Collumn code Ends -->

            <!-- Day 13 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirteen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 13 Collumn code Ends -->

            <!-- Day 14 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_fourteen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_fourteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_fourteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_fourteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 14 Collumn code Ends -->

            <!-- Day 15 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_fifteen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_fifteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_fifteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_fifteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 15 Collumn code Ends -->

            <!-- Day 16 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_sixteen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_sixteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_sixteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_sixteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 16 Collumn code Ends -->

            <!-- Day 17 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_seventeen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_seventeen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_seventeen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_seventeen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 17 Collumn code Ends -->

            <!-- Day 18 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eighteen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eighteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eighteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eighteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 18 Collumn code Ends -->

            <!-- Day 19 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_nineteen_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_nineteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_nineteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_nineteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 19 Collumn code Ends -->

            <!-- Day 20 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 20 Collumn code Ends -->

            <!-- Day 21 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_one_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 21 Collumn code Ends -->

            <!-- Day 22 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_two_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 22 Collumn code Ends -->

            <!-- Day 23 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_three_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 23 Collumn code Ends -->

            <!-- Day 24 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_four_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 24 Collumn code Ends -->

            <!-- Day 25 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_five_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 25 Collumn code Ends -->

            <!-- Day 26 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_six_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 26 Collumn code Ends -->

            <!-- Day 27 Collumn code Starts -->
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_seven_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <!-- Day 27 Collumn code Ends -->

            <!-- Day 28 Collumn code Starts -->
            <?php if($days >= 28){ ?>
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_eight_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <?php }?>

            <!-- Day 28 Collumn code Ends -->

            <!-- Day 29 Collumn code Starts -->
            <?php if($days >= 29){ ?>
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_nine_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <?php } ?>

            <!-- Day 29 Collumn code Ends -->

            <!-- Day 30 Collumn code Starts -->
            <?php if($days >= 30){ ?>
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47; border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirty_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirty_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirty_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirty_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <?php } ?>

            <!-- Day 30 Collumn code Ends -->

            <!-- Day 31 Collumn code Starts -->
            <?php if($days >= 31){ ?>
            <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirty_one_date_wise_day_name)->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('W')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('T')}}</td>
            <?php }else{ ?>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                {{__('A')}}</td>
            <?php } ?>

            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td
                style=" text-align:center; vertical-align: center; background-color: rgb(245, 227, 227);border:2px solid rgb(19, 4, 4);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            <?php
                              } ?>
            <?php
            $day_month_year = date("Y-m-d", strtotime($day_one_year_month_date));
            //$day_detect = date("d", strtotime($day_one_year_month_date));
            $month_detect = date("m", strtotime($day_one_year_month_date));
            $year_detect = date("Y", strtotime($day_one_year_month_date));
              $attendance_counts = Attendance::where('employee_id', '=', $attendancesValue->monthly_employee_id)
                ->whereMonth('attendance_date', '=', $month_detect)
                ->whereYear('attendance_date', '=', $year_detect)
                ->where('check_in_out', '=', 1)
                ->get();

                $attendance_work_hours_counts = Attendance::where('employee_id', '=', $attendancesValue->monthly_employee_id)
                                ->whereMonth('attendance_date', '=', $month_detect)
                                ->whereYear('attendance_date', '=', $year_detect)
                                ->where('check_in_out', '=', 1)
                                ->whereNotNull('clock_out')
                                ->get();
                                $total_work_hours = 0;
                                foreach ($attendance_work_hours_counts as $a) {
                                sscanf($a->total_work, '%d:%d', $hour, $min);
                                $total_work_hours += $hour * 60 + $min;
                                }
                                if ($h = floor($total_work_hours / 60)) {
                                $total_work_hours %= 60;
                                }
                                $sum_total_hours = sprintf('%02d:%02d', $h, $total_work_hours);

?>

            <td
                style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);background-color: #c3e01d;">
                {{
                $sum_total_hours }}</td>
            <td
                style="text-align:center;vertical-align: center;border:2px solid rgb(19, 4, 4);background-color: #c3e01d;">
                {{
                $attendance_counts->count() }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
