@extends('agentPages.agentPageMasterLayout')
@section('title')
    Assigned Tickets
@endsection
@php
    use App\Models\Status;
    use App\Models\Department;
    use App\Models\User;
@endphp
@push('customstyle')
    <style>
        .assignedTickets {
            background: red;
        }

        hr {
            background: white;
        }

        .table {
            color: white;
        }
        .maindiv{
            background:rgba(0,0,0,0.5);
        }
    </style>
@endpush
@section('content')
    <div class="maindiv p-5">
        <h5 class="text-white">Assigned Tickets</h5>
        <hr class="mb-2">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Ticket Number</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Department</th>
                        <th>Raised By</th>
                        <th>Raised On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php
                    $serialNumber = ($tickets->currentPage() - 1) * $tickets->perPage();
                @endphp
                <tbody>
                    @forelse ($tickets as $ticket)
                        @php
                            $serialNumber++;
                        @endphp
                        <tr>
                            <td>{{ $serialNumber }}</td>
                            <td style=" font-size:18px;"><a class="text-danger"
                                    href="/ticket/{{ $ticket['id'] }}">{{ $ticket['id'] }}</a></td>
                            <td>{{ Str::limit($ticket['subject'], 25) }}</td>
                            <td>{{ Str::limit($ticket['description'], 25) }}</td>
                            <td>{{ Department::find($ticket['department_id'])->department }}</td>
                            <td>{{ User::find($ticket['user_id'])->name }}</td>
                            <td>{{ $ticket['created_at'] }}</td>
                            <td>{{ Status::find($ticket['status_id'])->status_name }}</td>
                            <td><a href="/close-ticket-by-agent/{{ $ticket['id'] }}" class="btn btn-danger">Close</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Tickets found</td>
                        </tr>
                    @endforelse
                </tbody>
                <div class="text-center" id="pagination">
                    {{ $tickets->links('pagination::bootstrap-5') }}
                </div>
            </table>
        </div>
    </div>
@endsection
