@extends('Layouts.masterLayout')
@section('title')
    Change Password
@endsection

@section('content')
    <div style="margin:0 auto; width:60%; border:1px dotted grey; border-radius:10px; background:rgba(0,0,0,0.7); color:white;"
        class="p-5 mb-5 mt-5">
        <form action="/change-your-password" method="POST">
            @csrf
            <h2 class="text-center">Change Your Password</h2>
            <hr class="mb-4">
            <input type="hidden" name="uid" value="{{ $user['id'] }}">
            <div class="mb-1">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <span class="text-danger">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-danger">Change Password</button>
        </form>
    </div>
@endsection
