@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\Department;
    ?>
    <section class="main-contant-section">


        <div class=" mb-3">

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
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Complaint List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Complaint </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row">

                @if ($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-complaints')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
                        <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                    </form>
                </div>
                @endif
            </div> --}}


        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Complaint') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-complaints') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 form-group">
                                    <label>Complaint From Department's Employee</label>
                                    <select class="form-control" name="complaint_from_department_id"
                                        id="complaint_from_department_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Complaint From') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="complaint_from_employee_id"
                                        id="complaint_from_employee_id"></select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Complaint To Department's Employee</label>
                                    <select class="form-control" name="complaint_to_department_id"
                                        id="complaint_to_department_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Complaint Against') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="complaint_to_employee_id"
                                        id="complaint_to_employee_id"></select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Complaint Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="complaint_date" class="form-control date"
                                            value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Title</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="complaint_title" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-12  form-group">
                                    <label for="my-textarea">Description</label>
                                    <textarea class="form-control" name="complaint_desc"></textarea>
                                </div>

                                <div class="col-sm-12 mt-4">

                                    <input type="submit" name="action_button" class="btn btn-grad"
                                        value="{{ __('Add') }}" />

                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

        <!-- Add Modal Ends -->
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Complaint From Department') }}</th>
                            <th>{{ __('Complaint From Employee') }}</th>
                            <th>{{ __('Complaint To Department') }}</th>
                            <th>{{ __('Complaint Against') }}</th>
                            <th>{{ __('Complaint Date') }}</th>
                            <th>{{ __('Complaint Title') }}</th>
                            <th>{{ __('Complaint Description') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @php($i = 1)
                        @foreach ($complaints as $complaints_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <?php
                                $complaint_from_department = Department::where('id', $complaints_value->complaint_from_department_id)->get(['department_name']);
                                $complaint_to_department = Department::where('id', $complaints_value->complaint_to_department_id)->get(['department_name']);
                                $complaint_from = User::where('id', $complaints_value->complaint_from_employee_id)->get(['first_name', 'last_name']);
                                $complaint_to = User::where('id', $complaints_value->complaint_to_employee_id)->get(['first_name', 'last_name']);

                                ?>

                                <td><?php foreach ($complaint_from_department as $complaint_from_department_value) {
                                    echo $complaint_from_department_value->department_name;
                                } ?></td>
                                <td><?php foreach ($complaint_from as $complaint_from_value) {
                                    echo $complaint_from_value->first_name . ' ' . $complaint_from_value->last_name;
                                } ?></td>
                                <td><?php foreach ($complaint_to_department as $complaint_to_department_value) {
                                    echo $complaint_to_department_value->department_name;
                                } ?></td>
                                <td><?php foreach ($complaint_to as $complaint_to_value) {
                                    echo $complaint_to_value->first_name . ' ' . $complaint_to_value->last_name;
                                } ?></td>
                                <td>{{ $complaints_value->complaint_date }}</td>
                                <td>{{ $complaints_value->complaint_title }}</td>
                                <td>{{ $complaints_value->complaint_desc }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                            data-id="{{ $complaints_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                     @if ($delete_permission == 'Yes')
                                        <a href="{{ route('delete-complaints', ['id' => $complaints_value->id]) }}"
                                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                        data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    @endif


                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
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
                    <form method="post" action="{{ route('update-complaints') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Complaint From Department's Employee</label>
                                <select class="form-control" name="edit_complaint_from_department_id"
                                    id="edit_complaint_from_department_id">
                                    <option value="">Select-a-Department</option>
                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}">
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Complaint From') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="edit_complaint_from_employee_id"
                                    id="edit_complaint_from_employee_id">
                                    @foreach ($employees as $employees_value)
                                        <option value="{{ $employees_value->id }}">{{ $employees_value->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Complaint To Department's Employee</label>
                                <select class="form-control" name="edit_complaint_to_department_id"
                                    id="edit_complaint_to_department_id">
                                    <option value="">Select-a-Department</option>
                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}">
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Complaint Against') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="edit_complaint_to_employee_id"
                                    id="edit_complaint_to_employee_id">
                                    @foreach ($employees as $employees_value)
                                        <option value="{{ $employees_value->id }}">{{ $employees_value->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Complaint Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="complaint_date" id="complaint_date"
                                        class="form-control date" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Title</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="complaint_title" id="complaint_title"
                                        class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-12  form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="complaint_desc" id="complaint_desc"></textarea>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad">Save changes</button>
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
                    url: 'complaint-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_complaint_from_department_id').val(res
                            .complaint_from_department_id);
                        $('#edit_complaint_to_department_id').val(res
                            .complaint_to_department_id);
                        $('#edit_complaint_from_employee_id').val(res
                            .complaint_from_employee_id);
                        $('#edit_complaint_to_employee_id').val(res.complaint_to_employee_id);
                        $('#complaint_date').val(res.complaint_date);
                        $('#complaint_title').val(res.complaint_title);
                        $('#complaint_desc').val(res.complaint_desc);
                    }
                });
            });

            //value retriving and opening the edit modal ends

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



            $('#complaint_from_department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-department-wise-employee/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#complaint_from_employee_id').empty();
                                $('#complaint_from_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="complaint_from_employee_id"]')
                                        .append('<option value="' + employees.id +
                                            '">' + employees.first_name + ' ' +
                                            employees.last_name + '</option>');
                                });
                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });

            $('#complaint_to_department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-department-wise-employee/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#complaint_to_employee_id').empty();
                                $('#complaint_to_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="complaint_to_employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.first_name + ' ' + employees
                                        .last_name + '</option>');
                                });
                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });

            $('#edit_complaint_from_department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-department-wise-employee/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#edit_complaint_from_employee_id').empty();
                                $('#edit_complaint_from_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_complaint_from_employee_id"]')
                                        .append('<option value="' + employees.id +
                                            '">' + employees.first_name + ' ' +
                                            employees.last_name + '</option>');
                                });
                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });

            $('#edit_complaint_to_department_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-department-wise-employee/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#edit_complaint_to_employee_id').empty();
                                $('#edit_complaint_to_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_complaint_to_employee_id"]')
                                        .append('<option value="' + employees.id +
                                            '">' + employees.first_name + ' ' +
                                            employees.last_name + '</option>');
                                });
                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });




            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
                endDate: date
            });





        });
    </script>
@endsection
