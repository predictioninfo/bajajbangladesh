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
                    <h1 class="card-title text-center"> {{ __('Union List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Union </a></li>
                    </ol>
                </div>
            </div>

        </div>

        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Union') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-union') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Upazila Name</label>

                                        <select name="upazila_id" class="form-control selectpicker" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="up_name" required>
                                            <option value="">Select-a-District</option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->id }}">
                                                    {{ $upazila->up_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Union Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="un_name" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Union Bangla Name</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="un_bn_name" class="form-control" value=""
                                            required>
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

        <!-- Add Modal Ends -->
        <div style="display: flex; justify-content: center;" class="input-group">
            <div class="form-outline">
                <input type="search" id="search" class="form-control" placeholder="Search" />
            </div>
        </div>
        <div class="content-box">
            <div class="table-responsive">
                <table id="existingTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Upazila Name') }}</th>
                            <th>{{ __('Union Name') }}</th>
                            <th>{{ __('Union Bangla Name') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = $unions->currentPage() * $unions->perPage() - $unions->perPage() + 1)

                        @foreach ($unions as $union)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $union->upazila->up_name ?? '' }}</td>
                                <td>{{ $union->un_name }}</td>
                                <td>{{ $union->un_bn_name }}</td>

                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit" data-id="{{ $union->id }}"
                                                data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        @endif

                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-union', ['id' => $union->id]) }}"
                                                onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger delete-post" data-toggle="tooltip" title=""
                                                data-original-title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="resultsTable"></div>
        </div>

        <div id="pagination" style="display: flex; justify-content: flex-end;">
            {{ $unions->links() }}
        </div>
    </section>


    
    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-union') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Upzila Name</label>
                                <div class="input-group-prepend">

                                </div>
                                <select name="upazila_id" id="upazila_id" class="form-control" required>
                                    <option value="">Select-a-Upzila</option>
                                    @foreach ($upazilas as $upazila)
                                        <option value="{{ $upazila->id }}">
                                            {{ $upazila->up_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Union Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="un_name" id="un_name" class="form-control"
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Union Bangla Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="un_bn_name" id="un_bn_name" class="form-control"
                                    value="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad">Save changes
                            </button>
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
                    url: 'union-type-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#upazila_id').val(res.upazila_id);
                        $('#un_name').val(res.un_name);
                        $('#un_bn_name').val(res.un_bn_name);
                    }
                });
            });

            // value retriving and opening the edit modal ends
            $('#search').keyup(function() {
                var searchText = $(this).val();
                if (searchText === '') {
                    $('#existingTable').show();
                    $('#pagination').show();
                    $('#resultsTable').hide();
                    return; // Exit the function early when no search text is entered
                }
                var i = 1;
                $.ajax({
                    url: '{{ route('search-route-for-unions') }}',
                    method: 'POST',
                    data: {
                        search: searchText
                    },
                    success: function(response) {
                        $('#existingTable').hide();
                        $('#pagination').hide();

                        // Create a new table for the search results
                        var newTable = $('<table>').addClass('resultTable');

                        // Create the table header
                        var headerRow = $('<tr>');
                        headerRow.append($('<th>').text('SL'));
                        headerRow.append($('<th>').text('Upazila Name'));
                        headerRow.append($('<th>').text('Union Name'));
                        headerRow.append($('<th>').text('Union Bengali Name'));
                        headerRow.append($('<th>').text('Action'));
                        newTable.append(headerRow);

                        // Iterate over the response and populate the new table
                        var i = 1; // Initialize 'i' to 1
                        $.each(response.unions, function(index, union) {
                            console.log(response);
                            var row = $('<tr>');
                            row.append($('<td>').text(
                                i++)); // Increment 'i' and display in the 'SL' column
                            row.append($('<td>').text(union.upazila ? union.upazila
                                .up_name : ''));
                            row.append($('<td>').text(union.un_name));
                            row.append($('<td>').text(union.un_bn_name));

                            var buttonCell = $('<td>');

                            // Add edit button
                            if (response.edit_permission == 'Yes') {
                                var editButton = $('<a>')
                                    .attr('href', 'javascript:void(0)')
                                    .addClass('btn edit')
                                    .attr('data-id', union.id)
                                    .attr('data-toggle', 'tooltip')
                                    .attr('title', 'Edit')
                                    .click(function() {
                                        var id = $(this).data('id');
                                        $.ajax({
                                            type: "POST",
                                            url: 'union-type-by-id',
                                            data: {
                                                id: id
                                            },
                                            dataType: 'json',
                                            success: function(res) {
                                                console.log(res);
                                                $('#ajaxModelTitle')
                                                    .html("Edit");
                                                $('#edit-modal').modal(
                                                    'show');
                                                $('#id').val(res.id);
                                                $('#upazila_id').val(res
                                                    .upazila_id);
                                                $('#un_name').val(res
                                                    .un_name);
                                                $('#un_bn_name').val(res
                                                    .un_bn_name);
                                            }
                                        });
                                    });

                                var editIcon = $('<i>').addClass(
                                    'fa fa-pencil-square-o').attr('aria-hidden',
                                    'true');
                                editButton.append(editIcon);
                                buttonCell.append(editButton);
                            }
                            if (response.edit_permission === 'Yes') {
                                // Add delete button
                                var deleteButton = $('<a>')
                                    .attr('href', 'union/delete/' + union.id)
                                    .attr('onclick', 'return confirm("Are you sure?")')
                                    .addClass('btn btn-danger delete-post')
                                    .attr('data-toggle', 'tooltip')
                                    .attr('title', 'Delete');

                                var deleteIcon = $('<i>').addClass('fa fa-trash');

                                deleteButton.append(deleteIcon);
                                buttonCell.append(deleteButton);
                            }


                            row.append(buttonCell);
                            newTable.append(row);
                        });


                        // Replace the existing table with the new table
                        $('#resultsTable').html(newTable);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>
@endsection
