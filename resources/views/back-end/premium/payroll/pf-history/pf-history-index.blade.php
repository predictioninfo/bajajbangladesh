@extends('back-end.premium.layout.premium-main')
@section('content')

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

        

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Provident Fund History History') }} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="#">List - PF Fund </a></li>
                        </ol>

                    </nav>
                </div>
            </div>

        </div>


<div class="content-box">
<form method="post" action="{{route('month-wise-pf-histories')}}" class="container-fluid">
                                     @csrf
                                    <div class="row align-items-end" >

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="start_date">{{__('Month')}}</label>
                                                <input class="form-control" type="month" name="provident_fund_month_year">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">

                                                    <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i> {{__('Search')}}
                                                    </button>

                                            </div>
                                        </div>

                                    </div>


                                </form>
<div class="table-responsive mt-4">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Company</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Stuff ID</th>
                        <th>Bank Name</th>
                        <th>Bank A/C No</th>
                        <th>Branch Name</th>
                        <th>Branch Code</th>
                        <th>PF Payment Date</th>
                        <th>PF Month</th>
                        <th>PF Year</th>
                        <th>Employee Contribution</th>
                        <th>Company Contribution</th>
                        <th>Monthly Total</th>
                    </tr>
                </thead>
                <tbody>
                @php($i=1)
                @foreach($pf_histories as $pf_histories_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$pf_histories_value->company_name}}</td>
                        <td>{{$pf_histories_value->first_name.' '.$pf_histories_value->last_name}}</td>
                        <td>{{$pf_histories_value->department_name}}</td>
                        <td>{{$pf_histories_value->designation_name}}</td>
                        <td>{{$pf_histories_value->providentfund_bankaccount_stuff_id}}</td>
                        <td>{{$pf_histories_value->providentfund_bankaccount_bank_name}}</td>
                        <td>{{$pf_histories_value->providentfund_bankaccount_bank_account_number}}</td>
                        <td>{{$pf_histories_value->providentfund_bankaccount_branch_name}}</td>
                        <td>{{$pf_histories_value->providentfund_bankaccount_branch_code}}</td>
                        <td>{{$pf_histories_value->provident_fund_payment_date}}</td>
                        <td>{{date("F", strtotime($pf_histories_value->provident_fund_month_year))}}</td>
                        <td>{{date('Y', strtotime($pf_histories_value->provident_fund_month_year))}}</td>
                        <td>{{$pf_histories_value->provident_fund_employee_amount}}</td>
                        <td>{{$pf_histories_value->provident_fund_company_amount}}</td>
                        <td>{{$monthly_total = $pf_histories_value->provident_fund_employee_amount + $pf_histories_value->provident_fund_company_amount}}</td>
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










  } );


</script>



@endsection
















