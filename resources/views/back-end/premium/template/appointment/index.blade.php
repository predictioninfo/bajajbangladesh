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
                    <h1 class="card-title text-center"> {{ __('Apppointment Letter Template') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="{{ url('appointment-create') }}"><span class="icon icon-plus"> </span>Add</a></li>

                        <li><a href="#">List - Apppointment Letter </a></li>
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
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $appointment->appointment_template_subject }}</td>
                                <td>
                                    <a href="{{ route('appointment-shows', ['id' => $appointment->id]) }}" class="btn view"
                                        title="" data-original-title=" Show " data-toggle="tooltip"> <i
                                            class="fa fa-eye" aria-hidden="true"></i> </a>
                                    <a href="{{ route('appointment-edits', ['id' => $appointment->id]) }}" class="btn edit"
                                        title="" data-original-title=" Edit " data-toggle="tooltip"> <i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>

                                    <a href="{{ route('appointment-deletes', ['id' => $appointment->id]) }}"
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
