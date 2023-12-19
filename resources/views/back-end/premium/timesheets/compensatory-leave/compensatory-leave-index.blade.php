@extends('back-end.premium.layout.premium-main')
@section('content')

    <?php
    use App\Models\User;
    use App\Models\Role;
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
                    <h1 class="card-title text-center"> {{ __('Compensatory Leave list') }} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="#">List - Compensatory</a></li>
                        </ol>

                    </nav>
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
                                <th>{{ __('Region') }}</th>
                                <th>{{ __('Area') }}</th>
                                <th>{{ __('Territory') }}</th>
                                <th>{{ __('Town') }}</th>
                                <th>{{ __('DB House') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Duty Date') }}</th>
                                <th>{{ __('Compensatory Leave Date') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php($i = 1)
                            @foreach ($compensatory_leaves as $compensatory_leaves_value)
                                @if (Auth::user()->id == $compensatory_leaves_value->compen_leave_employee_id ||
                                        Auth::user()->company_profile == 'Yes' ||
                                        Auth::user()->user_admin_status == 'Yes')
                                    <?php

                                    $employee_details = User::with('userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'userdepartment', 'userdesignation')
                                        ->where('id', $compensatory_leaves_value->compen_leave_employee_id)
                                        ->get();

                                    ?>
                                    @foreach ($employee_details as $employee_details_value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $compensatory_leaves_value->usercompensatoryleave->first_name ?? null }}
                                                {{ $compensatory_leaves_value->usercompensatoryleave->last_name ?? null }}
                                            </td>
                                            <td>{{ $employee_details_value->company_assigned_id }}</td>
                                            <td>{{ $employee_details_value->userregion->region_name ?? null }}</td>
                                            <td>{{ $employee_details_value->userarea->area_name ?? null }}</td>
                                            <td>{{ $employee_details_value->userterritory->territory_name ?? null }}</td>
                                            <td>{{ $employee_details_value->usertown->town_name ?? null }}</td>
                                            <td>{{ $employee_details_value->userdbhouse->db_house_name ?? null }}</td>
                                            <td>{{ $employee_details_value->userdepartment->department_name ?? null }}</td>
                                            <td>{{ $employee_details_value->userdesignation->designation_name ?? null }}
                                            </td>
                                            <td>{{ $compensatory_leaves_value->compen_leave_duty_date }}</td>
                                            <td>{{ $compensatory_leaves_value->compen_leave_date }}</td>
                                            <td>{{ $compensatory_leaves_value->compen_leave_dsec }}</td>
                                            @if ($compensatory_leaves_value->compen_leave_status == 0)
                                                <td>{{ __('Pending') }} </td>
                                            @else
                                                <td>{{ __('Approved') }} </td>
                                            @endif
                                            {{--
                            {{Auth::user()->id}}
                            {{$compensatory_leaves_value->compen_leave_employee_id}}
                            --}}
                                            {{-- @if (Auth::user()->id == $compensatory_leaves_value->compen_leave_employee_id)
                                                @if ($compensatory_leaves_value->compen_leave_status == 0)
                                                    @if ($compensatory_leaves_value->compen_leave_date)
                                                    @else --}}
                                                        <td><a href="#" class="btn btn-primary" data-toggle="modal"
                                                                data-target="#edit-modal{{ $compensatory_leaves_value->id }}">CL
                                                                Request Send</a></td>
                                                    {{-- @endif --}}


                                                    <!-- edit boostrap model -->
                                                    <div class="modal fade"
                                                        id="edit-modal{{ $compensatory_leaves_value->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="ajaxModelTitle">Compensatory
                                                                        Leave For The Date
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                        action="{{ route('set-compensatory-leaves') }}">
                                                                        @csrf

                                                                        <input type="hidden" name="id"
                                                                            value="{{ $compensatory_leaves_value->id }}">
                                                                        <input type="hidden"
                                                                            name="compen_leave_employee_id"
                                                                            value="{{ $compensatory_leaves_value->compen_leave_employee_id }}">

                                                                        <div class="row">

                                                                            <div class="col-md-12">
                                                                                <div class="input-group mb-3">
                                                                                    <label>Compensatory Leave Date</label>
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i
                                                                                                class="fa fa-calendar-o"
                                                                                                aria-hidden="true"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="date"
                                                                                        name="compen_leave_date"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 form-group">
                                                                                <label>Description</label>
                                                                                <textarea name="compen_leave_dsec" id="" cols="8" rows="3" class="form-control" required></textarea>
                                                                            </div>
                                                                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                                                                <button type="submit"
                                                                                    class="btn btn-grad">Save
                                                                                    changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end bootstrap model -->
                                                {{-- @else
                                                    <td>---</td>
                                                @endif
                                            @else
                                                <td>---</td>
                                            @endif --}}
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach



                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function($) {
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


            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'edit-other-holiday-getting',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit Holiday");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#holiday_name').val(res.holiday_name);
                        $('#start_date').val(res.start_date);
                        $('#end_date').val(res.end_date);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                // let id_id = this.formData('id');
                //     console.log(id_id);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `edit-company-other-holiday`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                            this.reset();
                            alert('Data has been updated successfully');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends





        });
    </script>

@endsection
