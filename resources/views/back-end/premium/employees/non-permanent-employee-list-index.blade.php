@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
    use App\Models\Permission;

    $employee_sub_module_one_add = '2.1.1';
    $employee_sub_module_one_edit = '2.1.2';
    $employee_sub_module_one_delete = '2.1.3';

    $current_date = date('Y-m-d');
    $range_date = date('Y-m-d', strtotime('+30 days', strtotime($current_date)));

    ?>

<section class="main-contant-section">

    <div class="container-fluid"><span id="general_result"></span></div>

    <div class="container-fluid mb-3">

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


        <div class="">
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title text-center"> {{ __('Contract Renewal') }} </h3>
                </div>
                <div class="d-flex flex-row">

                    @if ($delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                    <div class="p-2">

                        <div class="btn btn-grad ml-2">
                            <a href="#employeeBulkRenewFormModal" data-toggle="modal"
                                data-target="#employeeBulkRenewFormModal"><span style="color:white;">Bulk
                                    Renew<span></a>
                        </div>

                        <!-- add modal code starts from here -->

                        <div id="employeeBulkRenewFormModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 id="exampleModalLabel" class="modal-title">{{ __('Bulk Renew') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <span id="form_result"></span>
                                        <form method="post" action="{{ route('bulk-renew-employees') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="bulk_renew_com_id"
                                                value="{{ Auth::user()->com_id }}">
                                            <label for="">Expiry Date</label>
                                            <input type="date" name="expiry_date" value="" placeholder="Expiry Date"
                                                class="form-control">
                                            <br>
                                            <div class="input-group">
                                                <label for="">Renewal Template</label>
                                                <select name="contact_renewal_id" id="employment_type" required
                                                    class="form-control">
                                                    <option value="">{{ __('Select A Renewal Template ') }}</option>
                                                    @foreach ($contact_renewals as $contact_renewal)
                                                    <option value="{{ $contact_renewal->id }}">
                                                        {{ $contact_renewal->contact_renewal_letter_template_name
                                                        }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <input type="submit" class="btn btn-danger"
                                                value="{{ __('Bulk Renew') }}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- add modal code ends here -->
                    </div>
                    @endif

                </div>

                <div class="content-box">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('employee-bulk-renew-filterings') }}">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="" class="text-bold">Company: </label>
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

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Department:</label>
                                            <select class="form-control" name="department_id"
                                                id="department_id"></select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Designation:</label>
                                            <select class="form-control" name="designation_id"
                                                id="designation_id"></select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="text-bold">{{ __('Region') }} <span
                                                    class="text-danger"></span></label>
                                            <select name="region_id" id="region_id"
                                                class="form-control selectpicker region" data-live-search="true"
                                                data-live-search-style="begins" data-dependent="area_name"
                                                title="{{ __('Selecting Region name') }}...">
                                                @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->region_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Area name:</label>
                                            <select class="form-control" name="area_id" id="area_id"></select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Territory Name:</label>
                                            <select class="form-control" name="territory_id" id="territory_id"></select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Town Name:</label>
                                            <select class="form-control" name="town_id" id="town_id"></select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">DB House Name:</label>
                                            <select class="form-control" name="db_house_id" id="db_house_id"></select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="" class="text-bold">Expiry Date:</label>
                                            <input type="date" name="expiry_date" value="" class="form-control"
                                                required>
                                        </div>
                                        <div class="input-group col-md-4">
                                            <label for="">Renewal Template</label>
                                            <select name="contact_renewal_id" id="employment_type" required
                                                class="form-control">
                                                <option value="">{{ __('Select A Renewal Template ') }}</option>
                                                @foreach ($contact_renewals as $contact_renewal)
                                                <option value="{{ $contact_renewal->id }}">
                                                    {{ $contact_renewal->contact_renewal_letter_template_name
                                                    }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group check-box">
                                            <input type="checkbox" name="is_active" value="1" class="form-check-input">
                                            <label class="text-bold" for="exampleCheck1">Is Active</label>

                                        </div>

                                        <div class="col-md-12 form-group mt-4">
                                            <button type="submit" class="btn btn-grad"><i class="fa fa-refresh"></i>
                                                {{ __('Renew') }} </button>
                                        </div>

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
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Employee Company ID') }}</th>
                            <th>{{ __('Profile Photo') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Employment Type') }}</th>
                            <th>{{ __('Joining Date') }}</th>
                            <th>{{ __('Expiry Date') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' ||
                            Auth::user()->company_profile == 'Yes')
                            <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($users as $usersData)
                        <?php

                                //if($usersData->expiry_date >= $current_date && $usersData->expiry_date <= $range_date){
                                // if($usersData->expiry_date <= $range_date || $usersData->expiry_date <= $current_date){

                                //     echo 'ok';

                                // }else{
                                //     echo 'not ok';
                                // }
                                ?>
                        <tr>

                            <td>{{ $i++ }}</td>
                            <td>{{ $usersData->company_assigned_id }}</td>
                            <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}"><img class="rounded"
                                        width="60" src="{{ asset($usersData->profile_photo) }}"></a></td>
                            <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{
                                    $usersData->first_name . ' ' . $usersData->last_name }}</a>
                            </td>
                            {{-- <td><a href="{{route('profile-details')}}">{{$usersData->first_name.'
                                    '.$usersData->last_name}}</a></td> --}}
                            <td>{{ $usersData->email }}</td>
                            <td>{{ $usersData->phone }}</td>
                            <td>{{ $usersData->employment_type }}</td>
                            <td>{{ $usersData->joining_date }}</td>
                            <td>{{ $usersData->expiry_date }}</td>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' ||
                            Auth::user()->company_profile == 'Yes')
                            <td>
                                @if ($usersData->expiry_date <= $range_date || $usersData->expiry_date <= $current_date)
                                        <a href="javascript:void(0)" class="renew" data-id="{{ $usersData->id }}">
                                        <button class="btn btn-success"><i class="fa fa-refresh"
                                                aria-hidden="true"></i></button></a>

                                        @endif
                                        @if ($edit_permission == 'Yes')
                                        <a href="javascript:void(0)" class="edit" data-id="{{ $usersData->id }}"><button
                                                class="btn btn-info" style="width:20px;"><i class="fa fa-edit"
                                                    style="margin-left:-6px;"></i></button></a>

                                        @endif
                                        @if ($delete_permission == 'Yes')
                                        <a href="{{ route('delete-user', ['id' => $usersData->id]) }}"
                                            data-id="{{ $usersData->id }}"><button class="btn btn-danger"
                                                style="width:20px;"><i class="fa fa-trash"
                                                    style="margin-left:-6px;"></i></button></a>
                                        @endif
                            </td>
                            @endif

                        </tr>

                        <!-- edit boostrap model -->
                        <div class="modal fade" id="renew-modal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="ajaxRenewModelTitle"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('employees-renews') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="edit_id" value="{{ $usersData->id }}">
                                            <div class="row">

                                                <div class="col-md-6 form-group">
                                                    <label class="text-bold">{{ __('Expiry Date') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" name="expiry_date" id="edit_expiry_date" required
                                                        class="form-control" value="{{ $usersData->expiry_date }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="text-bold">{{ __('Renewal Template') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="contact_renewal_id" id="employment_type" required
                                                        class="form-control">
                                                        <option value="">{{ __('Select A Renewal Template ') }}</option>
                                                        @foreach ($contact_renewals as $contact_renewal)
                                                        <option value="{{ $contact_renewal->id }}">
                                                            {{ $contact_renewal->contact_renewal_letter_template_name
                                                            }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-grad w-50">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end bootstrap model -->


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


        <!-- edit boostrap model -->
        <div class="modal fade" id="edit-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('ID') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="company_assigned_id" id="edit_company_assigned_id" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('First Name') }} *</label>
                                    <input type="text" name="first_name" id="edit_first_name" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('Last Name') }} *</label>
                                    <input type="text" name="last_name" id="edit_last_name" required
                                        class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>{{ __('Username') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="edit_username" required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="edit_email" required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="contact_no" id="edit_contact_no" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><strong>{{ __('Address') }}</strong><span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="address" id="edit_address" required class="form-control">
                                </div>
                                <div class="col-md-6 form-group ">
                                    <label for="profile_photo_edit" class=""><strong>{{ __('Image') }}</strong></label>
                                    <img src="">
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                        name="profile_photo">
                                    <span></span>
                                </div>

                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-grad w-50">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- end bootstrap model -->



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


            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'user-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_company_assigned_id').val(res.company_assigned_id);
                        $('#edit_first_name').val(res.first_name);
                        $('#edit_last_name').val(res.last_name);
                        $('#edit_username').val(res.username);
                        $('#edit_email').val(res.email);
                        $('#edit_contact_no').val(res.phone);
                        $('#edit_address').val(res.address);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-employee`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                            this.reset();
                            alert('Data has been updated successfully');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends



            //value retriving and opening the edit modal starts

            $('.renew').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'user-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxRenewModelTitle').html("Renew");
                        $('#renew-modal').modal('show');
                        $('#edit_id').val(res.id);
                        $('#edit_expiry_date').val(res.expiry_date);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#renew_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/renew-employee`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                            this.reset();
                            alert('Data has been updated successfully');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends






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
                                    '<option hidden value="">Choose Department</option>');
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
                                    '<option hidden value="">Choose Designation</option>');
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
                                    '<option hidden value="" >Choose Territory</option>');
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
                                    '<option hidden value="" >Choose Town</option>');
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
                                    '<option hidden value="" >Choose Town</option>');
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

            $('#admin_company_id').on('change', function() {
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
                                $('#admin_department_id').empty();
                                $('#admin_department_id').append(
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

            $('#admin_department_id').on('change', function() {
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
                                $('#admin_designation_id').empty();
                                $('#admin_designation_id').append(
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

        });
</script>
@endsection
