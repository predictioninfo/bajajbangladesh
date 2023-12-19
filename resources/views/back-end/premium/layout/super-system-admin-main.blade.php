<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" href="{{url('/uploads/logos/PitecHR.png') ?? 'NO Logo'}}">
        <title>PitecHR</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap-datepicker.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/Tag_input/tagsinput.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap-select.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/dripicons/webfont.css') }}" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
        <link rel="stylesheet" href="{{ asset('/css/grasp_mobile_progress_circle-1.0.0.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/vendor/daterange/css/daterangepicker.min.css') }}" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/select.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/dataTables.checkboxes.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/datatables.flexheader.boostrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/style.default.css') }}" id="theme-stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">

        <style>

            .CheckStyle{
                border: 2px solid #182C61;
                border-radius: 20px;
                text-align: center;
                font-size: 15px;
                background: rgb(49,89,98);
                background: linear-gradient(90deg, rgba(49,89,98,1) 0%, rgba(45,117,136,0.6895133053221288) 45%, rgba(242,246,245,0.989233193277311) 100%);
            }

            #organization-dropdown{
                background-color:#e2f1ebe8;
                border-radius: 5px 25px 25px 5px ;
            }

            #timesheet-dropdown{
                background-color:#f3e1e7;
                border-radius: 5px 25px 25px 5px ;
            }
        </style>

        <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/jquery/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/jquery-clockpicker/bootstrap-clockpicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/popper.js/umd/popper.min.js') }}"> </script>
        <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/charts-custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/daterange/js/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/daterange/js/knockout-3.4.2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/daterange/js/daterangepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/Tag_input/tagsinput.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/RangeSlider/ion.rangeSlider.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/pdfmake.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/vfs_fonts.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.buttons.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.bootstrap4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.colVis.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.html5.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/buttons.print.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/sum().js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/dataTables.checkboxes.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/datatable.fixedheader.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/datatable.responsive.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/select2/dist/js/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/vendor/datatable/datatable.responsive.boostrap.min.js') }}"></script>
        <script src="{{asset('/js/toastr.min.js')}}"></script>
        <script src="{{asset('/js/sweetalert.min.js')}}"></script>
    </head>

    <body>
        <header class="header">
            <nav class="navbar" style="background: rgb(49,89,98);
                background: linear-gradient(90deg, rgba(49,89,98,1) 0%, rgba(45,117,136,0.6895133053221288) 45%, rgba(149,182,155,0.989233193277311) 100%); ">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-align-left" aria-hidden="true"></i></a>
                        <span class="brand-big" id="site_logo_main"><img
                            src="{{asset('uploads/logos')}}/predictionit.png" width="150">&nbsp;
                            &nbsp;</span>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip" title="{{__('Full Screen')}}"><i class="dripicons-expand"></i></a></li>
                            <li class="nav-item">
                                <a rel="nofollow" id="notify-btn" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                                title="{{__('Notifications')}}">
                                    <i class="dripicons-bell"></i>
                                    <span class="badge badge-danger">  </span>
                                </a>
                                <ul class="right-sidebar">
                                    <li class="header">
                                        <span class="pull-right"><a href="">{{__('Clear All')}}</a></span>
                                        <span class="pull-left"><a href="">{{__('See All')}}</a></span>
                                    </li>
                                    <li><a class="" href="">Notification</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a rel="nofollow" href="#" class="nav-link dropdown-item">
                                    <img class="profile-photo sm mr-1" src="{{ asset('/uploads/profile_photos/avatar.png')}}">
                                    <span> {{Auth::user()->first_name." ".Auth::user()->last_name}} </span>
                                </a>
                                <ul class="right-sidebar">
                                    <li>
                                        <a href="">
                                            <i class="dripicons-user"></i> Profile
                                        </a>
                                    </li>
                                    <li><a href="{{route('password-changes')}}" id="general-dropdown">Change Password</a></li>
                                    <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <nav class="side-navbar" style="background:#e8f0e8;">
            <div class="side-navbar-wrapper">
                <div class="main-menu">
                    <ul id="side-main-menu" class="side-menu list-unstyled">
                        <li><a href="{{route('home')}}"> <div class="CheckStyle"><i style="color:white;" class="dripicons-meter"></i><span>Dashboard</span></div></a></li>

                        <li class="has-dropdown">
                            <a href="#packages" aria-expanded="false" data-toggle="collapse">
                                <div class="CheckStyle">
                                    <i style="color:white;" class="dripicons-user-group"></i><span>Packages</span>
                                </div>
                            </a>
                            <ul id="packages" class="collapse list-unstyled ">
                                <li id="employee_list"><a href="{{route('package-lists')}}">View Package List</a></li>
                            </ul>
                        </li>

                        <li class="has-dropdown">
                            <a href="#companies" aria-expanded="false" data-toggle="collapse">
                                <div class="CheckStyle">
                                    <i style="color:white;" class="dripicons-user-group"></i><span>Company</span>
                                </div>
                            </a>
                            <ul id="companies" class="collapse list-unstyled ">
                                <li id="employee_list"><a href="{{route('company-lists')}}">View Company List</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div id="content" class="page animate-bottom d-none">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="container-fluid">
                <p>
                    &copy; | {{ __('Developed by')}}
                    <a href="https://www.predictionit.com" class="external">{{ __('Prediction IT')}}</a>
                </p>
            </div>
        </footer>

        <script>
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success')}}")
            @endif
            @if(Session::has('info'))
                toastr.info("{{ Session::get('info')}}")
            @endif
            @if(Session::has('error'))
                toastr.error("{{ Session::get('error')}}")
            @endif


            var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#totalRevinew"), options);
        chart.render();

        var options = {
          series: [{
          name: 'series1',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'series2',
          data: [11, 32, 45, 32, 34, 52, 41]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#salesInfo"), options);
        chart.render();

        </script>
    </body>
</html>
