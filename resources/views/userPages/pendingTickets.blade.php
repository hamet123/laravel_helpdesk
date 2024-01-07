@extends("userPages.userPageMasterLayout")
@section('title') Pending Tickets @endsection
@push('customstyle')
<style>
.navdiv-active-pending-tickets {
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
            <div class=" table-responsive">
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
                            <th>Edit Ticket</th>
                            <th>Close Ticket</th>
                           
                            
                        </tr>
                    </thead>
                    @php
                            $serialNumber=0;
                    @endphp
                    <tbody>
                       
                        @forelse ($tickets as $ticket)
                        @if ($ticket['status']!=='closed')
                        @php $serialNumber++; @endphp
                        <tr>
                            <td>{{ $serialNumber }}</td>
                            <td>{{ $ticket['subject'] }}</td>
                            <td>{{ $ticket['select_department'] }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($ticket['description'], 15) }}</td>
                            <td style=" font-size:18px;"><a class="text-danger" href="/ticket/{{ $ticket['id'] }}">{{ $ticket['id'] }}</a></td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $ticket['status'] }}</td>
                            <td>
                                @if ($ticket['status'] !== 'closed')
                                <a class="btn btn-success" href="/ticket/edit/{{ $ticket['id'] }}">Edit</a>
                                @else
                                <a class="btn btn-success" href="#" style="cursor:not-allowed; background:grey" disabled>Already Closed</a>
                                @endif
                                </td>
                            <td>
                                @if ($ticket['status'] !== 'closed')
                                <a class="btn btn-danger" href="/ticket/close/{{ $ticket['id'] }}">Close</a>
                                @else
                                <a class="btn btn-danger" href="#" style="cursor:not-allowed; background:grey" disabled>Already Closed</a>
                                @endif
                            </td>
                         </tr>       
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