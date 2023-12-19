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

            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card mb-4">
                            <div class="card-header with-border">
                                <h1 class="card-title text-center"> {{ __('Performance ') }} </h1>
                            </div>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('value-type-configures') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="select_depertment">
                                    <select name="dept_id" id="objective_dept_id" required>
                                        <option value="">Choose a Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <select name="desig_id" id="desig_id" required>
                                    </select>
                                    <select name="emp_id" id="emp_id" required> </select>
                                    <select name="value_type_id" class="form-control selectpicker " data-live-search="true"
                                        data-live-search-style="begins" data-dependent="valuetype"
                                        title="{{ __('Selecting  Value Type Name') }}..." required>
                                        @foreach ($variable_types as $variable_type)
                                            <option value="{{ $variable_type->id }}">{{ $variable_type->value_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="">
                                        <input type="text" name="value_type_name" class="code form-control"
                                            placeholder="Value Type Name" required />
                                    </div>
                                </div>
                                <table class="form-table objective" id="Objective_plan">
                                    <tr>
                                        <th class="text-center">
                                            Values
                                        </th>
                                        <th class="text-center">
                                            Employee Comments with examples of behaviors
                                        </th>
                                        <th class="text-center">
                                            Supervisor Comments with examples of behavior displayed or not displayed
                                        </th>
                                        <th class="text-center">
                                            Supervisor Rating
                                        </th>
                                        <th colspan="">

                                        </th>
                                    </tr>

                                    <tr valign="top">
                                        <th colspan="3">
                                            SL
                                        </th>
                                        <th>
                                            SL
                                        </th>
                                        <th>
                                            <a href="javascript:void(0);" class="addOB btn" onclick="addOB()"> <i
                                                    class="fa fa-plus" aria-hidden="true"></i> </a>
                                        </th>
                                        {{-- <input type="hidden" name="obj_config_obj_typ_id"
                                        value="${objective_type_configs.obj_config_obj_typ_id}" />
                                    <input type="hidden" name="obj_config_id" value="${objective_type_configs.id}" />
                                    --}}
                                    </tr>
                                    <span id="objec"></span>
                                </table>
                                <button type="submit" class="btn btn-grad "> save </button>

                            </form>
                        </div>
                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead style="background-color:#20898f; color:white;">
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Department') }}</th>
                                        <th>{{ __('Designation') }}</th>
                                        <th>{{ __('Employee') }}</th>
                                        {{-- <th>{{ __('Value Type Name') }}</th> --}}
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($value_type_configs as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            {{-- <td>{{ $value->valueTypeConfig->value_type_name }}</td> --}}
                                            <td>{{ $value->valueDepartment->department_name ?? null }}</td>
                                            <td>{{ $value->valueDesignation->designation_name ?? null }}</td>

                                            <td>{{ ucfirst($value->valueUser->first_name ?? '') }}
                                                {{ ucfirst($value->valueUser->last_name ?? '') }}</td>
                                            {{-- <td>{{ $value->value_type_config_name ?? null}}</td> --}}
                                            <td> <a href="{{ route('performance-value-type-details', $value->id) }}"
                                                    class="btn btn-info">Details</a> </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>


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
                            $('#desig_id').empty();
                            $('#desig_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="desig_id"]').append(
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


        $('#desig_id').on('change', function() {
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
                            $('#emp_id').empty();
                            $('#emp_id').append(
                                '<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees) {
                                $('select[name="emp_id"]').append('<option value="' +
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
        $('#desig_id_edit').on('change', function() {
            var designationID = $(this).val();
            // console.log(designationID);
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
               <th class="text-center">
                Values
                </th>
                <th class="text-center">
                 Employee Comments with examples of behaviors
                </th>
                <th class="text-center">
                 Supervisor Comments with examples of behavior displayed or not displayed
                </th>
                <th  class="text-center">
                 Supervisor Rating
                </th>
                <th colspan="2">

                </th>
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
                <a href="javascript:void(0);" class="addOB btn" onclick="addOB(${objective_type_configs.id})"> <i
                        class="fa fa-plus" aria-hidden="true"></i> </a>
            </th>
            <input type="hidden" name="obj_config_obj_typ_id" value="${objective_type_configs.obj_config_obj_typ_id}" />
            <input type="hidden" name="obj_config_id" value="${objective_type_configs.id}" />
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





        var i = 1;

        function addOB(id) {
            console.log(id);
            $('#Objective_plan').append(`
                <tr valign="top">
                    <td> <input type="text" readonly value="${i++}" /> </td>
                    <td><input type="text" name="objective_name[]" class="code" id="customFieldName" value=""
                            placeholder="Objective Name" required /></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="objective_success[]" value=""
                            placeholder="Objective Name Succes" required /> </td>
                            <td> <input type="text" class="code" id="customFieldValue" name="objective_success[]" value=""
                                                        placeholder="Objective Name Succes" required /> </td>
                    <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus"
                                aria-hidden="true"></i></a> </td>
                </tr> `);
        }
        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });
    </script>
@endsection
