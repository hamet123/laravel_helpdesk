@extends('Layouts.masterLayout')
@section('title')
    Register
@endsection

@section('content')
<style>
    .registerdiv {
            margin-bottom:150px !important;
    }
</style>
    <div style=" margin:0 auto; width:60%; border:1px dotted grey; border-radius:10px; background:rgba(0,0,0,0.7); color:white;"
        class="p-5 mb-5 mt-5 registerdiv">
        <form action="/register" method="POST">
            @csrf
            <h2 class="text-center">Register</h2>
            <hr class="mb-4">
            <div class="mb-1">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-1">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                <span class="text-danger">
                    @error('username')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-1">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-1">
                <label for="security_question" class="form-label">Security Question</label>
                <select class="form-select" for="security_question" name="security_question">
                    <option selected>Select Security Question</option>
                    <option value="1">In which city were you born?</option>
                    <option value="2">What is the model of your first car?</option>
                    <option value="3">What is the name of your favorite childhood friend?</option>
                    <option value="4">What is the first name of your maternal grandmother?</option>
                    <option value="5">What is your favourite computer/mobile game ?</option>
                    <option value="6">What is the title of your favorite book?</option>
                </select>
                <span class="text-danger">
                    @error('security_question')
                        {{ 'Please select the security question' }}
                    @enderror
                </span>
            </div>
            <div class="mb-1">
              <label for="security_answer" class="form-label">Give your answer</label>
              <input type="text" class="form-control" id="security_answer" name="security_answer">
              <span class="text-danger">
                  @error('security_answer')
                      {{ $message }}
                  @enderror
              </span>
          </div>
            <div class="mb-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <span class="text-danger">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-danger">Register</button>
        </form>
    </div>
@endsection
