@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">
        <div class="container-fluid">

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

            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> Objective Section </h1>
                </div>
            </div>
            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'Objective')"> Objective Plan </button>
                            <button class="tablinks" onclick="openCity(event, 'Operational')"> Development Plan </button>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header with-border" style="background:#458191; color:white;">
                                <h1 class="card-title text-center"> {{ __('Development Form List') }} </h1>
                            </div>
                        </div>



                        <div class="table-responsive">


                            <button type="button" id="formButton" class="edit-btn btn btn-grad mr-2" data-toggle="modal">
                                <i class="fa fa-plus"></i> {{ __('Add Development form') }}
                            </button>

                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead style="background-color:#20898f; color:white;">
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Objective Type') }}</th>
                                        <th>{{ __('Department') }}</th>
                                        <th>{{ __('Designation') }}</th>
                                        <th>{{ __('Development Name') }}</th>
                                        <th>{{ __('Measure Of Success') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($objectivePlans as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->userobjectivetypefromobjective->objective_type_name }}</td>
                                            <td>{{ $value->userdepartmentfromobjective->department_name }}</td>
                                            <td>{{ $value->userdesignationfromobjective->designation_name }}</td>
                                            <td>{{ $value->objective_name }}</td>
                                            <td>{{ $value->objective_success }}</td>
                                            <td>Action</td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <form method="POST" action="{{ route('add-objective-plans') }}" enctype="multipart/form-data">
                                @csrf
                                <div id="Objective" class="tabcontent">
                                    <div class="select_depertment">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="objective_dept_id" id="objective_dept_id">
                                            <option>Choose a Department</option>
                                            @foreach ($departments as $departments_value)
                                                <option value="{{ $departments_value->id }}">
                                                    {{ $departments_value->department_name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="text-bold">{{ __('Designation') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="objective_desig_id" id="objective_desig_id">

                                        </select>
                                        {{-- <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label> --}}
                                        {{-- <select name="objective_emp_id" id="objective_emp_id"> </select> --}}
                                    </div>
                                    <table class="form-table objective" id="Objective_plan">
                                        <span id="objec"></span>
                                    </table>

                                    <button type="submit" class="btn btn-grad "> save </button>
                                </div>
                            </form>

                            <div id="Operational" class="tabcontent">
                                <div class="card mb-4">
                                    <div class="card-header with-border" style="background:#458191; color:white;">
                                        <h1 class="card-title text-center"> {{ __('Operation Form List') }} </h1>
                                    </div>
                                </div>



                                <div class="table-responsive">


                                    <button type="button" id="formButton" class="edit-btn btn btn-grad mr-2"
                                        data-toggle="modal">
                                        <i class="fa fa-plus"></i> {{ __('Add Operational form') }}
                                    </button>

                                    <table id="user-table" class="table table-bordered table-hover table-striped">
                                        <thead style="background-color:#20898f; color:white;">
                                            <tr>
                                                <th>{{ __('SL') }}</th>
                                                <th>{{ __('Department') }}</th>
                                                <th>{{ __('Designation') }}</th>
                                                <th>{{ __('Employee') }}</th>
                                                <th>{{ __('Development Name') }}</th>
                                                <th>{{ __('Measure Of Success') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($operationalPlans as $value)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $value->userdepartment->department_name }}</td>
                                                    <td>{{ $value->userdesignation->designation_name }}</td>
                                                    <td>{{ $value->user->first_name }}</td>
                                                    <td>{{ $value->development_name }}</td>
                                                    <td>{{ $value->meassure_of_success }}</td>
                                                    <td>Action</td>

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                                <form method="POST" action="{{ route('add-operational-plans') }}"
                                    enctype="multipart/form-data" id="form1">
                                    @csrf
                                    <div class="select_depertment">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="operation_dept_id" id="operation_dept_id">
                                            <option>Choose a Department</option>
                                            @foreach ($departments as $departments_value)
                                                <option value="{{ $departments_value->id }}">
                                                    {{ $departments_value->department_name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="text-bold">{{ __('Designation') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="operation_desi_id" id="operation_desi_id"> </select>
                                        <label class="text-bold">{{ __('Employee') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="operation_emp_id" id="operation_emp_id"> </select>

                                    </div>


                                    <table class="form-table" id="Operational_plan">
                                        <tr valign="top">
                                            <th>
                                                SL
                                            </th>
                                            <th>
                                                Development Plan
                                            </th>
                                            <th>
                                                Measure Of Success
                                            </th>
                                            <th>
                                                Action Taken
                                            </th>

                                            <th>
                                                <a href="javascript:void(0);" class="addOP btn"> <i class="fa fa-plus"
                                                        aria-hidden="true"></i> </a>
                                            </th>
                                        </tr>
                                    </table>

                                    <button type="submit" class="btn btn-grad"> save </button>
                                </form>
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
                    url: '/get-designation/' + departmentID,
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


        // $('#objective_desig_id').on('change', function() {
        //     var departmentID = $(this).val();
        //     if (departmentID) {
        //         $.ajax({
        //             url: '/get-department-wise-employee/' + departmentID,
        //             type: "GET",
        //             data: {
        //                 "_token": "{{ csrf_token() }}"
        //             },
        //             dataType: "json",
        //             success: function(data) {
        //                 if (data) {
        //                     $('#objective_emp_id').empty();
        //                     $('#objective_emp_id').append('<option hidden>Choose an Employee</option>');
        //                     $.each(data, function(key, employees) {
        //                         $('select[name="objective_emp_id"]').append('<option value="' +
        //                             employees.id + '">' + employees.first_name + ' ' +
        //                             employees.last_name + '</option>');
        //                     });
        //                 } else {
        //                     $('#employees').empty();
        //                 }
        //             }
        //         });
        //     } else {
        //         $('#employees').empty();
        //     }
        // });

        $('#operation_dept_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#operation_desi_id').empty();
                            $('#operation_desi_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="operation_desi_id"]').append('<option value="' +
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


        $('#operation_desi_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-department-wise-employee/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#operation_emp_id').empty();
                            $('#operation_emp_id').append('<option hidden>Choose an Employee</option>');
                            $.each(data, function(key, employees) {
                                $('select[name="operation_emp_id"]').append('<option value="' +
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
                                    <th colspan="5" class="text-center"> ${objective_type_configs.userobjectivetypefromobjectiveconfig.objective_type_name + ' ' + objective_type_configs.obj_config_percent}  </th>
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
                                        <a href="javascript:void(0);" class="addOB btn" onclick="addOB(${objective_type_configs.id})"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                                    </th>
                                        <input type="hidden" name="obj_config_obj_typ_id" value="${objective_type_configs.obj_config_obj_typ_id}"/>

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

        var i = 1;

        function addOB(id) {
            $('#Objective_plan').append(`
                <tr valign="top">
                <td> <input type="text" readonly value="${i++}" />  </td>
                <td><input type="text" name="objective_name[]" class="code" id="customFieldName"  value="" placeholder="Objective Name" /></td>
                <td> <input type="text" class="code" id="customFieldValue" name="objective_success[]" value="" placeholder="Objective Name Succes" /> </td>
                <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr> `);
        }
        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });

        $(document).ready(function() {


            var i = 1;
            $(".addOP").click(function() {
                $("#Operational_plan").append(`
                <tr valign="top">
                    <td> <input type="text" readonly value="${i++}" />  </td>
                    <td><input type="text" name="development_name[]" class="code" id="customFieldName"  value="" placeholder="Development Name" /></td>
                    <td><input type="text" name="meassure_of_success[]" class="code" id="customFieldName"  value="" placeholder="Measure of Success" /></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="action_taken[]" value="" placeholder="Action Taken" /> </td>

                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
            `);
            });
            $("#Operational_plan").on('click', '.remOP', function() {
                $(this).parent().parent().remove();
            });

        });
    </script>
@endsection
