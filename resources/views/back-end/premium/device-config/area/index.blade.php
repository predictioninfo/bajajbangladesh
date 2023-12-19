@extends('back-end.premium.layout.premium-main')

@section('content')
    <section class="main-contant-section">

        <div class="mb-3">

            @if (Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{!! Session::get('message') !!}</strong>
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
                                <th>Area Code</th>
                                <th>Area Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['area_code'] }}</td>
                                    <td>{{ $item['area_name'] }}</td>
                                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                        <td>
                                            @if ($edit_permission == 'Yes')
                                                <a href="javascript:void(0)" class="btn edit"
                                                    data-id="{{ $item['id'] }}" data-toggle="tooltip" title=""
                                                    data-original-title=" Edit "> <i class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i> </a>
                                            @endif
                                            @if ($delete_permission == 'Yes')
                                                <a onclick="return confirm('Are you sure you want to delete this item?');"
                                                    href="{{ route('delete-device-area', ['id' => $item['id']]) }}"
                                                    class="btn btn-danger" data-id="{{ $item['id'] }}"
                                                    data-toggle="tooltip" title="" data-original-title=" Delete ">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> </a>
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

    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
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
    </div>
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
