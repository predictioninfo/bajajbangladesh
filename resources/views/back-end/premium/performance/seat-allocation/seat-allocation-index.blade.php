@extends('back-end.premium.layout.premium-main')
@section('content')

    <section class="main-contant-section">


        <div class="mb-3">

            @if(Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
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
            @if($add_permission == 'Yes')
                <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Allocating Seats')}}
                </button> 
            @endif

          
        </div>
        @if($add_permission == 'Yes')
            <!-- Add Modal Starts -->
            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Allocating Seats')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-seats-allocations')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-bold">{{__('Department')}} <span class="text-danger">*</span></label>
                                                <select class="form-control" name="seat_allocation_dpt_id" id="seat_allocation_dpt_id">
                                                    <option>Choose a Department</option>
                                                    @foreach($departments as $departments_value)
                                                    <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="text-bold">{{__('Designation')}} <span class="text-danger">*</span></label>
                                            <select class="form-control" name="seat_allocation_desig_id" id="seat_allocation_desig_id"></select>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-bold">{{__('Designation Level')}} <span class="text-danger">*</span></label>

                                                <select name="seat_allocation_desig_level" required
                                                        class="form-control selectpicker dynamic"
                                                        data-live-search="true" data-live-search-style="begins"
                                                        data-shift_name="shift_name" data-dependent="department_name">
                                                        <option value="">Select-a-level</option>
                                                
                                                        <option value="1">Level-One</option>
                                                        <option value="2">Level-Two</option>
                                                        <option value="3">Level-Three</option>
                                                        <option value="4">Level-Four</option>
                                                        <option value="5">Level-Five</option>
                                                        <option value="6">Level-Six</option>
                                                        <option value="7">Level-Seven</option>
                                                        <option value="8">Level-Eight</option>
                                                        <option value="9">Level-Nine</option>
                                                        <option value="10">Level-Ten</option>
                                                        <option value="11">Level-Eleven</option>
                                                        <option value="12">Level-Twelve</option>
                                                        <option value="13">Level-Thireen</option>
                                                        <option value="14">Level-Fourteen</option>
                                                        <option value="15">Level-Fifteen</option>
                                                        <option value="16">Level-Sixteen</option>
                                                        <option value="17">Level-Seventeen</option>
                                                        <option value="18">Level-Eighteen</option>
                                                        <option value="19">Level-Nineteen</option>
                                                        <option value="20">Level-Twenty</option>
                                                
                                                </select>
                                        
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                            <label>Allocated Seats</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-steam-square" aria-hidden="true"></i> </span>
                                                </div>
                                                <input type="text" name="seat_allocation_alctd_seat" placeholder="5" class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="col-sm-12  mt-4">
                                        <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button> 
                                            <!-- <input type="submit" name="action_button" class="btn btn-grad  " value="{{__('Add')}}"/> -->
                                        </div>
                                    </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Add Modal Ends -->
        @endif

    
<div class="content-box">

<div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Designation Level</th>
                        <th>Allocated Seats</th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
            
                @php($i=1)
                @foreach($seat_allocations as $seat_allocations_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$seat_allocations_value->userdepartmentfromseatallocation->department_name}}</td>
                        <td>{{$seat_allocations_value->userdesignationfromseatallocation->designation_name}}</td>
                        <td>{{$seat_allocations_value->seat_allocation_desig_level}}</td>
                        <td>{{$seat_allocations_value->seat_allocation_alctd_seat}}</td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                            @if($edit_permission == 'Yes')                 
                            <a href="javascript:void(0)" class="btn edit" data-id="{{$seat_allocations_value->id}}">Edit</a>
                            @endif
                            @if($delete_permission == 'Yes')
                            <a href="{{route('delete-seats-allocations',['id'=>$seat_allocations_value->id])}}" class="btn delete-post">Delete</a>
                            @endif
                            </ul>
                        </div>
                            
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
                    <form method="post" action="{{route('update-seats-allocations')}}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>
                        <div class="row">
                     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-bold">{{__('Department')}} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="seat_allocation_dpt_id" id="seat_allocation_dpt_id_edit" required>
                                        <option>Choose a Department</option>
                                        @foreach($departments as $departments_value)
                                        <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-bold">{{__('Designation')}} <span class="text-danger">*</span></label>
                                <select class="form-control" name="seat_allocation_desig_id" id="seat_allocation_desig_id_edit" required></select>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-bold">{{__('Designation Level')}} <span class="text-danger">*</span></label>

                                    <select name="seat_allocation_desig_level" id="seat_allocation_desig_level" required
                                            class="form-control selectpicker dynamic"
                                            data-live-search="true" data-live-search-style="begins"
                                            data-shift_name="shift_name" data-dependent="department_name">
                                            <option value="">Select-a-level</option>
                                    
                                            <option value="1">Level-One</option>
                                            <option value="2">Level-Two</option>
                                            <option value="3">Level-Three</option>
                                            <option value="4">Level-Four</option>
                                            <option value="5">Level-Five</option>
                                            <option value="6">Level-Six</option>
                                            <option value="7">Level-Seven</option>
                                            <option value="8">Level-Eight</option>
                                            <option value="9">Level-Nine</option>
                                            <option value="10">Level-Ten</option>
                                            <option value="11">Level-Eleven</option>
                                            <option value="12">Level-Twelve</option>
                                            <option value="13">Level-Thireen</option>
                                            <option value="14">Level-Fourteen</option>
                                            <option value="15">Level-Fifteen</option>
                                            <option value="16">Level-Sixteen</option>
                                            <option value="17">Level-Seventeen</option>
                                            <option value="18">Level-Eighteen</option>
                                            <option value="19">Level-Nineteen</option>
                                            <option value="20">Level-Twenty</option>
                                    
                                    </select>
                            
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                <label>Allocated Seats</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-steam-square" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="seat_allocation_alctd_seat" id="seat_allocation_alctd_seat" class="form-control" value="" required>
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

            //value retriving and opening the edit modal starts

            $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'seats-allocation-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#seat_allocation_dpt_id').val(res.seat_allocation_dpt_id);
                    $('#seat_allocation_desig_id').val(res.seat_allocation_desig_id);
                    $('#seat_allocation_desig_level').val(res.seat_allocation_desig_level);
                    $('#seat_allocation_alctd_seat').val(res.seat_allocation_alctd_seat);
                    }
                });
            });

           //value retriving and opening the edit modal ends

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






           $('#seat_allocation_dpt_id').on('change', function() {
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
                            $('#seat_allocation_desig_id').empty();
                            $('#seat_allocation_desig_id').append('<option hidden value="">Choose a Designation</option>'); 
                            $.each(data, function(key, designations){
                                $('select[name="seat_allocation_desig_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
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

            $('#seat_allocation_dpt_id_edit').on('change', function() {
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
                            $('#seat_allocation_desig_id_edit').empty();
                            $('#seat_allocation_desig_id_edit').append('<option hidden value="">Choose a Designation</option>'); 
                            $.each(data, function(key, designations){
                                $('select[name="seat_allocation_desig_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
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
















