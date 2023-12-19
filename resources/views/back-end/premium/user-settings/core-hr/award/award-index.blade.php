@extends('back-end.premium.layout.employee-setting-main')
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
        </div>

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Award List')}} </h1>
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
                        <th>{{__('Award Name')}}</th>
                        <th>{{__('Gift')}}</th>
                        <th>{{__('Cash')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Award Photo')}}</th>
                        <th>{{__('Award Info')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($awards as $awards_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$awards_value->first_name.' '.$awards_value->last_name}}</td>
                            <td>{{$awards_value->department_name}}</td>
                            <td>{{$awards_value->award_type_name}}</td>
                            <td>{{$awards_value->award_gift}}</td>
                            <td>{{$awards_value->award_cash}}</td>
                            <td>{{$awards_value->award_date}}</td>
                            <td><img width="150" src="{{asset($awards_value->award_photo)}}"></td>
                            <td>{{$awards_value->award_info}}</td>
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
















