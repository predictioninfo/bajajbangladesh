@extends('back-end.premium.layout.premium-main')
<style>
    .popup {
        /* width: 900px; */
        margin: auto;
        text-align: center
    }

    .popup img {
        width: 200px;
        height: 200px;
        cursor: pointer
    }

    .show1 {
        z-index: 999;
        display: none;
    }

    .show1 .overlay {
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .66);
        position: absolute;
        top: 0;
        left: 0;
    }

    .show1 .img-show {
        width: 1000px;
        height: 500px;
        background: #FFF;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        overflow: hidden
    }

    .img-show span {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 99;
        cursor: pointer;
        color: red;
        font-weight: bold;
    }

    .img-show img {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    /*End style*/
</style>
@section('content')
    <section class="main-contant-section">
        <div class="">

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

            <div class="content-box">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Import Attandence</h3>
                        <div id="form_result"></div>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <h4>Instructions</h4>
                                <table class="table table-bordered table-hover table-striped">
                                    <tr>
                                        <td style="padding: 8px 15px; font-size:15px" colspan="3">
                                            <strong>
                                                1. The first line in downloaded csv file should remain as it is. Please do not change the order of columns in csv file.
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 15px; font-size:15px" colspan="3"> <strong> 2. The
                                                correct column
                                                order is <span style="color: red;font-size:20px;">
                                                    ( company_assigned_id, attendance_date, clock_in, clock_out )</span> and
                                                you
                                                must follow the csv file,
                                                otherwise you will get an <span style="color: red;font-size:20px;"> Error
                                                </span> while importing the csv file. </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 15px; font-size:15px" colspan="3">
                                            <strong> 3. Please select csv or excel file (allowed file size 2MB).</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; font-weight: bold;"> A. Correct Format
                                            <div class="popup">
                                                <img src="{{ asset('uploads/import-samples/format/correctFormat.png') }}">
                                            </div>
                                        </td>
                                        <td style="text-align: center; font-weight: bold;"">B. Wrong Format
                                            <div class="popup">
                                                <img src="{{ asset('uploads/import-samples/format/wrongFormat.png') }}">
                                            </div>
                                        </td>
                                        <td style="text-align: center; font-weight: bold;"">C. How to correction
                                            <div class="popup">
                                                <img src="{{ asset('uploads/import-samples/format/doCorrectFormat.gif') }}">
                                            </div>
                                        </td>

                                    </tr>

                                </table>
                                <div style="display: flex; align-items: center;">
                                    <input type="checkbox" id="instructionCheckbox" style="margin-right: 10px;">
                                    <label for="instructionCheckbox"
                                        style="font-size: 20px; color: red; margin-top: 8px; user-select:none;">I read &
                                        understand instructions</label>
                                </div>
                            </div>
                            <br>
                            <div class="justify-content-between" id="dynamicContentContainer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="show1">
            <div class="overlay"></div>
            <div class="img-show">
                <span>X</span>
                <img src="">
            </div>
        </div>
    </section>




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


            function generateDynamicContent() {
                var dynamicHTML = `
        <div class="row" id="uploadSection" style="display: none;">
          <div class="col-md-4">
            <a href="{{ asset('uploads/import-samples/attendance-import-sample.xlsx') }}"
                                class="btn btn-success" download> <i class="fa fa-download"></i> Download sample File </a>
          </div>
          <div class="col-md-8">
            <form action="{{route('file-attendance-imports')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <input type="file" name="file" class="form-control" id="file" required>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-upload"></i> {{ __('Upload') }}
                  </button>
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
            $(function() {
                "use strict";

                $(".popup img").click(function() {
                    var $src = $(this).attr("src");
                    $(".show1").fadeIn();
                    $(".img-show img").attr("src", $src);
                });

                $("span, .overlay").click(function() {
                    $(".show1").fadeOut();
                });

            });
        });
    </script>
@endsection
