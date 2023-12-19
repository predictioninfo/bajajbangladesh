@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

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
          
                {{--<button type="button" class="edit-btn btn btn-secondary mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Add Ticket')}}
                </button>--}}
           
        </div>



            <!-- Add Modal Starts -->

            {{--<div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color:#61c597;">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Ticket')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-employee-support-tickets')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="row">  
                                
                                    <div class="col-md-6 form-group">
                                        <label>Priority</label>
                                        <select class="form-control" name="support_ticket_priority" required>
                                            <option value="">Select-a-Priority</option>
                                            <option value="Critical">Critical</option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                   
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Subject</label>
                                        <input type="text" name="support_ticket_subject" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Ticket Note</label>
                                        <input type="text" name="support_ticket_note" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Ticket Date</label>
                                        <input type="text" name="support_ticket_date" class="form-control date" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Ticket Attachments</label>
                                        <input type="file" name="support_ticket_attachment" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="my-textarea">Description</label>
                                        <textarea class="form-control" name="support_ticket_desc"  rows="3"></textarea>
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
            </div>--}}

            <!-- Add Modal Ends -->

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead >
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Employee')}}</th>
                        <th>{{__('Department')}}</th>
                        <th>{{__('Priority')}}</th>
                        <th>{{__('Subject')}}</th>
                        <th>{{__('Ticket Note')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Ticket Attachments')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($support_tickets as $support_tickets_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$support_tickets_value->first_name.' '.$support_tickets_value->last_name}}</td>
                            <td>{{$support_tickets_value->department_name}}</td>
                            <td>{{$support_tickets_value->support_ticket_priority}}</td>
                            <td>{{$support_tickets_value->support_ticket_subject}}</td>
                            <td>{{$support_tickets_value->support_ticket_note}}</td>
                            <td>{{$support_tickets_value->support_ticket_date}}</td>
                            <td><a href="{{asset($support_tickets_value->support_ticket_attachment)}}" download>Download</a></td>
                            <td>{{$support_tickets_value->support_ticket_desc}}</td>
                            <td>@if($support_tickets_value->support_ticket_status == 'Opened')<span class="rounded" style="background-color:#3495ce;">Opened<span>@elseif($support_tickets_value->support_ticket_status == 'Pending')<span class="rounded" style="background-color:#34cea7;">Pending<span>@else<span class="rounded" style="background-color:#dc3545; color:white;">Closed<span>@endif</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{$support_tickets_value->id}}">Edit</a>
                                @if((Auth::user()->company_profile == 'Yes'))
                                <a href="{{route('delete-employee-support-tickets',['id'=>$support_tickets_value->id])}}" class="btn btn-danger delete-post">Delete</a>
                                @endif
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
                     
                            <div class="col-md-6 form-group">
                                <label>Priority</label>
                                <select class="form-control" name="support_ticket_priority"  id="support_ticket_priority" required>
                                    <option value="">Select-a-Priority</option>
                                    <option value="Critical">Critical</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                            
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Subject</label>
                                <input type="text" name="support_ticket_subject" id="support_ticket_subject" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ticket Note</label>
                                <input type="text" name="support_ticket_note" id="support_ticket_note" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ticket Date</label>
                                <input type="text" name="support_ticket_date" id="support_ticket_date" class="form-control date" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ticket Attachments</label>
                                <input type="file" name="support_ticket_attachment" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="support_ticket_desc"  id="support_ticket_desc" rows="5"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Ticket Status</label>
                                <select class="form-control" name="support_ticket_status"  id="support_ticket_status" required>
                                    <option value="">Select-a-Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Opened">Opened</option>
                                    <option value="Closed">Closed</option>
                            
                                </select>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
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
                    url: 'employee-support-ticket-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#edit_support_ticket_department_id').val(res.support_ticket_department_id);
                    $('#edit_support_ticket_employee_id').val(res.support_ticket_employee_id);
                    $('#support_ticket_priority').val(res.support_ticket_priority);
                    $('#support_ticket_subject').val(res.support_ticket_subject);
                    $('#support_ticket_note').val(res.support_ticket_note);
                    $('#support_ticket_date').val(res.support_ticket_date);
                    $('#support_ticket_desc').val(res.support_ticket_desc);
                    $('#support_ticket_status').val(res.support_ticket_status);
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
                    url: `/update-employee-support-ticket`,
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



            $('#support_ticket_department_id').on('change', function() {
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
                            $('#support_ticket_employee_id').empty();
                            $('#support_ticket_employee_id').append('<option hidden>Choose an Employee</option>'); 
                            $.each(data, function(key, employees){
                                $('select[name="support_ticket_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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

            $('#edit_support_ticket_department_id').on('change', function() {
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
                            $('#edit_support_ticket_employee_id').empty();
                            $('#edit_support_ticket_employee_id').append('<option hidden>Choose an Employee</option>'); 
                            $.each(data, function(key, employees){
                                $('select[name="edit_support_ticket_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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
           



  } );


</script>


@endsection
















