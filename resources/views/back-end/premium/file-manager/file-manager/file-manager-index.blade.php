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

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        </div>
        @if($add_permission == 'Yes')
        <div class="content-box">
        <div class="container-fluid">
            <div class="card mb-0">
                
                <div class="card mb-0">
                    <div class="card-header with-border">
                        <h1 class="card-title text-center"> {{ __('File Manager') }} </h1>
                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                           
                            <li><a href="#">List - {{ 'File Manager' }} </a></li>
                        </ol>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('add-file-managers')}}" enctype="multipart/form-data">
                                    @csrf

                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label>Department</label>
                                        <select class="form-control" name="file_manager_department_id" required>
                                            <option value="">Selecting...</option>
                                            @foreach($departments as $departments_value)
                                            <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">{{__('File Name')}}</label>
                                            <input type="text" class="form-control" name="file_manager_name" required value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">{{__('Document File')}}</label>
                                            <input type="file" class="form-control" name="file_manager_file" required value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">{{__('External Link (Drive,Dropbox etc)')}}</label>
                                            <input type="text" class="form-control" name="file_manager_external_link" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-grad"><i class="fa fa-plus"></i> {{__('Add')}}
                                                </button>
                                                @if($delete_permission == 'Yes')

                                                    <form method="post" action="{{route('bulk-delete-file-managers')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
                                                        <input type="submit" class="btn btn-danger" value="{{__('Bulk Delete')}}" />
                                                    </form>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endif


        <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Department Name')}}</th>
                        <th>{{__('File Name')}}</th>
                        <th>{{__('File')}}</th>
                        <th>{{__('File External Link')}}</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($file_managers as $file_managers_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$file_managers_value->department_name}}</td>
                            <td>{{$file_managers_value->file_manager_name}}</td>
                            <td><a href="{{asset($file_managers_value->file_manager_file)}}" download>Download</a></td>
                            <td>{{$file_managers_value->file_manager_external_link}}</td>
                            @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            <td>
                            
                                @if($edit_permission == 'Yes')
                                <a href="javascript:void(0)" class="btn edit" data-id="{{$file_managers_value->id}}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                                @if($delete_permission == 'Yes')
                                <a href="{{route('delete-file-managers',['id'=>$file_managers_value->id])}}" class="btn  btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                    data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                                @endif
                               
                            </td>
                            @endif
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
                    <form method="post" action="{{ route('update-file-managers') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            
                            <div class="col-md-6 form-group">
                                <label>Department</label>
                                <select class="form-control" name="file_manager_department_id" id="file_manager_department_id" required>
                                    <option value="">Selecting...</option>
                                    @foreach($departments as $departments_value)
                                    <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail"> {{__('File Name')}} </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-file-image-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="file_manager_name" id="file_manager_name" required value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail"> {{__('Document File')}} </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-file-image-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="file" class="form-control" name="file_manager_file" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail"> {{__('External Link (Drive,Dropbox etc)')}} </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-dropbox" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="file_manager_external_link" id="file_manager_external_link" value="">
                                </div>
                            </div>
                           
                            <div class="col-sm-offset-2 col-sm-10 mt-5">
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

                    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
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
















