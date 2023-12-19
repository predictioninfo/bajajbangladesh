@extends('back-end.premium.layout.premium-main')
@section('content')
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
                    <h1 class="card-title text-center"> {{ __('Upazila List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Upazila </a></li>
                    </ol>
                </div>
            </div>

        </div>

        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Upazila') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-upazila') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>District Name</label>

                                        <select name="district_id" class="form-control selectpicker" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="area_name" required>
                                            <option value="">Select-a-District</option>
                                            @foreach ($districts as $districts_value)
                                                <option value="{{ $districts_value->id }}">
                                                    {{ $districts_value->dist_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Upazila Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="up_name" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Upazila Bangla Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="up_bn_name" class="form-control" value="">
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
                            <th>{{ __('District Name') }}</th>
                            <th>{{ __('Upazila Name') }}</th>
                            <th>{{ __('Upazila Bangla Name') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)

                        @foreach ($upazilas as $upazilas_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $upazilas_value->district->dist_name }}</td>
                                <td>{{ $upazilas_value->up_name }}</td>
                                <td>{{ $upazilas_value->up_bn_name }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $upazilas_value->id }}" data-toggle="tooltip" title=""
                                                data-original-title=" Edit "> <i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i> </a>
                                        @endif

                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-upazila', ['id' => $upazilas_value->id]) }}"
                                                onclick="return confirm('Are you sure?')" class="btn btn-danger delete-post"
                                                data-toggle="tooltip" title="" data-original-title=" Delete "><i
                                                    class="fa fa-trash"></i></a>
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
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-upazila') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">District Name</label>
                                <div class="input-group-prepend">

                                </div>
                                <select name="district_id" id="district_id" class="form-control" required>
                                    <option value="">Select-a-District</option>
                                    @foreach ($districts as $districts_value)
                                        <option value="{{ $districts_value->id }}">
                                            {{ $districts_value->dist_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Upazila Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="up_name" id="up_name" class="form-control"
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Upazila Bangla Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="up_bn_name" id="up_bn_name" class="form-control"
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

            //value retriving and opening the edit modal starts
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'upazila-type-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#district_id').val(res.district_id);
                        $('#up_name').val(res.up_name);
                        $('#up_bn_name').val(res.up_bn_name);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            $('#user-table').DataTable({

                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 100,

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
