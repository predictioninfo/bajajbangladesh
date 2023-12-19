@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">
        <div class="">
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
                    <h1 class="card-title text-center"> {{ __('Variable Type List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - Variable Type </a></li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                    <li class="active"><a data-toggle="tab" href="#home">Award Type</a></li>
                    <li><a data-toggle="tab" href="#menu2">Warning Type</a></li>
                    <li><a data-toggle="tab" href="#menu3">Termination Type</a></li>
                    <li><a data-toggle="tab" href="#menu4">Job Status</a></li>
                    <li><a data-toggle="tab" href="#menu5">Office Shift Type</a></li>
                    <li><a data-toggle="tab" href="#menu6">Document Type</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">

            <div id="home" class="tab-pane fade in active show">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addModalAward">
                                <i class="fa fa-plus"></i> {{ __('Add Award Type') }}
                            </button>
                        @endif

                    </div>


                    <!--Award Add Modal Starts -->

                    <div id="addModalAward" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Award Type') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-award-types') }}" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_type_name" class="form-control"
                                                        value="" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-4">
                                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                        aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad "
                                                        value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Award Add Modal Ends -->
                    <div class="content-box">

                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($award_types as $award_types_value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $award_types_value->variable_type_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $award_types_value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-types', ['id' => $award_types_value->id]) }}"
                                                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                            data-original-title=" Delete "> <i class="fa fa-trash-o"
                                                                aria-hidden="true"></i> </a>
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

            </div>



            <div id="menu2" class="tab-pane fade">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addModalWarning">
                                <i class="fa fa-plus"></i> {{ __('Add Warning Type') }}
                            </button>
                        @endif

                    </div>

                    <!-- Warning Add Modal Starts -->

                    <div id="addModalWarning" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Warning Type') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-warning-types') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_type_name" class="form-control"
                                                        value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                        aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Warning Add Modal Ends -->
                    <div class="content-box">

                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($i = 1)
                                    @foreach ($warning_types as $warning_types_value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $warning_types_value->variable_type_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $warning_types_value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-types', ['id' => $warning_types_value->id]) }}"
                                                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                            data-original-title=" Delete "> <i class="fa fa-trash-o"
                                                                aria-hidden="true"></i> </a>
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
            </div>
            <div id="menu3" class="tab-pane fade">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addModalTermination">
                                <i class="fa fa-plus"></i> {{ __('Add Termination Type') }}
                            </button>
                        @endif

                    </div>


                    <!--Termination Add Modal Starts -->

                    <div id="addModalTermination" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Termination Type') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-termination-types') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_type_name" class="form-control"
                                                        value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                        aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Termination Add Modal Ends -->
                    <div class="content-box">

                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($i = 1)
                                    @foreach ($termination_types as $termination_types_value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $termination_types_value->variable_type_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $termination_types_value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-types', ['id' => $termination_types_value->id]) }}"
                                                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                            data-original-title=" Delete "> <i class="fa fa-trash-o"
                                                                aria-hidden="true"></i> </a>
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
            </div>
            <div id="menu4" class="tab-pane fade">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addModalJobType">
                                <i class="fa fa-plus"></i> {{ __('Add Job Status Type') }}
                            </button>
                        @endif

                    </div>

                    <!--Job Type Add Modal Starts -->

                    <div id="addModalJobType" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Job Status Type') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-job-status-types') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_type_name" class="form-control"
                                                        value="" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-4">
                                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                        aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Job Type  Add Modal Ends -->
                    <div class="content-box">

                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($i = 1)
                                    @foreach ($job_status_types as $job_status_types_value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $job_status_types_value->variable_type_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $job_status_types_value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-types', ['id' => $job_status_types_value->id]) }}"
                                                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                            data-original-title=" Delete "> <i class="fa fa-trash-o"
                                                                aria-hidden="true"></i> </a>
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
            </div>



            <div id="menu5" class="tab-pane fade">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addOfficeShift">
                                <i class="fa fa-plus"></i> {{ __('Add Office Shift Type') }}
                            </button>
                        @endif

                    </div>

                    <!-- Warning Add Modal Starts -->

                    <div id="addOfficeShift" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Office Shift Type') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-office-shift-types') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Office Shift Type Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_type_name" class="form-control"
                                                        value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                        aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Warning Add Modal Ends -->
                    <div class="content-box">

                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($i = 1)
                                    @foreach ($office_shift_types as $office_shift_types_value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $office_shift_types_value->variable_type_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $office_shift_types_value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-types', ['id' => $office_shift_types_value->id]) }}"
                                                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                            data-original-title=" Delete "> <i class="fa fa-trash-o"
                                                                aria-hidden="true"></i> </a>
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
            </div>

            <div id="menu6" class="tab-pane fade">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addDocumnetType">
                                <i class="fa fa-plus"></i> {{ __('Add Document Type') }}
                            </button>
                        @endif

                    </div>

                    <!-- Warning Add Modal Starts -->
                    <div id="addDocumnetType" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Documnet Type') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-documnet-types') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Documnet Type Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                                aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_type_name" class="form-control"
                                                        value="" required>
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

                    <!-- Warning Add Modal Ends -->
                    <div class="content-box">

                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($documnets_types as $documnets_type)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $documnets_type->variable_type_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $documnets_type->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-types', ['id' => $documnets_type->id]) }}"
                                                            class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                            data-original-title=" Delete "> <i class="fa fa-trash-o"
                                                                aria-hidden="true"></i> </a>
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
            </div>


        </div>

    </section>


    </section>


    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user-secret"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="variable_type_name" id="variable_type_name"
                                        class="form-control" value="" required>
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

    <!-- <p id="error-message"></p>    -->
    <script type="text/javascript">
        //value retriving and opening the edit modal starts

        $('.edit').on('click', function() {
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                url: 'variable-type-by-id',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#variable_type_name').val(res.variable_type_name);
                }
            });
        });

        //value retriving and opening the edit modal ends

        // edit form submission starts

        $('#edit_form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            console.log(formData);
            $('#error-message').text('');

            $.ajax({
                type: 'POST',
                url: `/update-variable-type`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    toastr.success(response.success, 'Data successfully updated!!');
                    window.location.reload(true);
                },
                error: function(response) {
                    toastr.error(response.error, 'Please Entry Valid Data!!');

                }
            });
        });

        // edit form submission ends
    </script>
@endsection
