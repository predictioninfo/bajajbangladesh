@extends('back-end.premium.layout.premium-main')
@section('content')
<section class="main-contant-section">
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
                    <h1 class="card-title text-center"> {{ __('Salary Increment Letter Template') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus">
                                </span>Add</a></li>

                        <li><a href="#">List - Salary Increment Letter </a></li>
                    </ol>
                </div>
            </div>

        </div>

        <div class="content-box">
            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead style="background-color:#458191;">
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($incremenrt_letters as $incremenrt_letter)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $incremenrt_letter->subject }}</td>
                            <td>
                                <a href="{{ route('salary-increment-shows', ['id' => $incremenrt_letter->id]) }}"
                                    class="btn view" title="" data-original-title=" Show " data-toggle="tooltip"> <i
                                        class="fa fa-eye" aria-hidden="true"></i> </a>

                                <a href="{{ route('salary-increment-edits', ['id' => $incremenrt_letter->id]) }}"
                                    class="btn edit" title="" data-original-title=" Edit " data-toggle="tooltip"> <i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('salary-increment-deletes', ['id' => $incremenrt_letter->id]) }}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                    data-original-title=" Delete "><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Add modal Start-->
    <div id="addModal" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Add Salary Increment Letter Template</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('salary-increment-format-adds') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_name">
                                        <span style="color:black;font-weight:bold;">Headers </label>
                                    <div class="input-group">
                                        <select name="header_id" id="" class="form-control">
                                            <option value="">Select Header</option>
                                            @foreach ($headers as $header)
                                            <option value="{{ $header->id }}">
                                                {!! preg_replace_callback(
                                                '/\b(\w)/',
                                                function ($matches) {
                                                return ucfirst($matches[0]);
                                                },
                                                Str::limit($header->header_description, 40),
                                                ) !!}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="subject">
                                        <span style="color:black;font-weight:bold;">Subject </span>
                                        <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Letter Subject"
                                            name="subject" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="email">
                                    <span style="color:black;font-weight:bold;">Template Body </span><span
                                        class="text-danger">*</span> </label>
                                <div class="">
                                    <textarea name="body" id="description" cols="50" rows="5"
                                        placeholder="Writing Somthing...."></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="" readonly class="form-control"
                                            placeholder="The amount of your salary increased is BDT. -TK" name=""
                                            required>
                                    </div>
                                </div>
                            </div><br><br><br>
                            <div class="col-md-12">

                                <label for="email">
                                    <span style="color:black;font-weight:bold;">Salary </span> </label>

                                <table class="table" style="width:10%">
                                    <tbody>

                                        <tr>
                                            <td style="border: 1px solid black;font-size: 12px;" colspan="2">Basic
                                                Salary</td>
                                            <td style="border: 1px solid black;text-align:right;font-size: 12px; "
                                                colspan="2"> -TK </td>
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black;font-size: 12px;" colspan="2">Medical
                                                allowance</td>
                                            <td style="border: 1px solid black;text-align:right;font-size: 12px; "
                                                colspan="2"> -TK</td>
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black;font-size: 12px;" colspan="2">House Rent
                                            </td>
                                            <td style="border: 1px solid black;text-align:right;font-size: 12px; "
                                                colspan="2"> -TK</td>
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black;font-size: 12px;" colspan="2">Convence
                                                Allowance</td>
                                            <td style="border: 1px solid black;text-align:right;font-size: 12px; "
                                                colspan="2"> -TK</td>
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black;font-size: 12px;" colspan="2">Total</td>
                                            <td style="border: 1px solid black;text-align:right;font-size: 12px; "
                                                colspan="2"> -TK</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="" readonly class="form-control"
                                            placeholder="These changes will come into effect from 2023-04-01" name=""
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="website">
                                    Signature <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" id="signature_img" accept="image/*"
                                        class="form-control @error('photo') is-invalid @enderror" name="signature_img"
                                        placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img id="blah"
                                    src="https://cdn.pixabay.com/photo/2016/02/11/19/03/michael-jackson-1194286_960_720.png"
                                    alt="" height="150px" width="150px" style="padding-top: 5px;" />
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">
                                        Sginatory <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="employee_id" id="employment_type" class="form-control" required>
                                            <option value="">{{ __('Select A Signatory ') }}
                                            </option>
                                            @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                            </option>
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
                                        <select name="footer_id" class="form-control">
                                            <option value="">{{ __('Select A Footer...') }}</option>
                                            @foreach ($footers as $footer)
                                            <option value="{{ $footer->id }}">
                                                {{ Str::limit($footer->footer_description, 45, '...') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="email">
                                    <span style="color:black;font-weight:bold;">Extra features </span><span
                                        class="text-danger">*</span> </label>
                                <div class="">
                                    <textarea name="extra_feture" id="description1" cols="20" rows="2"
                                        placeholder="Writing Somthing...."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" text-left mt-4">

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

    </div>
    </div>
    <!-- Add modal End-->

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

            });


    </script>
    @endsection