@php
    use App\Models\User;
    use App\Models\Company;
@endphp
<style>
    th, td {
    border-bottom: 1px solid #ddd;
}
</style>
<div style="overflow-x:auto;">
    <h3 style="text-align:center;">
        @php
            $companyName = Company::where('id', Auth::user()->com_id)->first('company_name');
        @endphp
        {{ ucfirst($companyName->company_name) }}
    </h3>
    <h4 style="text-align:center;">Man Power Planning Sheet</h4>
    <table>
        <thead>
            <tr style="background-color: #4CAF50;
            color: white;">
                <th>{{ __('SL') }}</th>
                <th>{{ __('Department') }}</th>
                <th>{{ __('Designation') }}</th>
                <th>{{ __('Number of Employee') }}</th>
                <th>{{ __('Previous Employee') }}</th>
                <th>{{ __('(Increment/Decrement)') }}</th>
                <th>{{ __('Vacancy') }}</th>
                <th>{{ __('Recruited') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $manPower)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $manPower->manPowerDeparment->department_name }}</td>
                    <td>{{ $manPower->manPowerDesignation->designation_name }}</td>
                    <td>{{ $manPower->number_of_employee }}
                        ({{ date('d-m-Y', strtotime($manPower->vacancy_date)) }})
                    </td>
                    <td>{{ $manPower->previous_employee }} </td>
                    <td>
                        @if ($manPower->update_vacancy_date)
                            {{ $manPower->update_employee - $manPower->previous_employee ?? ' ' }}
                            ({{ date('d-m-Y', strtotime($manPower->update_vacancy_date)) }})
                            <br>
                            @if ($manPower->increment_or_decrement == 'decrement')
                                {{ 'Decrement' }}
                            @elseif($manPower->increment_or_decrement == 'increment')
                                {{ 'Increment' }}
                            @endif
                        @endif
                    </td>
                    @php
                        $vacancy = User::where('com_id', '=', Auth::user()->com_id)
                            ->where('department_id', '=', $manPower->manPowerDeparment->id)
                            ->where('designation_id', '=', $manPower->manPowerDesignation->id)
                            ->where('is_active', '=', 1)
                            ->count();
                    @endphp
                    <td>{{ $manPower->number_of_employee - $vacancy }}
                    </td>
                    <td>
                        @if ($vacancy == 0)
                            {{ '(No Employee Recruited)' }}
                        @else
                            {{ $vacancy }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
