@extends('back-end.premium.layout.premium-main')
@section('content')

<section class="main-contant-section">


    <div class=" mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach


        <div class="card mb-4">
            <div class="card-header with-border">
                <h3 class="card-title text-center"> {{__('New Payments')}} </h3>
            </div>
        </div>
    </div>

    <?php

                    use App\Models\Attendance;
                    use App\Models\Holiday;
                    use App\Models\Leave;
                    use App\Models\Loan;
                    use App\Models\FestivalBonus;
                    use App\Models\Commission;
                    use App\Models\StatutoryDeduction;
                    use App\Models\OtherPayment;
                    use App\Models\OverTime;
                    use App\Models\LatetimeConfig;
                    use App\Models\LateTime;
                    use App\Models\Travel;

                    // $last_month_date_year = date('Y-m-d', strtotime('last month'));
                    // $last_month = date('m', strtotime('last month'));////////////the payment month
                    // $date_wise_day_name = date('D', strtotime('last month'));
                    // $previous_month_year = date('Y', strtotime('last month'));////////////the payment month's year

                    $total_number_of_days_of_the_month=cal_days_in_month(CAL_GREGORIAN, $last_month, $previous_month_year);

                   ////// function to find total number of holidays code starts////////////
                    function total_holiday($month,$year)
                    {
                        $holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                        $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);

                        $holidays=0;
                        for($i=1;$i<=$total_days;$i++)
                        foreach($holidays_names as $holidays_names_value){
                            if(date('N',strtotime($year.'-'.$month.'-'.$i))==$holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                            $holidays++;
                        }
                        return $holidays;
                    }
                    //echo total_holiday(1,2016);
                    // function to find total number of holidays code ends///////////////

                    ////// other-holiday count code starts////////////
                    if(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereMonth('start_date','=',$last_month)->whereYear('start_date', '=',$previous_month_year)->exists()) {

                        $other_holidays = Holiday::where('holiday_com_id',Auth::user()->com_id)
                        ->where('holiday_type','=','Other-Holiday')
                        ->whereMonth('start_date', '=',$last_month)
                        ->whereYear('start_date', '=',$previous_month_year)
                        ->get();

                        $all_other_holidays = 0;
                        foreach ($other_holidays as  $other_holidays_value) {

                           // echo "ok";

                            $startDate = new DateTime($other_holidays_value->start_date);
                            $endDate = new DateTime($other_holidays_value->end_date);

                            $difference = $endDate->diff($startDate);
                            $all_other_holidays += $difference->format("%a") + 1;
                        }

                    }else{
                        $all_other_holidays = 0;
                    }
                     ////// other-holiday count code ends////////////


            ?>
    <div class="content-box">
        <form method="post" action="{{route('department-wise-employee-payments')}}">
            @csrf
            <div class="row">

                <div class="col-md-4 form-group">

                    <label>{{__('Department')}} *</label>
                    <select name="department_id" class="form-control" required>
                        <option>Choose a Department</option>
                        @foreach($departments as $department_values)
                        <option value="{{$department_values->id}}">{{$department_values->department_name}}</option>
                        @endforeach


                    </select>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">{{__('Month')}}</label>
                        <input class="form-control" name="month_year" type="month">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i> {{__('Search')}}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <div class="table-responsive mt-4">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Payslip Type')}}</th>
                        <th>{{__('Basic Salary')}}</th>
                        <th>{{__('House Rent')}}</th>
                        <th>{{__('Allowances')}}</th>
                        <th>{{__('Tax Deduction')}}</th>
                        <th>{{__('Provident Fund')}}</th>
                        <th>{{__('Loan')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($new_payments as $new_payments_value)
                    @if($new_payments_value->monthly_payment_status == 0)
                    <?php
 ############################################### attendance count code starts################################
    $attendance_counts = Attendance::where('employee_id','=',$new_payments_value->monthly_employee_id)
                                    ->whereMonth('attendance_date', '=',$last_month)
                                    ->whereYear('attendance_date', '=',$previous_month_year)
                                    ->where('check_in_out', '=',1)
                                    ->get();
    $all_attendances_of_the_month = $attendance_counts->count();
 ############################################## attendance count code ends here ######################################
      ############################################## approved half leave days count code starts ######################################
          if(Leave::where('leaves_employee_id',$new_payments_value->monthly_employee_id)->where('is_half','=',1)->where('leaves_status','=','Approved')->whereMonth('leaves_start_date', '=',$last_month)->whereYear('leaves_end_date', '=',$previous_month_year)->exists()){

            $employee_half_leaves = Leave::where('leaves_employee_id',$new_payments_value->monthly_employee_id)
                                    ->where('is_half','=',1)
                                    ->where('leaves_status','=','Approved')
                                    ->whereMonth('leaves_start_date', '=',$last_month)
                                    ->whereYear('leaves_end_date', '=',$previous_month_year)
                                    ->get();

            $all_half_leaves_by_employee_without_holiday = 0;

            foreach ($employee_half_leaves as  $employee_half_leaves_value) {

                 ###################################### holidays counting from leave start date to end date code starts ######################################
                $half_holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                $half_leave_start_date =  date('d', strtotime($employee_half_leaves_value->leaves_start_date));
                $half_leave_end_date =  date('d', strtotime($employee_half_leaves_value->leaves_end_date));

                $half_holidays_in_leave=0;
                for($i=$half_leave_start_date;$i<=$half_leave_end_date;$i++){
                    foreach($half_holidays_names as $half_holidays_names_value){
                        if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$half_holidays_names_value->holiday_number){
                            $half_holidays_in_leave +=1;
                        }else{
                            $half_holidays_in_leave +=0;
                        }  //if monday means 1, tue means 2.... sunday means 7

                        }
                }

                //echo $half_holidays_in_leave;

                ###################################### holidays counting from leave start date to end date code ends here ######################################

                $startDateHalf = new DateTime($employee_half_leaves_value->leaves_start_date);
                $endDateHalf = new DateTime($employee_half_leaves_value->leaves_end_date);

                $difference_for_half_leaves = $endDateHalf->diff($startDateHalf);
                $all_half_leaves_by_employee_with_holiday = $difference_for_half_leaves->format("%a") + 1; //number of days with holidays between leave start date to end date
                $all_half_leaves_by_employee_without_holiday += ($all_half_leaves_by_employee_with_holiday - $half_holidays_in_leave)/2; //number of days without holidays between leave start date to end date

            }

        }else{
            $all_half_leaves_by_employee_without_holiday = 0;
        }

     ###################################### approved half leave days count code ends here ######################################

    ############################################## approved leave days count code starts ######################################
        if(Leave::where('leaves_employee_id',$new_payments_value->monthly_employee_id)->where(function ($query) {
            $query->where('is_half', 0)
                ->orWhereNull('is_half');
        })->where('leaves_status','=','Approved')->whereMonth('leaves_start_date', '=',$last_month)->whereYear('leaves_end_date', '=',$previous_month_year)->exists()){

            $employee_leaves = Leave::where('leaves_employee_id',$new_payments_value->monthly_employee_id)
                                    ->where(function ($query) {
                                        $query->where('is_half', 0)
                                            ->orWhereNull('is_half');
                                    })
                                    ->where('leaves_status','=','Approved')
                                    ->whereMonth('leaves_start_date', '=',$last_month)
                                    ->whereYear('leaves_end_date', '=',$previous_month_year)
                                    ->get();
            $all_leaves_by_employee_without_holiday = 0;
            foreach ($employee_leaves as  $employee_leaves_value) {

                ###################################### holidays counting from leave start date to end date code starts ######################################
                $holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                $leave_start_date =  date('d', strtotime($employee_leaves_value->leaves_start_date));
                $leave_end_date =  date('d', strtotime($employee_leaves_value->leaves_end_date));

                $holidays_in_leave=0;
                for($i=$leave_start_date;$i<=$leave_end_date;$i++)
                foreach($holidays_names as $holidays_names_value){
                if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                $holidays_in_leave++;
                }

                //echo $holidays_in_leave;

                ###################################### holidays counting from leave start date to end date code ends here ######################################

                $startDate = new DateTime($employee_leaves_value->leaves_start_date);
                $endDate = new DateTime($employee_leaves_value->leaves_end_date);

                $difference = $endDate->diff($startDate);
                $all_leaves_by_employee_with_holiday = $difference->format("%a") + 1; //number of days with holidays between leave start date to end date
                $all_leaves_by_employee_without_holiday += $all_leaves_by_employee_with_holiday - $holidays_in_leave; //number of days without holidays between leave start date to end date

            }

        }else{
            $all_leaves_by_employee_without_holiday = 0;
        }
        //echo $all_attendances_of_the_month;

     ###################################### approved leave days count code ends here ######################################

    ########################################## Late Days Counting Code Starts From Here #######################################################################
    $countable_late_days = 0;
    if(LateTime::where('late_time_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('late_time_date','=',$last_month)->whereYear('late_time_date', '=',$previous_month_year)->exists()){
        $minimum_countable_late_config_days = LatetimeConfig::where('latetime_config_com_id','=',Auth::user()->com_id)->first(['minimum_countable_day']); //minimum countable days
        $total_days_from_late_count_array = LateTime::where('late_time_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('late_time_date','=',$last_month)->whereYear('late_time_date', '=',$previous_month_year)->count(); //total late days
       for($a = 1; $a <= $total_days_from_late_count_array; $a++){
           if($a%$minimum_countable_late_config_days->minimum_countable_day == 0){
               $countable_late_days += 1;
           }
       }
    }
    //echo $countable_late_days;
    ########################################## Late Days Counting Code Ends Here #######################################################################







    ############################## Travelling Days counting code starts#####################################
               if(Travel::where('travel_com_id',Auth::user()->com_id)
                        ->where('travel_employee_id','=',$new_payments_value->monthly_employee_id)
                        ->where('travel_status','=','Approved')
                        // ->where(function($query) use ($last_month){
                        //     $query->whereMonth('travel_start_date',$last_month)
                        //                 ->orWhereMonth('travel_end_date',$last_month);
                        // })
                        // ->whereYear('travel_start_date', '=',$previous_month_year)
                        ->exists()) {  /////travel days exists or not condition starts/////////////////


                            $travelling_days = Travel::where('travel_com_id',Auth::user()->com_id)
                                    ->where('travel_employee_id','=',$new_payments_value->monthly_employee_id)
                                    ->where('travel_status','=','Approved')
                                    ->get();
                            $all_travel_days = 0;

                            foreach ($travelling_days as  $travelling_days_value) {


                                //echo "start date".$travelling_days_value->travel_start_date;
                                //echo  "end date".$travelling_days_value->travel_end_date;

                                $first_date_of_last_month = $previous_month_year."-".$last_month."-"."01";
                                $last_date_of_the_last_month = $previous_month_year."-".$last_month."-".$total_number_of_days_of_the_month;


                                if ($travelling_days_value->travel_start_date > $first_date_of_last_month && $travelling_days_value->travel_start_date < $last_date_of_the_last_month){
                                    if ($travelling_days_value->travel_end_date > $first_date_of_last_month && $travelling_days_value->travel_end_date < $last_date_of_the_last_month){
                                                //echo "(start date and end date exists in last month)";

                                            ###################################### holidays counting from travel start date to end date code starts ######################################
                                                    $company_holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                                                    $travel_start_date =  date('d', strtotime($travelling_days_value->travel_start_date));
                                                    $travel_end_date =  date('d', strtotime($travelling_days_value->travel_end_date));

                                                    $holidays_in_travel=0;
                                                    for($i=$travel_start_date;$i<=$travel_end_date;$i++)
                                                    foreach($company_holidays_names as $company_holidays_names_value){
                                                    if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$company_holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                                                    $holidays_in_travel++;
                                                    }

                                            ###################################### holidays counting from travel start date to end date code ends here ######################################
                                            ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                            if(Holiday::where('holiday_com_id',Auth::user()->com_id)
                                            ->where('holiday_type','=','Other-Holiday')
                                            ->whereMonth('start_date', '=',$last_month)
                                            ->whereYear('start_date', '=',$previous_month_year)
                                            ->exists()){   //////other holiday exists or not condition starts

                                                $other_holidays = Holiday::where('holiday_com_id',Auth::user()->com_id)
                                                ->where('holiday_type','=','Other-Holiday')
                                                ->whereMonth('start_date', '=',$last_month)
                                                ->whereYear('start_date', '=',$previous_month_year)
                                                ->get();

                                                foreach ($other_holidays as  $other_holidays_value) {

                                                        if($other_holidays_value->start_date > $travelling_days_value->travel_start_date && $other_holidays_value->start_date < $travelling_days_value->travel_end_date){
                                                            if($other_holidays_value->end_date > $travelling_days_value->travel_start_date && $other_holidays_value->end_date < $travelling_days_value->travel_end_date){
                                                                //echo "(other start date and end date exists in travel dates)";
                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                            }else{
                                                                //echo "(other start date exists but end date not in travel dates)";
                                                                $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                            }
                                                        }else{
                                                            if ($other_holidays_value->end_date > $travelling_days_value->travel_start_date && $other_holidays_value->end_date < $travelling_days_value->travel_end_date){
                                                                //echo "(other start date not exists but end date exists in travel dates)";
                                                                $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                            }else{
                                                                if($other_holidays_value->start_date < $travelling_days_value->travel_start_date && $other_holidays_value->end_date > $travelling_days_value->travel_end_date){
                                                                    //echo "(whole travel dates are in other holidays)";
                                                                    $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                                }else{
                                                                    $all_travel_other_holidays = 0;
                                                                }
                                                            }

                                                        }

                                                    }

                                            }else{ //////other holiday exists or not condition ends
                                                $all_travel_other_holidays = 0;
                                            }

                                            ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                            $travelStartDate = new DateTime($travelling_days_value->travel_start_date);
                                            $travelEndDate = new DateTime($travelling_days_value->travel_end_date);

                                            $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                            $all_travel_days += $difference_between_two_travel_dates->format("%a") + 1 - $all_travel_other_holidays;
                                    }else{
                                        //echo "(end date not but start date exists in last month)";

                                        ###################################### holidays counting from travel start date to end date code starts ######################################
                                        $company_holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                                        $travel_start_date =  date('d', strtotime($travelling_days_value->travel_start_date));
                                        $travel_end_date =  date('d', strtotime($last_date_of_the_last_month));

                                        $holidays_in_travel=0;
                                        for($i=$travel_start_date;$i<=$travel_end_date;$i++)
                                        foreach($company_holidays_names as $company_holidays_names_value){
                                        if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$company_holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                                        $holidays_in_travel++;
                                        }
                                        ###################################### holidays counting from travel start date to end date code ends here ######################################
                                         ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                         if(Holiday::where('holiday_com_id',Auth::user()->com_id)
                                         ->where('holiday_type','=','Other-Holiday')
                                         ->whereMonth('start_date', '=',$last_month)
                                         ->whereYear('start_date', '=',$previous_month_year)
                                         ->exists()){

                                             $other_holidays = Holiday::where('holiday_com_id',Auth::user()->com_id)
                                             ->where('holiday_type','=','Other-Holiday')
                                             ->whereMonth('start_date', '=',$last_month)
                                             ->whereYear('start_date', '=',$previous_month_year)
                                             ->get();

                                             foreach ($other_holidays as  $other_holidays_value) {

                                                     if($other_holidays_value->start_date > $travelling_days_value->travel_start_date && $other_holidays_value->start_date < $last_date_of_the_last_month){
                                                         if($other_holidays_value->end_date > $travelling_days_value->travel_start_date && $other_holidays_value->end_date < $last_date_of_the_last_month){
                                                             //echo "(other start date and end date exists in travel dates)";
                                                                 $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                 $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                 $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                 $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                         }else{
                                                             //echo "(other start date exists but end date not in travel dates)";
                                                             $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                             $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                             $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                             $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                         }
                                                     }else{
                                                         if ($other_holidays_value->end_date > $travelling_days_value->travel_start_date && $other_holidays_value->end_date < $last_date_of_the_last_month){
                                                             //echo "(other start date not exists but end date exists in travel dates)";
                                                             $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                             $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                             $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                             $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                         }else{
                                                             if($other_holidays_value->start_date < $travelling_days_value->travel_start_date && $other_holidays_value->end_date > $last_date_of_the_last_month){
                                                                 //echo "(whole travel dates are in other holidays)";
                                                                 $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                 $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                 $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                 $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                             }else{
                                                                 $all_travel_other_holidays = 0;
                                                             }
                                                         }

                                                     }

                                                 }

                                         }else{
                                             $all_travel_other_holidays = 0;
                                         }

                                         ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                        $travelStartDate = new DateTime($travelling_days_value->travel_start_date);
                                        $travelEndDate = new DateTime($last_date_of_the_last_month);

                                        $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                        $all_travel_days += $difference_between_two_travel_dates->format("%a") + 1 - $all_travel_other_holidays;
                                    }
                                }else{
                                    if ($travelling_days_value->travel_end_date > $first_date_of_last_month && $travelling_days_value->travel_end_date < $last_date_of_the_last_month){
                                        //echo "(start date not but end date exists in last month)";
                                        ###################################### holidays counting from travel start date to end date code starts ######################################
                                        $company_holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                                        $travel_start_date =  date('d', strtotime($first_date_of_last_month));
                                        $travel_end_date =  date('d', strtotime($travelling_days_value->travel_end_date));

                                        $holidays_in_travel=0;
                                        for($i=$travel_start_date;$i<=$travel_end_date;$i++)
                                        foreach($company_holidays_names as $company_holidays_names_value){
                                        if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$company_holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                                        $holidays_in_travel++;
                                        }
                                        ###################################### holidays counting from travel start date to end date code ends here ######################################
                                        ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                        if(Holiday::where('holiday_com_id',Auth::user()->com_id)
                                        ->where('holiday_type','=','Other-Holiday')
                                        ->whereMonth('start_date', '=',$last_month)
                                        ->whereYear('start_date', '=',$previous_month_year)
                                        ->exists()){   //////other holiday exists or not condition starts

                                            $other_holidays = Holiday::where('holiday_com_id',Auth::user()->com_id)
                                            ->where('holiday_type','=','Other-Holiday')
                                            ->whereMonth('start_date', '=',$last_month)
                                            ->whereYear('start_date', '=',$previous_month_year)
                                            ->get();

                                            foreach ($other_holidays as  $other_holidays_value) {

                                                    if($other_holidays_value->start_date > $first_date_of_last_month && $other_holidays_value->start_date < $travelling_days_value->travel_end_date){
                                                        if($other_holidays_value->end_date > $first_date_of_last_month && $other_holidays_value->end_date < $travelling_days_value->travel_end_date){
                                                            //echo "(other start date and end date exists in travel dates)";
                                                                $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                        }else{
                                                            //echo "(other start date exists but end date not in travel dates)";
                                                            $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                            $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                            $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                            $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                        }
                                                    }else{
                                                        if ($other_holidays_value->end_date > $first_date_of_last_month && $other_holidays_value->end_date < $travelling_days_value->travel_end_date){
                                                            //echo "(other start date not exists but end date exists in travel dates)";
                                                            $travelOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                            $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                            $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                            $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                        }else{
                                                            if($other_holidays_value->start_date < $first_date_of_last_month && $other_holidays_value->end_date > $travelling_days_value->travel_end_date){
                                                                //echo "(whole travel dates are in other holidays)";
                                                                $travelOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                            }else{
                                                                $all_travel_other_holidays = 0;
                                                            }
                                                        }

                                                    }

                                                }

                                        }else{ //////other holiday exists or not condition ends
                                            $all_travel_other_holidays = 0;
                                        }

                                        ###################################### other holidays counting from travel start date to end date code ends here ######################################


                                        $travelStartDate = new DateTime($first_date_of_last_month);
                                        $travelEndDate = new DateTime($travelling_days_value->travel_end_date);

                                        $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                        $all_travel_days += $difference_between_two_travel_dates->format("%a") + 1 - $all_travel_other_holidays;
                                    }else{
                                        if($travelling_days_value->travel_start_date < $first_date_of_last_month && $travelling_days_value->travel_end_date > $last_date_of_the_last_month){
                                            //echo "(whole last month is on travelling for this employee)";
                                        ###################################### holidays counting from travel start date to end date code starts ######################################
                                        $company_holidays_names = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                                        $travel_start_date =  date('d', strtotime($first_date_of_last_month));
                                        $travel_end_date =  date('d', strtotime($last_date_of_the_last_month));

                                        $holidays_in_travel=0;
                                        for($i=$travel_start_date;$i<=$travel_end_date;$i++)
                                        foreach($company_holidays_names as $company_holidays_names_value){
                                        if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$company_holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                                        $holidays_in_travel++;
                                        }
                                        ###################################### holidays counting from travel start date to end date code ends here ######################################
                                        ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                        if(Holiday::where('holiday_com_id',Auth::user()->com_id)
                                        ->where('holiday_type','=','Other-Holiday')
                                        ->whereMonth('start_date', '=',$last_month)
                                        ->whereYear('start_date', '=',$previous_month_year)
                                        ->exists()){   //////other holiday exists or not condition starts

                                            $other_holidays = Holiday::where('holiday_com_id',Auth::user()->com_id)
                                            ->where('holiday_type','=','Other-Holiday')
                                            ->whereMonth('start_date', '=',$last_month)
                                            ->whereYear('start_date', '=',$previous_month_year)
                                            ->get();

                                            foreach ($other_holidays as  $other_holidays_value) {

                                                    if($other_holidays_value->start_date > $first_date_of_last_month && $other_holidays_value->start_date < $last_date_of_the_last_month){
                                                        if($other_holidays_value->end_date > $first_date_of_last_month && $other_holidays_value->end_date < $last_date_of_the_last_month){
                                                            //echo "(other start date and end date exists in travel dates)";
                                                                $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                        }else{
                                                            //echo "(other start date exists but end date not in travel dates)";
                                                            $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                            $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                            $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                            $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                        }
                                                    }else{
                                                        if ($other_holidays_value->end_date > $first_date_of_last_month && $other_holidays_value->end_date < $last_date_of_the_last_month){
                                                            //echo "(other start date not exists but end date exists in travel dates)";
                                                            $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                            $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                            $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                            $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                        }else{
                                                            if($other_holidays_value->start_date < $first_date_of_last_month && $other_holidays_value->end_date > $last_date_of_the_last_month){
                                                                //echo "(whole travel dates are in other holidays)";
                                                                $travelOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                $all_travel_other_holidays = $travelOtherHolidayDifference->format("%a") + 1;
                                                            }else{
                                                                $all_travel_other_holidays = 0;
                                                            }
                                                        }

                                                    }

                                                }

                                        }else{ //////other holiday exists or not condition ends
                                            $all_travel_other_holidays = 0;
                                        }

                                        ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                        $travelStartDate = new DateTime($first_date_of_last_month);
                                        $travelEndDate = new DateTime($last_date_of_the_last_month);

                                        $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                        $all_travel_days += $difference_between_two_travel_dates->format("%a") + 1 - $all_travel_other_holidays;
                                        }else{
                                            echo "(start date and end date not exists in last month)";
                                            $all_travel_days += 0;
                                        }

                                    }

                                }

                            }

                        }else{ /////travel days exists or not condition ends/////////////////
                            $all_travel_days = 0;
                        }

     #######################################Travelling Days counting  code ends###############################################
    //  echo $last_month;
    //       echo "<br>";
    //  echo $previous_month_year;
    //       echo "<br>";
    //  echo $all_attendances_of_the_month;
    //  echo "<br>";
    // echo total_holiday($last_month,$previous_month_year);
    //   echo "<br>";
    //  echo $all_other_holidays;
    //   echo "<br>";
    //  echo $all_leaves_by_employee_without_holiday;
    //   echo "<br>";
    // echo $all_travel_days;
    //  echo "<br>";
    //  echo $countable_late_days; //total working days
    //   echo "<br>";

    $sub_total_working_days = $all_attendances_of_the_month + total_holiday($last_month,$previous_month_year) + $all_other_holidays + $all_leaves_by_employee_without_holiday + $all_half_leaves_by_employee_without_holiday + $all_travel_days - $countable_late_days; //total working days
    //$total_working_days = $all_attendances_of_the_month + total_holiday($last_month,$previous_month_year) + $all_other_holidays + $all_leaves_by_employee_without_holiday + $all_travel_days - $countable_late_days; //total working days
    //$total_working_days = $all_attendances_of_the_month + total_holiday($last_month,$previous_month_year) + $all_other_holidays + $all_leaves_by_employee_without_holiday; //total working days

    //$total_absent_days = $total_number_of_days_of_the_month - $total_working_days;
    if($sub_total_working_days > $total_number_of_days_of_the_month){
        $total_working_days = $total_number_of_days_of_the_month;
    }else{
        $total_working_days = $sub_total_working_days;
    }

     $employee_basic_salary_percentage_wise = ($new_payments_value->gross_salary*$new_payments_value->salary_config_basic_salary)/100; //basic salary after deducting 60 percent
     $employee_per_day_basic_salary = $employee_basic_salary_percentage_wise/$total_number_of_days_of_the_month; //per month basic salary with 60 percent deduction
     $monthly_basic_salary = $employee_per_day_basic_salary*$total_working_days;
     //$monthly_basic_salary = $employee_per_day_basic_salary*30;

?>
                    @if($all_attendances_of_the_month != 0)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$new_payments_value->first_name}}</td>
                        <td>Monthly</td>
                        <td>{{$monthly_basic_salary}}</td>
                        <td>{{$all_house_rent =
                            (($new_payments_value->gross_salary*$new_payments_value->salary_config_house_rent_allowance)/100)}}
                        </td>
                        <td>@if(FestivalBonus::where('festival_bonus_com_id','=',
                            Auth::user()->com_id)->whereMonth('festival_bonus_date_month_year',
                            '=',$last_month)->exists())
                            {{$all_allowances =
                            (($new_payments_value->gross_salary*$new_payments_value->salary_config_conveyance_allowance)/100)
                            +
                            (($new_payments_value->gross_salary*$new_payments_value->salary_config_medical_allowance)/100)
                            +
                            (($new_payments_value->gross_salary*$new_payments_value->salary_config_festival_bonus)/100)
                            }}
                            @else
                            {{$all_allowances =
                            (($new_payments_value->gross_salary*$new_payments_value->salary_config_conveyance_allowance)/100)
                            +
                            (($new_payments_value->gross_salary*$new_payments_value->salary_config_medical_allowance)/100)
                            }}
                            @endif
                        </td>

                        <?php
###################################### tax deduction code starts from here ######################################
$previous_deducted_salary_tax = 0;
?>
                        @foreach($tax_configs as $tax_configs_value)
                        <?php

###################################house-rent and allowances tax configure code starts from here####################
    //$yearly_total_gross_salary = 1600000;
    $yearly_total_gross_salary = $new_payments_value->gross_salary*12;
    $house_rent_non_taxable_minimum_range_yearly = 300000; //house-rent non taxable minimum range
    $medical_allowance_non_taxable_minimum_range_yearly = 120000;  //medical allowance non taxable minimum range
    $conveyance_allowance_non_taxable_minimum_range_yearly = 30000; //convayance allowance non taxable minimum range

    $house_rent_of_the_yearly_gross_salary = ($yearly_total_gross_salary*$new_payments_value->salary_config_house_rent_allowance)/100; //yearly house-rent getting from yearly gross salary
    $medical_allowance_of_the_yearly_gross_salary = ($yearly_total_gross_salary*$new_payments_value->salary_config_medical_allowance)/100; //yearly medical allowance getting from yearly gross salary
    $conveyance_allowance_of_the_yearly_gross_salary = ($yearly_total_gross_salary*$new_payments_value->salary_config_conveyance_allowance)/100; //yearly convance allowance getting from yearly gross salary

    if($house_rent_of_the_yearly_gross_salary >= $house_rent_non_taxable_minimum_range_yearly){
        $yearly_taxable_house_rent = $house_rent_of_the_yearly_gross_salary - $house_rent_non_taxable_minimum_range_yearly;
    }else{
        $yearly_taxable_house_rent = 0;
    }


    if($medical_allowance_of_the_yearly_gross_salary >= $medical_allowance_non_taxable_minimum_range_yearly){
         $yearly_taxable_medical_allowance = $medical_allowance_of_the_yearly_gross_salary - $medical_allowance_non_taxable_minimum_range_yearly;
    }else{
        $yearly_taxable_medical_allowance = 0;
    }

    if($conveyance_allowance_of_the_yearly_gross_salary >= $conveyance_allowance_non_taxable_minimum_range_yearly){
         $yearly_taxable_conveyance_allowance = $conveyance_allowance_of_the_yearly_gross_salary - $conveyance_allowance_non_taxable_minimum_range_yearly;
    }else{
        $yearly_taxable_conveyance_allowance = 0;
    }

    $taxable_total_yearly_house_rent_and_allowances = $yearly_taxable_house_rent + $yearly_taxable_medical_allowance + $yearly_taxable_conveyance_allowance;

###################################house-rent and allowances tax configure code ends here####################

###################################festival bonus code starts from here####################
    if(FestivalBonus::where('festival_bonus_com_id','=',Auth::user()->com_id)->whereMonth('festival_bonus_date_month_year', '=',$last_month)->exists()){
        $monthly_festival_bonus = ($new_payments_value->gross_salary*$new_payments_value->salary_config_festival_bonus)/100;
    }else{
        $monthly_festival_bonus = 0;
    }
###################################festival bonus code ends here####################

################################### Commission code starts from here ####################
    if(Commission::where('commission_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('commission_month_year','=',$last_month)->whereYear('commission_month_year', '=',$previous_month_year)->exists()){

    $employee_commissions_array = Commission::where('commission_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('commission_month_year','=',$last_month)->whereYear('commission_month_year', '=',$previous_month_year)->pluck('commission_amount');
        foreach($employee_commissions_array as $employee_commission_value){
            $monthly_commission = $employee_commission_value;
        }
    }else{
        $monthly_commission = 0;
    }
################################### Commission code ends here ####################

################################### PF code starts from here####################
if($new_payments_value->user_provident_fund_member == "Yes"){
    $monthly_provident_fund = ($new_payments_value->gross_salary*$new_payments_value->user_provident_fund)/100 + 0;
}else{
    $monthly_provident_fund = 0;
}
################################### PF code ends here####################

################################### Other Payment code starts from here ####################
    if(OtherPayment::where('other_payment_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('other_payment_month_year','=',$last_month)->whereYear('other_payment_month_year', '=',$previous_month_year)->exists()){
    $other_payments_array = OtherPayment::where('other_payment_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('other_payment_month_year','=',$last_month)->whereYear('other_payment_month_year', '=',$previous_month_year)->pluck('other_payment_amount');
        foreach($other_payments_array as $other_payments_value){
            $monthly_other_payment = $other_payments_value;
        }
    }else{
        $monthly_other_payment = 0;
    }
################################### Other Payment code ends here ####################

################################### Over Time code starts from here ####################
    if(Overtime::where('over_time_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('over_time_date','=',$last_month)->whereYear('over_time_date', '=',$previous_month_year)->exists()){
        $over_times = Overtime::where('over_time_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('over_time_date','=',$last_month)->whereYear('over_time_date', '=',$previous_month_year)->get(['over_time_company_duty_in_seconds', 'over_time_employee_in_seconds', 'over_time_rate']);
        $monthly_over_time_payment = 0;
        foreach($over_times as $over_times_value){
             $employee_basic_salary_per_second = $employee_per_day_basic_salary/$over_times_value->over_time_company_duty_in_seconds;
             $employee_over_time_amount_without_over_time_rate = $employee_basic_salary_per_second*$over_times_value->over_time_employee_in_seconds;
             $monthly_over_time_payment += $employee_over_time_amount_without_over_time_rate*$over_times_value->over_time_rate;
        }

    }else{
        $monthly_over_time_payment = 0;
    }
################################### Over Time code ends here ####################

###################################### Tax config wise tax amount code starts from here ######################################
        //$this_month_wise_yearly_basic_salary = $monthly_basic_salary*12;
        $this_month_wise_yearly_gross_salary = ($monthly_basic_salary + $monthly_festival_bonus + $monthly_commission + $monthly_provident_fund + $monthly_other_payment + $monthly_over_time_payment)*12 + $taxable_total_yearly_house_rent_and_allowances; ///yearly gross salary with all additions

    //$gross_salary = $new_payments_value->gross_salary;
    //$gross_salary = $taxable_total_yearly_house_rent_and_allowances + $this_month_wise_yearly_basic_salary;


    $gross_salary = $this_month_wise_yearly_gross_salary;


    if($tax_configs_value->minimum_salary <= $gross_salary ){

        if($gross_salary < $tax_configs_value->maximum_salary){
            $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
        }else{

            $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
        }

        $tax_deduction_percentage = $taxable_salary*$tax_configs_value->tax_percentage;

            $taxable_salary = $tax_configs_value->minimum_salary;

        $tax_deduction = $tax_deduction_percentage/100;

        $previous_deducted_salary_tax += $tax_deduction;

    }
###################################### Tax config wise tax amount code ends here ######################################


?>
                        @endforeach
                        <?php
######################################tax deduction code ends here ######################################
?>
                        <?php
                        ######### tax configuring code for 0 to Minimum tax amount starts from here ##############
                        $tax_deduction_amount = $previous_deducted_salary_tax/12;
                        if($tax_deduction_amount >= 1 && $tax_deduction_amount <= $minimum_tax_config->minimum_tax_config_amount){
                            $all_tax_deduction = $minimum_tax_config->minimum_tax_config_amount;
                        }else{
                            // if($new_payments_value->monthly_employee_id == 7976){
                            // $all_tax_deduction = 2100;
                            // }else{
                            //     $all_tax_deduction = $tax_deduction_amount;
                            // }
                            $all_tax_deduction = $tax_deduction_amount;
                        }
                        ######### tax configuring code for 0 to Minimum tax amount ends here ##############
                        ?>

                        <td>{{$all_tax_deduction}}</td>
                        <td>{{$monthly_provident_fund}}</td>
                        <td>@if(Loan::where('loans_employee_id','=',$new_payments_value->monthly_employee_id)->where('loans_remaining_installments',
                            '>', 0)->exists())
                            @php($employee_loan =
                            Loan::where('loans_employee_id','=',$new_payments_value->monthly_employee_id)->where('loans_remaining_installments',
                            '>', 0)->get(['loans_remaining_amount','loans_remaining_installments']))
                            @foreach($employee_loan as $employee_loan_value)
                            {{-- {{$monthly_loan = $employee_loan_value->loans_remaining_amount/12}} --}}
                            {{$monthly_loan =
                            $employee_loan_value->loans_remaining_amount/$employee_loan_value->loans_remaining_installments}}
                            @endforeach
                            @else
                            {{$monthly_loan = 0}}
                            @endif
                        </td>
                        {{-- <td>{{$monthly_net_salary = $monthly_basic_salary + $all_house_rent + $all_allowances -
                            $all_tax_deduction - $all_provident_fund_deduction - $monthly_loan}}</td> --}}
                        <td>@if($new_payments_value->monthly_payment_status ==
                            0){{__('Unpaid')}}@elseif($new_payments_value->monthly_payment_status ==
                            1){{__('Paid')}}@endif</td>


                        <td>
                            {{-- <a href="javascript:void(0)" class="btn btn-primary edit"
                                data-id="{{$new_payments_value->monthly_employee_id}}">Details</a> --}}
                            <a href="#" class="btn btn-primary" data-toggle="modal"
                                data-target="#datailsModal{{$new_payments_value->id}}">Details</a>
                            {{-- <a href="{{route('delete-salary-configs',['id'=>$new_payments_value->id])}}"
                                class="btn btn-dark delete-post">Make-Payment</a> --}}
                            <form method="post" action="{{route('make-payments')}}" class="form-horizontal btn"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="monthly_attendance_row_id"
                                    value="{{$new_payments_value->id}}">
                                <input type="hidden" name="pay_slip_email" value="{{$new_payments_value->email}}">
                                <input type="hidden" name="pay_slip_employee_name"
                                    value="{{$new_payments_value->first_name.' '.$new_payments_value->last_name}}">
                                <input type="hidden" name="pay_slip_com_id"
                                    value="{{$new_payments_value->monthly_com_id}}">
                                <input type="hidden" name="pay_slip_employee_id"
                                    value="{{$new_payments_value->monthly_employee_id}}">
                                <input type="hidden" name="pay_slip_department_id"
                                    value="{{$new_payments_value->department_id}}">
                                <input type="hidden" name="pay_slip_payment_type" value="Monthly">
                                <input type="hidden" name="pay_slip_payment_date" value="{{date('Y-m-d')}}">
                                <input type="hidden" name="pay_slip_month_year"
                                    value="{{$new_payments_value->attendance_month}}">
                                <input type="hidden" name="pay_slip_basic_salary" value="{{$monthly_basic_salary}}">
                                <input type="hidden" name="pay_slip_house_rent" value="{{$all_house_rent}}">
                                <input type="hidden" name="pay_slip_medical_allowance"
                                    value="{{(($new_payments_value->gross_salary*$new_payments_value->salary_config_medical_allowance)/100)}}">
                                <input type="hidden" name="pay_slip_conveyance_allowance"
                                    value="{{(($new_payments_value->gross_salary*$new_payments_value->salary_config_conveyance_allowance)/100)}}">
                                @if(FestivalBonus::where('festival_bonus_com_id','=',
                                Auth::user()->com_id)->whereMonth('festival_bonus_date_month_year',
                                '=',$last_month)->exists())
                                <input type="hidden" name="pay_slip_festival_bonus"
                                    value="{{(($new_payments_value->gross_salary*$new_payments_value->salary_config_festival_bonus)/100)}}">
                                @else
                                <input type="hidden" name="pay_slip_festival_bonus" value="0">
                                @endif
                                <input type="hidden" name="pay_slip_gross_salary"
                                    value="{{$new_payments_value->gross_salary}}">
                                <input type="hidden" name="pay_slip_commissions" value="{{$monthly_commission}}">
                                <input type="hidden" name="pay_slip_other_payments" value="{{$monthly_other_payment}}">
                                <input type="hidden" name="pay_slip_overtimes" value="{{$monthly_over_time_payment}}">
                                <input type="hidden" name="pay_slip_provident_fund" value="{{$monthly_provident_fund}}">
                                <input type="hidden" name="pay_slip_tax_deduction" value="{{$all_tax_deduction}}">
                                <input type="hidden" name="pay_slip_loans" value="{{$monthly_loan}}">
                                @php($statutory_deduction_this_month = 0)
                                @if(StatutoryDeduction::where('statutory_deduc_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year','=',$last_month)->whereYear('statutory_deduc_month_year',
                                '=',$previous_month_year)->exists())
                                @php($statutory_deductions =
                                StatutoryDeduction::where('statutory_deduc_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year','=',$last_month)->whereYear('statutory_deduc_month_year',
                                '=',$previous_month_year)->pluck('statutory_deduc_amount'))
                                @foreach($statutory_deductions as $statutory_deductions_value)
                                @php($statutory_deduction_this_month += $statutory_deductions_value)
                                @endforeach
                                @endif
                                <input type="hidden" name="pay_slip_statutory_deduction"
                                    value="{{$statutory_deduction_this_month}}">
                                <input type="hidden" name="pay_slip_transport_allowance"
                                    value="{{$total_transport_allowance = ($all_attendances_of_the_month*$new_payments_value->transport_allowance) + 0}}">
                                <input type="hidden" name="pay_slip_mobile_bill"
                                    value="{{$total_mobile_bill = $new_payments_value->mobile_bill + 0}}">
                                <input type="hidden" name="pay_slip_net_salary"
                                    value="{{$monthly_net_salary = $monthly_basic_salary + $all_house_rent + $all_allowances + $total_transport_allowance + $total_mobile_bill + $monthly_commission + $monthly_other_payment + $monthly_over_time_payment - $all_tax_deduction - $monthly_provident_fund - $monthly_loan - $statutory_deduction_this_month}}">
                                <input type="hidden" name="monthly_attendanc_payment_status" value="1">
                                <input type="hidden" name="pay_slip_working_days" value="{{$total_working_days}}">
                                <input type="submit" name="action_button" class="btn btn-dark"
                                    value="{{__('Make-Payment')}}" />
                            </form>
                        </td>

                    </tr>



                    <!-- Details Modal Starts -->
                    <div id="datailsModal{{$new_payments_value->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">Employee Salary Details</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body ">
                                    <div class="pay-slip-view">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="profile-view">
                                                    <div class="profile-img">
                                                        <img class="rounded" width="80"
                                                            src="{{asset($new_payments_value->profile_photo)}}">
                                                    </div>
                                                    <div class="profile-info">
                                                        <h3>{{$new_payments_value->first_name."
                                                            ".$new_payments_value->last_name}}</h3>
                                                        <a href="#">{{__('View Details')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group" style="text-align: center;">
                                                <h2>Salary Details</h2>
                                            </div><br>
                                            <div class="col-md-12 form-group" style="text-align: center;">
                                                <h2>- - - - - - - - - - - - - - - - - - - -</h2>
                                            </div>
                                            <div class="col-md-12">
                                                <dl>
                                                    <dd> <b> Monthly Payslip: </b></dd>
                                                    <dd> Monthly</dd>
                                                    <dd> <b> Payment for the month: </b></dd>
                                                    <dd> </dd>
                                                    <dd> <b>
                                                            <?php
                                                                        $dateObj   = DateTime::createFromFormat('!m', $last_month);
                                                                        $monthName = $dateObj->format('F');

                                                                    ?>
                                                        </b></dd>
                                                    <dd>
                                                        <?php echo $monthNameAndYear = $monthName.', '. $previous_month_year; ?>
                                                    </dd>
                                                    <dd> <b>Basic Salary:</b></dd>
                                                    <dd> {{$monthly_basic_salary}} </dd>
                                                    <dd> <b>House Rent:</b> </dd>
                                                    <dd> {{$all_house_rent}}</dd>
                                                    <dd> <b> Allowances: </b></dd>
                                                    <dd> Conveyance =
                                                        {{(($new_payments_value->gross_salary*$new_payments_value->salary_config_conveyance_allowance)/100)}}Tk,
                                                        Medical =
                                                        {{(($new_payments_value->gross_salary*$new_payments_value->salary_config_medical_allowance)/100)}}Tk,
                                                        @if(FestivalBonus::where('festival_bonus_com_id','=',
                                                        Auth::user()->com_id)->whereMonth('festival_bonus_date_month_year',
                                                        '=',$last_month)->exists())
                                                        Festival Bonus =
                                                        {{(($new_payments_value->gross_salary*$new_payments_value->salary_config_festival_bonus)/100)}}
                                                        @endif</dd>
                                                    <dd> <b> Commissions:</b></dd>
                                                    <dd> {{$monthly_commission}} </dd>
                                                    <dd> <b> Other Payment: </b></dd>
                                                    <dd> {{$monthly_other_payment}} </dd>
                                                    <dd> <b> TA/DA: </b></dd>
                                                    <dd> {{$total_transport_allowance}} </dd>
                                                    <dd> <b> Mobile Bill: </b></dd>
                                                    <dd> {{$total_mobile_bill}} </dd>
                                                    <dd> <b> Overtime: </b></dd>
                                                    <dd> {{$monthly_over_time_payment}} </dd>
                                                    <dd> <b> Loan: </b> </dd>
                                                    <dd> {{$monthly_loan}} </dd>
                                                    <dd> <b> Statutory Deductions: </b> </dd>
                                                    <dd> @if(StatutoryDeduction::where('statutory_deduc_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year','=',$last_month)->whereYear('statutory_deduc_month_year',
                                                        '=',$previous_month_year)->exists())
                                                        @php($statutory_deductions =
                                                        StatutoryDeduction::where('statutory_deduc_employee_id','=',$new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year','=',$last_month)->whereYear('statutory_deduc_month_year',
                                                        '=',$previous_month_year)->pluck('statutory_deduc_amount'))
                                                        @foreach($statutory_deductions as $statutory_deductions_value)
                                                        {{$statutory_deduction_this_months =
                                                        $statutory_deductions_value}}
                                                        @endforeach
                                                        @else
                                                        {{$statutory_deduction_this_months = 0}}
                                                        @endif </dd>
                                                    <dd> <b> Provident Fund: </b></dd>
                                                    <dd> {{$monthly_provident_fund}} </dd>
                                                    <dd> <b> Tax Deduction: </b></dd>
                                                    <dd> {{$all_tax_deduction}} </dd>
                                                    <dd> <b> Net Salary: </b></dd>
                                                    <dd> {{$monthly_net_salary}} </dd>
                                                </dl>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Details Modal Ends -->

                    @endif
                    @endif
                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
</section>











{{--
<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Minimum Salary</label>
                        <div class="col-sm-12">
                            <input type="text" name="first_name" id="first_name" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Total Holidays</label>
                        <div class="col-sm-12">
                            <input type="text" name="total_holidays" id="total_holidays" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-grad">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->



--}}
















<script type="text/javascript">
    $(document).ready( function () {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

      $('#user-table').DataTable({

                    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                    "iDisplayLength": 25,
              dom: '<"row"lfB>rtip',

              buttons: [
                  {
                      extend: 'pdf',
                      text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'csv',
                      text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'print',
                      text: '<i title="print" class="fa fa-print"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'colvis',
                      text: '<i title="column visibility" class="fa fa-eye"></i>',
                      columns: ':gt(0)'
                  },
              ],
          });




              //value retriving and opening the view modal starts

            //   $('.edit').on('click', function () {
            //     var id = $(this).data('id');

            //     $.ajax({
            //         type:"POST",
            //         url: 'salary-details-by-id',
            //         data: { id: id },
            //         dataType: 'json',
            //         success: function(res){
            //         $('#ajaxModelTitle').html("Edit");
            //         $('#edit-modal').modal('show');
            //         $('#id').val(res.id);
            //         $('#first_name').val(res.first_name);
            //         $('#total_holidays').val(res.total_holidays);
            //     }
            //     });
            // });

           //value retriving and opening the vied modal ends



  } );


</script>



@endsection
