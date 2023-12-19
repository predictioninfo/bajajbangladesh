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
                    <h1 class="card-title text-center"> {{ __('Variable Method') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - Variable Method </a></li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                    <li class="active"><a data-toggle="tab" href="#home">Arrangement Method</a></li>
                    <li><a data-toggle="tab" href="#menu1">Payment Type</a></li>
                    <li><a data-toggle="tab" href="#menu2">Qualification</a></li>
                    <li><a data-toggle="tab" href="#menu3">Job Category</a></li>
                    <li><a data-toggle="tab" href="#menu4">Job Location</a></li>

                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">

            <div id="home" class="tab-pane fade in active show">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addModalArrangement">
                                <i class="fa fa-plus"></i> {{ __('Add Arrangement Type') }}
                            </button>
                        @endif
                    </div>

                    <!--Arrangement Add Modal Starts -->

                    <div id="addModalArrangement" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-arrangement-methods') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_method_name" class="form-control"
                                                    value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                            <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Arrangement Add Modal Ends -->

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
                                    @foreach ($arrangement_methods as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->variable_method_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-methods', ['id' => $value->id]) }}"
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


            <div id="menu1" class="tab-pane fade">
                <section>
                    <div class=" mb-3">
                        @if ($add_permission == 'Yes')
                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                data-target="#addModalPayment">
                                <i class="fa fa-plus"></i> {{ __('Add Payment Type') }}
                            </button>
                        @endif

                    </div>


                    <!--Payment Add Modal Starts -->

                    <div id="addModalPayment" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-payment-type-methods') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_method_name" class="form-control"
                                                    value="" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-4">
                                            <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Payment Add Modal Ends -->
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
                                    @foreach ($payment_type_methods as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->variable_method_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-methods', ['id' => $value->id]) }}"
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
                                data-target="#addModalQualification">
                                <i class="fa fa-plus"></i> {{ __('Add Qualification') }}
                            </button>
                        @endif

                    </div>


                    <!--Qualification Add Modal Starts -->

                    <div id="addModalQualification" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-qualification-methods') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_method_name" class="form-control"
                                                    value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Qualification Add Modal Ends -->

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
                                    @foreach ($qualification_methods as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->variable_method_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-methods', ['id' => $value->id]) }}"
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
                                data-target="#addModalJob">
                                <i class="fa fa-plus"></i> {{ __('Add Job Category') }}
                            </button>
                        @endif

                    </div>


                    <!--Job Add Modal Starts -->

                    <div id="addModalJob" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-job-category-methods') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_method_name" class="form-control"
                                                    value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                            <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Job Add Modal Ends -->

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
                                    @foreach ($job_category_name_methods as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->variable_method_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                <td>
                                                    @if ($edit_permission == 'Yes')
                                                        <a href="javascript:void(0)" class="btn edit"
                                                            data-id="{{ $value->id }}" data-toggle="tooltip"
                                                            title="" data-original-title=" Edit "> <i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($delete_permission == 'Yes')
                                                        <a href="{{ route('delete-variable-methods', ['id' => $value->id]) }}"
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
                                data-target="#addModalJobLocation">
                                <i class="fa fa-plus"></i> {{ __('Add Job Location') }}
                            </button>
                        @endif

                    </div>


                    <!--Job Add Modal Starts -->

                    <div id="addModalJobLocation" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('add-job-location-methods') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_method_name" class="form-control"
                                                    value="" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                            <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                                <!-- <input type="submit" name="action_button" class="btn btn-grad"
                                                    value="{{ __('Add') }}" /> -->
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Job Add Modal Ends -->

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
                                    @foreach ($job_location_name_methods as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->variable_method_name }}</td>
                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                            <td>
                                                @if ($edit_permission == 'Yes')
                                                    <a href="javascript:void(0)" class="btn edit"
                                                        data-id="{{ $value->id }}" data-toggle="tooltip"
                                                        title="" data-original-title=" Edit "> <i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                                @endif
                                                @if ($delete_permission == 'Yes')
                                                    <a href="{{ route('delete-variable-methods', ['id' => $value->id]) }}"
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
                    <form method="post" action="{{ route('update-variable-methods') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                        <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Name</label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fa fa-user-secret" aria-hidden="true"></i> </span>
                                                    </div>
                                                    <input type="text" name="variable_method_name" id="variable_method_name"
                                    class="form-control" value="" required>
                                                </div>
                                            </div>
                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad ">Save changes</button>
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
        //value retriving and opening the edit modal starts

        $('.edit').on('click', function() {
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                url: 'variable-method-by-id',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#variable_method_name').val(res.variable_method_name);
                }
            });
        });

        //value retriving and opening the edit modal ends
    </script>
@endsection
