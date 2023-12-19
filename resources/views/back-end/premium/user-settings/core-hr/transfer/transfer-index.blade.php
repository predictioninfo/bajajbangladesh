@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
 ?>

    <section class="main-contant-section">

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Transfer List')}} </h1>
            </div>
        </div>


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
                            <td><?php foreach($employee_names as $employee_names_value){ echo $employee_names_value->first_name.' '.$employee_names_value->last_name;} ?></td>
                            <td><?php foreach($from_department_names as $from_department_names_value){ echo $from_department_names_value->department_name;} ?></td>
                            <td><?php foreach($to_department_names as $to_department_names_value){ echo $to_department_names_value->department_name;} ?></td>
                            <td><?php foreach($to_designation_names as $to_designation_names_value){ echo $to_designation_names_value->designation_name;} ?></td>
                            <td>{{$transfers_value->transfer_date}}</td>
                            <td>{{$transfers_value->transfer_desc}}</td>
                        </tr>
                        @endforeach


                </tbody>

            </table>

        </div>
        </div>
    </section>



<script type="text/javascript">

$(document).ready( function () {


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



  } );


</script>



@endsection
















