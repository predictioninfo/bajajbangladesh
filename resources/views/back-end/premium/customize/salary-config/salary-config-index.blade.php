@extends('back-end.premium.layout.premium-main')
@section('content')
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
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Salay Configure List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus"> </span>Add</a></li>
                       @endif
                        <li><a href="#">List - Festivals </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row">

                @if ($delete_permission == 'Yes')
                    <div class="p-1">
                        <form method="post" action="{{ route('bulk-delete-salary-configs') }}" id="sample_form"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                                class="form-check-input">
                            <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
                        </form>
                    </div>
                @endif
            </div> --}}

        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Salary Config') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-salary-configs') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Basic Salary(%)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_basic_salary" placeholder="10"
                                            class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>House Rent Allowance(%)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_house_rent_allowance" placeholder="10"
                                            class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Medical Allowance(%)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_medical_allowance" placeholder="10"
                                            class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Conveyance Allowance(%)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_conveyance_allowance" placeholder="10"
                                            class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Festival Bonus(%)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money"
                                                    aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_festival_bonus" placeholder="10"
                                            class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Festival Bonus Active Period(Month)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money"
                                                    aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_festival_bonus_active_period"
                                            placeholder="1" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Provident Found(%)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money"
                                                    aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="salary_config_provident_fund" placeholder="10"
                                            class="form-control" value="">
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
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Basic Salary (%)') }}</th>
                            <th>{{ __('House Rent Allowance Salary (%)') }}</th>
                            <th>{{ __('Conveyance Allowance Percentage (%)') }}</th>
                            <th>{{ __('Medical Allowance Percentage (%)') }}</th>
                            <th>{{ __('Festival Bonus Percentage (%)') }}</th>
                            <th>{{ __('Provident Fund Percentage (%)') }}</th>
                            <th>{{ __('Festival Bonus Active Period Percentage (%)') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($salary_configs as $salary_configs_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $salary_configs_value->salary_config_basic_salary }}</td>
                                <td>{{ $salary_configs_value->salary_config_house_rent_allowance }}</td>
                                <td>{{ $salary_configs_value->salary_config_conveyance_allowance }}</td>
                                <td>{{ $salary_configs_value->salary_config_medical_allowance }}</td>
                                <td>{{ $salary_configs_value->salary_config_festival_bonus }}</td>
                                <td>{{ $salary_configs_value->salary_config_provident_fund }}</td>
                                <td>{{ $salary_configs_value->salary_config_festival_bonus_active_period }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $salary_configs_value->id }}" data-toggle="tooltip"
                                                title="" data-original-title=" Edit "> <i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                        @endif
                                        {{-- @if ($delete_permission == 'Yes')
                                    <a href="{{route('delete-salary-configs',['id'=>$salary_configs_value->id])}}"
                                        class="btn delete-post">Delete</a>
                                    @endif --}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </section>


    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                    class="close"><i class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-salary-configs') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Basic Salary(%)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_basic_salary"
                                        id="salary_config_basic_salary" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>House Rent Allowance(%)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_house_rent_allowance"
                                        id="salary_config_house_rent_allowance" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Medical Allowance(%)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_medical_allowance"
                                        id="salary_config_medical_allowance" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Conveyance Allowance(%)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_conveyance_allowance"
                                        id="salary_config_conveyance_allowance" class="form-control" value="">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Festival Bonus(%)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_festival_bonus"
                                        id="salary_config_festival_bonus" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Festival Bonus Active Period(Month)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_festival_bonus_active_period"
                                        id="salary_config_festival_bonus_active_period" class="form-control"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Provident Found(%)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="salary_config_provident_fund"
                                        id="salary_config_provident_fund" class="form-control" value="">
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



    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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





            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'salary-config-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#salary_config_basic_salary').val(res.salary_config_basic_salary);
                        $('#salary_config_house_rent_allowance').val(res
                            .salary_config_house_rent_allowance);
                        $('#salary_config_conveyance_allowance').val(res
                            .salary_config_conveyance_allowance);
                        $('#salary_config_medical_allowance').val(res
                            .salary_config_medical_allowance);
                        $('#salary_config_festival_bonus').val(res
                        .salary_config_festival_bonus);
                        $('#salary_config_provident_fund').val(res
                        .salary_config_provident_fund);
                        $('#salary_config_festival_bonus_active_period').val(res
                            .salary_config_festival_bonus_active_period);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            //   $('#edit_form').submit(function(e) {
            //         e.preventDefault();
            //         let formData = new FormData(this);
            //         console.log(formData);
            //         $('#error-message').text('');

            //         $.ajax({
            //             type:'POST',
            //             url: `/update-salary-config`,
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             success: function(response)  {
            //                 toastr.success(response.success,'Data successfully updated!!');
            //             },
            //             error: function(response){
            //                 toastr.error(response.error,'Please Entry Valid Data!!');
            //             }
            //         });
            //     });

            // edit form submission ends








        });
    </script>
@endsection
