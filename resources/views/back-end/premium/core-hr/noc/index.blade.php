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
                    <h1 class="card-title text-center"> {{ __('Employee NOC List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#" type="button" data-toggle="modal" data-target="#nocEmployeeListModal"><span
                                    class="icon icon-plus"> </span>NOC Employee List</a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>

                        <li><a href="#">List - NOC</a></li>
                    </ol>
                </div>
            </div>


        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add NOC') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-noc-employee') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 form-group">
                                    <label>Employees <span class="text-danger">*</span></label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        data-live-search-style="begins" title="Selecting..." name="noc_employee_id"
                                        id="noc_employee_id" required>
                                        <option value="">Select-a-Department</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name }} {{ $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>NOC Template <span class="text-danger">*</span></label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        data-live-search-style="begins" title="Selecting..." name="noc_template_id"
                                        id="noc_template_id" required>
                                        <option value="">Select-a-NOC-Template</option>
                                        @foreach ($noc_templates as $noc_template)
                                            <option value="{{ $noc_template->id }}">
                                                {{ $noc_template->non_objection_certificate_subject }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label> Place Of Issue <span class="text-danger">*</span></label>
                                    <input type="text" name="place_of_issue" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label> Date Of Issue <span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_issue" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label> Date Of Expiry </label>
                                    <input type="date" name="date_of_expiry" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label> Purpose Of NOC <span class="text-danger">*</span> </label>
                                    <input type="text" name="purpose_of_noc" class="form-control">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label> Document </label>
                                    <input type="file" name="noc_document" id="noc_document" class="form-control">
                                </div>
                                <div class="col-md-4 form-group" id="previewContainer" style="width: 150px"
                                    height="150px">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label> Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" required></textarea>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Add </button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
        <div id="nocEmployeeListModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('NOC Employee Eligible List') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($noc_employee_list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>
                                        <a onclick="return confirm('Are you sure?')"
                                        href="{{ route('unacceptable-noc', ['id' => $item->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title="Unacceptable "
                                        data-original-title="Unacceptable"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <!-- Add Modal Ends -->
        <ul class="btn-tasks">
            <li class="dropdown" style="display: inline-block;">
                <a href="{{ route('all-noc-employee-pdf') }}" class="btn-grad btn" title="Download PDF"
                    data-toggle="tooltip" data-original-title="Download PDF">
                    <i class="fa fa-file-pdf-o"></i>
                </a>
            </li>
            <li class="dropdown" style="display: inline-block;">
                <button class="btn-grad btn toggle-form" data-toggle="tooltip" data-original-title="Search Form"><i
                        class="fa fa-plus"></i></button>
            </li>
        </ul>

        <div id="form-container" style="display: none; padding-left: 40px">
            <form action="{{ route('noc-employees') }}" method="GET" enctype="multipart/form-data">
                {{-- @csrf --}}
                <div class="row align-items-end">
                    <div class="col-md-2">
                        <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>
                        <select name="noc_employee_id" id="" class="form-control">
                            <option value="">Select Employee</option>
                            @foreach ($noc_employees as $noc_employee)
                                <option value="{{ $noc_employee->noc_employee_id }}">
                                    {{ $noc_employee->nocemployee->first_name }}
                                    {{ $noc_employee->nocemployee->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label data-error="wrong" data-success="right" for="start_date_of_issue">Start Date of Issue
                        </label>
                        <input class="form-control" type="date" name="start_date_of_issue" value=""
                            id="">
                    </div>
                    <div class="col-md-2">
                        <label data-error="wrong" data-success="right" for="end_date_of_issue">End Date of Issue
                        </label>
                        <input class="form-control" type="date" name="end_date_of_issue" id=""
                            value="">
                    </div>
                    <div class="col-md-2">
                        <label for=""> &nbsp; </label>
                        <input type="submit" class="btn btn-grad" value="Serach">
                    </div>
                </div>
            </form>
        </div>
        <div class="content-box">
            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Employee Name') }}</th>
                            <th>{{ __('NOC Template') }}</th>
                            <th>{{ __('Place Of Issue') }}</th>
                            <th>{{ __('Date Of Issue') }}</th>
                            <th>{{ __('Date Of Expiry') }}</th>
                            <th>{{ __('Purpose Of NOC') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Document') }}</th>
                            <th>{{ __('Status') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($noc_employees as $noc_employee)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $noc_employee->nocemployee->first_name }}
                                    {{ $noc_employee->nocemployee->last_name }}</td>
                                <td>{{ $noc_employee->noctemplate->non_objection_certificate_subject ?? '' }}</td>
                                <td>{{ $noc_employee->place_of_issue }}</td>
                                <td>{{ $noc_employee->date_of_issue }}</td>
                                <td>{{ $noc_employee->date_of_expiry }}</td>
                                <td>{{ $noc_employee->purpose_of_noc }}</td>
                                <td>{{ $noc_employee->description }}</td>
                                <td>
                                    @if ($noc_employee->noc_document)
                                        @php($extension = pathinfo($noc_employee->noc_document, PATHINFO_EXTENSION))
                                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                            <a href="{{ $noc_employee->noc_document }}"
                                                download="{{ basename($noc_employee->noc_document) }}">
                                                <img src="{{ $noc_employee->noc_document }}" width="100px"
                                                    height="100px" />
                                            </a>
                                            <br />
                                            <a href="{{ $noc_employee->noc_document }}"
                                                download="{{ basename($noc_employee->noc_document) }}"
                                                class="btn btn-primary">
                                                {{ __('Download') }}
                                            </a>
                                        @elseif (strtolower($extension) == 'pdf')
                                            <a href="{{ $noc_employee->noc_document }}" target="_blank">
                                                <embed src="{{ $noc_employee->noc_document }}" type="application/pdf"
                                                    width="100px" height="100px" />
                                            </a>
                                            <br />
                                            <a href="{{ $noc_employee->noc_document }}"
                                                download="{{ basename($noc_employee->noc_document) }}"
                                                class="btn btn-primary">
                                                {{ __('Download') }}
                                            </a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($noc_employee->status == 0)
                                        <label for="" class="btn btn-danger">{{ __('Pending') }}</label>
                                    @elseif($noc_employee->status == 1)
                                        <label for="" class="btn btn-info">{{ __('Approved') }}</label>
                                    @endif
                                </td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($noc_employee->status == 0)
                                            <a href="javascript:void(0)" class="btn btn-info approve"
                                                data-id="{{ $noc_employee->id }}" data-toggle="tooltip"
                                                title=" Approve" data-original-title="Approve"> <i
                                                    class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                        @elseif($noc_employee->status == 1)
                                            <a onclick="return confirm('Are you sure Dissapprove?')"
                                                href="{{ route('disapprove-noc-request', ['id' => $noc_employee->id]) }}"
                                                class="btn btn-danger" data-id="" data-toggle="tooltip"
                                                title=" Disapprove" data-original-title="Disapprove"> <i
                                                    class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                        @endif


                                        <a href="javascript:void(0)" class="btn view" data-id="{{ $noc_employee->id }}"
                                            data-toggle="tooltip" title=" View" data-original-title="View"> <i
                                                class="fa fa-eye" aria-hidden="true"></i></a>
                                        @if ($noc_employee->noc_template_id)
                                            <a href="{{ route('pdf-noc-employee', ['id' => $noc_employee->id]) }}"
                                                class="btn btn-info" data-toggle="tooltip" title=" PDF"
                                                data-original-title="PDF"><i class="fa fa-file-pdf-o"
                                                    aria-hidden="true"></i></a>
                                        @endif
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $noc_employee->id }}" data-toggle="tooltip" title=" Edit "
                                                data-original-title="Edit"> <i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                            <a onclick="return confirm('Are you sure?')"
                                                href="{{ route('delete-noc-employee', ['id' => $noc_employee->id]) }}"
                                                class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                data-original-title="Delete"><i class="fa fa-trash-o"
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
    </section>




    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-noc-employee') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>

                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label>Employees <span class="text-danger">*</span></label>
                                <select class="form-control" name="noc_employee_id" id="edit_noc_employee_id" required>
                                    <option value="">Select-a-Department</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->first_name }} {{ $employee->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>NOC Template <span class="text-danger">*</span></label>
                                <select class="form-control" name="noc_template_id" id="edit_noc_template_id" required>
                                    <option value="">Select-a-NOC-Template</option>
                                    @foreach ($noc_templates as $noc_template)
                                        <option value="{{ $noc_template->id }}">
                                            {{ $noc_template->non_objection_certificate_subject }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label> Place Of Issue <span class="text-danger">*</span></label>
                                <input type="text" name="place_of_issue" id="edit_place_of_issue"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label> Date Of Issue <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_issue" id="edit_date_of_issue" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label> Date Of Expiry </label>
                                <input type="date" name="date_of_expiry" id="edit_date_of_expiry"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label> Purpose Of NOC <span class="text-danger">*</span> </label>
                                <input type="text" id="edit_purpose_of_noc" name="purpose_of_noc"
                                    class="form-control">
                            </div>
                            <div class="col-md-2 form-group">
                                <label> Document </label>
                                <input type="file" name="noc_document" id="edit_noc_document" class="form-control">
                            </div>
                            <div class="col-md-4 form-group" id="edit_previewContainer" style="width: 150px"
                                height="150px">
                            </div>
                            <input type="hidden" name="edit_previewContainer_hidden" id="edit_previewContainer_hidden">
                            <div class="col-md-12 form-group">
                                <label> Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="edit_description" required></textarea>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Save Change </button>
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
    <!-- show boostrap model -->
    <div class="modal fade" id="view-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelView"></h4>
                </div>
                <div class="modal-body">
                    <h2 class="text-right">
                        <a id="pdf-link" href="" class="btn btn-info" data-toggle="tooltip" title=" PDF"
                            data-original-title="PDF">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </a>
                    </h2>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>
                                <img height="50" width="100px" id="company-logo-img" src=""
                                    alt="Company Logo">
                            </td>
                            <td>Date: {{ now()->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>TO WHOM IT MAY CONCERN</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This is to certify that <strong> <span id="employee-name-placeholder"></span></strong> has
                                been working under the management of
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <span id="company-name-placeholder"></span> since <span
                                    id="joining-date-placeholder"></span>. He has been
                                designated as <span id="emlpoyee-designation-placeholder"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                under <span id="employee-department-placeholder"></span> at our client company Perfetti Van
                                Melle
                                (Bangladesh) Pvt. Ltd
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                We would like to inform you that <span id="employee-name-placeholder-1"></span> S/O Dr. Md.
                                Faizul
                                Kabir hails from House
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                no. 11, Road no. 5, Nikunja-2, Khilkhet, Dhaka-1229. He has taken personal
                                leave from 24 th
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                April 2023 to 3 rd May 2023 to visit Thailand for the purpose of tourism
                                during this period.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                To the best of our knowledge, he bears good moral character and is a
                                sincere person. His
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">personal information is as follows:</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>: <span id="employee-name-placeholder-2"></span></td>
                        </tr>
                        <tr>
                            <td>Job title</td>
                            <td>: <span id="emlpoyee-designation-placeholder-1"></span></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td>: <span id="employee-date-of-birth-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td>Passport No</td>
                            <td>: <span id="employee-passport-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td>Date of Issue</td>
                            <td>: <span id="date-of-issue-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td>Date of Expiry</td>
                            <td>: <span id="date-of-expiry-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td>Place of Birth</td>
                            <td>: <span id="place-of-birth-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td>: <span id="nationality-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td>Place of Issue</td>
                            <td>: DIP/ Dhaka</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                All concerned are requested to cooperate Dr. Shahriar Kabir accordingly.
                            </td>
                        </tr>
                        <tr>
                            <td>Regards, <br>
                                <img height="50" width="100px" id="singnature" src="" alt="Singnature">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><span id="singnatory-placeholder"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span id="singnatory-designation-placeholder"></span>,<br /><span
                                    id="singnatory-company-name-placeholder"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                1 | P a g e | <span id="singnatory-company-name-placeholder-1"></span>, <span
                                    id="company-address-placeholder"></span>, <span id="company-city-placeholder"></span>
                                , <span id="company-country-placeholder"></span>;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Tel: <a id="company-phone-placeholder" href=""><span
                                        id="company-phone-placeholder-2"></span></a>;
                                <a href="" id="company-website-placeholder" target="_blank"> <span
                                        id="company-website-placeholder-2"></span></a>
                                , email:
                                <span id="company-email-placeholder"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Classification: Internal</td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- show bootstrap model -->
    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-approve" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelApprove"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('approve-noc-request') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id_approve" required>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>NOC Template <span class="text-danger">*</span></label>
                                <select class="form-control" name="approve_noc_template_id" id="approve_noc_template_id"
                                    required>
                                    <option value="">Select-a-NOC-Template</option>
                                    @foreach ($noc_templates as $noc_template)
                                        <option value="{{ $noc_template->id }}">
                                            {{ $noc_template->non_objection_certificate_subject }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Save Change </button>
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
            //For edit 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'edit-noc-employee',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#edit_noc_employee_id').val(res.noc_employee_id);
                        $('#edit_noc_template_id').val(res.noc_template_id);
                        $('#edit_place_of_issue').val(res.place_of_issue);
                        $('#edit_date_of_issue').val(res.date_of_issue);
                        $('#edit_date_of_expiry').val(res.date_of_expiry);
                        $('#edit_purpose_of_noc').val(res.purpose_of_noc);
                        $('#edit_description').val(res.description);
                        $('#edit_previewContainer_hidden').val(res.noc_document);
                        if (res.noc_document.includes('.jpg') || res.noc_document.includes(
                                '.png') ||
                            res.noc_document.includes('.gif')) {
                            // It's an image file
                            $('#edit_previewContainer').html('<img src="' + res.noc_document +
                                '" width="150" height="150">');
                        } else if (res.noc_document.includes('.pdf') || res.noc_document
                            .includes(
                                '.doc') || res.noc_document.includes('.docx') || res
                            .noc_document.includes(
                                '.txt')) {
                            // It's a document file
                            $('#edit_previewContainer').html('<iframe src="' + res
                                .noc_document +
                                '" width="150" height="150"></iframe>');
                        } else {
                            // It's neither an image nor a document
                            $('#edit_previewContainer').html('<p>No preview available</p>');
                        }
                    }
                });
            });
            //For View
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.view').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'show-noc-employee',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#pdf-link').attr('href', "{{ route('pdf-noc-employee', ':id') }}"
                            .replace(':id', res.noc_employee.id));
                        const issue_date = new Date(res.noc_employee.date_of_issue);
                        const expiry_date = new Date(res.noc_employee.date_of_expiry);
                        const birthPlace = res.noc_employee.nocemployee?.emoloyeedetail
                            ?.birth_place || 'Unknown';
                        const nationality = res.noc_employee.nocemployee.emoloyeedetail
                            ?.user_nationality?.name || 'Unknown';
                        $('#ajaxModelView').html("View");
                        $('#view-modal').modal('show');
                        $('#id').val(res.id);
                        $('#company-logo-img').attr('src', res.company_logo.company_logo);
                        $("#employee-name-placeholder").text(res.noc_employee.nocemployee
                            .first_name + " " + res.noc_employee.nocemployee.last_name);
                        $("#company-name-placeholder").text(res.company_logo.company_name);
                        $("#joining-date-placeholder").text(res.noc_employee.nocemployee
                            .joining_date);
                        $("#emlpoyee-designation-placeholder").text(res.noc_employee.nocemployee
                            .userdesignation.designation_name);
                        $("#employee-department-placeholder").text(res.noc_employee.nocemployee
                            .userdesignation.designation_name);
                        $("#employee-name-placeholder-1").text(res.noc_employee.nocemployee
                            .first_name + " " + res.noc_employee.nocemployee.last_name);
                        $("#employee-name-placeholder-2").text(res.noc_employee.nocemployee
                            .first_name + " " + res.noc_employee.nocemployee.last_name);
                        $("#emlpoyee-designation-placeholder-1").text(res.noc_employee
                            .nocemployee.userdesignation.designation_name);
                        $("#employee-date-of-birth-placeholder").text(res.noc_employee
                            .nocemployee.date_of_birth);

                        const suffixes_for_issue_date = ["th", "st", "nd", "rd"];
                        const day_for_issue_date = issue_date.getDate();
                        const suffix_for_issue_date = suffixes_for_issue_date[(
                                day_for_issue_date >= 11 && day_for_issue_date <= 13) ? 0 :
                            ((day_for_issue_date - 1) % 10 <
                                4 ? (day_for_issue_date - 1) % 10 : 0)];

                        const formattedIssueDate =
                            `${day_for_issue_date}${suffix_for_issue_date} ${issue_date.toLocaleString('default', { month: 'long' })} ${issue_date.getFullYear()}`;
                        $('#date-of-issue-placeholder').text(formattedIssueDate);

                        const suffixes_for_expiry_date = ["th", "st", "nd", "rd"];
                        const day_for_expiry_date = expiry_date.getDate();
                        const suffix_for_expiry_date = suffixes_for_expiry_date[(
                                day_for_expiry_date >= 11 && day_for_expiry_date <= 13) ?
                            0 : ((day_for_expiry_date - 1) % 10 <
                                4 ? (day_for_expiry_date - 1) % 10 : 0)];

                        const formattedExpiryDate =
                            `${day_for_expiry_date}${suffix_for_expiry_date} ${expiry_date.toLocaleString('default', { month: 'long' })} ${expiry_date.getFullYear()}`;
                        $('#date-of-expiry-placeholder').text(formattedExpiryDate);

                        $("#place-of-birth-placeholder").text(birthPlace);
                        $("#nationality-placeholder").text(nationality);

                        if (res.noc_employee && res.noc_employee.noctemplate && res.noc_employee
                            .noctemplate.non_objection_certificate_signature) {
                            $('#singnature').attr('src', res.noc_employee.noctemplate
                                .non_objection_certificate_signature);
                        } else {
                            $('#singnature').attr('src', '');
                        }
                        if (res.noc_employee && res.noc_employee.noctemplate && res.noc_employee
                            .noctemplate.signatory && res.noc_employee.noctemplate.signatory
                            .first_name && res.noc_employee.noctemplate.signatory
                            .last_name) {
                            $('#singnatory-placeholder').text(res.noc_employee.noctemplate
                                .signatory
                                .first_name + " " + res.noc_employee.noctemplate.signatory
                                .last_name);
                        } else {
                            $('#singnatory-placeholder').text('');
                        }
                        if (res.noc_employee && res.noc_employee
                            .noctemplate && res.noc_employee
                            .noctemplate.signatory && res.noc_employee
                            .noctemplate.signatory.userdesignation && res.noc_employee
                            .noctemplate.signatory.userdesignation.designation_name) {
                            $('#singnatory-designation-placeholder').text(res.noc_employee
                                .noctemplate.signatory.userdesignation.designation_name);

                        } else {
                            $('#singnatory-designation-placeholder').text('');
                        }
                        $('#singnatory-company-name-placeholder').text(res.company_logo
                            .company_name);
                        $('#singnatory-company-name-placeholder-1').text(res.company_logo
                            .company_name);
                        $('#company-address-placeholder').text(res.company_logo
                            .company_address);
                        $('#company-city-placeholder').text(res.company_logo.company_city);
                        $('#company-country-placeholder').text(res.company_logo
                            .company_country);
                        $('#company-phone-placeholder').attr('href', 'tel:' + res.company_logo
                            .company_phone);
                        $('#company-phone-placeholder-2').text(res.company_logo
                            .company_phone);
                        $('#company-website-placeholder').attr('href', 'https://' + res
                            .company_logo
                            .company_web_address);
                        $('#company-website-placeholder-2').text(res.company_logo
                            .company_web_address);
                        $('#company-email-placeholder').text(res.company_logo.company_email);

                    }
                });
            });
            //For approve
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.approve').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'edit-noc-employee',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelApprove').html("Approve");
                        $('#edit-approve').modal('show');
                        $('#id_approve').val(res.id);
                        if (res.noc_template_id) {
                            $('#approve_noc_template_id').val(res.noc_template_id);
                        } else {
                            $('#approve_noc_template_id').val('');
                        }
                    }
                });
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
            $(document).ready(function() {
                $('.toggle-form').click(function() {
                    if ($('#form-container').is(':visible')) {
                        $('#form-container').slideUp();
                        var buttonIcon = '<i class="fa fa-plus"></i>';
                    } else {
                        $('#form-container').slideDown();
                        var buttonIcon = '<i class="fa fa-minus"></i>';
                    }
                    $(this).html(buttonIcon);
                });
            });

            // JavaScript code to preview the selected file
            const fileInput = document.getElementById('noc_document');
            const previewContainer = document.getElementById('previewContainer');

            fileInput.addEventListener('change', function() {
                const file = this.files[0];

                // Check if the selected file is an image
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.width = '150px'; // Set the width of the image
                    img.style.height = '150px'; // Set the height of the image
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(img);
                }

                // Check if the selected file is a PDF
                else if (file.type === 'application/pdf') {
                    const pdf = document.createElement('embed');
                    pdf.src = URL.createObjectURL(file);
                    pdf.style.width = '245px'; // Set the width of the PDF
                    pdf.style.height = '150px'; // Set the height of the PDF
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(pdf);
                }

                // For other file types, display a message
                else {
                    previewContainer.innerHTML = 'File must be image or pdf';
                    event.target.value = ''; // Reset the file input element
                    return false; // Prevent form submission
                }
            });


            // JavaScript code to preview the selected file for edit 
            const fileInputEdit = document.getElementById('edit_noc_document');
            const previewContainerEdit = document.getElementById('edit_previewContainer');

            fileInputEdit.addEventListener('change', function() {
                const file = this.files[0];

                // Check if the selected file is an image
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.width = '150px'; // Set the width of the image
                    img.style.height = '150px'; // Set the height of the image
                    previewContainerEdit.innerHTML = '';
                    previewContainerEdit.appendChild(img);
                }

                // Check if the selected file is a PDF
                else if (file.type === 'application/pdf') {
                    const pdf = document.createElement('embed');
                    pdf.src = URL.createObjectURL(file);
                    pdf.style.width = '245px'; // Set the width of the PDF
                    pdf.style.height = '150px'; // Set the height of the PDF
                    previewContainerEdit.innerHTML = '';
                    previewContainerEdit.appendChild(pdf);
                }
                // For other file types, display a message
                else {
                    previewContainerEdit.innerHTML = 'File must be image or pdf';
                    event.target.value = ''; // Reset the file input element
                    return false; // Prevent form submission
                }
            });

        });
    </script>
@endsection
