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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/vendor/datatable/datatables.flexheader.boostrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('/css/style.default.css') }}" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
    {{--
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> --}}


    {{--



    @if (request()->is('admin/dashboard*') || request()->is('calendar*'))
    @include('calendarable.css')
    @endif
    --}}
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.js') }}">
    </script>

    <script type="text/javascript" src="{{ asset('/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/charts-custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/knockout-3.4.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    @include('back-end.premium.partials.customScripts')

</head>

<?php
use App\Models\Package;
use App\Models\Permission;
use App\Models\Locatoincustomize;
$locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();

$user_module = '1';
$user_sub_module_one = '1.1';
$user_sub_module_two = '1.2';
$user_sub_module_three = '1.3';

$employee_module = '2';
$employee_sub_module_one = '2.1';
$employee_sub_module_two = '2.2';

$customize_module = '3';
$customize_sub_module_one = '3.1';
$customize_sub_module_two = '3.2';
$customize_sub_module_three = '3.3';
$customize_sub_module_four = '3.4';
$customize_sub_module_five = '3.5';
$customize_sub_module_six = '3.6';
$customize_sub_module_eight = '3.8';
$customize_sub_module_nine = '3.9';
$customize_sub_module_ten = '3.10';
$customize_sub_module_eleven = '3.11';

$customize_sub_module_fourteen = '3.14';
$customize_sub_module_fifteen = '3.15';
$customize_sub_module_sixteen = '3.16';
$customize_sub_module_seventeen = '3.17';
$customize_sub_module_tweenty_two = '3.22';
$customize_sub_module_tweenty_three = '3.23';
$customize_sub_module_tweenty_four = '3.24';
$customize_sub_module_tweenty_five = '3.25';
$customize_sub_module_tweenty_six = '3.26';
$customize_sub_module_tweenty_seven = '3.27';
$customize_sub_module_tweenty_eight = '3.28';

$core_hr_module = '4';
$core_hr_sub_module_one = '4.1';
$core_hr_sub_module_two = '4.2';
$core_hr_sub_module_three = '4.3';
$core_hr_sub_module_four = '4.4';
$core_hr_sub_module_five = '4.5';
$core_hr_sub_module_six = '4.6';
$core_hr_sub_module_seven = '4.7';
$core_hr_sub_module_eight = '4.8';
$core_hr_sub_module_nine = '4.9';
$core_hr_sub_module_ten = '4.10';
$core_hr_sub_module_eleven = '4.11';
$core_hr_sub_module_twelve = '4.12';
$core_hr_sub_module_thirteen = '4.13';
$core_hr_sub_module_fourteen = '4.14';
$core_hr_sub_module_fifteen = '4.15';
$core_hr_sub_module_sixteen = '4.16';

$template_module = '18';
$template_sub_module_one = '18.1';
$template_sub_module_two = '18.2';
$template_sub_module_three = '18.3';
$template_sub_module_four = '18.4';
$template_sub_module_five = '18.5';
$template_sub_module_six = '18.6';
$template_sub_module_seven = '18.7';
$template_sub_module_eight = '18.8';
$template_sub_module_nine = '18.9';
$template_sub_module_ten = '18.10';
$template_sub_module_eleven = '18.11';

$organization_module = '5';
$organization_sub_module_one = '5.1';
$organization_sub_module_two = '5.2';
$organization_sub_module_three = '5.3';
$organization_sub_module_four = '5.4';
$organization_sub_module_five = '5.5';
$organization_sub_module_six = '5.6';
$organization_sub_module_seven = '5.7';
$organization_sub_module_eight = '5.8';
$organization_sub_module_twentytwo = '5.22';

$organization_sub_module_twelve = '5.12';
$organization_sub_module_thirteen = '5.13';
$organization_sub_module_fourteen = '5.14';
$organization_sub_module_fifteen = '5.15';
$organization_sub_module_sixteen = '5.16';
$organization_sub_module_seventeen = '5.17';
$organization_sub_module_eighteen = '5.18';
$organization_sub_module_nineteen = '5.19';
$organization_sub_module_twenty = '5.20';
$organization_sub_module_twentyone = '5.21';

$organization_sub_module_twenthree = '5.23';

$organization_sub_module_twentyfour = '5.24';

$organization_sub_module_nine = '5.9';
$organization_sub_module_ten = '5.10';
$organization_sub_module_eleven = '5.11';

$time_sheet_module = '6';
$time_sheet_sub_module_one = '6.1';
$time_sheet_sub_module_two = '6.2';
$time_sheet_sub_module_three = '6.3';
$time_sheet_sub_module_four = '6.4';
$time_sheet_sub_module_five = '6.5';
$time_sheet_sub_module_six = '6.6';
$time_sheet_sub_module_seven = '6.7';
$time_sheet_sub_module_eight = '6.8';
$time_sheet_sub_module_nine = '6.9';
$time_sheet_sub_module_ten = '6.10';
$time_sheet_sub_module_eleven = '6.11';

$payroll_module = '7';
$payroll_sub_module_one = '7.1';
$payroll_sub_module_two = '7.2';
$payroll_sub_module_three = '7.3';
$payroll_sub_module_four = '7.4';
$payroll_sub_module_five = '7.5';

$hr_calander_module = '8';

$hr_report_module = '9';
$hr_report_sub_module_one = '9.1';
$hr_report_sub_module_two = '9.2';
$hr_report_sub_module_three = '9.3';
$hr_report_sub_module_four = '9.4';
$hr_report_sub_module_five = '9.5';
$hr_report_sub_module_six = '9.6';
$hr_report_sub_module_seven = '9.7';
$hr_report_sub_module_eight = '9.8';
$hr_report_sub_module_nine = '9.9';
$hr_report_sub_module_ten = '9.10';
$hr_report_sub_module_eleven = '9.11';
$hr_report_sub_module_twelve = '9.12';
$hr_report_sub_module_thirteen = '9.13';
$hr_report_sub_module_fourteen = '9.14';
$hr_report_sub_module_fifteen = '9.15';
$hr_report_sub_module_sixteen = '9.16';
$hr_report_sub_module_seventeen = '9.17';
$event_and_meeting_module = '10';
$event_and_meeting_sub_module_one = '10.1';
$event_and_meeting_sub_module_two = '10.2';

$project_management_module = '11';
$project_management_sub_module_one = '11.1';
$project_management_sub_module_two = '11.2';

$support_ticket_module = '12';

$assets_module = '13';
$assets_sub_module_one = '13.1';
$assets_sub_module_two = '13.2';

$file_manager_module = '14';
$file_manager_sub_module_one = '14.1';
$file_manager_sub_module_two = '14.2';
$file_manager_sub_module_three = '14.3';

$performance_module = '15';
$performance_sub_module_one = '15.1';
$performance_sub_module_two = '15.2';
$performance_sub_module_three = '15.3';
$performance_sub_module_four = '15.4';
$performance_sub_module_five = '15.5';
$performance_sub_module_six = '15.6';
$performance_sub_module_seven = '15.7';
$performance_sub_module_eight = '15.8';
$performance_sub_module_nine = '15.9';
$performance_sub_module_ten = '15.10';
$performance_sub_module_eleven = '15.11';
$performance_sub_module_twelve = '15.12';
$performance_sub_module_tharteen = '15.13';

$recruitment_module = '16';
$recruitment_sub_module_one = '16.1';
$recruitment_sub_module_two = '16.2';
$recruitment_sub_module_three = '16.3';

$training_module = '17';
$training_sub_module_one = '17.1';
$training_sub_module_two = '17.2';
$training_sub_module_three = '17.3';

$probation_module = '19';
$core_probation_sub_module_one = '19.1';
$core_probation_sub_module_two = '19.2';

$finger_print_module = '20';
$finger_print_sub_module_one = "20.1";
$finger_print_sub_module_two = "20.2";
$finger_print_sub_module_three = "20.3";
$finger_print_sub_module_four = "20.4";
$finger_print_sub_module_five = "20.5";
$finger_print_sub_module_six = "20.6";

