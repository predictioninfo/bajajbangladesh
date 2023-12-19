@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="forms main-contant-section">
        <div class="employee-basic-information">
            <div class="row">
                @include('back-end.premium.performance.performance-report.menu-bar')
                <div class="col-md-9">
                    <div class="card h-100">
                        <div class="content-box">
                            <div class="tab-content">
                                {{-- 2nd Start --}}
                                <div class="">
                                    <div id="" class="tabcontent">
                                        <h1 class="text-center"> Incomplete Performance </h1>

                                            <ul class="btn-tasks">
                                                {{-- <li class="dropdown">
                                                    <a href="{{ route('download-performance-report') }}"
                                                        class="btn-grad btn" title="Download Word" data-toggle="tooltip" data-original-title="Download Word">
                                                        <i class="fa fa-file-word-o"></i>
                                                    </a>
                                                </li> --}}
                                                <li class="dropdown">
                                                    <a href="{{ route('incomlete-performance-list') }}" class="btn-grad btn"
                                                        title="Download PDF" data-toggle="tooltip"
                                                        data-original-title="Download PDF">
                                                        <i class="icon fa fa-file-pdf-o"></i>
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="toggle_down tip btn-grad btn"
                                                        data-toggle="tooltip" title=" Show Form "
                                                        data-original-title="Show Form">
                                                        <i class="icon fa fa-toggle-down"></i>
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="toggle_up tip btn-grad btn"
                                                        data-toggle="tooltip" title="Hide Form"
                                                        data-original-title="Hide Form">
                                                        <i class="icon fa fa-toggle-up"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                            <div id="form">

                                                <form action="{{ route('incomlete-performance') }}" method="GET"
                                                    enctype="multipart/form-data">
                                                    {{-- @csrf --}}
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label class="text-bold" data-error="wrong" data-success="right"
                                                                for="start_year">Department
                                                            </label>
                                                            <select name="department_id" id="department_id"
                                                                class="form-control selectpicker dynamic"
                                                                data-live-search="true" data-live-search-style="begins"
                                                                data-shift_name="department_id"
                                                                data-dependent="department_id"
                                                                title="{{ __('Selecting', ['key' => trans('file.Department')]) }}..."
                                                                required>
                                                                @foreach ($departments as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->department_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="text-bold">{{ __('Designation') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="objective_desig_id" id="objective_desig_id"
                                                                class="form-control">
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="text-bold">{{ __('Employee') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="objective_emp_id" id="objective_emp_id"
                                                                class="form-control"> </select>
                                                        </div>
                                                        {{-- <div class="col-md-2">
                                                            <label for="">Value Point</label>
                                                            <select name="value_point" id="" class="form-control">
                                                                <option value="3">A</option>
                                                                <option value="2">B</option>
                                                                <option value="1">C</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="">Objective Point</label>
                                                            <input name="point" type="text" class="form-control">
                                                        </div> --}}
                                                        <div class="col-md-2">
                                                            <label data-error="wrong" data-success="right"
                                                                for="start_year">Start Year
                                                            </label>
                                                            <input class="form-control" type="date" name="start_year"
                                                                value="" id="start_year">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label data-error="wrong" data-success="right"
                                                                for="start_year">End Year
                                                            </label>
                                                            <input class="form-control" type="date" name="end_year"
                                                                id="end_year" value="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for=""> &nbsp; </label>
                                                            <input type="submit" class="btn btn-grad" value="Serach">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table-responsive mt-4">
                                                <table id="user-table" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('SL') }}</th>
                                                            <th>{{ __('Department') }}</th>
                                                            <th>{{ __('Designation') }}</th>
                                                            <th>{{ __('Employee') }}</th>
                                                            {{-- <th>{{ __('Objective Point') }}</th>
                                                            <th>{{ __('Value Point') }}</th> --}}
                                                            <th>{{ __('Year') }}</th>
                                                            {{-- <th>{{ __('Action') }}</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($incomplete_performance as $value)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $value->userdepartmentfromobjective->department_name }}
                                                                </td>
                                                                <td>{{ $value->userdesignationfromobjective->designation_name }}
                                                                </td>
                                                                <td>{{ $value->userfromobjective->first_name }}
                                                                    {{ $value->userfromobjective->last_name }}
                                                                </td>
                                                                {{-- <td>{{ $value->point }}</td> --}}
                                                                {{-- <td>
                                                                    @if ($value->value_point == 3)
                                                                        {{ 'A' }}
                                                                    @elseif($value->value_point == 2)
                                                                        {{ 'B' }}
                                                                    @elseif($value->value_point == 1)
                                                                        {{ 'C' }}
                                                                    @endif
                                                                </td> --}}
                                                                <td>{{ $value->objective_date }}</td>
                                                                {{-- <td> <a style="padding-right: 5px;"
                                                                        href="{{ route('single-performance-point-report', $value->id) }}"
                                                                        class="" data-toggle="tooltip"
                                                                        title="Download PDF"> <i
                                                                            class="fa fa-file-pdf-o"></i>
                                                                    </a>
                                                                    <a href="{{ route('single-performance-point-preview', $value->id) }}"
                                                                        class="" data-toggle="tooltip"
                                                                        title="" data-original-title="Preview">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                </td> --}}
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>


                                    </div>
                                </div>
                                {{-- 2nd End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>




    <script>
        $('#user-table-v').DataTable({


            dom: '<"row"lfB>rtip',

            buttons: [{
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

        $('#form').hide();
        $('.toggle_down').click(function() {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function() {
            $("#form").slideUp();
            return false;
        });
        $('#form_v').hide();
        $('.toggle_down_v').click(function() {
            $("#form_v").slideDown();
            return false;
        });
        $('.toggle_up_v').click(function() {
            $("#form_v").slideUp();
            return false;
        });
        //For Department, Designation & Employee
        $('#department_id').on('change', function() {
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
                                $('select[name="objective_desig_id"] ').append(
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
        // For Search or Filtering
        // $('#department_id').on('change', function() {
        //     var departmentID = $(this).val();

        //     $.ajax({
        //         url: '/get-department-infos/' + departmentID,
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             var htmlView = '';
        //             $('#allData').hide();
        //             if (data.length > 0) {
        //                 $.each(data, function(key, objective_type_configs) {
        //                     $('#newData').html(
        //                         htmlView += `<tr>
    //                                 <td>${key+1}</td>
    //                                 <td>${objective_type_configs.userdepartmentfromobjective.department_name}</td>
    //                                 <td>${objective_type_configs.userdesignationfromobjective.designation_name}</td>
    //                                 <td>${objective_type_configs.userfromobjective.first_name} ${objective_type_configs.userfromobjective.last_name}</td>
    //                                 <td>${objective_type_configs.objective_date}</td>
    //                                 <td>
    //                                     <a style="padding-right: 5px" href="{{ URL::to('single-employee-performance-report-download') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-file-pdf-o"></i>
    //                                     <a href="{{ URL::to('single-employee-performance-report-preview') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-eye"></i>
    //                                     </a>
    //                                 </td>
    //                             </tr>`

        //                     );
        //                 });
        //             } else {
        //                 // $('#newData').hide();
        //                 $('#newData').html(
        //                     htmlView += `<tr>
    //                                 <td colspan="6" class="text-center">${'No Data Found'}</td>
    //                             </tr>`

        //                 );
        //             }
        //         }
        //     });
        // });
        // $('#objective_desig_id').on('change', function() {
        //     var designationID = $(this).val();
        //     $.ajax({
        //         url: '/get-designation-infos/' + designationID,
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             var htmlView = '';
        //             $('#allData').hide();
        //             if (data.length > 0) {
        //                 $.each(data, function(key, objective_type_configs) {
        //                     $('#newData').html(
        //                         htmlView += `<tr>
    //                                 <td>${key+1}</td>
    //                                 <td>${objective_type_configs.userdepartmentfromobjective.department_name}</td>
    //                                 <td>${objective_type_configs.userdesignationfromobjective.designation_name}</td>
    //                                 <td>${objective_type_configs.userfromobjective.first_name} ${objective_type_configs.userfromobjective.last_name}</td>
    //                                 <td>${objective_type_configs.objective_date}</td>
    //                                 <td>
    //                                     <a style="padding-right: 5px" href="{{ URL::to('single-employee-performance-report-download') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-file-pdf-o"></i>
    //                                     </a>
    //                                     <a href="{{ URL::to('single-employee-performance-report-preview') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-eye"></i>
    //                                 </a>
    //                                 </td>
    //                             </tr>`

        //                     );
        //                 });
        //             } else {
        //                 // $('#newData').hide();
        //                 $('#newData').html(
        //                     htmlView += `<tr>
    //                                 <td colspan="6" class="text-center">${'No Data Found'}</td>
    //                             </tr>`

        //                 );
        //             }
        //         }
        //     });
        // });

        // $('#objective_emp_id').on('change', function() {
        //     var employeeID = $(this).val();
        //     $.ajax({
        //         url: '/get-employees-infos/' + employeeID,
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             var htmlView = '';
        //             $('#allData').hide();
        //             if (data.length > 0) {
        //                 $.each(data, function(key, objective_type_configs) {
        //                     $('#newData').html(
        //                         htmlView += `<tr>
    //                                 <td>${key+1}</td>
    //                                 <td>${objective_type_configs.userdepartmentfromobjective.department_name}</td>
    //                                 <td>${objective_type_configs.userdesignationfromobjective.designation_name}</td>
    //                                 <td>${objective_type_configs.userfromobjective.first_name} ${objective_type_configs.userfromobjective.last_name}</td>
    //                                 <td>${objective_type_configs.objective_date}</td>
    //                                 <td>
    //                                     <a style="padding-right: 5px" href="{{ URL::to('single-employee-performance-report-download') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-file-pdf-o"></i>
    //                                     </a>
    //                                     <a href="{{ URL::to('single-employee-performance-report-preview') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-eye"></i>
    //                                 </a>
    //                                 </td>
    //                             </tr>`

        //                     );
        //                 });
        //             } else {
        //                 // $('#newData').hide();
        //                 $('#newData').html(
        //                     htmlView += `<tr>
    //                                 <td colspan="6" class="text-center">${'No Data Found'}</td>
    //                             </tr>`

        //                 );
        //             }
        //         }
        //     });
        // });

        // $('#start_year').on('change', function() {
        //     var startYear = $(this).val();
        //     $.ajax({
        //         url: '/get-start-date-infos/' + startYear,
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             var htmlView = '';
        //             $('#allData').hide();
        //             if (data.length > 0) {
        //                 $.each(data, function(key, objective_type_configs) {
        //                     $('#newData').html(
        //                         htmlView += `<tr>
    //                                 <td>${key+1}</td>
    //                                 <td>${objective_type_configs.userdepartmentfromobjective.department_name}</td>
    //                                 <td>${objective_type_configs.userdesignationfromobjective.designation_name}</td>
    //                                 <td>${objective_type_configs.userfromobjective.first_name} ${objective_type_configs.userfromobjective.last_name}</td>
    //                                 <td>${objective_type_configs.objective_date}</td>
    //                                 <td>
    //                                     <a style="padding-right: 5px" href="{{ URL::to('single-employee-performance-report-download') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-file-pdf-o"></i>
    //                                     </a>
    //                                     <a href="{{ URL::to('single-employee-performance-report-preview') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-eye"></i>
    //                                 </a>
    //                                 </td>
    //                             </tr>`

        //                     );
        //                 });
        //             } else {
        //                 // $('#newData').hide();
        //                 $('#newData').html(
        //                     htmlView += `<tr>
    //                                 <td colspan="6" class="text-center">${'No Data Found'}</td>
    //                             </tr>`

        //                 );
        //             }
        //         }
        //     });
        // });

        // $('#end_year').on('change', function() {
        //     var endYear = $(this).val();
        //     $.ajax({
        //         url: '/get-end-date-infos/' + endYear,
        //         type: "GET",
        //         data: {
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             var htmlView = '';
        //             $('#allData').hide();
        //             if (data.length > 0) {
        //                 $.each(data, function(key, objective_type_configs) {
        //                     $('#newData').html(
        //                         htmlView += `<tr>
    //                                 <td>${key+1}</td>
    //                                 <td>${objective_type_configs.userdepartmentfromobjective.department_name}</td>
    //                                 <td>${objective_type_configs.userdesignationfromobjective.designation_name}</td>
    //                                 <td>${objective_type_configs.userfromobjective.first_name} ${objective_type_configs.userfromobjective.last_name}</td>
    //                                 <td>${objective_type_configs.objective_date}</td>
    //                                 <td>
    //                                     <a style="padding-right: 5px" href="{{ URL::to('single-employee-performance-report-download') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-file-pdf-o"></i>
    //                                     </a>
    //                                     <a href="{{ URL::to('single-employee-performance-report-preview') }}/${objective_type_configs.id}" data-toggle="tooltip" title="Download PDF">
    //                                     <i class="fa fa-eye"></i>
    //                                 </a>
    //                                 </td>
    //                             </tr>`

        //                     );
        //                 });
        //             } else {
        //                 // $('#newData').hide();
        //                 $('#newData').html(
        //                     htmlView += `<tr>
    //                                 <td colspan="6" class="text-center">${'No Data Found'}</td>
    //                             </tr>`

        //                 );
        //             }
        //         }
        //     });
        // });
    </script>
@endsection
