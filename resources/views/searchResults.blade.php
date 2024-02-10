@extends('Layouts.masterLayout')
@section('content')
<h5 class="text-center my-5 p-5 text-white" style="background:rgba(0,0,0,0.7);">Search Results</h5>
<div class="container" style="margin-bottom:100px;">
    <div class="row">
        @forelse ($results as $result)
{{-- If result is regarding the Comment --}}
@if ($result['model_type'] == 'Comment')
<div class="col-md-4">
    <div class="card my-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Ticket No. - <a href="/ticket/{{ $result['ticket_id'] }}"
                    class="text-danger">{{ $result['ticket_id'] }}</a></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Subject - {{ Str::limit(App\Models\Ticket::find($result['ticket_id'])['subject'], 10) }}</li>
            <li class="list-group-item">Created By -
                {{ App\Models\User::find(App\Models\Ticket::find($result['ticket_id'])['user_id'])['name'] }}</li>
            <li class="list-group-item">Assigned To -
                {{ App\Models\User::find(App\Models\Ticket::find($result['ticket_id'])['agent_id'])['name'] }}</li>
            <li class="list-group-item">Status -
                {{ App\Models\Status::find(App\Models\Ticket::find($result['ticket_id'])['status_id'])['status_name'] }} </li>
            <li class="list-group-item">Department -
                {{ App\Models\Department::find(App\Models\Ticket::find($result['ticket_id'])['department_id'])['department'] }}</li>
        </ul>
        <div class="card-body">
            <a href="/ticket/{{ App\Models\Ticket::find($result['ticket_id'])['id'] }}" class="card-link text-danger">View Ticket</a>
        </div>
    </div>
</div>
@endif

        {{-- If result is regarding the ticket --}}
        @if ($result['model_type'] == 'Ticket')
        <div class="col-md-4">
            <div class="card my-5" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Ticket No. - <a href="/ticket/{{ $result['id'] }}"
                            class="text-danger">{{ $result['id'] }}</a></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Subject - {{ Str::limit($result['subject'], 10) }}</li>
                    <li class="list-group-item">Created By -
                        {{ App\Models\User::find($result['user_id'])['name'] }}</li>
                    <li class="list-group-item">Assigned To -
                        {{ App\Models\User::find($result['agent_id'])['name'] }}</li>
                    <li class="list-group-item">Status -
                        {{ App\Models\Status::find($result['status_id'])['status_name'] }} </li>
                    <li class="list-group-item">Department -
                        {{ App\Models\Department::find($result['department_id'])['department'] }}</li>
                </ul>
                <div class="card-body">
                    <a href="/ticket/{{ $result['id'] }}" class="card-link text-danger">View Ticket</a>
                </div>
            </div>
        </div>
    @endif



        {{-- If result is regarding User --}}
        @if ($result['model_type'] == 'User')
                <div class="col-md-4">
                    <div class="card my-5" style="width: 18rem;">
                        @if ($result->profile_pic_path == null)
                            <img src="{{ asset('images/profile.png') }}" class="card-img-top p-2" alt="...">
                        @else
                            <img src="{{ Storage::url($result->profile_pic_path) }}" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Name - {{ $result['name'] }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @if ($result['role'] == 'agent')
                                <li class="list-group-item">Department -
                                    {{ App\Models\Department::find($result['department_id'])['department'] }}</li>
                            @endif
                            <li class="list-group-item">Role - {{ $result['role'] }}</li>
                            @if ($result['email'] !== null)
                                <li class="list-group-item">Email - {{ $result['email'] }}</li>
                            @endif
                            {{-- Getting Phone number and address --}}
                            @php
                                $userInfo = App\Models\UserInfo::where('user_id', $result['id'])->first();
                            @endphp

                            @if ($userInfo && $userInfo->phone !== null)
                                <li class="list-group-item">Phone - {{ $userInfo->phone }}</li>
                            @endif

                            @if ($userInfo && $userInfo->address !== null)
                                <li class="list-group-item">Address - {{ $userInfo->address }}</li>
                            @endif

                            {{-- end of getting phone number and address --}}
                        </ul>
                    </div>
                </div>
            @endif

        {{-- If result is regarding UserInfo --}}
            @if ($result['model_type'] == 'UserInfo')
                <div class="col-md-4">
                    <div class="card my-5" style="width: 18rem;">
                        @if (App\Models\User::find($result['user_id'])['profile_pic_path'] == null)
                            <img src="{{ asset('images/profile.png') }}" class="card-img-top p-2" alt="...">
                        @else
                            <img src="{{ Storage::url(App\Models\User::find($result['user_id'])['profile_pic_path']) }}"
                                class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Name - {{ App\Models\User::find($result['user_id'])['name'] }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @if (App\Models\User::find($result['user_id'])['role'] == 'agent')
                                <li class="list-group-item">Department -
                                    {{ App\Models\Department::find(App\Models\User::find($result['user_id'])['department_id'])['department'] }}
                                </li>
                            @endif
                            <li class="list-group-item">Role - {{ App\Models\User::find($result['user_id'])['role'] }}</li>
                            @if (App\Models\User::find($result['user_id'])['email'] !== null)
                                <li class="list-group-item">Email -
                                    {{ App\Models\User::find($result['user_id'])['email'] }}</li>
                            @endif
                            {{-- Getting Phone number and address --}}
                            @php
                                $userInfo = App\Models\UserInfo::where('user_id', App\Models\User::find($result['user_id'])['id'])->first();
                            @endphp

                            @if ($userInfo && $userInfo->phone !== null)
                                <li class="list-group-item">Phone - {{ $userInfo->phone }}</li>
                            @endif

                            @if ($userInfo && $userInfo->address !== null)
                                <li class="list-group-item">Address - {{ $userInfo->address }}</li>
                            @endif

                            {{-- end of getting phone number and address --}}
                        </ul>
                    </div>
                </div>
            @endif

        @empty
        <div class="dark-background text-white text-center p-5">No results found</div>
        @endforelse
    </div>
</div>

@endsection