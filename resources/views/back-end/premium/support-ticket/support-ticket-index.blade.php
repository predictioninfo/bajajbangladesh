@extends('back-end.premium.layout.premium-main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <section class="main-contant-section">


        <div class="mb-3">

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
                    <h1 class="card-title text-center"> {{ __('Support Ticket List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - {{ 'Support List' }} </a></li>
                    </ol>
                </div>
            </div>


            {{-- <div class="d-flex flex-row mt-3">
               
                @if ($delete_permission == 'Yes')
                    <div class="p-1">
                        <form method="post" action="{{ route('bulk-delete-support-tickets') }}" id="sample_form"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                                class="form-check-input">
                            <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
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
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Ticket') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-support-tickets') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="support_ticket_department_id"
                                        id="support_ticket_department_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="support_ticket_employee_id"
                                        id="support_ticket_employee_id"></select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Priority</label>
                                    <select class="form-control" name="support_ticket_priority" required>
                                        <option value="">Select-a-Priority</option>
                                        <option value="Critical">Critical</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Subject</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-text-height"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="support_ticket_subject" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Ticket Note</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-sticky-note-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="support_ticket_note" class="form-control" required>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Ticket Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="support_ticket_date" class="form-control date" required>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Ticket Attachments</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-ticket"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="file" name="support_ticket_attachment" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="my-textarea">Description</label>
                                    <textarea class="form-control" name="support_ticket_desc" id="support_ticket_desc" rows="3"></textarea>
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
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Priority') }}</th>
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('Ticket Note') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Ticket Attachments') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Status') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($support_tickets as $support_tickets_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $support_tickets_value->first_name . ' ' . $support_tickets_value->last_name }}</td>
                                <td>{{ $support_tickets_value->department_name }}</td>
                                <td>{{ $support_tickets_value->support_ticket_priority }}</td>
                                <td>{{ $support_tickets_value->support_ticket_subject }}</td>
                                <td>{{ $support_tickets_value->support_ticket_note }}</td>
                                <td>{{ $support_tickets_value->support_ticket_date }}</td>
                                <td><a href="{{ asset($support_tickets_value->support_ticket_attachment) }}"
                                        download>Download</a></td>
                                <td>{!! $support_tickets_value->support_ticket_desc !!}</td>
                                <td>
                                    @if ($support_tickets_value->support_ticket_status == 'Opened')
                                        <span class="rounded" style="background-color:#3495ce;">Opened<span>
                                            @elseif($support_tickets_value->support_ticket_status == 'Pending')
                                                <span class="rounded" style="background-color:#34cea7;">Pending<span>
                                                    @else
                                                        <span class="rounded"
                                                            style="background-color:#dc3545; color:white;">Closed<span>
                                    @endif
                                </td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>

                                       
                                                @if ($support_tickets_value->support_ticket_status != 'Closed')
                                                    <a href="javascript:void(0)" class="btn edit"
                                                        data-id="{{ $support_tickets_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                @endif
                                              
                                                @if ($support_tickets_value->support_ticket_status != 'Closed')
                                                    <a href="{{ route('delete-support-tickets', ['id' => $support_tickets_value->id]) }}"
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
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="edit_support_ticket_department_id"
                                    id="edit_support_ticket_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}">
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="edit_support_ticket_employee_id"
                                    id="edit_support_ticket_employee_id">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Priority</label>
                                <select class="form-control" name="support_ticket_priority" id="support_ticket_priority"
                                    required>
                                    <option value="">Select-a-Priority</option>
                                    <option value="Critical">Critical</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>

                                </select>
                            </div>


                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Subject</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="support_ticket_subject" id="support_ticket_subject"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Ticket Note</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-sticky-note-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="support_ticket_note" id="support_ticket_note"
                                        class="form-control" required>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Ticket Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="support_ticket_date" id="support_ticket_date"
                                        class="form-control date" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Ticket Attachments</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-ticket" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="file" name="support_ticket_attachment" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="support_ticket_desc" id="edit_support_ticket_desc" rows="5"></textarea>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Ticket Status</label>
                                <select class="form-control" name="support_ticket_status" id="support_ticket_status"
                                    required>
                                    <option value="">Select-a-Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Opened">Opened</option>
                                    <option value="Closed">Closed</option>

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
                    url: 'support-ticket-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_support_ticket_department_id').val(res
                            .support_ticket_department_id);
                        $('#edit_support_ticket_employee_id').val(res
                            .support_ticket_employee_id);
                        $('#support_ticket_priority').val(res.support_ticket_priority);
                        $('#support_ticket_subject').val(res.support_ticket_subject);
                        $('#support_ticket_note').val(res.support_ticket_note);
                        $('#support_ticket_date').val(res.support_ticket_date);
                        $('#edit_support_ticket_desc').val(res.support_ticket_desc);
                        $('#support_ticket_status').val(res.support_ticket_status);
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
                    url: `/update-support-ticket`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        toastr.success(response.success, 'Data successfully updated!!');
                        setTimeout(function() {
                            window.location.href = '/support-tickets';
                        }, 2000)
                    },
                    error: function(response) {
                        toastr.error(response.error, 'Please Entry Valid Data!!');

                        // console.log(response);
                        //     $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends



            $('#support_ticket_department_id').on('change', function() {
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
                                $('#support_ticket_employee_id').empty();
                                $('#support_ticket_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="support_ticket_employee_id"]')
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

            $('#edit_support_ticket_department_id').on('change', function() {
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
                                $('#edit_support_ticket_employee_id').empty();
                                $('#edit_support_ticket_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_support_ticket_employee_id"]')
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
                startDate: date
            });


            CKEDITOR.replace('support_ticket_desc');
            CKEDITOR.replace('edit_support_ticket_desc');



        });
    </script>
@endsection
