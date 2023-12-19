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

    <div class="employee-basic-information Appointment">
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
        <form method="POST" action="{{ route('appointment-adds') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="card mb-2 content-box">
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">
                                    Header </label>
                                <div class="input-group">
                                    <select class="form-control" name="appoinment_header" id="employment_type">
                                        <option value="">{{ __('Select A Header...') }}</option>
                                        @foreach($headers as $headers)
                                        <option value="{{ $headers->id }}">{!!
                                            $headers->header_description !!}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">
                                    <span style="color:black;font-weight:bold;">Subject </span>
                                    <span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Appoinment Letter Subject"
                                        name="subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                                <label for="email">
                                    <span style="color:black;font-weight:bold;">General terms </span><span
                                        class="text-danger">*</span> </label>
                                <div class="">
                                    <textarea name="general_terms" id="description" cols="30" rows="5"
                                        placeholder="Writing Somthing...."></textarea>
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
                        </div>
                        <div class="col-md-12">
                                <label for="email">
                                    <span style="color:black;font-weight:bold;">Description</span>
                                    <span class="text-danger">*</span> </label> <br>
                                <div class="">
                                    <textarea name="description" id="description1" cols="30" rows="5"
                                        placeholder="Writing Somthing...."></textarea>
                                <span id="email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin: 15px 0;">
                                <label for="website">
                                    Signature <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" id="profile_photo"
                                        class="form-control @error('photo') is-invalid @enderror" name="signature_img"
                                        placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">
                                    Sginatory <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-control" name="employee_id" id="employment_type">
                                        <option value="">{{ __('Select A Signatory ') }}</option>
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{
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
                                    <select class="form-control" name="appoinment_footer" id="employment_type">
                                        <option value="">{{ __('Select A Footer...') }}</option>
                                        @foreach($footers as $footer)
                                        <option value="{{ $footer->footer_description }}">{{
                                            $footer->footer_description }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class=" text-left mt-4 col-md-12">
                            <button type="submit" id="abcd" class="btn btn-grad ladda-button" data-style="expand-right">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                <span class="ladda-label">
                                    Save </span><span class="ladda-spinner"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

</section>

@endsection
