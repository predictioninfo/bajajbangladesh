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
            
            <div class="d-flex flex-row">
                {{-- @if($add_permission == 'Yes') --}}
                <div class="p-2">
                    <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus"></i> {{__('Add Signatory')}}
                    </button>
                </div>
                {{-- @endif --}}

            </div>

           
        </div>



            <!-- Add Modal Starts -->

            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Signatory')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-signatures')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="row">  
                              
                                    <div class="col-md-6 form-group">
                                        <label>Signatory Name</label>
                                        <input type="text" name="signature_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Signatory Bangla Name</label>
                                        <input type="text" name="signature_bangla_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Company Name</label>
                                        <input type="text" name="signature_com_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Company Bangla Name</label>
                                        <input type="text" name="signature_com_bangla_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Designation</label>
                                        <input type="text" name="signature_designation" class="form-control" required>
                                    </div>
                                     <div class="col-md-6 form-group">
                                        <label>Bangla Designation</label>
                                        <input type="text" name="signature_bangla_designation" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Upload Signature</label>
                                        <input type="file" name="signature_photo" class="form-control">
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                        <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/>
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Add Modal Ends -->
<div class="conten-box">
    
<div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Signatory Name')}}</th>
                        <th>{{__('Signatory Bangla Name')}}</th>
                        <th>{{__('Signatorys Company Name')}}</th>
                        <th>{{__('Signatorys Company Bangla Name')}}</th>
                        <th>{{__('Designation')}}</th>
                        <th>{{__('Designation Bangla Name')}}</th>
                        <th>{{__('Signature')}}</th>
                        {{-- @if($edit_permission == 'Yes' || $delete_permission == 'Yes') --}}
                        <th>{{__('Action')}}</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody>
				         @php($i=1)
                        @foreach($signatures as $signature) 
                       <tr>
                            <td>{{$i++}}</td>


                            <td>{{$signature->signature_name}}</td>
                            <td>{{$signature->signature_bangla_name}}</td>
                            <td>{{$signature->signature_com_name}}</td>
                            <td>{{$signature->signature_com_bangla_name}}</td>
                            <td>{{$signature->signature_designation}}</td>
                            <td>{{$signature->signature_bangla_designation}}</td>
                            <td><img width="150" src="{{asset($signature->signature_photo)}}"></td>
                            <td>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{$signature->id}}"><i class="fa fa-edit" style="margin-left:-6px;"></i></button>
                            <!--<from method="post" action="{{route('update-signatures')}}">-->
                            <!--<a href="#" class="btn btn-danger delete-post">Delete</a>-->
                            <!-- </from>-->
                             <a href="{{route('delete-signatures',['id'=>$signature->id])}}" data-id="{{ $signature->id }}"><button class="btn btn-danger"  style="width:20px;"><i class="fa fa-trash" style="margin-left:-6px;"></i></button></a>
                            </td> 
                        </tr>
                        
                        
                        
                        
                        
        <!-- edit boostrap model -->
        <div class="modal fade" id="myModal{{$signature->id}}" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                   <form method="post" action="{{route('update-signatures')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{$signature->id}}">
                                <div class="row">  
                              
                                    <div class="col-md-6 form-group">
                                        <label>Signatory Name</label>
                                        <input type="text" name="signature_name" class="form-control" value="{{$signature->signature_name}}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Signatory Bangla Name</label>
                                        <input type="text" name="signature_bangla_name" class="form-control" value="{{$signature->signature_bangla_name}}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Company Name</label>
                                        <input type="text" name="signature_com_name" class="form-control" value="{{$signature->signature_com_name}}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Company Bangla Name</label>
                                        <input type="text" name="signature_com_bangla_name" class="form-control" value="{{$signature->signature_com_bangla_name}}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Designation</label>
                                        <input type="text" name="signature_designation" class="form-control" value="{{$signature->signature_designation}}" required>
                                    </div>
                                     <div class="col-md-6 form-group">
                                        <label>Bangla Designation</label>
                                        <input type="text" name="signature_bangla_designation" class="form-control" value="{{$signature->signature_bangla_designation}}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Upload Signature</label>
                                        <input type="file" name="signature_photo" class="form-control">
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                       <button type="submit" class="btn btn-primary">Save changes</button>
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
                        @endforeach
                        
                       
                      
                </tbody>

            </table>


        </div>
