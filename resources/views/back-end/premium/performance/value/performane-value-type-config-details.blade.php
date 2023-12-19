@extends('back-end.premium.layout.premium-main')
@section('content')
    <?php
    use App\Models\ValueTypeDetail;
    use App\Models\valueTypeConfigDetail;
    ?>
    <section class="main-contant-section">
        <div class="">
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
            <?php
            $employee_rating = 0;
            $supervisor_rating = 0;
            ?>
            @php($i = 1)

            <div class="objective-contant">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card mb-0">
                            <div class="card-header with-border">
                                <h1 class="card-title text-center">  {{ $userName->valueUser->first_name ?? '' }}
                                    {{ $userName->valueUser->last_name ?? '' }}'s Yearly Values Review Form</h1>
                                <ol id="breadcrumb1">
                                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                    <li><a href="{{ route('performance-value-type-configures') }}"><span class="fa fa-list"> List</span> </a></li>
                                    <li><a href="#">Show - {{ 'Yearly Values Review' }} </a></li>
                                </ol>
                            </div>
                        </div>

                        <div class="content-box">
                            <div class="section-title">
                                <h6>ASSESSMENT ON VALUES - YEAR END REVIEW</h6>
                            </div>
                            <p>The Supervisor should write comment on how they assessed the employee on these values based
                                on evidence of observed behaviors,
                                and where the employee needs improvement. Please provide one comment per value, but each
                                behavior statement must be rated using the rating scale of A - C. </p>
                            <form method="POST" action="{{ route('update-value-reviews', $userName->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <table class="form-table objective" id="Objective_plan">


                                    <th>Values</th>
                                    <th class="text-center">
                                        Employee Comments with examples of behaviors
                                    </th>
                                    <th class="text-center">
                                        Supervisor Comments with examples of behavior displayed or not displayed
                                    </th>
                                    <th class="text-center">
                                        Employee Rating
                                    </th>
                                    <th class="text-center">
                                        Supervisor Rating
                                    </th>
                                    @foreach ($value_type_config_details->unique(fn($p) => $p->valuetype->value_type_name ?? '') as $variable_type)
                                        <?php
                                        $value_type_details = valueTypeConfigDetail::where('value_type_config_type_id', $variable_type->value_type_config_type_id)
                                            ->where('value_type_config_id', $variable_type->value_type_config_id)
                                            ->get();

                                        ?>

                                        <input type="hidden" class="code" name="value_type_config_dept_id"
                                            value="{{ $variable_type->value_type_config_dept_id }}" />
                                        <input type="hidden" class="code" name="value_type_desg_id"
                                            value="{{ $variable_type->value_type_config_desg_id }}" />
                                        <input type="hidden" class="code" name="value_type_emp_id"
                                            value="{{ $variable_type->value_type_config_detail_emp_id }}" />


                                        <tr>
                                            <th colspan="7" class="text-center">
                                                {{ $variable_type->valuetype->value_type_name ?? '' }}

                                            </th>
                                        </tr>

                                        <tr valign="top">
                                            @foreach ($value_type_details as $value_type_detail)
                                        <tr valign="top">

                                            <input type="hidden" class="code" name="value_type_id[]"
                                                value="{{ $value_type_detail->value_type_config_id ?? null }}" />
                                            <input type="hidden" class="code" name="config_value_type_id[]"
                                                value="{{ $value_type_detail->value_type_config_type_detail_id ?? null }}" />

                                            <input type="hidden" class="code" name="value_type_config_type_id[]"
                                                value="{{ $variable_type->value_type_config_type_id ?? null }}" />

                                            <td>{{ $value_type_detail->valueTypDeatils->value_type_detail_value ?? null }}
                                            </td>
                                            <td> <input type="text" name="employee_comments[]"
                                                    placeholder="Employee Comments" readonly
                                                    value="{{ $value_type_detail->value_type_config_Employee_behaviour ?? null }}" />
                                            </td>
                                            <td> <input type="text" name="supervisor_comments[]"
                                                    placeholder="Supervisor Comments"
                                                    value="{{ $value_type_detail->value_type_config_supervisor_comment ?? null }}" />
                                            </td>
                                            <td>
                                                <select name="employee_value_type_point[]" class="form-control  "
                                                    data-live-search="true" data-live-search-style="begins"
                                                    data-dependent="valuetype" title="{{ __('Select Rating Value') }}...">
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
                                            <td>
                                                <select name="supervisor_employee_value_type_point[]" class="supervisor_point form-control"
                                                    data-live-search="true" data-live-search-style="begins"
                                                    data-dependent="valuetype" title="{{ __('Select Rating Value') }}...">
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

                                        </tr>
                                    @endforeach
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class=" text-right" colspan="3">Total Values Score</td>
                                        <td class=" text-center">
                                            @if ($value_employee_rating == 3)
                                                {{ __('A') }}
                                            @elseif($value_employee_rating >= 2)
                                                {{ __('B') }}
                                            @elseif($value_employee_rating >= 1)
                                                {{ __('C') }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($value_supervisor_rating == 3)
                                                <input type="text" id="sum" value="{{ __('A') }}" readonly>
                                            @elseif($value_supervisor_rating >= 2)
                                                <input type="text" id="sum" value="{{ __('B') }}" readonly>
                                            @elseif($value_supervisor_rating >= 1)
                                                <input type="text" id="sum" value="{{ __('C') }}" readonly>
                                            @endif
                                            <input type="hidden" name="supervisor_value_point" id="result">
                                        </td>
                                    </tr>
                                    <span id="objec"></span>
                                </table>
                                <button class="btn btn-grad mt-4">Save</button>
                                <input type="submit" name="value_satatus" class="btn btn-grad mt-4"
                                    value="{{ __('Approve') }}" />

                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        $(document).on('change', '.supervisor_point', function() {
            var sum = 0;
            var value_type_id =$('input[name="value_type_id[]"]').length;
            // console.log(value_type_id);
            $("select[name='supervisor_employee_value_type_point[]']").each(function() {
                sum += +this.value || 0;
            });
            var supervisor_value = Math.round(sum/value_type_id);
            if (supervisor_value == 3) {
                $("#sum").val('A');
            } else if(supervisor_value == 2) {
                $("#sum").val('B');
            }else if(supervisor_value == 1){
                $("#sum").val('C');
            }
            $("#result").val(supervisor_value);
            console.log(supervisor_value);

        });
    </script>
@endsection
