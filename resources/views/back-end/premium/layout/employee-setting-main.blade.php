<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{--
    <link rel="icon" type="image/png" href="{{url('/logo', $general_settings->site_logo) ?? 'NO Logo'}}"> --}}
    <link rel="icon" type="image/png" href="{{ url('/uploads/logos/PitecHR.png') ?? 'NO Logo' }}">
    <title>PitecHR</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://kit.fontawesome.com/80a1447cb8.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap-datepicker.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.css') }}"
        type="text/css">
    <!-- Boostrap Tag Inputs-->
    <link rel="stylesheet" href="{{ asset('/vendor/Tag_input/tagsinput.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap-select.min.css') }}" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}" type="text/css">
    <!-- Dripicons icon font-->
    <link rel="stylesheet" href="{{ asset('/vendor/dripicons/webfont.css') }}" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ asset('/css/grasp_mobile_progress_circle-1.0.0.min.css') }}" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}"
        type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="{{ asset('/vendor/daterange/css/daterangepicker.min.css') }}" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/datatables.flexheader.boostrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/style.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('/css/style.default.css') }}" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
    {{--
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> --}}
    <style>
        .CheckStyle {
            border: 2px solid #182C61;
            border-radius: 20px;
            text-align: center;
            font-size: 15px;
            background: rgb(49, 89, 98);
            background: linear-gradient(356deg, rgba(49, 89, 98, 1) 0%, rgba(49, 150, 49, 0.6895133053221288) 47%, rgba(242, 246, 245, 0.989233193277311) 100%);
        }

        #organization-dropdown {
            background-color: #e2f1ebe8;
            border-radius: 5px 25px 25px 5px;
        }

        #timesheet-dropdown {
            background-color: #f3e1e7;
            border-radius: 5px 25px 25px 5px;
        }
    </style>

    {{--
    @if (request()->is('admin/dashboard*') || request()->is('calendar*'))
    @include('calendarable.css')
    @endif
    --}}
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"src="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/charts-custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/knockout-3.4.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">

    <!-- JS for Boostrap Tag Inputs-->

    <script type="text/javascript" src="{{ asset('/vendor/Tag_input/tagsinput.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.js') }}"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="{{ asset('/vendor/datatable/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/sum().js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.checkboxes.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/datatable.fixedheader.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/datatable.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.js') }}"></script>

    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/app.js') }}"></script>
    <!-- html2pdf CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    @include('back-end.premium.partials.customScripts')


    {{-- @if (request()->is('admin/dashboard*') || request()->is('calendar*'))
    @include('calendarable.js')
    @endif
    --}}
</head>
<?php

use App\Models\User;
use App\Models\ObjectiveTypeConfig;
use App\Models\Objective;
use App\Models\Notification;
use App\Models\CompanyBankAccountCommunication;
use App\Models\ValueTypeDetail;
use App\Models\NocEmployee;

try {
    $users = User::where('id', Session::get('employee_setup_id'))->get(['designation_id', 'department_id', 'id', 'appointment_letter_format_id', 'warning_letter_format_id', 'probation_letter_format_id','noc_id','experience_letter_id','salary_certificate_format_id']);
    foreach ($users as $user) {
        $user_desg = $user->designation_id ?? null;
        $user_dept = $user->department_id ?? null;
        $user_id = $user->id;
        $appointment_letter_format_id = $user->appointment_letter_format_id;
        $warning_letter_format_id = $user->warning_letter_format_id;
        $probation_letter_format_id = $user->probation_letter_format_id;
        $noc_id = $user->noc_id;
        $experience_letter_id = $user->experience_letter_id;
        $salary_certificate_format_id = $user->salary_certificate_format_id;
    }
    $objectives = ObjectiveTypeConfig::where('obj_config_desig_id', $user_desg)->first(['obj_config_desig_id', 'obj_config_dept_id']);
} catch (\Exception $e) {
    return redirect()->route('home');
}

    $employeeId = Auth::id();
    $userId = CompanyBankAccountCommunication::where('company_bank_account_communication_emp_id', $employeeId)->exists();



