@extends('adminPages.adminPageMasterLayout')
@section('title')
    Search Ticket
@endsection
@php
    use App\Models\Department;
    use App\Models\Status;
    use App\Models\User;
@endphp
@push('customstyle')
    <style>
        .searchTicket {
            background: red;
        }

        .card {
            background: rgba(0, 0, 0, 0.568);
            color: white;
        }

        hr {
            background: white;
            margin: 0;
            padding: 0;
        }

        .parentdiv {
            background: rgba(0, 0, 0, 0.568);
            color: white;
            padding: 50px;
        }

        .resultdiv{
            width:50%;
            border:1px solid grey;
            border-radius:10px;
            padding:30px;
        }
        table thead th {
            font-size:12px;
        }
    </style>
@endpush
@section('content')
    <div class="container parentdiv">
        <div class="row">
            <div class="col-xl-12">
                <h5 class="text-white text-center">Search Ticket</h5>
                <hr class="my-3">
                <form action="/search-ticket" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    @csrf
                                    <div class="col-xl-5">
                                        <input type="text" name="ticket_no" id="ticket_no" class="form-control"
                                            placeholder="Enter Ticket Number" style="display:inline-block">
                                    </div>
                                    @error('ticket_no')
                                        <span class="text-danger my-3">{{ $message }}</span>                                        
                                    @enderror
                                    <div class="col-xl-3 d-flex justify-content-start">
                                        <input type="submit" value="Search" class="btn btn-danger my-2"
                                            style="display:inline-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="my-3">
               

                @if (isset($ticket) && isset($user) && $searchTicketData == true)
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-xl-6 resultdiv">
                                <h2 class="text-center">Ticket Details</h2>
                                <hr class="my-3">
                                <h6>Ticket Number - <a href="/ticket/{{ $ticket['id'] }}" class="text-danger">{{ $ticket['id'] }}</a></h6>
                                <hr class="my-3">
                                <h6>Title - {{ $ticket['subject'] }}</h6>
                                <hr class="my-3">
                                <h6>Description - {{ $ticket['description'] }}</h6>
                                <hr class="my-3">
                                <h6>Created By -  {{ $user['name'] }}</h6>
                                <hr class="my-3">
                                <h6>Created On - {{ $ticket['created_at']->format('F j, Y h:i A') }}</h6>
                                <hr class="my-3">
                                <h6>Department - {{ Department::find($ticket['department_id'])['department'] }}</h6>
                                <hr class="my-3">
                                <h6>Assigned To - {{ User::find($ticket['agent_id'])['name'] }}</h6>
                                <hr class="my-3">
                                <h6>Ticket Status - {{ Status::find($ticket['status_id'])['status_name'] }} </h6>
                                <hr class="my-3">
                                @if (Status::find($ticket['status_id'])['status_name'] == "closed")
                                <h6>Closed On</h6>
                                <hr class="my-3">
                                <h6>Total Time</h6>
                                <hr class="my-3">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>                   
                @endif
            </div>
        </div>
    </div>
@endsection
