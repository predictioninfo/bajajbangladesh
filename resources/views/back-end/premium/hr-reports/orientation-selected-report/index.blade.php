@extends('back-end.premium.layout.premium-main')

@section('content')


<section class="main-contant-section">

    <div class=""><span id="general_result"></span></div>

    <div class="">
        <div class="card mb-0">

            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Orientation Selected  Report') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li> <a href="{{ route('orientation-selected-download-reports') }}"><span class="fa fa-arrow-down"> Excel Download</span></a></li>
                        <li><a href="#">{{ 'Orientation Selected Report' }} </a></li>
                    </ol>
                </div>


        </div>
    </div>

    <div class="content-box">

        <h2>hellooo ;.....</h2>
    </div>
</section>



@endsection
