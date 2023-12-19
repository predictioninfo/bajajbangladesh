

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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    <span id="form_result"></span>

    <section class="forms">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                    <div class="card-header d-flex align-items-center">
                            <h4>{{__('Attenadance')}} For {{ $employee->first_name }} {{ $employee->last_name }}  -  {{ $employee->company_assigned_id}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="content-box">
                        {{-- @for ($i = 0; $i <= 31; $i++) --}}
                            <form method="POST" action="{{ route('employee-individual-bulk-attendances') }}" enctype="multipart/form-data">
                                @csrf
                                    
                                 <input type="hidden" class="form-control" name="employee_id" value="{{ $employee->id }}">
                                 <input type="hidden" class="form-control" name="attendance_com_id" value="{{ $employee->com_id }}"  >
                                 <input type="hidden" class="form-control" name="check_in_out" value=" 1 ">
                                  
                                   <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_one" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInOne" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutOne" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_two" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInTwo" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutTwo" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_three" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInthree" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutThree" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_four" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInFour" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutFour" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_five" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInFive" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutFive" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_six" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInSix" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutSix" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_seven" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInSeven" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutSeven" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_eight" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInEight" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutEight" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_nine" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInNine" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutNine" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_ten" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInTen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutTen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_eleven" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInEleven" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutEleven" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twelve" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInTwelve" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutTwelve" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_thirteen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInThirteen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutThirteen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_fourteen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInFourteen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutFourteen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_fifthteen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInFifthteen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutFifthteen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_sixteen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInsixteen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutsixteen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_seventeen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInseventeen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutseventeen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_eightteen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIneightteen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuteightteen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_ninthteen" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInninthteen" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutninthteen" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twenty" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwenty" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwenty" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyOne" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyOne" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyOne" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyTwo" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyTwo" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyTwo" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyThree" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyThree" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyThree" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyFour" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyFour" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyFour" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyFive" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyFive" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyFive" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentySix" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentySix" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentySix" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentySeven" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentySeven" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentySeven" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyEight" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyEight" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyEight" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_twentyNine" class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkIntwentyNine" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOuttwentyNine" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_thirty"  class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInthirty" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutthirty" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Date Of Attendance')}} *</strong></label>
                                            <input type="date" name="date_thirtyOne"  class="form-control"   />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check In')}} *</strong></label>
                                            <input type="time" name="checkInThirtyOne" class="form-control"    />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{__('Check Out')}} *</strong></label>
                                            <input type="time" name="checkOutThirtyOne" class="form-control"   />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <button class="btn btn-grad" type="submit">Sumbit</button>
                                    </div>
                                </div>
                            </form>
                              {{-- @endfor --}}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    </section>
@endsection