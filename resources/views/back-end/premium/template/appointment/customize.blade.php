@extends('back-end.premium.layout.premium-main')
@section('content')
<div class="">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        #option {
            width: 100%;
            padding: 50px 0;
            text-align: center;
            /* background-color: lightblue; */
            margin-top: 20px;
        }

        #draggable1 {
            width: 150px;
            height: 50px;
            padding: 0.5em;
        }

        #draggable2 {
            width: 150px;
            height: 30px;
            padding: 0.5em;
        }

        #draggable3 {
            width: 150px;
            height: 30px;
            padding: 0.5em;
        }

        #draggable4 {
            width: 150px;
            height: 50px;
            padding: 0.5em;
        }

        #draggable5 {
            width: 150px;
            height: 50px;
            padding: 0.5em;
        }

        #draggable6 {
            width: 150px;
            height: 60px;
            padding: 0.5em;
        }

        #draggable7 {
            width: 150px;
            height: 60px;
            padding: 0.5em;
        }

        #draggable8 {
            width: 150px;
            height: 60px;
            padding: 0.5em;
        }
    </style>

    <script>
        $( function() {
        $( "#draggable1" ).draggable().removeClass();
        $( "#draggable2" ).draggable().resizable();
        $( "#draggable3" ).draggable().resizable()
        $( "#draggable4" ).draggable().resizable();
        $( "#draggable5" ).draggable().resizable();
        $( "#draggable6" ).draggable().resizable();
        $( "#draggable7" ).draggable().resizable();
        $( "#draggable8" ).draggable().resizable();
        $( "#draggable9" ).draggable().resizable();
        $( "#draggable10" ).draggable().resizable();
        $( "#draggable11" ).draggable().resizable();
        $( "#draggable12" ).draggable().resizable();
        $( "#draggable13" ).draggable().resizable();
        $( "#draggable14" ).draggable().resizable();
        $( "#draggable15" ).draggable().resizable();
  } );
    </script>
</div>
<section class="main-contant-section">
    <section class="forms content-box">
        <div class="employee-basic-information">
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
            <button onclick="myFunction()">More Options</button>
            <div id="option">
                {{-- @foreach($employees as $key => $employee) --}}
                {{-- <div class="col-md-12" id="draggable3" class="ui-widget-content">
                    <label for="">Date {{ $employee_info->joining_date
                        }}</label>
                </div>
                <div class="col-md-12" id="draggable2" class="ui-widget-content">
                    <label for="">Employee Name {{ $employee_info->first_name}} {{
                        $employee_info->last_name}}</label>
                </div>
                <div class="col-md-12" id="draggable4" class="ui-widget-content">
                    <label for="">Employee Id {{ $employee_info->company_assigned_id}}</label>
                </div>
                <div class="col-md-12" id="draggable6" class="ui-widget-content">
                    <label for="">Department </label>
                </div>
                <div class="col-md-12" id="draggable7" class="ui-widget-content">
                    <label for="">Designation {{ $employee_info->userdesignation->designation_name}}</label>
                </div>
                <div class="col-md-12" id="draggable8" class="ui-widget-content">
                    <label for="">Loaction {{ $employee_info->userdesignation->designation_name}}</label>
                </div>
                <div class="col-md-12" id="draggable9" class="ui-widget-content">
                    <label for="">Salary remunaration</label>
                </div> --}}
                {{-- @endforeach --}}
            </div>
            <div class="card-header mb-10">

                <h1 class="card-title"> {{ __('Appointment Letter Format') }} </h1>
                <nav aria-label="breadcrumb">

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home">
                                </span></a>
                        </li>
                        <li><a href="{{ route('appointment-templates') }}"><span class="icon icon-list">
                                </span> Appointment Letter Format List</a></li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <form method="POST" action="{{ route('appointment-add-customizes') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-div">
                        <div class="col-md-12">
                            <div class="card mb-2 content-box">
                                <input type="hidden" name="id" value="{{ $appointments->id ?? null}}">
                                <div class="row">
                                    <div class="col-md-12" id="draggable11">
                                        <div class="form-group">

                                            Subject : {{ $appointments->appointment_template_subject ?? null}}

                                        </div>
                                    </div>
                                    <div class="col-md-12" id="draggable12">
                                        <div class="form-group">
                                            {{ $appointments->appointment_template_description ?? null }}
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="draggable13">
                                        <img src="{{asset($appointments->appointment_template_signature ?? null)}}"
                                            alt="Signature" style="width:50px;height:20px; padding-left:30px;"><br>
                                        <span
                                            style="background-color:white;color:black;font-weight:bold;">___________________________________</span><br>
                                    </div>
                                    <div class="col-md-12" id="draggable14">
                                        {{ $appointments->AppointmentSignatory->first_name ?? null}}
                                        {{ $appointments->AppointmentSignatory->last_name ?? null}}
                                    </div>
                                    <br>
                                    <div class="col-md-12 text-center" id="draggable15">
                                        {{ $appointments->appointment_template_footer ?? null }}
                                    </div>

                                </div>


                                <div class=" text-left mt-4">

                                    <button type="submit" id="abcd" class="btn btn-grad ladda-button"
                                        data-style="expand-right">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                        <span class="ladda-label">
                                            Save </span><span class="ladda-spinner"></span></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

    </section>
</section>
<div class="">
    <script>
        function myFunction() {
  var x = document.getElementById("option");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
    </script>
</div>
@endsection