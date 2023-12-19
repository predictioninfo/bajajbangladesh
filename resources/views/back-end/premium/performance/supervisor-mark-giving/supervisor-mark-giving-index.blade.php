@extends('back-end.premium.layout.premium-main')
@section('content')

<?php 
                    
use App\Models\ObjectiveTypeConfig;
use App\Models\ObjectiveType;
use App\Models\Objective;

$date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
$current_date = $date->format('Y-m-d');
$current_month = $date->format('m');
$current_year = $date->format('Y');
$current_day= $date->format('d');

?>
<section class="main-contant-section">
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> Performance Review </h1>
            </div>
        </div>

            @if(Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            @if($message)
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
<div class="content-box">

<div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="5">The objectives that have been cascaded to you by your supervisor for the year. Here is the SMART(Specific, Measurable, Achievable, Realistic, Time Based) objectives in each section.</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Individual Objectives with Timeline</th>
                    <th>Measures of Success</th>
                    <th>Actions Taken by Employee</th>
                    <th>Supervisor Comments</th>
                    <th>Supervisor Markings(this portion will be filled at the last review of the year.)</th>
                </tr>
            </thead>
            <tbody>
                
            @foreach($objective_type_configs as $objective_type_configs_value)
                @if(Objective::where('objective_emp_id',$em_id)->where('objective_desig_id',$em_designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->exists())
                <?php  
                $objectives = Objective::where('objective_emp_id',$em_id)->where('objective_desig_id',$em_designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->get();
                ?>
                <th colspan="4">{{$objective_type_configs_value->userobjectivetypefromobjectiveconfig->objective_type_name}}({{$objective_type_configs_value->obj_config_percent ?? null}}%)</th>
                @foreach($objectives as $objectives_value)
                <tr>
                    <td><a href="{{route('key-wise-goal-trackings',['slug'=>$objectives_value->objective_slug])}}">{{$objectives_value->objective_name}}</a></td>
                    <td>{{$objectives_value->objective_success}}</td>
                    <td>{{$objectives_value->objective_emp_actn}} <a href="javascript:void(0)" class="edit-by-employee" data-id="{{$objectives_value->id}}" style="float: right;"><i class="fa fa-edit"></i></a></td>
                    <td>{{$objectives_value->objective_sprvisr_cmnt}}<a href="javascript:void(0)" class="edit-for-supervisor-comment" data-id="{{$objectives_value->id}}" style="float: right;"><i class="fa fa-edit"></i></a></td>
                    <td>{{$objectives_value->objective_sprvisr_mark}} <a href="javascript:void(0)" class="edit-by-supervisor" data-id="{{$objectives_value->id}}" style="float: right;"><i class="fa fa-edit"></i>(out of {{$objective_type_configs_value->obj_config_percent ?? null}})</a></td>
                </tr>
                @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="content-box">

<div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>Objective Type</th>
                    <th>Average Points</th>
                    <th>Objective Type Wise Average Target Points</th>
                </tr>
            </thead>
            <tbody>
            @foreach($objective_type_configs as $objective_type_configs_value)
                @if(Objective::where('objective_emp_id',$em_id)->where('objective_desig_id',$em_designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->exists())
                <?php  
                $objectives = Objective::where('objective_emp_id',$em_id)->where('objective_desig_id',$em_designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->get();
                $objectives_counts = Objective::where('objective_emp_id',$em_id)->where('objective_desig_id',$em_designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->count();
                
                $average_value = 0;
                foreach($objectives as $objectives_value){
                    $average_value += $objectives_value->objective_sprvisr_mark;
                }

                $all_average_value = $average_value/$objectives_counts;

                ?>
                <tr>
                    <td>{{$objective_type_configs_value->userobjectivetypefromobjectiveconfig->objective_type_name}}</td>
                    <td>{{$all_average_value}}</td>
                    <td>{{$objective_type_configs_value->obj_config_target_point}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>

        </table>
    </div>

</div>
<h5>PERFORMANCE CONVERSATION</h5> 


    <!-- edit for employee action boostrap model -->
    <div class="modal fade" id="edit-modal-for-employee" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update-employee-action-objectives')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="em_act_id" required>

                    <input type="hidden" name="em_id" value="{{$em_id}}" required>
                    <input type="hidden" name="em_designation_id" value="{{$em_designation_id}}" required>

                    <div class="row">
                    

                        <div class="col-md-6 form-group">
                            <label class="text-bold">Employee Action</label>
                            <input type="text" name="objective_emp_actn" id="objective_emp_actn" class="form-control" value="">
                        </div>
        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-grad w-50 mt-4">Save changes</button>
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


    <!-- edit for supervisor comments boostrap model -->
    <div class="modal fade" id="edit-modal-for-supervisor-comment" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update-supervisor-comment-objectives')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="svr_cmnt_id" required>
                    <input type="hidden" name="objective_dept_id" id="objective_dept_id_for_sv_cmnts" required>
                    <input type="hidden" name="objective_desig_id" id="objective_desig_id_for_sv_cmnts" required>
                    <input type="hidden" name="objective_obj_type_id" id="objective_obj_type_id_for_sv_cmnts" required>

                    <input type="hidden" name="em_id" value="{{$em_id}}" required>
                    <input type="hidden" name="em_designation_id" value="{{$em_designation_id}}" required>

                    <div class="row">
                    

                        <div class="col-md-6 form-group">
                            <label class="text-bold">Supervisor Comment</label>
                            <input type="text" name="objective_sprvisr_cmnt" id="objective_sprvisr_cmnt" class="form-control" value="">
                        </div>
        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-grad w-50 mt-4">Save changes</button>
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







    <!-- edit for supervisor markings boostrap model -->
    <div class="modal fade" id="edit-modal-for-supervisor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update-supervisor-marking-objectives')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="svr_mark_id" required>
                    <input type="hidden" name="objective_dept_id" id="objective_dept_id_for_sv" required>
                    <input type="hidden" name="objective_desig_id" id="objective_desig_id_for_sv" required>
                    <input type="hidden" name="objective_obj_type_id" id="objective_obj_type_id_for_sv" required>

                    <input type="hidden" name="em_id" value="{{$em_id}}" required>
                    <input type="hidden" name="em_designation_id" value="{{$em_designation_id}}" required>
                    
                    <div class="row">
                    

                        <div class="col-md-6 form-group">
                            <label class="text-bold">Supervisor Marking</label>
                            <input type="text" name="objective_sprvisr_mark" id="objective_sprvisr_mark" class="form-control" value="">
                        </div>
        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-grad w-50 mt-4">Save changes</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
            </div>
        </div>
        </div>
</section>
        <!-- end bootstrap model -->




<script type="text/javascript">

    $(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

            //value retriving and opening the edit modal starts

            $('.edit-by-employee').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'objective-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal-for-employee').modal('show');
                    $('#em_act_id').val(res.id);
                    $('#objective_emp_actn').val(res.objective_emp_actn);
                    }
                });
            });

           //value retriving and opening the edit modal ends









            //value retriving and opening the edit modal starts

            $('.edit-for-supervisor-comment').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'objective-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal-for-supervisor-comment').modal('show');
                    $('#svr_cmnt_id').val(res.id);
                    $('#objective_dept_id_for_sv_cmnts').val(res.objective_dept_id);
                    $('#objective_desig_id_for_sv_cmnts').val(res.objective_desig_id);
                    $('#objective_obj_type_id_for_sv_cmnts').val(res.objective_obj_type_id);
                    $('#objective_sprvisr_cmnt').val(res.objective_sprvisr_cmnt);
                    }
                });
            });

           //value retriving and opening the edit modal ends













            //value retriving and opening the edit modal starts

            $('.edit-by-supervisor').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'objective-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal-for-supervisor').modal('show');
                    $('#svr_mark_id').val(res.id);
                    $('#objective_dept_id_for_sv').val(res.objective_dept_id);
                    $('#objective_desig_id_for_sv').val(res.objective_desig_id);
                    $('#objective_obj_type_id_for_sv').val(res.objective_obj_type_id);
                    $('#objective_sprvisr_mark').val(res.objective_sprvisr_mark);
                    }
                });
            });

           //value retriving and opening the edit modal ends

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
















