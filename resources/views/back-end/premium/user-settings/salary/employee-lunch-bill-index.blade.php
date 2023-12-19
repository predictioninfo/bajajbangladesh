@extends('back-end.premium.layout.employee-setting-main')
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

        <div class="card mb-0">
            <div class="card-header with-border">

                <h1 class="card-title text-center"> {{ __('Lunch Allowance List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                    <li><a href="#">List - Lunch Allowance </a></li>

                </ol>
            </div>
        </div>
    </div>

    <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Employee Name') }}</th>
                        <th>{{ __('Employee ID') }}</th>
                        <th>{{ __('Lunch Allowance') }}</th>
                        <th>{{ __('Month') }}</th>
                        <th>{{ __('Year') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($lunch_bills as $lunch)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $lunch->userLunch->first_name.' '.$lunch->userLunch->last_name }}</td>
                        <td>{{ $lunch->userLunch->company_assigned_id }}</td>
                        <td>{{ $lunch->lunch_bill.' '.__('BDT')}}</td>
                        <td>{{date('F', strtotime($lunch->lunch_month_year))}}</td>
                        <td>{{date('Y', strtotime($lunch->lunch_month_year))}}</td>

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
