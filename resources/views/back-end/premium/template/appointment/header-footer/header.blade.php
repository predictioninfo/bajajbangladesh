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

            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Template Header') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus">
                                </span>Add</a></li>

                        <li><a href="#">Template Header </a></li>
                    </ol>
                </div>
            </div>

        </div>
        <!-- Add Modal Starts -->
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header" style="background-color:#61c597;">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Header') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('add-headers') }}" class="form-horizontal" id="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12 form-group">
                                    <label for="my-textarea">Header Description</label>
                                    <textarea id="description" class="form-control" name="header_desc" rows="4" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="website">
                                        Company Logo <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" id="logo" accept="image/*"
                                            class="form-control @error('photo') is-invalid @enderror" name="logo"
                                            placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img id="blah"
                                        src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                        alt="" height="150px" width="150px" style="padding-top: 5px;" />
                                </div>
                                <br>
                                <div class="col-sm-3">
                                    <button id="add-header" class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Add </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

        <!-- Add Modal Ends -->

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color:#20898f;">
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Header Description') }}</th>
                        <th>{{ __('Logo') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($headers as $header)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{!! ucfirst($header->header_description) !!}</td>
                            <td> <img src="{{ $header->logo }}" alt=""> </td>

                            <td>
                                <a href="javascript:void(0)" class="btn edit" data-id="{{ $header->id }}"
                                    data-toggle="tooltip" title=" Edit" data-original-title="Edit"> <i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="{{ route('delete-headers', ['id' => $header->id]) }}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                    data-original-title=" Delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- Modal Form for View Start-->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelEdit"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form method="post" action="{{ route('update-header') }}" class="form-horizontal"
                            id="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="row">

                                <div class="col-md-12 form-group">
                                    <label for="my-textarea">Header Description</label>
                                    <textarea id="edit_description" class="form-control" name="edit_header_desc" rows="4" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="website">
                                        Company Logo <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" id="edit_logo" accept="image/*" value=""
                                            class="form-control @error('photo') is-invalid @enderror" name="edit_logo"
                                            placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img id="blah_edit" src="" alt="" height="150px" width="150px"
                                        style="padding-top: 5px;" />
                                </div>
                                <br>
                                <div class="col-sm-3">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Save Change </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Form for View End-->

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // For Image Preview
            logo.onchange = evt => {
                const [file] = logo.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
            //Image Preview for Edit
            edit_logo.onchange = evt => {
                const [file] = edit_logo.files
                if (file) {
                    blah_edit.src = URL.createObjectURL(file)
                }
            }
            //For textarea validation with ckeditor
            const editor = CKEDITOR.replace('description');
            const submitBtn = $('#add-header');

            submitBtn.on('click', function(event) {
                if (editor.getData().trim() === '') {
                    event.preventDefault();
                    alert('Please enter a description');
                }
            });
            //For Header Edit
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'header-show',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelEdit').html("Edit Header");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.header.id);

                        // Check if the CKEditor instance already exists
                        if (CKEDITOR.instances.edit_description) {
                            // If it exists, destroy the instance
                            CKEDITOR.instances.edit_description.destroy(true);
                        }

                        // Set the value of the <textarea> element to an empty string
                        $('#edit_description').val('');

                        // Replace the <textarea> element with CKEditor
                        CKEDITOR.replace('edit_description');

                        // Set the value of the CKEditor instance to the value of res.header_description
                        CKEDITOR.instances.edit_description.setData(res.header.header_description);

                        // Set the src attribute of the <img> element to the value of res.logo
                        $('#blah_edit').attr('src', res.header.logo);
                    }


                });
            });


            $('#user-table').DataTable({
                dom: '<"row"lfB>rtip',

                buttons: [
                    // {
                    //     extend: 'pdf',
                    //     text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                    //     exportOptions: {
                    //         columns: ':visible:Not(.not-exported)',
                    //         rows: ':visible'
                    //     },
                    // },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    // {
                    //     extend: 'print',
                    //     text: '<i title="print" class="fa fa-print"></i>',
                    //     exportOptions: {
                    //         columns: ':visible:Not(.not-exported)',
                    //         rows: ':visible'
                    //     },
                    // },
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
