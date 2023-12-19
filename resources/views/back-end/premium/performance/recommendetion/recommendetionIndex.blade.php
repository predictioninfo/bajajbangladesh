@extends('back-end.premium.layout.premium-main')
@section('content')
    <section class="main-contant-section">

        <div class=""><span id="general_result"></span></div>

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




            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> Supervisor's Recommendation</h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="" data-toggle="modal"
                            data-target="#manPowerModal"><span class="fa fa-plus"> </span> Add</a></li>
                        <li><a href="#">List - {{ 'Recommendation' }} </a></li>
                    </ol>
                </div>
            </div>

            <div class="content-box">
                {{-- 1st Start --}}
                <div class="table-responsive mt-4">
                        <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Recommendation Type') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php($i = 1)
                            @foreach ($recommendentions as $recommendention)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $recommendention->employee->first_name ?? '' }} {{ $recommendention->employee->last_name ?? '' }}</td>
                                    <td>{{ $recommendention->recommendationType->name ?? '' }}</td>
                                    <td>{{ $recommendention->recom_details ?? '' }}</td>

                                    <td>

                                        <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                            data-target="#departmentEditModal{{ $recommendention->id }}" data-id=""
                                            data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                                        <a href="{{ route('delete-recommendations', ['id' => $recommendention->id]) }}" class="btn btn-danger" data-toggle="tooltip" title=""
                                            data-original-title="Delete"> <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <div id="departmentEditModal{{ $recommendention->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}
                                                </h5>
                                                <button type="button" data-dismiss="modal" id="close"
                                                    aria-label="Close" class="close"><i
                                                        class="dripicons-cross"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" action="{{ route('update-recommendations') }}"
                                                    class="form-horizontal" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="id"
                                                            value="{{ $recommendention->id }}">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label>{{ __('Employee Name') }} <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-object-group"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <select name="recom_employee_id"
                                                                        class="form-control">
                                                                        <option value="">Select Employee
                                                                        </option>
                                                                        @foreach ($employees as $employee)
                                                                            <option value="{{ $employee->id }}"
                                                                                {{ $recommendention->recom_employee_id == $employee->id ? 'selected' : '' }}>
                                                                                {{ $employee->first_name }} {{ $employee->last_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label>{{ __('Recommendation Type') }} <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-object-group"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <select name="recom_id" id="recom_id"
                                                                        class="form-control">
                                                                        <option value="">Select Recommendation Type
                                                                        </option>
                                                                        @foreach ($recommendentionType as $recommendentionTypes)
                                                                            <option value="{{ $recommendentionTypes->id }}"
                                                                                {{ $recommendention->recom_id == $recommendentionTypes->id ? 'selected' : '' }}>
                                                                                {{ $recommendentionTypes->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label>{{ __('Description') }} </label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-sort-numeric-asc"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <input type="text" name="recom_details"
                                                                        value="{{ $recommendention->recom_details }}"
                                                                        class="form-control">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 mt-4">

                                                            <input type="submit" class="btn btn-grad "
                                                                value="{{ __('Edit') }}" />

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>



                {{-- 1st End --}}

            </div>


            <!-- add modal code starts from here -->

            <div id="manPowerModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Recommendation') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('add-recommendations') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Employee Name') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-object-group"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select name="recom_employee_id"  class="form-control">
                                                    <option value="">Select Employee</option>
                                                    @foreach ( $employees as $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ $value->first_name }} {{ $value->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Recommendation Type') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-object-group"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <select name="recom_id" id="recom_id" class="form-control">
                                                    <option value="">Select Recommendation Type</option>
                                                    @foreach ($recommendentionType as $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>{{ __('Description') }} </label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-sort-numeric-asc"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <input type="text" name="recom_details" value=""
                                                    class="form-control">
                                            </div>

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

    </section>
    <script>
        $('#user-table-v').DataTable({


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
    </script>
@endsection
