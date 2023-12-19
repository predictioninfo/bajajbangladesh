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
                <h1 class="card-title text-center"> {{ __('Termination List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Termination </a></li>
                </ol>
            </div>
        </div>



        {{-- <div class="d-flex flex-row">

            @if($delete_permission == 'Yes')
            <div class="p-2">
                <form method="post" action="{{route('bulk-delete-terminations')}}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
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
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Termination')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('add-terminations')}}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="termination_department_id"
                                    id="termination_department_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach($departments as $departments_value)
                                    <option value="{{$departments_value->id}}">{{$departments_value->department_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                                <select class="form-control" name="termination_employee_id"
                                    id="termination_employee_id"></select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Termination Type</label>
                                <select class="form-control" name="termination_type" required>
                                    <option value="">Select-An-Termination-Type</option>
                                    @foreach($termination_types as $termination_types_value)
                                    <option value="{{$termination_types_value->variable_type_name}}">
                                        {{$termination_types_value->variable_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group check-box">
                                <input type="checkbox" class="form-check-input" name="poor_performance" value="1">
                                <label><strong>Poor Performance
                                    </strong></label>
                            </div>
                            <div class="col-md-3 form-group check-box">
                                <input type="checkbox" class="form-check-input" name="integrity_problem" value="1">
                                <label><strong>Integrity Problem
                                    </strong></label>
                            </div>
                            <div class="col-md-4 form-group check-box">
                                <input type="checkbox" class="form-check-input" name="habitual_absent_attendance"
                                    value="1">
                                <label><strong>Habitual Absent/attendance
                                    </strong></label>
                            </div>
                            <div class="col-md-3 form-group check-box">
                                <input type="checkbox" class="form-check-input" name="indecent_behavior" value="1">
                                <label><strong>Indecent Behavior
                                    </strong></label>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="" class="text-bold">
                                    Repalace Employee Name
                                </label>
                                <select name="termination_replace_employee_id" id="replace_employee"
                                    class="form-control selectpicker region" data-live-search="true"
                                    data-live-search-style="begins" data-dependent="area_name"
                                    title="{{__('Selecting Repalace Employee Name')}}...">
                                    @foreach($inactive_employees as $inactive_users)
                                    <option value="{{$inactive_users->id}}">{{$inactive_users->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Termination Date</label>
                                <input type="date" name="termination_date" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Notice Date</label>
                                <input type="date" name="termination_notice_date" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea id="my-textarea" class="form-control" name="termination_desc"
                                    rows="3"></textarea>
                            </div>
                            <div class="col-sm-12 mt-4">
                            <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button> 
                                <!-- <input type="submit" name="action_button" class="btn btn-primary btn-block"
                                    value="{{__('Add')}}" /> -->

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
                    <th>{{__('SL')}}</th>
                    <th>{{__('Employee')}}</th>
                    <th>{{__('Department')}}</th>
                    <th>{{__('Termination Type')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Termination Date')}}</th>
                    <th>{{__('Notice Date')}}</th>
                    <th>{{__('Poor Performance')}}</th>
                    <th>{{__('Integrity Problem')}}</th>
                    <th>{{__('Habitual Absent/attendance')}}</th>
                    <th>{{__('Indecent Behavior')}}</th>
                    <th>{{__('Download')}}</th>
                    @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                    <th>{{__('Action')}}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($terminations as $terminations_value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$terminations_value->first_name.' '.$terminations_value->last_name}}</td>
                    <td>{{$terminations_value->department_name}}</td>
                    <td>{{$terminations_value->termination_type}}</td>
                    <td>{{$terminations_value->termination_desc}}</td>
                    <td>{{$terminations_value->termination_date}}</td>
                    <td>{{$terminations_value->termination_notice_date ?? null}}</td>
                    <td>{{$terminations_value->poor_performance ?? null}}</td>
                    <td>{{$terminations_value->integrity_problem ?? null}}</td>
                    <td>{{$terminations_value->habitual_absent_attendance ?? null}}</td>
                    <td>{{$terminations_value->indecent_behavior ?? null}}</td>
                    <td>
                        <form method="post"
                            action="{{route('termination-letter-downloads',['id'=>$terminations_value->id])}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$terminations_value->id}}">
                            <button type="submit">{{__('Download')}}</button>
                        </form>
                    </td>
                    @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                    <td>
                        @if($edit_permission == 'Yes')
                        <a href="javascript:void(0)" class="btn editModal edit"
                            data-id="{{$terminations_value->id}}" data-toggle="tooltip" title=""
                            data-original-title=" Edit "><i class="fa fa-edit"></i></a>
                        @endif
                        @if($delete_permission == 'Yes')
                        <a href="{{route('delete-terminations',['id'=>$terminations_value->id])}}"
                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                            data-original-title=" Delete "><i class="fa fa-trash"></i></a>
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
                <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Department</label>
                            <select class="form-control" name="edit_termination_department_id"
                                id="edit_termination_department_id" required>
                                <option value="">Select-a-Department</option>
                                @foreach($departments as $departments_value)
                                <option value="{{$departments_value->id}}">{{$departments_value->department_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-bold">{{__('Employee')}} <span class="text-danger">*</span></label>
                            <select class="form-control" name="edit_termination_employee_id"
                                id="edit_termination_employee_id"></select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Termination Type</label>
                            <select class="form-control" name="termination_type" id="termination_type" required>
                                <option value="">Select-An-Termination-Type</option>
                                @foreach($termination_types as $termination_types_value)
                                <option value="{{$termination_types_value->variable_type_name}}">
                                    {{$termination_types_value->variable_type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                        </div>
                        <div class="col-md-3 form-group check-box">
                            <input type="checkbox" class="form-check-input" name="poor_performance" value="1">
                            <label><strong>Poor Performance
                                </strong></label>
                        </div>
                        <div class="col-md-3 form-group check-box">
                            <input type="checkbox" class="form-check-input" name="integrity_problem" value="1">
                            <label><strong>Integrity Problem
                                </strong></label>
                        </div>
                        <div class="col-md-3 form-group check-box">
                            <input type="checkbox" class="form-check-input" name="habitual_absent_attendance" value="1">
                            <label><strong>Habitual Absent/attendance
                                </strong></label>
                        </div>
                        <div class="col-md-3 form-group check-box">
                            <input type="checkbox" class="form-check-input" name="indecent_behavior" value="1">
                            <label><strong>Indecent Behavior
                                </strong></label>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="" class="text-bold">
                                Repalace Employee Name
                            </label>
                            <select name="termination_replace_employee_id" id="replace_employee"
                                class="form-control selectpicker region" data-live-search="true"
                                data-live-search-style="begins" data-dependent="area_name"
                                title="{{__('Selecting Repalace Employee Name')}}...">
                                @foreach($inactive_employees as $inactive_users)
                                <option value="{{$inactive_users->id}}">{{$inactive_users->first_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Termination Date</label>
                            <input type="date" name="termination_date" id="termination_date" class="form-control"
                                value="">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Notice Date</label>
                            <input type="date" name="termination_notice_date" id="termination_notice_date"
                                class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="my-textarea">Description</label>
                            <textarea class="form-control" name="termination_desc" id="termination_desc"
                                rows="3"></textarea>
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

             $('.editModal').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'termination-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#edit_termination_department_id').val(res.termination_department_id);
                    $('#termination_type').val(res.termination_type);
                    $('#termination_desc').val(res.termination_desc);
                    $('#termination_date').val(res.termination_date);
                    $('#termination_notice_date').val(res.termination_notice_date);
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
                    url: `/update-termination`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                    toastr.success(response.success, 'Data successfully updated!!');
                    window.location.reload(true);
                },
                error: function(response) {
                    toastr.error(response.error, 'Please Entry Valid Data!!');

                }
                });
            });

            // edit form submission ends



            $('#termination_department_id').on('change', function() {
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
                            $('#termination_employee_id').empty();
                            $('#termination_employee_id').append('<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="termination_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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

            $('#edit_termination_department_id').on('change', function() {
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
                            $('#edit_termination_employee_id').empty();
                            $('#edit_termination_employee_id').append('<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="edit_termination_employee_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
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
