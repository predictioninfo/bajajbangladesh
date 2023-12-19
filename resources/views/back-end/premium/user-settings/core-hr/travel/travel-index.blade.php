@extends('back-end.premium.layout.employee-setting-main')
@section('content')



<section class="main-contant-section">

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Travel List')}} </h1>
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
                        <th>{{__('Visit Purpose')}}</th>
                        <th>{{__('Place Name')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                        <th>{{__('Expected Budget')}}</th>
                        <th>{{__('Actual Budget')}}</th>
                        <th>{{__('Travel Mode')}}</th>
                        <th>{{__('Travel Status')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($travels as $travels_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$travels_value->first_name.' '.$travels_value->last_name}}</td>
                            <td>{{$travels_value->department_name}}</td>
                            <td>{{$travels_value->travel_purpose}}</td>
                            <td>{{$travels_value->travel_place}}</td>
                            <td>{{$travels_value->travel_desc}}</td>
                            <td>{{$travels_value->travel_start_date}}</td>
                            <td>{{$travels_value->travel_end_date}}</td>
                            <td>{{$travels_value->travel_expected_budget}}</td>
                            <td>{{$travels_value->travel_actual_budget}}</td>
                            <td>{{$travels_value->travel_mode}}</td>
                            <td>{{$travels_value->travel_status}}</td>
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
















