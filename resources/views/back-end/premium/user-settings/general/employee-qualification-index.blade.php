
@extends('back-end.premium.layout.employee-setting-main')

@section('content')

    <section class="main-contant-section">


        <div class=" mb-3">

            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif


           <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Qualification List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                    <li><a href="#">List - Qualification </a></li>
                </ol>
            </div>
        </div>

           <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Qualification')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-qualification-employees')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                        <label>Institute Name:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_institute_name" class="form-control date" value="">
                                        </div>
                                    </div>

                                   <div class="col-md-6 form-group">
                                        <label for="exampleFormControlSelect1">Education Level</label>
                                        <select class="form-control" name="qualification_education_level">
                                        <option value="">Select A Level</option>
                                        @foreach($qualification_methods as $qualification_methods_value)
                                        <option value="{{$qualification_methods_value->variable_method_name}}">{{$qualification_methods_value->variable_method_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>From:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="qualification_from_date" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>To:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="qualification_to_date" class="form-control date" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Language Version:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-language" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_language_version" class="form-control date" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                        <label>Skill:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-slideshare" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_skill" class="form-control date" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Description:</label>
                                        <textarea class="form-control" name="qualification_description" rows="5"></textarea>
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
                        <th>{{__('Institute Name')}}</th>
                        <th>{{__('Education Level')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('Language Version')}}</th>
                        <th>{{__('Skill')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @php($i=1)
                        @foreach($qualification_details as $qualification_details_value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$qualification_details_value->qualification_institute_name}}</td>
                            <td>{{$qualification_details_value->qualification_education_level}}</td>
                            <td>{{$qualification_details_value->qualification_from_date}}</td>
                            <td>{{$qualification_details_value->qualification_to_date}}</td>
                            <td>{{$qualification_details_value->qualification_language_version}}</td>
                            <td>{{$qualification_details_value->qualification_skill}}</td>
                            <td>{{$qualification_details_value->qualification_description}}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn edit" data-id="{{$qualification_details_value->id}}" data-toggle="tooltip"
                                    title="" data-original-title=" Edit "> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                <a href="{{route('delete-employee-qualifications',['id'=>$qualification_details_value->id])}}" class="btn btn-danger delete delete-post" data-toggle="tooltip" title=""
                                    data-original-title=" Delete " > <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                        </tr>
                        @endforeach



                    </tbody>

                </table>
            </div>
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
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                <label>Institute Name:</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" name="qualification_institute_name" id="qualification_institute_name" class="form-control date" value="">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="exampleFormControlSelect1">Education Level</label>
                                <select class="form-control" name="qualification_education_level" id="qualification_education_level">
                                <option>Select A Level</option>
                                <option value="Msc">Msc</option>
                                <option value="MBA">MBA</option>
                                <option value="MCom">MCom</option>
                                <option value="Bsc">Bsc</option>
                                <option value="BBA">BBA</option>
                                <option value="BCom">BCom</option>
                                <option value="JSC">JSC</option>
                                <option value="JSC">JSC</option>
                                <option value="JSC">JSC</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>From:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_from_date" id="qualification_from_date" class="form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>To:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_to_date" id="qualification_to_date" class="form-control date" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Language Version:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-language" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_language_version" id="qualification_language_version" class="form-control date" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                        <label>Skill:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-slideshare" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="qualification_skill" id="qualification_skill" class="form-control date" value="">
                                        </div>
                                    </div>

                            <div class="col-md-6 form-group">
                                <label>Description:</label>
                                <textarea class="form-control" name="qualification_description" id="qualification_description" rows="5"></textarea>
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

      $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $('#user-table').DataTable({

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





             //value retriving and opening the edit modal starts

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'employee-qualification-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#qualification_institute_name').val(res.qualification_institute_name);
                    $('#qualification_education_level').val(res.qualification_education_level);
                    $('#qualification_from_date').val(res.qualification_from_date);
                    $('#qualification_to_date').val(res.qualification_to_date);
                    $('#qualification_language_version').val(res.qualification_language_version);
                    $('#qualification_skill').val(res.qualification_skill);
                    $('#qualification_description').val(res.qualification_description);
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
                    type:'POST',
                    url: `/update-employee-qualification`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                    toastr.success(response.success, 'Data successfully updated!!');
                    window.location.reload(true);
                    },
                    error: function(response){
                        toastr.error(response.error, 'Please Entry Valid Data!!');
                    }
                });
            });

            // edit form submission ends





   });

    </script>
@endsection
