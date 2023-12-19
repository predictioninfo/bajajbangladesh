@extends('back-end.premium.layout.premium-main')
@section('content')
<style>
    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>
<section class="main-contant-section">

    <div class="employee-basic-information">
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
        <form method="POST"
            action="{{ route('contact-renewal-letter-template-updates',['id' => $renewal_letters->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="card mb-2 content-box">

                    <div class="card-header mb-10">

                        <h1 class="card-title"> {{ __('Contact Renewal Letter Format') }} </h1>
                        <nav aria-label="breadcrumb">

                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a>
                                </li>
                                <li><a href="{{ route('contact-renewal-letter-templates') }}"><span
                                            class="icon icon-list">
                                        </span> Contact Renewal Letter Format List</a></li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">
                                    <span style="color:black;font-weight:bold;">Template Name </span>
                                    <span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Template Name"
                                        name="template_name" required
                                        value="{!! strip_tags($renewal_letters->contact_renewal_letter_template_name) !!}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">
                                    <span style="color:black;font-weight:bold;">Subject </span>
                                    <span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Letter Subject" name="subject"
                                        required
                                        value="{!! strip_tags($renewal_letters->contact_renewal_letter_template_subject) !!}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">
                                    <span style="color:black;font-weight:bold;">Description </span><span
                                        class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <textarea name="letter_format_body" id="" cols="30" rows="5"
                                        placeholder="Writing Somthing....">{!! strip_tags($renewal_letters->contact_renewal_letter_template_description)  !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="website">
                                Signature <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" id="profile_photo"
                                    class="form-control @error('photo') is-invalid @enderror" name="signature_img"
                                    placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="website">
                                    Sginatory <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select name="employee_id" id="employment_type" required class="form-control">
                                        <option value="">{{ __('Select A Signatory ') }}</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id ==
                                            $renewal_letters->contact_renewal_letter_template_emp_id ?
                                            'selected'
                                            : ''}}>
                                            {{ $employee->first_name . ' ' . $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-4 form-group check-box">
                                    <input type="checkbox" name="header" value="1" class="form-check-input" checked>
                                    <label class=" col-form-label" for="exampleCheck1">Header</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="website">
                                    Footer </label>
                                <div class="input-group">
                                    <select name="letter_format_footer" required class="form-control">
                                        <option value="">{{ __('Select A Footer...') }}</option>
                                        @foreach ($footers as $footer)
                                        <option value="{{ $footer->footer_description }}" {{ $footer->footer_description
                                            ==
                                            $renewal_letters->contact_renewal_letter_template_footer ?
                                            'selected'
                                            : ''}}>
                                            {{ $footer->footer_description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">
                                    <span style="color:black;font-weight:bold;">Extra features
                                    </span></label>
                                <div class="input-group">
                                    <textarea name="probition_letter_format_extra" id="" cols="30" rows="5"
                                        placeholder="Writing Somthing...."></textarea>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class=" text-left mt-4">

                        <button type="submit" id="abcd" class="btn btn-grad ladda-button" data-style="expand-right">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            <span class="ladda-label">
                                Save </span><span class="ladda-spinner"></span></button>
                    </div>
                </div>
            </div>


        </form>


    </div>

</section>
@endsection