@extends('back-end.premium.layout.super-system-admin-main')
@section('content')
<?php

    //echo $package_id; exit;

    use App\Models\Package;

    $dashboard_module = '0';

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
    // $customize_sub_module_twelve = '3.12';
    // $customize_sub_module_thirteen = '3.13';
    $customize_sub_module_fourteen = '3.14';
    $customize_sub_module_fifteen = '3.15';
    $customize_sub_module_sixteen = '3.16';
    $customize_sub_module_seventeen = '3.17';
    // $customize_sub_module_eighteen = '3.18';
    // $customize_sub_module_nineteen = '3.19';
    // $customize_sub_module_twenty = '3.20';
    // $customize_sub_module_tweenty_one = '3.21';
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
    $core_hr_sub_module_fifteen = "4.15";
    $core_hr_sub_module_sixteen = "4.16";

    $organization_module = '5';
    $organization_sub_module_one = '5.1';
    $organization_sub_module_two = '5.2';
    $organization_sub_module_three = '5.3';
    $organization_sub_module_four = '5.4';
    $organization_sub_module_five = '5.5';
    $organization_sub_module_six = '5.6';
    $organization_sub_module_seven = '5.7';
    $organization_sub_module_eight = '5.8';

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
    $organization_sub_module_twentytwo = '5.22';
    $organization_sub_module_twentythree = '5.23';
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
    $hr_report_sub_module_twelve = '9.12';
    $hr_report_sub_module_thirteen = '9.13';
    $hr_report_sub_module_eleven = '9.11';
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

    $recruitment_module = '16';
    $recruitment_sub_module_one = '16.1';
    $recruitment_sub_module_two = '16.2';
    $recruitment_sub_module_three = '16.3';

    $training_module = '17';
    $training_sub_module_one = '17.1';
    $training_sub_module_two = '17.2';
    $training_sub_module_three = '17.3';

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

    $probation_module = '19';
    $core_probation_sub_module_one = '19.1';
    $core_probation_sub_module_two = '19.2';

    $finger_print_module = '20';
    $finger_print_sub_module_one = '20.1';
    $finger_print_sub_module_two = '20.2';
    $finger_print_sub_module_three = '20.3';
    $finger_print_sub_module_four = '20.4';
    $finger_print_sub_module_five = '20.5';
    $finger_print_sub_module_six = '20.6';


    ?>
