@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">


        <div class="mb-3">

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
                    <h1 class="card-title text-center"> {{ __('Asset List') }} </h1>
                    <nav aria-label="breadcrumb">
                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                            <li><a href="#">List - Asset </a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <div class="d-flex flex-row mt-3">
                   
                    @if ($delete_permission == 'Yes')
    <div class="p-1">
                        <form method="post" action="{{ route('bulk-delete-assets') }}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bulk_delete_asset_com_id" value="{{ Auth::user()->com_id }}" class="form-check-input">
                            <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
                        </form>
                    </div>
    @endif
                </div> -->


        </div>



        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Asset') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-assets') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Asset Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="asset_name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Asset Code</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-codiepie"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="asset_code" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Asset Category</label>
                                    <select class="form-control" name="asset_category_name" required>
                                        <option value="">Select-An-Asset-Category</option>
                                        @foreach ($asset_categories as $asset_categories_value)
                                            <option value="{{ $asset_categories_value->asset_category_name }}">
                                                {{ $asset_categories_value->asset_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Is Working</label>
                                    <select class="form-control" name="asset_is_working" required>
                                        <option value="">Selecting...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="On Maintenance">On Maintenance</option>

                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="asset_department_id" id="asset_department_id"
                                        required>
                                        <option value="">Select-A-Department</option>
                                        @foreach ($departments as $departments_value)
                                            <option value="{{ $departments_value->id }}">
                                                {{ $departments_value->department_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="text-bold">{{ __('Employee') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="asset_employee_id"
                                        id="asset_employee_id"></select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Purchase Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="asset_purchase_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Warranty/AMC End Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="asset_warranty_end_date" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Manufacturer</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i
                                                    class="fa fa-american-sign-language-interpreting"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="asset_manufacturer" class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Serial Number</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-list-ol"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="asset_serial_number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="my-textarea">Asset Note</label>
                                    <textarea class="form-control" name="asset_note"></textarea>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Asset Image</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="file" name="asset_image" class="form-control" required>
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

        <!-- Add Modal Ends -->
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Asset Name') }}</th>
                            <th>{{ __('Asset Code') }}</th>
                            <th>{{ __('Asset Category') }}</th>
                            <th>{{ __('Asset Is Working') }}</th>
                            <th>{{ __('Purchase Date') }}</th>
                            <th>{{ __('Warranty End Date') }}</th>
                            <th>{{ __('Asset Manufacturer') }}</th>
                            <th>{{ __('Asset Serial Number') }}</th>
                            <th>{{ __('Asset Note') }}</th>
                            <th>{{ __('Asset Image') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($assets as $assets_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $assets_value->assetuser->first_name }} {{ $assets_value->assetuser->last_name }}
                                </td>
                                <td>{{ $assets_value->assetdepartment->department_name }} </td>
                                <td>{{ $assets_value->asset_name }}</td>
                                <td>{{ $assets_value->asset_code }}</td>
                                <td>{{ $assets_value->asset_category_name }}</td>
                                <td>{{ $assets_value->asset_is_working }}</td>
                                <td>{{ $assets_value->asset_purchase_date }}</td>
                                <td>{{ $assets_value->asset_warranty_end_date }}</td>
                                <td>{{ $assets_value->asset_manufacturer }}</td>
                                <td>{{ $assets_value->asset_serial_number }}</td>
                                <td>{{ $assets_value->asset_note }}</td>
                                <td><img width="150" src="{{ asset($assets_value->asset_image) }}"></td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <td>
                                    @if ($edit_permission == 'Yes')
                                    <a href="javascript:void(0)" class="btn edit"
                                    data-id="{{ $assets_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    @endif
                                    @if ($delete_permission == 'Yes')
                                    <a href="{{ route('delete-assets', ['id' => $assets_value->id]) }}"
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
                    <form method="post" action="{{ route('update-assets') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Asset Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="asset_name" id="asset_name" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Asset Code</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-codiepie" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="asset_code" id="asset_code" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Asset Category</label>
                                <select class="form-control" name="asset_category_name" id="asset_category_name"
                                    required>
                                    <option value="">Select-An-Asset-Category</option>
                                    @foreach ($asset_categories as $asset_categories_value)
                                        <option value="{{ $asset_categories_value->asset_category_name }}">
                                            {{ $asset_categories_value->asset_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Is Working</label>
                                <select class="form-control" name="asset_is_working" id="asset_is_working" required>
                                    <option value="">Selecting...</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="On Maintenance">On Maintenance</option>

                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Department</label>
                                <select class="form-control" name="edit_asset_department_id"
                                    id="edit_asset_department_id" required>
                                    <option value="">Select-A-Department</option>
                                    @foreach ($departments as $departments_value)
                                        <option value="{{ $departments_value->id }}">
                                            {{ $departments_value->department_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="edit_asset_employee_id" id="edit_asset_employee_id">
                                    @foreach ($employees as $employees_value)
                                        <option value="{{ $employees_value->id }}">{{ $employees_value->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Purchase Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="asset_purchase_date" id="asset_purchase_date"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Warranty/AMC End Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="asset_warranty_end_date" id="asset_warranty_end_date"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Manufacturer</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="asset_manufacturer" id="asset_manufacturer"
                                        class="form-control" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Serial Number</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="asset_serial_number" id="asset_serial_number"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="my-textarea">Asset Note</label>
                                <textarea class="form-control" name="asset_note" id="asset_note"></textarea>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Asset Image</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-picture-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="file" name="asset_image" class="form-control">
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
                    url: 'asset-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_asset_employee_id').val(res.asset_employee_id);
                        $('#edit_asset_department_id').val(res.asset_department_id);
                        $('#asset_name').val(res.asset_name);
                        $('#asset_code').val(res.asset_code);
                        $('#asset_category_name').val(res.asset_category_name);
                        $('#asset_is_working').val(res.asset_is_working);
                        $('#asset_purchase_date').val(res.asset_purchase_date);
                        $('#asset_warranty_end_date').val(res.asset_warranty_end_date);
                        $('#asset_manufacturer').val(res.asset_manufacturer);
                        $('#asset_serial_number').val(res.asset_serial_number);
                        $('#asset_note').val(res.asset_note);
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



            $('#asset_department_id').on('change', function() {
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
                                $('#asset_employee_id').empty();
                                $('#asset_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="asset_employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + '(' +
                                        employees.first_name + ' ' + employees
                                        .last_name + ')' + '</option>');
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

            $('#edit_asset_department_id').on('change', function() {
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
                                $('#edit_asset_employee_id').empty();
                                $('#edit_asset_employee_id').append(
                                    '<option hidden>Choose an Employee</option>');
                                $.each(data, function(key, employees) {
                                    $('select[name="edit_asset_employee_id"]').append(
                                        '<option value="' + employees.id + '">' +
                                        employees.company_assigned_id + '(' +
                                        employees.first_name + ' ' + employees
                                        .last_name + ')' + '</option>');
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
