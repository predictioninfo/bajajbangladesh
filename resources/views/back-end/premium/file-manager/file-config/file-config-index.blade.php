@extends('back-end.premium.layout.premium-main')
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

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach

        </div>

        <div class="card mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title text-center"> {{__('File Config')}}</h3>
                </div>
            </div>

<div class="content-box">
    <form method="post" class="mb-3" action="{{route('add-file-configs')}}" enctype="multipart/form-data">
        @csrf
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Max file Size (mb) *</label>
                    <input type="text" class="form-control" name="file_config_file_size" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-grad"><i class="fa fa-plus"></i> {{__('Add')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Max file Size (mb)')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($file_configs as $file_configs_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$file_configs_value->file_config_file_size}}</td>
                            <td>
                                <a href="{{route('delete-file-configs',['id'=>$file_configs_value->id])}}" class="btn btn-danger delete-post">Delete</a>
                            </td>
                        </tr>
                        @endforeach






                </tbody>

            </table>

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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">{{__('File Name')}}</label>
                                    <input type="text" class="form-control" name="file_manager_name" id="file_manager_name" required value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">{{__('Document File')}}</label>
                                    <input type="file" class="form-control" name="file_manager_file" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">{{__('External Link (Drive,Dropbox etc)')}}</label>
                                    <input type="text" class="form-control" name="file_manager_external_link" id="file_manager_external_link" value="">
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-grad w-50">Save changes</button>
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
                    url: 'file-manager-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#file_manager_department_id').val(res.file_manager_department_id);
                    $('#file_manager_name').val(res.file_manager_name);
                    $('#file_manager_external_link').val(res.file_manager_external_link);
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
                    url: `/update-file-manager`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                        this.reset();
                        alert('Data has been updated successfully');
                        }
                    },
                    error: function(response){
                        console.log(response);
                            $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends





  } );


</script>



@endsection
















