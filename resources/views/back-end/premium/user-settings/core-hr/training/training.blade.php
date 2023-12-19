@extends('back-end.premium.layout.employee-setting-main')
@section('content')

<?php
 use App\Models\TrainingType;
?>

    <section class="main-contant-section">

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Training List')}} </h1>
            </div>
        </div>

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>

                        <tr>
                            <th>{{__('SL')}}</th>
                            <th>{{__('Training Type')}}</th>
                            <th>{{__('Trainer Name')}}</th>
                            <th>{{__('Employee Name')}}</th>
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('End Date')}}</th>
                            <th>{{__('Start Time')}}</th>
                            <th>{{__('End Time')}}</th>
                            <th>{{__('Training Cost')}}</th>
                            <th>{{__('Training Attachment')}}</th>
                            <th>{{__('Training Description')}}</th>
                            <th>{{__('Training Status')}}</th>

                        </tr>

                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($trainings as $trainings_value)
                    @foreach(json_decode($trainings_value->training_emp_id) as $test)
                    @if($test == Session::get('employee_setup_id'))
                    <tr>
                        <td>{{$i++}}</td>

                        <?php
                           $trainingType = TrainingType::where('id',$trainings_value->training_tring_typ_id)->get(['training_type']);
                        ?>

                       <td><?php foreach($trainingType as $trainingType_value){echo $trainingType_value->training_type;} ?></td>
                        <td>
                            @foreach($trainers as $trainers_value)
                                @foreach(json_decode($trainings_value->training_trainer_id) as $trainer_indivisual_id)
                                    @if($trainer_indivisual_id == $trainers_value->id)

                                        {{$trainers_value->trainer_first_name}},

                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            @foreach($employees as $employees_value)
                                @foreach(json_decode($trainings_value->training_emp_id) as $employee_indivisual_id)
                                    @if($employee_indivisual_id == $employees_value->id)

                                        {{$employees_value->first_name}},

                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>{{$trainings_value->training_start_date}}</td>
                        <td>{{$trainings_value->training_end_date}}</td>
                        <td>{{$trainings_value->training_start_time}}</td>
                        <td>{{$trainings_value->training_end_time}}</td>
                        <td>{{$trainings_value->training_cost}}</td>
                        <td class="text-center"><a href="{{asset($trainings_value->training_attachmnt)}}" download>Download</a></td>
                        <td>{{$trainings_value->training_desc}}</td>
                        <td>{{$trainings_value->training_status}}</td>

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
















