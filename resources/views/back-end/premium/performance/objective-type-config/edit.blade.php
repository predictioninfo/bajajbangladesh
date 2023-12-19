@extends('back-end.premium.layout.premium-main')
@section('content')
<section class="main-contant-section">
   <div class="mb-0">
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


<div class="card mb-0">
    <div class="card-header with-border">
        <h1 class="card-title text-center"> {{ __('Edit Objectives') }} </h1>
        <ol id="breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
            <li><a href="{{ route('objectives-type-configs') }}"><span
                        class="icon icon-list"> </span> List</a></li>
            <li><a href="#">Edit - {{ 'Objectives' }} </a></li>
        </ol>
    </div>
</div>

<form method="post" action="{{route('update-objective-type-configs',  $detailsObjective->id)}}" class="form-horizontal" enctype="multipart/form-data">
   @csrf
   <div class="">
      <div class="objective-contant">
         <div class="row">
            <div class="col-md-12">
               <div id="Objective" class="">
                  <div class="content-box">
                     <div class="select_depertment row">
                        <select class="form-control col-md-4" name="obj_config_mas_dep_id" id="obj_config_dept_id">
                           <option>Choose a Department</option>
                           @foreach($departments as $departments_value)
                           <option value="{{ $departments_value->id }}"
                           {{ $detailsObjective->obj_config_mas_dep_id == $departments_value->id ? 'selected' : '' }}>
                           {{ $departments_value->department_name }}</option>
                           @endforeach
                        </select>
                        <select class="form-control col-md-4" name="obj_config_mas_dis_id" id="obj_config_desig_id">
                        @foreach($designations as $designations_value)
                        <option value="{{ $designations_value->id }}"
                        {{ $detailsObjective->obj_config_mas_dis_id == $designations_value->id ? 'selected' : '' }}>
                        {{ $designations_value->designation_name }}</option>
                        @endforeach
                        </select>
                     </div>

                     <table class="form-table" id="Objective_plan">
                     @foreach ($detailsObjectiveTypes as $value)
                        <tr>
                           @foreach($objective_points as $objective_point)
                           <input type="hidden"  class="form-control totalPoint" value="{{$objective_point->objective_point_config_point_number}}">
                           @endforeach
                           <td>{{$value->userobjectivetypefromobjectiveconfig->objective_type_name}}</td>
                           <input type="hidden"  name="obj_config_obj_typ_id[]" value="{{ $value->userobjectivetypefromobjectiveconfig->id }}"/>
                           <td><input type="number"  name="obj_config_percent[]" class="form-control persentage per" id="obj_config_percent" value="{{$value->obj_config_percent}}" placeholder="Percentage(%)" required /></td>
                           <td><input type="number" name="obj_config_target_point[]" id="obj_config_target_point" value="{{$value->obj_config_target_point}}" class="form-control targetPoint" placeholder="Target Point" required /></td>
                           <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i
                              class="fa fa-minus" aria-hidden="true"></i></a> </td>
                        </tr>
                        @endforeach
                     </table>

                     <div class="mt-4">
                        <button type="submit" id="abcd" class="btn btn-grad ladda-button" data-style="expand-right"><span class="ladda-label">
                        Save </span><span class="ladda-spinner"></span></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
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
                                $('select[name="obj_config_mas_dis_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
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

           $(document).on('keyup', '.targetPoint', function() {
           var targetPoint = parseFloat($(this).val() - 0);
           var totalPoint = parseFloat($(".totalPoint").val() - 0);
           if (totalPoint > targetPoint) {
               $(this).removeClass("border border-danger");
               $(this).addClass("border border-success");
           } else if (totalPoint < targetPoint) {
               Swal.fire('Warning!', 'Target Point Can not Grater Then Maximum Point.', 'warning');
               $(this).val(totalPoint);
               $(this).removeClass("border border-success");
               $(this).addClass("border border-danger");
           }

       });

       $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });

   $(document).on('keyup', '.per', function() {
       var total_persentage = 0;
       $('.persentage').each(function(i, e) {
           var total_persent = parseFloat($(this).val() - 0);
           total_persentage += total_persent;

           console.log(total_persentage);
       });

       if(100 < total_persentage){
               $(this).val(0);
                   Swal.fire('Warning!', "Total Persentage should be less than or equal!", 'warning');
               }

       });

   } );


</script>
@endsection
