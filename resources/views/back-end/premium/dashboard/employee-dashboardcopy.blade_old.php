@extends('back-end.premium.layout.employee-panel')
@section('content')
<?php
use App\Models\Attendance;
//use DateTime;
$date = new DateTime("now", new \DateTimeZone('Asia/Kolkata') );
$current_date = $date->format('Y-m-d');
//$current_time = $date->format('H:i:s');

$date_wise_day_name = date('D', strtotime($current_date));

?>

            <div class="container-fluid mb-3">

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

                <div class="text-center mt-5">
                    <div class="div"><h2><b>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</b>({{Auth::user()->username}})</h2></div>
                    @foreach($users as $users_value)
                    <div class="div"><p>{{$users_value->userdepartment->department_name}}, {{$users_value->userdesignation->designation_name}}</p></div>
                    <div class="div">
                        <p>Office Shift :
                            @if($date_wise_day_name == 'Sat') {{date('g:i A', strtotime($users_value->userofficeshift->saturday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->saturday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @elseif($date_wise_day_name == 'Sun') {{date('g:i A', strtotime($users_value->userofficeshift->sunday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->sunday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @elseif($date_wise_day_name == 'Mon') {{date('g:i A', strtotime($users_value->userofficeshift->monday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->monday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @elseif($date_wise_day_name == 'Tue') {{date('g:i A', strtotime($users_value->userofficeshift->tuesday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->tuesday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @elseif($date_wise_day_name == 'Wed') {{date('g:i A', strtotime($users_value->userofficeshift->wednesday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->wednesday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @elseif($date_wise_day_name == 'Thu') {{date('g:i A', strtotime($users_value->userofficeshift->thursday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->thursday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @elseif($date_wise_day_name == 'Fri') {{date('g:i A', strtotime($users_value->userofficeshift->friday_in))}} To {{date('g:i A', strtotime($users_value->userofficeshift->friday_out))}}({{$users_value->userofficeshift->shift_name}})
                            @else
                            @endif
                        </p>
                </div>
                    @endforeach




                    <div class="div">
                            <a href="{{route('profile-details')}}" class="btn btn-info"><i class="fa fa-star-circle"></i> {{('Profile')}}</a>

                        {{--<form class="d-inline m1-2" method="post" action="{{route('employee-attendance')}}">
                            @csrf

                            <input type="hidden" name="employee_id" id="employee_id" value="{{Auth::user()->id}}" required>

                            <script>

                                var current=navigator.geolocation
                                if (current) {
                                    navigator.geolocation.getCurrentPosition(showPosition);
                                } else {
                                    toastr.error('Your Browser Or Device not Supported Geolocaiton');
                                }
                                function showPosition(position)
                                {
                                    document.getElementById("check_in_lat").value = position.coords.latitude;
                                    document.getElementById("check_in_longt").value = position.coords.longitude;
                                }

                            </script>

                            <input type="hidden" name="lat" id="check_in_lat" value="" required>
                            <input type="hidden" name="longt" id="check_in_longt" value="" required>
                            @if(Attendance::where('employee_id','=',Auth::user()->id)->where('attendance_date','=',$current_date)->exists())
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-star-circle"></i> {{__('Check Out')}}
                            </button>
                            @else
                            <input type="hidden" name="check_in_request" value="check_in_request">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-star-circle"></i> {{__('Check In')}}
                            </button>
                            @endif

                        </form>--}}

                        @if(Auth::user()->attendance_type == 'general')
                        <form class="d-inline m1-2" method="post" action="{{route('employee-attendance')}}" >
                            @csrf

                            <input type="hidden" name="employee_id" id="employee_id" value="{{Auth::user()->id}}" required>
                            <script>

                                var current=navigator.geolocation
                                if (current) {
                                    navigator.geolocation.getCurrentPosition(showPosition);
                                } else {
                                    toastr.error('Your Browser Or Device not Supported Geolocaiton');
                                }
                                function showPosition(position)
                                {
                                    document.getElementById("check_in_lat").value = position.coords.latitude;
                                    document.getElementById("check_in_longt").value = position.coords.longitude;
                                }

                            </script>

                            <input type="hidden" readonly name="lat" id="check_in_lat" value="" required>
                            <input type="hidden" readonly name="longt" id="check_in_longt" value="" required>

                            {{--@if(Attendance::where('employee_id','=',Auth::user()->id)->where('attendance_date','=',$current_date)->where('check_in_out','=',0)->exists())--}}
                            @if(Attendance::where('employee_id','=',Auth::user()->id)->where('attendance_date','=',$current_date)->exists())
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-star-circle"></i> {{__('Check Out')}}
                            </button>
                            @else
                            <input type="hidden" name="check_in_request" value="check_in_request">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-star-circle"></i> {{__('Check In')}}
                            </button>
                            @endif

                        </form>
                        @else
                        <form class="d-inline m1-2" method="post" action="{{route('employee-ip-based-attendances')}}" >
                            @csrf
                            <input type="hidden" name="employee_id" id="employee_id" value="{{Auth::user()->id}}" required>
                           @if(Attendance::where('employee_id','=',Auth::user()->id)->where('attendance_date','=',$current_date)->exists())
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-star-circle"></i> {{__('Check Out')}}
                            </button>
                            @else
                            <input type="hidden" name="check_in_request" value="check_in_request">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-star-circle"></i> {{__('Check In')}}
                            </button>
                            @endif
                        </form>
                        @endif

                    </div>

                </div>


            </div>


<section>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-30px">
                <div><h1 class="thin-text">Welcome {{Auth::user()->username}}</h1></div>
                <div><h4 class="thin-text">{{__('Today is')}} {{now()->englishDayOfWeek}} {{now()->format(env('Date_Format'))}}</h4></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="wrapper count-title text-center" style="background:#afd5af;">
                        <a href="{{route('payslip-details')}}">
                            <div class="name"><strong class="purple-text">Payslip(<span style="color:red;">{{$pay_slip}}</span>)</strong></strong>
                            </div>
                            <div class="count-number employee-count">View Details</div>
                        </a>
                    </div>
                </div>

                <!-- Count item widget-->
                <div class="col-md-3">
                    <div class="wrapper count-title text-center" style="background:#e5e4ef;">
                        <a href="{{route('award-details')}}">
                            <div class="name"><strong class="orange-text">Award(<span style="color:red;">{{$award_counts}}</span>)</strong></div>
                            <div class="count-number attendance-count">View Details</div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-md-3">
                    <div class="wrapper count-title text-center" style="background:#bed9e1;">
                        <a href="{{route('announcement')}}">
                            <div class="name"><strong class="green-text">{{__('Announcement')}}(<span style="color:red;">{{$announcement}}</span>)</strong></strong></div>
                            <div class="count-number leave-count">View Details</div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-md-3">
                    <div class="wrapper count-title text-center" style="background:#8bd3e9;">
                        <a href="{{route('upcoming-holidays-details')}}">
                            <div class="name"><strong class="blue-text">{{__('Upcoming Holidays')}}(<span style="color:red;">{{$holiday_counts}}</span>)</strong></strong></div>
                            <div class="count-number total_expense edit">View Details</div>
                        </a>

                    </div>
                </div>

            </div>

            <br>    <br>

            <div class="row">

                <div class="col-md-4">
                    <div class="wrapper count-title text-center" style="background:#ebcbd6;">
                        <a href="">
                            <div class="name"><strong class="green-text">{{__('Leave')}}</strong></div>
                            <div class="row">
                                <div class="col-md-6">
                                <a href="{{route('leave-details')}}" class="btn btn-info">{{__('View Leave Info')}} </a>
                                </div>
                                <div class="col-md-6">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#requestLeave">{{__('Request Leave')}} </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                       <!-- Warning Add Modal Starts -->

                       <div id="requestLeave" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header" style="background-color:#61c597;">
                                            <h5 id="exampleModalLabel" class="modal-title">{{_('Leave Request')}}</h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">

                                            <form method="post" action="{{route('add-leaves')}}" class="form-horizontal" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">

                                                    <input type="hidden" name="employee_id" value="{{Auth::user()->id}}">

                                                    <div class="col-md-12 form-group">
                                                       <label style="padding-left:30%;">
                                                            @foreach ($Sick_leaves as $leave)
                                                            {{ __('Remaining  Sick leave') }} - {{ $leave->allocated_day-$sick_leave_count }} {{ __('Days') }}
                                                            @endforeach  <br>
                                                           @foreach ($Casual_Leaves as $leave)
                                                            {{ __('Remaining Casual Leave') }} - {{ $leave->allocated_day-$casual_leave_count }} {{ __('Days') }}
                                                            @endforeach
                                                        </label><br>
                                                        <label>Leave Type</label>
                                                        <select name="leave_type" class="form-control selectpicker " data-live-search="true" data-live-search-style="begins" title='Leave Type' required>
                                                                {{-- <option>Choose a Leave Type</option> --}}
                                                                @foreach($leave_types as $leave_type_value)
                                                                <option value="{{$leave_type_value->id}}">{{$leave_type_value->leave_type}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Start Date</label>
                                                        {{--<input type="text" name="start_date" class="form-control date" value="" required>--}}
                                                        <input type="date" name="start_date" class="form-control" value="" required>
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>End Date</label>
                                                        {{--<input type="text" name="end_date" class="form-control date" value="" required>--}}
                                                        <input type="date" name="end_date" class="form-control" value="" required>
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label for="leave_reason">Description</label>
                                                        <textarea class="form-control" name="leave_reason" rows="6" required></textarea>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="leave_reason">Document <span style="font-size: 10px;color:red;">If your leave type is sick leave,this filed is mandatory.Otherwise leave not approved</span></label>
                                                        <input type="file" name="leave_document" class="form-control">
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="is_half" value="1">
                                                            <label for="is_half">Half Day</label>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="col-sm-12">

                                                        <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Warning Add Modal Ends -->

                <!-- Count item widget-->
                <div class="col-md-4">
                    <div class="wrapper count-title text-center" style="background:#c1cacd;">
                        <a href="">
                            <div class="name"><strong class="blue-text">{{__('Travel')}}</strong></div>
                            <div class="row">
                                <div class="col-md-6">
                                <a href="{{route('travel-details')}}" class="btn btn-info">{{__('View Travel Info')}} </a>
                                </div>
                                <div class="col-md-6">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#requestTravel">{{__('Request Travel')}} </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                        <!-- Travel Modal Starts -->

                        <div id="requestTravel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header" style="background-color:#61c597;">
                                            <h5 id="exampleModalLabel" class="modal-title">{{_('Travel Request')}}</h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" action="{{route('add-travels')}}" class="form-horizontal" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="travel_department_id" value="{{Auth::user()->department_id}}">
                                                <input type="hidden" name="travel_employee_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="travel_status" class="form-control" value="Pending">
                                                <input type="hidden" name="travel_actual_budget" class="form-control" value="0">

                                                <div class="row">

                                                    <div class="col-md-6 form-group">
                                                        <label>Arrangement Type</label>
                                                        <select class="form-control" name="travel_arrangement_type" required>
                                                            <option value="">Select-An-Arrangement-Type</option>
                                                            @foreach($arrangement_types as $arrangement_types_value)
                                                            <option value="{{$arrangement_types_value->variable_method_name}}">{{$arrangement_types_value->variable_method_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="my-textarea">Purpose of Visit</label>
                                                        <textarea class="form-control" name="travel_purpose" rows="3" required></textarea>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Place of Visit</label>
                                                        <input type="text" name="travel_place" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="my-textarea">Description</label>
                                                        <textarea class="form-control" name="travel_desc" rows="5" required></textarea>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Start Date</label>
                                                        {{--<input type="text" name="travel_start_date" class="form-control date" value="" required>--}}
                                                        <input type="date" name="travel_start_date" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>End Date</label>
                                                        {{--<input type="text" name="travel_end_date" class="form-control date" value="" required>--}}
                                                        <input type="date" name="travel_end_date" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Expected Budget</label>
                                                        <input type="text" name="travel_expected_budget" class="form-control" value="" required>
                                                    </div>
                                                    {{--<div class="col-md-6 form-group">
                                                        <label>Actual Budget</label>
                                                        <input type="text" name="travel_actual_budget" class="form-control" value="">
                                                    </div>--}}
                                                    <div class="col-md-6 form-group">
                                                        <label>Travel Mode</label>
                                                        <select class="form-control" name="travel_mode" required>
                                                            <option>Select a Travel Mode</option>
                                                            <option value="By Bus">By Bus</option>
                                                            <option value="By Train">By Train</option>
                                                            <option value="By Plane">By Plane</option>
                                                            <option value="By Taxi">By Taxi</option>
                                                            <option value="By Rental Car">By Rental Car</option>
                                                            <option value="By Other">By Other</option>
                                                        </select>
                                                    </div>
                                                     {{--<div class="col-md-6 form-group">
                                                        <label>Status</label>

                                                       <select class="form-control" name="travel_status">
                                                            <option>Select a Travel Status</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="First Lavel Approval">First Lavel Approval</option>
                                                            <option value="Rejected">Rejected</option>
                                                        </select>
                                                    </div>--}}
                                                    <br>

                                                    <div class="col-sm-12">

                                                        <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Travel Modal Ends -->

                <div class="col-md-4">
                    <div class="wrapper count-title text-center" style="background:#c1cacd;">
                        <a href="">
                            <div class="name"><strong class="blue-text">{{__('Ticket')}}</strong></div>
                            <div class="row">
                                <div class="col-md-6">
                                <a href="{{route('ticket-details')}}" class="btn btn-info">{{__('View Ticket Info')}} </a>
                                </div>
                                <div class="col-md-6">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#openTicket">{{__('Open A Ticket')}} </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>



                  <!-- Ticket Modal Starts -->

                  <div id="openTicket" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header" style="background-color:#61c597;">
                                            <h5 id="exampleModalLabel" class="modal-title">{{_('Ticket Opening')}}</h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" action="{{route('add-support-tickets')}}" class="form-horizontal" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="support_ticket_department_id" value="{{Auth::user()->department_id}}">
                                                <input type="hidden" name="support_ticket_employee_id" value="{{Auth::user()->id}}">

                                                <div class="row">

                                                    <div class="col-md-6 form-group">
                                                        <label>Priority</label>
                                                        <select class="form-control" name="support_ticket_priority" required>
                                                            <option value="">Select-a-Priority</option>
                                                            <option value="Critical">Critical</option>
                                                            <option value="High">High</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Low">Low</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Subject</label>
                                                        <input type="text" name="support_ticket_subject" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ticket Note</label>
                                                        <input type="text" name="support_ticket_note" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ticket Date</label>
                                                        <input type="date" name="support_ticket_date" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ticket Attachments</label>
                                                        <input type="file" name="support_ticket_attachment" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="my-textarea">Description</label>
                                                        <textarea class="form-control" name="support_ticket_desc"  rows="5"></textarea>
                                                    </div>
                                                    <br>
                                                    <div class="col-sm-12">
                                                        <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Ticket Modal Ends -->
            </div>



            <div class="row">
                {{--<div class="col-md-8 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center">
                            <h4>Payment --- {{__('Last 6 Months ')}}</h4>
                        </div>
                        <div class="card-body">
                           <canvas id="payment_last_six" data-last_six_month_payment = "" data-months=""  data-label1="Payment" ></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Employee Department')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                         <canvas id="department_chart" data-dept_bgcolor='@json($dept_bgcolor_array)'
                                    data-hover_dept_bgcolor='@json($dept_hover_bgcolor_array)'
                                    data-dept_emp_count='@json($dept_count_array)'
                                    data-dept_label='@json($dept_name_array)' width="100" height="95"></canvas>

                                      <canvas id="department_chart" data-dept_bgcolor=''
                                    data-hover_dept_bgcolor=''
                                    data-dept_emp_count=''
                                    data-dept_label='' width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Employee Designation')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                          <canvas id="designation_chart" data-desig_bgcolor='@json($desig_bgcolor_array)'
                                    data-hover_desig_bgcolor='@json($desig_hover_bgcolor_array)'
                                    data-desig_emp_count='@json($desig_count_array)'
                                    data-desig_label='@json($desig_name_array)' width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Expense Vs Deposit')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                       -    <canvas id="expense_deposit_chart" data-expense_count='{{$total_expense_raw}}'
                                    data-expense_level="{{trans('Expense')}}"
                                    data-deposit_count='{{$total_deposit_raw}}'
                                    data-deposit_level="{{trans('Deposit')}}" width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Project Status')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                           <canvas id="project_chart" data-project_status='@json($project_count_array)'
                                    data-project_label='@json($project_name_array)' width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>
                --}}
            </div>


            <div class="row">

            </div>
        </div>

    </section>


        <!-- edit boostrap model -->
        {{--<div class="modal fade" id="edit-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">

                        <input type="hidden" name="id" id="id">
                        <div class="row">

                            <div class="col-md-3 form-group">
                                <input readonly name="holiday_name" id="holiday_name" class="form-control" > : From  <input readonly id="start_date" class="form-control" > -  <input readonly  id="end_date" class="form-control" >
                            </div>

                        </div>

                </div>
                <div class="modal-footer">

                </div>
                </div>
            </div>
            </div>--}}
        <!-- end bootstrap model -->



<script type="text/javascript">

$(document).ready( function () {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

      $('#user-table').DataTable({


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





             //value retriving and opening the edit modal starts

            //  $('.edit').on('click', function () {
            //     var id = $(this).data('id');

            //     $.ajax({
            //         type:"POST",
            //         url: 'upcoming-holiday-details-by-id',
            //         data: { id: id },
            //         dataType: 'json',

            //         success: function(res){
            //         $('#ajaxModelTitle').html("Edit");
            //         $('#edit-modal').modal('show');
            //         $('#id').val(res.id);
            //         $('#holiday_name').val(res.holiday_name);
            //         $('#start_date').val(res.start_date);
            //         $('#end_date').val(res.end_date);
            //         }
            //     });
            // });

           //value retriving and opening the edit modal ends


           var date = new Date();
            date.setDate(date.getDate());
            $('.date').datepicker({
            startDate: date
            });


  } );


</script>

@endsection
