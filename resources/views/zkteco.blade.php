
@extends('back-end.premium.layout.premium-main')
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

            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{__('Finger List')}} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>


                        <li><a href="#">List - Finger </a></li>
                    </ol>
                </div>
            </div>

        </div>


         <div class="content-box">

         <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>IN TIME</th>
                        <th>OUT TIME</th>

                    </tr>
                </thead>
                <tbody>
                        @php($i=1)

                        @foreach($data->data as $response)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$response->emp_code}}</td>
                          <td>{{$response->first_name}} {{$response->last_name}}</td>
                          <td>{{$response->punch_time}}</td>
                          <td>{{$response->punch_state}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </section>


@endsection

