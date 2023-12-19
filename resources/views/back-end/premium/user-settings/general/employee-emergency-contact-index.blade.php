
@extends('back-end.premium.layout.employee-setting-main')

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
                    <h1 class="card-title text-center"> {{ __('Emergency Contact List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        <li><a href="#">List - Emergency Contact </a></li>
                    </ol>
                </div>
            </div>

           <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color:#61c597;">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Emergency Contact')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-emergency-contact-employees')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Name:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_name" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Relation:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-retweet" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_relation" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Email:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_email" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Phone:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_phone" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Address:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_address" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>

                                    </div>
                                </div>

                            </form>
                        </div>

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
                        <th>{{__('Relation')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Address')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @php($i=1)
                        @foreach($emergency_contact_details as $emergency_contact_details_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$emergency_contact_details_value->emergency_contact_name}}</td>
                            <td>{{$emergency_contact_details_value->emergency_contact_relation}}</td>
                            <td>{{$emergency_contact_details_value->emergency_contact_email}}</td>
                            <td>{{$emergency_contact_details_value->emergency_contact_phone}}</td>
                            <td>{{$emergency_contact_details_value->emergency_contact_address}}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn  edit" data-id="{{$emergency_contact_details_value->id}}" data-toggle="tooltip"
                                    title="" data-original-title=" Edit "> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                <a href="{{route('delete-employee-emergency-contacts',['id'=>$emergency_contact_details_value->id])}}" data-toggle="tooltip" title=""
                                    data-original-title=" Delete " class="btn btn-danger delete delete-post"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           </div>
        </div>
    </section>


      <!-- edit boostrap model -->
      <div class="modal fade" id="edit-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                        <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Name:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Relation:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-retweet" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_relation" id="emergency_contact_relation" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Email:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_email" id="emergency_contact_email" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Phone:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Address:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="emergency_contact_address" id="emergency_contact_address" class="form-control date" value="">
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


             //value retriving and opening the edit modal starts

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'employee-emergency-contact-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#emergency_contact_name').val(res.emergency_contact_name);
                    $('#emergency_contact_relation').val(res.emergency_contact_relation);
                    $('#emergency_contact_email').val(res.emergency_contact_email);
                    $('#emergency_contact_phone').val(res.emergency_contact_phone);
                    $('#emergency_contact_address').val(res.emergency_contact_address);
                    }
                });
            });

           //value retriving and opening the edit modal ends

             // edit form submission starts

          $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type:'POST',
                    url: `/update-employee-emergency-contact`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                    toastr.success(response.success, 'Data successfully updated!!');
                    window.location.reload(true);
                    },
                    error: function(response){

                        toastr.error(response.error, 'Please Entry Valid Data!!');
                    }
                });
            });

            // edit form submission ends


   });

    </script>
@endsection
