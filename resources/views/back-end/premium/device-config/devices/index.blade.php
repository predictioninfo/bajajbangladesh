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
            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Serial No</th>
                                <th>IP Address</th>
                                <th>Alias</th>
                                <th>Area</th>
                                <th>Total Employee</th>
                                <th>Total Attandence</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['sn'] }}</td>
                                    <td>{{ $item['ip_address'] }}</td>
                                    <td>{{ $item['alias'] }}</td>
                                    <td>{{ $item['area_name'] }}</td>
                                    <td>{{ $item['user_count'] }}</td>
                                    <td>{{ $item['transaction_count'] }}</td>
                                    @if ($finger_print_sub_module_re_boot == 'Yes')
                                        <td>
                                            @if ($finger_print_sub_module_re_boot == 'Yes')
                                                <form action="{{ route('device-re-boot') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="reboot[]" value="{{ $item['id'] }}">
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="return confirm('Are you sure you want to re-boot this device?');">
                                                        <i class="fa fa-refresh"></i> Re-start
                                                    </button>
                                                </form>
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
    {{-- <div id="addDeviceAreaModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Add Device Area</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Serial Number<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-asterisk" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="sn" value="" required
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label> Name<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="alias" required value=""
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label> Device IP<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="ip_address" required 
                                        class="form-control" value="192.168.1.150" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label> area<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    
                                        <select name="area" id="" class="form-control">
                                            <option value="">Select Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            </div>


                            <div class="col-sm-12 mt-4">

                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus" aria-hidden="true"></i>
                                    Add </button>

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
                                    <input type="text" name="location2" value="" required class="form-control">
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
    </div> --}}

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
        });
    </script>
@endsection
