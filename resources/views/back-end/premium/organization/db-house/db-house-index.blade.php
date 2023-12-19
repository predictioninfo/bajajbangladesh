@extends('back-end.premium.layout.premium-main')

@section('content')
    <section class="main-contant-section">
        <?php

        use App\Models\Company;

        ?>
        <?php
        foreach ($locations as $location) {
            $location1 = $location->location1 ?? 'Location1';
            $location2 = $location->location2 ?? 'Location2';
            $location3 = $location->location3 ?? 'Location3';
            $location4 = $location->location4 ?? 'Location4';
            $location5 = $location->location5 ?? 'Location5';
        }
        ?>

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
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ $location5 }} {{ __('list') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#" type="button" data-toggle="modal" data-target="#editLocationModal"><span
                                    class="icon icon-edit"> </span>Edit Label</a></li>
                        <li><a href="#">List - {{ $location5 ?? 'location3' }} </a></li>
                    </ol>
                </div>
            </div>
            {{-- <div class="d-flex flex-row mt-3">

                @if ($delete_permission == 'Yes')
                <div class="ml-2">
                    <form method="post" action="{{route('bulk-delete-db-houses')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
                        <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                    </form>
                </div>
                @endif

            </div> --}}


            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Add') }} {{ $location5 }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                    class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('add-db-houses') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">


                                    <div class="col-md-4 form-group">
                                        <label> {{ $location1 }} *</label>
                                        <select name="region_id" id="region_id" class="form-control selectpicker region"
                                            data-live-search="true" data-live-search-style="begins"
                                            data-dependent="area_name" title="{{ __('Selecting  name') }}...">
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{ $location2 }} {{ __(' Name') }}*</label>
                                        <select class="form-control" name="area_id" id="area_id"></select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{ $location3 }}{{ __(' Name') }} *</label>
                                        <select class="form-control" name="territory_id" id="territory_id"></select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{ $location4 }}{{ __(' Name') }} *</label>
                                        <select class="form-control" name="town_id" id="town_id"></select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>{{ $location5 }}{{ __(' Name') }} *</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-home"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="db_house_name" value="" required
                                                class="form-control">
                                        </div>
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
            <div id="editLocationModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit Location Label name') }}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('loaction-fives') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="">

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ __('Location Label Name') }} *</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-location-arrow"
                                                        aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="location5" value="" required
                                                class="form-control">
                                        </div>
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

            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">

                        <thead>

                            <tr>
                                <th>{{ __('SL') }}</th>
                                {{-- <th>{{__('Company Name')}}</th> --}}
                                <th>{{ $location1 }}{{ __(' Name') }}</th>
                                <th>{{ $location2 }}{{ __(' Name') }}</th>
                                <th>{{ $location3 }}{{ __(' Name') }}</th>
                                <th>{{ $location4 }}{{ __(' Name') }}</th>
                                <th>{{ $location5 }}{{ __(' Name') }}</th>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <th>{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($db_houses as $db_housesValue)
                                <tr>

                                    <td>{{ $i++ }}</td>

                                    {{-- <td>{{$db_housesValue->company_name}}</td> --}}
                                    <td>{{ $db_housesValue->region_name }}</td>
                                    <td>{{ $db_housesValue->area_name }}</td>
                                    <td>{{ $db_housesValue->territory_name }}</td>
                                    <td>{{ $db_housesValue->town_name }}</td>
                                    <td>{{ $db_housesValue->db_house_name }}</td>
                                    @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                        <td>

                                            @if ($edit_permission == 'Yes')
                                                <a href="{{ route('edit-db-houses', ['id' => $db_housesValue->id]) }}"
                                                    class="btn edit" data-id="" data-toggle="tooltip" title=" Edit "
                                                    data-original-title="Edit"> <i class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i></a>
                                            @endif
                                            @if ($delete_permission == 'Yes')
                                                <a href="{{ route('delete-db-houses', ['id' => $db_housesValue->id]) }}"
                                                    class="btn btn-danger delete-post" data-toggle="tooltip"
                                                    title=" Delete " data-original-title="Delete"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>


                                        </td>
                                    @endif
                            @endif
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
