@extends('back-end.premium.layout.premium-main')
@section('content')

    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    <section class="main-contant-section">
        <div class="">
            @if (Session::get('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center">Performance Value Configure </h1>
                </div>
            </div>

            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'Valuetype')"> Value Type </button>
                            <button class="tablinks" onclick="openCity(event, 'Valuetypedetail')"> Value Type Details
                            </button>
                        </div>

                        <div id="valuepoint" class="tabcontent">

                            <div class="content-box">

                                <div class="table-responsive mt-4">
                                    <table id="user-table" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL') }}</th>
                                                <th>{{ __('Value Signature') }}</th>
                                                <th>{{ __('Value Marks') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($variable_points as $variable_point)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $variable_point->value_signature }}</td>
                                                    <td>{{ $variable_point->value_marks }}</td>

                                                </tr>

                                                <div id="points{{ $variable_point->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 id="exampleModalLabel" class="modal-title">
                                                                    {{ _('Edit') }}</h5>
                                                                <button type="button" data-dismiss="modal" id="close"
                                                                    aria-label="Close" class="close"><i
                                                                        class="dripicons-cross"></i></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form method="post"
                                                                    action="{{ route('update-value-point-configures', $variable_point->id) }}"
                                                                    class="form-horizontal" enctype="multipart/form-data">

                                                                    @csrf
                                                                    <div class="row">

                                                                        <input type="hidden" name="id"
                                                                            value="{{ $variable_point->id }}">


                                                                        <div class="col-md-12">
                                                                            <div class="input-group mb-3">
                                                                                <label>{{ __('Value Marks') }} *</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"> <i
                                                                                            class="fa fa-vine"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="text" name="valuemarks"
                                                                                    value="{{ $variable_point->value_marks }}"
                                                                                    required class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="input-group mb-3">
                                                                                <label>{{ __('Value Signature') }}
                                                                                    *</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"> <i
                                                                                            class="fa fa-vine"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="text" name="valuesignature"
                                                                                    value="{{ $variable_point->value_signature ?? null }}"
                                                                                    required class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 mt-4">

                                                                            <input type="submit" name="action_button"
                                                                                class="btn btn-grad"
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

                        <div id="Valuetype" class="tabcontent">

                            <div class="content-box">
                                <form class="form-inline performance-value-config" method="POST"
                                    action="{{ route('value-types') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-md-4 form-group">
                                        <label for="email">Value Type Name:</label>
                                        <input type="text" name="value_type_name" class="code form-control"
                                            placeholder="Value Type Name" required />
                                    </div>
                                    <div class="form-group col-md-12 mt-4">
                                        <button type="submit" class="btn btn-grad"> save </button>
                                    </div>

                                </form>
                                <div class="table-responsive mt-4">

                                    <table id="user-table" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL') }}</th>
                                                <th>{{ __('Value Name') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($variable_types as $value)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $value->value_type_name }}</td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button"
                                                                data-toggle="dropdown">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <a href="#" id="edit-post" class="btn "
                                                                    data-toggle="modal"
                                                                    data-target="#type{{ $value->id }}">Edit</a>
                                                                <a href="{{ route('delete-value-types', $value->id) }}"
                                                                    class="btn btn-dlete">Delete</a>
                                                            </ul>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <div id="type{{ $value->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 id="exampleModalLabel" class="modal-title">
                                                                    {{ _('Edit') }}</h5>
                                                                <button type="button" data-dismiss="modal"
                                                                    id="close" aria-label="Close" class="close"><i
                                                                        class="dripicons-cross"></i></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form method="post"
                                                                    action="{{ route('update-value-types', $value->id) }}"
                                                                    class="form-horizontal" enctype="multipart/form-data">

                                                                    @csrf
                                                                    <div class="row">

                                                                        <input type="hidden" name="id"
                                                                            value="{{ $value->id }}">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group mb-3">
                                                                                <label>{{ __('Value Marks') }} *</label>
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"> <i
                                                                                            class="fa fa-vine"
                                                                                            aria-hidden="true"></i> </span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="value_type_name"
                                                                                    value="{{ $value->value_type_name }}"
                                                                                    required class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 mt-4">

                                                                            <input type="submit" name="action_button"
                                                                                class="btn btn-grad"
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




                        <div id="Valuetypedetail" class="tabcontent">

                            <div class="content-box">
                                <form class="form-inline performance-value-config row" method="POST"
                                    action="{{ route('value-type-details') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-4">
                                        <div class=" form-group">
                                            <label> <label for="email">Value Type name:</label></label>

                                            <select name="value_type_id" class="form-control selectpicker "
                                                data-live-search="true" data-live-search-style="begins"
                                                data-dependent="point" title="{{ __('Selecting  Value Type Name') }}..."
                                                required>
                                                @foreach ($variable_types as $variable_type)
                                                    <option value="{{ $variable_type->id }}">
                                                        {{ $variable_type->value_type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pwd">Value Details:</label>
                                            <input type="text" class="code form-control" name="valuedetails"
                                                placeholder="Value Details" required />
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12 mt-4">
                                        <button type="submit" class="btn btn-grad"> save </button>
                                    </div>
                                </form>
                                <div class="table-responsive mt-4">

                                    <table id="user-table" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL') }}</th>
                                                <th>{{ __('Value Name') }}</th>
                                                <th>{{ __('Value Details') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($value_type_details as $value_type_detail)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $value_type_detail->valueDeatils->value_type_name }}</td>
                                                    <td>{{ $value_type_detail->value_type_detail_value }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button"
                                                                data-toggle="dropdown">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <a href="#" id="edit-post" class="btn "
                                                                    data-toggle="modal"
                                                                    data-target="#typedetails{{ $value_type_detail->id }}">Edit</a>
                                                                <a href="{{ route('delete-value-type-details', $value_type_detail->id) }}"
                                                                    class="btn btn-dlete">Delete</a>
                                                            </ul>
                                                        </div>

                                                    </td>
                                                </tr>

                                                </tr>
                                                <div id="typedetails{{ $value_type_detail->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 id="exampleModalLabel" class="modal-title">
                                                                    {{ _('Edit') }}</h5>
                                                                <button type="button" data-dismiss="modal"
                                                                    id="close" aria-label="Close" class="close"><i
                                                                        class="dripicons-cross"></i></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form method="post"
                                                                    action="{{ route('update-value-type-details', $value_type_detail->id) }}"
                                                                    class="form-horizontal" enctype="multipart/form-data">

                                                                    @csrf
                                                                    <div class="col-md-12 form-group">
                                                                        <label> <label for="email">Value Type
                                                                                name:</label></label>

                                                                        <select name="value_type_id_edit"
                                                                            class="form-control  " data-live-search="true"
                                                                            data-live-search-style="begins"
                                                                            data-dependent="typedetails"
                                                                            title="{{ __('Selecting  Value Type Name') }}..."
                                                                            required>
                                                                            @foreach ($variable_types as $variable_type)
                                                                                <option value="{{ $variable_type->id }}" {{ $value_type_detail->value_type_detail_value_type_id == $variable_type->id ? 'selected' : ''}}>
                                                                                    {{ $variable_type->value_type_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="input-group mb-3">
                                                                            <label for="pwd">Value Details:</label>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"> <i
                                                                                        class="fa fa-location-arrow"
                                                                                        aria-hidden="true"></i> </span>
                                                                            </div>
                                                                            <input type="text"
                                                                                class="code form-control"
                                                                                name="valuedetailsedit" value="{{ $value_type_detail->value_type_detail_value }}"
                                                                                placeholder="Value Details" required />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12 mt-4">

                                                                        <input type="submit" class="btn btn-grad "
                                                                            value="{{ __('Update') }}" />

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

                    </div>
                </div>
            </div>
        </div>


        </div>
    </section>


    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        var i = 1;

        function addOB(id) {
            $('#Objective_plan').append(`

                <tr valign="top">
                <td> <input type="text" readonly value="${i++}" />

                 </td>
                <td><input type="text" name="objective_name[]" class="code" id="customFieldName"  value="" placeholder="Objective Name" required/></td>
                <td> <input type="text" class="code" id="customFieldValue" name="objective_success[]" value="" placeholder="Objective Name Succes" required/> </td>
                <td class="remBtn"> <a href="javascript:void(0);" class="remOB btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
            </tr> `);
        }
        $("#Objective_plan").on('click', '.remOB', function() {
            $(this).parent().parent().remove();
        });

        $(document).ready(function() {


            var i = 1;
            $(".addOP").click(function() {
                $("#Operational_plan").append(`
                <tr valign="top">

                    <td> <input type="text" readonly value="${i++}" />  </td>
                    <td><input type="text" name="development_name[]" class="code" id="customFieldName"  value="" placeholder="Development Name" required /></td>
                    <td><input type="text" name="meassure_of_success[]" class="code" id="customFieldName"  value="" placeholder="Measure of Success" required/></td>
                    <td> <input type="text" class="code" id="customFieldValue" name="action_taken[]" value="" placeholder="Action Taken" /> </td>

                    <td class="remBtn"> <a href="javascript:void(0);" class="remOP btn"><i class="fa fa-minus" aria-hidden="true"></i></a> </td>
                </tr>
            `);
            });
            $("#Operational_plan").on('click', '.remOP', function() {
                $(this).parent().parent().remove();
            });

        });
    </script>
@endsection
