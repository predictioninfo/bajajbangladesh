<table id="user-table" class="table table-bordered table-hover table-striped">
    <thead style="background-color:#20898f; color:white;">
        <tr>
            <th>SL</th>
            <th>ID no.</th>
            <th>PSR Name</th>
            <th>Region</th>
            <th>Area</th>
            <th>Territory</th>
            <th>Town</th>
            <th>Joining Date</th>
            <th>Personal Number</th>
            <th>Office Number</th>
        </tr>
    </thead>
    <tbody>
        @php($i=1)
        @foreach($data['employees'] as $employee)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$employee->company_assigned_id}}</td>
            <td>{{$employee->first_name.' '.$employee->last_name}}</td>
            <td>{{$employee->userregion->region_name ?? null}}</td>
            <td>{{$employee->userarea->area_name ?? null}}</td>
            <td>{{$employee->userterritory->territory_name ?? null}}</td>
            <td>{{$employee->usertown->town_name ?? null}}</td>
            <td>{{$employee->joining_date}}</td>
            <td>{{$employee->phone ?? null}}</td>
            <td>{{$employee->b_phone ?? null}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
