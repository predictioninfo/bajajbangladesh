@extends('back-end.premium.layout.premium-main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

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
                    <h1 class="card-title text-center"> {{ __('  Job Post List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        <li><a href="#">List - {{ 'Job Post List' }} </a></li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Job Post') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-job-posts') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Position</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-get-pocket"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_title" id="jb_post_title" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Company Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_com_name" id="jb_post_com_name"
                                            class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>No of Vacancy</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_vacancy" id="jb_post_vacancy"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Job Status Type</label>
                                    <select name="jb_post_type_id" id="jb_post_type_id" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Select'>
                                        @foreach ($job_status_types as $job_status_types_value)
                                            <option value="{{ $job_status_types_value->id }}">
                                                {{ $job_status_types_value->variable_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Job Category</label>
                                    <select name="jb_post_category" id="jb_post_category" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Select' required>
                                        @foreach ($job_category_name_methods as $job_category_name)
                                            <option value="{{ $job_category_name->variable_method_name }}">
                                                {{ $job_category_name->variable_method_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Work Place</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_wrk_plc" id="jb_post_wrk_plc"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Context</label>
                                    <textarea name="jb_post_context" id="jb_post_context" rows="4" cols="100" placeholder="context"></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Responsibilities</label>
                                    <textarea name="jb_post_res" id="jb_post_res" rows="4" cols="100" placeholder="Responsibilities"></textarea>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label>Educational Requirements</label>
                                    <textarea name="jb_post_edu_req" id="jb_post_edu_req" rows="4" cols="100"
                                        placeholder="Educational Requirements"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Minimum Experience</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_min_exp" id="jb_post_min_exp"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Experience Requirements</label>
                                    <textarea name="jb_post_ex_req" id="jb_post_ex_req" rows="4" cols="100"
                                        placeholder="Experience Requirements"></textarea>

                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Additional Requirements</label>
                                    <textarea name="jb_post_addi_req" id="jb_post_addi_req" rows="4" cols="100"
                                        placeholder="Experience Requirements"></textarea>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Compensation & Other Benefits</label>
                                    <textarea name="jb_post_compen" id="jb_post_compen" rows="4" cols="100"
                                        placeholder="Experience Requirements"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Job Location</label>
                                    <select name="jb_post_location" id="jb_post_location"
                                        class="form-control selectpicker" data-live-search="true"
                                        data-live-search-style="begins" title='Select'>
                                        @foreach ($job_location_name_methods as $job_location_name)
                                            <option value="{{ $job_location_name->variable_method_name }}">
                                                {{ $job_location_name->variable_method_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Salary</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_salary" id="jb_post_salary"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Date of Closing</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="jb_post_closing_dt" id="jb_post_closing_dt"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Publication Status</label>
                                    <select name="jb_post_status" id="jb_post_status" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Select'>
                                        <option value="Unpublished">Unpublished</option>
                                        <option value="Published">Published</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 mt-4">
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
                            <th>{{ __('Job Title') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Vacancy') }}</th>
                            <th>{{ __('Job Status Type') }}</th>
                            <th>{{ __('Job Category') }}</th>
                            <th>{{ __('Work Place') }}</th>
                            <th>{{ __('Context') }}</th>
                            <th>{{ __('Job Responsibilities') }}</th>
                            <th>{{ __('Educational Requirements') }}</th>
                            <th>{{ __('Experience Requirements') }}</th>
                            <th>{{ __('Additional Requirements') }}</th>
                            <th>{{ __('Compensation & Other Benefits') }}</th>
                            <th>{{ __('Job Location') }}</th>
                            <th>{{ __('Salary') }}</th>
                            <th>{{ __('Date of Closing') }}</th>
                            <th>{{ __('Submited By') }}</th>
                            <th>{{ __('Publication Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($job_posts as $job_posts_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $job_posts_value->jb_post_title }}</td>
                                <td>{{ $job_posts_value->jb_post_com_name }}</td>
                                <td>{{ $job_posts_value->jb_post_vacancy }}</td>
                                <td>{{ $job_posts_value->jobpostvariable->variable_type_name }}</td>
                                <td>{{ $job_posts_value->jb_post_category }}</td>
                                <td>{{ $job_posts_value->jb_post_wrk_plc }}</td>
                                <td>{{ strip_tags($job_posts_value->jb_post_context) }}</td>
                                <td>{{ strip_tags($job_posts_value->jb_post_res) }} </td>
                                <td>{{ strip_tags($job_posts_value->jb_post_edu_req) }} </td>
                                <td>{{ strip_tags($job_posts_value->jb_post_ex_req) }} </td>
                                <td>{{ strip_tags($job_posts_value->jb_post_addi_req) }} </td>
                                <td>{{ strip_tags($job_posts_value->jb_post_compen) }} </td>
                                <td>{{ $job_posts_value->jb_post_location }}</td>
                                <td>{{ $job_posts_value->jb_post_salary }}</td>
                                <td>{{ $job_posts_value->jb_post_closing_dt }}</td>
                                <td>{{ $job_posts_value->jobpostuserdetails->first_name }}
                                    {{ $job_posts_value->jobpostuserdetails->last_name }}</td>
                                <td>{{ $job_posts_value->jb_post_status }}</td>
                                <td>
                                    <a type="button" class="btn edit waves-effect " data-toggle="modal"
                                                data-target="#edit-{{ $job_posts_value->id }}" data-id="" data-toggle="tooltip" title=" Edit "
                                                data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="{{ route('delete-job-posts', ['id' => $job_posts_value->id]) }}"
                                                class="btn  btn-danger delete-post" data-toggle="tooltip" title=" Delete "
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
    @foreach ($job_posts as $job_posts_value)
        <div class="modal fade" id="edit-{{ $job_posts_value->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="{{ route('update-job-posts') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $job_posts_value->id }}">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Position</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-get-pocket"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_title" id="jb_post_title_edit"
                                            class="form-control" required value="{{ $job_posts_value->jb_post_title }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Company Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_com_name" id="jb_post_com_name_edit"
                                            class="form-control" required
                                            value="{{ $job_posts_value->jb_post_com_name }}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>No of Vacancy</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_vacancy" id="jb_post_vacancy_edit"
                                            class="form-control" required
                                            value="{{ $job_posts_value->jb_post_vacancy }}">
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Job Status Type</label>
                                    <select name="jb_post_type_id" id="jb_post_type_id_edit"
                                        class="form-control selectpicker" data-live-search="true"
                                        data-live-search-style="begins" title='Select' required>
                                        @foreach ($job_status_types as $job_status_types_value)
                                            <option value="{{ $job_status_types_value->id }}">
                                                {{ $job_status_types_value->variable_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Job Category</label>
                                    <select name="jb_post_category" id="jb_post_category"
                                        class="form-control selectpicker" data-live-search="true"
                                        data-live-search-style="begins" title='Select' required>
                                        @foreach ($job_category_name_methods as $job_category_name)
                                            <option value="{{ $job_category_name->variable_method_name }}">
                                                {{ $job_category_name->variable_method_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Work Place</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_wrk_plc" id="jb_post_wrk_plc_edit"
                                            class="form-control" required
                                            value="{{ $job_posts_value->jb_post_wrk_plc }}">
                                    </div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Context</label>
                                    <textarea name="jb_post_context" id="jb_post_context_edit" rows="4" cols="100"
                                        placeholder="Experience Requirements">{{ strip_tags($job_posts_value->jb_post_context) }}</textarea>
                                </div> -->


                                <div class="col-md-12 form-group">
                                    <label>Context</label>
                                    <div id="summernote"></div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Responsibilities</label>
                                    <textarea name="jb_post_res" id="jb_post_res_edit" rows="4" cols="100"
                                        placeholder="Experience Requirements">{{ strip_tags($job_posts_value->jb_post_res) }}</textarea>
                                </div> -->

                                <div class="col-md-12 form-group">
                                    <label>Responsibilities</label>
                                    <div id="summernote1"></div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Educational Requirements</label>
                                    <textarea name="jb_post_edu_req" id="jb_post_edu_req_edit" rows="4" cols="100"
                                        placeholder="Experience Requirements">{{ strip_tags($job_posts_value->jb_post_edu_req) }}</textarea>
                                </div> -->

                                <div class="col-md-12 form-group">
                                    <label> Educational Requirements </label>
                                    <div id="summernote2"></div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Minimum Experience</label>
                                    <input type="text" name="jb_post_min_exp" id="jb_post_min_exp"
                                        class="form-control" required
                                        value="{{ strip_tags($job_posts_value->jb_post_min_exp) }}">
                                </div> -->

                                <div class="col-md-12 form-group">
                                    <label> Minimum Experience </label>
                                    <div id="summernote3"></div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Experience Requirements</label>
                                    <textarea name="jb_post_ex_req" id="jb_post_ex_req_edit" rows="4" cols="100"
                                        placeholder="Experience Requirements">{{ strip_tags($job_posts_value->jb_post_ex_req) }}</textarea>
                                </div> -->

                                <div class="col-md-12 form-group">
                                    <label> Experience Requirements </label>
                                    <div id="summernote4"></div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Additional Requirements</label>
                                    <textarea name="jb_post_addi_req" id="jb_post_addi_req_edit" rows="4" cols="100"
                                        placeholder="Experience Requirements">{{ strip_tags($job_posts_value->jb_post_addi_req) }}</textarea>
                                </div> -->

                                <div class="col-md-12 form-group">
                                    <label> Additional Requirements </label>
                                    <div id="summernote5"></div>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Compensation & Other Benefits</label>
                                    <textarea name="jb_post_compen" id="jb_post_compen_edit" rows="4" cols="100"
                                        placeholder="Experience Requirements">{{ strip_tags($job_posts_value->jb_post_addi_req) }}</textarea>
                                </div> -->

                                <div class="col-md-12 form-group">
                                    <label> Compensation & Other Benefits </label>
                                    <div id="summernote6"></div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Job Location</label>
                                    <select name="jb_post_location" id="jb_post_location"
                                        class="form-control selectpicker" data-live-search="true"
                                        data-live-search-style="begins" title='Select'>
                                        @foreach ($job_location_name_methods as $job_location_name)
                                            <option value="{{ $job_location_name->variable_method_name }}">
                                                {{ $job_location_name->variable_method_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Salary</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="jb_post_salary" id="jb_post_salary_edit"
                                            class="form-control" required
                                            value="{{ strip_tags($job_posts_value->jb_post_salary) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <label>Date of Closing</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="jb_post_closing_dt" id="jb_post_closing_dt_edit"
                                            class="form-control" required
                                            value="{{ $job_posts_value->jb_post_closing_dt }}">
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Publication Status</label>
                                    <select name="jb_post_status" id="jb_post_status_edit"
                                        class="form-control selectpicker" data-live-search="true"
                                        data-live-search-style="begins" title='Select'>
                                        <option value="Unpublished" <?php if ($job_posts_value->jb_post_status == 'Unpublished') {
                                            echo 'selected="selected"';
                                        } ?>>Unpublished</option>
                                        <option value="Published" <?php if ($job_posts_value->jb_post_status == 'Published') {
                                            echo 'selected="selected"';
                                        } ?>>Published</option>
                                    </select>
                                </div>

                                <div class="col-sm-offset-2 col-sm-10 mt-4">
                                    <button type="submit" class="btn btn-grad">Save changes</button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

            //  value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'job-post-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#jb_post_title_edit').val(res.jb_post_title);
                        $('#jb_post_com_name_edit').val(res.jb_post_com_name);
                        $('#jb_post_vacancy_edit').val(res.jb_post_vacancy);
                        $('#jb_post_type_id_edit').val(res.jb_post_type_id);
                        $('#jb_post_wrk_plc_edit').val(res.jb_post_wrk_plc);
                        $('#jb_post_context_edit').val(res.jb_post_context);
                        $('#jb_post_status').val(res.jb_post_status);
                        $('#jb_post_desc').val(res.jb_post_desc);
                        $('#jb_post_compen_edit').val(res.jb_post_compen);
                        $('#jb_post_location_edit').val(res.jb_post_location);
                        $('#jb_post_salary_edit').val(res.jb_post_salary);
                        $('#jb_post_closing_dt_edit').val(res.jb_post_closing_dt);
                        $('#jb_post_status_edit').val(res.jb_post_status);
                    }
                });
            });

            //value retriving and opening the edit modal ends


            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
                startDate: date
            });

            CKEDITOR.replace('jb_post_context');
            CKEDITOR.replace('jb_post_res');
            CKEDITOR.replace('jb_post_edu_req');
            CKEDITOR.replace('jb_post_ex_req');
            CKEDITOR.replace('jb_post_addi_req');
            CKEDITOR.replace('jb_post_compen');





        });

        $('#summernote').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      $('#summernote1').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      $('#summernote2').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      $('#summernote3').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      $('#summernote4').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      $('#summernote5').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });

      $('#summernote6').summernote({
        placeholder: 'write',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
@endsection
