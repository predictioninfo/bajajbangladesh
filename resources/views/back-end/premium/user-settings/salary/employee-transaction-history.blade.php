@extends('back-end.premium.layout.employee-setting-main')
@section('content')

<section class="main-contant-section">
    <div class=" mb-3">
        @if(Session::get('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
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
                <h1 class="card-title text-center"> {{__('Salary Increment History List')}} </h1>
            </div>
        </div>

    </div>
    <div class="content-box">
    <div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Previous Salary</th>
                    <th>Current Salary</th>
                    <th>Increment Date</th>
                </tr>
            </thead>
            <tbody>


                @php($i=1)
                @foreach($histories as $history)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ $history->usertSalaryHistory->company_assigned_id }}</td>
                    <td>{{ $history->usertSalaryHistory->first_name ?? null }} {{
                        $history->usertSalaryHistory->last_name
                        ?? null }}</td>
                    <td>{{$history->salary_history_previous_gross}}</td>
                    <td>{{$history->salary_history_gross}}</td>
                    <td>{{$history->updated_at->format(date('d-m-Y'))}}</td>
                </tr>
                @endforeach

            </tbody>

        </table>

    </div>
    </div>
</section>



<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update-goal-types')}}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" required>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                            <label>Goal Type</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" name="goal_type_name" id="goal_type_name" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->






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
