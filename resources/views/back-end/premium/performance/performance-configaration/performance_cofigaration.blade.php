@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="forms main-contant-section">
        <div class="employee-basic-information">
            <div class="row">
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="content-box">

                            <div class="profile-content">
                                <ul>
                                    <li> <a href="{{ route('performance-configarations') }}"> <span>Objective Type
                                            </span> </a> </li>
                                    <li> <a href="#objective_point" data-tab="objective_point" active=""> Objective
                                            Highest Rating </a>
                                    </li>
                                    <li> <a href="#objective_scale" data-tab="objective_scale" active=""> Objective
                                            Rating Defination</a>
                                    </li>
                                    <li> <a href="#yearly_review" data-tab="yearly_review">Yearly Review Time Set</a> </li>
                                    <li> <a href="#p_d_point" data-tab="p_d_point"> <span> Promotion/Demotion Rating Config
                                            </span> </a> </li>
                                    <li> <a href="#increment_point" data-tab="increment_point"> <span>
                                                Increment Rating</span> </a> </li>
                                    <li> <a href="#value_type" data-tab="value_type"> <span>
                                                Value Type </span> </a> </li>
                                    <li> <a href="#value_type_details" data-tab="value_type_details">
                                            <span> Value Type Details </span> </a> </li>
                                    <li> <a href="#recommendation_set_up" data-tab="recommendation_set_up">
                                            <span> Recommendation type</span> </a> </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card h-100">
                        <div class="content-box">
                            <div class="tabList">
                                <a href="#orange" data-tab="orange" class="">
                                </a>
                            </div>
                            <div class="tab-content">

                                {{-- Objective Type Start --}}
                                <div id="orange" class="b-tab active">
                                    <div class="">
                                        <div class=" mb-3">
                                            @if (Session::get('message'))
                                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                    <strong>{{ Session::get('message') }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong class="text-danger">{{ $error }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endforeach

                                            <div class="card mb-4">
                                                <div class="card-header with-border">
                                                    <h1 class="card-title text-center"> Objectives Type List</h1>
                                                </div>
                                            </div>


                                                <button type="button" class="edit-btn btn btn-grad mr-2"
                                                    data-toggle="modal" data-target="#addModal">
                                                    <i class="fa fa-plus"></i> {{ __('Add Objective Type') }}
                                                </button>

                                        </div>


                                            <!-- Add Modal Starts -->
                                            <div id="addModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 id="exampleModalLabel" class="modal-title">
                                                                {{ _('Add Objective Type') }}</h5>
                                                            <button type="button" data-dismiss="modal" id="close"
                                                                aria-label="Close" class="close"><i
                                                                    class="dripicons-cross"></i></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('add-objective-types') }}"
                                                                class="form-horizontal" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label>Objective Type</label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"> <i
                                                                                    class="fa fa-text-height"
                                                                                    aria-hidden="true"></i> </span>
                                                                        </div>
                                                                        <input type="text" name="objective_type_name"
                                                                            class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 mt-4">
                                                                    <button class="btn btn-grad" type="submit"> <i
                                                                            class="fa fa-plus" aria-hidden="true"></i> Add
                                                                    </button>

                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Add Modal Ends -->

                                        <div class="table-responsive">
                                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Objective Type</th>
                                                        <th>Action</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i = 1)
                                                    @foreach ($objective_types as $objective_types_value)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $objective_types_value->objective_type_name }}</td>

                                                                <td>

                                                                        <a href="javascript:void(0)"
                                                                            class="btn objective_type edit"
                                                                            data-id="{{ $objective_types_value->id }}"
                                                                            data-toggle="tooltip" title=" Edit "
                                                                            data-original-title="Edit"> <i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> </a>

                                                                        <a href="{{ route('delete-objective-types', ['id' => $objective_types_value->id]) }}"
                                                                            class="btn btn-danger delete-post"
                                                                            data-toggle="tooltip" title=" Delete "
                                                                            data-original-title="Delete"> <i
                                                                                class="fa fa-trash-o"
                                                                                aria-hidden="true"></i> </a>


                                                                </td>


                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>
                                </div>
                                {{-- Objective Type End --}}

                                {{-- Objective Rating Start --}}
                                <div id="objective_point" class="b-tab">
                                    <div class=" mb-3">
                                        @if (Session::get('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{ Session::get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong class="text-danger">{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach

                                        <div class="card mb-4">
                                            <div class="card-header with-border">
                                                <h1 class="card-title text-center"> Objectives Highest Rating Configuration
                                                </h1>
                                            </div>
                                        </div>


                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModal1">
                                                <i class="fa fa-plus"></i> {{ __('Add Objective Rating') }}
                                            </button>


                                    </div>


                                    <!-- Add Modal Starts -->

                                        <div id="addModal1" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Add Objective Rating') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('add-objective-points') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>Objective Rating</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-object-ungroup"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="objective_point"
                                                                        id="objective_point_config_point_number"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 mt-4">
                                                                <button class="btn btn-grad" type="submit"> <i
                                                                        class="fa fa-plus" aria-hidden="true"></i> Add
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <!-- Add Modal Ends -->

                                    <div class="table-responsive">
                                        <table id="user-table" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Objective Point</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php($i = 1)
                                                @foreach ($objective_points as $objective_point_value)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $objective_point_value->objective_point_config_point_number ?? null }}
                                                        </td>


                                                            <td>

                                                                    <a href="javascript:void(0)" class="btn edit point"
                                                                        data-id="{{ $objective_point_value->id }}"
                                                                        data-toggle="tooltip" title=" Edit "
                                                                        data-original-title="Edit"> <i
                                                                            class="fa fa-pencil-square-o"
                                                                            aria-hidden="true"></i> </a>

                                                                    <a href="{{ route('delete-objective-points', ['id' => $objective_point_value->id]) }}"
                                                                        class="btn btn-danger delete-post"
                                                                        data-toggle="tooltip" title=" Delete "
                                                                        data-original-title="Delete"> <i
                                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                                    </a>

                                                            </td>


                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                {{-- Objective Rating End --}}

                                {{-- Objective Rating defination Start --}}
                                <div id="objective_scale" class="b-tab">
                                    <div class=" mb-3">
                                        @if (Session::get('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{ Session::get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong class="text-danger">{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach

                                        <div class="card mb-4">
                                            <div class="card-header with-border">
                                                <h1 class="card-title text-center">Objective Rating Defination</h1>
                                            </div>
                                        </div>


                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addRatingScale">
                                                <i class="fa fa-plus"></i> {{ __('Add Rating Defination') }}
                                            </button>


                                    </div>
                                    <!-- Add Modal Starts -->

                                        <div id="addRatingScale" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Add Rating Scale') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('add-rating-scale') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="col-md-12">

                                                                @foreach ($objective_points as $objective_point)
                                                                    <input type="hidden" class="form-control totalPoint"
                                                                        value="{{ $objective_point->objective_point_config_point_number }}">
                                                                @endforeach


                                                                <div class="input-group mb-3">
                                                                    <label>Objective Rating</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-object-ungroup"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="point"
                                                                        class="form-control targetPoint" value="">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <label> Rating Defination</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-object-ungroup"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="defination"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 mt-4">
                                                                <button class="btn btn-grad" type="submit"> <i
                                                                        class="fa fa-plus" aria-hidden="true"></i> Add
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <!-- Add Modal Ends -->

                                    <div class="table-responsive">
                                        <table id="user-table" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Objective Rating</th>
                                                    <th> Rating Defination</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php($i = 1)
                                                @foreach ($rating_scales as $rating_scale)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $rating_scale->point ?? null }}</td>
                                                        <td>{{ $rating_scale->defination ?? null }}</td>

                                                            <td>

                                                                    <a href="javascript:void(0)"
                                                                        class="btn edit defination"
                                                                        data-id="{{ $rating_scale->id }}"
                                                                        data-toggle="tooltip" title=" Edit "
                                                                        data-original-title="Edit"> <i
                                                                            class="fa fa-pencil-square-o"
                                                                            aria-hidden="true"></i> </a>

                                                                    <a href="{{ route('delete-objective-points-scales', ['id' => $rating_scale->id]) }}"
                                                                        class="btn btn-danger delete-post"
                                                                        data-toggle="tooltip" title=" Delete "
                                                                        data-original-title="Delete"> <i
                                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                                    </a>

                                                            </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                {{-- Objective Rating Scale End --}}

                                {{-- Yearly Review Time Set Start --}}
                                <div id="yearly_review" class="b-tab">

                                    <div class="mb-3">
                                        @if (Session::get('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{ Session::get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong class="text-danger">{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach
                                        <div class="card mb-4">
                                            <div class="card-header with-border">
                                                <h1 class="card-title text-center"> Yearly Review Configuration Set </h1>
                                            </div>
                                        </div>

                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModal2">
                                                <i class="fa fa-plus"></i> {{ __('Configure Yearly Review') }}
                                            </button>

                                    </div>


                                        <!-- Add Modal Starts -->
                                        <div id="addModal2" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Configure Yearly Review') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('add-yearly-review-after-months') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="text-bold">{{ __('Review After Months') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select class="form-control"
                                                                            name="yearly_review_after_months">
                                                                            <option>Choose a Review After Months</option>
                                                                            <option value="1">January</option>
                                                                            <option value="2">February</option>
                                                                            <option value="3">March</option>
                                                                            <option value="4">April</option>
                                                                            <option value="5">May</option>
                                                                            <option value="6">June</option>
                                                                            <option value="7">July</option>
                                                                            <option value="8">August</option>
                                                                            <option value="9">September</option>
                                                                            <option value="10">October</option>
                                                                            <option value="11">November </option>
                                                                            <option value="12">December</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label
                                                                            class="text-bold">{{ __('Review Validity upto(number of days)') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"> <i
                                                                                    class="fa fa-calendar"
                                                                                    aria-hidden="true"></i> </span>
                                                                        </div>
                                                                        <input class="form-control" type="text"
                                                                            name="yearly_review_upto" placeholder="15"
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 mt-4">
                                                                    <button class="btn btn-grad" type="submit"> <i
                                                                            class="fa fa-plus" aria-hidden="true"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Add Modal Ends -->


                                    <div class="table-responsive">
                                        <table id="user-table" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>After Months</th>
                                                    <th>Review Validity upto(number of days)</th>

                                                        <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php($i = 1)
                                                @foreach ($yearly_reviews as $yearly_reviews_value)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $yearly_reviews_value->yearly_review_after_months ?? null }}
                                                        </td>
                                                        <td>{{ $yearly_reviews_value->yearly_review_upto ?? null }}</td>


                                                            <td>

                                                                    <a href="javascript:void(0)"
                                                                        class="btn edit edit_review"
                                                                        data-id="{{ $yearly_reviews_value->id }}"
                                                                        data-toggle="tooltip" title=" Edit "
                                                                        data-original-title="Edit"> <i
                                                                            class="fa fa-pencil-square-o"
                                                                            aria-hidden="true"></i> </a>


                                                                    <a href="{{ route('delete-yearly-review-configs', ['id' => $yearly_reviews_value->id]) }}"
                                                                        class="btn btn-danger delete-post"
                                                                        data-toggle="tooltip" title=" Delete "
                                                                        data-original-title="Delete"> <i
                                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                                    </a>

                                                            </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            {{-- Yearly Review Time Set End --}}

                            {{-- Promotion/Demotion Point Config Start --}}
                            <div id="p_d_point" class="b-tab">

                                <div class="mb-3">
                                    @if (Session::get('message'))
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <strong>{{ Session::get('message') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong class="text-danger">{{ $error }}</strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach

                                    <div class="card mb-4">
                                        <div class="card-header with-border">
                                            <h1 class="card-title text-center"> Promotion/Demotion Point Configuration
                                            </h1>
                                        </div>
                                    </div>


                                        <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                            data-target="#addModal3">
                                            <i class="fa fa-plus"></i> {{ __('Configure Promotion/Demotion Points') }}
                                        </button>

                                </div>

                                    <!-- Add Modal Starts -->
                                    <div id="addModal3" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="exampleModalLabel" class="modal-title">
                                                        {{ _('Configure Promotion/Demotion Points') }}
                                                    </h5>
                                                    <button type="button" data-dismiss="modal" id="close"
                                                        aria-label="Close" class="close"><i
                                                            class="dripicons-cross"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ route('add-promotion-demotion-point-configs') }}"
                                                        class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="text-bold">{{ __('Categories') }} <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" name="pd_point_cat">
                                                                        <option>Choose a Category</option>
                                                                        <option value="Promotion">Promotion</option>
                                                                        <option value="Demotion">Demotion</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>Minimum Objective Point</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-calendar"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    @foreach ($objective_points as $objective_point)
                                                                        <input type="hidden"
                                                                            class="form-control totalPoint"
                                                                            value="{{ $objective_point->objective_point_config_point_number }}">
                                                                    @endforeach
                                                                    <input type="text"
                                                                        name="pd_point_min_objective_point"
                                                                        class="form-control targetPoint" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label class="text-bold">{{ __('Minimum value Point') }}
                                                                    <span class="text-danger">*</span></label>
                                                                <select class="form-control"
                                                                    name="pd_point_min_value_point">
                                                                    <option value="">Choose a Category</option>
                                                                    <option value="3">A</option>
                                                                    <option value="2">B</option>
                                                                    <option value="1">C</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-12 mt-4">
                                                                <button class="btn btn-grad" type="submit"> <i
                                                                        class="fa fa-plus" aria-hidden="true"></i> Add
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- Add Modal Ends -->


                                <div class="table-responsive">
                                    <table id="user-table" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category</th>
                                                <th>Minnimum Objective Point</th>
                                                <th>Minnimum Value Point</th>
                                                <th>Total Points</th>

                                                    <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($promotion_demotion_points as $promotion_demotion_points_value)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $promotion_demotion_points_value->pd_point_cat }}</td>
                                                    <td>{{ $promotion_demotion_points_value->pd_point_min_objective_point }}
                                                    </td>
                                                    <td>
                                                        @if ($promotion_demotion_points_value->pd_point_min_value_point == 3)
                                                            {{ __('A') }}
                                                        @elseif($promotion_demotion_points_value->pd_point_min_value_point >= 2)
                                                            {{ __('B') }}
                                                        @elseif($promotion_demotion_points_value->pd_point_min_value_point >= 1)
                                                            {{ __('C') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $promotion_demotion_points_value->pd_point_min_objective_point }}
                                                        @if ($promotion_demotion_points_value->pd_point_min_value_point == 3)
                                                            {{ __('A') }}
                                                        @elseif($promotion_demotion_points_value->pd_point_min_value_point >= 2)
                                                            {{ __('B') }}
                                                        @elseif($promotion_demotion_points_value->pd_point_min_value_point >= 1)
                                                            {{ __('C') }}
                                                        @endif
                                                    </td>


                                                        <td>

                                                                <a href="javascript:void(0)" class="btn edit edit_p_d"
                                                                    data-id="{{ $promotion_demotion_points_value->id }}"
                                                                    data-toggle="tooltip" title=" Edit "
                                                                    data-original-title="Edit"> <i
                                                                        class="fa fa-pencil-square-o"
                                                                        aria-hidden="true"></i> </a>

                                                                <a href="{{ route('delete-promotion-demotion-point-configs', ['id' => $promotion_demotion_points_value->id]) }}"
                                                                    class="btn btn-danger delete-post"
                                                                    data-toggle="tooltip" title=" Delete "
                                                                    data-original-title="Delete"> <i class="fa fa-trash-o"
                                                                        aria-hidden="true"></i> </a>

                                                        </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            {{-- Promotion/Demotion Point Config End --}}

                            {{-- Increment Point Start --}}
                            <div id="increment_point" class="b-tab">

                                <div class="mb-3">

                                    @if (Session::get('message'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>{{ Session::get('message') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong class="text-danger">{{ $error }}</strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                    <div class="card mb-4">
                                        <div class="card-header with-border">
                                            <h1 class="card-title text-center">{{ __('Increment Rating Configuration') }}
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div class="">
                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addIncrementConfigModal"><i class="fa fa-plus-circle"></i>
                                                {{ __('Add Increment Config') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div id="addIncrementConfigModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 id="exampleModalLabel" class="modal-title">
                                                        {{ __('Add Increment Config') }}
                                                    </h5>
                                                    <button type="button" data-dismiss="modal" id="close"
                                                        aria-label="Close" class="close"><i
                                                            class="dripicons-cross"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('add-increment-configs') }}"
                                                        class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>{{ __('From Objective Point') }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-object-ungroup"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    @foreach ($objective_points as $objective_point)
                                                                        <input type="hidden"
                                                                            class="form-control totalPoint"
                                                                            value="{{ $objective_point->objective_point_config_point_number }}">
                                                                    @endforeach
                                                                    <input type="number" name="objective_point"
                                                                        value="" required
                                                                        class="form-control targetPoint">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 form-group">
                                                                <label>{{ __('From Value Point') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="value_point" class="form-control">
                                                                    <option value="" selected>Please Select</option>
                                                                    <option value="3">A</option>
                                                                    <option value="2">B</option>
                                                                    <option value="1">C</option>

                                                                </select>
                                                            </div>
                                                            {{-- <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>{{ __('To Objective Point') }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-object-ungroup"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    @foreach ($objective_points as $objective_point)
                                                                        <input type="hidden"
                                                                            class="form-control totalPoint"
                                                                            value="{{ $objective_point->objective_point_config_point_number ?? '' }}">
                                                                    @endforeach
                                                                    <input type="number" name="to_objective_point"
                                                                        value="" required
                                                                        class="form-control targetPoint">
                                                                </div>
                                                            </div> --}}

                                                            {{-- <div class="col-md-12 form-group">
                                                                <label>{{ __('To Value Point') }}<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="to_value_point" class="form-control">
                                                                    <option value="" selected>Please Select</option>
                                                                    <option value="3">A</option>
                                                                    <option value="2">B</option>
                                                                    <option value="1">C</option>

                                                                </select>
                                                            </div> --}}

                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>{{ __('salary Percentage') }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-percent"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="salary_percentage"
                                                                        value="" required class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 mt-4">
                                                                <button class="btn btn-grad" type="submit"> <i
                                                                        class="fa fa-plus" aria-hidden="true"></i> Add
                                                                </button>


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
                                                        <th> {{ __('SL') }}</th>
                                                        <th> {{ __(' Total Point') }} </th>
                                                        {{-- <th> {{ __('To Total Point') }} </th> --}}
                                                        <th> {{ __('Salary Percentage') }} </th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i = 1)
                                                    @foreach ($increment_configs as $increment_config)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>

                                                            <td>{{ $increment_config->increment_config_objective_point }}
                                                                @if ($increment_config->increment_config_value_point == 3)
                                                                    {{ __('A') }}
                                                                @elseif($increment_config->increment_config_value_point == 2)
                                                                    {{ __('B') }}
                                                                @elseif($increment_config->increment_config_value_point == 1)
                                                                    {{ __('C') }}
                                                                @endif
                                                            </td>

                                                            <td>{{ $increment_config->increment_config_salary_percentage ?? '' }}%
                                                            </td>


                                                                <td>

                                                                        <a href="javascript:void(0)"
                                                                            class="btn edit edit_increment"
                                                                            data-id="{{ $increment_config->id }}"
                                                                            data-toggle="tooltip" title=" Edit "
                                                                            data-original-title="Edit"> <i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> </a>

                                                                        <a href="{{ route('delete-increment-configs', ['id' => $increment_config->id]) }}"
                                                                            class="btn btn-danger delete-post"
                                                                            data-toggle="tooltip" title=" Delete "
                                                                            data-original-title="Delete"> <i
                                                                                class="fa fa-trash-o"
                                                                                aria-hidden="true"></i> </a>

                                                                </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            {{-- Increment Point End --}}

                            {{-- Value Type Start --}}
                            <div id="value_type" class="b-tab">

                                    <div class=" mb-3">
                                        @if (Session::get('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{ Session::get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong class="text-danger">{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach

                                        <div class="card mb-4">
                                            <div class="card-header with-border">
                                                <h1 class="card-title text-center"> Value Type Set</h1>
                                            </div>
                                        </div>


                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModal5">
                                                <i class="fa fa-plus"></i> {{ __('Add Value Type') }}
                                            </button>

                                    </div>



                                        <!-- Add Modal Starts -->
                                        <div id="addModal5" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Add Value Type') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('value-types') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>Value Type Name</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-text-height"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="value_type_name"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 mt-4">
                                                                <button class="btn btn-grad" type="submit"> <i
                                                                        class="fa fa-plus" aria-hidden="true"></i> Add
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- Add Modal Ends -->



                                        <div class="table-responsive">
                                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Value Type</th>

                                                            <th>Action</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i = 1)
                                                    @foreach ($variable_types as $value)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $value->value_type_name }}</td>

                                                                <td>

                                                                        <a href="javascript:void(0)"
                                                                            class="btn edit edit_value"
                                                                            data-id="{{ $value->id }}"
                                                                            data-toggle="tooltip" title=" Edit "
                                                                            data-original-title="Edit"> <i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> </a>

                                                                        <a href="{{ route('delete-value-types', ['id' => $value->id]) }}"
                                                                            class="btn btn-danger delete-post"
                                                                            data-toggle="tooltip" title=" Delete "
                                                                            data-original-title="Delete"> <i
                                                                                class="fa fa-trash-o"
                                                                                aria-hidden="true"></i> </a>

                                                                </td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                            </div>
                            {{-- Value Type End --}}

                            {{-- Value Type Details  Start --}}
                            <div id="value_type_details" class="b-tab">

                                    <div class="mb-3">

                                        @if (Session::get('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{ Session::get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong class="text-danger">{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach
                                        <div class="card mb-4">
                                            <div class="card-header with-border">
                                                <h1 class="card-title text-center"> Value Type Details </h1>
                                            </div>
                                        </div>

                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModal7">
                                                <i class="fa fa-plus"></i> {{ __('Add Value Type Details') }}
                                            </button>

                                    </div>

                                        <!-- Add Modal Starts -->
                                        <div id="addModal7" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Value Type Details') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('value-type-details') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="text-bold">{{ __('Value Type name') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <select class="form-control" name="value_type_id">
                                                                            <option>Choose Value Type</option>
                                                                            @foreach ($variable_types as $variable_type)
                                                                                <option value="{{ $variable_type->id }}">
                                                                                    {{ $variable_type->value_type_name }}
                                                                                </option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label
                                                                            class="text-bold">{{ __('Value Details') }}
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"> <i
                                                                                    class="fa fa-calendar"
                                                                                    aria-hidden="true"></i> </span>
                                                                        </div>
                                                                        <input class="form-control" type="text"
                                                                            name="valuedetails" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 mt-4">
                                                                    <button class="btn btn-grad" type="submit"> <i
                                                                            class="fa fa-plus" aria-hidden="true"></i> Add
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Add Modal Ends -->

                                        <div class="table-responsive">
                                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Value Name</th>
                                                        <th>Value Details</th>

                                                            <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php($i = 1)
                                                    @foreach ($value_type_details as $value_type_detail)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $value_type_detail->valueDeatils->value_type_name ?? '' }}
                                                            </td>
                                                            <td>{{ $value_type_detail->value_type_detail_value ?? '' }}
                                                            </td>
                                                                <td>

                                                                        <a href="javascript:void(0)"
                                                                            class="btn edit edit_value_details"
                                                                            data-id="{{ $value_type_detail->id }}"
                                                                            data-toggle="tooltip" title=" Edit "
                                                                            data-original-title="Edit"> <i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> </a>


                                                                        <a href="{{ route('delete-value-type-details', ['id' => $value_type_detail->id]) }}"
                                                                            class="btn btn-danger delete-post"
                                                                            data-toggle="tooltip" title=" Delete "
                                                                            data-original-title="Delete"> <i
                                                                                class="fa fa-trash-o"
                                                                                aria-hidden="true"></i> </a>

                                                                </td>

                                                        </tr>


                                                         <!--value Details edit Modal ends from here -->
    <div id="value-details-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelValueDetails"></h4>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('update-value-type-details') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="value_detail_id">
                        <div class="col-md-12 form-group">
                            <label> <label for="email">Value Type name:</label></label>

                            <select name="value_type_id_edit" id="value_type_detail_value_type_id"
                                class="form-control  " data-live-search="true" data-live-search-style="begins"
                                data-dependent="typedetails" title="{{ __('Selecting  Value Type Name') }}..."
                                required>

                                @foreach ($variable_types as $variable_type)
                                    <option value="{{ $variable_type->id ?? '' }}"
                                        {{ $value_type_detail->value_type_detail_value_type_id == $variable_type->id ? 'selected' : '' }}>
                                        {{ $variable_type->value_type_name ?? '' }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="pwd">Value Details:</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-location-arrow"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" id="value_type_detail_value" class="code form-control"
                                    name="valuedetailsedit"
                                    value="{{ $value_type_detail->value_type_detail_value ?? '' }}"
                                    placeholder="Value Details" required />
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">

                            <input type="submit" class="btn btn-grad " value="{{ __('Update') }}" />

                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!--value Details edit Modal ends from here -->
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                            </div>
                            {{-- Value Type Details  End --}}

                            {{-- recommendation Start --}}
                            <div id="recommendation_set_up" class="b-tab">

                                    <div class=" mb-3">
                                        @if (Session::get('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{ Session::get('message') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong class="text-danger">{{ $error }}</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endforeach

                                        <div class="card mb-4">
                                            <div class="card-header with-border">
                                                <h1 class="card-title text-center"> Recommendation Type</h1>
                                            </div>
                                        </div>


                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModalRecom">
                                                <i class="fa fa-plus"></i> {{ __('Add Recommendation Type') }}
                                            </button>

                                    </div>


                                        <!-- Add Modal Starts -->
                                        <div id="addModalRecom" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Add Recommendation Type') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('add-recommendations') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>Recommendation Name</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-text-height"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 mt-4">
                                                                <button class="btn btn-grad" type="submit"> <i
                                                                        class="fa fa-plus" aria-hidden="true"></i> Add
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- Add Modal Ends -->


                                        <div class="table-responsive">
                                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Name</th>

                                                            <th>Action</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i = 1)
                                                    @foreach ($recommendations as $value)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $value->name }}</td>

                                                                <td>

                                                                        <a href="javascript:void(0)"
                                                                            class="btn edit edit_recommendation"
                                                                            data-id="{{ $value->id }}"
                                                                            data-toggle="tooltip" title=" Edit "
                                                                            data-original-title="Edit"> <i
                                                                                class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> </a>

                                                                        <a href="{{ route('delete-recommendations', ['id' => $value->id]) }}"
                                                                            class="btn btn-danger delete-post"
                                                                            data-toggle="tooltip" title=" Delete "
                                                                            data-original-title="Delete"> <i
                                                                                class="fa fa-trash-o"
                                                                                aria-hidden="true"></i> </a>

                                                                </td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                            </div>
                            {{-- recommendation  End --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Value Type edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-objective-types') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Objective Type</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="objective_type_name" id="objective_type_name"
                                        class="form-control" value="">
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
    <!-- Value Type end bootstrap model -->

    <!-- objective Point edit Modal starts from here -->

    <div class="modal fade" id="edit-point" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelPoint"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-objective-points') }}" class="form-horizontal"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="point_id">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Objective Point</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-object-ungroup"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="objective_point" id="objective_point_config_point_number"
                                        class="form-control"
                                        value="{{ $objective_point_value->objective_point_config_point_number ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <input type="submit" class="btn btn-grad" value="{{ __('Update') }}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- objective Point  edit Modal ends from here -->

    <!-- objective Point Scale edit Modal starts from here -->
    <div class="modal fade" id="edit-defination" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelDefination"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-objective-scale-points') }}" class="form-horizontal"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="defination_id">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Objective Rating</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-object-ungroup"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="point" id="point" class="form-control targetPoint"
                                        value="{{ $rating_scale->point ?? '' }}">
                                </div>
                                <div class="input-group mb-3">
                                    <label>Rating Defination</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-object-ungroup"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="defination" id="defination" class="form-control"
                                        value="{{ $rating_scale->defination ?? '' }}">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <input type="submit" class="btn btn-grad" value="{{ __('Update') }}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- objective Point Scale edit Modal ends from here -->

    <!-- yearly review edit boostrap model -->
    <div class="modal fade" id="edit-modal1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle1"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-yearly-review-configs') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="review_id" required>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-bold">{{ __('Review After Months') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="yearly_review_after_months"
                                        id="yearly_review_after_months">
                                        <option>Choose a Review After Months</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November </option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label class="text-bold">{{ __('Review Validity upto(number of days)') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input class="form-control" type="text" name="yearly_review_upto"
                                        id="yearly_review_upto" placeholder="15" required>
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

    <!-- p/d edit boostrap model -->
    <div class="modal fade" id="promotion-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle3"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-promotion-demotion-point-configs') }}"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="promotion_id" required>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-bold">{{ __('Categories') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="pd_point_cat" id="pd_point_cat">
                                        <option>Choose Value</option>
                                        <option value="Promotion">Promotion</option>
                                        <option value="Demotion">Demotion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Minimum Objective Point</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @foreach ($objective_points as $objective_point)
                                        <input type="hidden" class="form-control totalPoint"
                                            value="{{ $objective_point->objective_point_config_point_number }}">
                                    @endforeach
                                    <input type="text" name="pd_point_min_objective_point"
                                        id="pd_point_min_objective_point" class="form-control targetPoint"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{ __('Minimum value Point') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="pd_point_min_value_point"
                                    id="pd_point_min_value_point">
                                    <option value="">Choose Value</option>
                                    <option value="3">A</option>
                                    <option value="2">B</option>
                                    <option value="1">C</option>

                                </select>
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
    <!-- p/d end bootstrap model -->

    <!--Increment edit Modal starts from here -->
    <div id="increment-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle4"></h4>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('update-increment-configs') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="increment_id">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ __('From Objective Point') }}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-object-ungroup"
                                                aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @foreach ($objective_points as $objective_point)
                                        <input type="hidden" class="form-control totalPoint"
                                            value="{{ $objective_point->objective_point_config_point_number ?? null }}">
                                    @endforeach
                                    <input type="number" name="objective_point" id="increment_config_objective_point"
                                        value="{{ $increment_config->increment_config_objective_point ?? '' }}" required
                                        class="form-control targetPoint">
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>{{ __('From Value Point') }}<span class="text-danger">*</span></label>
                                <select name="value_point" id="value_point" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="3">A</option>
                                    <option value="2">B</option>
                                    <option value="1">C</option>
                                </select>
                            </div>

                            {{-- <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ __('To Objective Point') }}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-object-ungroup"
                                                aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    @foreach ($objective_points as $objective_point)
                                        <input type="hidden" class="form-control totalPoint"
                                            value="{{ $objective_point->objective_point_config_point_number ?? '' }}">
                                    @endforeach
                                    <input type="number" name="to_objective_point" id="to_increment_point"
                                        value="{{ $increment_config->to_increment_config_objective_point ?? '' }}"
                                        required class="form-control targetPoint">
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-12 form-group">
                                <label>{{ __('To Value Point') }}<span class="text-danger">*</span></label>
                                <select name="to_value_point" id="to_value_point" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="3">A</option>
                                    <option value="2">B</option>
                                    <option value="1">C</option>


                                </select>
                            </div> --}}

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ __('salary Percentage') }}<span class="text-danger">*</span></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-percent"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="salary_percentage" id="salary_percentage"
                                        value="{{ $increment_config->increment_config_salary_percentage ?? '' }}"
                                        required class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12 mt-4">
                                <input type="submit" class="btn btn-grad " value="{{ __('Update') }}" />
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!--Increment edit Modal ends from here -->

    <!--value edit Modal ends from here -->
    <div id="value-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelValue"></h4>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('update-value-types') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="value_id">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ __('Value Marks') }} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-vine" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="value_type_name"
                                        value="{{ $value->value_type_name ?? '' }}" id="value_type_name" required
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">

                                <input type="submit" name="action_button" class="btn btn-grad"
                                    value="{{ __('Edit') }}" />

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--value edit Modal ends from here -->

    <!--value edit Modal ends from here -->
    <div id="recommendetion-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelRecommendation"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-recommendations') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="recom_id">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>{{ __('Name') }} *</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-vine" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="name" id="name"
                                        value="{{ $value->name ?? '' }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">

                                <input type="submit" name="action_button" class="btn btn-grad"
                                    value="{{ __('Edit') }}" />

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--value edit Modal ends from here -->


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            //value type retriving and opening the edit modal starts

            $('.objective_type').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'objective-type-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#objective_type_name').val(res.objective_type_name);
                    }
                });
            });

            //value type retriving and opening the edit modal ends

            //objective point retriving and opening the edit modal starts

            $('.point').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'objective-point-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelPoint').html("Edit");
                        $('#edit-point').modal('show');
                        $('#point_id').val(res.id);
                        $('#objective_point_config_point_number').val(res
                            .objective_point_config_point_number);
                    }
                });
            });

            //objective point retriving and opening the edit modal ends

            //objective point defination and opening the edit modal starts

            $('.defination').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'objective-point-scale-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelDefination').html("Edit");
                        $('#edit-defination').modal('show');
                        $('#defination_id').val(res.id);
                        $('#defination').val(res.defination);
                        $('#point').val(res.point);
                    }
                });
            });

            //objective point defination retriving and opening the edit modal ends

            //yearly review retriving and opening the edit modal starts

            $('.edit_review').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'yearly-review-config-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle1').html("Edit");
                        $('#edit-modal1').modal('show');
                        $('#review_id').val(res.id);
                        $('#yearly_review_after_months').val(res.yearly_review_after_months);
                        $('#yearly_review_upto').val(res.yearly_review_upto);
                    }
                });
            });

            //yearly review retriving and opening the edit modal ends

            //promotion retriving and opening the edit modal starts
            $('.edit_p_d').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'promotion-demotion-point-config-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle3').html("Edit");
                        $('#promotion-modal').modal('show');
                        $('#promotion_id').val(res.id);
                        $('#pd_point_cat').val(res.pd_point_cat);
                        $('#pd_point_result_point').val(res.pd_point_result_point);
                        $('#pd_point_min_objective_point').val(res
                            .pd_point_min_objective_point);
                        $('#pd_point_min_value_point').val(res.pd_point_min_value_point);
                    }
                });
            });
            //promotion retriving and opening the edit modal ends
            //increment edit modal start
            $('.edit_increment').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'increment-point-config-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle4').html("Edit");
                        $('#increment-modal').modal('show');
                        $('#increment_id').val(res.id);
                        $('#increment_config_objective_point').val(res
                            .increment_config_objective_point);
                        $('#value_point').val(res.increment_config_value_point);
                        // $('#to_increment_point').val(res.to_increment_config_objective_point);
                        // $('#to_value_point').val(res.to_increment_config_value_point);
                        $('#salary_percentage').val(res.increment_config_salary_percentage);


                    }
                });
            });
            //increment edit modal end
            //value edit modal start
            $('.edit_value').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'value-type-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelValue').html("Edit");
                        $('#value-modal').modal('show');
                        $('#value_id').val(res.id);
                        $('#value_type_name').val(res.value_type_name);
                    }
                });
            });
            //value edit modal end

            //recommendation edit modal start
            $('.edit_recommendation').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'recommendation-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelRecommendation').html("Edit");
                        $('#recommendetion-modal').modal('show');
                        $('#recom_id').val(res.id);
                        $('#name').val(res.name);
                    }
                });
            });
            //recommendation edit modal end

            //value details edit modal start
            $('.edit_value_details').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'value-type-detail-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelValueDetails').html("Edit");
                        $('#value-details-modal').modal('show');
                        $('#value_detail_id').val(res.id);
                        $('#value_type_detail_value_type_id').val(res
                            .value_type_detail_value_type_id);
                        $('#value_type_detail_value').val(res.value_type_detail_value);
                    }
                });
            });
            //value details edit modal end

            $('#user-table').DataTable({


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


        function Tabs() {
            var bindAll = function() {
                var menuElements = document.querySelectorAll('[data-tab]');
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].addEventListener('click', change, false);
                }
            }

            var clear = function() {
                var menuElements = document.querySelectorAll('[data-tab]');
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].classList.remove('active');
                    var id = menuElements[i].getAttribute('data-tab');
                    document.getElementById(id).classList.remove('active');
                }
            }

            var change = function(e) {
                clear();
                e.target.classList.add('active');
                var id = e.currentTarget.getAttribute('data-tab');
                document.getElementById(id).classList.add('active');
            }

            bindAll();
        }

        var connectTabs = new Tabs();

        $(document).on('keyup', '.targetPoint', function() {
            var targetPoint = parseFloat($(this).val() - 0);
            var totalPoint = parseFloat($(".totalPoint").val() - 0);
            if (totalPoint > targetPoint) {
                $(this).removeClass("border border-danger");
                $(this).addClass("border border-success");
            } else if (totalPoint < targetPoint) {
                Swal.fire('Warning!', 'Objective Rating Can not Grater Then Objective Highest Rating.', 'warning');
                $(this).val(totalPoint);
                $(this).removeClass("border border-success");
                $(this).addClass("border border-danger");
            }
        });
    </script>
@endsection
