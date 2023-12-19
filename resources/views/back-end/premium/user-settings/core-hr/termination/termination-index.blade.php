@extends('back-end.premium.layout.employee-setting-main')
@section('content')


    <section class="main-contant-section">

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Termination List')}} </h1>
            </div>
        </div>

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Employee')}}</th>
                        <th>{{__('Department')}}</th>
                        <th>{{__('Termination Type')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Termination Date')}}</th>
                        <th>{{__('Notice Date')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($terminations as $terminations_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$terminations_value->first_name.' '.$terminations_value->last_name}}</td>
                            <td>{{$terminations_value->department_name}}</td>
                            <td>{{$terminations_value->termination_type}}</td>
                            <td>{{$terminations_value->termination_desc}}</td>
                            <td>{{$terminations_value->termination_date}}</td>
                            <td>{{$terminations_value->termination_notice_date}}</td>
                        </tr>
                        @endforeach


                </tbody>

            </table>

        </div>
        </div>
    </section>




<script type="text/javascript">

$(document).ready( function () {

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
















