@extends('back-end.premium.layout.premium-main')
@section('content')
<?php
    use App\Models\FestivalPayment;
    use App\Models\BankAccount;
    use App\Models\TaxConfig;
    use App\Models\MinimumTaxConfigure;
    use Carbon\Carbon;
    ?>
<section class="main-contant-section">


    <div class=" mb-3">

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


        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('New Festival Payments') }} </h1>
                <nav aria-label="breadcrumb">

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - New Festival Payments </a></li>
                    </ol>

                </nav>
            </div>
        </div>

    </div>
    <div class="content-box">
        <form method="post" action="{{ route('new-festival-payment') }}" class="container-fluid">
            @csrf
            <div class="row align-items-end">

                <div class="col-md-4 form-group">

                    <label>{{ __('Department') }} </label>
                    <select name="department_id" class="form-control" required>
                        <option>Choose a Department</option>
                        <option value="0">All Department</option>
                        @foreach ($departments as $department_values)
                        <option value="{{ $department_values->id }}">
                            {{ $department_values->department_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">{{ __('Month') }}</label>
                        <input class="form-control" name="month_year" type="month">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped ">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Company ID') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Joining Date') }}</th>
                        <th>{{ __('Gross') }}</th>
                        <th>{{ __('Basic') }}</th>
                        <th>{{ __('Bonus Amount') }}</th>
                        <th>{{ __('Tax') }}</th>
                        <th>{{ __('Net bonus') }}</th>
                        <th>{{ __('Total Duration') }}</th>
                        <th>{{ __('Bounus Month') }}</th>
                        <th>{{ __('Bounus Title') }}</th>
                        {{-- @if ($edit_permission == 'Yes' || $delete_permission == 'Yes') --}}
                        <th>{{ __('Action') }}</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($users as $user)
                    <?php
                    $festival_payments = FestivalPayment::where('festival_payment_com_id',Auth::user()->com_id)->where('festival_payment_emp_id',$user->id)->first();

                    $bank_accounts = BankAccount::where('bank_account_com_id', Auth::user()->com_id)
                        ->where('bank_account_employee_id', $user->id)
                        ->first();



                    $days =  floor((time() - strtotime($user->joining_date)) / 86400);

                    $start_date = new DateTime($user->joining_date);
                    $end_date = new DateTime();

                    $interval = $start_date->diff($end_date);

                    $years = $interval->y;
                    $months = $interval->m;
                    $day = $interval->d;

                    $total_months = $years * 12 + $months;

                    ?>
                    @foreach ($festivalBonus as $festivalBonusMonth)
                    <?php
                   $month_year = date('Y-m', strtotime($festivalBonusMonth->festival_bonus_date_month_year));
                   $month_year_date = date('M-Y', strtotime($festivalBonusMonth->festival_bonus_date_month_year));


                   $payment_month = date('m', strtotime($festivalBonusMonth->festival_bonus_date_month_year));
                   $payment_year = date('Y', strtotime($festivalBonusMonth->festival_bonus_date_month_year));

                   $festival_bounus_title = $festivalBonusMonth->festival_bonus_title ?? null;

                    $date = Carbon::parse($festivalBonusMonth->festival_bonus_date_month_year);

                    $previousMonth = $date->subMonth()->format('Y-m');


                    ?>



                    @if(($total_months >= $festival_config->festival_config_festival_bonus_time_duration) &&($month_year
                    == date('Y-m')|| $previousMonth == date('Y-m')))
                    <?php
                    ###################################### tax deduction code starts from here ######################################

                    $previous_deducted_salary_tax = 0;

                    ?>
                    @foreach ($tax_configs as $tax_configs_value)
                    <?php
                      $bonus_amount = 0;
                        if($festival_config->festival_config_salary_type == "Gross"){
                            $bonus_amount=($user->gross_salary*$festival_config->festival_config_festival_bonus_percentage)/100;
                        }
                        if($festival_config->festival_config_salary_type == "Basic"){
                            $bonus_amount = ((($user->gross_salary*$salary_configs->salary_config_basic_salary)/100)*$festival_config->festival_config_festival_bonus_percentage)/100;
                        }

                        $gross_salary = $bonus_amount * 12;

                        if ($tax_configs_value->minimum_salary <= $gross_salary) {
                            if ($gross_salary < $tax_configs_value->maximum_salary) {
                                $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                            } else {
                                $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                            }

                            $tax_deduction_percentage = $taxable_salary * $tax_configs_value->tax_percentage;

                            $taxable_salary = $tax_configs_value->minimum_salary;

                            $tax_deduction = $tax_deduction_percentage / 100;

                            $previous_deducted_salary_tax += $tax_deduction;
                        }
                       ###################################### Tax config wise tax amount code ends here ######################################
                       ?>
                    @endforeach
                    <?php
                     ######################################tax deduction code ends here ######################################
                    ?>
                    <?php
                      ######### tax configuring code for 0 to Minimum  tax amount starts from here ##############

                      $tax_deduction_amount = $previous_deducted_salary_tax / 12;
                        if ($tax_deduction_amount >= 1 && $tax_deduction_amount <= $minimum_tax_config->minimum_tax_config_amount) {
                            $all_tax_deduction = $minimum_tax_config->minimum_tax_config_amount;
                        } else {
                            $all_tax_deduction = $tax_deduction_amount;
                        }

                     ######### tax configuring code for 0 to Minimum tax amount ends here ##############


                    $amount =0;
                    ?>

                    <tr>
                        <td>{{ $i++ }} </td>
                        <td>{{ $user->first_name ?? null}} {{ $user->last_name ?? null}}</td>
                        <td>{{ $user->company_assigned_id ?? null}}</td>
                        <td>{{ $user->phone ?? null}}</td>
                        <td>{{ $user->joining_date ?? null}}</td>
                        <td>{{ $user->gross_salary }}</td>
                        <td>{{ ($user->gross_salary*$salary_configs->salary_config_basic_salary)/100 }}</td>
                        <td>
                            @if (FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)
                            ->where('festival_payment_emp_id',$user->id)
                            ->where('status',1)
                            ->whereMonth('festival_payment_date', '=', $payment_month)
                            ->whereYear('festival_payment_date', '=', $payment_year)
                            ->exists())
                            {{$bonus_amount = 0}}
                            @else
                            @if($festival_config->festival_config_salary_type == "Gross")
                            <div class="col-md-12 form-group">
                                <label>{{
                                    $bonus_amount =
                                    ($user->gross_salary*$festival_config->festival_config_festival_bonus_percentage)/100}}
                                </label>
                            </div>
                            @endif
                            @if($festival_config->festival_config_salary_type == "Basic")
                            <div class="col-md-12 form-group">
                                <label>{{
                                    $bonus_amount =
                                    ((($user->gross_salary*$salary_configs->salary_config_basic_salary)/100)*$festival_config->festival_config_festival_bonus_percentage)/100
                                    }}
                                </label>
                            </div>
                            @endif
                            @endif
                        </td>
                        <td>{{ $all_tax_deduction }}</td>
                        <td>{{ $bonus_amount - $all_tax_deduction}}</td>
                        <td> {{ $years.' Year '. $months.' Month '.$day.' day' }}</td>
                        <td> {{ $month_year_date }}</td>
                        <td> {{ $festivalBonusMonth->festival_bonus_title }}</td>
                        <td>
                            <a href="#" class="btn view" data-toggle="modal" data-target="#viewModal{{$user->id}}"
                                data-toggle="tooltip" title=" View " data-original-title="View"> <i class="fa fa-eye"
                                    aria-hidden="true"></i></a>

                            <form method="post" action="{{ route('make-payment-festivals') }}"
                                class="form-horizontal btn" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="festival_payment_emp_id" value="{{ $user->id}}">
                                <input type="hidden" name="festival_payment_bank_account_id"
                                    value="{{ $bank_accounts->id ?? null}}">
                                <input type="hidden" name="festival_payment_department_id"
                                    value="{{ $user->department_id}}">
                                <input type="hidden" name="festival_payment_date" value="{{ date('Y-m-d')}}">

                                <input type="hidden" name="festival_payment_amount"
                                    value=" @if($festival_config->festival_config_salary_type == " Gross"){{
                                    $amount=($user->gross_salary*$festival_config->festival_config_festival_bonus_percentage)/100}}
                                @elseif($festival_config->festival_config_salary_type == "Basic")
                                {{$amount =
                                ((($user->gross_salary*$salary_configs->salary_config_basic_salary)/100)*$festival_config->festival_config_festival_bonus_percentage)/100}}
                                @endif
                                ">

                                <input type="hidden" name="festival_payment_tax_deduction"
                                    value="{{ $all_tax_deduction }}">

                                <input type="hidden" name="festival_payment_percentage"
                                    value="{{ $festival_config->festival_config_festival_bonus_percentage}}">

                                <input type="hidden" name="festival_payment_bonus_id"
                                    value="{{ $festivalBonusMonth->id}}">

                                <input type="hidden" name="festival_payment_net_bonus"
                                    value="{{ $amount - $all_tax_deduction}}">

                                <input type="hidden" name="festival_payment_status" value="1">
                                <?php
                                if( FestivalPayment::where('festival_payment_com_id',Auth::user()->com_id)->where('festival_payment_emp_id',$user->id)->whereMonth('festival_payment_date',$payment_month)->whereYear('festival_payment_date',$payment_year)->where('status',1)->exists()){ ?>
                                <div class="btn btn-danger">Payment Complete</div>
                                <?php } else{?>
                                <input type="submit" name="action_button" class="btn btn-info"
                                    value="{{ __('Make-Payment') }}" />
                                <?php }?>

                            </form>

                    </tr>

                    <div id="viewModal{{ $user->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 id="exampleModalLabel" class="modal-title">{{ "Festival bounus for".'
                                        '.$festival_bounus_title.'
                                        '.$month_year}} </h5>
                                    <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                        class="close"><i class="dripicons-cross"></i></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label> {{ "Festival bonus for".'
                                                '.$festival_bounus_title.'
                                                '.$month_year}}</label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Month : {{ date('F',strtotime($month_year))}} {{
                                                date('Y',strtotime($month_year))}}</label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Name : {{ $user->first_name ?? null}} {{ $user->last_name ??
                                                null}}</label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> ID : {{ $user->company_assigned_id ?? null}} </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Employment Type: {{ $user->employment_type ?? null}} </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Phone : {{ $user->phone ?? null}} </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Joining Date : {{ $user->joining_date ?? null}} </label>
                                        </div>
                                        @if($festival_config->festival_config_salary_type == "Gross")

                                        <div class="col-md-12 form-group">
                                            <label> Gross Salary : {{$user->gross_salary ?? null}}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Gross Bounus Percentage :
                                                {{$festival_config->festival_config_festival_bonus_percentage ?? null}}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Bounus Amount : {{
                                                ($user->gross_salary*$festival_config->festival_config_festival_bonus_percentage)/100}}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Tax Amount : {{
                                                $all_tax_deduction
                                                }}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Net Bonus Amount : {{ $bonus_amount - $all_tax_deduction}}
                                            </label>
                                        </div>

                                        @endif
                                        @if($festival_config->festival_config_salary_type == "Basic")
                                        <div class="col-md-12 form-group">
                                            <label> Gross Salary : {{$user->gross_salary ?? null}}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Basic Salary :
                                                {{($user->gross_salary*$salary_configs->salary_config_basic_salary)/100
                                                ?? null}}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Basic Bounus Percentage :
                                                {{$festival_config->festival_config_festival_bonus_percentage ?? null}}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Bounus Amount : {{
                                                ((($user->gross_salary*$salary_configs->salary_config_basic_salary)/100)*$festival_config->festival_config_festival_bonus_percentage)/100
                                                }}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label> Tax Amount : {{
                                                $all_tax_deduction
                                                }}
                                            </label>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Net Bonus Amount : {{ $bonus_amount - $all_tax_deduction}}
                                            </label>
                                        </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
                    @endforeach
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#user-table').DataTable({

                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,
                dom: '<"row"lfB>rtip',

                buttons: [{
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
