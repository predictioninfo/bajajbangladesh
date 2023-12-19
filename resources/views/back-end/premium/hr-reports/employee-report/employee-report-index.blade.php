@extends('back-end.premium.layout.premium-main')

@section('content')

<?php

    use App\Models\User;
    use App\Models\Permission;
    use App\Models\Attendance;
    use App\Models\Package;
    use App\Models\EmployeeDetail;

    $employee_sub_module_one_add = '2.1.1';
    $employee_sub_module_one_edit = '2.1.2';
    $employee_sub_module_one_delete = '2.1.3';
    //use DateTime;
    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');
    //$current_time = $date->format('H:i:s');

    $user_sub_module_one_add = '1.1.1';
    $user_sub_module_one_edit = '1.1.2';
    $user_sub_module_one_delete = '1.1.3';

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
<script>
    $(document).ready(function() {
            $("select").change(function() {
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });
</script>

<section class="main-contant-section">

    <div class=""><span id="general_result"></span></div>


    <div class=" mb-3">

        @if (Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>

    <div class="">
        <div class="card mb-0">


            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Employee Report') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">{{ 'Employee Report' }} </a></li>
                    </ol>
                </div>

                <div class="content-box">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <form method="post" action="{{ route('employee-report-filterings') }}">
                                    @csrf


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-bold">{{ __('Company') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="company_id" id="company_id"
                                                    class="form-control selectpicker dynamic" data-live-search="true"
                                                    data-live-search-style="begins" data-shift_name="shift_name"
                                                    data-dependent="department_name"
                                                    title="{{ __('Selecting', ['key' => trans('file.Company')]) }}...">
                                                    @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company_name }}
                                                    </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-bold">{{ __('Department') }} <span
                                                        class="text-danger"></span></label>

                                                <select class="form-control" name="department_id"
                                                    id="department_id"></select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="text-bold">{{ __('Designation') }} <span
                                                    class="text-danger"></span></label>

                                            <select class="form-control" name="designation_id"
                                                id="designation_id"></select>

                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="text-bold">{{ __('Office_Shift') }} <span
                                                    class="text-danger"></span></label>

                                            <select class="form-control" name="office_shift_id"
                                                id="office_shift_id"></select>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="section-title">
                                                <h4>Employee Job Location Wise Search</h4>
                                            </div>
                                        </div>

                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_four .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_four .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location1 ?? 'location1' }}
                                                Name:</label>
                                            <select name="region_id" id="region_id"
                                                class="form-control selectpicker region" data-live-search="true"
                                                data-live-search-style="begins" data-dependent="area_name"
                                                title="{{ __('Selecting  name') }}...">
                                                @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->region_name }}
                                                </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @endif
                                        @endif

                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_five .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_five .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location2 ?? 'location2' }}
                                                name:</label>

                                            <select class="form-control" name="area_id" id="area_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_six .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_six .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location3 ?? 'location3' }}
                                                Name:</label>

                                            <select class="form-control" name="territory_id" id="territory_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_seven .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_seven .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location4 ?? 'location4' }}
                                                Name:</label>

                                            <select class="form-control" name="town_id" id="town_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_eight .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_eight .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location5 ?? 'location5' }}
                                                Name:</label>

                                            <select class="form-control" name="db_house_id" id="db_house_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_twelve .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_twelve .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location6 ?? 'location6' }}
                                                Name:</label>

                                            <select class="form-control location_six_id" name="location_six_id"
                                                id="location_six_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_thirteen .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_thirteen .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location7 ?? 'location7' }}
                                                Name:</label>

                                            <select class="form-control location_seven_id" name="location_seven_id"
                                                id="location_seven_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_fourteen .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_fourteen .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold ">{{ $location8 ?? 'location8' }}
                                                Name:</label>

                                            <select class="form-control location_eight_id" name="location_eight_id"
                                                id="location_eight_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_fifteen .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_fifteen .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location9 ?? 'location9' }}
                                                Name:</label>
                                            <select class="form-control location_nine_id" name="location_nine_id"
                                                id="location_nine_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_sixteen .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_sixteen .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location10 ?? 'location10' }}
                                                Name:</label>

                                            <select class="form-control location_ten_id" name="location_ten_id"
                                                id="location_ten_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                                        'json_contains(package_module,
                                        \'["' .
                                        $organization_sub_module_seventeen .
                                        '"]\')')->exists())
                                        @if (Permission::where('permission_com_id', '=',
                                        Auth::user()->com_id)->where('permission_role_id', '=',
                                        Auth::user()->role_id)->whereRaw(
                                        'json_contains(permission_content,
                                        \'["' .
                                        $organization_sub_module_seventeen .
                                        '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">{{ $location11 ?? 'location11' }}
                                                Name:</label>

                                            <select class="form-control location_eleven_id" name="location_eleven_id"
                                                id="location_eleven_id"></select>
                                        </div>
                                        @endif
                                        @endif
                                        <div class="col-md-4 form-group">
                                            <label class="text-bold">{{ __('Role') }}</label>
                                            <select name="role_users_id" id="role_users_id"
                                                class="selectpicker form-control" data-live-search="true"
                                                data-live-search-style="begins"
                                                title="{{ __('Selecting', ['key' => trans('file.Role')]) }}...">
                                                @foreach ($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->roles_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="section-title">
                                                <h3>Employee Address Wise Search</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="text-bold">Division Name: </label>
                                            <select name="division_id" id="division_id"
                                                class="form-control selectpicker region" data-live-search="true"
                                                data-live-search-style="begins" data-dependent="area_name"
                                                title="{{ __('Selecting Division name') }}...">
                                                @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->dv_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">District Name:</label>
                                            <select class="form-control" name="district_id" id="district_id"></select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Upazila Name:</label>

                                            <select class="form-control" name="upazila_id" id="upazila_id"></select>
                                        </div>
                                        {{-- <div class="col-md-6 form-group">
                                            <label for="" class="text-bold">Union Name:</label>

                                            <select class="form-control" name="union_id" id="union_id"></select>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="section-title">
                                                <h3>Employee Joining Date Wise Search</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <label for="start_date">{{__('Start Date')}}</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-calendar"
                                                            aria-hidden="true"></i> </span>
                                                </div>
                                                <input class="form-control" name="start_date" type="date" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <label for="start_date">{{__('End Date')}}</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-calendar"
                                                            aria-hidden="true"></i> </span>
                                                </div>
                                                <input class="form-control" name="end_date" type="date" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group check-box mr-0 ">
                                            <input type="checkbox" name="over_time_payable" value="Yes"
                                                class="form-check-input">
                                            <label class="text-bold" for="exampleCheck1">Overtime Payable</label>
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Active Satus:</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1">Active </option>
                                                <option value="0">InActive </option>
                                                <option value="all" selected>All </option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-bold">{{ __('Category') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="category_name" id="add-button"
                                                    class="form-control selectpicker dynamic" data-live-search="true"
                                                    data-live-search-style="begins" data-shift_name="shift_name"
                                                    data-dependent="category_name"
                                                    title="{{ __('Selecting', ['key' => trans('categories')]) }}...">
                                                    <option value="Search">Search</option>
                                                    <option value="EmployeeReport">Download (PDF)</option>
                                                    <option value="EmployeeReportExcel">Download (Excel)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mt-4">
                                            <button type="submit" class="btn btn-grad Search box"><i
                                                    class="fa fa-search"></i>{{ __('Search') }} </button>
                                            <button type="submit" class="btn btn-grad EmployeeReport box"><i
                                                    class="fa fa-download"></i> {{ __('Download') }} </button>
                                            <button type="submit" class="btn btn-info EmployeeReportExcel box"><i
                                                    class="fa fa-download"></i> {{__('Download (Excel)')}} </button>

                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped display nowrap"
                    id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Employee-ID') }}</th>

                            <th>{{ __('Username') }}</th>
                            <th>{{ __('Photo') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Division') }}</th>
                            <th>{{ __('District') }}</th>
                            <th>{{ __('Upazila') }}</th>
                            <th>{{ __('Union') }}</th>
                            @if (EmployeeDetail::whereNotNull('village_bn')->exists())
                            <th>{{ __('Village') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('postal_area_bn')->exists())
                            <th>{{ __('Postal Area') }}</th>
                            @endif
                            {{-- <th>{{__('Address')}}</th> --}}
                            @if (EmployeeDetail::whereNotNull('identification_type')->exists())
                            <th>{{ __('ID Card Number') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('religion')->exists())
                            <th>{{ __('Religion') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('blood_group')->exists())
                            <th>{{ __('Blood Group') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('marital_status')->exists())
                            <th>{{ __('Marital Status') }}</th>
                            @endif
                            <th>{{ __('Gender') }}</th>
                            <th>{{ __('Role') }}</th>
                            @if (EmployeeDetail::whereNotNull('father_name')->exists())
                            <th>{{ __('Father Name') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('mother_name')->exists())
                            <th>{{ __('Mother Name') }}</th>
                            @endif
                            @if (User::whereNotNull('employment_type')->exists())
                            <th>{{ __('Employement Type') }}</th>
                            @endif
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Designation') }}</th>
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ $location1 ?? 'Location1' }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location2 ?? 'location2') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location3 ?? 'location3') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_seven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_seven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location4 ?? 'location4') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location5 ?? 'location5') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_twelve .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_twelve .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location6 ?? 'location6') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_thirteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_thirteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location7 ?? 'location7') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_fourteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_fourteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location8 ?? 'location8') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_fifteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_fifteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location9 ?? 'location9') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_sixteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_sixteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location10 ?? 'location10') }}</th>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_seventeen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_seventeen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <th>{{ __($location11 ?? 'location11') }}</th>
                            @endif
                            @endif
                            @if (User::whereNotNull('joining_date')->exists())
                            <th>{{ __('Joning Date') }}</th>
                            @endif
                            @if (User::whereNotNull('expiry_date')->exists())
                            <th>{{ __('LWD') }}</th>
                            @endif
                            @if (User::whereNotNull('date_of_birth')->exists())
                            <th>{{ __('DOB') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('experience_month')->exists())
                            <th>{{ __('Experience Month') }}</th>
                            @endif
                            @if (EmployeeDetail::whereNotNull('previous_organization')->exists())
                            <th>{{ __('Previous Organization') }}</th>
                            @endif
                            <th>{{ __('Fixed Salary') }}</th>
                            @if (User::whereNotNull('mobile_bill')->exists())
                            <th>{{ __('Mobile Allowance') }}</th>
                            @endif
                            @if (User::whereNotNull('transport_allowance')->exists())
                            <th>{{ __('TA/TD') }}</th>
                            @endif
                            <th>{{ __('Fixed Salary With Mobile Allowance') }}</th>
                            @if (User::whereNotNull('report_to_parent_id')->exists())
                            <th>{{ __('1st Supervisor') }}</th>
                            @endif
                            @if (User::whereNotNull('report_to_parent_id')->exists())
                            <th>{{ __('2nd Supervisor') }}</th>
                            @endif
                            <th>{{ __('Bank Name') }}</th>
                            <th>{{ __('Bank Type') }}</th>
                            <th>{{ __('Bank Account Number') }}</th>
                            @if (User::whereNotNull('user_provident_fund_member')->exists())
                            <th>{{ __('Provident Fund Member') }}</th>
                            @endif
                            @if (User::whereNotNull('over_time_payable')->exists())
                            <th>{{ __('Overtime Payable') }}</th>
                            @endif
                            @if (User::whereNotNull('user_over_time_rate')->exists())
                            <th>{{ __('Overtime Rate(Times of Basic)') }}</th>
                            @endif
                            @if (User::whereNotNull('inactive_date')->exists())
                            <th>{{ __('Inactive Date') }}</th>
                            @endif
                            @if (User::whereNotNull('inactive_description')->exists())
                            <th>{{ __('Inactive Description') }}</th>
                            @endif


                            {{-- <th>{{__('Vill BN')}}</th>
                            <th>{{__('District')}}</th> --}}
                            {{-- <th>{{__('Address')}}</th> --}}

                            <th>{{ __('Download') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)

                        @foreach ($users as $usersData)

                        <tr>

                            <td>{{ $i++ }}</td>
                            <td>{{ $usersData->company_assigned_id ?? '' }}</td>
                            <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{
                                    $usersData->first_name .
                                    '
                                    ' .
                                    $usersData->last_name }}</a>
                            </td>
                            <td><img class="rounded" width="60" src="{{ asset($usersData->profile_photo) }}"></td>
                            <td>{{ $usersData->email ?? $usersData->inactive_email }}</td>
                            <td>{{ $usersData->phone ?? $usersData->inactive_phone }}</td>


                            @if ($usersData->appointment_letter == 'management')
                            <td>{{ $usersData->userDivision->dv_name ?? null }}</td>
                            <td>{{ $usersData->userDistrict->dist_name ?? null }}</td>
                            <td>{{ $usersData->userUpazila->up_name ?? null }}</td>
                            <td>{{ $usersData->userUnion->un_name ?? null }}</td>
                            @if (EmployeeDetail::whereNotNull('village_bn')->exists())
                            <td>{{ $usersData->emoloyeedetail->village_bn ?? null }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('postal_area_bn')->exists())
                            <td>{{ $usersData->emoloyeedetail->postal_area_bn ?? null }}</td>
                            @endif
                            @endif
                            @if ($usersData->appointment_letter == 'nonmanagement')
                            <td>{{ $usersData->userDivision->dv_bn_name ?? null }}</td>
                            <td>{{ $usersData->userDistrict->dist_bn_name ?? null }}</td>
                            <td>{{ $usersData->userUpazila->up_bn_name ?? null }}</td>
                            <td>{{ $usersData->userUnion->un_bn_name ?? null }}</td>
                            @if (EmployeeDetail::whereNotNull('village_bn')->exists())
                            <td>{{ $usersData->emoloyeedetail->village_bn ?? null }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('postal_area_bn')->exists())
                            <td>{{ $usersData->emoloyeedetail->postal_area_bn ?? null }}</td>
                            @endif
                            @endif
                            {{-- <td>{{$usersData->address}}</td> --}}
                            @if (EmployeeDetail::whereNotNull('identification_type')->exists())
                            <td>
                                @if ($usersData->emoloyeedetail)
                                {{ $usersData->emoloyeedetail->identification_type }} :
                                @endif
                                {{ $usersData->emoloyeedetail->identification_number ?? null }}
                            </td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('religion')->exists())
                            <td>{{ $usersData->emoloyeedetail->religion ?? null }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('blood_group')->exists())
                            <td>{{ $usersData->blood_group ?? null }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('marital_status')->exists())
                            <td>{{ $usersData->emoloyeedetail->marital_status ?? null }}</td>
                            @endif
                            <td>{{ $usersData->gender }}</td>
                            <td>{{ $usersData->userrole->roles_name ?? null }}</td>
                            @if (EmployeeDetail::whereNotNull('father_name')->exists())
                            <td>{{ $usersData->emoloyeedetail->father_name ?? null }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('mother_name')->exists())
                            <td>{{ $usersData->emoloyeedetail->mother_name ?? null }}</td>
                            @endif
                            @if (User::whereNotNull('employment_type')->exists())
                            <td>{{ $usersData->employment_type ?? null }}</td>
                            @endif
                            <td>{{ $usersData->userdepartment->department_name ?? null }}</td>
                            <td>{{ $usersData->userdesignation->designation_name ?? null }}</td>
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_four .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_four .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userregion->region_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_five .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_five .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userarea->area_name ?? null }}</td>
                            @endif
                            @endif


                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_six .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_six .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userterritory->territory_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_seven .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_seven .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->usertown->town_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_eight .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_eight .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userdbhouse->db_house_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_twelve .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_twelve .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userlocationsix->location_six_location_six_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_thirteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_thirteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userlocationseven->location_seven_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_fourteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_fourteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userlocationeight->location_eights_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_fifteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_fifteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userlocationnine->location_nine_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_sixteen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_sixteen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userlocationten->location_ten_name ?? null }}</td>
                            @endif
                            @endif
                            @if (Package::where('id', '=', Auth::user()->com_pack)->whereRaw(
                            'json_contains(package_module,
                            \'["' .
                            $organization_sub_module_seventeen .
                            '"]\')')->exists())
                            @if (Permission::where('permission_com_id', '=',
                            Auth::user()->com_id)->where('permission_role_id',
                            '=', Auth::user()->role_id)->whereRaw(
                            'json_contains(permission_content,
                            \'["' .
                            $organization_sub_module_seventeen .
                            '"]\')')->exists() || Auth::user()->company_profile == 'Yes')
                            <td>{{ $usersData->userlocationeleven->location_eleven_name ?? null }}</td>
                            @endif
                            @endif
                            @if (User::whereNotNull('joining_date')->exists())
                            <td>{{ $usersData->joining_date }}</td>
                            @endif
                            @if (User::whereNotNull('expiry_date')->exists())
                            <td>{{ $usersData->expiry_date }}</td>
                            @endif
                            @if (User::whereNotNull('date_of_birth')->exists())
                            <td>{{ $usersData->date_of_birth }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('experience_month')->exists())
                            <td>{{ $usersData->emoloyeedetail->experience_month ?? null }}</td>
                            @endif
                            @if (EmployeeDetail::whereNotNull('previous_organization')->exists())
                            <td>{{ $usersData->emoloyeedetail->previous_organization ?? null }}</td>
                            @endif
                            <td>
                                {{ $usersData->gross_salary ?? '' }}
                            </td>
                            @if (User::whereNotNull('mobile_bill')->exists())
                            <td>{{ $usersData->mobile_bill ?? '' }}</td>
                            @endif
                            @if (User::whereNotNull('transport_allowance')->exists())
                            <td>{{ $usersData->transport_allowance ?? '' }}</td>
                            @endif
                            <td>{{ $usersData->gross_salary + $usersData->mobile_bill ?? '' }}</td>

                            <?php

                            $first_supervisor_details = User::where('id', $usersData->report_to_parent_id)->get(['first_name', 'last_name', 'report_to_parent_id']);

                            $first_supervisor_name = '';
                            $second_supervisor_name = '';
                            if (User::where('id', $usersData->report_to_parent_id)->exists()) {
                                foreach ($first_supervisor_details as $first_supervisor_details_value) {
                                    $first_supervisor_name = $first_supervisor_details_value->first_name . ' ' . $first_supervisor_details_value->last_name;

                                    if (User::where('id', $first_supervisor_details_value->report_to_parent_id)->exists()) {
                                        $second_supervisor_details = User::where('id', $first_supervisor_details_value->report_to_parent_id)->get(['first_name', 'last_name']);

                                        foreach ($second_supervisor_details as $second_supervisor_details_value) {
                                            $second_supervisor_name = $second_supervisor_details_value->first_name . ' ' . $second_supervisor_details_value->last_name;
                                        }
                                    }
                                }
                            }
                            ?>
                            <td>
                                <?php
                                echo $first_supervisor_name;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $second_supervisor_name;
                                ?>
                            </td>
                            <td>{{ $usersData->bankaccount->bank_name ?? null }}</td>
                            <td>{{ $usersData->bankaccount->bank_type ?? null }}</td>
                            <td>{{ $usersData->bankaccount->bank_account_number ?? null }}</td>
                            @if (User::whereNotNull('user_provident_fund_member')->exists())
                            <td>{{ $usersData->user_provident_fund_member ?? '' }}</td>
                            @endif
                            {{-- <td>Nominees</td> --}}
                            @if (User::whereNotNull('over_time_payable')->exists())
                            <td>{{ $usersData->over_time_payable ?? null }}</td>
                            @endif
                            @if (User::whereNotNull('user_over_time_rate')->exists())
                            <td>{{ $usersData->user_over_time_rate ?? null }}</td>
                            @endif
                            @if (User::whereNotNull('inactive_date')->exists())
                            <td>{{ $usersData->inactive_date ?? null }}</td>
                            @endif
                            @if (User::whereNotNull('inactive_description')->exists())
                            <td>{{ $usersData->inactive_description ?? null }}</td>
                            @endif
                            {{-- <td>{{$usersData->emoloyeedetail->village_bn ?? null}}</td>
                            <td>{{$usersData->emoloyeedetail->district ?? null}}</td> --}}
                            {{-- <td>{{$usersData->emoloyeedetail->permenet_address_english ?? null}}</td> --}}
                            <td>
                                <form method="post"
                                    action="{{ route('employee-report-downloads', ['id' => $usersData->id]) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $usersData->id }}">
                                    <button class="btn-grad" type="submit">{{ __('Download') }}</button>

                                </form>
                            </td>

                            <td>
                                @if ($usersData->is_active == 1)
                                <span class="rounded">{{ 'Active' }}</span>
                                @else
                                <span class="rounded">{{ 'Inactive' }}</span>
                                @endif <br><br>
                            </td>

                        </tr>
                        @endforeach

                        {{-- @endforeach --}}
                    </tbody>

                </table>
            </div>
        </div>
