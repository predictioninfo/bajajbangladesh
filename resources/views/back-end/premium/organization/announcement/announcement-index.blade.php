@extends('back-end.premium.layout.premium-main')

@section('content')
    <section class="main-contant-section">
        <?php

        use App\Models\Company;
        use App\Models\Department;

        ?>

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
                    <h1 class="card-title text-center"> {{ __('Announcement List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Announcement </a></li>
                    </ol>
                </div>
            </div>

            {{-- <div class="d-flex flex-row mt-3">

                @if ($delete_permission == 'Yes')
                <div class="ml-2">
                    <form method="post" action="{{route('bulk-delete-announcements')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
                        <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                    </form>
                </div>
                @endif
            </div> --}}

            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Announcement') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('add-announcements') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <input type="hidden" name="id" value="">

                                    <div class="col-md-12 form-group">
                                        <label class="text-bold">{{ __('Department') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="department_id" required class="form-control selectpicker dynamic"
                                            title="{{ __('Select a Department') }}">
                                            @foreach ($departments as $departmentsValue)
                                                <option value="{{ $departmentsValue->id }}">
                                                    {{ $departmentsValue->department_name }}</option>
                                            @endforeach
                                            <option value="0">All Departments</option>
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ __('Title') }} *</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-newspaper-o"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="announcement_title" value="" required
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="my-textarea">Description</label>
                                        <textarea class="form-control" name="announcement_desc"></textarea>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                                aria-hidden="true"></i> Add </button>
                                        <!-- <input type="submit" name="action_button" class="btn btn-grad" value="{{ __('Add') }}"/> -->

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
                                <th>{{ __('Department Name') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Announced By') }}</th>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <th>{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($announcements as $announcementsValue)
                                <tr>

                                    <td>{{ $i++ }}</td>
                                    @if ($announcementsValue->announcement_department_id != 0)
                                        <?php
                                        $department_names = Department::where('id', $announcementsValue->announcement_department_id)->get('department_name');
                                        ?>
                                        @foreach ($department_names as $department_names_value)
                                            <td>{{ $department_names_value->department_name }}</td>
                                        @endforeach
                                    @else
                                        <td>All Departments</td>
                                    @endif
                                    <td>{{ $announcementsValue->announcement_title }}</td>
                                    <td>{{ $announcementsValue->announcement_desc }}</td>
                                    <td>{{ $announcementsValue->announcementuser->first_name . ' ' . $announcementsValue->announcementuser->last_name }}
                                    </td>
                                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                        <td>
                                            @if ($edit_permission == 'Yes')
                                                <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                                    data-target="#announcementEditModal{{ $announcementsValue->id }}"
                                                    data-id="" data-toggle="tooltip" title=" Edit "
                                                    data-original-title="Edit"> <i class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i></a>
                                            @endif
                                            @if ($delete_permission == 'Yes')
                                                <a href="{{ route('delete-announcements', ['id' => $announcementsValue->id]) }}"
                                                    class="btn btn-danger delete-post" data-toggle="tooltip"
                                                    title=" Delete " data-original-title="Delete"> <i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            @endif


                                        </td>
                                    @endif

                                </tr>

                                <div id="announcementEditModal{{ $announcementsValue->id }}" class="modal fade"
                                    role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}</h5>
                                                <button type="button" data-dismiss="modal" id="close"
                                                    aria-label="Close" class="close"><i
                                                        class="dripicons-cross"></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="post" action="{{ route('update-announcements') }}"
                                                    class="form-horizontal" enctype="multipart/form-data">

                                                    @csrf
                                                    <div class="row">

                                                        <input type="hidden" name="id"
                                                            value="{{ $announcementsValue->id }}">

                                                        <div class="col-md-12 form-group">
                                                            <label class="text-bold">{{ __('Department') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="department_id" class="form-control">
                                                                <option value="">Select a Department</option>
                                                                @foreach ($departments as $departmentsValue)
                                                                    <option value="{{ $departmentsValue->id }}"
                                                                        {{ $announcementsValue->announcement_department_id == $departmentsValue->id ? 'selected' : '' }}>
                                                                        {{ $departmentsValue->department_name }}</option>
                                                                @endforeach
                                                                <option value="ALL Departments">All Departments</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="input-group mb-3">
                                                                <label>{{ __('Title') }} *</label>
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> <i
                                                                            class="fa fa-newspaper-o"
                                                                            aria-hidden="true"></i> </span>
                                                                </div>
                                                                <input type="text" name="announcement_title"
                                                                    value="{{ $announcementsValue->announcement_title }}"
                                                                    required class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <label for="my-textarea">Description</label>
                                                            <textarea id="my-textarea" class="form-control" name="announcement_desc" rows="5">{{ $announcementsValue->announcement_desc }}</textarea>
                                                        </div>

                                                        <div class="col-sm-12 mt-4">

                                                            <input type="submit" name="action_button"
                                                                class="btn btn-grad " value="{{ __('Edit') }}" />

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
            </div>



        </div>
    </section>
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






        });
    </script>
@endsection