<section class="main-contant-section">

    <div class="container-fluid mb-3">

        @if (Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>

    <div class="container">

        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="text-center mt-2">{{ $package_name }} Package</h1>
            </div>
        </div>
        <p>You can assign permission for this package</p>

        <form method="post" id="permission-dashboard" action="{{ route('package-permission-givings') }}"
            class="form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <input type="hidden" name="package_id" value="{{ $package_id }}">

                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-user-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $dashboard_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="dashboard_module"
                            value="0">Dashboard</h2>
                    </div>

                </div>



                {{-- <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-user-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $user_module . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="user_module" value="1"
                            id="usersAll">Users</h2>

                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="user-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $user_sub_module_one .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-module-check" type="checkbox" name="user_sub_module_one"
                            value="1.1">User List</span></div>


                    </div>
                </div> --}}


                {{-- <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-employee-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $employee_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="employee_module"
                            value="2" id="employeeAll">Employees</h2>

                    </div>
                    <div class="permission-container">

                    </div>
                </div> --}}





                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-customize-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $customize_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="customize_module"
                            value="3" id="customizeAll">Common Settings</h2>

                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $customize_sub_module_one
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_one" value="3.1">Roles</div>
                        <div style="margin-left:70px;" class="customize-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $customize_sub_module_two
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_two" value="3.2">Access Permission</div>
                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_three" value="3.3">Variable Type</div>
                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_four" value="3.4">Variable Method</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_fourteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_fourteen" value="3.14">Upazila</div>


                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_fifteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_fifteen" value="3.15">Union</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_three" value="3.23">Minimum Tax Configure</div>


                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_five" value="3.5">Tax Configure</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_five" value="3.25">Minimum House Rent Non Taxable
                            Configure
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_six . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_six" value="3.26">Minimum Medical Allowance Non Taxable
                            Configure
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_seven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_seven" value="3.27">Minimum Conveyance Allowance Non
                            Taxable Configure
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $customize_sub_module_six
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_six" value="3.6">Salary Configure</div>
                        {{-- <div style="margin-left:70px;" class="customize-module"> <input
                                class="form-check-input customize-module-check" type="checkbox" value="3.7">Salary
                            Component</div> --}}

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_two" value="3.22">Festival Config</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_eight" value="3.8">Festival Month Config</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_eight" value="3.28">Yearly Festival Bonus Configure</div>



                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_tweenty_four
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_tweenty_four" value="3.24">Late Time Salary Config</div>


                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_eleven" value="3.11">Company PF Config</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_sixteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_sixteen" value="3.16"> Company Bank Account
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_seventeen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_seventeen" value="3.17"> Company Bank Account
                            Communication
                        </div>

                    </div>
                </div>


                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-customize-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $template_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="template_module"
                            value="18" id="customizeAll"> Template Settings </h2>

                    </div>
                    <div class="permission-container">

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_ten . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_ten" value="18.10">Header Config
                        </div>
                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_one" value="18.1">Footer Config
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_two" value="18.2">Appointment Letter Template
                        </div>
                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_three" value="18.3"> Warning Letter Format
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_four" value="18.4"> Probation Letter Format
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>

                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_five" value="18.5">NOC (Non Objection Certificate) Template
                        </div>


                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_six . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_six" value="18.6">Resign Acceptance Letter Template
                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_seven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_seven" value="18.7" id="checkbox_id"> <label
                                for="checkbox_id">Salary Certificate</label>

                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_eight" value="18.8" id=""> <label for="">Contact Renewal
                                Letter</label>

                        </div>
                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_nine . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_nine" value="18.9" id="experience_letter_template_id"> <label
                                for="experience_letter_template_id">Expericene Letter Template</label>

                        </div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $template_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="template_sub_module_eleven" value="18.11" id="salary_cirtificate_letter_id"> <label
                                for="salary_cirtificate_letter_id">Salary Increment Letter Template</label>

                        </div>

                    </div>
                </div>



                <div class="col-md-12 form-group">

                    <div class="permission-title">
                        <span class="select-core-hr-module dropdown-toggle"></span>

                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="core_hr_module"
                            value="4" id="coreHrAll">Core HR</h2>

                    </div>
                    <div class="permission-container">


                        <div style="margin-left:70px;" class="employee-module"><input <?php if ( Package::where('id',
                            $package_id) ->whereRaw('json_contains(package_module, \'["' . $employee_sub_module_one
                        . '"]\')')
                        ->exists()
                        ) {
                        echo 'checked';
                        } ?>
                        class="form-check-input employee-module-check" type="checkbox"
                        name="employee_sub_module_one" value="2.1">Employee List</div>
                    <div style="margin-left:70px;" class="employee-module"> <input <?php if ( Package::where('id',
                            $package_id) ->whereRaw('json_contains(package_module, \'["' . $employee_sub_module_two
                        . '"]\')')
                        ->exists()
                        ) {
                        echo 'checked';
                        } ?>
                        class="form-check-input employee-module-check" type="checkbox"
                        name="employee_sub_module_two" value="2.2">Import Employees</div>
                    <div style="margin-left:70px;" class="user-module"> <input <?php if ( Package::where('id',
                            $package_id) ->whereRaw('json_contains(package_module, \'["' . $user_sub_module_two .
                        '"]\')')
                        ->exists()
                        ) {
                        echo 'checked';
                        } ?>
                        class="form-check-input user-module-check" type="checkbox" name="user_sub_module_two"
                        value="1.2">Assigning Rules</div>
                    <div style="margin-left:70px;" class="user-module"> <input <?php if ( Package::where('id',
                            $package_id) ->whereRaw('json_contains(package_module, \'["' . $user_sub_module_three .
                        '"]\')')
                        ->exists()
                        ) {
                        echo 'checked';
                        } ?>
                        class="form-check-input user-module-check" type="checkbox" name="user_sub_module_three"
                        value="1.3">Users Last Login</div>

                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_hr_sub_module_thirteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_thirteen" value="4.13">Bulk Renew</span></div>


                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_one .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_one" value="4.1">Promotion/Demotion</span></div>


                        {{-- <div style="margin-left:70px;" class="core-hr-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_hr_sub_module_twelve . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_twelve" value="4.12">Employee Probation Increment </span></div>
                        --}}


                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_hr_sub_module_fifteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_fifteen" value="4.15">Employee Increment </span></div>


                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_two .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_two" value="4.2">Award</div>


                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_three
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_three" value="4.3">Travel</div>
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_four
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_four" value="4.4">Transfer</div>
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_five
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_five" value="4.5">Resignations</div>
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_six .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_six" value="4.6">Complaints</div>
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_seven
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_seven" value="4.7">Warnings</div>
                        <div style="margin-left:70px;" class="core-hr-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_eight
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_eight" value="4.8">Termination</div>
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_nine
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_nine" value="4.9">Eligible PF Members</div>
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $core_hr_sub_module_ten .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_ten" value="4.10">PF Membership Taking</div>
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_hr_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_eleven" value="4.11">PF Bank Account</div>
                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_hr_sub_module_fourteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_fourteen" value="4.14">NOC</div>

                        <div style="margin-left:70px;" class="core-hr-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_hr_sub_module_sixteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input core-hr-module-check" type="checkbox"
                            name="core_hr_sub_module_sixteen" value="4.16">Contact Renewal List</div>

                            <div style="margin-left:70px;" class="core-probation-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_probation_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input probation-module-check" type="checkbox"
                            id="core_probation_sub_module_one"
                            name="core_probation_sub_module_one" value="19.1">
                            <label style="user-select: none;" for="core_probation_sub_module_one">Probation Review
                                List</label>

                            </span>
                        </div>

                        <div style="margin-left:70px;" class="core-probation-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $core_probation_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input probation-module-check" type="checkbox"
                            name="core_probation_sub_module_two" id="core_probation_sub_module_two" value="19.2">
                            <label style="user-select: none;" for="core_probation_sub_module_two">Recommendation
                                List</label>

                            </span>
                        </div>
                    </div>

                </div>

                {{-- <div class="col-md-12 form-group">

                    <div class="permission-title">
                        <span class="select-core-probation-module dropdown-toggle"></span>

                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $probation_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="probation_module"
                            value="19" id="probationAll">Probation
                        </h2>

                    </div>
                    <div class="permission-container">

                    </div>

                </div> --}}





                <div class="col-md-12 form-group">

                    <div class="permission-title">
                        <span class="select-organization-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $organization_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" value="5"
                            name="organization_module" id="organizationAll">Organization</h2>

                    </div>

                    <div class="permission-container">
                        {{-- <div style="margin-left:70px;" class="organization-module"> <input
                                class="form-check-input organization-module-check" type="checkbox" value="">Company
                            Organogram</div> --}}
                        <div style="margin-left:70px;" class="organization-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_one" value="5.1">Company</div>
                        <div style="margin-left:70px;" class="organization-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_twentytwo . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twentytwo" value="5.22">Organization Configarations
                        </div>
                        <div style="margin-left:70px;" class="organization-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_twentythree . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twentythree" value="5.23">Man Power</div>
                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_two" value="5.2">Department</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_three" value="5.3">Allowance Head</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_twentyfour . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twentyfour" value="5.24">Lunch Bill</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_four" value="5.4">Region</div>
                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_five" value="5.5">Area</div>
                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_six . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_six" value="5.6">Territory</div>
                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_seven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_seven" value="5.7">Town</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_eight" value="5.8">DB House</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_twelve . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_twelve" value="5.12">Location 6</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_thirteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_thirteen" value="5.13">Location 7</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_fourteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_fourteen" value="5.14">Location 8</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_fifteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_fifteen" value="5.15">Location 9</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_sixteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_sixteen" value="5.16">Location 10</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_seventeen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_seventeen" value="5.17">Location 11</div>

                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_nine . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_nine" value="5.9">Designation</div>
                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_ten . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_ten" value="5.10">Announcements</div>
                        <div style="margin-left:70px;" class="organization-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $organization_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input organization-module-check" type="checkbox"
                            name="organization_sub_module_eleven" value="5.11">Company Policy</div>

                    </div>


                </div>



                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-time-sheet-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $time_sheet_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="time_sheet_module"
                            value="6" id="timeSheetAll">Time Sheets</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_one" value="6.1">Attendances</div>
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_two" value="6.2">Date Wise Attendances</div>
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_three" value="6.3">Monthly Attendances</div>
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_four" value="6.4">Update Attendances</div>
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_five" value="6.5">Import Attendances</div>
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_six . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_six" value="6.6">Office Shift</div>


                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $customize_sub_module_nine . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_nine" value="3.9">Over Time Config</div>

                        <div style="margin-left:70px;" class="customize-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $customize_sub_module_ten
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input customize-module-check" type="checkbox"
                            name="customize_sub_module_ten" value="3.10">Late Time Config</div>
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_seven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_seven" value="6.7">Manage Weekly Holiday</div>
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_eight" value="6.8">Manage Other Holiday</div>
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_nine . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_nine" value="6.9">Manage Leave Type</div>
                        <div style="margin-left:70px;" class="time-sheet-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_ten . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_ten" value="6.10">Manage All Leaves</div>
                        <div style="margin-left:70px;" class="time-sheet-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $time_sheet_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input time-sheet-module-check" type="checkbox"
                            name="time_sheet_sub_module_eleven" value="6.11">Approve Employee Leaves</div>

                    </div>


                </div>
                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-finger-print-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $finger_print_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="finger_print_module"
                            value="20" id="fingerPrintAll">Finger Print Device Configure</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="finger-print-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $finger_print_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input finger-print-module-check" type="checkbox"
                            name="finger_print_sub_module_five" value="20.5">IP Set</div>
                        <div style="margin-left:70px;" class="finger-print-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $finger_print_sub_module_six . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input finger-print-module-check" type="checkbox"
                            name="finger_print_sub_module_six" value="20.6">Token Generate</div>
                        <div style="margin-left:70px;" class="finger-print-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $finger_print_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input finger-print-module-check" type="checkbox"
                            name="finger_print_sub_module_one" value="20.1">Device Area</div>
            
                        <div style="margin-left:70px;" class="finger-print-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $finger_print_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input finger-print-module-check" type="checkbox"
                            name="finger_print_sub_module_two" value="20.2">Device List</div>

                        <div style="margin-left:70px;" class="finger-print-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $finger_print_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input finger-print-module-check" type="checkbox"
                            name="finger_print_sub_module_three" value="20.3">Employee Without Finger Print</div>
                        <div style="margin-left:70px;" class="finger-print-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $finger_print_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input finger-print-module-check" type="checkbox"
                            name="finger_print_sub_module_four" value="20.4">Employee With Finger Print</div>
                    </div>

                </div>



                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-pay-roll-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $payroll_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="payroll_module"
                            value="7" id="payRollAll">Payroll & Benefits</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $payroll_sub_module_one .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input pay-roll-module-check" type="checkbox"
                            name="payroll_sub_module_one" value="7.1">New Payment</div>

                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $payroll_sub_module_two .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input pay-roll-module-check" type="checkbox"
                            name="payroll_sub_module_two" value="7.2">Payment History</div>

                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $payroll_sub_module_four
                            .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input pay-roll-module-check" type="checkbox"
                            name="payroll_sub_module_four" value="7.5">Payment Festival Bounas </div>

                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $payroll_sub_module_five
                            .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input pay-roll-module-check" type="checkbox"
                            name="payroll_sub_module_five" value="7.4">Payment Festival Bounas History</div>

                        <div style="margin-left:70px;" class="pay-roll-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $payroll_sub_module_three
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input pay-roll-module-check" type="checkbox"
                            name="payroll_sub_module_three" value="7.3">Provident Fund History</div>



                    </div>

                </div>


                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-performance-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $performance_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="performance_module"
                            value="15" id="performanceAll">Performance</h2>

                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_one" value="15.1">Configarations</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_two" value="15.2">KPI/Objective Set</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_three" value="15.3">Employees Objectives</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_four" value="15.4">Yearly Performance Review Form</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_five" value="15.5">Yearly Performance Value Form</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_six . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_six" value="15.6">Eligible P/D Employee List</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_seven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_seven" value="15.7">Eligible Annual Increment List
                        </div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_eight" value="15.8">Increment Approval</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_nine . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_nine" value="15.9">Performance Report</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_ten . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_ten" value="15.10">Annual Increment Salary History</div>
                        <div style="margin-left:70px;" class="performance-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $performance_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input performance-module-check" type="checkbox"
                            name="performance_sub_module_eleven" value="15.11">Supervisor Recommendation</div>

                    </div>


                </div>

                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-recruitment-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $recruitment_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="recruitment_module"
                            value="16" id="recruitmentAll">Recruitment</h2>

                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="recruitment-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $recruitment_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input recruitment-module-check" type="checkbox"
                            name="recruitment_sub_module_one" value="16.1">Job Post</div>
                        <div style="margin-left:70px;" class="recruitment-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $recruitment_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input recruitment-module-check" type="checkbox"
                            name="recruitment_sub_module_two" value="16.2">Job Candidates</div>
                        <div style="margin-left:70px;" class="recruitment-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $recruitment_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input recruitment-module-check" type="checkbox"
                            name="recruitment_sub_module_three" value="16.3">Job Interview</div>

                    </div>

                </div>

                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-training-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $training_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="training_module"
                            value="17" id="trainingAll">Training</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="training-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $training_sub_module_one
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input training-module-check" type="checkbox"
                            name="training_sub_module_one" value="17.1">Training Type</div>
                        <div style="margin-left:70px;" class="training-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $training_sub_module_two
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input training-module-check" type="checkbox"
                            name="training_sub_module_two" value="17.2">Trainers</div>
                        <div style="margin-left:70px;" class="training-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $training_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input training-module-check" type="checkbox"
                            name="training_sub_module_three" value="17.3">Training List</div>

                    </div>

                </div>

                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-hr-calander-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $hr_calander_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="hr_calander_module"
                            value="8" id="hrCalanderAll">HR Calander</h2>

                    </div>

                </div>



                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-hr-report-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $hr_report_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="hr_report_module"
                            value="9" id="hrReportAll">HR Reports</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $hr_report_sub_module_one
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_one" value="9.1">Attendance Report</div>
                        {{--
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $hr_report_sub_module_two
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_two" value="9.2">Training Report</div>
                        --}}


                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_three" value="9.3">Project Report</div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_four . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_four" value="9.4">Task Report</div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_five . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_five" value="9.5">Employees Report
                        </div>



                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_twelve . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_twelve" value="9.12">Active Psr
                            Report</div>

                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_thirteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_thirteen" value="9.13">Employees
                            Recruitment Summary </div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_eleven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_eleven" value="9.11">Employees
                            Master
                            Report</div>

                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_fourteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_fourteen" value="9.14">
                            Orientation & Selected Report
                        </div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_fifteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_fifteen" value="9.15">
                            Separation Report
                        </div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_sixteen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_sixteen" value="9.16">
                            Salary Disburse Report
                        </div>

                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_seventeen . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input
                            hr-report-module-check"
                            type="checkbox" name="hr_report_sub_module_seventeen" value="9.17">
                            Festival Bounus Salary Disburse Report
                        </div>
                        {{--
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $hr_report_sub_module_six
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_six" value="9.6">Account Report</div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_seven . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_seven" value="9.7">Expense Report</div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_eight . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_eight" value="9.8">Deposit Report</div>
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $hr_report_sub_module_nine . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_nine" value="9.9">Transaction Report</div>
                        --}}
                        <div style="margin-left:70px;" class="hr-report-module"> <input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $hr_report_sub_module_ten
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input hr-report-module-check" type="checkbox"
                            name="hr_report_sub_module_ten" value="9.10">Provident Fund Report</div>

                    </div>


                </div>



                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-event-and-meeting-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $event_and_meeting_module
                            . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="event_and_meeting_module"
                            value="10" id="eventAndMeetingAll">Event & Meetings</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="event-and-meeting-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $event_and_meeting_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input event-and-meeting-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_one" value="10.1">Events</div>
                        <div style="margin-left:70px;" class="event-and-meeting-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $event_and_meeting_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input event-and-meeting-module-check" type="checkbox"
                            name="event_and_meeting_sub_module_two" value="10.2">Meetings</div>

                    </div>

                </div>





                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-project-management-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $project_management_module . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="project_management_module"
                            value="11" id="projectManagemnetAll">Project Management</h2>

                    </div>

                    <div class="permission-container">
                        <div style="margin-left:70px;" class="project-management-sub-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $project_management_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input project-management-sub-module-check"
                            name="project_management_sub_module_one" type="checkbox" value="11.1">Projects
                        </div>
                        <div style="margin-left:70px;" class="project-management-sub-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $project_management_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?> class="form-check-input project-management-sub-module-check"
                            name="project_management_sub_module_two" type="checkbox" value="11.2">Tasks</div>
                        {{--
                        <div style="margin-left:70px;" class="project-management-module"> <input
                                class="form-check-input project-management-module-check" type="checkbox"
                                value="">Clients</div>
                        <div style="margin-left:70px;" class="project-management-module"> <input
                                class="form-check-input project-management-module-check" type="checkbox"
                                value="">Invoice</div>
                        <div style="margin-left:70px;" class="project-management-module"> <input
                                class="form-check-input project-management-module-check" type="checkbox" value="">Tax
                            Type</div>
                        --}}
                    </div>

                </div>


                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-support-ticket-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $support_ticket_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="support_ticket_module"
                            value="12">Support Tickets</h2>

                    </div>

                </div>



                <div class="col-md-12 form-group">

                    <div class="permission-title">
                        <span class="select-asset-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $assets_module . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="assets_module"
                            value="13" id="assetAll">Assets</h2>

                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="asset-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $assets_sub_module_one .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input asset-module-check" type="checkbox"
                            name="assets_sub_module_one" value="13.1">Asset Category</div>
                        <div style="margin-left:70px;" class="asset-module"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $assets_sub_module_two .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input asset-module-check" type="checkbox"
                            name="assets_sub_module_two" value="13.2">Assets</div>

                    </div>

                </div>





                <div class="col-md-12 form-group">
                    <div class="permission-title">
                        <span class="select-file-manager-module dropdown-toggle"></span>
                        <h2 style="margin-left:33px;margin-top:-20px;"><input <?php if ( Package::where('id',
                                $package_id) ->whereRaw('json_contains(package_module, \'["' . $file_manager_module .
                            '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input user-check" type="checkbox" name="file_manager_module"
                            value="14" id="fileManagerAll">File Manager</h2>

                    </div>
                    <div class="permission-container">
                        <div style="margin-left:70px;" class="file-manager-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $file_manager_sub_module_one . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input file-manager-module-check" type="checkbox"
                            name="file_manager_sub_module_one" value="14.1">File Manager</div>
                        <div style="margin-left:70px;" class="file-manager-module"><input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $file_manager_sub_module_two . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input file-manager-module-check" type="checkbox"
                            name="file_manager_sub_module_two" value="14.2">Official Documents</div>
                        <div style="margin-left:70px;" class="file-manager-module"> <input <?php if (
                                Package::where('id', $package_id) ->whereRaw('json_contains(package_module, \'["' .
                            $file_manager_sub_module_three . '"]\')')
                            ->exists()
                            ) {
                            echo 'checked';
                            } ?>
                            class="form-check-input file-manager-module-check" type="checkbox"
                            name="file_manager_sub_module_three" value="14.3">File Configuration</div>

                    </div>


                </div>





                <div class="col-sm-12">
                    <input type="submit" name="action_button" class="btn btn-grad w-50" value="{{ __('Update') }}" />
                </div>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#usersAll").click(function() {
                $(".user-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-user-module").click(function() {
                $(".user-module").toggle();
            });


            $("#userlistAll").click(function() {
                $(".user-list-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-user-list-sub-module").click(function() {
                $(".user-list-sub-module").toggle();
            });


            $("#employeeAll").click(function() {
                $(".employee-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-employee-module").click(function() {
                $(".employee-module").toggle();
            });


            $("#employeelistAll").click(function() {
                $(".employee-list-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-employee-list-sub-module").click(function() {
                $(".employee-list-sub-module").toggle();
            });


            $("#customizeAll").click(function() {
                $(".customize-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-customize-module").click(function() {
                $(".customize-module").toggle();
            });


            $("#variabletypeAll").click(function() {
                $(".variable-type-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-variable-type-sub-module").click(function() {
                $(".variable-type-sub-module").toggle();
            });


            $("#variablemethodAll").click(function() {
                $(".variable-method-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-variable-method-sub-module").click(function() {
                $(".variable-method-sub-module").toggle();
            });

            $("#taxconfigAll").click(function() {
                $(".tax-config-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-tax-config-sub-module").click(function() {
                $(".tax-config-sub-module").toggle();
            });


            $("#salaryconfigAll").click(function() {
                $(".salary-config-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-salary-config-sub-module").click(function() {
                $(".salary-config-sub-module").toggle();
            });

            $("#festivalAll").click(function() {
                $(".festival-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-festival-sub-module").click(function() {
                $(".festival-sub-module").toggle();
            });


            $("#overtimeconfigAll").click(function() {
                $(".overtime-config-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-overtime-config-sub-module").click(function() {
                $(".overtime-config-sub-module").toggle();
            });

            $("#latetimeconfigAll").click(function() {
                $(".latetime-config-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-latetime-config-sub-module").click(function() {
                $(".latetime-config-sub-module").toggle();
            });

            $("#companypfconfigAll").click(function() {
                $(".company-pf-config-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-company-pf-config-sub-module").click(function() {
                $(".company-pf-config-sub-module").toggle();
            });


            $("#rulesAll").click(function() {
                $(".roles-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-roles-sub-module").click(function() {
                $(".roles-sub-module").toggle();
            });


            $("#coreHrAll").click(function() {
                $(".core-hr-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-core-hr-module").click(function() {
                $(".core-hr-module").toggle();
            });

            $("#probationAll").click(function() {
                $(".probation-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-core-probation-module").click(function() {
                $(".core-probation-module").toggle();
            });
            $("#promotionAll").click(function() {
                $(".promotion-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-promotion-sub-module").click(function() {
                $(".promotion-sub-module").toggle();
            });


            $("#awardAll").click(function() {
                $(".award-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-award-sub-module").click(function() {
                $(".award-sub-module").toggle();
            });


            $("#travelAll").click(function() {
                $(".travel-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-travel-sub-module").click(function() {
                $(".travel-sub-module").toggle();
            });


            $("#transferAll").click(function() {
                $(".transfer-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-transfer-sub-module").click(function() {
                $(".transfer-sub-module").toggle();
            });

            $("#resignationAll").click(function() {
                $(".resignation-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-resignation-sub-module").click(function() {
                $(".resignation-sub-module").toggle();
            });


            $("#complaintAll").click(function() {
                $(".complaint-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-complaint-sub-module").click(function() {
                $(".complaint-sub-module").toggle();
            });


            $("#warningAll").click(function() {
                $(".warning-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-warning-sub-module").click(function() {
                $(".warning-sub-module").toggle();
            });


            $("#terminationAll").click(function() {
                $(".termination-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-termination-sub-module").click(function() {
                $(".termination-sub-module").toggle();
            });


            $("#organizationAll").click(function() {
                $(".organization-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-organization-module").click(function() {
                $(".organization-module").toggle();
            });

            $("#allowanceheadAll").click(function() {
                $(".allowance-head-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-allowance-head-sub-module").click(function() {
                $(".allowance-head-sub-module").toggle();
            });

            $("#departmentAll").click(function() {
                $(".department-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-department-sub-module").click(function() {
                $(".department-sub-module").toggle();
            });

            $("#regionAll").click(function() {
                $(".region-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-region-sub-module").click(function() {
                $(".region-sub-module").toggle();
            });


            $("#areaAll").click(function() {
                $(".area-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-area-sub-module").click(function() {
                $(".area-sub-module").toggle();
            });



            $("#territoryAll").click(function() {
                $(".territory-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-territory-sub-module").click(function() {
                $(".territory-sub-module").toggle();
            });


            $("#townAll").click(function() {
                $(".town-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-town-sub-module").click(function() {
                $(".town-sub-module").toggle();
            });



            $("#dbhouseAll").click(function() {
                $(".db-house-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-db-house-sub-module").click(function() {
                $(".db-house-sub-module").toggle();
            });




            $("#designationAll").click(function() {
                $(".designation-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-designation-sub-module").click(function() {
                $(".designation-sub-module").toggle();
            });



            $("#announcementAll").click(function() {
                $(".announcement-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-announcement-sub-module").click(function() {
                $(".announcement-sub-module").toggle();
            });

            $("#companypolicyAll").click(function() {
                $(".company-policy-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-company-policy-sub-module").click(function() {
                $(".company-policy-sub-module").toggle();
            });


            $("#timeSheetAll").click(function() {
                $(".time-sheet-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-time-sheet-module").click(function() {
                $(".time-sheet-module").toggle();
            });

            $("#fingerPrintAll").click(function() {
                $(".finger-print-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-finger-print-module").click(function() {
                $(".finger-print-module").toggle();
            });


            $("#officeshiftAll").click(function() {
                $(".office-shift-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-office-shift-sub-module").click(function() {
                $(".office-shift-sub-module").toggle();
            });

            $("#weeklyholidayAll").click(function() {
                $(".weekly-holiday-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-weekly-holiday-sub-module").click(function() {
                $(".weekly-holiday-sub-module").toggle();
            });


            $("#otherholidayAll").click(function() {
                $(".other-holiday-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-other-holiday-sub-module").click(function() {
                $(".other-holiday-sub-module").toggle();
            });


            $("#leavetypeAll").click(function() {
                $(".leave-type-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-leave-type-sub-module").click(function() {
                $(".leave-type-sub-module").toggle();
            });


            $("#leaveAll").click(function() {
                $(".leave-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-leave-sub-module").click(function() {
                $(".leave-sub-module").toggle();
            });


            $("#payRollAll").click(function() {
                $(".pay-roll-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-pay-roll-module").click(function() {
                $(".pay-roll-module").toggle();
            });

            $("#performanceAll").click(function() {
                $(".performance-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-performance-module").click(function() {
                $(".performance-module").toggle();
            });

            $("#recruitmentAll").click(function() {
                $(".recruitment-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-recruitment-module").click(function() {
                $(".recruitment-module").toggle();
            });

            $("#trainingAll").click(function() {
                $(".training-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-training-module").click(function() {
                $(".training-module").toggle();
            });

            // $("#hrCalanderAll").click(function () {
            //   $(".hr-calander-module-check").prop('checked', $(this).prop('checked'));
            // });
            // $(".select-hr-calander-module").click(function(){
            //   $(".hr-calander-module").toggle();
            // });



            $("#hrReportAll").click(function() {
                $(".hr-report-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-hr-report-module").click(function() {
                $(".hr-report-module").toggle();
            });

            $("#eventAndMeetingAll").click(function() {
                $(".event-and-meeting-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-event-and-meeting-module").click(function() {
                $(".event-and-meeting-module").toggle();
            });

            $("#eventAll").click(function() {
                $(".event-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-event-sub-module").click(function() {
                $(".event-sub-module").toggle();
            });

            $("#meetingAll").click(function() {
                $(".meeting-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-meeting-sub-module").click(function() {
                $(".meeting-sub-module").toggle();
            });


            $("#projectManagemnetAll").click(function() {
                $(".project-management-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-project-management-module").click(function() {
                $(".project-management-sub-module").toggle();
            });


            $("#supportTicketAll").click(function() {
                $(".support-ticket-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-support-ticket-module").click(function() {
                $(".support-ticket-module").toggle();
            });


            $("#assetAll").click(function() {
                $(".asset-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-asset-module").click(function() {
                $(".asset-module").toggle();
            });

            $("#assetcategoryAll").click(function() {
                $(".asset-category-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-asset-category-sub-module").click(function() {
                $(".asset-category-sub-module").toggle();
            });

            $("#assetsAll").click(function() {
                $(".assets-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-assets-sub-module").click(function() {
                $(".assets-sub-module").toggle();
            });


            $("#fileManagerAll").click(function() {
                $(".file-manager-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-file-manager-module").click(function() {
                $(".file-manager-module").toggle();
            });

            $("#fileManagerSubModuleAll").click(function() {
                $(".file-manager-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-file-manager-sub-module").click(function() {
                $(".file-manager-sub-module").toggle();
            });

            $("#officialdocumentAll").click(function() {
                $(".official-document-sub-module-check").prop('checked', $(this).prop('checked'));
            });
            $(".select-official-document-sub-module").click(function() {
                $(".official-document-sub-module").toggle();
            });








            // edit form submission starts

            // $('#permission_form').submit(function(e) {
            //       e.preventDefault();
            //       let formData = new FormData(this);
            //       console.log(formData);
            //       $('#error-message').text('');

            //       $.ajax({
            //           type:'POST',
            //           url: `/permission-giving`,
            //           data: formData,
            //           contentType: false,
            //           processData: false,
            //           success: (response) => {
            //               window.location.reload();
            //               if (response) {
            //               this.reset();
            //               alert('Data has been updated successfully');
            //               }
            //           },
            //           error: function(response){
            //               console.log(response);
            //                   $('#error-message').text(response.responseJSON.errors.file);
            //           }
            //       });
            //   });

            // edit form submission ends



        });
</script>
@endsection
