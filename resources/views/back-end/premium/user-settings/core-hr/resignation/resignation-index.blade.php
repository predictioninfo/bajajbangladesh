@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Resignation List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    <li><a href="#">List - Resignation </a></li>
                </ol>
            </div>
        </div>

    </div>

    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Resignation')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{route('employee-resignation-adds')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="resignation_department_id"
                                value="{{ Auth::user()->userdepartment->id }}">
                            <input type="hidden" name="resignation_designation_id"
                                value="{{ Auth::user()->userdesignation->id }}">

                            <input type="hidden" name="resignation_employee_id"
                                value="{{ Session::get('employee_setup_id') }}">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Notice Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="date" name="resignation_notice_date" class="form-control date"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Resignation Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="date" name="resignation_date" class="form-control date" value="">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="resignation_desc" id="resignation_desc"
                                    rows="3"></textarea>
                                <script>
                                    CKEDITOR.replace( 'resignation_desc' );
                                </script>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>

                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

    <!-- Add Modal Ends -->

    <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Employee')}}</th>
                        <th>{{__('Department')}}</th>
                        <th>{{__('Notice Date')}}</th>
                        <th>{{__('Resignation Date')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Download')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($resignations as $resignations_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$resignations_value->first_name.' '.$resignations_value->last_name}}</td>
                        <td>{{$resignations_value->department_name}}</td>
                        <td>{{$resignations_value->resignation_notice_date}}</td>
                        <td>{{$resignations_value->resignation_date}}</td>
                        <td>{{strip_tags($resignations_value->resignation_desc)}}</td>
                        <td>
                            <form method="post"
                                action="{{route('resignation-letter-downloads',['id'=>$resignations_value->id])}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resignations_value->id}}">
                                <button type="submit">{{__('Download')}}</button>
                            </form>
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
                <form method="post" action="{{ route('update-resignations') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Department</label>
                            <select class="form-control" name="edit_resignation_department_id"
                                id="edit_resignation_department_id" required>
                                <option value="">Select-a-Department</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_resignation_employee_id"
                                id="edit_resignation_employee_id"></select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Notice Date</label>
                            <input type="date" name="resignation_notice_date" id="resignation_notice_date"
                                class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Resignation Date</label>
                            <input type="date" name="resignation_date" id="resignation_date" class="form-control"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="my-textarea">Description</label>
                            <textarea class="form-control" name="resignation_desc" id="resignation_desc"
                                rows="3"></textarea>
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
                    url: 'resignation-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#edit_resignation_department_id').val(res.resignation_department_id);
                    $('#edit_resignation_employee_id').val(res.resignation_employee_id);
                    $('#resignation_notice_date').val(res.resignation_notice_date);
                    $('#resignation_date').val(res.resignation_date);
                    $('#resignation_desc').val(res.resignation_desc);
                    }
                });
            });

           //value retriving and opening the edit modal ends

            $('#resignation_department_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-department-wise-employee/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#resignation_employee_id').empty();
                            $('#resignation_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="resignation_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
                            });
                        }else{
                            $('#employees').empty();
                        }
                     }
                   });
               }else{
                 $('#employees').empty();
               }
            });

            $('#edit_resignation_department_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-department-wise-employee/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#edit_resignation_employee_id').empty();
                            $('#edit_resignation_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="edit_resignation_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
                            });
                        }else{
                            $('#employees').empty();
                        }
                     }
                   });
               }else{
                 $('#employees').empty();
               }
            });





  } );


</script>



@endsection