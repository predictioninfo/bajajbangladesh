@extends('back-end.premium.layout.employee-setting-main')
@section('content')

@if(Session::get('employee_setup_id'))
@else
<script>
    window.location = "/login";
</script>
@endif
<?php
    use App\Models\Permission;
    use App\Models\Attendance;
    use App\Models\Package;
    //use DateTime;
    $date = new DateTime("now", new \DateTimeZone('Asia/Kolkata') );
    $current_date = $date->format('Y-m-d');
    //$current_time = $date->format('H:i:s');
    $user_sub_module_one_add = "1.1.1";
    $user_sub_module_one_edit = "1.1.2";
    $user_sub_module_one_delete = "1.1.3";
    $organization_sub_module_four = "5.4";
    $organization_sub_module_five = "5.5";
    $organization_sub_module_six = "5.6";
    $organization_sub_module_seven = "5.7";
    $organization_sub_module_eight = "5.8";
    $organization_sub_module_twelve = "5.12";
    $organization_sub_module_thirteen = "5.13";
    $organization_sub_module_fourteen = "5.14";
    $organization_sub_module_fifteen = "5.15";
    $organization_sub_module_sixteen = "5.16";
    $organization_sub_module_seventeen = "5.17";
    $organization_sub_module_eighteen = "5.18";
    $organization_sub_module_nineteen = "5.19";
    $organization_sub_module_twenty = "5.20";
    $organization_sub_module_twentyone = "5.21";
    foreach ($locations as $location){
    $location1 = $location->location1;
    $location2 = $location->location2 ;
    $location3 = $location->location3 ;
    $location4 = $location->location4 ;
    $location5 = $location->location5 ;
    $location6 = $location->location6 ;
    $location7 = $location->location7 ;
    $location8 = $location->location8 ;
    $location9 = $location->location9 ;
    $location10 = $location->location10;
    $location11 = $location->location11;
    }
?>


