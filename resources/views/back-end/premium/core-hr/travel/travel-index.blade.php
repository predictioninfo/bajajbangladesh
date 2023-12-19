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
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Travel')}} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus"> </span>Add</a></li>
                       @endif
                        <li><a href="#">List - Travel   </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row">
                @if($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-travels')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
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
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Travel')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-travels')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label>Department  <span class="text-danger">*</label>
                                        <select class="form-control" name="travel_department_id" id="travel_department_id" required>
                                            <option value="">Select-a-Department</option>
                                            @foreach($departments as $departments_value)
                                            <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" name="travel_employee_id" id="travel_employee_id" data-live-search="true" data-live-search-style="startsWith"></select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Arrangement Type  <span class="text-danger">*</label>
                                        <select class="form-control" name="travel_arrangement_type" required>
                                            <option value="">Select-An-Arrangement-Type</option>
                                            @foreach($arrangement_types as $arrangement_types_value)
                                            <option value="{{$arrangement_types_value->variable_method_name}}">{{$arrangement_types_value->variable_method_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="my-textarea">Purpose of Visit  <span class="text-danger">*</label>
                                        <textarea class="form-control" name="travel_purpose" ></textarea>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="my-textarea">Description</label>
                                        <textarea class="form-control" name="travel_desc"></textarea>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Place of Visit  <span class="text-danger">*</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-map-marker" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="travel_place" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Start Date  <span class="text-danger">*</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="travel_start_date" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>End Date  <span class="text-danger">*</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="travel_end_date" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Expected Budget  <span class="text-danger">*</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="travel_expected_budget" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Actual Budget  <span class="text-danger">*</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="travel_actual_budget" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Travel Mode  <span class="text-danger">*</label>
                                        <select class="form-control" name="travel_mode">
                                            <option>Select a Travel Mode</option>
                                            <option value="By Bus">By Bus</option>
                                            <option value="By Train">By Train</option>
                                            <option value="By Plane">By Plane</option>
                                            <option value="By Taxi">By Taxi</option>
                                            <option value="By Rental Car">By Rental Car</option>
                                            <option value="By Other">By Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Status  <span class="text-danger">*</label>
                                        <select class="form-control" name="travel_status">
                                            <option>Select a Travel Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="First Lavel Approval">First Lavel Approval</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                        <!-- <input type="submit" name="action_button" class="btn btn-grad" value="{{__('Add')}}"/> -->

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
                        <th>{{__('Visit Purpose')}}</th>
                        <th>{{__('Place Name')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                        <th>{{__('Expected Budget')}}</th>
                        <th>{{__('Actual Budget')}}</th>
                        <th>{{__('Travel Mode')}}</th>
                        <th>{{__('Travel Status')}}</th>
                        {{-- @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif --}}
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($travels as $travels_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$travels_value->first_name.' '.$travels_value->last_name}}</td>
                            <td>{{$travels_value->department_name}}</td>
                            <td>{{$travels_value->travel_purpose}}</td>
                            <td>{{$travels_value->travel_place}}</td>
                            <td>{{$travels_value->travel_desc}}</td>
                            <td>{{$travels_value->travel_start_date}}</td>
                            <td>{{$travels_value->travel_end_date}}</td>
                            <td>{{$travels_value->travel_expected_budget}}</td>
                            <td>{{$travels_value->travel_actual_budget}}</td>
                            <td>{{$travels_value->travel_mode}}</td>
                            <td>
                                <span class="badge badge-light-success"> {{$travels_value->travel_status}} </span>
                            </td>
                            {{--
                            @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                @if($edit_permission == 'Yes')
                                <a href="javascript:void(0)" class="btn edit" data-id="{{$travels_value->id}}">Edit</a>
                                @endif
                                @if($travels_value->travel_status != 'Approved')
                                <a href="{{route('approve-travels',['id'=>$travels_value->id])}}" class="btn  delete-post">Approve</a>
                                @endif
                                @if($delete_permission == 'Yes')
                                <a href="{{route('delete-travels',['id'=>$travels_value->id])}}" class="btn delete-post">Delete</a>
                                @endif
                                </ul>
                            </div>

                            </td>
                            @endif
                            --}}
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
                        <input type="hidden" name="travel_employee_id_hidden" id="travel_employee_id_hidden">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Department</label>
                                <select class="form-control" name="edit_travel_department_id" id="edit_travel_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach($departments as $departments_value)
                                    <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                                <select class="form-control" name="edit_travel_employee_id" id="edit_travel_employee_id"></select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Arrangement Type</label>
                                <select class="form-control" name="travel_arrangement_type" id="travel_arrangement_type" required>
                                    <option value="">Select-An-Arrangement-Type</option>
                                    @foreach($arrangement_types as $arrangement_types_value)
                                    <option value="{{$arrangement_types_value->variable_method_name}}">{{$arrangement_types_value->variable_method_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="my-textarea">Purpose of Visit</label>
                                <textarea class="form-control" name="travel_purpose" id="travel_purpose" ></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Place of Visit</label>
                                <input type="text" name="travel_place" id="travel_place" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="travel_desc" id="travel_desc"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Start Date</label>
                                {{--<input type="text" name="travel_start_date" id="travel_start_date" class="form-control date" value="">--}}
                                <input type="date" name="travel_start_date" id="travel_start_date" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>End Date</label>
                                {{--<input type="text" name="travel_end_date" id="travel_end_date" class="form-control date" value="">--}}
                                <input type="date" name="travel_end_date" id="travel_end_date" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Expected Budget</label>
                                <input type="text" name="travel_expected_budget" id="travel_expected_budget" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Actual Budget</label>
                                <input type="text" name="travel_actual_budget" id="travel_actual_budget" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Travel Mode</label>
                                <select class="form-control" name="travel_mode" id="travel_mode">
                                    <option>Select a Travel Mode</option>
                                    <option value="By Bus">By Bus</option>
                                    <option value="By Train">By Train</option>
                                    <option value="By Plane">By Plane</option>
                                    <option value="By Taxi">By Taxi</option>
                                    <option value="By Rental Car">By Rental Car</option>
                                    <option value="By Other">By Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Status</label>
                                <select class="form-control" name="travel_status" id="travel_status">
                                    <option>Select a Travel Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="First Lavel Approval">First Lavel Approval</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad ">Save changes</button>
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
                    url: 'travel-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#edit_travel_department_id').val(res.travel_department_id);
                    $('#travel_employee_id_hidden').val(res.travel_employee_id);
                    $('#travel_arrangement_type').val(res.travel_arrangement_type);
                    $('#travel_purpose').val(res.travel_purpose);
                    $('#travel_place').val(res.travel_place);
                    $('#travel_desc').val(res.travel_desc);
                    $('#travel_start_date').val(res.travel_start_date);
                    $('#travel_end_date').val(res.travel_end_date);
                    $('#travel_expected_budget').val(res.travel_expected_budget);
                    $('#travel_actual_budget').val(res.travel_actual_budget);
                    $('#travel_mode').val(res.travel_mode);
                    $('#travel_status').val(res.travel_status);
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
                    url: `/update-travel`,
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


            $('#travel_department_id').on('change', function() {
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

                            $('#travel_employee_id').empty();
                            //$('#travel_employee_id').append('<option hidden value="" >Choose an Employee</option>');

                            //$('#travel_employee_id').replaceAll('');

                            $.each(data, function(key, employees){
                                $('select[name="travel_employee_id"]').append('<option value="'+ employees.id +'">' + employees.company_assigned_id+ '(' + employees.first_name+ ' ' + employees.last_name + ')' +
                                //'data-subtext='+'<img src="'+ employees.profile_photo+'">'+
                                '</option>');

                            });

                            $(".selectpicker").selectpicker('refresh');

                        }else{
                            $('#employees').empty();
                        }
                     }
                   });
               }else{
                 $('#employees').empty();
               }
            });

            $('#edit_travel_department_id').on('change', function() {
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
                            $('#edit_travel_employee_id').empty();
                            $('#edit_travel_employee_id').append('<option hidden value="" >Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="edit_travel_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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






            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
            startDate: date
            });













// $('#my-select').selectpicker('refresh');
// $('#my-div .form-control').on('keyup', function () {
//     //here you listen to the change of the input corresponding to your select
//     //and now you can populate your select element


//     $('#my-select').append($('<option>', { value: 'any ty', text: 'any text' }));
//     $('#my-select').selectpicker('refresh');
// });









  } );


</script>



@endsection
















