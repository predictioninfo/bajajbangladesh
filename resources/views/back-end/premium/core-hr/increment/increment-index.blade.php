@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\Department;
    use App\Models\Designation;
    use App\Models\Permission;

    $core_hr_sub_module_twelve_add = '4.12.1';
    $core_hr_sub_module_twelve_edit = '4.12.2';
    $core_hr_sub_module_twelve_delete = '4.12.3';

    ?>
    <section class="main-contant-section">

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
                    <h1 class="card-title text-center"> {{ __('Employee Increment List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>

                        <li><a href="#">List - Employee Increment</a></li>
                    </ol>
                </div>
            </div>


        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Increment') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-increments') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="dep_id" id="department_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('New Designation') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="form-control" name="desig_id" id="designation_id"
                                        required></select>

                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="emp_id" id="employee_id"></select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Old Gross Salary : </label>
                                    <span class="form-control" id="employee_old_gross_salary"></span>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Increment Amount : <span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="increment_amount" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>End of Probition Date <span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="increment_date" class="form-control" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Increment Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" required></textarea>
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

        <!-- Add Modal Ends -->
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Designation') }}</th>
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Old Gross Salary') }}</th>
                            <th>{{ __('Increment Amount') }}</th>
                            <th>{{ __('New Gross Salary') }}</th>
                            <th>{{ __('End of Probition Date') }}</th>
                            <th>{{ __('Increment Date') }}</th>
                            <th>{{ __('Description') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($increment as $increment_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <?php
                                $employee_name = User::where('id', $increment_value->emp_id)->get(['first_name', 'last_name']);
                                $old_department_name = Department::where('id', $increment_value->dep_id)->get(['department_name']);
                                $new_designation_name = Designation::where('id', $increment_value->desig_id)->get(['designation_name']);
                                ?>
                                <td><?php foreach ($old_department_name as $old_department_name_value) {
                                    echo $old_department_name_value->department_name;
                                } ?></td>

                                <td><?php foreach ($new_designation_name as $new_designation_name_value) {
                                    echo $new_designation_name_value->designation_name;
                                } ?></td>
                                 <td><?php foreach ($employee_name as $employee_name_value) {
                                    echo $employee_name_value->first_name . ' ' . $employee_name_value->last_name;
                                } ?></td>

                                <td>{{ $increment_value->old_gross_salary }}</td>
                                <td>{{ $increment_value->increment_amount }}</td>
                                <td>{{ $increment_value->new_gross_salary }}</td>
                                <td>{{ $increment_value->increment_date }}</td>
                                <td>{{ \Carbon\Carbon::parse( $increment_value->increment_date )->addDay(1)->format('Y-m-d')}}</td>

                                <td>{{ $increment_value->description }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>

                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $increment_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-increments', ['id' => $increment_value->id]) }}"
                                                class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        @endif

                                    </td>
                                @endif
                            </tr>
                        @endforeach


                    </tbody>

                </table>

            </div>
        </div>
    </section>




    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-increments') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>

                        <div class="row">


                            <div class="col-md-4 form-group">
                                <label> Department</label>
                                <select class="form-control" name="dep_id" id="edit_department_id"
                                    required>

                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}"
                                            {{ old('department_name') == $departments_value->id ? 'selected' : '' }}>
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __(' Designation') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control" name="desig_id" id="edit_designation_id">
                                    @foreach ($designations as $designations_value)
                                        <option value="{{ $designations_value->id }}"
                                            {{ old('designation_name') == $designations_value->id ? 'selected' : '' }}>
                                            {{ $designations_value->designation_name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Employee Name') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control" name="emp_id" id="edit_employee_id">
                                    @foreach ($employees as $designations_value)
                                        <option value="{{ $designations_value->id }}"
                                            {{ old('first_name') == $designations_value->id ? 'selected' : '' }}>
                                            {{ $designations_value->first_name }} {{ $designations_value->last_name  }}</option>
                                    @endforeach
                                </select>

                            </div>



                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Old Gross Salary : </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="old_gross_salary" id="old_gross_salary"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Increment Amount : </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="increment_amount" id="edit_increment_amount"
                                        class="form-control" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>End of Probition Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="increment_date" id="increment_date" class="form-control"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Increment Description</label>
                                <textarea class="form-control" name="description" id="description" required></textarea>
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



    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'increment-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_employee_id').val(res.emp_id);
                        $('#edit_department_id').val(res.dep_id);
                        $('#edit_designation_id').val(res.desig_id);
                        $('#edit_increment_amount').val(res.increment_amount);
                        $('#increment_date').val(res.increment_date);
                        $('#old_gross_salary').val(res.old_gross_salary);
                        $('#description').val(res.description);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            $('#user-table').DataTable({

                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,

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
                                    '<option hidden>Choose Designation</option>');
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

            $('#designation_id').on('change', function() {
                var departmentID = $(this).val();
                if (departmentID) {
                    $.ajax({
                        url: '/get-department-wise-employee-increment/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#employee_id').empty();
                                $('#employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="emp_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.first_name + ' ' + employees
                                        .last_name + '</option>');
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

            $('#edit_department_id').on('change', function() {
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
                                $('#edit_designation_id').empty();
                                $('#edit_designation_id').append(
                                    '<option hidden>Choose Designation</option>');
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


            $('#edit_designation_id').on('change', function() {

                var departmentID = $(this).val();

                if (departmentID) {
                    $.ajax({

                        url: '/get-department-wise-employee-increment/' + departmentID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#edit_employee_id').empty();
                                $('#edit_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="emp_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.first_name + ' ' + employees
                                        .last_name + '</option>');
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


            $('#employee_id').on('change', function() {
                var employeeID = $(this).val();

                if (employeeID) {
                    $.ajax({
                        url: '/get-employee-gross-salary/' + employeeID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#employee_old_gross_salary').empty();
                                $.each(data, function(key, employees_gross_salary) {
                                    $("#employee_old_gross_salary").append(
                                        "<input type='text' readonly name='old_gross_salary' class='form-control' value='" +
                                        employees_gross_salary.gross_salary + "'>");
                                });
                            } else {
                                $('#employees_gross_salary').empty();
                            }
                        }
                    });
                } else {
                    $('#employees_gross_salary').empty();
                }
            });

            $('#edit_employee_id').on('change', function() {
                alert('pl');
                var employeeID = $(this).val();

                if (employeeID) {
                    $.ajax({
                        url: '/get-employee-gross-salary/' + employeeID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#old_gross_salary').empty();
                                $.each(data, function(key, employees_gross_salary) {
                                    $("#old_gross_salary").append(
                                        "<input type='text' readonly name='old_gross_salary' class='form-control' value='" +
                                        employees_gross_salary.gross_salary + "'>");
                                });
                            } else {
                                $('#employees_gross_salary').empty();
                            }
                        }
                    });
                } else {
                    $('#employees_gross_salary').empty();
                }
            });



        });
    </script>
@endsection
