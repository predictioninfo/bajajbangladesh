@extends('back-end.premium.layout.premium-main')
@section('content')

<?php

    $date = new DateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $current_date = $date->format('Y-m-d');
    $current_month = $date->format('m');
    $current_day = $date->format('d');
    $lastDay = $date->modify('last day of this month');
    $lastDays = $lastDay->format('d');

    $review_permission = 'Not-Permitted';
    $year_end_review_permission = 'Not-Permitted';
    $review_visible_days = 0;
    $current_day_number = $current_day;
    $current_month_number = $current_month;
    $lastDayOfcurrentMonth = $lastDays;

    foreach ($yearly_reviews as $yearly_reviews_value) {
        if ($current_month_number == $yearly_reviews_value->yearly_review_after_months && $current_day_number >= $yearly_reviews_value->yearly_review_upto) {
            $review_permission = 'Permitted';
        } else {
            $year_end_review_permission = 'Not-Permitted';
        }
        // if ($current_day_number >= $yearly_reviews_value->yearly_review_upto && $current_day_number <= $lastDayOfcurrentMonth) {

        //     $review_visible_days = 'Permitted';

        // } else {
        //     $review_visible_days = 'Not-Permitted';

        // }

    }

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
                <h1 class="card-title text-center"> Yearly Employees Performance Review Form List </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#">List - {{ 'Yearly Reviews' }} </a></li>
                </ol>
            </div>
        </div>


    </div>

    @if ($review_permission == 'Permitted')
    <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ __('SL') }} </th>
                        <th>{{ __('Department') }}</th>
                        <th>{{ __('Designation') }}</th>
                        <th>{{ __('Employee') }}</th>
                        <th>{{ __('Year') }}</th>
                        <th>{{ __('Point') }}</th>
                        <th>{{ __('Action') }}</th>

                    </tr>
                </thead>

                <tbody>
                    @php($i = 1)
                    @foreach ($objectives as $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->userdepartmentfromobjective->department_name ?? '' }}</td>
                        <td>{{ $value->userdesignationfromobjective->designation_name ?? '' }}</td>
                        <td>{{ $value->userfromobjective->first_name ?? '' }} {{ $value->userfromobjective->last_name ??
                            '' }}</td>
                        <td>{{$value->created_at->format('Y')}}</td>
                        <td>{{$value->point}}</td>
                        <td>
                            <a href="{{route('performances-marking',['id'=>$value->id])}}" class="btn edit" data-toggle="tooltip" title="Performance Review "
                                        data-original-title="Marking" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                            <a href="{{ route('objective-review-views', $value->id) }}" class="btn view" data-toggle="tooltip" title="View"
                                data-original-title="Marking" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
                            </td>

                    </tr>
                    @endforeach


                </tbody>

            </table>

        </div>
    </div>
    @endif
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
