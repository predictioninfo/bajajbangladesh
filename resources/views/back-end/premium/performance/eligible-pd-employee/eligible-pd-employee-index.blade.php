@extends('back-end.premium.layout.premium-main')
@section('content')

<?php 
                    
use App\Models\ObjectiveTypeConfig;
use App\Models\ObjectiveType;
use App\Models\Objective;
use App\Models\PromotionApproval;
use App\Models\SeatAllocation;
use App\Models\User;

$date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
$current_date = $date->format('Y-m-d');
$current_month = $date->format('m');
$current_year = $date->format('Y');
$current_day= $date->format('d');

?>
    <section class="main-contant-section">


        <div class="mb-3">

            @if(Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
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
        </div>

<div class="content-box">

<div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Point Earned</th>
                        <th>Promotion Eligibility</th>
                        <th>Demotion Eligibility</th>
                        <th>Vacancy</th>
                        <th>To Department</th>
                        <th>To Designation</th>
                        <th>First Supervisor Approval</th>
                        <th>Second Supervisor Approval</th>
                        <th>P/D Action</th>
                    </tr>
                </thead>
                <tbody>

                @php($i=1)
                <?php 
                 //$earned_points = 0;
                ?>
             
                @foreach($users as $users_value)
                    @if((Objective::where('objective_com_id',Auth::user()->com_id)->where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_fst_sv_id',Auth::user()->id)->orWhere('objective_scnd_sv_id',Auth::user()->id)->whereYear('objective_review_yr', $current_year)->exists()) || (Auth::user()->company_profile == 'Yes'))
                        @if(Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->whereYear('objective_review_yr', $current_year)->exists())

                                <?php  
                                    
                                    $promotion_result_array = [];
                
                                    foreach($objective_type_configs as $objective_type_configs_value){

                                        if(Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->exists()){
                                        
                                            $objectives = Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->get();
                                            $objectives_counts = Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_obj_type_id',$objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->count();
                                            
                                            $average_value = 0;
                                            foreach($objectives as $objectives_value){
                                                $average_value += $objectives_value->objective_sprvisr_mark;
                                            }

                                            $all_average_value = $average_value/$objectives_counts;

                                            if($all_average_value >= $objective_type_configs_value->obj_config_target_point){
                                                array_push($promotion_result_array,1);
                                            }else{
                                                array_push($promotion_result_array,0);
                                            }
                                        }
                                    }

                                    //echo json_encode($promotion_result_array);
                                ?>

                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$objectives_value->userfromobjective->company_assigned_id ?? null}}</td>
                                <td>{{$objectives_value->userfromobjective->first_name ?? null}} {{$objectives_value->userfromobjective->last_name ?? null}}</td>
                                <td>{{$objectives_value->userdepartmentfromobjective->department_name ?? null}}</td>
                                <td>{{$objectives_value->userdesignationfromobjective->designation_name ?? null}}</td>
                                <td>

                                    <?php  
                        
                                        $this_employee_objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id',Auth::user()->com_id)->where('obj_config_dept_id',$users_value->department_id)->where('obj_config_desig_id',$users_value->designation_id)->get();
                                        $all_average_value = 0;
                                        foreach ($this_employee_objective_type_configs as $this_employee_objective_type_configs_value) {
                                            if(Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_obj_type_id',$this_employee_objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->exists()){
                                                $objectives = Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_obj_type_id',$this_employee_objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->get();
                                                $objectives_counts = Objective::where('objective_emp_id',$users_value->id)->where('objective_dept_id',$users_value->department_id)->where('objective_desig_id',$users_value->designation_id)->where('objective_obj_type_id',$this_employee_objective_type_configs_value->obj_config_obj_typ_id)->whereYear('objective_review_yr', $current_year)->count();
                                            
                                                $average_value = 0;
                                                foreach($objectives as $objectives_value){
                                                    $average_value += $objectives_value->objective_sprvisr_mark;
                                                }
                                                $all_average_value += $average_value/$objectives_counts;
                                            }
                                        }
                                        echo $all_average_value;
                                    ?>

                                </td>
                                <td class="text-center">

                                    <?php  
                    
                                        if (in_array(0,$promotion_result_array) || empty($promotion_result_array)) {
                                            //demoted
                                            //skip
                                            $promotion_result = "No";
                                        }else{
                                            //promoted
                                            echo  $promotion_result = "Yes";
                                        }

                                    ?>

                                </td>
                                <td class="text-center">

                                    <?php  

                                        if (in_array(0,$promotion_result_array) || empty($promotion_result_array)) {
                                            //demoted
                                            echo $demotion_result = "Yes";
                                        }else{
                                            //promoted
                                            //skip
                                            echo $demotion_result = "No";
                                        }

                                    ?>

                                </td>
                                <td class="text-center">
                                    <?php 

                                        $vacancies = SeatAllocation::where('seat_allocation_com_id',Auth::user()->com_id)->where('seat_allocation_dpt_id',$objectives_value->objective_dept_id)->where('seat_allocation_desig_id',$objectives_value->objective_desig_id)->take(1)->get();
                                        
                                        foreach($vacancies as $vacancies_value){

                                            $upper_level = $vacancies_value->seat_allocation_desig_level+1;

                                            if(SeatAllocation::where('seat_allocation_com_id',Auth::user()->com_id)->where('seat_allocation_dpt_id',$objectives_value->objective_dept_id)->where('seat_allocation_desig_level',$upper_level)->exists()){
                                            
                                                $level_wise_vacancies = SeatAllocation::where('seat_allocation_com_id',Auth::user()->com_id)->where('seat_allocation_dpt_id',$objectives_value->objective_dept_id)->where('seat_allocation_desig_level',$upper_level)->take(1)->get();

                                                foreach($level_wise_vacancies as $level_wise_vacancies_value){

                                                    if($level_wise_vacancies_value->seat_allocation_alctd_seat){

                                                        echo $available_seats = $level_wise_vacancies_value->seat_allocation_alctd_seat;

                                                        $available_department_name = $level_wise_vacancies_value->userdepartmentfromseatallocation->department_name;
                                                        $available_designation_name = $level_wise_vacancies_value->userdesignationfromseatallocation->designation_name;

                                                        $available_department_id = $level_wise_vacancies_value->seat_allocation_dpt_id;
                                                        $available_designation_id = $level_wise_vacancies_value->seat_allocation_desig_id;

                                                    }else{
                                                        echo $available_seats = 0;
                                                    }
                                            
                                                }

                                            }else{
                                                echo $available_seats = 0;
                                            }

                                        }
                                    ?>
                                </td>
                                <td class="text-center">
                                    {{$objectives_value->userdepartmentfromobjective->department_name ?? null}}
                                </td>
                                <td class="text-center">
                                @if($available_seats <= 0)
                                    {{$objectives_value->userdesignationfromobjective->designation_name ?? null}}
                                @else
                                    {{$available_designation_name}}
                                @endif
                                </td>
                                <td class="text-center">
                                    @if(PromotionApproval::where('prom_aprv_com_id',Auth::user()->com_id)->where('prom_aprv_emp_id',$objectives_value->objective_emp_id)->where('prom_aprv_fst_sv_sts','Yes')->exists())
                                    Yes
                                    @endif
                                

                                    @if(User::where('com_id',Auth::user()->com_id)->where('id',$objectives_value->objective_emp_id)->exists())
                                        <?php 
                                        $employee_details = User::where('com_id',Auth::user()->com_id)->where('id',$objectives_value->objective_emp_id)->get();
                                        ?>
                                        @foreach($employee_details as $employee_details_value)
                                            @if($employee_details_value->report_to_parent_id == Auth::user()->id || (Auth::user()->company_profile == 'Yes'))
                                                <a href="javascript:void(0)" class="first-supervisor-approval" data-id="{{$objectives_value->id}}" style="float: right;"><i class="fa fa-edit"></i></a></td>
                                            @endif
                                        @endforeach
                                    @endif

                                
                                <td class="text-center">    
                                        @if(PromotionApproval::where('prom_aprv_com_id',Auth::user()->com_id)->where('prom_aprv_emp_id',$objectives_value->objective_emp_id)->where('prom_aprv_scnd_sv_sts','Yes')->exists())
                                        Yes
                                        @endif


                                        @if(User::where('com_id',Auth::user()->com_id)->where('id',$objectives_value->objective_emp_id)->exists())
                                            <?php 
                                            $employee_details = User::where('com_id',Auth::user()->com_id)->where('id',$objectives_value->objective_emp_id)->get();
                                            ?>
                                            @foreach($employee_details as $employee_details_value)
                                                <?php 
                                                $generation_two_details = User::where('id','=',$employee_details_value->report_to_parent_id)->get();
                                                ?>
                                                @foreach($generation_two_details as $generation_two_details_value)
                                                    @if($generation_two_details_value->report_to_parent_id == Auth::user()->id || (Auth::user()->company_profile == 'Yes'))
                                                    <a href="javascript:void(0)" class="second-supervisor-approval" data-id="{{$objectives_value->id}}" style="float: right;"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif


                               </td>
                                <td class="text-center">
                                    @if($promotion_result == "Yes")
                                        @if($available_seats >= 1)
                                            @if(PromotionApproval::where('prom_aprv_com_id',Auth::user()->com_id)->where('prom_aprv_emp_id',$objectives_value->objective_emp_id)->where('prom_aprv_fst_sv_sts','Yes')->exists())
                                                @if(PromotionApproval::where('prom_aprv_com_id',Auth::user()->com_id)->where('prom_aprv_emp_id',$objectives_value->objective_emp_id)->where('prom_aprv_scnd_sv_sts','Yes')->exists())

                                    
                                                <a href="#editModal{{$objectives_value->id}}" class="btn btn-primary text-center" data-toggle="modal" class="btn btn-warning" >Give Promotion</a>
                                                {{-- <a href="javascript:void(0)" class="btn btn-primary text-center edit-by-employee" data-id="{{$objectives_value->id}}" style="float: right;">Give Promotion</a> --}}


                                        <!--edit modal-->
                                            <div class="modal fade" id="editModal{{$objectives_value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Promotion Approval</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        
                                                            <form method="POST" action="{{route('promotion-approvals')}}" class="form-horizontal" enctype="multipart/form-data">
                                                                    @csrf
                                                            
                                                                    <input type="text" name="promotion_giving_emp_id" value="{{$objectives_value->objective_emp_id}}" required>
                                                                    <input type="text" name="promotion_giving_old_department_id" value="{{$objectives_value->objective_dept_id}}" required>
                                                                    <input type="text" name="promotion_giving_new_department_id" value="{{$available_department_id}}" required>
                                                                    <input type="text" name="promotion_giving_old_designation_id" value="{{$objectives_value->objective_desig_id}}" required>
                                                                    <input type="text" name="promotion_giving_new_designation_id" value="{{$available_designation_id}}" required>
                                                            
                                                                    <div class="form-group row">
                                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Old Salary') }}</label>
                                                                        <div class="col-md-6">
                                                                            <input id="name" type="text" readonly class="form-control" name="meeting_date"  value="{{$objectives_value->userfromobjective->gross_salary}}" required>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group row">
                                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('New Salary') }}</label>
                                                                        <div class="col-md-6">
                                                                            <input id="name" type="text" class="form-control" name="promotion_giving_new_salary" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Give Promotion</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>  
                                            <!--end - edit modal-->   


                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </td>
                            </tr>
                
                        @endif
                    @endif
                @endforeach
               
                </tbody>
                
            </table>

        </div>
