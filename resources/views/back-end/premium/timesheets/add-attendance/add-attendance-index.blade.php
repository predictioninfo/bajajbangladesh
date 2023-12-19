
@extends('back-end.premium.layout.premium-main')

@section('content')

    <section>

        <div class="container-fluid mb-3"> </div>

            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
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


            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header with-border" style="background:#458191; color:white;">
                        <h3 class="card-title text-center"> {{__('Add Attendance')}} </h3>
                    </div>
                    <div class="card-body" style="background:#458191; color:white;">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{route('add-date-wise-employee-attendances')}}" class="form-horizontal" enctype="multipart/form-data">

                                @csrf
                                    <div class="row">
                                        <input type="hidden" name="employee_id" value="{{$employee_id}}">
                                        <input type="hidden" name="attendance_date" value="{{$add_date}}">

                                        <div class="col-md-6 form-group">
                                            <label>{{__('In Time')}} *</label>
                                            <input type="time" name="clock_in"  value="" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>{{__('Out Time')}} *</label>
                                            <input type="time" name="clock_out"  value="" class="form-control">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead style="background-color:#458191; color:white;">
                        <tr>
                        <th>SL</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Total Work</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--
                        @php($i=1)
                        @foreach($attendances as $attendancesValue)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{ $attendancesValue->first_name }} {{ $attendancesValue->last_name }}</td>
                            <td>{{$attendancesValue->attendance_date}}</td>
                            <td>{{ $attendancesValue->clock_in }}</td>
                            <td>{{ $attendancesValue->clock_out }}</td>
                            <td><?php echo date_create($attendancesValue->clock_in)->diff(date_create($attendancesValue->clock_out))->format('%H:%i:%s'); ?></td>
                            <td>
                                <a href="#" id="edit-post" data-toggle="modal" data-target="#employeeAttendanceEditModal{{$attendancesValue->id}}"><button class="btn btn-info" style="width:20px;"><i class="fa fa-edit" style="margin-left:-6px;"></i></button></a>
                                ||
                                <a href="{{route('delete-user',['id'=>$attendancesValue->id])}}" data-id="{{$attendancesValue->id}}"><button class="btn btn-danger"  style="width:20px;"><i class="fa fa-trash" style="margin-left:-6px;"></i></button></a>
                            </td>
                        </tr>


                        <div id="employeeAttendanceEditModal{{$attendancesValue->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{_('Edit')}}</h5>
                                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                            </div>

                            <div class="modal-body">
                                <span id="form_result_edit"></span>
                                <span id="store_profile_photo"></span>
                                <form method="post" action="{{route('update-date-wise-employee-attendances')}}" class="form-horizontal" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">

                                    <input type="hidden" name="id" value="{{$attendancesValue->id}}">
                                    <input type="hidden" name="employee_id" value="{{$attendancesValue->employee_id}}">
                                    <input type="hidden" name="attendance_date" value="{{$attendancesValue->attendance_date}}">

                                        <div class="col-md-6 form-group">
                                            <label>{{__('In Time')}} *</label>
                                            <input type="time" name="clock_in"  value="{{$attendancesValue->clock_in}}" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>{{__('Out Time')}} *</label>
                                            <input type="time" name="clock_out"  value="{{$attendancesValue->clock_out}}" class="form-control">
                                        </div>

                                        <div class="col-sm-9">

                                            <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Edit')}}"/>

                                        </div>
                                </form>
                                        </div>

                            </div>

                        </div>
                    </div>

                        @endforeach
                        --}}
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



   });


    </script>
@endsection