##### for upcoming
$startDate = date('Y-m-d', strtotime('-1 days'));
//$endDate = date('Y').'-'.'12'.'-'.'31';
$endDate = date('Y-m-d', strtotime('+7 days'));
##### for upcoming ends

##### previous
$previous_startDate = date('Y-m-d', strtotime('-7 days'));
$previous_endDate = date('Y-m-d', strtotime('+1 days'));
##### previous ends

$announcement_counts = Notification::where('notification_com_id', Auth::user()->com_id)
    ->where('notification_type', '=', 'Announcement')
    ->where('notification_status', '=', 'Unseen')
    ->where(function ($query) use ($previous_startDate, $previous_endDate) {
        $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
    })
    ->count();

$announcement_details = Notification::where('notification_com_id', Auth::user()->com_id)
    ->where('notification_type', '=', 'Announcement')
    ->where(function ($query) use ($previous_startDate, $previous_endDate) {
        $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
    })
    ->orderBy('id', 'DESC')
    ->get();

$notifications_counts = Notification::where('notification_com_id', Auth::user()->com_id)
    ->where('notification_to', Auth::user()->id)
    //->orWhere('notification_type','=','Announcement')
    ->where('notification_status', '=', 'Unseen')
    ->where(function ($query) use ($previous_startDate, $previous_endDate) {
        $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
    })
    ->count();

$notifications_to_details = Notification::where('notification_com_id', Auth::user()->com_id)
    ->where('notification_to', Auth::user()->id)
    ->where('notification_status', '=', 'Unseen')
    //->orWhere('notification_type','=','Announcement')
    ->where(function ($query) use ($previous_startDate, $previous_endDate) {
        $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
    })
    ->orderBy('id', 'DESC')
    ->get();

?>

