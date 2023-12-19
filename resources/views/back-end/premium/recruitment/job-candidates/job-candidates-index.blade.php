@extends('back-end.premium.layout.premium-main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

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
                    <h1 class="card-title text-center"> {{ __('Job Candidates List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#">List - {{ 'Job Candidates List' }} </a></li>
                    </ol>
                </div>
           </div>

        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{ __('Candidate Name') }}</th>
                            <th>{{ __('Candidate Email') }}</th>
                            <th>{{ __('Candidate Phone') }}</th>
                            <th>{{ __('Candidate Address') }}</th>
                            <th>{{ __('Apply Date') }}</th>
                            <th>{{ __('Facebook Link') }}</th>
                            <th>{{ __('LinkedIn Link') }}</th>
                            <th>{{ __('Cover Letter') }}</th>
                            <th>{{ __('CV') }}</th>
                            <th>{{ __('Agreement Status') }}</th>
                            <th>{{ __('Interview Selection') }}</th>
                            <th>{{ __('Interview Place') }}</th>
                            <th>{{ __('Interview Date') }}</th>
                            <th>{{ __('Interview Time') }}</th>
                            <th>{{ __('Interview Selected By') }}</th>
                            <th>{{ __('Action') }}</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php($i = 1)
                        @foreach ($job_candidates as $job_candidates_value)
                            @if ($job_candidates_value->job_cnd_selection === '' || $job_candidates_value->job_cnd_selection === null)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $job_candidates_value->jobpostdetailsforcandidate->jb_post_title ?? null }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_full_name }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_email }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_phone }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_address }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_apply_dt }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_fb }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_lnkdin }}</td>
                                    <td>{!! $job_candidates_value->job_cnd_cover_ltr !!}</td>
                                    <td><a href="{{ asset($job_candidates_value->job_cnd_cv_upload) }}"
                                            download>Download</a></td>
                                    <td>
                                        @if ($job_candidates_value->job_cnd_agrmnt === 1)
                                            {{ 'Agreed' }}
                                        @else
                                            {{ 'Not Agreed' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($job_candidates_value->job_cnd_selection === 'Yes')
                                            {{ 'Yes' }}
                                        @else
                                            {{ 'No' }}
                                        @endif
                                    </td>
                                    <td>{{ $job_candidates_value->job_cnd_intw_plc }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_intw_dt }}</td>
                                    <td>{{ $job_candidates_value->job_cnd_intw_tym }}</td>
                                    <td>{{ $job_candidates_value->userdetailsforcandidate->first_name ?? null }}
                                        {{ $job_candidates_value->userdetailsforcandidate->last_name ?? null }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <a href="javascript:void(0)" class="btn edit"
                                                    data-id="{{ $job_candidates_value->id }}">Select For The Interview</a>

                                                <form method="post" action="{{ route('select-candidates') }}"
                                                    class="form-horizontal" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="id"
                                                        value="{{ $job_candidates_value->id }}" class="form-control"
                                                        required>
                                                    <button type="submit" class="btn ">Move to the CV storage</button>
                                                </form>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @endif
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
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('select-candidates') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Interview Place</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="job_cnd_intw_plc" id="job_cnd_intw_plc" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Interview Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="job_cnd_intw_dt" id="job_cnd_intw_dt" class="form-control"
                                        required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Interview Time</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="job_cnd_intw_tym" id="job_cnd_intw_tym" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label>Company Contact Number</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-volume-control-phone"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="job_cnd_intw_phn" id="job_cnd_intw_phn"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad ">Save changes</button>
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
                    url: 'job-candidate-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        //$('#training_type').val(res.training_type);
                    }
                });
            });

            //value retriving and opening the edit modal ends


            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
                startDate: date
            });






        });
    </script>
@endsection
