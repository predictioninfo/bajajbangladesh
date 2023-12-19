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

        @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        <div class="content-box">

            <div class="card mb-4">

                <div class="card mb-0">
                    <div class="card-header with-border">
                        <h1 class="card-title text-center"> {{ __('Payments History') }} </h1>
                        <nav aria-label="breadcrumb">

                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                <li><a href="#">List - Payments History </a></li>
                            </ol>

                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('department-and-month-wise-payment-histories')}}">
                                @csrf
                                <div class="row align-items-end">

                                    <div class="col-md-4 form-group">
                                        <label>{{__('Department')}} *</label>
                                        <select name="payment_history_department_id" class="form-control" required>
                                            <option>Choose a Department</option>
                                            <option value="0">All Department</option>
                                            @foreach($departments as $departments_value)
                                            <option value="{{$departments_value->id}}">
                                                {{$departments_value->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="start_date">{{__('Month')}}</label>
                                            <input class="form-control" name="payment_history_month_year" type="month"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                                    {{__('Search')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form method="post" action="{{route('month-wise-salary-sheet-generates')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="start_date">{{__('Month')}}</label>
                                    <input class="form-control" type="month" name="month_year" required>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group pt-4 mt-1">
                                    <input type="submit" name="download_pdf" class="btn btn-grad"
                                        value="{{__('Download PDF')}}" />
                                    <input type="submit" name="download_excel" class="btn btn-grad"
                                        value="{{__('Download Excel')}}" />
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- <form method="post" action="{{route('month-wise-salary-sheet-generate-exceles')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="start_date">{{__('Month')}}</label>
                                    <input class="form-control" type="month" name="month_year" required>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:30px;">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-grad" formtarget="_blank"><i
                                            class="fa fa-search"></i>
                                        {{__('Download Excel')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>

        </div>

        {{--<div class="float-right">

            <form method="post" action="{{route('make-payments')}}" class="form-horizontal btn"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="monthly_attendance_row_id" value="">

                <input type="submit" name="action_button" class="btn btn-dark" value="{{__('Download PDF')}}" />
            </form>

        </div>--}}



    </div>


    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Payslip Number</th>
                        <th>Company</th>
                        <th>Employee</th>
                        <th>Joining Date</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Salary Type</th>
                        <th>Gross Salary</th>
                        <th>Basic Salary</th>
                        <th>Total Working Hour</th>
                        <th>Per Hour Rate</th>
                        <th>House Rent</th>
                        <th>Medical</th>
                        <th>Conveyance</th>
                        <th>Festival Bonus</th>
                        <th>Net Overtime</th>
                        <th>Commission</th>
                        <th>Other Payment</th>
                        <th>Tax Per Month</th>
                        <th>Loan</th>
                        <th>PF Contribution</th>
                        <th>Statutory Deduction</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Working Days</th>
                        <th>Net Salary</th>

                        {{--
                        <th>OT Rate(2 Times)</th>
                        <th>OT Hour</th>
                        <th>Total OT</th>
                        <th>Night Shift Allowance</th>
                        <th>Night Shift Days</th>
                        <th>Total Night Shift Pay</th>
                        --}}
                        <th>Payroll Charge</th>
                        <th>Insurance</th>
                        <th>Tax</th>
                        <th>CTC(Cost To Company)</th>
                        <th>Exchange Risk</th>
                        <th>Total Payable</th>
                        <th>Bank Account</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($payment_histories as $payment_histories_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$payment_histories_value->pay_slip_number}}</td>
                        <td>{{$payment_histories_value->company_name}}</td>
                        <td>{{$payment_histories_value->first_name." ".$payment_histories_value->last_name}}</td>
                        <td>{{$payment_histories_value->joining_date}}</td>
                        <td>{{$payment_histories_value->department_name}}</td>
                        <td>{{$payment_histories_value->designation_name}}</td>
                        <td>{{$payment_histories_value->pay_slip_payment_type}}</td>
                        <td>{{$payment_histories_value->pay_slip_gross_salary}}</td>
                        <td>{{$payment_histories_value->pay_slip_basic_salary}}</td>
                        <td>{{$payment_histories_value->pay_slip_total_working_hour}}</td>
                        <td>{{number_format((float)$payment_histories_value->pay_slip_per_hour_rate),2, '.', ''}}</td>
                        <td>{{$payment_histories_value->pay_slip_house_rent}}</td>
                        <td>{{$payment_histories_value->pay_slip_medical_allowance}}</td>
                        <td>{{$payment_histories_value->pay_slip_conveyance_allowance}}</td>
                        <td>{{$payment_histories_value->pay_slip_festival_bonus}}</td>
                        <td>{{$payment_histories_value->pay_slip_overtimes}}</td>
                        <td>{{$payment_histories_value->pay_slip_commissions}}</td>
                        <td>{{$payment_histories_value->pay_slip_other_payments}}</td>
                        <td>{{$payment_histories_value->pay_slip_tax_deduction}}</td>
                        <td>{{$payment_histories_value->pay_slip_loans}}</td>
                        <td>{{$payment_histories_value->pay_slip_provident_fund}}</td>
                        <td>{{$payment_histories_value->pay_slip_statutory_deduction}}</td>
                        {{--
                        <!--<td>{{$payment_histories_value->pay_slip_month_year}}</td>-->
                        <!--<td>{{$payment_histories_value->pay_slip_month_year}}</td>--> --}}

                        <td>{{date("F", strtotime($payment_histories_value->pay_slip_month_year))}}</td>
                        <td>{{date('Y', strtotime($payment_histories_value->pay_slip_month_year))}}</td>

                        <td>{{$payment_histories_value->pay_slip_working_days}}</td>
                        <td>{{$payment_histories_value->pay_slip_net_salary}}</td>
                        <td>{{$payroll_charge = ($payment_histories_value->pay_slip_net_salary*15)/100}}</td>
                        <td>{{$insurance = 0}}</td>
                        <td>{{$tax_on_payrol_charge = ((($payroll_charge*10)/100) +
                            $payment_histories_value->pay_slip_net_salary + $payroll_charge + $insurance)*1.5/100}}</td>
                        <td>@php($total_ctc = $payment_histories_value->pay_slip_net_salary + $payroll_charge +
                            $insurance +
                            $tax_on_payrol_charge){{number_format((float)$total_ctc, 2, '.', '')}}</td>
                        <td>{{$exchange_risk = 365.42}}</td>
                        <td>@php($total_payable = $total_ctc + $exchange_risk){{number_format((float)$total_payable, 2,
                            '.',
                            '')}}</td>
                        <td>{{$payment_histories_value->bankAccount->bank_account_number ?? null}}</td>
                        <td>
                            <form action="{{ route('paymentDelete') }}" method="post" enctype="multipart/form-data">
                                {{method_field('post')}}
                                @csrf
                                <input type="hidden" name="monthly_attendance_row_id"
                                    value="{{$payment_histories_value->monthly_attendance_id}}">
                                <input type="hidden" name="monthly_attendanc_payment_status" value=" 0 ">
                                <input type="hidden" name="id" value="{{$payment_histories_value->id}}"
                                    class="form-check-input">
                                <button type="submit" class="btn btn-block">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

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
                      extend: 'csv',
                      text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'pdf',
                      text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
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

  } );


</script>



@endsection
