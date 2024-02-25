@extends('Layouts.masterLayout')
@section('title')
    Forgot Password
@endsection

@section('content')
    <div style="margin:0 auto; width:60%; border:1px dotted grey; border-radius:10px; background:rgba(0,0,0,0.7); color:white;"
        class="p-5 mb-5 mt-5">
        <form action="/forgot-password" method="POST">
            @csrf
            <h2 class="text-center">Forgot Your Password ?</h2>
            <hr class="mb-4">
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
            </div>
            <div class="mb-3">
              <label for="security_answer" class="form-label">Give your answer</label>
              <input type="text" class="form-control" id="security_answer" name="security_answer">
              <span class="text-danger">
                  @error('security_answer')
                      {{ $message }}
                  @enderror
              </span>
          </div>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
    </div>
@endsection
