@extends("Layouts.masterLayout")
@section('title')  Register @endsection

@section('content')
<div style="margin:0 auto; width:60%; border:1px dotted grey; border-radius:10px; background:rgba(0,0,0,0.7); color:white;" class="p-5 mb-5 mt-5">
<form action="/register" method="POST">
    @csrf
    <h2 class="text-center">Register</h2><hr class="mb-4">
    <div class="mb-1">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
      </div>
      <div class="mb-1">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
        <span class="text-danger">@error('username') {{ $message }} @enderror</span>
      </div>
    <div class="mb-1">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
      <span class="text-danger">@error('email') {{ $message }} @enderror</span>
    </div>
    <div class="mb-1">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
      <span class="text-danger">@error('password') {{ $message }} @enderror</span>
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
      </div>
    <button type="submit" class="btn btn-danger">Register</button>
  </form>
</div>
@endsection