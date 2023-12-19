@extends('back-end.premium.layout.employee-setting-main')

@section('content')

    <section>

  
        <div class="container mt-5">
            
            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <div><h1>###This percentage of amount will be deducted from the basic salary of this employee in every month!!!</h1></div>
            <br>
        @foreach($employee_provident_fund as $employee_provident_fund_value)

            <form action="{{route('employee-pf-updates')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{Session::get('employee_setup_id')}}">
            
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Provident Fund Percentage</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" name="user_provident_fund" value="{{$employee_provident_fund_value}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save">Edit</button>
                    </div>
                </div>
            </form>

        @endforeach
                                         
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


    



   });

    </script>
@endsection
