@extends('back-end.premium.layout.employee-setting-main')

@section('content')
    <section class="main-contant-section">

        @php
            use App\Models\User;
        @endphp
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
                    <h1 class="card-title text-center"> {{ __('NOC List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if (User::where('id', Session::get('employee_setup_id'))->where('noc_eligiblity_status',0)->first())
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - NOC </a></li>
                    </ol>
                </div>
            </div>


            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add NOC') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('noc-approval-request') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label> Place Of Issue <span class="text-danger">*</span></label>
                                        <input type="text" name="place_of_issue" class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label> Date Of Issue <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_issue" class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label> Date Of Expiry <span class="text-danger">*</span> </label>
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
                                    <div class="col-md-12">
                                        <label> Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" rows="10" cols="50" required></textarea>
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

            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Place Of Issue') }}</th>
                                <th>{{ __('Date of Issue') }}</th>
                                <th>{{ __('Date of Expiry') }}</th>
                                <th>{{ __('Purpose Of NOC') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Document') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($noc_lists as $noc_list)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $noc_list->place_of_issue }}</td>
                                    <td>{{ $noc_list->date_of_issue }}</td>
                                    <td>{{ $noc_list->date_of_expiry }}</td>
                                    <td>{{ $noc_list->purpose_of_noc }}</td>
                                    <td>{{ $noc_list->description }}</td>
                                    <td>
                                        @if ($noc_list->noc_document)
                                            @php($extension = pathinfo($noc_list->noc_document, PATHINFO_EXTENSION))
                                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <a href="{{ $noc_list->noc_document }}"
                                                    download="{{ basename($noc_list->noc_document) }}">
                                                    <img src="{{ $noc_list->noc_document }}" width="100px"
                                                        height="100px" />
                                                </a>
                                                <br />
                                                <a href="{{ $noc_list->noc_document }}"
                                                    download="{{ basename($noc_list->noc_document) }}"
                                                    class="btn btn-primary">
                                                    {{ __('Download') }}
                                                </a>
                                            @elseif (strtolower($extension) == 'pdf')
                                                <a href="{{ $noc_list->noc_document }}" target="_blank">
                                                    <embed src="{{ $noc_list->noc_document }}" type="application/pdf"
                                                        width="100px" height="100px" />
                                                </a>
                                                <br />
                                                <a href="{{ $noc_list->noc_document }}"
                                                    download="{{ basename($noc_list->noc_document) }}"
                                                    class="btn btn-primary">
                                                    {{ __('Download') }}
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($noc_list->status == 0)
                                            <label for="" class="btn btn-danger">{{ __('Pending') }}</label>
                                        @elseif($noc_list->status == 1)
                                            <label for="" class="btn btn-info">{{ __('Approved') }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($noc_list->status == 0)
                                            @if ($noc_list->noc_eligiblity_status == 0)
                                                <a href="javascript:void(0)" class="btn  edit"
                                                    data-id="{{ $noc_list->id }}" data-toggle="tooltip" title=""
                                                    data-original-title=" Edit "> <i class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i> </a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('delete-noc-request', ['id' => $noc_list->id]) }}"
                                                    class="btn btn-danger delete delete-post" data-toggle="tooltip"
                                                    title="" data-original-title=" Delete "> <i
                                                        class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        @elseif($noc_list->status == 1)
                                            <a href="javascript:void(0)" class="btn view" data-id="{{ $noc_list->id }}"
                                                data-toggle="tooltip" title=" View" data-original-title="View"> <i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('pdf-noc-request', ['id' => $noc_list->id]) }}"
                                                class="btn btn-info" data-toggle="tooltip" title=""
                                                data-original-title=" PDF"><i class="fa fa-file-pdf-o"
                                                    aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>





    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-approval-request') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" required>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label> Place Of Issue <span class="text-danger">*</span></label>
                                <input type="text" id="edit_place_of_issue" name="place_of_issue"
                                    class="form-control">
                            </div>

                            <div class="col-md-4 form-group">
                                <label> Date Of Issue <span class="text-danger">*</span></label>
                                <input type="date" id="edit_date_of_issue" name="date_of_issue" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label> Date Of Expiry <span class="text-danger">*</span> </label>
                                <input type="date" id="edit_date_of_expiry" name="date_of_expiry"
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
                            <div class="col-md-12">
                                <label> Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="edit_description" name="description" rows="10" cols="50" required></textarea>
                            </div>

                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Save Chnage </button>
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
                    url: 'noc-approval-request-edit',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
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

            //value retriving and opening the edit modal ends

            //value retriving and opening the edit modal starts

            $('.view').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'show-noc-request',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        $('#pdf-link').attr('href', "{{ route('pdf-noc-request', ':id') }}"
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

            //value retriving and opening the edit modal ends



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
