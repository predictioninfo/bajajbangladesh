@extends('back-end.general.layout.general-main')
@section('content')

  
<section class="main-content-section">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-30px">
                <div><h1 class="thin-text">Welcome username</h1></div>
                <div><h4 class="thin-text">{{__('Today is')}} {{now()->englishDayOfWeek}} {{now()->format(env('Date_Format'))}}</h4></div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center" style="background: rgb(0,36,17);
background: linear-gradient(90deg, rgba(0,36,17,1) 0%, rgba(9,121,65,0.2721463585434174) 45%, rgba(83,166,77,0.989233193277311) 100%);">
                        <a href="">
                            <div class="name"><strong class="purple-text">Employees</strong>
                            </div>
                            <div class="count-number employee-count">343</div>
                        </a>
                    </div>
                </div>

                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center" style="background: rgb(0,30,36);
background: linear-gradient(90deg, rgba(0,30,36,1) 0%, rgba(9,83,121,0.2721463585434174) 45%, rgba(77,115,166,0.989233193277311) 100%);">
                        <a href="">
                            <div class="name"><strong class="orange-text">Attendance</strong></div>
                            <div class="count-number attendance-count">P:23
                                A:22</div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center" style="background: rgb(127,177,187);
background: linear-gradient(90deg, rgba(127,177,187,1) 0%, rgba(9,83,121,0.2721463585434174) 45%, rgba(77,166,92,0.989233193277311) 100%);">
                        <a href="">
                            <div class="name"><strong class="green-text">{{__('Total Leave')}}</strong></div>
                            <div class="count-number leave-count">22</div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center" style="background: rgb(30,43,46);
background: linear-gradient(90deg, rgba(30,43,46,1) 0%, rgba(9,83,121,0.2721463585434174) 45%, rgba(30,54,34,0.989233193277311) 100%);">
                        <a href="">
                            <div class="name"><strong class="blue-text">{{__('Total Expense')}}</strong></div>
                            <div class="count-number total_expense">3333</div>
                        </a>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="wrapper count-title text-center" style="background: rgb(106,194,214);
background: linear-gradient(90deg, rgba(106,194,214,1) 0%, rgba(76,82,85,0.2721463585434174) 45%, rgba(124,171,132,0.989233193277311) 100%);">
                        <a href="">
                            <div class="name"><strong class="green-text">{{__('Total Deposit')}}</strong></div>
                            <div class="count-number total_deposit">2222222</div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center" style="background: rgb(49,89,98);
background: linear-gradient(90deg, rgba(49,89,98,1) 0%, rgba(45,117,136,0.6895133053221288) 45%, rgba(149,182,155,0.989233193277311) 100%);">
                        <a href="">
                            <div class="name"><strong class="blue-text">{{__('Total Salaries Paid')}}</strong>
                            </div>
                            <div class="count-number total_salaries_paid">222222</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center">
                            <h4>Payment --- {{__('Last 6 Months ')}}</h4>
                        </div>
                        <div class="card-body">
                           {{-- <canvas id="payment_last_six" data-last_six_month_payment = "{{json_encode($per_month_payment) ?? ''}}" data-months="{{json_encode($per_month) ?? ''}}"  data-label1="Payment" ></canvas> --}}
                           <canvas id="payment_last_six" data-last_six_month_payment = "" data-months=""  data-label1="Payment" ></canvas> 
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Employee Department')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                        {{--  <canvas id="department_chart" data-dept_bgcolor='@json($dept_bgcolor_array)'
                                    data-hover_dept_bgcolor='@json($dept_hover_bgcolor_array)'
                                    data-dept_emp_count='@json($dept_count_array)'
                                    data-dept_label='@json($dept_name_array)' width="100" height="95"></canvas> --}}

                                      <canvas id="department_chart" data-dept_bgcolor=''
                                    data-hover_dept_bgcolor=''
                                    data-dept_emp_count=''
                                    data-dept_label='' width="100" height="95"></canvas> 
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Employee Designation')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                        {{--    <canvas id="designation_chart" data-desig_bgcolor='@json($desig_bgcolor_array)'
                                    data-hover_desig_bgcolor='@json($desig_hover_bgcolor_array)'
                                    data-desig_emp_count='@json($desig_count_array)'
                                    data-desig_label='@json($desig_name_array)' width="100" height="95"></canvas> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Expense Vs Deposit')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                        {{--    <canvas id="expense_deposit_chart" data-expense_count='{{$total_expense_raw}}'
                                    data-expense_level="{{trans('Expense')}}"
                                    data-deposit_count='{{$total_deposit_raw}}'
                                    data-deposit_level="{{trans('Deposit')}}" width="100" height="95"></canvas> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{__('Project Status')}}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                        {{--    <canvas id="project_chart" data-project_status='@json($project_count_array)'
                                    data-project_label='@json($project_name_array)' width="100" height="95"></canvas> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4 mt-4">
                    <div class="wrapper count-title d-flex">
                        <div class="icon blue-text ml-2 mr-3"><i class="dripicons-volume-medium"></i></div>
                        <a href="">
                            <h3 class="mt-3">454 Announcement</h3>
                        </a>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="wrapper count-title d-flex">
                        <div class="icon green-text ml-2 mr-3"><i class="dripicons-ticket"></i></div>
                        <a href="">
                            <h3 class="mt-3">32343 {{__('Open Ticket')}}</h3>
                        </a>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="wrapper count-title d-flex">
                        <div class="icon orange-text ml-2 mr-3"><i class="dripicons-briefcase"></i></div>
                        <a href="">
                            <h3 class="mt-3">3454 {{__('Completed Projects')}}</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
               
            </div>
        </div>

    </section>


@endsection