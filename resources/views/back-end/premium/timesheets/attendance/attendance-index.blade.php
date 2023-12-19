@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
use App\Models\Role;

?>

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


        <div class="attendance-search">
            <div class="card mb-4">
                <div class="card-header with-border">

                    <div class="card-title text-center">
                        <h1>Daily Attendance Info<span id="details_month_year"></span></h1>
                    </div>
                </div>
            </div>
        </div>



        <div class="content-box">
            @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
            <form method="post" action="{{route('date-wise-all-attendance')}}"
                class="container-fluid table-common-search">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <label for="day_month_year">Select Date</label>
                        <div class="input-group">
                            <input class="form-control" placeholder="Select Date" name="searchable_date" type="date"
                                value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="filtering btn btn-grad"><i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
            @endif
            <div class="table-responsive mt-4">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Clock In</th>
                            <th>IN LC</th>
                            <th>Clock Out</th>
                            <th>OUT LC</th>
                            <th>Late</th>
                            <th>Early Leaving</th>
                            <th>Overtime</th>
                            <th>Check In Latitude</th>
                            <th>Check In Longitude</th>
                            {{-- <th>Check In Location</th> --}}
                            <th>Check Out Latitude</th>
                            <th>Check Out Longitude</th>
                            {{-- <th>Check Out Location</th> --}}
                            <th>Total Work</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($attendances as $attendancesValue)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $attendancesValue->first_name.' '.$attendancesValue->last_name}}</td>
                            <td>{{ $attendancesValue->company_assigned_id }}</td>
                            {{-- <td>{{ $attendancesValue->company_name}}</td> --}}
                            <td>{{ $attendancesValue->attendance_date}}</td>
                            <td>@if($attendancesValue->check_in_out === 1){{__('Present')}}@else{{__('Absent')}}@endif
                            </td>
                            <td>{{ $attendancesValue->clock_in }}</td>
                            <td>{{ $attendancesValue->clock_in }}</td>
                            <td>{{ $attendancesValue->clock_out }}</td>
                            <td>{{ $attendancesValue->clock_out }}</td>
                            <td>{{ $attendancesValue->time_late }}</td>
                            <td>{{ $attendancesValue->early_leaving }}</td>
                            <td>{{ $attendancesValue->overtime }}</td>
                            <td>{{ $attendancesValue->check_in_latitude }}</td>
                            <td>{{ $attendancesValue->check_in_longitude }}</td>
                            {{-- <td id="map" style="height: 100px;width: 100px;"></td> --}}
                            <td>{{ $attendancesValue->check_out_latitude }}</td>
                            <td>{{ $attendancesValue->check_out_longitude }}</td>
                            {{-- <td>Check Out Location</td> --}}
                            @if($attendancesValue->clock_out == NULL || $attendancesValue->clock_out == '')
                            <td>00:00:00</td>
                            @else
                            <td>
                                {{ $attendancesValue->total_work }}

                            </td>
                            @endif
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

                        // $( function() {
                        //     $( "#datepicker" ).datepicker({
                        //         dateFormat: 'yy-mm-dd',
                        //         maxDate:0,
                        //     });
                        // });

   });


</script>
{{--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7U-RKEJcYdF9mbg7-_DDA-xocMSnzDr4"></script>
<script>
    function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: 0, lng: 0 },
                    zoom: 2,
                });

                @foreach ($attendances as $location)
                    new google.maps.Marker({
                        position: { lat: {{ $location->check_in_latitude }}, lng: {{ $location->check_in_longitude }} },
                        map,
                        title: 'Attendance Location',
                    });
                @endforeach
            }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7U-RKEJcYdF9mbg7-_DDA-xocMSnzDr4&callback=initMap"></script>
--}}
@endsection
