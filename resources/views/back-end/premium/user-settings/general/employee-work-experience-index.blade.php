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
                <h1 class="card-title text-center"> {{ __('Work Experience List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                    <li><a href="#">List - Work Experience </a></li>
                </ol>
            </div>
        </div>

        <div id="addDepartmentModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{_('Add Work Experience')}}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{route('add-work-experience-employees')}}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>Comapany Name:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="work_experience_company_name" class="form-control date"
                                        value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>Total Year of Experience:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="total_year_of_experience" class="form-control date"
                                        value="">
                                    </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>From:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="work_experience_from_date" class="form-control date"
                                        value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>To:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="work_experience_to_date" class="form-control date"
                                        value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>Position:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-podcast" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="work_experience_post" class="form-control date" value="">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Description:</label>
                                    <textarea class="form-control" name="work_experience_desc" rows="5"></textarea>

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
                        <th>{{__('Company Name')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('Position')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Total Year of Experience')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @php($i=1)
                    @foreach($work_experience_details as $work_experience_details_value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$work_experience_details_value->work_experience_company_name}}</td>
                        <td>{{$work_experience_details_value->work_experience_from_date}}</td>
                        <td>{{$work_experience_details_value->work_experience_to_date}}</td>
                        <td>{{$work_experience_details_value->work_experience_post}}</td>
                        <td>{{$work_experience_details_value->work_experience_desc}}</td>
                        <td>{{$work_experience_details_value->total_year_of_experience}}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn edit"
                                data-id="{{$work_experience_details_value->id}}" data-toggle="tooltip"
                                title="" data-original-title=" Edit "> <i class="fa fa-pencil-square-o" aria-hidden="true" ></i> </a>
                            <a href="{{route('delete-employee-work-experiences',['id'=>$work_experience_details_value->id])}}"
                                class="btn delete btn-danger delete-post"data-toggle="tooltip" title=""
                                data-original-title=" Delete "><i class="fa fa-trash-o"
                                aria-hidden="true"></i> </a>
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
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>Comapany Name:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="work_experience_company_name" id="work_experience_company_name"
                                class="form-control date" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>Total Year of Experience:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="total_year_of_experience" id="total_year_of_experience"
                                class="form-control date" value="">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>From:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="work_experience_from_date" id="work_experience_from_date"
                                class="form-control date" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>To:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="date" name="work_experience_to_date" id="work_experience_to_date"
                                class="form-control date" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                    <label>Position:</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-podcast" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="work_experience_post" id="work_experience_post"
                                class="form-control date" value="">
                                    </div>
                                </div>

                        <div class="col-md-4 form-group">
                            <label>Description:</label>
                            <textarea class="form-control" name="work_experience_desc" id="work_experience_desc"
                                rows="5"></textarea>
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
                    url: 'employee-work-experience-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#work_experience_company_name').val(res.work_experience_company_name);
                    $('#total_year_of_experience').val(res.total_year_of_experience);
                    $('#work_experience_from_date').val(res.work_experience_from_date);
                    $('#work_experience_to_date').val(res.work_experience_to_date);
                    $('#work_experience_post').val(res.work_experience_post);
                    $('#work_experience_desc').val(res.work_experience_desc);
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
                    url: `/update-employee-work-experience`,
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