</div>
    </section>


        




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

            //  $('.edit').on('click', function () {
            //     var id = $(this).data('id');

            //     $.ajax({
            //         type:"POST",
            //         url: 'asset-by-id',
            //         data: { id: id },
            //         dataType: 'json',

            //         success: function(res){
            //         $('#ajaxModelTitle').html("Edit");
            //         $('#edit-modal').modal('show');
            //         $('#id').val(res.id);
            //         $('#edit_asset_department_id').val(res.asset_department_id);
            //         $('#asset_name').val(res.asset_name);
            //         $('#asset_code').val(res.asset_code);
            //         $('#asset_category_name').val(res.asset_category_name);
            //         $('#asset_is_working').val(res.asset_is_working);
            //         $('#asset_purchase_date').val(res.asset_purchase_date);
            //         $('#asset_warranty_end_date').val(res.asset_warranty_end_date);
            //         $('#asset_manufacturer').val(res.asset_manufacturer);
            //         $('#asset_serial_number').val(res.asset_serial_number);
            //         $('#asset_note').val(res.asset_note);
            //         }
            //     });
            // });

           //value retriving and opening the edit modal ends

             // edit form submission starts

        //   $('#edit_form').submit(function(e) {
        //         e.preventDefault();
        //         let formData = new FormData(this);
        //         console.log(formData);
        //         $('#error-message').text('');

        //         $.ajax({
        //             type:'POST',
        //             url: `/update-asset`,
        //             data: formData,
        //             contentType: false,
        //             processData: false,
        //             success: (response) => {
        //                 window.location.reload();
        //                 if (response) {
        //                 this.reset();
        //                 alert('Data has been updated successfully');
        //                 }
        //             },
        //             error: function(response){
        //                 console.log(response);
        //                     $('#error-message').text(response.responseJSON.errors.file);
        //             }
        //         });
        //     });

            // edit form submission ends

            // $('#asset_department_id').on('change', function() {
            //   var departmentID = $(this).val();
            //   if(departmentID) {
            //       $.ajax({
            //           url: '/get-department-wise-employee/'+departmentID,
            //           type: "GET",
            //           data : {"_token":"{{ csrf_token() }}"},
            //           dataType: "json",
            //           success:function(data)
            //           {
            //              if(data){
            //                 $('#asset_employee_id').empty();
            //                 $('#asset_employee_id').append('<option hidden>Choose an Employee</option>'); 
            //                 $.each(data, function(key, employees){
            //                     $('select[name="asset_employee_id"]').append('<option value="'+ employees.id +'">' + employees.company_assigned_id+'('+ employees.first_name +' '+ employees.last_name +')'+'</option>');
            //                 });
            //             }else{
            //                 $('#employees').empty();
            //             }
            //          }
            //       });
            //   }else{
            //      $('#employees').empty();
            //   }
            //  });

            //  $('#edit_asset_department_id').on('change', function() {
            //   var departmentID = $(this).val();
            //   if(departmentID) {
            //       $.ajax({
            //           url: '/get-department-wise-employee/'+departmentID,
            //           type: "GET",
            //           data : {"_token":"{{ csrf_token() }}"},
            //           dataType: "json",
            //           success:function(data)
            //           {
            //              if(data){
            //                 $('#edit_asset_employee_id').empty();
            //                 $('#edit_asset_employee_id').append('<option hidden>Choose an Employee</option>'); 
            //                 $.each(data, function(key, employees){
            //                     $('select[name="edit_asset_employee_id"]').append('<option value="'+ employees.id +'">' + employees.company_assigned_id+'('+ employees.first_name +' '+ employees.last_name +')'+'</option>');
            //                 });
            //             }else{
            //                 $('#employees').empty();
            //             }
            //          }
            //       });
            //   }else{
            //      $('#employees').empty();
            //   }
            //  });



  } );


</script>



@endsection
















