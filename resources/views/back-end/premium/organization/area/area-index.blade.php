@extends('back-end.premium.layout.premium-main')

@section('content')

<section class="main-contant-section">
    <?php

    use App\Models\Company;

    ?>
    <?php
    foreach ($locations as $location){
    $location1 = $location->location1 ?? "Location1";
    $location2 = $location->location2 ?? "Location2";
    $location3 = $location->location3 ?? "Location3";
    $location4 = $location->location4 ?? "Location4";
    }
  ?>

    <div class="mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
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
                <h1 class="card-title text-center">{{ $location2 ?? "Location2"}} {{__(' List')}} </h1>

                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if($add_permission == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#" type="button" data-toggle="modal" data-target="#editLocationModal"><span class="icon icon-edit"> </span>Edit Label</a></li>
                    <li><a href="#">List - {{ $location2 ?? "Location2"}}  </a></li>
                </ol>

            </div>
        </div>
        {{-- <div class="d-flex flex-row mt-3">

            @if($delete_permission == 'Yes')
            <div class="ml-2">
                <form method="post" action="{{route('bulk-delete-areas')}}" id="sample_form" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}"
                        class="form-check-input">
                    <input type="submit" class="btn btn-danger" value="{{__('Bulk Delete')}}" />
                </form>
            </div>
            @endif

        </div> --}}

        <div id="addDepartmentModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ $location2 ?? "Location2"}}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{route('add-areas')}}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">



                                <div class="col-md-12 form-group">
                                    <label> {{ $location1 ?? "Location2"}} <span class="text-danger">*</span></label>

                                    <select name="region_id" class="form-control selectpicker region"
                                        data-live-search="true" data-live-search-style="begins"
                                        data-dependent="area_name" title="{{__('Selecting Region name')}}...">
                                        @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{$region->region_name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-12">
                                <div class="input-group mb-3">
                                <label>{{ $location2 ?? "Location2"}}<span class="text-danger">*</span></label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="area_name" value="" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">

                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>

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
                        <h5 id="exampleModalLabel" class="modal-title">{{_('Edit Location Label name')}}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('loaction-twos') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="">
                                <div class="col-md-12">
                                <div class="input-group mb-3">
                                <label>{{__('Location Label Name')}} *</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="location2" value="" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button>

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
                        <th>{{__('SL')}}</th>
                        <th> {{ $location1 ?? "Location1"}} {{__(' Name')}} </th>
                        <th> {{ $location2 ?? "Location2"}} {{__(' Name')}} </th>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($areas as $areasValue)
                    <tr>

                        <td>{{$i++}}</td>
                        <td>{{$areasValue->region_name}}</td>
                        <td>{{$areasValue->area_name}}</td>
                        @if($edit_permission == 'Yes' || $delete_permission == 'Yes')
                        <td>

                            @if($edit_permission == 'Yes')
                            <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                data-target="#areaEditModal{{ $areasValue->id }}" data-id="" data-toggle="tooltip" title=" Edit "
                                data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @if($delete_permission == 'Yes')
                            <a href="{{route('delete-areas',['id'=>$areasValue->id])}}"
                                class="btn btn-danger delete-post"  data-toggle="tooltip" title=" Delete "
                                data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            @endif


                        </td>
                        @endif

                    </tr>
                    <!--
                        edit Modal starts from here -->
                    <div id="areaEditModal{{$areasValue->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header" >
                                    <h5 id="exampleModalLabel" class="modal-title">{{_('Edit')}}</h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="{{route('update-areas')}}" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{$areasValue->id}}">
                                            <div class="col-md-12 form-group">
                                                <label> {{ $location1 ?? 'location1' }} <span class="text-danger">*</span></label>
                                                <select name="region_id" class="form-control">
                                                    <option value=""> Plese Select </option>
                                                    @foreach($regions as $region)

                                                    <option value="{{$region->id}}" {{ $areasValue->area_region_id ==
                                                        $region->id ? 'selected' : '' }}>{{$region->region_name}}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                <label> {{ $location2 ?? 'location2' }} <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                                        </div>
                                                        <input type="text" name="area_name" value="{{$areasValue->area_name}}"
                                                    required class="form-control">
                                                    </div>
                                            </div>

                                            <div class="col-sm-12 mt-4">

                                                <input type="submit" name="action_button"
                                                    class="btn btn-grad" value="{{__('Edit')}}" />

                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--
                        edit Modal ends from here -->

                    @endforeach
                </tbody>
            </table>
        </div>
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
