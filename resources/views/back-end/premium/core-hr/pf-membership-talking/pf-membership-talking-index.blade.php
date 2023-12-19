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
         <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Provident Fund Membership Taking')}} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - Provident Fund Membership Taking   </a></li>
                    </ol>
                </div>
            </div>

        </div>

<div class="content-box">

<div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                        @php($i=1)
                        @foreach($pf_memberships as $pf_memberships_value)
                        @if($pf_memberships_value->user_provident_fund_member != 'Yes')
                        <tr>
                            <td>{{$pf_memberships_value->first_name.' '.$pf_memberships_value->last_name}}, Please take your provident fund membership.</td>
                            <td>
                                <a href="{{route('pf-membership-takens',['id'=>$pf_memberships_value->id])}}" class="btn btn-warning">Take</a>
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
















