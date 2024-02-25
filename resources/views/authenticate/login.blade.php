@extends("Layouts.masterLayout")
@section('title')  Login @endsection

@section('content')

<div style="margin:0 auto; width:65%; border:1px dotted grey; border-radius:10px; background:rgba(0,0,0,0.7); color:white;" class="p-5 mt-5">
<form action="/login" method="POST">
    @csrf
    <h2 class="text-center">Login</h2><hr class="mb-4">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="d-flex justify-content-end">
      <a href="/forgot-password" class="text-light">Forgot Your Password ?</a>
    </div>
    <button type="submit" class="btn btn-danger">Login</button>

     <h5 class="text-danger pt-3">@error('login') {{ $message }} @enderror</h5>
  </form>
</div>
@endsection