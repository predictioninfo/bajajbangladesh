@extends('back-end.premium.layout.premium-main')
@section('content')

<section class="main-contant-section">

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
                <h1 class="card-title text-center"> {{ __('Add New Objectives') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="{{ route('objectives-type-configs') }}"><span
                                class="icon icon-list"> </span> List</a></li>
                    <li><a href="#">Add - {{ 'Objectives' }} </a></li>
                </ol>
            </div>
        </div>


        <div class="objective-contant">
            <div class="row">
                <div class="col-md-12">
                    <div id="Objective" class="">
                       <div class="content-box">
                            <form method="post" action="{{route('add-objective-type-configs')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="select_depertment row">
                                    <select class="form-control col-md-4" name="obj_config_mas_dep_id" id="obj_config_dept_id">
                                        <option>Choose a Department</option>
                                        @foreach($departments as $departments_value)
                                        <option value="{{$departments_value->id}}">{{$departments_value->department_name}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control col-md-4" name="obj_config_mas_dis_id" id="obj_config_desig_id"></select>
                                </div>
                                <table class="form-table objective" id="Objective_plan">


                                </table>

                                <div class="mt-4">
                                    <a href="{{ route('objective-type-creates') }}" class="btn btn-danger" aria-expanded="true">Reset</a>
                                    &nbsp;
                                    <button type="submit" id="abcd" class="btn btn-grad ladda-button"
                                        data-style="expand-right"><span class="ladda-label">
                                            Save </span><span class="ladda-spinner"></span></button>
                                </div>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>

</section>


<script>

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


            $('#obj_config_desig_id').on('change', function() {
                 $.ajax({
                    url: '/objective-type',
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        if (data) {
                            $('.objective').empty();
                            $.each(data, function(key, objective_types) {
                             console.log(objective_types.id);
                                $('.objective').prepend(`
                                 <tr>
                                    <td  name="obj_config_obj_typ_id[]" >
                                        ${objective_types.objective_type_name}
                                    </td>
                                    <input type="hidden"  class="form-control" name="obj_config_obj_typ_id[]" value="${objective_types.id}">
                                        <td><input type="number"  name="obj_config_percent[]" class="form-control persentage per" id="obj_config_percent"  value="" placeholder="Percentage(%)" required /></td>

                                        @foreach($objective_points as $objective_point)
                                            <input type="hidden"  class="form-control totalPoint" value="{{$objective_point->objective_point_config_point_number}}">
                                        @endforeach



                                        <td><input type="number" name="obj_config_target_point[]" id="obj_config_target_point" value="" class="form-control targetPoint" placeholder="Target Point" required /></td>
                                        <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>

                                    </tr>
                               `);
                            });
                        } else {
                            $('#objective_types').empty();
                        }
                    }
                });

        });

        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
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

        $(document).on('keyup', '.per', function() {
            var total_persentage = 0;
            $('.persentage').each(function(i, e) {
                var total_persent = parseFloat($(this).val() - 0);
                total_persentage += total_persent;
                console.log(total_persentage);
            });
            if(100 < total_persentage){
                    $(this).val(0);
                    Swal.fire('Warning!', "Total Persentage cann't greater then 100%!", 'warning');
        }

});

</script>

@endsection
















