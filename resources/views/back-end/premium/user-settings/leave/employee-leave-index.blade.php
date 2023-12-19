@extends('back-end.premium.layout.employee-setting-main')

@section('content')

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
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Leave List') }} </h1>
                </div>
            </div>


            <div class="content-box leave-management">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card employ-profile">
                            <div class="card-img">
                                <img src="data:image/jpeg;base64,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"
                                    alt="">
                            </div>
                            <div class="card-body">
                                <article class="text-left">
                                    <p>
                                        @foreach ($Sick_leaves as $leave)
                                            {{ __('Sick leave') }} - {{ $leave->allocated_day - $sick_leave_count }}
                                            {{ __('Days') }}
                                        @endforeach
                                    </p>
                                    <p>
                                        @foreach ($Casual_Leaves as $leave)
                                            {{ __('Casual Leave') }} - {{ $leave->allocated_day - $casual_leave_count }}
                                            {{ __('Days') }}
                                        @endforeach
                                    </p>
                                    <p>
                                        @if (round((strtotime(date('Y-m-d')) - strtotime($users[0]->joining_date)) / (60 * 60 * 24)) >= 365)
                                            @foreach ($Annual_Leaves as $leave)
                                                {{ __('Remaining Annual Leave') }} -
                                                {{ $leave->allocated_day - $annual_leave_count }} {{ __('Days') }}
                                            @endforeach
                                        @endif
                                    </p>
                                    <p> {{ $current_year }} Remaning Leave </p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Date') }}</th>
                                <th>{{ __('Total Days') }}</th>
                                <th>{{ __('Document') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($leaves as $leaves_value)
                                <tr>

                                    <td>{{ $i++ }}</td>
                                    <td>{{ $leaves_value->first_name }} {{ $leaves_value->last_name }}</td>
                                    <td>{{ $leaves_value->leave_type }}</td>
                                    <td>{{ $leaves_value->department_name }}</td>
                                    <td>{{ $leaves_value->designation_name }}</td>
                                    <td>{{ $leaves_value->leaves_start_date }}</td>
                                    <td>{{ $leaves_value->leaves_end_date }}</td>
                                    <td>{{ $leaves_value->total_days }}</td>
                                    @if ($leaves_value->leave_document)
                                        <td><a href="{{ asset($leaves_value->leave_document) }}" download>Download</a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $leaves_value->leaves_status }}</td>
                                    <td>
                                        <a href="#" class="btn view" data-toggle="modal"
                                            data-target="#viewModal{{ $leaves_value->id }}"> <i class="fa fa-eye"
                                                aria-hidden="true"></i> </a>
                                        @if (Auth::user()->company_profile == 'Yes')
                                            <a href="{{ route('delete-leaves', ['id' => $leaves_value->id]) }}"
                                                class="btn btn-danger delete-post"> <i class="fa fa-trash-o"
                                                    aria-hidden="true"></i> </a>
                                        @endif
                                    </td>
                                </tr>


                                <!-- Bootstrap View Modal Starts-->

                                <div id="viewModal{{ $leaves_value->id }}" class="modal fade employ-leave-view"
                                    role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">Leave Request Details</h5>
                                                <button type="button" data-dismiss="modal" id="close"
                                                    aria-label="Close" class="close"><i
                                                        class="dripicons-cross"></i></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="employe-info">
                                                    <dl>
                                                        <dd>
                                                            <b>Employee Name : </b>
                                                        </dd>
                                                        <dd>
                                                            {{ $leaves_value->first_name }}
                                                            {{ $leaves_value->last_name }}
                                                        </dd>
                                                    </dl>
                                                    <dl>
                                                        <dd>
                                                            <b>Department : </b>
                                                        </dd>
                                                        <dd>
                                                            {{ $leaves_value->department_name }}
                                                        </dd>
                                                    </dl>

                                                    <dl>
                                                        <dd>
                                                            <b>Designation : </b>
                                                        </dd>
                                                        <dd>
                                                            {{ $leaves_value->designation_name }}
                                                        </dd>
                                                    </dl>


                                                    <dl>
                                                        <dd>
                                                            <b> Leave Date Starts : </b>
                                                        </dd>
                                                        <dd>
                                                            {{ $leaves_value->leaves_start_date }}
                                                        </dd>
                                                    </dl>
                                                    <dl>
                                                        <dd>
                                                            <b> Leave Date Ends : </b>
                                                        </dd>
                                                        <dd>
                                                            {{ $leaves_value->leaves_end_date }}
                                                        </dd>
                                                    </dl>
                                                    <dl>
                                                        <dd>
                                                            <b> Total Days : </b>
                                                        </dd>
                                                        <dd>
                                                            {{ $leaves_value->total_days }}
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Leave Reason : </label>
                                                <textarea class="form-control" readonly rows="5">{!! $leaves_value->leave_reason !!}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Leave Status : {{ $leaves_value->leaves_status }}</label>
                                            </div>
                                            <br>



                                        </div>

                                    </div>

                                </div>


                </div>
            </div>
        </div>
        <!-- Bootstrap View Modal Ends-->
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





            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
                startDate: date
            });


        });
    </script>
@endsection
