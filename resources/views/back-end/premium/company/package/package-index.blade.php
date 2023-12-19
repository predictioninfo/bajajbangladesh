@extends('back-end.premium.layout.super-system-admin-main')
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

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Package List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                        <li><a href="#">List - {{ 'Package List' }} </a></li>
                    </ol>
                </div>
            </div>

        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Package') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('add-packages') }}" method="post" class="form-horizontal row"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="packageName">Package Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-globe" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="package_name">
                                </div>
                            </div>

                            <div class="form-group mt-4 col-md-12">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus" aria-hidden="true"></i>
                                    Add </button>

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
                            <th>{{ __('Package Name') }}</th>
                            {{-- <th>{{__('Access Modules/Sub-Modules')}}</th> --}}
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php($i = 1)
                        @foreach ($packages as $packages_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $packages_value->package_name }}</td>

                                {{--
                                <td>

                                    @foreach (json_decode($packages_value->package_module) as $package_module_value)

                                    @foreach ($modules as $modules_values)

                                            @if ($modules_values->module_serial_code == $package_module_value)
                                                {{$modules_values->module_name."(M)"}} <br>
                                            @endif

                                    @endforeach

                                    @foreach ($sub_modules as $sub_module_values)

                                        @if ($sub_module_values->sub_module_serial_code == $package_module_value)
                                            {{$sub_module_values->sub_module_name."(SM)"}} <br>
                                        @endif

                                    @endforeach


                                @endforeach

                            </td>
                            --}}


                                <td>
                                    <a href="{{ route('package-permissions', ['id' => $packages_value->id, 'package_name' => $packages_value->package_name]) }}"
                                        class="btn view delete-post" data-toggle="tooltip" title=" Permission " data-original-title="Permission"> <i
                                        class="fa fa-check" aria-hidden="true"></i></a>

                                    <a href="javascript:void(0)" class="btn edit"
                                     data-id="{{ $packages_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                     class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                    <a href="{{ route('delete-package', ['id' => $packages_value->id]) }}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                    data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                       

                                </td>
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
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="packageName">Package Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-globe" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="package_name" id="package_name" class="form-control"
                                        value="">
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
                    url: 'package-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#package_name').val(res.package_name);
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


            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-package`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.success, 'Data successfully updated!!');
                        window.location.reload(true);
                    },
                    error: function(response) {
                        console.log(response);
                        $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends



            ///MULTIPLE PACKAGE SELECT OPTION CODE STARTS FROM HERE
            // $("#package_module_select").select2({
            // placeholder: "Select a Name",
            // allowClear: true,
            // tags:true
            // });
            ///MULTIPLE PACKAGE SELECT OPTION CODE ENDS HERE





        });
    </script>
@endsection
