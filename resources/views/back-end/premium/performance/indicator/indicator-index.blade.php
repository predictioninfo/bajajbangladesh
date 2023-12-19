@extends('back-end.premium.layout.premium-main')
@section('content')
<section class="main-contant-section">
    <div class="">
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



        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Employees Objective & Development Plan List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">List - {{ 'Objective & Development' }} </a></li>
                </ol>
            </div>
        </div>

        <div class="objective-contant">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab">
                        <button class="tablinks active" onclick="openCity(event, 'Objective')"> Objective's Plan </button>
                        <button class="tablinks" onclick="openCity(event, 'Development')"> Development Plan </button>
                    </div>

                    <div id="Objective" class="tabcontent" style="display: block;">
                        <!-- <div class="card mb-4">
                            <div class="card-header with-border">
                                <h1 class="card-title text-center"> {{ __('Development Plan Form List') }} </h1>
                            </div>
                        </div> -->
                        <div class="content-box">
                            <div class="">
                                <h4>1. OBJECTIVES FOR THE PERIOD UNDER REVIEW (To be filled by the Employee and approved by the Supervisor at the beginning of the year)</h4>
                                <p>This section should report the objectives that have been cascaded to you by your supervisor for the year. Please write a minimum of 1 and a maximum of
                                    5 SMART (Specific, Measurable, Achievable, Realistic, Time Based) objectives in each section and total objectives will be minimum 3 and maximum 8. </p>
                            </div>
                        </div>

                        <div class="content-box">
                        <form method="POST" action="{{ route('add-objective-plans') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="select_depertment">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="objective_dept_id" id="objective_dept_id" required>
                                            <option value="">Choose a Department</option>
                                            @foreach ($departments->unique(fn($p)  =>
                                            $p->id) as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name ?? null}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Designation') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="objective_desig_id" id="objective_desig_id" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Employee') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="objective_emp_id" id="objective_emp_id" required> </select>
                                    </div>
                                </div>
                                <table class="form-table objective" id="Objective_plan">

                                </table>
                                <button type="submit" class="btn btn-grad mt-4"> save </button>
                            </form>
                            <div class="table-responsive mt-4">
                                <table id="user-table" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th>{{ __('Department') }}</th>
                                            <th>{{ __('Designation') }}</th>
                                            <th>{{ __('Employee') }}</th>
                                            <th>{{ __('Year') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($objectivePlans as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->userdepartmentfromobjective->department_name ?? null }}</td>
                                            <td>{{ $value->userdesignationfromobjective->designation_name ?? null}}</td>
                                            <td>{{ ucfirst($value->userfromobjective->first_name ?? '') }}
                                                {{ ucfirst($value->userfromobjective->last_name ?? '') }}</td>
                                            <td>{{ date('Y', strtotime($value->created_at)); }}</td>
                                            <td>
                                            <a href="{{ route('details-objective-plans', $value->id) }}" class="btn edit" data-toggle="tooltip" title="Show Details"
                                            data-original-title="Marking" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                            <a href="{{ route('details-objective-plans-views', $value->id) }}" class="btn view" data-toggle="tooltip" title="View"
                                            data-original-title="Marking" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div id="Development" class="tabcontent">
                        <!-- <div class="card mb-4">
                            <div class="card-header with-border">
                                <h1 class="card-title text-center"> {{ __('Operation Form List') }} </h1>
                            </div>
                        </div> -->

                        <div class="content-box">
                        <div class="">
                                <h4>2. DEVELOPMENT PLAN FOR THE PERIOD UNDER REVIEW (To be filled by the Employee and approved by the Supervisor)</h4>
                                <p>This section should capture your Development Plans for the year. Please focus on 1-3 important development goals ie areas you want to improve upon.
                                     Your development goals should support you in achieving your individual objectives above. The development plan should capture activities through on-the-job experience,
                                     exposure by working on cross-functional projects and networking assignments; and classroom training provided by internal or external providers.  </p>
                            </div>
                        </div>

                        <div class="content-box">

                            <form method="POST" action="{{ route('add-development-plans') }}"
                                enctype="multipart/form-data" id="form1">
                                @csrf
                                <div class="select_depertment">
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="development_dept_id" id="development_dept_id" required>
                                            <option value="">Choose a Department</option>
                                            @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name ?? null}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Designation') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="development_desig_id" id="development_desig_id" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-bold">{{ __('Employee') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="development_emp_id" id="development_emp_id" required> </select>
                                    </div>
                                </div>
                                <br>
                                <table class="form-table" id="development_plan">
                                    <tr valign="top">

                                        <th>
                                            Development Plan (Please fill this at the beginning of the year)
                                        </th>
                                        <th>
                                            Measures Of Success (Please specify metrics for measuring the development plan. Please fill this at the beginning of the year)
                                        </th>
                                        <th>
                                            Action Taken (Please mention actions taken against the plan. Please fill it at the year end)
                                        </th>
                                        <th>
                                            <a href="javascript:void(0);" class="addOP btn" onclick="addOP()"> <i
                                                    class="fa fa-plus" aria-hidden="true"></i> </a>
                                        </th>
                                    </tr>
                                </table>
                                <div id="operation"> </div>
                                <button type="submit" class="btn btn-grad mt-4"> save </button>
                            </form>
                        </div>

                        <div class="content-box">
                            <div class="table-responsive">
                                <table id="user-table" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th>{{ __('Department') }}</th>
                                            <th>{{ __('Designation') }}</th>
                                            <th>{{ __('Employee') }}</th>
                                            <th>{{ __('Year') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($developmentPlans as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->userdepartment->department_name ?? null}}</td>
                                            <td>{{ $value->userdesignation->designation_name ?? null}}</td>
                                            <td>{{ $value->user->first_name ?? null}} {{ $value->user->last_name ??
                                                null}}</td>
                                            <td>{{ date('Y', strtotime($value->created_at)); }}</td>
                                            <td>
                                                <a href="{{ route('details-development-plans', $value->id) }}" class="btn edit" data-toggle="tooltip" title="Show Details"
                                                data-original-title="Marking" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                <a href="{{ route('details-development-plans-views', $value->id) }}" class="btn view" data-toggle="tooltip" title="Show Details"
                                                data-original-title="Marking" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<script>

    $(document).ready(function() {

            $("#formButton").click(function() {
                $("#form1").toggle();
            });
        });

        $('#objective_dept_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-obj-designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#objective_desig_id').empty();
                            $('#objective_desig_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="objective_desig_id"]').append(
                                    '<option value="' + designations.id + '">' +
                                    designations.designation_name + '</option>');
                            });
                        } else {
                            $('#designations').empty();
                        }
                    }
                });
            } else {
                $('#designations').empty();
            }
        });

        $('#objective_desig_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-employee/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#objective_emp_id').empty();
                            $('#objective_emp_id').append(
                                '<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees) {
                                $('select[name="objective_emp_id"]').append('<option value="' +
                                    employees.id + '">' + employees.first_name + ' ' +
                                    employees.last_name + '</option>');
                            });
                        } else {
                            $('#employees').empty();
                        }
                    }
                });
            } else {
                $('#employees').empty();
            }
        });

        $('#development_dept_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-obj-designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#development_desig_id').empty();
                            $('#development_desig_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="development_desig_id"]').append('<option value="' +
                                    designations.id + '">' + designations.designation_name +
                                    '</option>');
                            });
                        } else {
                            $('#designations').empty();
                        }
                    }
                });
            } else {
                $('#designations').empty();
            }
        });


        $('#development_desig_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-employee/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#development_emp_id').empty();
                            $('#development_emp_id').append(
                                '<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees) {
                                $('select[name="development_emp_id"]').append('<option value="' +
                                    employees.id + '">' + employees.first_name + ' ' +
                                    employees.last_name + '</option>');
                            });
                        } else {
                            $('#employees').empty();
                        }
                    }
                });
            } else {
                $('#employees').empty();
            }
        });


        $('#objective_desig_id').on('change', function() {
            var designationID = $(this).val();
            if (designationID) {
                $.ajax({
                    url: '/get-objective-type/' + designationID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('.objective').empty();
                            $.each(data, function(key, objective_type_configs) {

                                $('.objective').prepend(`
                                 <tr>
                                    <th colspan="4" class="text-center"> ${objective_type_configs.userobjectivetypefromobjectiveconfig.objective_type_name + ' ' + objective_type_configs.obj_config_percent } % </th>
                                </tr>
                                 <tr valign="top" id="after${objective_type_configs.obj_config_obj_typ_id}">

                                <th>
                                    Individual Objective With Timeline (Please fill this at the beginning of the year. Please specify your objectives here)
                                </th>
                                <th>
                                    Measures Of Success (Please specify metrics for measuring the objectives)
                                </th>

                                    <th>
                                        <a href="javascript:void(0);" class="addOB btn" onclick="addOB(${objective_type_configs.obj_config_obj_typ_id})"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>

                                    </tr>
                               `);
                            });
                        } else {
                            $('#objective_type_configs').empty();
                        }
                    }
                });
            } else {
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



        function addOB(id) {
            var obj_config_obj_typ_id = id;
            $('#after'+id).after(`
                <tr valign="top">

                <td><textarea  name="objective_name[]" class="code" id="customFieldName"  value="" placeholder=" Individual Objective" required ></textarea></td>
                <td> <textarea  class="code" id="customFieldValue" name="objective_success[]" value="" placeholder="Measures Of Success" required></textarea>
                     <input type="hidden" name="obj_config_obj_typ_id[]" value="${id}"/> </td>



                    @foreach ($departments as $departments_value)
                                <option value="{{ $departments_value->id }}">
                                </option>
                     @endforeach
                    @foreach ($designations as $designations_value)
                                <option value="{{ $designations_value->id }}">
                                </option>
                     @endforeach
                    @foreach ($employee_list as $employee_list_value)
                                <option value="{{ $employee_list_value->id }}">
                                </option>
                     @endforeach

                <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr> `);
        }
        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });


            function addOP() {
            $('#development_plan').append(`
                <tr valign="top">

                    <td><textarea name="development_name[]" class="code" id="customFieldName"  value="" placeholder="Development Name" required ></textarea></td>
                    <td><textarea name="meassure_of_success[]" class="code" id="customFieldName"  value="" placeholder="Measure of Success" required></textarea></td>
                    <td> <textarea class="code" id="customFieldValue" name="action_taken[]" value="" placeholder="Action Taken" readonly></textarea> </td>
                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>

            </tr> `);
        }
            $("#development_plan").on('click', '.remOP', function() {
                $(this).parent().parent().remove();
            });

</script>
@endsection
