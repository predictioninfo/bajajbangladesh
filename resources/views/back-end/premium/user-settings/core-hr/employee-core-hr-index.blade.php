@extends('back-end.premium.layout.employee-setting-main')
@section('content')


    <section>


        <div class="container-fluid mb-3">

            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
          
                <button type="button" class="edit-btn btn btn-secondary mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Add Salary Config')}}</button>
           
        </div>


            <!-- Add Modal Starts -->

            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color:#61c597;">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Salary Config')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-salary-configs')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Basic Salary(%)</label>
                                        <input type="text" name="salary_config_basic_salary" placeholder="10" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>House Rent Allowance(%)</label>
                                        <input type="text" name="salary_config_house_rent_allowance" placeholder="10" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Medical Allowance(%)</label>
                                        <input type="text" name="salary_config_medical_allowance" placeholder="10" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Conveyance Allowance(%)</label>
                                        <input type="text" name="salary_config_conveyance_allowance" placeholder="10" class="form-control" value="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Festival Bonus(%)</label>
                                        <input type="text" name="salary_config_festival_bonus" placeholder="10" class="form-control" value="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Festival Bonus Active Period(Month)</label>
                                        <input type="text" name="salary_config_festival_bonus_active_period" placeholder="1" class="form-control" value="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Provident Found(%)</label>
                                        <input type="text" name="salary_config_provident_fund" placeholder="10" class="form-control" value="">
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

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#20898f; color:white;">
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Basic Salary (%)')}}</th>
                        <th>{{__('House Rent Allowance Salary (%)')}}</th>
                        <th>{{__('Conveyance Allowance Percentage (%)')}}</th>
                        <th>{{__('Medical Allowance Percentage (%)')}}</th>
                        <th>{{__('Festival Bonus Percentage (%)')}}</th>
                        <th>{{__('Provident Fund Percentage (%)')}}</th>
                        <th>{{__('Festival Bonus Active Period Percentage (%)')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
				{{--@php($i=1)
                        @foreach($salary_configs as $salary_configs_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$salary_configs_value->salary_config_basic_salary}}</td>
                            <td>{{$salary_configs_value->salary_config_house_rent_allowance}}</td>
                            <td>{{$salary_configs_value->salary_config_conveyance_allowance}}</td>
                            <td>{{$salary_configs_value->salary_config_medical_allowance}}</td>
                            <td>{{$salary_configs_value->salary_config_festival_bonus}}</td>
                            <td>{{$salary_configs_value->salary_config_provident_fund}}</td>
                            <td>{{$salary_configs_value->salary_config_festival_bonus_active_period}}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-primary edit" data-id="{{$salary_configs_value->id}}">Edit</a>
                                <a href="{{route('delete-salary-configs',['id'=>$salary_configs_value->id])}}" class="btn btn-danger delete-post">Delete</a>
                            </td>                        
                        </tr>
                        @endforeach
				--}}
                </tbody>

            </table>

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
                                <label>Basic Salary(%)</label>
                                <input type="text" name="salary_config_basic_salary" id="salary_config_basic_salary" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>House Rent Allowance(%)</label>
                                <input type="text" name="salary_config_house_rent_allowance" id="salary_config_house_rent_allowance" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Medical Allowance(%)</label>
                                <input type="text" name="salary_config_medical_allowance" id="salary_config_medical_allowance" class="form-control" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Conveyance Allowance(%)</label>
                                <input type="text" name="salary_config_conveyance_allowance" id="salary_config_conveyance_allowance" class="form-control" value="">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Festival Bonus(%)</label>
                                <input type="text" name="salary_config_festival_bonus" id="salary_config_festival_bonus" class="form-control" value="">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Festival Bonus Active Period(Month)</label>
                                <input type="text" name="salary_config_festival_bonus_active_period" id="salary_config_festival_bonus_active_period" class="form-control" value="">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Provident Found(%)</label>
                                <input type="text" name="salary_config_provident_fund" id="salary_config_provident_fund" class="form-control" value="">
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
















