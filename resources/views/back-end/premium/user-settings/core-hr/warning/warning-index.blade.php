@extends('back-end.premium.layout.employee-setting-main')
@section('content')

    <section class="main-contant-section">

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Warning List')}} </h1>
            </div>
        </div>

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Department')}}</th>
                        <th>{{__('Employee Name')}}</th>
                        <th>{{__('Warning Type')}}</th>
                        <th>{{__('Warning Date')}}</th>
                        <th>{{__('Subject')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Warning Status')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($warnings as $warnings_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$warnings_value->department_name}}</td>
                            <td>{{$warnings_value->first_name.' '.$warnings_value->last_name}}</td>
                            <td>{{$warnings_value->warning_type}}</td>
                            <td>{{$warnings_value->warning_date}}</td>
                            <td>{{$warnings_value->warning_subject}}</td>
                            <td>{{$warnings_value->warning_desc}}</td>
                            <td>{{$warnings_value->warning_status}}</td>
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
















