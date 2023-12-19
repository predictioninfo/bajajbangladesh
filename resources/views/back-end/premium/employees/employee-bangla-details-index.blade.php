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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ $employee_name->first_name }}</h1>
            </div>
        </div>


        <span id="form_result"></span>
        <section class="forms">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>{{ __('Employee Details Add/Update') }}</h4>
                            </div>
                            <div class="card-body">
                                <p class="italic">
                                    <small>{{ __('The field labels marked with * are required input
                                                                    fields') }}.</small>
                                </p>

                                @if ($add == 1)
                                    <form method="POST" action="{{ route('user-input-banglas') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" class="form-control" name="empdetails_employee_id"
                                            value="{{ $employee_id }}">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Name') }}
                                                        </strong><span>(Bangla)</span></label>
                                                    <input type="text" name="bangla_name" class="form-control"
                                                        placeholder="Employee Bangla Name" value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Father Name') }} </strong></label>
                                                    <input type="text" name="father_name" class="form-control"
                                                        value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Mother Name') }} </strong></label>
                                                    <input type="text" name="mother_name" class="form-control"
                                                        value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="text-bold">Division Name:</label>
                                                <select name="division_id" id="division_id"
                                                    class="form-control selectpicker region" data-live-search="true"
                                                    data-live-search-style="begins" data-dependent="area_name"
                                                    title="{{ __('Selecting Division name') }}...">
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->dv_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="" class="text-bold">District Name:</label>
                                                <select class="form-control" name="district_id" id="district_id"></select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="" class="text-bold">Upazila Name:</label>

                                                <select class="form-control" name="upazila_id" id="upazila_id"></select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="" class="text-bold">Union Name:</label>

                                                <select class="form-control" name="union_id" id="union_id"></select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Village Name') }}
                                                        </strong><span>(Bangla)</span></label>
                                                    <input type="text" name="village_bn" class="form-control"
                                                        value="" placeholder="Village Name in  Bangla" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Village Name') }} </strong></label>
                                                    <input type="text" name="village_bn" class="form-control"
                                                        value="" placeholder="Village Name in  English" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Postal Area') }}
                                                        </strong><span>(Bangla)</span></label>
                                                    <input type="text" name="postal_area_bn" class="form-control"
                                                        value="" placeholder="Postal Area In Bangla" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Postal Area English') }} </strong></label>
                                                    <input type="text" name="postal_area_bn" class="form-control"
                                                        value="" placeholder="Postal Area In English" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-bold">{{ __('Previous Organization') }} <span
                                                            class="text-danger"></span></label>
                                                    <input type="text" name="previous_organization"
                                                        class="form-control" value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{ __('Total Experience') }} </strong></label>
                                                    <input type="text" name="experience_month" class="form-control"
                                                        value="" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label class="text-bold">{{ __('Identification Type') }} <span
                                                        class="text-danger">*</span></label>

                                                <select class="form-control" name="identification_type">
                                                    <option value="" selected="selected" disabled="disabled">--
                                                        select one --
                                                    </option>
                                                    <option value="nid">NID Number</option>
                                                    <option value="birthcertificate">Birth Certificate Number</option>
                                                    <option value="passport-number">Passport Number</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="" class="text-bold">Identification Number</label>
                                                <input type="text" name="identification_number" value=""
                                                    class="form-control" />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="text-bold">{{ __('Religion') }} <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="religion" required>
                                                    <option value="" selected="selected" disabled="disabled">--
                                                        select one --
                                                    </option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Hinduism">Hinduism</option>
                                                    <option value="Buddhism">Buddhism</option>
                                                    <option value="Christianity">Christianity</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>


                                            <div class="col-md-6 form-group">
                                                <label class="text-bold">{{ __('Marital Status') }} <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="marital_status" required>
                                                    <option value="" selected="selected" disabled="disabled">--
                                                        select one --
                                                    </option>
                                                    <option value="Unmarried">Unmarried</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                            </div>


                                            <div class="col-md-6 mt-5">
                                                <div class="form-group">
                                                    <input type="submit" id="submit" value="{{ __('Submit') }}"
                                                        class="btn btn-primary">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                @else
                                    @foreach ($employee_details as $employee_details_value)
                                        <form method="POST" action="{{ route('user-input-banglas') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" class="form-control" name="empdetails_employee_id"
                                                value="{{ $employee_id }}">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Name') }}
                                                            </strong><span>(Bangla)</span></label>
                                                        <input type="text" name="bangla_name" class="form-control"
                                                            placeholder="Employee Bangla Name"
                                                            value="{{ $employee_details_value->bangla_name }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Father Name') }} </strong></label>
                                                        <input type="text" name="father_name" class="form-control"
                                                            value="{{ $employee_details_value->father_name }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Mother Name') }} </strong></label>
                                                        <input type="text" name="mother_name" class="form-control"
                                                            value="{{ $employee_details_value->mother_name }}" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="" class="text-bold">Division Name:
                                                    </label>
                                                    <select name="division_id" id="division_id_edit"
                                                        class="form-control selectpicker " data-live-search="true"
                                                        data-live-search-style="begins" data-dependent="area_name"
                                                        title="{{ __('Selecting Division name') }}...">
                                                        @foreach ($divisions as $division)
                                                            <option value="{{ $division->id }}"
                                                                {{ $employee_details_value->division_id == $division->id ? 'selected' : '' }}>
                                                                {{ $division->dv_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="" class="text-bold">District Name: </label>
                                                    <select class="form-control" name="district_id"
                                                        id="district_id_edit"   title="{{ __('Selecting District name') }}...">
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}"
                                                                {{ $employee_details_value->district_id == $district->id ? 'selected' : '' }}>
                                                                {{ $district->dist_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="" class="text-bold">Upazila Name: </label>
                                                    <select class="form-control" name="upazila_id" id="upazila_id_edit"  title="{{ __('Selecting Upazila name') }}...">
                                                        @foreach ($upzillas as $upzilla)
                                                            <option value="{{ $upzilla->id }}"
                                                                {{ $employee_details_value->upazila_id == $upzilla->id ? 'selected' : '' }}>
                                                                {{ $upzilla->up_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="" class="text-bold">Union Name: </label>


                                                    <select class="form-control" name="union_id" id="union_id_edit"  title="{{ __('Selecting Union name') }}...">
                                                        @foreach ($unions as $union)
                                                            <option value="{{ $union->id }}"
                                                                {{ $employee_details_value->union_id == $union->id ? 'selected' : '' }}>
                                                                {{ $union->un_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Village Name') }}
                                                            </strong><span>(Bangla)</span></label>
                                                        <input type="text" name="village_bn" class="form-control"
                                                            value="{{ $employee_details_value->village_bn }}"
                                                            placeholder="Village Name in  Bangla" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Village Name') }} </strong></label>
                                                        <input type="text" name="village_bn" class="form-control"
                                                            value="{{ $employee_details_value->village_bn }}"
                                                            placeholder="Village Name in  English" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Postal Area') }}
                                                            </strong><span>(Bangla)</span></label>
                                                        <input type="text" name="postal_area_bn" class="form-control"
                                                            value="{{ $employee_details_value->postal_area_bn }}"
                                                            placeholder="Postal Area In Bangla" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Postal Area') }} </strong></label>
                                                        <input type="text" name="postal_area_en" class="form-control"
                                                            value="{{ $employee_details_value->postal_area_bn }}"
                                                            placeholder="Postal Area In English" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="text-bold">{{ __('Previous Organization') }}</label>
                                                        <input type="text" name="previous_organization"
                                                            class="form-control"
                                                            value="{{ $employee_details_value->previous_organization }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>{{ __('Total Experience') }} </strong></label>
                                                        <input type="text" name="experience_month"
                                                            class="form-control"
                                                            value="{{ $employee_details_value->experience_month }}" />
                                                    </div>
                                                </div>


                                                <div class="col-md-6 form-group">
                                                    <label class="text-bold">{{ __('Identification Type') }} <span
                                                            class="text-danger">*</span></label>

                                                    <select class="form-control" name="identification_type" required>
                                                        <option value="" selected="selected" disabled="disabled">--
                                                            select one --
                                                        </option>
                                                        <option value="nid" <?php if ($employee_details_value->identification_type == 'nid') {
                                                            echo 'selected="selected"';
                                                        } ?>>NID Number</option>
                                                        <option value="birthcertificate" <?php if ($employee_details_value->identification_type == 'birthcertificate') {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Birth
                                                            Certificate Number</option>
                                                        <option value="passport-number" <?php if ($employee_details_value->identification_type == 'passport-number') {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Passport Number
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="" class="text-bold">Identification Number</label>
                                                    <input type="text" name="identification_number"
                                                        value="{{ $employee_details_value->identification_number }}"
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="text-bold">{{ __('Religion') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" name="religion" required>
                                                        <option value="" selected="selected" disabled="disabled">--
                                                            select one --
                                                        </option>
                                                        <option value="Islam" <?php if ($employee_details_value->religion == 'Islam') {
                                                            echo 'selected="selected"';
                                                        } ?>>Islam</option>
                                                        <option value="Hinduism" <?php if ($employee_details_value->religion == 'Hinduism') {
                                                            echo 'selected="selected"';
                                                        } ?>>Hinduism</option>
                                                        <option value="Buddhism" <?php if ($employee_details_value->religion == 'Buddhism') {
                                                            echo 'selected="selected"';
                                                        } ?>>Buddhism</option>
                                                        <option value="Christianity" <?php if ($employee_details_value->religion == 'Christianity') {
                                                            echo 'selected="selected"';
                                                        } ?>>Christianity
                                                        </option>
                                                        <option value="Other" <?php if ($employee_details_value->religion == 'Other') {
                                                            echo 'selected="selected"';
                                                        } ?>>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="text-bold">{{ __('Marital Status') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" name="marital_status" required>
                                                        <option value="" selected="selected" disabled="disabled">--
                                                            select one --
                                                        </option>
                                                        <option value="Unmarried" <?php if ($employee_details_value->marital_status == 'Unmarried') {
                                                            echo 'selected="selected"';
                                                        } ?>>Unmarried</option>
                                                        <option value="Married" <?php if ($employee_details_value->marital_status == 'Married') {
                                                            echo 'selected="selected"';
                                                        } ?>>Married</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6 mt-5">
                                                    <div class="form-group">
                                                        <input type="submit" id="submit" value="{{ __('Submit') }}"
                                                            class="btn btn-primary">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    @endforeach
                                @endif


                            </div>
                        </div>


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

            var i = 1;

            // var full_name = '';


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


            $('#division_id').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-district/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#district_id').empty();
                                $('#district_id').append(
                                    '<option hidden value="" >Choose Division</option>');
                                $.each(data, function(key, districts) {
                                    $('select[name="district_id"]').append(
                                        '<option value="' + districts.id + '">' +
                                        districts.dist_name + '</option>');
                                });
                            } else {
                                $('#districts').empty();
                            }
                        }
                    });
                } else {
                    $('#districts').empty();
                }
            });


            $('#district_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-upazila/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#upazila_id').empty();
                                $('#upazila_id').append(
                                    '<option hidden value="" >Choose Upazila</option>');
                                $.each(data, function(key, upazilas) {
                                    $('select[name="upazila_id"]').append(
                                        '<option value="' + upazilas.id + '">' +
                                        upazilas.up_name + '</option>');
                                });
                            } else {
                                $('#upazilas').empty();
                            }
                        }
                    });
                } else {
                    $('#upazilas').empty();
                }
            });

            $('#upazila_id').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-union/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#union_id').empty();
                                $('#union_id').append(
                                    '<option hidden value="">Choose Union</option>');
                                $.each(data, function(key, unions) {
                                    $('select[name="union_id"]').append(
                                        '<option value="' + unions.id + '">' +
                                        unions.un_name + '</option>');
                                });
                            } else {
                                $('#unions').empty();
                            }
                        }
                    });
                } else {
                    $('#unions').empty();
                }
            });

            $('#division_id_edit').on('change', function() {
                var regionID = $(this).val();
                if (regionID) {
                    $.ajax({
                        url: '/get-district/' + regionID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#district_id_edit').empty();
                                $('#district_id_edit').append(
                                    '<option hidden value="">Choose District</option>');
                                $.each(data, function(key, districts) {
                                    $('select[name="district_id"]').append(
                                        '<option value="' + districts.id + '">' +
                                        districts.dist_name + '</option>');
                                });
                            } else {
                                $('#districts').empty();
                            }
                        }
                    });
                } else {
                    $('#districts').empty();
                }
            });

            $('#district_id_edit').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-upazila/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#upazila_id_edit').empty();
                                $('#upazila_id_edit').append(
                                    '<option hidden value="">Choose Upazila</option>');
                                $.each(data, function(key, upazilas) {
                                    $('select[name="upazila_id"]').append(
                                        '<option value="' + upazilas.id + '">' +
                                        upazilas.up_name + '</option>');
                                });
                            } else {
                                $('#upazilas').empty();
                            }
                        }
                    });
                } else {
                    $('#upazilas').empty();
                }
            });

            $('#upazila_id_edit').on('change', function() {
                var areaID = $(this).val();
                if (areaID) {
                    $.ajax({
                        url: '/get-union/' + areaID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#union_id_edit').empty();
                                $('#union_id_edit').append(
                                    '<option hidden value="">Choose Union</option>');
                                $.each(data, function(key, unions) {
                                    $('select[name="union_id"]').append(
                                        '<option value="' + unions.id + '">' +
                                        unions.un_name + '</option>');
                                });
                            } else {
                                $('#unions').empty();
                            }
                        }
                    });
                } else {
                    $('#unions').empty();
                }
            });

        });
    </script>
@endsection
