@extends('back-end.premium.layout.premium-main')

@section('content')
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
                    <h1 class="card-title text-center"> {{ __(' List') }} </h1>

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                        @if ($ip->isEmpty())
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addIp"><span
                                        class="icon icon-plus"> </span>Add IP</a></li>
                        @endif
                        @endif
                    </ol>

                </div>
            </div>
            <div id="addIp" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color:#61c597;">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add IP Address') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Instruction</h4>
                                    <table>
                                        <tr>
                                            <td style="padding: 8px 15px; font-size:15px">1. Please Make sure about Real IP Address</td>
                                        </tr>
                                    </table>
                                    <div class="form-check" style="margin-top: 10px;">
                                        <input type="checkbox" class="form-check-input" id="instructionCheckbox" style="margin-top: -1.7px">
                                        <label class="form-check-label" for="instructionCheckbox"
                                            style="font-size: 20px; color: red;">I read & understand instructions</label>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div id="dynamicContentContainer"></div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ip as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['ip'] }}</td>
                                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                        <td>
                                            @if ($edit_permission == 'Yes')
                                                <a href="javascript:void(0)" class="btn edit"
                                                    data-id="{{ $item['id'] }}" data-toggle="tooltip" title=""
                                                    data-original-title=" Edit "> <i class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i> </a>
                                            @endif
                                            @if ($delete_permission == 'Yes')
                                                <a onclick="return confirm('Are you sure you want to delete this item?');"
                                                    href="{{ route('delete-ip', ['id' => $item['id']]) }}"
                                                    class="btn btn-danger" data-id="{{ $item['id'] }}"
                                                    data-toggle="tooltip" title="" data-original-title=" Delete ">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('ip-update') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">IP Code</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-server" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="ip_code" id="ip_code" class="form-control"
                                    value="">
                            </div>
                            <p id="error-message1" style="color: red;"></p>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad" id="update-button" disabled>Save changes
                            </button>
                        </div>
                    </form>
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

            function generateDynamicContent() {
                var dynamicHTML = `
        <div class="row" id="uploadSection" style="display: none;">
          <div class="col-md-8">
            <form method="post" action="{{ route('add-device-ip') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>IP Address<span class="text-danger">*</span></label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-server"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="device_ip" id="device_ip" value=""
                                                class="form-control" placeholder="127.0.0.1:8090">
                                        </div>
                                        <p id="error-message" style="color: red;"></p>
                                    </div>
                                    <div class="col-sm-12 mt-4">

                                        <button class="btn btn-grad" type="submit" id="submit-button" disabled> <i
                                                class="fa fa-plus" aria-hidden="true"></i> Add </button>

                                    </div>
                                </div>

                            </form>
          </div>
        </div>
      `;
                return dynamicHTML;
            }

            // Call the function to generate the dynamic content
            var generatedHTML = generateDynamicContent();
            $("#dynamicContentContainer").html(generatedHTML);

            // Add event listener to the dynamically generated checkbox
            $(document).on("change", "#instructionCheckbox", function() {
                if ($(this).is(":checked")) {
                    $("#uploadSection").show();
                } else {
                    $("#uploadSection").hide();
                }
                if ($(this).is(":checked")) {
                    $("label[for='instructionCheckbox']").addClass("checked");
                } else {
                    $("label[for='instructionCheckbox']").removeClass("checked");
                }
            });

            $("#instructionCheckbox").change(function() {
                if ($(this).is(":checked")) {
                    $("#uploadSection").show();
                    $("label[for='instructionCheckbox']").css("color", "green");
                } else {
                    $("#uploadSection").hide();
                    $("label[for='instructionCheckbox']").css("color", "red");
                }
            });
            $('#device_ip').on('input', function() {
                var inputValue = $(this).val();
                var ipPortPattern = /^(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{4,6})$/;
                var submitButton = $('#submit-button');

                if (ipPortPattern.test(inputValue)) {
                    $('#error-message').text('');
                    submitButton.prop('disabled', false); // Enable the submit button
                } else {
                    $('#error-message').text(
                        'Invalid format. Please use the format like "127.0.0.1:8090".');
                    submitButton.prop('disabled', true); // Disable the submit button
                }
            });
            $('#ip_code').on('input', function() {
                var inputValue = $(this).val();
                var ipPortPattern = /^(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{4,6})$/;
                var submitButton = $('#update-button');

                if (ipPortPattern.test(inputValue)) {
                    $('#error-message1').text('');
                    submitButton.prop('disabled', false); // Enable the submit button
                } else {
                    $('#error-message1').text(
                        'Invalid format. Please use the format like "127.0.0.1:8090".');
                    submitButton.prop('disabled', true); // Disable the submit button
                }
            });
            //value retriving and opening the edit modal starts
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'ip-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        // console.log(res);
                        var ipWithoutHttpAndSlash = res.ip.replace('http://', '').replace(/\/$/,
                            '');
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#ip_code').val(ipWithoutHttpAndSlash);
                    }
                });
            });
        });
    </script>
@endsection