<section class="main-contant-section">
    <div class="employee-profile">
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!! session::get('message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center">{{__('Today is')}} {{now()->englishDayOfWeek}}
                    {{now()->format(env('Date_Format'))}}</h1>
                <nav aria-label="breadcrumb">
                     <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="{{route('employee-add') }}"><span  class="icon icon-plus"> </span> Add</a></li>
                        <li><a href="{{route('employee-lists') }}"><span  class="icon icon-list"> </span> List</a></li>
                        <li><a href="#">Show -Employee Details</a></li>
                    </ol>

                </nav>
            </div>
        </div>


        <div class="d-flex justify-content-between">
            <div>
                <h4 class="thin-text">{{__('Today is')}} {{now()->englishDayOfWeek}}
                    {{now()->format(env('Date_Format'))}}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card content-box">
                    @foreach($user_detail as $employee_basic_infos_value)
                    <img class="rounded-circle" src="{{ asset($employee_basic_infos_value->profile_photo) }}" alt="https://app.hrsale.com/public/uploads/users/6-small.png" height="300" width="400">
                    <div class="mt-3">

                            <h1 class="thin-text">Details of {{$employee_basic_infos_value->first_name ?? ''}}
                            {{$employee_basic_infos_value->last_name ?? ''}}</h1>


                        <article class="mt-3">
                            <p> <b> Name:</b>  {{$employee_basic_infos_value->first_name ?? ''}} {{$employee_basic_infos_value->last_name ?? ''}}</p>
                            <p> <b> Designation:</b> {{$employee_basic_infos_value->userdesignation->designation_name ?? ''}} </p>
                            <p> <b> Email:</b> {{$employee_basic_infos_value->email ?? ''}}  </p>
                            <p> <b> Phone:</b> {{$employee_basic_infos_value->phone ?? ''}}  </p>
                            <p> <b> Date of birth: </b>{{$employee_basic_infos_value->date_of_birth ?? ''}}  </p>
                            <p> <b> Gender:</b> {{$employee_basic_infos_value->gender ?? ''}}  </p>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="card content-box">
                    <div class="">
                        @foreach($user_detail as $employee_basic_infos_value)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h1>{{__('Basic Information')}}</h1>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>{{__('ID')}} : {{$employee_basic_infos_value->company_assigned_id ?? ''}}</h4>

                                            </div>
                                             <div class="col-md-6">
                                                <h4>{{__('Username')}} : {{$employee_basic_infos_value->username ?? ''}}</h4>

                                            </div>

                                            <div class="col-md-6">
                                                <h4>{{__('Identification number')}} : {{$employee_basic_infos_value->emoloyeedetail->identification_number ?? ''}}</h4>

                                            </div>
                                            <div class="col-md-6">


                                                <h4>{{__('Address English' )}} :
                                                    @if($employee_basic_infos_value->emoloyeedetail)
                                                    {{ $employee_basic_infos_value->emoloyeedetail->village_en ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userUnion)
                                                    {{ $employee_basic_infos_value->userUnion->un_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userUpazila)
                                                    {{ $employee_basic_infos_value->userUpazila->up_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userDistrict)
                                                    {{ $employee_basic_infos_value->userDistrict->dist_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userDivision)
                                                    {{ $employee_basic_infos_value->userDivision->dv_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->emoloyeedetail)
                                                    {{ $employee_basic_infos_value->emoloyeedetail->postal_area_en ?? null}}
                                                    @endif</h4>

                                            </div>
                                            <div class="col-md-6">

                                                <h4>{{__('Address Bangla')}} :
                                                    @if($employee_basic_infos_value->emoloyeedetail)
                                                    {{ $employee_basic_infos_value->emoloyeedetail->village_bn ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userUnion)
                                                    {{ $employee_basic_infos_value->userUnion->un_bn_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userUpazila)
                                                    {{ $employee_basic_infos_value->userUpazila->up_bn_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userDistrict)
                                                    {{ $employee_basic_infos_value->userDistrict->dist_bn_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->userDivision)
                                                    {{ $employee_basic_infos_value->userDivision->dv_bn_name ?? null}} {{ __(',') }}
                                                    @endif
                                                    @if($employee_basic_infos_value->emoloyeedetail)
                                                    {{ $employee_basic_infos_value->emoloyeedetail->postal_area_bn ?? null}}
                                                    @endif</h4>

                                            </div>


                                            <div class="col-md-6">
                                                <h4>{{__('Department')}} :
                                                    {{$employee_basic_infos_value->userdepartment->department_name ?? ''}}</h4>
                                            </div>

                                            <div class="col-md-6 ">
                                                <h4>{{__('Office Shift')}} :
                                                    {{$employee_basic_infos_value->userofficeshift->shift_name ?? ''}}</h4>
                                            </div>
                                            <div class="col-md-6 ">
                                                <h4>{{__('Blood Group')}} :
                                                    {{$employee_basic_infos_value->emoloyeedetail->blood_group ?? ''}}</h4>
                                            </div>
                                            <div class="col-md-6 ">
                                                <h4>{{__('Marital Status')}} :
                                                    {{$employee_basic_infos_value->emoloyeedetail->marital_status ?? ''}}</h4>
                                            </div>
                                            <div class="col-md-6 ">
                                                <h4>{{__('Previous Organization')}} :
                                                    {{$employee_basic_infos_value->emoloyeedetail->previous_organization ?? ''}}</h4>
                                            </div>
                                            <div class="col-md-6 ">
                                                <h4>{{__('Experience Month')}} :
                                                    {{$employee_basic_infos_value->emoloyeedetail->experience_month ?? ''}}</h4>
                                            </div>
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_four . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_four . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6 ">
                                                <h4>{{$location1 ?? 'location1'}} :
                                                    {{$employee_basic_infos_value->userregion->region_name ??
                                                    ''}}
                                                </h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_five . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_five . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location2 ?? 'location2'}} : {{$employee_basic_infos_value->userarea->area_name
                                                    ?? ''}}
                                                </h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_six . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_six . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location3 ?? 'location3'}} :
                                                    {{$employee_basic_infos_value->userterritory->territory_name ?? ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_seven . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_seven . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location4 ?? 'location4'}} : {{$employee_basic_infos_value->usertown->town_name
                                                    ?? ''}}
                                                </h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_eight . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_eight . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location5 ?? 'location5'}} :
                                                    {{$employee_basic_infos_value->userdbhouse->db_house_name ?? ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_twelve . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_twelve . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location6 ?? 'location6'}} :
                                                    {{$employee_basic_infos_value->userlocationsix->location_six_location_six_name ??
                                                    ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_thirteen . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_thirteen . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location7 ?? 'location7'}} :
                                                    {{$employee_basic_infos_value->userlocationseven->location_seven_name ?? ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_fourteen . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_fourteen . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location8 ?? 'location8'}} :
                                                    {{$employee_basic_infos_value->userlocationeight->location_eights_name ?? ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_fifteen . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_fifteen . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location9 ?? 'location9'}} :
                                                    {{$employee_basic_infos_value->userlocationnine->location_nine_name ?? ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_sixteen . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_sixteen . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location10 ?? 'location10'}} :
                                                    {{$employee_basic_infos_value->userlocationten->location_ten_name ?? ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                            \'["' . $organization_sub_module_seventeen . '"]\')')->exists())
                                            @if(Permission::where('permission_com_id','=',
                                            Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                            \'["' . $organization_sub_module_seventeen . '"]\')')->exists() ||
                                            (Auth::user()->company_profile == 'Yes'))
                                            <div class="col-md-6">
                                                <h4>{{$location11 ?? 'location11'}} :
                                                    {{$employee_basic_infos_value->userlocationeleven->location_eleven_name ??
                                                    ''}}</h4>
                                            </div>
                                            @endif
                                            @endif
                                            <div class="col-md-6">
                                                <h4>{{__('Role Name')}} : {{$employee_basic_infos_value->userrole->roles_name ?? ''}}
                                                </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Attendance Type')}} : {{$employee_basic_infos_value->attendance_type ?? ''}}
                                                </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Attendance Status')}} : {{$employee_basic_infos_value->attendance_status ??
                                                    ''}}
                                                </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Date of Joinning')}} : {{$employee_basic_infos_value->joining_date ?? ''}}
                                                </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Overtime Type')}} : {{$employee_basic_infos_value->user_over_time_type ?? ''}}
                                                </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Overtime Payable')}} : {{$employee_basic_infos_value->over_time_payable ??
                                                    ''}}</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Overtime Rate')}} : {{$employee_basic_infos_value->user_over_time_rate ?? ''}}
                                                </h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>{{__('Active Employee')}} :
                                                    <?php if($employee_basic_infos_value->is_active == "1") echo 'Yes'; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
@endsection
