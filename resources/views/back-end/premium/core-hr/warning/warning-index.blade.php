@extends('back-end.premium.layout.premium-main')
@section('content')
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
                    <h1 class="card-title text-center"> {{ __('Warnings List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Warnings </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row">

                @if ($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-warnings')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
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
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Warning') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-warnings') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="warning_department_id" id="warning_department_id"
                                        required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="warning_employee_id"
                                        id="warning_employee_id"></select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Warning Type</label>
                                    <select class="form-control" name="warning_type" required>
                                        <option value="">Select-An-Warning-Type</option>
                                        @foreach ($warning_types as $warning_types_value)
                                            <option value="{{ $warning_types_value->variable_type_name }}">
                                                {{ $warning_types_value->variable_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Warning Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="warning_date" class="form-control date" value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Subject</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-assistive-listening-systems"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="warning_subject" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="my-textarea">Description</label>
                                    <textarea class="form-control" name="warning_desc" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="warning_status" value="Unsolved" class="form-control"
                                    value="">

                                    <div class="col-md-6 form-group">
                                        <label>Warning Letter Format</label>
                                        <select class="form-control" name="cirtificate_format_id" id="cirtificate_format_id">
                                            <option value="">Select-a-Format</option>
                                            @foreach ($cirtificateFormat as $value)
                                                <option value="{{ $value->id }}">
                                                    {{ $value->warning_letter_format_subject }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Add </button>

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
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Employee Name') }}</th>
                            <th>{{ __('Warning Type') }}</th>
                            <th>{{ __('Warning Date') }}</th>
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Warning Status') }}</th>
                            <th>{{ __('Download PDF') }}</th>

                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($warnings as $warnings_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $warnings_value->department_name }}</td>
                                <td>{{ $warnings_value->first_name . ' ' . $warnings_value->last_name }}</td>
                                <td>{{ $warnings_value->warning_type }}</td>
                                <td>{{ $warnings_value->warning_date }}</td>
                                <td>{{ $warnings_value->warning_subject }}</td>
                                <td>{{ $warnings_value->warning_desc }}</td>
                                <td>{{ $warnings_value->warning_status }}</td>

                                <td>

                                    <form method="post"
                                        action="{{route('warning-letter-downloads',['id'=>$warnings_value->id])}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$warnings_value->id}}">
                                        <button type="submit">{{__('Download')}}</button>
                                    </form>

                                </td>

                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>

                                                @if ($edit_permission == 'Yes')
                                                    <a href="javascript:void(0)" class="btn edit"
                                                        data-id="{{ $warnings_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                @endif
                                                @if ($delete_permission == 'Yes')
                                                    <a href="{{ route('delete-warnings', ['id' => $warnings_value->id]) }}"
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
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                        class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-warnings') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="edit_warning_department_id"
                                    id="edit_warning_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}">
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="edit_warning_employee_id"
                                    id="edit_warning_employee_id">
                                    @foreach ($employees as $employees_value)
                                        <option value="{{ $employees_value->id }}">{{ $employees_value->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Warning Type</label>
                                <select class="form-control" name="warning_type" id="warning_type" required>
                                    <option value="">Select-An-Warning-Type</option>
                                    @foreach ($warning_types as $warning_types_value)
                                        <option value="{{ $warning_types_value->variable_type_name }}">
                                            {{ $warning_types_value->variable_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Warning Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="warning_date" id="warning_date"
                                        class="form-control date" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Subject</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-assistive-listening-systems"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="warning_subject" id="warning_subject"
                                        class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="warning_desc" id="warning_desc" rows="3"></textarea>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Warning Status</label>
                                <select class="form-control" name="warning_status" id="warning_status">
                                    <option>Select a Status</option>
                                    <option value="Solved">Solved</option>
                                    <option value="Unsolved">Unsolved</option>
                                </select>
                            </div>


                            <div class="col-md-6 form-group">
                                <label>Warning Letter Format</label>
                                <select class="form-control" name="cirtificate_format_id" id="cirtificate_format_id">
                                    <option value="">Select-a-Format</option>
                                    @foreach ($cirtificateFormat as $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $warnings_value->cirtificate_format_id ? 'selected' : ''}}>
                                            {{ $value->warning_letter_format_subject }}</option>
                                    @endforeach
                                </select>
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
                    url: 'warning-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_warning_employee_id').val(res.warning_employee_id);
                        $('#edit_warning_department_id').val(res.warning_department_id);
                        $('#warning_date').val(res.warning_date);
                        $('#warning_type').val(res.warning_type);
                        $('#warning_subject').val(res.warning_subject);
                        $('#warning_desc').val(res.warning_desc);
                        $('#warning_status').val(res.warning_status);
                        $('#cirtificate_format_id').val(res.cirtificate_format_id);
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










            $('#warning_department_id').on('change', function() {
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
                                $('#warning_employee_id').empty();
                                $('#warning_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="warning_employee_id"]').append(
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

            $('#edit_warning_department_id').on('change', function() {
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
                                $('#edit_warning_employee_id').empty();
                                $('#edit_warning_employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_warning_employee_id"]').append(
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





            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
                endDate: date
            });






        });
    </script>
@endsection
