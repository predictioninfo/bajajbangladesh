@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">
        @php
            use App\Models\User;
        @endphp
        <div class=""><span id="general_result"></span></div>


        <div class=" mb-3">


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
                    <h1 class="card-title"> {{ __('Man Power List') }} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="#" type="button" data-toggle="modal" data-target="#manPowerModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                            <li><a href="#">List - Man Power </a></li>
                        </ol>

                    </nav>
                </div>
            </div>

            <div class="content-box">
                <div class="tab-content">

                    {{-- 1st Start --}}
                    <div id="orange" class="b-tab active">
                        <div id="" class="tabcontent">
                            <div class="">
                                <ul class="btn-tasks">
                                    {{-- <li class="dropdown">
                                                <button type="button" class="edit-btn btn btn-grad mr-2 text-left"
                                                    data-toggle="modal" data-target="#manPowerModal"><i
                                                        class="fa fa-plus-circle"></i> Add Man Power
                                                </button>
                                            </li> --}}
                                    <li class="dropdown">
                                        <a href="{{ route('download-man-power-report') }}" class="btn-grad btn"
                                            title="Download PDF" data-toggle="tooltip" data-original-title="Download PDF">
                                            <i class="icon fa fa-file-pdf-o"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="toggle_down tip btn-grad btn" data-toggle="tooltip"
                                            title=" Show Form " data-original-title="Show Form">
                                            <i class="icon fa fa-toggle-down"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="toggle_up tip btn-grad btn" data-toggle="tooltip"
                                            title="Hide Form" data-original-title="Hide Form">
                                            <i class="icon fa fa-toggle-up"></i>
                                        </a>
                                    </li>

                                </ul>
                                <div id="form" style="display: block;">

                                    <form action="{{ route('man-power') }}" method="GET" enctype="multipart/form-data">
                                        {{-- @csrf --}}
                                        <div class="row align-items-end">
                                            <div class="col-md-2">
                                                <label class="text-bold" data-error="wrong" data-success="right"
                                                    for="start_year">Department
                                                </label>
                                                <select name="department_id_for_serach" id="department_id_for_serach"
                                                    class="form-control selectpicker dynamic" data-live-search="true"
                                                    data-live-search-style="begins" data-shift_name="department_id"
                                                    data-dependent="department_id"
                                                    title="{{ __('Selecting', ['key' => trans('file.Department')]) }}...">
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
                                                <select name="desig_id_for_serach" id="desig_id_for_serach"
                                                    class="form-control">
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="text-bold">{{ __('Grade') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="gradesetup_id_for_serach" id="gradesetup_id_for_serach"
                                                    class="form-control">
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label data-error="wrong" data-success="right" for="start_date">Start Date
                                                    (Vacancy)
                                                </label>
                                                <input class="form-control" type="date" name="start_date" value=""
                                                    id="start_date">
                                            </div>
                                            <div class="col-md-2">
                                                <label data-error="wrong" data-success="right" for="end_date">End Date
                                                    (Vacancy)
                                                </label>
                                                <input class="form-control" type="date" name="end_date"
                                                    id="end_date" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for=""> &nbsp; </label>
                                                <input type="submit" class="btn btn-grad" value="Serach">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table id="user-table" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL') }}</th>
                                                <th>{{ __('Department') }}</th>
                                                <th>{{ __('Designation') }}</th>
                                                {{-- <th>{{ __('Grade') }}</th> --}}
                                                <th>{{ __('Number of Employee') }}</th>
                                                <th>{{ __('Previous Employee') }}</th>
                                                <th>{{ __('(Increment/Decrement)') }}</th>
                                                <th>{{ __('Vacancy') }}</th>
                                                <th>{{ __('Recruited') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($manPowers as $manPower)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $manPower->manPowerDeparment->department_name }}</td>
                                                    <td>{{ $manPower->manPowerDesignation->designation_name }}</td>

                                                    {{-- <td>
                                                        @if ($manPower->manPowerGardeSetaup)
                                                            {{ $manPower->manPowerGardeSetaup->gardeSetaupGarde->grade_name ?? '' }}
                                                        @endif
                                                    </td> --}}
                                                    <td>{{ $manPower->number_of_employee }}
                                                        ({{ date('d-m-Y', strtotime($manPower->vacancy_date)) }})
                                                    </td>
                                                    <td>{{ $manPower->previous_employee }} </td>
                                                    <td>
                                                        @if ($manPower->update_vacancy_date)
                                                            {{ $manPower->update_employee - $manPower->previous_employee ?? ' ' }}
                                                            ({{ date('d-m-Y', strtotime($manPower->update_vacancy_date)) }})
                                                            <br>
                                                            @if ($manPower->increment_or_decrement == 'decrement')
                                                                {{ 'Decrement' }}
                                                            @elseif($manPower->increment_or_decrement == 'increment')
                                                                {{ 'Increment' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    @php
                                                        $vacancy = User::where('com_id', '=', Auth::user()->com_id)
                                                            // ->where('department_id', '=', $manPower->manPowerDeparment->id)
                                                            ->where('designation_id', '=', $manPower->manPowerDesignation->id)
                                                            // ->where('gradesetup_id', '=', $manPower->manPowerDesignation->grade_id)
                                                            ->where('is_active', '=', 1)
                                                            ->count();
                                                    @endphp
                                                    <td>{{ $manPower->number_of_employee - $vacancy }}</td>
                                                    <td>
                                                        @if ($vacancy == 0)
                                                            {{ '(No Employee Recruited)' }}
                                                        @else
                                                            {{ $vacancy }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- <a style="padding-right: 5px" class="btn edit"
                                                            data-toggle="tooltip" title=""
                                                            data-original-title="Edit" href="javascript:void(0)"
                                                            data-id="{{ $manPower->id }}"> <i class="fa fa-edit"></i></a> --}}
                                                        <a class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')"
                                                            href="{{ route('man-power-delete', $manPower->id) }}"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 1st End --}}
                </div>
            </div>



            <!-- add modal code starts from here -->

            <div id="manPowerModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Man Power Setup') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('create-man-power') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- <input type="hidden" name="id" value=""> --}}
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Department Name') }} *</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-object-group"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select name="department_id" id="department_id" class="form-control">
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">
                                                            {{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Designation Name') }} <span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-level-up"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select class="form-control" name="designation_id"
                                                    id="designation_id"></select>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Grade Name') }} <span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-level-up"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select class="form-control" name="gradesetup_id"
                                                    id="gradesetup_id"></select>
                                            </div>

                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>{{ __('Number of Employee') }} <span class="text-danger">*</span> <i
                                                    style="color: red"></i> </label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-sort-numeric-asc"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <input type="text" name="number_of_employee" value=""
                                                    id="number_of_employee" onkeyup="myFunction()" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <span id="total_number_of_employee">

                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Date') }} <span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <input type="date" name="vacancy_date" value=""
                                                    class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                aria-hidden="true"></i> Add </button>

                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <!-- edit boostrap model -->
            <div class="modal fade" id="edit-modal" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="ajaxModelTitle"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('update-man-power') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Update Department</label>
                                        <select class="form-control" name="edit_man_power_department_id"
                                            id="edit_man_power_department_id">
                                            <option value="">Select-a-Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Update Designation</label>
                                        <select class="form-control" name="edit_man_power_designation_id"
                                            id="edit_man_power_designation_id">
                                            <option value="">Select-a-Designation</option>
                                            @foreach ($designations as $designation)
                                                <option value="{{ $designation->id }}">
                                                    {{ $designation->designation_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Update Number of Employee') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-sort-numeric-asc"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <input type="text" name="edit_number_of_employee"
                                                    id="edit_number_of_employee" value="" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Update Date') }} <span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <input type="date" name="edit_vacancy_date" id="edit_vacancy_date"
                                                    value="" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10 mt-4">
                                        <button type="submit" class="btn btn-grad">Save changes</button>
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
    </section>
    <script>
        $('.edit').on('click', function() {
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                url: 'man-power-by-id',
                data: {
                    id: id
                },
                dataType: 'json',

                success: function(res) {
                    console.log(res);
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#edit_man_power_department_id').val(res.department_id);
                    $('#edit_man_power_designation_id').val(res.designation_id);
                    $('#edit_number_of_employee').val(res.number_of_employee);
                    $('#edit_vacancy_date').val(res.vacancy_date);
                }
            });
        });

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
                            $('#designation_id').empty();
                            $('#designation_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="designation_id"]').append(
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
        $('#designation_id').on('change', function() {
            var designationID = $(this).val();
            // alert(designationID);
            if (designationID) {
                $.ajax({
                    url: '/get-grade/' + designationID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#gradesetup_id').empty();
                            $('#gradesetup_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, grades) {
                                $('select[name="gradesetup_id"]').append(
                                    '<option value="' + grades.id + '">' +
                                    grades.garde_setaup_garde.grade_name + '</option>');
                            });
                        } else {
                            $('#grades').empty();
                        }
                    }
                });
            } else {
                $('#grades').empty();
            }
        });
        $('#designation_id').on('change', function() {
            var gradesetupID = $(this).val();
            // alert(gradesetupID);
            if (gradesetupID) {
                $.ajax({
                    url: '/get-number-of-employee/' + gradesetupID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#total_number_of_employee').html('');
                        if (data.number_of_employee) {
                            $('#total_number_of_employee').html(`
                            <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label>+/-</lable>
                                                <select class="form-control mt-2" name="increment_or_decrement" id="increment_or_decrement" onchange="myFunction()" requried>
                                                <option value="increment">+</option>
                                                <option value="decrement">-</option>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <i style="font-size:9px; color:red;">Previous  Employee</i>
                                                <input type="text" class="form-control mt-2" name="previous_number_of_employee" id="previous_number_of_employee" value="${data.number_of_employee}" readonly>
                                                <input type="hidden" class="form-control mt-2" name="gradesetup_id" id="gradesetup_id" value="${data.gradesetup_id}" readonly>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                            `);
                        }
                    },
                    error: function() {
                        $('#total_number_of_employee').html('');
                    }
                });
            } else {
                $('#total_number_of_employee').html('');
            }
        });

        function myFunction() {
            var increment_or_decrement = document.getElementById("increment_or_decrement").value;
            if (increment_or_decrement == 'decrement') {
                var previous_number_of_employee = parseInt(document.getElementById("previous_number_of_employee").value);
                var number_of_employee = parseInt(document.getElementById("number_of_employee").value);
                if (previous_number_of_employee < number_of_employee) {
                    console.log('previous_number_of_employee ' + previous_number_of_employee);
                    console.log('number_of_employee ' + number_of_employee);
                    alert('Number of Employee More Than Previous Employee !!!!');
                    $('#number_of_employee').val(previous_number_of_employee);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }



        $('#edit_man_power_department_id').on('change', function() {
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
                            $('#edit_man_power_designation_id').empty();
                            $('#edit_man_power_designation_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="edit_man_power_designation_id"]').append(
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
        $('#form').hide();
        $('.toggle_down').click(function() {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function() {
            $("#form").slideUp();
            return false;
        });
        $('#department_id_for_serach').on('change', function() {
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
                            $('#desig_id_for_serach').empty();
                            $('#desig_id_for_serach').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="desig_id_for_serach"]').append(
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

        $('#desig_id_for_serach').on('change', function() {
            var designationID = $(this).val();
            // alert(designationID);
            if (designationID) {
                $.ajax({
                    url: '/get-grade/' + designationID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#gradesetup_id_for_serach').empty();
                            $('#gradesetup_id_for_serach').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, grades) {
                                $('select[name="gradesetup_id_for_serach"]').append(
                                    '<option value="' + grades.id + '">' +
                                    grades.garde_setaup_garde.grade_name + '</option>');
                            });
                        } else {
                            $('#grades').empty();
                        }
                    }
                });
            } else {
                $('#grades').empty();
            }
        });

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
    </script>
@endsection
