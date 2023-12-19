@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\GradeSetup;
    use App\Models\Grade;
    foreach ($grade_labels as $grade_label) {
        $grade_label_name = $grade_label->name ?? 'Grade';
        $grade_label_id = $grade_label->id ?? null;
    }
    ?>
    <section class="forms main-contant-section">
        <div class="employee-basic-information">


            <div class="row">
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="content-box">

                            <div class="profile-content">
                                <ul>
                                    <li> <a href="{{ route('organization-configarations') }}">
                                            <span>{{ $grade_label_name ?? 'Grade' }}

                                            </span> </a> </li>
                                    <li> <a href="#grade_setup" data-tab="grade_setup" active="">
                                            {{ $grade_label_name ?? 'Grade' }} {{ __('Setup') }} </a>
                                    </li>
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
                                {{-- Grade Start --}}
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
                                                    <h1 class="card-title text-center"> {{ $grade_label_name ?? 'Grade' }}
                                                        {{ __('List') }}</h1>
                                                    <ol id="breadcrumb1">
                                                        <li><a href="{{ route('home') }}"><span class="icon icon-home">
                                                                </span></a></li>
                                                        <li><a href="#" type="button" data-toggle="modal"
                                                                data-target="#addGradeModal"><span class="icon icon-plus">
                                                                </span>Add</a></li>
                                                        <li><a href="#" type="button" data-toggle="modal"
                                                                data-target="#editGradeModal"><span class="icon icon-edit">
                                                                </span>Edit Label</a></li>
                                                        <li><a href="#">List - {{ $grade_label_name ?? 'Grade' }} </a>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>


                                        </div>

                                        {{-- @if ($add_permission == 'Yes') --}}
                                        <div id="editGradeModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">{{ __('Edit') }}
                                                            {{ $grade_label_name ?? 'Grade' }}
                                                            {{ __('Label') }}</h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('add-grade-labels') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <input type="hidden" name="id" value="">
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <label>{{ __('Edit') }}
                                                                            {{ $grade_label_name ?? 'Grade' }}
                                                                            {{ __('Label') }} *</label>
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"> <i
                                                                                    class="fa fa-location-arrow"
                                                                                    aria-hidden="true"></i> </span>
                                                                        </div>
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $grade_label_id ?? null }}" required
                                                                            class="form-control">
                                                                        <input type="text" name="grade_label_name"
                                                                            value="{{ $grade_label_name ?? null }}"
                                                                            required class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 mt-4">
                                                                    <button class="btn btn-grad" type="submit"> <i
                                                                            class="fa fa-plus" aria-hidden="true"></i>
                                                                        Add </button>

                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <!-- Add Modal Starts -->
                                        <div id="addGradeModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                            {{ _('Add ') }}{{ $grade_label_name ?? 'Grade' }}
                                                        </h5>
                                                        <button type="button" data-dismiss="modal" id="close"
                                                            aria-label="Close" class="close"><i
                                                                class="dripicons-cross"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('add-grades') }}"
                                                            class="form-horizontal" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>{{ $grade_label_name ?? 'Grade' }} Name</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-text-height"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="grade_name"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>{{ $grade_label_name ?? 'Grade' }}Sort
                                                                        Order</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-text-height"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="number" name="grade_sort_order"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <label>{{ $grade_label_name ?? 'Grade' }}
                                                                        Defiantion</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-text-height"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <input type="text" name="grade_defination"
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
                                        {{-- @endif --}}
                                        <div class="content-box">

                                            <div class="table-responsive">
                                                <table id="user-table"
                                                    class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th> {{ $grade_label_name ?? 'Grade' }}
                                                                {{ __('Name') }}</th>
                                                            <th>{{ $grade_label_name ?? 'Grade' }} Defiantion</th>
                                                            <th>{{ $grade_label_name ?? 'Grade' }} Sort Order</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php($i = 1)
                                                        @foreach ($grades as $grade)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $grade->grade_name ?? null }}</td>
                                                                <td>{{ $grade->grade_defination ?? null }}</td>
                                                                <td>{{ $grade->grade_sort_order ?? null }}</td>
                                                                <td>
                                                                    <a href="#" id="edit-post"
                                                                        class="btn objective_type edit"
                                                                        data-toggle="modal"
                                                                        data-target="#gradeEditModal{{ $grade->id }}"
                                                                        data-toggle="tooltip">
                                                                        <i class="fa fa-pencil-square-o"
                                                                            aria-hidden="true"></i>
                                                                    </a>

                                                                    <a href="{{ route('delete-grades', ['id' => $grade->id]) }}"
                                                                        class="btn btn-danger delete-post"
                                                                        data-toggle="tooltip" title=" Delete "
                                                                        data-original-title="Delete"> <i
                                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                                    </a>

                                                                </td>

                                                            </tr>
                                                            <!-- edit Modal starts from here -->
                                                            <div id="gradeEditModal{{ $grade->id }}"
                                                                class="modal fade" role="dialog">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h5 id="exampleModalLabel"
                                                                                class="modal-title">
                                                                                {{ _('Edit') }}</h5>
                                                                            <button type="button" data-dismiss="modal"
                                                                                id="close" aria-label="Close"
                                                                                class="close"><i
                                                                                    class="dripicons-cross"></i></button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <form method="post"
                                                                                action="{{ route('edit-grades') }}"
                                                                                class="form-horizontal"
                                                                                enctype="multipart/form-data">

                                                                                @csrf
                                                                                <div class="row">

                                                                                    <input type="hidden" name="id"
                                                                                        value="{{ $grade->id }}">


                                                                                    <div class="col-md-12">
                                                                                        <div class="input-group mb-3">
                                                                                            <label
                                                                                                for="pwd">{{ $grade_label_name ?? 'Grade' }}
                                                                                                {{ __('Name') }}
                                                                                                <span
                                                                                                    class="text-danger">*</span></label>
                                                                                            <div
                                                                                                class="input-group-prepend">
                                                                                                <span
                                                                                                    class="input-group-text">
                                                                                                    <i class="fa fa-location-arrow"
                                                                                                        aria-hidden="true"></i>
                                                                                                </span>
                                                                                            </div>
                                                                                            <input type="text"
                                                                                                class="code form-control"
                                                                                                name="grade_name"
                                                                                                value="{{ $grade->grade_name ?? '' }}"
                                                                                                placeholder="" required />
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        <div class="input-group mb-3">
                                                                                            <label>
                                                                                                {{ $grade_label_name ?? 'Grade' }}
                                                                                                {{ __('Defination') }}
                                                                                                <span
                                                                                                    class="text-danger">*</span></label>
                                                                                            <div
                                                                                                class="input-group-prepend">
                                                                                                <span
                                                                                                    class="input-group-text">
                                                                                                    <i class="fa fa-location-arrow"
                                                                                                        aria-hidden="true"></i>
                                                                                                </span>
                                                                                            </div>
                                                                                            <input type="text"
                                                                                                name="grade_defination"
                                                                                                value="{{ $grade->grade_defination ?? '' }}"
                                                                                                required
                                                                                                class="form-control">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        <div class="input-group mb-3">
                                                                                            <label>
                                                                                                {{ $grade_label_name ?? 'Grade' }}
                                                                                                {{ __('Sort Order') }}
                                                                                                <span
                                                                                                    class="text-danger">*</span></label>
                                                                                            <div
                                                                                                class="input-group-prepend">
                                                                                                <span
                                                                                                    class="input-group-text">
                                                                                                    <i class="fa fa-location-arrow"
                                                                                                        aria-hidden="true"></i>
                                                                                                </span>
                                                                                            </div>
                                                                                            <input type="number"
                                                                                                name="grade_sort_order"
                                                                                                value="{{ $grade->grade_sort_order ?? '' }}"
                                                                                                required
                                                                                                class="form-control">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-sm-12 mt-4">
                                                                                        <input type="submit"
                                                                                            name="action_button"
                                                                                            class="btn btn-grad"
                                                                                            value="{{ __('Edit') }}" />

                                                                                    </div>
                                                                                </div>

                                                                            </form>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!--edit Modal ends from here -->
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Grade End --}}

                                {{-- Grade Setup Start --}}
                                <div id="grade_setup" class="b-tab">
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
                                                <h1 class="card-title text-center"> {{ $grade_label_name ?? 'Grade' }}
                                                    {{ __('Setup') }}
                                                </h1>
                                                <ol id="breadcrumb1">
                                                    <li><a href="{{ route('home') }}"><span class="icon icon-home">
                                                            </span></a></li>
                                                    <li><a href="#" type="button" data-toggle="modal"
                                                            data-target="#gradeSetupModal"><span class="icon icon-plus">
                                                            </span>Add</a></li>
                                                    <li><a href="#">List - {{ $grade_label_name ?? 'Grade' }}
                                                            {{ __('Setup') }} </a></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Add Modal Starts -->
                                    <div id="gradeSetupModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 id="exampleModalLabel" class="modal-title">{{ __('Add') }}
                                                        {{ $grade_label_name ?? 'Grade' }}
                                                        {{ __('Setup') }}
                                                    </h5>
                                                    <button type="button" data-dismiss="modal" id="close"
                                                        aria-label="Close" class="close"><i
                                                            class="dripicons-cross"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('add-grade-setups') }}"
                                                        class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="col-md-12">
                                                            <div class="input-group mb-3">
                                                                <label>{{ $grade_label_name ?? 'Grade' }}
                                                                    Name</label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-object-ungroup"
                                                                            aria-hidden="true"></i> </span>
                                                                </div>
                                                                <select name="grade_id"
                                                                    class="form-control selectpicker region"
                                                                    data-live-search="true"
                                                                    data-live-search-style="begins"
                                                                    data-dependent="area_name"
                                                                    title="{{ __('Selecting Grade name') }}...">
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->id }}">
                                                                            {{ $grade->grade_name ?? null }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <label>Department</label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-object-ungroup"
                                                                            aria-hidden="true"></i> </span>
                                                                </div>
                                                                <select name="department_id" id="department_id"
                                                                    class="form-control selectpicker region"
                                                                    data-live-search="true"
                                                                    data-live-search-style="begins"
                                                                    data-dependent="area_name"
                                                                    title="{{ __('Selecting  name') }}...">
                                                                    @foreach ($depatments as $depatment)
                                                                        <option value="{{ $depatment->id }}">
                                                                            {{ $depatment->department_name ?? null }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <label>Designation</label>
                                                                <select class="form-control" name="designation_id"
                                                                    id="designation_id"
                                                                    class="form-control selectpicker region"
                                                                    data-live-search="true"
                                                                    data-live-search-style="begins"
                                                                    data-dependent="area_name"
                                                                    title="{{ __('Selecting  name') }}..."></select>

                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <label class="text-bold">{{ __('Employee') }} <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="emp_id"
                                                                    id="emp_id" required>
                                                                </select>
                                                            </div>

                                                            @if ($is_empty_grade_setup = GradeSetup::count() !== 0)
                                                                <h3>Parent Department & Designation</h3>
                                                                <div class="input-group mb-3">
                                                                    <label>Department</label>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"> <i
                                                                                class="fa fa-object-ungroup"
                                                                                aria-hidden="true"></i> </span>
                                                                    </div>
                                                                    <select name="department_id_u" id="department_id_u"
                                                                        class="form-control selectpicker region"
                                                                        data-live-search="true"
                                                                        data-live-search-style="begins"
                                                                        data-dependent="area_name"
                                                                        title="{{ __('Selecting  name') }}...">
                                                                        @foreach ($depatments as $depatment)
                                                                            <option value="{{ $depatment->id }}">
                                                                                {{ $depatment->department_name ?? null }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <label>Designation</label>
                                                                    <select class="form-control" name="designation_id_u"
                                                                        id="designation_id_u"
                                                                        class="form-control selectpicker region"
                                                                        data-live-search="true"
                                                                        data-live-search-style="begins"
                                                                        data-dependent="area_name"
                                                                        title="{{ __('Selecting  name') }}..."></select>
                                                                </div>

                                                                <div class="input-group mb-3">
                                                                    <label class="text-bold">{{ __('Grade Setup') }} <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" name="gradesetup_id"
                                                                        id="gradesetup_id">
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" id="under_grade_id" name="under_grade_id">
                                                            @endif

                                                        </div>
                                                        <div class="col-sm-12 mt-4">
                                                            <button class="btn btn-grad" type="submit"> <i
                                                                    class="fa fa-plus" aria-hidden="true"></i>
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
                                                        <th>SL</th>
                                                        <th>{{ $grade_label_name ?? 'Grade' }} Name</th>
                                                        <th> Department</th>
                                                        <th> Designation</th>
                                                        <th> Employee Name</th>
                                                        <th> Parent Name</th>
                                                        <th> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i = 1)
                                                    @foreach ($grade_setups as $grade_setup)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $grade_setup->gardeSetaupGarde->grade_name ?? null }}
                                                            </td>
                                                            <td>{{ $grade_setup->gardeSetaupDepartment->department_name ?? null }}
                                                            </td>
                                                            <td>{{ $grade_setup->gardeSetaupDesignation->designation_name ?? null }}
                                                            </td>
                                                            <td>
                                                                {{ $grade_setup->gardeSetaupEmployee->first_name ?? null}}
                                                                {{ $grade_setup->gardeSetaupEmployee->last_name ?? null}}
                                                            </td>
                                                            <td>
                                                                {{ $grade_setup->parentName->gardeSetaupEmployee->first_name ?? null }}
                                                                {{ $grade_setup->parentName->gardeSetaupEmployee->last_name ?? null }}
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)" class="btn btn-primary edit"
                                                                    data-id="{{ $grade_setup->id }}"
                                                                    data-toggle="tooltip" title=""
                                                                    data-original-title=" Edit "><i
                                                                        class="fa fa-edit"></i></a>

                                                                <a href="{{ route('delete-grade-setups', ['id' => $grade_setup->id]) }}" onclick="return confirm('Are you sure?')"
                                                                    class="btn btn-danger delete-post"
                                                                    data-toggle="tooltip" title=" Delete "
                                                                    data-original-title="Delete"> <i class="fa fa-trash-o"
                                                                        aria-hidden="true"></i> </a>
                                                            </td>
                                                        </tr>
                                                        <!-- edit Modal starts from here -->
                                                        <div id="gradeSetEditModal" class="modal fade" role="dialog">
                                                            <div class="modal-dialog modal-md">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 id="exampleModalLabel" class="modal-title">
                                                                            {{ $grade_label_name ?? 'Grade' }}
                                                                            {{ _('Edit') }}</h5>
                                                                        <button type="button" data-dismiss="modal"
                                                                            id="close" aria-label="Close"
                                                                            class="close"><i
                                                                                class="dripicons-cross"></i></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form method="post"
                                                                            action="{{ route('update-grade-setup') }}"
                                                                            class="form-horizontal"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                id="id" value="">
                                                                                <input type="hidden" id="parent_id" name="parent_id">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group mb-3">
                                                                                    <label>{{ $grade_label_name ?? 'Grade' }}
                                                                                        Name</label>

                                                                                    <select name="edit_grade_id"
                                                                                        id="edit_grade_id"
                                                                                        class="form-control">

                                                                                        @foreach ($grades as $grade)
                                                                                            <option
                                                                                                value="{{ $grade->id }}">
                                                                                                {{ $grade->grade_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div class="input-group mb-3">
                                                                                    <label>{{ $grade_label_name ?? 'Grade' }}
                                                                                        Department</label>
                                                                                    <select name="edit_department_id"
                                                                                        id="edit_department_id"
                                                                                        class="form-control">
                                                                                        @foreach ($depatments as $depatment)
                                                                                            <option
                                                                                                value="{{ $depatment->id }}">
                                                                                                {{ $depatment->department_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div class="input-group mb-3">
                                                                                    <label>{{ $grade_label_name ?? 'Grade' }}
                                                                                        Designation <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control"
                                                                                        name="edit_designation_id"
                                                                                        id="edit_designation_id">
                                                                                        @foreach ($designations as $designation)
                                                                                            <option
                                                                                                value="{{ $designation->id }}">
                                                                                                {{ $designation->designation_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="input-group mb-3">
                                                                                    <label>Employee Name<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control"
                                                                                        name="edit_employee_id"
                                                                                        id="edit_employee_id">
                                                                                        @foreach ($users as $user)
                                                                                            <option
                                                                                                value="{{ $user->id }}">
                                                                                                {{ $user->first_name }}
                                                                                                {{ $user->last_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div id="parentDepartmentDesignation">
                                                                                    <h3>Parent Department & Designation</h3>
                                                                                    <div class="input-group mb-3">
                                                                                        <label>Department</label><select
                                                                                            name="edit_department_id_u"
                                                                                            id="edit_department_id_u"
                                                                                            class="form-control">
                                                                                            @foreach ($depatments as $depatment)
                                                                                                <option
                                                                                                    value="{{ $depatment->id }}">
                                                                                                    {{ $depatment->department_name }}
                                                                                                </option>
                                                                                                @endforeach
                                                                                        </select> </div>
                                                                                    <div class="input-group mb-3">
                                                                                        <label>Designation</label> <select
                                                                                            name="edit_designation_id_u"
                                                                                            id="edit_designation_id_u"
                                                                                            class="form-control">
                                                                                            @foreach ($designations as $designation)
                                                                                                <option
                                                                                                    value="{{ $designation->id }}">
                                                                                                    {{ $designation->designation_name }}
                                                                                                </option>
                                                                                                @endforeach
                                                                                        </select> </div>
                                                                                    <div class="input-group mb-3"> <label
                                                                                            class="text-bold">{{ __('Grade Setup') }}
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <select class="form-control"
                                                                                            name="edit_show_grade"
                                                                                            id="edit_show_grade">
                                                                                            @foreach ($grades as $grade)
                                                                                                <option
                                                                                                    value="{{ $grade->id }}">
                                                                                                    {{ $grade->grade_name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select> </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="col-sm-12 mt-4">
                                                                                <button class="btn btn-grad"
                                                                                    type="submit"> <i class="fa fa-plus"
                                                                                        aria-hidden="true"></i>
                                                                                    Add </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--edit Modal ends from here -->
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- Grade Setup End --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
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

        $('#department_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#designation_id').empty();
                            $('#designation_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="designation_id"]').append(
                                    '<option value="' + designations.id + '">' +
                                    designations.designation_name + '</option>');
                            });
                        } else {
                            $('#designations').empty();
                        }
                    }
                });
            } else {
                $('#designations').empty();
            }
        });
        $('#designation_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-employee/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#emp_id').empty();
                            $('#emp_id').append(
                                '<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees) {
                                $('select[name="emp_id"]').append('<option value="' +
                                    employees.id + '">' + employees.first_name + ' ' +
                                    employees.last_name + '</option>');
                            });
                        } else {
                            $('#employees').empty();
                        }
                    }
                });
            } else {
                $('#employees').empty();
            }
        });

        $('#department_id_u').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#designation_id_u').empty();
                            $('#designation_id_u').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="designation_id_u"]').append(
                                    '<option value="' + designations.id + '">' +
                                    designations.designation_name + '</option>');
                            });
                        } else {
                            $('#designations').empty();
                        }
                    }
                });
            } else {
                $('#designations').empty();
            }
        });
        $('#designation_id_u').on('change', function() {
            var designationID = $(this).val();
            if (designationID) {
                $.ajax({
                    url: '/get-grade/' + designationID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#gradesetup_id').empty();
                            $('#gradesetup_id').append(
                                '<option hidden value="">Choose Grade</option>');
                                $.each(data, function(key, grades) {
                                    console.log(grades);
                                    $('select[name="gradesetup_id"]').append(
                                        '<option value="' + grades.id + '">' +
                                            grades.garde_setaup_garde.grade_name + '</option>');
                                            $('#under_grade_id').val(grades.grade_id);

                            });
                        } else {
                            $('#grades').empty();
                        }
                    }
                });
            } else {
                $('#grades').empty();
            }
        });





        $('.edit').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: 'edit-grade-setup',
                data: {
                    id: id
                },
                dataType: 'json',

                success: function(res) {
                    console.log(res.resignationByIds);
                    $('#gradeSetEditModal').modal('show');
                    $('#id').val(res.resignationByIds.id);
                    $('#edit_grade_id').val(res.resignationByIds.grade_id);
                    $('#edit_department_id').val(res.resignationByIds.dept_id);
                    $('#edit_designation_id').val(res.resignationByIds.desg_id);
                    $('#edit_employee_id').val(res.resignationByIds.emp_id);
                    $('#parent_id').val(res.resignationByIds.parent_id);
                    if (res.resignationByIds.parent_id != null) {
                        // Show the HTML block
                        $('#parentDepartmentDesignation').show();
                        // Update other elements in the HTML block using res data
                        $('#edit_department_id_u').val(res.resignationByIds.under_dept_id);
                        $('#edit_designation_id_u').val(res.resignationByIds.under_desg_id);
                        $('#edit_show_grade').val(res.parent_grade_name.garde_setaup_garde.id);
                    } else {
                        $('#parentDepartmentDesignation').hide();
                    }

                    $('#edit_department_id_u').on('change', function() {
                        var departmentID = $(this).val();
                        if (departmentID) {
                            $.ajax({
                                url: '/get-designation/' + departmentID,
                                type: "GET",
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                dataType: "json",
                                success: function(data) {
                                    if (data) {
                                        $('#edit_designation_id_u').empty();
                                        $('#edit_designation_id_u').append(
                                            '<option hidden value="">Choose Designation</option>'
                                        );
                                        $.each(data, function(key, designations) {
                                            $('select[name="edit_designation_id_u"]')
                                                .append(
                                                    '<option value="' +
                                                    designations.id + '">' +
                                                    designations
                                                    .designation_name +
                                                    '</option>');
                                        });
                                    } else {
                                        $('#designations').empty();
                                    }
                                }
                            });
                        } else {
                            $('#designations').empty();
                        }
                    });

                    $('#edit_designation_id_u').on('change', function() {
                        var designationID = $(this).val();
                        if (designationID) {
                            $.ajax({
                                url: '/get-grade/' + designationID,
                                type: "GET",
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                dataType: "json",
                                success: function(data) {
                                    if (data) {
                                        $('#edit_show_grade').empty();
                                        $('#edit_show_grade').append(
                                            '<option hidden value="">Choose Grade</option>'
                                        );
                                        $.each(data, function(key, grades) {
                                            $('select[name="edit_show_grade"]')
                                                .append(
                                                    '<option value="' +
                                                    grades.id + '">' +
                                                    grades
                                                    .garde_setaup_garde
                                                    .grade_name +
                                                    '</option>');
                                        });
                                    } else {
                                        $('#grades').empty();
                                    }
                                }
                            });
                        } else {
                            $('#grades').empty();
                        }
                    });


                }
            });
        });

        $('#edit_department_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-designation/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#edit_designation_id').empty();
                            $('#edit_designation_id').append(
                                '<option hidden value="">Choose Designation</option>');
                            $.each(data, function(key, designations) {
                                $('select[name="edit_designation_id"]').append(
                                    '<option value="' + designations.id + '">' +
                                    designations.designation_name + '</option>');
                            });
                        } else {
                            $('#designations').empty();
                        }
                    }
                });
            } else {
                $('#designations').empty();
            }
        });
        $('#edit_designation_id').on('change', function() {
            var departmentID = $(this).val();
            if (departmentID) {
                $.ajax({
                    url: '/get-employee/' + departmentID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#edit_employee_id').empty();
                            $('#edit_employee_id').append(
                                '<option hidden value="">Choose an Employee</option>');
                            $.each(data, function(key, employees) {
                                $('select[name="edit_employee_id"]').append('<option value="' +
                                    employees.id + '">' + employees.first_name + ' ' +
                                    employees.last_name + '</option>');
                            });
                        } else {
                            $('#employees').empty();
                        }
                    }
                });
            } else {
                $('#employees').empty();
            }
        });
    </script>
@endsection
