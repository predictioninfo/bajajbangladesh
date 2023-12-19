@extends('back-end.premium.layout.premium-main')

@section('content')
<section>

    <section class="main-contant-section">

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
                    <h1 class="card-title text-center">{{ 'Lunch bill' }} {{ __(' List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                        @endif
                    </ol>
                </div>
            </div>

            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="post" action="{{ route('add-lunch-bills') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <input type="hidden" name="id" value="">
                                    <div class="col-md-12 form-group">

                                        <label>{{ 'Employee Name' }}*</label>

                                        <select name="employee_id" id="employee_id"
                                            class="form-control selectpicker employee" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="employee_id"
                                            title="{{ __('Selecting  name') }}..." required>
                                            @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->company_assigned_id }}-{{
                                                $employee->first_name.' '.$employee->last_name }} </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ 'Add Lunch Bill' }} *</label>
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="number" name="lunch_bill" value="" required
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ 'Month Year' }} *</label>
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="month" name="lunch_bill_month" value="" required
                                                class="form-control">
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
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Employee ID') }}</th>
                                <th>{{ __('Lunch Bill') }}</th>
                                <th>{{ __('Month') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($lunches as $lunch)
                            <tr>

                                <td>{{ $i++ }}</td>

                                <td>{{ $lunch->userLunch->first_name.' '.$lunch->userLunch->last_name }}</td>
                                <td>{{ $lunch->userLunch->company_assigned_id }}</td>
                                <td>{{ $lunch->lunch_bill.' '.__('BDT')}}</td>
                                <td>{{date('F', strtotime($lunch->lunch_month_year))}}</td>
                                <td>{{date('Y', strtotime($lunch->lunch_month_year))}}</td>


                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <td>
                                    @if ($edit_permission == 'Yes')
                                    <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                        data-target="#EditModal{{ $lunch->id }}" data-id="" data-toggle="tooltip"
                                        title=" Edit " data-original-title="Edit"> <i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i></a>
                                    @endif
                                    @if ($delete_permission == 'Yes')
                                    <a href="{{ route('delete-lunch-bills', ['id' => $lunch->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></a>
                                    @endif
                                </td>
                                @endif
                            </tr>

                            <div id="EditModal{{ $lunch->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}
                                            </h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                                class="close"><i class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post"
                                                action="{{ route('update-lunch-bills',['id' => $lunch->id]) }}"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $lunch->id }}">
                                                    <div class="col-md-12 form-group">

                                                        <label>{{ 'Employee Name' }}*</label>

                                                        <select name="employee_id" id="employee_id_edit"
                                                            class="form-control" data-live-search="true"
                                                            data-live-search-style="begins"
                                                            data-dependent="employee_id_edit"
                                                            title="{{ __('Selecting  name') }}...">
                                                            @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">{{
                                                                $employee->first_name.'
                                                                '.$employee->last_name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <label>{{ 'Add Lunch Bill' }} *</label>
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="number" name="lunch_bill" value="{{ $lunch->lunch_bill }}" required
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <label>{{ 'Month Year' }} *</label>
                                                            <div class="input-group-prepend">

                                                            </div>
                                                            <input type="month" name="lunch_bill_month" value="{{ $lunch->lunch_bill_month }}"
                                                                required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 mt-4">

                                                        <input type="submit" name="action_button" class="btn btn-grad "
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
            </div>



        </div>
    </section>

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