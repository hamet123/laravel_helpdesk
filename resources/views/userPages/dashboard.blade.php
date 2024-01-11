@extends("userPages.userPageMasterLayout")
@section('title') Dashboard @endsection
@php
use App\Models\Status;
use App\Models\Department;
@endphp
@push('customstyle')
<style>
.navdiv-active-all-tickets {
    background: #b93c38

} 
.ticketDiv{
    background:rgba(0,0,0,0.7);
    border-radius:10px;
    padding:20px;
}
.text-danger:hover{
    font-weight: bold;
}

</style>
  
@endpush
@section("usercontent")

    <div class="container mt-5 ticketDiv">
        <div class="row">
            <div class="table-responsive">
                <table class="table text-white hideTableWhenEmpty">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Subject</th>
                            <th>Department</th>
                            <th>Description</th>
                            <th>Ticket ID</th>
                            <th>Created By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @php
                            $serialNumber=0;
                    @endphp
                    <tbody>
                        @forelse ($tickets as $ticket)
                        @php
                            $serialNumber++;
                        @endphp
                        @if ($ticket)
                        <tr>
                            <td>{{ $serialNumber }}</td>
                            <td>{{ $ticket['subject'] }}</td>
                            <td>{{ Department::find($ticket['department_id'])['department'] }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($ticket['description'], 15) }}</td>
                            <td style=" font-size:18px;"><a class="text-danger" href="/ticket/{{ $ticket['id'] }}">{{ $ticket['id'] }}</a></td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ Status::find($ticket['status_id'])['status_name'] }}</td>
                            
                        </tr>  
                        @else
                        <h2 class="text-danger text-center">No tickets found</h2>
                            <style>
                                .hideTableWhenEmpty{
                                    display:none;
                                }
                            </style>
                        @endif  
                        @empty
                            <h2 class="text-danger text-center">No tickets found</h2>
                            <style>
                                .hideTableWhenEmpty{
                                    display:none;
                                }
                            </style>
                        @endforelse 
                         
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection