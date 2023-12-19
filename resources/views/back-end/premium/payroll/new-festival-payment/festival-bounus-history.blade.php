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
                        <h1 class="card-title text-center"> {{ __('Festival Payments History') }} </h1>
                        <nav aria-label="breadcrumb">

                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                <li><a href="#">List -Festival Payments History </a></li>
                            </ol>

                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                action="{{route('department-and-month-wise-payment-festival-histories')}}">
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

                    <form method="post" action="{{route('month-wise-festival-salary-sheet-generates')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="start_date">{{__('Month')}}</label>
                                    <input class="form-control" type="month" name="festival_month_year" required>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:30px;">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-grad" formtarget="_blank"><i
                                            class="fa fa-search"></i>
                                        {{__('Download PDF')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Employee Name</th>
                        <th>Employee ID</th>
                        <th>Department Name</th>
                        <th>Bank Account</th>
                        <th>Payment Date</th>
                        <th>Bounus Month</th>
                        <th>Bounus Tilte</th>
                        <th>Bounus Type</th>
                        <th>Bounus Percentage</th>
                        <th>Bounus Amount</th>
                        <th>Tax</th>
                        <th>Net Bounus Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                    @foreach($festival_payments as $festival_payment)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $festival_payment->festivalPaymentUser->first_name }} {{
                            $festival_payment->festivalPaymentUser->last_name }}</td>
                        <td>{{ $festival_payment->festivalPaymentUser->company_assigned_id }}</td>
                        <td>{{ $festival_payment->festivalPaymentDepartment->department_name ?? null }}</td>
                        <td>{{ $festival_payment->festivalPaymentBankAccount->bank_account_number ?? null }}</td>
                        <td>{{ $festival_payment->festival_payment_date }}</td>
                        <td>{{ date('F',strtotime($festival_payment->festival_payment_date))}}</td>
                        <td>{{ $festival_payment->festivalPaymentBonus->festival_bonus_title ?? null}}</td>
                        <td>{{ $festival_payment->festivalPaymentBonusConfig->festival_config_salary_type }}</td>
                        <td>{{ $festival_payment->festival_payment_percentage }}%</td>
                        <td>{{ $festival_payment->festival_payment_amount }}</td>
                        <td>{{ $festival_payment->festival_payment_tax_deduction }}</td>
                        <td>{{ $festival_payment->festival_payment_net_bonus }}</td>
                        <td>
                            <form action="{{ route('paymentFestivalDelete') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$festival_payment->id}}">
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="btn">Remove</button>
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