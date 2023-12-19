<!DOCTYPE html>
<html>

<head>
    <style>
        html,
        body,
        div {
            font-family: nikosh;
            /*font-size:14px;*/
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td {
            line-height: 25px;
            padding-left: 15px;
            border: 1px solid black;
        }

        table th {
            background-color: #fbc403;
            color: #363636;
            border: 1px solid black;
        }
    </style>

</head>
<?php
use App\Models\Company;
$company_names = Company::where('id', Auth::user()->com_id)->first(['company_name']);
use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\Package;
use App\Models\Permission;
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

<body>
    <section class="main-contant-section">


        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped display nowrap" id="example"
                style="width:100%">
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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


                        {{-- <th>{{__('Vill BN')}}</th>
                    <th>{{__('District')}}</th> --}}
                        {{-- <th>{{__('Address')}}</th> --}}

                        {{-- <th>{{ __('Download') }}</th> --}}
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)

                    @foreach ($users as $usersData)
                        <tr>

                            <td>{{ $i++ }}</td>
                            <td>{{ $usersData->company_assigned_id ?? '' }}</td>
                            <td><a
                                    href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{ $usersData->first_name .
                                        '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ' .
                                        $usersData->last_name }}</a>
                            </td>
                            <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}"><img class="rounded"
                                        width="60" src="{{ asset($usersData->profile_photo) }}"></a></td>
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                                @if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw(
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
                            {{-- <td>{{$usersData->emoloyeedetail->village_bn ?? null}}</td>
                    <td>{{$usersData->emoloyeedetail->district ?? null}}</td> --}}
                            {{-- <td>{{$usersData->emoloyeedetail->permenet_address_english ?? null}}</td> --}}
                            {{-- <td>
                                <form method="post"
                                    action="{{ route('employee-report-downloads', ['id' => $usersData->id]) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $usersData->id }}">
                                    <button type="submit">{{ __('Download') }}</button>
                                </form>
                            </td> --}}
                            <td>
                                @if ($usersData->is_active == 1)
                                    <span class="rounded"
                                        >{{ 'Active' }}</span>
                                @else
                                    <span class="rounded"
                                        >{{ 'Inactive' }}</span>
                                @endif <br><br>
                            </td>

                        </tr>
                    @endforeach

                    {{-- @endforeach --}}
                </tbody>

            </table>
        </div>
    </section>
