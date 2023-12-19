@extends('back-end.premium.layout.premium-main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <section>


        <div class="container-fluid mb-3">

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
                <div class="card-header with-border" style="background:#458191; color:white;">
                    <h1 class="card-title text-center"> {{ __('Job Post List') }} </h1>
                </div>
            </div>



        </div>



        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header" style="background-color:#61c597;">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Job Post') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-job-posts') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label>Position</label>
                                    <input type="text" name="jb_post_title" id="jb_post_title" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="jb_post_com_name" id="jb_post_com_name" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>No of Vacancy</label>
                                    <input type="text" name="jb_post_vacancy" id="jb_post_vacancy" class="form-control"
                                        required>
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

                                <div class="col-md-4 form-group">
                                    <label>Work Place</label>
                                    <input type="text" name="jb_post_wrk_plc" id="jb_post_wrk_plc" class="form-control"
                                        required>
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

                                <div class="col-md-10 form-group">
                                    <label>Minimum Experience</label>
                                    <input type="text" name="jb_post_min_exp" id="jb_post_min_exp" class="form-control"
                                        required>
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
                                <div class="col-md-4 form-group">
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


                                <div class="col-md-6 form-group">
                                    <label>Salary</label>
                                    <input type="text" name="jb_post_salary" id="jb_post_salary" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Date of Closing</label>
                                    <input type="date" name="jb_post_closing_dt" id="jb_post_closing_dt"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Publication Status</label>
                                    <select name="jb_post_status" id="jb_post_status" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Select'>
                                        <option value="Unpublished">Unpublished</option>
                                        <option value="Published">Published</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <input type="submit" name="action_button" class="btn btn-primary btn-block"
                                        value="{{ __('Add') }}" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
