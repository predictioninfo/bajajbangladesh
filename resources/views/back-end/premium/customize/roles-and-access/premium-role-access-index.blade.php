@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\Permission;

    $customize_sub_module_one_add = '3.1.1';
    $customize_sub_module_one_edit = '3.1.2';
    $customize_sub_module_one_delete = '3.1.3';

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
                    <h1 class="card-title text-center"> {{ __('Roles & Access List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                         <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Role & Access</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Role') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-roles') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Role Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-info-circle"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="roles_name" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Role Description</label>
                                    <textarea class="form-control" name="roles_description"></textarea>
                                </div>
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <input class="form-check-input" type="checkbox" name="roles_admin_status" value="Yes"
                                        title="Role Admin Status" id="roles_admin">
                                    <label class="not-selectable" for="roles_admin" style="margin-top:10px;">Role Admin
                                        Status</label>
                                </div>

                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <input class="form-check-input" type="checkbox" name="roles_bulk_status" value="Yes"
                                        title="Bulk Employee Role Status" id="roles_bulk">
                                    <label class="not-selectable" for="roles_bulk" style="margin-top:10px;">Bulk Employee
                                        Role Status</label>
                                </div>
                                <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                    <input class="form-check-input" type="checkbox" name="active" value="1"
                                        title="Active" id="active_status">
                                    <label class="not-selectable" for="active_status"
                                        style="margin-top:10px;">Active</label>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Add</button>
                                    <!-- <input type="submit" name="action_button" class="btn btn-grad mt-4"
                                            value="{{ __('Add') }}" /> -->
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
                            <th>{{ __('Role Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Is Admin') }}</th>
                            <th>{{ __('Is Employee Bulk Import Role') }}</th>
                            <th>{{ __('Status') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || $access_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($roles as $rolesValue)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $rolesValue->roles_name ?? '' }}</td>
                                <td>{{ $rolesValue->roles_description ?? '' }}</td>
                                <td>
                                    @if ($rolesValue->roles_admin_status)
                                        {{ $rolesValue->roles_admin_status }}
                                    @else
                                        {{ __('No') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($rolesValue->roles_bulk_status)
                                        {{ $rolesValue->roles_bulk_status }}
                                    @else
                                        {{ __('No') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($rolesValue->roles_is_active == 1)
                                        {{ __('Active') }}@else{{ __('Inactive') }}
                                    @endif
                                </td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || $access_permission == 'Yes')
                                    <td>

                                        @if ($access_permission == 'Yes')
                                            <a href="{{ route('role-access-permissions', ['id' => $rolesValue->id, 'roles_name' => $rolesValue->roles_name]) }}" data-toggle="tooltip" title="" data-original-title="Permission"
                                                class=" btn attandance"> <i class="fa fa-superpowers"></i></a>
                                        @endif
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit" data-id="{{ $rolesValue->id }}" data-toggle="tooltip" title="" data-original-title="Edit">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-roles', ['id' => $rolesValue->id]) }}" data-toggle="tooltip" title="" data-original-title="Delete"
                                                class=" btn btn-danger delete-post"> <i class="fa fa-trash"></i></a>
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
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Role Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-info-circle"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="roles_name" id="roles_name" class="form-control"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Role Description</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-info-circle"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="roles_description" id="roles_description"
                                        class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <input class="form-check-input" type="checkbox" name="roles_admin_status"
                                    id="roles_admin_status" value="Yes" title="Role Admin Status">
                                <label class="not-selectable"for="roles_admin_status" style="margin-top:10px;">Role Admin
                                    Status</label>
                            </div>

                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <input class="form-check-input" type="checkbox" name="roles_bulk_status" value="Yes"
                                    id="roles_bulk_status">
                                <label class="not-selectable" for="roles_bulk_status" style="margin-top:10px;">Bulk
                                    Employee Role Status</label>
                            </div>
                            <div class="col-md-5 form-group check-box" style="margin-left:20px;">
                                <input class="form-check-input" type="checkbox" name="active" value="1"
                                    id="active">
                                <label class="not-selectable" for="active" style="margin-top:10px;">Active</label>
                            </div>

                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad"> Save Change </button>
                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                    value="{{ __('Save changes') }}" /> -->

                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>


    {{-- <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Role Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="roles_name" id="roles_name" class="form-control"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="roles_description" id="roles_description"
                                    class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-4 form-group" style="margin-left:40px;">
                            <input class="form-check-input" type="checkbox" name="active" value="1">
                            <label>Active</label>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn w-50 btn-grad">Save changes
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


            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'role-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        // console.log(res.roles_admin_status);
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#roles_name').val(res.roles_name);
                        $('#roles_description').val(res.roles_description);
                        if (res.roles_admin_status == 'Yes') {
                            $("#roles_admin_status").attr("checked", true);
                        } else {
                            $("#roles_admin_status").attr("checked", false);
                        }
                        if (res.roles_bulk_status == 'Yes') {
                            $("#roles_bulk_status").attr("checked", true);
                        } else {
                            $("#roles_bulk_status").attr("checked", false);
                        }
                        if (res.roles_is_active == 1) {
                            $("#active").attr("checked", true);
                        } else {
                            $("#active").attr("checked", false);
                        }
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
                    url: `/update-role`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        toastr.success(response.success, 'Data successfully updated!!');
                        setTimeout(function() {
                            window.location.href = '/role';
                        }, 2000)
                    },
                    error: function(response) {
                        toastr.error(response.error, 'Please Entry Valid Data!!');

                        // console.log(response);
                        //     $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends








        });
    </script>
@endsection
