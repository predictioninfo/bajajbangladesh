<table>
    <caption>Incomplete Performance</caption>

    <thead>
        <tr>
            <th>{{ __('SL') }}</th>
            <th>{{ __('Department') }}</th>
            <th>{{ __('Designation') }}</th>
            <th>{{ __('Employee') }}</th>
            {{-- <th>{{ __('Objective Point') }}</th>
            <th>{{ __('Value Point') }}</th> --}}
            <th>{{ __('Year') }}</th>
            {{-- <th>{{ __('Action') }}</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->userdepartmentfromobjective->department_name }}
                </td>
                <td>{{ $value->userdesignationfromobjective->designation_name }}
                </td>
                <td>{{ $value->userfromobjective->first_name }}
                    {{ $value->userfromobjective->last_name }}
                </td>
                {{-- <td>{{ $value->point }}</td> --}}
                {{-- <td>
                    @if ($value->value_point == 3)
                        {{ 'A' }}
                    @elseif($value->value_point == 2)
                        {{ 'B' }}
                    @elseif($value->value_point == 1)
                        {{ 'C' }}
                    @endif
                </td> --}}
                <td>{{ $value->objective_date }}</td>
                {{-- <td> <a style="padding-right: 5px;"
                        href="{{ route('single-performance-point-report', $value->id) }}"
                        class="" data-toggle="tooltip"
                        title="Download PDF"> <i
                            class="fa fa-file-pdf-o"></i>
                    </a>
                    <a href="{{ route('single-performance-point-preview', $value->id) }}"
                        class="" data-toggle="tooltip"
                        title="" data-original-title="Preview">
                        <i class="fa fa-eye"></i>
                    </a>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>