</div>
    </section>

    <!-- edit for the first supervisor approval action boostrap model -->
    <div class="modal fade" id="edit-modal-for-first-supervisor-approval" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitleForFirstSupervisor"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('first-supervisor-promotion-approvals')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="first_sv_approving_id" required>
                    <input type="hidden" name="objective_emp_id" id="objective_emp_id" required>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <h4>Are you sure about approving this employee????</h4>
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-grad">Yes</button>
                            <button type="button" data-dismiss="modal" class="btn btn-danger">No</button>
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

    <!-- edit for the second supervisor approval action boostrap model -->
        <div class="modal fade" id="edit-modal-for-second-supervisor-approval" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ajaxModelTitleForSecondSupervisor"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('second-supervisor-promotion-approvals')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="second_sv_approving_id" required>
                    <input type="hidden" name="objective_emp_id" id="objective_emp_id_for_second_sv" required>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <h4>Are you sure about approving this employee????</h4>
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-grad">Yes</button>
                            <button type="button" data-dismiss="modal" class="btn btn-danger">No</button>
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

            //value retriving and opening the edit modal starts

            $('.first-supervisor-approval').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'objective-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitleForFirstSupervisor').html("Approval");
                    $('#edit-modal-for-first-supervisor-approval').modal('show');
                    $('#first_sv_approving_id').val(res.id);
                    $('#objective_emp_id').val(res.objective_emp_id);
                    }
                });
            });

           //value retriving and opening the edit modal ends

            //value retriving and opening the edit modal starts

            $('.second-supervisor-approval').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'objective-by-id',
                    data: { id: id },
                    dataType: 'json',

                    success: function(res){
                    $('#ajaxModelTitleForSecondSupervisor').html("Approval");
                    $('#edit-modal-for-second-supervisor-approval').modal('show');
                    $('#second_sv_approving_id').val(res.id);
                    $('#objective_emp_id_for_second_sv').val(res.objective_emp_id);
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






           $('#obj_config_dept_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-designation/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#obj_config_desig_id').empty();
                            $('#obj_config_desig_id').append('<option hidden value="">Choose Designation</option>'); 
                            $.each(data, function(key, designations){
                                $('select[name="obj_config_desig_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
                            });
                        }else{
                            $('#designations').empty();
                        }
                     }
                   });
               }else{
                 $('#designations').empty();
               }
            });

            $('#obj_config_dept_id_edit').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-designation/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#obj_config_desig_id_edit').empty();
                            $('#obj_config_desig_id_edit').append('<option hidden value="">Choose Designation</option>'); 
                            $.each(data, function(key, designations){
                                $('select[name="obj_config_desig_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
                            });
                        }else{
                            $('#designations').empty();
                        }
                     }
                   });
               }else{
                 $('#designations').empty();
               }
            });



  } );


</script>



@endsection
















