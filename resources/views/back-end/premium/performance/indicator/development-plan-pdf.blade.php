<h1 style="text-align: center">{{ ucfirst($userName->user->first_name) }}
    {{ ucfirst($userName->user->last_name) }}'s Development Details </h1>
    <table style="width:100%">
        <tbody>
            <tr valign="top">
                <th style="background-color: #04AA6D">
                    Individual Objective With Timeline
                </th>
                <th style="background-color: #04AA6D">
                    Measures Of Success
                </th>
                <th style="background-color: #04AA6D">
                    Action Taken
                </th>


            </tr>

            @foreach ($detailsDevelopment as $value)
            <tr>
                <td style="text-align: center; border: 1px solid;">{{ $value->development_name }}</td>
                <td style="text-align: center; border: 1px solid;">{{ $value->development_meassure_of_success }}</td>
                <td style="text-align: center; border: 1px solid;"> {{ $value->development_action_taken }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>