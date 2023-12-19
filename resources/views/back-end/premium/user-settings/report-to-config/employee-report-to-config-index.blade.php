@extends('back-end.premium.layout.employee-setting-main')
@section('content')


<section class="main-contant-section">

<div class="container-fluid mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="content-box">
    <div class="table-responsive">
        <table  class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>{{__('Supervisor')}}</th>
                    <th>{{__('Profile Photo')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Phone')}}</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($report_to_employees as $report_to_employees_value)
                <tr>
                    @if($first_supervisor != '' || $first_supervisor != NULL)
                    @if($report_to_employees_value->id == $first_supervisor)
                    <td>{{__('First Supervisor')}}</td>
                    <td><img class="rounded" width="60" src="{{asset($report_to_employees_value->profile_photo)}}"></td>
                    <td>{{$report_to_employees_value->first_name." ".$report_to_employees_value->last_name}}</td>
                    <td>{{$report_to_employees_value->email}}</td>
                    <td>{{$report_to_employees_value->phone}}</td>
                    @endif
                    @if($second_supervisor->report_to_parent_id != '' || $second_supervisor->report_to_parent_id !=
                    NULL)
                    @if($report_to_employees_value->id == $second_supervisor->report_to_parent_id)
                    <td>{{__('Second Supervisor')}}</td>
                    <td><img class="rounded" width="60" src="{{asset($report_to_employees_value->profile_photo)}}"></td>
                    <td>{{$report_to_employees_value->first_name." ".$report_to_employees_value->last_name}}</td>
                    <td>{{$report_to_employees_value->email}}</td>
                    <td>{{$report_to_employees_value->phone}}</td>
                    @endif
                    @endif
                    @endif
                </tr>
                @endforeach
              

            </tbody>

        </table>
    </div>
    </div>

    <br>
    <!--<div style="text-algin:center;"><h3>Supervisor Setup Option</h3></div><br>-->
    <div class="content-box">
    <div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>{{__('SL')}}</th>
                    <th>{{__('Profile Photo')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('First Supervisor')}}</th>
                    <th>{{__('Second Supervisor')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($report_to_employees as $report_to_employees_value)
                @if ($report_to_employees_value->is_active == "1")
                <tr>
                    <td>{{$i++}}</td>
                    <td><img class="rounded" width="60" src="{{asset($report_to_employees_value->profile_photo)}}"></td>
                    <td>{{$report_to_employees_value->first_name." ".$report_to_employees_value->last_name}}</td>
                    <td>{{$report_to_employees_value->email}}</td>
                    <td>{{$report_to_employees_value->phone}}</td>
                    @if($first_supervisor != '' || $first_supervisor != NULL)
                    @if($report_to_employees_value->id == $first_supervisor)
                    <td class="text-center"><i class="fa fa-check"></i></td>
                    @else
                    <td></td>
                    @endif
                    @if($second_supervisor->report_to_parent_id != '' || $second_supervisor->report_to_parent_id !=
                    NULL)
                    @if($report_to_employees_value->id == $second_supervisor->report_to_parent_id)
                    <td class="text-center"><i class="fa fa-check"></i></td>
                    @else
                    <td></td>
                    @endif
                    @else
                    <td></td>
                    @endif
                    @else
                    <td></td>
                    <td></td>
                    @endif
                    <td>
                        <a href="{{route('set-employee-report-to-ids',['id'=>$report_to_employees_value->id])}}"
                            class="btn btn-danger delete-post">Set</a>
                    </td>
                </tr>
                @endif
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
