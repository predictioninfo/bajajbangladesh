@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    
    use App\Models\ObjectiveTypeConfig;
    use App\Models\ObjectiveType;
    use App\Models\Objective;
    use App\Models\SalaryIncrementApproval;
    use App\Models\SeatAllocation;
    use App\Models\User;
    use App\Models\SalaryIncrement;
    
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

                    <div class="modal-header" style="background-color:#61c597;">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Give Increment') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('give-employee-increments') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="department_id" id="department_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Designation') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="designation_id" id="designation_id"></select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                    <select class="form-control selectpicker" name="employee_id" id="employee_id"
                                        data-live-search="true" data-live-search-style="startsWith"></select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Old Salary : </label>
                                    <span id="employee_old_gross_salary"></span>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Increment Salary Amount</label>
                                    <input type="text" name="increment_amount" class="form-control" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Increment Date</label>
                                    <input type="date" name="increment_date" class="form-control date" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Increment Letter Format</label>
                                    <select class="form-control" name="cirtificate_format_id" id="cirtificate_format_id">
                                        <option value="">Select-a-Format</option>
                                        @foreach ($cirtificateFormat as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->subject }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>

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
                            <th>SL</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Old Salary</th>
                            <th>Increment Amount</th>
                            <th>New Salary</th>
                            <th>Increment Date</th>
                            <th>Download</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php($i = 1)

                        @foreach ($salary_increments as $salary_increments_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $salary_increments_value->employeedetails->company_assigned_id ?? null }}</td>
                                <td>{{ $salary_increments_value->employeedetails->first_name ?? null }}
                                    {{ $salary_increments_value->employeedetails->last_name ?? null }}</td>
                                <td>{{ $salary_increments_value->departmentdetails->department_name ?? null }}</td>
                                <td>{{ $salary_increments_value->designationdetails->designation_name ?? null }}</td>
                                <td>{{ $salary_increments_value->salary_incre_old_salary }}</td>
                                <td>{{ $salary_increments_value->increment_amount }}</td>
                                <td>{{ $salary_increments_value->salary_incre_new_salary }}</td>
                                <td>{{ $salary_increments_value->salary_incre_date }}</td>
                                <td>
                                    
                                    <form method="post"
                                        action="{{route('salary-increment-downloads',['id'=>$salary_increments_value->id])}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$salary_increments_value->id}}">
                                        <button type="submit">{{__('Download')}}</button>
                                    </form>
                                   
                                </td>

                                <td><a href="#editModal{{ $salary_increments_value->id }}" class="btn edit"
                                        data-target="#editModal{{ $salary_increments_value->id }}" data-toggle="modal"
                                        title=" Edit " data-original-title="Edit">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>

                                    <a href="{{ route('delete-employee-increments', ['id' => $salary_increments_value->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>


                            <!-- edit model below.. -->

                            <div class="modal fade" id="editModal{{ $salary_increments_value->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Edit</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update-employee-increments') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="id"
                                                    value="{{ $salary_increments_value->id }}" class="form-control"
                                                    required>
                                                <input type="hidden" name="employee_id"
                                                    value="{{ $salary_increments_value->salary_incre_emp_id }}"
                                                    class="form-control" required>

                                                <div class="col-md-6 form-group">
                                                    <label>Old Salary</label>
                                                    <input type="text" name="old_gross_salary"
                                                        value="{{ $salary_increments_value->salary_incre_old_salary }}"
                                                        class="form-control" disabled>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Increment Salary Amount</label>
                                                    <input type="text" name="increment_amount"
                                                        value="{{ $salary_increments_value->increment_amount }}"
                                                        class="form-control" required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Increment Date</label>
                                                    <input type="date" name="increment_date"
                                                        value="{{ $salary_increments_value->salary_incre_date }}"
                                                        class="form-control date" required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Increment Letter Format</label>
                                                    <select class="form-control" name="cirtificate_format_id" id="cirtificate_format_id">
                                                        <option value="">Select-a-Format</option>
                                                        @foreach ($cirtificateFormat as $value)
                                                            <option value="{{ $value->id }}" {{ $value->id == $salary_increments_value->cirtificate_format_id ? 'selected' : ''}}>
                                                                {{ $value->subject }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <br>
                                                <div class="col-sm-12">
                                                    <input type="submit" name="action_button"
                                                        class="btn btn-primary btn-block" value="{{ __('Add') }}" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </section>




    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#department_id_edit').on('change', function() {
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
                                $('#designation_id_edit').empty();
                                $('#designation_id_edit').append(
                                    '<option hidden value="">Choose Designation</option>');
                                $.each(data, function(key, designations) {
                                    $('select[name="designation_id_edit"]').append(
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


            $('#designation_id_edit').on('change', function() {
                var designationID = $(this).val();
                //console.log(designationID);
                if (designationID) {
                    $.ajax({
                        url: '/get-designation-wise-employee/' + designationID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#employee_id_edit').empty();
                                //$('#employee_id_edit').append('<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="employee_id_edit"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + '(' +
                                        employees.first_name + ' ' + employees
                                        .last_name + ')' + '</option>');
                                });

                                $(".selectpicker").selectpicker('refresh');

                            } else {
                                $('#employees').empty();
                            }
                        }
                    });
                } else {
                    $('#employees').empty();
                }
            });


            $('#employee_id_edit').on('change', function() {
                var employeeID = $(this).val();
                console.log(employeeID);
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
                                $('#employee_old_gross_salary_edit').empty();
                                //$('#employee_old_gross_salary').append('<input type="hidden">');
                                $.each(data, function(key, employees_gross_salary) {
                                    //console.log(employees_gross_salary.gross_salary);
                                    $("#employee_old_gross_salary_edit").append(
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




            //value retriving and opening the edit modal starts

            $('.first-supervisor-approval').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'objective-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitleForFirstSupervisor').html("Approval");
                        $('#edit-modal-for-first-supervisor-approval').modal('show');
                        $('#first_sv_approving_id').val(res.id);
                        $('#objective_emp_id').val(res.objective_emp_id);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            //value retriving and opening the edit modal starts

            $('.second-supervisor-approval').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'objective-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitleForSecondSupervisor').html("Approval");
                        $('#edit-modal-for-second-supervisor-approval').modal('show');
                        $('#second_sv_approving_id').val(res.id);
                        $('#objective_emp_id_for_second_sv').val(res.objective_emp_id);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            $('#user-table').DataTable({


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
                //console.log(designationID);
                if (designationID) {
                    $.ajax({
                        url: '/get-designation-wise-employee/' + designationID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#employee_id').empty();
                                $('#employee_id').append(
                                    '<option hidden value="" >Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + '(' +
                                        employees.first_name + ' ' + employees
                                        .last_name + ')' + '</option>');
                                });

                                $(".selectpicker").selectpicker('refresh');

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
                console.log(employeeID);
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
                                //$('#employee_old_gross_salary').append('<input type="hidden">');
                                $.each(data, function(key, employees_gross_salary) {
                                    //console.log(employees_gross_salary.gross_salary);
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

        });
    </script>
@endsection
