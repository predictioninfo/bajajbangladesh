<table style="width:100%">
    <thead style="background-color:#e8ee9a; color:white; border:1px solid black;">
        <tr>
            <th colspan="13"
                style="background-color:#eeabab; color:black; text-align:center; border:1px solid black; font-size:20px;">
                List Of
                Separation </th>
            <th colspan="6"
                style="background-color:#d0d314; color:black; text-align:center; border:1px solid black; font-size:20px;">
                List of New
                Joining PSR </th>
        </tr>
        <tr style="text-align:center; border:1px solid black; font-size:15px; color:black;">
            <th style="text-align:center; border:1px solid black;">{{ __('Month') }}</th>
            <th style="text-align:center; border:1px solid black;">{{__('SL')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('ID NO')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Seperated OLD PSR')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Territory')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('SE-Area')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Joinig date')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Resigned Date')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Name of Distributors')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Location')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Cluster no')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Area')}}</th>
            <th style="text-align:center; border:1px solid black;">{{__('Mob')}}</th>
            <th style="background-color:#d0d314; color:black; text-align:center; border:1px solid black;">
                {{__('Replace PSR Name')}}</th>
            <th style="background-color:#d0d314; color:black; text-align:center; border:1px solid black;">
                {{__('ID NO.')}}</th>
            <th style="background-color:#d0d314; color:black;text-align:center; border:1px solid black;">
                {{__('Joining Date')}}</th>
            <th style="background-color:#d0d314; color:black;text-align:center; border:1px solid black;">
                {{__('Status')}}</th>
            <th style="background-color:#d0d314; color:black;text-align:center; border:1px solid black;">
                {{__('Phone Number')}}</th>
            <th style="background-color:#d0d314; color:black;text-align:center; border:1px solid black;">
                {{__('Remarks')}}</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i =1;
        @endphp
        @foreach($data['separations'] as $separation)
        <tr style="text-align:center; border:1px solid black;">
            <td style="text-align:center; border:1px solid black;">{{date('M-Y',
                strtotime($separation->date)) ?? null }}</td>
            <td style="text-align:center; border:1px solid black;">{{ $i++ }}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->company_assigned_id ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->first_name ?? null}} {{
                $separation->separationEmployee->last_name ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->userregion->region_name ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->userarea->area_name ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->joining_date ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{ $separation->date ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->userterritory->territory_name ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->usertown->town_name ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->emoloyeedetail->cluster ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->emoloyeedetail->dr_cksb ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->separationEmployee->inactive_phone ??
                null}}</td>
            <td style="text-align:center; border:1px solid black;">{{ $separation->repalaceEmployee->first_name
                ?? null}}{{
                $separation->repalaceEmployee->last_name ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->repalaceEmployee->company_assigned_id ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->repalaceEmployee->joining_date ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->repalaceEmployee->company_assigned_id ?? null}}</td>
            <td style="text-align:center; border:1px solid black;">{{ $separation->repalaceEmployee->phone ??
                null}}</td>
            <td style="text-align:center; border:1px solid black;">{{
                $separation->repalaceEmployee->inactive_description ?? null}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- <table>
    <thead>
        <tr>
            <th>sl</th>
            <th>sl</th>
        </tr>
    </thead>
    <tbody>
        <td>ss</td>
        <td>ss</td>
        {{-- <td>ss</td>
        <td>ss</td>
        <td>ss</td>
    </tbody>
</table> --}}
