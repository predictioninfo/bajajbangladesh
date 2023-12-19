
@extends('back-end.premium.layout.premium-main')

@section('content')

    <section class="main-contant-section">


        <div class="mt-5">

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
                    <h1 class="card-title"> {{ __('Company Info' ) }} </h1>
                    <nav aria-label="breadcrumb">

                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="#">Company Info  </a></li>
                        </ol>

                    </nav>
                </div>
            </div>

        @foreach($companies as $companiesValue)
<div class="content-box">


<form action="{{route('company-updates')}}" method="post" class="form-horizontal row" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{$companiesValue->com_id}}">

                <div class="form-group col-md-4">
                    <label for="staticEmail" class="col-form-label">Company Logo</label>
                    <div class="row">
                    <div class="col-md-4">
                    <img class="rounded" width="50" src="{{$companiesValue->company_logo}}">
                    </div>
                    <div class="col-md-8">

                    <input type="file" name="company_logo" value="">
                    </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                    <label for="staticEmail" class=" col-form-label">Company Name</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_name" value="{{$companiesValue->company_name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                    <label for="staticEmail" class=" col-form-label">Company Email</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_email" value="{{$companiesValue->email}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                    <label for="staticEmail" class=" col-form-label">Company Password</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                        </div>
                        <input type="password" class="form-control" name="company_password" value="{{$companiesValue->company_password}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                    <label for="staticEmail" class=" col-form-label">Company Phone</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-id-badge" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_phone" value="{{$companiesValue->phone}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                    <label for="staticEmail" class=" col-form-label">Company Address</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_address" value="{{$companiesValue->company_address}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                    <label for="staticEmail" class=" col-form-label">Company Web Address</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-firefox" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_web_address" value="{{$companiesValue->company_web_address}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label for="staticEmail" class=" col-form-label">City</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building-o" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_city" value="{{$companiesValue->company_city}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <label for="staticEmail" class="col-form-label">Country</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-globe" aria-hidden="true"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="company_country" value="{{$companiesValue->company_country}}">
                    </div>
                </div>

                <div class="form-group col-md-12 mt-4">
                    <button type="submit" class="btn btn-grad " id="btn-save">Edit</button>
                </div>
            </form>

</div>
        @endforeach

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
