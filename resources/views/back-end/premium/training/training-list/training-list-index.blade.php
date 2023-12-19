@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\TrainingType;
    ?>
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

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
                    <h1 class="card-title text-center"> {{ __('Trainnig List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                        <li><a href="#">List - {{ 'Trainnig List' }} </a></li>
                    </ol>
                </div>
            </div>

        </div>

        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Training') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-training-lists') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Training Type</label>
                                    <select name="training_tring_typ_id" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Training Type'>
                                        @foreach ($training_types as $training_types_value)
                                            <option value="{{ $training_types_value->id }}">
                                                {{ $training_types_value->training_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Trainer</label>
                                    <select name="training_trainer_id[]" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Trainer' multiple>
                                        @foreach ($trainers as $trainers_value)
                                            <option
                                                value="{{ $trainers_value->id }}"data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $trainers_value->profile_photo }}'>">
                                                {{ $trainers_value->trainer_first_name . ' ' . $trainers_value->trainer_last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Employee</label>
                                    <select name="training_emp_id[]" class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="begins" title='Employee' multiple>
                                        @foreach ($employees as $employees_value)
                                            <option
                                                value="{{ $employees_value->id }}"data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $employees_value->profile_photo }}'>">
                                                {{ $employees_value->first_name . ' ' . $employees_value->last_name }}({{ $employees_value->company_assigned_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Start Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="training_start_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>End Date</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="training_end_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Start Time</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="time" name="training_start_time" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>End Time</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="time" name="training_end_time" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Training Cost</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-expand"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="training_cost" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <label>Document</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="file" name="training_attachmnt" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="my-textarea">Description</label>
                                    <textarea class="form-control" name="training_desc" rows="3"></textarea>
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
                            <th>{{ __('Training Type') }}</th>
                            <th>{{ __('Trainer Name') }}</th>
                            <th>{{ __('Employee Name') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Start Time') }}</th>
                            <th>{{ __('End Time') }}</th>
                            <th>{{ __('Training Cost') }}</th>
                            <th>{{ __('Training Attachment') }}</th>
                            <th>{{ __('Training Description') }}</th>
                            <th>{{ __('Training Status') }}</th>
                            <th>{{ __('Action') }}</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php($i = 1)
                        @foreach ($trainings as $trainings_value)
                            <tr>
                                <td>{{ $i++ }}</td>

                                <?php
                                $trainingType = TrainingType::where('id', $trainings_value->training_tring_typ_id)->get(['training_type']);
                                ?>

                                <td><?php foreach ($trainingType as $trainingType_value) {
                                    echo $trainingType_value->training_type;
                                } ?></td>
                                <td>
                                    @foreach ($trainers as $trainers_value)
                                        @foreach (json_decode($trainings_value->training_trainer_id) as $trainer_indivisual_id)
                                            @if ($trainer_indivisual_id == $trainers_value->id)
                                                {{ $trainers_value->trainer_first_name }},
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($employees as $employees_value)
                                        @foreach (json_decode($trainings_value->training_emp_id) as $employee_indivisual_id)
                                            @if ($employee_indivisual_id == $employees_value->id)
                                                {{ $employees_value->first_name }},
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>{{ $trainings_value->training_start_date }}</td>
                                <td>{{ $trainings_value->training_end_date }}</td>
                                <td>{{ $trainings_value->training_start_time }}</td>
                                <td>{{ $trainings_value->training_end_time }}</td>
                                <td>{{ $trainings_value->training_cost }}</td>
                                <td class="text-center"><a href="{{ asset($trainings_value->training_attachmnt) }}"
                                        download>Download</a></td>
                                <td>{{ $trainings_value->training_desc }}</td>
                                <td>{{ $trainings_value->training_status }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $trainings_value->id }}" data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                    <a href="{{ route('delete-training-lists', ['id' => $trainings_value->id]) }}"
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
                    <form method="post" action="{{ route('update-training-lists') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="training_status" id="training_status">
                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label>Training Type</label>
                                <select name="training_tring_typ_id" class="form-control selectpicker"
                                    data-live-search="true" data-live-search-style="begins" title='Training Type'>
                                    @foreach ($training_types as $training_types_value)
                                        <option value="{{ $training_types_value->id }}">
                                            {{ $training_types_value->training_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Trainer</label>
                                <select name="training_trainer_id[]" class="form-control selectpicker"
                                    data-live-search="true" data-live-search-style="begins" title='Trainer' multiple>
                                    @foreach ($trainers as $trainers_value)
                                        <option
                                            value="{{ $trainers_value->id }}"data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $trainers_value->profile_photo }}'>">
                                            {{ $trainers_value->trainer_first_name . ' ' . $trainers_value->trainer_last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Employee</label>
                                <select name="training_emp_id[]" class="form-control selectpicker"
                                    data-live-search="true" data-live-search-style="begins" title='Employee' multiple>
                                    @foreach ($employees as $employees_value)
                                        <option
                                            value="{{ $employees_value->id }}"data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $employees_value->profile_photo }}'>">
                                            {{ $employees_value->first_name . ' ' . $employees_value->last_name }}({{ $employees_value->company_assigned_id }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Start Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="training_start_date" id="training_start_date"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>End Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="training_end_date" id="training_end_date"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Start Time</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="training_start_time" id="training_start_time"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>End Time</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="time" name="training_end_time" id="training_end_time"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Training Cost</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-expand" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="training_cost" id="training_cost" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label>Document</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-picture-o"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="file" name="training_attachmnt" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="my-textarea">Description</label>
                                <textarea class="form-control" name="training_desc" id="training_desc" rows="3"></textarea>
                            </div>


                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad ">Save changes</button>
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
                    url: 'training-list-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#training_start_date').val(res.training_start_date);
                        $('#training_end_date').val(res.training_end_date);
                        $('#training_start_time').val(res.training_start_time);
                        $('#training_end_time').val(res.training_end_time);
                        $('#training_cost').val(res.training_cost);
                        $('#training_desc').val(res.training_desc);
                        $('#training_status').val(res.training_status);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            //   $('#edit_form').submit(function(e) {
            //         e.preventDefault();
            //         let formData = new FormData(this);
            //         console.log(formData);
            //         $('#error-message').text('');

            //         $.ajax({
            //             type:'POST',
            //             url: `/update-support-ticket`,
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             success: (response) => {
            //                 window.location.reload();
            //                 if (response) {
            //                 this.reset();
            //                 alert('Data has been updated successfully');
            //                 }
            //             },
            //             error: function(response){
            //                 console.log(response);
            //                     $('#error-message').text(response.responseJSON.errors.file);
            //             }
            //         });
            //     });

            // edit form submission ends






            var date = new Date();
            date.setDate(date.getDate());

            $('.date').datepicker({
                startDate: date
            });






        });
    </script>
@endsection
