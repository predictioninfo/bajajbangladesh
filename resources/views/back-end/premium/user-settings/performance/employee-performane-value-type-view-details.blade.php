@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\ValueTypeDetail;
    use App\Models\valueTypeConfigDetail;
    ?>

    <section class="main-contant-section">
        <div class=" ">
            <style>
                .performance-report-pdf .header-logo {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                .performance-report-pdf .check-box {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                .performance-report-pdf .date-info {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }

                table tr td {
                    border: 1px solid #333;
                    padding: 3px 5px;
                }

                table tr th {
                    border: 1px solid #333;
                    padding: 3px 5px;
                }

                .singnature {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: end;
                    width: 100%;
                    gap: 20px;
                    text-align: center;
                }

                .singnature p {
                    border-top: 1px solid #000;
                    width: 100%;
                    margin-bottom: 0;
                }

                .flex-content {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: end;
                    width: 100%;
                    gap: 20px;
                    text-align: left;
                }

                .flex-content p {
                    width: 100%;
                    margin-bottom: 0;
                }

                table tr td h4 {
    margin: 0;
    font-size: 16px;
    padding: 5px;
    text-align: center;
    font-weight: 700;
    text-transform: lowercase;
}

table tr th h4 {
    margin: 0;
    font-size: 14px;
    padding: 1px;
    text-align: center;
    font-weight: 700;
    text-transform: lowercase;
}

                .performance-report-pdf .section-title {
                    text-align: center;
                }
            </style>
            <div class="performance-report-pdf">
                <div class="header-info">
                    <div class="section-title">


                        <div class="card mb-0">
                            <div class="card-header with-border">
                                <h1 class="card-title text-center"> Employees Yearly Value Review View</h1>
                                <ol id="breadcrumb1">
                                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                    <li><a href="{{ route('employee-values') }}"><span class="fa fa-list"> List</span> </a></li>
                                    <li><a href="#">Show - {{ 'Yearly Values Review' }} </a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box">
                    <div class="table-responsive">
                    <table>
                    <tbody>
                        <tr>
                            <td colspan="5">
                                <h4>Staff Infomation</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Name Of The Staff:</td>
                            <td>{{ ucfirst($userName->valueUser->first_name) }}
                                {{ ucfirst($userName->valueUser->last_name) }}
                            </td>
                            <td>PIN:</td>
                            <td>{{ ucfirst($userName->valueUser->company_assigned_id) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Designation in use (including function):</td>
                            <td colspan="3">{{  $userDesignation->valueDesignation->designation_name ?? ''}}</td>

                        </tr>
                        <tr>
                            <td colspan="2">Organizational Unit (Program/Department):</td>
                            <td colspan="3">{{ $userDepartment->valueDepartment->department_name ?? ''}}</td>

                        </tr>
                        <tr>
                            <td colspan="2">Date of joining BRAC:</td>
                            <td> {{ $userName->valueUser->joining_date }}</td>
                            <td>Country:</td>
                            <td>
                                Afghaanse
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5">
                                <h4>iii) ASSESSMENT ON VALUES - YEAR END REVIEW</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                The Supervisor should write comment on how they assessed the employee
                                on these values based on evidence of observed behaviors, and where the
                                employee needs improvement. Please provide one comment per value, but
                                each behavior statement must be rated using the rating scale of 3 - 1.
                            </td>
                        </tr>
                        <tr>
                            <td>Values</td>
                            <td>Employee Comments with examples of behaviors</td>
                            <td colspan="">
                                Supervisor Comments with examples of behavior displayed or not
                                displayed
                            </td>
                            <td>Employee Ratings</td>
                            <td>Supervisor Rating (3 -1)</td>
                        </tr>
                        @foreach ($value_type_config_details->unique(fn($p) => $p->valuetype->value_type_name ?? '') as $variable_type)
                            <?php
                            $value_type_details = valueTypeConfigDetail::where('value_type_config_type_id', $variable_type->value_type_config_type_id)
                                ->where('value_type_config_id', $variable_type->value_type_config_id)
                                ->get();

                            ?>

                            <tr>

                                <th colspan="5" style="background-color: #04AA6D; text-align:center; color:#fff;">
                                    <h4> {{ $variable_type->valuetype->value_type_name ?? '' }} </h4>
                                </th>
                            </tr>
                            @foreach ($value_type_details as $value_type_detail)
                                <tr valign="top">
                                    <td style="text-align: center; border: 1px solid;">
                                        {{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}
                                    </td>
                                    <td style="text-align: center; border: 1px solid;">
                                        {{ $value_type_detail->value_type_config_Employee_behaviour ?? null }}
                                    </td>
                                    <td style="text-align: center; border: 1px solid;">
                                        {{ $value_type_detail->value_type_config_supervisor_comment ?? null }}
                                    </td>

                                    <td style="text-align: center; border: 1px solid;">
                                        <select class="form-control  " data-live-search="true"
                                            data-live-search-style="begins" data-dependent="valuetype"
                                            title="{{ __('Select Rating Value') }}...">
                                            <option value="">Please Select </option>

                                            <option value="3"
                                                {{ $value_type_detail->value_type_config_employee_rating == 3 ? 'selected' : '' }}>
                                                A</option>
                                            <option value="2"
                                                {{ $value_type_detail->value_type_config_employee_rating == 2 ? 'selected' : '' }}>
                                                B</option>
                                            <option value="1"
                                                {{ $value_type_detail->value_type_config_employee_rating == 1 ? 'selected' : '' }}>
                                                C</option>

                                        </select>
                                    </td>
                                    <td style="text-align: center; border: 1px solid;">
                                        <select name="supervisor_employee_value_type_point[]"
                                            class="supervisor_point form-control" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="valuetype"
                                            title="{{ __('Select Rating Value') }}...">
                                            {{-- <option value="">Select Value</option> --}}
                                            <option value="3"
                                                {{ $value_type_detail->value_type_config_supervisor_rating == 3 ? 'selected' : '' }}>
                                                A</option>
                                            <option value="2"
                                                {{ $value_type_detail->value_type_config_supervisor_rating == 2 ? 'selected' : '' }}>
                                                B</option>
                                            <option value="1"
                                                {{ $value_type_detail->value_type_config_supervisor_rating == 1 ? 'selected' : '' }}>
                                                C</option>

                                        </select>
                                    </td>
                            @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="background-color: #04AA6D; color: #fff; text-align:center; font-size: 14px;">Value Point Average</td>
                            <td style="background-color: #04AA6D">
                                @if ($value_employee_rating == 3)
                                    {{ __('A') }}
                                @elseif($value_employee_rating >= 2)
                                    {{ __('B') }}
                                @elseif($value_employee_rating >= 1)
                                    {{ __('C') }}
                                @endif
                            </td>
                            <td style="background-color: #04AA6D; color: #fff; text-align:center; font-size: 14px;">
                                @if ($value_supervisor_rating == 3)
                                    <input type="text" id="sum" value="{{ __('A') }}" readonly>
                                @elseif($value_supervisor_rating >= 2)
                                    <input type="text" id="sum" value="{{ __('B') }}" readonly>
                                @elseif($value_supervisor_rating >= 1)
                                    <input type="text" id="sum" value="{{ __('C') }}" readonly>
                                @endif
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
