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
                    <h1 class="card-title text-center"> {{ __('Manage Leave Type') }} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            @if ($add_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                <li><a href="#" type="button" data-toggle="modal"
                                        data-target="#addDepartmentModal"><span class="icon icon-plus"> </span>Add</a></li>
                            @endif
                            <li><a href="#">List - Leave Type </a></li>
                        </ol>

                    </nav>
                </div>
            </div>


            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Leave') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('add-leave-types') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Leave Type</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-life-ring"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="leave_type" class="form-control date"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Day Allocating</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="allocated_day" class="form-control date"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>Activation Days (Optional)</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="activation_days" class="form-control date"
                                                value="">
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
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Allocated Day') }}</th>
                                <th>{{ __('Activation Days') }}</th>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                    <th>{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($leave_types as $leave_types_value)
                                <tr>

                                    <td>{{ $i++ }}</td>
                                    <td>{{ $leave_types_value->leave_type }}</td>
                                    <td>{{ $leave_types_value->allocated_day }}</td>
                                    <td>{{ $leave_types_value->activation_days }}</td>

                                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                        <td>

                                            @if ($edit_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                                <a href="javascript:void(0)" class="btn  edit"
                                                    data-id="{{ $leave_types_value->id }}" data-toggle="tooltip"
                                                    title=" Edit " data-original-title="Edit"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                                            @endif
                                            {{-- @if ($delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                                <a href="{{ route('delete-leave-types', ['id' => $leave_types_value->id]) }}"
                                                    class="btn btn-danger delete-post" data-toggle="tooltip"
                                                    title=" Delete " data-original-title="Delete"> <i class="fa fa-trash-o"
                                                        aria-hidden="true"></i></a>
                                            @endif --}}
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
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-leave-types') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label>Leave Type</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-life-ring" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="leave_type" id="leave_type" class="form-control"
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label>Day Allocating</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="allocated_day" id="allocated_day" class="form-control"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label>Activation Days (Optional)</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-calendar"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" name="activation_days" id="activation_days" class="form-control date"
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
                    url: 'leave-type-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit Leave Type");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#leave_type').val(res.leave_type);
                        $('#allocated_day').val(res.allocated_day);
                        $('#activation_days').val(res.activation_days);
                    }
                });
            });

            //value retriving and opening the edit modal ends








        });
    </script>
@endsection
