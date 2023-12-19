@extends('back-end.premium.layout.premium-main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <!-- html2pdf CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
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
                    <h1 class="card-title text-center"> {{ __('Experience Letter Template') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus">
                                </span>Add</a></li>

                        <li><a href="#">Experience - Letter </a></li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#458191;">
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Logo') }}</th>
                        <th>{{ __('Subject') }}</th>
                        <th>{{ __('Template Body') }}</th>
                        <th>{{ __('Signatory') }}</th>
                        <th>{{ __('Signature') }}</th>
                        <th>{{ __('Footer') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experienceTemplates as $experienceTemplate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($experienceTemplate->experienceHeader)
                                    {{-- {!! preg_replace_callback('/\b(\w)/', function($matches) { return ucfirst($matches[0]); },
                        $experienceTemplate->experienceHeader->header_description, 40) !!} --}}
                                    <img src="{{ asset($experienceTemplate->experienceHeader->logo) }}" alt="">
                                @endif
                            </td>
                            <td>{!! $experienceTemplate->subject !!}</td>
                            <td>{!! html_entity_decode($experienceTemplate->description) !!}</td>
                            <td>
                                @if ($experienceTemplate->experienceSignatory)
                                    {{ $experienceTemplate->experienceSignatory->first_name }}
                                    {{ $experienceTemplate->experienceSignatory->last_name }}
                                @endif
                            </td>
                            <td> <img src="{{ asset($experienceTemplate->signature) }}" alt=""> </td>
                            <td>
                                @if ($experienceTemplate->experienceFooter)
                                    {!! html_entity_decode($experienceTemplate->experienceFooter->footer_description) !!}
                            </td>
                    @endif
                    <td>
                        <a href="javascript:void(0)" class="btn view" data-id="{{ $experienceTemplate->id }}"
                            data-toggle="tooltip" title=" View" data-original-title="View"> <i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" class="btn edit" data-id="{{ $experienceTemplate->id }}"
                            title="Edit" data-original-title="Edit" data-toggle="tooltip"> <i
                                class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>

                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                            href="{{ route('experience-template-delete', $experienceTemplate->id) }}"><i
                                class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </section>
    <!-- Add modal Start-->
    <div id="addModal" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Add Experience Template</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('add-experience-templates') }}" enctype="multipart/form-data">
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
                                    <label for="company_name">
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
                                    <textarea name="description" id="description" cols="50" rows="5" placeholder="Writing Somthing...."></textarea>
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
                                        <select name="employee_id" id="" class="form-control" required>
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
                        </div>
                        <div class=" text-left mt-4">

                            <button type="submit" id="abcd" class="btn btn-grad ladda-button"
                                data-style="expand-right">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                <span class="ladda-label">
                                    Save </span><span class="ladda-spinner"></span></button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!-- Add modal End-->
    <!-- Modal Form for Edit Start-->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelEdit"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="header_id" id="header_id">
                        <input type="hidden" name="logo-top" id="logo-top">
                        <input type="hidden" name="logo-left" id="logo-left">
                        <div style="width: 90%; background-color: #fff; padding: 15px;">
                            <h1 style="text-align: center;" contenteditable="true" id="title">Letter of Experience
                                and
                                Conduct</h1>
                            <div style="text-align: right;">
                                <br /> <img src="" alt="" id="logo"><br />
                            </div>
                            <div>
                                <p> Month date, year </p>
                            </div>
                            <p id="subject" contenteditable="true">Subject/Reference</p>
                            <!-- this can be removed -->

                            <p>To,</p>

                            <p contenteditable="false">
                                Name of the employee
                            </p>

                            <p>Designation _____________</p>

                            <p>Dear Mr./ Ms. ____________,</p>

                            <div>
                                <div contenteditable="true" id="editor1" style="display: inline-block;">This is to
                                    state that</div>
                                <b>Name of employee</b>
                                <div contenteditable="true" id="editor2" style="display: inline-block;">has been
                                    employed at</div>
                                RubyEffect Software Solutions Pvt. Ltd. from <b>From Date</b> to <b>To Date </b> as a
                                <b>Desgination</b>
                                <div contenteditable="true" id="editor3" style="display: inline-block;">with <b>Field
                                        of work</b>
                                    development as his area of
                                    expertise.</div>
                            </div>

                            <div id="body" contenteditable="true">
                                <br /> During his tenure with this company, his conduct has been good and his performance has been
                                up to the expectations of this company.<br /><br /> He/She is a hard worker,is disciplined and has been a source of inspiration for his juniors growth story. 
                                <br /><br /> We wish his/her a bright and enterprising career ahead.
                                </p><br />
                            </div>

                            <div style="text-align: left;">
                                <!-- this can be changed to "left" if preferred-->
                                <div> Best Regards </div><br />
                                <img src="" alt="" id="signature"> <br>
                                <span id="signatory">Cass Amino</span>
                                <br />
                                <br />
                                <br />
                                <b>(employee name)</b><br /> Designation
                                <br /> RubyEffect Software Solutions Pvt. Ltd.<br /> (previously worked company)
                            </div>
                            <div id="footer">

                            </div>
                            <button class="btn btn-success" id="save-btn">Save Change</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Form for Edit End-->
    <!-- Modal Form for View Start-->
    <div class="modal fade" id="view-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelView"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="makepdf">
                    <div class="row">
                        <div style="width: 90%; background-color: #fff; padding: 15px;">
                            <h1 style="text-align: center;" id="title1">Letter of Experience and Conduct</h1>
                            <div style="text-align: right;">
                                <br /> <img src="" alt="" id="logo1"><br />
                            </div>
                            <div>
                                <p> Month date, year </p>
                            </div>
                            <p id="subject1">Subject/Reference</p>
                            <!-- this can be removed -->

                            <p>To,</p>

                            <p>
                                Name of the employee
                            </p>

                            <p>Designation _____________</p>

                            <p>Dear Mr./ Ms. ____________,</p>

                            <div>
                                <div id="editor11" style="display: inline-block;">This is to
                                    state that</div>
                                <b>Name of employee</b>
                                <div id="editor21" style="display: inline-block;">has been
                                    employed at</div>
                                RubyEffect Software Solutions Pvt. Ltd. from <b>From Date</b> to <b>To Date </b> as a
                                <b>Desgination</b>
                                <div id="editor31" style="display: inline-block;">with <b>Field
                                        of work</b>
                                    development as his area of
                                    expertise.</div>
                            </div>

                            <div id="body1">
                                <br /> During his tenure with this company, his conduct has been good and his performance
                                has
                                been
                                up to the expectations of this company.<br /><br /> He/She is a hard worker,
                                is
                                disciplined and has been a source of inspiration for his juniors
                                and has helped the company in its endeavors. He has been an integral part of this company
                                growth
                                story. <br /><br /> We wish his/her a bright and enterprising career ahead.
                                </p><br />
                            </div>

                            <div style="text-align: left;">
                                <!-- this can be changed to "left" if preferred-->
                                <div> Best Regards </div><br />
                                <img src="" alt="" id="signature1"> <br>
                                <span id="signatory1">Cass Amino</span>
                                <br />
                                <br />
                                <br />
                                <b>(employee name)</b><br /> Designation
                                <br /> RubyEffect Software Solutions Pvt. Ltd.<br /> (previously worked company)
                            </div>
                            <div id="footer1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pdfBtn">Generate PDF</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Form for Edit End-->
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            signature_img.onchange = evt => {
                const [file] = signature_img.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
            //For Editable
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'experience-show',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelEdit').html("Letter of Experience");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.experienceLetter.id);
                        if (res.experienceLetter && res.experienceLetter.experience_header &&
                            res.experienceLetter.experience_header.id) {
                            $('#header_id').val(res.experienceLetter.experience_header.id);
                        } else {
                            $('#header_id').val('');
                        }
                        if (res.experienceLetter && res.experienceLetter.title) {
                            $('#title').text(res.experienceLetter.title.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        } else {
                            $('#title').text('');
                        }
                        if (res.experienceLetter && res.experienceLetter.subject) {
                            $('#subject').text(res.experienceLetter.subject.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        } else {
                            $('#subject').text('');
                        }
                        if (res.experienceLetter && res.experienceLetter.experience_header &&
                            res.experienceLetter.experience_header.logo) {
                            $('#logo').attr('src', res.experienceLetter.experience_header.logo);
                        } else {
                            $('#logo').attr('src', '');
                        }
                        //  Set the position of the logo element
                        if (res.experienceLetter && res.experienceLetter.logo_top && res
                            .experienceLetter && res.experienceLetter.logo_left) {
                            $("#logo").css({
                                "height": "50px",
                                "width": "150px",
                                "position": "relative",
                                "top": res.experienceLetter.logo_top,
                                "left": res.experienceLetter.logo_left,
                            });
                        } else {
                            $("#logo").css({
                                "height": "50px",
                                "width": "150px",
                                "position": "relative",
                                "top": -31 + "px",
                                "left": 73 + "px",
                            });
                        }

                        if (res.experienceLetter.content1) {
                            $('#editor1').text(res.experienceLetter.content1.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        }
                        if (res.experienceLetter.content2) {
                            $('#editor2').text(res.experienceLetter.content2.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        }
                        if (res.experienceLetter.content3) {
                            $('#editor3').text(res.experienceLetter.content3.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        }
                        if (res.experienceLetter && res.experienceLetter.description) {
                            $('#body').text(res.experienceLetter.description.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        } else {
                            $('#body').text('');
                        }
                        if (!res || !res.experienceLetter) {
                            $('#signatory').text('No experience letter available');
                        } else if (!res.experienceLetter.experience_signatory) {
                            $('#signatory').text('No signatory available');
                        } else {
                            const {
                                experience_signatory
                            } = res.experienceLetter;
                            const name = experience_signatory.first_name ? experience_signatory
                                .first_name + ' ' : '';
                            const lastName = experience_signatory.last_name || '';
                            const signatoryName = name + lastName || 'No name available';
                            $('#signatory').text(signatoryName);
                        }
                        if (res.experienceLetter.signature) {
                            $('#signature').attr('src', res.experienceLetter.signature);
                            $('#signature').css({
                                'height': '20px',
                                'width': '150px'
                            });
                            $('#signature').attr('alt', '');
                        } else {
                            $('#signature').attr('src', '');
                            $('#signature').css({
                                'height': '',
                                'width': ''
                            }); // Reset to default size
                            $('#signature').attr('alt', 'No signature available');
                        }
                        if (res.experienceLetter.experience_footer && res.experienceLetter
                            .experience_footer.footer_description) {
                            $('#footer').text(res.experienceLetter.experience_footer
                                .footer_description.replace(/<\/?[^>]+(>|$)/g, "").replace(
                                    /&nbsp;/g, " ").replace(/&amp;/g, '&'));
                        } else {
                            $('#footer').text('No footer added');
                        }
                        $(function() {
                            $('#logo').draggable();
                        });
                    }
                });
            });

            CKEDITOR.replace('description');
            // Get the position of the logo element

            $(function() {
                $('#logo').draggable({
                    stop: function() {
                        $('#logo-top').val($(this).css(
                        'top')); // store the top position of the logo in a hidden input field
                        $('#logo-left').val($(this).css(
                        'left')); // store the left position of the logo in a hidden input field
                    }
                });

                $('#save-btn').click(function() {
                    var content1 = $('#editor1').html();
                    var content2 = $('#editor2').html();
                    var content3 = $('#editor3').html();
                    var logo_top = $('#logo-top').val();
                    var logo_left = $('#logo-left').val();
                    var title = $('#title').text();
                    var subject = $('#subject').html();
                    var body = $('#body').html();
                    var id = $('#id').val();
                    var header_id = $('#header_id').val();


                    $.ajax({
                        type: 'POST',
                        url: 'change-experience-letter',
                        data: {
                            id: id,
                            header_id: header_id,
                            content1: content1,
                            content2: content2,
                            content3: content3,
                            logo_top: logo_top,
                            logo_left: logo_left,
                            title: title,
                            subject: subject,
                            body: body
                        },
                        success: function(response) {
                            window.location.reload();
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });


            //For View
            $('.view').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'experience-show',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelView').html("Letter of Experience Preview");
                        $('#view-modal').modal('show');
                        var filename = res.experienceLetter.subject ||
                        'mydoc.pdf'; // Use res.experienceLetter.subject if available, otherwise fallback to 'mydoc.pdf'
                        if (res.experienceLetter && res.experienceLetter.title) {
                            $('#title1').text(res.experienceLetter.title.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        } else {
                            $('#title1').text('');
                        }
                        if (res.experienceLetter && res.experienceLetter.subject) {
                            $('#subject1').text(res.experienceLetter.subject.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        } else {
                            $('#subject1').text('');
                        }
                        if (res.experienceLetter && res.experienceLetter.experience_header &&
                            res.experienceLetter.experience_header.logo) {
                            $('#logo1').attr('src', res.experienceLetter.experience_header
                            .logo);
                        } else {
                            $('#logo1').attr('src', '');
                        }
                        //  Set the position of the logo element
                        if (res.experienceLetter && res.experienceLetter.logo_top && res
                            .experienceLetter && res.experienceLetter.logo_left) {
                            $("#logo1").css({
                                "height": "50px",
                                "width": "150px",
                                "position": "relative",
                                "top": res.experienceLetter.logo_top,
                                "left": res.experienceLetter.logo_left,
                            });
                        } else {
                            $("#logo1").css({
                                "height": "50px",
                                "width": "150px",
                                "position": "relative",
                                "top": -31 + "px",
                                "left": 73 + "px",
                            });
                        }

                        if (res.experienceLetter.content1) {
                            $('#editor11').text(res.experienceLetter.content1.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        }
                        if (res.experienceLetter.content2) {
                            $('#editor21').text(res.experienceLetter.content2.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        }
                        if (res.experienceLetter.content3) {
                            $('#editor31').text(res.experienceLetter.content3.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        }
                        if (res.experienceLetter && res.experienceLetter.description) {
                            $('#body1').text(res.experienceLetter.description.replace(
                                /<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").replace(
                                /&amp;/g, '&'));
                        } else {
                            $('#body1').text('');
                        }
                        if (!res || !res.experienceLetter) {
                            $('#signatory1').text('No experience letter available');
                        } else if (!res.experienceLetter.experience_signatory) {
                            $('#signatory1').text('No signatory available');
                        } else {
                            const {
                                experience_signatory
                            } = res.experienceLetter;
                            const name = experience_signatory.first_name ? experience_signatory
                                .first_name + ' ' : '';
                            const lastName = experience_signatory.last_name || '';
                            const signatoryName = name + lastName || 'No name available';
                            $('#signatory1').text(signatoryName);
                        }
                        if (res.experienceLetter.signature) {
                            $('#signature1').attr('src', res.experienceLetter.signature);
                            $('#signature1').css({
                                'height': '20px',
                                'width': '150px'
                            });
                            $('#signature1').attr('alt', '');
                        } else {
                            $('#signature1').attr('src', '');
                            $('#signature1').css({
                                'height': '',
                                'width': ''
                            }); // Reset to default size
                            $('#signature1').attr('alt', 'No signature available');
                        }
                        if (res.experienceLetter.experience_footer && res.experienceLetter
                            .experience_footer.footer_description) {
                            $('#footer1').text(res.experienceLetter.experience_footer
                                .footer_description.replace(/<\/?[^>]+(>|$)/g, "").replace(
                                    /&nbsp;/g, " ").replace(/&amp;/g, '&'));
                        } else {
                            $('#footer1').text('No footer added');
                        }
                        generatePDF(
                        filename); // Call the function that generates the PDF with the filename parameter
                    }
                });
            });

            function generatePDF(filename) {
                var button = document.getElementById("pdfBtn");
                var makepdf = document.getElementById("makepdf");

                button.addEventListener("click", function() {
                    html2pdf().set({
                        filename: filename, // Use the value of the filename parameter here
                        format: 'a4'
                    }).from(makepdf).save().then(function() {
                        // PDF generation completed successfully
                        location.reload(); // Reload the page
                    });
                });
            }
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