?>
<?php
foreach ($locations as $location) {
    $location1 = $location->location1 ?? 'Location1';
    $location2 = $location->location2 ?? 'Location2';
    $location3 = $location->location3 ?? 'Location3';
    $location4 = $location->location4 ?? 'Location4';
    $location5 = $location->location5 ?? 'Location5';
    $location6 = $location->location6 ?? 'Location6';
    $location7 = $location->location7 ?? 'Location7';
    $location8 = $location->location8 ?? 'Location8';
    $location9 = $location->location9 ?? 'Location9';
    $location10 = $location->location10 ?? 'Location10';
    $location11 = $location->location11 ?? 'Location11';
}
?>
<?php

// use App\Models\Award;
// use App\Models\PaySlip;
// use App\Models\Leave;
// use App\Models\Travel;
// use App\Models\Transfer;
// use App\Models\Announcement;
use App\Models\Notification;

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
    ->orWhere('report_admin_id', Auth::user()->id)
    ->where('notification_status', '=', 'Unseen')
    ->where(function ($query) use ($previous_startDate, $previous_endDate) {
        $query->whereBetween('created_at', [$previous_startDate, $previous_endDate])->orWhereBetween('updated_at', [$previous_startDate, $previous_endDate]);
    })
    ->count();

$notifications_to_details = Notification::where('notification_com_id', Auth::user()->com_id)
    ->where('notification_to', Auth::user()->id)
    ->orWhere('report_admin_id', Auth::user()->id)

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

                        <li class="nav-item">
                            <a id="btnFullscreen" data-toggle="tooltip" title="{{ __('Full Screen') }}">
                                <i class="dripicons-expand"></i>
                            </a>
                        </li>

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
                                    <span class="pull-right"><a
                                            href="{{ route('clear-all', ['id' => Auth::user()->id]) }}">{{ __('Clear
                                            All') }}</a></span>
                                    <span class="pull-left"><a
                                            href="{{ route('see-all', ['id' => Auth::user()->id]) }}">{{ __('See
                                            All') }}</a></span>
                                </li>

                                @foreach ($notifications_to_details as $notifications_details_value)
                                {{-- notification type unseen --}}
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
                                @if ($notifications_details_value->notification_type == 'NOC')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('noc-approval-index') }}"
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
                                @if ($notifications_details_value->notification_type == 'Warning')
                                <li><a href="{{ route('employee-warning') }}"
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
                                @if ($notifications_details_value->notification_type == 'Objective-Review')
                                <li><a href="{{ route('employee-objectives') }}"
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
                                @if ($notifications_details_value->notification_type == 'Development-Plan')
                                <li><a href="{{ route('employee-objectives') }}"
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




                                @if ($notifications_details_value->notification_type == 'Employee-Objective-Comments')
                                <li><a href="{{ route('employee-objectives') }}"
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

                                @if ($notifications_details_value->notification_type == 'Probation Recomenation')
                                <li><a href="{{ route('recommendation-employees') }}"
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
                                @if ($notifications_details_value->notification_type == 'Supervisor Recomenation')
                                <li><a href="{{ route('recommendation-employees') }}"
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

                                @if ($notifications_details_value->notification_type == 'Probation')
                                <li><a href="{{ route('probation-employees') }}"
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



                                @if ($notifications_details_value->notification_type == 'Salary-Increment')
                                <li><a href="{{ route('employee-salary-histories') }}"
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

                                {{-- notification type seen --}}

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
                                @if ($notifications_details_value->notification_type == 'NOC')
                                <li style="background-color:#e2f1ebe8;"><a href="{{ route('noc-approval-index') }}"
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


                                @if ($notifications_details_value->notification_type == 'Objective-Review')
                                <li><a href="{{ route('employee-objectives') }}"
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

                                @if ($notifications_details_value->notification_type == 'Development-Plan')
                                <li><a href="{{ route('employee-objectives') }}"
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
                                @if ($notifications_details_value->notification_type == 'Salary-Increment')
                                <li><a href="{{ route('employee-salary-histories') }}"
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
                                @if (Auth::user()->company_profile == 'Yes')
                                <li>
                                    <a href="{{ route('companies') }}">
                                        <i class="dripicons-user"></i>
                                        Profile
                                    </a>
                                </li>
                                @else
                                <li>
                                    <a href="{{ route('profile-details') }}">
                                        <i class="dripicons-user"></i>
                                        Profile
                                    </a>
                                </li>
                                @endif

                                <li><a href="{{ route('password-changes') }}" id="general-dropdown">Change
                                        Password</a>
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


    <nav class="side-navbar" style="background:#e8f0e8;">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
                <ul id="side-main-menu" class="side-menu list-unstyled">

                    <li class="@if (request()->is('home')) {{ request()->is('home') ? 'active' : '' }} @endif">
                        <a href="{{ route('home') }}">
                            <div class="CheckStyle"><i style="color:white;"
                                    class="dripicons-meter"></i><span>Dashboard</span></div>
                        </a>
                    </li>


                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $customize_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $customize_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li class="has-dropdown @if (request()->is('role*')) {{ request()->is('role*') ? 'active' : '' }}
                                                @elseif(request()->is('general-setting*')){{ request()->is('general-setting*') ? 'active' : '' }}
                                                @elseif(request()->is('mail-setting*')){{ request()->is('mail-setting*') ? 'active' : '' }}
                                                @elseif(request()->is('language-setting*')){{ request()->is('language-setting*') ? 'active' : '' }}
                                                @elseif(request()->is('variable-type*')){{ request()->is('variable-type*') ? 'active' : '' }}
                                                @elseif(request()->is('variable-method*')){{ request()->is('variable-method*') ? 'active' : '' }}
                                                @elseif(request()->is('upazila*')){{ request()->is('upazila*') ? 'active' : '' }}
                                                @elseif(request()->is('union*')){{ request()->is('union*') ? 'active' : '' }}
                                                @elseif(request()->is('ip-setting*')){{ request()->is('ip-setting*') ? 'active' : '' }}
                                                @elseif(request()->is('tax-config*')){{ request()->is('tax-config*') ? 'active' : '' }}
                                                @elseif(request()->is('salary-config*')){{ request()->is('salary-config*') ? 'active' : '' }}
                                                @elseif(request()->is('salary-componen*')){{ request()->is('salary-componen*') ? 'active' : '' }}
                                                @elseif(request()->is('festival-month*')){{ request()->is('festival-month*') ? 'active' : '' }}
                                                @elseif(request()->is('company-pf-config*')){{ request()->is('company-pf-config*') ? 'active' : '' }}
                                                @elseif(request()->is('company-bank-account*')){{ request()->is('company-bank-account*') ? 'active' : '' }}
                                                @elseif(request()->is('communication-company-bank-account*')){{ request()->is('communication-company-bank-account*') ? 'active' : '' }}
                                                @elseif(request()->is('festival-config')){{ request()->is('festival-config') ? 'active' : '' }}
                                                @elseif(request()->is('minimum-tax-config')){{ request()->is('minimum-tax-config') ? 'active' : '' }}
                                                @elseif(request()->is('late-time-salary-config')){{ request()->is('late-time-salary-config') ? 'active' : '' }}
                                                @elseif(request()->is('minimum-house-rent-non-taxable')){{ request()->is('minimum-house-rent-non-taxable') ? 'active' : '' }}
                                                @elseif(request()->is('minimum-medical-allowance-non-taxable')){{ request()->is('minimum-medical-allowance-non-taxable') ? 'active' : '' }}
                                                @elseif(request()->is('minimum-conveyance-allowance-non-taxable')){{ request()->is('minimum-conveyance-allowance-non-taxable') ? 'active' : '' }}
                                                @endif">

                        <a href="#Customize_settings" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle">
                                <i style="color:white;" class="dripicons-toggles"></i><span>{{ __('Common Settings')
                                    }}</span>
                            </div>
                        </a>
                        <ul id="Customize_settings" class="collapse list-unstyled ">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="roles"><a href="{{ route('roles') }}" id="all-dropdown">{{ __('Roles and Access')
                                    }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="variable_type"><a href="{{ route('variable-type') }}" id="all-dropdown">{{
                                    __('Variable
                                    Type') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="variable_method"><a href="{{ route('variable-method') }}" id="all-dropdown">{{
                                    __('Variable Method') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_fourteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_fourteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="upazila"><a href="{{ route('upazila') }}" id="all-dropdown">{{ __('Upazila') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_fifteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_fifteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="union"><a href="{{ route('union') }}" id="all-dropdown">{{ __('Union') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('salary-configs') }}" id="all-dropdown">{{ __('Salary
                                    Configure') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('late-time-salary-configs') }}" id="all-dropdown">{{
                                    __('Late Time Salary Configure') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('festival-months') }}" id="all-dropdown">{{
                                    __('Festival
                                    Month Configure') }}</a>
                            </li>
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('festival-configs') }}" id="all-dropdown">{{
                                    __('Festival Bonus Configure') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('yearly-festival-bonus-configs') }}" id="all-dropdown">{{
                                    __('Yearly Festival Bonus Configure') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('minimum-tax-configs') }}" id="all-dropdown">{{
                                    __('Mininum
                                    Tax
                                    Configure') }}</a>
                            </li>
                            @endif
                            @endif

                            {{-- <li id="ip_setting"><a href="{{route('ip-settings')}}">{{__('IP Settings')}}</a></li>
                            --}}
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('tax-configs') }}" id="all-dropdown">{{ __('Tax
                                    Configure') }}</a>
                            </li>
                            @endif
                            @endif

                            {{-- <li id="ip_setting"><a href="{{route('salary-components')}}">{{__('Salary
                                    Component')}}</a></li> --}}

                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('minimum-house-rent-non-taxables') }}"
                                    id="all-dropdown">{{
                                    __('Minimum House Rent Non Taxable
                                    Configure') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('minimum-medical-allowance-non-taxables') }}"
                                    id="all-dropdown">{{
                                    __('Minimum Medical Allowance Non Taxable
                                    Configure') }}</a></li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_tweenty_seven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_tweenty_seven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('minimum-conveyance-allowance-non-taxables') }}"
                                    id="all-dropdown">{{
                                    __('Minimum Conveyance Allowance Non
                                    Taxable Configure') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('company-pf-configs') }}" id="all-dropdown">{{
                                    __('Company PF Configure') }}</a></li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_sixteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_sixteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('company-bank-accounts') }}" id="all-dropdown">{{
                                    __('Company Bank Account') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_seventeen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_seventeen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('communication-company-bank-accounts') }}"
                                    id="all-dropdown">{{ __('Communication Company Bank Account') }}</a>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </li>
                    @endif
                    @endif


                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                        'json_contains(package_module,
                        \'["' .
                        $organization_module .
                        '"]\')')->exists())
                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                        '=', Auth::user()->role_id)->whereRaw(
                        'json_contains(permission_content,
                        \'["' .
                        $organization_module .
                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                        <li
                            class="has-dropdown @if (request()->is('company-organogram')) {{ request()->is('company-organogram') ? 'active' : '' }}
                                                    @elseif(request()->is('group-of-company-list')){{ request()->is('group-of-company-list') ? 'active' : '' }}
                                                    @elseif(request()->is('company')){{ request()->is('company') ? 'active' : '' }}
                                                    @elseif(request()->is('department')){{ request()->is('department') ? 'active' : '' }}
                                                    @elseif(request()->is('allowance*')){{ request()->is('allowance*') ? 'active' : '' }}
                                                    @elseif(request()->is('region*')){{ request()->is('region*') ? 'active' : '' }}
                                                    @elseif(request()->is('area*')){{ request()->is('area*') ? 'active' : '' }}
                                                    @elseif(request()->is('territory*')){{ request()->is('territory*') ? 'active' : '' }}
                                                    @elseif(request()->is('town*')){{ request()->is('town*') ? 'active' : '' }}
                                                    @elseif(request()->is('db-house*')){{ request()->is('db-house*') ? 'active' : '' }}
                                                    @elseif(request()->is('location-six*')){{ request()->is('location-six*') ? 'active' : '' }}
                                                    @elseif(request()->is('location-seven*')){{ request()->is('location-seven*') ? 'active' : '' }}
                                                    @elseif(request()->is('location-eight*')){{ request()->is('location-eight*') ? 'active' : '' }}
                                                    @elseif(request()->is('location-nine*')){{ request()->is('location-nine*') ? 'active' : '' }}
                                                    @elseif(request()->is('location-ten*')){{ request()->is('location-ten*') ? 'active' : '' }}
                                                    @elseif(request()->is('location-eleven*')){{ request()->is('location-eleven*') ? 'active' : '' }}
                                                    @elseif(request()->is('designation*')){{ request()->is('designation*') ? 'active' : '' }}
                                                    @elseif(request()->is('announcement*')){{ request()->is('announcement*') ? 'active' : '' }}
                                                    @elseif(request()->is('company-policies')){{ request()->is('company-policies') ? 'active' : '' }}
                                                    @elseif(request()->is('organization-configaration')){{ request()->is('organization-configaration') ? 'active' : '' }}
                                                    @elseif(request()->is('lunch-bills')){{ request()->is('lunch-bills') ? 'active' : '' }}
                                                    @elseif(request()->is('man-power-setup')){{ request()->is('man-power-setup') ? 'active' : '' }} @endif">
                            <a href="#Organization" aria-expanded="false" data-toggle="collapse">
                                <div class="CheckStyle">
                                    <i style="color:white;" class="dripicons-view-thumb"></i><span>Organization</span>
                                </div>
                            </a>
                            <ul id="Organization" class="collapse list-unstyled">


                                @if (Auth::user()->group_com_status == 'Yes')
                                    <li><a href="{{ route('group-of-company-lists') }}" id="all-dropdown">Company Wings</a> </li>
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_one .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_one .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('companies') }}" id="all-dropdown">Company</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                    'json_contains(package_module,
                                    \'["' .
                                    $organization_sub_module_twenthree .
                                    '"]\')')->exists())
                                    @if (Permission::where('permission_com_id', '=',
                                    Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                    'json_contains(permission_content,
                                    \'["' .
                                    $organization_sub_module_twenthree .
                                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                    <li><a href="{{ route('man-power') }}" id="all-dropdown">Man Power
                                            Configurations</a>
                                    </li>
                                    @endif
                                    @endif

                                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_two .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_two .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <li><a href="{{ route('departments') }}" id="all-dropdown">Department</a></li>
                                        @endif
                                        @endif

                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_nine .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_nine .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <li><a href="{{ route('designations') }}" id="all-dropdown">Designation</a></li>
                                        @endif
                                        @endif


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_twentytwo .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_twentytwo .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('organization-configarations') }}" id="all-dropdown">Organization
                                        Configurations</a>
                                </li>
                                @endif
                                @endif

                                <li><a href="{{ route('company-organograms') }}" id="all-dropdown">Company
                                    Organogram</a>
                                </li>


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_three .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_three .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('allowance-heads') }}" id="all-dropdown">Allowance
                                        Head</a></li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_twentyfour .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_twentyfour .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('lunch-bills') }}" id="all-dropdown">Lunch Allowance
                                    </a></li>
                                @endif
                                @endif
                                {{--
                                <li><a href="{{route('locations')}}" id="all-dropdown">Location</a></li>

                                <li><a href="{{route('attandance-locations')}}" id="all-dropdown">{{__('Attendance
                                        Location')}}</a></li>

                                <li><a href="{{route('login-histories')}}" id="all-dropdown">{{__('Login History')}}</a>
                                </li>

                                <li><a href="{{route('login-id-locations')}}" id="all-dropdown">{{__('Login ID
                                        Location')}}</a></li>
                                --}}
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_four .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_four .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('regions') }}" id="all-dropdown">{{ $location1 ?? 'location1' }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_five .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_five .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('areas') }}" id="all-dropdown">{{ $location2 ?? 'location2' }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_six .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_six .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('territories') }}" id="all-dropdown">{{ $location3 ?? 'location3'
                                        }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_seven .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_seven .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('towns') }}" id="all-dropdown">{{ $location4 ?? 'location4' }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_eight .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_eight .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('db-houses') }}" id="all-dropdown">{{ $location5 ?? 'location5' }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_twelve .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_twelve .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('location-sixes') }}" id="all-dropdown">{{ $location6 ?? 'location6'
                                        }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_thirteen .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_thirteen .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('location-sevens') }}" id="all-dropdown">{{ $location7 ?? 'location7'
                                        }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_fourteen .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_fourteen .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('location-eights') }}" id="all-dropdown">{{ $location8 ?? 'location8'
                                        }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_fifteen .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_fifteen .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('location-nines') }}" id="all-dropdown">{{ $location9 ?? 'location9'
                                        }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_sixteen .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_sixteen .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('location-tens') }}" id="all-dropdown">{{ $location10 ?? 'location10'
                                        }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_seventeen .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_seventeen .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('location-elevens') }}" id="all-dropdown">{{ $location11 ??
                                        'location11' }}</a>
                                </li>
                                @endif
                                @endif


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_ten .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_ten .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('announcement') }}" id="all-dropdown">Announcements</a></li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $organization_sub_module_eleven .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $organization_sub_module_eleven .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li><a href="{{ route('company-policy') }}" id="all-dropdown">{{ __('Company Policy') }}</a>
                                </li>
                                @endif
                                @endif

                            </ul>
                        </li>
                        @endif
                        @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $core_hr_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $core_hr_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('promotion*')) {{ request()->is('promotion*') ? 'active' : '' }}
                                                @elseif (request()->is('employee-list')) {{ request()->is('employee-list') ? 'active' : '' }}
                                                @elseif(request()->is('employee-create')){{ request()->is('employee-create') ? 'active' : '' }}
                                                @elseif(request()->is('file-import-export')){{ request()->is('file-import-export') ? 'active' : '' }}
                                                @elseif(request()->is('assigning-role')){{ request()->is('assigning-role') ? 'active' : '' }}
                                                @elseif(request()->is('inactive-user-list')){{ request()->is('inactive-user-list') ? 'active' : '' }}
                                                @elseif(request()->is('award*')){{ request()->is('award*') ? 'active' : '' }}
                                                @elseif(request()->is('probation-employee*')){{ request()->is('probation-employee*') ? 'active' : '' }}
                                                @elseif(request()->is('recommendation-employee*')){{ request()->is('recommendation-employee*') ? 'active' : '' }}
                                                @elseif(request()->is('employee_increment*')){{ request()->is('employee_increment*') ? 'active' : '' }}
                                                @elseif(request()->is('travel*')){{ request()->is('travel*') ? 'active' : '' }}
                                                @elseif(request()->is('transfer*')){{ request()->is('transfer*') ? 'active' : '' }}
                                                @elseif(request()->is('resignation*')){{ request()->is('resignation*') ? 'active' : '' }}
                                                @elseif(request()->is('complaint*')){{ request()->is('complaint*') ? 'active' : '' }}
                                                @elseif(request()->is('warning*')){{ request()->is('warning*') ? 'active' : '' }}
                                                @elseif(request()->is('termination*')){{ request()->is('termination*') ? 'active' : '' }}
                                                @elseif(request()->is('provident-fund-member*')){{ request()->is('provident-fund-member*') ? 'active' : '' }}
                                                @elseif(request()->is('take-pf-membership*')){{ request()->is('take-pf-membership*') ? 'active' : '' }}
                                                @elseif(request()->is('pf-bank-account*')){{ request()->is('pf-bank-account*') ? 'active' : '' }}
                                                @elseif(request()->is('non-permanent-employee')){{ request()->is('non-permanent-employee') ? 'active' : '' }}
                                                @elseif(request()->is('noc-employee')){{ request()->is('noc-employee') ? 'active' : '' }}

                                                @elseif(request()->is('bulk-download-id-card')){{ request()->is('bulk-download-id-card') ? 'active' : '' }} @endif">
                        <a href="#Core_hr" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle">
                                <i style="color:white;" class="dripicons-briefcase"></i><span>{{ __('Core HR') }}</span>
                            </div>
                        </a>
                        <ul id="Core_hr" class="collapse list-unstyled ">



                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $employee_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $employee_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="add_employee"><a href="{{ route('employee-add') }}" id="all-dropdown">Add Employee
                                </a></li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $employee_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $employee_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employee_list"><a href="{{ route('employee-lists') }}" id="all-dropdown">Employee
                                    Lists</a></li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $employee_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $employee_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="user-import"><a href="{{ route('import-employee') }}" id="all-dropdown">{{
                                    __('Import
                                    Employees') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $user_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $user_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="user-roles"><a href="{{ route('assigning-roles') }}" id="all-dropdown">{{
                                    __('Assigning
                                    Roles') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $user_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $user_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="user-last-login"><a href="{{ url('/admin/user-activity') }}" id="all-dropdown">{{
                                    __('Employee Last Login') }}</a></li>
                            @endif
                            @endif

                            @if (Auth::user()->company_profile == 'Yes')
                            {{-- <li id="contactRenewal"><a href="{{route('non-permanent-employees')}}"
                                    id="all-dropdown">{{__('Contact Renewal')}}</a></li> --}}
                            @endif

                            <li id="bulkDownload"><a href="{{ route('bulk-id-cards') }}" id="all-dropdown"
                                    target="_blank">{{ __('Bulk Downloads') }}</a>
                            </li>

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_fourteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_fourteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employee_increment"><a href="{{ route('noc-employees') }}" id="all-dropdown">NOC</a>
                            </li>
                            @endif
                            @endif


                            @if (Auth::user()->company_profile == 'Yes')
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_probation_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_probation_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="probation"><a href="{{ route('probation-employees') }}" id="all-dropdown">Probation
                                    Review List</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_probation_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_probation_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="probation"><a href="{{ route('recommendation-employees') }}"
                                    id="all-dropdown">Recommendation</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_thirteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_thirteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employee_increment"><a href="{{ route('non-permanent-employees') }}"
                                    id="all-dropdown">Contact Renewal</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_sixteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_sixteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employee_increment"><a href="{{ route('contact-renewal-letter-lists') }}"
                                    id="all-dropdown">Contact Renewal List</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')

                            <li id="promotion"><a href="{{ route('promotion') }}"
                                    id="all-dropdown">Promotion/Demotion</a>
                            </li>
                            @endif
                            @endif

                            {{-- @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_twelve .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_twelve .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="employee_increment"><a href="{{ route('employee_increment') }}"
                                    id="all-dropdown">Employee probation
                                    Increment</a>
                            </li>
                            @endif
                            @endif --}}




                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_fifteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_fifteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employee-salary-increments"><a href="{{ route('employee-salary-increments') }}"
                                    id="all-dropdown">Employee Salary Increment</a>
                            </li>
                            @endif
                            @endif



                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="award"><a href="{{ route('award') }}" id="all-dropdown">Award</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="travel"><a href="{{ route('travel') }}" id="all-dropdown">Travel</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="transfer"><a href="{{ route('transfer') }}" id="all-dropdown">Transfer</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="resignation"><a href="{{ route('resignation') }}" id="all-dropdown">Resignations</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="complaint"><a href="{{ route('complaint') }}" id="all-dropdown">Complaints</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_seven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_seven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="warning"><a href="{{ route('warning') }}" id="all-dropdown">Warnings</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="termination"><a href="{{ route('termination') }}" id="all-dropdown">Terminations</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_nine .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_nine .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="provident"><a href="{{ route('provident-fund-member') }}" id="all-dropdown">{{
                                    __('Eligible PF Members') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_ten .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_ten .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="provident"><a href="{{ route('take-pf-memberships') }}" id="all-dropdown">{{ __('PF
                                    Membership Taking') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $core_hr_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $core_hr_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="provident"><a href="{{ route('pf-bank-accounts') }}" id="all-dropdown">{{ __('PF
                                    Bank
                                    Account') }}</a>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </li>
                    @endif
                    @endif


                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                        'json_contains(package_module,
                        \'["' .
                        $template_module .
                        '"]\')')->exists())
                        @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                        '=', Auth::user()->role_id)->whereRaw(
                        'json_contains(permission_content,
                        \'["' .
                        $template_module .
                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                        <li
                            class="has-dropdown @if (request()->is('appointment-template*')) {{ request()->is('appointment-template*') ? 'active' : '' }}
                                                    @elseif(request()->is('template-header*')){{ request()->is('template-header*') ? 'active' : '' }}
                                                    @elseif(request()->is('template-footer*')){{ request()->is('template-footer*') ? 'active' : '' }}
                                                    @elseif(request()->is('experience-template*')){{ request()->is('experience-template*') ? 'active' : '' }}
                                                    @elseif(request()->is('create-experience-template')){{ request()->is('create-experience-template') ? 'active' : '' }}
                                                    @elseif(request()->is('warning-letter-format*')){{ request()->is('warning-letter-format*') ? 'active' : '' }}
                                                    @elseif(request()->is('warning-letter-edit*')){{ request()->is('warning-letter-edit*') ? 'active' : '' }}
                                                    @elseif(request()->is('warning-letter-format-create')){{ request()->is('warning-letter-format-create') ? 'active' : '' }}
                                                    @elseif(request()->is('probation-letter-formats')){{ request()->is('probation-letter-formats') ? 'active' : '' }}
                                                    @elseif(request()->is('resignation-letter-format')){{ request()->is('resignation-letter-format') ? 'active' : '' }}
                                                    @elseif(request()->is('non-objection-certificate')){{ request()->is('non-objection-certificate') ? 'active' : '' }}
                                                    @elseif(request()->is('salary-increment-letter-template')){{ request()->is('salary-increment-letter-template') ? 'active' : '' }}
                                                    @elseif(request()->is('contact-renewal-letter-template')){{ request()->is('contact-renewal-letter-template') ? 'active' : '' }} @endif">
                            <a href="#template_module" aria-expanded="false" data-toggle="collapse">
                                <div class="CheckStyle">
                                    <i style="color:white;" class="dripicons-scale"></i><span>{{ __('Template Settings')
                                        }}</span>
                                </div>
                            </a>
                            <ul id="template_module" class="collapse list-unstyled ">

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_ten .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_ten .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="roles"><a href="{{ route('headers') }}" id="all-dropdown">{{ __('Templates Headers
                                        Configure') }}</a>
                                </li>
                                @endif
                                @endif
                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_one .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_one .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="roles"><a href="{{ route('footers') }}" id="all-dropdown">{{ __('Templates Footer
                                        Configure') }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_nine .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_nine .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="roles"><a href="{{ route('experience-templates') }}" id="all-dropdown">{{
                                        __('Experience Letter Template') }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_two .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_two .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="roles"><a href="{{ route('appointment-templates') }}" id="all-dropdown">{{
                                        __('Appointment Letter Template') }}</a>
                                </li>
                                @endif
                                @endif




                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_three .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_three .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('warning-letter-formats') }}" id="all-dropdown">{{
                                        __('Warning Letter Template') }}</a></li>
                                @endif
                                @endif


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_four .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_four .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('probation-letter-formats') }}" id="all-dropdown">{{
                                        __('Probation Letter Template') }}</a></li>
                                @endif
                                @endif


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_five .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_five .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('non-objection-certificates') }}" id="all-dropdown">{{
                                        __('NOC (Non Objection Certificate)') }}</a>
                                </li>
                                @endif
                                @endif


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_six .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_six .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('resignation-letter-formats') }}" id="all-dropdown">{{
                                        __('Resign Acceptance Letter Template') }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_seven .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_seven .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('salary-certificate-formats') }}" id="all-dropdown">{{
                                        __('Salary Certificate') }}</a></li>
                                @endif
                                @endif


                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_eleven .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_eleven .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('salary-increment-letter-templates') }}"
                                        id="all-dropdown">{{ __('Salary Increment Letter Template') }}</a>
                                </li>
                                @endif
                                @endif

                                @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                'json_contains(package_module,
                                \'["' .
                                $template_sub_module_eight .
                                '"]\')')->exists())
                                @if (Permission::where('permission_com_id', '=',
                                Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                                'json_contains(permission_content,
                                \'["' .
                                $template_sub_module_eight .
                                '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                <li id="ip_setting"><a href="{{ route('contact-renewal-letter-templates') }}"
                                        id="all-dropdown">{{ __('Contact Renewal Letter Template') }}</a>
                                </li>
                                @endif
                                @endif

                            </ul>
                        </li>
                        @endif
                        @endif


                    {{-- @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $probation_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $probation_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('probation-employee')) {{ request()->is('probation-employee') ? 'active' : '' }}
                                                @elseif(request()->is('recommendation-employee')){{ request()->is('recommendation-employee') ? 'active' : '' }} @endif">
                        <a href="#Probation" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle">
                                <i style="color:white;" class="dripicons-hourglass"></i><span>{{ __('Probation')
                                    }}</span>
                            </div>
                        </a>
                        <ul id="Probation" class="collapse list-unstyled ">

                        </ul>
                    </li>
                    @endif
                    @endif --}}



                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $time_sheet_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $time_sheet_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('attendance')) {{ request()->is('attendance') ? 'active' : '' }}
                                                @elseif(request()->is('date-wise-attendances')){{ request()->is('date-wise-attendances*') ? 'active' : '' }}
                                                @elseif(request()->is('date-wise-employee-attendances')){{ request()->is('date-wise-employee-attendances*') ? 'active' : '' }}
                                                @elseif(request()->is('monthly-attendance*')){{ request()->is('monthly-attendance*') ? 'active' : '' }}
                                                @elseif(request()->is('update-attendance*')){{ request()->is('update-attendance*') ? 'active' : '' }}
                                                @elseif(request()->is('import-attendance*')){{ request()->is('import-attendance*') ? 'active' : '' }}
                                                @elseif(request()->is('office-shift*')){{ request()->is('office-shift*') ? 'active' : '' }}
                                                @elseif(request()->is('manage-weekly*')){{ request()->is('manage-weekly*') ? 'active' : '' }}
                                                @elseif(request()->is('manage-other*')){{ request()->is('manage-other*') ? 'active' : '' }}
                                                @elseif(request()->is('manage-leave-type*')){{ request()->is('manage-leave-type*') ? 'active' : '' }}
                                                @elseif(request()->is('manage-leave*')){{ request()->is('manage-leave*') ? 'active' : '' }}
                                                @elseif(request()->is('over-time-config*')){{ request()->is('over-time-config*') ? 'active' : '' }}
                                                @elseif(request()->is('late-time-config*')){{ request()->is('late-time-config*') ? 'active' : '' }}
                                                @elseif(request()->is('approve-leave*')){{ request()->is('approve-leave*') ? 'active' : '' }}
                                                @elseif(request()->is('manage-travel*')){{ request()->is('manage-travel*') ? 'active' : '' }}
                                                @elseif(request()->is('approve-travel*')){{ request()->is('approve-travel*') ? 'active' : '' }}
                                                @elseif(request()->is('date-wise-all-attendances')){{ request()->is('date-wise-all-attendances') ? 'active' : '' }}
                                                @elseif(request()->is('location-reset')){{ request()->is('location-reset') ? 'active' : '' }}
                                                @elseif(request()->is('location-lock')){{ request()->is('location-lock') ? 'active' : '' }}
                                                @elseif(request()->is('compensatory-leave')){{ request()->is('compensatory-leave') ? 'active' : '' }}
                                                @elseif(request()->is('compensatory-leaves-approve')){{ request()->is('compensatory-leaves-approve') ? 'active' : '' }} @endif">
                        <a href="#Timesheets" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"><i style="color:white;"
                                    class="dripicons-clock"></i><span>Timesheets</span></div>
                        </a>
                        <ul id="Timesheets" class="collapse list-unstyled">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="attendance"><a href="{{ route('attendance') }}" id="all-dropdown">Attendances</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="date_wise_attendance"><a href="{{ route('date-wise-attendance') }}"
                                    id="all-dropdown">
                                    {{ __('Date wise Attendances') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="monthly_attendance"><a href="{{ route('monthly-attendance') }}" id="all-dropdown">
                                    {{ __('Monthly Attendances') }}</a>
                            </li>
                            @endif
                            @endif
                            {{--
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="update_attendance"><a href="{{route('add-attendances')}}" id="all-dropdown">
                                    {{__('Add Attendances')}}</a>
                            </li>
                            @endif
                            @endif
                            --}}
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="update_attendance"><a href="{{ route('update-attendance') }}" id="all-dropdown">
                                    {{ __('Update Attendances') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="import_attendance"><a href="{{ route('import-attendance') }}" id="all-dropdown">
                                    {{ __('Import Attendances') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="office_shift"><a href="{{ route('office-shifts') }}" id="all-dropdown">{{ __('Office
                                    Shift') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_nine .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_nine .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('over-time-configs') }}" id="all-dropdown">{{ __('Over
                                    Time Configure') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $customize_sub_module_ten .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $customize_sub_module_ten .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="ip_setting"><a href="{{ route('late-time-configs') }}" id="all-dropdown">{{ __('Late
                                    Time Config') }}</a>
                            </li>
                            @endif
                            @endif

                            {{-- <li id="weekly-holiday"><a href="#" id="all-dropdown">{{__('Manage Special Duty
                                    Day')}}</a></li> --}}
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_seven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_seven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="weekly-holiday"><a href="{{ route('manage-weekly-holidays') }}" id="all-dropdown">{{
                                    __('Manage Weekly Holiday') }}</a></li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="other-holiday"><a href="{{ route('manage-other-holidays') }}" id="all-dropdown">{{
                                    __('Manage Other Holiday') }}</a></li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_nine .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_nine .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="leave-type"><a href="{{ route('manage-leave-types') }}" id="all-dropdown">{{
                                    __('Manage
                                    Leave Type') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_ten .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_ten .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="leave"><a href="{{ route('manage-leave') }}" id="all-dropdown">{{ __('Manage All
                                    Leaves') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="approve-leave"><a href="{{ route('approve-leaves') }}" id="all-dropdown">{{
                                    __('Approve
                                    Employee Leaves') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="manage-leave"><a href="{{ route('manage-travels') }}" id="all-dropdown">{{
                                    __('Manage
                                    Travel Requests') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="approve-travel"><a href="{{ route('approve-travels') }}" id="all-dropdown">{{
                                    __('Approve Travel Requests') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="approve-leave"><a href="{{ route('location-resets') }}" id="all-dropdown">{{
                                    __('Location Reset') }}</a></li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $time_sheet_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="approve-leave"><a href="{{ route('location-locks') }}" id="all-dropdown">{{
                                    __('Location Lock') }}</a></li>
                            @endif
                            @endif

                            <li id="approve-leave"><a href="{{ route('compensatory-leaves') }}" id="all-dropdown">{{
                                    __('Compensatory Leaves') }}</a></li>
                            <li id="approve-leave"><a href="{{ route('compensatory-leaves-approves') }}"
                                    id="all-dropdown">{{ __('Compensatory Leaves Approve') }}</a></li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $finger_print_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $finger_print_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown
                         @if (request()->is('device-area')) {{ request()->is('device-area') ? 'active' : '' }}
                                                @elseif(request()->is('device-list')){{ request()->is('device-list') ? 'active' : '' }}
                                                @elseif(request()->is('employee-with-fp')){{ request()->is('employee-with-fp') ? 'active' : '' }}
                                                @elseif(request()->is('employee-without-fp')){{ request()->is('employee-without-fp') ? 'active' : '' }}
                                                @elseif(request()->is('set-ip')){{ request()->is('set-ip') ? 'active' : '' }}
                                                @elseif(request()->is('token-list')){{ request()->is('token-list') ? 'active' : '' }}
                                                 @endif
                                                ">
                        <a href="#Fpdevice" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"><i style="color:white;"
                                    class="dripicons-device-mobile"></i><span>FP Device Configure</span></div>
                        </a>
                        <ul id="Fpdevice" class="collapse list-unstyled">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $finger_print_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $finger_print_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="device-area"><a href="{{ route('set-ip') }}" id="all-dropdown">{{ __('IP Set') }} </a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $finger_print_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $finger_print_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="device-area"><a href="{{ route('token-list') }}" id="all-dropdown">{{ __('Token Generate') }} </a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $finger_print_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $finger_print_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="device-area"><a href="{{ route('device-area') }}" id="all-dropdown">{{ __('Device Area') }} </a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $finger_print_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $finger_print_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="device-area"><a href="{{ route('device-list') }}" id="all-dropdown">{{ __('Device List') }} </a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $finger_print_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $finger_print_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="device-area"><a href="{{ route('employee-with-fp') }}" id="all-dropdown">{{ __('Employee With Finger Print') }} </a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $finger_print_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $finger_print_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="device-area"><a href="{{ route('employee-without-fp') }}" id="all-dropdown">{{ __('Employee Without Finger Print') }} </a>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </li>
                    @endif
                    @endif
                    
                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $payroll_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $payroll_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('new-payment*')) {{ request()->is('new-payment*') ? 'active' : '' }}
                                                @elseif(request()->is('payment-history*')){{ request()->is('payment-history*') ? 'active' : '' }}
                                                @elseif(request()->is('pf-history')){{ request()->is('pf-history') ? 'active' : '' }}
                                                @elseif(request()->is('payment-festival-history')){{ request()->is('payment-festival-history') ? 'active' : '' }}
                                                @elseif(request()->is('new-festival-payments')){{ request()->is('new-festival-payments') ? 'active' : '' }}
                                                @elseif(request()->is('department-and-month-wise-payment-history')){{ request()->is('department-and-month-wise-payment-history') ? 'active' : '' }}
                                                @elseif(request()->is('department-and-month-wise-payment-festival-history')){{ request()->is('department-and-month-wise-payment-festival-history') ? 'active' : '' }} @endif">
                        <a href="#Payroll" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle">
                                <i style="color:white;" class="dripicons-wallet"></i><span>Payroll & Benefits</span>
                            </div>
                        </a>
                        <ul id="Payroll" class="collapse list-unstyled">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $payroll_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $payroll_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li><a href="{{ route('new-payment') }}" id="all-dropdown">{{ __('New Payment') }}</a></li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $payroll_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $payroll_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li><a href="{{ route('payment-histories') }}" id="all-dropdown">{{ __('Payment History')
                                    }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $payroll_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $payroll_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li><a href="{{ route('new-festival-payment') }}" id="all-dropdown">{{ __('Festival Bounas
                                    Payment') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $payroll_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $payroll_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li><a href="{{ route('payment-festival-histories') }}" id="all-dropdown">{{ __('Festival
                                    Bounas
                                    Payment History') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $payroll_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $payroll_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li><a href="{{ route('pf-histories') }}" id="all-dropdown">{{ __('Provident Fund
                                    History') }}</a>
                            </li>
                            @endif
                            @endif

                        </ul>
                    </li>
                    @endif
                    @endif


                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $performance_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $performance_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('goal-types')) {{ request()->is('goal-types') ? 'active' : '' }}
                                                @elseif(request()->is('objectives-type')){{ request()->is('objectives-type') ? 'active' : '' }}
                                                @elseif(request()->is('objectives-type-config')){{ request()->is('objectives-type-config') ? 'active' : '' }}
                                                @elseif(request()->is('objectives')){{ request()->is('objectives') ? 'active' : '' }}
                                                @elseif(request()->is('yearly-review-config')){{ request()->is('yearly-review-config') ? 'active' : '' }}
                                                @elseif(request()->is('promotion-demotion-point-config')){{ request()->is('promotion-demotion-point-config') ? 'active' : '' }}
                                                @elseif(request()->is('seats-allocation')){{ request()->is('seats-allocation') ? 'active' : '' }}
                                                @elseif(request()->is('performance-form')){{ request()->is('performance-form') ? 'active' : '' }}
                                                @elseif(request()->is('supervisor-marking')){{ request()->is('supervisor-marking') ? 'active' : '' }}
                                                @elseif(request()->is('supervisor-mark-giving-page')){{ request()->is('supervisor-mark-giving-page') ? 'active' : '' }}
                                                @elseif(request()->is('eligible-pd-employee')){{ request()->is('eligible-pd-employee') ? 'active' : '' }}
                                                @elseif(request()->is('annual-increment')){{ request()->is('annual-increment') ? 'active' : '' }}
                                                @elseif(request()->is('performance-report')){{ request()->is('performance-report') ? 'active' : '' }}
                                                @elseif(request()->is('objectives-point-config')){{ request()->is('objectives-point-config') ? 'active' : '' }}
                                                @elseif(request()->is('performance-value-configure')){{ request()->is('performance-value-configure') ? 'active' : '' }}
                                                @elseif(request()->is('performance-value-type-configure')){{ request()->is('performance-value-type-configure') ? 'active' : '' }}
                                                @elseif(request()->is('employee-performance-result')){{ request()->is('employee-performance-result') ? 'active' : '' }}
                                                @elseif(request()->is('objective')){{ request()->is('objective') ? 'active' : '' }}
                                                @elseif(request()->is('supervisor-recommendation')){{ request()->is('supervisor-recommendation') ? 'active' : '' }}
                                                 @elseif(request()->is('salary-history')){{ request()->is('salary-history') ? 'active' : '' }}
                                                 @elseif(request()->is('approval-increment')){{ request()->is('approval-increment') ? 'active' : '' }}
                                                 @elseif(request()->is('increment-config')){{ request()->is('increment-config') ? 'active' : '' }}
                                                 @elseif(request()->is('performance-cofigaration')){{ request()->is('performance-cofigaration') ? 'active' : '' }} @endif">
                        <a href="#performance" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"><i style="color:white;"
                                    class="fa fa-bar-chart"></i><span>Performance</span></div>
                        </a>
                        <ul id="performance" class="collapse list-unstyled ">




                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="promotion-demotion-point-config"><a
                                    href="{{ route('performance-configarations') }}">{{ __('Configurations') }}</a>
                            </li>
                            @endif

                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="objectives-type-config"><a href="{{ route('objectives-type-configs') }}">{{
                                    __('KPI/Objective Set
                                    ') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="indicator"><a href="{{ route('indicators') }}">{{ __('Employees Objectives') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="performance-form"><a href="{{ route('performance-forms') }}">{{ __('Yearly
                                    Performance
                                    Review
                                    ') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="promotion-demotion-point-config"><a
                                    href="{{ route('performance-value-type-configures') }}">{{ __('Yearly
                                    Value Review') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="promotion-demotion-point-config"><a
                                    href="{{ route('supervisor-recommendations') }}">{{ __('Supervisor Recommendation')
                                    }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="promotion-demotion-point-config"><a
                                    href="{{ route('employee-performance-results') }}">{{ __('Eligible P/D
                                    Employees List') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_seven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_seven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="performance-form"><a href="{{ route('annual-increments') }}">{{ __('Eligible Annual
                                    Increment List') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="performance-form"><a href="{{ route('approval-increments') }}">{{ __('
                                    Increment Approval') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_nine .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_nine .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="performance-form"><a href="{{ route('performance-report') }}">{{ __('Performance
                                    Report') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $performance_sub_module_ten .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $performance_sub_module_ten .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="performance-form"><a href="{{ route('salary-histories') }}">{{ __('Annual Increment
                                    Salary History') }}</a>
                            </li>
                            @endif
                            @endif


                        </ul>
                    </li>
                    @endif
                    @endif


                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $recruitment_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $recruitment_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('job-post')) {{ request()->is('job-post') ? 'active' : '' }}
                                                @elseif(request()->is('job-candidates')){{ request()->is('job-candidates') ? 'active' : '' }}
                                                @elseif(request()->is('job-interview')){{ request()->is('job-interview') ? 'active' : '' }}
                                                @elseif(request()->is('job-portal')){{ request()->is('job-portal') ? 'active' : '' }} @endif">
                        <a href="#Recruitment" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <i style="color:white;"
                                    class="dripicons-user-id"></i><span>Recruitment</span></div>
                        </a>
                        <ul id="Recruitment" class="collapse list-unstyled ">


                            <li id="job_post"><a href="{{ route('job-posts') }}">{{ __('Job Post') }}</a>
                            </li>

                            <li id="job_candidate"><a href="{{ route('job-candidate') }}">{{ __('Job Candidates') }}</a>
                            </li>

                            <li id="job_interview"><a href="{{ route('job-interviews') }}">{{ __('Job Interview') }}</a>
                            </li>

                            <li id="cms"><a href="{{ route('job-portals') }}" target="_blank">{{ __('Job Portal') }}</a>
                            </li>

                        </ul>
                    </li>
                    @endif
                    @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $training_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $training_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('training-type')) {{ request()->is('training-type') ? 'active' : '' }}
                                                @elseif(request()->is('trainers')){{ request()->is('trainers') ? 'active' : '' }}
                                                @elseif(request()->is('training-list')){{ request()->is('training-list') ? 'active' : '' }} @endif">
                        <a href="#training" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"><i style="color:white;"
                                    class="fa fa-trophy"></i><span>Training</span></div>
                        </a>
                        <ul id="training" class="collapse list-unstyled ">

                            <li id="training-type"><a href="{{ route('training-types') }}">{{ __('Training Type') }}</a>
                            </li>
                            <li id="trainer"><a href="{{ route('trainer') }}">{{ __('Trainers') }}</a>
                            </li>
                            <li id="training-list"><a href="{{ route('training-lists') }}">{{ __('Training List') }}</a>
                            </li>

                        </ul>
                    </li>
                    @endif
                    @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $hr_calander_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $hr_calander_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="@if (request()->is('fullcalender')) {{ request()->is('fullcalender') ? 'active' : '' }} @endif">
                        <a href="{{ route('hr-calendars') }}">
                            <div class="CheckStyle"><i style="color:white;" class="dripicons-calendar"></i><span>{{
                                    __('HR Calendar') }}</span></div>
                        </a>
                    </li>
                    @endif
                    @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $hr_report_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $hr_report_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('attendance-report')) {{ request()->is('attendance-report') ? 'active' : '' }}
                                                @elseif(request()->is('pf-report*')){{ request()->is('pf-report*') ? 'active' : '' }}
                                                @elseif(request()->is('project-report*')){{ request()->is('project-report*') ? 'active' : '' }}
                                                @elseif(request()->is('task-report*')){{ request()->is('task-report*') ? 'active' : '' }}
                                                @elseif(request()->is('employee-report')){{ request()->is('employee-report') ? 'active' : '' }}
                                                @elseif(request()->is('active-psr-report')){{ request()->is('active-psr-report') ? 'active' : '' }}
                                                @elseif(request()->is('psr-recruitment-summary')){{ request()->is('psr-recruitment-summary') ? 'active' : '' }}
                                                @elseif(request()->is('orientation-selected-report')){{ request()->is('orientation-selected-report') ? 'active' : '' }}
                                                @elseif(request()->is('psr-recruitment-summary')){{ request()->is('psr-recruitment-summary') ? 'active' : '' }}
                                                @elseif(request()->is('psr-master-report')){{ request()->is('psr-master-report') ? 'active' : '' }}
                                                @elseif(request()->is('separation-report')){{ request()->is('separation-report') ? 'active' : '' }}
                                                @elseif(request()->is('salary-disburse')){{ request()->is('salary-disburse') ? 'active' : '' }}
                                                @elseif(request()->is('search-salary-disburse')){{ request()->is('search-salary-disburse') ? 'active' : '' }}

                                                @elseif(request()->is('festival-salary-disburse')){{ request()->is('festival-salary-disburse') ? 'active' : '' }}
                                                @elseif(request()->is('festival-search-salary-disburse')){{ request()->is('festival-search-salary-disburse') ? 'active' : '' }} @endif">
                        <a href="#HR_Reports" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle">
                                <i style="color:white;" class="dripicons-document"></i><span>{{ __('HR Reports')
                                    }}</span>
                            </div>
                        </a>
                        <ul id="HR_Reports" class="collapse list-unstyled ">

                            {{--
                            <li id="payslip_report"><a href="">{{__('Payslip Report')}}</a>
                            </li>
                            --}}
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="attendance_report"><a href="{{ route('attandance-reports') }}" id="all-dropdown">{{
                                    __('Attendance Report') }}</a>
                            </li>
                            @endif
                            @endif

                            {{--
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_two .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_two .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="training_report"><a href="{{route('training-reports')}}"
                                    id="all-dropdown">{{__('Training Report')}}</a>
                            </li>
                            @endif
                            @endif
                            --}}

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="project_report"><a href="{{ route('project-reports') }}" id="all-dropdown">{{
                                    __('Project Report') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="task_report"><a href="{{ route('task-reports') }}" id="all-dropdown">{{ __('Task
                                    Report') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('employee-reports') }}" id="all-dropdown">{{
                                    __('Employees Report') }}</a>
                            </li>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_eleven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_eleven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('psr-master-reports') }}" id="all-dropdown">{{
                                    __('Employees Master Report') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_twelve .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_twelve .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('active-psr-reports') }}" id="all-dropdown">{{
                                    __('Active Employees Report') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_thirteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_thirteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('psr-recruitment-summary') }}"
                                    id="all-dropdown">{{ __('Employees Recruitment Summary') }}</a>
                            </li>
                            @endif
                            @endif

                            {{--
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_fourteen .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_fourteen .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{route('orientation-selected-reports')}}"
                                    id="all-dropdown">{{__('Orientation & Selected Report')}}</a>
                            </li>
                            @endif
                            @endif --}}

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_fifteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_fifteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('separation-reports') }}" id="all-dropdown">{{
                                    __('Separation Report') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_sixteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_sixteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('salary-disburses') }}" id="all-dropdown">{{
                                    __('Salary Disburse Report') }}</a>
                            </li>
                            @endif
                            @endif

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_seventeen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_seventeen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="employees_report"><a href="{{ route('festival-salary-disburses') }}"
                                    id="all-dropdown">{{ __('Festival Bounus Salary Disburse Report') }}</a>
                            </li>
                            @endif
                            @endif

                            {{--
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_six .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_six .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="account_report"><a href="{{route('account-reports')}}"
                                    id="all-dropdown">{{__('Account Report')}}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_seven .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_seven .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="expense_report"><a href="{{route('expense-reports')}}"
                                    id="all-dropdown">{{__('Expense Report')}}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_eight .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_eight .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="deposit_report"><a href="{{route('deposite-reports')}}">{{__('Deposit Report')}}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_nine .
                            '"]\')',
                            )->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_nine .
                            '"]\')',
                            )->exists() ||
                            Auth::user()->company_profile == 'Yes')
                            <li id="transaction_report"><a href="{{route('transaction-reports')}}"
                                    id="all-dropdown">{{__('Transaction Report')}}</a>
                            </li>
                            @endif
                            @endif
                            --}}

                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $hr_report_sub_module_ten .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $hr_report_sub_module_ten .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="transaction_report"><a href="{{ route('pf-reports') }}" id="all-dropdown">{{
                                    __('Provident Fund Report') }}</a>
                            </li>
                            @endif
                            @endif


                            {{-- <li id="pension_report"><a href="{{route('pension-reports')}}">{{__('Pension
                                    Report')}}</a></li> --}}
                        </ul>
                    </li>
                    @endif
                    @endif


                    {{--
                    <li class="has-dropdown {{ (request()->is('recruitment*')) ? 'active' : '' }}"><a
                            href="#Recruitment" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <i style="color:white;"
                                    class="dripicons-user-id"></i><span>Recruitment</span></div>
                        </a>
                        <ul id="Recruitment" class="collapse list-unstyled ">


                            <li id="job_post"><a href="{{route('job-posts')}}">{{__('Job Post')}}</a></li>

                            <li id="job_candidate"><a href="{{route('job-candidate')}}">{{__('Job Candidates')}}</a>
                            </li>

                            <li id="job_interview"><a href="{{route('job-interviews')}}">{{__('Job Interview')}}</a>
                            </li>

                            <li id="cms"><a href="{{route('job-portals')}}">{{__('CMS')}}</a>
                            </li>

                        </ul>
                    </li>


                    <li
                        class="has-dropdown @if (request()->is('training*')){{ (request()->is('training*')) ? 'active' : '' }}@elseif(request()->is('dynamic_variable/training_type*')){{ (request()->is('dynamic_variable/training_type*')) ? 'active' : '' }}@endif">
                        <a href="#Training" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <i style="color:white;"
                                    class="dripicons-trophy"></i><span>Training</span></div>
                        </a>
                        <ul id="Training" class="collapse list-unstyled ">

                            <li id="training_list"><a href="{{route('training-lists')}}">{{__('Training List')}}</a>
                            </li>

                            <li id="training_type"><a href="{{route('training-types')}}">{{__('Training Type')}}</a>
                            </li>

                            <li id="trainers"><a href="{{route('trainer')}}">Trainers</a>
                            </li>

                        </ul>
                    </li>

                    --}}

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $event_and_meeting_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $event_and_meeting_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('event*')) {{ request()->is('event*') ? 'active' : '' }}
                                                @elseif(request()->is('meeting*')){{ request()->is('meeting*') ? 'active' : '' }} @endif">
                        <a href="#Events_Meetings" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <i style="color:white;" class="dripicons-to-do"></i><span>Events &
                                    Meetings</span></div>
                        </a>
                        <ul id="Events_Meetings" class="collapse list-unstyled ">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $event_and_meeting_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $event_and_meeting_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="events"><a href="{{ route('event') }}" id="all-dropdown">Events</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $event_and_meeting_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $event_and_meeting_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="meetings"><a href="{{ route('meeting') }}" id="all-dropdown">Meetings</a>
                            </li>
                            @endif
                            @endif

                        </ul>

                    </li>
                    @endif
                    @endif
                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $project_management_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $project_management_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('projects')) {{ request()->is('projects') ? 'active' : '' }}
                                            @elseif(request()->is('tasks')){{ request()->is('tasks') ? 'active' : '' }} @endif">

                        <a href="#Project_Management" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <i style="color:white;" class="dripicons-checklist"></i><span>{{
                                    __('Project Management') }}</span>
                            </div>
                        </a>
                        <ul id="Project_Management" class="collapse list-unstyled ">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $project_management_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $project_management_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="projects"><a href="{{ route('project') }}" id="all-dropdown">Projects</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $project_management_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $project_management_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="tasks"><a href="{{ route('task') }}" id="all-dropdown">Tasks</a>
                            </li>
                            @endif
                            @endif
                            {{--
                            <li id="clients"><a href="{{route('client')}}">Clients</a>
                            </li>

                            <li id="invoices"><a href="{{route('invoices')}}">Invoice</a>
                            </li>

                            <li id="tax_type"><a href="{{route('tax-types')}}">Tax Type</a>
                            </li>
                            --}}

                        </ul>
                    </li>
                    @endif
                    @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $support_ticket_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $support_ticket_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="@if (request()->is('support-tickets')) {{ request()->is('support-tickets') ? 'active' : '' }} @endif">
                        <a href="{{ route('support-ticket') }}">
                            <div class="CheckStyle"> <i style="color:white;" class="dripicons-ticket"></i><span>Support
                                    Tickets</span></div>
                        </a>
                    </li>
                    @endif
                    @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $assets_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $assets_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('asset-categor*')) {{ request()->is('asset-categor*') ? 'active' : '' }}
                                                @elseif(request()->is('asset*')){{ request()->is('asset*') ? 'active' : '' }} @endif">
                        <a href="#assets" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"><i style="color:white;"
                                    class="dripicons-box"></i><span>Assets</span></div>
                        </a>
                        <ul id="assets" class="collapse list-unstyled ">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $assets_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $assets_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="assets_category"><a href="{{ route('asset-category') }}" id="all-dropdown">Asset
                                    Category</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $assets_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $assets_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="assets">
                                <a href="{{ route('asset') }}" id="all-dropdown">Assets</a>
                            </li>
                            @endif
                            @endif

                        </ul>
                    </li>
                    @endif
                    @endif

                    @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                    'json_contains(package_module,
                    \'["' .
                    $file_manager_module .
                    '"]\')')->exists())
                    @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id',
                    '=', Auth::user()->role_id)->whereRaw(
                    'json_contains(permission_content,
                    \'["' .
                    $file_manager_module .
                    '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                    <li
                        class="has-dropdown @if (request()->is('file-manager*')) {{ request()->is('file-manager*') ? 'active' : '' }}
                                                @elseif(request()->is('official-document*')){{ request()->is('official-document*') ? 'active' : '' }}
                                                @elseif(request()->is('file-configuration*')){{ request()->is('file-configuration*') ? 'active' : '' }} @endif">
                        <a href="#file_manager" aria-expanded="false" data-toggle="collapse">
                            <div class="CheckStyle"> <i style="color:white;" class="dripicons-archive"></i><span>{{
                                    __('File Manager') }}</span></div>
                        </a>
                        <ul id="file_manager" class="collapse list-unstyled ">
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $file_manager_sub_module_one .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $file_manager_sub_module_one .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="files"><a href="{{ route('file-managers') }}" id="all-dropdown">{{ __('File
                                    Manager') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $file_manager_sub_module_two .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $file_manager_sub_module_two .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="official_documents"><a href="{{ route('official-document') }}" id="all-dropdown">{{
                                    __('Official Documents') }}</a>
                            </li>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $file_manager_sub_module_three .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $file_manager_sub_module_three .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <li id="file_config"><a href="{{ route('file-configurations') }}" id="all-dropdown">{{
                                    __('File
                                    Configuration') }}</a>
                            </li>
                            @endif
                            @endif

                        </ul>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

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
<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('description1');
</script>


</html>
