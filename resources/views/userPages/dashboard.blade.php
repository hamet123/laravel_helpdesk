@extends("userPages.userPageMasterLayout")
@section('title') Dashboard @endsection
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
                            <th>Attachments</th>
                            <th>Edit Ticket</th>
                            <th>Close Ticket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ticket['subject'] }}</td>
                            <td>{{ $ticket['select_department'] }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($ticket['description'], 15) }}</td>
                            <td style="text-align:center; font-size:18px;"><a class="text-danger" href="/ticket/{{ $ticket['id'] }}">{{ $ticket['id'] }}</a></td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $ticket['status'] }}</td>
                            <td style="text-align:center; font-size:18px;"><a class="text-danger" href="{{ asset(Storage::url($ticket['attachment'])) }}">View</a></td>
                            <td><a class="btn btn-success" href="/ticket/edit/{{ $ticket['id'] }}">Edit</a></td>
                            <td><a class="btn btn-danger" href="/ticket/close/{{ $ticket['id'] }}">Close</a></td>
                        </tr>  
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