
@extends('back-end.premium.layout.premium-main')
@section('content')

    <section class="main-contant-section">
        <div class="">

            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            @foreach ($errors->all() as $error)
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach

            <div class="card mb-3">
                <div class="card-header with-border">
                    <h1 class="card-title"> Import </h1>
                    <nav aria-label="breadcrumb">
                        <ol id="breadcrumb1">
                            <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                            <li><a href="{{ route('employee-add') }}" ><span class="icon icon-plus"> </span> Download sample File </a></li>
                            <li><a href="{{ route('file-export') }}"> Export All Users </a></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card">

                <div class="content-box">
                    <div class="card-body">
                        <h3 class="card-title">Import CSV file only</h3>
                        <p class="card-text">The first line in downloaded csv file should remain as it is. Please do not change
                            the order of columns in csv file.</p>
                        <p class="card-text">The correct column order must follow the csv file,
                            otherwise you will get an error while importing the csv file.</p>
                        <h6><a href="{{asset('uploads/import-samples/employee-import-sample.xlsx')}}" class="btn btn-success" download> <i
                            class="fa fa-download"></i> Download sample File </a></h6>
                        {{-- <form method="post" action="{{route('import-details')}}" >
                            @csrf
                            <button type="submit" class="btn btn-primary"> {{__('Import Details File')}}</button>
                        </form> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <span class="h4">Import Employees</span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" action="{{route('file-import')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Select File for Upload</label>
                                            <input type="file" name="file" />
                                            <p> <span class="text-muted">.xls, .xslx</span> </p>
                                            <input type="submit" name="upload" class="btn btn-primary" value="Import Employee Data">
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <span class="h4">Export Users</span>
                                </div>
                                <div class="card-body text-center">
                                    <a class="btn btn-success" href="{{ route('file-export') }}">Export All Users</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>







@endsection

