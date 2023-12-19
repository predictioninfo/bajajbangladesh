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
                    <h1 class="card-title text-center"> {{ __(' List') }} </h1>

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        {{-- @if ($add_permission == 'Yes') --}}
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addDeviceAreaModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                        {{-- @endif --}}
                    </ol>

                </div>
            </div>
            <div id="addDeviceAreaModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Add Device Area</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('add-device-area') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Area ID<span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-asterisk"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="device_area_id" value="" required
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Area Name<span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="device_area_name" required value=""
                                                class="form-control">
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
            <div id="editLocationModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-body">
                            <form method="post" action="{{ route('loaction-twos') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ __('Location Label Name') }} *</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="location2" value="" required
                                                class="form-control">
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
            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empolyee Code</th>
                                <th>Empolyee Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee_without_fp as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->company_assigned_id }}</td>
                                    <td>{{ $item['first_name'] }} {{ $item['last_name'] }}</td>
                                    <td>{{ $item['email'] }} </td>
                                    @if ($add_finger_print == 'Yes')
                                        <td>
                                            @if ($add_finger_print == 'Yes')
                                                <a href="#" class="btn btn-info open-area-modal"
                                                    data-id="{{ $item['id'] }}" data-toggle="tooltip"
                                                    title="Add Finger Print">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
    <!-- Add Area Modal structure -->
    <div class="modal fade" id="fingerPrintModal" tabindex="-1" role="dialog"
        aria-labelledby="fingerPrintModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fingerPrintModalLabel">Add Finger Print</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="" action="{{ route('add-employee-with-fp') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="employeeId" id="employeeId">
                        <div class="form-group">
                            <label for="employeeDropdown">Select Device Area:</label>
                            <select class="form-control" id="employeeDropdown" name="device_area_id">
                                <!-- Dropdown options will be populated dynamically -->
                                <option value="">Select Device Area</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- edit boostrap model -->
    {{-- <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('device-area-update') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Area Code</label>
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" name="area_code" id="area_code" readonly class="form-control"
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Area Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="area_name" id="area_name" class="form-control"
                                    value="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div> --}}
    <!-- end bootstrap model -->



    <script type="text/javascript">
        $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

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
                    // Open the modal when the button is clicked
                    $('.open-area-modal').click(function() {
                        var employeeId = $(this).data('id');
                        // Assuming you have a function to fetch employee data dynamically
                        populateEmployeeDropdown(employeeId);
                        $('#fingerPrintModal').modal('show');
                    });

                    function populateEmployeeDropdown(employeeId) {
                        // Use the employeeId parameter in your AJAX call
                        $.ajax({
                            url: '/get-device-area/',
                            method: 'GET',
                            success: function(data) {
                                // console.log(data);
                                var dropdown = $('#employeeDropdown');
                                dropdown.empty();
                                $('#employeeId').val(employeeId);
                                $.each(data, function(key, value) {
                                    dropdown.append($('<option>').text(value.area_name).attr('value', value.id));
                                });
                            },
                            error: function() {
                                console.log('Error fetching employee data.');
                            }
                        });
                    }
                        //value retriving and opening the edit modal starts
                        $('.edit').on('click', function() {
                            var id = $(this).data('id');
                            $.ajax({
                                type: "POST",
                                url: 'device-area-by-id',
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                success: function(res) {
                                    // console.log(res);
                                    $('#ajaxModelTitle').html("Edit");
                                    $('#edit-modal').modal('show');
                                    $('#id').val(res.id);
                                    $('#area_code').val(res.area_code);
                                    $('#area_name').val(res.area_name);
                                }
                            });
                        });

                    });
    </script>
@endsection
