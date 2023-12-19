@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
use App\Models\User;
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
                @if((Auth::user()->company_profile == 'Yes'))
                <button type="button" class="edit-btn btn btn-secondary mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Add Task')}}</button>
                @endif


        </div>

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Task List')}} </h1>
            </div>
        </div>
            <!-- Add Modal Starts -->

            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Task')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-employee-tasks')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" class="form-control" name="task_assigned_to[]" value="{{Session::get('employee_setup_id')}}">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Title</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-text-height" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="task_title" placeholder="10" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Start Date</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="task_start_date" placeholder="10" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                        <label>End Date</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="task_end_date" placeholder="10" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                        <label>Task Progress</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-spinner" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="task_progress" placeholder="1" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                        <!-- <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/> -->

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
                        <th>{{__('Title')}}</th>
                        <th>{{__('Assigned To')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                        <th>{{__('Assigned By')}}</th>
                        <th>{{__('Task Progress')}}</th>
                        @if((Auth::user()->company_profile == 'Yes'))
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($tasks as $tasks_value)
                        @foreach(json_decode($tasks_value->task_assigned_to) as $test)
                        @if($test == Session::get('employee_setup_id'))
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$tasks_value->task_title}}</td>
                            <td>
                            @foreach(json_decode($tasks_value->task_assigned_to) as $test)
                            <?php
                            $users = User::where('id',$test)->get(['first_name','last_name']);
                            foreach($users as $users_data){
                            echo $users_data->first_name.' '.$users_data->last_name.'<br>';
                            }
                            ?>
                            @endforeach
                            </td>
                            <td>{{$tasks_value->task_start_date}}</td>
                            <td>{{$tasks_value->task_end_date}}</td>
                            <td>{{$tasks_value->taskassingedby->first_name ?? null}} {{$tasks_value->taskassingedby->last_name ?? null}}</td>
                            <td>{{$tasks_value->task_progress}}</td>
                            @if((Auth::user()->company_profile == 'Yes'))
                            <td>
                                <a href="#" class="btn  edit"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                <a href="#" class="btn delete delete-post"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
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

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'salary-config-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#salary_config_basic_salary').val(res.salary_config_basic_salary);
                    $('#salary_config_house_rent_allowance').val(res.salary_config_house_rent_allowance);
                    $('#salary_config_conveyance_allowance').val(res.salary_config_conveyance_allowance);
                    $('#salary_config_medical_allowance').val(res.salary_config_medical_allowance);
                    $('#salary_config_festival_bonus').val(res.salary_config_festival_bonus);
                    $('#salary_config_provident_fund').val(res.salary_config_provident_fund);
                    $('#salary_config_festival_bonus_active_period').val(res.salary_config_festival_bonus_active_period);
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
                    url: `/update-salary-config`,
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
















