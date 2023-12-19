@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
use App\Models\Role;

?>
<section class="main-contant-section">

    <div class=" mb-3">

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

        @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
        <div class="attendance-search">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title text-center"> {{__('Salary Disburse')}} </h3>
                </div>
            </div>
        </div>
        @endif
        <div class="content-box">
            <form method="post" action="{{route('search-salary-disburses')}}" class="container-fluid">
                @csrf

                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>{{__('Bank Name')}} *</label>
                        <select name="bank_id" class="form-control" required>
                            <option value=""> Choose a bank name</option>
                            @foreach($bank_accounts as $bank_account)
                            <option value="{{ $bank_account->id }}"> {{ $bank_account->company_bank_account_name ??
                                null}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{__('Bank Type')}} *</label>
                        <select name="bank_type" class="form-control" required>
                            <option value=""> Choose a bank type</option>
                            <option value="Core Bank"> Core Banking</option>
                            <option value="Mobile Bank"> Mobile Banking</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{__('Department')}} <span style="font-size:10px;">(Not Mandatory)</span></label>
                        <select name="department_id" class="form-control">
                            <option value="">Choose an Option</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name ?? null }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="start_date">{{__('Month')}} <span style="font-size:10px;"></span></label>
                            <input class="form-control" name="month" type="month" value="">
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="form-group pt-4 mt-1">
                            <input type="submit" name="search" class="btn btn-grad" value="{{__('Search')}}" />
                            <input type="submit" name="exeldownload" class="btn btn-grad"
                                value="{{__('Bank Advise')}}" />
                            <input type="submit" name="disburse_reqest" class="btn btn-grad"
                                value="{{__('Disburse Report Request ')}}" />
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Bank Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($payment_histories as $payment_historiy)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $payment_historiy->first_name.' '.$payment_historiy->last_name}}</td>
                            <td>{{ $payment_historiy->company_assigned_id }}</td>
                            <td>{{ number_format((float)$payment_historiy->pay_slip_net_salary , 0, '.', '')}} </td>
                            <td>{{ $payment_historiy->pay_slip_payment_date ?? null }} </td>
                            <td>{{ $payment_historiy->bank_account_number ?? null}}</td>
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
                    "iDisplayLength": 25,

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