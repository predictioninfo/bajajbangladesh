@extends('back-end.premium.layout.premium-main')

@section('content')

<section class="main-contant-section">

    <div class="mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
       <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Attendance Report') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                    <li><a href="#">List - {{ 'Attendance Report' }} </a></li>
                </ol>
            </div>
        </div>


        <div class="content-box">
        <form method="post" action="{{route('date-wise-attendance-reports')}}" class="container-fluid attendance-report-search">
                                    @csrf

                                    <div class="row align-items-end">
                                        {{--
                                        <div class="col-md-4 form-group">

                                            <label>{{__('Employee')}} *</label>
                                            <select name="employee_id" class="form-control selectpicker "
                                                data-live-search="true" data-live-search-style="begins"
                                                title='Employee'>
                                                @foreach($employees as $employees_value)
                                                <option value="{{$employees_value->id}}"
                                                    data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{$employees_value->profile_photo}}'>">
                                                    {{$employees_value->first_name.'
                                                    '.$employees_value->last_name}}({{$employees_value->company_assigned_id}})
                                                </option>
                                                @endforeach

                                            </select>

                                        </div> --}}


                                        {{-- <div class="col-md-4 form-group">
                                            <label>{{__('Designation')}}</label>

                                            <select class="form-control" name="designation_id"
                                                id="designation_id"></select>

                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>{{__('Employee')}} *</label>
                                            <select class="form-control" name="employee_id" id="employee_id"></select>


                                        </div>
                                        --}}

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="start_date">{{__('Start Date')}}</label>
                                                <input class="form-control" name="start_date" type="date" required
                                                    value="">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="start_date">{{__('End Date')}}</label>
                                                <input class="form-control" name="end_date" type="date" required
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-grad "><i
                                                            class="fa fa-search"></i> {{__('Search')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
            <div class="table-responsive mt-4">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Clock In</th>
                            {{-- <th>IN LC</th> --}}
                            <th>Clock Out</th>
                            {{-- <th>OUT LC</th> --}}
                            <th>Late</th>
                            <th>Early Leaving</th>
                            <th>Overtime</th>
                            <th>Total Work</th>
                            <th>Total Rest</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($attendances as $attendancesValue)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{ $attendancesValue->first_name.' '.$attendancesValue->last_name}}</td>
                            <td>{{ $attendancesValue->company_assigned_id}}</td>
                            <td>{{ $attendancesValue->attendance_date}}</td>
                            <td>@if($attendancesValue->check_in_out === 1){{__('Present')}}@else{{__('Absent')}}@endif
                            </td>
                            <td>{{ $attendancesValue->clock_in }}</td>
                            <td>{{ $attendancesValue->clock_out }}</td>
                            <td>{{$attendancesValue->time_late}}</td>
                            <td>{{$attendancesValue->early_leaving}}</td>
                            <td>----</td>
                            <td>
                                <?php echo date_create($attendancesValue->clock_in)->diff(date_create($attendancesValue->clock_out))->format('%H:%i:%s'); ?>
                            </td>
                            <td>----</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>


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

                    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                    "iDisplayLength": 100,

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
                                    $('#designation_id').append('<option hidden>Choose a Designation</option>');
                                    $.each(data, function(key, designations){
                                        $('select[name="designation_id"]').append('<option value="'+ key +'">' + designations.designation_name+ '</option>');
                                    });
                                }else{
                                    $('#designation_id').empty();
                                }
                            }
                        });
                    }else{
                        $('#designation_id').empty();
                    }
                });





                $('#designation_id').on('change', function() {
                    var designationID = $(this).val();
                    console.log(designationID);
                    if(designationID) {
                        $.ajax({
                            url: '/get-employee/'+designationID,
                            type: "GET",
                            data : {"_token":"{{ csrf_token() }}"},
                            dataType: "json",
                            success:function(data)
                            {
                                if(data){
                                    $('#employee_id').empty();
                                    $('#employee_id').append('<option hidden>Choose Employee</option>');
                                    $.each(data, function(key, employees){
                                        $('select[name="employee_id"]').append('<option value="'+ key +'">' + employees.first_name+ '</option>');
                                    });
                                }else{
                                    $('#employee_id').empty();
                                }
                            }
                        });
                    }else{
                        $('#employee_id').empty();
                    }
                });







   });


</script>
@endsection
