@extends('back-end.premium.layout.premium-main')
@section('content')
<?php
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
 ?>

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
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Transfer')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Transfer </a></li>
                </ol>
            </div>
        </div>
        {{-- <div class="d-flex flex-row">
            @if($delete_permission == 'Yes')
            <div class="p-1">
                <form method="post" action="{{route('bulk-delete-transfers')}}" id="sample_form" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}"
                        class="form-check-input">
                    <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                </form>
            </div>
            @endif
        </div> --}}



    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Transfer')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{route('add-transfers')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label>From Department</label>
                                <select class="form-control" name="transfer_from_department_id"
                                    id="transfer_from_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach($departments as $departments_value)
                                    <option value="{{$departments_value->id}}">{{$departments_value->department_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                                <select class="form-control" name="transfer_employee_id"
                                    id="transfer_employee_id"></select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>To Department</label>
                                <select class="form-control" name="transfer_to_department_id"
                                    id="transfer_to_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach($departments as $departments_value)
                                    <option value="{{$departments_value->id}}">{{$departments_value->department_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{__('To Designation')}} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="transfer_to_designation_id"
                                    id="transfer_to_designation_id"></select>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Transfer Date <span class="text-danger">*</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="date" name="transfer_date" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea id="my-textarea" class="form-control" name="transfer_desc"></textarea>
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
                        <th>{{__('From Department')}}</th>
                        <th>{{__('To Department')}}</th>
                        <th>{{__('To Designation')}}</th>
                        <th>{{__('Transfer Date')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Download')}}</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($transfers as $transfers_value)
                    <?php
                                $employee_names = User::where('id','=',$transfers_value->transfer_employee_id)->get(['first_name','last_name']);
                                $from_department_names = Department::where('id','=',$transfers_value->transfer_from_department_id)->get(['department_name']);
                                $to_department_names = Department::where('id','=',$transfers_value->transfer_to_department_id)->get(['department_name']);
                                $to_designation_names = Designation::where('id','=',$transfers_value->transfer_to_designation_id)->get(['designation_name']);
                        ?>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <?php foreach($employee_names as $employee_names_value){ echo $employee_names_value->first_name.' '.$employee_names_value->last_name;} ?>
                        </td>
                        <td>
                            <?php foreach($from_department_names as $from_department_names_value){ echo $from_department_names_value->department_name;} ?>
                        </td>
                        <td>
                            <?php foreach($to_department_names as $to_department_names_value){ echo $to_department_names_value->department_name;} ?>
                        </td>
                        <td>
                            <?php foreach($to_designation_names as $to_designation_names_value){ echo $to_designation_names_value->designation_name;} ?>
                        </td>
                        <td>{{$transfers_value->transfer_date}}</td>
                        <td>{{$transfers_value->transfer_desc}}</td>
                        <td>
                            <form method="post"
                                action="{{route('transfer-letter-downloads',['id'=>$transfers_value->id])}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$transfers_value->id}}">
                                <button type="submit">{{__('Download')}}</button>
                            </form>
                        </td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>

                            @if($edit_permission == 'Yes')
                            <a href="javascript:void(0)" class="btn edit" data-id="{{$transfers_value->id}}"
                                data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @if($delete_permission == 'Yes')
                            <a href="{{route('delete-transfers',['id'=>$transfers_value->id])}}"
                                class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
                <form method="post" action="{{ route('update-transfers') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="id">

                    <div class="row">

                        <div class="col-md-4 form-group">
                            <label>From Department</label>
                            <select class="form-control" name="edit_transfer_from_department_id"
                                id="edit_transfer_from_department_id">

                                @foreach($departments as $departments_value)

                                <option value="{{$departments_value->id}}" {{
                                    old('department_name')==$departments_value->id ? 'selected' : ''
                                    }}>{{$departments_value->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_transfer_employee_id"
                                id="edit_transfer_employee_id">

                                @foreach($employees as $employees_value)
                                <option value="{{$employees_value->id}}">{{$employees_value->first_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>To Department</label>
                            <select class="form-control" name="edit_transfer_to_department_id"
                                id="edit_transfer_to_department_id">
                                <option value="" disabled>Select-a-Department</option>
                                @foreach($departments as $departments_value)
                                <option value="{{$departments_value->id}}">{{$departments_value->department_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="text-bold">{{__('To Designation')}} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_transfer_to_designation_id"
                                id="edit_transfer_to_designation_id">
                                <option value="">Select-a-Designation</option>
                                @foreach($designations as $designations_value)
                                <option value="{{$designations_value->id}}" {{
                                    old('designation_name')==$designations_value->id ? 'selected' : ''
                                    }}>{{$designations_value->designation_name}}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label>Transfer Date <span class="text-danger">*</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="transfer_date" id="transfer_date" class="form-control"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="my-textarea">Description</label>
                            <textarea class="form-control" name="transfer_desc" id="transfer_desc"></textarea>
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
                    "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                    "iDisplayLength": 25,
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
                    url: 'transfer-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#transfer_date').val(res.transfer_date);
                    $('#edit_transfer_employee_id').val(res.transfer_employee_id);
                    $('#edit_transfer_from_department_id').val(res.transfer_from_department_id);
                    $('#edit_transfer_to_department_id').val(res.transfer_to_department_id);
                    $('#edit_transfer_to_designation_id').val(res.transfer_to_designation_id);
                    $('#transfer_desc').val(res.transfer_desc);
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
                    url: `/update-transfer`,
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


            $('#transfer_from_department_id').on('change', function() {
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
                            $('#transfer_employee_id').empty();
                            $('#transfer_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="transfer_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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

            $('#transfer_to_department_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-designation/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#transfer_to_designation_id').empty();
                            $('#transfer_to_designation_id').append('<option hidden value="" >Choose Designation</option>');
                            $.each(data, function(key, designations){
                                $('select[name="transfer_to_designation_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
                            });
                        }else{
                            $('#designations').empty();
                        }
                     }
                   });
               }else{
                 $('#designations').empty();
               }
            });


            $('#edit_transfer_from_department_id').on('change', function() {
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
                            $('#edit_transfer_employee_id').empty();
                            $('#edit_transfer_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="edit_transfer_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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

            $('#edit_transfer_to_department_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-designation/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#edit_transfer_to_designation_id').empty();
                            $('#edit_transfer_to_designation_id').append('<option hidden value="" >Choose Designation</option>');
                            $.each(data, function(key, designations){
                                $('select[name="edit_transfer_to_designation_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
                            });
                        }else{
                            $('#designations').empty();
                        }
                     }
                   });
               }else{
                 $('#designations').empty();
               }
            });




  } );


</script>



@endsection