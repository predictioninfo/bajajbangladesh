@extends('back-end.premium.layout.employee-setting-main')
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

          

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Loan List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if($add_permission == "Yes" || (Auth::user()->company_profile == 'Yes'))

                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Loan </a></li>
                    </ol>
                </div>
            </div>

        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Loan') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-employee-loans') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- <input type="hidden" name="commission_employee_id"
                            value="{{Session::get('employee_setup_id')}}"> --}}
                            <div class="row">

                                <div class="col-md-12 form-group">
                                    <label>Month-Year</label>
                                    <input type="month" name="loans_month_year" class="form-control" value="" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="loans_start_date" class="form-control" value="" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Loan Type</label>
                                    <select class="form-control" name="loans_type" required>
                                        <option value="">Select-A-Loan-Type</option>
                                        <option value="Home-Development">Home Development Mutual Fund Loan </option>
                                        <option value="Social-Security">Social Security System Loan</option>
                                        <option value="Other-Loan">Other Loan</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Title</label>
                                    <input type="text" name="loans_title" class="form-control" value="" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Loan Amount</label>
                                    <input type="text" name="loans_amount" class="form-control" value="" required>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Reason</label>
                                    <textarea name="loans_reason" class="form-control" cols="20" rows="8" required></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>No of Installments</label>
                                    <input type="text" name="loans_no_of_installments" class="form-control" required>
                                </div>
                                {{-- <div class="col-md-12 form-group">
                                <label>Amount Remaining</label>
                                <input type="text" name="loans_amount_remaining" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Remining Installments</label>
                                <input type="text" name="loans_remaining_installments" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Monthly Payable</label>
                                <input type="text" name="loans_monthly_payable" class="form-control">
                            </div> --}}
                                <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                                    <!-- <input type="submit" name="action_button" class="btn btn-primary btn-block"
                                        value="{{ __('Add') }}" /> -->

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
                        <th>{{ __('Month Year') }}</th>
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Reason') }}</th>
                        <th>{{ __('Loan Amount') }}</th>
                        <th>{{ __('No of Installments') }}</th>
                        <th>{{ __('Remaining Amount') }}</th>
                        <th>{{ __('Remaining Installments') }}</th>
                        <th>{{ __('Monthly Payable') }}</th>
                        @if ($add_permission == 'Yes' ||
                            $edit_permission == 'Yes' ||
                            $delete_permission == 'Yes' ||
                            Auth::user()->company_profile == 'Yes')
                            <th>{{ __('Action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($loans as $loans_value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $loans_value->loans_month_year }}</td>
                            <td>{{ $loans_value->loans_start_date }}</td>
                            <td>{{ $loans_value->loans_title }}</td>
                            <td>{{ $loans_value->loans_type }}</td>
                            <td>{{ $loans_value->loans_reason }}</td>
                            <td>{{ $loans_value->loans_amount }}</td>
                            <td>{{ $loans_value->loans_no_of_installments }}</td>
                            <td>{{ $loans_value->loans_remaining_amount }}</td>
                            <td>{{ $loans_value->loans_remaining_installments }}</td>
                            <td>{{ $loans_value->loans_monthly_payable }}</td>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary edit"
                                        data-id="{{ $loans_value->id }}">Edit</a>
                                    <a href="{{ route('delete-employee-loans', ['id' => $loans_value->id]) }}"
                                        class="btn btn-danger delete-post">Delete</a>
                                </td>
                            @endif
                        </tr>
                        @php($i = 1)
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
                <div class="modal-header" style="background-color:#df0b1d;">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                        class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Month-Year</label>
                                <input type="month" name="loans_month_year" id="loans_month_year" class="form-control"
                                    value="" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Start Date</label>
                                <input type="date" name="loans_start_date" id="loans_start_date" class="form-control"
                                    value="">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Loan Type</label>
                                <select class="form-control" name="loans_type" id="loans_type" required>
                                    <option value="">Select-A-Loan-Type</option>
                                    <option value="Home-Development">Home Development Mutual Fund Loan </option>
                                    <option value="Social-Security">Social Security System Loan</option>
                                    <option value="Other-Loan">Other Loan</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Title</label>
                                <input type="text" name="loans_title" id="loans_title" class="form-control"
                                    value="" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Loan Amount</label>
                                <input type="text" name="loans_amount" id="loans_amount" class="form-control"
                                    value="" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Reason</label>
                                <textarea name="loans_reason" id="loans_reason" class="form-control" cols="20" rows="8" required></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>No of Installments</label>
                                <input type="text" name="loans_no_of_installments" id="loans_no_of_installments"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Remaining Amount</label>
                                <input type="text" name="loans_remaining_amount" id="loans_remaining_amount"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Remaining Installments</label>
                                <input type="text" name="loans_remaining_installments"
                                    id="loans_remaining_installments" class="form-control" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Monthly Payable</label>
                                <input type="text" name="loans_monthly_payable" id="loans_monthly_payable"
                                    class="form-control" required>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                    url: 'employee-loan-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#loans_month_year').val(res.loans_month_year);
                        $('#loans_start_date').val(res.loans_start_date);
                        $('#loans_type').val(res.loans_type);
                        $('#loans_title').val(res.loans_title);
                        $('#loans_amount').val(res.loans_amount);
                        $('#loans_no_of_installments').val(res.loans_no_of_installments);
                        $('#loans_remaining_amount').val(res.loans_remaining_amount);
                        $('#loans_remaining_installments').val(res
                        .loans_remaining_installments);
                        $('#loans_monthly_payable').val(res.loans_monthly_payable);
                        $('#loans_reason').val(res.loans_reason);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-employee-loan`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        toastr.success(response.success, 'Data successfully updated!!');
                        setTimeout(function() {
                            window.location.href = '/employee-loan';
                        }, 2000)
                    },
                    error: function(response) {
                        toastr.error(response.error, 'Please Entry Valid Data!!');

                        // console.log(response);
                        //     $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends








        });
    </script>
@endsection
