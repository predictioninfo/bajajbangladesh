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
        </div>
        @if ($add_permission == 'Yes')
            <div class="content-box">
                <div class="card mb-4">
                    <div class="card-header with-border">
                        <h3 class="card-title text-center"> {{ __('Asset Category') }} </h3>
                    </div>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('add-asset-categories') }}">
                                    @csrf
                                    <div class="row" style="align-items: end;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">{{ __('Asset Category Name') }}</label>
                                                <input class="form-control" name="asset_category_name" type="text"
                                                    required value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-grad"><i class="fa fa-plus"></i>
                                                        {{ __('Add') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @if ($delete_permission == 'Yes')
                                    <form method="post" action="{{ route('bulk-delete-asset-categories') }}"
                                        id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="bulk_delete_asset_category_com_id"
                                            value="{{ Auth::user()->com_id }}" class="form-check-input">
                                        <input type="submit" class="btn btn-danger" value="{{ __('Bulk Delete') }}" />
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Asset Category Name') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($asset_categories as $asset_categories_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $asset_categories_value->asset_category_name }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                        <a href="javascript:void(0)" class="btn edit"
                                        data-id="{{ $asset_categories_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                        <a href="{{ route('delete-asset-categories', ['id' => $asset_categories_value->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        @endif
                                        
                                    </td>
                                @endif
                            </tr>
                        @endforeach



                    </tbody>

                </table>

            </div>
        </div>
    </section>




    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-asset-categories') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="start_date">{{ __('Asset Category Name') }}</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="asset_category_name" id="asset_category_name"
                                        type="text" required value="">
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

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


            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'asset-category-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#asset_category_name').val(res.asset_category_name);
                    }
                });
            });

            //value retriving and opening the edit modal ends
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
