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
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Provident Fund Members')}} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - Provident Fund Members   </a></li>
                    </ol>
                </div>
            </div>

        </div>

<div class="content-box">

<div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Department')}}</th>
                        <th>{{__('Designation')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($pf_eligible_members as $pf_eligible_members_value)
                        @if($pf_eligible_members_value->user_provident_fund_member != 'Yes')
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$pf_eligible_members_value->first_name.' '.$pf_eligible_members_value->last_name}}</td>
                            <td>{{$pf_eligible_members_value->department_name}}</td>
                            <td>{{$pf_eligible_members_value->designation_name}}</td>
                            <td>
                                <a href="{{route('send-membership-proposals',['id'=>$pf_eligible_members_value->id])}}" class="btn-warning delete-post">Send Membership Proposal</a>
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

        "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,
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
















