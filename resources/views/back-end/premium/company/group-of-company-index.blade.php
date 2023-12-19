@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
use App\Models\Company;
use App\Models\User;
?>
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

        <div class="card mb-4">
            <div class="card-header with-border">
                <h1 class="card-title"> {{__('Company List')}} </h1>
                <nav aria-label="breadcrumb">

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span class="icon icon-plus"> </span>Add</a></li>
                        <li><a href="#">List - Company   </a></li>
                    </ol>

                </nav>
            </div>
        </div>

    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{_('Add Company')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form action="{{route('add-sister-concerns')}}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Logo</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="company_logo" required value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Bangla Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_name_bangla">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Email</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Password</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="password" class="form-control" required name="company_password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Phone</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-volume-control-phone" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Address</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Web Address</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-firefox" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_web_address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label class="col-sm-12 col-form-label">Employee ID Prefix</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-id-card-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control"  name="employee_id_prefix">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">City</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_city">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Country</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" required name="company_country">
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-grad" id="btn-save"> <i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal Ends -->
<div class="content-box container-fluid">

<div class="table-responsive">
        <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>{{__('SL')}}</th>
                    <th>{{__('Company Name')}}</th>
                    <th>{{__('Company Email')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Address')}}</th>
                    <th>{{__('Employee ID Prefix')}}</th>
                    <th>{{__('Active Employee')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($companies as $companies_value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$companies_value->company_name ?? ''}}</td>
                    <td>{{$companies_value->company_email ?? ''}}</td>
                    <td>{{$companies_value->company_phone ?? ''}}</td>
                    <td>{{$companies_value->company_address ?? ''}}</td>
                    <td>{{$companies_value->employee_id_prefix ?? ''}}</td>
                    <td>
                        <?php $total_employees = User::where('com_id', $companies_value->id)->where('is_active',1)->count(); ?>
                        {{ $total_employees }}
                    </td>
                    <td>
                    <a href="javascript:void(0)" class="btn edit" data-id="{{$companies_value->id}}" data-toggle="tooltip" title=" Edit "
                                                        data-original-title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                    <a href="{{route('delete-companies',['id'=>$companies_value->id])}}" class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                                        data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>

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
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                    class="dripicons-cross"></i></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('update-companies') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">


                    <div class="row">

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Logo</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="company_logo" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_name" id="company_name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Bangla Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_name_bangla" id="company_name_bangla">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Email</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_email" id="company_email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Password</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-key" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="password" class="form-control" name="company_password"
                                    id="edit_company_password">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Phone</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-volume-control-phone" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_phone" id="company_phone">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Address</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_address" id="company_address">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Company Web Address</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-firefox" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_web_address" id="company_web_address">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Employee ID Prefix</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-id-card-o" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="employee_id_prefix" id="employee_id_prefix">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">City</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_city" id="company_city">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <label for="staticEmail" class="col-sm-12 col-form-label">Country</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="company_country" id="company_country">
                                </div>
                            </div>
                        <div class="col-md-12 mt-4">
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


        //value retriving and opening the edit modal starts

        $('.edit').on('click', function () {
                        var id = $(this).data('id');

                        $.ajax({
                            type:"POST",
                            url: 'company-by-id',
                            data: { id: id },
                            dataType: 'json',
                            success: function(res){
                            $('#ajaxModelTitle').html("Edit");
                            $('#edit-modal').modal('show');
                            $('#id').val(res.id);
                            $('#company_name').val(res.company_name);
                            $('#company_name_bangla').val(res.company_name_bangla);
                            $('#company_email').val(res.company_email);
                            $('#company_phone').val(res.company_phone);
                            $('#company_address').val(res.company_address);
                            $('#company_web_address').val(res.company_web_address);
                            $('#company_city').val(res.company_city);
                            $('#edit_company_password').val(res.company_password);
                            $('#employee_id_prefix').val(res.employee_id_prefix);
                            $('#company_country').val(res.company_country);
                        }
                        });
                    });

                //value retriving and opening the edit modal ends

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


                    // edit form submission starts

                $('#edit_form').submit(function(e) {
                        e.preventDefault();
                        let formData = new FormData(this);
                        console.log(formData);
                        $('#error-message').text('');

                        $.ajax({
                            type:'POST',
                            url: `/update-company`,
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: (response) => {

                                toastr.success(response.success,'Data successfully updated!!');
                            },
                            error: function(response){
                                toastr.error(response.error,'Please Entry Valid Data!!');
                                // console.log(response);
                                //     $('#error-message').text(response.responseJSON.errors);
                            }
                        });
                    });


                    // edit form submission ends

  } );


</script>



@endsection
