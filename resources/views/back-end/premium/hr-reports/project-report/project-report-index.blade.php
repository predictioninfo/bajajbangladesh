@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    ?>
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

        </div>


        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Project Report') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">{{ 'Project Report' }} </a></li>
                </ol>
            </div>
        </div>

        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Project Name') }}</th>
                            <th>{{ __('Assigned To') }}</th>
                            <th>{{ __('Priority') }}</th>
                            <th>{{ __('Client Name') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Project Progress (%)') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($projects as $projects_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $projects_value->project_name }}</td>
                                <td>
                                    @foreach (json_decode($projects_value->assign_to) as $test)
                                        <?php
                                        $users = User::where('id', $test)->get(['first_name', 'last_name']);
                                        foreach ($users as $users_data) {
                                            echo $users_data->first_name . ' ' . $users_data->last_name . '<br>';
                                        }
                                        ?>
                                    @endforeach
                                </td>
                                <td>{{ $projects_value->project_priority }}</td>
                                <td>{{ $projects_value->project_client_name }}</td>
                                <td>{{ $projects_value->project_start_date }}</td>
                                <td>{{ $projects_value->project_end_date }}</td>
                                <td>{{ $projects_value->progress_progress }}</td>
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