<body>
    {{-- <div id="loader"></div> --}}

    <header class="header">
        <nav class="navbar"
            style="background: rgb(49,89,98);
                    background: linear-gradient(90deg, rgba(49,89,98,1) 0%, rgba(45,117,136,0.6895133053221288) 45%, rgba(149,182,155,0.989233193277311) 100%); ">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <a id="toggle-btn" href="#" class="menu-btn"> <i class="fa fa-align-left" aria-hidden="true"></i>
                    </a>
                    <span class="brand-big" id="site_logo_main"><img src="{{ asset('uploads/logos') }}/predictionit.png"
                            width="150">&nbsp;
                        &nbsp;</span>

                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                        <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip"
                                title="{{ __('Full Screen') }}"><i class="dripicons-expand"></i></a></li>
                        {{--
                        <li class="nav-item"><a href="{{route('zoom-meetings')}}"> <img style="width:40px;"
                                    src="{{asset('uploads/icons')}}/zoom.png" alt=""
                                    class="img-fluid shadow img-circle"> </a></li>
                        <li class="nav-item"><a href="{{url('/admin/user-activity')}}"> <img style="width:40px;"
                                    src="{{asset('uploads/icons')}}/21474371-removebg-preview.png" alt=""
                                    class="img-fluid shadow img-circle"> </a></li>
                        <li class="nav-item"><a href="{{route('chats')}}"> <img style="width:40px;"
                                    src="{{asset('uploads/icons')}}/chat.png" alt=""
                                    class="img-fluid shadow img-circle"> </a></li>
                        <li class="nav-item"><a href="{{route('prayer-and-lunch')}}"> <img style="width:40px;"
                                    src="{{asset('uploads/icons')}}/gratis-png-mezquita.png" alt=""
                                    class="img-fluid shadow img-circle"> </a></li>
                        --}}
                        <li class="nav-item">
                            <a rel="nofollow" id="notify-btn" href="#" class="nav-link dropdown-item"
                                data-toggle="tooltip" title="{{ __('Notifications') }}">
                                <i class="dripicons-bell"></i>

                                <span class="badge badge-danger">
                                    {{ $all_notifications = $notifications_counts + $announcement_counts }}
                                </span>

                            </a>
                            <ul class="right-sidebar">
                                <li class="header">
                                    <span class="pull-right"><a href="">{{ __('Clear All') }}</a></span>
                                    <span class="pull-left"><a href="">{{ __('See All') }}</a></span>
                                </li>

                                @foreach ($notifications_to_details as $notifications_details_value)
                                @if ($notifications_details_value->notification_status == 'Unseen')
                                @if ($notifications_details_value->notification_type == 'Leave')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('approve-leaves') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Award')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-award') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Complaint')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-complaint') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Warning')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-warning') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Termination')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-termination') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Leave-Approved')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('leave-details') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Leave-Request-Denied')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('leave-details') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Travel')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('travel') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Travel-Approved')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('travel-details') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Transfer')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('transfer-details') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Support')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('support-ticket') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Support-Updated')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('ticket-details') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @endif
                                @if ($notifications_details_value->notification_status == 'Seen')
                                @if ($notifications_details_value->notification_type == 'Leave')
                                <li><a href="{{ route('approve-leaves') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Leave-Approved')
                                <li><a href="{{ route('leave-details') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Award')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-award') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Complaint')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-complaint') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Warning')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-warning') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Termination')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('employee-termination') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif


                                @if ($notifications_details_value->notification_type == 'Leave-Request-Denied')
                                <li><a href="{{ route('leave-details') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Travel')
                                <li><a href="{{ route('travel') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Travel-Approved')
                                <li><a href="{{ route('travel-details') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Transfer')
                                <li><a href="{{ route('transfer-details') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif

                                @if ($notifications_details_value->notification_type == 'Approve Salary Sheet')
                                <li><a href="{{ route('/employee-salary-sheet-approves') }}"
                                        id="{{ $notifications_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif

                                @if ($notifications_details_value->notification_type == 'Support')
                                <li><a href="{{ route('support-ticket') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @if ($notifications_details_value->notification_type == 'Support-Updated')
                                <li><a href="{{ route('ticket-details') }}" id="{{ $notifications_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $notifications_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                    if (clicked_id) {
                                                        $.ajax({
                                                            url: '/get-seen/' + clicked_id,
                                                            type: "GET",
                                                            data: {
                                                                "_token": "{{ csrf_token() }}"
                                                            },
                                                            dataType: "json",
                                                        });
                                                    }
                                                }
                                </script>
                                @endif
                                @endif
                                @endforeach



                                @foreach ($announcement_details as $announcement_details_value)
                                @if ($announcement_details_value->notification_status == 'Unseen')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('announcement') }}"
                                        id="{{ $announcement_details_value->id }}" onClick="reply_click(this.id)">{{
                                        $announcement_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                if (clicked_id) {
                                                    $.ajax({
                                                        url: '/get-seen/' + clicked_id,
                                                        type: "GET",
                                                        data: {
                                                            "_token": "{{ csrf_token() }}"
                                                        },
                                                        dataType: "json",
                                                    });
                                                }
                                            }
                                </script>
                                @endif
                                @if ($announcement_details_value->notification_status == 'Seen')
                                <li><a href="{{ route('announcement') }}" id="{{ $announcement_details_value->id }}"
                                        onClick="reply_click(this.id)">{{
                                        $announcement_details_value->notification_title }}</a>
                                </li>
                                <script type="text/javascript">
                                    function reply_click(clicked_id) {
                                                if (clicked_id) {
                                                    $.ajax({
                                                        url: '/get-seen/' + clicked_id,
                                                        type: "GET",
                                                        data: {
                                                            "_token": "{{ csrf_token() }}"
                                                        },
                                                        dataType: "json",
                                                    });
                                                }
                                            }
                                </script>
                                @endif
                                @endforeach


                            </ul>
                        </li>

                        <li class="nav-item">
                            <a rel="nofollow" href="#" class="nav-link dropdown-item">

                                <img class="profile-photo sm mr-1" src="{{ asset(Auth::user()->profile_photo) }}">

                                <span> {{ Auth::user()->name }} </span>
                            </a>
                            <ul class="right-sidebar">
                                <li>
                                    <a href="">
                                        <i class="dripicons-user"></i>
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>


    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
                <ul id="side-main-menu" class="side-menu list-unstyled">

                    <li class="@if (request()->is('home')) {{ request()->is('home') ? 'active' : '' }} @endif">
                        <a href="{{ route('home') }}" style="color:black;">
                            <div class="CheckStyle"> <span>Dashboard</span></div>
                        </a>
                    </li>
                    <li
                        class="@if (request()->is('employee-profile')) {{ request()->is('employee-profile') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-profiles') }}">
                            <div class="CheckStyle"> <span>Profile</span></div>
                        </a>
                    </li>
                    <li class="has-dropdown @if (request()->is('employee-basic-info*')) {{ request()->is('employee-basic-info*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-immigration*')){{ request()->is('employee-immigration*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-emergency-contact*')){{ request()->is('employee-emergency-contact*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-social-profile*')){{ request()->is('employee-social-profile*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-document*')){{ request()->is('employee-document*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-qualification*')){{ request()->is('employee-qualification*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-work-experience*')){{ request()->is('employee-work-experience*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-bank-account*')){{ request()->is('employee-bank-account*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-pf-bank-account*')){{ request()->is('employee-pf-bank-account*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-password-change')){{ request()->is('employee-password-change') ? 'active' : '' }}
                                                @elseif(request()->is('employee-detail/*')){{ request()->is('employee-detail/*') ? 'active' : '' }}
                                                @elseif(request()->is('profile-detail')){{ request()->is('profile-detail') ? 'active' : '' }}
                                                @elseif(request()->is('noc-approval-index')){{ request()->is('noc-approval-index') ? 'active' : '' }}
                                                @endif">
                        <a href="#General" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <span>General</span></div>
                        </a>
                        <ul id="General" class="collapse list-unstyled">

                            <li><a href="{{ route('employee-basic-infos') }}" id="general-dropdown">Basic
                                    Information</a>
                            </li>
                            <li><a href="{{ route('employee-signature') }}" id="general-dropdown">Signature
                                    Upload</a>
                            </li>
                            <li><a href="{{ route('employee-immigrations') }}" id="general-dropdown">Immigration</a>
                            </li>
                            <li><a href="{{ route('employee-emergency-contacts') }}" id="general-dropdown">Emergency
                                    Contacts</a></li>
                            <li><a href="{{ route('employee-social-profiles') }}" id="general-dropdown">Social
                                    Profile</a>
                            </li>
                            <li><a href="{{ route('employee-documents') }}" id="general-dropdown">Document</a></li>
                            <li><a href="{{ route('employee-qualifications') }}" id="general-dropdown">Qualification</a>
                            </li>
                            <li><a href="{{ route('employee-work-experiences') }}" id="general-dropdown">Work
                                    Experience</a></li>
                            <li><a href="{{ route('employee-bank-accounts') }}" id="general-dropdown">Salary Bank
                                    Account</a></li>
                            <li><a href="{{ route('employee-password-changes') }}" id="general-dropdown">Change
                                    Password</a></li>
                            {{-- @if (Auth::user()->company_profile == 'Yes') --}}
                            {{-- <li><a href="{{route('employee-pf-bank-accounts')}}" id="general-dropdown">Provident
                                    Fund Bank Account</a></li> --}}
                            @if ($appointment_letter_format_id)
                            <li><a href="{{ route('appointment-letter-downloads') }}" id="general-dropdown">Appointment
                                    Letter</a></li>
                            @endif
                            @if ($noc_id)
                            <li><a href="{{ route('noc-approval-index') }}" id="general-dropdown"> {{ 'NOC (Non
                                    Objection Certificate)' }}
                                </a></li>
                            @endif

                            <li><a href="{{ route('employee-personal-details-download') }}" id="general-dropdown"> {{
                                    'Personal Details Download' }}
                                </a></li>
                            <li><a href="{{ route('employee-experience-template-download') }}" id="general-dropdown"> {{
                                    'Experience Letter Download' }}
                                </a></li>

                            <li><a href="{{ route('employee-id-card-downloads') }}" target="_blank"
                                    id="general-dropdown">Download ID Card</a></li>
                            {{-- @if (Auth::user()->company_profile == 'Yes' || Auth::user()->admin_status == 'Yes' ||
                            Auth::user()->admin_status == 1)
                            <li><a href="{{ route('employee-experience-letters') }}" target="_blank"
                                    id="general-dropdown"> Download Experience Certifecate</a></li>
                            @endif --}}
                            {{--
                            @if (Auth::user()->company_profile == 'Yes' || Auth::user()->admin_status == 'Yes' ||
                            Auth::user()->admin_status == 1)
                            @if ($warning_letter_format_id)
                            <li><a href="{{ route('warning-letter-downloads') }}" target="_blank"
                                    id="general-dropdown">Download Warning Letter</a>
                            </li>
                            @endif
                            @endif --}}

                            @if (Auth::user()->company_profile == 'Yes' || Auth::user()->admin_status == 'Yes' ||
                            Auth::user()->admin_status == 1)
                            @if ($probation_letter_format_id)
                            <li><a href="{{ route('probation-letter-downloads') }}" target="_blank"
                                    id="general-dropdown">Download Probation Letter</a>
                            </li>
                            @endif
                            @endif

                            @if ($salary_certificate_format_id)
                            <li><a href="{{ route('salary-certificate-downloads') }}" id="general-dropdown"> {{
                                    'Salary Certificates' }}
                                </a></li>
                            @endif
                            {{-- @endif --}}

                        </ul>
                    </li>
                    <li
                        class="has-dropdown @if (request()->is('employee-total-salary*')) {{ request()->is('employee-total-salary*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-hourly-total-salary*')){{ request()->is('employee-hourly-total-salary*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-allowance*')){{ request()->is('employee-allowance*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-commission*')){{ request()->is('employee-commission*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-loan*')){{ request()->is('employee-loan*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-statutory-deduction')){{ request()->is('employee-statutory-deduction*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-other-payment*')){{ request()->is('employee-other-payment*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-over-time*')){{ request()->is('employee-over-time*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-pension*')){{ request()->is('employee-pension*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-mobile-bill')){{ request()->is('employee-mobile-bill') ? 'active' : '' }}
                                                @elseif(request()->is('employee-lunch-bill')){{ request()->is('employee-lunch-bill') ? 'active' : '' }}
                                                @elseif(request()->is('employee-transport-allowance')){{ request()->is('employee-transport-allowance') ? 'active' : '' }}
                                                @elseif(request()->is('employee-salary-history')){{ request()->is('employee-salary-history') ? 'active' : '' }} @endif">
                        <a href="#Salary" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <span>Salary</span></div>
                        </a>
                        <ul id="Salary" class="collapse list-unstyled">

                            @if (User::where('id', '=', Session::get('employee_setup_id'))->where('salary_type',
                            'Monthly')->exists())
                            <li><a href="{{ route('employee-total-salaries') }}" id="general-dropdown">Monthly
                                    Total
                                    Salary</a></li>
                            @endif
                            @if (User::where('id', '=', Session::get('employee_setup_id'))->where('salary_type',
                            'Hourly')->exists())
                            <li><a href="{{ route('employee-hourly-total-salaries') }}" id="general-dropdown">Hourly
                                    Total
                                    Salary</a></li>
                            @endif
                            {{-- <li><a href="{{ route('employee-salary-remunarations') }}" id="general-dropdown">Salary
                                    Remuneration

                                </a></li> --}}

                            <li><a href="{{ route('employee-salary-histories') }}" id="general-dropdown">Salary
                                    Increment
                                    History
                                </a></li>
                            {{-- <li><a href="{{route('company-organograms')}}" id="general-dropdown">Basic Salary</a>
                            </li> --}}
                            <li><a href="{{ route('employee-allowances') }}" id="general-dropdown">Allowances</a>
                            </li>
                            <li><a href="{{ route('employee-commissions') }}" id="general-dropdown">Commissions</a>
                            </li>
                            <li><a href="{{ route('employee-loans') }}" id="general-dropdown">Loan</a></li>
                            <li><a href="{{ route('employee-statutory-deductions') }}" id="general-dropdown">Statutory
                                    Deductions</a></li>
                            <li><a href="{{ route('employee-other-payments') }}" id="general-dropdown">Other
                                    Payment</a>
                            </li>
                            <li><a href="{{ route('employee-over-times') }}" id="general-dropdown">Overtime</a></li>
                            <li><a href="{{ route('employee-pensions') }}" id="general-dropdown">Salary Pension</a>
                            </li>
                            <li><a href="{{ route('employee-mobile-bills') }}" id="general-dropdown">Mobile Bill</a>
                            </li>
                            <li><a href="{{ route('employee-lunch-bills') }}" id="general-dropdown">Lunch Bill</a>
                            </li>
                            <li><a href="{{ route('employee-transport-allowances') }}" id="general-dropdown">TA/DA</a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="has-dropdown @if (request()->is('employee-award*')) {{ request()->is('employee-award*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-travel*')){{ request()->is('employee-travel*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-transfer*')){{ request()->is('employee-transfer*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-promotion*')){{ request()->is('employee-promotion*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-complaint*')){{ request()->is('employee-complaint*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-warning*')){{ request()->is('employee-warning*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-termination*')){{ request()->is('employee-termination*') ? 'active' : '' }}
                                                @elseif(request()->is('department*')){{ request()->is('department*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-resignation*')){{ request()->is('employee-resignation*') ? 'active' : '' }} @endif">
                        <a href="#Core" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <span>Core HR</span></div>
                        </a>
                        <ul id="Core" class="collapse list-unstyled">
                            <li><a href="{{ route('employee-award') }}" id="general-dropdown">Award</a></li>
                            <li><a href="{{ route('employee-travel') }}" id="general-dropdown">Travel</a></li>
                            <li><a href="{{ route('employee-training') }}" id="general-dropdown">Training</a></li>
                            <li><a href="{{ route('employee-transfer') }}" id="general-dropdown">Transfer</a></li>
                            <li><a href="{{ route('employee-resignation') }}" id="general-dropdown">Resignation</a>
                            </li>
                            <li><a href="{{ route('employee-termination') }}" id="general-dropdown">Termination</a>
                            </li>
                            <li><a href="{{ route('employee-promotion') }}" id="general-dropdown">Promotion</a></li>
                            <li><a href="{{ route('employee-complaint') }}" id="general-dropdown">Complaint</a></li>
                            <li><a href="{{ route('employee-warning') }}" id="general-dropdown">Warning</a></li>

                        </ul>
                    </li>

                    <li
                        class="has-dropdown @if (request()->is('employee-objective*')) {{ request()->is('employee-objective*') ? 'active' : '' }}
                                                                    @elseif(request()->is('employees-performance-review*')){{ request()->is('employees-performance-review*') ? 'active' : '' }}
                                                                    @elseif(request()->is('employee-result')){{ request()->is('employee-result') ? 'active' : '' }}
                                                                    @elseif(request()->is('employee-value*')){{ request()->is('employee-value*') ? 'active' : '' }} @endif">
                        <a href="#performance" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <span>Perforamnce</span></div>
                        </a>
                        <ul id="performance" class="collapse list-unstyled">

                            @if (ObjectiveTypeConfig::where('obj_config_com_id',
                            Auth::user()->com_id)->where('obj_config_desig_id', $user_desg)->exists() )
                            <li><a href="{{ route('employee-objectives') }}" id="general-dropdown">Employees
                                    Objectives</a></li>

                            @endif

                            @if (Objective::where('objective_com_id', Auth::user()->com_id)->where('objective_emp_id',
                            $user_id)->exists())
                            <li><a href="{{ route('employee-performance-review') }}" id="general-dropdown">Yearly
                                    Performance Review
                                </a></li>
                            @endif

                            @if (ValueTypeDetail::where('value_type_detail_com_id', Auth::user()->com_id)->exists())
                            <li><a href="{{ route('employee-values') }}" id="general-dropdown">Yearly Value
                                    Review </a>
                            </li>
                            @endif

                            {{-- <li><a href="{{route('employee-results')}}" id="general-dropdown">Result</a></li> --}}
                        </ul>
                    </li>

                    <li
                        class="@if (request()->is('employee-leave')) {{ request()->is('employee-leave') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-leaves') }}">
                            <div class="CheckStyle"> <span>Leave</span></div>
                        </a>
                    </li>
                    <li
                        class="@if (request()->is('employee-support-tickets')) {{ request()->is('employee-support-tickets') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-support-ticket') }}">
                            <div class="CheckStyle"> <span>Support Ticket</span></div>
                        </a>
                    </li>
                    @if (Auth::user()->company_profile == 'Yes' || Auth::user()->userrole->roles_admin_status == 'Yes')
                    <li
                        class="@if (request()->is('employee-report-to-config')) {{ request()->is('employee-report-to-config') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-report-to-configs') }}">
                            <div class="CheckStyle"> <span>Supervisor Setup</span></div>
                        </a>
                    </li>
                    <li
                        class="@if (request()->is('employee-pf-config')) {{ request()->is('employee-pf-config') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-pf-configs') }}">
                            <div class="CheckStyle"> <span>PF Configure</span></div>
                        </a>
                    </li>
                    @endif

                    <li
                        class="@if (request()->is('employee-project')) {{ request()->is('employee-project') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-projects') }}">
                            <div class="CheckStyle"> <span>Project</span></div>
                        </a>
                    </li>

                    <li
                        class="@if (request()->is('employee-event')) {{ request()->is('employee-event') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-events') }}">
                            <div class="CheckStyle"> <span>Events</span></div>
                        </a>
                    </li>

                    <li
                        class="@if (request()->is('employee-meeting')) {{ request()->is('employee-meeting') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-meetings') }}">
                            <div class="CheckStyle"> <span>Meetings</span></div>
                        </a>
                    </li>

                    <li
                        class="@if (request()->is('employee-task')) {{ request()->is('employee-task') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-tasks') }}">
                            <div class="CheckStyle"> <span>Task</span></div>
                        </a>
                    </li>

                    <li
                        class="@if (request()->is('employee-pay-slip')) {{ request()->is('employee-pay-slip') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-pay-slips') }}">
                            <div class="CheckStyle"> <span>Pay Slip</span></div>
                        </a>
                    </li>

                    <li
                        class="@if (request()->is('tax-accountable')) {{ request()->is('tax-accountable') ? 'active' : '' }} @endif">
                        <a href="{{ route('tax-accountables') }}">
                            <div class="CheckStyle"> <span>Tax Accountable</span></div>
                        </a>
                    </li>



                    @if ($userId)
                    <li class="@if (request()->is('employee-salary-sheet-approve')) {{ request()->is('employee-salary-sheet-approve') ? 'active' : '' }} @endif">
                        <a href="{{ route('employee-salary-sheet-approves') }}">
                            <div class="CheckStyle"> <span>Approve Salary Sheet</span></div>
                        </a>
                    </li>
                @endif


                </ul>
            </div>
        </div>
    </nav>

    <?php

    $setting_user_details = User::where('id', '=', Session::get('employee_setup_id'))->get(['first_name', 'last_name']);
    ?>
    <!-- @foreach ($setting_user_details as $setting_user_details)
<div class="text-center card">
        <div class="card-header with-border">
            <h2>{{ $setting_user_details->first_name }} {{ $setting_user_details->last_name }}</h2>
        </div>
    </div>
@endforeach -->

    <div id="content" class="page animate-bottom d-none">
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="container-fluid">
            <p>
                &copy; | {{ __('Developed by') }}
                <a href="https://www.predictionit.com" class="external">{{ __('Prediction IT') }}</a>
            </p>
        </div>
    </footer>


</body>

</html>
