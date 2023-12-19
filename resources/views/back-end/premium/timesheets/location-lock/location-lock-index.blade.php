@extends('back-end.premium.layout.premium-main')

@section('content')

<?php
use App\Models\Role;
use App\Models\User;
?>

<section class="main-contant-section">

    <div class="mb-3">

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

        @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
        <div class="card">
            <div class="card-header with-border">

                <div class="card-title text-center mb-0">
                    <h3>Daily Attendance Location Lock Info<span id="details_month_year"></span></h3>
                </div>



            </div>
        </div>
        @endif


        <div class="content-box">
            <form method="post" class="container-fluid" action="{{route('date-wise-all-attendance')}}">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="day_month_year">Select Date</label>
                        <div class="input-group">
                            <input class="form-control" placeholder="Select Date" name="searchable_date" type="date"
                                value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <button type="submit" class="filtering btn btn-grad"><i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-4">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Date</th>
                            <th>First Time Attempt</th>
                            <th>Old Check In Lat</th>
                            <th>Old Check In Long</th>
                            <th>Requested Check In Lat</th>
                            <th>Requested Check In Long</th>
                            <th>Distance Differences In Meters For Checking In</th>
                            <th>Distance Differences In Kilo Meters For Checking In</th>
                            <th>Attempts For Check In</th>
                            <th>Check In Action</th>

                            <th>---</th>

                            <th>Old Check Out Lat</th>
                            <th>Old Check Out Long</th>
                            <th>Requested Check Out Lat</th>
                            <th>Requested Check Out Long</th>
                            <th>Distance Differences In Meters For Checking Out</th>
                            <th>Distance Differences In Kilo Meters For Checking Out</th>
                            <th>Attempts For Check Out</th>
                            <th>Check Out Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($attendance_locations as $attendance_locations_value)

                        <?php
                            //$attendance_locations = AttendanceLocation::where('attendance_location_com_id',Auth::user()->com_id)->get();

                            $employees = User::where('id',$attendance_locations_value->attendance_location_employee_id)->where('com_id',Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted','No')->whereNull('company_profile')->get([
                                'id',
                                'first_name',
                                'last_name',
                                'company_assigned_id',
                                'profile_photo',
                                'check_in_latitude',
                                'check_in_latitude_two',
                                'check_in_latitude_three',
                                'check_in_longitude',
                                'check_in_longitude_two',
                                'check_in_longitude_three',
                                'check_out_latitude',
                                'check_out_latitude_two',
                                'check_out_latitude_three',
                                'check_out_longitude',
                                'check_out_longitude_two',
                                'check_out_longitude_three',

                            ]);

                            $one_meter_to_degree = 0.00000898;

                        ?>
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <?php
                                 foreach($employees as $employeesValue){
                                    echo $employeesValue->first_name.' '.$employeesValue->last_name;
                                 }
                                ?>
                            </td>
                            <td>
                                <?php
                                 foreach($employees as $employeesValue){
                                    echo $employeesValue->company_assigned_id;
                                 }
                                ?>
                            </td>
                            <td>{{$attendance_locations_value->attendance_location_date}}</td>
                            <?php date_default_timezone_set('UTC');

                                // Create a DateTime object with the created_at timestamp
                                $created_at = new DateTime($attendance_locations_value->created_at);

                                // Set the time zone to Bangladesh
                                $bd_time_zone = new DateTimeZone('Asia/Dhaka');
                                $created_at->setTimezone($bd_time_zone);
                                // Format the date and time in h:i:s A format
                                $formatted_time = $created_at->format('h:i:s A');
                                ?>
                            <td>{{ $formatted_time}}</td>
                            <td>
                                <?php
                                 foreach($employees as $employeesValue){
                                    echo $employeesValue->check_in_latitude;
                                 }
                                ?>
                            </td>
                            <td>
                                <?php
                                 foreach($employees as $employeesValue){
                                    echo $employeesValue->check_in_longitude;
                                 }
                                ?>
                            </td>
                            <td>{{ $attendance_locations_value->attendance_location_check_in_latitude}}</td>
                            <td>{{ $attendance_locations_value->attendance_location_check_in_longitude}}</td>
                            <td>
                                <?php
                                    foreach($employees as $employeesValue){
                                        if(is_numeric($employeesValue->check_in_latitude)){
                                            $old_lat = $employeesValue->check_in_latitude;
                                        }else{
                                            $old_lat = 0;
                                        }


                                        $meters_value_for_old_lat = $old_lat/$one_meter_to_degree;
                                        $meters_value_for_current_lat = $attendance_locations_value->attendance_location_check_in_latitude/$one_meter_to_degree;

                                            if($meters_value_for_old_lat > $meters_value_for_current_lat){
                                                $distance_in_meter_full_value = $meters_value_for_old_lat - $meters_value_for_current_lat;
                                                echo $distance_in_meter = number_format($distance_in_meter_full_value, 2, '.', '');
                                                echo " (m)";
                                                //echo $distance_in_kilometer = $distance_in_meter/1000;
                                            }else{
                                                $distance_in_meter_full_value = $meters_value_for_current_lat - $meters_value_for_old_lat;
                                                echo $distance_in_meter = number_format($distance_in_meter_full_value, 2, '.', '');
                                                echo " (m)";
                                                //echo $distance_in_kilometer = $distance_in_meter/1000;
                                            }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    foreach($employees as $employeesValue){
                                        if(is_numeric($employeesValue->check_in_latitude)){
                                            $old_lat = $employeesValue->check_in_latitude;
                                        }else{
                                            $old_lat = 0;
                                        }

                                        $meters_value_for_old_lat = $old_lat/$one_meter_to_degree;
                                        $meters_value_for_current_lat = $attendance_locations_value->attendance_location_check_in_latitude/$one_meter_to_degree;

                                            if($meters_value_for_old_lat > $meters_value_for_current_lat){
                                                $distance_in_meter = $meters_value_for_old_lat - $meters_value_for_current_lat;
                                                $distance_in_kilometer_full_value = $distance_in_meter/1000;
                                                echo $distance_in_kilometer = number_format($distance_in_kilometer_full_value, 2, '.', '');
                                                echo " (km)";
                                            }else{
                                                $distance_in_meter = $meters_value_for_current_lat - $meters_value_for_old_lat;
                                                $distance_in_kilometer_full_value = $distance_in_meter/1000;
                                                echo $distance_in_kilometer = number_format($distance_in_kilometer_full_value, 2, '.', '');
                                                echo " (km)";
                                            }
                                    }
                                ?>
                            </td>
                            <td>{{$attendance_locations_value->attendance_location_check_in_attempt}}</td>
                            <td>
                                @foreach($employees as $employeesValue)
                                @if($employeesValue->check_in_latitude_three ==
                                $attendance_locations_value->attendance_location_check_in_latitude)
                                <form method="post" action="{{route('unset-attendance-locations')}}">
                                    @csrf
                                    <input class="form-control" name="attendance_location_employee_id" type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_employee_id}}">
                                    <button type="submit" class="filtering btn btn-danger"><i
                                            class="fa fa-ban"></i></button>
                                </form>
                                {{-- <a
                                    href="{{route('unset-attendance-locations',['id'=>$employeesValue->id])}}"><button
                                        class="btn btn-danger">Unset</button></a> --}}
                                @else
                                <form method="post" action="{{route('set-attendance-locations')}}">
                                    @csrf
                                    <input class="form-control" name="attendance_location_employee_id" type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_employee_id}}">
                                    <input class="form-control" name="attendance_check_in_location_latitude"
                                        type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_check_in_latitude}}">
                                    <input class="form-control" name="attendance_check_in_location_longitude"
                                        type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_check_in_longitude}}">
                                    <button type="submit" class="filtering btn btn-primary"><i
                                            class="fa fa-check"></i></button>
                                </form>
                                {{-- <a href="{{route('set-attendance-locations',['id'=>$employeesValue->id])}}"><button
                                        class="btn btn-success">Set</button></a> --}}
                                @endif
                                @endforeach
                            </td>




                            <td>---</td>





                            <td>
                                <?php
                                 foreach($employees as $employeesValue){
                                    echo $employeesValue->check_out_latitude;
                                 }
                                ?>
                            </td>
                            <td>
                                <?php
                                 foreach($employees as $employeesValue){
                                    echo $employeesValue->check_out_longitude;
                                 }
                                ?>
                            </td>
                            <td>{{ $attendance_locations_value->attendance_location_check_out_latitude}}</td>
                            <td>{{ $attendance_locations_value->attendance_location_check_out_longitude}}</td>
                            <td>
                                <?php
                                    foreach($employees as $employeesValue){
                                        if(is_numeric($employeesValue->check_out_latitude)){
                                            $old_check_out_lat = $employeesValue->check_out_latitude;
                                        }else{
                                            $old_check_out_lat = 0;
                                        }

                                        $meters_value_for_old_check_out_lat = $old_check_out_lat/$one_meter_to_degree;
                                        $check_out_meters_value_for_current_lat = $attendance_locations_value->attendance_location_check_out_latitude/$one_meter_to_degree;

                                            if($meters_value_for_old_check_out_lat > $check_out_meters_value_for_current_lat){
                                                $check_out_distance_in_meter_full_value = $meters_value_for_old_check_out_lat - $check_out_meters_value_for_current_lat;
                                                echo $check_out_distance_in_meter = number_format($check_out_distance_in_meter_full_value, 2, '.', '');
                                                echo " (m)";
                                                //echo $distance_in_kilometer = $distance_in_meter/1000;
                                            }else{
                                                $check_out_distance_in_meter_full_value = $check_out_meters_value_for_current_lat - $meters_value_for_old_check_out_lat;
                                                echo $check_out_distance_in_meter = number_format($check_out_distance_in_meter_full_value, 2, '.', '');
                                                echo " (m)";
                                                //echo $distance_in_kilometer = $distance_in_meter/1000;
                                            }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php


                                    foreach($employees as $employeesValue){
                                        if(is_numeric($employeesValue->check_out_latitude)){
                                            $old_check_out_lat = $employeesValue->check_out_latitude;
                                        }else{
                                            $old_check_out_lat = 0;
                                        }

                                        $meters_value_for_old_check_out_lat = $old_check_out_lat/$one_meter_to_degree;
                                        $check_out_meters_value_for_current_lat = $attendance_locations_value->attendance_location_check_out_latitude/$one_meter_to_degree;

                                            if($meters_value_for_old_check_out_lat > $check_out_meters_value_for_current_lat){
                                                $check_out_distance_in_meter_full_value = $meters_value_for_old_check_out_lat - $check_out_meters_value_for_current_lat;
                                                $check_out_distance_in_meter = number_format($check_out_distance_in_meter_full_value, 2, '.', '');
                                                echo $check_out_distance_in_kilometer = $check_out_distance_in_meter/1000;
                                                echo " (km)";
                                            }else{
                                                $check_out_distance_in_meter_full_value = $check_out_meters_value_for_current_lat - $meters_value_for_old_check_out_lat;
                                                $check_out_distance_in_meter = number_format($check_out_distance_in_meter_full_value, 2, '.', '');
                                                echo $check_out_distance_in_kilometer = $check_out_distance_in_meter/1000;
                                                echo " (km)";
                                            }
                                    }
                                ?>
                            </td>
                            <td>{{$attendance_locations_value->attendance_location_check_out_attempt}}</td>
                            <td>
                                @foreach($employees as $employeesValue)
                                @if($employeesValue->check_out_latitude_three ==
                                $attendance_locations_value->attendance_location_check_out_latitude)
                                <form method="post" action="{{route('unset-check-out-attendance-locations')}}">
                                    @csrf
                                    <input class="form-control" name="attendance_check_out_location_employee_id"
                                        type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_employee_id}}">
                                    <button type="submit" class="filtering btn btn-danger"><i
                                            class="fa fa-ban"></i></button>
                                </form>
                                {{-- <a
                                    href="{{route('unset-attendance-locations',['id'=>$employeesValue->id])}}"><button
                                        class="btn btn-danger">Unset</button></a> --}}
                                @else
                                <form method="post" action="{{route('set-check-out-attendance-locations')}}">
                                    @csrf
                                    <input class="form-control" name="attendance_check_out_location_employee_id"
                                        type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_employee_id}}">
                                    <input class="form-control" name="attendance_check_out_location_latitude"
                                        type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_check_out_latitude}}">
                                    <input class="form-control" name="attendance_check_out_location_longitude"
                                        type="hidden"
                                        value="{{$attendance_locations_value->attendance_location_check_out_longitude}}">
                                    <button type="submit" class="filtering btn btn-primary"><i
                                            class="fa fa-check"></i></button>
                                </form>
                                {{-- <a href="{{route('set-attendance-locations',['id'=>$employeesValue->id])}}"><button
                                        class="btn btn-success">Set</button></a> --}}
                                @endif
                                @endforeach
                            </td>



                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>


    </div>
</section>





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








   });


</script>
@endsection
