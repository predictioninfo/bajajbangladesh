@extends('back-end.premium.layout.employee-setting-main')
@section('content')


<section class="main-contant-section">
    <div class="card mb-0">
        <div class="card-header with-border">
            <h1 class="card-title text-center"> {{__('Pay Slip List')}} </h1>
        </div>
    </div>
    <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Net Salary')}}</th>
                        <th>{{__('Salary Month')}}</th>
                        <th>{{__('Payroll Date')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($pay_slips as $pay_slips_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$pay_slips_value->pay_slip_net_salary}}</td>
                        <td>{{$pay_slips_value->pay_slip_month_year}}</td>
                        <td>{{$pay_slips_value->pay_slip_month_year}}</td>
                        <td>@if($pay_slips_value->pay_slip_status == 1){{_('Paid')}}@else{{_('Unpaid')}}@endif</td>
                        <td>
                            <form method="post" action="{{route('pay-slip-downloads')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$pay_slips_value->id}}" required>
                                <button type="submit">{{__('Download')}}</button>
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