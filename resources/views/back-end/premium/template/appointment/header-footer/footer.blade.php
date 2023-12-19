@extends('back-end.premium.layout.premium-main')
@section('content')
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
                    <h1 class="card-title text-center"> {{ __('Template Footer') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>

                        <li><a href="#">List - Template Footer </a></li>
                    </ol>
                </div>
            </div>

        </div>
        <!-- Add Modal Starts -->
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header" style="background-color:#61c597;">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Footer') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('add-footers') }}" class="form-horizontal" id="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12 mt-4">
                                    <label for="my-textarea">Footer Description</label>
                                    <textarea class="form-control" name="footer_desc" rows="4"></textarea>
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
                            <th>{{ __('Footer Description') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($footers as $footer)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $footer->footer_description }}</td>
                                <td>
                                    <a href="#" class="btn edit" data-toggle="modal"
                                        data-target="#Modal{{ $footer->id }}" title=""
                                        data-original-title=" Edit "> <i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i> </a>

                                    <a href="{{ route('delete-footers', ['id' => $footer->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                        data-original-title=" Delete "><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            <div id="Modal{{ $footer->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit Footer') }}
                                            </h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                                class="close"><i class="dripicons-cross"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"
                                                action="{{ route('update-footers', ['id' => $footer->id]) }}"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12 mt-4">
                                                        <textarea class="form-control" name="footer_desc" rows="4">{{ $footer->footer_description }}</textarea>
                                                    </div>
                                                    <div class="col-sm-offset-2 col-sm-10 mt-4">
                                                        <button type="submit" class="btn btn-grad">Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
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
        });
    </script>
@endsection
