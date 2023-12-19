@extends('back-end.premium.layout.super-system-admin-main')
@section('content')
    <?php
    use App\Models\Company;
    use App\Models\User;
    ?>
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
                    <h1 class="card-title text-center"> {{ __('Company List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                        <li><a href="#">List - {{ 'Company List' }} </a></li>
                    </ol>
                </div>
            </div>



        </div>

        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Company') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('add-companies') }}" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Logo</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-file-image-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="file" name="company_logo" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Bangla Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_name_bangla">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Email</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-envelope-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Password</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" name="company_password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Phone</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-phone"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Address</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_address">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Web Address</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-firefox"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_web_address">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Employee ID Prefix</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-id-badge"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="employee_id_prefix">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">City</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_city">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Country</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-globe"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_country">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="staticEmail">Package</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="company_package">
                                                <option>Select-A-Package</option>
                                                @foreach ($packages as $packages_value)
                                                    <option value="{{ $packages_value->id }}">
                                                        {{ $packages_value->package_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label for="staticEmail">Company Create
                                            Limit(Optional)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-plus-square-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" name="company_create_limit"
                                            placeholder="10">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
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
                            <th>{{ __('Company Name') }}</th>
                            <th>{{ __('Company Email') }}</th>
                            <th>{{ __('Company Package') }}</th>
                            <th>{{ __('Mother Company') }}</th>
                            <th>{{ __('Employee ID Prefix') }}</th>
                            <th>{{ __('Total Active Employee') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($companies as $companies_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $companies_value->company_name ?? '' }}</td>
                                <td>{{ $companies_value->company_email ?? '' }}</td>
                                <td>{{ $companies_value->companypackage->package_name ?? '' }}</td>
                                <td>
                                    <?php $mother_companies = Company::where('id', $companies_value->company_mother_id)->get('company_name'); ?>
                                    @foreach ($mother_companies as $mother_companies_value)
                                        {{ $mother_companies_value->company_name ?? '' }}
                                    @endforeach
                                </td>
                                <td>{{ $companies_value->employee_id_prefix ?? '' }}</td>
                                <td>
                                    <?php $total_employees = User::where('com_id', $companies_value->id)
                                        ->where('is_active', 1)
                                        ->count(); ?>
                                    {{ $total_employees }}
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn edit" data-id="{{ $companies_value->id }}"
                                        data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                    <a href="{{ route('delete-companies', ['id' => $companies_value->id]) }}"
                                        class="btn btn-danger  delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>


                                </td>
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
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                        class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal row" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Logo</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="file" name="company_logo" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_name" id="company_name">
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                                <div class="input-group mb-3">
                                <label for="staticEmail">Company Bangla Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_name_bangla">
                                </div>
                            </div> -->
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Email</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_email" id="company_email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Password</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
                                </div>
                                <input type="password" class="form-control" name="company_password"
                                    id="company_password">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Phone</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_phone" id="company_phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Address</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_address" id="company_address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Web Address</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-firefox" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_web_address"
                                    id="company_web_address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Employee ID Prefix</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-id-badge" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="employee_id_prefix"
                                    id="employee_id_prefix">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">City</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_city" id="company_city">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Country</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-globe" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="company_country" id="company_country">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-12 col-form-label">Package</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="company_package" id="company_package">
                                        <option value="">Select-A-Package</option>
                                        @foreach ($packages as $packages_value)
                                            <option value="{{ $packages_value->id }}">{{ $packages_value->package_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <label for="staticEmail">Company Create
                                    Limit(Optional)</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-plus-square-o"
                                            aria-hidden="true"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="company_create_limit"
                                    id="company_create_limit" placeholder="10">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad">Save changes</button>
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

            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'company-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#company_name').val(res.company_name);
                        $('#company_email').val(res.company_email);
                        $('#company_password').val(res.company_password);
                        $('#company_phone').val(res.company_phone);
                        $('#company_address').val(res.company_address);
                        $('#company_package').val(res.company_package);
                        $('#company_web_address').val(res.company_web_address);
                        $('#employee_id_prefix').val(res.employee_id_prefix);
                        $('#company_city').val(res.company_city);
                        $('#company_country').val(res.company_country);
                        $('#company_create_limit').val(res.company_create_limit);
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


            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-company`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.success, 'Data successfully updated!!');
                    },
                    error: function(response) {
                        toastr.error(response.error, 'Please Entry Valid Data!!');
                    }
                });
            });

            // edit form submission ends


        });
    </script>
@endsection
