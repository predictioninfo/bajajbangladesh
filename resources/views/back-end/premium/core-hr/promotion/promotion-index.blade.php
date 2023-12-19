@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\Department;
    use App\Models\Designation;
    use App\Models\Permission;
    
    $core_hr_sub_module_one_add = '4.1.1';
    $core_hr_sub_module_one_edit = '4.1.2';
    $core_hr_sub_module_one_delete = '4.1.3';
    
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
                    <h1 class="card-title text-center"> {{ __('Promotion / Demotion List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Promotion / Demotion </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row">

                @if ($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-promotions')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
                        <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                    </form>
                </div>
                @endif
            </div> --}}

        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Promotion/Demotion') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-promotions') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="department_id" id="department_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="promotion_employee_id" id="employee_id"></select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>New Department</label>
                                    <select class="form-control" name="new_department_id" id="new_department_id" required>
                                        <option value="">Select-A-New-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('New Designation') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="form-control" name="new_designation_id" id="designation_id"
                                        required></select>

                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Old Gross Salary : </label>
                                    <span class="form-control" id="employee_old_gross_salary"></span>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>New Gross Salary : <span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="new_gross_salary" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Promotion Title <span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-text-height"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="promotion_title" class="form-control" value=""
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Promotion Date <span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="promotion_date" class="form-control" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Promotion Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="promotion_description" required></textarea>
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
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Old Department') }}</th>
                            <th>{{ __('New Department') }}</th>
                            <th>{{ __('Old Designation') }}</th>
                            <th>{{ __('New Designation') }}</th>
                            <th>{{ __('Old Gross Salary') }}</th>
                            <th>{{ __('New Gross Salary') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Promotion Date') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Download') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($promotions as $promotions_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <?php
                                $employee_name = User::where('id', $promotions_value->promotion_employee_id)->get(['first_name', 'last_name']);
                                $old_department_name = Department::where('id', $promotions_value->promotion_old_department)->get(['department_name']);
                                $new_department_name = Department::where('id', $promotions_value->promotion_new_department)->get(['department_name']);
                                $old_designation_name = Designation::where('id', $promotions_value->promotion_old_designation)->get(['designation_name']);
                                $new_designation_name = Designation::where('id', $promotions_value->promotion_new_designation)->get(['designation_name']);
                                ?>

                                <td><?php foreach ($employee_name as $employee_name_value) {
                                    echo $employee_name_value->first_name . ' ' . $employee_name_value->last_name;
                                } ?></td>
                                <td><?php foreach ($old_department_name as $old_department_name_value) {
                                    echo $old_department_name_value->department_name;
                                } ?></td>
                                <td><?php foreach ($new_department_name as $new_department_name_value) {
                                    echo $new_department_name_value->department_name;
                                } ?></td>
                                <td><?php foreach ($old_designation_name as $old_designation_name_value) {
                                    echo $old_designation_name_value->designation_name;
                                } ?></td>
                                <td><?php foreach ($new_designation_name as $new_designation_name_value) {
                                    echo $new_designation_name_value->designation_name;
                                } ?></td>
                                <td>{{ $promotions_value->promotion_old_gross_salary }}</td>
                                <td>{{ $promotions_value->promotion_new_gross_salary }}</td>
                                <td>{{ $promotions_value->promotion_title }}</td>
                                <td>{{ $promotions_value->promotion_date }}</td>
                                <td>{{ $promotions_value->promotion_description }}</td>
                                <td>
                                    <form method="post" action="{{route('promotion-letter-downloads')}}" >
                                         @csrf
                                         <input type="hidden"  name="id" value="{{$promotions_value->id}}" required>
                                         <button type="submit">{{__('Download')}}</button>
                                    </form>
                                </td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $promotions_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-promotions', ['id' => $promotions_value->id]) }}"
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
                    <form method="post" action="{{ route('update-promotions') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>
                        <input type="hidden" name="promoted_employee_id" id="promoted_employee_id" required>
                        <div class="row">


                            <div class="col-md-4 form-group">
                                <label>New Department</label>
                                <select class="form-control" name="new_department_id" id="edit_new_department_id"
                                    required>

                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}"
                                            {{ old('department_name') == $departments_value->id ? 'selected' : '' }}>
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('New Designation') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control" name="new_designation_id" id="edit_designation_id">
                                    @foreach ($designations as $designations_value)
                                        <option value="{{ $designations_value->id }}"
                                            {{ old('designation_name') == $designations_value->id ? 'selected' : '' }}>
                                            {{ $designations_value->designation_name }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>New Gross Salary : </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="new_gross_salary" id="edit_new_gross_salary"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Promotion Title</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="promotion_title" id="promotion_title"
                                        class="form-control" value="" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Promotion Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="promotion_date" id="promotion_date" class="form-control"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Promotion Description</label>
                                <textarea class="form-control" name="promotion_description" id="promotion_description" required></textarea>
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
                    url: 'promotion-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#promoted_employee_id').val(res.promotion_employee_id);
                        $('#edit_new_department_id').val(res.promotion_new_department);
                        $('#edit_designation_id').val(res.promotion_new_designation);
                        $('#edit_new_gross_salary').val(res.promotion_new_gross_salary);
                        $('#promotion_title').val(res.promotion_title);
                        $('#promotion_date').val(res.promotion_date);
                        $('#promotion_description').val(res.promotion_description);
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
                        url: '/get-department-wise-employee/' + departmentID,
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
                                    $('select[name="promotion_employee_id"]').append(
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


            $('#new_department_id').on('change', function() {
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
                                    $('select[name="new_designation_id"]').append(
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

            $('#edit_new_department_id').on('change', function() {
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
                                    $('select[name="new_designation_id"]').append(
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


            $('#employee_id').on('change', function() {
                var employeeID = $(this).val();
                //console.log(employeeID);
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
