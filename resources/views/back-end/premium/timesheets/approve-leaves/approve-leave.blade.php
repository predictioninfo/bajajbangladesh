@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
use App\models\Leave;
use App\models\User;
use App\models\LeaveType;

?>
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
                    <h1 class="card-title text-center"> {{ __('Approve Leave list') }} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="#">List - Leave </a></li>
                        </ol>

                    </nav>
                </div>
            </div>
            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Name') }}</th>
                                <th>{{ __('Total Days') }}</th>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Document') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($leaves as $leaves_value)
                                @if ($leaves_value->leaves_status != 'Approved')
                                    <tr>

                                        <td>{{ $i++ }}</td>
                                        <td>{{ $leaves_value->first_name . ' ' . $leaves_value->last_name }}</td>
                                        <td>{{ $leaves_value->department_name }}</td>
                                        <td>{{ $leaves_value->designation_name }}</td>
                                        <td>{{ $leaves_value->leaves_start_date }}</td>
                                        <td>{{ $leaves_value->leaves_end_date }}</td>
                                        <td>{{ $leaves_value->total_days }}</td>
                                        <td>{{ $leaves_value->leave_type }}</td>
                                        @if ($leaves_value->leave_document)
                                            <td><a href="{{ asset($leaves_value->leave_document) }}" download>Download</a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $leaves_value->leaves_status }}</td>

                                        <td>

                                            <a href="#" class="btn view" data-toggle="modal"
                                                data-target="#viewModal{{ $leaves_value->id }}" data-toggle="tooltip"
                                                title=" View " data-original-title="View"> <i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>

                                            <a href="#" data-toggle="modal"
                                                data-target="#editAndApproveModal{{ $leaves_value->id }}" class="btn edit"
                                                data-id="" title=" Edit & Approve" data-original-title="Edit"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                            <a href="{{ route('approve-leave-requests', ['id' => $leaves_value->id, 'leave_approver_id' => Auth::user()->id]) }}"
                                                class="btn editTravel view" data-toggle="tooltip" title=" Approve "
                                                data-original-title="Approve"><i class="fa fa-check"
                                                    aria-hidden="true"></i></a>

                                            <a href="{{ route('delete-leaves', ['id' => $leaves_value->id]) }}"
                                                class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                data-original-title="Delete"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></a>


                                            </ul>
                </div>

                </td>
                </tr>
                <?php

                $current_year = date('Y');
                $startDate = date('Y-m-d');
                //$endDate = date('Y-m-d',strtotime('+365 days'));
                $endDate = date('Y') . '-' . '12' . '-' . '31';

                $previous_start_date = date('Y-m-d', strtotime('-7 days'));
                $upto_end_date = date('Y-m-d', strtotime('+1 days'));
                $sick_leave_count = Leave
                    // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
                    // ->select('leave_types.leave_type')
                    ::where('leaves_leave_type_id', '=', '4')
                    ->where('leaves_company_id', Auth::user()->com_id)
                    ->where('leaves_employee_id', $leaves_value->leaves_employee_id)
                    ->whereYear('created_at', '=', $current_year)
                    ->where('leaves_status', 'Approved')
                    ->sum('total_days');
                $casual_leave_count = Leave
                    // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
                    // ->select('leave_types.leave_type')
                    ::where('leaves_leave_type_id', '=', '5')
                    ->where('leaves_company_id', Auth::user()->com_id)
                    ->where('leaves_employee_id', $leaves_value->leaves_employee_id)
                    ->whereYear('created_at', '=', $current_year)
                    ->where('leaves_status', 'Approved')
                    ->sum('total_days');
                $annual_leave_count = Leave
                    // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
                    // ->select('leave_types.leave_type')
                    ::where('leaves_leave_type_id', '=', '7')
                    ->where('leaves_company_id', Auth::user()->com_id)
                    ->where('leaves_employee_id', $leaves_value->leaves_employee_id)
                    ->whereYear('created_at', '=', $current_year)
                    ->where('leaves_status', 'Approved')
                    ->sum('total_days');
                ?>



                <!-- Bootstrap View Modal Starts-->

                <div id="viewModal{{ $leaves_value->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">Leave Request Details</h5>
                                <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                    class="close"><i class="dripicons-cross"></i></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <div class="">
                                                <div class="leave-title">
                                                    <h4>  {{ $leaves_value->leave_type }} {{ __('Application') }} </h4>
                                                </div>
                                                <div class="leave-count">

                                                    <dl>
                                                        <dd>
                                                               <b> {{ __('Leave Types') }} </b>

                                                        </dd>
                                                        <dd>
                                                           <b>{{ __('Allocated') }}</b>

                                                      </dd>
                                                        <dd>
                                                               <b> {{ __('Approved') }} </b>

                                                        </dd>
                                                        <dd>
                                                              <b> {{ __('Balance') }}</b>

                                                        </dd>
                                                    </dl>

                                                    {{-- <dl>

                                                        <dd>
                                                            {{ __('Sick') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Sick_leaves as $leave)
                                                                {{ $leave->allocated_day }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                        <dd>

                                                                 {{ $sick_leave_count }}
                                                                {{ __('Days') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Sick_leaves as $leave)

                                                                {{ $leave->allocated_day - $sick_leave_count }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                    </dl> --}}


                                                    {{-- <dl>
                                                        <dd>
                                                            {{ __('Casual') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Casual_Leaves as $leave)

                                                                {{ $leave->allocated_day  }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                        <dd>

                                                                {{$casual_leave_count }}
                                                                {{ __('Days') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Casual_Leaves as $leave)

                                                                {{ $leave->allocated_day - $casual_leave_count }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                    </dl> --}}

                                                    @foreach ($leave_types as $leave_type)
                                                    <?php
                                                                    
                                                         $leave_count = Leave::where('leaves_leave_type_id', '=', $leave_type->id)
                                                                        ->where('leaves_company_id', Auth::user()->com_id)
                                                                        ->where('leaves_employee_id', $leaves_value->leaves_employee_id)
                                                                        ->whereYear('created_at', '=', date('Y'))
                                                                        ->where('leaves_status', 'Approved')
                                                                        ->sum('total_days');
                                                    
                                                         $joining_date = User::where('id', $leaves_value->leaves_employee_id)->first('joining_date');
                                                        $days = floor((time() - strtotime($joining_date->joining_date)) / 86400) + 1;
                                                                    
                                                         ?>
                                                    @if ($days >= $leave_type->activation_days)
                                                    <dl>
                                                        <dd>
                                                            {{ $leave_type->leave_type }}
                                                        </dd>
                                                        <dd>
                                                            {{ $leave_type->allocated_day }}
                                                        </dd>
                                                        <dd>
                                                            {{ $leave_count }}
                                                            {{ __('Days') }}
                                                        </dd>
                                                        <dd>
    
                                                            {{ $leave_type->allocated_day - $leave_count }}
                                                            {{ __('Days') }}
    
                                                        </dd>
                                                    </dl>
                                                    @endif
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
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

                                        <textarea class="form-control" readonly>{{ $leaves_value->leave_reason }}</textarea>

                                    </div>
                                    <br>


                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Bootstrap View Modal Ends-->

                <!-- Bootstrap Edit & Approve Modal Starts-->

                <div id="editAndApproveModal{{ $leaves_value->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">Edit & Approve</h5>
                                <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                    class="close"><i class="dripicons-cross"></i></button>
                            </div>

                            <div class="modal-body">
                                <form method="post" action="{{ route('edit-and-approve-leave-requests') }}"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" class="form-control"
                                        value="{{ $leaves_value->id }}" required>
                                    <input type="hidden" name="leave_approver_id" class="form-control"
                                        value="{{ Auth::user()->id }}" required>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                            <div class="">
                                                <div class="leave-title">
                                                    <h4> {{ $leaves_value->leave_type }}  {{ __('Application') }}</h4>
                                                </div>
                                                <div class="leave-count">

                                                    <dl>
                                                        <dd>
                                                               <b> {{ __('Leave Types') }} </b>

                                                        </dd>
                                                        <dd>
                                                           <b>{{ __('Allocated') }}</b>

                                                      </dd>
                                                        <dd>
                                                               <b> {{ __('Approved') }} </b>

                                                        </dd>
                                                        <dd>
                                                              <b> {{ __('Balance') }}</b>

                                                        </dd>
                                                    </dl>


                                                    {{-- <dl>

                                                        <dd>
                                                            {{ __('Sick') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Sick_leaves as $leave)
                                                                {{ $leave->allocated_day }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                        <dd>

                                                                 {{ $sick_leave_count }}
                                                                {{ __('Days') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Sick_leaves as $leave)

                                                                {{ $leave->allocated_day - $sick_leave_count }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                    </dl>


                                                    <dl>
                                                        <dd>
                                                            {{ __('Casual') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Casual_Leaves as $leave)

                                                                {{ $leave->allocated_day  }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                        <dd>

                                                                {{$casual_leave_count }}
                                                                {{ __('Days') }}

                                                        </dd>
                                                        <dd>
                                                            @foreach ($Casual_Leaves as $leave)

                                                                {{ $leave->allocated_day - $casual_leave_count }}
                                                                {{ __('Days') }}
                                                            @endforeach
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
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
                                                    <b> Total Days : </b>
                                                </dd>
                                                <dd>
                                                    {{ $leaves_value->total_days }}
                                                </dd> --}}
                                                @foreach ($leave_types as $leave_type)
                                                <?php
                                                                
                                                     $leave_count = Leave::where('leaves_leave_type_id', '=', $leave_type->id)
                                                                    ->where('leaves_company_id', Auth::user()->com_id)
                                                                    ->where('leaves_employee_id', $leaves_value->leaves_employee_id)
                                                                    ->whereYear('created_at', '=', date('Y'))
                                                                    ->where('leaves_status', 'Approved')
                                                                    ->sum('total_days');
                                                
                                                     $joining_date = User::where('id', $leaves_value->leaves_employee_id)->first('joining_date');
                                                    $days = floor((time() - strtotime($joining_date->joining_date)) / 86400) + 1;
                                                                
                                                     ?>
                                                @if ($days >= $leave_type->activation_days)
                                                <dl>
                                                    <dd>
                                                        {{ $leave_type->leave_type }}
                                                    </dd>
                                                    <dd>
                                                        {{ $leave_type->allocated_day }}
                                                    </dd>
                                                    <dd>
                                                        {{ $leave_count }}
                                                        {{ __('Days') }}
                                                    </dd>
                                                    <dd>

                                                        {{ $leave_type->allocated_day - $leave_count }}
                                                        {{ __('Days') }}

                                                    </dd>
                                                </dl>
                                                @endif
                                                @endforeach
                                                
                                            </dl>
                                        </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Leave Approve/Deny</label>
                                            <select name="leave_status" class="form-control" required="required">
                                                <option value="">Selecting</option>
                                                <option value="Approved">Approve</option>
                                                <option value="Denied">Deny</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Leave Date Starts</label>

                                            <input type="date" name="start_date" class="form-control"
                                                value="{{ $leaves_value->leaves_start_date }}" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Leave Date Ends</label>

                                            <input type="date" name="end_date" class="form-control"
                                                value="{{ $leaves_value->leaves_end_date }}" required>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Leave Reason : </label>

                                            <textarea class="form-control" rows="10" readonly>{{ $leaves_value->leave_reason }}</textarea>

                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <input type="submit" name="action_button" class="btn btn-grad w-50"
                                                value="{{ __('Submit') }}" />
                                        </div>


                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Bootstrap Edit & Approve Modal Ends-->
                @endif
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



        });
    </script>
@endsection
