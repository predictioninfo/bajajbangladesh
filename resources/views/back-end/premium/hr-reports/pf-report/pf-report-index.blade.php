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
           
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Provident Fund Report') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">{{ 'Provident Fund Report' }} </a></li>
                    </ol>
                </div>
            </div>
            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Company</th>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Stuff ID</th>
                                <th>Total Provident Fund Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php($i = 1)
                            @foreach ($pf_histories as $pf_histories_value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $pf_histories_value->company_name }}</td>
                                    <td>{{ $pf_histories_value->first_name . ' ' . $pf_histories_value->last_name }}</td>
                                    <td>{{ $pf_histories_value->department_name }}</td>
                                    <td>{{ $pf_histories_value->designation_name }}</td>
                                    <td>{{ $pf_histories_value->providentfund_bankaccount_stuff_id }}</td>
                                    <td>{{ $pf_histories_value->providentfund_report_total_amount }}</td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>

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



        });
    </script>
@endsection
