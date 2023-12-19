@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\Permission;
    
    $core_hr_sub_module_two_add = '4.2.1';
    $core_hr_sub_module_two_edit = '4.2.2';
    $core_hr_sub_module_two_delete = '4.2.3';
    
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
                    <h1 class="card-title text-center"> {{ __('Award List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Award </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row">

                @if ($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-awards')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
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
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Award') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-awards') }}" class="form-horizontal"
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
                                    <select class="form-control" name="employee_id" id="employee_id"></select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Award Type</label>
                                    <select class="form-control" name="award_type_name" required>
                                        <option value="">Select-An-Award-Type</option>
                                        @foreach ($award_types as $award_types_value)
                                            <option value="{{ $award_types_value->variable_type_name }}">
                                                {{ $award_types_value->variable_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Gift</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="award_gift" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Cash</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="award_cash" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Award Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="award_date" class="form-control date" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label> Award Photo </label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="file" name="award_photo" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="my-textarea">Award Information</label>
                                    <textarea class="form-control" name="award_info"></textarea>
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
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Award Name') }}</th>
                            <th>{{ __('Gift') }}</th>
                            <th>{{ __('Cash') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Award Photo') }}</th>
                            <th>{{ __('Award Info') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($awards as $awards_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $awards_value->first_name . ' ' . $awards_value->last_name }}</td>
                                <td>{{ $awards_value->department_name }}</td>
                                <td>{{ $awards_value->award_type_name }}</td>
                                <td>{{ $awards_value->award_gift }}</td>
                                <td>{{ $awards_value->award_cash }}</td>
                                <td>{{ $awards_value->award_date }}</td>
                                <td><img width="150" src="{{ asset($awards_value->award_photo) }}"></td>
                                <td>{{ $awards_value->award_info }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $awards_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-awards', ['id' => $awards_value->id]) }}"
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
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-awards') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="department_id" id="edit_department_id_hidden">
                        <input type="hidden" name="employee_id" id="edit_employee_id_hidden">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="edit_department_id" id="edit_department_id">
                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}"
                                            {{ old('department_name') == $departments_value->id ? 'selected' : '' }}>
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="edit_employee_id" id="edit_employee_id">
                                    @foreach ($employees as $employees_value)
                                        <option value="{{ $employees_value->id }}"
                                            {{ old('first_name') == $employees_value->id ? 'selected' : '' }}>
                                            {{ $employees_value->first_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Award Type</label>
                                <select class="form-control" name="award_type_name" id="award_type_name" required>
                                    <option value="">Select-An-Award-Type</option>
                                    @foreach ($award_types as $award_types_value)
                                        <option value="{{ $award_types_value->variable_type_name }}">
                                            {{ $award_types_value->variable_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Gift</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-gift" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="award_gift" id="award_gift" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Cash</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="award_cash" id="award_cash" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Award Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="award_date" id="award_date" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Award Photo</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-picture-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="file" name="award_photo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="my-textarea">Award Information</label>
                                <textarea class="form-control" name="award_info" id="award_info"></textarea>
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
                    url: 'award-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_department_id').val(res.award_department_id);
                        $('#edit_employee_id').val(res.award_employee_id);
                        $('#award_type_name').val(res.award_type_name);
                        $('#award_gift').val(res.award_gift);
                        $('#award_cash').val(res.award_cash);
                        $('#award_date').val(res.award_date);
                        $('#award_info').val(res.award_info);
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
                                    $('select[name="employee_id"]').append(
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
                        url: '/get-department-wise-employee/' + departmentID,
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
                                    $('select[name="edit_employee_id"]').append(
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






        });
    </script>
@endsection
