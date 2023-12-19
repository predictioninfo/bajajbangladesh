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
                    <h1 class="card-title text-center"> {{ __('Probation Review List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#nocEmployeeListModal"><span
                                    class="icon icon-plus"> </span>Probation Review List</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div id="form-container" style="display: none; padding-left: 40px">
            <form action="{{ route('noc-employees') }}" method="GET" enctype="multipart/form-data">
                <div class="row align-items-end">
                    <div class="col-md-2">
                        <label class="text-bold">{{ __('Employee') }} <span class="text-danger">*</span></label>

                    </div>
                    <div class="col-md-2">
                        <label data-error="wrong" data-success="right" for="start_date_of_issue">Start Date of Issue
                        </label>
                        <input class="form-control" type="date" name="start_date_of_issue" value="" id="">
                    </div>
                    <div class="col-md-2">
                        <label data-error="wrong" data-success="right" for="end_date_of_issue">End Date of Issue
                        </label>
                        <input class="form-control" type="date" name="end_date_of_issue" id="" value="">
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
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Designation') }}</th>
                            <th>{{ __('Joining Date') }}</th>
                            <th>{{ __('Probation Month') }}</th>
                            <th>{{ __('Probation Expairy Date') }}</th>
                            <th>{{ __('Old Salary') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($probation_employees as $probation_employee)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $probation_employee->first_name }}
                                    {{ $probation_employee->last_name }}</td>
                                <td>{{ $probation_employee->userdepartment->department_name }}</td>
                                <td>{{ $probation_employee->userdesignation->designation_name }}</td>
                                <td>{{ $probation_employee->joining_date }}</td>
                                <td>{{ $probation_employee->in_probation_month }}</td>
                                <td>{{ $probation_employee->probation_expiry_date }}</td>
                                <td>{{ $probation_employee->gross_salary }}</td>
                                <td>
                                    @if (Carbon\Carbon::now()->between(date('Y-m-d', strtotime('-30 days', strtotime($probation_employee->probation_expiry_date))), date('Y-m-d', strtotime('+150 days', strtotime($probation_employee->probation_expiry_date)))))
                                        <a onclick="return confirm('Want to refer this employee to a supervisor for recommendation ?')"
                                            href="{{ route('probation-employee-recommendation', $probation_employee->id) }}" class="btn btn-info "
                                            data-toggle="tooltip" title="Supervisor Recommendation"
                                            data-original-title="Supervisor Recommendation">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </a>
                                        @else
                                        <a onclick="return alert('Recommendation not Eligible for this employee!!!')"
                                        href="#" class="btn btn-danger "
                                        data-toggle="tooltip" title="Recommendation not Eligible"
                                        data-original-title="Recommendation not Eligible">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            ;

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
