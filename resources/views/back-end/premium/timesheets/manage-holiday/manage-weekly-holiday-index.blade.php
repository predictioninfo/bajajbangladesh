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
                    <h1 class="card-title text-center"> {{ __('Manage Weekly Holiday') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Weekly Holiday </a></li>
                    </ol>
                </div>
            </div>


            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">

                            <form method="post" action="{{ route('add-weekly-holidays') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="holiday_type" name="holiday_type"
                                    value="Weekly-Holiday" required="">
                                {{-- <input type="hidden" class="form-control" id="com_id" name="com_id" value="{{Auth::user()->com_id}}" required=""> --}}
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Holiday Name</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="holiday_name" name="holiday_name">
                                            <option>Choose a Holiday</option>
                                            <option value="Sat">Saturday</option>
                                            <option value="Sun">Sunday</option>
                                            <option value="Mon">Monday</option>
                                            <option value="Tue">Tuesday</option>
                                            <option value="Wed">Wednesday</option>
                                            <option value="Thu">Thursday</option>
                                            <option value="Fri">Friday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Add </button>

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
                                <th>{{ __('Holiday Type') }}</th>
                                <th>{{ __('Holiday Name') }}</th>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                    <th>{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($holidays as $holiday_value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $holiday_value->holiday_type }}</td>
                                    <td>{{ $holiday_value->holiday_name }}</td>
                                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                        <td>

                                            @if ($edit_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                                <a href="javascript:void(0)" class="btn  edit"
                                                    data-id="{{ $holiday_value->id }}" data-toggle="tooltip" title=" Edit "
                                                    data-original-title="Edit"><i class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i></a>
                                            @endif
                                            @if ($delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                                <a href="javascript:void(0)" class="btn btn-danger delete"
                                                    data-id="{{ $holiday_value->id }}" data-toggle="tooltip"
                                                    title=" Delete " data-original-title="Delete"> <i class="fa fa-trash-o"
                                                        aria-hidden="true"></i></a>
                                            @endif

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
    </section>


    <!-- edit boostrap model -->
    <div class="modal fade" id="ajax-edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-weekly-holidays') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" class="form-control" id="holiday_type" name="holiday_type"
                            value="Weekly-Holiday" required="">

                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Holiday Name</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="holiday_name" name="holiday_name">
                                    <option>Choose a Holiday</option>
                                    <option value="Sat">Saturday</option>
                                    <option value="Sun">Sunday</option>
                                    <option value="Mon">Monday</option>
                                    <option value="Tue">Tuesday</option>
                                    <option value="Wed">Wednesday</option>
                                    <option value="Thu">Thursday</option>
                                    <option value="Fri">Friday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad" id="btn-save" value="addNewHoliday">Save
                                changes
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
        $(document).ready(function($) {
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
                    url: 'edit-weekly-holiday',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit Holiday");
                        $('#ajax-edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#holiday_type').val(res.holiday_type);
                        $('#holiday_name').val(res.holiday_name);
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


            $('.delete').on('click', function() {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');
                    $.ajax({
                        type: "POST",
                        url: '/delete-weekly-holiday',
                        data: {
                            id: id
                        },
                        dataType: 'json',

                        success: function(response)  {
                        toastr.success(response.success,'Data successfully updated!!');
                        window.location.reload();
                    },
                    error: function(response){
                        toastr.error(response.error,'Please Entry Valid Data!!');
                       
                    }

                    });
                }
            });



        });
    </script>
@endsection
