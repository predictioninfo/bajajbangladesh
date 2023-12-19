@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\User;
    use App\Models\Project;
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
                    <h1 class="card-title text-center"> {{ __('Task List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - {{ 'Task List' }} </a></li>
                    </ol>
                </div>
            </div>

            {{-- <div class="d-flex flex-row mt-3">
                @if ($delete_permission == 'Yes')
                <div class="p-1">
                    <form method="post" action="{{route('bulk-delete-tasks')}}" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="bulk_delete_com_id" value="{{Auth::user()->com_id}}" class="form-check-input">
                        <input type="submit" class="btn btn-danger w-100" value="{{__('Bulk Delete')}}" />
                    </form>
                </div>
                @endif
            </div> --}}


        </div>


        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Task') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-tasks') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label>Title</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-text-height"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="task_title" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Start Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="task_start_date" placeholder="10" class="form-control"
                                            value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>End Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="task_end_date" placeholder="10" class="form-control"
                                            value="">
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Project</label>
                                    <select name="task_project_id" class="form-control" required>
                                        @foreach ($projects as $projects_value)
                                            <option value="{{ $projects_value->id }}">{{ $projects_value->project_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Assigning to</label>
                                    <select id="assign_to" name="task_assigned_to[]" class="form-control"
                                        multiple="multiple" required>
                                        @foreach ($employees as $employees_value)
                                            <option value="{{ $employees_value->id }}">{{ $employees_value->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Estimated Hours</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="task_estimated_hour" placeholder="10"
                                            class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Task Progress</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-percent"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="task_progress" placeholder="10%"
                                            class="form-control" value="">
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
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Project Name') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Assigned To') }}</th>
                            <th>{{ __('Estimated Hours') }}</th>
                            <th>{{ __('Assigned By') }}</th>
                            <th>{{ __('Task Progress') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($tasks as $tasks_value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $tasks_value->task_title }}</td>
                                <td>
                                    <?php
                                    $projects = Project::where('id', $tasks_value->task_project_id)->get(['project_name']);
                                    foreach ($projects as $projects_data) {
                                        echo $projects_data->project_name;
                                    }
                                    ?>
                                </td>
                                <td>{{ $tasks_value->task_start_date }}</td>
                                <td>{{ $tasks_value->task_end_date }}</td>
                                <td>
                                    @foreach (json_decode($tasks_value->task_assigned_to) as $test)
                                        <?php
                                        $users = User::where('id', $test)->get(['first_name', 'last_name']);
                                        foreach ($users as $users_data) {
                                            echo $users_data->first_name . ' ' . $users_data->last_name . '<br>';
                                        }
                                        ?>
                                    @endforeach
                                </td>
                                <td>{{ $tasks_value->task_estimated_hour }}</td>
                                <td>
                                    <?php
                                    $users = User::where('id', $tasks_value->task_assigned_by)->get(['first_name', 'last_name']);
                                    foreach ($users as $users_data) {
                                        echo $users_data->first_name . ' ' . $users_data->last_name . '<br>';
                                    }
                                    ?>
                                </td>
                                <td>{{ $tasks_value->task_progress }}</td>
                                <td>
                                    
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $tasks_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="{{ route('delete-tasks', ['id' => $tasks_value->id]) }}"
                                                class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                data-original-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                       

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </section>

    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label>Title</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-text-height"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="task_title" id="task_title" class="form-control"
                                        value="">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Start Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="task_start_date" id="task_start_date" placeholder="10"
                                        class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>End Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="task_end_date" id="task_end_date" placeholder="10"
                                        class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Project</label>
                                <select name="task_project_id" class="form-control">
                                    @foreach ($projects as $projects_value)
                                        <option value="{{ $projects_value->id }}">{{ $projects_value->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Assigning to</label>
                                <select id="edit_assign_to" name="task_assigned_to[]" class="form-control"
                                    multiple="multiple">
                                    @foreach ($employees as $employees_value)
                                        <option value="{{ $employees_value->id }}">{{ $employees_value->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Estimated Hours</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="task_estimated_hour" id="task_estimated_hour"
                                        placeholder="10" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Task Progress</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-percent" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="task_progress" id="task_progress" placeholder="10%"
                                        class="form-control" value="">
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





            //value retriving and opening the edit modal starts

            $('.edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'task-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#task_title').val(res.task_title);
                        $('#task_start_date').val(res.task_start_date);
                        $('#task_end_date').val(res.task_end_date);
                        $('#edit_assign_to').val(res.task_assigned_to);
                        $('#task_estimated_hour').val(res.task_estimated_hour);
                        $('#task_progress').val(res.task_progress);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-task`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                            this.reset();
                            alert('Data has been updated successfully');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends



            ///MULTIPLE EMPLOYEE SELECT OPTION CODE STARTS FROM HERE
            $("#assign_to").select2({
                placeholder: "Select a Name",
                allowClear: true,
                tags: true
            });

            $("#edit_assign_to").select2({
                placeholder: "Select a Name",
                allowClear: true,
                tags: true
            });

            ///MULTIPLE EMPLOYEE SELECT OPTION CODE ENDS HERE




        });
    </script>
@endsection
