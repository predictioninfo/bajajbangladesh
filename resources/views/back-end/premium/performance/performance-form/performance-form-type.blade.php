
@extends('back-end.premium.layout.premium-main')
@section('content')

<section class="main-contant-section">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> Objective Section  </h1>
            </div>
        </div>
        <div class="objective-contant">

            @if (Session::get('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
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

        
            <div class="row">
                <div class="col-md-12">
                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'Objective')"> Objective Plan </button>
                        <button class="tablinks" onclick="openCity(event, 'Operational')"> Operational Plan </button>
                    </div>

                    <div id="Objective" class="tabcontent">
                        <form action="">

                            @foreach($objectiveTypeConfigs as $objectiveTypeConfig)
                            <table class="form-table" id="Objective_plan">

                                <tr>
                                    <th colspan="5" class="text-center"> {{$objectiveTypeConfig->userobjectivetypefromobjectiveconfig->objective_type_name}} </th>
                                </tr>

                                <tr valign="top">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                    Individual Objective With Timeline
                                    </th>
                                    <th>
                                    Measures Of Success
                                    </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOB btn"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </table>
                           @endforeach
                            <button type="submit"  class="btn btn-grad "> save </button>
                        </form>
                    </div>

                    <div id="Operational" class="tabcontent">
                        <form action="">
                            <table class="form-table" id="Operational_plan">
                                <tr valign="top">
                                    <th>
                                        SL
                                    </th>
                                    <th>
                                        Development Plan
                                    </th>
                                    <th>
                                        Measures Of Success
                                    </th>
                                    <th>
                                        Action Taken
                                    </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOP btn"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                </tr>
                            </table>

                            <button type="submit"  class="btn btn-grad"> save </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>

$('#objective_dept_id').on('change', function() {
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
                            $('#objective_desig_id').empty();
                            $('#objective_desig_id').append('<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations){
                                $('select[name="objective_desig_id"]').append('<option value="'+ designations.id +'">' + designations.designation_name+ '</option>');
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


            $('#objective_desig_id').on('change', function() {
               var departmentID = $(this).val();
               if(departmentID) {
                   $.ajax({
                       url: '/get-department-wise-employee/'+departmentID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#objective_emp_id').empty();
                            $('#objective_emp_id').append('<option hidden>Choose an Employee</option>');
                            $.each(data, function(key, employees){
                                $('select[name="objective_emp_id"]').append('<option value="'+ employees.id +'">' + employees.first_name+ ' ' + employees.last_name +'</option>');
                            });
                        }else{
                            $('#employees').empty();
                        }
                     }
                   });
               }else{
                 $('#employees').empty();
               }
            });




            $('#objective_emp_id').on('change', function() {
               var employeeID = $(this).val();
               if(employeeID) {
                   $.ajax({
                       url: '/get-objective-type/'+employeeID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#obj_config_target_point').empty();
                            //$('#employee_old_gross_salary').append('<input type="hidden">');
                            $.each(data, function(key, objective_type_configs){
                                $('#obj_config_target_point').append('<th name="obj_config_target_point" class="text-center" colspan="5">' + objective_type_configs.userobjectivetypefromobjectiveconfig.objective_type_name + ' ' + objective_type_configs.obj_config_percent + '</th>');

                            });
                        }else{
                            $('#objective_type_configs').empty();
                        }
                     }
                   });
               }else{
                 $('#objective_type_configs').empty();
               }
            });

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).ready(function(){
        $(".addOB").click(function(){
            $("#Objective_plan").append(`
            <tr valign="top">
                <td> 1 </td>
                <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>
                <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr>
            `);
        });
        $("#Objective_plan").on('click','.remOB',function(){
            $(this).parent().parent().remove();
        });

        $(".addOB1").click(function(){
            $("#Objective_plan1").append(`
            <tr valign="top">
                <td> 1 </td>
                <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>
                <td class="remBtn"> <a href="javascript:void(0);" class="remOB1 btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr>
            `);
        });
        $("#Objective_plan1").on('click','.remOB1',function(){
            $(this).parent().parent().remove();
        });

        $(".addOP").click(function(){
            $("#Operational_plan").append(`
                <tr valign="top">
                    <td> 1 </td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td><input type="text" name="payment_method[]" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Method Name" /></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="methodInfo[]" value="" placeholder="Method Info" /> </td>

                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
            `);
        });
        $("#Operational_plan").on('click','.remOP',function(){
            $(this).parent().parent().remove();
        });

    });


</script>

@endsection
















