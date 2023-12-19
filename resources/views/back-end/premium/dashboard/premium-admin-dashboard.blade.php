@extends('back-end.premium.layout.premium-main')
@section('content')

    <?php
    use App\Models\Attendance;
    use App\Models\Role;
    //use DateTime;
    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');
    //$current_time = $date->format('H:i:s');
    $date_wise_day_name = date('D', strtotime($current_date));

    ?>
    <section class="main-contant-section">
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
        @if (Auth::user()->user_admin_status == 'Yes')

            <div class="text-center mt-5">
                <div class="div">
                    <h2><b>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</b>({{ Auth::user()->username }})</h2>
                </div>
                @foreach ($users as $users_value)
                    <div class="div">
                        <p>{{ $users_value->userdepartment->department_name }},
                            {{ $users_value->userdesignation->designation_name }}
                        </p>
                    </div>
                @endforeach

                <div class="div">
                    @if (Auth::user()->attendance_type == 'general')
                        <form class="d-inline m1-2" method="post" action="{{ route('employee-attendance') }}">
                            @csrf
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ Auth::user()->id }}"
                                required>
                            <script>
                                var current = navigator.geolocation
                                if (current) {
                                    navigator.geolocation.getCurrentPosition(showPosition);
                                } else {
                                    toastr.error('Your Browser Or Device not Supported Geolocaiton');
                                }

                                function showPosition(position) {
                                    document.getElementById("check_in_lat").value = position.coords.latitude;
                                    document.getElementById("check_in_longt").value = position.coords.longitude;
                                }
                            </script>

                            <input type="hidden" readonly name="lat" id="check_in_lat" value="" required>
                            <input type="hidden" readonly name="longt" id="check_in_longt" value="" required>

                            {{-- @if (Attendance::where('employee_id', '=', Auth::user()->id)->where('attendance_date', '=', $current_date)->where('check_in_out', '=', 0)->exists()) --}}
                            @if (Attendance::where('employee_id', '=', Auth::user()->id)->where('attendance_date', '=', $current_date)->exists())
                                <button type="submit" class="btn btn-success"><i class="fa fa-star-circle"></i>
                                    {{ __('Check Out') }}
                                </button>
                            @else
                                <input type="hidden" name="check_in_request" value="check_in_request">
                                <button type="submit" class="btn btn-success"><i class="fa fa-star-circle"></i>
                                    {{ __('Check In') }}
                                </button>
                            @endif

                        </form>
                    @else
                        <form class="d-inline m1-2" method="post" action="{{ route('employee-ip-based-attendances') }}">
                            @csrf
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ Auth::user()->id }}"
                                required>
                            @if (Attendance::where('employee_id', '=', Auth::user()->id)->where('attendance_date', '=', $current_date)->exists())
                                <button type="submit" class="btn btn-success"><i class="fa fa-star-circle"></i>
                                    {{ __('Check Out') }}
                                </button>
                            @else
                                <input type="hidden" name="check_in_request" value="check_in_request">
                                <button type="submit" class="btn btn-success"><i class="fa fa-star-circle"></i>
                                    {{ __('Check In') }}
                                </button>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        @endif

        <div class="container-fluid dashboard-top-card-section">
            <div class="d-flex justify-content-between mb-30px">
                <div>
                    <h1 class="thin-text">Welcome {{ Auth::user()->username }}</h1>
                </div>

                <div>
                    <h4 class="thin-text">{{ __('Today is') }} {{ now()->englishDayOfWeek }}
                        {{ now()->format(env('Date_Format')) }}</h4>
                </div>
            </div>
            <div class="section-contant">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card ">
                            <div class="card_title">
                                <a href="{{ route('employee-lists') }}">
                                    <div class="icon">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> Employees </strong>
                                    </div>
                                    <div class="count-number employee-count"> <span> {{ $employee_counts }} </span> </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Count item widget-->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card_title">
                                <a href="{{ route('attendance') }}">
                                    <div class="icon">
                                        <i class="fa fa-address-card" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> Attendance </strong>
                                    </div>

                                    <div class="count-number attendance-count">
                                        P:{{ $attendance_p }}
                                        A:{{ $employee_counts - $attendance_p }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Count item widget-->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card_title">
                                <a href="#">
                                    <div class="icon">
                                        <i class="fa fa-reply-all" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{ __('Total Leave') }} </strong>
                                    </div>

                                    <div class="count-number leave-count">{{ $leave }}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Count item widget-->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card_title">
                                <a href="{{ route('announcement') }}">
                                    <div class="icon">
                                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{ __('Announcement') }} </strong>
                                    </div>
                                    <div class="count-number total_expense">{{ $announcement }}</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card_title">
                                <a href="#">
                                    <div class="icon">
                                        <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{ __('Completed Projects') }} </strong>
                                    </div>

                                    <div class="count-number total_deposit">{{ $project }}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Count item widget-->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card_title">
                                <a href="#">
                                    <div class="icon">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </div>
                                    <div class="name">
                                        <strong> {{ __('Total Paid Salaries') }} </strong>
                                    </div>
                                    <div class="count-number total_deposit"> {{ (int) $salary }} </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-chart">
                <div class="row">
                    <div class="col-md-6" style="margin-top: 15px; margin-bottom: 15px;">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center">
                                <h4>Payment --- {{ __('Last 6 Months ') }}</h4>
                            </div>
                            <div class="card-body">
                                <div id="columnchart_material"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 15px; margin-bottom: 15px;">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center">
                                <h4> Employee Department </h4>
                            </div>
                            <div class="pie-chart mb-2">
                                <div id="piechart_3d"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="margin-top: 15px; margin-bottom: 15px;">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center">
                                <h4> Employee Designation </h4>
                            </div>
                            <div class="pie-chart mb-2">
                                <div id="designation_chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 15px; margin-bottom: 15px;">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center">
                                <h4> Project Management </h4>
                            </div>
                            <div class="pie-chart mb-2">
                                <div id="project_chartData_id"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="container-fluid">
                <p>
                    &copy; | {{ __('Developed by') }}
                    <a href="http://predictionit.com" class="external">{{ __('Prediction IT') }} </a>
                </p>
            </div>
        </footer>
    </section>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php
                foreach ($department_piedata as $data) {
                    echo "['" . $data->department_name . "', " . $data->count . '],';
                }
                ?>
            ]);

            var options = {
                height: 400,
                legend: 'bottom',
                title: 'Employee Department',
                is3D: true,
                colors: ['#ff7588', '#009933', '#0059b3', '#00ffaa', '#00cccc', '#008ae6', '#000080', '#2dd5eb',
                    '#669999',
                    '#8c1aff', '#D6816F', '#719945', '#459990'
                ]
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php
                foreach ($designation_chartData as $data) {
                    echo "['" . $data->designation_name . "', " . $data->count . '],';
                }
                ?>
            ]);

            var options = {
                height: 400,
                legend: 'bottom',
                title: 'Employee Designation',
                is3D: true,
                colors: ['#ff7588', '#009933', '#0059b3', '#00ffaa', '#00cccc', '#008ae6', '#000080', '#2dd5eb',
                    '#669999', '#8c1aff', '#D6816F', '#719945', '#459990'
                ]
            };

            var chart = new google.visualization.PieChart(document.getElementById('designation_chart'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Project', 'Progress', 'Employee', {
                    role: 'annotation'
                }],
                [' ', 00, 00, ''],

                <?php foreach ($projects as $project) {
                    echo "['" . $project->project . "', " . $project->progress . ",'" . count(json_decode($project->assign)) . "',''],";
                }
                ?>
            ]);

            var options = {
                height: 400,
                legend: {
                    position: 'top',
                    maxLines: 3
                },
                bar: {
                    groupWidth: '75%'
                },
                isStacked: true,
                colors: ['#009933', '#459990', '#0059b3', '#00ffaa', '#00cccc', '#008ae6', '#000080', '#2dd5eb',
                    '#669999', '#8c1aff', '#D6816F', '#719945', '#ff7588'
                ]
            };

            var chart = new google.charts.Bar(document.getElementById('project_chartData_id'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month Year', 'Salary'],
                <?php
                foreach ($payments as $product) {
                    echo "['" . $product->month_year . "', " . $product->total . ', ' . $product->quantity . '],';
                }
                ?>
            ]);

            var options = {
                height: 400,
                chart: {
                    title: 'Company Salary Chart',
                }
            };
            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        var options = {
            series: [{
                name: "sales",
                data: [{
                    x: '2019/01/01',
                    y: 400
                }, {
                    x: '2019/04/01',
                    y: 430
                }, {
                    x: '2019/07/01',
                    y: 448
                }, {
                    x: '2019/10/01',
                    y: 470
                }, {
                    x: '2020/01/01',
                    y: 540
                }, {
                    x: '2020/04/01',
                    y: 580
                }, {
                    x: '2020/07/01',
                    y: 690
                }, {
                    x: '2020/10/01',
                    y: 690
                }]
            }],
            chart: {
                type: 'bar',
                height: 500
            },
            xaxis: {
                type: 'category',
                labels: {
                    formatter: function(val) {
                        return "Q" + dayjs(val).quarter()
                    }
                },
                group: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 700
                    },
                    groups: [{
                            title: '2019',
                            cols: 4
                        },
                        {
                            title: '2020',
                            cols: 4
                        }
                    ]
                }
            },
            title: {
                text: 'Grouped Labels on the X-axis',
            },
            tooltip: {
                x: {
                    formatter: function(val) {
                        return "Q" + dayjs(val).quarter() + " " + dayjs(val).format("YYYY")
                    }
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#project_management"), options);
        chart.render();
    </script>
    <script>
        setTimeout(function() {
            // Get the div element
            var divElement = document.getElementById('temp_message');

            // Check if the div element exists
            if (divElement) {
                // Hide the div by setting its display property to 'none'
                divElement.remove();
            }
        },5000); // 24 hours in milliseconds
    </script>
@endsection
