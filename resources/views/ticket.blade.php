@extends('Layouts.masterLayout')
@section('title')
    Ticket - {{ $ticket['subject'] }}
@endsection
@php
    use App\Models\User;
    use App\Models\Department;
    use App\Models\Status;
@endphp
@push('customstyle')
    <style>
    </style>
@endpush
<style>
    p {
        font-size: 13px !important;
    }

    .ticketdiv {
        margin-bottom: 100px;
        margin-top: 50px;
    }

    .specialfont {
        color: #38e126 !important;
    }
</style>
@section('content')
    <div class="container p-5 ticketdiv dark-background">
        <div class="row dark-background p-3">
            <div class="col-md-12">
                <div class="white-border p-5">
                    <h2 class="text-white text-center">Subject - {{ $ticket['subject'] }}</h2>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-8 dark-background p-3">
                <div class="white-border p-3">
                    <h4 class="text-white text-center p-2">Ticket Description </h4>
                    <hr style="background:white;">
                    <textarea class="mb-2" style="background:rgba(0,0,0,0.2);color:white; width:100%; min-height:340px; padding:20px;"
                        id="" disabled>{{ $ticket['description'] }}</textarea>
                    @foreach ($ticketAttachments as $singleAttachment)
                        <a class="mx-2 specialfont" target="_blank" href="{{ Storage::url($singleAttachment->path) }}">Attachment
                            {{ $loop->iteration }} </a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4 dark-background p-3">
                @if (Session::has('uid') &&
                        (User::find(Session::get('uid'))->role == 'admin' || User::find(Session::get('uid'))->role == 'agent'))
                    <div class="ticketconfig white-border p-4">
                        <form action="/ticket-config" method="post">
                            @csrf
                            <p class="specialfont" style="font-weight:bold;">Ticket Created By : {{ $ticketUser['name'] }}
                            </p>
                            <p class="specialfont" style="font-weight:bold;">Ticket Created On :
                                {{ $ticket['created_at']->format('F j, Y h:i A') }}
                            </p>
                            <p class="specialfont" style="font-weight:bold;">Department :
                                {{ Department::find($ticket['department_id'])['department'] }}
                            </p>
                            <p class="specialfont" style="font-weight:bold;">Assigned To :
                                {{ User::find($ticket['agent_id'])['name'] }}
                            </p>
                            <p class="specialfont" style="font-weight:bold;">Status :
                                {{ Status::find($ticket['status_id'])['status_name'] }}
                            </p>
                            <hr style="background:white;">
                            <label class="text-white form-label" for="department">Support Department</label>
                            <br>
                            <input type="hidden" name="id" value="{{ $ticket['id'] }}">
                            <select class="form-control" name="department" id="department">
                                <option value="" selected>Select Department</option>
                                @forelse ($departments as $department)
                                    <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
                                @empty
                                    <option value="">No Departments Found</option>
                                @endforelse
                            </select>
                            <br>
                            <label class="text-white form-label" for="status">Status</label>
                            <br>
                            <select class="form-control" name="status" id="status">
                                <option value="" selected>Select Status</option>
                                @forelse ($statuses as $status)
                                    <option value="{{ $status['id'] }}">{{ $status['status_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                            <button class="btn btn-success form-control mt-3">Update</button>
                        </form>
                    </div>
                @else
                    <div class="ticketconfig white-border p-4">
                        <p class="specialfont" style="font-weight:bold;">Ticket Created By : {{ $ticketUser['name'] }}
                        </p>
                        <p class="specialfont" style="font-weight:bold;">Ticket Created On :
                            {{ $ticket['created_at']->format('F j, Y h:i A') }}
                        </p>
                        <p class="specialfont" style="font-weight:bold;">Department :
                            {{ Department::find($ticket['department_id'])['department'] }}
                        </p>
                        <p class="specialfont" style="font-weight:bold;">Assigned To :
                            {{ User::find($ticket['agent_id'])['name'] }}
                        </p>
                        <p class="specialfont" style="font-weight:bold;">Status :
                            {{ Status::find($ticket['status_id'])['status_name'] }}
                        </p>
                    </div>
                @endif
            </div>
        </div>


        <div class="row dark-background p-3">
            <h4 class="text-white text-center py-3" style="border-top:1px solid grey; border-bottom:1px solid grey;">Threads
            </h4>
        </div>


        <div class="row mt-2 text-white white-border p-5 dark-background">
            <div class="col-md-12">
                @foreach ($comments as $comment)
                    <div style="border:1px solid grey; border-radius:10px;" class="mb-5">
                        <div class="comment p-3">
                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-md-4">
                                    <p class="specialfont">Added by -
                                        {{ App\Models\User::find($comment['user_id'])['name'] }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="specialfont">Added on - {{ $comment['created_at']->format('F j, Y h:i A') }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="specialfont">Email Id -
                                        {{ App\Models\User::find($comment['user_id'])['email'] }}</p>
                                </div>
                            </div>
                            <hr style="background:white;">
                            <div class="row p-2">
                                <div class="col-md-12 p-3"
                                    style="background:rgba(255,255,255,0.5); border-radius:10px; color:black;">
                                    <p>{{ $comment['comment'] }}</p>
                                </div>
                            </div>
                            @if (Session::get('uid') == $comment['user_id'])
                                <a href="/delete-comment/{{ $comment['id'] }}" class="btn btn-danger mt-2">Delete</a>
                            @endif
                        </div>

                    </div>
                @endforeach
                <hr style="background:white;" class="mb-5">

                @if (Session::has('uid'))
                    <form action="/add-comment" method="post">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket['id'] }}">
                        <textarea name="comment" id="comment" cols="30" rows="3" class="form-control" placeholder="Add a thread"></textarea>
                        <button class="btn btn-success my-3">Reply</button>
                        @error('comment')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </form>
                @else
                    <h5 class="text-white text-center">Please <a href="/login" style="font-weight:bold;"
                            class="text-success">Login</a> to Comment !!!</h5>
                @endif

            </div>
        </div>
    </div>
@endsection
