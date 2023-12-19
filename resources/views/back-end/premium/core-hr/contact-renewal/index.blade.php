@extends('back-end.premium.layout.premium-main')
@section('content')

<?php
    use App\Models\Permission;
    use App\Models\Attendance;
    use App\Models\Package;
    $employee_sub_module_one_add = '2.1.1';
    $employee_sub_module_one_edit = '2.1.2';
    $employee_sub_module_one_delete = '2.1.3';
    //use DateTime;
    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');

    ?>

<section class="main-contant-section">

    <div class=""><span id="general_result"></span></div>


    <div class=" mb-2">


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

        <div class="card mb-3">
            <div class="card-header with-border">
                <h1 class="card-title"> {{__('Employee List')}} </h1>
                <nav aria-label="breadcrumb">

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - Employee</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex flex-row">

            @if ($employee_sub_module_one_delete == 'Yes')
            <div class="p-1">
                <form method="post" action="{{ route('bulk-delete-employees') }}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                        class="form-check-input">
                    <input type="submit" class="btn btn-danger w-100" value="{{ __('Bulk Delete') }}" />
                </form>
            </div>
            <div class="p-1">
                <form method="post" action="{{ route('bulk-restore-employees') }}" id="sample_form"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{ Auth::user()->com_id }}"
                        class="form-check-input">

                    <input type="submit" class="btn btn-warning w-100" value="{{ __('Bulk Restore') }}" />

                </form>
            </div>
            @endif

        </div>

    </div>

    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Employee ID') }}</th>
                        <th>{{ __('Employee Name') }}</th>
                        <th>{{ __('Profile Photo') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Previous Expiry Date') }}</th>
                        <th>{{ __('Renewal Date') }}</th>
                        <th>{{ __('Salary Type') }}</th>
                        <th>{{ __('Employment Type') }}</th>
                        <th>{{ __('Download Letter') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @php($i = 1)
                    @foreach ($contact_renewal as $contact)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $contact->employeeContactRenewal->company_assigned_id ?? null}}</td>
                        <td>{{ $contact->employeeContactRenewal->first_name ?? null}} {{
                            $contact->employeeContactRenewal->last_name ?? null}}
                        </td>
                        <td><img class="rounded" width="60"
                                src="{{ asset($contact->employeeContactRenewal->profile_photo ?? null) }}">
                        </td>
                        <td>{{ $contact->employeeContactRenewal->email ?? null}}</td>
                        <td>{{ $contact->employeeContactRenewal->phone ?? null}}</td>
                        <td>{{ $contact->contact_renewal_letter_renewal_date ?? '' }}</td>
                        <td>{{ $contact->contact_renewal_letter_renewal_previous_date ?? '' }}</td>
                        <td>{{ $contact->employeeContactRenewal->salary_type ?? '' }}</td>
                        <td>{{ $contact->employeeContactRenewal->employment_type ?? '' }}</td>
                        <td>
                            <a href="{{ route('contact-renewal-letter-template-downloads', ['id' => $contact->id]) }}"
                                class="btn btn-info"> Download
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var i = 1;
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