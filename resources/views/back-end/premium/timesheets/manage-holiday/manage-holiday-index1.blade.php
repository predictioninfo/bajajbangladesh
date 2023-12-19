
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

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Office Shift')}} </h1>
                </div>
            </div>
            <div class="p-2">

                   <button type="button" class="btn btn-grad" data-toggle="modal" data-target="#addDepartmentModal"><i
                               class="fa fa-plus-circle"></i> {{__('Add Holiday')}}
                   </button>

           </div>

           <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Holiday')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                                <form method="post" id="add_holiday_form" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- <input type="hidden" name="id" value=""> -->

                                    <div class="col-md-8 form-group">
                                        <label>{{__('Holiday Type')}} *</label>
                                        <input type="text" name="holiday_type" id="holiday_type"  value="" required class="form-control">
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <label>{{__('Holiday Name')}} *</label>
                                        <input type="text" name="holiday_name" id="holiday_name"  value="" required class="form-control">
                                    </div>
                                    <br>

                                    <div class="col-sm-9">

                                        <input type="submit" name="action_button" class="btn btn-grad w-50" value="{{__('Add')}}"/>

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
                        <th>{{__('Holiday Name')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach($holidays as $holidays_values)
                        <tr>
                            <td>{{$holidays_values->holiday_type}}</td>
                            <td>{{$holidays_values->holiday_name}}</td>
                            <td>
                            <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                            <a href="javascript:void(0)" class="btn " id="edit-holiday" data-id="{{ $holidays_values->id }}">Edit</a>
                                <a href="javascript:void(0)" class="btn " id="delete-holiday" data-id="{{ $holidays_values->id }}">Delete</a>
                                <!-- <input type='button' value='Update' class='update' data-id='"+id+"' >
                                <input type='button' value='Delete' class='delete' data-id='"+id+"' > -->
                            </ul>
                        </div>
                                
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
</div>



        </div>
    </section>





<!-- boostrap model -->
<div class="modal fade" id="ajax-book-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxBookModel"></h4>
          </div>
          <div class="modal-body">
            {{-- <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="POST"> --}}
            <form method="post" id="edit_holiday_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Holiday Type</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="holiday_type" name="holiday_type" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Holiday Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="holiday_name" name="holiday_name" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-grad" id="btn-save" value="addNewBook">Save changes
                </button>
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


        $('#add_holiday_form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type:'POST',
                url: `/add-holiday`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                    this.reset();
                    alert('Data has been added successfully');
                    }
                },
                error: function(response){
                    console.log(response);
                        $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });





            // $('#edit-post').on('click', function () {
            //     var post_id = $(this).data('id');

            //     $.ajax({
            //            url: '/get-by-employee-id/'+post_id,
            //            type: "GET",
            //            data : {"_token":"{{ csrf_token() }}"},
            //            dataType: "json",
            //            success:function(data)
            //            {
            //             $('#postCrudModal').html("Edit post");
            //             $('#btn-save').val("edit-post");
            //             $('#ajax-crud-modal').modal('show');
            //             $('#post_id').val(users_by_id.id);
            //             $('#first_name').val(users_by_id.first_name);
            //             // $.each(data, function(key, users_by_id){
            //             //         $('#post_id').val(users_by_id.id);
            //             //         $('#first_name').val(users_by_id.first_name);
            //             //     });
            //             }
            //        });


            // });

            $('#edit-holiday').on('click', function () {

                var id = $(this).data('id');
                // ajax
                $.ajax({
                    type:"GET",
                    url: '/getting-holiday/'+id,
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: 'json',
                    success: function(holiday_by_id){
                    $('#ajaxBookModel').html("Edit Book");
                    $('#ajax-book-model').modal('show');
                    $('#id').val(holiday_by_id.id);
                    $('#holiday_type').val(holiday_by_id.holiday_type);
                    $('#holiday_name').val(holiday_by_id.holiday_name);
                }
                });
            });



            $('#edit_holiday_form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type:'POST',
                url: `/update-holiday`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                    this.reset();
                    alert('Data has been Updated successfully');
                    }
                },
                error: function(response){
                    console.log(response);
                        $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });


            $('#delete-holiday').on('click', function () {
            if (confirm("Delete Record?") == true) {
                var id = $(this).data('id');

                // ajax
                $.ajax({
                    type:"POST",
                    url: "{{ url('delete-holiday') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    window.location.reload();
                }
                });
            }
            });












   });

    </script>
@endsection
