@extends('back-end.premium.layout.premium-main')
@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    #draggable1 {
        width: 150px;
        height: 50px;
        padding: 0.5em;
    }

    #draggable2 {
        width: 150px;
        height: 30px;
        padding: 0.5em;
    }

    #draggable3 {
        width: 150px;
        height: 30px;
        padding: 0.5em;
    }

    #draggable4 {
        width: 150px;
        height: 50px;
        padding: 0.5em;
    }

    #draggable5 {
        width: 150px;
        height: 50px;
        padding: 0.5em;
    }

    #draggable6 {
        width: 150px;
        height: 60px;
        padding: 0.5em;
    }

    #draggable7 {
        width: 150px;
        height: 60px;
        padding: 0.5em;
    }

    #draggable8 {
        width: 150px;
        height: 60px;
        padding: 0.5em;
    }
</style>

<script>

</script>

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

        <div class="row">
            <form method="POST" action="{{ route('edit-appointments',['id'=>$appointments->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-2 content-box">

                            <div class="card-header mb-10">

                                <h1 class="card-title"> {{ __('Appointment Letter Format') }} </h1>
                                <nav aria-label="breadcrumb">

                                    <ol id="breadcrumb1">
                                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a>
                                        </li>
                                        <li><a href="{{ route('appointment-templates') }}"><span class="icon icon-list">
                                                </span> Appointment Letter Format List</a></li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Header </label>
                                        <div class="input-group">
                                            <select class="form-control" name="appoinment_header" id="employment_type">
                                                <option value="">{{ __('Select A Header...') }}</option>
                                                @foreach($headers as $headers)
                                                <option value="{{ $headers->id }}" {{ $headers->
                                                    id ==
                                                    $appointments->appointment_template_header ?
                                                    'selected'
                                                    : ''}}>{!!
                                                    $headers->header_description !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">
                                            Subject <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="First Name"
                                                name="subject" required
                                                value="{{ $appointments->appointment_template_subject }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                        <label for="email">
                                            <span style="color:black;font-weight:bold;">General terms </span><span
                                                class="text-danger">*</span> </label>
                                        <div class="">
                                            <textarea name="general_terms" id="description" cols="30" rows="5"
                                            placeholder="Writing Somthing....">  {!!html_entity_decode( $appointments->appointment_template_general_terms)!!}</textarea>
                                        </div>
                                        <span id="email_error"></span>

                                </div>
                                <div class="col-md-12">
                                    <span style="font-weight:bold;"> Remuneration and benefits: <br></span><br><br>
                                    <table style="width:70%; padding-right:50%;">
                                        <tbody>
                                            <tr>
                                                <th width="60px; float:right;text-align: left;">Basic Salary</th>
                                                <th width="5px">:</th>
                                                <th width="60px; text-align: right;"> BDT</th>
                                            </tr>
                                            <tr>
                                                <th width="60px;float:right;text-align: left;">Medical allowance
                                                </th>
                                                <th width="5px">:</th>
                                                <th width="60px;text-align: right;"> BDT
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="60px;text-align: left;">House Rent</th>
                                                <th width="5px">:</th>
                                                <th width="60px;text-align: right;"> BDT
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="60px;text-align: left;">Mobile Allowance</th>
                                                <th width="5px">:</th>
                                                <th width="100px;text-align: right;">
                                                    BDT</th>
                                            </tr>
                                            <tr>
                                                <th width="60px;text-align: left;">Convence Allowance</th>
                                                <th width="5px">:</th>
                                                <th width="60px;text-align: right;"> BDT
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="60px;text-align: left;">Festival Bounus</th>
                                                <th width="5px">:</th>
                                                <th width="60px;text-align: right;">
                                                    BDT
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <br>
                                    <table style="width:70%">
                                        <tbody>
                                            <tr>
                                                <th width="32%;text-align: left;">Total</th>
                                                <th width="6%;">:</th>
                                                <th width="40%;text-align: right;"> BDT
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br><br>
                                </div>
                                <br><br><br><br>
                                <div class="col-md-12">
                                        <label for="email">
                                            Description <span class="text-danger">*</span> </label>
                                        <div class="">
                                            <textarea name="description" id="description1" cols="30"
                                                rows="10">{!!html_entity_decode( $appointments->appointment_template_description)!!}</textarea>
                                        </div>
                                        <span id="email_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="website">
                                        Signature <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" id="profile_photo"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            name="signature_img"
                                            placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Signatory <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="employee_id" id="employment_type" required>
                                                <option value="">{{ __('Select A Signatory ') }}</option>
                                                @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ $employee->id ==
                                                    $appointments->appointment_template_signature_employee_id ?
                                                    'selected'
                                                    : ''}}>{{
                                                    $employee->first_name.' '. $employee->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Footer </label>
                                        <div class="input-group">
                                            <select name="appoinment_footer" id="employment_type">
                                                <option value="">{{ __('Select A Footer...') }}</option>
                                                @foreach($footers as $footer)
                                                <option value="{{ $footer->footer_description  ?? null}}" {{ $footer->
                                                    footer_description ==
                                                    $appointments->appointment_template_footer ?
                                                    'selected'
                                                    : ''}}>{{
                                                    $footer->footer_description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class=" text-left mt-4">

                                <button type="submit" id="abcd" class="btn btn-grad ladda-button"
                                    data-style="expand-right">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    <span class="ladda-label">
                                        Save </span><span class="ladda-spinner"></span></button>
                                <button type="submit" id="abcd" class="btn btn-grad " data-style="expand-right"><a
                                        href="{{ route('appointment-shows',['id'=>$appointments->id]) }}">Preview</a></button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</section>

@endsection
