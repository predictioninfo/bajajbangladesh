@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<section class="main-contant-section">
    <?php
        use App\Models\User;
        use App\Models\ObjectiveTypeConfig;
        use App\Models\Objective;
        use App\Models\ObjectiveDetails;
        use App\Models\HouseRentNonTaxableRangeYearly;
        use App\Models\MedicalAllowanceNonTaxableRangeYearly;
        use App\Models\ConveyanceAllowanceNonTaxableRangeYearly;
        use App\Models\YearlyFestivalBonusConfig;
        use App\Models\MinimumTaxConfigure;

        $nonTaxableHouseRent = 25000;
            if(HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
                $nonTaxableHouseRent =   ($house_rent_non_taxable->house_rent_non_taxable_range_yearlies_amount)/12;
            }else{
                $nonTaxableHouseRent ;
            }
        $nonTaxableMedical = 10000;
            if(MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
                $nonTaxableMedical = ($medical_allowance_non_taxable->medical_allowance_non_taxable_range_yearlies_amount)/12;
            }else{
                $nonTaxableMedical ;
        }

        $nonTaxableConceyance = 2500;
        if(ConveyanceAllowanceNonTaxableRangeYearly::where('conveyance_allowance_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
                $nonTaxableConceyance =  ($conveyance_allowance_non_taxable->conveyance_allowance_non_taxable_range_yearlies_amount)/12;
            }else{
                $nonTaxableConceyance;
        }
        $minimum_tax_config_amount = 417;
        if(MinimumTaxConfigure::where('minimum_tax_config_com_id',Auth::user()->com_id)->exists()){
                $minimum_tax_config_amount =  $minimum_tax_configs->minimum_tax_config_amount;
            }else{
                $minimum_tax_config_amount;
        }
        ?>

    <div class="performance-report-pdf">
        <div class="header-info">

            <div class="section-title">
                <div class="card mb-0">
                    <div class="card-header with-border">
                        <h1 class="card-title text-center"> Tax Accountable</h1>
                    </div>
                </div>

            </div>

        </div>
        <div class="content-box">
            <div>
                <h5><b>1) Salary Breakdown For a Month:</b> </h5>
            </div>
            <h5>{{ $gross_salary->gross_salary  }} TK</h5><br>
            <div class="table-responsive">
                <table class="">
                    <thead>
                        <tr>

                            <th>{{__('SL')}}</th>
                            <th>{{__('Salary Role')}}</th>
                            <th>{{__('Salary Income')}}</th>
                            <th>{{__('Max Exempted Income')}}</th>
                            <th> {{__('Taxable Income')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($salary_configs as $salary_config)
                        <tr>
                            <td>1</td>
                            <td>Basic Salary</td>
                            <td style="text-align: right">
                                {{ ($gross_salary->gross_salary * $salary_config->salary_config_basic_salary) / 100 }}
                            </td>
                            <td style="text-align: right">0</td>
                            <td style="text-align: right">
                                <?php
                                    $basicTaxableIcome = ($gross_salary->gross_salary * $salary_config->salary_config_basic_salary) / 100;
                                ?>
                                {{ $basicTaxableIcome }}
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>House Rent</td>
                            <td style="text-align: right">{{( $gross_salary->gross_salary*$salary_config->salary_config_house_rent_allowance )/100}}</td>
                            <td style="text-align: right">{{$nonTaxableHouseRent}}</td>
                            <td style="text-align: right">
                            <?php
                                $houseRent = ($gross_salary->gross_salary * $salary_config->salary_config_house_rent_allowance) / 100;
                                $taxAbleHouseRentceIncome = $houseRent > $nonTaxableHouseRent ? $houseRent - $nonTaxableHouseRent : 0;
                            ?>
                            {{  $taxAbleHouseRentceIncome}}
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Conveyance</td>
                            <td style="text-align: right">{{( $gross_salary->gross_salary*$salary_config->salary_config_conveyance_allowance )/100}}</td>
                            <td style="text-align: right">{{$nonTaxableConceyance}}</td>
                            <td style="text-align: right">
                                <?php
                                $conveyance = ($gross_salary->gross_salary * $salary_config->salary_config_conveyance_allowance) / 100;
                                $taxAbleConveyanceIncome = $conveyance > $nonTaxableConceyance ? $conveyance - $nonTaxableConceyance : 0;

                            ?>
                            {{ $taxAbleConveyanceIncome }}
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Medical</td>
                            <td style="text-align: right">{{  ($gross_salary->gross_salary*$salary_config->salary_config_medical_allowance) /100}}</td>
                            <td style="text-align: right">{{ $nonTaxableMedical}}</td>
                            <td style="text-align: right">
                            <?php
                                $medical = ($gross_salary->gross_salary*$salary_config->salary_config_medical_allowance) /100;
                                $taxAbleMedicalIncome = $medical >  $nonTaxableMedical ? $medical -  $nonTaxableMedical : 0;
                            ?>
                            {{ $taxAbleMedicalIncome}}
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>CC-PF</td>
                            <td style="text-align: right">0</td>
                            <td style="text-align: right">0</td>
                            <td style="text-align: right">0</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: center">Total</td>
                            <td style="text-align: right">
                                <?php
                                    $monthlyTotalTaxableIncome =$basicTaxableIcome + $taxAbleConveyanceIncome +  $taxAbleHouseRentceIncome + $taxAbleMedicalIncome;
                                ?>
                                {{$monthlyTotalTaxableIncome}}
                            </td>
                        </tr>
                    </tfoot>

                </table>
            </div><br>
            <div>
                <h5><b> 2) Income From Others:</b> </h5>
            </div><br>
            <table class="">
                <tbody>
                    <tr>
                        <td>Total Taxable Income Per Month (BDT)</td>
                        <td style="text-align: right">{{ $monthlyTotalTaxableIncome}}</td>
                    </tr>
                    <tr>
                        <td>Total Taxable Income For Two Festival Bonus (BDT)</td>
                        <td style="text-align: right">
                            <?php
                              $totalFestivalBonusyearly =   $festivalBonusyearly->total_bonus ?? 0;
                            ?>
                            {{ $totalFestivalBonusyearly ?? 0}}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Taxable Income For 12 Months & Two Festival Bonus (BDT)</td>
                        <?php
                            $yeralyTaxbleIncome = ($monthlyTotalTaxableIncome*12);
                        ?>
                        <td style="text-align: right">
                        <?php
                            $yeralyTotalTaxbleIncome = $yeralyTaxbleIncome + $totalFestivalBonusyearly;
                        ?>
                            {{$yeralyTotalTaxbleIncome}}
                        </td>
                    </tr>
                </tbody>
            </table><br>

            <div>
                <h5><b>3) Calculation Tax Liability:</b> </h5>
            </div><br>
            <table class="">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Tax Slab</th>
                        <th>Taxable Income</th>
                        <th>Calculated Tax</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                
                    $total_tax_amount = 0;
                ?>

                @foreach ($tax_configs as $index => $config)
                    <?php

                        $min_range = $config->minimum_salary;
                        $max_range = $config->maximum_salary;
                        $rate = $config->tax_percentage;
                        $taxable_amount_in_this_range = 0;
                        $calculated_tax_in_this_range = 0;

                        if ($yeralyTotalTaxbleIncome <= $min_range) {
                            break; // No need to continue the loop if the income is below the first range
                        }

                        if ($yeralyTotalTaxbleIncome > $max_range) {
                            $taxable_amount_in_this_range = $max_range - $min_range ;
                            $calculated_tax_in_this_range = ($taxable_amount_in_this_range * $rate)/100;
                            $total_tax_amount += $calculated_tax_in_this_range;
                        } else {
                            $taxable_amount_in_this_range = $yeralyTotalTaxbleIncome - $min_range;
                            $calculated_tax_in_this_range = ($taxable_amount_in_this_range * $rate)/100;
                            $total_tax_amount += $calculated_tax_in_this_range;

                        }

              
            ?>

         <tr>
            <th>{{ $index + 1 }}</th>
            <td>From Tk {{ number_format($min_range) }} to Tk {{ number_format($max_range) }} - {{ number_format($rate) }}%</td>
            <td style="text-align: right">{{ number_format($taxable_amount_in_this_range) }}</td>
            <td style="text-align: right">{{ number_format($calculated_tax_in_this_range) }} </td>
        </tr>
            </tr>
                @endforeach
                    <tr>
                        <th colspan="3" style="text-align: center">Total</th>
                        <td style="text-align: right">{{ number_format($total_tax_amount) }}</td>
                    </tr>
                </tbody>

            </table>
            <br>

            <div>
                <h5><b> 5) Net Tax Payable:</b> </h5>
            </div><br>
            <table class="">
                <tbody>
                    <tr>
                        <td>Net Tax Payable For 1 Year (BDT)</td>
                        <td style="text-align: right">{{ number_format($total_tax_amount) }}</td>
                    </tr>
                    <tr>
                        <td>Net Tax Payable Per Month (BDT)</td>
                        <td style="text-align: right">
                            <?php
                                $monthly_tax = ($total_tax_amount)/12;
                                if ($monthly_tax >= 1 && $monthly_tax <= $minimum_tax_config_amount) {
                                        $monthly_tax = $minimum_tax_config_amount;
                                } else {
                                    $monthly_tax;
                                }
                            ?>
                            {{ round($monthly_tax) ?? 0 }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection
