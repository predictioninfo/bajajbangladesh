
@extends('back-end.premium.layout.premium-main')

@section('content')

    <section class="main-contant-section">

        <div class=" mb-3"> </div>

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

            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header with-border">
                        <h3 class="card-title text-center"> {{__('Attendance Location Reset')}} </h3>
                    </div>

                 
                        <div class="content-box">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <form method="post" action="{{route('update-attendance-locations')}}">
                                     @csrf
                                    <div class="row">
                                            <div class="col-md-12 form-group mb-0">
                                                    <label>{{__('Employee')}} *</label>
                                                    <select name="employee_id"  class="form-control selectpicker" data-live-search="true" data-live-search-style="begins" title='Employee' required>
                                                    {{-- <option>Choose a Employee</option> --}}
                                                        @foreach($employees as $employees_value)
                                                            <option value="{{$employees_value->id}}" data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{$employees_value->profile_photo}}'>" >{{$employees_value->first_name}} {{$employees_value->last_name}}({{$employees_value->company_assigned_id}})</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn btn-grad"><i class="fa fa-edit"></i> {{__('Reset')}}
                                    </button>
                                </form>

                            </div>
                            <div class="col-md-4">
                                <form method="post" action="{{route('update-bulk-attendance-locations')}}">
                                     @csrf

                                     <input type="hidden" class="form-control-file" name="com_id" value="{{Auth::user()->com_id}}">
                                     <div class="form-group mb-0">
                                    <div class="form-actions">
                                        
                                        <button  type="submit" class="btn btn-grad"><i class="fa fa-edit"></i> {{__('Bulk Reset')}}</button>
                                        </button>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                        </div>

                </div>
            </div>


    </section>

@endsection
