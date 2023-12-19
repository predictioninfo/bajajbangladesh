@extends('back-end.general.layout.general-main')

@section('content')

    <section>

        <div class="container-fluid"><span id="general_result"></span></div>

        <div class="container-fluid mb-3">
            <div class="d-flex flex-row">
                <div class="p-2">

                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus"></i> {{__('Add User')}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" name="create_record" id="create_record">Add Admin</a>
                                <a class="dropdown-item" href="{{url('/staff/employees')}}#formModal">Add Employee</a>
                                <a class="dropdown-item" href="{{url('/project-management/clients')}}#formModal">Add Client</a>
                            </div>
                        </div>
              
                </div>
                <div class="p-2">
                   
                        <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i
                                    class="fa fa-minus-circle"></i> {{__('Bulk delete')}}
                        </button>
                  
                </div>
            </div>


       
          
        </div>


        <div class="table-responsive">
            <table id="user-table" class="table ">
                <thead>
                <tr>
                    <th>{{__('SL')}}</th>
                    <th>{{__('User')}}</th>
                    <th>{{__('Email')}}</th>
                </tr>
                </thead>

            </table>
        </div>
    </section>

    <script type="text/javascript">

      $(document).ready( function () {

            var i = 1;

            $('#user-table').DataTable({
                
                    ajax: {

                        url: "{{ route('get-user-lists') }}",
                        method: 'GET'

                     },
                    columns: [
                        {
                            "render": function(data) {
                                return i++;
                            },
                            name: 'SL'
                        },
                        {
                            data: 'name',
                            name: 'User'
                        },
                        {
                            data: 'email',
                            name: 'Email'
                        },
                    ],

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
