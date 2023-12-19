@extends('back-end.premium.layout.premium-main')

@section('content')


<section class="main-contant-section">

    <div class=""><span id="general_result"></span></div>

    <div class="">
        <div class="card mb-0">


            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Active PSR Report') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li> <a href="{{ route('active-psr-report-downloads') }}"><span class="fa fa-arrow-down"> Excel Download</span></a></li>
                        <li><a href="#">{{ 'Active PSR Report' }} </a></li>
                    </ol>
                </div>


        </div>
    </div>

    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped display nowrap" id="example"
            style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>ID no.</th>
                        <th>PSR Name</th>
                        <th>Region</th>
                        <th>Area</th>
                        <th>Territory</th>
                        <th>Town</th>
                        <th>Joining Date</th>
                        <th>Personal Number</th>
                        <th>Office Number</th>

                    </tr>

                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$employee->company_assigned_id}}</td>
                        <td>{{$employee->first_name.' '.$employee->last_name}}</td>
                        <td>{{$employee->userregion->region_name ?? null}}</td>
                        <td>{{$employee->userarea->area_name ?? null}}</td>
                        <td>{{$employee->userterritory->territory_name ?? null}}</td>
                        <td>{{$employee->usertown->town_name ?? null}}</td>
                        <td>{{$employee->joining_date}}</td>
                        <td>{{$employee->phone ?? null}}</td>
                        <td>{{$employee->b_phone ?? null}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $('#user-table').DataTable({
                    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                    "iDisplayLength": 25,

                    dom: '<"row"lfB>rtip',

                    buttons: [
                        {
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
