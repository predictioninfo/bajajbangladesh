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

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Company Policy List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Company Policy </a></li>
                    </ol>
                </div>
            </div>


        </div>

        <div id="addDepartmentModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Policy') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-company-policy') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <input type="hidden" name="id" value="">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>{{ __('Title') }} *</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-newspaper-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="policy_title" value="" required
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="my-textarea">Description</label>
                                    <textarea class="form-control" name="policy_desc"></textarea>
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
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Policy Added By') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($company_policies as $company_policiesValue)
                            <tr>

                                <td>{{ $i++ }}</td>

                                <td>{{ $company_policiesValue->policy_title }}</td>
                                <td>{{ $company_policiesValue->policy_desc }}</td>
                                <td>{{ $company_policiesValue->first_name . ' ' . $company_policiesValue->last_name }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>

                                                @if ($edit_permission == 'Yes')
                                                    <a href="#" id="edit-post"  data-toggle="modal"
                                                        data-target="#policyEditModal{{ $company_policiesValue->id }}" class="btn edit" data-id="" data-toggle="tooltip" title=" Edit "
                                                        data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                         @endif
                                                @if ($delete_permission == 'Yes')
                                                    <a href="{{ route('delete-company-policy', ['id' => $company_policiesValue->id]) }}"
                                                        class="btn btn-danger delete-post"  data-toggle="tooltip" title=" Delete "
                                                        data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                @endif

                                    </td>
                                @endif

                            </tr>

                            <div id="policyEditModal{{ $company_policiesValue->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}</h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                                class="close"><i class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" action="{{ route('update-company-policy') }}"
                                                class="form-horizontal" enctype="multipart/form-data">

                                                @csrf
                                                <div class="row">

                                                    <input type="hidden" name="id"
                                                        value="{{ $company_policiesValue->id }}">

                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <label>{{ __('Title') }} *</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i
                                                                        class="fa fa-newspaper-o" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="policy_title" value="{{ $company_policiesValue->policy_title }} "
                                                                required class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label for="my-textarea">Description</label>
                                                        <textarea id="my-textarea" class="form-control" name="policy_desc" rows="5">{{ $company_policiesValue->policy_desc }}</textarea>
                                                    </div>

                                                    <div class="col-sm-12 mt-4">

                                                        <input type="submit" name="action_button" class="btn btn-grad"
                                                            value="{{ __('Edit') }}" />

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
