@extends('back-end.premium.layout.premium-main')

@section('content')

<?php

        use App\Models\User;
        use App\Models\Permission;
        use App\Models\Attendance;
        use App\Models\Package;

        $employee_sub_module_one_add = "2.1.1";
        $employee_sub_module_one_edit = "2.1.2";
        $employee_sub_module_one_delete = "2.1.3";
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
        $location1 = $location->location1 ?? "Location1";
        $location2 = $location->location2 ?? "Location2";
        $location3 = $location->location3 ?? "Location3";
        $location4 = $location->location4 ?? "Location4";
        $location5 = $location->location5 ?? "Location5";
        $location6 = $location->location6 ?? "Location6";
        $location7 = $location->location7 ?? "Location7";
        $location8 = $location->location8 ?? "Location8";
        $location9 = $location->location9 ?? "Location9";
        $location10 = $location->location10 ?? "Location10";
        $location11 = $location->location11 ?? "Location11";
        }
    ?>
<section class="main-contant-section">

    <div class="container-fluid"><span id="general_result"></span></div>

    <div class="container-fluid mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>

    <div class="">
        <div class="card mb-4">
            <div class="card-header with-border">
                <h3 class="card-title text-center"> {{__('Filtering')}} </h3>
            </div>
                <div class="content-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('employee-id-card-bulk-downloads')}}" target="_blank">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-bold">{{__('Category')}} <span
                                                    class="text-danger"></span></label>
                                            <select name="category_name" class="form-control selectpicker dynamic"
                                                data-live-search="true" data-live-search-style="begins"
                                                data-shift_name="shift_name" data-dependent="category_name"
                                                title="{{__('Selecting',['key'=>trans('categories')])}}...">
                                                <option value="Appointment-Letter">Appointment Letter</option>
                                                <option value="Id-Card">Id Card</option>
                                                <option value="increment-letter">Increment Letter</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h3>Employee Job Location Wise Search</h3>
                                        </div>
                                    </div>
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_four . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_four . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))
                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location1 ?? "location1"}} Name:</label>
                                        <select name="region_id" id="region_id" class="form-control selectpicker region"
                                            data-live-search="true" data-live-search-style="begins"
                                            data-dependent="area_name" title="{{__('Selecting  name')}}...">
                                            @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{$region->region_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @endif
                                    @endif

                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_five . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_five . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))
                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location2 ?? "location2" }} name:</label>

                                        <select class="form-control" name="area_id" id="area_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_six . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_six . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))
                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location3 ?? "location3"}} Name:</label>

                                        <select class="form-control" name="territory_id" id="territory_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_seven . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_seven . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))
                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location4 ?? "location4"}} Name:</label>

                                        <select class="form-control" name="town_id" id="town_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_eight . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_eight . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))
                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location5 ?? "location5"}} Name:</label>

                                        <select class="form-control" name="db_house_id" id="db_house_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_twelve . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_twelve . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))

                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location6 ?? "location6"}} Name:</label>

                                        <select class="form-control location_six_id" name="location_six_id"
                                            id="location_six_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_thirteen . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_thirteen . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))

                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location7 ?? "location7"}} Name:</label>

                                        <select class="form-control location_seven_id" name="location_seven_id"
                                            id="location_seven_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_fourteen . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_fourteen . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))

                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold ">{{ $location8 ?? "location8"}} Name:</label>

                                        <select class="form-control location_eight_id" name="location_eight_id"
                                            id="location_eight_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_fifteen . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_fifteen . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))

                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location9 ?? "location9"}} Name:</label>
                                        <select class="form-control location_nine_id" name="location_nine_id"
                                            id="location_nine_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_sixteen . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_sixteen . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))

                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location10 ?? "location10"}} Name:</label>

                                        <select class="form-control location_ten_id" name="location_ten_id"
                                            id="location_ten_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    @if(Package::where('id','=',Auth::user()->com_pack)->whereRaw('json_contains(package_module,
                                    \'["' . $organization_sub_module_seventeen . '"]\')')->exists())
                                    @if(Permission::where('permission_com_id','=',
                                    Auth::user()->com_id)->where('permission_role_id','=',Auth::user()->role_id)->whereRaw('json_contains(permission_content,
                                    \'["' . $organization_sub_module_seventeen . '"]\')')->exists() ||
                                    (Auth::user()->company_profile == 'Yes'))

                                    <div class="col-md-4 form-group">
                                        <label for="" class="text-bold">{{ $location11 ?? "location11"}} Name:</label>

                                        <select class="form-control location_eleven_id" name="location_eleven_id"
                                            id="location_eleven_id"></select>
                                    </div>
                                    @endif
                                    @endif
                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h3 >Employee Address Wise Search</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="text-bold">Division Name: </label>
                                        <select name="division_id" id="division_id"
                                            class="form-control selectpicker region" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="area_name"
                                            title="{{__('Selecting Division name')}}...">
                                            @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->dv_name}}</option>
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

                                    <div class="col-md-4 form-group">
                                        <label class="text-bold">{{__('Role')}} <span
                                                class="text-danger"></span></label>
                                        <select name="role_users_id" id="role_users_id"
                                            class="selectpicker form-control" data-live-search="true"
                                            data-live-search-style="begins"
                                            title="{{__('Selecting',['key'=>trans('file.Role')])}}...">
                                            @foreach ($roles as $item)
                                            <option value="{{$item->id}}">{{$item->roles_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group check-box">
                                        <input type="checkbox" name="over_time_payable" value="Yes"
                                            class="form-check-input">
                                        <label class="text-bold" for="exampleCheck1">Overtime Payable</label>
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <button type="submit" class="btn btn-grad"><i class="fa fa-download"></i>
                                            {{__('Download')}} </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

            var i = 1;
            $('#user-table').DataTable({

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






        $('#company_id').on('change', function() {
               var companyID = $(this).val();
               if(companyID) {
                   $.ajax({
                       url: '/get-department/'+companyID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#department_id').empty();
                            $('#department_id').append('<option hidden value="" >Choose Department</option>');
                            $.each(data, function(key, departments){
                                $('select[name="department_id"]').append('<option value="'+ departments.id +'">' + departments.department_name+ '</option>');
                            });
                        }else{
                            $('#departments').empty();
                        }
                     }
                   });
               }else{
                 $('#departments').empty();
               }
            });

        $('#department_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-designation/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#designation_id').empty();
                            $('#designation_id').append('<option hidden value="" >Choose Designation</option>');
                            $.each(data, function(key, designations){
                                $('select[name="designation_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
                            });
                        }else{
                            $('#designations').empty();
                        }
                     }
                   });
               }else{
                 $('#designations').empty();
               }
        });

        $('#company_id').on('change', function() {
               var companyID = $(this).val();
               if(companyID) {
                   $.ajax({
                       url: '/get-office-shift/'+companyID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#office_shift_id').empty();
                            $('#office_shift_id').append('<option hidden value="" >Choose Office Shift</option>');
                            $.each(data, function(key, office_shifts){
                                $('select[name="office_shift_id"]').append('<option value="'+ office_shifts.id +'">' + office_shifts.shift_name+ '</option>');
                            });
                        }else{
                            $('#office_shifts').empty();
                        }
                     }
                   });
               }else{
                 $('#office_shifts').empty();
               }
            });



        $('#region_id').on('change', function() {
               var regionID = $(this).val();
               if(regionID) {
                   $.ajax({
                       url: '/get-area/'+regionID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#area_id').empty();
                            $('#area_id').append('<option hidden value="" >Choose Area</option>');
                            $.each(data, function(key, areas){
                                $('select[name="area_id"]').append('<option value="'+ areas.id +'">' + areas.area_name+ '</option>');
                            });
                        }else{
                            $('#areas').empty();
                        }
                     }
                   });
               }else{
                 $('#areas').empty();
               }
            });


        $('#area_id').on('change', function() {
               var areaID = $(this).val();
               if(areaID) {
                   $.ajax({
                       url: '/get-territory/'+areaID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#territory_id').empty();
                            $('#territory_id').append('<option hidden value="">Choose Territory</option>');
                            $.each(data, function(key, territories){
                                $('select[name="territory_id"]').append('<option value="'+ territories.id +'">' + territories.territory_name+ '</option>');
                            });
                        }else{
                            $('#territories').empty();
                        }
                     }
                   });
               }else{
                 $('#territories').empty();
               }
            });

            $('#territory_id').on('change', function() {
               var territoryID = $(this).val();
               if(territoryID) {
                   $.ajax({
                       url: '/get-town/'+territoryID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#town_id').empty();
                            $('#town_id').append('<option hidden value="">Choose Town</option>');
                            $.each(data, function(key, towns){
                                $('select[name="town_id"]').append('<option value="'+ towns.id +'">' + towns.town_name+ '</option>');
                            });
                        }else{
                            $('#towns').empty();
                        }
                     }
                   });
               }else{
                 $('#towns').empty();
               }
            });

            $('#town_id').on('change', function() {
               var townID = $(this).val();
               if(townID) {
                   $.ajax({
                       url: '/get-db-house/'+townID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#db_house_id').empty();
                            $('#db_house_id').append('<option hidden value="">Choose DB House</option>');
                            $.each(data, function(key, db_houses){
                                $('select[name="db_house_id"]').append('<option value="'+ db_houses.id +'">' + db_houses.db_house_name+ '</option>');
                            });
                        }else{
                            $('#db_houses').empty();
                        }
                     }
                   });
               }else{
                 $('#db_houses').empty();
               }
            });
            $('#db_house_id').on('change', function() {
                    var dbhouseID = $(this).val();
                    if(dbhouseID) {
                    $.ajax({
                    url: '/get-location-six/'+dbhouseID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data)
                    {
                    if(data){
                    $('#location_six_id').empty();
                    $('#location_six_id').append('<option hidden value="">Choose Town</option>');
                    $.each(data, function(key, locationsixes){
                    $('select[name="location_six_id"]').append('<option value="'+ locationsixes.id +'">' +
                        locationsixes.location_six_location_six_name+ '</option>');
                    });
                    }else{
                    $('#locationsixes').empty();
                    }
                    }
                    });
                    }else{
                    $('#locationsixes').empty();
                    }
                    });

                    $('#location_six_id').on('change', function() {
                            var locationsixID = $(this).val();
                            if(locationsixID) {
                            $.ajax({
                            url: '/get-location-seven/'+locationsixID,
                            type: "GET",
                            data : {"_token":"{{ csrf_token() }}"},
                            dataType: "json",
                            success:function(data)
                            {
                            if(data){
                            $('#location_seven_id').empty();
                            $('#location_seven_id').append('<option hidden value="">Choose Town</option>');
                            $.each(data, function(key, locationsevens){
                            $('select[name="location_seven_id"]').append('<option value="'+ locationsevens.id +'">' +
                                locationsevens.location_seven_name+ '</option>');
                            });
                            }else{
                            $('#locationsevens').empty();
                            }
                            }
                            });
                            }else{
                            $('#locationsevens').empty();
                            }
                            });
                            $('#location_seven_id').on('change', function() {
                                    var locationsevenID = $(this).val();
                                    if(locationsevenID) {
                                    $.ajax({
                                    url: '/get-location-eight/'+locationsevenID,
                                    type: "GET",
                                    data : {"_token":"{{ csrf_token() }}"},
                                    dataType: "json",
                                    success:function(data)
                                    {
                                    if(data){
                                    $('#location_eight_id').empty();
                                    $('#location_eight_id').append('<option hidden value="">Choose Town</option>');
                                    $.each(data, function(key, locationeights){
                                    $('select[name="location_eight_id"]').append('<option value="'+ locationeights.id +'">' +
                                        locationeights.location_eights_name+ '</option>');
                                    });
                                    }else{
                                    $('#locationeights').empty();
                                    }
                                    }
                                    });
                                    }else{
                                    $('#locationeights').empty();
                                    }
                                    });
                                    $('#location_eight_id').on('change', function() {
                                            var locationeightID = $(this).val();
                                            if(locationeightID) {
                                            $.ajax({
                                            url: '/get-location-nine/'+locationeightID,
                                            type: "GET",
                                            data : {"_token":"{{ csrf_token() }}"},
                                            dataType: "json",
                                            success:function(data)
                                            {
                                            if(data){
                                            $('#location_nine_id').empty();
                                            $('#location_nine_id').append('<option hidden value="">Choose Location</option>');
                                            $.each(data, function(key, locationnines){
                                            $('select[name="location_nine_id"]').append('<option value="'+ locationnines.id +'">' +
                                                locationnines.location_nine_name+ '</option>');
                                            });
                                            }else{
                                            $('#locationnines').empty();
                                            }
                                            }
                                            });
                                            }else{
                                            $('#locationnines').empty();
                                            }
                                            });
                                    $('#location_nine_id').on('change', function() {

                                            var locationtenID = $(this).val();

                                            if(locationtenID) {
                                            $.ajax({
                                            url: '/get-location-ten/'+locationtenID,
                                            type: "GET",
                                            data : {"_token":"{{ csrf_token() }}"},
                                            dataType: "json",
                                            success:function(data)
                                            {
                                            if(data){
                                            $('#location_ten_id').empty();
                                            $('#location_ten_id').append('<option hidden value="">Choose Location</option>');
                                            $.each(data, function(key, locationtens){

                                            $('select[name="location_ten_id"]').append('<option value="'+ locationtens.id +'">' + locationtens.location_ten_name+ '</option>');
                                            });
                                            }else{
                                            $('#locationtens').empty();
                                            }
                                            }
                                            });
                                            }else{
                                            $('#locationtens').empty();
                                            }
                                            });

                                    });

                                    $('.location_ten_id').on('change', function() {
                                            var locationelevenID = $(this).val();
                                            if(locationelevenID) {
                                            $.ajax({
                                            url: '/get-location-eleven/'+locationelevenID,
                                            type: "GET",
                                            data : {"_token":"{{ csrf_token() }}"},
                                            dataType: "json",
                                            success:function(data)
                                            {
                                            if(data){
                                            $('.location_eleven_id').empty();
                                            $('.location_eleven_id').append('<option hidden value="">Choose Location</option>');
                                            $.each(data, function(key, locationelevens){
                                            $('select[name="location_eleven_id"]').append('<option value="'+ locationelevens.id +'">' +
                                                locationelevens.location_eleven_name+ '</option>');
                                            });
                                            }else{
                                            $('#locationelevens').empty();
                                            }
                                            }
                                            });
                                            }else{
                                            $('#locationelevens').empty();
                                            }
                                            });

                                            $('#division_id').on('change', function() {
                                                        var regionID = $(this).val();
                                                        if(regionID) {
                                                        $.ajax({
                                                        url: '/get-district/'+regionID,
                                                        type: "GET",
                                                        data : {"_token":"{{ csrf_token() }}"},
                                                        dataType: "json",
                                                        success:function(data)
                                                        {
                                                        if(data){
                                                        $('#district_id').empty();
                                                        $('#district_id').append('<option hidden value="">Choose Division</option>');
                                                        $.each(data, function(key, districts){
                                                        $('select[name="district_id"]').append('<option value="'+ districts.id +'">' + districts.dist_name+ '</option>');
                                                        });
                                                        }else{
                                                        $('#districts').empty();
                                                        }
                                                        }
                                                        });
                                                        }else{
                                                        $('#districts').empty();
                                                        }
                                                        });

                                                        $('#district_id').on('change', function() {
                                                                    var areaID = $(this).val();
                                                                    if(areaID) {
                                                                    $.ajax({
                                                                    url: '/get-upazila/'+areaID,
                                                                    type: "GET",
                                                                    data : {"_token":"{{ csrf_token() }}"},
                                                                    dataType: "json",
                                                                    success:function(data)
                                                                    {
                                                                    if(data){
                                                                    $('#upazila_id').empty();
                                                                    $('#upazila_id').append('<option hidden value="">Choose Upazila</option>');
                                                                    $.each(data, function(key, upazilas){
                                                                    $('select[name="upazila_id"]').append('<option value="'+ upazilas.id +'">' + upazilas.up_name+ '</option>');
                                                                    });
                                                                    }else{
                                                                    $('#upazilas').empty();
                                                                    }
                                                                    }
                                                                    });
                                                                    }else{
                                                                    $('#upazilas').empty();
                                                                    }
                                                                    });

</script>
@endsection
