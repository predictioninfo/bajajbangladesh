@extends('back-end.premium.layout.premium-main')
@section('content')

<section>


    <div class="container-fluid mb-3">

        @if (Session::get('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @foreach ($errors->all() as $error)
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        @if ($add_permission == 'Yes')
        <div class="card mb-4">
            <div class="card-header with-border" style="background:#44463b; color:white;">
                <h3 class="card-title text-center"> {{ __('Key Performance Indicators(KPI) or Objectives') }} </h3>
            </div>
            <div class="card-body" style="background:#96a79a; color:white;">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('add-objectives') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label>{{ __('Goal Type') }} *</label>
                                    <select name="objective_goal_type_id" id="objective_goal_type_id"
                                        class="form-control" required>
                                        <option>Choose an Goal Type</option>
                                        @foreach ($goal_types as $goal_types_value)
                                        <option value="{{ $goal_types_value->id }}">
                                            {{ $goal_types_value->goal_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Goal Tracking Key') }} <span
                                                class="text-danger">*</span></label>
                                        {{--
                                        <select name="goal_tracking_key" id="goal_tracking_key" required
                                            class="form-control selectpicker dynamic" data-live-search="true"
                                            data-live-search-style="begins">
                                        </select>
                                        --}}

                                        <select class="form-control" name="goal_tracking_key"
                                            id="goal_tracking_key"></select>

                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>{{ __('Objective Type') }} *</label>
                                    <select name="objective_obj_type_id" class="form-control" required>
                                        <option>Choose an Objective Type</option>
                                        @foreach ($objective_types as $objective_types_value)
                                        <option value="{{ $objective_types_value->id }}">
                                            {{ $objective_types_value->objective_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @foreach ($roles as $roles_value)
                                @if ($roles_value->roles_admin_status == 'Yes')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>

                                        <select name="department_id" id="department_id" required
                                            class="form-control selectpicker dynamic" data-live-search="true"
                                            data-live-search-style="begins" data-shift_name="shift_name"
                                            data-dependent="department_name">
                                            <option value="">Select-a-Department</option>
                                            @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Designation') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="designation_id" id="designation_id"></select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control selectpicker" name="employee_id" id="employee_id"
                                        data-live-search="true" data-live-search-style="startsWith"></select>
                                </div>
                                @else
                                <input class="form-control" type="hidden" name="department_id"
                                    value="{{ Auth::user()->department_id }}" required>
                                <input class="form-control" type="hidden" name="designation_id"
                                    value="{{ Auth::user()->designation_id }}" required>
                                <input class="form-control" type="hidden" name="employee_id"
                                    value="{{ Auth::user()->id }}" required>
                                @endif
                                @endforeach

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('Name') }}</label>
                                        <input class="form-control" type="text" name="objective_name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('Success Measures') }}</label>
                                        <input class="form-control" type="text" name="objective_success" required>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{
                                                __('Add') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif


    </div>



    <div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead style="background-color:#00695c; color:white;">
                <tr>
                    <th>SL</th>
                    <th>Goal Type</th>
                    <th>Goal Tracking Key</th>
                    <th>Objective Type</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Empoloyee</th>
                    <th>Objective Name</th>
                    <th>Success Measurements</th>
                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @php($i = 1)
                @foreach ($objectives as $objectives_value)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $objectives_value->usergoaltypefromobjective->goal_type_name ?? null }}</td>
                    <td class="text-center"> <a
                            href="{{ route('key-wise-goal-trackings', ['slug' => $objectives_value->objective_slug]) }}"
                            style="color:white; background-color:#e78492;">{{ $objectives_value->objective_gl_trkng_key
                            }}</a>
                    </td>
                    <td>{{ $objectives_value->userobjectivetypefromobjective->objective_type_name ?? null }}</td>
                    <td>{{ $objectives_value->userdepartmentfromobjective->department_name ?? null }}</td>
                    <td>{{ $objectives_value->userdesignationfromobjective->designation_name ?? null }}</td>
                    <td>{{ $objectives_value->userfromobjective->first_name ?? null }}
                        {{ $objectives_value->userfromobjective->last_name ?? null }}</td>
                    <td>{{ $objectives_value->objective_name }}</td>
                    <td>{{ $objectives_value->objective_success }}</td>
                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                    <td>
                        @if ($edit_permission == 'Yes')
                        <a href="javascript:void(0)" class="btn btn-primary edit"
                            data-id="{{ $objectives_value->id }}">Edit</a>
                        @endif
                        @if ($delete_permission == 'Yes')
                        <a href="{{ route('delete-objectives', ['id' => $objectives_value->id]) }}"
                            class="btn btn-danger delete-post">Delete</a>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach

            </tbody>

        </table>

    </div>
</section>

<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('update-objectives') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" required>
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label>{{ __('Goal Type') }} *</label>
                            <select name="objective_goal_type_id" id="objective_goal_type_id" class="form-control"
                                required>
                                <option>Choose an Goal Type</option>
                                @foreach ($goal_types as $goal_types_value)
                                <option value="{{ $goal_types_value->id }}">
                                    {{ $goal_types_value->goal_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ __('Objective Type') }} *</label>
                            <select name="objective_obj_type_id" id="objective_obj_type_id" class="form-control"
                                required>
                                <option>Choose an Objective Type</option>
                                @foreach ($objective_types as $objective_types_value)
                                <option value="{{ $objective_types_value->id }}">
                                    {{ $objective_types_value->objective_type_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-bold">{{ __('Department') }} <span
                                        class="text-danger">*</span></label>

                                <select name="edit_department_id" id="edit_department_id" required
                                    class="form-control selectpicker dynamic" data-live-search="true"
                                    data-live-search-style="begins" data-shift_name="shift_name"
                                    data-dependent="department_name">
                                    <option value="">Select-a-Department</option>
                                    @foreach ($departments as $departments_value)
                                    <option value="{{ $departments_value->id }}">
                                        {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{ __('Designation') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_designation_id" id="edit_designation_id"
                                required></select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="edit_employee_id" id="edit_employee_id"
                                data-live-search="true" data-live-search-style="startsWith" required></select>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="start_date">{{ __('Name') }}</label>
                                <input class="form-control" type="text" name="objective_name" id="objective_name"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">{{ __('Success Measures') }}</label>
                                <input class="form-control" type="text" name="objective_success" id="objective_success"
                                    required>
                            </div>
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
                    url: 'objective-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#objective_goal_type_id').val(res.objective_goal_type_id);
                        $('#objective_obj_type_id').val(res.objective_obj_type_id);
                        $('#objective_name').val(res.objective_name);
                        $('#objective_success').val(res.objective_success);
                    }
                });
            });

            //value retriving and opening the edit modal ends


            $('#user-table').DataTable({


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



            $('#objective_goal_type_id').on('change', function() {
                var goalTypeID = $(this).val();
                //document.write(goalTypeID);
                //document.write("Hello World!");
                if (goalTypeID) {
                    $.ajax({
                        url: '/get-goal-tracking-key/' + goalTypeID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#goal_tracking_key').empty();
                                $('#goal_tracking_key').append(
                                    '<option hidden value="">Choose a key</option>');
                                $.each(data, function(key, goal_tracking_keys) {
                                    $('select[name="goal_tracking_key"]').append(
                                        '<option value="' + goal_tracking_keys
                                        .goal_tracking_key + '">' +
                                        goal_tracking_keys.goal_tracking_key +
                                        '</option>');
                                });
                            } else {
                                $('#goal_tracking_key').empty();
                            }
                        }
                    });
                } else {
                    $('#goal_tracking_key').empty();
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





            $('#designation_id').on('change', function() {
                var designationID = $(this).val();
                if (designationID) {
                    $.ajax({
                        url: '/get-designation-wise-employee/' + designationID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#employee_id').empty();
                                //$('#resignation_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + '(' +
                                        employees.first_name + ' ' + employees
                                        .last_name + ')' + '</option>');
                                });

                                $(".selectpicker").selectpicker('refresh');

                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });



            $('#edit_department_id').on('change', function() {
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
                                $('#edit_designation_id').empty();
                                $('#edit_designation_id').append(
                                    '<option hidden value="">Choose Designation</option>');
                                $.each(data, function(key, designations) {
                                    $('select[name="edit_designation_id"]').append(
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




            $('#edit_designation_id').on('change', function() {
                var designationID = $(this).val();
                if (designationID) {
                    $.ajax({
                        url: '/get-designation-wise-employee/' + designationID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#edit_employee_id').empty();
                                //$('#edit_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + '(' +
                                        employees.first_name + ' ' + employees
                                        .last_name + ')' + '</option>');
                                });

                                $(".selectpicker").selectpicker('refresh');

                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });

        });
</script>



@endsection