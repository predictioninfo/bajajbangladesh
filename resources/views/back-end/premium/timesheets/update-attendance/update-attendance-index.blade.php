@extends('back-end.premium.layout.premium-main')

@section('content')
<section class="main-contant-section">
        <div class=" mb-3"> </div>

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

        <div class="attendance-search">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title text-center "> {{ __('Update Attendance') }} </h3>
                </div>
            </div>
        </div>

        <div class="content-box">
            <form method="post" action="{{ route('update-date-wise-employee-attendance-searches') }}"
                class="container-fluid table-common-search">
                @csrf
                <div class="row">

                    <div class="col-md-4 form-group">

                        <label>{{ __('Employee') }} *</label>
                        <select name="employee_id" class="form-control selectpicker" data-live-search="true"
                            data-live-search-style="begins" title='Employee' required>
                            {{-- <option>Choose a Employee</option> --}}
                            @foreach ($employees as $employees_value)
                                <option value="{{ $employees_value->id }}"
                                    data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $employees_value->profile_photo }}'>">
                                    {{ $employees_value->first_name }}
                                    {{ $employees_value->last_name }}({{ $employees_value->company_assigned_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">{{ __('Date') }}</label>
                            <input class="form-control" name="update_date" type="date" required value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

            <div class="content-box">
                <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Total Work</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($attendances as $attendancesValue)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $attendancesValue->attendance_date }}</td>
                                    <td>{{ $attendancesValue->clock_in }}</td>
                                    <td>{{ $attendancesValue->clock_out }}</td>
                                    <td>{{ $attendancesValue->total_work }}</td>
                                   
                                    <td>
                                            <a href="#" id="edit-post"  data-toggle="modal" data-target="#employeeAttendanceEditModal{{ $attendancesValue->id }}" class="btn edit" data-id="" data-toggle="tooltip" title=" Edit "
                                                data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                            <a href="{{ route('delete-attendances', ['id' => $attendancesValue->id]) }}"    data-id="{{ $attendancesValue->id }}" class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                        </td>
                                </tr>


                                <div id="employeeAttendanceEditModal{{ $attendancesValue->id }}" class="modal fade"
                                    role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}</h5>
                                                <button type="button" data-dismiss="modal" id="close"
                                                    aria-label="Close" class="close"><i
                                                        class="dripicons-cross"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <span id="form_result_edit"></span>
                                                <span id="store_profile_photo"></span>
                                                <form method="post"
                                                    action="{{ route('update-date-wise-employee-attendances') }}"
                                                    class="form-horizontal" enctype="multipart/form-data">

                                                    @csrf
                                                    <div class="row">

                                                        <input type="hidden" name="id"
                                                            value="{{ $attendancesValue->id }}">
                                                        <input type="hidden" name="employee_id"
                                                            value="{{ $attendancesValue->employee_id }}">
                                                        <input type="hidden" name="attendance_date"
                                                            value="{{ $attendancesValue->attendance_date }}">


                                                        <div class="col-md-12">
                                                            <div class="input-group mb-3">
                                                                <label>{{ __('In Time') }} *</label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-clock-o" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="time" name="clock_in"
                                                                    value="{{ $attendancesValue->clock_in }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="input-group mb-3">
                                                                <label>{{ __('Out Time') }} *</label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-clock-o" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="time" name="clock_out"
                                                                    value="{{ $attendancesValue->clock_out }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 mt-4">

                                                            <input type="submit" name="action_button"
                                                                class="btn btn-grad" value="{{ __('Edit') }}" />

                                                        </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




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



            //      //value retriving and opening the edit modal starts

            //      $('.edit').on('click', function () {
            //         var id = $(this).data('id');

            //         $.ajax({
            //             type:"POST",
            //             url: 'leave-type-by-id',
            //             data: { id: id },
            //             dataType: 'json',
            //             success: function(res){
            //             $('#ajaxModelTitle').html("Edit Leave Type");
            //             $('#edit-modal').modal('show');
            //             $('#id').val(res.id);
            //             $('#leave_type').val(res.leave_type);
            //             $('#allocated_day').val(res.allocated_day);
            //         }
            //         });
            //     });

            //    //value retriving and opening the edit modal ends

            //      // edit form submission starts

            //   $('#edit_form').submit(function(e) {
            //         e.preventDefault();
            //         let formData = new FormData(this);
            //         $('#error-message').text('');

            //         $.ajax({
            //             type:'POST',
            //             url: `/update-leave-type`,
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             success: (response) => {
            //                 window.location.reload();
            //                 if (response) {
            //                 this.reset();
            //                 alert('Data has been updated successfully');
            //                 }
            //             },
            //             error: function(response){
            //                 console.log(response);
            //                     $('#error-message').text(response.responseJSON.errors.file);
            //             }
            //         });
            //     });

            //     // edit form submission ends






        });
    </script>
@endsection
