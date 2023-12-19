
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

    <div class="card mb-0">
        <div class="card-header with-border">
            <h1 class="card-title text-center"> {{ __('Approve Travel Request list') }} </h1>
            <nav aria-label="breadcrumb">

                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">List - Travel Request </a></li>
                </ol>

            </nav>
        </div>
    </div>

</div>

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
                <th>{{__('Action')}}</th>

            </tr>
        </thead>
        <tbody>
                @php($i=1)
                @foreach($travels as $travels_value)
                <tr>
                {{-- @if($travels_value->travel_status != 'Approved') --}}
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
                    <td>{{$travels_value->travel_status}}</td>
                    <td>
                            <a href="javascript:void(0)" class="btn editTravel view" data-id="{{$travels_value->id}}" data-toggle="tooltip"
                                title=" Approve " data-original-title="Approve"><i
                                    class="fa fa-check" aria-hidden="true"></i></a>

                             <a href="{{route('delete-travels',['id'=>$travels_value->id])}}" class="btn btn-danger delete-post" data-toggle="tooltip"
                                title=" Delete " data-original-title="Delete"> <i class="fa fa-trash-o"
                                aria-hidden="true"></i></a>

                    </td>

                </tr>


<!-- edit boostrap model -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="ajaxModelTitle"></h4>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('update-travels')}}"  class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $travels_value->id }}">
                <input type="hidden" name="edit_travel_department_id"  value="{{ $travels_value->travel_department_id  }}">
                <input type="hidden" name="edit_travel_employee_id"  value="{{ $travels_value->travel_employee_id  }}">
                <input type="hidden" name="travel_arrangement_type"  value="{{ $travels_value->travel_arrangement_type }}">
                <input type="hidden" name="travel_purpose"  value="{{ $travels_value->travel_purpose }}">
                <input type="hidden" name="travel_place"  value="{{ $travels_value->travel_place }}">
                <input type="hidden" name="travel_desc"  value="{{ $travels_value->travel_desc }}">
                <input type="hidden" name="travel_start_date"  value="{{ $travels_value->travel_start_date }}">
                <input type="hidden" name="travel_end_date"  value="{{ $travels_value->travel_end_date  }}">
                <input type="hidden" name="travel_expected_budget"  value="{{ $travels_value->travel_expected_budget }}">
                <div class="row">

                    <div class="col-md-12">
                        <div class="input-group mb-3">
                        <label>Actual Budget</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i> </span>
                            </div>
                            <input type="text" name="travel_actual_budget" id="travel_actual_budget" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
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
                    <div class="col-md-12 form-group">
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

     $('.editTravel').on('click', function () {
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





} );


</script>










@endsection