</section>





<script type="text/javascript">
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var i = 1;
            $('#user-table').DataTable({

                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,

                dom: '<"row"lfB>rtip',

                buttons: [
                    // {
                    //     extend: 'pdf',
                    //     text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                    //     exportOptions: {
                    //         columns: ':visible:Not(.not-exported)',
                    //         rows: ':visible'
                    //     },
                    // },
                    // extend: 'csvHtml5',
                    // text: 'CSV',
                    // exportOptions: {
                    // stripHtml: false
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible',
                           // stripHtml: false
                        },
                    },
                    {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                    }
                    },
                    // {
                    //     extend: 'print',
                    //     text: '<i title="print" class="fa fa-print"></i>',
                    //     exportOptions: {
                    //         columns: ':visible:Not(.not-exported)',
                    //         rows: ':visible'
                    //     },
                    // },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });





            $('#company_id').on('change', function() {
                var companyID = $(this).val();
                if (companyID) {
                    $.ajax({
                        url: '/get-department/' + companyID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#department_id').empty();
                                $('#department_id').append(
                                    '<option hidden value="" >Choose Department</option>');
                                $.each(data, function(key, departments) {
                                    $('select[name="department_id"]').append(
                                        '<option value="' + departments.id + '">' +
                                        departments.department_name + '</option>');
                                });
                            } else {
                                $('#departments').empty();
                            }
                        }
                    });
                } else {
                    $('#departments').empty();
                }
            });

            $('#department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-designation/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#designation_id').empty();
                                $('#designation_id').append(
                                    '<option hidden value="" >Choose Designation</option>');
                                $.each(data, function(key, designations) {
                                    $('select[name="designation_id"]').append(
                                        '<option value="' + designations.id + '">' +
                                        designations.designation_name + '</option>');
                                });
                            } else {
                                $('#designations').empty();
                            }
                        }
                    });
                } else {
                    $('#designations').empty();
                }
            });

            $('#company_id').on('change', function() {
                var companyID = $(this).val();
                if (companyID) {
                    $.ajax({
                        url: '/get-office-shift/' + companyID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#office_shift_id').empty();
                                $('#office_shift_id').append(
                                    '<option hidden value="" >Choose Office Shift</option>');
                                $.each(data, function(key, office_shifts) {
                                    $('select[name="office_shift_id"]').append(
                                        '<option value="' + office_shifts.id +
                                        '">' + office_shifts.shift_name +
                                        '</option>');
                                });
                            } else {
                                $('#office_shifts').empty();
                            }
                        }
                    });
                } else {
                    $('#office_shifts').empty();
                }
            });



            $('#region_id').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-area/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#area_id').empty();
                                $('#area_id').append(
                                    '<option hidden value="" >Choose Area</option>');
                                $.each(data, function(key, areas) {
                                    $('select[name="area_id"]').append(
                                        '<option value="' + areas.id + '">' + areas
                                        .area_name + '</option>');
                                });
                            } else {
                                $('#areas').empty();
                            }
                        }
                    });
                } else {
                    $('#areas').empty();
                }
            });


            $('#area_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-territory/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#territory_id').empty();
                                $('#territory_id').append(
                                    '<option hidden value="">Choose Territory</option>');
                                $.each(data, function(key, territories) {
                                    $('select[name="territory_id"]').append(
                                        '<option value="' + territories.id + '">' +
                                        territories.territory_name + '</option>');
                                });
                            } else {
                                $('#territories').empty();
                            }
                        }
                    });
                } else {
                    $('#territories').empty();
                }
            });

            $('#territory_id').on('change', function() {
                var territoryID = $(this).val();
                if (territoryID) {
                    $.ajax({
                        url: '/get-town/' + territoryID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#town_id').empty();
                                $('#town_id').append(
                                    '<option hidden value="">Choose Town</option>');
                                $.each(data, function(key, towns) {
                                    $('select[name="town_id"]').append(
                                        '<option value="' + towns.id + '">' + towns
                                        .town_name + '</option>');
                                });
                            } else {
                                $('#towns').empty();
                            }
                        }
                    });
                } else {
                    $('#towns').empty();
                }
            });

            $('#town_id').on('change', function() {
                var townID = $(this).val();
                if (townID) {
                    $.ajax({
                        url: '/get-db-house/' + townID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#db_house_id').empty();
                                $('#db_house_id').append(
                                    '<option hidden value="">Choose DB House</option>');
                                $.each(data, function(key, db_houses) {
                                    $('select[name="db_house_id"]').append(
                                        '<option value="' + db_houses.id + '">' +
                                        db_houses.db_house_name + '</option>');
                                });
                            } else {
                                $('#db_houses').empty();
                            }
                        }
                    });
                } else {
                    $('#db_houses').empty();
                }
            });

            $('#db_house_id').on('change', function() {
                var dbhouseID = $(this).val();
                if (dbhouseID) {
                    $.ajax({
                        url: '/get-location-six/' + dbhouseID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_six_id').empty();
                                $('#location_six_id').append(
                                    '<option hidden value="">Choose Town</option>');
                                $.each(data, function(key, locationsixes) {
                                    $('select[name="location_six_id"]').append(
                                        '<option value="' + locationsixes.id +
                                        '">' +
                                        locationsixes
                                        .location_six_location_six_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationsixes').empty();
                            }
                        }
                    });
                } else {
                    $('#locationsixes').empty();
                }
            });
            $('#location_six_id').on('change', function() {
                var locationsixID = $(this).val();
                if (locationsixID) {
                    $.ajax({
                        url: '/get-location-seven/' + locationsixID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_seven_id').empty();
                                $('#location_seven_id').append(
                                    '<option hidden value="">Choose Town</option>');
                                $.each(data, function(key, locationsevens) {
                                    $('select[name="location_seven_id"]').append(
                                        '<option value="' + locationsevens.id +
                                        '">' +
                                        locationsevens.location_seven_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationsevens').empty();
                            }
                        }
                    });
                } else {
                    $('#locationsevens').empty();
                }
            });
            $('#location_seven_id').on('change', function() {
                var locationsevenID = $(this).val();
                if (locationsevenID) {
                    $.ajax({
                        url: '/get-location-eight/' + locationsevenID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_eight_id').empty();
                                $('#location_eight_id').append(
                                    '<option hidden value="">Choose Town</option>');
                                $.each(data, function(key, locationeights) {
                                    $('select[name="location_eight_id"]').append(
                                        '<option value="' + locationeights.id +
                                        '">' +
                                        locationeights.location_eights_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationeights').empty();
                            }
                        }
                    });
                } else {
                    $('#locationeights').empty();
                }
            });
            $('#location_eight_id').on('change', function() {
                var locationeightID = $(this).val();
                if (locationeightID) {
                    $.ajax({
                        url: '/get-location-nine/' + locationeightID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_nine_id').empty();
                                $('#location_nine_id').append(
                                    '<option hidden value="">Choose Location</option>');
                                $.each(data, function(key, locationnines) {
                                    $('select[name="location_nine_id"]').append(
                                        '<option value="' + locationnines.id +
                                        '">' +
                                        locationnines.location_nine_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationnines').empty();
                            }
                        }
                    });
                } else {
                    $('#locationnines').empty();
                }
            });

            $('#location_nine_id').on('change', function() {

                var locationtenID = $(this).val();

                if (locationtenID) {
                    $.ajax({
                        url: '/get-location-ten/' + locationtenID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#location_ten_id').empty();
                                $('#location_ten_id').append(
                                    '<option hidden value="">Choose Location</option>');
                                $.each(data, function(key, locationtens) {

                                    $('select[name="location_ten_id"]').append(
                                        '<option value="' + locationtens.id + '">' +
                                        locationtens.location_ten_name + '</option>'
                                    );
                                });
                            } else {
                                $('#locationtens').empty();
                            }
                        }
                    });
                } else {
                    $('#locationtens').empty();
                }
            });

            $('#division_id').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-district/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#district_id').empty();
                                $('#district_id').append(
                                    '<option hidden value="">Choose Division</option>');
                                $.each(data, function(key, districts) {
                                    $('select[name="district_id"]').append(
                                        '<option value="' + districts.id + '">' +
                                        districts.dist_name + '</option>');
                                });
                            } else {
                                $('#districts').empty();
                            }
                        }
                    });
                } else {
                    $('#districts').empty();
                }
            });
            $('.location_ten_id').on('change', function() {
                var locationelevenID = $(this).val();
                if (locationelevenID) {
                    $.ajax({
                        url: '/get-location-eleven/' + locationelevenID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('.location_eleven_id').empty();
                                $('.location_eleven_id').append(
                                    '<option hidden value="">Choose Location</option>');
                                $.each(data, function(key, locationelevens) {
                                    $('select[name="location_eleven_id"]').append(
                                        '<option value="' + locationelevens.id +
                                        '">' +
                                        locationelevens.location_eleven_name +
                                        '</option>');
                                });
                            } else {
                                $('#locationelevens').empty();
                            }
                        }
                    });
                } else {
                    $('#locationelevens').empty();
                }
            });

            $('#district_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-upazila/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#upazila_id').empty();
                                $('#upazila_id').append(
                                    '<option hidden value="">Choose Upazila</option>');
                                $.each(data, function(key, upazilas) {
                                    $('select[name="upazila_id"]').append(
                                        '<option value="' + upazilas.id + '">' +
                                        upazilas.up_name + '</option>');
                                });
                            } else {
                                $('#upazilas').empty();
                            }
                        }
                    });
                } else {
                    $('#upazilas').empty();
                }
            });

            $('#upazila_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-union/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#union_id').empty();
                                $('#union_id').append(
                                    '<option hidden value="">Choose Union</option>');
                                $.each(data, function(key, unions) {
                                    $('select[name="union_id"]').append(
                                        '<option value="' + unions.id + '">' +
                                        unions.un_name + '</option>');
                                });
                            } else {
                                $('#unions').empty();
                            }
                        }
                    });
                } else {
                    $('#unions').empty();
                }
            });





        });
</script>
@endsection