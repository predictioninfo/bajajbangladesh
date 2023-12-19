@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php

    $date = new DateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $current_date = $date->format('Y-m-d');
    $current_month = $date->format('m');
    $current_day = $date->format('d');
    $lastDay = $date->modify('last day of this month');
    $lastDays = $lastDay->format('d');

    $review_permission = 'Not-Permitted';
    $year_end_review_permission = 'Not-Permitted';
    $review_visible_days = 0;
    $current_day_number = $current_day;
    $current_month_number = $current_month;
    $lastDayOfcurrentMonth = $lastDays;

    foreach ($yearly_reviews as $yearly_reviews_value) {
        if ($current_month_number == $yearly_reviews_value->yearly_review_after_months && $current_day_number >= $yearly_reviews_value->yearly_review_upto) {
            $review_permission = 'Permitted';
        } else {
            $year_end_review_permission = 'Not-Permitted';
        }
    }
    ?>

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



            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">

                       
                        <div class="card mb-0">
                            <div class="card-header with-border">
                                <h1 class="card-title text-center"> Yearly Employees Values Review Form List</h1>
                                <ol id="breadcrumb1">
                                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                    <li><a href="#">List - {{ 'Yearly Values Review' }} </a></li>
                                </ol>
                            </div>
                        </div>

                        @if ($review_permission == 'Permitted')
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
                                            @foreach ($value_type_configs as $value)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $value->valueDepartment->department_name ?? null }}</td>
                                                    <td>{{ $value->valueDesignation->designation_name ?? null }}</td>
                                                    <td>{{ ucfirst($value->valueUser->first_name ?? '') }}
                                                        {{ ucfirst($value->valueUser->last_name ?? '') }}
                                                    </td>
                                                    <td>{{ $value->created_at->format('Y') }} </td>
                                                    <td>
                                                        <a href="{{ route('performance-value-type-configure-details', $value->id) }}" class="btn edit" data-toggle="tooltip" title="Value Review "
                                                                    data-original-title="Value" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                        <a href="{{ route('performance-value-type-view-details', $value->id) }}" class="btn view" data-toggle="tooltip" title="Show Details"
                                                            data-original-title="Value" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

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
                    url: '/get-employee/' + departmentID,
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
