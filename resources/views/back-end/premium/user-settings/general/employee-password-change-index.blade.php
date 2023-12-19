
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



    <span id="form_result"></span>

    <section class="forms">
    <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{__('Change Password')}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        <div class="content-box">
        <p class="italic"><small>{{__('The field labels marked with * are required input fields')}}.</small></p>
                        
                        <form method="POST" action="{{route('update-employee-passwords')}}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" class="form-control" value="{{Session::get('employee_setup_id')}}" required />
                      
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{__('New Password')}} *</strong></label>
                                        <input type="password" name="password" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{__('Confirm Password')}} *</strong></label>
                                        <input type="password" name="confirm_password" class="form-control" required/>
                                    </div>
                                </div>
                  
                             
                                <div class="col-md-6 mt-4">
                                    <div class="form-group">
                                        <input type="submit" id="submit" value="{{__('Submit')}}" class="btn btn-grad">
                                    </div>
                                </div>

                    
                        </form>
        </div>
    </section>
    </section>

 
    <script type="text/javascript">

      $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    

            var i = 1;
            

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