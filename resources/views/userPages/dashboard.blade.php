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
                        </tr>
                    </thead>
<<<<<<< HEAD
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
=======
                    <tbody>
                        @forelse ($tickets as $ticket)
                        @if ($ticket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
>>>>>>> 1df1e2c7563e8d608581982f739a7ac006ab6e86
                            <td>{{ $ticket['subject'] }}</td>
                            <td>{{ $ticket['select_department'] }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($ticket['description'], 15) }}</td>
                            <td style=" font-size:18px;"><a class="text-danger" href="/ticket/{{ $ticket['id'] }}">{{ $ticket['id'] }}</a></td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $ticket['status'] }}</td>
                            
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