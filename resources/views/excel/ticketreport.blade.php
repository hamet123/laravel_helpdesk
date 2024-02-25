<table class="table">
    <thead>
        <tr>
            <th scope="col">Sr. No.</th>
            <th scope="col">Created By</th>
            <th scope="col">Created On</th>
            <th scope="col">Department</th>
            <th scope="col">Assigned To</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $serialNumber = 0;
        @endphp
        @forelse ($tickets as $ticket)
        @php
            $serialNumber++;
        @endphp
        <tr>
            <th>{{ $serialNumber }}</th>
            <th>{{ App\Models\User::find($ticket['user_id'])['name'] }}</th>
            <th>{{ $ticket['created_at']->format('F j, Y h:i A') }}</th>
            <th>{{ App\Models\Department::find($ticket['department_id'])['department'] }}</th>
            <th>{{ App\Models\User::find($ticket['agent_id'])['name'] }}</th>
            <th>{{ App\Models\Status::find($ticket['status_id'])['status_name'] }}</th>
        </tr>
        @empty
            <tr>
            <th colspan="6">No Record Found</th>
            </tr>
        @endforelse
    </tbody>
</table>