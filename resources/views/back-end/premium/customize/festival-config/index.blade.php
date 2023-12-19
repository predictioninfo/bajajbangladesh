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
        @if (Session::get('message_err'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message_err') }}</strong>
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
                <h1 class="card-title text-center"> {{__('Festival Config List')}} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Festival Config </a></li>
                </ol>
            </div>
        </div>



    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Festival Config') }}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('add-festival-configs') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Festival bonus salary type</label>
                                    <select name="salary_type" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="begins"
                                        title="{{__('Selecting Salary Type')}}..." required>
                                        <option value="Gross">Gross</option>
                                        <option value="Basic">Basic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Festival bonus percentage(%)</label>
                                    <input type="number" name="festival_bonus_percentage" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Festival bonus required time duration Month</label>
                                    <select name="festival_bonus_time_duration" class="form-control" required>
                                        <option value="">{{__('Selecting Duration Month')}}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                        <option value="6">Six</option>
                                        <option value="7">Seven</option>
                                        <option value="8">Eight</option>
                                        <option value="9">Nine</option>
                                        <option value="10">Ten</option>
                                        <option value="11">Eleven</option>
                                        <option value="12">Twelve</option>
                                    </select>
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

    <!-- Add Modal Ends -->
    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped ">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Festival bonus salary type') }}</th>
                        <th>{{ __('Festival bonus percentage(%)') }}</th>
                        <th>{{ __('Festival bonus required time duration Month') }}</th>
                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{ __('Action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($festivals as $festivals_config)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $festivals_config->festival_config_salary_type }}</td>
                        <td>{{ $festivals_config->festival_config_festival_bonus_percentage }}</td>
                        <td>{{ $festivals_config->festival_config_festival_bonus_time_duration }}</td>
                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>
                            @if ($edit_permission == 'Yes')
                            <a href="javascript:void(0)" class="btn edit" data-id="{{ $festivals_config->id }}"
                                data-toggle="tooltip" title="" data-original-title=" Edit "> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                            @endif
                            @if ($delete_permission == 'Yes')
                            <a href="{{ route('delete-festival-configs', ['id' => $festivals_config->id]) }}"
                                data-toggle="tooltip" title="" data-original-title="Delete"
                                class="btn btn-danger delete-post"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                            @endif
                        </td>
                        @endif
                    </tr>



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
                                    <form method="post" action="{{ route('update-festival-configs') }}"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $festivals_config->id }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Festival bonus salary type</label>
                                                    <select name="salary_type" class="form-control "  required>
                                                        <option value="Gross"{{ $festivals_config->festival_config_salary_type == "Gross" ? 'selected' : '' }}>Gross</option>
                                                        <option value="Basic" {{ $festivals_config->festival_config_salary_type == "Basic" ? 'selected' : '' }}>Basic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Festival bonus percentage(%)</label>
                                                    <input type="number" name="festival_bonus_percentage"
                                                        class="form-control" value="{{ $festivals_config->festival_config_festival_bonus_percentage}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <label>Festival bonus required time duration Month</label>
                                                    <select name="festival_bonus_time_duration" class="form-control"
                                                        required>
                                                        <option value="" selected="selected" disabled="disabled">-- select one --</option>
                                                        <option value="1" {{ $festivals_config->festival_config_festival_bonus_time_duration == "1" ? 'selected' : '' }}>One</option>
                                                        <option value="2" {{ $festivals_config->festival_config_festival_bonus_time_duration == "2" ? 'selected' : '' }}>Two</option>
                                                        <option value="3" {{ $festivals_config->festival_config_festival_bonus_time_duration == "3" ? 'selected' : '' }}>Three</option>
                                                        <option value="4" {{ $festivals_config->festival_config_festival_bonus_time_duration == "4" ? 'selected' : '' }}>Four</option>
                                                        <option value="5" {{ $festivals_config->festival_config_festival_bonus_time_duration == "5" ? 'selected' : '' }}>Five</option>
                                                        <option value="6" {{ $festivals_config->festival_config_festival_bonus_time_duration == "6" ? 'selected' : '' }}>Six</option>
                                                        <option value="7" {{ $festivals_config->festival_config_festival_bonus_time_duration == "7" ? 'selected' : '' }}>Seven</option>
                                                        <option value="8" {{ $festivals_config->festival_config_festival_bonus_time_duration == "8" ? 'selected' : '' }}>Eight</option>
                                                        <option value="9" {{ $festivals_config->festival_config_festival_bonus_time_duration == "9" ? 'selected' : '' }}>Nine</option>
                                                        <option value="10" {{ $festivals_config->festival_config_festival_bonus_time_duration == "10" ? 'selected' : '' }}>Ten</option>
                                                        <option value="11" {{ $festivals_config->festival_config_festival_bonus_time_duration == "11" ? 'selected' : '' }}>Eleven</option>
                                                        <option value="12" {{ $festivals_config->festival_config_festival_bonus_time_duration == "12" ? 'selected' : '' }}>Twelve</option>
                                                    </select>
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
                    @endforeach

                </tbody>

            </table>

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

            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'festival-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#festival_config_salary_type').val(res
                            .festival_config_salary_type);
                        $('#festival_config_festival_bonus_percentage').val(res.festival_config_festival_bonus_percentage);
                        $('#festival_config_festival_bonus_time_duration').val(res.festival_config_festival_bonus_time_duration);

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








        });
</script>
@endsection
