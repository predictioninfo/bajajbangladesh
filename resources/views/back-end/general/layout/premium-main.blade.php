

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

{{--    <link rel="icon" type="image/png" href="{{url('/logo', $general_settings->site_logo) ?? 'NO Logo'}}">--}}
    <link rel="icon" type="image/png" href="{{url('/uploads/logos/PitecHR.png') ?? 'NO Logo'}}">
    <title>PitecHR</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') }}"
          type="text/css">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}"
          type="text/css">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap-datepicker.min.css') }}"
          type="text/css">

    <link rel="stylesheet" href="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.css') }}"
          type="text/css">
    <!-- Boostrap Tag Inputs-->
    <link rel="stylesheet" href="{{ asset('/vendor/Tag_input/tagsinput.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap-select.min.css') }}"
          type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}"
          type="text/css">
    <!-- Dripicons icon font-->
    <link rel="stylesheet" href="{{ asset('/vendor/dripicons/webfont.css') }}" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ asset('/css/grasp_mobile_progress_circle-1.0.0.min.css') }}" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet"
          href="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}"
          type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="{{ asset('/vendor/daterange/css/daterangepicker.min.css') }}"
          type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/datatable/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/datatable/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/datatable/datatables.flexheader.boostrap.min.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('/css/style.default.css') }}" id="theme-stylesheet"
          type="text/css">
    <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
{{--    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">--}}
<style>

         .CheckStyle{
            border: 2px solid #182C61;
            border-radius: 20px;
            text-align: center;
            font-size: 15px;
            background: rgb(49,89,98);
background: linear-gradient(90deg, rgba(49,89,98,1) 0%, rgba(45,117,136,0.6895133053221288) 45%, rgba(242,246,245,0.989233193277311) 100%);
        }

 </style>

{{--
    @if((request()->is('admin/dashboard*')) || (request()->is('calendar*')) )
        @include('calendarable.css')
    @endif
    --}}
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery-ui.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/jquery/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript"
            src="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/popper.js/umd/popper.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>

    <script type="text/javascript"
            src="{{ asset('/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/js/charts-custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/daterange/js/knockout-3.4.2.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/daterange/js/daterangepicker.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <!-- JS for Boostrap Tag Inputs-->

    <script type="text/javascript" src="{{ asset('/vendor/Tag_input/tagsinput.js') }}"></script>

    <script type="text/javascript"
            src="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.js') }}"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="{{ asset('/vendor/datatable/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/vfs_fonts.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.print.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/dataTables.select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatable/sum().js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/dataTables.checkboxes.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/datatable.fixedheader.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/datatable.responsive.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.js') }}"></script>

{{--    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>--}}
{{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}
    <script src="{{asset('/js/toastr.min.js')}}"></script>
    <script src="{{asset('/js/sweetalert.min.js')}}"></script>




{{--@if((request()->is('admin/dashboard*')) || (request()->is('calendar*')) )
        @include('calendarable.js')
    @endif
    --}}
</head>


<body>
<div id="loader"></div>
<header class="header">
    <nav class="navbar" style="background: rgb(49,89,98);
background: linear-gradient(90deg, rgba(49,89,98,1) 0%, rgba(45,117,136,0.6895133053221288) 45%, rgba(149,182,155,0.989233193277311) 100%); ">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-align-left" aria-hidden="true"></i>
                <span class="brand-big" id="site_logo_main"><img
                            src="{{asset('uploads/logos')}}/predictionit.png" width="150">&nbsp;
                    &nbsp;</span>



                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                    <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip"
                                            title="{{__('Full Screen')}}"><i class="dripicons-expand"></i></a></li>
                    <li class="nav-item"><a href="{{route('zoom-meetings')}}"> <img style="width:40px;" src="{{asset('uploads/icons')}}/zoom.png" alt="" class="img-fluid shadow img-circle">  </a></li>
                    <li class="nav-item"><a href="{{route('activity-logs')}}">  <img style="width:40px;" src="{{asset('uploads/icons')}}/21474371-removebg-preview.png" alt="" class="img-fluid shadow img-circle"> </a></li>
                    <li class="nav-item"><a href="{{route('chats')}}"> <img style="width:40px;" src="{{asset('uploads/icons')}}/chat.png" alt="" class="img-fluid shadow img-circle"> </a></li>
                    <li class="nav-item"><a href="{{route('prayer-and-lunch')}}"> <img style="width:40px;" src="{{asset('uploads/icons')}}/gratis-png-mezquita.png" alt="" class="img-fluid shadow img-circle"> </a></li>

                    <li class="nav-item">
                        <a rel="nofollow" id="notify-btn" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="{{__('Notifications')}}">
                            <i class="dripicons-bell"></i>

                                <span class="badge badge-danger">

                                </span>

                        </a>
                        <ul class="right-sidebar">
                            <li class="header">
                                <span class="pull-right"><a href="">{{__('Clear All')}}</a></span>
                                <span class="pull-left"><a href="">{{__('See All')}}</a></span>
                            </li>

                                <li><a class="" href="">Notification</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item">

                                <img class="profile-photo sm mr-1"
                                     src="{{ asset('/uploads/profile_photos/avatar.png')}}">

                            <span> {{Auth::user()->name}} </span>
                        </a>
                        <ul class="right-sidebar">
                            <li>
                                <a href="">
                                    <i class="dripicons-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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

                    <li class="active"><a
                                href="{{route('home')}}"> <div class="CheckStyle"><span>Dashboard</span><i style="color:white;"
                                    class="dripicons-meter"></i></div></a>
                    </li>
                    <?php
                    use App\Models\Module;
                    // use App\Models\SubModule;
                    // use App\Models\Permission;

                    ?>


                    @if(Module::where('id','=', 1)->where('com_id','=', Auth::user()->com_id)->where('role_id','=', Auth::user()->role_id)->exists())

                    <li class="has-dropdown @if(request()->is('user*')){{ (request()->is('user*')) ? 'active' : '' }}@elseif(request()->is('add-user*')){{ (request()->is('add-user*')) ? 'active' : '' }}@endif">
                        <a href="#users" aria-expanded="false" data-toggle="collapse"> <div class="CheckStyle"><span>User</span><i style="color:white;"
                                    class="dripicons-user"></i></div></a>
                        <ul id="users" class="collapse list-unstyled ">
                               {{-- @if(SubModule::where('id','=', 1)->where('module_id','=', 1)->where('com_id','=', Auth::user()->com_id)->where('role_id','=', Auth::user()->role_id)->exists())
                                <li id="users-menu"><a href="{{route('user-lists')}}">{{__('Users List')}}</a></li>
                                @endif
                                @if(SubModule::where('id','=', 2)->where('module_id','=', 1)->where('com_id','=', Auth::user()->com_id)->where('role_id','=', Auth::user()->role_id)->exists())
                                <li id="user-roles"><a href="">{{__('User Roles and Access')}}</a></li>
                                @endif
                                @if(SubModule::where('id','=', 3)->where('module_id','=', 1)->where('com_id','=', Auth::user()->com_id)->where('role_id','=', Auth::user()->role_id)->exists())
                                <li id="user-last-login"><a href="">{{__('Users Last Login')}}</a>
                                @endif
                                </li>--}}

                                <li id="users-menu"><a href="{{route('user-lists')}}">{{__('Users List')}}</a></li>
                                <li id="user-roles"><a href="">{{__('User Roles and Access')}}</a></li>
                                <li id="user-last-login"><a href="">{{__('Users Last Login')}}</a>
                               </li>
                        </ul>
                    </li>
                  @endif
                  @if(Module::where('id','=', 2)->where('com_id','=', Auth::user()->com_id)->where('role_id','=', Auth::user()->role_id)->exists())
                    <li class="has-dropdown {{ (request()->is('staff*')) ? 'active' : '' }}">
                        <a href="#employees" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i class="dripicons-user-group"></i><span>Employees</span></div></a>
                        <ul id="employees" class="collapse list-unstyled ">

                                <li id="employee_list"><a href="{{route('employee-lists')}}">Employee Lists</a></li>


                                <li id="user-import"><a href="{{route('import-employee')}}">{{__('Import Employees')}}</a>
                                </li>

                        </ul>
                    </li>
                    @endif
                    <li class="has-dropdown {{ (request()->is('settings*')) ? 'active' : '' }}"><a
                                href="#Customize_settings" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i
                                    class="dripicons-toggles"></i><span>{{__('Customize Setting')}}</span></div></a>
                        <ul id="Customize_settings" class="collapse list-unstyled ">

                                <li id="roles"><a href="{{route('roles-and-accesses')}}">{{__('Roles and Access')}}</a></li>

                                <li id="general_settings"><a
                                            href="{{route('general-settings')}}">{{__('General Settings')}}</a>
                                </li>
                                <li id="mail_setting"><a
                                            href="{{route('mail-settings')}}">{{__('Mail Setting')}}</a>
                                </li>


                                <li id="language_switch"><a
                                            href="{{route('language-settings')}}">{{__('Language Settings')}}</a>
                                </li>

                                <li id="variable_type"><a
                                            href="{{route('variable-type')}}">{{__('Variable Type')}}</a>
                                </li>

                                <li id="variable_method"><a
                                            href="{{route('variable-method')}}">{{__('Variable Method')}}</a>
                                </li>

                                <li id="ip_setting"><a href="{{route('ip-settings')}}">{{__('IP Settings')}}</a></li>

                                    <li id="ip_setting"><a href="{{route('tax-configs')}}">{{__('Tax Configure')}}</a></li>



                                    <li id="ip_setting"><a href="{{route('salary-configs')}}">{{__('Salary Config')}}</a></li>

                                    <li id="ip_setting"><a href="{{route('salary-components')}}">{{__('Salary Component')}}</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown {{ (request()->is('core_hr*')) ? 'active' : '' }}"><a href="#Core_hr"
                                                                                                  aria-expanded="false"
                                                                                                  data-toggle="collapse">
                                                                                                  <div class="CheckStyle"> <i class="dripicons-briefcase"></i><span>{{__('Core HR')}}</span></div></a>
                        <ul id="Core_hr" class="collapse list-unstyled ">


                                <li id="promotion"><a
                                            href="{{route('promotion')}}">Promotion</a>
                                </li>

                                <li id="award"><a href="{{route('award')}}">Award</a></li>

                                <li id="travel"><a href="{{route('travel')}}">Travel</a></li>

                                <li id="transfer"><a href="{{route('transfer')}}">Transfer</a>
                                </li>

                                <li id="resignation"><a
                                            href="{{route('resignation')}}">Resignations</a>
                                </li>

                                <li id="complaint"><a
                                            href="{{route('complaint')}}">Complaints</a>
                                </li>

                                <li id="warning"><a href="{{route('warning')}}">Warnings</a>
                                </li>

                                <li id="termination"><a
                                            href="{{route('termination')}}">Terminations</a>
                                </li>

                                    <li id="provident"><a
                                            href="{{route('provident-fund-member')}}">{{__('Provident Found Member')}}</a>
                                    </li>
                        </ul>
                    </li>


                    <li class="has-dropdown {{ (request()->is('organization*')) ? 'active' : '' }}"><a href="#Organization"
                                                                                                   aria-expanded="false"
                                                                                                   data-toggle="collapse">
                                                                                                   <div class="CheckStyle">
                        <i class="dripicons-view-thumb"></i><span>Organization</span></div></a>
                    <ul id="Organization" class="collapse list-unstyled ">

                            <li id="company"><a href="{{route('companies')}}">Company</a></li>

                            <li id="department"><a href="{{route('departments')}}">Department</a></li>

                            <li id="department"><a href="{{route('allowance-heads')}}">Allowance Head</a></li>

                            <li id="location"><a href="{{route('locations')}}">Location</a></li>

                            <li id="location"><a href="{{route('attandance-locations')}}">{{__('Attendance Location')}}</a></li>

                            <li id="location"><a href="{{route('login-histories')}}">{{__('Login History')}}</a></li>

                                    <li id="location"><a href="{{route('login-id-locations')}}">{{__('Login ID Location')}}</a></li>

                            <li id="location"><a href="{{route('regions')}}">{{__('Region')}}</a></li>

                            <li id="location"><a href="{{route('areas')}}">{{__('Area')}}</a></li>

                            <li id="location"><a href="{{route('territories')}}">{{__('Territory')}}</a></li>

                                <li id="location"><a href="{{route('towns')}}">{{__('Town')}}</a></li>

                                <li id="location"><a href="{{route('db-houses')}}">{{__('DB House')}}</a></li>

                            <li id="designation"><a
                                        href="{{route('designations')}}">Designation</a>
                            </li>


                        <li id="announcements"><a
                                    href="{{route('announcement')}}">Announcements</a></li>

                        <li id="company_policy"><a href="{{route('company-policy')}}">{{__('Company Policy')}}</a>
                        </li>

                    </ul>
                </li>



                <li class="has-dropdown {{ (request()->is('timesheet*')) ? 'active' : '' }}"><a href="#Timesheets"
                                                                                                    aria-expanded="false"
                                                                                                    data-toggle="collapse">
                                                                                                    <div class="CheckStyle">
                            <i class="dripicons-clock"></i><span>Timesheets</span></div></a>
                        <ul id="Timesheets" class="collapse list-unstyled ">

                                <li id="attendance"><a
                                            href="{{route('attandance')}}">Attendances</a>
                                </li>
                                <li id="date_wise_attendance"><a
                                            href="{{route('date-wise-attandance')}}"> {{__('Date wise Attendances')}}</a>
                                </li>


                                <li id="monthly_attendance"><a
                                            href="{{route('monthly-attandance')}}"> {{__('Monthly Attendances')}}</a>
                                </li>



                                <li id="update_attendance"><a
                                            href="{{route('update-attandance')}}"> {{__('Update Attendances')}}</a>
                                </li>



                                <li id="import_attendance"><a
                                            href="{{route('import-attandance')}}"> {{__('Import Attendances')}}</a>
                                </li>

                                <li id="office_shift"><a
                                            href="{{route('office-shifts')}}">{{__('Office Shift')}}</a>
                                </li>

                                <li id="holiday"><a href="{{route('manage-holidays')}}">{{__('Manage Holiday')}}</a></li>

                                <li id="leave"><a href="{{route('manage-leave')}}">{{__('Manage Leaves')}}</a></li>

                        </ul>
                    </li>

                    <li class="has-dropdown {{ (request()->is('payroll*')) ? 'active' : '' }}"><a href="#Payroll"
                                                                                                  aria-expanded="false"
                                                                                                  data-toggle="collapse">
                                                                                                  <div class="CheckStyle">
                            <i
                                    class="dripicons-wallet"></i><span>Payroll</span></div></a>
                        <ul id="Payroll" class="collapse list-unstyled">

                                <li><a href="{{route('new-payment')}}">{{__('New Payment')}}</a>
                                </li>

                                <li><a href="{{route('payment-histories')}}">{{__('Payment History')}}</a>
                                </li>


                        </ul>
                    </li>

                    <li class="has-dropdown {{ (request()->is('performance*')) ? 'active' : '' }}"><a href="#performance" aria-expanded="false" data-toggle="collapse"> <div class="CheckStyle"><i class="fa fa-bar-chart"></i><span>Performance</span></div></a>
                            <ul id="performance" class="collapse list-unstyled ">

                                    <li id="goal-type"><a href="{{route('goal-type')}}">{{__('Goal type')}}</a></li>

                                    <li id="goal-tracking"><a href="{{route('goal-trackings')}}">{{__('Goal Tracking')}}</a></li>

                                    <li id="indicator"><a href="{{route('indicators')}}">{{__('Indicator')}}</a></li>

                                    <li id="appraisal"><a href="{{route('appraisals')}}">{{__('Appraisal')}}</a></li>

                            </ul>
                    </li>

                    <li class="{{ (request()->is('calendar*')) ? 'active' : '' }}"><a
                                href="{{route('hr-calendars')}}"> <div class="CheckStyle"><i
                                    class="dripicons-calendar"></i><span>{{__('HR Calendar')}}</span></div></a>
                    </li>

                    <li class="has-dropdown {{ (request()->is('report*')) ? 'active' : '' }}"><a href="#HR_Reports"
                                                                                                 aria-expanded="false"
                                                                                                 data-toggle="collapse">
                                                                                                 <div class="CheckStyle">
                            <i class="dripicons-document"></i><span>{{__('HR Reports')}}</span></div></a>
                        <ul id="HR_Reports" class="collapse list-unstyled ">

                            {{--
                                <li id="payslip_report"><a
                                            href="">{{__('Payslip Report')}}</a>
                                </li>
                             --}}

                                <li id="attendance_report"><a
                                            href="{{route('attandance-reports')}}">{{__('Attendance Report')}}</a>
                                </li>

                                <li id="training_report"><a
                                            href="{{route('training-reports')}}">{{__('Training Report')}}</a>
                                </li>

                                <li id="project_report"><a
                                            href="{{route('project-reports')}}">{{__('Project Report')}}</a>
                                </li>

                                <li id="task_report"><a
                                            href="{{route('task-reports')}}">{{__('Task Report')}}</a></li>

                                <li id="employees_report"><a
                                            href="{{route('employee-reports')}}">{{__('Employees Report')}}</a>
                                </li>

                                <li id="account_report"><a
                                            href="{{route('account-reports')}}">{{__('Account Report')}}</a>
                                </li>

                                <li id="expense_report"><a
                                            href="{{route('expense-reports')}}">{{__('Expense Report')}}</a>
                                </li>

                                <li id="deposit_report"><a
                                            href="{{route('deposite-reports')}}">{{__('Deposit Report')}}</a>
                                </li>

                                <li id="transaction_report"><a
                                            href="{{route('transaction-reports')}}">{{__('Transaction Report')}}</a>
                                </li>


                            <li id="pension_report"><a href="{{route('pension-reports')}}">{{__('Pension Report')}}</a></li>
                        </ul>
                    </li>


                    <li class="has-dropdown {{ (request()->is('recruitment*')) ? 'active' : '' }}"><a
                                href="#Recruitment" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i
                                    class="dripicons-user-id"></i><span>Recruitment</span></div></a>
                        <ul id="Recruitment" class="collapse list-unstyled ">


                                <li id="job_post"><a
                                            href="{{route('job-posts')}}">{{__('Job Post')}}</a></li>

                                <li id="job_candidate"><a
                                            href="{{route('job-candidate')}}">{{__('Job Candidates')}}</a>
                                </li>

                                <li id="job_interview"><a
                                            href="{{route('job-interviews')}}">{{__('Job Interview')}}</a>
                                </li>

                                <li id="cms"><a
                                            href="{{route('job-portals')}}">{{__('CMS')}}</a>
                                </li>

                        </ul>
                    </li>

                    <li class="has-dropdown @if(request()->is('training*')){{ (request()->is('training*')) ? 'active' : '' }}@elseif(request()->is('dynamic_variable/training_type*')){{ (request()->is('dynamic_variable/training_type*')) ? 'active' : '' }}@endif">
                        <a href="#Training" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i
                                    class="dripicons-trophy"></i><span>Training</span></div></a>
                        <ul id="Training" class="collapse list-unstyled ">

                                <li id="training_list"><a
                                            href="{{route('training-lists')}}">{{__('Training List')}}</a>
                                </li>

                                <li id="training_type"><a
                                            href="{{route('training-types')}}">{{__('Training Type')}}</a>
                                </li>

                                <li id="trainers"><a
                                            href="{{route('trainer')}}">Trainers</a>
                                </li>

                        </ul>
                    </li>




                    <li class="has-dropdown @if(request()->is('events*')){{ (request()->is('events*')) ? 'active' : '' }}@elseif(request()->is('meetings*')){{ (request()->is('meetings*')) ? 'active' : '' }}@endif">
                        <a href="#Events_Meetings" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i
                                    class="dripicons-to-do"></i><span>Events & Meetings</span></div></a>
                        <ul id="Events_Meetings" class="collapse list-unstyled ">

                                <li id="events"><a
                                            href="{{route('event')}}">Events</a>
                                </li>

                                <li id="meetings"><a
                                            href="{{route('meeting')}}">Meetings</a>
                                </li>

                        </ul>

                    </li>

                        <li class="has-dropdown {{ (request()->is('project-management*')) ? 'active' : '' }}"><a
                                    href="#Project_Management" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i
                                        class="dripicons-checklist"></i><span>{{__('Project Management')}}</span></div></a>
                            <ul id="Project_Management" class="collapse list-unstyled ">

                                    <li id="projects"><a
                                                href="{{route('project')}}">Projects</a>
                                    </li>

                                    <li id="tasks"><a
                                                href="{{route('task')}}">Tasks</a>
                                    </li>

                                    <li id="clients"><a
                                                href="{{route('client')}}">Clients</a>
                                    </li>

                                    <li id="invoices"><a
                                                href="{{route('invoices')}}">Invoice</a>
                                    </li>

                                    <li id="tax_type"><a
                                                href="{{route('tax-types')}}">Tax Type</a>
                                    </li>

                            </ul>
                        </li>



                        <li class="{{ (request()->is('tickets*')) ? 'active' : '' }}"><a
                                    href="{{route('support-ticket')}}"><div class="CheckStyle"> <i
                                        class="dripicons-ticket"></i><span>Support Tickets</span></div></a>
                        </li>



                        <li class="has-dropdown {{ (request()->is('accounting*')) ? 'active' : '' }}"><a href="#Finance"
                                                                                                         aria-expanded="false"
                                                                                                         data-toggle="collapse">
                                                                                                         <div class="CheckStyle">
                                <i
                                        class="dripicons-graph-pie"></i><span>Finance</span></div></a>
                            <ul id="Finance" class="collapse list-unstyled ">

                                    <li id="accounting_list"><a
                                                href="{{route('account-lists')}}">{{__('Accounts List')}}</a>
                                    </li>

                                    <li id="account_balances"><a
                                                href="{{route('account-balance')}}">{{__('Account Balances')}}</a>
                                    </li>

                                    <li id="payees"><a
                                                href="{{route('payees')}}">Payee</a>
                                    </li>

                                    <li id="payers"><a
                                                href="{{route('payers')}}">Payer</a>
                                    </li>

                                    <li id="deposit"><a
                                                href="{{route('deposites')}}">Deposit</a>
                                    </li>

                                    <li id="expense"><a
                                                href="{{route('expenses')}}">Expense</a>
                                    </li>

                                    <li id="transactions"><a
                                                href="{{route('transactions')}}">Transaction</a>
                                    </li>

                                    <li id="finance_transfer"><a
                                                href="{{route('transfer')}}">Transfer</a>
                                    </li>

                            </ul>
                        </li>


                    <li class="has-dropdown @if(request()->is('assets*')){{ (request()->is('assets*')) ? 'active' : '' }}@elseif(request()->is('dynamic_variable/assets_category*')){{ (request()->is('dynamic_variable/assets_category*')) ? 'active' : '' }}@endif">
                        <a href="#assets" aria-expanded="false" data-toggle="collapse"> <div class="CheckStyle"><i
                                    class="dripicons-box"></i><span>Assets</span></div></a>
                        <ul id="assets" class="collapse list-unstyled ">

                                <li id="assets_category"><a
                                    href="{{route('category')}}">Category</a>
                                </li>

                                <li id="assets">
                                    <a href="{{route('asset')}}">Assets</a>
                                </li>

                        </ul>
                    </li>

                        <li class="has-dropdown {{ (request()->is('file_manager*')) ? 'active' : '' }}"><a
                                    href="#file_manager" aria-expanded="false" data-toggle="collapse"><div class="CheckStyle"> <i
                                        class="dripicons-archive"></i><span>{{__('File Manager')}}</span></div></a>
                            <ul id="file_manager" class="collapse list-unstyled ">


                                    <li id="files"><a
                                                href="{{route('file-managers')}}">{{__('File Manager')}}</a>
                                    </li>

                                    <li id="official_documents"><a
                                                href="{{route('official-document')}}">{{__('Official Documents')}}</a>
                                    </li>



                                    <li id="file_config"><a
                                                href="{{route('file-configurations')}}">{{__('File Configuration')}}</a>
                                    </li>

                            </ul>
                        </li>


            </ul>
        </div>
    </div>
</nav>


<div id="content" class="page animate-bottom d-none">


<!-- Content Section starts from here  -->

   @yield('content')

<!-- Content Section ends here  -->

    <footer class="main-footer">
        <div class="container-fluid">
            <p>&copy; | {{ __('Developed by')}} <a
                        href="https://www.predictionla.com" class="external">{{ __('Prediction')}}</a></p>
        </div>
    </footer>
</div>



</body>
</html>
