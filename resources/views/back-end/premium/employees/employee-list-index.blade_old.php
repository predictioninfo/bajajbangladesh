@extends('back-end.premium.layout.premium-main')

@section('content')
    <?php
    use App\Models\Permission;

    $employee_sub_module_one_add = '2.1.1';
    $employee_sub_module_one_edit = '2.1.2';
    $employee_sub_module_one_delete = '2.1.3';
    ?>

    <section>

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

            <div class="card mb-4">
                <div class="card-header with-border" style="background:#458191; color:white;">
                    <h1 class="card-title text-center"> {{ __('Employee List') }} </h1>
                </div>
            </div>

            <div class="d-flex flex-row">
                @if ($add_permission == 'Yes')
                    <div class="p-2">
                        <div class="dropdown">

                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus"></i> {{ __('Add Employee') }}
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#employeeFormModal" data-toggle="modal"
                                    data-target="#employeeFormModal">Add Employee</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($delete_permission == 'Yes')
                    <div class="p-2">
                        <form method="post" action="{{ route('bulk-delete-employees') }}" id="sample_form"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                                class="form-check-input">
                            <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
                        </form>
                    </div>
                    <div class="p-2">
                        <form method="post" action="{{ route('bulk-restore-employees') }}" id="sample_form"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                                class="form-check-input">

                            <input type="submit" class="btn btn-warning w-100" value="{{ __('Bulk Restore') }}" />

                        </form>
                    </div>
                @endif

            </div>





        </div>


        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#20898f; color:white;">
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Employee Company ID') }}</th>
                        <th>{{ __('Profile Photo') }}</th>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Salary Type') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Employee Setting') }}</th>
                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            <th>{{ __('Action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($users as $usersData)
                        <tr>

                            <td>{{ $i++ }}</td>
                            <td>{{ $usersData->company_assigned_id }}</td>
                            <td><a href="{{ route('employee-details', ['id' => $usersData->id]) }}"><img class="rounded"
                                        width="60" src="{{ asset($usersData->profile_photo) }}"></a></td>
                            <td><a
                                    href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{ $usersData->first_name . ' ' . $usersData->last_name }}</a>
                            </td>
                            {{-- <td><a href="{{route('profile-details')}}">{{$usersData->first_name.' '.$usersData->last_name}}</a></td> --}}
                            <td>{{ $usersData->email }}</td>
                            <td>{{ $usersData->phone }}</td>
                            <td>{{ $usersData->salary_type ?? '' }}</td>
                            <td>{{ $usersData->address }}</td>
                            {{-- <td><button class="btn btn-info"><a
                                        href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{ __('Settings for ') . $usersData->first_name . ' ' . $usersData->last_name }}</a></button>
                            </td> --}}
                            <td><button class="btn btn-info"><a
                                        href="{{ route('employee-details', ['id' => $usersData->id]) }}">{{ __('More Infomation')}}</a></button>
                            </td>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <td>
                                    <a href="{{ route('employee-attendance-forms', ['id' => $usersData->id]) }}"
                                        target="_blank"><button class="btn btn-primary">A</button></a>
                                    @if ($edit_permission == 'Yes')
                                        <a href="javascript:void(0)" class="edit" data-id="{{ $usersData->id }}"><button
                                                class="btn btn-info" style="width:20px;"><i class="fa fa-edit"
                                                    style="margin-left:-6px;"></i></button></a>
                                        ||
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
                    @endforeach
                </tbody>

            </table>
        </div>
    </section>




    <!-- add modal code starts from here -->

    <div id="employeeFormModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ __('Add Employee') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <span id="form_result"></span>


                </div>
            </div>
        </div>
    </div>

    <!-- add modal code ends here -->




    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('employees-updates') }}" class="form-horizontal"
                        enctype="multipart/form-data">
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
                                <label><strong>{{ __('Address') }}</strong><span class="text-danger">*</span></label>
                                <input type="text" name="address" id="edit_address" required class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{ __('Staff Type') }} <span
                                        class="text-danger">*</span></label>
                                <select name="appointment_letter" id="edit_appointment_letter" class="form-control"
                                    required>
                                    <option value="">Select Staff Type</option>
                                    <option value="management">Management</option>
                                    <option value="nonmanagement">Non Management</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{ __('Salary Type') }} <span
                                        class="text-danger">*</span></label>
                                <select name="salary_type" id="edit_salary_type" class="form-control" required>
                                    <option value="">Select Salary Type</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Hourly">Hourly</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group ">
                                <label for="profile_photo_edit"
                                    class=""><strong>{{ __('Image') }}</strong></label>
                                <img src="">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    name="profile_photo">
                                <span></span>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save changes</button>
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




    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                        $('#edit_salary_type').val(res.salary_type);
                        $('#edit_address').val(res.address);
                        $('#edit_appointment_letter').val(res.appointment_letter);
                    }
                });
            });

            //value retriving and opening the edit modal ends

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
