@extends('back-end.premium.layout.premium-main')
@section('content')
<?php
    use App\Models\User;
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
                    <h1 class="card-title text-center"> {{ __('Events List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - {{ 'Events List' }} </a></li>
                    </ol>
                </div>
            </div>


            {{-- <div class="d-flex flex-row mt-3">

                @if ($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-events')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
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
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Event') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-events') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">


                                <div class="col-md-4 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="event_department_id" id="event_department_id"
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
                                    <select id="events_employee_id" name="events_employee_id[]" class="form-control"
                                        multiple="multiple" required>
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Title</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-text-height"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="event_title" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="event_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Time</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="time" name="event_time" class="form-control" required>
                                    </div>
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
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Event Title') }}</th>
                            <th>{{ __('Event Date') }}</th>
                            <th>{{ __('Event Time') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($events as $events_value)
                            <tr>
                                <td>{{ $i++ }}</td>

                                <td>{{ $events_value->department_name }}</td>
                                <td>
                                    @foreach (json_decode($events_value->events_employee_id) as $test)
                                        <?php
                                        $users = User::where('id', $test)->get(['first_name', 'last_name']);
                                        foreach ($users as $users_data) {
                                            echo $users_data->first_name . ' ' . $users_data->last_name . '<br>';
                                        }
                                        ?>
                                    @endforeach
                                </td>
                                <td>{{ $events_value->event_title }}</td>
                                <td>{{ $events_value->event_date }}</td>
                                <td>{{ $events_value->event_time }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <td>
                                    @if ($edit_permission == 'Yes')
                                        <a href="javascript:void(0)" class="btn edit"
                                        data-id="{{ $events_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    @endif

                                    @if ($delete_permission == 'Yes')
                                     <a href="{{ route('delete-events', ['id' => $events_value->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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
                    <form method="post" action="{{ route('update-events') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="not_edited_department_id" id="event_department_id_hidden">
                        <input type="hidden" name="not_edited_employee_id" id="event_employee_id_hidden">
                        <input type="hidden" name="event_unique_key" id="event_unique_key">
                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="event_department_id" id="edit_event_department_id"
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
                                <select class="form-control" name="events_employee_id[]" id="edit_event_employee_id"
                                    multiple="multiple">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Title</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="event_title" id="event_title" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="event_date" id="event_date" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Time</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="event_time" id="event_time" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad ">Save changes</button>
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
                    url: 'event-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#event_unique_key').val(res.event_unique_key);
                        $('#edit_event_employee_id').val(res.events_employee_id);
                        $('#edit_event_department_id').val(res.event_department_id);
                        $('#event_title').val(res.event_title);
                        $('#event_date').val(res.event_date);
                        $('#event_time').val(res.event_time);
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
                    url: `/update-event`,
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



            $('#event_department_id').on('change', function() {
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
                                $('#events_employee_id').empty();
                                $('#events_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="events_employee_id[]"]').append(
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

            $('#edit_event_department_id').on('change', function() {
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
                                $('#edit_event_employee_id').empty();
                                $('#edit_event_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="events_employee_id[]"]').append(
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



            ///MULTIPLE EMPLOYEE SELECT OPTION CODE STARTS FROM HERE
            $("#events_employee_id").select2({
                placeholder: "Select a Name",
                allowClear: true,
                tags: true
            });
            $("#edit_event_employee_id").select2({
                placeholder: "Select a Name",
                allowClear: true,
                tags: true
            });
            ///MULTIPLE EMPLOYEE SELECT OPTION CODE ENDS HERE





        });
    </script>
@endsection
