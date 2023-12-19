@extends('back-end.premium.layout.employee-panel')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <?php
    use App\Models\Attendance;
    use App\models\Leave;
    use App\models\User;
    use App\models\LeaveType;
    //use DateTime;
    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');
    //$current_time = $date->format('H:i:s');
    
    $date_wise_day_name = date('D', strtotime($current_date));
    
    ?>

    <section class="main-contant-section">

        @if (Session::get('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
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

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="thin-text">Welcome {{ Auth::user()->username }}</h1>
                    </div>
                    <div>
                        <h4 class="thin-text">{{ __('Today is') }} {{ now()->englishDayOfWeek }}
                            {{ now()->format(env('Date_Format')) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card content-box profile-img">
                    @foreach ($users as $users_value)
                        <img class="card-img-top" src="{{ $users_value->profile_photo }}" lt="Card image cap">
                    @endforeach


                    {{-- <a href="{{route('profile-details')}}" class="btn profile-edite"> <i class="fa fa-pencil-square-o"
                        aria-hidden="true"></i> </a> --}}


                    <div class="card-body">
                        <h5 class="card-title">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</b>({{ Auth::user()->username }})
                        </h5>
                        @foreach ($users as $users_value)
                            <div class="div">
                                <p>{{ $users_value->userdepartment->department_name }},
                                    {{ $users_value->userdesignation->designation_name }}
                                </p>
                            </div>
                            <div class="div">
                                <p>Office Shift :
                                    @if ($date_wise_day_name == 'Sat')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->saturday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->saturday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @elseif($date_wise_day_name == 'Sun')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->sunday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->sunday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @elseif($date_wise_day_name == 'Mon')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->monday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->monday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @elseif($date_wise_day_name == 'Tue')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->tuesday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->tuesday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @elseif($date_wise_day_name == 'Wed')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->wednesday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->wednesday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @elseif($date_wise_day_name == 'Thu')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->thursday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->thursday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @elseif($date_wise_day_name == 'Fri')
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->friday_in)) }}
                                        To
                                        {{ date('g:i A', strtotime($users_value->userofficeshift->friday_out)) }}({{ $users_value->userofficeshift->shift_name }})
                                    @else
                                    @endif
                                </p>
                            </div>
                        @endforeach
                        <div class="profile_view_btn mt-4">
                            @if (Auth::user()->attendance_type == 'general')
                                <form class="d-inline m1-2" method="post" action="{{ route('employee-attendance') }}">
                                    @csrf
                                    <input type="hidden" name="employee_id" id="employee_id"
                                        value="{{ Auth::user()->id }}" required>
                                    {{-- <script>
                                var current = navigator.geolocation
                                        if (current) {
                                            navigator.geolocation.getCurrentPosition(showPosition);
                                        } else {
                                            toastr.error('Your Browser Or Device not Supported Geolocaiton');
                                        }

                                        function showPosition(position) {
                                            document.getElementById("check_in_lat").value = position.coords.latitude;
                                            document.getElementById("check_in_longt").value = position.coords.longitude;
                                        }
                            </script> --}}

                                    <script>
                                        var current = navigator.geolocation;
                                        if (current) {
                                            navigator.geolocation.getCurrentPosition(showPosition);
                                        } else {
                                            toastr.error('Your Browser Or Device not Supported Geolocation');
                                        }

                                        function showPosition(position) {
                                            document.getElementById("check_in_lat").value = position.coords.latitude;
                                            document.getElementById("check_in_longt").value = position.coords.longitude;
                                            // Use the Google Maps Geolocation API here
                                            var apiKey = "AIzaSyCbiXJAobl0GkJjpH3pHPTeAlLDmkWYQtQ"; // Replace with your actual API key
                                            var apiUrl = `https://maps.googleapis.com/maps/api/geolocation/json?key=${apiKey}`;
                                            var data = {
                                                "considerIp": "true",
                                                "wifiAccessPoints": [] // You can provide Wi-Fi access point data if available
                                            };
                                            // Make an API request to Google Maps Geolocation API
                                            fetch(apiUrl, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                    },
                                                    body: JSON.stringify(data)
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Handle the API response data here
                                                    console.log(data);
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
                                        }
                                    </script>

                                    <input type="hidden" readonly name="lat" id="check_in_lat" value="" required>
                                    <input type="hidden" readonly name="longt" id="check_in_longt" value=""
                                        required>
                                    {{-- @if (Attendance::where('employee_id', '=', Auth::user()->id)->where('attendance_date', '=', $current_date)->where('check_in_out', '=', 0)->exists()) --}}
                                    @if (Attendance::where('employee_id', '=', Auth::user()->id)->where('attendance_date', '=', $current_date)->exists())
                                        <button type="submit" class="btn btn-grad"> <i class="fa fa-map-marker"
                                                aria-hidden="true"></i> {{ __('Check Out') }}
                                        </button>
                                    @else
                                        <input type="hidden" name="check_in_request" value="check_in_request">
                                        <button type="submit" class="btn btn-grad"> <i class="fa fa-map-marker"
                                                aria-hidden="true"></i> {{ __('Check In') }}
                                        </button>
                                    @endif
                                </form>
                            @else
                                <form class="d-inline m1-2" method="post"
                                    action="{{ route('employee-ip-based-attendances') }}">
                                    @csrf
                                    <input type="hidden" name="employee_id" id="employee_id"
                                        value="{{ Auth::user()->id }}" required>
                                    @if (Attendance::where('employee_id', '=', Auth::user()->id)->where('attendance_date', '=', $current_date)->exists())
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-map-marker"
                                                aria-hidden="true"></i> {{ __('Check Out') }}
                                        </button>
                                    @else
                                        <input type="hidden" name="check_in_request" value="check_in_request">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-map-marker"
                                                aria-hidden="true"></i> {{ __('Check In') }}
                                        </button>
                                    @endif
                                </form>
                            @endif

                            <a href="{{ route('profile-details') }}" class="btn btn-grad"> {{ __('Profile') }}
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <section class="employ-profile-right-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://icon-library.com/images/payslip-icon/payslip-icon-7.jpg"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="{{ route('payslip-details') }}">
                                                <div class="name"><strong>Payslip(<span
                                                            style="color:red;">{{ $pay_slip }}</span>)</strong></strong>
                                                </div>
                                                <div class="count-number employee-count">
                                                    <a href="#" class="btn btn-grad"> View Details </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Count item widget-->
                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://cdn-icons-png.flaticon.com/512/86/86762.png" alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="{{ route('award-details') }}">
                                                <div class="name"><strong>Award(<span
                                                            style="color:red;">{{ $award_counts }}</span>)</strong></div>
                                                <div class="count-number attendance-count">
                                                    <a href="#" class="btn btn-grad"> View Details </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Count item widget-->
                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="data:image/png;base64,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"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="{{ route('announcement') }}">
                                                <div class="name"><strong>{{ __('Announcement') }}(<span
                                                            style="color:red;">{{ $announcement }}</span>)</strong></strong>
                                                </div>
                                                <div class="count-number leave-count">
                                                    <a href="#" class="btn btn-grad"> View Details </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Count item widget-->
                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://images.freeimages.com/fic/images/icons/331/slate/256/holiday.png"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="{{ route('upcoming-holidays-details') }}">
                                                <div class="name"><strong>{{ __('Upcoming Holidays') }}(<span
                                                            style="color:red;">{{ $holiday_counts }}</span>)</strong></strong>
                                                </div>
                                                <div class="count-number total_expense edit">
                                                    <a href="#" class="btn btn-grad"> View Details </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3387/3387188.png" alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="">
                                                <div class="name"><strong>{{ __('Leave') }}</strong></div>
                                                <div class="section-btn">
                                                    <a href="{{ route('leave-details') }}"
                                                        class="btn btn-grad">{{ __('View
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Leave') }}
                                                    </a>
                                                    <a href="#" class="btn btn-grad" data-toggle="modal"
                                                        data-target="#requestLeave">{{ __('Request Leave') }} </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Request Leave Add Modal Starts -->

                            <div id="requestLeave" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Leave Request') }}</h5>
                                            <button type="button" data-dismiss="modal" id="close"
                                                aria-label="Close" class="close"><i
                                                    class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" action="{{ route('add-leaves') }}"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="employee_id"
                                                        value="{{ Auth::user()->id }}">
                                                    <div class="col-md-12 form-group">

                                                        <table class="table table-striped table-bordered">
                                                            <tr>
                                                                <td>
                                                                    {{ __('Leave Types') }}

                                                                </td>
                                                                <td>
                                                                    {{ __('Allocated') }}

                                                                </td>
                                                                <td>
                                                                    {{ __('Approved') }}

                                                                </td>
                                                                <td>
                                                                    {{ __('Balance') }}

                                                                </td>
                                                            </tr>

                                                            @foreach ($leave_types as $leave_type)
                                                                <?php
                                                                
                                                                $leave_count = Leave::where('leaves_leave_type_id', '=', $leave_type->id)
                                                                    ->where('leaves_company_id', Auth::user()->com_id)
                                                                    ->where('leaves_employee_id', Auth::user()->id)
                                                                    ->whereYear('created_at', '=', date('Y'))
                                                                    ->where('leaves_status', 'Approved')
                                                                    ->sum('total_days');
                                                                
                                                                $joining_date = User::where('id', Auth::user()->id)->first('joining_date');
                                                                $days = floor((time() - strtotime($joining_date->joining_date)) / 86400) + 1;
                                                                
                                                                ?>
                                                                @if ($days >= $leave_type->activation_days)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $leave_type->leave_type }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $leave_type->allocated_day }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $leave_count }}
                                                                            {{ __('Days') }}
                                                                        </td>
                                                                        <td>

                                                                            {{ $leave_type->allocated_day - $leave_count }}
                                                                            {{ __('Days') }}

                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </table>

                                                    </div>



                                                    <div class="col-md-3">
                                                        <div class="input-group mb-3">
                                                            <label>Leave Type</label>
                                                            <select name="leave_type" id="leave_type"
                                                                class="form-control" data-live-search="true"
                                                                data-live-search-style="begins" title='Leave Type'
                                                                required>
                                                                <option value="">Select Leave</option>
                                                                @foreach ($leave_types as $leave_type_value)
                                                                    <?php
                                                                    $joining_date = User::where('id', Auth::user()->id)->first('joining_date');
                                                                    $days = floor((time() - strtotime($joining_date->joining_date)) / 86400) + 1;
                                                                    ?>
                                                                    @if ($days >= $leave_type_value->activation_days)
                                                                        <option value="{{ $leave_type_value->id }}">
                                                                            {{ $leave_type_value->leave_type }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group mb-3">
                                                            <label>Start Date</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                                        aria-hidden="true"></i> </span>
                                                            </div>
                                                            <input type="date" name="start_date" id="start_date"
                                                                class="form-control" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group mb-3">
                                                            <label>End Date</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                                        aria-hidden="true"></i> </span>
                                                            </div>
                                                            <input type="date" name="end_date" id="end_date"
                                                                class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group mb-3">
                                                            <label>Total Days</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                                        aria-hidden="true"></i> </span>
                                                            </div>
                                                            <input type="text" name="" id="leave_days"
                                                                class="form-control" value="" readonly>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12 form-group">
                                                        <label>Replacement Employee</label>
                                                        <select name="assigned_employee_id" id="assigned_employee_id"
                                                            class="form-control selectpicker select2"
                                                            data-live-search="true" data-live-search-style="begins"
                                                            title='Assigned Employee' required>
                                                            @foreach ($employees as $employee)
                                                                <option value="{{ $employee->id }}">
                                                                    {{ $employee->first_name . ' ' . $employee->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>


                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label for="leave_reason">Description</label>
                                                        <textarea id="leave_reason" rows="10" cols="20" class="form-control" name="leave_reason" required></textarea>
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="leave_reason">Document </label>
                                                        <input type="file" name="leave_document" class="form-control">
                                                        <span style="font-size: 10px;color:red;">If
                                                            your leave type is sick leave,this filed is
                                                            mandatory.Otherwise leave
                                                            not approved</span>
                                                    </div>


                                                    <div class="col-md-6 form-group" style="margin-top: 21px;">
                                                        <div class="custom-control custom-checkbox"
                                                            style="display: flex; align-items: center;">
                                                            <input type="checkbox" name="is_half" id="is_half"
                                                                value="1" style="margin-right: 5px;">
                                                            <label for="is_half"
                                                                style="margin: 0; cursor: pointer; user-select: none;">Half
                                                                Day</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <input id="submit_btn" type="submit" name="action_button"
                                                            class="btn bg-success w-50 text-white"
                                                            value="{{ __('Add') }}" disabled />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Request Leave Add Modal script Starts --}}
                            <script>
                                $(document).ready(function() {
                                    $('.select2').select2();
                                    $('#end_date').change(function() {
                                        // Get the values from the input fields
                                        var date1String = $('#start_date').val();
                                        var date2String = $(this).val();

                                        // Convert the date strings to Date objects
                                        var date1 = new Date(date1String);
                                        var date2 = new Date(date2String);

                                        // Calculate the time difference in milliseconds
                                        var timeDiff = Math.abs(date2.getTime() - date1.getTime());

                                        // Convert the time difference from milliseconds to days
                                        var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24) + 1);
                                        $('#leave_days').val(daysDiff);
                                        console.log('The number of days between the two dates is: ' + daysDiff);
                                    });

                                    $(document).ready(function() {
                                        // var editor = CKEDITOR.replace('leave_reason');
                                        $('#leave_type, #start_date, #end_date, #assigned_employee_id, #leave_reason').on('input',
                                            function() {
                                                var allFilled = true;
                                                $('#leave_type, #start_date, #end_date, #assigned_employee_id, #leave_reason')
                                                    .each(function() {
                                                        if ($(this).val() === '') {
                                                            allFilled = false;
                                                            return false; // Exit the loop if any field is empty
                                                        }
                                                    });
                                                // var editorContent = editor.getData().trim();
                                                // if (editorContent === '') {
                                                //     allFilled = false;
                                                // }

                                                if (allFilled) {
                                                    $('#submit_btn').prop('disabled', false);
                                                } else {
                                                    $('#submit_btn').prop('disabled', true);
                                                }
                                            });
                                    });

                                });
                            </script>
                            {{-- Request Leave Add Modal script end --}}
                            <!-- Request Leave Add Modal Ends -->

                            <!-- Count item widget-->
                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://png.pngtree.com/png-clipart/20190628/original/pngtree-vacation-and-travel-icon-png-image_4032146.jpg"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="">
                                                <div class="name"><strong
                                                        class="blue-text">{{ __('Travel') }}</strong>
                                                </div>
                                                <div class="section-btn">
                                                    <a href="{{ route('travel-details') }}"
                                                        class="btn btn-grad">{{ __('View
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Travel') }}
                                                    </a>
                                                    <a href="#" class="btn btn-grad" data-toggle="modal"
                                                        data-target="#requestTravel">{{ __('Request Travel') }} </a>

                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="requestTravel" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Travel Request') }}</h5>
                                            <button type="button" data-dismiss="modal" id="close"
                                                aria-label="Close" class="close"><i
                                                    class="dripicons-cross"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('add-travels') }}"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="travel_department_id"
                                                    value="{{ Auth::user()->department_id }}">
                                                <input type="hidden" name="travel_employee_id"
                                                    value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="travel_status" class="form-control"
                                                    value="Pending">
                                                <input type="hidden" name="travel_actual_budget" class="form-control"
                                                    value="0">

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Arrangement Type</label>
                                                        <select class="form-control" name="travel_arrangement_type"
                                                            required>
                                                            <option value="">Select-An-Arrangement-Type</option>
                                                            @foreach ($arrangement_types as $arrangement_types_value)
                                                                <option
                                                                    value="{{ $arrangement_types_value->variable_method_name }}">
                                                                    {{ $arrangement_types_value->variable_method_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="my-textarea">Purpose of Visit</label>
                                                        <textarea class="form-control" name="travel_purpose" rows="3" required></textarea>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Place of Visit</label>
                                                        <input type="text" name="travel_place" class="form-control"
                                                            value="" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="my-textarea">Description</label>
                                                        <textarea class="form-control" name="travel_desc" rows="5" required></textarea>
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Start Date</label>
                                                        <input type="date" name="travel_start_date"
                                                            class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>End Date</label>
                                                        <input type="date" name="travel_end_date" class="form-control"
                                                            value="" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Expected Budget</label>
                                                        <input type="text" name="travel_expected_budget"
                                                            class="form-control" value="" required>
                                                    </div>
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

                                                    <div class="col-sm-12">
                                                        <input type="submit" name="action_button"
                                                            class="btn btn-grad w-50" value="{{ __('Add') }}" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://img.freepik.com/premium-vector/two-tickets-icon-illustration-ticket-entrance-event_385450-19.jpg?w=2000"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="">
                                                <div class="name"><strong
                                                        class="blue-text">{{ __('Ticket') }}</strong>
                                                </div>
                                                <div class=" section-btn">
                                                    <a href="{{ route('ticket-details') }}"
                                                        class="btn btn-grad">{{ __('View
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Ticket') }}
                                                    </a>
                                                    <a href="#" class="btn btn-grad" data-toggle="modal"
                                                        data-target="#openTicket">{{ __('Open A Ticket') }} </a>

                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="openTicket" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Ticket Opening') }}</h5>
                                            <button type="button" data-dismiss="modal" id="close"
                                                aria-label="Close" class="close"><i
                                                    class="dripicons-cross"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('add-support-tickets') }}"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="support_ticket_department_id"
                                                    value="{{ Auth::user()->department_id }}">
                                                <input type="hidden" name="support_ticket_employee_id"
                                                    value="{{ Auth::user()->id }}">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Priority</label>
                                                        <select class="form-control" name="support_ticket_priority"
                                                            required>
                                                            <option value="">Select-a-Priority</option>
                                                            <option value="Critical">Critical</option>
                                                            <option value="High">High</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Low">Low</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Subject</label>
                                                        <input type="text" name="support_ticket_subject"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ticket Note</label>
                                                        <input type="text" name="support_ticket_note"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ticket Date</label>
                                                        <input type="date" name="support_ticket_date"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ticket Attachments</label>
                                                        <input type="file" name="support_ticket_attachment"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="my-textarea">Description</label>
                                                        <textarea class="form-control" name="support_ticket_desc" rows="5"></textarea>
                                                    </div>
                                                    <br>
                                                    <div class="col-sm-12">
                                                        <input type="submit" name="action_button"
                                                            class="btn btn-grad w-50" value="{{ __('Add') }}" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card subtle">
                                    <div class="card-img">
                                        <img src="https://cdn-icons-png.flaticon.com/512/86/86764.png" alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="wrapper count-title text-center">
                                            <a href="">
                                                <div class="name"><strong>{{ __('Performance') }}</strong></div>
                                                <div class="section-btn">
                                                    <a href="{{ route('employee-values') }}"
                                                        class="btn btn-grad">{{ __('Set
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Values') }}
                                                    </a>
                                                    <a href="{{ route('employee-objectives') }}"
                                                        class="btn btn-grad">{{ __('Set Objectives') }} </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>

    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            const tabWrapper = document.querySelector(".employee-profile-tab");
            const tabBtns = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-contents .content");

            tabWrapper.addEventListener("click", (e) => {
                const id = e.target.dataset.target;
                if (id) {
                    // remove active from other buttons
                    tabBtns.forEach((btn) => {
                        btn.classList.remove("active");
                        e.target.classList.add("active");
                    });
                    // hide other tabContents
                    tabContents.forEach((content) => {
                        content.classList.remove("active");
                    });
                    const currentContent = document.getElementById(id);
                    currentContent.classList.add("active");
                }
            });



            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#user-table').DataTable({
                    dom: '<"row"lfB>rtip',
                    buttons: [{
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

                var date = new Date();
                date.setDate(date.getDate());
                $('.date').datepicker({
                    startDate: date
                });
            });


        });
    </script>

@endsection
