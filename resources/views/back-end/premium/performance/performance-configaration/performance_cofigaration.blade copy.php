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
                                    <li> <a href="{{ route('performance-configarations') }}"> <span> Objective Type
                                            </span> </a> </li>
                                    <li> <a href="#objective_point" data-tab="objective_point" active="">Objective Point
                                        </a>
                                    </li>
                                    <li> <a href="#par_address" data-tab="par_address"> Yearly Review Time Config</a> </li>
                                    <li> <a href="#job_location" data-tab="job_location"> <span> P/D Point
                                            </span> </a> </li>
                                    <li> <a href="#company_information" data-tab="company_information"> <span>
                                                Increment Point </span> </a> </li>
                                    <li> <a href="#parental_information" data-tab="parental_information"> <span>
                                                Value Type Nmae</span> </a> </li>
                                    <li> <a href="#basic_information_bangla" data-tab="basic_information_bangla">
                                            <span> Value Type Details</span> </a> </li>

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

                                {{-- Objective Type module Start --}}
                                <div id="orange" class="b-tab active">

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
                                                <h1 class="card-title text-center"> Objectives </h1>
                                            </div>
                                        </div>

                                        @if ($add_permission == 'Yes')
                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModal">
                                                <i class="fa fa-plus"></i> {{ __('Add Objective Type') }}
                                            </button>
                                        @endif
                                    </div>

                                    @if ($add_permission == 'Yes')
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
                                                                <!-- <input type="submit" name="action_button" class="btn btn-grad w-50" value="{{ __('Add') }}"/> -->
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- Add Modal Ends -->
                                    @endif
                                    <div class="content-box">
                                        <div class="table-responsive">
                                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Objective Type</th>
                                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                            <th>Action</th>
                                                        @endif

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php($i = 1)
                                                    @foreach ($objective_types as $objective_types_value)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $objective_types_value->objective_type_name }}</td>
                                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn dropdown-toggle" type="button"
                                                                            data-toggle="dropdown">
                                                                            <i class="fa fa-plus-circle"
                                                                                aria-hidden="true"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            @if ($edit_permission == 'Yes')
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn edit"
                                                                                    data-id="{{ $objective_types_value->id }}">Edit</a>
                                                                            @endif
                                                                            @if ($delete_permission == 'Yes')
                                                                                <a href="{{ route('delete-objective-types', ['id' => $objective_types_value->id]) }}"
                                                                                    class="btn delete-post">Delete</a>
                                                                            @endif
                                                                        </ul>
                                                                    </div>

                                                                </td>
                                                            @endif

                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div id="objective_point" class="b-tab active">

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
                                                <h1 class="card-title text-center"> Objectives </h1>
                                            </div>
                                        </div>

                                        @if ($add_permission == 'Yes')
                                            <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal"
                                                data-target="#addModal">
                                                <i class="fa fa-plus"></i> {{ __('Add Objective Type') }}
                                            </button>
                                        @endif
                                    </div>

                                    @if ($add_permission == 'Yes')
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
                                                                <!-- <input type="submit" name="action_button" class="btn btn-grad w-50" value="{{ __('Add') }}"/> -->
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- Add Modal Ends -->
                                    @endif
                                    <div class="content-box">
                                        <div class="table-responsive">
                                            <table id="user-table" class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Objective Type</th>
                                                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                            <th>Action</th>
                                                        @endif

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php($i = 1)
                                                    @foreach ($objective_types as $objective_types_value)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $objective_types_value->objective_type_name }}</td>
                                                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn dropdown-toggle" type="button"
                                                                            data-toggle="dropdown">
                                                                            <i class="fa fa-plus-circle"
                                                                                aria-hidden="true"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            @if ($edit_permission == 'Yes')
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn edit"
                                                                                    data-id="{{ $objective_types_value->id }}">Edit</a>
                                                                            @endif
                                                                            @if ($delete_permission == 'Yes')
                                                                                <a href="{{ route('delete-objective-types', ['id' => $objective_types_value->id]) }}"
                                                                                    class="btn delete-post">Delete</a>
                                                                            @endif
                                                                        </ul>
                                                                    </div>

                                                                </td>
                                                            @endif

                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
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
    <!-- end bootstrap model -->
    {{-- Objective Type module Start --}}





    <script>
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

            //value retriving and opening the edit modal ends


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
    </script>
@endsection
