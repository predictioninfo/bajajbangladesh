@extends('back-end.premium.layout.employee-setting-main')
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
            
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Allowance List')}} </h1>
                </div>
            </div>

        </div>


        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('House Rent')}}</th>
                        <th>{{__('Conveyance')}}</th>
                        <th>{{__('Medical')}}</th>
                        <th>{{__('Total')}}</th>
                    </tr>
                </thead>
                <tbody>
				@php($i=1)
                        @foreach($user_salary_configs as $user_salary_configs_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user_house_rent_allowance = ($user_gross_salaries_value*$user_salary_configs_value->salary_config_house_rent_allowance)/100}}</td>
                            <td>{{$user_convayance_allowance = ($user_gross_salaries_value*$user_salary_configs_value->salary_config_conveyance_allowance)/100}}</td>
                            <td>{{$user_medical_allowance = ($user_gross_salaries_value*$user_salary_configs_value->salary_config_medical_allowance)/100}}</td>
                            <td>{{$user_total_allowance = $user_house_rent_allowance + $user_convayance_allowance + $user_medical_allowance}}</td>
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
















