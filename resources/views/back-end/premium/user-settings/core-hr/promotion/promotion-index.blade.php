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
                <h1 class="card-title text-center"> {{__('Promotion List')}} </h1>
            </div>
        </div>

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Employee')}}</th>
                        <th>{{__('Old Department')}}</th>
                        <th>{{__('New Department')}}</th>
                        <th>{{__('Old Designation')}}</th>
                        <th>{{__('New Designation')}}</th>
                        <th>{{__('Old Gross Salary')}}</th>
                        <th>{{__('New Gross Salary')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Promotion Date')}}</th>
                        {{-- <th>{{__('Action')}}</th> --}}
                    </tr>
                </thead>
                <tbody>
				        @php($i=1)
                        @foreach($promotions as $promotions_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <?php
                             $employee_name = User::where('id',$promotions_value->promotion_employee_id)->get(['first_name','last_name']);
                             $old_department_name = Department::where('id',$promotions_value->promotion_old_department)->get(['department_name']);
                             $new_department_name = Department::where('id',$promotions_value->promotion_new_department)->get(['department_name']);
                             $old_designation_name = Designation::where('id',$promotions_value->promotion_old_designation)->get(['designation_name']);
                             $new_designation_name = Designation::where('id',$promotions_value->promotion_new_designation)->get(['designation_name']);
                            ?>
                            <td><?php foreach($employee_name as $employee_name_value){echo $employee_name_value->first_name.' '.$employee_name_value->last_name;} ?></td>
                            <td><?php foreach($old_department_name as $old_department_name_value){echo $old_department_name_value->department_name;} ?></td>
                            <td><?php foreach($new_department_name as $new_department_name_value){echo $new_department_name_value->department_name;} ?></td>
                            <td><?php foreach($old_designation_name as $old_designation_name_value){echo $old_designation_name_value->designation_name;} ?></td>
                            <td><?php foreach($new_designation_name as $new_designation_name_value){echo $new_designation_name_value->designation_name;} ?></td>
                            <td>{{$promotions_value->promotion_old_gross_salary}}</td>
                            <td>{{$promotions_value->promotion_new_gross_salary}}</td>
                            <td>{{$promotions_value->promotion_title}}</td>
                            <td>{{$promotions_value->promotion_date}}</td>
                            {{-- <td>
                                <form method="post" action="{{route('promotion-letter-downloads')}}" >
                                     @csrf
                                     <input type="hidden"  name="id" value="{{$promotions_value->id}}" required>
                                     <button type="submit">{{__('Download')}}</button>
                                </form>
                            </td> --}}
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


  } );


</script>



@endsection
















