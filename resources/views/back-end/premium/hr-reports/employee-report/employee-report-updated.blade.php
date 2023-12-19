@extends('back-end.premium.layout.premium-main')

@section('content')

<?php

use App\Models\User;
use App\Models\EmployeeDetail;

?>


<script>
    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });
</script>

<section class="main-contant-section">
    <!--        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">-->
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">-->


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

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header with-border">
                <h3 class="card-title text-center"> {{__('Filter Employees')}} </h3>
            </div>
            {{-- <div class="card-body"> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('employee-report-filterings')}}">
                                @csrf


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-bold">{{__('Company')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="company_id" id="company_id"
                                                class="form-control selectpicker dynamic" data-live-search="true"
                                                data-live-search-style="begins" data-shift_name="shift_name"
                                                data-dependent="department_name"
                                                title="{{__('Selecting',['key'=>trans('file.Company')])}}...">
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-bold">{{__('Department')}} <span
                                                    class="text-danger"></span></label>

                                            <select class="form-control" name="department_id"
                                                id="department_id"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{__('Designation')}} <span
                                                class="text-danger"></span></label>

                                        <select class="form-control" name="designation_id" id="designation_id"></select>

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{__('Office_Shift')}} <span
                                                class="text-danger"></span></label>

                                        <select class="form-control" name="office_shift_id"
                                            id="office_shift_id"></select>

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="" class="text-bold">Region Name:</label>
                                        <select name="region_id" id="region_id" class="form-control selectpicker region"
                                            data-live-search="true" data-live-search-style="begins"
                                            data-dependent="area_name" title="{{__('Selecting Region name')}}...">
                                            @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{$region->region_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="" class="text-bold">Area name:</label>

                                        <select class="form-control" name="area_id" id="area_id"></select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="" class="text-bold">Territory Name:</label>

                                        <select class="form-control" name="territory_id" id="territory_id"></select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="" class="text-bold">Town Name:</label>

                                        <select class="form-control" name="town_id" id="town_id"></select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="" class="text-bold">DB House Name:</label>

                                        <select class="form-control" name="db_house_id" id="db_house_id"></select>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label class="text-bold">{{__('Role')}} <span
                                                class="text-danger">*</span></label>
                                        <select name="role_users_id" id="role_users_id"
                                            class="selectpicker form-control" data-live-search="true"
                                            data-live-search-style="begins"
                                            title="{{__('Selecting',['key'=>trans('file.Role')])}}...">
                                            @foreach ($roles as $item)
                                            <option value="{{$item->id}}">{{$item->roles_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group mt-4 ml-5">
                                        <input type="checkbox" name="over_time_payable" value="Yes"
                                            class="form-check-input">
                                        <label class="text-bold" for="exampleCheck1">Overtime Payable</label>
                                    </div>

                                    {{-- <div class="col-md-6 form-group">
                                        <label class="text-bold" for="exampleCheck1">Overtime Rate(Times of
                                            Basic)</label>
                                        <input type="text" class="form-control" name="user_over_time_rate" value=""
                                            class="form-check-input">
                                    </div> --}}

                                    <div class="col-md-6 form-group mt-4 ml-5">
                                        <input type="checkbox" name="is_active" value="1" class="form-check-input"
                                            checked>
                                        <label class="text-bold" for="exampleCheck1">Is Active</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-bold">{{__('Category')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="category_name" id="add-button"
                                                class="form-control selectpicker dynamic" data-live-search="true"
                                                data-live-search-style="begins" data-shift_name="shift_name"
                                                data-dependent="category_name"
                                                title="{{__('Selecting',['key'=>trans('categories')])}}...">
                                                <option value="Search">Search</option>
                                                <option value="EmployeeReport">Download</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-info Search box"><i
                                                class="fa fa-search"></i> {{__('Search')}} </button>
                                        <button type="submit" class="btn btn-info EmployeeReport box"><i
                                                class="fa fa-download"></i> {{__('Download')}} </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped display nowrap" id="example"
                style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Employee-ID')}}</th>
                        <th>{{__('SU Code')}}</th>
                        <th>{{__('BL Username')}}</th>
                        <th>{{__('Username')}}</th>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>

                        <th>{{__('ID Card Number')}}</th>
                        <th>{{__('Religion')}}</th>
                        <th>{{__('Blood Group')}}</th>
                        <th>{{__('Marital Status')}}</th>
                        <th>{{__('Gender')}}</th>
                        <th>{{__('Role')}}</th>
                        <th>{{__('Father Name')}}</th>
                        <th>{{__('Mother Name')}}</th>
                        <th>{{__('Employement Type')}}</th>
                        <th>{{__('EC')}}</th>

                        <th>{{__('SAP')}}</th>
                        <th>{{__('TC')}}</th>
                        <th>{{__('SR Type')}}</th>
                        <th>{{__('Department')}}</th>
                        <th>{{__('Designation')}}</th>
                        <th>{{__('Region')}}</th>
                        <th>{{__('Area')}}</th>
                        <th>{{__('Territory')}}</th>
                        <th>{{__('Town')}}</th>
                        <th>{{__('DB Point')}}</th>
                        <th>{{__('DB Status')}}</th>
                        <th>{{__('Sub DB Name')}}</th>
                        <th>{{__('Sub DB Code')}}</th>
                        <th>{{__('Joning Date')}}</th>
                        <th>{{__('LWD')}}</th>
                        <th>{{__('DOB')}}</th>
                        <th>{{__('Experience Month')}}</th>
                        <th>{{__('Previous Organization')}}</th>
                        <th>{{__('Fixed Salary')}}</th>
                        <th>{{__('Mobile Allowance')}}</th>
                        <th>{{__('TA/TD')}}</th>
                        <th>{{__('Fixed Salary With Mobile Allowance')}}</th>
                        <th>{{__('1st Supervisor')}}</th>
                        <th>{{__('2nd Supervisor')}}</th>
                        <th>{{__('Bank Name')}}</th>
                        <th>{{__('Bank Account Number')}}</th>
                        <th>{{__('Provident Fund Member')}}</th>
                        {{-- <th>{{__('Nominees')}}</th> --}}
                        <th>{{__('Overtime Payable')}}</th>
                        <th>{{__('Overtime Rate(Times of Basic)')}}</th>

                        <th>{{__('Postal Area BN')}}</th>
                        <th>{{__('Vill BN')}}</th>
                        <th>{{__('District')}}</th>
                        <th>{{__('Address')}}</th>

                        <th>{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($users as $usersData)

                    {{--
                    <?php
                    $employee_details = EmployeeDetail::where('empdetails_employee_id',$usersData->id)->get();
                    ?>

                    @foreach($employee_details as $employee_details_value) --}}
                    <tr>

                        <td>{{$i++}}</td>
                        <td>{{$usersData->company_assigned_id}}</td>
                        <td>{{$usersData->emoloyeedetail->su_code ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->bangla_name ?? null}}</td>
                        <td><a href="{{route('employee-details',['id'=>$usersData->id])}}">{{$usersData->first_name.'
                                '.$usersData->last_name}}</a></td>
                        <td><a href="{{route('employee-details',['id'=>$usersData->id])}}"><img class="rounded"
                                    width="60" src="{{asset($usersData->profile_photo)}}"></a></td>
                        <td>{{$usersData->email ?? null}}</td>
                        <td>{{$usersData->phone}}</td>

                        <td>{{$usersData->emoloyeedetail->identification_type ?? null}} :
                            {{$usersData->emoloyeedetail->identification_number ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->religion ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->blood_group ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->marital_status ?? null}}</td>
                        <td>{{$usersData->gender}}</td>
                        <td>{{$usersData->userrole->roles_name ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->father_name ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->mother_name ?? null}}</td>
                        <td>{{$usersData->employment_type ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->ec_code ?? null}}</td>

                        <td>{{$usersData->emoloyeedetail->sap_code ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->tc_code ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->sr_type ?? null}}</td>
                        <td>{{$usersData->userdepartment->department_name ?? null}}</td>
                        <td>{{$usersData->userdesignation->designation_name ?? null}}</td>
                        <td>{{$usersData->userregion->region_name ?? null}}</td>
                        <td>{{$usersData->userarea->area_name ?? null}}</td>
                        <td>{{$usersData->userterritory->territory_name ?? null}}</td>
                        <td>{{$usersData->usertown->town_name ?? null}}</td>
                        <td>{{$usersData->userdbhouse->db_house_name ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->db_status ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->sub_db_name ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->sub_db_code ?? null}}</td>
                        <td>{{$usersData->joining_date}}</td>
                        <td>{{$usersData->expiry_date}}</td>
                        <td>{{$usersData->date_of_birth}}</td>
                        <td>{{$usersData->emoloyeedetail->experience_month ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->previous_organization ?? null}}</td>
                        <td>
                            {{$usersData->gross_salary}}<br>
                        </td>
                        <td>{{$usersData->mobile_bill}}</td>
                        <td>{{$usersData->transport_allowance}}</td>
                        <td>{{$usersData->gross_salary + $usersData->mobile_bill}}</td>

                        <?php

                        $first_supervisor_details = User::where('id',$usersData->report_to_parent_id)->get(['first_name','last_name','report_to_parent_id']);

                        $first_supervisor_name = '';
                        $second_supervisor_name = '';
                        if(User::where('id',$usersData->report_to_parent_id)->exists()){
                            foreach($first_supervisor_details as $first_supervisor_details_value){

                                $first_supervisor_name = $first_supervisor_details_value->first_name.' '.$first_supervisor_details_value->last_name;

                                if(User::where('id',$first_supervisor_details_value->report_to_parent_id)->exists()){
                                $second_supervisor_details = User::where('id',$first_supervisor_details_value->report_to_parent_id)->get(['first_name','last_name']);

                                foreach($second_supervisor_details as $second_supervisor_details_value){
                                    $second_supervisor_name = $second_supervisor_details_value->first_name.' '.$second_supervisor_details_value->last_name;
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
                        <td>{{$usersData->bankaccount->bank_name ?? null}}</td>
                        <td>{{$usersData->bankaccount->bank_account_number ?? null}}</td>
                        <td>{{$usersData->user_provident_fund_member}}</td>
                        {{-- <td>Nominees</td> --}}
                        <td>{{$usersData->over_time_payable ?? null}}</td>
                        <td>{{$usersData->user_over_time_rate ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->postal_area_bn ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->village_bn ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->district ?? null}}</td>
                        <td>{{$usersData->emoloyeedetail->permenet_address_english ?? null}}</td>
                        <td>
                            @if($usersData->is_active == 1)<span class="rounded"
                                style="background-color:green; color:white;">{{'Active'}}</span> @else <span
                                class="rounded" style="background-color:#c72727;  color:white;">{{'Inactive'}}</span>
                            @endif <br><br>
                            <form method="post" action="{{route('employee-report-downloads',['id'=>$usersData->id])}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$usersData->id}}">
                                <button type="submit">{{__('Download')}}</button>
                            </form>
                        </td>

                    </tr>

                    @endforeach

                    {{-- @endforeach --}}
                </tbody>

            </table>
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

                    "aLengthMenu": [[25, 50, 100,1500, -1], [25, 50, 100,1500, "All"]],
                    "iDisplayLength": 1500,

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


                        {
                            extend: 'csv',
                            charset: 'utf-8',
                            bom: true,
                            text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible'
                            },
                        },
                        {
                        extend: 'excelHtml5',
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







   });

</script>

@endsection